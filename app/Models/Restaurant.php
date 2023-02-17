<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Restaurant extends Model
{
    use HasFactory;


    //interrogazione relazione con user one to one
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //interrogazione con relazione con type many to many
    public function types()
    {
        return $this->belongsToMany(Type::class);
    }

    public function foods()
    {
        return $this->hasMany(Food::class);
    }

    public static function generateSlug($string)
    {
        $slug = Str::slug($string, '-');
        /*
            - salvare lo slug originale
            - controllare se esiste
            - generarne uno con in aggiunta un contataore
            -- se esiste generarne un'altro e così via fino a che se ne trova uno non esistente
        */
        $original_slug = $slug;
        $c = 1;
        $exists = Restaurant::where('slug', $slug)->first();
        while ($exists) {
            $slug = $original_slug . '-' . $c;
            $exists = Restaurant::where('slug', $slug)->first();
            $c++;
        }
        return $slug;
    }
}
