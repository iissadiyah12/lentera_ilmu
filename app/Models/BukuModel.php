<?php

namespace App\Models;
use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'id_buku';

    protected $allowedFields = [
        'isbn','judul','id_kategori','id_penulis','id_penerbit',
        'tahun_terbit','jumlah','tersedia','deskripsi','cover'
    ];

    public function getAll()
    {
        return $this->db->table('buku')
            ->select('buku.*, kategori.nama_kategori, penulis.nama_penulis, penerbit.nama_penerbit')
            ->join('kategori','kategori.id_kategori=buku.id_kategori','left')
            ->join('penulis','penulis.id_penulis=buku.id_penulis','left')
            ->join('penerbit','penerbit.id_penerbit=buku.id_penerbit','left')
            ->get()->getResultArray();
    }

    public function filter($kategori, $penulis, $penerbit)
    {
        $builder = $this->db->table('buku')
            ->select('buku.*, kategori.nama_kategori, penulis.nama_penulis, penerbit.nama_penerbit')
            ->join('kategori','kategori.id_kategori=buku.id_kategori','left')
            ->join('penulis','penulis.id_penulis=buku.id_penulis','left')
            ->join('penerbit','penerbit.id_penerbit=buku.id_penerbit','left');

        if($kategori) $builder->where('buku.id_kategori',$kategori);
        if($penulis) $builder->where('buku.id_penulis',$penulis);
        if($penerbit) $builder->where('buku.id_penerbit',$penerbit);

        return $builder->get()->getResultArray();
    }

    public function getDetail($id)
{
    return $this->db->table('buku')
        ->select('buku.*, 
                  kategori.nama_kategori, kategori.deskripsi as deskripsi_kategori,
                  penulis.nama_penulis, penulis.alamat as alamat_penulis, penulis.no_hp as hp_penulis,
                  penerbit.nama_penerbit, penerbit.alamat as alamat_penerbit, penerbit.no_hp as hp_penerbit')
        ->join('kategori','kategori.id_kategori=buku.id_kategori','left')
        ->join('penulis','penulis.id_penulis=buku.id_penulis','left')
        ->join('penerbit','penerbit.id_penerbit=buku.id_penerbit','left')
        ->where('buku.id_buku', $id)
        ->get()
        ->getRowArray();
}
}