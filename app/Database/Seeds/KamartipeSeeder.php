<?php

namespace App\Database\Seeds;

use App\Models\KamartipeModel;
use CodeIgniter\Database\Seeder;

class KamartipeSeeder extends Seeder
{
    public function run()
    {
        $id = (new KamartipeModel())->insert([
            'tipe' => 'Deluxe',
            'keterangan' => 'Tersedia',
            'urutan' => '1',
            'aktif' => 'Y',
            'gambar' => '',
        ]);
    }
}

