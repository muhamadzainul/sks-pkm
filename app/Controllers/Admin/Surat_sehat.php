<?php

namespace App\Controllers\Admin;

use App\Models\Model_surat;
use App\Models\Model_pasien;

use App\Controllers\BaseController;
use DateTime;
use Endroid\QrCode\Color\Color;
use \Endroid\QrCode\Encoding\Encoding;
use \Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use \Endroid\QrCode\QrCode;
use \Endroid\QrCode\Label\Label;
use \Endroid\QrCode\Logo\Logo;
use \Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use \Endroid\QrCode\Writer\PngWriter;
use MYPDF;
use TCPDF;

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
    // dd($id);
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

    $this->pasienBuilder->select('nik_pasien');
    $this->pasienBuilder->where('nik_pasien', $this->request->getVar('nik_pasien'));
    $query = $this->pasienBuilder->get();
    $queryp = $query->getResult();
    if (empty($queryp)) {
      if ($id == null) {
        // dd(empty($queryp));

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

    $teks = $this->request->getVar('nomor_surat') . "-" . $this->request->getVar('nik_pasien') . "-" . $this->request->getVar('nip_kapus') . "-" . $this->request->getVar('nama_pasien') . "-" . $this->request->getVar('kepentingan') . "-" . $this->request->getVar('hasil_periksa') . "-" . date("Y-m-d", time());
    $hash_teks = md5($teks);
    // dd($hash_teks);

    $this->kapusBuilder->select('id_kapus, nama_kapus, nip_kapus, publik_key, private_key');
    $queryKapus   = $this->kapusBuilder->get();
    $kapusQ       = $queryKapus->getResultArray();

    if (empty($queryp)) {
      $pasien_key = $gen_key[1];
    } else {
      $this->pasienBuilder->select('publik_key');
      $pp = $this->pasienBuilder->where('nik_pasien', $this->request->getVar('nik_pasien'))->get();
      $ps_pr = $pp->getRow();
      $pasien_key = $ps_pr->publik_key;
    }
    // dd($pasien_key);

    $kapus_private_key   = $kapusQ[0]['private_key'];
    // dd($kapus_private_key);
    // dd();
    // $kapus_private_key  = $kapusQ[0]['private_key'];

    // Proses Enkripsi
    // $private_key = explode(".", $kapus_private_key);
    // $d = $private_key[0];
    // $n = $private_key[1];
    // $public_key2 = explode(".", $pasien_key);
    // $e2 = $public_key2[0];
    // $n3 = $public_key2[1];

    // $hasil = "";
    // $hasil_sem = "";
    // $ascii = "";
    // $angka_0 = "";

    // for ($i = 0; $i < strlen($hash_teks); $i++) {
    //   $ascii .= ord($hash_teks[$i]);
    // }
    // echo "<br>Hash text = " . $hash_teks;
    // echo "<br>Nilai Ascii = " . $ascii;
    // echo "<br>";
    // $rq = strlen($ascii) - 4;
    // $v_k = 0; // inisisalisasi angka 0 yang ada di depan pada nilai ascii yang telah dibagi menjadi blok-blok

    // for ($j = 0; $j < strlen($ascii); $j++) {
    //   // echo "<br>",$j+1;
    //   // // echo "<br>";
    //   // echo "<br>" . $ascii[$j];
    //   if ((($j) % 4) == 0) {
    //     // echo "<br>Nilai text ASCII = $j";
    //     // $ph = intval(substr($ascii, $j, 4));
    //     // echo "<br>.$ph";
    //     // echo "<br>";
    //     $pl = intval(substr($ascii, $j, 1)); // inisisalisasi nilai 1 pada tiap blok
    //     if ($pl == 0) {
    //       for ($k = 0; $k < 4; $k++) {
    //         $rf = intval(substr($ascii, $j + $k, 1)); //inisisalisasi angka 0 yang berada di depan pada tiap blok
    //         if ($rf == 0) {
    //           // code...
    //           $hasil .= "0";
    //           $v_k = $v_k + 1;
    //         } else {
    //           break;
    //         }
    //       }
    //       $hasil .= "_";
    //     }

    //     $ht = intval(substr($ascii, $j + $v_k, 4 - $v_k)); //inisisalisasi untuk mencari nilai yang sudah tidak ada nilai 0 di depannya pada tiap blok
    //     echo "<br>Nilai Ascii Yang di Ambil Untuk menggunakan Private Key pengirim = " . $ht;
    //     // echo $ht*2;
    //     // echo "<br>Nilai text ASCII = " . $j;
    //     // echo "<br>";
    //     $hasil_sem .= gmp_mod(gmp_pow($ht, $d), $n);
    //     $dfd = explode(".", $hasil_sem);
    //     $fdf = $dfd[count($dfd) - 1];
    //     echo "<br>enkripsi menggunakan private key pengirim = (Pn ** d) mod n";
    //     echo "<br> hasil sementara = " . $hasil_sem;
    //     echo "<br>";
    //     echo "<br>hasil sementara akan di split jika lebih dari 4 digit nomor";
    //     // echo "<br>" . $fdf;
    //     // var_dump($fdf);
    //     $ex1 = explode("_", $fdf);
    //     // var_dump($ex1);
    //     // echo "<br> if ex1[1] = ".(!empty($ex1[1])) ? "ada" : "tidak";
    //     if (!empty($ex1[1])) {
    //       $ks2 = explode(".", $hasil);
    //       // echo "<br> iterasi = ".count($ks2);
    //       // echo "<br>".$ex1[1];
    //       // echo "<br>".strlen($ex1[1]);
    //     } else {
    //       // code...
    //       // echo "<br>".$ex1[0];
    //       // echo "<br>".strlen($ex1[0]);
    //       $rd = 0;
    //       $zr = intval(substr($ex1[0], 0, 4));
    //       // echo "<br> e2 = $e2";
    //       // echo "<br> n2 = $n3";
    //       $hasil .= gmp_mod(gmp_pow($zr, $e2), $n3);
    //       // echo "<br>Hasil Coba = ".gmp_mod(gmp_pow($zr, $e2), $n3);
    //       $zr2 = intval(substr($ex1[0], 4, strlen($ex1[0]) - 4));
    //       if (strlen($fdf) > 4) {
    //         $zx = "." . $zr2;
    //       } else {
    //         $zx = "";
    //       }
    //       echo "<br>hasil split = $zr$zx";
    //       echo "<br>";
    //       echo "<br>Kemudian hasil split dipisah dan akan di enkripsi lagi menggunakan publik key penerima = (Pn ** e2) mod n2";
    //       echo "<br>";
    //       if (strlen($ex1[0]) > 4) {
    //         if ($zr2 == 0) {
    //           $hasil .= "*";
    //           for ($k = 0; $k < (strlen($ex1[0]) - 4); $k++) {
    //             $rj = intval(substr($ex1[0], 4 + $k, 1)); //inisisalisasi angka 0 yang berada di depan pada tiap blok
    //             // echo "<br> panjang ex1[0]" . (strlen($ex1[0]) - 4);
    //             // echo "<br> rj = " . $rj;
    //             if ($rj == 0) {
    //               $hasil .= "0";
    //               $rd = $rd + 1;
    //             } else {
    //               $zr3 = intval(substr($ex1[0], $k, (strlen($ex1[0]) - 4)));
    //               if (((strlen($ex1[0]) - 4) - $rd) != 0) {
    //                 $hasil .= "*";
    //                 $hasil .= gmp_mod(gmp_pow($zr2, $e2), $n3);
    //               }
    //               break;
    //             }
    //           }
    //           // echo "<br> RD = $rd";
    //           // if ((strlen($ex1[0]-4)) != 0) {
    //           // $zr3 = intval(substr($ex1[0], 4+$rd, (strlen($ex1[0])-4)));
    //           // echo "<br> ZR2 = $zr2";
    //           // echo "<br> ZR3 = $zr3";
    //           // echo "<br> if  = ".((strlen($ex1[0])-4)-$rd);
    //           // if (((strlen($ex1[0])-4)-$rd) != 0) {
    //           // code...
    //           // $hasil .= "*";
    //           // $hasil .= gmp_mod(gmp_pow($zr2, $e2), $n3);
    //           // echo "<br>Hasil coba 2 ada 0 = ".gmp_mod(gmp_pow($zr2, $e2), $n3);
    //           // }
    //           // }
    //         } else {
    //           $zr3 = intval(substr($ex1[0], 4, ($ex1[0] - 4)));
    //           // echo "<br> ZR2 = $zr3";
    //           $hasil .= "*";
    //           $hasil .= gmp_mod(gmp_pow($zr2, $e2), $n3);
    //           // echo "<br>Hasil coba 2 = ".gmp_mod(gmp_pow($zr2, $e2), $n3);
    //         }
    //       }
    //       $rd = $rd * 0;


    //       $ks2 = explode(".", $hasil);
    //       $ks4 = $ks2[(count($ks2) - 1)];
    //       $ks = explode("*", $zr);
    //       echo "<br>haiil akan di appand pada string kosong pada hasil enkripsi : " . $ks4;
    //       // echo "<br>Jumlah angka = " . strlen($ex1[0]);
    //       echo "<br> iterasi = " . count($ks2);

    //       echo "<hr>";
    //     }



    //     if (($j + 5) <= strlen($ascii)) {
    //       $hasil .= ".";
    //     }
    //   }
    //   // echo "<br>$v_k";
    //   $hasil_sem = "";
    //   $v_k = $v_k * 0;
    // }
    // echo "<br>Nilai text ASCII = $ascii";
    // $hs = "";
    // $pecah_enkrip = explode(".", $hasil);
    // // echo "<br>". (count($pecah_enkrip));
    // for ($ol = 0; $ol < count($pecah_enkrip); $ol++) {
    //   $pecah_enkrip2 = explode("*", $pecah_enkrip[$ol]);
    //   $pecah_0 = explode("_", $pecah_enkrip2[0]);
    //   // echo "<br>".(count($pecah_0));
    //   for ($io = 0; $io < count($pecah_enkrip2); $io++) {
    //     if (count($pecah_0) == 2) {
    //       $hs .= $pecah_0[0];
    //       $hs .= $pecah_0[1];
    //     } else {
    //       $hs .= $pecah_enkrip2[$io];
    //       // code...
    //     }
    //   }
    // }
    // // echo "<br>Nilai Hasil Enkripsi asli = " . $hs;
    // echo "<br>Nilai hasil Enkripsi = $hasil";
    // dd($hasil);


    $enk_teks = enkripsi_text($hash_teks, $kapus_private_key, $pasien_key);
    // dd($enk_teks);
    // dd(strlen($enk_teks[1]));
    // dd($enk_teks);

    // dd($kapusQ[0]['nama_kapus']);
    //create QRcode
    $text_qr = base_url() . '/validasi' . '/' . md5($enk_teks[0]);

    $this->gen_qr   = QrCode::create($text_qr);
    $writer         = new PngWriter();

    $qrCode = $this->gen_qr->setEncoding(new Encoding('UTF-8'))
      ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
      ->setSize(300)
      ->setMargin(10)
      ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
      ->setForegroundColor(new Color(0, 0, 0))
      ->setBackgroundColor(new Color(255, 255, 255));

    // Create generic logo
    $logo = Logo::create('./gambar/Logo-Mojokerto.png')
      ->setResizeToWidth(50);

    // Create generic label
    // $label = Label::create('Zainul')
    //     ->setTextColor(new Color(255, 0, 0));

    $test = $writer->write($qrCode, $logo);

    // header('Content-Type: ' . $test->getMimeType());
    // echo $test->getString();
    // $qr_name = getRandomName();
    $test->saveToFile('./gambar/qr_code/' . $hash_teks . '.png');
    $db_qrcode = $hash_teks . '.png';


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
      'qr_code'         => $db_qrcode,
      'tanggal_dibuat'  => date("Y-m-d", time()),
      'tanggal_diubah'  => date("Y-m-d", time()),
      'tanggal_exp'     => $tgl_exp
    ]);

    if ($id == null) {
      $this->rsaBuilder->insert([
        'nomor_surat'   => $this->request->getVar('nomor_surat'),
        'nik_pasien'    => $this->request->getVar('nik_pasien'),
        'nip_kapus'     => $this->request->getVar('nip_kapus'),
        'teks_asli'     => $hash_teks,
        'teks_enkripsi' => $enk_teks[1],
        'hash_enkrip'   => md5($enk_teks[0]),
        'tanggal_dibuat' => date("Y-m-d", time()),
      ]);
    } else {
      $dataRSA = [
        'nomor_surat'   => $this->request->getVar('nomor_surat'),
        'nik_pasien'    => $this->request->getVar('nik_pasien'),
        'nip_kapus'     => $this->request->getVar('nip_kapus'),
        'teks_asli'     => $hash_teks,
        'teks_enkripsi' => $enk_teks[1],
        'hash_enkrip'   => md5($enk_teks[0]),
        'tanggal_dibuat' => date("Y-m-d", time()),
      ];
      $this->rsaBuilder->replace($dataRSA);
    }

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
    hasil_periksa, qr_code, nama_kapus, kapus.nip_kapus as nip_kp, nama_kapus, pasien.tgl_lahir as tgl_lahir, TIMESTAMPDIFF(MONTH , pasien.tgl_lahir, NOW() ) AS umur');
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
          hasil_periksa, qr_code, nama_kapus, kapus.nip_kapus as nip_kp, nama_kapus, pasien.tgl_lahir as tgl_lahir, surat_kesehatan.tanggal_dibuat as tgl_dibuat, 
          TIMESTAMPDIFF(MONTH , pasien.tgl_lahir, NOW() ) AS umur');
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
  public function cetak_surat($id)
  {
    $this->suratBuilder->select('id_sks, nomor_surat, pasien.nik_pasien as nik_p, nama_pasien, nama_kapus, kapus.nip_kapus as nip_kp, jenis_kelamin, tgl_lahir, alamat,
    pekerjaan, kepentingan, tinggi_badan, berat_badan, tensi_darah, suhu_tubuh, nadi, respirasi, mata_buta, tubuh_tato, tubuh_tindik,
    hasil_periksa, qr_code, nama_kapus, kapus.nip_kapus as nip_kp, nama_kapus, pasien.tgl_lahir as tgl_lahir, surat_kesehatan.tanggal_dibuat as tgl_dibuat, 
    TIMESTAMPDIFF(MONTH , pasien.tgl_lahir, NOW() ) AS umur');
    $this->suratBuilder->join('pasien', 'pasien.nik_pasien = surat_kesehatan.nik_pasien');
    $this->suratBuilder->join('kapus', 'kapus.nip_kapus = surat_kesehatan.nip_kapus');
    $this->suratBuilder->where('id_sks', $id);
    $query = $this->suratBuilder->get();
    $data_cetak = $query->getRowArray();

    $data_logo = '/gambar/Logo-Mojokerto.png';


    $data = [
      'data_cetak'  => $data_cetak,
      'logo_mjk'    => $data_logo
    ];
    $html = view('/administrator/cetak_surat', $data);

    $pdf = new MYPDF('P', PDF_UNIT, 'LEGAL', true, 'UTF-8', false);

    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('SKS-Puskesmas Dawarblandong');
    $pdf->SetTitle('Cetak Surat');
    $pdf->SetSubject('Surat Kesehatan');


    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . '', PDF_HEADER_STRING);

    // set header and footer fonts
    $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    $pdf->addPage();

    // output the HTML content
    $pdf->writeHTML($html, true, false, true, false, '');
    //line ini penting
    $this->response->setContentType('application/pdf');
    //Close and output PDF document
    $pdf->Output($data_cetak['nama_pasien'] . '.pdf', 'I');
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
