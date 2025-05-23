<?php

namespace App\Http\Controllers;

use App\Models\MJurusan;
use App\Models\Sdatatambahan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{

    public function register(Request $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'nama_siswa' => 'required|string|max:255',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'agama' => 'required|in:Islam,Kristen Protestan,Katolik,Hindu,Buddha,Konghucu',
                'email' => 'required|email|unique:siswas',
                'asal_sekolah' => 'required|string|max:255',
                'jalur_pendaftaran' => 'required|in:Reguler,RMP',
                'id_jurusan' => 'required',
                'payment_type' => 'required',
                'no_hp' => 'required|string|max:20',
                'mgm' => 'required',
                'password' => 'required|confirmed|min:6'
            ]);
            $pendaftaranData = [
                'nis' => null,
                'nama' => $validated['nama_siswa'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'agama' => $validated['agama'],
                'asal_sekolah' => $validated['asal_sekolah'],
                'jalur_pendaftaran' => $validated['jalur_pendaftaran'],
                'id_jurusan' => $validated['id_jurusan'],
                'no_hp' => $validated['no_hp'],
                'mgm' => $validated['mgm'],
                'created_at' => Carbon::now(),
            ];
            // Jika mgm adalah 'Y', tambahkan nama_mgm dan asal_mgm
            if ($validated['mgm'] == true || $validated['mgm'] == 1) {
                $pendaftaranData['nama_mgm'] = $request->nama_mgm;
                $pendaftaranData['asal_mgm'] = $request->asal_mgm;
            } else {
                $pendaftaranData['nama_mgm'] = null;
                $pendaftaranData['asal_mgm'] = null;
            }
            // dd($pendaftaranData,$validated);
            // Menyimpan data menggunakan query builder
            $s_id = DB::table('siswas')->insertGetId($pendaftaranData);

            if ($pendaftaranData['jalur_pendaftaran'] === 'RMP') {
                if ($request->hasFile('dtks')) {
                    $student_name = str_replace(' ', '-', strtolower($validated['nama_siswa'])); // Format nama
                    $folder = "pendaftar/{$student_name}/berkas_tambahan"; // Path penyimpanan

                    $file = $request->file('dtks');
                    $dtks = $student_name . '_' . 'DTKS'  . '_' . $file->getClientOriginalName(); // Buat nama unik
                    $dtks_path = $file->storeAs($folder, $dtks, 'public'); // Simpan di storage

                } else {
                    $dtks = null;
                    $dtks_path = null;
                }
                if ($request->hasFile('kip')) {
                    $student_name = str_replace(' ', '-', strtolower($validated['nama_siswa'])); // Format nama
                    $folder = "pendaftar/{$student_name}/berkas_tambahan"; // Path penyimpanan

                    $file = $request->file('kip');
                    $kip = $student_name . '_' . 'KIP'  . '_' . $file->getClientOriginalName(); // Buat nama unik
                    $kip_path = $file->storeAs($folder, $kip, 'public'); // Simpan di storage

                } else {
                    $kip = null;
                    $kip_path = null;
                }
                DB::table('berkas_tambahans')->insert([
                    'siswa_id' => $s_id,
                    'dtks' => $dtks,
                    'dtks_path' => $dtks_path,
                    'kip' => $kip,
                    'kip_path' => $kip_path,
                    'created_at' => Carbon::now()
                ]);
            }
            $amountFinal = DB::table('m_jurusans')
                ->select(
                    DB::raw('(dsp + spp + 150000) AS total_biaya_pendaftaran')
                )
                ->where('id', $validated['id_jurusan'])
                ->first();

            DB::table('bukti_pembayarans')->insert([
                'siswa_id' => $s_id,
                'payment_type' => $validated['payment_type'],
                'amount' => $amountFinal->total_biaya_pendaftaran,
                'created_at' => Carbon::now()
            ]);
            DB::commit();
            Alert::success('success', 'Pendaftaran berhasil!');
            return redirect()->route('siswa.masuk');
        } catch (\Exception $ex) {
            DB::rollBack();
            // dd($ex->getMessage());
            Alert::error('Gagal', $ex->getMessage());
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('siswa')->attempt($credentials)) {
            return redirect()->route('siswa.dashboard');
            // dd('Login As Siswa', auth_user());
        }
        Alert::error('Login Gagal', 'Email atau password salah');
        return back();
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/siswa/login');
    }

    public function registerPage(Request $request)
    {
        $listJurusan = DB::table('m_jurusans')->select('id', 'nama_jurusan')->orderBy('nama_jurusan', 'ASC')->get();
        return view('daftar', compact('listJurusan'));
    }

    public function dashboard(Request $request)
    {
        return view('dashboardSiswa');
    }
    public function dataDiri(Request $request)
    {
        $listJurusan = DB::table('m_jurusans')->select('id', 'nama_jurusan')->orderBy('nama_jurusan', 'ASC')->get();
        $dataTambahan = Sdatatambahan::where('siswa_id', auth_user()->id)->first();
        return view('siswa.datadiri', compact('listJurusan', 'dataTambahan'));
    }
    public function UpdateData(Request $request)
    {
        $id = auth_user()->id;
        DB::beginTransaction();

        if (auth_user()->isAccepted !== 1) {
            try {
                $validated = $request->validate([
                    'nama_siswa' => 'required|string|max:255',
                    'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                    'agama' => 'required|in:Islam,Kristen Protestan,Katolik,Hindu,Buddha,Konghucu',
                    'email' => 'required|email',
                    'asal_sekolah' => 'required|string|max:255',
                    'jalur_pendaftaran' => 'required|in:Reguler,RMP',
                    'id_jurusan' => 'required',
                    'no_hp' => 'required|string|max:20',
                    'mgm' => 'required',
                ]);
                $pendaftaranData = [
                    'nis' => null,
                    'nama' => $validated['nama_siswa'],
                    'email' => $validated['email'],
                    'jenis_kelamin' => $validated['jenis_kelamin'],
                    'agama' => $validated['agama'],
                    'asal_sekolah' => $validated['asal_sekolah'],
                    'jalur_pendaftaran' => $validated['jalur_pendaftaran'],
                    'id_jurusan' => $validated['id_jurusan'],
                    'no_hp' => $validated['no_hp'],
                    'mgm' => $validated['mgm'],
                    'updated_at' => Carbon::now(),
                ];

                if ($request->filled('password')) {
                    $pendaftaranData['password'] = Hash::make($request->password);
                }

                // Jika mgm adalah 'Y', tambahkan nama_mgm dan asal_mgm
                if ($validated['mgm'] == true || $validated['mgm'] == 1) {
                    $pendaftaranData['nama_mgm'] = $request->nama_mgm;
                    $pendaftaranData['asal_mgm'] = $request->asal_mgm;
                } else {
                    $pendaftaranData['nama_mgm'] = null;
                    $pendaftaranData['asal_mgm'] = null;
                }
                // Menyimpan data menggunakan query builder
                if ($pendaftaranData['jalur_pendaftaran'] === 'RMP') {
                    if ($request->hasFile('dtks')) {
                        $student_name = str_replace(' ', '-', strtolower($validated['nama_siswa'])); // Format nama
                        $folder = "pendaftar/{$student_name}/berkas_tambahan"; // Path penyimpanan

                        $file = $request->file('dtks');
                        $dtks = $student_name . '_' . 'DTKS'  . '_' . $file->getClientOriginalName(); // Buat nama unik
                        $dtks_path = $file->storeAs($folder, $dtks, 'public'); // Simpan di storage

                    } else {
                        $dtks = null;
                        $dtks_path = null;
                    }
                    if ($request->hasFile('kip')) {
                        $student_name = str_replace(' ', '-', strtolower($validated['nama_siswa'])); // Format nama
                        $folder = "pendaftar/{$student_name}/berkas_tambahan"; // Path penyimpanan

                        $file = $request->file('kip');
                        $kip = $student_name . '_' . 'KIP'  . '_' . $file->getClientOriginalName(); // Buat nama unik
                        $kip_path = $file->storeAs($folder, $kip, 'public'); // Simpan di storage

                    } else {
                        $kip = null;
                        $kip_path = null;
                    }
                    DB::table('berkas_tambahans')->where('siswa_id', $id)->update([
                        'dtks' => $dtks,
                        'dtks_path' => $dtks_path,
                        'kip' => $kip,
                        'kip_path' => $kip_path,
                        'created_at' => Carbon::now()
                    ]);
                }
                DB::table('siswas')->where('id', $id)->update($pendaftaranData);
                DB::commit();
                return response()->json(['message' => 'Data berhasil diUpdate!'], 201);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['message' => 'Ada Masalah Diantara Input/Server'], 500);
                // return response()->json(['message' => $e->getMessage()], 500);
            }
        }
        return response()->json(['message' => 'Data Sudah Disimpan Permanen tidak Bisaa Di edit'], 500);
    }
    public function upsertDataTambahan(Request $request)
    {
        // Validasi data yang diterima
        $validated = $request->validate([
            'isAbk' => 'required|boolean',
            'alamat' => 'nullable|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'nama_orang_tua' => 'nullable|string|max:255',
            'alamat_orang_tua' => 'nullable|string|max:255',
            'no_hp_orang_tua' => 'nullable|string|max:20',
            'pekerjaan_orang_tua' => 'nullable|string|max:255',
        ]);

        // Data array untuk upsert
        $data = [
            'isAbk' => $validated['isAbk'],
            'alamat' => $validated['alamat'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'nama_orang_tua' => $validated['nama_orang_tua'],
            'alamat_orang_tua' => $validated['alamat_orang_tua'],
            'no_hp_orang_tua' => $validated['no_hp_orang_tua'],
            'pekerjaan_orang_tua' => $validated['pekerjaan_orang_tua'],
        ];

        // Mendapatkan waktu saat ini
        $now = now();

        // Menambahkan timestamps
        $user_id = auth_user()->id; // Ambil user_id dari authenticated user

        try {
            // Mulai transaksi
            DB::beginTransaction();

            // Cek apakah data sudah ada
            $existing = DB::table('s_data_tambahans')->where('siswa_id', $user_id)->first();

            if ($existing) {
                // Jika data sudah ada (update)
                $data['updated_at'] = $now;  // Update timestamp
                DB::table('s_data_tambahans')
                    ->where('siswa_id', $user_id)
                    ->update($data);  // Update data
            } else {
                // Jika data belum ada (insert)
                $data['siswa_id'] = $user_id;
                $data['created_at'] = $now;  // Set created_at untuk insert
                DB::table('s_data_tambahans')
                    ->insert($data);  // Insert data
            }

            // Commit transaksi jika berhasil
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diperbarui atau disimpan.'
            ]);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // return response()->json([
            //     'status' => 'error',
            //     'message' => 'Terjadi kesalahan, coba lagi.'
            // ], 500); // Kode error 500 untuk kesalahan server
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500); // Kode error 500 untuk kesalahan server
        }
    }
}
