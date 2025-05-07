<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Administrator', 'email' => 'admin@x.com', 'password' => Hash::make('admin'), 'role_id' => 1, 'created_at' => now()],
            ['name' => 'Operator Sekolah', 'email' => 'operator@x.com', 'password' => Hash::make('operator'), 'role_id' => 2, 'created_at' => now()],
            ['name' => 'Staff PPDB', 'email' => 'staff@x.com', 'password' => Hash::make('staff'), 'role_id' => 3, 'created_at' => now()],
        ];

        DB::table('users')->insert($roles);
    }
}
