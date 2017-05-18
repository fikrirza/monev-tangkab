<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public $incrementing = false;
    
    public function program()
    {
        return $this->belongsTo('App\Models\Program');
    }

    public function indicators()
    {
        return $this->hasMany('App\Models\Indicator');
    }

    public function results()
    {
        return $this->hasMany('App\Models\ActivityResult');
    }

    public function executors()
    {
        return $this->hasMany('App\Models\Executor');
    }
}
