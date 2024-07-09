<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Car;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate the cars table
        Car::truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Insert seed data
        Car::insert([
            [
                'car_name' => 'Toyota Camry',
                'model' => '2020',
                'type' => 'Sedan',
                'image' => 'toyota_camry.jpg',
                'number_of_seats' => 5,
                'status' => 1,
                'price' => 50.00,
            ],
            [
                'car_name' => 'Honda Accord',
                'model' => '2021',
                'type' => 'Sedan',
                'image' => 'honda_accord.jpg',
                'number_of_seats' => 5,
                'status' => 1,
                'price' => 55.00,
            ],
            [
                'car_name' => 'Ford Explorer',
                'model' => '2019',
                'type' => 'SUV',
                'image' => 'ford_explorer.jpg',
                'number_of_seats' => 7,
                'status' => 1,
                'price' => 80.00,
            ],
            [
                'car_name' => 'Chevrolet Malibu',
                'model' => '2018',
                'type' => 'Sedan',
                'image' => 'chevrolet_malibu.jpg',
                'number_of_seats' => 5,
                'status' => 1,
                'price' => 45.00,
            ],
            [
                'car_name' => 'Tesla Model 3',
                'model' => '2021',
                'type' => 'Sedan',
                'image' => 'tesla_model_3.jpg',
                'number_of_seats' => 5,
                'status' => 1,
                'price' => 70.00,
            ],
            [
                'car_name' => 'BMW X5',
                'model' => '2020',
                'type' => 'SUV',
                'image' => 'bmw_x5.jpg',
                'number_of_seats' => 7,
                'status' => 1,
                'price' => 100.00,
            ],
            [
                'car_name' => 'Audi Q7',
                'model' => '2021',
                'type' => 'SUV',
                'image' => 'audi_q7.jpg',
                'number_of_seats' => 7,
                'status' => 1,
                'price' => 110.00,
            ],
            [
                'car_name' => 'Mercedes-Benz C-Class',
                'model' => '2020',
                'type' => 'Sedan',
                'image' => 'mercedes_benz_c_class.jpg',
                'number_of_seats' => 5,
                'status' => 1,
                'price' => 85.00,
            ],
            [
                'car_name' => 'Nissan Altima',
                'model' => '2019',
                'type' => 'Sedan',
                'image' => 'nissan_altima.jpg',
                'number_of_seats' => 5,
                'status' => 1,
                'price' => 40.00,
            ],
            [
                'car_name' => 'Hyundai Santa Fe',
                'model' => '2021',
                'type' => 'SUV',
                'image' => 'hyundai_santa_fe.jpg',
                'number_of_seats' => 7,
                'status' => 1,
                'price' => 90.00,
            ],
        ]);
    }
}
