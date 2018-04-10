<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grund extends Model
{
    protected $fillable = [
        'name'
    ];

    public function rechnung()
    {
        return $this->belongsToMany(Rechnung::class,'reason_id');
    }
}
