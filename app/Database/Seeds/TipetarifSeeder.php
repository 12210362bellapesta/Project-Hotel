<?php

namespace App\Database\Seeds;

use App\Models\TipetarifModel;
use CodeIgniter\Database\Seeder;

class TipetarifSeeder extends Seeder
{
    public function run()
    {
        $id = (new TipetarifModel())->insert([
            'tipe'          => 'Akhir Pekan',
            'keterangan'    => 'Tersedia',
            'urutan'        => '2',
            'aktif'         => 'Y',
        ]);
        echo "hasil id = $id";
    }
}
