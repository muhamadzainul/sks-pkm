<?php

namespace App\Controllers\Admin;

use App\Models\Model_pasien;
use App\Models\Model_surat;
use App\Controllers\BaseController;
use \Endroid\QrCode\Builder\Builder;
use \Endroid\QrCode\Encoding\Encoding;
use \Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use \Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use \Endroid\QrCode\Label\Font\NotoSans;
use \Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use \Endroid\QrCode\Writer\PngWriter;

class Administrator extends BaseController
{
    protected $db;
    protected $PasienBuilder;
    protected $SuratBuilder;
    protected $UserBuilder;
    protected $gen_qr;
    public function __construct()
    {
        $this->db               = \Config\Database::connect();
        $this->PasienBuilder    = $this->db->table('pasien');
        $this->SuratBuilder     = $this->db->table('surat_kesehatan');
        $this->UserBuilder      = $this->db->table('users');
        $this->gen_qr           = Builder::create();
    }

    public function index()
    {
        $this->SuratBuilder->select('id_sks, nomor_surat, surat_kesehatan.nik_pasien as nik_p, pasien.tgl_lahir, nama_pasien, kepentingan, hasil_periksa, TIMESTAMPDIFF(
            MONTH , pasien.tgl_lahir, NOW() ) AS umur');
        $this->SuratBuilder->join('pasien', 'pasien.nik_pasien = surat_kesehatan.nik_pasien');
        $this->SuratBuilder->orderBy('id_sks', 'DESC');
        $this->PasienBuilder->orderBy('id_pasien', 'DESC');
        $suratQuery = $this->SuratBuilder->get(10, 0);
        // $suratQuery       = $this->SuratBuilder->get(10, 0);
        $pasienQuery      = $this->PasienBuilder->get(10, 0);
        $pasienCount      = $this->PasienBuilder->countAllResults();
        $suratCount       = $this->SuratBuilder->countAllResults();
        $userCount        = $this->UserBuilder->countAllResults();

        $test = $this->gen_qr->writer(new PngWriter())
            ->writerOptions([])
            ->data('aku sayang kamu sepenuhnya')
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(400)
            ->margin(10)
            ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
            // ->logoPath('./gambar/Logo-Mojokerto.png')
            ->labelText('Zainul')
            ->labelFont(new NotoSans(20))
            ->labelAlignment(new LabelAlignmentCenter())
            ->build();
        header('Content-Type: ' . $test->getMimeType());
        echo $test->getString();
        // $test->saveToFile('./gambar/qr_code/zainul.png');
        dd();


        $data = [
            'title'    => 'Dashboard',
            'data_pasien' => $pasienQuery->getResultArray(),
            'data_surat' => $suratQuery->getResultArray(),
            'total_pasien' => $pasienCount,
            'total_surat' => $suratCount,
            'total_user' => $userCount,
        ];
        return view('/administrator/index', $data);
    }

    public function profile()
    {
        return view('/administrator/my_profile');
    }
}
