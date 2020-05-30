<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerData extends Model
{
    protected $table = 'highCardPlays';

    protected $fillable = [
        'name', 'userScore', 'compScore', 'userWon'
    ];
}
