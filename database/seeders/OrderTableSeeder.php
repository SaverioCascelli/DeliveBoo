<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
        {
        $ordernumber = ['F01','F02','F03', 'F04','F05','F06','F07'];
	    foreach ($ordernumber as $item) {
            $new_order = new Order();
            //io metterei l'order number
            $new_order->receipt = $item;

            $new_order->total_price = 140.22;
            $new_order->customer_name = 'Nome';
            $new_order->customer_surname = 'Cognome';
            $new_order->customer_address = 'Indirizzo';
            $new_order->customer_mail = 'mb@gmail.com';
            $new_order->customer_phone_number = '3337777777';
            $new_order->customer_note = 'prova';
            $new_order->save();
        }
    }
}
