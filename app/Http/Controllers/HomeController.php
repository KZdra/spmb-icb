<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $chartData = DB::table('siswas')
            ->join('m_jurusans', 'siswas.id_jurusan', '=', 'm_jurusans.id')
            ->select(
                'm_jurusans.nama_jurusan as jurusan',
                DB::raw("
                COUNT(CASE WHEN jenis_kelamin = 'Laki-laki' THEN 1 END) AS total_male,
                COUNT(CASE WHEN jenis_kelamin = 'Perempuan' THEN 1 END) AS total_female
            ")
            )
            ->groupBy('m_jurusans.nama_jurusan')
            ->get()
            ->toArray();

        $paymentStats = DB::table('bukti_pembayarans')
            ->selectRaw("
            COUNT(*) as total,
            COALESCE(SUM(status = 'pending'), 0) as pending,
            COALESCE(SUM(status = 'verified'), 0) as verified,
            COALESCE(SUM(status = 'rejected'), 0) as rejected,
            COALESCE(SUM(status = 'waiting_upload'), 0) as waiting_upload,
            COALESCE(SUM(status = 'waiting_cash'), 0) as waiting_cash
        ")
            ->first();

        $totalSiswa = DB::table('siswas')->count();
        $totalDiterima = DB::table('siswas')->where('isAccepted', 1)->count();
        $totalPending = DB::table('siswas')->where(function ($q) {
            $q->where('status', 'Pending')->orWhereNull('status')->orWhere('isAccepted', 0);
        })->where('status', '!=', 'Ditolak')->count();
        $totalDitolak = DB::table('siswas')->where('status', 'Ditolak')->count();

        $setting = DB::table('pengaturan_aplikasis')->first();
        $biaya = $setting->biaya_pendaftaran ?? 200000;
        $verifiedCount = $paymentStats->verified ?? 0;
        $totalDanaMasuk = DB::table('bukti_pembayarans')->where('status', 'verified')->sum('amount') ?: ($verifiedCount * $biaya);

        $recentSiswas = DB::table('siswas')
            ->leftJoin('m_jurusans', 'siswas.id_jurusan', '=', 'm_jurusans.id')
            ->leftJoin('bukti_pembayarans', 'siswas.id', '=', 'bukti_pembayarans.siswa_id')
            ->select(
                'siswas.id',
                'siswas.kode_pendaftaran',
                'siswas.nama',
                'siswas.no_hp',
                'siswas.asal_sekolah',
                'siswas.status',
                'siswas.isAccepted',
                'siswas.nis',
                'siswas.created_at',
                'm_jurusans.nama_jurusan',
                'bukti_pembayarans.status as status_bayar'
            )
            ->orderBy('siswas.id', 'desc')
            ->limit(7)
            ->get();

        return view('home', compact(
            'chartData',
            'paymentStats',
            'totalSiswa',
            'totalDiterima',
            'totalPending',
            'totalDitolak',
            'totalDanaMasuk',
            'recentSiswas',
            'setting'
        ));
    }
}
