<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\Order;
use App\Models\Restaurant;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class CustomOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $period = new DatePeriod(
            new DateTime('2023-01-01'),
            new DateInterval('P1D'),
            new DateTime('2023-12-31'),
        );
        $restaurant = Restaurant::find(3);
        $restaurantFoods = $restaurant->foods;
        // $hourArr = ['12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23'];
        $hourArr = ['12', '13', '14', '15',  '20', '21', '22', '23'];

        foreach ($period as $key => $date) {

            // file_put_contents('dump.txt', $date->format('Y-m-d') . ' ' . $hourArr[$key] . ':01:01');
            foreach ($hourArr as $key => $hour) {
                $randOrderPerHour = rand(0, 5);
                $date = date_create($date->format('Y-m-d') . ' ' . $hourArr[$key] . ':01:01');

                for ($i = 0; $i < $randOrderPerHour; $i++) {

                    $new_order = new Order();
                    $new_order->customer_name = $faker->firstName();
                    $new_order->customer_surname = $faker->lastName();
                    $new_order->customer_address = $faker->streetAddress();
                    $new_order->customer_mail = $faker->email();
                    $new_order->customer_phone_number = $faker->phoneNumber();
                    $new_order->customer_note = $faker->text();
                    $new_order->restaurant_id = $restaurant->id;
                    $new_order->save();
                    $new_order->created_at = $date;
                    $new_order->update();

                    $randomKeysOfFood = array_rand($restaurantFoods->toArray(), rand(2, 5));
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
        }


        // foreach ($hourArr as $key => $hour) {
        //     $randOrderPerHour = rand(1, 10);
        //     $date = date_create('2023-02-027 ' . $hourArr[$key] . ':01:01');

        //     for ($i = 0; $i < $randOrderPerHour; $i++) {

        //         $new_order = new Order();
        //         $new_order->customer_name = $faker->firstName();
        //         $new_order->customer_surname = $faker->lastName();
        //         $new_order->customer_address = $faker->streetAddress();
        //         $new_order->customer_mail = $faker->email();
        //         $new_order->customer_phone_number = $faker->phoneNumber();
        //         $new_order->customer_note = $faker->text();
        //         $new_order->restaurant_id = $restaurant->id;
        //         $new_order->save();
        //         $new_order->created_at = $date;
        //         $new_order->update();

        //         $randomKeysOfFood = array_rand($restaurantFoods->toArray(), rand(2, 5));
        //         //setta il prezzo totale a 0 per sommarlo man mano
        //         $totalPrice = 0;
        //         foreach ($randomKeysOfFood as $key) {
        //             //prende il il food con incice random
        //             $food = $restaurantFoods[$key];
        //             //calcola il totale dell'ordine
        //             $totalPrice += $food->price;
        //             //crea il collegamento tra food e order settando un quantità casuale
        //             $food->orders()->attach($new_order->id, ['quantity' => rand(1, 3)]);
        //         }
        //         //fa l'update di total price nella tabella order
        //         $new_order->total_price = $totalPrice;
        //         $new_order->update();
        //     }
        // }
        // file_put_contents('dump.txt', date_format($date, "Y/m/d H:i:s"));
    }
}
