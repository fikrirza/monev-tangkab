<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Realization extends Model
{
    public function activity() 
    {
        return $this->belongsTo('App\Models\Activity');
    }
    
    public function termins()
    {
        return $this->hasMany('App\Models\Termin');
    }
}
