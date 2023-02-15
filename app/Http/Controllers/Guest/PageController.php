<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // funzione che mi ritorna la vista dove è montato vue js
    public function index() {
        return view('guest.home');
    }
}
