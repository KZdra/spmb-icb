<?php

namespace App\Http\Controllers;

use App\Models\BuktiPembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VerifikasiPembayaranController extends Controller
{
    public function index()
    {
        $users = DB::table('bukti_pembayarans as bp')
            ->join('siswas as s', 'bp.siswa_id', '=', 's.id')
            ->select('bp.id', 'bp.file_name', 'bp.file_path', 'bp.amount', 's.nama as nama_siswa', 'bp.payment_date', 'bp.status')
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
}
