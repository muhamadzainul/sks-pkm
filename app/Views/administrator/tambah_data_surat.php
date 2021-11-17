<?php $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<!-- Page Content -->
<div id="page-wrapper">
<div class="container-fluid">
  <div class="row bg-title">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h4 class="page-title">Tambah Data Pembuat</h4> </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
          <ol class="breadcrumb">
              <li><a href="/">Puskesmas</a></li>
              <li class="active">Tambah Data Pembuat</li>
          </ol>
      </div>
      <!-- /.col-lg-12 -->
  </div>

  <!-- row -->
  <div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <!-- <h3 class="box-title">Basic Information</h3> -->
            <form class="form-material form-horizontal" action="/Admin/surat_sehat/simpan" method="post" enctype="">
              <?= csrf_field();?>
                <div class="form-group">
                    <label class="col-md-12" for="nomor_surat">No. Suat</span>
                    </label>
                    <div class="col-md-12">
                        <input type="text" id="nomor_surat" name="nomor_surat" class="form-control" placeholder="Masukkan Nomor Surat" value="<?= old('nomor_surat');?>"> </div>
                </div>
                <div class="form-group <?= ($validation->hasError('nik_petugas')) ? 'has-error has-danger' : '';?>">
                    <label class="col-md-12" for="tinggi_badan">Tinggi Badan</span>
                    </label>
                    <div class="col-md-12">
                        <input type="text" id="tinggi_badan" name="tinggi_badan" class="form-control" placeholder="Masukkan Tinggi Badan" value="<?= old('tinggi_badan');?>">
                    </div>
                    <!-- <div class="help-block with-errors ml-3">
                      <ul class="list-unstyled">
                        <li><?= $validation->getError('nik_petugas');?></li>
                      </ul>
                    </div> -->

                </div>
                <div class="form-group">
                    <label class="col-md-12" for="nomor_surat">Berat Badan</span>
                    <div class="col-md-12">
                        <input type="text" id="berat_badan" name="berat_badan" class="form-control" placeholder="Masukkan Berat Badan" value="<?= old('berat_badan');?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="suhu_tubuh">Suhu Tubuh</span>
                    </label>
                    <div class="col-md-12">
                        <input type="text" id="suhu_tubuh" name="suhu_tubuh" class="form-control mydatepicker" placeholder="Masukkan Suhu Tubuh" value="<?= old('suhu_tubuh');?>"> </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="tensi_darah">Tensi Darah</span>
                    </label>
                    <div class="col-md-12">
                        <input type="text" id="tensi_darah" name="tensi_darah" class="form-control mydatepicker" placeholder="Masukkan Tensi Darah" value="<?= old('tensi_darah');?>"> </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="riwayat_penyakit">Riwayat Penyakit</span>
                    </label>
                    <div class="col-md-12">
                        <input type="text" id="riwayat_penyakit" name="riwayat_penyakit" class="form-control mydatepicker" placeholder="Masukkan Riwayat Penyakit" value="<?= old('riwayat_penyakit');?>"> </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="kepentingan">Kepentingan</span>
                    </label>
                    <div class="col-md-12">
                        <input type="text" id="kepentingan" name="kepentingan" class="form-control mydatepicker" placeholder="Masukkan Kepentingan" value="<?= old('kepentingan');?>"> </div>
                </div>
                <button type="submit" class="btn btn-info waves-effect waves-light m-r-10">Submit</button>
                <a href="/admin/surat_sehat/" class="btn btn-inverse waves-effect waves-light">Cancel</a>
              </form>
          </div>
      </div>
  </div>
  <!-- /row -->

</div>

<!-- /.container-fluid -->
<?= $this->endSection(); ?>
