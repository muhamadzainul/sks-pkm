<?php

namespace App\Controllers\Admin;

use App\Models\Model_pasien;
use App\Models\Model_surat;
use App\Controllers\BaseController;

class Administrator extends BaseController
{
    protected $db;
    protected $PasienBuilder;
    protected $SuratBuilder;
    protected $UserBuilder;
    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->PasienBuilder = $this->db->table('pasien');
        $this->SuratBuilder = $this->db->table('surat_kesehatan');
        $this->UserBuilder = $this->db->table('users');
    }

    public function index()
    {
        $this->SuratBuilder->select('id_sks, nomor_surat, surat_kesehatan.nik_pasien as nik_p, pasien.tgl_lahir, nama_pasien, kepentingan, hasil_periksa, TIMESTAMPDIFF(
            MONTH , pasien.tgl_lahir, NOW() ) AS umur');
        $this->SuratBuilder->join('pasien', 'pasien.nik_pasien = surat_kesehatan.nik_pasien');
        $suratQuery = $this->SuratBuilder->get(10, 0);
        // $suratQuery       = $this->SuratBuilder->get(10, 0);
        $pasienQuery      = $this->PasienBuilder->get(10, 0);
        $pasienCount      = $this->PasienBuilder->countAllResults();
        $suratCount       = $this->SuratBuilder->countAllResults();
        $userCount        = $this->UserBuilder->countAllResults();


        $data = [
          'title'    => 'Dashboard',
        'data_pasien' => $pasienQuery->getResultArray(),
        'data_surat' => $suratQuery->getResultArray(),
        'total_pasien' => $pasienCount,
        'total_surat' => $suratCount,
        'total_user' => $userCount
      ];
        return view('/administrator/index', $data);
    }

    public function profile()
    {
        return view('/administrator/my_profile');
    }
}
