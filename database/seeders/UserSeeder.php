<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id' => 1,
                'name' => 'Administrator SPMB',
                'email' => 'admin@x.com',
                'password' => Hash::make('admin'),
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Panitia Penerimaan',
                'email' => 'panitia@spmb.sch.id',
                'password' => Hash::make('panitia123'),
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($users as $u) {
            DB::table('users')->updateOrInsert(['email' => $u['email']], $u);
        }
    }
}
