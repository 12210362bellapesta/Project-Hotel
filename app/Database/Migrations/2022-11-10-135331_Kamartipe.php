<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kamartipe extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => [ 'type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'auto_increment'=>true ],
            'tipe'          => [ 'type'=>'varchar', 'constraint'=>100, 'null'=>false ],
            'keterangan'    => [ 'type'=>'text', 'null'=>true ],
            'urutan'        => [ 'type'=>'int', 'constraint'=>10, 'unsigned'=>true, ],
            'aktif'         => [ 'type'=>'enum("Y","P")', 'default'=>"Y", 'null'=>true, ],
            'gambar'        => [ 'type'=>'varbinary', 'constraint'=>255, 'null'=>true, ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('kamartipe');
    }

    public function down()
    {
        $this->forge->dropTable('kamartipe');
    }
}
