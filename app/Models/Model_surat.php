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
    protected $allowedFields = ['nomor_surat','slug','tinggi_badan','berat_badan','riwayat_penyakit','suhu_tubuh','tensi_darah','kepentingan','tanggal_exp'];

    public function getPetugas($slug=false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug'=>$slug])->first();
    }

    public function search($keyword)
    {
        return $this->table('surat_kesehatan')->like('nomor_surat', $keyword);
    }
}
