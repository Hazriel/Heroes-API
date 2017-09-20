<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public $timestamps = false;
}
