<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rechnungspos extends Model
{
	protected $fillable = [
        'bezeichnung', 'gesamtbetrag', 'bezahlt', 'rechnungs_id'
    ];

    public function rechnung(){
        return $this->belongsTo(Rechnung::class, 'rechnungs_id');
    }

    public function user_has_rechnungspos(){
        return $this->hasMany(user_has_rechnungspos::class);
    }
}
