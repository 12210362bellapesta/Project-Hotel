<?php

namespace App\Database\Seeds;

use App\Models\KamartarifModel;
use CodeIgniter\Database\Seeder;

class KamartarifSeeder extends Seeder
{
    public function run()
    {
        $id = (new KamartarifModel())->insert([
            'kamartipe_id' => '1',
            'tarif' => '600000',
            'tgl_mulai' => '2022-09-04',
            'tgl_selesai' => '2022-09-07',
            'tipetarif_id' => '1',
        ]);
        echo "hasil id = $id";
    }
}

