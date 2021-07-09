<?php

namespace App\Models;

use CodeIgniter\Model;

class HasilModel extends Model
{
    protected $table          = 'hasil';
    protected $primaryKey     = 'id_hasil';
    protected $returnType     = 'array';
    protected $allowedFields  = ['id_pendataan', 'nilai'];
}
