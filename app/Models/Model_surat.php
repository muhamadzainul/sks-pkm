<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_surat extends Model
{
    protected $table = 'surat_kesehatan';
    protected $primaryKey = 'id_sks';
    protected $useTimestamps = true;
    protected $createdField = 'tanggal_dibuat';
    protected $updatedField = 'tanggal_diubah';
    protected $allowedFields = ['nomor_surat', 'nik_pasien', 'nama_pasien', 'jenis_kelamin', 'tgl_lahir', 'alamat',
    'pekerjaan', 'kepentingan', 'tinggi_badan', 'berat_badan', 'tensi_darah', 'suhu_tubuh', 'nadi', 'respirasi', 'mata_buta', 'tubuh_tato', 'tubuh_tindik',
    'hasil_periksa', 'nama_kapus', 'nip_kapus', 'tanggal_exp'];

    public function getPetugas($slug=false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug'=>$slug])->first();
    }

    public function search($keyword)
    {
        // return $this->table('surat_kesehatan')->like('nomor_surat', $keyword)->orlike('');

        $suratBuilder   = $this->table('surat_kesehatan');
        $suratBuilder->select('id_sks, nomor_surat, surat_kesehatan.nik_pasien as nik_p, nama_pasien, jenis_kelamin, tgl_lahir, alamat,
        pekerjaan, kepentingan, tinggi_badan, berat_badan, tensi_darah, suhu_tubuh, nadi, respirasi, mata_buta, tubuh_tato, tubuh_tindik,
        hasil_periksa, nama_kapus, kapus.nip_kapus as nip_kp');
        $suratBuilder->join('pasien', 'pasien.nik_pasien = surat_kesehatan.nik_pasien');
        $suratBuilder->join('kapus', 'kapus.nip_kapus = surat_kesehatan.nip_kapus');
        $suratBuilder->like('nomor_surat', $keyword);
        $suratBuilder->like('nik_pasien', $keyword);
        //
        return $suratBuilder;
    }
}
