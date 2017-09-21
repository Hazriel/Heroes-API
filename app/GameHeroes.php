<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

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

    public $timestamps = false;
}
