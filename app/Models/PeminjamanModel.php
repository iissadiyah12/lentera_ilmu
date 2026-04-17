<?php

namespace App\Models;
use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';

    protected $allowedFields = [
        'id_anggota',
        'id_petugas',
        'id_buku',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status'
    ];

    public function edit($id)
{
    $data['peminjaman'] = $this->peminjaman->find($id);
    $data['buku'] = $this->buku->findAll();
    $data['anggota'] = $this->anggota->findAll();
    $data['petugas'] = $this->petugas->findAll();

    return view('peminjaman/edit', $data);
}

   public function getAll()
{
    return $this->select('peminjaman.*, buku.judul, anggota.nis, petugas.jabatan')
        ->join('buku', 'buku.id_buku = peminjaman.id_buku')
        ->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota')
        ->join('petugas', 'petugas.id_petugas = peminjaman.id_petugas')
        ->findAll();
}
    public function filter($anggota, $petugas)
    {
        $builder = $this->builder();

        if ($anggota) {
            $builder->where('id_anggota', $anggota);
        }

        if ($petugas) {
            $builder->where('id_petugas', $petugas);
        }

        return $builder->get()->getResultArray();
    }
}