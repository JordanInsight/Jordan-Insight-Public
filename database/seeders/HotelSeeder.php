<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $hotels = [
            ['location_id' => 1, 'hotel_name' => 'Coral Tower', 'description' => 'A comfortable stay in Amman.', 'website' => 'https://facebook.com/CoralTowerAmman', 'image' => 'coral_tower.jpg', 'min_price' => 92, 'max_price' => 112, 'rating' => 3.0, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 4, 'hotel_name' => 'Kempinski Hotel Aqaba', 'description' => 'Luxury beachfront hotel in Aqaba.', 'website' => 'https://facebook.com/KempinskiAqaba', 'image' => 'kempinski_aqaba.jpg', 'min_price' => 276, 'max_price' => 384, 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 15, 'hotel_name' => 'RUM YANAL CAMP', 'description' => 'Experience the beauty of Wadi Rum.', 'website' => '', 'image' => 'rum_yanal_camp.jpg', 'min_price' => 25, 'max_price' => 96, 'rating' => 4.3, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 14, 'hotel_name' => 'Kempinski Hotel Ishtar Dead Sea', 'description' => 'Luxury spa and resort at the Dead Sea.', 'website' => 'https://facebook.com/KempinskiDeadSea', 'image' => 'kempinski_dead_sea.jpg', 'min_price' => 225, 'max_price' => 443, 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 1, 'hotel_name' => 'Ayass Hotel', 'description' => 'Modern hotel in Amman.', 'website' => 'https://facebook.com/AyassHotel', 'image' => 'ayass_hotel.jpg', 'min_price' => 102, 'max_price' => 128, 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 1, 'hotel_name' => 'W Amman', 'description' => 'Luxury hotel in the heart of Amman.', 'website' => 'https://facebook.com/WAmman', 'image' => 'w_amman.jpg', 'min_price' => 190, 'max_price' => 211, 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 15, 'hotel_name' => 'Sun City Camp Wadi Rum', 'description' => 'Unique desert camp experience in Wadi Rum.', 'website' => 'https://facebook.com/SunCityCamp', 'image' => 'sun_city_camp.jpg', 'min_price' => 160, 'max_price' => 180, 'rating' => 5.0, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 15, 'hotel_name' => 'Bedouin Lifestyle Camp', 'description' => 'Authentic Bedouin experience in Wadi Rum.', 'website' => 'https://bedouinlifestylecamp.com', 'image' => 'bedouin_lifestyle_camp.jpg', 'min_price' => 8, 'max_price' => 120, 'rating' => 5.0, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 14, 'hotel_name' => 'Movenpick Resort & Spa Dead Sea', 'description' => 'Relaxing resort at the Dead Sea.', 'website' => 'https://facebook.com/MovenpickDeadSea', 'image' => 'movenpick_dead_sea.jpg', 'min_price' => 222, 'max_price' => 295, 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 3, 'hotel_name' => 'Opal Hotel', 'description' => 'Comfortable hotel near the airport.', 'website' => 'https://facebook.com/OpalHotelAmman', 'image' => 'opal_hotel.jpg', 'min_price' => 100, 'max_price' => 114, 'rating' => 4.0, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 4, 'hotel_name' => 'Luxotel Aqaba Beach Resort & Spa', 'description' => 'Beachfront luxury in Aqaba.', 'website' => 'https://com-jordan.com/LuxotelAqaba', 'image' => 'luxotel_aqaba.jpg', 'min_price' => 106, 'max_price' => 206, 'rating' => 5.0, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 4, 'hotel_name' => 'Movenpick Resort & Spa Tala Bay Aqaba', 'description' => 'Luxury beach resort in Tala Bay.', 'website' => 'https://accor.com/MovenpickTalaBay', 'image' => 'movenpick_tala_bay.jpg', 'min_price' => 186, 'max_price' => 394, 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 4, 'hotel_name' => 'Al Manara A Luxury Collection Hotel Saraya Aqaba', 'description' => 'Exclusive luxury hotel in Aqaba.', 'website' => 'https://marriott.com/AlManaraAqaba', 'image' => 'al_manara.jpg', 'min_price' => 183, 'max_price' => 353, 'rating' => 5.0, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 4, 'hotel_name' => 'Movenpick Resort & Residences Aqaba', 'description' => 'Luxury resort and residences in Aqaba.', 'website' => 'https://accor.com/MovenpickAqaba', 'image' => 'movenpick_aqaba.jpg', 'min_price' => 178, 'max_price' => 281, 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 4, 'hotel_name' => 'Luciana Hotel By Bratus', 'description' => 'Family-friendly hotel in Aqaba.', 'website' => 'https://luhbb.com/LucianaAqaba', 'image' => 'luciana_aqaba.jpg', 'min_price' => 79, 'max_price' => 128, 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 4, 'hotel_name' => 'InterContinental Aqaba (Resort Aqaba) an IHG Hotel', 'description' => 'Luxury resort with stunning views in Aqaba.', 'website' => 'https://ihg.com/InterContinentalAqaba', 'image' => 'intercontinental_aqaba.jpg', 'min_price' => 150, 'max_price' => 380, 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 4, 'hotel_name' => 'Hyatt Regency Aqaba Ayla Resort', 'description' => 'Elegant beachfront resort in Aqaba.', 'website' => 'https://ayla.com/HyattRegencyAqaba', 'image' => 'hyatt_regency_aqaba.jpg', 'min_price' => 216, 'max_price' => 430, 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 1, 'hotel_name' => 'Landmark Amman Hotel & Conference Center', 'description' => 'Business and leisure hotel in Amman.', 'website' => 'https://landmarkamman.com', 'image' => 'landmark_amman.jpg', 'min_price' => 119, 'max_price' => 134, 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 1, 'hotel_name' => 'Fairmont Amman', 'description' => 'Luxury hotel with world-class amenities.', 'website' => 'https://fairmont.com/FairmontAmman', 'image' => 'fairmont_amman.jpg', 'min_price' => 237, 'max_price' => 313, 'rating' => 5.0, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 1, 'hotel_name' => 'InterContinental Amman', 'description' => 'Elegant hotel in the heart of Amman.', 'website' => 'https://ihg.com/InterContinentalAmman', 'image' => 'intercontinental_amman.jpg', 'min_price' => 127, 'max_price' => 172, 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 1, 'hotel_name' => 'Corp Amman Hotel', 'description' => 'Contemporary hotel in Amman.', 'website' => 'https://com-amman.com/CorpAmman', 'image' => 'corp_amman.jpg', 'min_price' => 71, 'max_price' => 87, 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 1, 'hotel_name' => 'Mövenpick Hotel Amman', 'description' => 'Modern hotel in Amman.', 'website' => 'https://accor.com/MovenpickAmman', 'image' => 'movenpick_amman.jpg', 'min_price' => 110, 'max_price' => 130, 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 1, 'hotel_name' => 'Grand Hyatt Amman', 'description' => 'Luxurious 5-star hotel in Amman.', 'website' => 'https://hyatt.com/GrandHyattAmman', 'image' => 'grand_hyatt_amman.jpg', 'min_price' => 135, 'max_price' => 180, 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 1, 'hotel_name' => 'The House Boutique Suites', 'description' => 'Stylish boutique hotel in Amman.', 'website' => 'https://thehouseamman.com', 'image' => 'the_house_boutique_suites.jpg', 'min_price' => 125, 'max_price' => 145, 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 14, 'hotel_name' => 'Crowne Plaza Jordan - Dead Sea Resort & Spa', 'description' => 'Relaxing resort and spa at the Dead Sea.', 'website' => 'https://ihg.com/CrownePlazaDeadSea', 'image' => 'crowne_plaza_dead_sea.jpg', 'min_price' => 145, 'max_price' => 227, 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 14, 'hotel_name' => 'Holiday Inn Resort Dead Sea', 'description' => 'Family-friendly resort at the Dead Sea.', 'website' => 'https://ihg.com/HolidayInnDeadSea', 'image' => 'holiday_inn_dead_sea.jpg', 'min_price' => 138, 'max_price' => 222, 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 14, 'hotel_name' => 'Grand East Hotel - Resort & Spa Dead Sea', 'description' => 'Comfortable resort and spa at the Dead Sea.', 'website' => 'https://com-jordan.com/GrandEastDeadSea', 'image' => 'grand_east_dead_sea.jpg', 'min_price' => 78, 'max_price' => 96, 'rating' => 4.0, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 14, 'hotel_name' => 'Dead Sea Marriott Resort & Spa', 'description' => 'Luxurious resort and spa at the Dead Sea.', 'website' => 'https://marriott.com/DeadSeaMarriott', 'image' => 'dead_sea_marriott.jpg', 'min_price' => 164, 'max_price' => 394, 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 14, 'hotel_name' => 'Hilton Dead Sea Resort & Spa', 'description' => 'Elegant resort and spa at the Dead Sea.', 'website' => 'https://hilton.com/HiltonDeadSea', 'image' => 'hilton_dead_sea.jpg', 'min_price' => 121, 'max_price' => 244, 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
        ];

        foreach ($hotels as $hotel) {
            Hotel::create($hotel);
        }
    }
}
