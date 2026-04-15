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
        $data['buku'] = $this->buku->getAll();
        return view('buku/index',$data);
    }

    public function create()
    {
        return view('buku/create');
    }

    public function store()
    {
        // insert kategori
        $id_kategori = $this->kategori->insert([
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'deskripsi' => $this->request->getPost('deskripsi_kategori')
        ]);

        // insert penulis
        $id_penulis = $this->penulis->insert([
            'nama_penulis' => $this->request->getPost('nama_penulis'),
            'alamat' => $this->request->getPost('alamat_penulis'),
            'no_hp' => $this->request->getPost('hp_penulis')
        ]);

        // insert penerbit
        $id_penerbit = $this->penerbit->insert([
            'nama_penerbit' => $this->request->getPost('nama_penerbit'),
            'alamat' => $this->request->getPost('alamat_penerbit'),
            'no_hp' => $this->request->getPost('hp_penerbit')
        ]);

        // insert buku
        $this->buku->insert([
            'isbn' => $this->request->getPost('isbn'),
            'judul' => $this->request->getPost('judul'),
            'id_kategori' => $id_kategori,
            'id_penulis' => $id_penulis,
            'id_penerbit' => $id_penerbit,
            'tahun_terbit' => $this->request->getPost('tahun'),
            'jumlah' => $this->request->getPost('jumlah'),
            'tersedia' => $this->request->getPost('tersedia'),
            'deskripsi' => $this->request->getPost('deskripsi')
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
        return view('buku/edit',$data);
    }

    public function update($id)
    {
        $this->buku->update($id,[
            'judul' => $this->request->getPost('judul'),
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