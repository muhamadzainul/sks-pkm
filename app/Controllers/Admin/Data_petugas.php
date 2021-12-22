<?php

namespace App\Controllers\Admin;

use App\Models\Model_petugas;

use App\Controllers\BaseController;

class Data_petugas extends BaseController
{
  protected $petugasModel;
  protected $userPetugas;
  public function __construct()
  {
    $this->petugasModel = new Model_petugas();
    $this->db           = \Config\Database::connect();
    $this->userPetugas  = $this->db->table('users');
  }

  public function index()
  {
    $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
    // $data_pasien = $this->pasienModel->findAll();

    $this->userPetugas->select('users.id as id_satgas, email, fullname, user_profile, auth_groups_users.group_id as akses');
    $this->userPetugas->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
    $this->userPetugas->join('auth_groups', 'auth_groups_users.group_id = auth_groups.id');
    $query = $this->userPetugas->get();

    $keyword = $this->request->getVar('keyword');

    if ($keyword) {
      $petugas = $this->petugasModel->search($keyword);
    } else {
      $petugas = $this->petugasModel;
    }

    // $data_petugas = $this->petugasModel->findAll();
    $data = [
      // 'data_petugas' => $data_petugas
      'title'         => 'Data Petugas',
      'data_petugas'  => $query->getResultArray(),
      // 'pager'         => $this->petugasModel->pager,
      // 'currentPage'   => $currentPage
    ];
    return view('/administrator/data_petugas', $data);
  }

  public function tambah_data_petugas()
  {
    $data = [
      'title'    => 'Tambah Data Petugas',
      'validation' => \Config\Services::validation()
    ];
    return view('/administrator/tambah_data_petugas', $data);
  }

  public function simpan()
  {

    // Form Validasi
    if (!$this->validate([
      'nik_petugas' => [
        'rules' => 'required|is_unique[satgas.nik_petugas]',
        'errors' => [
          'required' => 'NIK petugas harus di isi',
          'is_unique' => 'NIK petugas sudah terdaftar'
        ]
      ],
      'foto_profil' => [
        'rules' => 'max_size[foto_profil, 2028]|is_image[foto_profil]|mime_in[foto_profil,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'max_size' => 'Ukuran Gambar Terlalu Besar',
          'is_image' => 'Yang Anda Masukkan Bukan File Gambar',
          'mime_in' => 'Yang Anda Masukkan Bukan File Gambar'
        ]
      ]
    ])) {
      // $valid = \Config\Services::validation();
      // return redirect()->to('/admin/data_petugas/tambah_data_petugas')->withInput()->with('Validation', $valid);
      return redirect()->to('/admin/data_petugas/tambah_data_petugas')->withInput();
    }

    // Ambil File
    $file_FotoProfil = $this->request->getFile('foto_profil');
    // pindah file ke directori kita
    if ($file_FotoProfil->getError() == 4) {
      $nama_file = null;
    } else {
      // nama File
      $nama_file = $file_FotoProfil->getRandomName();
      $file_FotoProfil->move('gambar/profil_petugas', $nama_file);
    }

    $slug = url_title($this->request->getVar('nik_petugas') . '-' . $this->request->getVar('nama_petugas'), '-', true);

    $this->petugasModel->save([
      'nama_petugas' => $this->request->getVar('nama_petugas'),
      'slug' => $slug,
      'nip_petugas' => $this->request->getVar('nip_petugas'),
      'nik_petugas' => $this->request->getVar('nik_petugas'),
      'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
      'alamat' => $this->request->getVar('alamat'),
      'no_hp' => $this->request->getVar('no_hp'),
      'email' => $this->request->getVar('email'),
      'foto_profil' => $nama_file,
    ]);

    session()->setFLashdata('pesan', 'Tambahkan');

    return redirect()->to('/admin/data_petugas');
  }

  public function hapus_data($id)
  {

    $this->userPetugas->select('users.id as id_satgas, user_profile, auth_groups_users.group_id as akses');
    $this->userPetugas->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
    $this->userPetugas->join('auth_groups', 'auth_groups_users.group_id = auth_groups.id');
    $query = $this->userPetugas->get();
    $petugas_data = $query->getResultArray();

    // cari nama gambar berdasarkan id
    // $petugas_data = $this->petugasModel->find($id);
    // hapus Gambar
    if (!empty($petugas_data['user_profile'])) {
      if ($petugas_data['user_profile'] != 'default-profile.png') {
        unlink('gambar/profil_petugas/' . $petugas_data['user_profile']);
      }
    }
    $this->table_akses = $this->db->table('auth_groups_users');
    $this->table_akses->delete(['user_id' => $id]);
    $this->userPetugas->delete(['id' => $id]);
    // $this->petugasModel->delete($id);


    session()->setFLashdata('pesan', 'Hapus');
    return redirect()->to('/admin/data_petugas');
  }

  public function edit_data($slug)
  {
    $data = [
      'title'    => 'Edit Data Petugas',
      'validation' => \Config\Services::validation(),
      'data_petugas' => $this->petugasModel->getPetugas($slug)
    ];
    return view('/administrator/edit_data_petugas', $data);
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
        'errors' => [
          'max_size' => 'Ukuran Gambar Terlalu Besar',
          'is_image' => 'Yang Anda Masukkan Bukan File Gambar',
          'mime_in' => 'Yang Anda Masukkan Bukan File Gambar'
        ]
      ]
    ])) {
      // $valid = \Config\Services::validation();
      // return redirect()->to('/admin/data_petugas/edit_data/'.$slug)->withInput()->with('Validation', $valid);
      return redirect()->to('/admin/data_petugas/edit_data/' . $this->request->getVar('slug'))->withInput();
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
      if ($data_lama['foto_profil'] != 'default-profil.png') {
        if (!empty($data_lama['foto_profil'])) {
          unlink('gambar/profil_petugas/' . $this->request->getVar('file_profil_lama'));
        }
      }
      // nama File
      $nama_file = $file_FotoProfil->getRandomName();
      $file_FotoProfil->move('gambar/profil_petugas', $nama_file);
    }

    // cek slug
    if ($data_lama['nik_petugas'] == $this->request->getVar('nik_petugas') || $data_lama['nama_petugas'] == $this->request->getVar('nama_petugas')) {
      $slug = url_title($this->request->getVar('nik_petugas') . '-' . $this->request->getVar('nama_petugas'), '-', true);
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

    return redirect()->to('/admin/data_petugas/detail_petugas/' . $slug);
  }
  public function detail_petugas($slug)
  {
    $data = [
      'title'    => 'Detail Data Petugas',
      'validation' => \Config\Services::validation(),
      'data_petugas' => $this->petugasModel->getPetugas($slug)
    ];
    return view('/administrator/detail_petugas', $data);
  }
}
