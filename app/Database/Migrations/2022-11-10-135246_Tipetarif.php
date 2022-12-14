<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tipetarif extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'auto_increment'=>true],
            'tipe'=> ['type'=>'varchar', 'constraint'=>100, 'null'=>false],
            'keterangan'=>['type'=>'text', 'null'=>true],
            'urutan'=>['type'=>'int', 'constraint'=>11, 'null'=>true],
            'aktif'=>['type'=>'enum("Y","T")', 'default'=>"Y", 'null'=>true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('Tipetarif');
    }

    public function down()
    {
        $this->forge->dropTable('Tipetarif');
    }
}
