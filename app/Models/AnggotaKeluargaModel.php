<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaKeluargaModel extends Model
{
    protected $table      = 'anggota_keluarga';
    protected $primaryKey = 'nik';
    protected $returnType     = 'array';

    protected $allowedFields = [
        'nik',
        'nkk',
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'hubungan_keluarga'
    ];
}
