<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Area; // Pastikan memanggil Model Area

class AreaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Sukodadi',
                'description' => 'Area strategis dekat stasiun dan pusat kuliner.'
            ],
            [
                'name' => 'Babat',
                'description' => 'Kota perdagangan, cocok untuk pekerja dan mahasiswa.'
            ],
            [
                'name' => 'Lamongan Kota',
                'description' => 'Pusat pemerintahan dan dekat dengan berbagai kampus.'
            ],
            [
                'name' => 'Paciran',
                'description' => 'Area pesisir dengan akses wisata dan pendidikan.'
            ],
            [
                'name' => 'Karanggeneng',
                'description' => 'Lingkungan asri dan tenang untuk hunian.'
            ],
            [
                'name' => 'Sekaran',
                'description' => 'Dekat dengan area kampus dan pemukiman mahasiswa.'
            ],
        ];

        foreach ($data as $item) {
            Area::create($item);
        }
    }
}