<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;


class BraintreeController extends Controller
{

    public function getToken()
    {
        $gateway = new \Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'brmn8t5x5dy5qxcq',
            'publicKey' => '5kfpt9t7xcg5nkk2',
            'privateKey' => '641f6b41bbf02806747ef4e9cca79b7d'
        ]);

        $clientToken = $gateway->clientToken()->generate();
        $token = $clientToken;
        return response()->json(compact('token'));
    }


    public function nounce(Request $request)
    {
        $data = $request->all();
        $gateway = new \Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'brmn8t5x5dy5qxcq',
            'publicKey' => '5kfpt9t7xcg5nkk2',
            'privateKey' => '641f6b41bbf02806747ef4e9cca79b7d'
        ]);
        if ($data['nonce'] != null) {

            $orderJson = $data['cart'];
            // $order = $orderJson->json();

            $orderJson = stripslashes(html_entity_decode($orderJson));
            $order = json_decode($orderJson);

            $totalPrice = getTotalPrice($order);

            $name = $data['name'];
            $surname = $data['surname'];
            $email = $data['email'];
            $note = $data['note'];
            $address = $data['address'];
            $phoneNumber = $data['phoneNumber'];
            $newOrder = new Order();
            $newOrder->customer_name = $name;
            $newOrder->customer_surname = $surname;
            $newOrder->customer_address = $address;
            $newOrder->customer_mail = $email;
            $newOrder->customer_phone_number = $phoneNumber;
            $newOrder->customer_note = $note;
            $foods =  foodsFromFoodId($order[0]->id);
            $restaurantId = $foods[0]->restaurant_id;
            $newOrder->restaurant_id = $restaurantId;
            $newOrder->total_price = $totalPrice;
            $newOrder->save();


            foreach ($order as $item) {
                $food = Food::find($item->id);
                $food->orders()->attach($newOrder->id, ['quantity' => $item->quantity]);
            }

            $nonceFromTheClient = $request['nonce'];
            $gateway->transaction()->sale([
                'amount' => $totalPrice,
                'paymentMethodNonce' => $nonceFromTheClient,
                'options' => [
                    'submitForSettlement' => True
                ],
            ]);
        }
    }
}
function getTotalPrice($orderArray)
{
    $totalPrice = 0;

    foreach ($orderArray as $orderItem) {
        $food = Food::find($orderItem->id);
        $totalPrice += $food->price * $orderItem->quantity;
    }
    return $totalPrice;
}

function foodsFromFoodId($foodId)
{

    $food = Food::find($foodId);
    $foods = $food->restaurant->foods;
    return $foods;
}
