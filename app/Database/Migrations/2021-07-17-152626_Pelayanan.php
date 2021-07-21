<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pelayanan extends Migration
{
	public function up()
	{
	$this->forge->addField([
        'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
        ],
        'nama'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
        ],
        'keterangan' => [
                'type'           => 'TEXT',
                'null'           => TRUE,
        ],
        'kode'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '2',
        ],
    ]);
    $this->forge->addKey('id', TRUE);
    $this->forge->createTable('pelayanan');
	}

	public function down()
	{
		//
	}
}
