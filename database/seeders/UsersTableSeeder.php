<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        User::create([
            'first_name' => 'Default',
            'last_name' => 'Admin',
            'email' => 'admin@ji.com',
            'password' => Hash::make('admin'),
            'role_id' => 1, 
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        User::create([
            'first_name' => 'Default',
            'last_name' => 'Vendor',
            'email' => 'vendor@ji.com',
            'password' => Hash::make('vendor'),
            'role_id' => 2, 
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
