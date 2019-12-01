<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nabidka extends Model
{
    //
    protected $table = 'nabidka';
    //Searches for all polozka belonging to nabidka through table nabidka_polozka 
    protected function polozka(){
        return $this->belongsToMany(Polozka::class,'nabidka_polozka');
    }
}
