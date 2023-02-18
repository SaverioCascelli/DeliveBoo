<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.orders.index');
    }

    public function statistics()
    {
        return view('admin.orders.statistics');
    }

    public function show(Order $order)
    {
        //2 se l'utente non è loggato viene rimbalzato alla index
        if ($order->restaurant_id === Auth::id()) {
            return view('admin.foods.show', compact('food'));
        }

        return redirect()->route('admin.orders.index');

    }
}
