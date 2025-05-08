<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VerifikasiSiswaController extends Controller
{
    public function generateNIS($siswaId)
    {
        DB::beginTransaction();

        try {
            // Lock baris agar tidak race condition
            $counter = DB::table('nis_counters')->lockForUpdate()->first();

            // Jika belum ada baris (misalnya pertama kali)
            if (!$counter) {
                DB::table('nis_counters')->insert(['last_number' => 1]);
                $nisNumber = 1;
            } else {
                $nisNumber = $counter->last_number + 1;
                DB::table('nis_counters')->update(['last_number' => $nisNumber]);
            }

            $formattedNis = '125' . str_pad($nisNumber, 4, '0', STR_PAD_LEFT);

            DB::table('siswas')->where('id', $siswaId)->update([
                'nis' => $formattedNis,
                'updated_at' => now()
            ]);

            DB::commit();
            return $formattedNis;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    public function index(Request $request)
    {
        $datasis = Siswa::with(['dataTambahan', 'jurusan', 'buktiPembayaran'])
            ->whereHas('buktiPembayaran', function ($query) {
                $query->where('status', 'Diverifikasi');
            })
            ->get();
        return view('verifsiswa.index', compact('datasis'));
    }
    public function getDataTambahan(Request $request, $id)
    {
        $siswa = Siswa::with('dataTambahan')->findOrFail($id);
        return response()->json([

            'nama' => $siswa->nama,
            'data_tambahan' => $siswa->dataTambahan
        ], 200);
    }
    public function approveStatus(Request $request)
    {
        $data = $request->validate([
            'siswa_id' => 'required'
        ]);
        DB::beginTransaction();
        try {
            DB::table('siswas')->where('id', $data['siswa_id'])->update([
                'nis' => $this->generateNIS($data['siswa_id']),
                'status' => 'Diterima',
                'isAccepted' => 1,
                'updated_at' => now()
            ]);
            DB::commit();
            return response()->json(['message' => 'Siswa Diterima'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            // return response()->json(['message' => 'Ada Masalah Diantara Input/Server'], 500);
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

            return response()->json(['message' => 'Siswa Ditolak'], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            // return response()->json(['message' => 'Ada Masalah Diantara Input/Server'], 500);
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
