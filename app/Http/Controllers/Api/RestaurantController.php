<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        $types = Type::all();
        $foods = Food::all();
        $restaurants = Restaurant::with(['types', 'foods', 'user'])->get();
        //dd($restaurants);
        return response()->json(compact('restaurants', 'types', 'foods'));
    }


    public function getByType()
    {
        $typeIds = [];
        $restaurants = Restaurant::whereHas('types', function ($query) use ($typeIds) {
            $query->whereIn('id', $typeIds);
        }, '>', count($typeIds) - 1)->get();
        return response()->json(compact('restaurants'));
    }
}
