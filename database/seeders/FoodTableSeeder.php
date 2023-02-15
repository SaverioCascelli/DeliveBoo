<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
        public function run()
        {
        //$datatype = ['Italiano','Cinese','Giappo', 'Thai','Libanese','Greco','Pizzeria'];
        $dataname = ['Amatriciana','Sushi','Gricia', 'Ramen','Tatziki','Capricciosa','Pizzeria'];
	    foreach ($dataname as $item) {
            $new_food = new Food();
            $new_food->name = $item;
            //$new_food->slug = Str::slug($item);
            //$new_food->type = 'prova';
            $new_food->is_available = 1;
            $new_food->price = 21.99;
            $new_food->description = 'prova';
            $new_food->save();
        }
    }
}
