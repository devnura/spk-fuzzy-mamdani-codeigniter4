<?php

namespace App\Database\Seeds;

class UsergroupSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            'id_user' => 1,
            'id_group' => 1
        ];

        // Using Query Builder
        $this->db->table('user_group')->insert($data);
    }
}
