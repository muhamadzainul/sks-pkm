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
      <br>
      </hr>
      <a href="" data-toggle="modal" data-target="#Edit_petugas<?= $data_petugas['id_satgas']; ?>" class="btn btn-success btn-sm"><i class="fa fa-fw fa-edit"></i>Edit</a>
      <a href="" data-toggle="modal" data-target="#reset_password<?= $data_petugas['id_satgas']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-fw fa-key"></i>Reset Password</a>
      <a href="<?php base_url(); ?>/admin/data_petugas" class="btn btn-inverse btn-sm"><i class="fa fa-fw fa-arrow-left"></i>Kembali</a>
    </div>
    <!-- row -->
  </div>
  <!-- Modal Edit -->
  <div class="modal fade" id="Edit_petugas<?= $data_petugas['id_satgas']; ?>" tabindex="-1" role="dialog" aria-labelledby="pelamarEditLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="pelamarEditLabel">Edit Data Petugas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?php base_url(); ?>/admin/data_petugas/update_data/<?= $data_petugas['id_satgas']; ?>" method="POST">
          <div class="modal-body">
            <div class="form-group">
              <label for="nama_kapus">Username</label>
              <input type="hidden" name="pesan" value="Edit">
              <input type="text" class="form-control" id="username" name="username" value="<?= $data_petugas['username']; ?>" placeholder="Username">
            </div>
            <div class="form-group">
              <label for="nama_kapus">Full Name</label>
              <input type="text" class="form-control" id="fullname" name="fullname" value="<?= $data_petugas['fullname']; ?>" placeholder="Nama Lengkap">
            </div>
            <div class="form-group">
              <label for="nama_kapus">Email</label>
              <input type="text" class="form-control" id="email" name="email" value="<?= $data_petugas['email']; ?>" placeholder="Email">
            </div>
            <!-- <div class="form-group">
              <label for="nama_kapus">Foto Profil</label>
              <div class="<?= ($validation->hasError('user_profile')) ? 'has-error has-danger' : ''; ?>">
                <label for="foto_profil">Masukkan Foto Profil - klik atau drag foto</label>
                <input type="file" id="foto_profil" class="dropify" data-default-file="<?= ($data_petugas['user_profile']) ? '/gambar/profil_petugas/' . $data_petugas['user_profile'] : ''; ?>" name="foto_profil">
                <div class="help-block with-errors ml-3">
                  <ul class="list-unstyled">
                    <li><?= $validation->getError('foto_profil'); ?></li>
                  </ul>
                </div>
              </div>
            </div> -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Edit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Modal reset password -->
  <div class="modal fade" id="Edit_petugas<?= $data_petugas['id_satgas']; ?>" tabindex="-1" role="dialog" aria-labelledby="pelamarEditLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="pelamarEditLabel">Edit Data Petugas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?php base_url(); ?>/admin/data_petugas/update_data/<?= $data_petugas['id_satgas']; ?>" method="POST">
          <div class="modal-body">
            <?php if (empty($data_petugas['username'])) : ?>
              <div class="form-group">
                <label for="nama_kapus">Username</label>
                <input type="hidden" name="pesan" value="Edit">
                <input type="text" class="form-control" id="username" name="username" value="" placeholder="Username">
              </div>
            <?php endif; ?>
            <div class="form-group">
              <label for="nama_kapus">Full Name</label>
              <input type="text" class="form-control" id="fullname" name="fullname" value="<?= $data_petugas['fullname']; ?>" placeholder="Nama Lengkap">
            </div>
            <div class="form-group">
              <label for="nama_kapus">Email</label>
              <input type="text" class="form-control" id="email" name="email" value="<?= $data_petugas['email']; ?>" placeholder="Email">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Edit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>



  <?= $this->endSection(); ?>