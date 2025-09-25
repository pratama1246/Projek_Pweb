<?php

namespace App\Controllers;

use App\Models\BukuModel;

class Buku extends BaseController{

    protected $BukuModel;

    public function __construct(){
        $this->BukuModel = new BukuModel();
    }

    public function index(){
        $current = $this->request->getVar('page_buku') ? $this->request->getVar('page_buku') : 1; // ubah 1
        $cari = $this->request->getVar('cari');
        if($cari){
            $buku = $this->BukuModel->findBuku($cari); // ubah 1
        }else{
            $buku = $this->BukuModel->getBuku();
        }

        $data = [
            'title' => 'Daftar Buku',
            'buku' => $this->BukuModel->paginate(2, 'buku'), // ubah 2
            'pager' => $this->BukuModel->pager,
            'current' => $current
        ];

        return view('buku/index', $data);
    }

    public function detail($idbuku){
        $data = [
            'title' => 'Detail Buku',
            'buku' => $this->BukuModel->getBuku($idbuku)
        ];

        return view('buku/detail', $data);
    }

    public function tambah(){
        $data = [
            'title' => 'Form Tambah Data Buku',
            'validation' => \Config\Services::validation()
        ];

        return view('buku/tambah', $data);
    }

    public function simpan()
{
    // Validasi input
    if (!$this->validate([
        'judul' => [
            'rules' => 'required|is_unique[buku.judul]',
            'errors' => [
                'required' => '{field} harus diisi',
                'is_unique' => '{field} sudah terdaftar'
            ]
        ],
        'pengarang' => [
            'rules' => 'required',
            'errors' => [
                'required' => '{field} harus diisi'
            ]
        ],
        'penerbit' => [
            'rules' => 'required',
            'errors' => [
                'required' => '{field} harus diisi'
            ]
        ],
        'tahun_terbit' => [
            'rules' => 'required',
            'errors' => [
                'required' => '{field} harus diisi'
            ]
        ],
        'sampul' => [
            'rules' => 'uploaded[sampul]|max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
            'errors' => [
                'uploaded' => 'Gambar Wajib Dipilih',
                'max_size' => 'Ukuran gambar terlalu besar',
                'is_image' => 'File Wajib Gambar',
                'mime_in' => 'Tipe File Gambar Tidak Sesuai'
            ]
        ]
    ])) {
        // Redirect kembali dengan input dan validasi
        return redirect()->to('/buku/tambah')->withInput();
    }

    // Ambil file yang diunggah
    $fileSampul = $this->request->getFile('sampul');
    
    // Beri nama acak untuk file
    $namaSampul = $fileSampul->getName();

    // Pindahkan file ke folder img
    $fileSampul->move('img', $namaSampul);

    // Simpan data ke database
    $this->BukuModel->save([
        'judul'        => $this->request->getVar('judul'),
        'pengarang'    => $this->request->getVar('pengarang'),
        'penerbit'     => $this->request->getVar('penerbit'),
        'tahun_terbit' => $this->request->getVar('tahun_terbit'),
        'sampul'       => $namaSampul
    ]);

    session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
    return redirect()->to('/buku');
}

    public function hapus($idbuku){
        $this->BukuModel->delete($idbuku);
        session()->setFlashdata('pesan', 'Data buku berhasil dihapus.');
        return redirect()->to('/buku');
    }
    
    public function ubah($idbuku){
        $data = [
            'title' => 'Form Ubah Data Buku',
            'validation' => \Config\Services::validation(),
            'buku' => $this->BukuModel->getBuku($idbuku)
        ];

        return view('buku/ubah', $data);
    }

   public function update($idbuku)
    {
        // Cek Judul: Validasi unik (is_unique) di form ubah.
        $bukuLama = $this->BukuModel->getBuku($this->request->getVar('id_buku'));
        if ($bukuLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[buku.judul]';
        }

        // Validasi Form
        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} buku sudah terdaftar'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang Anda pilih bukan gambar',
                    'mime_in' => 'Yang Anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/buku/ubah/' . $this->request->getVar('id_buku'))->withInput();
        }

        // Ambil gambar yang diunggah
        $fileSampul = $this->request->getFile('sampul');

        // Cek apakah ada file yang diunggah (error code 4 berarti tidak ada file)
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            // Beri nama acak untuk file
            $namaSampul = $fileSampul->getName();

            // Pindahkan file ke folder img
            $fileSampul->move('img', $namaSampul);

            // Hapus file lama, kecuali jika itu gambar default
            if ($this->request->getVar('sampulLama') != 'default.jpg') {
                unlink('img/' . $this->request->getVar('sampulLama'));
            }
        }

        // Simpan data yang diperbarui ke database
        $this->BukuModel->save([
            'id_buku' => $idbuku,
            'judul' => $this->request->getVar('judul'),
            'pengarang' => $this->request->getVar('pengarang'),
            'penerbit' => $this->request->getVar('penerbit'),
            'tahun_terbit' => $this->request->getVar('tahun_terbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data buku berhasil diubah.');

        return redirect()->to('/buku');
    }

}