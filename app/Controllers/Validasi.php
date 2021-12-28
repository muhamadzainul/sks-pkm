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
            // echo "private Key Pasien = " . $ps_pr;

            // private key pasien
            $this->kapusBuilder = $this->db->table('kapus');
            $this->kapusBuilder->select('publik_key');
            $pr = $this->kapusBuilder->where('nip_kapus', $this->request->getVar('nip_kapus'))->get();
            $kapus_key = $pr->getRow();
            $kp_pb = $kapus_key->publik_key;
            // echo "<br>Publik Key Kapus = " . $kp_pb;

            // echo "<br>Teks MD5 Asli = " . $data_scan['teks_asli'];
            // echo "<br>Teks Enkripsi = " . $data_scan['teks_enkripsi'];
            // $teks_asli = ;
            // $teks_enkrip = ;

            $has_dek = dekrip_text($data_scan['teks_asli'], $data_scan['teks_enkripsi'], $kp_pb, $ps_pr);
            // dd($has_dek);

            // echo $has_dek;
            $this->skBuilder = $this->db->table('surat_rsa');
            $this->skBuilder->select('id_sks, surat_rsa.nomor_surat as nmr_surat, surat_rsa.nik_pasien as nik_p, nama_pasien, nama_kapus, kapus.nip_kapus as nip_kp, jenis_kelamin, tgl_lahir, alamat,
    pekerjaan, kepentingan, tinggi_badan, berat_badan, tensi_darah, suhu_tubuh, nadi, respirasi, mata_buta, tubuh_tato, tubuh_tindik,
    hasil_periksa, qr_code, nama_kapus, kapus.nip_kapus as nip_kp, nama_kapus, pasien.tgl_lahir as tgl_lahir, surat_kesehatan.tanggal_dibuat as tgl_dibuat, 
    TIMESTAMPDIFF(MONTH , pasien.tgl_lahir, NOW() ) AS umur');
            $this->skBuilder->join('surat_kesehatan', 'surat_kesehatan.nomor_surat = surat_rsa.nomor_surat');
            $this->skBuilder->join('pasien', 'pasien.nik_pasien = surat_rsa.nik_pasien');
            $this->skBuilder->join('kapus', 'kapus.nip_kapus = surat_rsa.nip_kapus');
            // $this->skBuilder->where('id_sks', $id);
            $query = $this->skBuilder->get();
            $data_cetak = $query->getRowArray();
        } else {
            $has_dek = "Data Palsu Surat Tidak Sama";
        }
        $data = [
            'hasil_validasi' => $has_dek,
            'data_surat'     => $data_cetak
        ];

        return view("validasi_hasil", $data);
        // dd($data_scan);
    }

    public function coba()
    {

        // $pow = gmp_pow(5750, 36415);
        dd(chr(57));
        // echo "<br> hasil pow = " . gmp_mod(gmp_pow(5750, 51193), 73033);
        $hash_text = md5("Muhamad-Zainul-Mustofa-17041110011");
        $d = 51193;
        $n = 73033;
        $e2 = 251;
        $n3 = 133907;

        $hasil = "";
        $hasil_sem = "";
        $ascii = "";
        $ht = "";

        for ($i = 0; $i < strlen($hash_text); $i++) {
            $ascii .= ord($hash_text[$i]);
        }
        // echo "<br>".strlen($ascii);
        echo "<br>" . $ascii;
        $rq = strlen($ascii) - 4;
        $v_k = 0; // inisisalisasi angka 0 yang ada di depan pada nilai ascii yang telah dibagi menjadi blok-blok

        for ($j = 0; $j < strlen($ascii); $j++) {
            // echo "<br>",$j+1;
            // echo "<br>";
            // echo "<br>" . $ascii[$j];
            echo "<br>";

            if ((($j) % 4) == 0) {
                echo "<br>Nilai text ASCII = $j";
                // $ht = intval(substr($ascii, $j, 4));
                $pl = intval(substr($ascii, $j, 1)); // inisisalisasi nilai 1 pada tiap blok
                echo "<br>" . $pl;
                if ($pl == 0) {
                    for ($k = 0; $k < 4; $k++) {
                        $rf = intval(substr($ascii, $j + $k, 1)); //inisisalisasi angka 0 yang berada di depan pada tiap blok
                        if ($rf == 0) {
                            // code...
                            $hasil .= "0";
                            $v_k = $v_k + 1;
                        } else {
                            break;
                        }
                    }
                    $hasil .= "_";
                }

                $ht .= intval(substr($ascii, $j + $v_k, 4 - $v_k)); //inisisalisasi untuk mencari nilai yang sudah tidak ada nilai 0 di depannya pada tiap blok'
                $ht .= ".";
                $htt = explode(".", $ht);
                $ht2 = intval($htt[(count($htt)) - 2]);
                // dd($ht2);
                echo "<br> ht2 =" . $ht2;
                // echo "<br>" . $ht * 2;
                echo "<br>Nilai text ASCII = " . $j;
                // echo "<br>";
                // $pangkat = gmp_pow($ht, $d);
                // dd($ht2);
                $hasil_sem .= gmp_mod(gmp_pow($ht2, $d), $n);
                // dd($hasil_sem);
                $dfd = explode(".", $hasil_sem);
                $fdf = $dfd[count($dfd) - 1];
                echo "<br> hasil sementara = " . $hasil_sem;
                // echo "<br> hasil sementara2 = " . $pangkat;
                echo "<br>";
                // var_dump($pangkat);
                // echo "<br> hasil sementara2 = " . intval($pangkat) % intval($n);
                echo "<br>";
                var_dump($fdf);
                $ex1 = explode("_", $fdf);
                echo "<br>";
                var_dump($ex1);
                // echo "<br>";
                // echo "<br>" . empty($ex1[1]);
                if (!empty($ex1[1])) {
                    $ks2 = explode(".", $hasil);
                    // echo "<br> iterasi = ".count($ks2);
                    // echo "<br>".$ex1[1];
                    // echo "<br>".strlen($ex1[1]);
                } else {
                    // code...
                    // echo "<br>".$ex1[0];
                    // echo "<br>".strlen($ex1[0]);
                    $rd = 0;
                    $zr = intval(substr($ex1[0], 0, 4));
                    // echo "<br> e2 = $e2";
                    // echo "<br> n2 = $n3";
                    // echo "<br> zr = $zr";
                    $hasil .= gmp_mod(gmp_pow($zr, $e2), $n3);
                    // echo "<br>Hasil Coba = ".gmp_mod(gmp_pow($zr, $e2), $n3);
                    $zr2 = intval(substr($ex1[0], 4, strlen($ex1[0]) - 4));
                    if (strlen($ex1[0]) > 4) {
                        if ($zr2 == 0) {
                            $hasil .= "*";
                            for ($k = 0; $k < (strlen($ex1[0]) - 4); $k++) {
                                $rj = intval(substr($ex1[0], 4 + $k, 1)); //inisisalisasi angka 0 yang berada di depan pada tiap blok
                                // echo "<br> panjang ex1[0]".(strlen($ex1[0])-4);
                                // echo "<br> rj = ".$rj;
                                if ($rj == 0) {
                                    $hasil .= "0";
                                    $rd = $rd + 1;
                                } else {
                                    $zr3 = intval(substr($ex1[0], $k, (strlen($ex1[0]) - 4)));
                                    if (((strlen($ex1[0]) - 4) - $rd) != 0) {
                                        $hasil .= "*";
                                        $hasil .= gmp_mod(gmp_pow($zr2, $e2), $n3);
                                    }
                                    break;
                                }
                            }
                            // echo "<br> RD = $rd";
                            // if ((strlen($ex1[0]-4)) != 0) {
                            // $zr3 = intval(substr($ex1[0], 4+$rd, (strlen($ex1[0])-4)));
                            // echo "<br> ZR2 = $zr2";
                            // echo "<br> ZR3 = $zr3";
                            // echo "<br> if  = ".((strlen($ex1[0])-4)-$rd);
                            // if (((strlen($ex1[0])-4)-$rd) != 0) {
                            // code...
                            // $hasil .= "*";
                            // $hasil .= gmp_mod(gmp_pow($zr2, $e2), $n3);
                            // echo "<br>Hasil coba 2 ada 0 = ".gmp_mod(gmp_pow($zr2, $e2), $n3);
                            // }
                            // }
                        } else {
                            $zr3 = intval(substr($ex1[0], 4, ($ex1[0] - 4)));
                            // echo "<br> ZR2 = $zr3";
                            $hasil .= "*";
                            $hasil .= gmp_mod(gmp_pow($zr2, $e2), $n3);
                            // echo "<br>Hasil coba 2 = ".gmp_mod(gmp_pow($zr2, $e2), $n3);
                        }
                    }
                    $rd = $rd * 0;


                    $ks2 = explode(".", $hasil);
                    $ks4 = $ks2[(count($ks2) - 1)];
                    // $ks = explode("*", $zr);
                    // echo "<br>". $ks4;
                    // echo "<br>Jumlah angka = ".strlen($ex1[0]);
                    // echo "<br> iterasi = ".count($ks2);

                    // echo "<hr>";
                }



                if (($j + 5) <= strlen($ascii)) {
                    $hasil .= ".";
                }
            }
            // echo "<br>$v_k";
            $hasil_sem = "";
            $v_k = $v_k * 0;
        }
        echo "<br>Nilai text ASCII = $ascii";
        $hs = "";
        $pecah_enkrip = explode(".", $hasil);
        // echo "<br>". (count($pecah_enkrip));
        for ($ol = 0; $ol < count($pecah_enkrip); $ol++) {
            $pecah_enkrip2 = explode("*", $pecah_enkrip[$ol]);
            $pecah_0 = explode("_", $pecah_enkrip2[0]);
            // echo "<br>".(count($pecah_0));
            for ($io = 0; $io < count($pecah_enkrip2); $io++) {
                if (count($pecah_0) == 2) {
                    $hs .= $pecah_0[0];
                    $hs .= $pecah_0[1];
                } else {
                    $hs .= $pecah_enkrip2[$io];
                    // code...
                }
            }
        }
        echo "<br>Nilai Hasil Enkripsi asli = " . $hs;
        echo "<br>Nilai hasil Enkripsi = $hasil";
    }
}
