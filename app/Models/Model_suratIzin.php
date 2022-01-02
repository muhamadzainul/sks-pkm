<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_suratIzin extends Model
{
    protected $table = 'surat_izin';
    protected $primaryKey = 'id_suratIzin';
    protected $useTimestamps = true;
    protected $createdField = 'tgl_dibuat';
    protected $updatedField = 'tgl_diubah';
    protected $allowedFields = [
        'nomor_surat', 'nik_pasien', 'pangkat', 'jabatan', 'hari', 'tanggal', 'kepentingan', 'nip_kapus', 'qr_code', 'tgl_dibuat', 'tgl_dibuat', 'tanggal_exp'
    ];

    public function getSurat($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $id])->first();
    }

    public function search($keyword = null)
    {
        // return $this->table('surat_kesehatan')->like('nomor_surat', $keyword)->orlike('');

        $suratBuilder   = $this->table('surat_izin');
        $suratBuilder->select('id_suratIzin, nomor_surat, surat_izin.nik_pasien as nik_p, nama_pasien, nip_pasien, alamat,
        pangkat, jabatan, hari, tanggal, tgl_dibuat, kepentingan, nama_kapus, kapus.nip_kapus as nip_kp,');
        $suratBuilder->join('pasien', 'pasien.nik_pasien = surat_izin.nik_pasien');
        $suratBuilder->join('kapus', 'kapus.nip_kapus = surat_izin.nip_kapus');
        if ($keyword != null) {
            $suratBuilder->like('nomor_surat', $keyword);
            $suratBuilder->like('nik_pasien', $keyword);
            # code...
        }
        //
        return $suratBuilder;
    }
}
