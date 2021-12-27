<?php

namespace App\Controllers;

class Validasi extends BaseController
{
    public function __construct()
    {
        $this->db           = \Config\Database::connect();
        $this->request      = \Config\Services::request();
    }

    public function index()
    {
        if (!empty($this->request->uri->getSegment(2))) {
            $data_ver1 = $this->request->uri->getSegment(2);
        } else {
            $data_ver1 = null;
        }

        // dd($data_ver1);

        $this->suratBuilder = $this->db->table('surat_rsa');
        $this->suratBuilder->select('id_sks, surat_rsa.nomor_surat as nmr_surat, surat_rsa.nik_pasien as nik_p, nama_pasien, nama_kapus, kapus.nip_kapus as nip_kp, jenis_kelamin, tgl_lahir, alamat,
    pekerjaan, kepentingan, tinggi_badan, berat_badan, tensi_darah, suhu_tubuh, nadi, respirasi, mata_buta, tubuh_tato, tubuh_tindik,
    hasil_periksa, qr_code, nama_kapus, kapus.nip_kapus as nip_kp, nama_kapus, pasien.tgl_lahir as tgl_lahir, surat_kesehatan.tanggal_dibuat as tgl_dibuat, 
    TIMESTAMPDIFF(MONTH , pasien.tgl_lahir, NOW() ) AS umur');
        $this->suratBuilder->join('surat_kesehatan', 'surat_kesehatan.nomor_surat = surat_rsa.nomor_surat');
        $this->suratBuilder->join('pasien', 'pasien.nik_pasien = surat_rsa.nik_pasien');
        $this->suratBuilder->join('kapus', 'kapus.nip_kapus = surat_rsa.nip_kapus');
        // $this->suratBuilder->where('id_sks', $id);
        $query = $this->suratBuilder->get();
        $data_cetak = $query->getRowArray();

        $data = [
            'data_scan'     => $data_ver1,
            'data_surat'    => $data_cetak
        ];

        return view('validasi', $data);
    }
    public function hasil_validasi($data_scan)
    {
        // dd($data_scan);
        $this->suratBuilder = $this->db->table('surat_rsa');
        $this->suratBuilder->select('nomor_surat, nik_pasien, nip_kapus, teks_asli, teks_enkripsi, hash_enkrip, tanggal_dibuat');
        $this->suratBuilder->where('hash_enkrip', $data_scan);
        $query = $this->suratBuilder->get();
        $data_scan = $query->getRowArray();

        if ($data_scan['nik_pasien'] == $this->request->getVar('nik_pasien') && $data_scan['tanggal_dibuat'] == $this->request->getVar('tgl_dibuatsurat')) {
            // private key pasien
            $this->pasienBuilder = $this->db->table('pasien');
            $this->pasienBuilder->select('private_key');
            $pr = $this->pasienBuilder->where('nik_pasien', $this->request->getVar('nik_pasien'))->get();
            $pasien_key = $pr->getRow();
            $ps_pr = $pasien_key->private_key;
            echo "private Key Pasien = " . $ps_pr;

            // private key pasien
            $this->kapusBuilder = $this->db->table('kapus');
            $this->kapusBuilder->select('publik_key');
            $pr = $this->kapusBuilder->where('nip_kapus', $this->request->getVar('nip_kapus'))->get();
            $kapus_key = $pr->getRow();
            $kp_pb = $kapus_key->publik_key;
            echo "<br>Publik Key Kapus = " . $kp_pb;

            echo "<br>Teks MD5 Asli = " . $data_scan['teks_asli'];
            echo "<br>Teks Enkripsi = " . $data_scan['teks_enkripsi'];
            // $teks_asli = ;
            // $teks_enkrip = ;

            $has_dek = dekrip_text($data_scan['teks_asli'], $data_scan['teks_enkripsi'], $kp_pb, $ps_pr);
            // dd($has_dek);

            echo $has_dek;
        } else {
            echo "Data Palsu Surat Tidak Sama";
        }
        // dd($data_scan);
    }
    public function coba()
    {

        // $pow = gmp_pow(5750, 36415);
        echo "<br> hasil pow = " . gmp_mod(gmp_pow(5750, 36415), 50213);
    }
}
