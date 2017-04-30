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

    public function getBudgetData()
    {
        return [
            0 => [
                'id'         => '1.01.01.01',
                'name'       => 'DINAS PENDIDIKAN',
                'budget'     => 195705086500,
                'percentage' => 16.6
            ],
            1=> [
                'id'         => '1.02.01.01',
                'name'       => 'DINAS KESEHATAN',
                'budget'     => 37328632300,
                'percentage' => 3.2
            ],
            2=> [
                'id'         => '1.02.01.02',
                'name'       => 'RUMAH SAKIT UMUM PROVINSI',
                'budget'     => 110821800950,
                'percentage' => 9.4
            ],
            3=> [
                'id'         => '1.02.01.03',
                'name'       => 'RUMAH SAKIT JIWA',
                'budget'     => 33155244500,
                'percentage' => 2.8
            ],
        ];
    }
}