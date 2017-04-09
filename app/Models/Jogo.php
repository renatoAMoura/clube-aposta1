<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jogo extends Model
{
    protected $table = 'jogos';
    public $timestamps = false;

    protected $fillable = ['scoreHome','scoreAway'];

    public function Campeonato(){
        return $this->hasOne(Campeonato::class,"id",'competition_id');
    }

    public function TimeHome(){
        return $this->hasOne(Time::class, "id",'home_id');
    }

    public function TimeAway(){
        return $this->hasOne(Time::class, "id",'away_id');
    }
}
