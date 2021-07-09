<?php

namespace App\Models;

use CodeIgniter\Model;

class KeluargaModel extends Model
{
    protected $table      = 'keluarga';
    protected $primaryKey = 'nkk';

    protected $allowedFields = ['nkk', 'kepala_keluarga', 'kelurahan', 'jumlah_art', 'rt', 'rw'];
}
