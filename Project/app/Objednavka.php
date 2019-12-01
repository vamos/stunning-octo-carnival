<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objednavka extends Model
{
    //
    protected $table = 'objednavka';
    protected $guarded = [];
    //Through table objednavka_polozka searches for polozka which belongs to objednavka + gives back the pocet atribute
    //from objednavka_polozka
    protected function polozka(){
       return $this->belongsToMany(Polozka::class,'objednavka_polozka')->withPivot('pocet');
    }

    protected function uzivatel(){
        return $this->belongsTo(User::class);
    }
}
