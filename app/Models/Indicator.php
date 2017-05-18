<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    public function activity()
    {
        return $this->belongsTo('App\Models\Activity');
    }

    public function results()
    {
        return $this->hasMany('App\Models\IndicatorResult');
    }
}
