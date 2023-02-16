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

    //prende i ristoranti e li cicla, per ogni ristorante prende in ordine random tutti i tipi e ne associa con numero n di type.
    public function run()
    {

        $restaurants = Restaurant::all();
        foreach ($restaurants as $restaurant) {
            // prende i tipi in ordine random
            $types = Type::inRandomOrder()->get();
            // un numero random tra 1 e 3
            $randNumberOfTypes = rand(1, 3);
            // ciclo un numero n di volte e attacco n tipi al ristorante
            for ($i = 0; $i < $randNumberOfTypes; $i++) {
                //  prende un ristorante e gli attacca l'id del tipo in random order
                $restaurant->types()->attach($types[$i]->id);
            }
        }
    }
}
