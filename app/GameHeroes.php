<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GameHeroes extends Model
{
    protected $fillable = [
        'user_id',
        'heroName',
        'online',
        'ip_address'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function stats()
    {
        return $this->hasMany('App\GameStats', 'heroID');
    }

    public function getTeam()
    {
        $team = 0;
        foreach ($this->stats as $stat)
        {
            if ($stat->statsKey == "c_team")
                $team = $stat->statsValue;
        }
        switch ($team)
        {
            case 1:
                return "national";
            case 2:
                return "royal";
            default:
                return "error_team";
        }
    }

    public function getClass()
    {
        $class = 0;
        foreach ($this->stats as $stat)
        {
            if ($stat->statsKey == "c_kit") {
                $class = $stat->statsValue;
            }
        }
        switch ($class)
        {
            case "0":
                return "commando";
            case "1":
                return "soldier";
            case "2":
                return "gunner";
            default:
                return "error_class";
        }
    }

    public function getStat($stat)
    {
        return GameStats::where('heroID', $this->id)->where('statsKey', $stat)->first()->statsValue;
    }
	
	public function resetStats()
	{
		$faction = $this->getStat('c_team');
		$class = $this->getStat('c_kit');
		$skinColor = $this->getStat('c_skc');
		$hairColor = $this->getStat('c_hrc');
		$hairStyle = $this->getStat('c_hrs');
		$face = $this->getStat('c_ft');
		
		DB::delete('DELETE FROM game_stats WHERE heroID = :id', ['id' => $this->id]);
		
		// Level 30
        GameStats::create([
            'user_id' => Auth::id(),
            'heroID' => $this->id,
            'statsKey' => 'level',
            'statsValue' => 30
        ]);

        // 15 Ability points
        GameStats::create([
            'user_id' => Auth::id(),
            'heroID' => $this->id,
            'statsKey' => 'c_wallet_hero',
            'statsValue' => 15
        ]);

        // Elo 1000
        GameStats::create([
            'user_id' => Auth::id(),
            'heroID' => $this->id,
            'statsKey' => 'elo',
            'statsValue' => 1000
        ]);

        // Faction. 1 = National, 2 = Royal
        GameStats::create([
            'user_id' => Auth::id(),
            'heroID' => $this->id,
            'statsKey' => 'c_team',
            'statsValue' => $faction
        ]);

        // Player Type. 0 = Commando, 1 = Soldier, 2 = Gunner
        GameStats::create([
            'user_id' => Auth::id(),
            'heroID' => $this->id,
            'statsKey' => 'c_kit',
            'statsValue' => $class
        ]);

        // Skin color. 1...9, 1 = darkest, 9 = lighest
        GameStats::create([
            'user_id' => Auth::id(),
            'heroID' => $this->id,
            'statsKey' => 'c_skc',
            'statsValue' => $skinColor
        ]);

        // Hair color. 1...5
        GameStats::create([
            'user_id' => Auth::id(),
            'heroID' => $this->id,
            'statsKey' => 'c_hrc',
            'statsValue' => $hairColor
        ]);

        // Hair Style. 0 = bald, 82...87 some hair
        GameStats::create([
            'user_id' => Auth::id(),
            'heroID' => $this->id,
            'statsKey' => 'c_hrs',
            'statsValue' => $hairStyle
        ]);

        // Facial Hair Style 0 = None, 102...109
        GameStats::create([
            'user_id' => Auth::id(),
            'heroID' => $this->id,
            'statsKey' => 'c_ft',
            'statsValue' => $face
        ]);
	}

    public $timestamps = false;
}
