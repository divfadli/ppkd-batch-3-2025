<?php

namespace Database\Seeders;

use App\Models\Members;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nik'           => '3501010101010001',
                'nama_anggota'  => 'Andi Wijaya',
                'no_hp'         => '081234567801',
                'email'         => 'andi.wijaya@example.com',
            ],
            [
                'nik'           => '3501010101010002',
                'nama_anggota'  => 'Budi Santoso',
                'no_hp'         => '081234567802',
                'email'         => 'budi.santoso@example.com',
            ],
            [
                'nik'           => '3501010101010003',
                'nama_anggota'  => 'Citra Dewi',
                'no_hp'         => '081234567803',
                'email'         => 'citra.dewi@example.com',
            ],
            [
                'nik'           => '3501010101010004',
                'nama_anggota'  => 'Dedi Kurniawan',
                'no_hp'         => '081234567804',
                'email'         => 'dedi.kurniawan@example.com',
            ],
            [
                'nik'           => '3501010101010005',
                'nama_anggota'  => 'Eka Prasetya',
                'no_hp'         => '081234567805',
                'email'         => 'eka.prasetya@example.com',
            ],
            [
                'nik'           => '3501010101010006',
                'nama_anggota'  => 'Fitri Handayani',
                'no_hp'         => '081234567806',
                'email'         => 'fitri.handayani@example.com',
            ],
            [
                'nik'           => '3501010101010007',
                'nama_anggota'  => 'Galih Saputra',
                'no_hp'         => '081234567807',
                'email'         => 'galih.saputra@example.com',
            ],
            [
                'nik'           => '3501010101010008',
                'nama_anggota'  => 'Hana Lestari',
                'no_hp'         => '081234567808',
                'email'         => 'hana.lestari@example.com',
            ],
            [
                'nik'           => '3501010101010009',
                'nama_anggota'  => 'Irwan Maulana',
                'no_hp'         => '081234567809',
                'email'         => 'irwan.maulana@example.com',
            ],
            [
                'nik'           => '3501010101010010',
                'nama_anggota'  => 'Joko Susilo',
                'no_hp'         => '081234567810',
                'email'         => 'joko.susilo@example.com',
            ],
        ];

        foreach ($data as $index => $member) {
            $pref  = 'MEMBER-';
            $today = Carbon::now()->format('dmy');

            // hitung total created hari ini + index loop
            $countDay = Members::whereDate('created_at', now()->toDateString())->count() + ($index + 1);

            $runningNumber = str_pad($countDay, 5, '0', STR_PAD_LEFT);
            $memberCode    = $pref . $today . "-" . $runningNumber;

            Members::create(array_merge($member, [
                'nomor_anggota' => $memberCode,
            ]));
        }
    }
}