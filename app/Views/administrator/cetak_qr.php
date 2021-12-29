<html>

<head>

</head>

<body>
    <p></p>
    <p style="font-size: 14; text-align: center;">Kunci Validasi</p>
    <p></p>
    <table>
        <tr>
            <td>Nama Pasien</td>
            <td colspan="5">: <?= $data_cetak['nama_pasien']; ?></td>
        </tr>
        <tr>
            <td>Nik Pasien</td>
            <td colspan="5">: <?= $data_cetak['nik_p']; ?></td>
        </tr>
        <tr>
            <td>Umur</td>
            <td colspan="5">: <?= intval($data_cetak['umur'] / 12); ?></td>
        </tr>
    </table>
    <img width="150" alt="qr_code" src="<?php base_url(); ?>/gambar/qr_code/pasien/<?= $data_cetak['pas_qr']; ?>" class="m-t-10">
    <p style="text-align: center;">DI mohon untuk menyimpan kunci validasi ini dengan baik</p>
</body>

</html>