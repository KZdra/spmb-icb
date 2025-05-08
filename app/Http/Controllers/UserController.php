<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        $rolesList = DB::table('roles')->select('id', 'name')->orderBy('name', 'asc')->get();
        return view('users.index', compact('users', 'rolesList'));
    }
    public function store(Request $request)
    {
        $kont = $request->validate([

            'role_id' => 'required|integer',
            'nama' => 'required|string',
            'password' => 'required',
            'email' => 'required|email|unique:users,email',
        ]);
        try {
            DB::table('users')->insert([
                'name' => $kont['nama'],
                'role_id' => $kont['role_id'],
                'email' => $kont['email'],
                'password' => Hash::make($kont['password']),
                'created_at' => Carbon::now(),
            ]);
            return response()->json(['message' => 'User berhasil ditambahkan!'], 201);
        } catch (\Exception $e) {
            // return response()->json(['message' => 'Ada Masalah Diantara Input/Server'], 500);
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function update(Request $request, $id)
    {
        try {

            $data = [
                'role_id' => $request->role_id,
                'name' => $request->nama,
                'email' => $request->email,
                'updated_at' => Carbon::now(),
            ];

            if ($request->filled('password')) { // Gunakan filled() untuk mengecek apakah password dikirim
                $data['password'] = Hash::make($request->password);
            }
            DB::table('users')->where('id', $id)->update($data);
            return response()->json(['message' => 'User berhasil diUpdate!'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ada Masalah Diantara Input/Server'], 500);
            // return response()->json(['message' => $e->getMessages()], 500);
        }
    }
    public function destroy($id)
    {
        try {
            DB::table('users')->where('id', $id)->delete();
            return response()->json(['message' => 'User berhasil diUpdate!'], 201);
        } catch (\Exception $e) {
            // return response()->json(['message' => 'Ada Masalah Diantara Input/Server'], 500);
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
