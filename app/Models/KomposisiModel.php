<?php

namespace App\Models;

use CodeIgniter\Model;

class KomposisiModel extends Model
{
    protected $table          = 'komposisi_aturan';
    protected $primaryKey     = 'id_komposisi';
    protected $returnType     = 'array';
    protected $allowedFields  = ['id_pendataan', 'nilai'];
}
