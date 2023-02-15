<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
