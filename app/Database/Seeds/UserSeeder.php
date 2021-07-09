<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

class UserSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            'username' => 'admin',
            'password' => password_hash('password', PASSWORD_DEFAULT),
            'email'    => 'admin@admin.com',
            'name' => 'Admin',
            'level' => '1',
            'active' => '1',
            'created_at' => Time::now(),
            'updated_at' => Time::now()
        ];

        // Using Query Builder
        $this->db->table('users')->insert($data);
    }
}
