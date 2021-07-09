<?php

namespace App\Models;

use CodeIgniter\Model;

class PendataanModel extends Model
{
    protected $table          = 'pendataan';
    protected $primaryKey     = 'id_pendataan';
    protected $returnType     = 'array';
    protected $allowedFields  = ['tgl_pendataan', 'tahun_aktif', 'id_user', 'nkk', 'status_pendataan'];
}
