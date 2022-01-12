<?php $this->extend('layout/template_login'); ?>
<?= $this->section('content'); ?>
<a id="qr_scan"></a>
<!-- Page Content -->
<div style="background-color: #ffffff;" class="wrapper">
    <div class="row">
        <div class="col-lg-12 pl-5">
            <a href=""><img src="<?= base_url(); ?>/gambar/Logo-pkm.png" alt="logo" width="30%" class="m-t-10"></a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="white-box w-100">
        <div class="row">
            <div class="col-lg">
                <h3>Cek Validasi Surat</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h4>Data hasil scaning</h4><br>
                <?php if ($data_scan) {
                    echo $data_scan;
                }; ?>
            </div>
            <div class="col-lg-6">
                <h4>Masukkan Data</h4>
                <form action="<?= base_url(); ?>/validasi/hasil_validasi/<?= $data_scan; ?>" method="post">
                    <table class="table-borderless table">
                        <tr>
                            <td>No. NIK KTP anda</td>
                            <td><input type="text" name="nik_pasien" id="nik_pasien" class="form-control" placeholder="NIK KTP"></td>
                            <td><input type="hidden" name="nip_kapus" id="nip_kapus" class="form-control" value="<?= $data_surat['nip_kp']; ?>"></td>
                        </tr>
                        <tr>
                            <td>Tanggal Pembuatan Surat</td>
                            <td><input type="date" name="tgl_dibuatsurat" id="tgl_dibuatsurat" class="form-control" placeholder="Tanggal Dibuat"></td>
                        </tr>
                        <!-- <tr>
                            <td colspan="2"><a href="" class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#scane_qr" onclick="tscan()">Scan Kunci</a></td>
                        </tr> -->
                        <tr>
                            <td>
                                <!-- Masukkan Password Untuk Validasi-->Token
                            </td>
                            <td><input type="text" name="password_pas" class="form-control" placeholder="Password Validasi" value="<?= $token; ?>" readonly></td>
                            <!-- <td colspan="2"><input type="text" name="privete_key" id="qrcode" class="form-control" readonly></td> -->
                        </tr>
                        <tr>
                            <td colspan="2"><button type="submit" class="btn btn-sm btn-success">Cek Data</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    <!-- Modal Tambah Kapus -->
    <!-- <div class="modal fade" id="scane_qr" tabindex="-1" role="dialog" aria-labelledby="userBaruLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userBaruLabel">Scane Qr Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="tscan()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <video id="preview" width="400" height="300"></video>
                </div>

            </div>
        </div>

    </div> -->
    <!-- /#page-wrapper -->
    <footer class="w-100 py-4 flex-shrink-0" style="position: fixed; background-color:#212529;">
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