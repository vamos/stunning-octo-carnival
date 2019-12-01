<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// anchor.centerIn; parent;
// mouse.pressef ? : Qt.darker();
// MouseArea{
//    id anchors.fill: parent;
//    onClicked{}
//}
// Text{
//     anchor.centerIn: parent;
//     text: parent.pocitadlo
//     font.pointSize
// }

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','city','street'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function objednavky(){
        return $this->hasMany(objednavka::class);
    }
}
