<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentYearMonth = date('Ym');
        $pasiens = [
            [
                'nama' => 'Johan',
                'email' => 'johan@mail.com',
                'password' => Hash::make('pasien123'),
                'role' => 'pasien',
                'alamat' => 'Jl. Merpati No. 10, Jakarta Selatan',
                'no_ktp' => '3175060101010001',
                'no_hp' => '081234567801',
                'no_rm' => $currentYearMonth . '-001',
            ],
            [
                'nama' => 'Ridho',
                'email' => 'ridho@mail.com',
                'password' => Hash::make('pasien123'),
                'role' => 'pasien',
                'alamat' => 'Jl. Kenari No. 22, Jakarta Timur',
                'no_ktp' => '3175060202020002',
                'no_hp' => '081234567802',
                'no_rm' => $currentYearMonth . '-002',
            ],
            [
                'nama' => 'Budi',
                'email' => 'budi@mail.com',
                'password' => Hash::make('pasien123'),
                'role' => 'pasien',
                'alamat' => 'Jl. Cendrawasih No. 33, Jakarta Barat',
                'no_ktp' => '3175060303030003',
                'no_hp' => '081234567803',
                'no_rm' => $currentYearMonth . '-003',
            ],
            [
                'nama' => 'Dholi Gondrong',
                'email' => 'dholigondrong@mail.com',
                'password' => Hash::make('pasien123'),
                'role' => 'pasien',
                'alamat' => 'Jl. Elang No. 44, Jakarta Utara',
                'no_ktp' => '3175060404040004',
                'no_hp' => '081234567804',
                'no_rm' => $currentYearMonth . '-004',
            ],
            [
                'nama' => 'Dholi',
                'email' => 'dholi@mail.com',
                'password' => Hash::make('pasien123'),
                'role' => 'pasien',
                'alamat' => 'Jl. Rajawali No. 55, Jakarta Pusat',
                'no_ktp' => '3175060505050005',
                'no_hp' => '081234567805',
                'no_rm' => $currentYearMonth . '-005',
            ],
        ];

        foreach ($pasiens as $pasien) {
            User::create($pasien);
        }
    }
}