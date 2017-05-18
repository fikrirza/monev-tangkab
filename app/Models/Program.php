<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    public $incrementing = false;

    public function scopeOnSkpd($query, $skpd)
    {
        return $query->where('skpd_id', $skpd);
    }

    public function skpd()
    {
        return $this->belongsTo('App\Models\Skpd');
    }

    public function activities()
    {
        return $this->hasMany('App\Models\Activity');
    }

    public function results()
    {
        return $this->hasMany('App\Models\ProgramResult');
    }
}
