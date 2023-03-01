<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\FoodRequest;
use App\Mail\ClientMail;
use App\Mail\RestaurantMail;
use App\Mail\TestMail;
use App\Models\Food;
use App\Models\Lead;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\PaymentRequest;


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

            // $res = $request->transaction->status;

            $orderJson = $data['cart'];
            // $order = $orderJson->json();

            $orderJson = stripslashes(html_entity_decode($orderJson));
            $order = json_decode($orderJson);

            $totalPrice = getTotalPrice($order);
            if ($data['note']) {
                $note = $data['note'];
            } else {
                $note = 'Nessuna nota';
            }
            $name = $data['name'];
            $surname = $data['surname'];
            $email = $data['email'];
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

            $restaurant = Restaurant::find($restaurantId);

            $user = User::find($restaurantId);
            if (!($restaurant->free_delivery)) {
                $totalPrice += 5.90;
            }

            $nonceFromTheClient = $request['nonce'];
            $braintreeResult = $gateway->transaction()->sale([
                'amount' => $totalPrice,
                'paymentMethodNonce' => $nonceFromTheClient,
                'options' => [
                    'submitForSettlement' => True
                ],
                'customer' => [
                    'company' => $user->name,
                    'email' => $user->email
                ],
                'billing' => [
                    'firstName' => $name,
                    'lastName' => $surname,
                    'streetAddress' => $address,
                ],
            ]);
            $status = $braintreeResult->transaction->status;


            $newOrder->total_price = $totalPrice;
            // $newOrder->save();

            if ($status == 'submitted_for_settlement') {
                $newOrder->save();
            }
            foreach ($order as $item) {
                $food = Food::find($item->id);
                $food->orders()->attach($newOrder->id, ['quantity' => $item->quantity]);
            }
            if (!($restaurant->free_delivery)) {

                $food = Food::find(1);
                $food->orders()->attach($newOrder->id);
            } else {

                $food = Food::find(2);
                $food->orders()->attach($newOrder->id);
            }

            $order = Order::with('foods')->find($newOrder->id);
            $lead = new Lead();
            $lead->address = $address;
            $lead->name = $name;
            $lead->surname = $surname;
            $lead->totalPrice = $totalPrice;
            $lead->order = $order;
            $lead->restaurantName = $restaurant->name;
            $lead->restaurantAddress = $restaurant->address;
            $lead->phoneNumber = $phoneNumber;
            // file_put_contents('dimp.txt', $lead);

            $status = $braintreeResult->transaction->status;
            if ($status == 'submitted_for_settlement') {
                Mail::to($user->email)->send(new RestaurantMail($lead));
                Mail::to($email)->send(new ClientMail($lead));
            }
            return response()->json(compact('status'));
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
