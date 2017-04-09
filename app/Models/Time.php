<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $table = 'times';
    public $timestamps = false;

    protected $fillable = ['name','country'];

    public function jogos(){
        return $this->hasMany(Jogo::class);
    }

}
