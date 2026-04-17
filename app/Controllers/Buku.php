<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\KategoriModel;
use App\Models\PenulisModel;
use App\Models\PenerbitModel;
use App\Models\RakModel;


class Buku extends BaseController
{
protected $buku, $kategori, $penulis, $penerbit, $rak;

    public function __construct()
    {
        $this->buku = new BukuModel();
        $this->kategori = new KategoriModel();
        $this->penulis = new PenulisModel();
        $this->penerbit = new PenerbitModel();
        $this->rak = new RakModel();

    }

  public function index()
{
    $data['buku'] = $this->buku->getAll(); // ❗ penting
    return view('buku/index', $data);
}

public function detail($id)
{
    $data['buku'] = $this->buku->getDetail($id);
    return view('buku/detail',$data);
}
   public function create()
{
    $data['kategori'] = $this->kategori->findAll();
    $data['penulis']  = $this->penulis->findAll();
    $data['penerbit'] = $this->penerbit->findAll();

    return view('buku/create', $data);
}
   public function store()
{
    // KATEGORI
$nama_kategori = $this->request->getPost('nama_kategori');
$kategori = $this->kategori->where('nama_kategori', $nama_kategori)->first();
$id_kategori = $kategori ? $kategori['id_kategori'] : $this->kategori->insert(['nama_kategori'=>$nama_kategori]);

// PENULIS
$nama_penulis = $this->request->getPost('nama_penulis');
$penulis = $this->penulis->where('nama_penulis', $nama_penulis)->first();
$id_penulis = $penulis ? $penulis['id_penulis'] : $this->penulis->insert(['nama_penulis'=>$nama_penulis]);

// PENERBIT
$nama_penerbit = $this->request->getPost('nama_penerbit');
$penerbit = $this->penerbit->where('nama_penerbit', $nama_penerbit)->first();
$id_penerbit = $penerbit ? $penerbit['id_penerbit'] : $this->penerbit->insert(['nama_penerbit'=>$nama_penerbit]);

// RAK
$nama_rak = $this->request->getPost('nama_rak');
$rak = $this->rak->where('nama_rak', $nama_rak)->first();
$id_rak = $rak ? $rak['id_rak'] : $this->rak->insert(['nama_rak'=>$nama_rak]);
    

    // ========================
    // UPLOAD COVER
    // ========================
    $file = $this->request->getFile('cover');
    $namaFile = null;

    if ($file && $file->isValid()) {
        $namaFile = $file->getRandomName();
        $file->move('uploads/buku/', $namaFile);
    }

    // ========================
    // SIMPAN BUKU
    // ========================
    $this->buku->insert([
        'isbn' => $this->request->getPost('isbn'),
        'judul' => $this->request->getPost('judul'),
        'id_kategori' => $id_kategori,
        'id_penulis' => $id_penulis,
        'id_penerbit' => $id_penerbit,
        'tahun_terbit' => $this->request->getPost('tahun_terbit'),
        'jumlah' => $this->request->getPost('jumlah'),
        'tersedia' => $this->request->getPost('tersedia'),
        'deskripsi' => $this->request->getPost('deskripsi'),
        'cover' => $namaFile
    ]);

    return redirect()->to('/buku');
}
    public function delete($id)
    {
        $this->buku->delete($id);
        return redirect()->to('/buku');
    }
    

    public function edit($id)
{
    $data['buku'] = $this->buku->find($id);
    $data['kategori'] = $this->kategori->findAll();
    $data['penulis']  = $this->penulis->findAll();
    $data['penerbit'] = $this->penerbit->findAll();

    return view('buku/edit',$data);
}

   public function update($id)
{
    $this->buku->update($id,[
        'judul' => $this->request->getPost('judul'),
        'id_kategori' => $this->request->getPost('id_kategori'),
        'id_penulis' => $this->request->getPost('id_penulis'),
        'id_penerbit' => $this->request->getPost('id_penerbit'),
        'jumlah' => $this->request->getPost('jumlah'),
        'tersedia' => $this->request->getPost('tersedia')
    ]);

    return redirect()->to('/buku');
}

    public function filter()
    {
        $kategori = $this->request->getGet('kategori');
        $penulis = $this->request->getGet('penulis');
        $penerbit = $this->request->getGet('penerbit');

        $data['buku'] = $this->buku->filter($kategori,$penulis,$penerbit);

        return view('buku/index',$data);
    }
    public function getKategori()
{
    $keyword = $this->request->getGet('keyword');
    $data = $this->kategori
        ->like('nama_kategori', $keyword)
        ->findAll();

    return $this->response->setJSON(array_column($data, 'nama_kategori'));
}

public function getPenulis()
{
    $keyword = $this->request->getGet('keyword');
    $data = $this->penulis
        ->like('nama_penulis', $keyword)
        ->findAll();

    return $this->response->setJSON(array_column($data, 'nama_penulis'));
}

public function getPenerbit()
{
    $keyword = $this->request->getGet('keyword');
    $data = $this->penerbit
        ->like('nama_penerbit', $keyword)
        ->findAll();

    return $this->response->setJSON(array_column($data, 'nama_penerbit'));
}

public function getRak()
{
    $keyword = $this->request->getGet('keyword');
    $data = $this->rak
        ->like('nama_rak', $keyword)
        ->findAll();

    return $this->response->setJSON(array_column($data, 'nama_rak'));
}
}