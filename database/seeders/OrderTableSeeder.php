<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *prende tutti i ristoranti con i relativi foods(menu),
     crea un numero random n di ordini per ristorante
     crea un numero random m di foods da inserire negli ordini
     crea l'ordine con dati fake,
     associa un numero m di piatti all'ordine. calcola il totale e aggiorna la tabella ordine
     * @return void
     */
    public function run(Faker  $faker)
    {
        //prende tutti i ristoranti e li cicla
        $restaurants = Restaurant::with('foods')->get();
        foreach ($restaurants as $restaurant) {
            // prende i piatti del ristorante (foods)
            $restaurantFoods = $restaurant->foods;
            // sceglie un numero random di ordini da associare al ristorante e li cicla
            $randomNumersOfOrders = rand(1, 15);
            for ($i = 0; $i < $randomNumersOfOrders; $i++) {
                // crea un nuovo ordine
                $new_order = new Order();
                $new_order->customer_name = $faker->firstName();
                $new_order->customer_surname = $faker->lastName();
                $new_order->customer_address = $faker->streetAddress();
                $new_order->customer_mail = $faker->email();
                $new_order->customer_phone_number = $faker->phoneNumber();
                $new_order->customer_note = $faker->text();
                $new_order->restaurant_id = $restaurant->id;
                $new_order->save();

                $maxItemsInOrder = 5;
                $countFoods = count($restaurantFoods->toArray());
                if ($countFoods > $maxItemsInOrder) {
                    $countFoods = $maxItemsInOrder;
                }
                // sceglie un numero n di indici casuali dall'array dei food e li cicla
                $randomKeysOfFood = array_rand($restaurantFoods->toArray(), rand(2, $countFoods));
                //setta il prezzo totale a 0 per sommarlo man mano
                $totalPrice = 0;
                foreach ($randomKeysOfFood as $key) {
                    //prende il il food con incice random
                    $food = $restaurantFoods[$key];
                    //calcola il totale dell'ordine
                    $quantity = rand(1, 3);
                    $totalPrice += $food->price * $quantity;
                    //crea il collegamento tra food e order settando un quantità casuale
                    $food->orders()->attach($new_order->id, ['quantity' => $quantity]);
                }
                //fa l'update di total price nella tabella order

                if (!($restaurant->free_delivery)) {
                    $food = Food::find(1);
                    $food->orders()->attach($new_order->id);
                    $totalPrice += 5.90;
                } else {

                    $food = Food::find(2);
                    $food->orders()->attach($new_order->id);
                }
                $new_order->total_price = $totalPrice;
                $new_order->update();
            }
        }



        // for ($i = 0; $i < $randNumberOfOrders; $i++) {

        //     $new_order = new Order();

        //     $new_order->total_price = 140.22;
        //     $new_order->customer_name = 'Nome';
        //     $new_order->customer_surname = 'Cognome';
        //     $new_order->customer_address = 'Indirizzo';
        //     $new_order->customer_mail = 'mb@gmail.com';
        //     $new_order->customer_phone_number = '3337777777';
        //     $new_order->customer_note = 'prova';
        //     $new_order->save();
        // }
        //io metterei l'order number

    }
}
