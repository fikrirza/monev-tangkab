<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data statistik realisasi dari service statistic
        $service = resolve('Services\Statistic');
        $data    = $service->getBudgetData();

        return View('pages.budget.index', [
            'data' => $data
        ]);
    }
}
