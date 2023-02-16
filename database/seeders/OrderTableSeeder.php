<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurants = Restaurant::with('foods')->get();
        foreach ($restaurants as $restaurant) {
            file_put_contents('dump.json', $restaurant['foods']);
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
