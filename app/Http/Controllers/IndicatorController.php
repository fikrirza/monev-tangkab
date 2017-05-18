<?php

namespace App\Http\Controllers;

use App\Models\Indicator;
use App\Models\IndicatorResult;
use App\Models\Activity;
use Illuminate\Http\Request;

class IndicatorController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $indicator = Indicator::find($id);
        $activity  = $indicator->activity;

        return View('pages.indicator.edit', [
            'indicator' => $indicator,
            'activity'  => $activity
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'target' => 'required',
            'unit'   => 'required'
        ]);

        $indicator = Indicator::find($id);
        $indicator->target = $request->input('target');
        $indicator->unit   = $request->input('unit');
        $indicator->save();

        $stages = [ 'I', 'II', 'III', 'IV' ];
        $realizations = $request->input('realization');
        for ($i = 0; $i < 4; $i++)
        {
            $result = IndicatorResult::where('indicator_id', $id)->where('stage', $stages[$i])->first();
            $result->value = $realizations[$i];
            $result->save();
        }

        return redirect('kegiatan/' . $indicator->activity->id)->with(['success' => true]);
    }
}
