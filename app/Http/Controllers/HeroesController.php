<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\GameHeroes;
use App\GameStats;

class HeroesController extends Controller
{
    public function view()
    {
        return view('heroes.view');
    }

    public function isHeroNameAvailable()
    {
        if (GameHeroes::where('heroName', Input::get('heroName'))->exists())
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
		
		if (Input::get('baseMSGPersonaClassStats') == '0')
			return redirect()->back()->withErrors("This fucking trash class is not allowed in this server, get cancer.");

        if (GameHeroes::where('user_id', Auth::id())->count() > 12)
            return redirect()->route('heroes.view')->withErrors('You have too many heroes.');

        $hero = GameHeroes::create([
            'user_id' => Auth::id(),
            'heroName' => Input::get('nameCharacterText'),
            'online' => 0,
            'ip_address' => request()->ip()
        ]);

        // Level 1
        GameStats::create([
            'user_id' => Auth::id(),
            'heroID' => $hero->id,
            'statsKey' => 'level',
            'statsValue' => 30
        ]);

        // 15 Ability points
        GameStats::create([
            'user_id' => Auth::id(),
            'heroID' => $hero->id,
            'statsKey' => 'c_wallet_hero',
            'statsValue' => 15
        ]);

        // Elo 1000
        GameStats::create([
            'user_id' => Auth::id(),
            'heroID' => $hero->id,
            'statsKey' => 'elo',
            'statsValue' => 1000
        ]);

        // Faction. 1 = National, 2 = Royal
        GameStats::create([
            'user_id' => Auth::id(),
            'heroID' => $hero->id,
            'statsKey' => 'c_team',
            'statsValue' => Input::get('baseMSGFactionStats')
        ]);

        // Player Type. 0 = Commando, 1 = Soldier, 2 = Gunner
        GameStats::create([
            'user_id' => Auth::id(),
            'heroID' => $hero->id,
            'statsKey' => 'c_kit',
            'statsValue' => Input::get('baseMSGPersonaClassStats')
        ]);

        // Skin color. 1...9, 1 = darkest, 9 = lighest
        GameStats::create([
            'user_id' => Auth::id(),
            'heroID' => $hero->id,
            'statsKey' => 'c_skc',
            'statsValue' => Input::get('baseMSGAppearanceSkinToneStats')
        ]);

        // Hair color. 1...5
        GameStats::create([
            'user_id' => Auth::id(),
            'heroID' => $hero->id,
            'statsKey' => 'c_hrc',
            'statsValue' => Input::get('haircolor_ui_name')
        ]);

        // Hair Style. 0 = bald, 82...87 some hair
        GameStats::create([
            'user_id' => Auth::id(),
            'heroID' => $hero->id,
            'statsKey' => 'c_hrs',
            'statsValue' => Input::get('baseMSGAppearanceHairStyleStats')
        ]);

        // Facial Hair Style 0 = None, 102...109
        GameStats::create([
            'user_id' => Auth::id(),
            'heroID' => $hero->id,
            'statsKey' => 'c_ft',
            'statsValue' => Input::get('facial_ui_name')
        ]);

        return redirect()->route('heroes.view')->withSuccess('You have successfully created a hero.');
    }

    public function abilities()
    {
        $userId = Auth::user()->id;
        DB::update('UPDATE game_stats SET statsValue = \'\' WHERE statsKey = \'c_items\' AND user_id = :id', ['id' => $userId]);
        DB::update('UPDATE game_stats SET statsValue = \'15\' WHERE statsKey = \'c_wallet_hero\' AND user_id = :id', ['id' => $userId]);

        return redirect()->back()->withSuccess("Your abilities were successfully refreshed !");
    }
}
