<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function getProgramIndex(Request $request)
    {
        // Untuk sementara, data program dan kegiatan ditempatkan di service.
        $service = resolve('Services\Activity');
        $data    = $service->getProgramData();
        

        return View('program', [
            'programs' => $data
        ]);
    }
}
