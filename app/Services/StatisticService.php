<?php

namespace App\Services;

class StatisticService 
{
    function __construct()
    {
        
    }

    /**
     * TODO: Fungsi ini memastikan bahwa data realisasi dan target yang dikembalikan selalu memiliki 4 element array untuk 4 triwulan.
     *       Tanpa memerhatikan berapa banyak data yang ada sebenarnya (Data yang belum ada harus memiliki nilai 0)
     */
    public function getRealizationData()
    {
        // Mock data grafik
        $target = [
            'financial' => [25, 38, 80, 100],
            'physical'  => [15, 45, 78, 100]
        ];

        $realization = [
            'financial' => [30, 40, 78, 100],
            'physical'  => [15, 48, 75, 100]
        ];

        return [
            'target'      => $target,
            'realization' => $realization
        ];
    }
}