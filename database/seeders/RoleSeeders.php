<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['id' => 1, 'name' => 'Administrator'],
            ['id' => 2, 'name' => 'Operator Sekolah'],
            ['id' => 3, 'name' => 'Staff PPDB'],
        ];

        foreach ($roles as $r) {
            DB::table('roles')->updateOrInsert(['id' => $r['id']], $r);
        }
    }
}
