<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Skpd;
use App\Models\Program;

class RealisasiController extends Controller
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

    public function show($id)
    {
        //
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

    public function laporan(Request $request)
    {
        $user     = Auth::user();
        $skpd     = Skpd::find($request->input('skpd', $user->skpd_id));
        $programs = $skpd == null ? Program::all() : Program::where('skpd_id', $skpd->id)->get();

        $request->flash();
        return View('pages.laporan.triwulan', [
            'skpd'     => $skpd,
            'programs' => $programs
        ]);
    }
}
