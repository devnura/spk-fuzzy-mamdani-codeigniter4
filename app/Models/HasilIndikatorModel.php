<?php

namespace App\Models;

use CodeIgniter\Model;

class HasilIndikatorModel extends Model
{
    protected $table          = 'hasil_indikator';
    protected $primaryKey     = 'id_indikator';
    protected $returnType     = 'array';
    protected $allowedFields  = ['id_pendataan', 'nik', 'id_indikator', 'jawaban'];
}
