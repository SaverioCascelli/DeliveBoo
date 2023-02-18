<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        //mando in dashboard gli ultimi tre ordini ricevuti
        $latestOrders = Order::orderBy('created_at', 'desc')->where('restaurant_id', Auth::id())->take(3)->get();
        //il totale dei piatti(foods)
        $totalFoods = Food::where('restaurant_id', Auth::id())->count();
        //solo i piatti disponibili(foods)
        $availableFoods = Food::where('restaurant_id', Auth::id())->where('is_available', 0)->count();
        //il ristorante
        $restaurant = Restaurant::where('id', Auth::id())->first();

        return view('admin.home', compact('restaurant', 'latestOrders', 'totalFoods', 'availableFoods'));
    }
}
