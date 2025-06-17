<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Obat;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obats = [
            [
                'nama_obat' => 'Paracetamol',
                'kemasan'   => 'Tablet',
                'harga'     => 7000,
            ],
            [
                'nama_obat' => 'Amoxicillin',
                'kemasan'   => 'Kapsul',
                'harga'     => 12000,
            ],
            [
                'nama_obat' => 'Salbutamol',
                'kemasan'   => 'Tablet',
                'harga'     => 8000,
            ],
            [
                'nama_obat' => 'Antasida',
                'kemasan'   => 'Sachet',
                'harga'     => 3000,
            ],
            [
                'nama_obat' => 'Cetirizine',
                'kemasan'   => 'Tablet',
                'harga'     => 7000,
            ],
            [
                'nama_obat' => 'Komik',
                'kemasan'   => 'Botol',
                'harga'     => 7000,
            ],
        ];

        foreach ($obats as $obat) {
            Obat::create($obat);
        }
    }
}