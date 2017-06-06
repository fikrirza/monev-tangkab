<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indikator;

class IndikatorController extends Controller
{
    public function edit($id)
    {
        return View('pages.indikator.edit', [
            'indikator' => Indikator::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'target' => 'required',
            'satuan' => 'required',
            'nilai'  => 'required'
        ]);

        $indikator = Indikator::find($id);
        $indikator->target = $request->input('target');
        $indikator->satuan = $request->input('satuan');
        $indikator->nilai  = $request->input('nilai');
        $indikator->save();

        return redirect('kegiatan/' . $indikator->kegiatan->id)->with(['success' => true]);
    }
}
