<?php

namespace App\Database\Seeds;

use App\Models\PembayaranModel;
use CodeIgniter\Database\Seeder;

class PembayaranSeeder extends Seeder
{
    public function run()
    {
        $id = (new PembayaranModel())->insert([
            'tgl' => '2022-09-05',
            'tagihan' => '500000',
            'dibayar' => '500000',
            'nama_pembayar' => 'Flesia',
            'metodebayar_id' => '1',
            'pengguna_id' => '1',
        ]);
        echo "hasil id = $id";
    }
}
