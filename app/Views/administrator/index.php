<?php $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Page Content -->
<div id="page-wrapper">
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">SKS Puskesmas Dashboard</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li class="active">Dashboard</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!--row -->
    <div class="row">
        <div class="col-md-4 col-sm-6">
            <div class="white-box">
                <div class="r-icon-stats"> <i class="ti-user bg-megna"></i>
                    <div class="bodystate">
                        <h4><?= $total_user;?></h4> <span class="text-muted">Data Petugas</span> </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="white-box">
                <div class="r-icon-stats"> <i class="ti-user bg-info"></i>
                    <div class="bodystate">
                        <h4><?= $total_pasien;?></h4> <span class="text-muted">Data Pasien</span> </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="white-box">
                <div class="r-icon-stats"> <i class="ti-files bg-success"></i>
                    <div class="bodystate">
                        <h4><?= $total_surat;?></h4> <span class="text-muted">Data Surat Sehat</span> </div>
                </div>
            </div>
        </div>
    </div>
    <!--/row -->
    <!-- row -->
    <div class="row">
        <div class="col-sm-6">
            <div class="white-box">
                <h3 class="box-title m-b-0">Daftar Pasien</h3>
                <p class="text-muted">Daftar data pasien terbaru</p>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>NIK Pasien</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                            $n = 1;
                            foreach ($data_pasien as $dp):
                          ?>
                            <tr>
                                <td><?= $n++;?></td>
                                <td><?= $dp['nama_pasien'];?></td>
                                <td><?= $dp['nik_pasien'];?></td>
                                <?php if (empty($dp['email']) or empty($dp['no_hp']) or empty($dp['foto_kk']) or empty($dp['foto_ktp']) or empty($dp['alamat']) or $dp['foto_ktp'] == 'default-ktp.png' or $dp['foto_kk'] == 'default-kk.png') : ?>
                                  <td><span class="label label-danger">Belum</span> </td>
                                <?php else : ?>
                                  <td><span class="label label-success">Lengkap</span> </td>
                                <?php endif;?>
                            </tr>
                          <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="white-box">
                <h3 class="box-title m-b-0">Data Pembuat</h3>
                <p class="text-muted">Daftar pembuat surat keterangan sehat terbaru</p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nomor surat</th>
                                <th>Nama Pasien</th>
                                <th>Umur</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                          $n=1;
                          foreach ($data_surat as $ds): ?>
                            <tr>
                              <td><?= $n++;?></td>
                              <td><?= $ds['nomor_surat'];?></td>
                              <td><?= $ds['tinggi_badan'];?></td>
                              <td><?= $ds['berat_badan'];?></td>
                            </tr>
                          <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
<?= $this->endSection(); ?>
