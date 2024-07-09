<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $restaurants = [
            ['location_id' => 1, 'restaurant_name' => 'Lucca Steakhouse', 'cuisine' => 'Steakhouse Barbecue', 'description' => 'A popular steakhouse in Amman.', 'website' => 'https://facebook.com/LuccaSteakhouse', 'image' => 'lucca_steakhouse.jpg', 'min_price' => 3, 'max_price' => 12, 'rating' => 5.0, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 1, 'restaurant_name' => 'High Garden Rooftop', 'cuisine' => 'American Seafood International European Healthy', 'description' => 'A rooftop restaurant with stunning views.', 'website' => 'https://facebook.com/HighGardenRooftop', 'image' => 'high_garden_rooftop.jpg', 'min_price' => 2, 'max_price' => 21, 'rating' => 5.0, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 1, 'restaurant_name' => 'Jubran', 'cuisine' => 'Middle Eastern International', 'description' => 'A well-known restaurant in Al Abdali.', 'website' => 'https://facebook.com/JubranRestaurant', 'image' => 'jubran.jpg', 'min_price' => 25, 'max_price' => 60, 'rating' => 5.0, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 1, 'restaurant_name' => 'Sufra Restaurant', 'cuisine' => 'Mediterranean Middle Eastern', 'description' => 'Authentic Mediterranean and Middle Eastern cuisine.', 'website' => 'https://facebook.com/SufraRestaurant', 'image' => 'sufra.jpg', 'min_price' => 7, 'max_price' => 30, 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 14, 'restaurant_name' => 'Burj Al Hamam', 'cuisine' => 'Lebanese Middle Eastern', 'description' => 'A renowned Lebanese restaurant.', 'website' => 'https://ihg.com/BurjAlHamam', 'image' => 'burj_al_hamam.jpg', 'min_price' => 30, 'max_price' => 60, 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 1, 'restaurant_name' => 'Abu Zaghleh Restaurant', 'cuisine' => 'Barbecue Middle Eastern', 'description' => 'Famous for its barbecue dishes.', 'website' => 'https://abuzaghleh.com', 'image' => 'abu_zaghleh.jpg', 'min_price' => 10, 'max_price' => 35, 'rating' => 4.0, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 1, 'restaurant_name' => 'Habibah Sweets', 'cuisine' => 'Middle Eastern Sweets', 'description' => 'Best sweets in Amman.', 'website' => 'https://habibah.com.jo', 'image' => 'habibah_sweets.jpg', 'min_price' => 2, 'max_price' => 15, 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 1, 'restaurant_name' => 'Hashem Restaurant', 'cuisine' => 'Mediterranean Middle Eastern', 'description' => 'Legendary restaurant in downtown Amman.', 'website' => 'https://hashemrestaurants.com', 'image' => 'hashem_restaurant.jpg', 'min_price' => 3, 'max_price' => 20, 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 1, 'restaurant_name' => 'Bourj Al Hamam', 'cuisine' => 'Lebanese Mediterranean Barbecue Healthy Middle Eastern', 'description' => 'Delicious Lebanese cuisine.', 'website' => 'https://ihg.com/BourjAlHamam', 'image' => 'bourj_al_hamam.jpg', 'min_price' => 30, 'max_price' => 60, 'rating' => 5.0, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 1, 'restaurant_name' => 'Nur Lebanese Dining', 'cuisine' => 'Lebanese Mediterranean Middle Eastern', 'description' => 'Elegant Lebanese dining experience.', 'website' => 'https://fairmont.com/NurLebaneseDining', 'image' => 'nur_lebanese_dining.jpg', 'min_price' => 25, 'max_price' => 75, 'rating' => 5.0, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 1, 'restaurant_name' => 'IL Terrazzo Amman Restaurant', 'cuisine' => 'Italian European Tuscan Sicilian Central-Italian Southern-Italian', 'description' => 'Authentic Italian cuisine.', 'website' => 'https://marriott.com/ILTerrazzoAmman', 'image' => 'il_terrazzo_amman.jpg', 'min_price' => 30, 'max_price' => 80, 'rating' => 5.0, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 1, 'restaurant_name' => 'La Capitale Restaurant', 'cuisine' => 'French European', 'description' => 'Fine French dining.', 'website' => 'https://fourseasons.com/LaCapitaleAmman', 'image' => 'la_capitale_amman.jpg', 'min_price' => 40, 'max_price' => 100, 'rating' => 5.0, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 4, 'restaurant_name' => 'Khashoka Aqaba', 'cuisine' => 'International Mediterranean Healthy Middle Eastern', 'description' => 'Delicious international dishes in Aqaba.', 'website' => 'https://facebook.com/KhashokaAqaba', 'image' => 'khashoka_aqaba.jpg', 'min_price' => 20, 'max_price' => 50, 'rating' => 5.0, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 4, 'restaurant_name' => 'khubza & seneya', 'cuisine' => 'Healthy Middle Eastern', 'description' => 'Healthy and delicious Middle Eastern cuisine.', 'website' => 'https://khubzaseneya.com', 'image' => 'khubza_seneya.jpg', 'min_price' => 7, 'max_price' => 14, 'rating' => 5.0, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 4, 'restaurant_name' => 'Buffalo Wings & Rings- Aqaba', 'cuisine' => 'American Central American', 'description' => 'Famous for its wings and rings.', 'website' => 'https://facebook.com/BuffaloWingsAqaba', 'image' => 'buffalo_wings_aqaba.jpg', 'min_price' => 6, 'max_price' => 13, 'rating' => 5.0, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 4, 'restaurant_name' => 'Shinawi Restaurant', 'cuisine' => 'Cafe Mediterranean Healthy Middle Eastern', 'description' => 'Great cafe and restaurant in Aqaba.', 'website' => 'https://facebook.com/ShinawiAqaba', 'image' => 'shinawi_aqaba.jpg', 'min_price' => 1, 'max_price' => 17, 'rating' => 5.0, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 4, 'restaurant_name' => 'Al-Shami', 'cuisine' => 'Seafood Mediterranean Barbecue Middle Eastern', 'description' => 'Famous for its seafood dishes.', 'website' => 'https://facebook.com/AlShamiAqaba', 'image' => 'al_shami_aqaba.jpg', 'min_price' => 20, 'max_price' => 50, 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 15, 'restaurant_name' => 'Rum Castle', 'cuisine' => 'Middle Eastern', 'description' => 'Authentic Middle Eastern dishes.', 'website' => 'https://facebook.com/RumCastleRestaurant', 'image' => 'rum_castle.jpg', 'min_price' => 10, 'max_price' => 40, 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 15, 'restaurant_name' => 'Foodex', 'cuisine' => 'Middle Eastern', 'description' => 'Delicious Middle Eastern cuisine.', 'website' => 'https://facebook.com/FoodexAmman', 'image' => 'foodex.jpg', 'min_price' => 1, 'max_price' => 4, 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 14, 'restaurant_name' => 'Oak Tree Kitchen', 'cuisine' => 'Middle Eastern', 'description' => 'Tasty Middle Eastern dishes.', 'website' => 'https://marriott.com/OakTreeKitchen', 'image' => 'oak_tree_kitchen.jpg', 'min_price' => 15, 'max_price' => 45, 'rating' => 5.0, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 14, 'restaurant_name' => 'Rehan Lebanese Cuisine', 'cuisine' => 'Lebanese Mediterranean Healthy Middle Eastern', 'description' => 'Healthy and flavorful Lebanese cuisine.', 'website' => 'https://kempinski.com/RehanLebaneseCuisine', 'image' => 'rehan_lebanese.jpg', 'min_price' => 25, 'max_price' => 55, 'rating' => 5.0, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 14, 'restaurant_name' => 'Al Deera Restaurant', 'cuisine' => 'International Middle Eastern', 'description' => 'A mix of international and Middle Eastern cuisine.', 'website' => 'https://ihg.com/AlDeeraRestaurant', 'image' => 'al_deera.jpg', 'min_price' => 35, 'max_price' => 56, 'rating' => 5.0, 'created_at' => $now, 'updated_at' => $now],
            ['location_id' => 14, 'restaurant_name' => 'Ashur Pizza & Grill Restaurant', 'cuisine' => 'Italian', 'description' => 'Delicious Italian pizzas and grills.', 'website' => 'https://kempinski.com/AshurPizzaGrill', 'image' => 'ashur_pizza_grill.jpg', 'min_price' => 25, 'max_price' => 55, 'rating' => 4.5, 'created_at' => $now, 'updated_at' => $now]
        ];

        foreach ($restaurants as $restaurant) {
            Restaurant::create($restaurant);
        }
    }
}
