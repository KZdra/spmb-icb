<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('home', compact('chartData'));
    }
}
