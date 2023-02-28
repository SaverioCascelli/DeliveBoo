<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *cicla tutti i ristoranti, vede la loro tipologia e in base a quello associa un numer n di food(elementi del menu)
     * @return void
     */
    public function run()
    {
        //prende tutti i ristoranti e li cicla
        $restaurants = Restaurant::with(['types'])->get();
        foreach ($restaurants as $restaurant) {
            //estrapol ai tipi del ristorante
            $restaurantTypes = $restaurant['types'];
            // cicla per ogni tipologia di ristorante
            foreach ($restaurantTypes as $type) {

                //prende un array si ricette della tipologia del ristorante. File presente in presente in config
                $foodList = getFoodsListByType($type->name);

                //mischia l'array per utilizzare gli stessi dati
                shuffle($foodList);

                //vede quanti elementi esistono nell'array delle ricette
                $itemsInFoodList = count($foodList);

                //sceglie quante ricette inserire nel ristorante
                $randNumerOfRecipies = rand(4, $itemsInFoodList);

                //cicla in base a quante ricette inserire
                for ($i = 0; $i < $randNumerOfRecipies; $i++) {

                    //crea la nuova istanza food e la salva nel db
                    $new_food = new Food();
                    $new_food->is_available = rand(0, 1);
                    //crea un numero random in double
                    $new_food->price = rand(500, 2000) / 100;
                    $new_food->restaurant_id = $restaurant->id;
                    //prende le informazioni della ricetta nel file config e le salva nell'istanza food
                    $foodInfo = $foodList[$i];
                    $new_food->name = $foodInfo['name'];
                    $new_food->slug = Food::generateSlug($new_food->name);
                    $new_food->description = $foodInfo['description'];
                    $new_food->img_url = $foodInfo['url'];
                    $new_food->save();
                }
            }
        }
    }
}
// restituisce una lista di ricette della tipologia passata per parametro file presente in config
function getFoodsListByType($_type)
{
    $foodsArr = config('foods');
    return $foodsArr[$_type];
}
