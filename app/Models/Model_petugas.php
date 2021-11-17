<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_petugas extends Model
{
    protected $table = 'satgas';
    protected $primaryKey = 'id_satgas';
    protected $useTimestamps = true;
    protected $createdField = 'tanggal_dibuat';
    protected $updatedField = 'tanggal_diubah';
    protected $allowedFields = ['nama_petugas','slug','nik_petugas','nip_petugas','jenis_kelamin','alamat','no_hp','email','foto_profil'];

    public function getPetugas($slug=false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug'=>$slug])->first();
    }

    public function search($keyword)
    {
        return $this->table('satgas')->like('nama_petugas', $keyword);
    }
}
