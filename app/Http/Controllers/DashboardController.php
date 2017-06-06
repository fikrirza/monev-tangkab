<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\ItemKegiatan;
use App\Models\Indikator;

class DashboardController extends Controller
{
    public function index()
    {   
        $errors    = [];
        $program   = [];
        $kegiatan  = [];
        $item      = [];
        $indikator = [];

        try
        {
            $user = Auth::user();
            if ($user == null || $user->skpd_id == null || $user->skpd_id == '1.01.01.00')
            {
                $program   = Program::all();
                $kegiatan  = Kegiatan::all();
                $item      = ItemKegiatan::all();
                $indikator = Indikator::all();
            }
            else
            {
                $program   = Program::where('skpd_id', $user->skpd_id)->get();
                $kegiatan  = Kegiatan::whereHas('program', function($query) use($user) {
                    $query->where('skpd_id', $user->skpd_id);
                })->get();

                $item      = ItemKegiatan::whereHas('kegiatan.program', function($query) use($user) {
                    $query->where('skpd_id', $user->skpd_id);
                })->get();

                $indikator = Indikator::whereHas('kegiatan.program', function($query) use($user) {
                    $query->where('skpd_id', $user->skpd_id);
                })->get();
            }
        }
        catch (\Exception $ex)
        {
            $errors = [ $ex ];
        }
        finally
        {
            return View('pages.dashboard.index', [
                'program'   => $program,
                'kegiatan'  => $kegiatan,
                'item'      => $item,
                'indikator' => $indikator
            ])->with($errors);
        }
    }

    public function migration()
    {
        return View('pages.migrator.index', [
            'service' => resolve('App\Services\MigrationService')
        ]);
    }
}
