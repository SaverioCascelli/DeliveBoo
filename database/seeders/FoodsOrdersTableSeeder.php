<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodsOrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $food = Food::inRandomOrder()->first();
            $order_id = Order::inRandomOrder()->first()->id;
            $food->quantity = rand(1, 5);
            $food->orders()->attach($order_id);
        }
    }
}
