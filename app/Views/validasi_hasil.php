<?php $this->extend('layout/template_login'); ?>
<?= $this->section('content'); ?>

<!-- Page Content -->
<div style="background-color: #bbbbbb;" class="wrapper">
    <div class="row bg-title">
        <div class="col-lg-12">
            <a href=""><img src="<?= base_url(); ?>/gambar/Logo-pkm.png" alt="logo" style="width: 30%;"></a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="white-box w-100">
        <div class="row">
            <div class="col-lg">
                <h1 class="box-title"><strong> Hasil Valdasi</strong></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h4>Data hasil scaning</h4><br>
                <strong> <?= $hasil_validasi; ?></strong>
            </div>
            <div class="col-lg-6">
                <h4>Data Surat Pasien : <?= $data_surat["nama_pasien"]; ?></h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-5 b-r">
                                <strong>Nama Pasien</strong>
                            </div>
                            <div class="col-md-7">
                                <p class="text-muted"><?= $data_surat['nama_pasien']; ?></p>
                            </div>

                            <div class="col-md-5 b-r">
                                <strong>Umur</strong>
                            </div>
                            <div class="col-md-7">
                                <p class="text-muted"><?= floor($data_surat['umur'] / 12); ?></p>
                            </div>

                            <div class="col-md-5 b-r">
                                <strong>Jenis Kelamin</strong>
                            </div>
                            <div class="col-md-7">
                                <p class="text-muted"><?= $data_surat['jenis_kelamin']; ?></p>
                            </div>

                            <div class="col-md-5 b-r">
                                <strong>Pekerjaan</strong>
                            </div>
                            <div class="col-md-7">
                                <p class="text-muted"><?= $data_surat['pekerjaan']; ?></p>
                            </div>

                            <div class="col-md-5 b-r">
                                <strong>Alamat</strong>
                            </div>
                            <div class="col-md-7">
                                <p class="text-muted"><?= $data_surat['alamat']; ?></p>
                            </div>

                            <div class="col-md-5 b-r">
                                <strong>Kepentingan</strong>
                            </div>
                            <div class="col-md-7">
                                <p class="text-muted"><?= $data_surat['kepentingan']; ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <strong>Keterangan Fisik</strong>
                            </div>
                            <hr>

                            <div class="col-md-4">
                                <strong>Tinggi Badan</strong>
                            </div>

                            <div class="col-md-4">
                                <strong>Berat Badan</strong>
                            </div>

                            <div class="col-md-4">
                                <strong>Tekanan Darah</strong>
                            </div>

                            <div class="col-md-4">
                                <p class="text-muted"><?= $data_surat['tinggi_badan']; ?></p>
                            </div>

                            <div class="col-md-4">
                                <p class="text-muted"><?= $data_surat['berat_badan']; ?></p>
                            </div>

                            <div class="col-md-4">
                                <p class="text-muted"><?= $data_surat['tensi_darah']; ?></p>
                            </div>

                            <div class="col-md-4">
                                <strong>Suhu Tubuh</strong>
                            </div>

                            <div class="col-md-4">
                                <strong>Nadi</strong>
                            </div>

                            <div class="col-md-4">
                                <strong>Respirasi</strong>
                            </div>

                            <div class="col-md-4">
                                <p class="text-muted"><?= $data_surat['suhu_tubuh']; ?></p>
                            </div>

                            <div class="col-md-4">
                                <p class="text-muted"><?= $data_surat['nadi']; ?></p>
                            </div>

                            <div class="col-md-4">
                                <p class="text-muted"><?= $data_surat['respirasi']; ?></p>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <strong>Keterangan Mata</strong>
                            </div>
                            <hr>

                            <div class="col-md-6 b-r">
                                <strong>Buta Warna</strong>
                            </div>

                            <div class="col-md-6">
                                <p class="text-muted"><?= $data_surat['mata_buta']; ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <strong>Keterangan Kulit</strong>
                            </div>
                            <hr>
                            <div class="col-md-6">
                                <strong>Tatto</strong>
                            </div>

                            <div class="col-md-6">
                                <strong>Tindik</strong>
                            </div>

                            <div class="col-md-6">
                                <p class="text-muted"><?= $data_surat['tubuh_tato']; ?></p>
                            </div>

                            <div class="col-md-6">
                                <p class="text-muted"><?= $data_surat['tubuh_tindik']; ?></p>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <strong>Hasil Pemeriksaan</strong>
                            </div>
                            <hr>

                            <div class="col-md-3 b-r">
                                <strong>Hasil Periksa</strong>
                            </div>

                            <div class="col-md-9">
                                <p class="text-muted"><?= $data_surat['hasil_periksa']; ?></p>
                            </div>
                        </div>
                        <hr>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Tanggal Dibuat</strong>
                            </div>

                            <div class="col-md-6">
                                <strong>Nama Kepala Puskesmas</strong>
                            </div>

                            <div class="col-md-6">
                                <p class="text-muted"><?= $data_surat['tgl_dibuat']; ?></p>
                            </div>

                            <div class="col-md-6">
                                <p class="text-muted"><?= $data_surat['nama_kapus']; ?></p>
                            </div>

                        </div>
                        </hr>
                        <div class="row">
                            <div class="col-md-12">
                                <img width="40%" alt="qr_code" src="<?php base_url(); ?>/gambar/qr_code/<?= $data_surat['qr_code']; ?>" class="m-t-10">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- /#page-wrapper -->
    </div>
</div>

<footer class="w-100 py-4 flex-shrink-0" style=" background-color:#212529;">
    <div class="container py-4">
        <div class="row gy-4 gx-5">
            <div class="col-lg-4 col-md-6">
                <h5 class="h1 text-white">UPT Puskesmas Dawarblandong</h5>
                <p class="small text-muted">Merupakan Organisasi Perangkat Daerah (OPD) di bawah Dinas Kesehatan Kabupaten Mojokerto</p>
            </div>
            <div class="col-lg-4 col-md-6">
                <h4 class="text-white">SKS Puskesmas Dawarblandong</h4>
                <p class="small text-muted">SKS Puskesmas Dawarblandong merupakan web-site UPT Puskesmas Dawarblandong untuk pembuatan Surat Keterangan Sehat dan Surat Izin</p>
            </div>
            <div class="col-lg-4 col-md-6 right">
                <h5 class="text-white mb-3">Hubungi Kami</h5>
                <ul class="list-unstyled text-muted">
                    <li><i class="fa fa-globe"></i> Web : UPT Puskesmas Dawarblandong</li>
                    <li><i class="fa fa-envelope-o"></i> Email : pkmdawar@gmail.com</li>
                    <li><i class="fa fa-mobile-phone"></i> Telp.(031) 7924035, 0856 0441 3296</li>
                    <li><i class="fa fa-map-marker"></i>Jl. Mayjend. Sungkono No. 17 Dawarblandong, Kabupaten Mojokerto</li>
                </ul>
            </div>
            <!-- <div class="col-lg-4 col-md-6">
                <h5 class="text-white mb-3">Newsletter</h5>
                <p class="small text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                <form action="#">
                    <div class="input-group mb-3">
                        <input class="form-control" type="text" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-primary" id="button-addon2" type="button"><i class="fas fa-paper-plane"></i></button>
                    </div>
                </form>
            </div> -->
        </div>
        <div class="row">
            <div class="col-lg m-t-10">
                <p class="small text-muted mb-0 text-center">&copy; Copyrights. Surat Keterangan Sehat Online. skspuskesmas.com</p>
            </div>
        </div>
    </div>
</footer>
<!-- /#wrapper -->

<?= $this->endSection(); ?>