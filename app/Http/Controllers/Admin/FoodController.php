<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FoodRequest;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods = Food::all()->where('restaurant_id', Auth::id());
        return view('admin.foods.index', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.foods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FoodRequest $request)
    {
        $form_data = $request->all();
        $form_data['slug'] = Food::generateSlug($form_data['name']);
        //1
        $from_data['restaurant_id'] = Auth::id();

        $new_food = Food::create($form_data);
        $new_food->restaurant_id = Auth::id();
        //dd($new_food);
        $new_food->update();
        return redirect()->route('admin.foods.show', $new_food)
            ->with('message', 'Piatto creato correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food)
    {
        //2 se l'utente non è loggato viene rimbalzato alla index
        if($food->restaurant_id === Auth::id()){
            return view('admin.foods.show', compact('food'));
          }
          return redirect()->route('admin.foods.index');

        //return view('admin.foods.show', compact('food'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Food $food)
    {
        //3 se l'utente non è loggato viene rimbalzato alla index
        if($food->restaurant_id != Auth::id()){
            return redirect()->route('admin.foods.index');
            }
            //qui va l'import dei restaurant types
            return view('admin.foods.edit', compact('food'));

        //return view('admin.foods.edit', compact('food'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FoodRequest $request, Food $food)
    {
        $form_data = $request->all();
        if ($form_data['name'] != $food->name) {
            $form_data['slug'] = Food::generateSlug($form_data['name']);
        } else {
            $form_data['slug'] = $food->slug;
        }
        $food->update($form_data);
        return redirect()->route('admin.foods.show', $food)
            //->with('message', "Il piatto $food->name è stato modificato correttamente")
        ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        $food->delete();
        return redirect()->route('admin.foods.index')
            //->with('deleted', "Il piatto $food->name è stato eliminato correttamente")
        ;
    }
}
