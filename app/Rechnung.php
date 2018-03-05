<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rechnung extends Model
{
	protected $fillable = [
        'reason', 'abrechner_id'
    ];

    public function rechnungspos(){
        return $this->hasMany(Rechnungspos::class);
    }
    public function abrechner(){
        return $this->belongsTo(User::class);
    }
}
