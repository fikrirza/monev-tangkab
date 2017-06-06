<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    protected $table = 'indikator';

    public function kegiatan()
    {
        return $this->belongsTo('App\Models\Kegiatan');
    }

    public function getNilaiAttribute()
    {
        $nilai = collect([]);
        for ($i = 0; $i < 4; $i++)
        {
            $nilai->push($this->attributes['nilai_' . ($i + 1)]);
        }

        return $nilai;
    }

    public function setNilaiAttribute($nilai)
    {
        if (count($nilai) >= 4)
        {
            for($i = 0; $i < 4; $i++)
            {
                $this->attributes['nilai_' . ($i + 1)] = $nilai[$i];
            }
        }
    }
}
