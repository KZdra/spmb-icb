<?php

namespace App\Http\Controllers;

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
        $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
        $passwordHash = Hash::make($password);
        try {
            $validated = $request->validate([
                'nama_siswa' => 'required|string|max:255',
                'alamat' => 'required|string',
                'tempat_lahir' => 'required|string',
                'ttl' => 'required|date',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'agama' => 'required|in:Islam,Kristen Protestan,Katolik,Hindu,Buddha,Konghucu',
                'email' => 'required|email|unique:siswas',
                'asal_sekolah' => 'required|string|max:255',
                'jalur_pendaftaran' => 'required|in:Reguler,RMP',
                'jurusan' => 'required|in:TKR,TSM,RPL,TKJ,FAR,KEP',
                'no_hp' => 'required|string|max:20',
                'abk' => 'required|in:Y,N',
                'nama_ortu_wali' => 'required|string|max:255',
                'alamat_wali' => 'required|string',
                'pekerjaan_wali' => 'required|string|max:255',
                'no_hp_wali' => 'required|string|max:20',
                'mgm' => 'required|in:Y,N',
            ]);
            $pendaftaranData = [
                'nis' => null,
                'nama' => $validated['nama_siswa'],
                'alamat' => $validated['alamat'],
                'password' => $passwordHash,
                'rawPass' => $password,
                'tanggal_lahir' => $validated['ttl'],
                'tempat_lahir' => $validated['tempat_lahir'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'agama' => $validated['agama'],
                'email' => $validated['email'],
                'asal_sekolah' => $validated['asal_sekolah'],
                'jalur_pendaftaran' => $validated['jalur_pendaftaran'],
                'jurusan' => $validated['jurusan'],
                'no_hp' => $validated['no_hp'],
                'abk' => $validated['abk'],
                'nama_orang_tua' => $validated['nama_ortu_wali'],
                'alamat_orang_tua' => $validated['alamat_wali'],
                'pekerjaan_orang_tua' => $validated['pekerjaan_wali'],
                'no_hp_orang_tua' => $validated['no_hp_wali'],
                'mgm' => $validated['mgm'],
                'created_at' => Carbon::now(),
            ];

            // Jika mgm adalah 'Y', tambahkan nama_mgm dan asal_mgm
            if ($validated['mgm'] === 'Y') {
                $pendaftaranData['nama_mgm'] = $request->nama_mgm;
                $pendaftaranData['asal_mgm'] = $request->asal_mgm;
            } else {
                $pendaftaranData['nama_mgm'] = null;
                $pendaftaranData['asal_mgm'] = null;
            }
            // Menyimpan data menggunakan query builder
            DB::table('siswas')->insert($pendaftaranData);

            $latestId = DB::table('siswas')->latest('id')->value('id');
            $formattedId = str_pad($latestId, 3, '0', STR_PAD_LEFT);
            $nis = '2526' . $formattedId;

            DB::table('siswas')->where('id', '=', $latestId)->update([
                "nis" => $nis
            ]);
            Alert::success('success', 'Pendaftaran berhasil!');
            return redirect()->intended('/siswa/' . $latestId . '/secret');
        } catch (\Exception $ex) {
            Alert::error('Gagal', $ex->getMessage());
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }
    public function login(Request $request)
    {
        $credentials = $request->only('nis', 'password');

        if (Auth::guard('siswa')->attempt($credentials)) {
            // return redirect()->intended('/siswa/dashboard');
            dd('Login As Siswa', auth_user());
        }

        return back()->withErrors(['nis' => 'Login gagal']);
    }
    public function secret(Request $request, $id)
    {
        $dataSis = Siswa::findOrFail($id);
        if ($dataSis) {
            return view('secret', compact('dataSis'));
        } else {
            return redirect()->back();
        }
    }
}
