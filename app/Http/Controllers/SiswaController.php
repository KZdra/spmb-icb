<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class SiswaController extends Controller
{
    /**
     * Halaman Form Pendaftaran Siswa Baru
     */
    public function registerPage(Request $request)
    {
        $listJurusan = DB::table('m_jurusans')
            ->select('id', 'nama_jurusan')
            ->orderBy('nama_jurusan', 'ASC')
            ->get();
        $setting = DB::table('pengaturan_aplikasis')->first();
        return view('daftar', compact('listJurusan', 'setting'));
    }

    /**
     * Proses Submit Formulir Pendaftaran
     */
    public function register(Request $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
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
            ]);

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
                'asal_sekolah'       => $validated['asal_sekolah'],
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

            DB::commit();

            // Flash data untuk halaman sukses
            session()->flash('pendaftaran_baru', [
                'id'               => $s_id,
                'kode_pendaftaran' => $kodePendaftaran,
                'nama'             => $validated['nama_siswa'],
                'nisn'             => $validated['nisn'],
                'email'            => $validated['email'],
                'no_hp'            => $validated['no_hp'],
                'asal_sekolah'     => $validated['asal_sekolah'],
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
        return view('pendaftaran-sukses', compact('siswa', 'setting', 'kode'));
    }

    /**
     * Halaman Cek Status Pendaftaran (publik, tanpa login)
     */
    public function cekStatusPage()
    {
        $setting = DB::table('pengaturan_aplikasis')->first();
        return view('cek-status', compact('setting'));
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
        return view('cek-status', compact('siswa', 'keyword', 'setting'));
    }
}
