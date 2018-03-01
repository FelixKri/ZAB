<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Klasse extends Model
{
    public function user(){
        return $this->hasMany(User::class);
    }
}
