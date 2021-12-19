<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_pasien extends Model
{
    protected $table = 'pasien';
    protected $primaryKey = 'id_pasien';
    protected $useTimestamps = true;
    protected $createdField = 'tanggal_dibuat';
    protected $updatedField = 'tanggal_diubah';
    protected $allowedFields = ['nama_pasien', 'slug', 'nik_pasien', 'tgl_lahir', 'jenis_kelamin', 'alamat', 'no_hp', 'email', 'foto_ktp', 'foto_kk', 'publik_key', 'private_key', 'hash_publik_key', 'hash_private_key', 'tanggal_dibuat', 'tanggal_diubah'];

    public function getPasien($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function search($keyword)
    {
        return $this->table('pasien')->like('nama_pasien', $keyword);
    }
}
