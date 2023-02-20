<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FoodRequest;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $foods = Food::where('name', 'like', "%$search%")->where('restaurant_id', Auth::id())->paginate(10);
        } else {
            $foods = Food::where('restaurant_id', Auth::id())->paginate(10);
        }

        //dd($foods);
        return view('admin.foods.index', compact('foods'));
    }


    public function orderby($column, $direction)
    {

        $foods = Food::where('restaurant_id', Auth::id())->orderBy($column, $direction)->paginate(10);

        $btn_active = $column;

        return view('admin.foods.index', compact('foods', 'direction', 'btn_active'));
    }

    public function getAuth()
    {
        $authId = Auth::id();
        return response()->json(compact('authId'));
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
        //$from_data['restaurant_id'] = Auth::id();

        //se è presente il file image lo salvo nel filesystem e nel db, e salvo il nome originale
        if (array_key_exists('img_url', $form_data)) {
            $form_data['img_url_original_name'] = $request->file('img_url')->getClientOriginalName();
            $form_data['img_url'] = Storage::put('uploads', $form_data['img_url']);
        }
        //dd($form_data);

        $new_food = Food::create($form_data);
        $new_food->restaurant_id = Auth::id();

        // se il food non ha l'immagine ne viene caricata una di placeholder
        if ($new_food->img_url == null) {
            $new_food->img_url = 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/681px-Placeholder_view_vector.svg.png';
        }


        $new_food->update();
        //dd($new_food);
        return redirect()->route('admin.foods.show', $new_food)
            ->with('message', 'Il piatto è stato creato correttamente');
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
        if ($food->restaurant_id === Auth::id()) {
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
        if ($food->restaurant_id != Auth::id()) {
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

        //se esiste l'image è possibile cancellarla e rimpiazzarla tramite il form
        if (array_key_exists('img_url', $form_data)) {
            if ($food->img_url) {
                Storage::disk('public')->delete($food->img_url);
            }

            $form_data['img_url_original_name'] = $request->file('img_url')->getClientOriginalName();
            $form_data['img_url'] = Storage::put('uploads', $form_data['img_url']);
        }

        $food->update($form_data);
        return redirect()->route('admin.foods.show', $food)
            ->with('message', "Il piatto è stato modificato correttamente");
    }

    public function toggleAvailable($id)
    {
        $food = Food::where('id', $id)->first();
        $food->is_available = $food->is_available === 1 ? 0 : 1;

        $food->update();
        return redirect()->route('admin.foods.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        //se esiste l'image si può cancellare
        if ($food->img_url) {
            Storage::disk('public')->delete($food->img_url);
        }

        $food->delete();
        return redirect()->route('admin.foods.index')
            ->with('deleted', "Il piatto è stato eliminato correttamente");
    }
}
