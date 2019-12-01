<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provozna extends Model
{
    //
    protected $table = 'provozna';
    protected $guarded = [
    ];

    // public function nabidka(){
    //     return $this->hasOne(Nabidka_Polozka::class);
    // }
}
