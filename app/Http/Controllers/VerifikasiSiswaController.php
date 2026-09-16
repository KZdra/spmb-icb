<?php

namespace App\Http\Controllers;

use App\Mail\PengumumanKelulusanMail;
use App\Models\PengaturanAplikasi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class VerifikasiSiswaController extends Controller
{
    /**
     * Generate NIS using configured prefix and counter
     */
    public function generateNIS($siswaId, $customNis = null)
    {
        if (!empty($customNis)) {
            $formattedNis = trim($customNis);
            DB::table('siswas')->where('id', $siswaId)->update([
                'nis' => $formattedNis,
                'updated_at' => now()
            ]);
            return $formattedNis;
        }

        $setting = PengaturanAplikasi::first();
        $prefix = $setting->nis_prefix ?? '125';
        $startNum = $setting->nis_start_number ?? 1;

        // Lock row to prevent race condition
        $counter = DB::table('nis_counters')->lockForUpdate()->first();

        if (!$counter) {
            $nisNumber = $startNum;
            DB::table('nis_counters')->insert([
                'last_number' => $nisNumber,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } else {
            $nisNumber = max($counter->last_number + 1, $startNum);
            DB::table('nis_counters')->update([
                'last_number' => $nisNumber,
                'updated_at' => now()
            ]);
        }

        $formattedNis = $prefix . str_pad($nisNumber, 4, '0', STR_PAD_LEFT);

        DB::table('siswas')->where('id', $siswaId)->update([
            'nis' => $formattedNis,
            'updated_at' => now()
        ]);

        return $formattedNis;
    }

    public function index(Request $request)
    {
        $datasis = Siswa::with(['dataTambahan', 'jurusan', 'buktiPembayaran'])
            ->orderBy('id', 'asc')
            ->get();
        return view('verifsiswa.index', compact('datasis'));
    }

    public function getDataTambahan(Request $request, $id)
    {
        $siswa = Siswa::with(['dataTambahan', 'jurusan', 'buktiPembayaran'])->findOrFail($id);
        return response()->json([
            'nama' => $siswa->nama,
            'siswa' => $siswa,
            'data_tambahan' => $siswa->dataTambahan,
            'bukti' => $siswa->buktiPembayaran,
            'jurusan' => $siswa->jurusan?->nama_jurusan
        ], 200);
    }

    public function approveStatus(Request $request)
    {
        $data = $request->validate([
            'siswa_id' => 'required',
            'custom_nis' => 'nullable|string|max:50'
        ]);

        DB::beginTransaction();
        try {
            $nis = $this->generateNIS($data['siswa_id'], $request->custom_nis);

            // Update status kelulusan siswa
            DB::table('siswas')->where('id', $data['siswa_id'])->update([
                'status' => 'Diterima',
                'isAccepted' => 1,
                'updated_at' => now()
            ]);

            // Sekaligus validasi status bukti pembayaran siswa jika ada
            DB::table('bukti_pembayarans')->where('siswa_id', $data['siswa_id'])->update([
                'status' => 'verified',
                'updated_at' => now()
            ]);

            DB::commit();

            // Kirim email kelulusan secara otomatis ke email siswa
            $siswa = Siswa::with(['jurusan', 'dataTambahan'])->find($data['siswa_id']);
            if ($siswa && filter_var($siswa->email, FILTER_VALIDATE_EMAIL)) {
                try {
                    Mail::to($siswa->email)->send(new PengumumanKelulusanMail($siswa));
                } catch (\Exception $mailEx) {
                    Log::warning('Gagal mengirim email kelulusan ke ' . $siswa->email . ': ' . $mailEx->getMessage());
                }
            }

            return response()->json([
                'message' => 'Siswa Diterima! NIS: ' . $nis . ' diterbitkan, pembayaran diverifikasi, dan surat kelulusan telah dikirim ke email pendaftar.',
                'nis' => $nis
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function notApproveStatus(Request $request)
    {
        $data = $request->validate([
            'siswa_id' => 'required'
        ]);

        DB::beginTransaction();
        try {
            DB::table('siswas')->where('id', $data['siswa_id'])->update([
                'status' => 'Ditolak',
                'isAccepted' => 0,
                'updated_at' => now()
            ]);
            DB::commit();

            return response()->json(['message' => 'Pendaftaran Siswa Ditolak'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Setujui / Terima semua calon siswa yang berstatus Pending secara massal
     */
    public function approveAll(Request $request)
    {
        $pendingSiswas = Siswa::with(['jurusan', 'dataTambahan'])
            ->where(function ($q) {
                $q->where('status', 'Pending')
                  ->orWhereNull('status')
                  ->orWhere('isAccepted', 0);
            })
            ->where('status', '!=', 'Ditolak')
            ->get();

        if ($pendingSiswas->isEmpty()) {
            return response()->json([
                'message' => 'Tidak ada calon siswa dengan status pending untuk diverifikasi.'
            ], 422);
        }

        $count = 0;
        $failedEmails = 0;

        foreach ($pendingSiswas as $siswa) {
            DB::beginTransaction();
            try {
                // Generate NIS otomatis berurutan
                $nis = $this->generateNIS($siswa->id);

                DB::table('siswas')->where('id', $siswa->id)->update([
                    'status' => 'Diterima',
                    'isAccepted' => 1,
                    'updated_at' => now()
                ]);

                // Validasi bukti pembayaran jika ada
                DB::table('bukti_pembayarans')->where('siswa_id', $siswa->id)->update([
                    'status' => 'verified',
                    'updated_at' => now()
                ]);

                DB::commit();
                $count++;

                // Kirim notifikasi email kelulusan & surat ketetapan NIS
                if ($siswa->email && filter_var($siswa->email, FILTER_VALIDATE_EMAIL)) {
                    try {
                        Mail::to($siswa->email)->send(new PengumumanKelulusanMail($siswa));
                    } catch (\Exception $mailEx) {
                        $failedEmails++;
                        Log::warning("Gagal mengirim email kelulusan massal ke {$siswa->email}: " . $mailEx->getMessage());
                    }
                }
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error("Gagal menerima siswa massal ID {$siswa->id}: " . $e->getMessage());
            }
        }

        $emailMsg = $failedEmails > 0 ? " (catatan: {$failedEmails} email belum terkirim)" : " dan surat kelulusan telah dikirimkan ke email pendaftar.";

        return response()->json([
            'message' => "Sukses! Sebanyak {$count} calon siswa berhasil diterima secara massal, nomor NIS resmi diterbitkan{$emailMsg}",
            'total_accepted' => $count
        ], 200);
    }

    /**
     * Verifikasi bukti pembayaran siswa langsung dari satu pintu
     */
    public function verifBayarDirect(Request $request)
    {
        $data = $request->validate([
            'siswa_id' => 'required'
        ]);

        DB::table('bukti_pembayarans')->where('siswa_id', $data['siswa_id'])->update([
            'status' => 'verified',
            'updated_at' => now()
        ]);

        return response()->json(['message' => 'Bukti pembayaran berhasil diverifikasi!'], 200);
    }

    /**
     * Tolak bukti pembayaran siswa dengan catatan alasan
     */
    public function tolakBayarDirect(Request $request)
    {
        $data = $request->validate([
            'siswa_id' => 'required',
            'alasan' => 'nullable|string'
        ]);

        DB::table('bukti_pembayarans')->where('siswa_id', $data['siswa_id'])->update([
            'status' => 'rejected',
            'alasan' => $data['alasan'] ?? 'Bukti transfer tidak valid atau belum terbaca.',
            'updated_at' => now()
        ]);

        return response()->json(['message' => 'Pembayaran ditandai tidak valid / ditolak.'], 200);
    }

    /**
     * Export Rekapitulasi Data Siswa Pendaftar ke format Excel (.xlsx) Simpel
     */
    public function exportXlsx(Request $request)
    {
        $status = $request->query('status');
        $query = Siswa::with(['dataTambahan', 'jurusan', 'buktiPembayaran'])->orderBy('id', 'asc');
        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }
        $siswas = $query->get();
        $setting = PengaturanAplikasi::first();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Siswa SPMB');
        $sheet->setShowGridlines(true);

        // Page setup
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);

        // Title Block Simpel
        $appName = $setting->app_name ?? 'SMK ICB Cinta Teknika Bandung';
        $tahunAjaran = $setting->tahun_ajaran ?? (date('Y') . '/' . (date('Y') + 1));

        $sheet->setCellValue('A1', 'REKAPITULASI PENDAFTARAN SISWA BARU (SPMB)');
        $sheet->setCellValue('A2', strtoupper($appName) . ' - TAHUN AJARAN ' . $tahunAjaran);
        $sheet->setCellValue('A3', 'Dicetak pada: ' . date('d F Y, H:i') . ' WIB | Total Pendaftar: ' . count($siswas) . ' Siswa');

        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('102C57'));
        $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(11)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('334155'));
        $sheet->getStyle('A3')->getFont()->setItalic(true)->setSize(9)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('64748B'));

        // Header Columns Simpel Sesuai Urutan Asal (Tanpa Pekerjaan Orang Tua)
        $headers = [
            'A5'  => 'No',
            'B5'  => 'Kode Pendaftaran',
            'C5'  => 'Status',
            'D5'  => 'NIS',
            'E5'  => 'NISN',
            'F5'  => 'Nama Lengkap',
            'G5'  => 'Jenis Kelamin',
            'H5'  => 'Tempat Lahir',
            'I5'  => 'Tanggal Lahir',
            'J5'  => 'Agama',
            'K5'  => 'No. Handphone / WA',
            'L5'  => 'Email',
            'M5'  => 'Pilihan Jurusan',
            'N5'  => 'Jalur Pendaftaran',
            'O5'  => 'Asal Sekolah',
            'P5'  => 'Alamat Sekolah Asal',
            'Q5'  => 'Tahun Lulus',
            'R5'  => 'Alamat Domisili',
            'S5'  => 'RT',
            'T5'  => 'RW',
            'U5'  => 'Kelurahan / Desa',
            'V5'  => 'Kecamatan',
            'W5'  => 'Kota / Kabupaten',
            'X5'  => 'Provinsi',
            'Y5'  => 'Nama Ayah',
            'Z5'  => 'Telepon Ayah',
            'AA5' => 'Nama Ibu',
            'AB5' => 'Telepon Ibu',
            'AC5' => 'Tinggi (cm)',
            'AD5' => 'Berat (kg)',
            'AE5' => 'Status Pembayaran',
            'AF5' => 'Tanggal Daftar'
        ];

        foreach ($headers as $cell => $text) {
            $sheet->setCellValue($cell, $text);
        }

        // Header Styling Simpel & Rapi
        $headerRange = 'A5:AF5';
        $sheet->getStyle($headerRange)->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 10,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '102C57'],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => false,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => 'CBD5E1'],
                ],
            ],
        ]);
        $sheet->getRowDimension(5)->setRowHeight(25);

        // Fill Data Rows
        $row = 6;
        foreach ($siswas as $idx => $s) {
            $d = $s->dataTambahan;
            $bp = $s->buktiPembayaran;

            // Status Bayar
            $bayarText = 'BELUM UPLOAD';
            if ($bp && $bp->file_path) {
                $bpSt = strtolower($bp->status ?? 'pending');
                if ($bpSt === 'verified' || $bpSt === 'diverifikasi') {
                    $bayarText = 'LUNAS / VALID';
                } elseif ($bpSt === 'rejected' || $bpSt === 'ditolak') {
                    $bayarText = 'DITOLAK';
                } else {
                    $bayarText = 'MENUNGGU VERIFIKASI';
                }
            }

            $sheet->setCellValue('A' . $row, $idx + 1);
            $sheet->setCellValueExplicit('B' . $row, $s->kode_pendaftaran ?? '-', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('C' . $row, strtoupper($s->status ?? 'PENDING'));
            $sheet->setCellValueExplicit('D' . $row, $s->nis ?? '-', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('E' . $row, $s->nisn ? (string)$s->nisn : '-', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('F' . $row, $s->nama);
            $sheet->setCellValue('G' . $row, $s->jenis_kelamin);
            $sheet->setCellValue('H' . $row, $d->tempat_lahir ?? '-');
            $sheet->setCellValue('I' . $row, $d->tanggal_lahir ? date('d/m/Y', strtotime($d->tanggal_lahir)) : '-');
            $sheet->setCellValue('J' . $row, $s->agama);
            $sheet->setCellValueExplicit('K' . $row, $s->no_hp ? (string)$s->no_hp : '-', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('L' . $row, $s->email);
            $sheet->setCellValue('M' . $row, $s->jurusan?->nama_jurusan ?? '-');
            $sheet->setCellValue('N' . $row, $s->jalur_pendaftaran);
            $sheet->setCellValue('O' . $row, $s->asal_sekolah);
            $sheet->setCellValue('P' . $row, $d->alamat_sekolah_asal ?? '-');
            $sheet->setCellValue('Q' . $row, $s->tahun_lulus ?? '-');
            $sheet->setCellValue('R' . $row, $d->alamat ?? '-');
            $sheet->setCellValue('S' . $row, $d->rt ?? '-');
            $sheet->setCellValue('T' . $row, $d->rw ?? '-');
            $sheet->setCellValue('U' . $row, $d->kelurahan ?? '-');
            $sheet->setCellValue('V' . $row, $d->kecamatan ?? '-');
            $sheet->setCellValue('W' . $row, $d->kota ?? '-');
            $sheet->setCellValue('X' . $row, $d->provinsi ?? '-');
            $sheet->setCellValue('Y' . $row, $d->nama_ayah ?? '-');
            $sheet->setCellValueExplicit('Z' . $row, $d->telepon_ayah ? (string)$d->telepon_ayah : '-', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('AA' . $row, $d->nama_ibu ?? '-');
            $sheet->setCellValueExplicit('AB' . $row, $d->telepon_ibu ? (string)$d->telepon_ibu : '-', \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('AC' . $row, $d->tinggi_badan ?? '-');
            $sheet->setCellValue('AD' . $row, $d->berat_badan ?? '-');
            $sheet->setCellValue('AE' . $row, $bayarText);
            $sheet->setCellValue('AF' . $row, $s->created_at ? $s->created_at->format('d/m/Y H:i') : '-');

            // Zebra Striping Row Background
            if ($row % 2 == 1) {
                $sheet->getStyle('A' . $row . ':AF' . $row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('F8FAFC');
            }

            // Simple Status Coloring
            $statusCell = 'C' . $row;
            if (strtoupper($s->status ?? '') === 'DITERIMA') {
                $sheet->getStyle($statusCell)->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('059669'))->setBold(true);
            } elseif (strtoupper($s->status ?? '') === 'DITOLAK') {
                $sheet->getStyle($statusCell)->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('DC2626'))->setBold(true);
            } else {
                $sheet->getStyle($statusCell)->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('D97706'))->setBold(true);
            }

            $sheet->getRowDimension($row)->setRowHeight(20);
            $row++;
        }

        $lastRow = max(6, $row - 1);
        $dataRange = 'A6:AF' . $lastRow;

        // Border Tipis Abu-Abu Lembut untuk Semua Data
        $sheet->getStyle($dataRange)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => 'CBD5E1'],
                ],
            ],
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'font' => [
                'size' => 9,
            ]
        ]);

        // Alignment Spesifik Kolom
        $sheet->getStyle('A6:E' . $lastRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('G6:G' . $lastRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('I6:J' . $lastRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('K6:K' . $lastRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('Q6:T' . $lastRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('Z6:Z' . $lastRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('AB6:AD' . $lastRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('AE6:AF' . $lastRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Lebar Kolom Proporsional - Kolom No (A) kecil proporsional
        $sheet->getColumnDimension('A')->setWidth(5);   // No urut tidak kebesaran
        $sheet->getColumnDimension('B')->setWidth(18);  // Kode Pendaftaran
        $sheet->getColumnDimension('C')->setWidth(14);  // Status
        $sheet->getColumnDimension('D')->setWidth(12);  // NIS
        $sheet->getColumnDimension('E')->setWidth(14);  // NISN
        $sheet->getColumnDimension('F')->setWidth(24);  // Nama Lengkap
        $sheet->getColumnDimension('G')->setWidth(12);  // Jenis Kelamin
        $sheet->getColumnDimension('H')->setWidth(16);  // Tempat Lahir
        $sheet->getColumnDimension('I')->setWidth(14);  // Tanggal Lahir
        $sheet->getColumnDimension('J')->setWidth(12);  // Agama
        $sheet->getColumnDimension('K')->setWidth(18);  // No HP / WA
        $sheet->getColumnDimension('L')->setWidth(22);  // Email
        $sheet->getColumnDimension('M')->setWidth(26);  // Pilihan Jurusan
        $sheet->getColumnDimension('N')->setWidth(16);  // Jalur Pendaftaran
        $sheet->getColumnDimension('O')->setWidth(24);  // Asal Sekolah
        $sheet->getColumnDimension('P')->setWidth(26);  // Alamat Sekolah Asal
        $sheet->getColumnDimension('Q')->setWidth(12);  // Tahun Lulus
        $sheet->getColumnDimension('R')->setWidth(28);  // Alamat Domisili
        $sheet->getColumnDimension('S')->setWidth(8);   // RT
        $sheet->getColumnDimension('T')->setWidth(8);   // RW
        $sheet->getColumnDimension('U')->setWidth(18);  // Kelurahan
        $sheet->getColumnDimension('V')->setWidth(18);  // Kecamatan
        $sheet->getColumnDimension('W')->setWidth(20);  // Kota
        $sheet->getColumnDimension('X')->setWidth(20);  // Provinsi
        $sheet->getColumnDimension('Y')->setWidth(22);  // Nama Ayah
        $sheet->getColumnDimension('Z')->setWidth(18);  // Telepon Ayah
        $sheet->getColumnDimension('AA')->setWidth(22); // Nama Ibu
        $sheet->getColumnDimension('AB')->setWidth(18); // Telepon Ibu
        $sheet->getColumnDimension('AC')->setWidth(12); // Tinggi
        $sheet->getColumnDimension('AD')->setWidth(12); // Berat
        $sheet->getColumnDimension('AE')->setWidth(22); // Status Bayar
        $sheet->getColumnDimension('AF')->setWidth(18); // Tanggal Daftar

        // Freeze baris header & kolom No, Kode, Status
        $sheet->freezePane('D6');

        // Output stream
        $filename = 'SPMB_Rekap_Pendaftar_' . date('Ymd_His') . '.xlsx';
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Cache-Control' => 'max-age=0',
        ]);
    }
}
