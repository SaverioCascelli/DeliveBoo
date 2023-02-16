<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['americana', 'araba', 'argentina', 'brasiliana', 'cinese', 'fast-food', 'francese', 'giapponese', 'italiana', 'mediterranea', 'pizza', 'steakhouse'];



        foreach ($types as $type) {
            $new_type = new Type();
            $new_type->name = $type;
            $new_type->slug = Type::generateSlug($new_type->name);
            $new_type->save();
        }
    }
}
