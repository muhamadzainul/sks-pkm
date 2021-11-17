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
        <div class="col-md-12 col-xs-12">
            <div class="white-box">
              <div class="row">
                <div class="col-lg-12 col-md-12" >
                  <img width="80px" src="/gambar/Logo-Mojokerto.png" class="mt-3">
                  <div class="pull-right text-center">
                    <!-- <p style="text-align: center; font-size:18px; font-family: arial;">
                      <b>PEMERINTAH KABUPATEN MOJOKERTO</b><br>
                      <b>DINAS KESEHATAN</b><br>
                      <b>PUSKESMAS DAWARBLANDONG</b>
                    </p> -->
                    <h4 style="text-align:center;"> <strong>PEMERINTAH KABUPATEN MOJOKERTO</strong></h4>
                    <h4 class="m-t-0" style="text-align:center;"> <strong>DINAS KESEHATAN</strong></h4>
                    <h4 class="m-t-0" style="text-align:center;"> <strong>PUSKESMAS DAWARBLANDONG</strong></h4>
                    <address style="text-align:center;">
                      <h6>Jl. Mayjen Sungkono No.17, Sidokerto, Dawarblandong, Dawar Blandong, Mojokerto, Jawa Timur 61354</h6>
                      <h6>Email : pkmdawar@gmaillp : 082332680507</h6>
                    </address>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12 col-xs-12">
                  <h5 class="mt-5" style="text-align: center;"> <strong> <u>SURAT KETERANGAN SEHAT</u> </strong> </h5>
                  <p style="text-align: center; font-size:12px; font-family: arial;">Nomor : </p>
                </div>
              </div>

              <div class="row m-t-40">
                <div class="col-md-12">
                  <p class="">Yang bertanda tangan di bawah ini Dokter PEMERINTAHKABUPATEN MOJOKERTO dengan ini menerangkan bahwa:</p>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-1">
                  </div>
                  <div class="col-md-2">
                    <p>Nama</p>
                  </div>
                  <div class="col-md-9">
                    <p>: Muhamad Zainul Mustofa</p>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-1">
                </div>
                <div class="col-md-2">
                  <p>Jenis Kelamin</p>
                </div>
                <div class="col-md-8">
                  <p>: Laki-laki</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-1">
                </div>
                <div class="col-md-2">
                  <p>Umur</p>
                </div>
                <div class="col-md-8">
                  <p>: 22 Tahun</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-1">
                </div>
                <div class="col-md-2">
                  <p>Alamat</p>
                </div>
                <div class="col-md-8">
                  <p>: Brayu Wetan RT 003 RW 005</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-1">
                </div>
                <div class="col-md-2">
                  <p>Pekerjaan</p>
                </div>
                <div class="col-md-8">
                  <p>: Pelajar</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-1">
                </div>
                <div class="col-md-2">
                  <p>Suhu</p>
                </div>
                <div class="col-md-8">
                  <p>: 36 C</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-1">
                </div>
                <div class="col-md-2">
                  <p>Catatan</p>
                </div>
                <div class="col-md-8">
                  <p>: Sakit</p>
                </div>
              </div>

              <div class="row m-t-20">
                <div class="col-md-12">
                  <p>Bahwa pada pemeriksakaan kesehatan pada saat ini ternyata dalam kondisi <b>Sakit</b>. Sehingga perlu isturahat selama <b>1 hari</b>, mulai
                  tanggal <b>16-11-2021</b> s/d <b>17-11-2021</b></p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-1">
                </div>
                <div class="col-md-11">
                  <p>Demikian surat keterangan ini di buat agar digunakan sebagaimana mestinya.</p>
                </div>
              </div>

              </div>
            </div>
          </div>
    </div>
    <!-- row -->
</div>

<?= $this->endSection(); ?>
