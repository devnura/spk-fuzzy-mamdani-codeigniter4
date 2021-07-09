<?php

namespace App\Models;

use CodeIgniter\Model;

class DefuzzyfikasiModel extends Model
{
    protected $table          = 'defuzzyfikasi';
    protected $primaryKey     = 'id_defuzzyfikasi';
    protected $returnType     = 'array';
    protected $allowedFields  = ['id_pendataan', 'luas', 'momen'];
}
