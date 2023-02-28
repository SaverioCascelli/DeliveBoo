<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Order;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        //mando in dashboard gli ultimi tre ordini ricevuti
        $latestOrders = Order::orderBy('created_at', 'desc')->where('restaurant_id', Auth::id())->take(4)->get();
        //il totale dei piatti(foods)
        $totalFoods = Food::where('restaurant_id', Auth::id())->count();
        //solo i piatti disponibili(foods)
        $availableFoods = Food::where('restaurant_id', Auth::id())->where('is_available', 1)->count();
        //il ristorante
        $restaurant = Restaurant::where('id', Auth::id())->first();

        $ordersHours = getHours();
        $orderByHour = [];
        $today = Carbon::today();

        foreach ($ordersHours as $key => $hour) {
            $start_time = $today->copy()->setHour($hour)->setMinute(0)->setSecond(0)->format('Y-m-d H:i:s');
            $end_time = $today->copy()->setHour($hour)->setMinute(59)->setSecond(59)->format('Y-m-d H:i:s');

            $orderByHour[$key] = Order::where('restaurant_id', Auth::id())->whereBetween('created_at', [$start_time, $end_time])->get();

            $orderByHour[$key] = getTotalAmount($orderByHour[$key]);
        }
        foreach ($ordersHours as $key => $hour) {
            $ordersHours[$key] = $hour . ':00';
        }
        // dd($ordersHours);

        return view('admin.home', compact('restaurant', 'latestOrders', 'totalFoods', 'availableFoods', 'orderByHour', 'ordersHours'));
    }
}
function getOrdersBtwHour($_start_hour, $_end_hour)
{

    $startDate = Carbon::today()->startOfDay()->addHours($_start_hour);
    $endDate = Carbon::today()->startOfDay()->addHours($_end_hour);
    $records = Order::where('restaurant_id', Auth::id())
        ->whereBetween('created_at', [$startDate, $endDate])
        ->get();
    return $records;
}

function getHours()
{
    $today = Carbon::today();
    $records = Order::where('restaurant_id', Auth::id())->selectRaw('HOUR(created_at) as hour')
        ->whereDate('created_at', $today)
        ->groupBy('hour')
        ->pluck('hour')
        ->toArray();

    return $records;
}

function getTotalAmount($_order_array)
{
    $total = 0;
    foreach ($_order_array as $key => $order) {
        $total += $order->total_price;
    }
    return $total;
}
