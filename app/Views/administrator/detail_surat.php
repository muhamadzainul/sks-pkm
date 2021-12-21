<?php $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row bg-title">
      <div class="col-lg-5 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Detail Surat Keterangan Sehat</h4>
      </div>
      <div class="col-lg-7 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
          <li><a href="<?php base_url(); ?>/">Puskesmas</a></li>
          <li><a href="<?php base_url(); ?>/data_petugas">Data Surat</a></li>
          <li class="active">Detail Surat</li>
        </ol>
      </div>
    </div>
    <div class="pesan_flash" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>
    <!-- /.row -->
    <!-- .row -->
    <div class="white-box">
      <?php foreach ($data_surat as $ds) : ?>
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="row">
              <div class="col-md-12">
                <strong>Data Diri Pasien</strong>
              </div>
              <hr>
              <!-- <div class="col-md-3 b-r">
                  <strong>Nomor Surat</strong>
                </div>
                <div class="col-md-9">
                    <p class="text-muted"><?= $ds['nomor_surat']; ?></p>
                </div> -->

              <div class="col-md-3 b-r">
                <strong>Nama Pasien</strong>
              </div>
              <div class="col-md-9">
                <p class="text-muted"><?= $ds['nama_pasien']; ?></p>
              </div>

              <div class="col-md-3 b-r">
                <strong>Umur</strong>
              </div>
              <div class="col-md-9">
                <p class="text-muted"><?= floor($ds['umur'] / 12); ?></p>
              </div>

              <div class="col-md-3 b-r">
                <strong>Jenis Kelamin</strong>
              </div>
              <div class="col-md-9">
                <p class="text-muted"><?= $ds['jenis_kelamin']; ?></p>
              </div>

              <div class="col-md-3 b-r">
                <strong>Pekerjaan</strong>
              </div>
              <div class="col-md-9">
                <p class="text-muted"><?= $ds['pekerjaan']; ?></p>
              </div>

              <div class="col-md-3 b-r">
                <strong>Alamat</strong>
              </div>
              <div class="col-md-9">
                <p class="text-muted"><?= $ds['alamat']; ?></p>
              </div>

              <div class="col-md-3 b-r">
                <strong>Kepentingan</strong>
              </div>
              <div class="col-md-9">
                <p class="text-muted"><?= $ds['kepentingan']; ?></p>
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
                <p class="text-muted"><?= $ds['tinggi_badan']; ?></p>
              </div>

              <div class="col-md-4">
                <p class="text-muted"><?= $ds['berat_badan']; ?></p>
              </div>

              <div class="col-md-4">
                <p class="text-muted"><?= $ds['tensi_darah']; ?></p>
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
                <p class="text-muted"><?= $ds['suhu_tubuh']; ?></p>
              </div>

              <div class="col-md-4">
                <p class="text-muted"><?= $ds['nadi']; ?></p>
              </div>

              <div class="col-md-4">
                <p class="text-muted"><?= $ds['respirasi']; ?></p>
              </div>
            </div>
            <hr>

            <div class="row">
              <div class="col-md-12">
                <strong>Keterangan Mata</strong>
              </div>
              <hr>

              <div class="col-md-3 b-r">
                <strong>Buta Warna</strong>
              </div>

              <div class="col-md-9">
                <p class="text-muted"><?= $ds['mata_buta']; ?></p>
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
                <p class="text-muted"><?= $ds['tubuh_tato']; ?></p>
              </div>

              <div class="col-md-6">
                <p class="text-muted"><?= $ds['tubuh_tindik']; ?></p>
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
                <p class="text-muted"><?= $ds['hasil_periksa']; ?></p>
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
                <p class="text-muted"><?= $ds['tgl_dibuat']; ?></p>
              </div>

              <div class="col-md-6">
                <p class="text-muted"><?= $ds['nama_kapus']; ?></p>
              </div>

            </div>
          </div>

        </div>
        <div class="row m-t-30">
          <div class="col-md-4">
            <a href="<?php base_url(); ?>/admin/surat_sehat/edit_data/<?= $ds['id_sks']; ?>" class="btn btn-success btn-rounded">Edit</a>
            <a href="<?php base_url(); ?>/admin/surat_sehat" class="btn btn-inverse btn-rounded">Kembali</a>
          </div>
        </div>

      <?php endforeach; ?>
    </div>
    <!-- row -->
  </div>
</div>

<?= $this->endSection(); ?>