<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skpd extends Model
{
    protected $table = 'skpd';
    public $incrementing = false;

    public function getAnggaranAttribute()
    {
        return $this->kegiatan->sum(function($kegiatan) {
            return $kegiatan->item->sum('total');
        });
    }

    public function getCapaianAttribute()
    {
        $capaian = collect([]);
        for ($i = 0; $i < 4; $i++)
        {
            $capaian->push($this->program->sum(function($program) use($i) {
                return $program->capaian[$i];
            }) / $this->program->count());
        }

        return $capaian;
    }

    public function getRealisasiAttribute()
    {
        $realisasi = collect([]);
        for ($i = 0; $i < 4; $i++)
        {
            $realisasi->push($this->program->sum(function($program) use($i) {
                $prop = 'nilai_' . ($i + 1);
                return $program->item->sum(function($item) use($prop) {
                    return $item->realisasi != null ? $item->realisasi->$prop : 0;
                });
            }));
        }

        return $realisasi;
    }

    public function program()
    {
        return $this->hasMany('App\Models\Program');
    }

    public function kegiatan()
    {
        return $this->hasManyThrough(
            'App\Models\Kegiatan',
            'App\Models\Program'
        );
    }

    public function item()
    {
        $items = collect([]);
        foreach ($this->kegiatan as $kegiatan)
        {
            $items->push($kegiatan->item);
        }

        return $items;
    }
}
