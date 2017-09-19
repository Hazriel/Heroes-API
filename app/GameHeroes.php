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

    public $timestamps = false;
}
