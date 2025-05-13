<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\MJurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MJurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurusans = MJurusan::all();
        return view('jurusan.index', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $kont = $request->validate([

            'nama' => 'required|string',
            'spp' => 'required',
            'dsp' => 'required',
        ]);
        try {
            DB::table('m_jurusans')->insert([
                'nama_jurusan' => $kont['nama'],
                'spp' => $kont['spp'],
                'dsp' => $kont['dsp'],
                'created_at' => Carbon::now(),
            ]);
            return response()->json(['message' => 'Jurusan berhasil ditambahkan!'], 201);
        } catch (\Exception $e) {
            // return response()->json(['message' => 'Ada Masalah Diantara Input/Server'], 500);
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function update(Request $request, $id)
    {
        try {

            $data = [
                'nama_jurusan' => $request->nama,
                'spp' => $request->spp,
                'dsp' => $request->dsp,
                'updated_at' => Carbon::now(),
            ];
            DB::table('m_jurusans')->where('id', $id)->update($data);
            return response()->json(['message' => 'Jurusan berhasil diUpdate!'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ada Masalah Diantara Input/Server'], 500);
            // return response()->json(['message' => $e->getMessages()], 500);
        }
    }
    public function destroy($id)
    {
        try {
            DB::table('m_jurusans')->where('id', $id)->delete();
            return response()->json(['message' => 'Jurusan berhasil Di Hapus!'], 201);
        } catch (\Exception $e) {
            // return response()->json(['message' => 'Ada Masalah Diantara Input/Server'], 500);
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
