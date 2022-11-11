<?php

namespace App\Database\Seeds;

use App\Models\PenggunaModel;
use CodeIgniter\Database\Seeder;

class PenggunaSeeder extends Seeder
{
    public function run()
    {
        $id = (new PenggunaModel())->insert([
            'nama_depan'        => 'Bella',
            'nama_belakang'     => 'Pesta',
            'gender'            => 'P',
            'alamat'            => 'jln.Panjaitan',
            'kota'              => 'Pontianak',
            'notelp'            => '62345679',
            'nohp'              => '0892349087',
            'email'             => 'bellapeta136@gmail.com',
            'level'             => 'M',
            'foto'              => '',
            'sandi'             => password_hash('123456', PASSWORD_BCRYPT),
            'token_reset'       => 'towing',
        ]);
        echo "hasil id - $id";
    }
}