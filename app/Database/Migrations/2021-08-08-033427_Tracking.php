<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tracking extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type'           => 'INT',
				'unsigned'       => true,
				'auto_increment' => true,
				'null'           => false,
			],
			'no_polis' => [
				'type' 			=> 'VARCHAR',
				'constraint' 	=> '255',
			],
			'nama_tertanggung' => [
				'type' 			=> 'VARCHAR',
				'constraint' 	=> '255',
			],
			'alamat' => [
				'type'      	=> 'TEXT',
			],
			'waktu_kejadian' => [
				'type' 			=> 'DATETIME'
			],
			'lokasi_kejadian' => [
				'type'          => 'TEXT',
			],
			'no_hp' => [
				'type' 			=> 'VARCHAR',
				'constraint' 	=> '16',
			],
			'status_request' => [
				'type' 			=> 'VARCHAR',
				'constraint' 	=> '255',
			],
			'user_id' => [
				'type' 			=> 'INT',
			],
			'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
			'updated_at DATETIME DEFAULT NULL',
		]);

		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('trackings');
	}

	public function down()
	{
		$this->forge->dropTable('trackings');
	}
}
