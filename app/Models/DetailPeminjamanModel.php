<?php

namespace App\Models;
use CodeIgniter\Model;

class DetailPeminjamanModel extends Model
{
    protected $table = 'detail_peminjaman';
    protected $primaryKey = 'id_detail';

    protected $allowedFields = [
        'id_peminjaman',
        'id_buku',
        'jumlah'
    ];

    public function getDetail($id_peminjaman)
    {
        return $this->select('detail_peminjaman.*, buku.judul, buku.cover')
            ->join('buku', 'buku.id_buku = detail_peminjaman.id_buku')
            ->where('detail_peminjaman.id_peminjaman', $id_peminjaman)
            ->findAll();
    }
}