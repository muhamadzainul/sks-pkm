<?php $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Detail petugas</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href="" target="_blank" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Buy Now</a>
            <ol class="breadcrumb">
                <li><a href="/">Puskesmas</a></li>
                <li><a href="/data_petugas">Data petugas</a></li>
                <li class="active">Detail petugas</li>
            </ol>
        </div>
    </div>
    <div class="pesan_flash" data-flashdata="<?= session()->getFlashdata('pesan');?>"></div>
    <!-- /.row -->
    <!-- .row -->
      <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="white-box">
              <div class="row">
                  <div class="col-md-12 col-xs-6">
                    <strong>Foto Profil</strong>
                    <br>
                    <img width="100%" alt="Foto Profil" src="/gambar/profil_petugas/<?= $data_petugas['foto_profil'];?>">
                  </div>
                </div>
              </div>
            </dif>
          </div>
            <div class="col-md-8 col-xs-12">
                <div class="white-box">
                <div class="row">
                    <div class="col-md-3 col-xs-6 b-r">
                      <strong>Nama Petugas</strong>
                    </div>
                        <div class="col-md-9 col-xs-6">
                            <p class="text-muted"><?= $data_petugas['nama_petugas'];?></p>
                        </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3 col-xs-6 b-r">
                      <strong>Nip Petugas</strong>
                    </div>
                        <div class="col-md-9 col-xs-6">
                            <p class="text-muted"><?= $data_petugas['nip_petugas'];?></p>
                        </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3 col-xs-6 b-r">
                      <strong>Nik Petugas</strong>
                    </div>
                        <div class="col-md-9 col-xs-6">
                            <p class="text-muted"><?= $data_petugas['nik_petugas'];?></p>
                        </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3 col-xs-6 b-r">
                      <strong>Jenis Kelamin</strong>
                    </div>
                        <div class="col-md-9 col-xs-6">
                            <p class="text-muted"><?= $data_petugas['jenis_kelamin'];?></p>
                        </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3 col-xs-6 b-r">
                      <strong>Alamat</strong>
                    </div>
                        <div class="col-md-9 col-xs-6">
                            <p class="text-muted"><?= $data_petugas['alamat'];?></p>
                        </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 col-xs-6 b-r"><strong>No Handphone</strong>
                      <p><?= $data_petugas['no_hp'];?></p>
                    </div>
                    <div class="col-md-6 col-xs-6"><strong>Email</strong>
                        <p class="text-muted"><?= $data_petugas['email'];?></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 col-xs-6 b-r">
                      <a href="/admin/data_petugas/edit_data/<?= $data_petugas['slug'];?>" class="btn btn-success btn-rounded">Edit</a>
                      <a href="/admin/data_petugas" class="btn btn-inverse btn-rounded">Kembali</a>
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
