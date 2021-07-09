<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User_group extends Migration
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
			'id_user'       => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'id_group'       => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('user_group');
	}

	public function down()
	{
		$this->forge->dropTable('user_group');
	}
}
