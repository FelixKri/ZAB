<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rechnungspos extends Model
{
    public function rechnungskopf(){
        return $this->belongsTo(Rechnung::class);
    }

    public function user_has_rechnungspos(){
        return $this->hasMany(user_has_rechnungspos::class);
    }
}
