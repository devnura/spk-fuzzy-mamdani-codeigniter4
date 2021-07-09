<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table          = 'kategori';
    protected $primaryKey     = 'id_kategori';
    protected $returnType     = 'array';
    protected $allowedFields  = ['id_kriteria', 'nama_kategori', 'left_side', 'mid', 'right_side'];
}
