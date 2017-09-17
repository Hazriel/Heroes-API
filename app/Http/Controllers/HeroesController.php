<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HeroesController extends Controller
{
    public function view()
    {
        return view('heroes.view');
    }
}
