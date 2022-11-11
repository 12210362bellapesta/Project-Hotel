<?php

namespace App\Database\Seeds;

use App\Models\KamarModel;
use CodeIgniter\Database\Seeder;

class KamarSeeder extends Seeder
{
    public function run()
    {
        $id = (new KamarModel())->insert([
            'kamartipe_id' => '1',
            'lantai' => '2',
            'nomor' => '201',
            'kamarstatus_id' => '1',
            'deskripsi' => 'kamar tersedia dan siap huni'
        ]);
        echo "hasil id = $id";
    }
}

