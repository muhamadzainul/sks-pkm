<html>

<head>

</head>

<body>
    <p></p>
    <div style="font-size: 14; text-align: center;"><strong><u>SURAT KETERANGAN SEHAT</u></strong></div>
    <!-- <span style="font-size: 12; text-align: center;">Nomor : 445/<?= $data_cetak['nomor_surat']; ?>/416-102.11/<?= date("Y", time()); ?></span> -->
    <!-- <p></p> -->
    <p style="text-indent: 30px;">Yang bertanda tangan dibawah ini Dokter UPT Puskesmas Dawarblandong, yang bertugas pada Dinas Kabupaten Mojokerto dengan mengingat sumpah jabatan menerangkan bahwa :</p>
    <table>
        <tr>
            <td>Nama Pasien</td>
            <td colspan="5">: <?= $data_cetak['nama_pasien']; ?></td>
        </tr>
        <tr>
            <td>Umur</td>
            <td colspan="5">: <?= intval($data_cetak['umur'] / 12); ?></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td colspan="5">: <?= $data_cetak['jenis_kelamin']; ?></td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td colspan="5">: <?= $data_cetak['pekerjaan']; ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td colspan="5">: <?= $data_cetak['alamat']; ?></td>
        </tr>
        <tr>
            <td>Kepentingan</td>
            <td colspan="5">: <?= $data_cetak['kepentingan']; ?></td>
        </tr>
    </table>
    <p><u><b>Keterangan Fisik</b></u></p>
    <br>
    <table>
        <tr>
            <td>Tinggi Badan</td>
            <td>: <?= $data_cetak['tinggi_badan']; ?> cm</td>
            <td colspan="2"><u><b>Mata</b></u></td>
        </tr>
        <tr>
            <td>Berat Badan</td>
            <td>: <?= $data_cetak['berat_badan']; ?> kg</td>
            <td>Buta Warna</td>
            <td>: <?= $data_cetak['mata_buta']; ?></td>
        </tr>
        <tr>
            <td>Suhu</td>
            <td>: <?= $data_cetak['suhu_tubuh']; ?>&deg;C</td>
        </tr>
        <tr>
            <td>Tensi Darah</td>
            <td>: <?= $data_cetak['tensi_darah']; ?> mm/Hg</td>
            <td colspan="2"><u><b>Tubuh</b></u></td>
        </tr>
        <tr>
            <td>Nadi</td>
            <td>: <?= $data_cetak['nadi']; ?> / Menit</td>
            <td>Tato</td>
            <td>: <?= $data_cetak['tubuh_tato']; ?></td>
        </tr>
        <tr>
            <td>Respirasi</td>
            <td>: <?= $data_cetak['respirasi']; ?> / Menit</td>
            <td>Tindik</td>
            <td>: <?= $data_cetak['tubuh_tindik']; ?></td>
        </tr>
        <tr>
            <td>Hasil Pemerisa Pasien</td>
            <td>: <strong><?= $data_cetak['hasil_periksa']; ?></strong></td>
        </tr>
    </table>
    <p style="text-indent: 30px;">Demikian surat keterangan sehat ini dibuat dengan sebenar-benarnya dan dapat digunakan sebagaimana perlunya.</p>
    <p></p>
    <table align="right">
        <tr>
            <td></td>
            <td style="text-align: center; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                <p style="font-size: 10;">
                    KABUPATEN MOJOKERTO,<br>
                    <?php
                    $d = strtotime($data_cetak['tgl_dibuat']);
                    // dd($d);
                    echo date("j F Y", $d); ?><br>
                    Kepala UPT Puskesmas Dawarblandong
                    <br>
                    <img width="100px" alt="qr_code" src="<?php base_url(); ?>/gambar/qr_code/<?= $data_cetak['qr_code']; ?>" class="m-t-10">
                    <br>
                    <?= $data_cetak['nama_kapus']; ?><br>
                    Nip. <?= $data_cetak['nip_kp']; ?>
                </p>
            </td>
        </tr>
    </table>
</body>

</html>