<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $roles = [
            ['role_name' => 'Admin', 'created_at' => $now, 'updated_at' => $now],
            ['role_name' => 'Vendor', 'created_at' => $now, 'updated_at' => $now],
            ['role_name' => 'User', 'created_at' => $now, 'updated_at' => $now],

        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
