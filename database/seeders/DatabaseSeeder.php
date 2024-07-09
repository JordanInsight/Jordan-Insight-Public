<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(CarSeeder::class);
        $this->call(HotelSeeder::class);
        $this->call(HistoricalSiteSeeder::class);
        $this->call(RestaurantSeeder::class);
        $this->call(ActivitySeeder::class);
        $this->call(CategoriesTableSeeder::class);
    }
}
