<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pemesananstatus extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            =>['type'=>'int', 'constraint'=>10, 'null'=>false, 'unsigned'=>true],
            'status'        =>['type'=>'varchar', 'constraint'=>50, 'null'=>false],
            'urutan'        =>['type'=>'int', 'constraint'=>10, 'default'=>"1", 'null'=>false, 'unsigned'=>true],
            'aktif'         =>['type'=>'enum("Y","T")', 'default'=>"T", 'null'=>true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('pemesananstatus');
    }

    public function down()
    {
        $this->forge->dropTable('pemesananstatus');
    }
}

