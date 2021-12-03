<?php $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<!-- Page Content -->
<div id="page-wrapper">
<div class="container-fluid">
  <div class="row bg-title">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h4 class="page-title">Edit Data Pasien</h4> </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
          <ol class="breadcrumb">
              <li><a href="<?php base_url();?>/">Puskesmas</a></li>
              <li><a href="<?php base_url();?>/">Puskesmas</a></li>
              <li class="active">Edit Data Pasien</li>
          </ol>
      </div>
      <!-- /.col-lg-12 -->
  </div>

  <!-- row -->
  <div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <!-- <h3 class="box-title">Basic Information</h3> -->
            <form class="form-material form-horizontal" action="<?php base_url();?>/admin/data_pasien/update_data/<?= $data_pasien['id_pasien'];?>" method="post" enctype="multipart/form-data">
              <?= csrf_field();?>
              <input type="hidden" id="slug" name="slug" value="<?= $data_pasien['slug'];?>">
              <input type="hidden" name="file_ktp_lama" value="<?= $data_pasien['foto_ktp'];?>">
              <input type="hidden" name="file_kk_lama" value="<?= $data_pasien['foto_kk'];?>">
                <div class="form-group">
                    <label class="col-md-12" for="nama_pasien">Nama</span>
                    </label>
                    <div class="col-md-12">
                        <input type="text" id="nama_pasien" name="nama_pasien" class="form-control" value="<?= (old('nama_pasien')) ? old('nama_pasien') : $data_pasien['nama_pasien'];?>"> </div>
                </div>
                <div class="form-group <?= ($validation->hasError('nik_pasien')) ? 'has-error has-danger' : '';?>">
                    <label class="col-md-12" for="nik_pasien">NIK</span>
                    </label>
                    <div class="col-md-12">
                        <input type="number" id="nik_pasien" name="nik_pasien" class="form-control"  value="<?= (old('nik_pasien')) ? old('nik_pasien') : $data_pasien['nik_pasien'];?>"> </div>
                        <div class="help-block with-errors ml-3">
                          <ul class="list-unstyled">
                            <li><?= $validation->getError('nik_pasien');?></li>
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
                        <input type="text" id="alamat" name="alamat" class="form-control mydatepicker" value="<?= (old('alamat')) ? old('alamat') : $data_pasien['alamat'];?>"> </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="email">Email</span>
                    </label>
                    <div class="col-md-12">
                        <input type="text" id="email" name="email" class="form-control mydatepicker" value="<?= (old('email')) ? old('email') : $data_pasien['email'];?>"> </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="no_hp">No. Hp</span>
                    </label>
                    <div class="col-md-12">
                        <input type="number" id="no_hp" name="no_hp" class="form-control mydatepicker" value="<?= (old('no_hp')) ? old('no_hp') : $data_pasien['no_hp'];?>"> </div>
                </div>
                <div class="form-group">
                  <div class="col-md-6 <?= ($validation->hasError('foto_ktp')) ? 'has-error has-danger' : '';?>">
                    <h3 class="box-title">Foto KTP</h3>
                    <label for="foto_ktp">Masukkan Foto KTP - klik atau drag foto</label>
                    <input type="file" id="foto_ktp" class="dropify" data-default-file="<?= ($data_pasien['foto_ktp']) ? '/gambar/foto_ktp/'.$data_pasien['foto_ktp'] : '';?>"  name="foto_ktp"/>
                    <div class="help-block with-errors ml-3">
                      <ul class="list-unstyled">
                        <li><?= $validation->getError('foto_ktp');?></li>
                      </ul>
                    </div>
                  </div>
                    <div class="col-md-6 <?= ($validation->hasError('foto_kk')) ? 'has-error has-danger' : '';?>">
                      <h3 class="box-title">Foto KK</h3>
                      <label for="foto_kk">Masukkan Foto KK - klik atau drag foto</label>
                      <input type="file" id="foto_kk" class="dropify" data-default-file="<?= ($data_pasien['foto_ktp']) ? '/gambar/foto_kk/'.$data_pasien['foto_kk'] : '';?>" name="foto_kk" />
                      <div class="help-block with-errors ml-3">
                        <ul class="list-unstyled">
                          <li><?= $validation->getError('foto_kk');?></li>
                        </ul>
                      </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-info waves-effect waves-light m-r-10">Edit</button>
                <a href="<?php base_url();?>/admin/data_pasien/detail_pasien/<?= $data_pasien['slug'];?>" class="btn btn-inverse waves-effect waves-light">Batal</a>
              </form>
          </div>
      </div>
  </div>
  <!-- /row -->

</div>

<!-- /.container-fluid -->
<?= $this->endSection(); ?>
