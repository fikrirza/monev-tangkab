<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        // Untuk sementara, data program dan kegiatan ditempatkan di service.
        $service = resolve('Services\Activity');
        $data    = $service->getProgramData();
        
        return View('pages.program.index', [
            'programs' => $data
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        // Untuk sementara, data program dan kegiatan ditempatkan di service.
        $service = resolve('Services\Activity');
        $data    = $service->getProgramData();
        
        return View('pages.program.show', [
            'program' => $data[0]
        ]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
