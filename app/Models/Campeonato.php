<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campeonato extends Model
{
    protected $table = 'campeonatos';
    public $timestamps = false;
    protected $fillable = ['name'];


    public function jogos(){
        return $this->hasMany(Jogo::class);
    }

}
