<?php

namespace App\Services;

use App\Models\SimdaApbdBl;
use App\Models\User;
use App\Models\Skpd;
use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\ItemKegiatan;
use App\Models\Indikator;
use DB;

class MigratorService
{
    public function skpd()
    {
        ini_set('max_execution_time', 30000);

        try
        {
            // ---- INSERT UNIQUE SKPD FROM SIMDA TO ADIK ----
            $db       = DB::connection('apbd');
            $skpdData = $db->table('Ref_Sub_Unit')->get();
            $all      = Skpd::all();
            foreach ($skpdData as $key)
            {
                $bidangCode = sprintf('%02d', $key->Kd_Bidang);
                $unitCode   = sprintf('%02d', $key->Kd_Unit);
                $subCode    = sprintf('%02d', $key->Kd_Sub);
                $skpdCode   = implode('.', [ $key->Kd_Urusan, $bidangCode, $unitCode, $subCode ]);
                if (Skpd::find($skpdCode) == null) 
                {
                    $skpd       = new Skpd;
                    $skpd->id   = $skpdCode;
                    $skpd->nama = $key->Nm_Sub_Unit;
                    $skpd->save();
                }
            } 
            // ---- END INSERT UNIQUE SKPD FROM SIMDA TO ADIK ----
        }
        catch (\Exception $ex)
        {
            return $ex->getMessage();
        }

        return 'SUCCESS';
    }

    public function user()
    {
        ini_set('max_execution_time', 30000);

        try
        {
            $skpdData = Skpd::all();
            foreach ($skpdData as $skpd)
            {
                $nama = str_replace(' ', '_', strtolower($skpd->nama));
                User::create([
                    'skpd_id'  => $skpd->id,
                    'username' => $nama,
                    'password' => bcrypt($nama)
                ]);
            }
        }
        catch (\Exception $ex)
        {
            return $ex->getMessage();
        }

        return 'SUCCESS';
    }

    public function program()
    {
        ini_set('max_execution_time', 30000);

        try 
        {
            // ---- INSERT UNIQUE PRORAM FROM SIMDA TO ADIK ----
            $db       = DB::connection('apbd');
            $programs = $db->table('simda_apbd_bl')->get();

            foreach ($programs as $key) 
            {
                $bidangCode  = sprintf('%02d', $key->kd_bidang);
                $programCode = sprintf('%02d', $key->kd_prog);
                $unitCode    = sprintf('%02d', $key->kd_unit);
                $subCode     = sprintf('%02d', $key->kd_sub);
                $rekening    = implode('.', [ $key->kd_urusan, $bidangCode, $programCode ]);
                $skpd        = implode('.', [ $key->kd_urusan, $bidangCode, $unitCode, $subCode ]);

                if (Program::where('rekening', $rekening)->where('nama', $key->ket_program)->count() == 0) 
                {
                    $program           = new Program;
                    $program->rekening = $rekening;
                    $program->skpd_id  = $skpd;
                    $program->nama     = $key->ket_program;
                    $program->nilai_1  = 25;
                    $program->nilai_2  = 50;
                    $program->nilai_3  = 75;
                    $program->nilai_4  = 100;
                    $program->save();
                }
            }
            // ---- END OF INSERT UNIQUE PRORAM FROM SIMDA TO ADIK ----
        }
        catch (\Exception $ex)
        {
            return $ex->getMessage();
        }

        return 'SUCCESS';
    }

    public function kegiatan()
    {
        ini_set('max_execution_time', 30000);

        try 
        {
            // ---- INSERT UNIQUE KEGIATAN FROM SIMDA TO ADIK ----
            $db       = DB::connection('apbd');
            $kegiatan = $db->table('simda_apbd_bl')->get();

            foreach ($kegiatan as $key) 
            {
                $programCode = implode('.', [ $key->kd_urusan, sprintf('%02d', $key->kd_bidang), sprintf('%02d', $key->kd_prog) ]);
                $program     = Program::where('rekening', $programCode)->where('nama', $key->ket_program)->first();
                $kegiatanId  = sprintf('%03d', $key->kd_keg);
                $rekening    = $program->rekening.".".$kegiatanId;

                if (Kegiatan::where('rekening', $rekening)->where('nama', $key->ket_kegiatan)->count() == 0) 
                {
                    $kegiatan = new Kegiatan;
                    $kegiatan->program_id = $program->id;
                    $kegiatan->rekening   = $rekening;
                    $kegiatan->nama       = $key->ket_kegiatan;
                    $kegiatan->save();
                }
            }

            // ---- END INSERT UNIQUE KEGIATAN FROM SIMDA TO ADIK ----
        }
        catch (\Exception $ex)
        {
            return $ex->getMessage();
        }

        return 'SUCCESS';
    }

