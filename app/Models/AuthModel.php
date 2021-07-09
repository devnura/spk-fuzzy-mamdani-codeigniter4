<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'email'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function get_user($id = false)
    {
        if ($id == false) {
            return  $this->findAll();
        }
        return $this->where(['id', $id])->first();
    }

    public function chek_login($username)
    {
        return $this->db->table('users')
            ->where(array('username' => $username))
            ->orWhere(array('email' => $username))
            ->get()->getResultArray();
    }

    public function is_login()
    {
        if (!session('id')) {
            return false;
        } else {
            return true;
        }
    }

    public function is_admin()
    {
        $is_admin = $this->db->table('user_group')
            ->where(array('id_user' => session()->get('id')))
            ->where(array('id_group' => 1))
            ->get()->getRowArray();
        if ($is_admin) {
            return true;
        } else {
            return false;
        }
    }
}
