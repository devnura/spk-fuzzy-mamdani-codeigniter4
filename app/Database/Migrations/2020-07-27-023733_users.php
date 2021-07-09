<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
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
			'username'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'password'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'email'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'active'       => [
				'type'           => 'INT',
				'constraint'     => '1',
			],
			'created_at' => [
				'type'           => 'DATETIME',
				'null'           => TRUE,
			],
			'updated_at' => [
				'type'           => 'DATETIME',
				'null'           => TRUE,
			],
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('users');
	}

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
