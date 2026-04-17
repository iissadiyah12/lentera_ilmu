<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\BukuModel;
use App\Models\AnggotaModel;
use App\Models\PetugasModel;

class Peminjaman extends BaseController
{
    protected $peminjaman, $buku, $anggota, $petugas;

    public function __construct()
    {
        $this->peminjaman = new PeminjamanModel();
        $this->buku = new BukuModel();
        $this->anggota = new AnggotaModel();
        $this->petugas = new PetugasModel();
    }

    public function index()
{
    $data['peminjaman'] = $this->peminjaman->getAll();
    return view('peminjaman/index', $data);
}

    public function update($id)
{
    $this->peminjaman->update($id, [
        'id_buku' => $this->request->getPost('id_buku'),
        'id_anggota' => $this->request->getPost('id_anggota'),
        'id_petugas' => $this->request->getPost('id_petugas'),
        'tanggal_pinjam' => $this->request->getPost('tanggal_pinjam'),
        'tanggal_kembali' => $this->request->getPost('tanggal_kembali'),
        'status' => $this->request->getPost('status')
    ]);

    return redirect()->to('/peminjaman');
}

public function detail($id)
{
    $detailModel = new PeminjamanModel();

    $data['peminjaman'] = $this->peminjaman
        ->select('peminjaman.*, anggota.nis, petugas.jabatan')
        ->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota')
        ->join('petugas', 'petugas.id_petugas = peminjaman.id_petugas')
        ->where('id_peminjaman', $id)
        ->first();

    $data['detail'] = $detailModel->getDetail($id);

    return view('peminjaman/detail', $data);
}

    public function create()
    {
        $data['buku'] = $this->buku->findAll();
        $data['anggota'] = $this->anggota->findAll();
        $data['petugas'] = $this->petugas->findAll();

        return view('peminjaman/create', $data);
    }

    public function edit($id)
{
    $data['peminjaman'] = $this->peminjaman->find($id);
    $data['buku'] = $this->buku->findAll();
    $data['anggota'] = $this->anggota->findAll();
    $data['petugas'] = $this->petugas->findAll();

    return view('peminjaman/edit', $data);
}

    public function store()
    {
        $id_buku = $this->request->getPost('id_buku');
        $jumlah_pinjam = 1; // default 1 buku

        $buku = $this->buku->find($id_buku);

        // ❌ jika stok habis
        if ($buku['tersedia'] <= 0) {
            return redirect()->back()->with('error', 'Stok buku habis!');
        }

        // ✅ simpan peminjaman
        $this->peminjaman->insert([
            'id_anggota' => $this->request->getPost('id_anggota'),
            'id_petugas' => $this->request->getPost('id_petugas'),
            'id_buku' => $id_buku,
            'tanggal_pinjam' => $this->request->getPost('tanggal_pinjam'),
            'tanggal_kembali' => $this->request->getPost('tanggal_kembali'),
            'status' => 'dipinjam'
        ]);

        // ✅ update stok buku
        $this->buku->update($id_buku, [
            'tersedia' => $buku['tersedia'] - $jumlah_pinjam
        ]);

        return redirect()->to('/peminjaman');
    }

    public function delete($id)
    {
        $this->peminjaman->delete($id);
        return redirect()->to('/peminjaman');
    }

    
}