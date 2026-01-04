<?php

namespace Database\Seeders;

use App\Helpers\Uid;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['Admin', 'Staff'];
        foreach ($roles as $dRole) {
            $user = User::create([
                'id' => Uid::generate(),
                'name' => $dRole,
                'email' => strtolower($dRole) . "@mail.com",
                'email_verified_at'  => now(),
                'password' => Hash::make('Password1'), // password1
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $role = Role::where('name', $dRole)->first();
            $user->roles()->sync($role);
        }
    }
}
