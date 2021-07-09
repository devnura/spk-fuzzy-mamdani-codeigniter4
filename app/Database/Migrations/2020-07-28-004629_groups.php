<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Groups extends Migration
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
			'group'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'description'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			]
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('groups');
	}

	public function down()
	{
		$this->forge->dropTable('groups');
	}
}
