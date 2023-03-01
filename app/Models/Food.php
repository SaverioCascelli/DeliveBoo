<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model

{
    use HasFactory;
    public $table = 'foods';

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity')->withTimestamps();
    }




    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
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
        $exists = Food::where('slug', $slug)->first();
        while ($exists) {
            $slug = $original_slug . '-' . $c;
            $exists = Food::where('slug', $slug)->first();
            $c++;
        }
        return $slug;
    }

    protected $fillable = [
        'name',
        'is_available',
        'price',
        'description',
        'img_url',
        'img_url_original_name',
        'slug',
        'restaurant_id'
    ];
}
