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
            $total = $this->item->sum('total');
            if ($total > 0)
            {
                $nilai = $this->item->sum(function ($item) use($i) {
                    $prop = 'nilai_' . ($i + 1);
                    return $item->realisasi != null ? $item->realisasi->$prop : 0;
                });

                $capaian->push(($nilai / $total) * 100);
            }
            else
            {
                $capaian->push(0);
            }
        }

        return $capaian;
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
