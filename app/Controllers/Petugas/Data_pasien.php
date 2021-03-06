<?php

namespace App\Controllers\Petugas;

use App\Models\Model_pasien;

use App\Controllers\BaseController;

class Data_pasien extends BaseController
{
    protected $pasienModel;
    public function __construct()
    {
        $this->pasienModel = new Model_pasien();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
        // $data_pasien = $this->pasienModel->findAll();

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $pasien = $this->pasienModel->search($keyword);
        } else {
            $pasien = $this->pasienModel;
        }

        $data = [
      // 'data_pasien' => $data_pasien
        'data_pasien' => $pasien->paginate(10),
        'pager' => $this->pasienModel->pager,
        'currentPage' => $currentPage
     ];
        return view('/petugas/data_pasien', $data);
    }

    public function tambah_data_pasien()
    {
        $data = [
        'validation' => \Config\Services::validation()
      ];
        return view('/petugas/tambah_data_pasien', $data);
    }

    public function simpan()
    {

      // Form Validasi
        if (!$this->validate([
          'nik_pasien' => [
            'rules' => 'required|is_unique[pasien.nik_pasien]',
            'errors' => [
              'required' => 'NIK pasien harus di isi',
              'is_unique' => 'NIK pasien sudah terdaftar'
            ]
          ],
          'foto_ktp' => [
            'rules' => 'max_size[foto_ktp, 2028]|is_image[foto_ktp]|mime_in[foto_ktp,image/jpg,image/jpeg,image/png]',
            'errors' =>[
              'max_size' => 'Ukuran Gambar Terlalu Besar',
              'is_image' => 'Yang Anda Masukkan Bukan File Gambar',
              'mime_in' => 'Yang Anda Masukkan Bukan File Gambar'
            ]
          ],
          'foto_kk' => [
            'rules' => 'max_size[foto_kk, 2028]|is_image[foto_kk]|mime_in[foto_kk,image/jpg,image/jpeg,image/png]',
            'errors' =>[
              'max_size' => 'Ukuran Gambar Terlalu Besar',
              'is_image' => 'Yang Anda Masukkan Bukan File Gambar',
              'mime_in' => 'Yang Anda Masukkan Bukan File Gambar'
            ]
          ]
        ])) {
            // $valid = \Config\Services::validation();
            // return redirect()->to('/data_pasien/tambah_data_pasien')->withInput()->with('Validation', $valid);
            return redirect()->to('/data_pasien/tambah_data_pasien')->withInput();
        }

        // Ambil File
        $file_Fotoktp = $this->request->getFile('foto_ktp');
        $file_Fotokk = $this->request->getFile('foto_kk');
        // nama File
        $nama_file = $file_Fotoktp->getRandomName();
        // pindah file ke directori kita
        if ($file_Fotoktp->getError() == 4) {
            $nama_file_ktp = null;
        } else {
            $nama_file_ktp = 'KTP - '.$nama_file;
            $file_Fotoktp->move('gambar/foto_ktp', 'KTP - '.$nama_file);
        }
        if ($file_Fotokk->getError() == 4) {
            $nama_file_kk = null;
        } else {
            $nama_file_kk = 'KK - '.$nama_file;
            $file_Fotokk->move('gambar/foto_kk', 'KK - '.$nama_file);
        }

        $slug = url_title($this->request->getVar('nik_pasien').'-'.$this->request->getVar('nama_pasien'), '-', true);

        $this->pasienModel->save([
          'nama_pasien' => $this->request->getVar('nama_pasien'),
          'slug' => $slug,
          'nik_pasien' => $this->request->getVar('nik_pasien'),
          'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
          'alamat' => $this->request->getVar('alamat'),
          'no_hp' => $this->request->getVar('no_hp'),
          'email' => $this->request->getVar('email'),
          'foto_ktp' => $nama_file_ktp,
          'foto_kk' => $nama_file_kk
        ]);

        session()->setFLashdata('pesan', 'Tambahkan');

        return redirect()->to('/petugas/data_pasien');
    }

    public function hapus_data($id)
    {
        // cari nama gambar berdasarkan id
        $pasien_data = $this->pasienModel->find($id);
        // hapus Gambar
        if (!empty($pasien_data['foto_kk'])) {
            unlink('gambar/foto_kk/'.$pasien_data['foto_kk']);
        }
        if (!empty($pasien_data['foto_ktp'])) {
            unlink('gambar/foto_ktp/'.$pasien_data['foto_ktp']);
        }
        $this->pasienModel->delete($id);

        session()->setFLashdata('pesan', 'Hapus');
        return redirect()->to('/petugas/data_pasien');
    }

    public function edit_data($slug)
    {
        $data = [
      'validation' => \Config\Services::validation(),
      'data_pasien' => $this->pasienModel->getPasien($slug)
    ];
        return view('/petugas/edit_data_pasien', $data);
    }

    public function update_data($id)
    {
        // data Alama
        $data_lama = $this->pasienModel->getPasien($this->request->getVar('slug'));
        if ($data_lama['nik_pasien'] == $this->request->getVar('nik_pasien')) {
            $rule_nik = 'required';
        } else {
            $rule_nik = 'required|is_unique[pasien.nik_pasien]';
        }
        // Form Validasi
        if (!$this->validate([
          'nik_pasien' => [
            'rules' => $rule_nik,
            'errors' => [
              'required' => 'NIK pasien harus di isi',
              'is_unique' => 'NIK pasien sudah terdaftar'
            ]
          ],
          'foto_ktp' => [
            'rules' => 'max_size[foto_ktp, 2028]|is_image[foto_ktp]|mime_in[foto_ktp,image/jpg,image/jpeg,image/png]',
            'errors' =>[
              'max_size' => 'Ukuran Gambar Terlalu Besar',
              'is_image' => 'Yang Anda Masukkan Bukan File Gambar',
              'mime_in' => 'Yang Anda Masukkan Bukan File Gambar'
            ]
          ],
          'foto_kk' => [
            'rules' => 'max_size[foto_kk, 2028]|is_image[foto_kk]|mime_in[foto_kk,image/jpg,image/jpeg,image/png]',
            'errors' =>[
              'max_size' => 'Ukuran Gambar Terlalu Besar',
              'is_image' => 'Yang Anda Masukkan Bukan File Gambar',
              'mime_in' => 'Yang Anda Masukkan Bukan File Gambar'
            ]
          ]
        ])) {
            // $valid = \Config\Services::validation();
            // return redirect()->to('/data_pasien/edit_data/'.$slug)->withInput()->with('Validation', $valid);
            return redirect()->to('/petugas/data_pasien/edit_data/'.$this->request->getVar('slug'))->withInput();
        }

        // Ambil File
        $file_Fotoktp = $this->request->getFile('foto_ktp');
        $file_Fotokk = $this->request->getFile('foto_kk');
        // nama File
        $nama_file = $file_Fotoktp->getRandomName();
        // cek gambar
        // KTP
        if ($file_Fotoktp->getError() == 4) {
            if (empty($data_lama['foto_ktp'])) {
                $nama_file_ktp = null;
            } else {
                $nama_file_ktp = $this->request->getVar('file_ktp_lama');
            }
        } else {
            // pindah file ke directori kita
            unlink('gambar/foto_ktp/'.$this->request->getVar('file_ktp_lama'));
            $nama_file_ktp = 'KTP - '.$nama_file;
            $file_Fotoktp->move('gambar/foto_ktp', 'KTP - '.$nama_file);
        }
        // KK
        if ($file_Fotokk->getError() == 4) {
            if (empty($data_lama['foto_kk'])) {
                $nama_file_kk = null;
            } else {
                $nama_file_kk = $this->request->getVar('file_kk_lama');
            }
        } else {
            unlink('gambar/foto_kk/'.$this->request->getVar('file_kk_lama'));
            $nama_file_kk = 'KK - '.$nama_file;
            $file_Fotokk->move('gambar/foto_kk', 'KK - '.$nama_file);
        }

        // cek slug
        if ($data_lama['nik_pasien'] == $this->request->getVar('nik_pasien') || $data_lama['nama_pasien'] == $this->request->getVar('nama_pasien')) {
            $slug = url_title($this->request->getVar('nik_pasien').'-'.$this->request->getVar('nama_pasien'), '-', true);
        } else {
            $slug = $this->request->getVar('slug');
        }

        $this->pasienModel->save([
        'id_pasien' => $id,
        'nama_pasien' => $this->request->getVar('nama_pasien'),
        'slug' => $slug,
        'nik_pasien' => $this->request->getVar('nik_pasien'),
        'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
        'alamat' => $this->request->getVar('alamat'),
        'no_hp' => $this->request->getVar('no_hp'),
        'email' => $this->request->getVar('email'),
        'foto_ktp' => $nama_file_ktp,
        'foto_kk' => $nama_file_kk
      ]);

        session()->setFLashdata('pesan', 'Ubah');

        return redirect()->to('/petugas/data_pasien/detail_pasien/'.$slug);
    }
    public function detail_pasien($slug)
    {
        $data = [
      'validation' => \Config\Services::validation(),
      'data_pasien' => $this->pasienModel->getPasien($slug)
    ];
        return view('/petugas/detail_pasien', $data);
    }
}
