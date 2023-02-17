<?php

namespace App\Http\Controllers\Auth;

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
            'name' => ['required', 'string', 'max:255', 'min:2'],
            'restaurantName' => ['required', 'string', 'min:2', 'max:255'],
            'address' => ['required', 'string', 'min:10', 'max:100'],
            'piva' => ['required', 'string', 'min:11', 'max:11'],
            'types' => ['required'],
            'email' => ['required', 'string', 'email', 'min:8', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $formData = $request->all();
        $new_restaurent = new Restaurant();
        $new_restaurent->name = $formData['restaurantName'];
        $new_restaurent->slug = Restaurant::generateSlug($new_restaurent->name);
        $new_restaurent->user_id = $user->id;
        $new_restaurent->VAT = $formData['piva'];
        $new_restaurent->address = $formData['address'];
        $new_restaurent->save();
        foreach ($formData['types'] as $type) {
            $type = Type::all()->where('id', (int)$type)->first();
            $new_restaurent->types()->attach($type->id);
        }



        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
