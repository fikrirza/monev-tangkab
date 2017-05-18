<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Request $request, $id)
    {
        // Untuk sementara, data program dan kegiatan ditempatkan di service.
        $service = resolve('Services\Activity');
        $data    = Activity::find($id);
        
        return View('pages.activity.show', [
            'program'  => $data->program,
            'activity' => $data
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
