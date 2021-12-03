<?php $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<!-- Page Content -->
<div id="page-wrapper">
<div class="container-fluid">
  <div class="row bg-title">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h4 class="page-title">Tambah Data Petugas</h4> </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
          <ol class="breadcrumb">
              <li><a href="<?php base_url();?>/">Puskesmas</a></li>
              <li class="active">Tambah Data Petugas</li>
          </ol>
      </div>
      <!-- /.col-lg-12 -->
  </div>

  <!-- row -->
  <div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <!-- <h3 class="box-title">Basic Information</h3> -->
            <form class="form-material form-horizontal" action="<?php base_url();?>/Admin/data_petugas/simpan" method="post" enctype="multipart/form-data">
              <?= csrf_field();?>
                <div class="form-group">
                    <label class="col-md-12" for="nama_petugas">Nama</span>
                    </label>
                    <div class="col-md-12">
                        <input type="text" id="nama_petugas" name="nama_petugas" class="form-control" placeholder="Masukkan Nama" value="<?= old('nama_petugas');?>"> </div>
                </div>
                <div class="form-group <?= ($validation->hasError('nik_petugas')) ? 'has-error has-danger' : '';?>">
                    <label class="col-md-12" for="nik_petugas">NIK</span>
                    </label>
                    <div class="col-md-12">
                        <input type="number" id="nik_petugas" name="nik_petugas" class="form-control" placeholder="Masukkan nomor NIK" value="<?= old('nik_petugas');?>">
                    </div>
                    <div class="help-block with-errors ml-3">
                      <ul class="list-unstyled">
                        <li><?= $validation->getError('nik_petugas');?></li>
                      </ul>
                    </div>

                </div>
                <div class="form-group">
                    <label class="col-md-12" for="nik_petugas">NIP</span>
                    </label>
                    <div class="col-md-12">
                        <input type="number" id="nip_petugas" name="nip_petugas" class="form-control" placeholder="Masukkan Nomor NIP" value="<?= old('nip_petugas');?>">
                    </div>
                    <div class="help-block with-errors ml-3">
                      <ul class="list-unstyled">
                        <li><?= $validation->getError('nik_petugas');?></li>
                      </ul>
                    </div>

                </div>
                <div class="form-group">
                    <label class="col-sm-12">Jenis Kelamin</label>
                    <div class="col-sm-12">
                        <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                            <option>-- Pilih Jenis Kelamin --</option>
                            <option>Laki-laki</option>
                            <option>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="alamat">Alamat</span>
                    </label>
                    <div class="col-md-12">
                        <input type="text" id="alamat" name="alamat" class="form-control mydatepicker" placeholder="Masukkan Alamat" value="<?= old('alamat');?>"> </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="email">Email</span>
                    </label>
                    <div class="col-md-12">
                        <input type="text" id="email" name="email" class="form-control mydatepicker" placeholder="Masukkan Email" value="<?= old('email');?>"> </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="no_hp">No. Hp</span>
                    </label>
                    <div class="col-md-12">
                        <input type="number" id="no_hp" name="no_hp" class="form-control mydatepicker" placeholder="Masukkan No. Hp" value="<?= old('no_hp');?>"> </div>
                </div>
                <div class="form-group ">
                  <div class="col-md-12 <?= ($validation->hasError('foto_profil')) ? 'has-error has-danger' : '';?>">
                    <h3 class="box-title">Foto Profil</h3>
                    <label for="foto_profil">Masukkan Foto Profil - klik atau drag foto</label>
                    <input type="file" id="foto_profil" class="dropify" name="foto_profil" />
                    <div class="help-block with-errors ml-3">
                      <ul class="list-unstyled">
                        <li><?= $validation->getError('foto_profil');?></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-info waves-effect waves-light m-r-10">Submit</button>
                <a href="<?php base_url();?>/data_petugas/" class="btn btn-inverse waves-effect waves-light">Cancel</a>
              </form>
          </div>
      </div>
  </div>
  <!-- /row -->

</div>

<!-- /.container-fluid -->
<?= $this->endSection(); ?>
