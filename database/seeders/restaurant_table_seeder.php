<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class restaurant_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker  $faker)
    {

        $restaurants = config('restaurants');
        foreach ($restaurants as $key => $restaurant) {
            $newRestaurant = new Restaurant();
            $newRestaurant->user_id = $key + 1;
            $newRestaurant->name = $restaurant['name'];
            $newRestaurant->slug = Restaurant::generateSlug($newRestaurant->name);
            $newRestaurant->VAT = $faker->vat();
            $newRestaurant->address = $faker->streetAddress();
            $newRestaurant->img_url = $restaurant['url'];
            $rand = rand(1, 2);
            if ($rand == 1) {
                $newRestaurant->free_delivery = 1;
            } else {
                $newRestaurant->free_delivery = 0;
            }
            $newRestaurant->save();
        }
    }
}
