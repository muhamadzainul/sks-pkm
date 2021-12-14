<?php

function checkPrime($num)
{
    if ($num == 1) {
        return 0;
    }
    for ($i = 2; $i <= $num/2; $i++) {
        if ($num % $i == 0) {
            return 0;
        }
    }
    return 1;
}

function gcd_cek($x, $y)
{
    if ($x > $y) {
        $temp = $x;
        $x = $y;
        $y = $temp;
    }

    for ($i = 1; $i < ($x+1); $i++) {
        if ($x%$i == 0 and $y%$i == 0) {
            $gcd = $i;
        }
    }
    return $gcd;
}

function get_key()
{
    // pencariaan nilai p dan q
    do {
        $p = rand(100, 400);
        $flag = checkPrime($p);

        if ($flag == 1) {
            echo "<br>";
            // echo "<br> nilai P = ".$p;
            break;
        }
    } while (true);

    do {
        $q = rand(100, 400);
        $flag = checkPrime($q);

        if ($flag == 1) {
            if ($q != $p && $q > $p) {
                // echo "<br> nilai Q = ".$q;
                break;
            }
        }
    } while (true);

    // perhitungan nilai n dan totien n
    $n = $p*$q;
    // echo "<br>nilai n = $n";
    $tn = ($p-1)*($q-1);
    // echo "<br>nilai tn = ".$tn;

    // pencarian nilai e
    do {
        $e = rand(100, 400);
        $flag = checkPrime($e);
        if ($flag == 1) {
            $gcd = gcd_cek($e, $tn);
            if ($gcd == 1) {
                // echo "<br> nilai e = $e";
                break;
            }
        }
    } while (true);


    $i=1;

    do {
        // $res = gmp_div_qr(gmp_add(gmp_mul($totient, $i), 1), $e);

        $res = $tn*$i+1;
        $res2 = $res%$e;
        if ($res2 == 0) {
            $d = $res/$e;
            // echo "<br> nilai d = $d";
            break;
        }

        $i++;

        if ($i==10000) { //maksimal percobaan 10000
            echo "hasil tidak di temukan dari 10000 percobaan";
            break;
        }
    } while (true);
    $public_key = $e."."."$n";
    $private_key = $d."."."$n";
    return [$public_key, $private_key];
}

// enkripsi
function enkripsi_text($hash_text, $text, $get_k, $get_k2)
{
    $public_key = explode(".", $get_k[0]);
    $e = $public_key[0];
    $n = $public_key[1];
    $private_key = explode(".", $get_k[1]);
    $d = $private_key[0];
    $n2 = $private_key[1];
    if ($n != $n2) {
        echo "Kunci Tidak Cocok";
    }
    $public_key2 = explode(".", $get_k2[0]);
    $e2 = $public_key2[0];
    $n3 = $public_key2[1];
    $private_key2 = explode(".", $get_k2[1]);
    $d2 = $private_key2[0];
    $n4 = $private_key2[1];
    if ($n3 != $n4) {
        echo "Kunci Tidak Cocok";
    }
    $hasil = "";
    $hasil_sem = "";
    $ascii = "";
    $angka_0 = "";

    for ($i=0; $i < strlen($hash_text) ; $i++) {
        $ascii .= ord($hash_text[$i]);
    }
    $rq = strlen($ascii)-4;
    $v_k = 0; // inisisalisasi angka 0 yang ada di depan pada nilai ascii yang telah dibagi menjadi blok-blok

    for ($j=0; $j < strlen($ascii) ; $j++) {
        if ((($j)%4)==0) {
            $pl = intval(substr($ascii, $j, 1)); // inisisalisasi nilai 1 pada tiap blok
            if ($pl==0) {
                for ($k=0; $k < 4 ; $k++) {
                    $rf = intval(substr($ascii, $j+$k, 1)); //inisisalisasi angka 0 yang berada di depan pada tiap blok
                    if ($rf == 0) {
                        $hasil .= "0";
                        $v_k = $v_k+1;
                    } else {
                        break;
                    }
                }
                $hasil .="_";
            }

            $ht = intval(substr($ascii, $j+$v_k, 4-$v_k));
            $hasil_sem .= gmp_mod(gmp_pow($ht, $d), $n);
            $dfd = explode(".", $hasil_sem);
            $fdf = $dfd[count($dfd)-1];
            $ex1 = explode("_", $fdf);
            if (!empty($ex1[1])) {
                $ks2 = explode(".", $hasil);
            } else {
                $rd = 0;
                $zr = intval(substr($ex1[0], 0, 4));
                $hasil .= gmp_mod(gmp_pow($zr, $e2), $n3);
                $zr2 = intval(substr($ex1[0], 4, strlen($ex1[0])-4));
                if (strlen($ex1[0]) > 4) {
                    if ($zr2 == 0) {
                        $hasil .= "*";
                        for ($k=0; $k < (strlen($ex1[0])-4) ; $k++) {
                            $rj = intval(substr($ex1[0], 4+$k, 1)); //inisisalisasi angka 0 yang berada di depan pada tiap blok
                            if ($rj == 0) {
                                $hasil .= "0";
                                $rd = $rd+1;
                            } else {
                                $zr3 = intval(substr($ex1[0], $k, (strlen($ex1[0])-4)));
                                if (((strlen($ex1[0])-4)-$rd) != 0) {
                                    $hasil .= "*";
                                    $hasil .= gmp_mod(gmp_pow($zr2, $e2), $n3);
                                }
                                break;
                            }
                        }
                    } else {
                        $zr3 = intval(substr($ex1[0], 4, ($ex1[0]-4)));
                        $hasil .= "*";
                        $hasil .= gmp_mod(gmp_pow($zr2, $e2), $n3);
                    }
                }
                $rd = $rd*0;


                $ks2 = explode(".", $hasil);
                $ks4 = $ks2[(count($ks2)-1)];
            }

            if (($j+5) <= strlen($ascii)) {
                $hasil .=".";
            }
        }
        $hasil_sem = "";
        $v_k = $v_k*0;
    }
    echo "<br>Nilai text ASCII = $ascii";
    $hs = "";
    $pecah_enkrip = explode(".", $hasil);
    // echo "<br>". (count($pecah_enkrip));
    for ($ol=0; $ol < count($pecah_enkrip) ; $ol++) {
        $pecah_enkrip2 = explode("*", $pecah_enkrip[$ol]);
        $pecah_0 = explode("_", $pecah_enkrip2[0]);
        // echo "<br>".(count($pecah_0));
        for ($io=0; $io < count($pecah_enkrip2) ; $io++) {
            if (count($pecah_0) == 2) {
                $hs .= $pecah_0[0];
                $hs .= $pecah_0[1];
            } else {
                $hs .= $pecah_enkrip2[$io];
                // code...
            }
        }
    }
    // echo "<br>Nilai Hasil Enkripsi asli = ".$hs;
    // echo "<br>Nilai hasil Enkripsi = $hasil";
    return [$hs, $hasil];
}

