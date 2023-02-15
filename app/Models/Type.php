<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    //interrogazione relazione con restaurants many to many
    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class);
    }
}
