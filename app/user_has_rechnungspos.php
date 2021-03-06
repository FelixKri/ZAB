<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_has_rechnungspos extends Model
{
    protected $fillable = [
        'user_id', 'rechnungspos_id', 'bezahlt', 'betrag'
    ];


    public function rechnungspos(){
        return $this->belongsTo(rechnungspos::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
