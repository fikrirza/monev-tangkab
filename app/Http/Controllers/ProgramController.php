<?php

namespace App\Http\Controllers;

use App\Models\Skpd;
use App\Models\Program;
use App\Models\ProgramResult;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
        $default = null;
        if (Auth::check())
        {
            $default = Auth::user()->skpd_id;
        }

        $data = null;
        $skpd = $request->input('skpd', $default);
        if ($skpd == null)
        {
            $data = Program::all();
        }
        else
        {
            $data = Program::onSkpd($skpd)->get();
        }

        return View('pages.program.index', [
            'skpd'     => $skpd != null ? Skpd::find($skpd) : null,
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
        $data    = Program::find($id);
        
        return View('pages.program.show', [
            'program' => $data
        ]);
    }

    public function edit($id)
    {
        $data = Program::find($id);
        return View('pages.program.edit', [
            'program' => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'summary'     => 'required|string',
            'realization' => 'required'
        ]);

        $program = Program::find($id);
        $program->summary = $request->input('summary');
        $program->save();

        $stages = [ 'I', 'II', 'III', 'IV' ];
        $realizations = $request->input('realization');
        for ($i = 0; $i < 4; $i++)
        {
            $result = ProgramResult::where('program_id', $id)->where('stage', $stages[$i])->first();
            $result->value = $realizations[$i];
            $result->save();
        }

        return redirect('program/' . $id)->with(['success' => true]);
    }

    public function destroy($id)
    {
        //
    }
}
