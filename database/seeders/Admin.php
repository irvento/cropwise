<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class Admin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin@example.com'), // Replace 'password' with a secure password
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'address' => '123 Admin Street, Admin City',
            'contact_number' => '1234567890',
        ]);
    }
}
