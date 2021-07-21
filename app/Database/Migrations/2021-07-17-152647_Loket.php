<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Loket extends Migration
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
        'pelayanan_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
        ],
    ]);
    $this->forge->addKey('id', TRUE);
    $this->forge->createTable('loket');
	}

	public function down()
	{
		//
	}
}
