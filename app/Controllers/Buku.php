<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\KategoriModel;
use App\Models\PenulisModel;
use App\Models\PenerbitModel;

class Buku extends BaseController
{
    protected $buku, $kategori, $penulis, $penerbit;

    public function __construct()
    {
        $this->buku = new BukuModel();
        $this->kategori = new KategoriModel();
        $this->penulis = new PenulisModel();
        $this->penerbit = new PenerbitModel();
    }

   public function index()
{
    $keyword = $this->request->getGet('keyword');

    if ($keyword) {
        $data['buku'] = $this->buku
            ->like('judul', $keyword)
            ->orderBy("judul LIKE '$keyword%'", 'DESC') // prioritas depan
            ->orderBy('judul', 'ASC')
            ->findAll();
    } else {
        $data['buku'] = $this->buku->findAll();
    }

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
   $file = $this->request->getFile('cover');

if ($file && $file->isValid()) {
    $namaFile = $file->getRandomName();
    $file->move('uploads/buku/', $namaFile);
}

    $this->buku->insert([
        'isbn' => $this->request->getPost('isbn'),
        'judul' => $this->request->getPost('judul'),
        'id_kategori' => $this->request->getPost('id_kategori'),
        'id_penulis' => $this->request->getPost('id_penulis'),
        'id_penerbit' => $this->request->getPost('id_penerbit'),
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
}