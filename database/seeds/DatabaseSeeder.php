<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $migrator = resolve('App\Services\MigratorService');

        $migrator->skpd();
        $migrator->user();
        $migrator->program();
        $migrator->kegiatan();
        $migrator->item();
        $migrator->indikator();
        $migrator->realisasi();
    }
}
