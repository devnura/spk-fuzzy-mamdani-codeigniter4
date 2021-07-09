<?php

namespace App\Models;

use CodeIgniter\Model;

class SubKriteriaModel extends Model
{
    protected $table          = 'sub_kriteria';
    protected $primaryKey     = 'id_sub_kriteria';
    protected $returnType     = 'array';
    protected $allowedFields  = ['id_kriteria', 'nama_sub_kriteria', 'niali_min', 'nilai_max'];
}
