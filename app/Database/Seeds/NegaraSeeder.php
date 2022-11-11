<?php

namespace App\Database\Seeds;

use App\Models\NegaraModel;
use CodeIgniter\Database\Seeder;

class NegaraSeeder extends Seeder
{
    public function run()
    {
        $id = (new NegaraModel())->insert([
            'negara' => 'Indonesia'
        ]);
        echo "hasil id = $id";
    }
}
