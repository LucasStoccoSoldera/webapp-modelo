<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    public $table = 'usuario';

    protected $fillable = [
        'nome',
        'login',
        'senha',
    ];

    public $timestamps = false;
}
