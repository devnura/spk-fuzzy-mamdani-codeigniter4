<?php

namespace App\Models;

use CodeIgniter\Model;

class DaerahModel extends Model
{
    protected $table      = 'kelurahan';
    protected $primaryKey = 'id_kel';
    protected $returnType     = 'array';
}
