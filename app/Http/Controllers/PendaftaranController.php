<?php

namespace App\Http\Controllers;

use App\Models\Siswa;

class PendaftaranController extends Controller
{
    public function index()
    {
        $dataSis = Siswa::with(['jurusan', 'buktiPembayaran'])->findOrFail(auth_user()->id);
        return view('siswa.pendaftaran', compact('dataSis'));
    }
}
