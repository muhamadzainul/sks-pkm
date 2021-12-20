<?php

namespace App\Controllers\Admin;

use App\Models\Model_surat;
use App\Models\Model_pasien;

use App\Controllers\BaseController;

class Surat_sehat extends BaseController
{
  protected $suratModel;
  protected $pasienModel;
  protected $db;
  protected $suratBuilder;
  protected $pasienBuilder;
  protected $rsaBuilder;
  public function __construct()
  {
    $this->suratModel     = new Model_surat();
    $this->pasienModel    = new Model_pasien();
    $this->db             = \Config\Database::connect();
    $this->suratBuilder   = $this->db->table('surat_kesehatan');
    $this->pasienBuilder   = $this->db->table('pasien');
    $this->kapusBuilder   = $this->db->table('kapus');
    $this->rsaBuilder   = $this->db->table('surat_rsa');
  }

  public function index()
  {
    $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
    // $data_pasien = $this->pasienModel->findAll();


    $this->suratBuilder->select('id_sks, nomor_surat, surat_kesehatan.nik_pasien as nik_p, pasien.tgl_lahir, nama_pasien, kepentingan, hasil_periksa, surat_kesehatan.tanggal_dibuat as tgl_dibuat, TIMESTAMPDIFF(
MONTH , pasien.tgl_lahir, NOW() ) AS umur');
    $this->suratBuilder->join('pasien', 'pasien.nik_pasien = surat_kesehatan.nik_pasien');
    $this->suratBuilder->orderBy('id_sks', 'DESC');

    $keyword = $this->request->getVar('keyword');

    if ($keyword) {
      // $sks = $this->suratModel->search($keyword);
      $this->suratBuilder->like('nama_pasien', $keyword);
      $this->suratBuilder->orLike('surat_kesehatan.nik_pasien', $keyword);
      $query = $this->suratBuilder->get();
    } else {
      $query = $this->suratBuilder->get();
    }

    // $data_surat = $this->suratModel->findAll();
    $data = [
      // 'data_surat' => $data_surat
      // 'cek_data' => $kosong,
      // 'data_surat' => $sks->paginate(4),
      // 'pager' => $this->suratModel->pager,
      // 'currentPage' => $currentPage
      'title'    => 'Data Surat',
      'data_surat' => $query->getResultArray()
    ];
    return view('/administrator/data_surat_sehat', $data);
  }

