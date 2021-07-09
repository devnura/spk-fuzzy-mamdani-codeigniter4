<?php

namespace App\Models;

use CodeIgniter\Model;

class TahunAktifModel extends Model
{
    protected $table          = 'tahun_aktif';
    protected $primaryKey     = 'tahun_aktif';
    protected $returnType     = 'array';
    protected $allowedFields  = ['tahun_aktif', 'tanggal_pembukaan', 'tanggal_penutupan', 'status_aktif'];
}
