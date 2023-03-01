<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([


            user_table_seeder::class,
            DeliverySeeder::class,
            restaurant_table_seeder::class,
            Typeseeder::class,
            restaurant_type_seeder::class,
            FoodTableSeeder::class,
            OrderTableSeeder::class,
            typeImgSeeder::class,


        ]);
    }
}
