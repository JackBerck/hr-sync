<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jabatans = [
            ["nama_jabatan" => 'Manager HRD', "tunjangan" => 5000000],
            ["nama_jabatan" => 'Staff IT Support', "tunjangan" => 2500000],
            ["nama_jabatan" => 'Akuntan Senior', "tunjangan" => 4000000],
            ["nama_jabatan" => 'Marketing Executive', "tunjangan" => 3000000],
            ["nama_jabatan" => 'Sales Representative', "tunjangan" => 2000000],
            ["nama_jabatan" => 'Supervisor Produksi', "tunjangan" => 3500000],
            ["nama_jabatan" => 'Logistik Officer', "tunjangan" => 2200000],
            ["nama_jabatan" => 'R&D Engineer', "tunjangan" => 4500000],
            ["nama_jabatan" => 'Customer Service Specialist', "tunjangan" => 1800000],
            ["nama_jabatan" => 'Manajer Umum', "tunjangan" => 6000000],
            ["nama_jabatan" => 'Legal Advisor', "tunjangan" => 4200000],
            ["nama_jabatan" => 'Business Analyst', "tunjangan" => 3800000],
            ["nama_jabatan" => 'Quality Control Inspector', "tunjangan" => 2800000],
            ["nama_jabatan" => 'Pengadaan Barang', "tunjangan" => 2600000],
            ["nama_jabatan" => 'Keuangan Manager', "tunjangan" => 5500000],
            ["nama_jabatan" => 'Strategi Bisnis Manager', "tunjangan" => 5800000],
            ["nama_jabatan" => 'Pengembangan Produk Manager', "tunjangan" => 5200000],
        ];

        foreach ($jabatans as $jabatan) {
            \App\Models\Jabatan::create([
                'nama_jabatan' => $jabatan['nama_jabatan'],
                'tunjangan' => $jabatan['tunjangan'],
            ]);
        }
    }
}