  public function tambah_data_surat()
  {
    $this->suratBuilder->select('id_sks, nomor_surat, surat_kesehatan.nik_pasien as nik_p, nama_pasien, jenis_kelamin, tgl_lahir, alamat,
        pekerjaan, kepentingan, tinggi_badan, berat_badan, tensi_darah, suhu_tubuh, nadi, respirasi, mata_buta, tubuh_tato, tubuh_tindik,
        hasil_periksa, nama_kapus, kapus.nip_kapus as nip_kp, nama_kapus, TIMESTAMPDIFF(
MONTH , pasien.tgl_lahir, NOW() ) AS umur');
    $this->suratBuilder->join('pasien', 'pasien.nik_pasien = surat_kesehatan.nik_pasien');
    $this->suratBuilder->join('kapus', 'kapus.nip_kapus = surat_kesehatan.nip_kapus');


    $keyword = $this->request->getVar('keyword');
    // dd($keyword);

    if ($keyword) {
      $this->pasienBuilder->select('id_pasien, nik_pasien, nama_pasien, jenis_kelamin, tgl_lahir, alamat, TIMESTAMPDIFF(
      MONTH , pasien.tgl_lahir, NOW() ) AS umur');
      // $sks = $this->suratModel->search($keyword);
      $this->pasienBuilder->like('nama_pasien', $keyword);
      $this->pasienBuilder->orLike('nik_pasien', $keyword);
      $querySurat = $this->suratBuilder->get();
      $queryPasien = $this->pasienBuilder->get();
      $data_pasien = $queryPasien->getResultArray();
      // $kosong = $keyword;
    }
    if ($keyword == null) {
      $querySurat = $this->suratBuilder->get();
      $data_pasien = null;
      // $kosong = null;
    }

    //   if ($keyword) {
    //       // $sks = $this->suratModel->search($keyword);
    //       $this->suratBuilder->like('nama_pasien', $keyword);
    //       $this->suratBuilder->orLike('surat_kesehatan.nik_pasien', $keyword);
    //       $query = $this->suratBuilder->get();
    //   } else {
    //       $query = $this->suratBuilder->get();
    //   }
    //
    $data = [
      'title'       => 'Tambah Daa Surat',
      'validation'  => \Config\Services::validation(),
      'data_surat'  => $querySurat->getResultArray(),
      'data_pasien' => $data_pasien,
      'kosong'      => $keyword
    ];

    return view('/administrator/tambah_data_surat', $data);
  }

  public function simpan($id = null)
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

    // dd($this->request->getVar('nip_kapus'));
    // dd($this->request->getVar('nik_pasien'));

    $slug       = url_title($this->request->getVar('nomor_surat') . '-' . $this->request->getVar('nama_pasien'), '-', true);
    $slugPasien = url_title($this->request->getVar('nik_pasien') . '-' . $this->request->getVar('nama_pasien'), '-', true);

    //
    // $pasienBuilder = $this->db->table('pasien');
    // $data=[
    //   'nik_pasien'    => $this->request->getVar('nik_pasien'),
    //   'slug'          => $slugPasien,
    //   'nama_pasien'   => $this->request->getVar('nama_pasien'),
    //   'tgl_lahir'     => $this->request->getVar('tgl_lahir'),
    //   'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
    //   'alamat'        => $this->request->getVar('alamat')
    //
    // ];

    $cek_date = date("Y-m-d", time());
    $te = explode("-", $cek_date);
    $tm = (intval($te[2]) + 2);
    $tgl_exp = ($te[0] . "-" . $te[1] . "-" . $tm) . "<br>";

    $gen_key = get_key();

    if ($id == null) {

      $this->pasienBuilder->select('nik_pasien');
      $this->pasienBuilder->where('nik_pasien', $this->request->getVar('nik_pasien'));
      $query = $this->pasienBuilder->get();
      $queryp = $query->getResult();
      // dd(empty($queryp));

      if (empty($queryp)) {
        $this->pasienModel->insert([
          'nik_pasien'          => $this->request->getVar('nik_pasien'),
          'slug'                => $slugPasien,
          'nama_pasien'         => $this->request->getVar('nama_pasien'),
          'tgl_lahir'           => $this->request->getVar('tgl_lahir'),
          'jenis_kelamin'       => $this->request->getVar('jenis_kelamin'),
          'alamat'              => $this->request->getVar('alamat'),
          'publik_key'          => $gen_key[0],
          'private_key'         => $gen_key[1],
          'hash_publik_key'     => md5($gen_key[0]),
          'hash_private_key'    => md5($gen_key[1]),
          'tanggal_dibuat'      => date("Y-m-d", time()),
          'tanggal_diubah'      => date("Y-m-d", time()),
        ]);
      }
    }
    // $pasienBuilder->insert($data);

    // $this->suratBuilder->select('pasien.nik_pasien');
    // $this->suratBuilder->join('pasien', 'pasien.nik_pasien = surat_kesehatan.nik_pasien');
    // $this->suratModel->where('nik_pasien', $this->request->getVar('nik_pasien'))
    // $query = $this->suratBuilder->get();

    // $this->suratBuilder->select('kapus.nip_kapus');
    // $this->suratBuilder->join('kapus', 'kapus.nip_kapus = surat_kesehatan.nip_kapus');
    // $query2 = $this->suratBuilder->get();

    $this->suratModel->insert([
      'nomor_surat'     => $this->request->getVar('nomor_surat'),
      'nik_pasien'      => $this->request->getVar('nik_pasien'),
      'nip_kapus'       => $this->request->getVar('nip_kapus'),
      'pekerjaan'       => $this->request->getVar('pekerjaan'),
      'slug'            => $slug,
      'tinggi_badan'    => $this->request->getVar('tinggi_badan'),
      'berat_badan'     => $this->request->getVar('berat_badan'),
      'suhu_tubuh'      => $this->request->getVar('suhu_tubuh'),
      'tensi_darah'     => $this->request->getVar('tensi_darah'),
      'nadi'            => $this->request->getVar('nadi'),
      'respirasi'       => $this->request->getVar('respirasi'),
      'mata_buta'       => $this->request->getVar('mata_buta'),
      'tubuh_tato'      => $this->request->getVar('tubuh_tato'),
      'tubuh_tindik'    => $this->request->getVar('tubuh_tindik'),
      'kepentingan'     => $this->request->getVar('kepentingan'),
      'hasil_periksa'   => $this->request->getVar('hasil_periksa'),
      'tanggal_dibuat'  => date("Y-m-d", time()),
      'tanggal_diubah'  => date("Y-m-d", time()),
      'tanggal_exp'     => $tgl_exp
    ]);

    $teks = $this->request->getVar('nomor_surat') . "-" . $this->request->getVar('nik_pasien') . "-" . $this->request->getVar('nik_pasien') . "-" . $this->request->getVar('nama_pasien') . "-" . $this->request->getVar('kepentingan') . "-" . $this->request->getVar('hasil_periksa') . "-" . date("Y-m-d", time());
    $hash_teks = md5($teks);
    // dd($teks);

    $this->kapusBuilder->select('id_kapus, nama_kapus, nip_kapus, publik_key, private_key');
    $queryKapus   = $this->kapusBuilder->get();
    $kapusQ       = $queryKapus->getResultArray();

    $kapus_publik_key   = $kapusQ[0]['publik_key'];
    // $kapus_private_key  = $kapusQ[0]['private_key'];

    // dd($kapusQ[0]['nama_kapus']);

    $enk_teks = enkripsi_text($hash_teks, $gen_key[1], $kapus_publik_key);
    // dd($enk_teks);
    if ($id == null) {
      $this->rsaBuilder->insert([
        'nomor_surat'   => $this->request->getVar('nomor_surat'),
        'nik_pasien'    => $this->request->getVar('nik_pasien'),
        'nip_kapus'     => $this->request->getVar('nip_kapus'),
        'teks_asli'     => $hash_teks,
        'teks_enkripsi' => $enk_teks[1]
      ]);
    } else {
      $dataRSA = [
        'nomor_surat'   => $this->request->getVar('nomor_surat'),
        'nik_pasien'    => $this->request->getVar('nik_pasien'),
        'nip_kapus'     => $this->request->getVar('nip_kapus'),
        'teks_asli'     => $hash_teks,
        'teks_enkripsi' => $enk_teks[1]
      ];
      $this->rsaBuilder->replace($dataRSA);
    }

    // $dataSurat = [
    //     'nomor_surat' => $this->request->getVar('nomor_surat'),
    //     'nik_pasien' => $this->request->getVar('nik_pasien'),
    //     'nip_kapus' => $this->request->getVar('nip_kapus'),
    //     'pekerjaan' => $this->request->getVar('pekerjaan'),
    //     'slug' => $slug,
    //     'tinggi_badan' => $this->request->getVar('tinggi_badan'),
    //     'berat_badan' => $this->request->getVar('berat_badan'),
    //     'suhu_tubuh' => $this->request->getVar('suhu_tubuh'),
    //     'tensi_darah' => $this->request->getVar('tensi_darah'),
    //     'nadi' => $this->request->getVar('nadi'),
    //     'respirasi' => $this->request->getVar('respirasi'),
    //     'mata_buta' => $this->request->getVar('mata_buta'),
    //     'tubuh_tato' => $this->request->getVar('tubuh_tato'),
    //     'tubuh_tindik' => $this->request->getVar('tubuh_tindik'),
    //     'kepentingan' => $this->request->getVar('kepentingan'),
    //     'hasil_periksa' => $this->request->getVar('hasil_periksa')
    // ];
    // $this->suratBuilder->insert($dataSurat);

    session()->setFLashdata('pesan', 'Tambahkan');

    return redirect()->to('/admin/surat_sehat');
  }

