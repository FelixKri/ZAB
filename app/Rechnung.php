<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rechnung extends Model
{
	protected $fillable = [
        'reason_id', 'abrechner_id'
    ];

    public function rechnungspos(){
        return $this->hasMany(Rechnungspos::class, 'rechnungs_id');
    }
    public function abrechner(){
        return $this->belongsTo(User::class);
    }
    public function grund(){
        return $this->hasOne(Grund::class, "id");
    }
}
