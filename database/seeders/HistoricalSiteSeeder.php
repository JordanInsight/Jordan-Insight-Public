<?php

namespace Database\Seeders;

use App\Models\HistoricalSite;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HistoricalSiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $sites = [
            ['location_id' => 1, 'site_name' => 'Roman Theatre', 'description' => 'Ancient Roman theatre in downtown Amman.', 'website' => 'https://jordan-travel.com/RomanTheater', 'image' => 'roman_theatre.jpg', 'entry_fees' => 3.00, 'opening_hours' => '8:00 AM - 4:00 PM', 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 1, 'site_name' => 'The Citadel', 'description' => 'Historical site with ruins from various periods.', 'website' => 'https://touristjordan.com/AmmanCitadel', 'image' => 'the_citadel.jpg', 'entry_fees' => 3.00, 'opening_hours' => '8:00 AM - 4:00 PM', 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 8, 'site_name' => 'Iraq Al Amir', 'description' => 'Ancient historical site near Amman.', 'website' => 'https://jordan-travel.com/IraqAlAmir', 'image' => 'iraq_al_amir.jpg', 'entry_fees' => 3.00, 'opening_hours' => '8:00 AM - 4:00 PM', 'rating' => 5.0, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 13, 'site_name' => 'Petra', 'description' => 'Famous archaeological site in Jordan.', 'website' => 'https://jordan-travel.com/Petra', 'image' => 'petra.jpg', 'entry_fees' => 50.00, 'opening_hours' => '6:00 AM - 6:00 PM', 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 7, 'site_name' => 'Jerash Ruins', 'description' => 'Well-preserved Roman city ruins.', 'website' => 'https://jordan-travel.com/JerashRuins', 'image' => 'jerash_ruins.jpg', 'entry_fees' => 10.00, 'opening_hours' => '8:00 AM - 4:00 PM', 'rating' => 5.0, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 8, 'site_name' => 'Ajloun Castle', 'description' => 'Historic Islamic castle.', 'website' => 'https://touristjordan.com/AjlounCastle', 'image' => 'ajloun_castle.jpg', 'entry_fees' => 3.00, 'opening_hours' => '8:00 AM - 4:00 PM', 'rating' => 4.0, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 10, 'site_name' => 'Kerak Castle', 'description' => 'Crusader castle in Kerak.', 'website' => 'https://visitjordan.com/KerakCastle', 'image' => 'kerak_castle.jpg', 'entry_fees' => 3.00, 'opening_hours' => '8:00 AM - 4:00 PM', 'rating' => 5.0, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 15, 'site_name' => 'Wadi Rum', 'description' => 'Protected desert wilderness in southern Jordan.', 'website' => 'https://wadirum.jo', 'image' => 'wadi_rum.jpg', 'entry_fees' => 5.00, 'opening_hours' => '8:00 AM - 4:00 PM', 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 14, 'site_name' => 'The Baptism Site Of Jesus Christ', 'description' => 'Pilgrimage site on the Jordan River.', 'website' => 'https://visitjordan.com/BaptismSite', 'image' => 'baptism_site.jpg', 'entry_fees' => 12.00, 'opening_hours' => '8:00 AM - 4:00 PM', 'rating' => 5.0, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 2, 'site_name' => 'Qusayr \'Amra', 'description' => 'Desert castle near Zarqa.', 'website' => 'https://touristjordan.com/QusayrAmra', 'image' => 'qusair_amra.jpg', 'entry_fees' => 3.00, 'opening_hours' => '8:00 AM - 4:00 PM', 'rating' => 5.0, 'created_at' => $now, 'updated_at' => $now],
        ];

        foreach ($sites as $site) {
            HistoricalSite::create($site);
        }
    }
}
