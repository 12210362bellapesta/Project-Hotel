<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KamarDipesan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'auto_increment'=>true],
            'pemesanan_id' => ['type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'null'=>true],
            'kamar_id' => ['type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'null'=>false],
            'tarif' => ['type'=>'double', 'null'=>true],
            'pengguna_id' => ['type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'null'=>true],
            'created_at' => ['type'=>'datetime', 'null'=>true],
            'updated_at' => ['type'=>'datetime', 'null'=>true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('pemesanan_id', 'pemesanan', 'id', 'cascade', 'setnull');
        $this->forge->addForeignKey('kamar_id', 'kamar', 'id', 'cascade');
        $this->forge->addForeignKey('pengguna_id', 'pengguna', 'id', 'cascade');
        $this->forge->createTable('kamardipesan');
    }

    public function down()
    {
        $this->forge->dropTable('kamardipesan');
    }
}

