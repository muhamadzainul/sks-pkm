<?php

namespace App\Controllers\Petugas;

use App\Models\Model_surat;

use App\Controllers\BaseController;

class Surat_sehat extends BaseController
{
    protected $suratModel;
    public function __construct()
    {
        $this->suratModel = new Model_surat();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
        // $data_pasien = $this->pasienModel->findAll();

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $sks = $this->suratModel->search($keyword);
        } else {
            $sks = $this->suratModel;
        }

        // $data_surat = $this->suratModel->findAll();
        $data = [
      // 'data_surat' => $data_surat
        'data_surat' => $sks->paginate(4),
        'pager' => $this->suratModel->pager,
        'currentPage' => $currentPage
    ];
        return view('/petugas/data_surat_sehat', $data);
    }

    public function tambah_data_surat()
    {
        $data = [
        'validation' => \Config\Services::validation()
      ];
        return view('/petugas/tambah_data_surat', $data);
    }

    public function simpan()
    {

      // Form Validasi
        if (!$this->validate([
          'nomor_surat' => [
            'rules' => 'required',
            'errors' => [
              'required' => 'NIK petugas harus di isi'
            ]
          ]
        ])) {
            // $valid = \Config\Services::validation();
            // return redirect()->to('/data_petugas/tambah_data_petugas')->withInput()->with('Validation', $valid);
            return redirect()->to('/data_petugas/tambah_data_surat')->withInput();
        }

        // $slug = url_title($this->request->getVar('nomor_surat'), '-', true);

        $this->suratModel->save([
          'nomor_surat' => $this->request->getVar('nomor_surat'),
          // 'slug' => $slug,
          'tinggi_badan' => $this->request->getVar('tinggi_badan'),
          'berat_badan' => $this->request->getVar('berat_badan'),
          'suhu_tubuh' => $this->request->getVar('suhu_tubuh'),
          'tensi_darah' => $this->request->getVar('tensi_darah'),
          'riwayat_penyakit' => $this->request->getVar('riwayat_penyakit'),
          'kepentingan' => $this->request->getVar('kepentingan')
        ]);

        session()->setFLashdata('pesan', 'Tambahkan');

        return redirect()->to('/surat_sehat');
    }

    public function hapus_data($id)
    {
        $this->suratModel->delete($id);

        session()->setFLashdata('pesan', 'Hapus');
        return redirect()->to('/surat_sehat');
    }

    public function edit_data($slug)
    {
        $data = [
      'validation' => \Config\Services::validation(),
      'data_petugas' => $this->petugasModel->getPetugas($slug)
    ];
        return view('/petugas/edit_data_petugas', $data);
    }

    public function update_data($id)
    {
        // data Alama
        $data_lama = $this->petugasModel->getPetugas($this->request->getVar('slug'));
        if ($data_lama['nik_petugas'] == $this->request->getVar('nik_petugas')) {
            $rule_nik = 'required';
        } else {
            $rule_nik = 'required|is_unique[satgas.nik_petugas]';
        }
        // Form Validasi
        if (!$this->validate([
          'nik_petugas' => [
            'rules' => $rule_nik,
            'errors' => [
              'required' => 'NIK petugas harus di isi',
              'is_unique' => 'NIK petugas sudah terdaftar'
            ]
          ],
          'foto_profil' => [
            'rules' => 'max_size[foto_profil, 2028]|is_image[foto_profil]|mime_in[foto_profil,image/jpg,image/jpeg,image/png]',
            'errors' =>[
              'max_size' => 'Ukuran Gambar Terlalu Besar',
              'is_image' => 'Yang Anda Masukkan Bukan File Gambar',
              'mime_in' => 'Yang Anda Masukkan Bukan File Gambar'
            ]
          ]
        ])) {
            // $valid = \Config\Services::validation();
            // return redirect()->to('/data_petugas/edit_data/'.$slug)->withInput()->with('Validation', $valid);
            return redirect()->to('/data_petugas/edit_data/'.$this->request->getVar('slug'))->withInput();
        }

        // Ambil File
        $file_FotoProfil = $this->request->getFile('foto_profil');
        // cek gambar
        // KTP
        if ($file_FotoProfil->getError() == 4) {
            if (empty($data_lama['foto_profil'])) {
                $nama_file = null;
            } else {
                $nama_file = $this->request->getVar('file_profil_lama');
            }
        } else {
            // pindah file ke directori kita
            unlink('gambar/profil_petugas/'.$this->request->getVar('file_profil_lama'));
            // nama File
            $nama_file = $file_FotoProfil->getRandomName();
            $file_FotoProfil->move('gambar/profil_petugas', $nama_file);
        }

        // cek slug
        if ($data_lama['nik_petugas'] == $this->request->getVar('nik_petugas') || $data_lama['nama_petugas'] == $this->request->getVar('nama_petugas')) {
            $slug = url_title($this->request->getVar('nik_petugas').'-'.$this->request->getVar('nama_petugas'), '-', true);
        } else {
            $slug = $this->request->getVar('slug');
        }

        $this->petugasModel->save([
        'id_satgas' => $id,
        'nama_petugas' => $this->request->getVar('nama_petugas'),
        'slug' => $slug,
        'nip_petugas' => $this->request->getVar('nip_petugas'),
        'nik_petugas' => $this->request->getVar('nik_petugas'),
        'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
        'alamat' => $this->request->getVar('alamat'),
        'no_hp' => $this->request->getVar('no_hp'),
        'email' => $this->request->getVar('email'),
        'foto_profil' => $nama_file
      ]);

        session()->setFLashdata('pesan', 'Ubah');

        return redirect()->to('/data_petugas');
    }
}