    public function item()
    {
        ini_set('max_execution_time', 30000);

        try 
        {
            //---- INSERT ITEM KEGIATAN FROM SIMDA TO ADIK ----
            $db    = DB::connection('apbd');
            $items = $db->table('simda_apbd_bl')
                        ->select([
                            'ket_kegiatan', 
                            'kd_urusan', 
                            'kd_bidang', 
                            'kd_prog', 
                            'kd_keg', 
                            'kd_rek_1', 
                            'kd_rek_2', 
                            'kd_rek_3', 
                            'kd_rek_4', 
                            'kd_rek_5', 
                            'keterangan', 
                            'sat_1', 
                            'nilai_1', 
                            'sat_2', 
                            'nilai_2', 
                            'sat_3', 
                            'nilai_3', 
                            'nilai_rp', 
                            'total', 
                            'expr1'
                        ])->get();
            
            // Disable foreign check to truncate
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            ItemKegiatan::query()->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            foreach ($items as $key) 
            {
                $nm = $key->ket_kegiatan;
                $programCode  = implode('.', [ $key->kd_urusan, sprintf('%02d', $key->kd_bidang), sprintf('%02d', $key->kd_prog) ]);
                $kegiatanCode = implode('.', [ $programCode, sprintf('%03d', $key->kd_keg) ]);
                $kegiatan     = Kegiatan::where('rekening', $kegiatanCode)
                                        ->where('nama', $key->ket_kegiatan)->first();

                $rek_4    = sprintf('%02d', $key->kd_rek_4);
                $rek_5    = sprintf('%03d', $key->kd_rek_5);;
                $rekening = implode('.', [ $key->kd_rek_1, $key->kd_rek_2, $key->kd_rek_3, $rek_4, $rek_5 ]);

                $item              = new ItemKegiatan;
                $item->kegiatan_id = $kegiatan->id;
                $item->rekening    = $rekening;
                $item->nama        = $key->keterangan;
                $item->nilai_1     = $key->nilai_1;
                $item->satuan_1    = $key->sat_1;
                $item->nilai_2     = $key->nilai_2;
                $item->satuan_2    = $key->sat_2;
                $item->nilai_3     = $key->nilai_3;
                $item->satuan_3    = $key->sat_3;
                $item->fisik       = 0;
                $item->realisasi   = $key->nilai_rp;
                $item->total       = $key->total;
                $item->expr        = $key->expr1;
                $item->save();
            }
            //---- END OF INSERT ITEM KEGIATAN FROM SIMDA TO ADIK ----
        }
        catch (\Exception $ex)
        {
            return $ex->getMessage();
        }

        return 'SUCCESS';
    }

    public function indikator()
    {
        ini_set('max_execution_time', 30000);

        try
        {
            $db            = DB::connection('apbd');
            $indikatorData = $db->table('ta_indikator')
                                ->select([ 
                                    'kd_urusan', 
                                    'kd_bidang', 
                                    'kd_sub', 
                                    'kd_prog', 
                                    'kd_keg', 
                                    'nm_indikator', 
                                    'tolak_ukur', 
                                    'target_angka', 
                                    'target_uraian' 
                                ])
                                ->join('ref_indikator', 'ta_indikator.kd_indikator', '=', 'ref_indikator.kd_indikator')
                                ->get();

            foreach ($indikatorData as $key)
            {
                $programCode  = implode('.', [ $key->kd_urusan, sprintf('%02d', $key->kd_bidang), sprintf('%02d', $key->kd_prog) ]);
                $kegiatanCode = implode('.', [ $programCode, sprintf('%03d', $key->kd_keg) ]);
                $kegiatan     = Kegiatan::where('rekening', $kegiatanCode)->first();
                if ($kegiatan != null)
                {
                    $indikator = new Indikator;
                    $indikator->kegiatan_id = $kegiatan->id;
                    $indikator->nama        = $key->nm_indikator;
                    $indikator->uraian      = $key->tolak_ukur;
                    $indikator->target      = $key->target_angka;
                    $indikator->satuan      = $key->target_uraian;
                    for ($i = 0; $i < 4; $i++)
                    {
                        $nilaiProp = 'nilai_' . ($i + 1);

                        if ($key->target_angka != null)
                        {
                            $indikator->$nilaiProp = ($key->target_angka / 4 * (i + 1));
                        }
                        else
                        {
                            $indikator->$nilaiProp = 0;
                        }
                    }
                    $indikator->save();
                }
            }
        }
        catch (\Exception $ex)
        {
            return $ex->getMessage();
        }

        return 'SUCCESS';
    }
}