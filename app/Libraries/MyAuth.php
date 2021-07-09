<?php

namespace App\Liblaries\MyAuth;

class myauth
{

    public function login()
    {
    }

    public function is_login()
    {
    }

    public function is_admin()
    {
        if ($this->UserGroupModel->is_admin(session('id'))) {
            echo "admin";
        } else {
            echo "bukan_admin";
        }
    }
}
