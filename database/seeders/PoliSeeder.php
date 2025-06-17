<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Poli;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $polis = [
            [
                'nama' => 'Umum',
                'deskripsi' => 'Poli Umum melayani berbagai keluhan umum pasien.',
            ],
            [
                'nama' => 'Anak',
                'deskripsi' => 'Poli Anak khusus untuk perawatan dan konsultasi anak.',
            ],
            [
                'nama' => 'Kebidanan dan Kandungan',
                'deskripsi' => 'Poli Kebidanan dan Kandungan untuk ibu hamil dan persalinan.',
            ],
            [
                'nama' => 'Mata',
                'deskripsi' => 'Poli Mata untuk pemeriksaan dan perawatan mata.',
            ],
            [
                'nama' => 'THT',
                'deskripsi' => 'Poli THT untuk masalah telinga, hidung, dan tenggorokan.',
            ],
        ];

        foreach ($polis as $poli) {
            Poli::create($poli);
        }
    }
}
