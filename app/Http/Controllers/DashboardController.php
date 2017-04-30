<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data statistik realisasi dari service statistic
        $service = resolve('Services\Statistic');
        $data    = $service->getRealizationData();

        return View('dashboard', [
            'target'      => $data['target'],
            'realization' => $data['realization']
        ]);
    }
}
