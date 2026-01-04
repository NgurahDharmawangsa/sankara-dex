<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['id' => Role::ADMIN, 'name' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Role::STAFF, 'name' => 'Staff', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
