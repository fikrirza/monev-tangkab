<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityResult extends Model
{
    public function activity()
    {
        return $this->belongsTo('App\Models\Activity');
    }
}
