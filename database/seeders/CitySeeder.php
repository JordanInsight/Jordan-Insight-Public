<?php

namespace Database\Seeders;

use App\Models\City;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $cities = [
            ['id' => 1, 'city_name' => 'Amman', 'created_at' => $now, 'updated_at' => $now ,'crs'=>"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d433868.63821682485!2d35.61797159576475!3d31.835918823585978!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151b5fb85d7981af%3A0x631c30c0f8dc65e8!2sAmman!5e0!3m2!1sen!2sjo!4v1717366156589!5m2!1sen!2sjo"],
            ['id' => 2, 'city_name' => 'Zarqa', 'created_at' => $now, 'updated_at' => $now , 'crs'=>"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d216423.48999768874!2d35.96887001774628!3d32.052555946625255!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151b658f76dbb883%3A0x6dbb13eec3c7a1f1!2sZarqa!5e0!3m2!1sen!2sjo!4v1717366315207!5m2!1sen!2sjo"],
            ['id' => 3, 'city_name' => 'Irbid', 'created_at' => $now, 'updated_at' => $now ,'crs'=>"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d53808.149738042324!2d35.806209847948274!3d32.55259548017165!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151c76916dac0453%3A0x5416e113d81f7d82!2sIrbid!5e0!3m2!1sen!2sjo!4v1717366369367!5m2!1sen!2sjo"],
            ['id' => 4, 'city_name' => 'Aqaba', 'created_at' => $now, 'updated_at' => $now , 'crs'=>"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d222065.38987871853!2d34.91032344299061!3d29.58124473948577!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15007039ff2efa81%3A0x595faa556d2e6acc!2sAqaba!5e0!3m2!1sen!2sjo!4v1717366456525!5m2!1sen!2sjo"],
            ['id' => 5, 'city_name' => 'Madaba', 'created_at' => $now, 'updated_at' => $now , 'crs'=>"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d54304.041849078945!2d35.75720053900566!3d31.715823540861276!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151cacd00bad3bc5%3A0x4d6d5834c1003e2b!2sMadaba!5e0!3m2!1sen!2sjo!4v1717366500441!5m2!1sen!2sjo"],
            ['id' => 6, 'city_name' => 'Salt', 'created_at' => $now, 'updated_at' => $now , 'crs'=>"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d108235.59116194712!2d35.64361087794553!3d32.03238558991176!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151cbd5c659cb8a7%3A0x31d4c6ecaa51cc1e!2sAs-Salt!5e0!3m2!1sen!2sjo!4v1717366532700!5m2!1sen!2sjo"],
            ['id' => 7, 'city_name' => 'Jerash', 'created_at' => $now, 'updated_at' => $now , 'crs'=>"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d108235.59116194712!2d35.64361087794553!3d32.03238558991176!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151c802ff49ac08d%3A0x876c24b1cbded302!2sJerash!5e0!3m2!1sen!2sjo!4v1717366557391!5m2!1sen!2sjo"],
            ['id' => 8, 'city_name' => 'Ajloun', 'created_at' => $now, 'updated_at' => $now , 'crs'=>"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d53934.255778553634!2d35.72604904567195!3d32.34163602287306!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151c87da460049bd%3A0x3fbf8443e03b269a!2sAjloun!5e0!3m2!1sen!2sjo!4v1717366731454!5m2!1sen!2sjo"],
            ['id' => 9, 'city_name' => 'Mafraq', 'created_at' => $now, 'updated_at' => $now , 'crs'=>"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d53935.030082416844!2d36.18157299565796!3d32.34033692405783!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151b977ffa02fd03%3A0xd3cb20415778c2be!2sAl-Mafraq!5e0!3m2!1sen!2sjo!4v1717366770565!5m2!1sen!2sjo"],
            ['id' => 10, 'city_name' => 'Karak', 'created_at' => $now, 'updated_at' => $now , 'crs'=>"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d109223.41766172368!2d35.61252329181205!3d31.186585562299864!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15037a1f8e1a87a9%3A0x98bd1406f49b95d4!2sKerak!5e0!3m2!1sen!2sjo!4v1717366802541!5m2!1sen!2sjo"],
            ['id' => 11, 'city_name' => 'Ma\'an', 'created_at' => $now, 'updated_at' => $now , 'crs'=>"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d220645.50643286668!2d35.52202894960711!3d30.22036035017124!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x150146193b84e079%3A0xc9ed1d8a38192b48!2sMa&#39;an!5e0!3m2!1sen!2sjo!4v1717366825886!5m2!1sen!2sjo"],
            ['id' => 12, 'city_name' => 'Tafila', 'created_at' => $now, 'updated_at' => $now , 'crs'=>"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d109658.65986546743!2d35.51044667592153!3d30.80731383172476!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x150394e1c14b940f%3A0x752145b98f9b9708!2sAt-Tafilah!5e0!3m2!1sen!2sjo!4v1717366700207!5m2!1sen!2sjo"],
            ['id' => 13, 'city_name' => 'Petra', 'created_at' => $now, 'updated_at' => $now , 'crs'=>"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3443.7911099261332!2d35.44178727507228!3d30.328459005059287!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15016ef1703b6071%3A0x199bf908679a2291!2sPetra!5e0!3m2!1sen!2sjo!4v1717366667126!5m2!1sen!2sjo"],
            ['id' => 14, 'city_name' => 'Sweimah (Dead Sea)', 'created_at' => $now, 'updated_at' => $now , 'crs'=>"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13568.66279073111!2d35.5880708499137!3d31.765966329187147!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15034acfdeaa52d7%3A0x9cfd7d00aa6b7f08!2sSwemeh!5e0!3m2!1sen!2sjo!4v1717366630917!5m2!1sen!2sjo"],
            ['id' => 15, 'city_name' => 'Wadi Rum', 'created_at' => $now, 'updated_at' => $now , 'crs'=>"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d23346.470444263487!2d35.38911139155324!3d29.560820667705148!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x150093a5d3b537b3%3A0xe9885592958b5d07!2sWadi%20Rum%20Protected%20Area!5e0!3m2!1sen!2sjo!4v1717366598734!5m2!1sen!2sjo"],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
