<?php

namespace App\Controllers\Admin;

use App\Models\Model_pasien;

use App\Controllers\BaseController;
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

class Data_pasien extends BaseController
{
  protected $pasienModel;
  public function __construct()
  {
    $this->pasienModel = new Model_pasien();
    $this->db             = \Config\Database::connect();
    $this->pasienBuilder  = $this->db->table('pasien');
    $this->enkripsi    = \Config\Services::encrypter();
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
      'title'         => 'Data Pasien',
      'data_pasien'   => $pasien->paginate(10),
      'pager'         => $this->pasienModel->pager,
      'currentPage'   => $currentPage
    ];
    return view('/administrator/data_pasien', $data);
  }

  public function tambah_data_pasien()
  {
    $data = [
      'title'       => 'Tambah Data Pasien',
      'validation'  => \Config\Services::validation()
    ];
    return view('/administrator/tambah_data_pasien', $data);
  }

  public function simpan()
  {

    // Form Validasi
    if (!$this->validate([
      'nik_pasien'    => [
        'rules'       => 'required|is_unique[pasien.nik_pasien]',
        'errors'      => [
          'required'  => 'NIK pasien harus di isi',
          'is_unique' => 'NIK pasien sudah terdaftar'
        ]
      ],
      'foto_ktp'    => [
        'rules'     => 'max_size[foto_ktp, 2028]|is_image[foto_ktp]|mime_in[foto_ktp,image/jpg,image/jpeg,image/png]',
        'errors'    => [
          'max_size'  => 'Ukuran Gambar Terlalu Besar',
          'is_image'  => 'Yang Anda Masukkan Bukan File Gambar',
          'mime_in'   => 'Yang Anda Masukkan Bukan File Gambar'
        ]
      ],
      'foto_kk'   => [
        'rules'   => 'max_size[foto_kk, 2028]|is_image[foto_kk]|mime_in[foto_kk,image/jpg,image/jpeg,image/png]',
        'errors'  => [
          'max_size'  => 'Ukuran Gambar Terlalu Besar',
          'is_image'  => 'Yang Anda Masukkan Bukan File Gambar',
          'mime_in'   => 'Yang Anda Masukkan Bukan File Gambar'
        ]
      ]
    ])) {
      // $valid = \Config\Services::validation();
      // return redirect()->to('/data_pasien/tambah_data_pasien')->withInput()->with('Validation', $valid);
      return redirect()->to('/admin/data_pasien/tambah_data_pasien')->withInput();
    }

    // Ambil File
    $file_Fotoktp   = $this->request->getFile('foto_ktp');
    $file_Fotokk    = $this->request->getFile('foto_kk');

    // nama File
    $nama_file      = $file_Fotoktp->getRandomName();

    // pindah file ke directori kita
    if ($file_Fotoktp->getError() == 4) {
      $nama_file_ktp = 'default-ktp.png';
    } else {
      $nama_file_ktp = 'KTP - ' . $nama_file;
      $file_Fotoktp->move('gambar/foto_ktp', 'KTP - ' . $nama_file);
    }
    if ($file_Fotokk->getError() == 4) {
      $nama_file_kk = 'default-kk.png';
    } else {
      $nama_file_kk = 'KK - ' . $nama_file;
      $file_Fotokk->move('gambar/foto_kk', 'KK - ' . $nama_file);
    }

    $slug = url_title($this->request->getVar('nik_pasien') . '-' . $this->request->getVar('nama_pasien'), '-', true);

    $gen_key = get_key();
    $private_key = base64_encode($this->enkripsi->encrypt($gen_key[1]));


    $text_qr = $private_key;

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
    $test = $writer->write($qrCode, $logo);
    $nama_file = generateRandomString(32);
    $test->saveToFile('./gambar/qr_code/pasien/' . $nama_file . '.png');
    $db_qrcode_pasien = $nama_file . '.png';

    $this->pasienModel->save([
      'nama_pasien'       => $this->request->getVar('nama_pasien'),
      'slug'              => $slug,
      'nik_pasien'        => $this->request->getVar('nik_pasien'),
      'tgl_lahir'         => $this->request->getVar('tgl_lahir'),
      'jenis_kelamin'     => $this->request->getVar('jenis_kelamin'),
      'alamat'            => $this->request->getVar('alamat'),
      'no_hp'             => $this->request->getVar('no_hp'),
      'email'             => $this->request->getVar('email'),
      'publik_key'        => $gen_key[0],
      'private_key'       => $private_key,
      'qr_code'           => $db_qrcode_pasien,
      'foto_ktp'          => $nama_file_ktp,
      'foto_kk'           => $nama_file_kk
    ]);

    session()->setFLashdata('pesan', 'Tambahkan');

    return redirect()->to('/admin/data_pasien');
  }

  public function hapus_data($id)
  {
    // cari nama gambar berdasarkan id
    $pasien_data = $this->pasienModel->find($id);

    // hapus Gambar
    if ($pasien_data['foto_kk'] != 'default-kk.png') {
      unlink('gambar/foto_kk/' . $pasien_data['foto_kk']);
    }
    if ($pasien_data['foto_ktp'] != 'default-ktp.png') {
      unlink('gambar/foto_ktp/' . $pasien_data['foto_ktp']);
    }
    $this->pasienModel->delete($id);

    session()->setFLashdata('pesan', 'Hapus');
    return redirect()->to('/admin/data_pasien');
  }

  public function edit_data($slug)
  {
    $data = [
      'title'       => 'Edit Data Pasien',
      'validation'  => \Config\Services::validation(),
      'data_pasien' => $this->pasienModel->getPasien($slug)
    ];
    return view('/administrator/edit_data_pasien', $data);
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
        'rules'   => $rule_nik,
        'errors'  => [
          'required'  => 'NIK pasien harus di isi',
          'is_unique' => 'NIK pasien sudah terdaftar'
        ]
      ],
      'foto_ktp' => [
        'rules'   => 'max_size[foto_ktp, 2028]|is_image[foto_ktp]|mime_in[foto_ktp,image/jpg,image/jpeg,image/png]',
        'errors'  => [
          'max_size'  => 'Ukuran Gambar Terlalu Besar',
          'is_image'  => 'Yang Anda Masukkan Bukan File Gambar',
          'mime_in'   => 'Yang Anda Masukkan Bukan File Gambar'
        ]
      ],
      'foto_kk' => [
        'rules'   => 'max_size[foto_kk, 2028]|is_image[foto_kk]|mime_in[foto_kk,image/jpg,image/jpeg,image/png]',
        'errors'  => [
          'max_size'  => 'Ukuran Gambar Terlalu Besar',
          'is_image'  => 'Yang Anda Masukkan Bukan File Gambar',
          'mime_in'   => 'Yang Anda Masukkan Bukan File Gambar'
        ]
      ]
    ])) {
      // $valid = \Config\Services::validation();
      // return redirect()->to('/data_pasien/edit_data/'.$slug)->withInput()->with('Validation', $valid);
      return redirect()->to('/admin/data_pasien/edit_data/' . $this->request->getVar('slug'))->withInput();
    }

    // Ambil File
    $file_Fotoktp = $this->request->getFile('foto_ktp');
    $file_Fotokk  = $this->request->getFile('foto_kk');

    // nama File
    $nama_file = $file_Fotoktp->getRandomName();

    // cek gambar
    // KTP
    if ($file_Fotoktp->getError() == 4) {
      $nama_file_ktp = $this->request->getVar('file_ktp_lama');
    } else {
      // pindah file ke directori kita
      if ($data_lama['foto_ktp'] != 'default-ktp.png') {
        unlink('gambar/foto_ktp/' . $this->request->getVar('file_ktp_lama'));
      }
      $nama_file_ktp = 'KTP - ' . $nama_file;
      $file_Fotoktp->move('gambar/foto_ktp', 'KTP - ' . $nama_file);
    }

    // KK
    if ($file_Fotokk->getError() == 4) {
      $nama_file_kk = $this->request->getVar('file_kk_lama');
    } else {
      if ($data_lama['foto_kk'] != 'default-kk.png') {
        unlink('gambar/foto_kk/' . $this->request->getVar('file_kk_lama'));
      }
      $nama_file_kk = 'KK - ' . $nama_file;
      $file_Fotokk->move('gambar/foto_kk', 'KK - ' . $nama_file);
    }

    // cek slug
    if ($data_lama['nik_pasien'] == $this->request->getVar('nik_pasien') || $data_lama['nama_pasien'] == $this->request->getVar('nama_pasien')) {
      $slug = url_title($this->request->getVar('nik_pasien') . '-' . $this->request->getVar('nama_pasien'), '-', true);
    } else {
      $slug = $this->request->getVar('slug');
    }

    $this->pasienModel->save([
      'id_pasien'       => $id,
      'nama_pasien'     => $this->request->getVar('nama_pasien'),
      'slug'            => $slug,
      'nik_pasien'      => $this->request->getVar('nik_pasien'),
      'tgl_lahir'       => $this->request->getVar('tgl_lahir'),
      'jenis_kelamin'   => $this->request->getVar('jenis_kelamin'),
      'alamat'          => $this->request->getVar('alamat'),
      'no_hp'           => $this->request->getVar('no_hp'),
      'email'           => $this->request->getVar('email'),
      'foto_ktp'        => $nama_file_ktp,
      'foto_kk'         => $nama_file_kk
    ]);

    session()->setFLashdata('pesan', 'Ubah');

    return redirect()->to('/admin/data_pasien/detail_pasien/' . $slug);
  }
  public function detail_pasien($slug)
  {
    $data = [
      'title'       => 'Detail Data Pasien',
      'validation'  => \Config\Services::validation(),
      'data_pasien' => $this->pasienModel->getPasien($slug)
    ];
    return view('/administrator/detail_pasien', $data);
  }

  public function cetak_qr($id)
  {
    $this->pasienBuilder->select('nik_pasien as nik_p, nama_pasien, qr_code as pas_qr, 
    TIMESTAMPDIFF(MONTH , pasien.tgl_lahir, NOW() ) AS umur');
    $this->pasienBuilder->where('slug', $id);
    $query = $this->pasienBuilder->get();
    $data_cetak = $query->getRowArray();

    $data_logo = '/gambar/Logo-Mojokerto.png';


    $data = [
      'data_cetak'  => $data_cetak,
      'logo_mjk'    => $data_logo
    ];

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
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    $pdf->addPage();

    // output the HTML content
    $html = view('/administrator/cetak_qr', $data);
    $pdf->writeHTML($html, true, false, true, false, '');
    //line ini penting
    $this->response->setContentType('application/pdf');
    //Close and output PDF document
    $pdf->Output($data_cetak['nama_pasien'] . '.pdf', 'I');
  }
}
