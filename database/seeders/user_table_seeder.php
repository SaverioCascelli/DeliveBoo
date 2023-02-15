<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class user_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $resturants_arr = config('restaurants');

        // creo tanti user quanti ristoranti nel file config. esempio di user  per il login
        // username: user1
        // mail : user1@test.it
        // pass: sdfsdfsdf
        foreach ($resturants_arr as $key => $restaurant) {
            $newUser = new User();
            // do nome allo user in base al suo id
            $newUser->name = 'user' . $key + 1;
            // email fittizia es: user1@test.it  viene creata per ogni user
            $newUser->email = $newUser->name .  '@test.it';
            //assegna ad ogni user la stessa pass criptata : sdfsdfsdf.
            $newUser->password = '$2y$10$IEkOF11MIAP6a1l0BYeykObIc96EqWuur2tudzzHStc49P2L3G9Mi';
            $newUser->save();
        }
    }
}
