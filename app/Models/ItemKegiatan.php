<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemKegiatan extends Model
{
    protected $table = 'item';

    public function kegiatan()
    {
        return $this->belongsTo('App\Models\Kegiatan');
    }
}
