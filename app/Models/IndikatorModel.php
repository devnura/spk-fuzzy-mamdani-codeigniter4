<?php

namespace App\Models;

use CodeIgniter\Model;

class IndikatorModel extends Model
{
    protected $table          = 'indikator';
    protected $primaryKey     = 'id_indikator';
    protected $returnType     = 'array';
    protected $allowedFields  = ['indikator', 'id_kriteria', 'jenis_indikator'];
}
