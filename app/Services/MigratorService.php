<?php

namespace App\Services;

use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Helper\ProgressBar;

use App\Models\SimdaApbdBl;
use App\Models\User;
use App\Models\Skpd;
use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\ItemKegiatan;
use App\Models\RealisasiItem;
use App\Models\Indikator;
use DB;

class MigratorService
{
    public function skpd()
    {
        ini_set('max_execution_time', 30000);
        $console = new ConsoleOutput();

        // ---- INSERT UNIQUE SKPD FROM SIMDA TO ADIK ----
        $db       = DB::connection('apbd');
        $skpdData = $db->table('Ref_Sub_Unit')->get();
        $all      = Skpd::all();

        $console->writeln('----- EXPORTING SKPD -----');
        $progress = new ProgressBar($console, count($skpdData));
        $progress->setOverwrite(true);
        foreach ($skpdData as $key)
        {
            try
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

                    $progress->advance();
                }
                else
                {
                    $progress->clear();
                    $console->writeln('Duplicate SKPD');
                    $progress->display();
                }
            }
            catch (\Exception $ex)
            {
                $progress->clear();
                $console->writeln($ex->getMessage());
                $progress->display();
            }
        } 

        // ---- END INSERT UNIQUE SKPD FROM SIMDA TO ADIK ----
        $progress->finish();
        $console->writeln('');
        $console->writeln('COMPLETED');
    }

    public function user()
    {
        ini_set('max_execution_time', 30000);
        $skpdData = Skpd::all();

        $console = new ConsoleOutput();
        $console->writeln('----- EXPORTING SKPD CREDENTIALS -----');

        $progress = new ProgressBar($console, count($skpdData));
        $progress->setOverwrite(true);
        foreach ($skpdData as $skpd)
        {
            try
            {
                $nama = str_replace(' ', '_', strtolower($skpd->nama));
                User::create([
                    'skpd_id'  => $skpd->id,
                    'username' => $nama,
                    'password' => bcrypt($nama)
                ]);

                $progress->advance();
            }
            catch (\Exception $ex)
            {
                $progress->clear();
                $console->writeln($ex->getMessage());
                $progress->display();
            }

            
        }

        $progress->finish();
        $console->writeln('');
        $console->writeln('COMPLETED');
    }

    public function program()
    {
        ini_set('max_execution_time', 30000);

        // ---- INSERT UNIQUE PRORAM FROM SIMDA TO ADIK ----
        $db       = DB::connection('apbd');
        $programs = $db->table('TA_Program')->get();

        $console = new ConsoleOutput();
        $console->writeln('----- EXPORTING PROGRAM -----');

        $progress = new ProgressBar($console, count($programs));
        $progress->setOverwrite(true);
        foreach ($programs as $key) 
        {
            try 
            {
                $bidangCode  = sprintf('%02d', $key->Kd_Bidang);
                $programCode = sprintf('%02d', $key->Kd_Prog);
                $unitCode    = sprintf('%02d', $key->Kd_Unit);
                $subCode     = sprintf('%02d', $key->Kd_Sub);
                $rekening    = implode('.', [ $key->Kd_Urusan, $bidangCode, $programCode ]);
                $skpd        = Skpd::where('id', implode('.', [ $key->Kd_Urusan, $bidangCode, $unitCode, $subCode ]))->first();

                if ($skpd != null) 
                {
                    $program           = new Program;
                    $program->skpd_id  = $skpd->id;
                    $program->rekening = $rekening;
                    $program->nama     = $key->Ket_Program;
                    $program->save();

                    $progress->advance();
                }
                else
                {
                    $progress->clear();
                    $console->writeln($skpd->rekening . ' not found (Program: ' . $rekening . ' - ' . $key->Ket_Program . ')');
                    $progress->display();
                }
            }
            catch (\Exception $ex)
            {
                $progress->clear();
                $console->writeln($ex->getMessage());
                $progress->display();
            }
        }

        // ---- END OF INSERT UNIQUE PRORAM FROM SIMDA TO ADIK ----
        $progress->finish();
        $console->writeln('');
        $console->writeln('COMPLETED');
    }

    public function kegiatan()
    {
        ini_set('max_execution_time', 30000);

        // ---- INSERT UNIQUE KEGIATAN FROM SIMDA TO ADIK ----
        $db       = DB::connection('apbd');
        $kegiatan = $db->table('TA_Kegiatan')->get();

        $console  = new ConsoleOutput();
        $console->writeln('----- EXPORTING KEGIATAN -----');

        $progress = new ProgressBar($console, count($kegiatan));
        $progress->setOverwrite(true);
        foreach ($kegiatan as $key) 
        {
            try 
            {
                $programCode = implode('.', [ $key->Kd_Urusan, sprintf('%02d', $key->Kd_Bidang), sprintf('%02d', $key->Kd_Prog) ]);
                $program     = Program::where('rekening', $programCode)->first();
                $rekening    = implode('.', [ $program->rekening, sprintf('%03d', $key->Kd_Keg) ]);

                if ($program != null) 
                {
                    $kegiatan = new Kegiatan;
                    $kegiatan->program_id = $program->id;
                    $kegiatan->rekening   = $rekening;
                    $kegiatan->nama       = $key->Ket_Kegiatan;
                    $kegiatan->save();

                    $progress->advance();
                }
                else
                {
                    $progress->clear();
                    $console->writeln($programCode . ' not found (Kegiatan: ' . $rekening . ' - ' . $key->Ket_Kegiatan . ')');
                    $progress->display();
                }
            }
            catch (\Exception $ex)
            {
                $progress->clear();
                $console->writeln($ex->getMessage());
                $progress->display();
            }
        }

        // ---- END INSERT UNIQUE KEGIATAN FROM SIMDA TO ADIK ---
        $progress->finish();
        $console->writeln('');
        $console->writeln('COMPLETED');
    }

    public function item()
    {
        ini_set('max_execution_time', 30000);

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

        $console  = new ConsoleOutput();
        $console->writeln('----- EXPORTING ITEM KEGIATAN -----');

        $progress = new ProgressBar($console, count($items));
        $progress->setOverwrite(true);
        foreach ($items as $key) 
        {
            try 
            {
                $nm = $key->ket_kegiatan;
                $programCode  = implode('.', [ $key->kd_urusan, sprintf('%02d', $key->kd_bidang), sprintf('%02d', $key->kd_prog) ]);
                $kegiatanCode = implode('.', [ $programCode, sprintf('%03d', $key->kd_keg) ]);
                $kegiatan     = Kegiatan::where('rekening', $kegiatanCode)
                                        ->where('nama', $key->ket_kegiatan)->first();

                $rek_4    = sprintf('%02d', $key->kd_rek_4);
                $rek_5    = sprintf('%03d', $key->kd_rek_5);;
                $rekening = implode('.', [ $key->kd_rek_1, $key->kd_rek_2, $key->kd_rek_3, $rek_4, $rek_5 ]);

                if ($kegiatan != null) 
                {
                    $item              = new ItemKegiatan;
                    $item->kegiatan_id = $kegiatan->id;
                    $item->rekening    = $rekening;
                    $item->nama        = $key->keterangan;
                    $item->total       = $key->total;
                    $item->save();

                    $progress->advance();
                }
                else
                {
                    $progress->clear();
                    $console->writeln($kegiatanCode . ' not found (Item: ' . $rekening . ' - ' . $key->keterangan . ')');
                    $progress->display();
                }
            }
            catch (\Exception $ex)
            {
                $progress->clear();
                $console->writeln($ex->getMessage());
                $progress->display();
            }
        }
        //---- END OF INSERT ITEM KEGIATAN FROM SIMDA TO ADIK ----
        $progress->finish();
        $console->writeln('');
        $console->writeln('COMPLETED');
    }

    public function indikator()
    {
        ini_set('max_execution_time', 30000);

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

        $console  = new ConsoleOutput();
        $console->writeln('----- EXPORTING INDIKATOR -----');

        $progress = new ProgressBar($console, count($indikatorData));
        $progress->setOverwrite(true);
        foreach ($indikatorData as $key)
        {
            try
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
                            $indikator->$nilaiProp = ($key->target_angka / 4 * ($i + 1));
                        }
                        else
                        {
                            $indikator->$nilaiProp = 0;
                        }
                    }
                    
                    $indikator->save();
                    $progress->advance();
                }
                else
                {
                    $progress->clear();
                    $console->writeln($kegiatanCode . ' not found (Kegiatan: ' . $key->nm_kegiatan . ')');
                    $progress->display();
                }
            }
            catch (\Exception $ex)
            {
                $progress->clear();
                $console->writeln($ex->getMessage());
                $progress->display();
            }
        }
        
        $progress->finish();
        $console->writeln('');
        $console->writeln('COMPLETED');
    }

    public function realisasi()
    {
        ini_set('max_execution_time', 30000);

        $db      = DB::connection('apbd');
        $spdRinc = $db->table('ta_spd_rinc')->get();

        $console  = new ConsoleOutput();
        $console->writeln('----- EXPORTING REALISASI -----');

        $progress = new ProgressBar($console, count($spdRinc));
        $progress->setOverwrite(true);
        foreach ($spdRinc as $key)
        {
            try
            {
                $programCode  = implode('.', [ $key->Kd_Urusan, sprintf('%02d', $key->Kd_Bidang), sprintf('%02d', $key->Kd_Prog) ]);
                $kegiatanCode = implode('.', [ $programCode, sprintf('%03d', $key->Kd_Keg) ]);

                $rek_4    = sprintf('%02d', $key->Kd_Rek_4);
                $rek_5    = sprintf('%03d', $key->Kd_Rek_5);
                $rekening = implode('.', [ $key->Kd_Rek_1, $key->Kd_Rek_2, $key->Kd_Rek_3, $rek_4, $rek_5 ]);
                $item     = ItemKegiatan::where('rekening', $rekening)->whereHas('kegiatan', function($query) use($kegiatanCode) {
                    $query->where('rekening', $kegiatanCode);
                })->first();

                if ($item != null)
                {
                    $realisasi = RealisasiItem::where('item_id', $item->id)->first();
                    if ($realisasi == null)
                    {
                        $realisasi = new RealisasiItem();
                    }

                    $data     = explode('/', $key->No_SPD);
                    $tahun    = $key->Tahun;
                    $triwulan = str_replace('0', '', $data[0]);
                    $prop     = 'nilai_' . $triwulan;

                    $realisasi->item_id = $item->id;
                    $realisasi->spd     = implode('/', [ $data[1], $data[2], $data[3] ]);
                    $realisasi->tahun   = $tahun;
                    $realisasi->$prop   = $key->Nilai;

                    $realisasi->save();
                    $progress->advance();
                }
                else
                {
                    $progress->clear();
                    $console->writeln($kegiatanCode . ' not found (Item: ' . $rekening . ')');
                    $progress->display();
                }
            }
            catch (\Exception $ex)
            {
                $progress->clear();
                $console->writeln($ex->getMessage());
                $progress->display();
            }
        }
        
        $progress->finish();
        $console->writeln('');
        $console->writeln('COMPLETED');
    }
}