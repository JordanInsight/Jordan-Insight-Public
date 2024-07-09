<?php

namespace Database\Seeders;

use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $activities = [
            [
                'location_id' => 1,
                'activity_name' => 'The Jordanian Kitchen',
                'description' => 'Experience traditional Jordanian cooking.',
                'website' => 'https://web.facebook.com/people/The-Jordanian-Kitchen/100087382098135/',
                'activity_type' => 'Cooking Lesson',
                'price' => 30.00,
                'image' => 'jordanian_kitchen.jpg',
                'rating' => 5.0,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'location_id' => 1,
                'activity_name' => 'Royal Automobile Museum',
                'description' => 'A museum displaying vintage cars from the private collection of King Hussein.',
                'website' => 'https://automuseums.info/jordan/royal-automobile-museum',
                'activity_type' => 'Sightseeing',
                'price' => 5.00,
                'image' => 'royal_automobile_museum.jpg',
                'rating' => 4.5,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'location_id' => 1,
                'activity_name' => 'Children\'s Museum',
                'description' => 'Interactive exhibits and activities for children.',
                'website' => 'https://cmj.jo/',
                'activity_type' => 'Sightseeing',
                'price' => 3.00,
                'image' => 'childrens_museum.jpg',
                'rating' => 4.0,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'location_id' => 1,
                'activity_name' => 'The Jordan Museum',
                'description' => 'Explore the rich history and culture of Jordan.',
                'website' => 'https://web.facebook.com/TheJordanMuseum/?_rdc=3&_rdr',
                'activity_type' => 'Sightseeing',
                'price' => 5.00,
                'image' => 'jordan_museum.jpg',
                'rating' => 4.5,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'location_id' => 1,
                'activity_name' => 'Jordan Archaeological Museum',
                'description' => 'Discover ancient artifacts from Jordan\'s history.',
                'website' => 'https://museums.visitjordan.com/en/Museum/15',
                'activity_type' => 'Sightseeing',
                'price' => 3.00,
                'image' => 'archaeological_museum.jpg',
                'rating' => 4.0,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'location_id' => 1,
                'activity_name' => 'Royal Tank Museum',
                'description' => 'Explore a collection of historical military tanks.',
                'website' => 'https://rtm.jo/',
                'activity_type' => 'Sightseeing',
                'price' => 3.00,
                'image' => 'royal_tank_museum.jpg',
                'rating' => 5.0,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'location_id' => 1,
                'activity_name' => 'Amman Panorama Art Gallery',
                'description' => 'Experience beautiful artworks in Amman.',
                'website' => 'https://www.ammanpanoramaartgallery.com/',
                'activity_type' => 'Art Exhibition',
                'price' => 0.00,
                'image' => 'amman_panorama_art_gallery.jpg',
                'rating' => 5.0,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'location_id' => 1,
                'activity_name' => 'Darat al Funun',
                'description' => 'Art gallery showcasing contemporary Middle Eastern art.',
                'website' => 'https://daratalfunun.org/',
                'activity_type' => 'Art Exhibition',
                'price' => 0.00,
                'image' => 'darat_al_funun.jpg',
                'rating' => 4.5,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'location_id' => 1,
                'activity_name' => 'Old Signs Of Amman',
                'description' => 'A walk down memory lane with old signs of Amman.',
                'website' => 'https://www.jordannews.jo/Section-128/Where-to-Go/Old-Signs-of-Amman-a-walk-down-memory-lane-8599',
                'activity_type' => 'Sightseeing',
                'price' => 0.00,
                'image' => 'old_signs_of_amman.jpg',
                'rating' => 4.5,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'location_id' => 4,
                'activity_name' => 'Scuba Diving',
                'description' => 'Explore the underwater world in Aqaba.',
                'website' => 'https://aqabaleadersdive.com/',
                'activity_type' => 'Entertainment',
                'price' => 50.00,
                'image' => 'scuba_diving.jpg',
                'rating' => 5.0,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'location_id' => 4,
                'activity_name' => 'Glass-Bottom Boat',
                'description' => 'Enjoy a boat ride with a view of the underwater world.',
                'website' => 'https://web.facebook.com/p/Coral-Vision-100068497817436/?_rdc=1&_rdr',
                'activity_type' => 'Sightseeing',
                'price' => 30.00,
                'image' => 'glass_bottom_boat.jpg',
                'rating' => 4.0,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'location_id' => 4,
                'activity_name' => 'Saraya Aqaba Waterpark',
                'description' => 'Fun and adventure at the Saraya Aqaba Waterpark.',
                'website' => 'https://sarayaaqabawaterpark.com/',
                'activity_type' => 'Entertainment',
                'price' => 35.00,
                'image' => 'saraya_aqaba_waterpark.jpg',
                'rating' => 4.0,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'location_id' => 4,
                'activity_name' => 'City Beach',
                'description' => 'Relax and enjoy the beach in Aqaba.',
                'website' => 'https://aqaba.jo/Pages/Details/Attraction/14/Aqaba_Beaches_',
                'activity_type' => 'Entertainment',
                'price' => 0.00,
                'image' => 'city_beach.jpg',
                'rating' => 4.0,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'location_id' => 15,
                'activity_name' => 'Camping and Hiking Adventure',
                'description' => 'Enjoy camping and hiking in Wadi Rum.',
                'website' => 'https://www.salmatours.com/salma-tours-jordan-travel-jordan-tours--accueil',
                'activity_type' => 'Adventure',
                'price' => 150.00,
                'image' => 'camping_hiking_adventure.jpg',
                'rating' => 4.5,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'location_id' => 14,
                'activity_name' => 'Wadi Al Mujib Adventures',
                'description' => 'Experience the thrill of Wadi Al Mujib.',
                'website' => 'https://international.visitjordan.com/Wheretogo/Wadi-Mujib',
                'activity_type' => 'Adventures',
                'price' => 21.00,
                'image' => 'wadi_al_mujib_adventures.jpg',
                'rating' => 4.5,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'location_id' => 15,
                'activity_name' => 'Hot Air Balloon Flight',
                'description' => 'Experience the stunning views of Wadi Rum from a hot air balloon.',
                'website' => 'https://www.royalballoonjordan.com/',
                'activity_type' => 'Entertainment',
                'price' => 150.00,
                'image' => 'hot_air_balloon_flight.jpg',
                'rating' => 5.0,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'location_id' => 13,
                'activity_name' => 'Ad-Deir Trail',
                'description' => 'Hike the famous Ad-Deir Trail in Petra.',
                'website' => 'https://visitpetra.jo/DetailsPage/VisitPetra/TrailsDetailsEn.aspx?PID=8',
                'activity_type' => 'Adventure',
                'price' => 50.00,
                'image' => 'ad_deir_trail.jpg',
                'rating' => 5.0,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'location_id' => 13,
                'activity_name' => 'Al Khubtha Trail',
                'description' => 'Explore the scenic Al Khubtha Trail in Petra.',
                'website' => 'https://visitpetra.jo/DetailsPage/VisitPetra/TrailsDetailsEn.aspx?PID=7',
                'activity_type' => 'Adventure',
                'price' => 50.00,
                'image' => 'al_khubtha_trail.jpg',
                'rating' => 5.0,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'location_id' => 14,
                'activity_name' => 'Dead Sea Museum',
                'description' => 'Learn about the unique ecosystem of the Dead Sea.',
                'website' => 'https://museums.visitjordan.com/en/Museum/29',
                'activity_type' => 'Sightseeing',
                'price' => 2.00,
                'image' => 'dead_sea_museum.jpg',
                'rating' => 4.0,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'location_id' => 14,
                'activity_name' => 'Zara Cliff Walking Trail',
                'description' => 'Experience the breathtaking Zara Cliff Walking Trail.',
                'website' => 'https://traveljordanian.com/explore/eco-and-adventure-tourism/zara-cliff-walk',
                'activity_type' => 'Adventure',
                'price' => 5.00,
                'image' => 'zara_cliff_walking_trail.jpg',
                'rating' => 4.0,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'location_id' => 14,
                'activity_name' => 'Dead Sea Mud Bath',
                'description' => 'Rejuvenate with a therapeutic Dead Sea mud bath.',
                'website' => 'https://jordan-travel.com/dead-sea-mud/',
                'activity_type' => 'Entertainment',
                'price' => 20.00,
                'image' => 'dead_sea_mud_bath.jpg',
                'rating' => 5.0,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];

        foreach ($activities as $activity) {
            Activity::create($activity);
        }
    }
}
