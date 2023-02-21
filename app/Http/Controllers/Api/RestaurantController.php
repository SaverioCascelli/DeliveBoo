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

    //ricerco il ristorante per la show partendo dallo slug e lo mando con i foods
    public function getRestaurant()
    {
        if (isset($_GET['name'])) {
            $searchItem = $_GET['name'];
            $restaurant = Restaurant::with(['foods'])->where('slug', $searchItem)->first();
        }
        return response()->json(compact('restaurant'));
    }

    //esegue la ricerca dei ristoranti utilizzando sia il parametro tosearch (parola digitata) che l'array typeIds (una o più tipologie selezionate). La risposta JSON restituita contiene i ristoranti corrispondenti alla ricerca
    public function searchByTypeAndName()
    {
        //array di slug che viene popolato dal get types
        $typeSlug = [];
        if (isset($_GET['types'])) {
            // se mi arriva types in get allora lo esplodo dalla virgola
            $typeSlug = explode(',', $_GET['types']);
        }
        // stringa name che mi arriva da ricercare
        $searchInput = $_GET['name'];
        //ricerca in base al nome
        $restaurants = Restaurant::where('slug', 'like', "%$searchInput%")
            //ricerca sulla tabella ponte wherehase prender solo ristoranti con più di n relazioni con i tipi e applica una ricerca approfondit con wherein dove confronta lo slug del tipo con quello presente nell'array typeslug
            ->whereHas('types', function ($query) use ($typeSlug) {
                $query->whereIn('slug', $typeSlug);
            }, '>', count($typeSlug) - 1)
            ->with(['types', 'foods'])
            ->get();
        //ritorno il json dei ristoranti trovati
        return response()->json(compact('restaurants'));
    }
}
