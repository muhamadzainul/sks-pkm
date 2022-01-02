<html>

<head>

</head>

<body>
    <span>Mojokerto, <?= date('j F Y', (strtotime($data_cetak['tgl_dibuat']))) ?></span>
    <p></p>
    <table>
        <tr>
            <td>Hal</td>
            <td colspan="5">: Permohonan Izin Tidak Masuk Kerja</td>
        </tr>
        <tr>
            <td>Lampiran</td>
            <td colspan="5">: 1 Lembar</td>
        </tr>
    </table>
    <p></p>
    <p>
        Yang terhormat,<br>
        Kepala UPT Puskesmas Dawarblandong<br>
        di Tempat
    </p>
    <p></p>
    <!-- <p></p> -->
    <p>Saya yang bertanda tangan di bawah ini :</p>
    <p></p>
    <table>
        <tr>
            <td>Nama Pasien</td>
            <td colspan="3">: <?= $data_cetak['nama_pasien']; ?></td>
        </tr>
        <tr>
            <td>Nip</td>
            <td colspan="3">: <?= $data_cetak['nip_pasien']; ?></td>
        </tr>
        <tr>
            <td>Pangkat/Gol. Ruang</td>
            <td colspan="3">: <?= $data_cetak['pangkat']; ?></td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td colspan="3">: <?= $data_cetak['jabatan']; ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td colspan="3">: <?= $data_cetak['alamat']; ?></td>
        </tr>
    </table>
    <p></p>
    <p>Dengan ini saya memberitahukan bahwa Saya Tidak bisa masuk untuk bekerjaseperti biasanya, pada :</p>
    <br>
    <table>
        <tr>
            <td>Hari</td>
            <td colspan="4">: <?= $data_cetak['hari']; ?></td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td colspan="4">: <?= date('j F Y', (strtotime($data_cetak['tanggal']))); ?></td>
        </tr>
        <tr>
            <td>Kepentingan</td>
            <td colspan="4">: <?= $data_cetak['kepentingan']; ?></td>
        </tr>
    </table>
    <p style="text-indent: 30px; text-align: judtify;">Demikian surat izin ini saya buat dengan sebenar-benarnya atas perhatian serta kebijakannya saya ucapkan terimakasih.</p>
    <p></p>
    <table align="right">
        <tr>
            <td></td>
            <td style="text-align: center; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                <p style="font-size: 10;">
                    Mengetahui,<br>
                    <!-- <?php
                            $d = strtotime($data_cetak['tgl_dibuat']);
                            // dd($d);
                            echo date("j F Y", $d); ?><br> -->
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