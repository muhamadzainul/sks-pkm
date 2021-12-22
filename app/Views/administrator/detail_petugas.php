<?php $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row bg-title">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Detail petugas</h4>
      </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
          <li><a href="<?php base_url(); ?>/">Puskesmas</a></li>
          <li class="active">profil saya</li>
        </ol>
      </div>
    </div>
    <!-- /.row -->
    <!-- .row -->
    <div class="white-box">
      <div class="row">
        <div class="col-md-4 col-xs-12">
          <div class="row">
            <div class="col-md-12 col-xs-6">
              <strong>Foto Profil</strong>
              <br>
              <img src="<?= base_url(); ?>/gambar/profil_petugas/<?= $data_petugas['user_profile']; ?>" width="100%" alt="Foto Profil">
            </div>
          </div>
        </div>
        <div class="col-md-8 col-xs-12">
          <div class="white-box">
            <div class="row">
              <div class="col-md-3 col-xs-6 b-r">
                <strong>Nama Petugas</strong>
              </div>
              <div class="col-md-9 col-xs-6">
                <p class="text-muted"><?= $data_petugas['fullname']; ?></p>
              </div>
            </div>
            <hr>

            <div class="row">
              <div class="col-md-12 col-xs-12"><strong>Email</strong>
                <p class="text-muted"><?= $data_petugas['email']; ?></p>
              </div>
            </div>
            <div style="height: 28px;">
              <div id="placeholder" class="demo-placeholder"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- row -->
  </div>

  <?= $this->endSection(); ?>