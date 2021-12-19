<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_kapus extends Model
{
    protected $table = 'kapus';
    protected $primaryKey = 'id_kapus';
    protected $useTimestamps = true;
    protected $createdField = 'tanggal_dibuat';
    protected $updatedField = 'tanggal_diubah';
    protected $allowedFields = ['id_kapus', 'slug', 'nama_kapus', 'nip_kp', 'hash_kapus', 'publik_key', 'private_key', 'hash_publik_key', 'hash_private_key', 'active', 'tanggal_dibuat', 'tanggal_diubah'];

    public function getkapus($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function search($keyword)
    {
        return $this->table('kapus')->like('nama_kapus', $keyword);
    }
}
