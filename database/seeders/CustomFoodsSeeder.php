<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function Database\Seeders\getFoodsListByType as SeedersGetFoodsListByType;

class CustomFoodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurant = Restaurant::find(101);

        $restaurantTypes = $restaurant['types'];

        foreach ($restaurantTypes as $type) {
            $foodList = SeedersGetFoodsListByType($type->name);
            foreach ($foodList as  $food) {

                $new_food = new Food();
                $new_food->is_available = 1;
                //crea un numero random in double
                $new_food->price = rand(500, 2000) / 100;
                $new_food->restaurant_id = $restaurant->id;
                //prende le informazioni della ricetta nel file config e le salva nell'istanza food
                $new_food->name = $food['name'];
                $new_food->slug = Food::generateSlug($new_food->name);
                $new_food->description = $food['description'];
                $new_food->img_url = $food['url'];
                $new_food->save();
            }
        }
    }
}

function getFoodsListByType($_type)
{
    $foodsArr = config('foods');
    return $foodsArr[$_type];
}
