<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vorName','nachName', 'email', 'password', 'isAdmin','canWrite','klasse_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function has_rechnungspos(){
        return $this->hasMany(user_has_rechnungspos::class);
    }
    public function rechnungen(){
        return $this->hasMany(User::class);
    }
    public function klasse(){
        return $this->belongsTo(Klasse::class);
    }
}
