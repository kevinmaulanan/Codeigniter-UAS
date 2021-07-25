<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
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
			'name' => [
				'type' 			=> 'VARCHAR',
				'constraint' 	=> '255',
			],
			'email' => [
				'type'      	=> 'VARCHAR',
				'constraint' 	=> '100',
				'unique' 		=> true,
			],
			'password' => [
				'type' 			=> 'VARCHAR',
				'constraint' 	=> '255',
			],
			'role' => [
				'type' 			=> 'VARCHAR',
				'constraint' 	=> '32',
			],
			'status' => [
				'type'          => 'ENUM',
				'constraint'    => ['ACTIVE', 'DELETED'],
				'default'       => 'ACTIVE',
			],
			'limit' => [
				'type'          => 'BIGINT',
				'default'       => 5000000,
			],
			'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
			'updated_at DATETIME DEFAULT NULL'
		]);

		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('users');
	}

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
