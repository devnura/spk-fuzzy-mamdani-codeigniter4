<?php

namespace App\Database\Seeds;

class GroupSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            'group' => 'admin',
            'description' => 'have all permission in system'
        ];

        // Using Query Builder
        $this->db->table('groups')->insert($data);
    }
}
