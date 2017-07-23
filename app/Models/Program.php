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
        $debug   = collect([]);
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

    public function getRealisasiAttribute()
    {
        return $this->item->sum(function($item) {
            if ($item->realisasi != null)
            {
                return $item->realisasi->nilai_1 + $item->realisasi->nilai_2 + $item->realisasi->nilai_3 + $item->realisasi->nilai_4;
            }

            return 0;
        });
    }

    public function getFisikAttribute()
    {
        return $this->item->avg(function($item) {
            if ($item->realisasi != null)
            {
                return $item->realisasi->fisik;
            }

            return 0;
        });
    }

    public function getUraianAttribute()
    {
        return 'Terpenuhinya ' . $this->attributes['nama'];
    }
}
