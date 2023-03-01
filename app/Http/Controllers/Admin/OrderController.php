<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Order;
use Carbon\Carbon;
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
        $daysInMonth = getDays();
        $orderInMonth = getOrderPerDay($daysInMonth);

        $monthsInYear = getMonths();
        $ordersInYear = getOrderPerMonth($monthsInYear);
        setlocale(LC_TIME, 'it_IT'); // Set the locale to Italian
        $monthNames = array_map(function ($month) {
            return ucfirst(Carbon::create(null, $month, null)->locale('it_IT')->monthName);
        }, $monthsInYear);

        return view('admin.orders.statistics', compact('daysInMonth', 'orderInMonth', 'monthNames', 'ordersInYear'));
    }
}
function getDays()
{
    $today = Carbon::today();
    $startOfMonth = $today->copy()->startOfMonth()->startOfDay();;
    $endOfMonth = $startOfMonth->copy()->endOfMonth();

    $start_time = $startOfMonth->format('Y-m-d H:i:s');
    $end_time = $endOfMonth->format('Y-m-d H:i:s');
    $days = Order::where('restaurant_id', Auth::id())->selectRaw('DAY(created_at) as day')
        ->whereBetween('created_at', [$start_time, $end_time])
        ->groupBy('day')
        ->pluck('day')
        ->toArray();

    return $days;
}

function getOrderPerDay($days)
{

    $ordersPerDay = [];

    foreach ($days as $key => $day) {
        $startDay =  Carbon::today()->setDay($day)->format('Y-m-d H:i:s');
        $endDay = Carbon::today()->setDay($day)->endOfDay()->format('Y-m-d H:i:s');
        $orders = Order::where('restaurant_id', Auth::id())
            ->whereBetween('created_at', [$startDay, $endDay])
            ->get();
        $ordersPerDay[$key] = 0;
        foreach ($orders as  $order) {
            $ordersPerDay[$key] += $order->total_price;
        }
        $ordersPerDay[$key] = (int)$ordersPerDay[$key];
    }

    return $ordersPerDay;
}

function getMonths()
{

    $today = Carbon::today();
    $startOfYear = $today->copy()->startOfYear();;
    $endOfYear = $startOfYear->copy()->endOfYear();

    $start_time = $startOfYear->format('Y-m-d H:i:s');
    $end_time = $endOfYear->format('Y-m-d H:i:s');


    $months = Order::where('restaurant_id', Auth::id())->selectRaw('MONTH(created_at) as month')
        ->whereBetween('created_at', [$start_time, $end_time])
        ->groupBy('month')
        ->pluck('month')
        ->toArray();

    return $months;
}

function getOrderPerMonth($months)
{

    $totalPerMonth = [];

    foreach ($months as $key => $month) {

        $startMonth =  Carbon::today()->setMonth($month)->startOfMonth()->format('Y-m-d H:i:s');
        $endMonth = Carbon::today()->setMonth($month)->endOfMonth()->format('Y-m-d H:i:s');

        $orders = Order::where('restaurant_id', Auth::id())
            ->whereBetween('created_at', [$startMonth, $endMonth])
            ->get();

        $totalPerMonth[$key] = 0;
        foreach ($orders as  $order) {
            $totalPerMonth[$key] += $order->total_price;
        }
        $totalPerMonth[$key] = (int)$totalPerMonth[$key];
    }

    return $totalPerMonth;
}
