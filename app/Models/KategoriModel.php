<?php

namespace App\Models;
use CodeIgniter\Model;
use App\Models\RakModel;
use App\Models\RakBukuModel;

class KategoriModel extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $allowedFields = ['nama_kategori'];
}