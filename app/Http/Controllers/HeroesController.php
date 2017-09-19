<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\GameHeroes;

class HeroesController extends Controller
{
    public function view()
    {
        return view('heroes.view');
    }

    public function isHeroNameAvailable()
    {
        if(GameHeroes::where('heroName', Input::get('heroName'))->exists())
            return 'This hero name is already taken.';
    }

    public function createForm()
    {
        return view('heroes.create');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'nameCharacterText' => 'required|regex:/^([a-zA-Z0-9.?\-_]*)$/'
        ]);

        return redirect()->route('heroes.view')->withSuccess('You have successfully created a hero.');
    }
}
