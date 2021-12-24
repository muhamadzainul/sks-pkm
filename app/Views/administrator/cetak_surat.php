<html>

<head>

</head>

<body>
    <p></p>
    <div style="font-size: 14; text-align: center;">Nomor Surat</div>
    <table>
        <tr>
            <td>Nama Pasien</td>
            <td colspan="5">: <?= $data_cetak['nama_pasien']; ?></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td colspan="5">: <?= $data_cetak['jenis_kelamin']; ?></td>
        </tr>
        <tr>
            <td>Umur</td>
            <td colspan="5">: <?= intval($data_cetak['umur'] / 12); ?></td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td colspan="5">: <?= $data_cetak['pekerjaan']; ?></td>
        </tr>
        <tr>
            <td>Kepentingan</td>
            <td colspan="5">: <?= $data_cetak['kepentingan']; ?></td>
        </tr>
    </table>
    <p></p>
    <table>
        <tr>
            <td colspan="2"><b>Keterangan Fisik</b></td>
            <td colspan="2"><b>Mata</b></td>
        </tr>
        <tr>
            <td>Tinggi Badan</td>
            <td>: <?= $data_cetak['tinggi_badan']; ?>cm</td>
            <td>Buta Warna</td>
            <td>: <?= $data_cetak['mata_buta']; ?></td>
        </tr>
        <tr>
            <td>Berat Badan</td>
            <td>: <?= $data_cetak['berat_badan']; ?>kg</td>
            <td colspan="2"><b>Tubuh</b></td>
        </tr>
        <tr>
            <td>Suhu</td>
            <td>: <?= $data_cetak['suhu_tubuh']; ?>&deg;</td>
            <td>Tato</td>
            <td>: <?= $data_cetak['tubuh_tato']; ?></td>
        </tr>
        <tr>
            <td>Tensi Darah</td>
            <td>: <?= $data_cetak['tensi_darah']; ?></td>
            <td>Tindik</td>
            <td>: <?= $data_cetak['tubuh_tindik']; ?></td>
        </tr>
        <tr>
            <td>Nadi</td>
            <td>: <?= $data_cetak['nadi']; ?></td>
        </tr>
        <tr>
            <td>Respirasi</td>
            <td>: <?= $data_cetak['respirasi']; ?></td>
        </tr>
    </table>
    <p></p>
    <table align="right">
        <tr>
            <td></td>
            <td style="text-align: center; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                <p style="font-size: 10;">
                    KABUPATEN MOJOKERTO,<br>
                    <?= date("j F Y") ?><br>
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