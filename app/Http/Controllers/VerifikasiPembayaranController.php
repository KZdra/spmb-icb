<?php

namespace App\Http\Controllers;

use App\Models\BuktiPembayaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VerifikasiPembayaranController extends Controller
{
    public function index()
    {
        $users = DB::table('bukti_pembayarans as bp')
            ->join('siswas as s', 'bp.siswa_id', '=', 's.id')
            ->select('bp.id', 'bp.file_name', 'bp.file_path', 'bp.amount', 'bp.payment_type', 'bp.account_name', 's.nama as nama_siswa', 'bp.payment_date', 'bp.status')
            ->get();
        return view('pembayaran.index', compact('users'));
    }
    public function approveStatus(Request $request)
    {
        $data = $request->validate([
            'bukti_id' => 'required'
        ]);
        DB::beginTransaction();

        try {
            DB::table('bukti_pembayarans')->where('id', $data['bukti_id'])->update([
                'status' => 'Diverifikasi',
                'updated_at' => now()
            ]);
            DB::commit();

            return response()->json(['message' => 'Pembayaran Diverifikasi!'], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            // return response()->json(['message' => 'Ada Masalah Diantara Input/Server'], 500);
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function notApproveStatus(Request $request)
    {
        $data = $request->validate([
            'bukti_id' => 'required',
            'alasan' => 'required|string'
        ]);
        DB::beginTransaction();

        try {
            DB::table('bukti_pembayarans')->where('id', $data['bukti_id'])->update([
                'status' => 'Ditolak',
                'alasan' => $data['alasan'],
                'updated_at' => now()
            ]);
            return response()->json(['message' => 'Pembayaran DiTolak!'], 201);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            // return response()->json(['message' => 'Ada Masalah Diantara Input/Server'], 500);
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function inputUlang($id)
    {
        $bp = DB::table('bukti_pembayarans')->where('id', $id)->first();

        if (!$bp) {
            return response()->json(['message' => 'Ada Masalah Diantara Input/Server'], 500);
        }

        if ($bp->file_path) {
            Storage::disk('public')->delete($bp->file_path);
        }
        DB::beginTransaction();
        try {
            DB::table('bukti_pembayarans')->where('id', $id)->delete();
            DB::commit();
            return response()->json(['message' => 'Berhasil Request Input Ulang!'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            // return response()->json(['message' => 'Ada Masalah Diantara Input/Server'], 500);
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function inputBukti(Request $request)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|mimes:png,jpg',
            'payment_date' => 'required',
        ]);
        $dataSis = Siswa::findOrFail($request->siswa_id);
        if ($request->hasFile('bukti_pembayaran')) {
            $student_name = str_replace(' ', '-', strtolower($dataSis->nama)); // Format nama
            $folder = "pendaftar/{$student_name}/bukti_pembayaran"; // Path penyimpanan

            $file = $request->file('bukti_pembayaran');
            $file_name = $student_name . '_' . $request->payment_date  . '_' . $file->getClientOriginalName(); // Buat nama unik
            $file_path = $file->storeAs($folder, $file_name, 'public'); // Simpan di storage

        } else {
            $file_name = null;
            $file_path = null;
        }
        DB::beginTransaction();
        try {
            DB::table('bukti_pembayarans')->where('siswa_id', $request->siswa_id)->update([
                'file_name' => $file_name,
                'file_path'  => $file_path,
                'account_name' => $request->payment_date,
                'payment_date' => $request->payment_date,
                'created_at' => now()
            ]);
            DB::commit();
            return response()->json(['message' => 'Bukti Berhasil Dikirim!'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            // return response()->json(['message' => 'Error Sistem!'], 500);
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
