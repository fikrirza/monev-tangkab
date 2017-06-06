<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'program';

    public function skpd()
    {
        return $this->belongsTo('App\Models\Skpd');
    }

    public function kegiatan()
    {
        return $this->hasMany('App\Models\Kegiatan');
    }

    public function item()
    {
        return $this->hasManyThrough(
            'App\Models\ItemKegiatan', 
            'App\Models\Kegiatan'
        );
    }

    public function getCapaianAttribute()
    {
        $capaian = collect([]);
        for ($i = 0; $i < 4; $i++)
        {
            $capaian->push($this->attributes['nilai_' . ($i + 1)]);
        }

        return $capaian;
    }

    public function setCapaianAttribute($capaian)
    {
        if (count($capaian) >= 4)
        {
            for($i = 0; $i < 4; $i++)
            {
                $this->attributes['nilai_' . ($i + 1)] = $capaian[$i];
            }
        }
    }

    public function getUraianAttribute()
    {
        return 'Terpenuhinya ' . $this->attributes['nama'];
    }
}
