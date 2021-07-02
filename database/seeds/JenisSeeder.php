<?php

use App\Jenis;
use Illuminate\Database\Seeder;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jenis::create([
            'name' => 'Absensi',
            'nominal' => 0
        ]);
        Jenis::create([
            'name' => 'Izin Setengah Hari',
            'nominal' => 50000
        ]);
        Jenis::create([
            'name' => 'Izin',
            'nominal' => 100000
        ]);
        Jenis::create([
            'name' => 'Cuti',
            'nominal' => 0
        ]);
        Jenis::create([
            'name' => 'Lembur',
            'nominal' => 200000
        ]);
    }
}
