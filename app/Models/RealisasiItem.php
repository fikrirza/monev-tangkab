<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RealisasiItem extends Model
{
    protected $table = 'realisasi_item';
    
    public function item()
    {
        $this->belongsTo('App\Models\ItemKegiatan');
    }
}
