<?php

namespace App\Models;

use CodeIgniter\Model;

class ImplikasiModel extends Model
{
    protected $table          = 'implikasi';
    protected $primaryKey     = 'id_implikasi';
    protected $returnType     = 'array';
    protected $allowedFields  = ['id_pendataan', 'nilai_implikasi'];
}
