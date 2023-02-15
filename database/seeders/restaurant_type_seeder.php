<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class restaurant_type_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    //prende i ristoranti e li cicla, per ogni ristorante prende in ordine random tutti i tipi e li associa con numero n di type.
    public function run()
    {

        $restaurants = Restaurant::all();
        foreach ($restaurants as $restaurant) {
            $types = Type::inRandomOrder()->get();
            $randTypesNumber = rand(1, 3);
            for ($i = 0; $i < $randTypesNumber; $i++) {
                $restaurant->types()->attach($types[$i]->id);
            }
        }
    }
}
