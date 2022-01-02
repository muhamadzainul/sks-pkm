<?php

namespace App\Controllers\Admin;

use App\Models\Model_suratIzin;
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
use MYPDF2;
use SebastianBergmann\CodeCoverage\Driver\Selector;
use TCPDF;

class Surat_izin extends BaseController
{
    protected $suratModel;
    protected $pasienModel;
    protected $db;
    protected $suratBuilder;
    protected $pasienBuilder;
    protected $rsaBuilder;
    protected $enkripsi;
    public function __construct()
    {
        $this->suratModel     = new Model_suratIzin();
        $this->pasienModel    = new Model_pasien();
        $this->db             = \Config\Database::connect();
        $this->suratBuilder   = $this->db->table('surat_izin');
        $this->pasienBuilder  = $this->db->table('pasien');
        $this->kapusBuilder   = $this->db->table('kapus');
        $this->rsaBuilder     = $this->db->table('surat_rsaIzin');
        $this->enkripsi       = \Config\Services::encrypter();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;


        $this->suratBuilder->select('id_suratIzin, nomor_surat, surat_izin.nik_pasien as nik_p, nip_pasien, nama_pasien, kepentingan, tgl_dibuat');
        $this->suratBuilder->join('pasien', 'pasien.nik_pasien = surat_izin.nik_pasien');
        $this->suratBuilder->orderBy('id_suratIzin', 'DESC');

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $sks = $this->suratModel->search($keyword);
            $this->suratBuilder->like('nama_pasien', $keyword);
            $this->suratBuilder->orLike('surat_izin.nik_pasien', $keyword);
            $query = $this->suratBuilder->get();
        } else {
            $sks = $this->suratModel->search("");
            $query = $this->suratBuilder->get();
        }

