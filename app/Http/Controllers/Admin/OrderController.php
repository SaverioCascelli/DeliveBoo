<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {

        //mando in dashboard gli ultimi tre ordini ricevuti
        $orders = Order::with(['foods'])->orderBy('created_at', 'desc')->where('restaurant_id', Auth::id())->paginate(4);




        return view('admin.orders.index', compact('orders'));
    }

    public function statistics()
    {
        return view('admin.orders.statistics');
    }

    // public function show(Order $order)
    // {
    //     //2 se l'utente non è loggato viene rimbalzato alla index
    //     if ($order->restaurant_id === Auth::id()) {
    //         return view('admin.foods.show', compact('order'));
    //     }

    //     return redirect()->route('admin.orders.index');

    // }
}
