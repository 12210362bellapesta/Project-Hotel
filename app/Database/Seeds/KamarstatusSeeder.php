<?php

namespace App\Database\Seeds;

use App\Models\KamarstatusModel;
use CodeIgniter\Database\Seeder;

class KamarstatusSeeder extends Seeder
{
    public function run()
    {
        $id = (new KamarstatusModel())->insert([
           'status' => 'siap huni',
           'keterangan' => 'tersedia',
           'urutan' => '1',
        ]);
        echo "hasil id - $id";
    }
}

