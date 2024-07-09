<?php

namespace Database\Seeders;

use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $locations = [
            ['city_id' => 1, 'location_name' => 'Al Abdali', 'created_at' => $now, 'updated_at' => $now],
            ['city_id' => 4, 'location_name' => 'King Hussein Street', 'created_at' => $now, 'updated_at' => $now],
            ['city_id' => 15, 'location_name' => 'Wadi Rum Road', 'created_at' => $now, 'updated_at' => $now],
            ['city_id' => 14, 'location_name' => 'Dead Sea Road', 'created_at' => $now, 'updated_at' => $now],
            ['city_id' => 1, 'location_name' => 'Al-Madina Al-Monawara St', 'created_at' => $now, 'updated_at' => $now],
            ['city_id' => 9, 'location_name' => 'Jordan Valley Highway', 'created_at' => $now, 'updated_at' => $now],
            ['city_id' => 13, 'location_name' => 'Petra', 'created_at' => $now, 'updated_at' => $now],
            ['city_id' => 10, 'location_name' => 'Kerak castle road', 'created_at' => $now, 'updated_at' => $now],
            ['city_id' => 8, 'location_name' => 'Ajloun Castle', 'created_at' => $now, 'updated_at' => $now],
            ['city_id' => 7, 'location_name' => 'Jerash', 'created_at' => $now, 'updated_at' => $now],
            ['city_id' => 6, 'location_name' => 'Al-Hashemi Street', 'created_at' => $now, 'updated_at' => $now],
            ['city_id' => 5, 'location_name' => 'King Talal Street', 'created_at' => $now, 'updated_at' => $now],
            ['city_id' => 4, 'location_name' => 'Marina Village, Ayla', 'created_at' => $now, 'updated_at' => $now],
            ['city_id' => 11, 'location_name' => 'Madina Al Munawarah St', 'created_at' => $now, 'updated_at' => $now],
            ['city_id' => 3, 'location_name' => 'Airport Road', 'created_at' => $now, 'updated_at' => $now],
            ['city_id' => 2, 'location_name' => 'South Beach Highway', 'created_at' => $now, 'updated_at' => $now],
            ['city_id' => 1, 'location_name' => 'Fifth Circle', 'created_at' => $now, 'updated_at' => $now],
            ['city_id' => 1, 'location_name' => 'Al Shmeisani', 'created_at' => $now, 'updated_at' => $now],
            ['city_id' => 1, 'location_name' => 'Rainbow Street', 'created_at' => $now, 'updated_at' => $now],
            ['city_id' => 1, 'location_name' => 'Downtown', 'created_at' => $now, 'updated_at' => $now],
            ['city_id' => 15, 'location_name' => 'Wadi Rum Village', 'created_at' => $now, 'updated_at' => $now],
            ['city_id' => 14, 'location_name' => 'Sweimah', 'created_at' => $now, 'updated_at' => $now],
            ['city_id' => 13, 'location_name' => 'Wadi Musa', 'created_at' => $now, 'updated_at' => $now],
            ['city_id' => 14, 'location_name' => 'Sweimah (Dead Sea)', 'created_at' => $now, 'updated_at' => $now],
            ['city_id' => 10, 'location_name' => 'Karak', 'created_at' => $now, 'updated_at' => $now],
            ['city_id' => 1, 'location_name' => 'AL Muqabalein', 'created_at' => $now, 'updated_at' => $now],
            ['city_id' => 14, 'location_name' => 'Dead Sea Sweimah', 'created_at' => $now, 'updated_at' => $now],
            ['city_id' => 2, 'location_name' => 'Highway 40', 'created_at' => $now, 'updated_at' => $now],
            ['city_id' => 14, 'location_name' => 'k.hussin bridge', 'created_at' => $now, 'updated_at' => $now],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}
