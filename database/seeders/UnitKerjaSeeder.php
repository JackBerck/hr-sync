<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unitKerjas = [
            ["nama_unit" => 'HRD', "lokasi" => 'Gedung A'],
            ["nama_unit" => 'IT Support', "lokasi" => 'Gedung B'],
            ["nama_unit" => 'Akuntansi', "lokasi" => 'Gedung C'],
            ["nama_unit" => 'Marketing', "lokasi" => 'Gedung D'],
            ["nama_unit" => 'Sales', "lokasi" => 'Gedung E'],
            ["nama_unit" => 'Produksi', "lokasi" => 'Gedung F'],
            ["nama_unit" => 'Logistik', "lokasi" => 'Gudang Utama'],
            ["nama_unit" => 'R&D', "lokasi" => 'Laboratorium'],
            ["nama_unit" => 'Customer Service', "lokasi" => 'Gedung G'],
            ["nama_unit" => 'Manajemen', "lokasi" => 'Gedung Utama'],
            ["nama_unit" => 'Legal', "lokasi" => 'Gedung H'],
            ["nama_unit" => 'Business Analyst', "lokasi" => 'Gedung I'],
            ["nama_unit" => 'Quality Control', "lokasi" => 'Gedung J'],
            ["nama_unit" => 'Pengadaan', "lokasi" => 'Gedung L'],
            ["nama_unit" => 'Keuangan', "lokasi" => 'Gedung M'],
            ["nama_unit" => 'Strategi Bisnis', "lokasi" => 'Gedung N'],
            ["nama_unit" => 'Pengembangan Produk', "lokasi" => 'Gedung O'],
        ];

        foreach ($unitKerjas as $unitKerja) {
            \App\Models\UnitKerja::create([
                'nama_unit' => $unitKerja['nama_unit'],
                'lokasi' => $unitKerja['lokasi'],
            ]);
        }
    }
}
