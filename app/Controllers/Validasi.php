<?php

namespace App\Controllers;

use DateTime;
use Endroid\QrCode\Color\Color;
use \Endroid\QrCode\Encoding\Encoding;
use \Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use \Endroid\QrCode\QrCode;
use \Endroid\QrCode\Label\Label;
use \Endroid\QrCode\Logo\Logo;
use \Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use \Endroid\QrCode\Writer\PngWriter;

class Validasi extends BaseController
{
    protected $dekripsi;
    public function __construct()
    {
        $this->db           = \Config\Database::connect();
        $this->request      = \Config\Services::request();
        $this->dekripsi     = \Config\Services::encrypter();
    }

    public function index()
    {
        if (!empty($this->request->uri->getSegment(2))) {
            $rsa        = explode('+', $this->request->uri->getSegment(2));
            $data_ver1  = $rsa[0];
            $token      = $rsa[1];
        } else {
            $data_ver1 = null;
            $token     = null;
        }

        // dd($data_ver1);

        $this->suratBuilder = $this->db->table('surat_rsa');
        $this->suratBuilder->select('id_sks, surat_rsa.nomor_surat as nmr_surat, surat_rsa.nik_pasien as nik_p, nama_pasien, nama_kapus, kapus.nip_kapus as nip_kp, jenis_kelamin, tgl_lahir, alamat,
    pekerjaan, kepentingan, tinggi_badan, berat_badan, tensi_darah, suhu_tubuh, nadi, respirasi, mata_buta, tubuh_tato, tubuh_tindik,
    hasil_periksa, surat_kesehatan.qr_code as surat_qr, pasien.qr_code as qr_key,nama_kapus, kapus.nip_kapus as nip_kp, nama_kapus, pasien.tgl_lahir as tgl_lahir, surat_kesehatan.tanggal_dibuat as tgl_dibuat, 
    TIMESTAMPDIFF(MONTH , pasien.tgl_lahir, NOW() ) AS umur');
        $this->suratBuilder->join('surat_kesehatan', 'surat_kesehatan.nomor_surat = surat_rsa.nomor_surat');
        $this->suratBuilder->join('pasien', 'pasien.nik_pasien = surat_rsa.nik_pasien');
        $this->suratBuilder->join('kapus', 'kapus.nip_kapus = surat_rsa.nip_kapus');
        // $this->suratBuilder->where('id_sks', $id);
        $query = $this->suratBuilder->get();
        $data_cetak = $query->getRowArray();

        $data = [
            'title'         => 'Validasi Surat',
            'data_scan'     => $data_ver1,
            'token'         => $token,
            'data_surat'    => $data_cetak
        ];

        return view('validasi', $data);
    }
    public function hasil_validasi($data_scan)
    {
        // dd($data_scan);
        // dd($this->request->getVar('nik_pasien'));

        $this->suratBuilder = $this->db->table('surat_rsa');
        $this->suratBuilder->select('id_surat_rsa, nomor_surat, nik_pasien, nip_kapus, teks_asli, teks_enkripsi, hash_enkrip, tanggal_dibuat, kunci_pasien');
        $this->suratBuilder->where('hash_enkrip', $data_scan);
        $query = $this->suratBuilder->get();
        $data_scan = $query->getRowArray();

        $pass       = $this->request->getVar('password_pas');
        // dd($pass);
        // echo '<br>' . $pass;
        // dd($data_scan['kunci_pasien']);
        // echo $data_scan['kunci_pasien'];
        // $txt = '1nfR2svN+qUhVZofmDxbl1VGgTXz94PsGxg4L0Qx77VkYiLyOSlHyU+rO1bib+NagPvdHTCi3u64ZhK+aWvegyZBf/ev9BDsY5v6FJL87sQ=';
        // dd(empty($srt_deck));
        if (!empty($data_scan)) {
            // $srt_deck   = $this->dekripsi->decrypt(base64_decode($txt));
            // dd($srt_deck == $pass);
            // 
            $srt_deck   = $this->dekripsi->decrypt(base64_decode($data_scan['kunci_pasien']));
            if ($data_scan['nik_pasien'] == $this->request->getVar('nik_pasien') && $data_scan['tanggal_dibuat'] == $this->request->getVar('tgl_dibuatsurat')) {
                if ($srt_deck == $pass) {
                    // dd($data_scan['nik_pasien']);
                    // private key pasien
                    $this->pasienBuilder = $this->db->table('pasien');
                    $this->pasienBuilder->select('private_key');
                    $pr = $this->pasienBuilder->where('nik_pasien', $this->request->getVar('nik_pasien'))->get();
                    $pasien_key = $pr->getRow();
                    $priv_pas = $pasien_key->private_key;
                    $ps_pr    = $this->dekripsi->decrypt(base64_decode($priv_pas));

                    // $in_priv = $this->request->getVar('privete_key');
                    // dd($in_priv);
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

                    $start_time = microtime(true) * 1000;
                    $has_dek = dekrip_text($data_scan['teks_asli'], $data_scan['teks_enkripsi'],  $kp_pb, $ps_pr);
                    // dekrip_text($hash_text, $enk[1], $publik_key, $private_key2);
                    $end_time = microtime(true) * 1000;
                    $dekrip_time = $end_time - $start_time;

                    $start_time_biasa = microtime(true) * 1000;
                    Dekripsi_biasa($data_scan['teks_asli'], $data_scan['teks_enkripsi'], $kp_pb);
                    $end_time_biasa = microtime(true) * 1000;
                    $dekrip_time_biasa = $end_time_biasa - $start_time_biasa;

                    // dd($has_dek);

                    // echo $has_dek;
                    $this->skBuilder = $this->db->table('surat_rsa');
                    $this->skBuilder->select('id_sks, surat_rsa.nomor_surat as nmr_surat, surat_rsa.nik_pasien as nik_p, nama_pasien, nama_kapus, kapus.nip_kapus as nip_kp, jenis_kelamin, tgl_lahir, alamat,
            pekerjaan, kepentingan, tinggi_badan, berat_badan, tensi_darah, suhu_tubuh, nadi, respirasi, mata_buta, tubuh_tato, tubuh_tindik,
            hasil_periksa, surat_kesehatan.qr_code as surat_qr, pasien.qr_code as qr_key, nama_kapus, kapus.nip_kapus as nip_kp, nama_kapus, pasien.tgl_lahir as tgl_lahir, surat_kesehatan.tanggal_dibuat as tgl_dibuat, 
            TIMESTAMPDIFF(MONTH , pasien.tgl_lahir, NOW() ) AS umur');
                    $this->skBuilder->join('surat_kesehatan', 'surat_kesehatan.nomor_surat = surat_rsa.nomor_surat');
                    $this->skBuilder->join('pasien', 'pasien.nik_pasien = surat_rsa.nik_pasien');
                    $this->skBuilder->join('kapus', 'kapus.nip_kapus = surat_rsa.nip_kapus');
                    $this->skBuilder->where('surat_rsa.nik_pasien', $data_scan['nik_pasien']);
                    $query = $this->skBuilder->get();
                    $data_cetak = $query->getRowArray();
                    # code...
                } else {
                    $has_dek = "Token Tidak Sesuai";
                    $data_cetak = "";
                }
                // echo "private Key Pasien = " . $ps_pr;

                // private key pasien
                // dd($data_cetak['nama_pasien']);
            } else {
                $has_dek    = "Surat Palsu Data Verifikasi Tidak Sama";
                $data_cetak = "";
            }
            if (!empty($dekrip_time)) {
                # code...
                $upd = [
                    'waktu_dekripsi'          => $dekrip_time,
                    'waktu_dekripsi_rsaBiasa' => $dekrip_time_biasa
                ];
                $this->suratBuilder->where('id_surat_rsa', $data_scan['id_surat_rsa']);
                $this->suratBuilder->update($upd);
            }

            $tdl_dbu = new DateTime($data_scan['tanggal_dibuat']);
            $tgl_now = new DateTime();
            $exp_tgl = $tgl_now->diff($tdl_dbu);
            $tgl_exp = $exp_tgl->days;
            // dd($tdl_dbu);
            # code...
        } else {
            $has_dek    = "Surat Palsu Data Scan Tidak Sama";
            $data_cetak = "";
            $tgl_exp = null;
        }



        $data = [
            'exp_tgl'        => $tgl_exp,
            'title'          => 'Hasil Validasi',
            'hasil_validasi' => $has_dek,
            'data_surat'     => $data_cetak
        ];

        return view("validasi_hasil", $data);
        // dd($data_scan);
    }
    public function verif_validasi()
    {
        // if (!empty($this->request->uri->getSegment(2))) {
        //     $data_ver1 = $this->request->uri->getSegment(2);
        // } else {
        //     $data_ver1 = null;
        // }
        $code       = explode('+', $this->request->getVar('qr_code'));
        $data_ver1  = $code[0];
        $token      = $code[1];

        // dd($data_ver1);

        $this->suratBuilder = $this->db->table('surat_rsa');
        $this->suratBuilder->select('id_sks, surat_rsa.nomor_surat as nmr_surat, surat_rsa.nik_pasien as nik_p, nama_pasien, nama_kapus, kapus.nip_kapus as nip_kp, jenis_kelamin, tgl_lahir, alamat,
    pekerjaan, kepentingan, tinggi_badan, berat_badan, tensi_darah, suhu_tubuh, nadi, respirasi, mata_buta, tubuh_tato, tubuh_tindik,
    hasil_periksa, surat_kesehatan.qr_code as surat_qr, pasien.qr_code as qr_key,nama_kapus, kapus.nip_kapus as nip_kp, nama_kapus, pasien.tgl_lahir as tgl_lahir, surat_kesehatan.tanggal_dibuat as tgl_dibuat, 
    TIMESTAMPDIFF(MONTH , pasien.tgl_lahir, NOW() ) AS umur');
        $this->suratBuilder->join('surat_kesehatan', 'surat_kesehatan.nomor_surat = surat_rsa.nomor_surat');
        $this->suratBuilder->join('pasien', 'pasien.nik_pasien = surat_rsa.nik_pasien');
        $this->suratBuilder->join('kapus', 'kapus.nip_kapus = surat_rsa.nip_kapus');
        // $this->suratBuilder->where('id_sks', $id);
        $query = $this->suratBuilder->get();
        $data_cetak = $query->getRowArray();

        $data = [
            'title'         => 'Validasi Surat',
            'data_scan'     => $data_ver1,
            'token'         => $token,
            'data_surat'    => $data_cetak
        ];
        return view('verif_validasi', $data);
    }

    public function coba()
    {

        $text = "Muhamad-Zainul-Mustofa-17041110011";
        $hash_text = md5($text);

        $kunci_rsa = get_key();

        // // $kp = explode('$kunci_rsa);
        $publik_key = "109.12317";
        $private_key = "8101.12317";

        $kunci_rsa2 = get_key();

        // // $kp = explode('$kunci_rsa);
        $publik_key2 = "151.87391";
        $private_key2 = "83351.87391";

        $enk = enkripsi_text($hash_text, $private_key, $publik_key2);

        // dd($enk[1]);
        dekrip_text($hash_text, $enk[1], $publik_key, $private_key2);
        dd();

        // $pr = $this->dekripsi->decrypt(base64_decode('8WG96ceuzmHq7DMiA/U5DAkL3ETZh3URxEtZTRZSAkLKYYpYb5dl/suy+7J/lQO5lf1Gaeuuu6KvXzeea/1bLdVmNngn57xJQOXd3xwdbwCozN8r7k74oQ=='));
        // dd($pr);

        // $pasien = $this->db->table('pasien');
        // $ps = $pasien->select('id_pasien, nama_pasien, nik_pasien, publik_key, private_key')->get();
        // $pss = $ps->getResultArray();

        // $kapus = $this->db->table('kapus');
        // $kp = $kapus->select('id_kapus, nama_kapus, nip_kapus, publik_key, private_key')->get();
        // $kpp = $kp->getResultArray();

        // $surat = $this->db->table('surat_rsa');
        // $surat->select('pasien.nama_pasien as nama_pasien, panjang_rsaGanda, panjang_rsa, pasien.nik_pasien as nik_pasien, waktu_enkripsi, waktu_dekripsi, waktu_enkripsi_rsaBiasa, waktu_dekripsi_rsaBiasa');
        // $surat->join('surat_kesehatan', 'surat_kesehatan.nomor_surat = surat_rsa.nomor_surat');
        // $surat->join('pasien', 'pasien.nik_pasien = surat_rsa.nik_pasien');
        // $surat->join('kapus', 'kapus.nip_kapus = surat_rsa.nip_kapus');
        // $srr = $surat->get();
        // $srrt = $srr->getResultArray();

        // dd(count($pss));
        // for ($i = 0; $i < count($pss); $i++) {
        //     echo "<br>Nama Pasien : " . $pss[$i]['nama_pasien'];
        //     echo "<br>Nik Pasien : " . $pss[$i]['nik_pasien'];
        //     echo "<br>Publik Key : " . $pss[$i]['publik_key'];
        //     echo "<br>Private Key : " . $this->dekripsi->decrypt(base64_decode($pss[$i]['private_key']));
        //     echo "<br>";
        //     # code...
        // }
        // for ($i = 0; $i < count($kpp); $i++) {
        //     echo "<br>Nama Kapus : " . $kpp[$i]['nama_kapus'];
        //     echo "<br>Nip Kapus : " . $kpp[$i]['nip_kapus'];
        //     echo "<br>Publik Key : " . $kpp[$i]['publik_key'];
        //     echo "<br>Private Key : " . $this->dekripsi->decrypt(base64_decode($kpp[$i]['private_key']));
        //     echo "<br>";
        //     # code...
        // }
        // for ($i = 0; $i < count($srrt); $i++) {
        //     echo "<br>Nama Pasien : " . $srrt[$i]['nama_pasien'];
        //     echo "<br>NIK Pasien : " . $srrt[$i]['nik_pasien'];
        //     echo "<br>Panjang RSA Ganda : " . $srrt[$i]['panjang_rsaGanda'];
        //     echo "<br>Panjang RSA Biasa : " . $srrt[$i]['panjang_rsa'];
        //     echo "<br>Waktu Enkripsi : " . $srrt[$i]['waktu_enkripsi'];
        //     echo "<br>Waktu Enkripsi Rsa Biasa : " . $srrt[$i]['waktu_enkripsi_rsaBiasa'];
        //     echo "<br>Waktu Dekripsi : " . $srrt[$i]['waktu_dekripsi'];
        //     echo "<br>Waktu Dekripsi Rsa Biasa : " . $srrt[$i]['waktu_dekripsi_rsaBiasa'];
        //     // echo "<br>Private Key kapus : " . $this->dekripsi->decrypt(base64_decode($srrt[$i]['private_key']));
        //     echo "<br>";
        //     # code...
        // }


        // dd(getToken(8));
        // $this->srBuilder = $this->db->table('surat_kesehatan');
        // $sk = $this->srBuilder->select('id_sks, nomor_surat')->orderBy('id_sks', 'DESC')->get();
        // $sr = $sk->getresultArray();
        // // dd($sr[0]['nomor_surat']);
        // $ex = explode('/', $sr[0]['nomor_surat']);
        // // dd(count($ex) > 1);
        // if (count($ex) > 1) {
        //     $thn = date('Y');
        //     if ($thn == $ex[1]) {
        //         $no = $ex[0] + 1;
        //         $nomor_surat = $no . '/' . date('Y');
        //     } else {
        //         $no = 1;
        //         $nomor_surat = $no . '/' . date('Y');
        //     }
        // } else {
        //     $nomor_surat = '1/' . date('Y');
        // }

        // dd($nomor_surat);


        // dd(date('d m Y'));
        // $text_qr = "TI9J3LEhv4fwaKzs9BfQveguWngHbBBOd4aQKeXn7cG2W2JNcncVpqC8mpAda3c3f/fDjVj6hgzSJVNsvCo+bEFrdpiWtfd5ZB8rmw8uTdiZFmdGF+e4zQh8CA==";

        // $this->gen_qr   = QrCode::create($text_qr);
        // $writer         = new PngWriter();

        // $qrCode = $this->gen_qr->setEncoding(new Encoding('UTF-8'))
        //     ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
        //     ->setSize(300)
        //     ->setMargin(10)
        //     ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
        //     ->setForegroundColor(new Color(0, 0, 0))
        //     ->setBackgroundColor(new Color(255, 255, 255));

        // // Create generic logo
        // $logo = Logo::create('./gambar/Logo-Mojokerto.png')
        //     ->setResizeToWidth(50);
        // $test = $writer->write($qrCode, $logo);
        // $nama_file = generateRandomString(32);
        // $test->saveToFile('./gambar/qr_code/pasien/' . $nama_file . '.png');
        // $db_qrcode_pasien = $nama_file . '.png';

        // header('Content-Type: ' . $test->getMimeType());
        // echo $test->getString();
        // dd();


        // $contoh = base64_encode($this->dekripsi->encrypt('28429.89147'));
        // echo $contoh;
        // echo "<br>" . $this->dekripsi->decrypt(base64_decode($contoh)) . "<br>";
        // $this->pasienBuilder = $this->db->table('pasien');
        // $this->pasienBuilder->select('private_key');
        // $pr = $this->pasienBuilder->where('nik_pasien', '678324562345322')->get();
        // $pasien_key = $pr->getRow();
        // $priv_pas = $pasien_key->private_key;
        // echo $priv_pas . "<br>";
        // // $ps_pr    = $this->dekripsi->decrypt($priv_pas);
        // echo "<br>" . $this->dekripsi->decrypt(base64_decode($priv_pas)) . "<br>";
        // // echo generateRandomString(6);
        // $pow = gmp_pow(5750, 36415);
        // dd(chr(57));
        // echo "<br> hasil pow = " . gmp_mod(gmp_pow(5750, 51193), 73033);
        // $hash_text = md5("Muhamad-Zainul-Mustofa-17041110011");
        // $rsa_key = get_key();

        // $enk = Enkripsi_biasa($hash_text, $rsa_key[1]);
        // $dek = Dekripsi_biasa($hash_text, $enk[1], $rsa_key[0]);
        // dd($dek);

        // $pub = explode('.', $rsa_key[0]);
        // $pri = explode('.', $rsa_key[1]);
        // $e = $pub[0];
        // $d = $pri[0];
        // $n = $pub[1];

        // // $d = 51193;
        // // $n = 73033;
        // // $e2 = 251;
        // // $n3 = 133907;

        // echo "<br> e = $e";
        // echo "<br> d = $d";
        // echo "<br> n = $n";

        // $hasil = "";
        // $hasil_sem = "";
        // $ascii = "";
        // $ht = "";

        // for ($i = 0; $i < strlen($hash_text); $i++) {
        //     $ascii .= ord($hash_text[$i]);
        // }
        // // echo "<br>".strlen($ascii);
        // echo "<br>" . $ascii;
        // $rq = strlen($ascii) - 4;
        // $v_k = 0; // inisisalisasi angka 0 yang ada di depan pada nilai ascii yang telah dibagi menjadi blok-blok

        // for ($j = 0; $j < strlen($ascii); $j++) {
        //     // echo "<br>",$j+1;
        //     // echo "<br>";
        //     // echo "<br>" . $ascii[$j];
        //     echo "<br>";

        //     if ((($j) % 4) == 0) {
        //         echo "<br>Nilai text ASCII = $j";
        //         // $ht = intval(substr($ascii, $j, 4));
        //         $pl = intval(substr($ascii, $j, 1)); // inisisalisasi nilai 1 pada tiap blok
        //         echo "<br> pl =" . $pl;
        //         if ($pl == 0) {
        //             // for ($k = 0; $k < 4; $k++) {
        //             //     $rf = intval(substr($ascii, $j + $k, 1)); //inisisalisasi angka 0 yang berada di depan pada tiap blok
        //             //     if ($rf == 0) {
        //             //         // code...
        //             //         $hasil .= "0";
        //             //         $v_k = $v_k + 1;
        //             //     } else {
        //             //         break;
        //             //     }
        //             // }
        //             $hasil .= "0";
        //             $hasil .= "_";
        //         }

        //         $ht .= intval(substr($ascii, $j + $v_k, 4 - $v_k)); //inisisalisasi untuk mencari nilai yang sudah tidak ada nilai 0 di depannya pada tiap blok'
        //         $ht .= ".";
        //         $htt = explode(".", $ht);
        //         $ht2 = intval($htt[(count($htt)) - 2]);
        //         // dd($ht2);
        //         echo "<br> ht2 =" . $ht2;
        //         // echo "<br>" . $ht * 2;
        //         // echo "<br>Nilai text ASCII = " . $j;
        //         // echo "<br>";
        //         // $pangkat = gmp_pow($ht, $d);
        //         // dd($ht2);
        //         $hasil .= gmp_mod(gmp_pow($ht2, $d), $n);
        //         // dd($hasil_sem);
        //         // $dfd = explode(".", $hasil_sem);
        //         // $fdf = $dfd[count($dfd) - 1];
        //         // echo "<br> hasil sementara = " . $hasil_sem;
        //         // echo "<br> hasil sementara2 = " . $pangkat;
        //         // echo "<br>";
        //         // var_dump($pangkat);
        //         // echo "<br> hasil sementara2 = " . intval($pangkat) % intval($n);
        //         // echo "<br>";
        //         // var_dump($fdf);
        //         // $ex1 = explode("_", $fdf);
        //         // echo "<br>";
        //         // var_dump($ex1);
        //         // echo "<br>";
        //         // echo "<br>" . empty($ex1[1]);
        //         // if (!empty($ex1[1])) {
        //         //     $ks2 = explode(".", $hasil);
        //         // echo "<br> iterasi = ".count($ks2);
        //         // echo "<br>".$ex1[1];
        //         // echo "<br>".strlen($ex1[1]);
        //         // } else {
        //         // code...
        //         // echo "<br>".$ex1[0];
        //         // echo "<br>".strlen($ex1[0]);
        //         // $rd = 0;
        //         // $zr = intval(substr($ex1[0], 0, 4));
        //         // echo "<br> e2 = $e2";
        //         // echo "<br> n2 = $n3";
        //         // echo "<br> zr = $zr";
        //         // $hasil .= gmp_mod(gmp_pow($zr, $e2), $n3);
        //         // echo "<br>Hasil Coba = ".gmp_mod(gmp_pow($zr, $e2), $n3);
        //         // $zr2 = intval(substr($ex1[0], 4, strlen($ex1[0]) - 4));
        //         // if (strlen($ex1[0]) > 4) {
        //         //     if ($zr2 == 0) {
        //         //         $hasil .= "*";
        //         //         for ($k = 0; $k < (strlen($ex1[0]) - 4); $k++) {
        //         //             $rj = intval(substr($ex1[0], 4 + $k, 1)); //inisisalisasi angka 0 yang berada di depan pada tiap blok
        //         //             // echo "<br> panjang ex1[0]".(strlen($ex1[0])-4);
        //         //             // echo "<br> rj = ".$rj;
        //         //             if ($rj == 0) {
        //         //                 $hasil .= "0";
        //         //                 $rd = $rd + 1;
        //         //             } else {
        //         //                 $zr3 = intval(substr($ex1[0], $k, (strlen($ex1[0]) - 4)));
        //         //                 if (((strlen($ex1[0]) - 4) - $rd) != 0) {
        //         //                     $hasil .= "*";
        //         //                     $hasil .= gmp_mod(gmp_pow($zr2, $e2), $n3);
        //         //                 }
        //         //                 break;
        //         //             }
        //         //         }
        //         //         // echo "<br> RD = $rd";
        //         //         // if ((strlen($ex1[0]-4)) != 0) {
        //         //         // $zr3 = intval(substr($ex1[0], 4+$rd, (strlen($ex1[0])-4)));
        //         //         // echo "<br> ZR2 = $zr2";
        //         //         // echo "<br> ZR3 = $zr3";
        //         //         // echo "<br> if  = ".((strlen($ex1[0])-4)-$rd);
        //         //         // if (((strlen($ex1[0])-4)-$rd) != 0) {
        //         //         // code...
        //         //         // $hasil .= "*";
        //         //         // $hasil .= gmp_mod(gmp_pow($zr2, $e2), $n3);
        //         //         // echo "<br>Hasil coba 2 ada 0 = ".gmp_mod(gmp_pow($zr2, $e2), $n3);
        //         //         // }
        //         //         // }
        //         //     } else {
        //         //         $zr3 = intval(substr($ex1[0], 4, ($ex1[0] - 4)));
        //         //         // echo "<br> ZR2 = $zr3";
        //         //         $hasil .= "*";
        //         //         $hasil .= gmp_mod(gmp_pow($zr2, $e2), $n3);
        //         //         // echo "<br>Hasil coba 2 = ".gmp_mod(gmp_pow($zr2, $e2), $n3);
        //         //     }
        //         // }
        //         // $rd = $rd * 0;


        //         // $ks2 = explode(".", $hasil);
        //         // $ks4 = $ks2[(count($ks2) - 1)];
        //         // $ks = explode("*", $zr);
        //         // echo "<br>". $ks4;
        //         // echo "<br>Jumlah angka = ".strlen($ex1[0]);
        //         // echo "<br> iterasi = ".count($ks2);

        //         // echo "<hr>";
        //         // }



        //         if (($j + 5) <= strlen($ascii)) {
        //             $hasil .= ".";
        //         }
        //     }
        //     // echo "<br>$v_k";
        //     $hasil_sem = "";
        //     $v_k = $v_k * 0;
        // }
        // echo "<br>Nilai text ASCII = $ascii";
        // echo "<br>Nilai Hasil Enkripsi = $hasil";
        // $hs = "";
        // $pecah_enkrip = explode(".", $hasil);
        // // dd($hasil);
        // // echo "<br>". (count($pecah_enkrip));
        // for ($ol = 0; $ol < count($pecah_enkrip); $ol++) {
        //     $pecah_enkrip2 = explode("*", $pecah_enkrip[$ol]);
        //     $pecah_0 = explode("_", $pecah_enkrip2[0]);
        //     // echo "<br>".(count($pecah_0));
        //     for ($io = 0; $io < count($pecah_enkrip2); $io++) {
        //         if (count($pecah_0) == 2) {
        //             $hs .= $pecah_0[0];
        //             $hs .= $pecah_0[1];
        //         } else {
        //             $hs .= $pecah_enkrip2[$io];
        //             // code...
        //         }
        //     }
        // }
        // echo "<br>Nilai Hasil Enkripsi asli = " . $hs;
        // echo "<br>Nilai hasil Enkripsi = $hasil";


        // // Dekripsi
        // // echo "<br>";
        // $h_dekrip = "";
        // $dekrip_sem = "";

        // $text_d = explode(".", $hasil);
        // // echo "<br>".count($text_d);
        // // dd($text_d[0]);

        // for ($i = 0; $i < count($text_d); $i++) {
        //     $tf = intval(substr($text_d[$i], 0, 1));
        //     echo "<br> tf = " . $text_d[$i];
        //     $tq = explode("_", $text_d[$i]);
        //     echo "<br> tq =" . count($tq) . "<br>";
        //     if (count($tq) > 1) {
        //         $h_dekrip .= $tq[0];
        //         $h_dekrip .= gmp_strval(gmp_mod(gmp_pow(intval($tq[1]), $e), $n));
        //     } else {
        //         $h_dekrip .= gmp_strval(gmp_mod(gmp_pow(intval($text_d[$i]), $e), $n));
        //     }
        //     // $dekrip_sem = "";
        //     // echo "<br>" . $text_d[$i];
        //     // dd($text_d[$i]);
        //     // echo "<br>".$tf;
        //     // if ($tf == 0) {
        //     //     $jk = explode("*", $text_d[$i]);
        //     //     for ($k = 0; $k < count($jk); $k++) {
        //     //         $fr = intval(substr($jk[$k], 0, 1));
        //     //         $tq = explode("_", $jk[$k]);
        //     //         // echo "<br> count TQ".(count($tq));
        //     //         // echo "<br>TQ[0] = ".$tq[0];
        //     //         // echo "<br>TQ[1] = ".$tq[1];
        //     //         if (count($tq) > 1) {
        //     //             // if ($tq[0] == "0") {
        //     //             // var_dump(count($tq));
        //     //             $h_dekrip .= $tq[0];
        //     //             // if (empty($tq[1])) {
        //     //             // $dekrip_sem .= 0;
        //     //             // echo "<br>TQ =".$tq[1];
        //     //             // } else {
        //     //             // echo "<br>TQ =".$tq[1];
        //     //             $dekrip_sem .= gmp_mod(gmp_pow(intval($tq[1]), $d2), $n4);
        //     //             // code...
        //     //             // } else {
        //     //             // $dekrip_sem .= gmp_mod(gmp_pow(intval($tq[0]), $d2), $n4);
        //     //             // }
        //     //             // code...
        //     //             // }
        //     //         } else {
        //     //             $dekrip_sem .= gmp_mod(gmp_pow(intval($jk[$k]), $d2), $n4);
        //     //         }
        //     //     }
        //     //     // echo "<br>$text_d[$i]";
        //     //     // echo "<br>$dekrip_sem";
        //     //     $h_dekrip .= gmp_strval(gmp_mod(gmp_pow(intval($dekrip_sem), $e), $n));
        //     //     $dekrip_sem = "";
        //     //     // echo "<br>0".$tq[1];
        //     // } else {
        //     //     // echo "<br>".$text_d[$i];
        //     //     $ik = explode("*", $text_d[$i]);
        //     //     for ($j = 0; $j < count($ik); $j++) {
        //     //         $dekrip_sem .= gmp_mod(gmp_pow(intval($ik[$j]), $d2), $n4);
        //     //     }
        //     //     $h_dekrip .= gmp_strval(gmp_mod(gmp_pow(intval($dekrip_sem), $e), $n));
        //     //     // echo "<br>$text_d[$i]";
        //     //     // echo "<br>$dekrip_sem";
        //     //     $dekrip_sem = "";
        //     // }
        // }

        // $hasil_ascii = "";
        // $var = 0;
        // $kap = strlen($h_dekrip) - 2;
        // // echo "<br>" . $kap;
        // for ($i = 0; $i < strlen($h_dekrip); $i++) {
        //     if (($i % 2 == $var)) {
        //         $re = substr($h_dekrip, $i, 1);
        //         if ($re == 1) {
        //             $hasil_ascii .= substr($h_dekrip, $i, 3);
        //             if ($i != $kap) {
        //                 $hasil_ascii .= ".";
        //                 // code...
        //             }
        //             if ($var == 0) {
        //                 $i = $i + 1;
        //                 $var = $var + 1;
        //             } else {
        //                 $i = $i + 1;
        //                 $var = $var - 1;
        //             }
        //         } else {
        //             $hasil_ascii .= substr($h_dekrip, $i, 2);
        //             if ($i != $kap) {
        //                 $hasil_ascii .= ".";
        //             }
        //         }
        //         // echo "<br> i = " . $i;
        //         // echo "<br> kap = " . $kap;
        //     }
        // }

        // $hh = "";
        // $tra = explode(".", $hasil_ascii);
        // // echo "<br>";
        // // var_dump($tra);
        // for ($i = 0; $i < count($tra); $i++) {
        //     if (strlen($tra[$i]) != 0) {
        //         $hh .= chr(intval($tra[$i]));
        //         # code...
        //     }
        //     # code...
        // }
        // // foreach ($tra as $val) {
        // // }

        // echo "<br>Nil text ASCII = $ascii";
        // echo "<br>Hasil Dekripsi = $h_dekrip";
        // echo "<br>Hasil Dekripsi = $hasil_ascii";
        // echo "<br>hash kata awal = $hash_text";
        // echo "<br>Hasil Dekripsi = $hh<br>";
        // // echo "<br>";
        // // var_dump($hash_text);
        // // echo "<br>";
        // // var_dump($hh);
        // // $hasil_akhir = "Data Surat Keterangan Sehat Valid atau Asli";

        // if ($hh == $hash_text) {
        //     $hasil_akhir = "Data Surat Keterangan Sehat Valid atau Asli";
        // } else {
        //     $hasil_akhir = "Data Surat Keterangan Sehat Tidak Valid";;
        // }
    }
}
