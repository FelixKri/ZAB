<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Klasse extends Model
{
    protected $fillable = [
        'name'
    ];
    public function user(){
        return $this->hasMany(User::class);
    }
}
