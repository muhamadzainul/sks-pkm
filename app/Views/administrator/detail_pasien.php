<?php $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Detail Pasien</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href="" target="_blank" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Buy Now</a>
            <ol class="breadcrumb">
                <li><a href="/">Puskesmas</a></li>
                <li><a href="/data_pasien">Data Pasien</a></li>
                <li class="active">Detail Pasien</li>
            </ol>
        </div>
    </div>
    <div class="pesan_flash" data-flashdata="<?= session()->getFlashdata('pesan');?>"></div>
    <!-- /.row -->
    <!-- .row -->
    <div class="row">
      </div>
      <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-3 col-xs-6 b-r">
                      <strong>Nama Pasien</strong>
                    </div>
                        <div class="col-md-9 col-xs-6">
                            <p class="text-muted"><?= $data_pasien['nama_pasien'];?></p>
                        </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3 col-xs-6 b-r">
                      <strong>Nik Pasien</strong>
                    </div>
                        <div class="col-md-9 col-xs-6">
                            <p class="text-muted"><?= $data_pasien['nik_pasien'];?></p>
                        </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3 col-xs-6 b-r">
                      <strong>Jenis Kelamin</strong>
                    </div>
                        <div class="col-md-9 col-xs-6">
                            <p class="text-muted"><?= $data_pasien['jenis_kelamin'];?></p>
                        </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3 col-xs-6 b-r">
                      <strong>Alamat</strong>
                    </div>
                        <div class="col-md-9 col-xs-6">
                            <p class="text-muted"><?= $data_pasien['alamat'];?></p>
                        </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 col-xs-6 b-r"><strong>No Handphone</strong>
                      <p><?= $data_pasien['no_hp'];?></p>
                    </div>
                    <div class="col-md-6 col-xs-6"><strong>Email</strong>
                        <p class="text-muted"><?= $data_pasien['email'];?></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                      <div class="col-md-6 col-xs-6 b-r">
                        <strong>Foto KTP</strong>
                        <br>
                        <img width="100%" alt="foto_ktp" src="/gambar/foto_ktp/<?=$data_pasien['foto_ktp'];?>">
                      </div>
                        <div class="col-md-6 col-xs-6">
                        <strong>Foto Kartu Keluarga</strong>
                        <br>
                        <img width="100%" alt="foto_kk" src="/gambar/foto_kk/<?=$data_pasien['foto_kk'];?>">
                        </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-2 col-xs-6 b-r">
                      <a href="/admin/data_pasien/edit_data/<?= $data_pasien['slug'];?>" class="btn btn-success btn-rounded">Edit</a>
                      <a href="/admin/data_pasien" class="btn btn-inverse btn-rounded">Kembali</a>
                    </div>
                </div>
                <div style="height: 28px;">
                    <div id="placeholder" class="demo-placeholder"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
</div>

<?= $this->endSection(); ?>
