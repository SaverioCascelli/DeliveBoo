<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;
    public function foods()
    {
        return $this->belongsToMany(Food::class)->withPivot('quantity');
    }
    public function orderBetweenTime($_hour_start, $_hour_end)
    {
        $startDate = Carbon::today()->startOfDay()->addHours($_hour_start);
        $endDate = Carbon::today()->startOfDay()->addHours($_hour_end);
        $records = Order::where('restaurant_id', Auth::id())
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();
        return $records;
    }
}