  public function hapus_data($id)
  {
    $this->suratModel->delete($id);

    session()->setFLashdata('pesan', 'Hapus');
    return redirect()->to('/admin/surat_sehat');
  }

  public function edit_data($id)
  {
    $this->suratBuilder->select('id_sks, nomor_surat, pasien.nik_pasien as nik_p, nama_pasien, jenis_kelamin, tgl_lahir, alamat,
    pekerjaan, kepentingan, tinggi_badan, berat_badan, tensi_darah, suhu_tubuh, nadi, respirasi, mata_buta, tubuh_tato, tubuh_tindik,
    hasil_periksa, nama_kapus, kapus.nip_kapus as nip_kp, nama_kapus, pasien.tgl_lahir as tgl_lahir, TIMESTAMPDIFF(MONTH , pasien.tgl_lahir, NOW() ) AS umur');
    $this->suratBuilder->join('pasien', 'pasien.nik_pasien = surat_kesehatan.nik_pasien');
    $this->suratBuilder->join('kapus', 'kapus.nip_kapus = surat_kesehatan.nip_kapus');
    $this->suratBuilder->where('id_sks', $id);
    $query = $this->suratBuilder->get();

    // dd($query->getResult());

    $data = [
      'title'    => 'Edit data surat',
      'validation' => \Config\Services::validation(),
      'data_surat' => $query->getResult()
    ];
    return view('/administrator/edit_data_surat', $data);
  }

  public function tambah_data_surat_ada($id)
  {
    $this->pasienBuilder->select('nik_pasien, nama_pasien, jenis_kelamin, tgl_lahir, alamat, TIMESTAMPDIFF(MONTH , pasien.tgl_lahir, NOW() ) AS umur');
    $this->pasienBuilder->where('id_pasien', $id);
    $queryPasien = $this->pasienBuilder->get();
    $this->kapusBuilder->select('id_kapus, nama_kapus, nip_kapus, active');
    $queryKapus = $this->kapusBuilder->get();
    // dd($queryKapus->getResult());

    // dd($query->getResult());

    $data = [
      'title'    => 'Tambah data surat',
      'validation' => \Config\Services::validation(),
      'data_surat' => $queryPasien->getResult(),
      'data_kapus' => $queryKapus->getResult()
    ];
    return view('/administrator/tambah_data_surat_ada', $data);
  }


  public function detail_surat($id)
  {
    $this->suratBuilder->select('id_sks, nomor_surat, pasien.nik_pasien as nik_p, nama_pasien, nama_kapus, kapus.nip_kapus as nip_kp, jenis_kelamin, tgl_lahir, alamat,
          pekerjaan, kepentingan, tinggi_badan, berat_badan, tensi_darah, suhu_tubuh, nadi, respirasi, mata_buta, tubuh_tato, tubuh_tindik,
          hasil_periksa, nama_kapus, kapus.nip_kapus as nip_kp, nama_kapus, pasien.tgl_lahir as tgl_lahir, surat_kesehatan.tanggal_dibuat as tgl_dibuat, TIMESTAMPDIFF(MONTH , pasien.tgl_lahir, NOW() ) AS umur');
    $this->suratBuilder->join('pasien', 'pasien.nik_pasien = surat_kesehatan.nik_pasien');
    $this->suratBuilder->join('kapus', 'kapus.nip_kapus = surat_kesehatan.nip_kapus');
    $this->suratBuilder->where('id_sks', $id);
    $query = $this->suratBuilder->get();

    // dd($query->getResult());

    $data = [
      'title'    => 'Detail data surat',
      'validation' => \Config\Services::validation(),
      'data_surat' => $query->getResultArray()
    ];
    return view('/administrator/detail_surat', $data);
  }
  // public function update_data($id)
  // {
  //     // data Alama
  //     $data_lama = $this->petugasModel->getPetugas($this->request->getVar('slug'));
  //     if ($data_lama['nik_petugas'] == $this->request->getVar('nik_petugas')) {
  //         $rule_nik = 'required';
  //     } else {
  //         $rule_nik = 'required|is_unique[satgas.nik_petugas]';
  //     }
  //     // Form Validasi
  //     if (!$this->validate([
  //       'nik_petugas' => [
  //         'rules' => $rule_nik,
  //         'errors' => [
  //           'required' => 'NIK petugas harus di isi',
  //           'is_unique' => 'NIK petugas sudah terdaftar'
  //         ]
  //       ],
  //       'foto_profil' => [
  //         'rules' => 'max_size[foto_profil, 2028]|is_image[foto_profil]|mime_in[foto_profil,image/jpg,image/jpeg,image/png]',
  //         'errors' =>[
  //           'max_size' => 'Ukuran Gambar Terlalu Besar',
  //           'is_image' => 'Yang Anda Masukkan Bukan File Gambar',
  //           'mime_in' => 'Yang Anda Masukkan Bukan File Gambar'
  //         ]
  //       ]
  //     ])) {
  //         // $valid = \Config\Services::validation();
  //         // return redirect()->to('/data_petugas/edit_data/'.$slug)->withInput()->with('Validation', $valid);
  //         return redirect()->to('/data_petugas/edit_data/'.$this->request->getVar('slug'))->withInput();
  //     }
  //
  //     // Ambil File
  //     $file_FotoProfil = $this->request->getFile('foto_profil');
  //     // cek gambar
  //     // KTP
  //     if ($file_FotoProfil->getError() == 4) {
  //         if (empty($data_lama['foto_profil'])) {
  //             $nama_file = null;
  //         } else {
  //             $nama_file = $this->request->getVar('file_profil_lama');
  //         }
  //     } else {
  //         // pindah file ke directori kita
  //         unlink('gambar/profil_petugas/'.$this->request->getVar('file_profil_lama'));
  //         // nama File
  //         $nama_file = $file_FotoProfil->getRandomName();
  //         $file_FotoProfil->move('gambar/profil_petugas', $nama_file);
  //     }
  //
  //     // cek slug
  //     if ($data_lama['nik_petugas'] == $this->request->getVar('nik_petugas') || $data_lama['nama_petugas'] == $this->request->getVar('nama_petugas')) {
  //         $slug = url_title($this->request->getVar('nik_petugas').'-'.$this->request->getVar('nama_petugas'), '-', true);
  //     } else {
  //         $slug = $this->request->getVar('slug');
  //     }
  //
  //     $this->petugasModel->save([
  //     'id_satgas' => $id,
  //     'nama_petugas' => $this->request->getVar('nama_petugas'),
  //     'slug' => $slug,
  //     'nip_petugas' => $this->request->getVar('nip_petugas'),
  //     'nik_petugas' => $this->request->getVar('nik_petugas'),
  //     'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
  //     'alamat' => $this->request->getVar('alamat'),
  //     'no_hp' => $this->request->getVar('no_hp'),
  //     'email' => $this->request->getVar('email'),
  //     'foto_profil' => $nama_file
  //   ]);
  //
  //     session()->setFLashdata('pesan', 'Ubah');
  //
  //     return redirect()->to('/data_petugas');
  // }
}
