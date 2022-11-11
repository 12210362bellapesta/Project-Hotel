<?php

namespace App\Database\Seeds;

use App\Models\TamuModel;
use CodeIgniter\Database\Seeder;

class TamuSeeder extends Seeder
{
    public function run()
    {
        $id = (new TamuModel())->insert([
            'nama_depan'        => 'Portunata',
            'nama_belakang'     => 'Mulianti',
            'gender'            => 'P',
            'alamat'            => 'Jl. Sepakat',
            'kota'              => 'Pontianak',
            'negara_id'         => '1',
            'nohp'              => '0892312345',
            'email'             => 'prtnat23136@gmail.com',
            'sandi'             => password_hash('123456', PASSWORD_BCRYPT),
            'token_reset'       => 'towing',
        ]);
        echo "hasil id = $id";
    }
}
