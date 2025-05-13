<?php

namespace App\Http\Controllers;

use App\Models\BuktiPembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuktiPembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa_id = auth_user()->id;
        $buktiIsExist = false;
        $dataBukti = DB::table('bukti_pembayarans')->select('id', 'siswa_id', 'status','alasan')->where('siswa_id', '=', $siswa_id)->first();
        if ($dataBukti) {
            $buktiIsExist = true;
        }
        return view('siswa.pembayaran', compact('buktiIsExist', 'dataBukti'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|mimes:png,jpg',
            'amount' => 'required',
            'payment_date' => 'required',
        ]);
        if ($request->hasFile('bukti_pembayaran')) {
            $student_name = str_replace(' ', '-', strtolower(auth_user()->nama)); // Format nama
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
            DB::table('bukti_pembayarans')->insert([
                'siswa_id' => auth_user()->id,
                'file_name' => $file_name,
                'file_path'  => $file_path,
                'amount' => $request->amount,
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
