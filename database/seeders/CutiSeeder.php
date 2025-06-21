<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CutiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cutis = [
            [
                'pegawai_id' => 1,
                'tanggal_mulai' => '2024-01-15',
                'tanggal_akhir' => '2024-01-17',
                'alasan' => 'Liburan keluarga',
            ],
            [
                'pegawai_id' => 2,
                'tanggal_mulai' => '2024-02-10',
                'tanggal_akhir' => '2024-02-12',
                'alasan' => 'Keperluan pribadi',
            ],
            [
                'pegawai_id' => 3,
                'tanggal_mulai' => '2024-03-05',
                'tanggal_akhir' => '2024-03-08',
                'alasan' => 'Sakit',
            ],
            [
                'pegawai_id' => 1,
                'tanggal_mulai' => '2024-04-20',
                'tanggal_akhir' => '2024-04-22',
                'alasan' => 'Mudik lebaran',
            ],
            [
                'pegawai_id' => 4,
                'tanggal_mulai' => '2024-05-01',
                'tanggal_akhir' => '2024-05-03',
                'alasan' => 'Cuti tahunan',
            ],
            [
                'pegawai_id' => 2,
                'tanggal_mulai' => '2024-06-10',
                'tanggal_akhir' => '2024-06-12',
                'alasan' => 'Acara keluarga',
            ],
            [
                'pegawai_id' => 3,
                'tanggal_mulai' => '2024-07-15',
                'tanggal_akhir' => '2024-07-17',
                'alasan' => 'Pendidikan',
            ],
            [
                'pegawai_id' => 4,
                'tanggal_mulai' => '2024-08-20',
                'tanggal_akhir' => '2024-08-22',
                'alasan' => 'Cuti sakit',
            ],
            [
                'pegawai_id' => 1,
                'tanggal_mulai' => '2024-09-10',
                'tanggal_akhir' => '2024-09-12',
                'alasan' => 'Cuti pribadi',
            ],
            [
                'pegawai_id' => 2,
                'tanggal_mulai' => '2024-10-05',
                'tanggal_akhir' => '2024-10-07',
                'alasan' => 'Liburan akhir tahun',
            ],
            [
                'pegawai_id' => 3,
                'tanggal_mulai' => '2024-11-15',
                'tanggal_akhir' => '2024-11-17',
                'alasan' => 'Cuti keluarga',
            ],
        ];

        foreach ($cutis as $cuti) {
            \App\Models\Cuti::create([
                'pegawai_id' => $cuti['pegawai_id'],
                'tanggal_mulai' => $cuti['tanggal_mulai'],
                'tanggal_akhir' => $cuti['tanggal_akhir'],
                'alasan' => $cuti['alasan'],
            ]);
        }
    }
}
