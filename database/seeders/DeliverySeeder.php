<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $new_food = new Food();
        $new_food->is_available = 1;
        //crea un numero random in double
        $new_food->price = 5.90;
        //prende le informazioni della ricetta nel file config e le salva nell'istanza food
        $new_food->name = 'Consegna Standard';
        $new_food->slug = Food::generateSlug($new_food->name);
        $new_food->description = 'Consegna standard';
        $new_food->save();
        $new_food = new Food();
        $new_food->is_available = 1;
        //crea un numero random in double
        $new_food->price = 0.00;
        //prende le informazioni della ricetta nel file config e le salva nell'istanza food
        $new_food->name = 'Consegna Gratuita';
        $new_food->slug = Food::generateSlug($new_food->name);
        $new_food->description = 'Consegna Gratuita';
        $new_food->save();
    }
}
