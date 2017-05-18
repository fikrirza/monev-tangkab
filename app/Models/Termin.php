<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Termin extends Model
{
    public function realization()
    {
        return $this->belongsTo('App\Models\Realization');
    }
}
