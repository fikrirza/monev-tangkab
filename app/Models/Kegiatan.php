<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';

    public function program()
    {
        return $this->belongsTo('App\Models\Program');
    }

    public function item()
    {
        return $this->hasMany('App\Models\ItemKegiatan');
    }

    public function indikator()
    {
        return $this->hasMany('App\Models\Indikator');
    }
}