        // $data_surat = $this->suratModel->findAll();
        $data = [
            // 'data_surat' => $data_surat,
            // 'cek_data' => $kosong,
            'data_surat'    => $sks->orderBy('id_suratIzin', 'DESC')->paginate(10),
            'pager'         => $this->suratModel->pager,
            'currentPage'   => $currentPage,
            'title'         => 'Data Surat Izin',
            // 'data_surat' => $query->getResultArray()
        ];
        return view('/administrator/data_surat_izin', $data);
    }

    public function tambah_data_suratIzin()
    {
        $this->kapusBuilder = $this->db->table('kapus');
        $this->kapusBuilder->select('nip_kapus');
        $this->kapusBuilder->where('active', 1);
        $querySurat = $this->kapusBuilder->get();
        $kapus = $querySurat->getRowArray();
        // dd($kapus['nip_kapus']);


        $keyword = $this->request->getVar('keyword');
        // dd($keyword);

        if ($keyword) {
            $this->pasienBuilder->select('id_pasien, nik_pasien, nip_pasien, nama_pasien, jenis_kelamin, tgl_lahir, alamat');
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
            'title'       => 'Tambah Data Surat',
            'validation'  => \Config\Services::validation(),
            'data_kapus'  => $kapus['nip_kapus'],
            'data_pasien' => $data_pasien,
            'kosong'      => $keyword
        ];

        return view('/administrator/tambah_data_suratIzin', $data);
    }

    public function simpan($id = null)
    {
        // dd($this->request->getVar('tgl_dibuat'));
        // Form Validasi
        // if (!$this->validate([
        //     'nomor_surat' => [
        //         'rules' => 'required|is_unique[surat_izin.nomor_surat]',
        //         'errors' => [
        //             'required' => 'Nomor Surat harus di isi',
        //             'is_unique' => 'Nomor Surat sudah terdaftar'
        //         ]
        //     ]
        // ])) {
        //     // $valid = \Config\Services::validation();
        //     // return redirect()->to('/data_petugas/tambah_data_petugas')->withInput()->with('Validation', $valid);
        //     return redirect()->to('/data_petugas/tambah_data_surat')->withInput();
        // }

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

        $this->pasienBuilder->select('nik_pasien, nip_pasien');
        $this->pasienBuilder->where('nik_pasien', $this->request->getVar('nik_pasien'));
        $query = $this->pasienBuilder->get();
        $queryp = $query->getRowArray();

        // dd($queryp['nip_pasien']);


        if (empty($queryp)) {
            if ($id == null) {
                // dd(empty($queryp));

                $priv_key = base64_encode($this->enkripsi->encrypt($gen_key[1]));

                $text_qr = $priv_key;

                $this->pasienModel->insert([
                    'nik_pasien'          => $this->request->getVar('nik_pasien'),
                    'nip_pasien'          => $this->request->getVar('nip_pasien'),
                    'slug'                => $slugPasien,
                    'nama_pasien'         => $this->request->getVar('nama_pasien'),
                    'tgl_lahir'           => $this->request->getVar('tgl_lahir'),
                    'jenis_kelamin'       => $this->request->getVar('jenis_kelamin'),
                    'alamat'              => $this->request->getVar('alamat'),
                    'publik_key'          => $gen_key[0],
                    'private_key'         => $priv_key,
                    // 'qr_code'             => $db_qrcode_pasien,
                    'foto_ktp'            => 'default-ktp.png',
                    'foto_kk'             => 'default-kk.png',
                    'tanggal_dibuat'      => date("Y-m-d", time()),
                    'tanggal_diubah'      => date("Y-m-d", time()),
                ]);
            }
        } else {
            if ($queryp['nip_pasien'] == null) {
                $data = [
                    'nip_pasien' => $this->request->getVar('nip_pasien'),
                    'tanggal_diubah'      => date("Y-m-d", time()),
                ];
                $this->pasienBuilder->where('nik_pasien', $queryp['nik_pasien']);
                $this->pasienBuilder->update($data);
            }
        }

        $teks = $this->request->getVar('nomor_surat') . "-" . $this->request->getVar('nik_pasien') . "-" . $this->request->getVar('nip_kapus') . "-" . $this->request->getVar('nama_pasien') . "-" . $this->request->getVar('kepentingan') . "-" . $this->request->getVar('tanggal') . "-" . $this->request->getVar('tgl_dibuat');
        $hash_teks = md5($teks);
        // dd($hash_teks);

        $this->kapusBuilder->select('id_kapus, nama_kapus, nip_kapus, publik_key, private_key');
        $queryKapus   = $this->kapusBuilder->get();
        $kapusQ       = $queryKapus->getResultArray();
        $kapus_private_key   = $kapusQ[0]['private_key'];
        $priv_kap = $this->enkripsi->decrypt(base64_decode($kapus_private_key));

        if (empty($queryp)) {
            $pasien_key = $gen_key[1];
        } else {
            $this->pasienBuilder->select('publik_key');
            $pp = $this->pasienBuilder->where('nik_pasien', $this->request->getVar('nik_pasien'))->get();
            $ps_pr = $pp->getRow();
            $pasien_key = $ps_pr->publik_key;
        }
        // dd($pasien_key);

        // dd($kapus_private_key);
        // dd();
        // $kapus_private_key  = $kapusQ[0]['private_key'];

        $enk_teks = enkripsi_text($hash_teks, $priv_kap, $pasien_key);
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
        // dd($this->request->getVar('nip_kapus'));
        if ($id != null) {

            $this->suratBuilder->select('id_suratIzin, nomor_surat');
            $ka = $this->suratBuilder->where('nomor_surat', $id)->get();
            $tr = $ka->getRowArray();
            // dd($tr['id_sks']);

            $this->rsaBuilder->select('kunci_pasien');
            $sr = $this->rsaBuilder->where('nik_pasien', $this->request->getVar('nik_pasien'))->get();
            $srt = $sr->getRowArray();
            // dd(empty($this->request->getVar('ubah_pass_pas')));
            if (empty($this->request->getVar('ubah_pass_pas'))) {
                $pass_pas = $srt['kunci_pasien'];
            } else {
                $pass_pas = base64_encode($this->enkripsi->encrypt($this->request->getVar('ubah_pass_pas')));
                // dd($pass_pas);
            }

            $dataRSA = [
                'nomor_surat'   => $this->request->getVar('nomor_surat'),
                'nik_pasien'    => $this->request->getVar('nik_pasien'),
                'nip_kapus'     => $this->request->getVar('nip_kapus'),
                'hash_text'     => $hash_teks,
                'enkripsi_text' => $enk_teks[1],
                'hash_enkrip'   => md5($enk_teks[0]),
                'kunci_pass'    => $pass_pas,
                'tgl_dibuat'    => $this->request->getVar('tgl_dibuat'),
                'tgl_diubah'    => date("Y-m-d", time()),
            ];
            $this->rsaBuilder->replace($dataRSA);

            $data = [
                'id_sks'          => $tr['id_suratIzin'],
                'nik_pasien'      => $this->request->getVar('nik_pasien'),
                'nip_kapus'       => $this->request->getVar('nip_kapus'),
                'pangkat'         => $this->request->getVar('pangkat'),
                'slug'            => $slug,
                'jabatan'         => $this->request->getVar('jabatan'),
                'hari'            => $this->request->getVar('hari'),
                'tanggal'           => $this->request->getVar('tanggal'),
                'kepentingan'     => $this->request->getVar('kepentingan'),
                'qr_code'         => $db_qrcode,
                'tgl_dibuat'      => $this->request->getVar('tgl_dibuat'),
                'tgl_diubah'      => date("Y-m-d", time()),
                'tgl_exp'         => $tgl_exp
            ];
            $this->suratModel->save($data);
        } else {
            $this->suratModel->insert([
                'nomor_surat'     => $this->request->getVar('nomor_surat'),
                'nik_pasien'      => $this->request->getVar('nik_pasien'),
                'nip_kapus'       => $this->request->getVar('nip_kapus'),
                'pangkat'         => $this->request->getVar('pangkat'),
                'slug'            => $slug,
                'jabatan'         => $this->request->getVar('jabatan'),
                'hari'            => $this->request->getVar('hari'),
                'tanggal'           => $this->request->getVar('tanggal'),
                'kepentingan'     => $this->request->getVar('kepentingan'),
                'qr_code'         => $db_qrcode,
                'tgl_dibuat'      => $this->request->getVar('tgl_dibuat'),
                'tgl_diubah'      => date("Y-m-d", time()),
                'tgl_exp'         => $tgl_exp
            ]);

            $pass_pas = base64_encode($this->enkripsi->encrypt($this->request->getVar('pass_pas')));
            $this->rsaBuilder->insert([
                'nomor_surat'   => $this->request->getVar('nomor_surat'),
                'nik_pasien'    => $this->request->getVar('nik_pasien'),
                'nip_kapus'     => $this->request->getVar('nip_kapus'),
                'hash_text'     => $hash_teks,
                'enkripsi_text' => $enk_teks[1],
                'hash_enkrip'   => md5($enk_teks[0]),
                'kunci_pass'  => $pass_pas,
                'tgl_dibuat' => date("Y-m-d", time()),
                'tgl_diubah' => date("Y-m-d", time()),
            ]);
        }


        // if ($id == null) {
        // } else {
        // }

        session()->setFLashdata('pesan', 'Tambahkan');

        return redirect()->to('/admin/surat_izin');
    }

    public function hapus_data($id)
    {

        $this->srt_rsa = $this->db->table('surat_rsa');
        $this->srt_rsa->select('id_surat_rsa');
        $kd = $this->srt_rsa->where('nomor_surat', $id)->get();
        $ns = $kd->getRowArray();
        $id_surat = $ns['id_surat_rsa'];
        // dd($id_surat);
        $this->srt_rsa->delete(['id_surat_rsa' => $id_surat]);

        $this->suratBuilder->select('id_sks');
        $td = $this->suratBuilder->where('nomor_surat', $id)->get();
        $idk = $td->getRowArray();
        $id_sks = $idk['id_sks'];
        // dd($id_sks);

        $this->suratModel->delete($id_sks);

        session()->setFLashdata('pesan', 'Hapus');
        return redirect()->to('/admin/surat_sehat');
    }

    public function edit_data($id)
    {
        $this->suratBuilder->select('id_suratIzin, nomor_surat, pasien.nik_pasien as nik_p, nip_pasien, nama_pasien, nama_kapus, kapus.nip_kapus as nip_kp, alamat,
          pangkat, jabatan, kepentingan, hari, tanggal, surat_izin.qr_code as qr_code, surat_izin.tgl_dibuat as tgl_dibuat');
        $this->suratBuilder->join('pasien', 'pasien.nik_pasien = surat_izin.nik_pasien');
        $this->suratBuilder->join('kapus', 'kapus.nip_kapus = surat_izin.nip_kapus');
        $this->suratBuilder->where('nomor_surat', $id);
        $query = $this->suratBuilder->get();
        $surat = $query->getResultArray();
        // dd($surat);



        $this->rsaBuilder->select('kunci_pasien, tanggal_dibuat');
        $ps = $this->rsaBuilder->where('nomor_surat', $surat[0]->nomor_surat)->get();
        $pas = $ps->getRowArray();
        // dd($query->getResult());
        if (empty($pas['kunci_pasisen'])) {
            $pp = "";
        } else {
            $pp = $pas['kunci_pasisen'];
        }

        $data = [
            'title'    => 'Edit data surat',
            'validation' => \Config\Services::validation(),
            'data_surat' => $query->getResult(),
            'password_pas'  => $pp,
            'tgl_dibuat'    => $pas['tanggal_dibuat']
        ];
        return view('/administrator/edit_data_surat', $data);
    }

    public function tambah_data_suratIzin_ada($id)
    {
        $this->pasienBuilder->select('nik_pasien, nip_pasien, nama_pasien, jenis_kelamin, tgl_lahir, alamat');
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
        return view('/administrator/tambah_data_suratIzin_ada', $data);
    }


    public function detail_surat($id)
    {
        $this->suratBuilder->select('id_suratIzin, nomor_surat, pasien.nik_pasien as nik_p, nip_pasien, nama_pasien, nama_kapus, kapus.nip_kapus as nip_kp, alamat,
          pangkat, jabatan, kepentingan, hari, tanggal, surat_izin.qr_code as qr_code, surat_izin.tgl_dibuat as tgl_dibuat');
        $this->suratBuilder->join('pasien', 'pasien.nik_pasien = surat_izin.nik_pasien');
        $this->suratBuilder->join('kapus', 'kapus.nip_kapus = surat_izin.nip_kapus');
        $this->suratBuilder->where('nomor_surat', $id);
        $query = $this->suratBuilder->get();
        $surat = $query->getResultArray();
        // dd($surat[0]['nomor_surat']);

        $this->rsaBuilder->select('kunci_pasien, tanggal_dibuat');
        $ps = $this->rsaBuilder->where('nomor_surat', $surat[0]['nomor_surat'])->get();
        $pas = $ps->getRowArray();
        // dd(empty($pas));
        if (empty($pas['kunci_pasisen'])) {
            $pp = "";
        } else {
            $pp = $pas['kunci_pasisen'];
        }
        // dd($query->getResult());

        $data = [
            'title'         => 'Detail data surat',
            'validation'    => \Config\Services::validation(),
            'data_surat'    => $surat,
            'password_pas'  => $pp,
            'tgl_dibuat'    => $pas['tanggal_dibuat']
        ];
        return view('/administrator/detail_surat', $data);
    }
    public function cetak_surat_izin($id)
    {
        $this->suratBuilder->select('id_suratIzin, nomor_surat, pasien.nik_pasien as nik_p, nip_pasien, nama_pasien, nama_kapus, kapus.nip_kapus as nip_kp, alamat,
          pangkat, jabatan, kepentingan, hari, tanggal, surat_izin.qr_code as qr_code, surat_izin.tgl_dibuat as tgl_dibuat');
        $this->suratBuilder->join('pasien', 'pasien.nik_pasien = surat_izin.nik_pasien');
        $this->suratBuilder->join('kapus', 'kapus.nip_kapus = surat_izin.nip_kapus');
        $this->suratBuilder->where('nomor_surat', $id);
        $query = $this->suratBuilder->get();
        $data_cetak = $query->getRowArray();

        $data_logo = '/gambar/Logo-Mojokerto.png';


        $data = [
            'data_cetak'  => $data_cetak,
            'logo_mjk'    => $data_logo
        ];
        $html = view('/administrator/cetak_surat_izin', $data);

        $pdf = new MYPDF2('P', PDF_UNIT, 'LEGAL', true, 'UTF-8', false);

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
        // $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $pdf->addPage();

        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        // $pdf->lastPage();
        // $pdf->addPage();

        // $html = view('/administrator/cetak_qr', $data);
        // $pdf->writeHTML($html, true, false, true, false, '');
        // $pdf->lastPage();
        //line ini penting
        $this->response->setContentType('application/pdf');
        //Close and output PDF document
        $pdf->Output($data_cetak['nama_pasien'] . '.pdf', 'I');
    }
}
