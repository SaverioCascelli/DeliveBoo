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
        $restaurants = Restaurant::with(['types', 'foods'])->get();
        //dd($restaurants);
        return response()->json(compact('restaurants', 'types', 'foods'));
    }

    //Query solo per tipologia
    /*
    public function getByType()
    {
        $typeIds = [];
        $restaurants = Restaurant::whereHas('types', function ($query) use ($typeIds) {
            $query->whereIn('id', $typeIds);
        }, '>', count($typeIds) - 1)->get();
        return response()->json(compact('restaurants'));
    }
    */

    //Query solo per nome
    /*
    public function search()
    {
        $tosearch = $_GET['tosearch'];
        $restaurants = Restaurant::where('name','like',"%$tosearch%")->with(['types', 'foods', 'user'])->get();

        return response()->json(compact('restaurants'));
    }
    */

    //esegue la ricerca dei ristoranti utilizzando sia il parametro tosearch (parola digitata) che l'array typeIds (una o più tipologie selezionate). La risposta JSON restituita contiene i ristoranti corrispondenti alla ricerca
    public function searchByTypeAndName()
    {
        $typeSlug = [];
        if (isset($_GET['types'])) {
            $typeSlug = explode(',', $_GET['types']);
        }
        $searchInput = $_GET['name'];
        file_put_contents('dump.json', json_encode($searchInput));
        $restaurants = Restaurant::where('slug', 'like', "%$searchInput%")
            ->whereHas('types', function ($query) use ($typeSlug) {
                $query->whereIn('slug', $typeSlug);
            }, '>', count($typeSlug) - 1)
            ->with(['types', 'foods'])
            ->get();
        return response()->json(compact('restaurants'));
    }
}
