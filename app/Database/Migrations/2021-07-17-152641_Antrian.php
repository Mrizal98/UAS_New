<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Antrian extends Migration
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
        'tanggal'       => [
                'type'           => 'datetime',
          
        ],
        'no_antrian' => [
                'type'           => 'varchar',
                 'constraint'     => 255,
        ],
        'status'       => [
                'type'           => 'tinyint',
                'constraint'     => 11,
        ],
        'waktu_panggil TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
        'waktu_selesai TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
         'pelayanan_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
        ],
         'loket_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
        ],
    ]);
    $this->forge->addKey('id', TRUE);
    $this->forge->createTable('antrian');
	}

	public function down()
	{
		//
	}
}
