<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Metodebayar extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=>['type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'auto_increment'=>true],
            'metode'=>['type'=>'varchar', 'constraint'=>50, 'null'=>false],
            'aktif'=>['type'=>'enum("Y","T")', "default"=>"Y"],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('Metodebayar');
    }

    public function down()
    {
        $this->forge->dropTable('Metodebayar');
    }
}
