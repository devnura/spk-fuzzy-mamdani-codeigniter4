<?php

namespace App\Models;

use CodeIgniter\Model;

class FuzzyfikasiModel extends Model
{
    protected $table          = 'fuzzyfikasi';
    protected $primaryKey     = 'id_fuzzyfikasi';
    protected $returnType     = 'array';
    protected $allowedFields  = ['id_pendataan', 'id_kriteria', 'id_kategori', 'nilai'];
}
