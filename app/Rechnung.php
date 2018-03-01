<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rechnung extends Model
{
    public function rechnungspos(){
        return $this->hasMany(Rechnungspos::class);
    }
    public function abrechner(){
        return $this->belongsTo(User::class);
    }
}
