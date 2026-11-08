<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class SiswaController extends Controller
{
    /**
     * Halaman Form Pendaftaran Siswa Baru
     */
    public function registerPage(Request $request)
    {
        $setting = DB::table('pengaturan_aplikasis')->first();

        // Cek jika pendaftaran ditutup
        if (($setting->status_pendaftaran ?? 'buka') === 'tutup') {
            Alert::info('Pendaftaran Ditutup', $setting->pesan_penutupan ?? 'Pendaftaran saat ini sedang ditutup sementara.');
            return redirect()->route('landing');
        }

        $listJurusan = DB::table('m_jurusans')
            ->select('id', 'nama_jurusan')
            ->orderBy('nama_jurusan', 'ASC')
            ->get();

        $syaratBerkas = \App\Models\SyaratBerkas::where('is_active', true)->orderBy('urutan', 'asc')->get();
        $rekeningBanks = \App\Models\RekeningBank::where('is_active', true)->orderBy('urutan', 'asc')->get();

        return view('daftar', compact('listJurusan', 'setting', 'syaratBerkas', 'rekeningBanks'));
    }

    /**
     * Proses Submit Formulir Pendaftaran
     */
    public function register(Request $request)
    {
        DB::beginTransaction();
        try {
            $setting = DB::table('pengaturan_aplikasis')->first();
            if (($setting->status_pendaftaran ?? 'buka') === 'tutup') {
                throw new \Exception($setting->pesan_penutupan ?? 'Pendaftaran saat ini sedang ditutup sementara.');
            }

            // Aturan validasi dinamis untuk berkas tambahan aktif
            $syaratBerkas = \App\Models\SyaratBerkas::where('is_active', true)->get();
            $berkasRules = [];
            foreach ($syaratBerkas as $sb) {
                $fieldName = 'berkas_' . $sb->id;
                $berkasRules[$fieldName] = $sb->is_required
                    ? 'required|file|mimes:jpeg,jpg,png,pdf|max:10240'
                    : 'nullable|file|mimes:jpeg,jpg,png,pdf|max:10240';
            }

            $rules = array_merge([
                'jalur_pendaftaran'   => 'required|string|max:255',
                'id_jurusan'          => 'required|exists:m_jurusans,id',
                'nama_siswa'          => 'required|string|max:255',
                'jenis_kelamin'       => 'required|string|max:50',
                'tempat_lahir'        => 'required|string|max:100',
                'tanggal_lahir'       => 'required|date',
                'agama'               => 'required|string|max:50',
                'alamat'              => 'required|string|max:500',
                'rt'                  => 'required|string|max:10',
                'rw'                  => 'required|string|max:10',
                'kelurahan'           => 'required|string|max:100',
                'kecamatan'           => 'required|string|max:100',
                'kota'                => 'required|string|max:100',
                'provinsi'            => 'required|string|max:100',
                'no_hp'               => 'required|string|max:25',
                'email'               => 'required|email|unique:siswas,email',
                'asal_sekolah'        => 'required|string|max:255',
                'alamat_sekolah_asal' => 'required|string|max:500',
                'nisn'                => 'required|string|max:20',
                'tahun_lulus'         => 'required|string|max:10',
                'nama_ayah'           => 'required|string|max:100',
                'telepon_ayah'        => 'required|string|max:25',
                'nama_ibu'            => 'required|string|max:100',
                'telepon_ibu'         => 'required|string|max:25',
                'tinggi_badan'        => 'nullable|numeric|min:100|max:250',
                'berat_badan'         => 'nullable|numeric|min:20|max:200',
                'bukti_pembayaran'    => 'required|file|mimes:jpeg,jpg,png,pdf|max:10240',
                'mgm'                 => 'nullable|in:0,1',
                'nama_mgm'            => 'nullable|string|max:100',
                'asal_mgm'            => 'nullable|string|max:100',
            ], $berkasRules);

            $validated = $request->validate($rules);

            // Normalisasi nama sekolah asal (trim spasi berlebih, uppercase, standarisasi singkatan)
            $normalizedAsalSekolah = $this->normalizeAsalSekolah($validated['asal_sekolah']);

            // ── Generate Kode Pendaftaran Unik ──────────────────────
            $tahun = date('Y');
            $urutan = DB::table('siswas')->whereYear('created_at', $tahun)->count() + 1;
            $kodePendaftaran = 'ICB-' . $tahun . '-' . str_pad($urutan, 4, '0', STR_PAD_LEFT);

            // ── 1. Simpan Data Pokok Siswa ───────────────────────────
            $s_id = DB::table('siswas')->insertGetId([
                'nis'                => null,
                'kode_pendaftaran'   => $kodePendaftaran,
                'nama'               => $validated['nama_siswa'],
                'email'              => $validated['email'],
                'password'           => Hash::make(Str::random(24)), // internal only, tidak untuk login
                'jenis_kelamin'      => $validated['jenis_kelamin'],
                'agama'              => $validated['agama'],
                'asal_sekolah'       => $normalizedAsalSekolah,
                'nisn'               => $validated['nisn'],
                'tahun_lulus'        => $validated['tahun_lulus'],
                'jalur_pendaftaran'  => $validated['jalur_pendaftaran'],
                'id_jurusan'         => $validated['id_jurusan'],
                'no_hp'              => $validated['no_hp'],
                'mgm'                => $request->mgm ?? 0,
                'nama_mgm'           => $request->nama_mgm ?? null,
                'asal_mgm'           => $request->asal_mgm ?? null,
                'status'             => 'pending',
                'isAccepted'         => 0,
                'created_at'         => Carbon::now(),
                'updated_at'         => Carbon::now(),
            ]);

            // ── 2. Simpan Data Tambahan ──────────────────────────────
            DB::table('s_data_tambahans')->insert([
                'siswa_id'            => $s_id,
                'tempat_lahir'        => $validated['tempat_lahir'],
                'tanggal_lahir'       => $validated['tanggal_lahir'],
                'alamat'              => $validated['alamat'],
                'rt'                  => $validated['rt'],
                'rw'                  => $validated['rw'],
                'kelurahan'           => $validated['kelurahan'],
                'kecamatan'           => $validated['kecamatan'],
                'kota'                => $validated['kota'],
                'provinsi'            => $validated['provinsi'],
                'alamat_sekolah_asal' => $validated['alamat_sekolah_asal'],
                'nama_ayah'           => $validated['nama_ayah'],
                'telepon_ayah'        => $validated['telepon_ayah'],
                'nama_ibu'            => $validated['nama_ibu'],
                'telepon_ibu'         => $validated['telepon_ibu'],
                'tinggi_badan'        => $validated['tinggi_badan'] ?? null,
                'berat_badan'         => $validated['berat_badan'] ?? null,
                'nama_orang_tua'      => $validated['nama_ayah'] ?: $validated['nama_ibu'],
                'no_hp_orang_tua'     => $validated['telepon_ayah'] ?: $validated['telepon_ibu'],
                'alamat_orang_tua'    => $validated['alamat'],
                'created_at'          => Carbon::now(),
                'updated_at'          => Carbon::now(),
            ]);

            // ── 3. Upload & Simpan Bukti Pembayaran ─────────────────
            $file         = $request->file('bukti_pembayaran');
            $studentClean = preg_replace('/[^a-zA-Z0-9_-]/', '_', strtolower($validated['nama_siswa']));
            $folder       = "pendaftar/{$studentClean}/bukti_bayar";
            $fileName     = time() . '_' . $file->getClientOriginalName();
            $filePath     = $file->storeAs($folder, $fileName, 'public');

            $setting = DB::table('pengaturan_aplikasis')->first();
            $amount  = $setting->biaya_pendaftaran ?? 200000;

            DB::table('bukti_pembayarans')->insert([
                'siswa_id'     => $s_id,
                'file_name'    => $fileName,
                'file_path'    => $filePath,
                'payment_type' => 'transfer',
                'account_name' => $validated['nama_siswa'],
                'amount'       => $amount,
                'payment_date' => Carbon::now()->toDateString(),
                'status'       => 'pending',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ]);

            // ── 4. Upload & Simpan Berkas Tambahan (Disimpan dalam format aslinya) ──
            foreach ($syaratBerkas as $sb) {
                $fieldName = 'berkas_' . $sb->id;
                if ($request->hasFile($fieldName)) {
                    $bFile     = $request->file($fieldName);
                    $bFolder   = "pendaftar/{$studentClean}/berkas";
                    $bFileName = time() . '_' . $sb->id . '_' . preg_replace('/[^a-zA-Z0-9_.-]/', '_', $bFile->getClientOriginalName());
                    $bFilePath = $bFile->storeAs($bFolder, $bFileName, 'public');

                    DB::table('siswa_berkas')->insert([
                        'siswa_id'         => $s_id,
                        'syarat_berkas_id' => $sb->id,
                        'file_name'        => $bFileName,
                        'file_path'        => $bFilePath,
                        'created_at'       => Carbon::now(),
                        'updated_at'       => Carbon::now(),
                    ]);
                }
            }

            DB::commit();

            // Flash data untuk halaman sukses
            session()->flash('pendaftaran_baru', [
                'id'               => $s_id,
                'kode_pendaftaran' => $kodePendaftaran,
                'nama'             => $validated['nama_siswa'],
                'nisn'             => $validated['nisn'],
                'email'            => $validated['email'],
                'no_hp'            => $validated['no_hp'],
                'asal_sekolah'     => $normalizedAsalSekolah,
                'jalur_pendaftaran'=> $validated['jalur_pendaftaran'],
                'id_jurusan'       => $validated['id_jurusan'],
            ]);

            return redirect()->route('pendaftaran.sukses', ['kode' => $kodePendaftaran]);

        } catch (\Exception $ex) {
            DB::rollBack();
            Alert::error('Gagal Mendaftar', $ex->getMessage());
            return redirect()->back()->withInput()->with('error', $ex->getMessage());
        }
    }

    /**
     * Halaman Konfirmasi Tanda Terima Pendaftaran Sukses
     */
    public function pendaftaranSukses(Request $request)
    {
        $kode  = $request->query('kode');
        $siswa = null;

        if ($kode) {
            $siswa = DB::table('siswas')
                ->leftJoin('m_jurusans', 'siswas.id_jurusan', '=', 'm_jurusans.id')
                ->select('siswas.*', 'm_jurusans.nama_jurusan')
                ->where('siswas.kode_pendaftaran', $kode)
                ->first();
        }

        $setting = DB::table('pengaturan_aplikasis')->first();
        $rekeningBanks = \App\Models\RekeningBank::where('is_active', true)->orderBy('urutan', 'asc')->get();
        return view('pendaftaran-sukses', compact('siswa', 'setting', 'kode', 'rekeningBanks'));
    }

    /**
     * Halaman Cek Status Pendaftaran (publik, tanpa login)
     */
    public function cekStatusPage()
    {
        $setting = DB::table('pengaturan_aplikasis')->first();
        $rekeningBanks = \App\Models\RekeningBank::where('is_active', true)->orderBy('urutan', 'asc')->get();
        return view('cek-status', compact('setting', 'rekeningBanks'));
    }

    public function cekStatusPost(Request $request)
    {
        $request->validate(['keyword' => 'required|string|max:50']);

        $keyword = trim($request->keyword);
        $siswa = DB::table('siswas')
            ->leftJoin('m_jurusans', 'siswas.id_jurusan', '=', 'm_jurusans.id')
            ->leftJoin('bukti_pembayarans', 'siswas.id', '=', 'bukti_pembayarans.siswa_id')
            ->select('siswas.*', 'm_jurusans.nama_jurusan', 'bukti_pembayarans.status as status_bayar')
            ->where('siswas.kode_pendaftaran', $keyword)
            ->orWhere('siswas.nisn', $keyword)
            ->orWhere('siswas.email', $keyword)
            ->first();

        $setting = DB::table('pengaturan_aplikasis')->first();
        $rekeningBanks = \App\Models\RekeningBank::where('is_active', true)->orderBy('urutan', 'asc')->get();
        return view('cek-status', compact('siswa', 'keyword', 'setting', 'rekeningBanks'));
    }

    /**
     * Download / Stream Tanda Terima Pendaftaran dalam format PDF (DomPDF)
     */
    public function downloadTandaTerimaPdf(string $kode, Request $request)
    {
        $siswa = DB::table('siswas')
            ->leftJoin('s_data_tambahans', 'siswas.id', '=', 's_data_tambahans.siswa_id')
            ->leftJoin('m_jurusans', 'siswas.id_jurusan', '=', 'm_jurusans.id')
            ->leftJoin('bukti_pembayarans', 'siswas.id', '=', 'bukti_pembayarans.siswa_id')
            ->select(
                'siswas.*',
                'm_jurusans.nama_jurusan',
                'bukti_pembayarans.status as status_bayar',
                's_data_tambahans.tempat_lahir',
                's_data_tambahans.tanggal_lahir',
                's_data_tambahans.alamat',
                's_data_tambahans.rt',
                's_data_tambahans.rw',
                's_data_tambahans.kelurahan',
                's_data_tambahans.kecamatan',
                's_data_tambahans.kota',
                's_data_tambahans.provinsi',
                's_data_tambahans.nama_ayah',
                's_data_tambahans.telepon_ayah',
                's_data_tambahans.nama_ibu',
                's_data_tambahans.telepon_ibu',
                's_data_tambahans.tinggi_badan',
                's_data_tambahans.berat_badan'
            )
            ->where('siswas.kode_pendaftaran', $kode)
            ->first();

        if (!$siswa) {
            abort(404, 'Data pendaftaran dengan kode ' . e($kode) . ' tidak ditemukan.');
        }

        $setting = DB::table('pengaturan_aplikasis')->first();

        // 1. Logo Base64 (Aman untuk DomPDF tanpa network call)
        $logoBase64 = null;
        $logoPath = null;
        if (!empty($setting?->logo_path) && file_exists(storage_path('app/public/' . $setting->logo_path))) {
            $logoPath = storage_path('app/public/' . $setting->logo_path);
        } elseif (file_exists(public_path('images/icb.png'))) {
            $logoPath = public_path('images/icb.png');
        }
        if ($logoPath && file_exists($logoPath)) {
            $mime = mime_content_type($logoPath) ?: 'image/png';
            $logoBase64 = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($logoPath));
        }

        // 2. QR Code Base64 untuk verifikasi
        $qrBase64 = null;
        try {
            $qrRes = Http::timeout(4)->get('https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=' . urlencode($kode));
            if ($qrRes->successful()) {
                $qrBase64 = 'data:image/png;base64,' . base64_encode($qrRes->body());
            }
        } catch (\Throwable $e) {
            // Silently fallback without QR code
        }

        $pdf = Pdf::loadView('pdf.tanda-terima', compact('siswa', 'setting', 'logoBase64', 'qrBase64'))
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled'      => true,
                'defaultFont'          => 'sans-serif',
            ]);

        $filename = 'Tanda-Terima-' . Str::slug($siswa->kode_pendaftaran) . '.pdf';

        if ($request->has('stream') || $request->get('action') === 'print') {
            return $pdf->stream($filename);
        }

        return $pdf->download($filename);
    }

    /**
     * Normalisasi nama sekolah asal siswa (uppercase, standarisasi singkatan, trim spasi ganda)
     */
    private function normalizeAsalSekolah(?string $nama): ?string
    {
        if (!$nama) return null;
        $s = trim(preg_replace('/\s+/', ' ', strtoupper($nama)));
        $s = preg_replace('/^SMP\s+NEGERI\s+/i', 'SMPN ', $s);
        $s = preg_replace('/^SMP\s*N\s*([0-9]+)/i', 'SMPN $1', $s);
        $s = preg_replace('/^SMP\s*N\.\s*([0-9]+)/i', 'SMPN $1', $s);
        $s = preg_replace('/^MTS\s+NEGERI\s+/i', 'MTSN ', $s);
        $s = preg_replace('/^MTS\s*N\s*([0-9]+)/i', 'MTSN $1', $s);
        $s = preg_replace('/^MTS\s*N\.\s*([0-9]+)/i', 'MTSN $1', $s);
        $s = preg_replace('/^MTSN\s*([0-9]+)/i', 'MTSN $1', $s);
        return $s;
    }
}
