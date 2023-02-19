<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Requests\RestaurantRequest;
use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Type;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $types = Type::all();
        // dd($types);

        return view('auth.register', compact('types'));
    }

    /**e
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100', 'min:2'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:' . User::class],
            'restaurantName' => ['required', 'string', 'min:2', 'max:100'],
            'piva' => ['required', 'string', 'min:11', 'max:11'],
            'address' => ['required', 'string', 'min:10', 'max:100'],
            'types' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        //crea il ristorante con i dati del form
        $formData = $request->all();
        $new_restaurent = new Restaurant();
        $new_restaurent->name = $formData['restaurantName'];
        $new_restaurent->slug = Restaurant::generateSlug($new_restaurent->name);
        $new_restaurent->user_id = $user->id;
        $new_restaurent->VAT = $formData['piva'];
        $new_restaurent->address = $formData['address'];
        $new_restaurent->img_url = 'https://t3.ftcdn.net/jpg/02/06/04/70/360_F_206047084_OxZGQ404N8rocQmItLIQRMRWlQwV3mSH.jpg';
        $new_restaurent->save();
        //associa i ristoranti con le tipologie selezionate nel form
        foreach ($formData['types'] as $type) {
            $type = Type::all()->where('id', (int)$type)->first();
            $new_restaurent->types()->attach($type->id);
        }



        event(new Registered($user));

        Auth::login($user);

        return redirect('admin');
    }
}