// dekripsi
function dekrip_text($hash_text, $enkripsi_t, $get_k, $get_k2)
{
    $public_key = explode(".", $get_k[0]);
    $e = $public_key[0];
    $n = $public_key[1];
    $private_key = explode(".", $get_k[1]);
    $d = $private_key[0];
    $n2 = $private_key[1];
    if ($n != $n2) {
        echo "Kunci Tidak Cocok";
    }
    $public_key2 = explode(".", $get_k2[0]);
    $e2 = $public_key2[0];
    $n3 = $public_key2[1];
    $private_key2 = explode(".", $get_k2[1]);
    $d2 = $private_key2[0];
    $n4 = $private_key2[1];
    if ($n3 != $n4) {
        echo "Kunci Tidak Cocok";
    }

    $hasil = $enkripsi_t[1];

    echo "<br>";
    $h_dekrip = "";
    $dekrip_sem = "";

    $text_d = explode(".", $hasil);

    for ($i=0; $i < count($text_d) ; $i++) {
        $tf = intval(substr($text_d[$i], 0, 1));
        if ($tf == 0) {
            $jk = explode("*", $text_d[$i]);
            for ($k=0; $k < count($jk); $k++) {
                $fr = intval(substr($jk[$k], 0, 1));
                $tq = explode("_", $jk[$k]);
                if (count($tq) > 1) {
                    $dekrip_sem .= gmp_mod(gmp_pow(intval($tq[1]), $d2), $n4);
                } else {
                    $dekrip_sem .= gmp_mod(gmp_pow(intval($jk[$k]), $d2), $n4);
                }
            }
            $h_dekrip .= gmp_strval(gmp_mod(gmp_pow(intval($dekrip_sem), $e), $n));
            $dekrip_sem = "";
        } else {
            $ik = explode("*", $text_d[$i]);
            for ($j=0; $j < count($ik); $j++) {
                $dekrip_sem .= gmp_mod(gmp_pow(intval($ik[$j]), $d2), $n4);
            }
            $h_dekrip .= gmp_strval(gmp_mod(gmp_pow(intval($dekrip_sem), $e), $n));
            $dekrip_sem = "";
        }
    }

    $hasil_ascii = "";
    $var = 0;
    $kap = strlen($h_dekrip)-2;
    for ($i=0; $i < strlen($h_dekrip); $i++) {
        if (($i%2 == $var)) {
            $re = substr($h_dekrip, $i, 1);
            if ($re == 1) {
                $hasil_ascii .= substr($h_dekrip, $i, 3);
                if ($i != $kap) {
                    $hasil_ascii .= ".";
                    // code...
                }
                if ($var == 0) {
                    $i = $i+1;
                    $var = $var+1;
                } else {
                    $i = $i+1;
                    $var = $var-1;
                }
            } else {
                $hasil_ascii .= substr($h_dekrip, $i, 2);
                if ($i != $kap) {
                    $hasil_ascii .= ".";
                    // code...
                }
                // code...
            }
        }
    }

    $hh = "";
    $tra = explode(".", $hasil_ascii);
    foreach ($tra as $val) {
        $hh .= chr($val);
    }

    if ($hh == $hash_text) {
        $hasil_akhir = "Valid";
    } else {
        $hasil_akhir = "Not Valid";
        ;
    }
    return $hasil_akhir;
}

  // function generate_key()
  // {
  //     // pencarian angka random dari 100-200
  //
  //     $rand1=rand(100, 200);
  //     $rand2=rand(100, 200);
  //
  //     //pemilihan angka prima p,q
  //     $p = gmp_nextprime($rand1);
  //     $q = gmp_nextprime($rand2);
  //
  //     // perhitungan nilai n dan totien(n)
  //     $n = gmp_mul($p, $q);
  //
  //     $tn  = ($p-1)*($q-1);
  // }

  // function coba_hel()
  // {
  //     $cb = intval(gmp_mod(gmp_pow(4851, 44249), 49403));
  //     return $cb;
  // }
