<?php $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row bg-title">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Tambah Data Pembuat</h4>
      </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
          <li><a href="<?php base_url(); ?>/">Puskesmas</a></li>
          <li class="active">Tambah Data Pembuat</li>
        </ol>
      </div>
      <!-- /.col-lg-12 -->
    </div>

    <!-- row -->
    <div class="row">
      <div class="col-lg">
        <div class="white-box">
          <label class="col-md-12" for="input_search">Cek Apakah Data Sudah Pernah di Tambahkan ?</span>
          </label>
          <form role="search" class="app-search hidden-xs" action="<?php base_url(); ?>/Admin/surat_sehat/tambah_data_surat/" method="post">
            <div class="input-group mb-3">
              <input type="text" name="keyword" class="form-control" placeholder="Masukkan Nik atau Nama Pasien">
              <div class="input-group-prepend">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
              </div>
            </div>
          </form>
          <?php if ($kosong == null) : ?>
            &nbsp;
          <?php else : ?>
            <div class="table-responsive table-bordered kol-fix">
              <table class="table-striped table-hover table-bordered table">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Pasien</th>
                    <th scope="col">Umur</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Alamat</th>
                    <th scope="col" colspan="2">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (empty($data_pasien)) : ?>
                    <td colspan="13">
                      <h5 class="text-grey-500 text-center">Data Surat Sehat Belum Ada</h5>
                    </td>
                    <?php else :
                    $n = 1;
                    foreach ($data_pasien as $dp) : ?>
                      <tr>
                        <td><?= $n++; ?></td>
                        <td><?= $dp['nama_pasien']; ?></td>
                        <td><?= floor($dp['umur'] / 12); ?> <span> Tahun</span> </td>
                        <td><?= $dp['jenis_kelamin']; ?></td>
                        <td><?= $dp['alamat']; ?></td>
                        <td><a href="<?php base_url(); ?>/admin/surat_sehat/tambah_data_surat_ada/<?= $dp['id_pasien']; ?>" class="btn btn-primary btn-rounded">Tambahkan Data</a></td>
                      </tr>
                  <?php
                    endforeach;
                  endif;
                  ?>
                </tbody>
              </table>
            </div>
          <?php endif; ?>

        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-lg">
        <div class="white-box">
          <!-- <h3 class="box-title">Basic Information</h3> -->
          <form class="form-material form-horizontal" action="<?php base_url(); ?>/Admin/surat_sehat/simpan" method="post" enctype="">
            <?= csrf_field(); ?>
            <!-- <div class="form-group <?= ($validation->hasError('nomor_surat')) ? 'has-error has-danger' : ''; ?>">
              <label class="col-md-12" for="nomor_surat"><span>No. Suat</span>
              </label>
              <div class="col-md-12">
                <input type="text" name="nomor_surat" class="form-control" placeholder="Masukkan Nomor SUrat" value="<?= old('nomor_surat'); ?>">
              </div>
              <div class="help-block with-errors ml-3">
                <ul class="list-unstyled">
                  <li><?= $validation->getError('nomor_surat'); ?></li>
                </ul>
              </div>
            </div> -->

            <div class="form-group ">
              <label class="col-md-12 m-t-10 m-b-10" for="data_diri"><span>DATA DIRI PASIEN</span></label>
              <div class="row">
                <div class="col-md">
                  <label class="col-md-7" for="nama_pasien"><span>Nama Pasien</span></label>
                  <label class="col-md-5" for="nik_pasien"><span>Nik Pasien</span></label>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <div class="col-md-7  <?= ($validation->hasError('nik_pasien')) ? 'has-error has-danger' : ''; ?>">
                    <input type="text" name="nama_pasien" class="form-control" placeholder="Masukkan Nama Pasien" value="<?= old('nama_pasien'); ?>">
                  </div>
                  <div class="col-md-5">
                    <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="16" name="nik_pasien" class="form-control" placeholder="Masukkan Nik Pasien" maxlength="16" value="<?= old('nik_pasien'); ?>">
                  </div>
                  <div class="help-block with-errors ml-3">
                    <ul class="list-unstyled">
                      <li><?= $validation->getError('nik_pasien'); ?></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <label class="col-md-4" for="jenis_kelamin"><span>Jenis Kelamin</span></label>
                  <label class="col-md-4" for="pekerjaan"><span>Pekerjaan</span></label>
                  <label class="col-md-4" for="tgl_lahir"><span>Tanggal Lahir</span></label>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <div class="col-md-4">
                    <select class="form-control" name="jenis_kelamin">
                      <option value="null" class="dropdown-item" selected>-- Pilih salah satu --</option>
                      <option class="dropdown-item">Laki-laki</option>
                      <option class="dropdown-item">Perempuan</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <input type="text" name="pekerjaan" class="form-control" placeholder="Masukkan Pekerjaan" value="<?= old('pekerjaan'); ?>">
                  </div>
                  <div class="col-md-4">
                    <input type="date" name="tgl_lahir" class="form-control" placeholder="Masukkan Tanggal Lahir" value="<?= old('tgl_lahir'); ?>">
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-12" for="alamat"><span>ALamat</span>
              </label>
              <div class="col-md-12">
                <input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat" value="<?= old('alamat'); ?>">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-12" for="kepentingan"><span>Kepentingan</span>
              </label>
              <div class="col-md-12">
                <input type="text" id="kepentingan" name="kepentingan" class="form-control mydatepicker" placeholder="Masukkan Kepentingan" value="<?= old('kepentingan'); ?>">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-12 m-t-10 m-b-10" for="fisik"><span>KETERANGAN FISIK</span></label>
              <div class="row">
                <div class="col-md">
                  <label class="col-md-4" for="tinggi_badan"><span>Tinggi Badan</span></label>
                  <label class="col-md-4" for="berat_badan"><span>Berat Badan</span></label>
                  <label class="col-md-4" for="tensi_darah"><span>Tekanan Darah</span></label>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <div class="col-md-4">
                    <input type="text" name="tinggi_badan" class="form-control" placeholder="Masukkan Tinggi Badan" value="<?= old('tinggi_badan'); ?>">
                  </div>
                  <div class="col-md-4">
                    <input type="text" name="berat_badan" class="form-control" placeholder="Masukkan Berat Badan" value="<?= old('berat_badan'); ?>">
                  </div>
                  <div class="col-md-4">
                    <input type="text" name="tensi_darah" class="form-control" placeholder="Masukkan Tekanan Darah" value="<?= old('tensi_darah'); ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <label class="col-md-4" for="suhu_tubuh"><span>Suhu Tubuh</span></label>
                  <label class="col-md-4" for="nadi"><span>Nadi</span></label>
                  <label class="col-md-4" for="respirasi"><span>respirasi</span></label>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <div class="col-md-4">
                    <input type="text" name="suhu_tubuh" class="form-control" placeholder="Masukkan Suhu Tubuh" value="<?= old('suhu_tubuh'); ?>">
                  </div>
                  <div class="col-md-4">
                    <input type="text" name="nadi" class="form-control" placeholder="Masukkan Nadi" value="<?= old('nadi'); ?>">
                  </div>
                  <div class="col-md-4">
                    <input type="text" name="respirasi" class="form-control" placeholder="Masukkan Respirasi" value="<?= old('respirasi'); ?>">
                  </div>
                </div>
              </div>
            </div>


            <div class="form-group">
              <div class="row">
                <div class="col-md">
                  <label class="col-md-4 m-t-10 m-b-10" for="mata"><span>Mata</span></label>
                  <label class="col-md-8 m-t-10 m-b-10" for="tubuh"><span>Tubuh</span></label>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <label class="col-md-4" for="mata_buta"><span>Buta Warna</span></label>
                  <label class="col-md-4" for="tato"><span>Tato</span></label>
                  <label class="col-md-4" for="tindik"><span>Tindik</span></label>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <div class="col-md-4">
                    <select class="custom-select custom-select-sm col-sm" name="mata_buta">
                      <option value="null" class="dropdown-item" selected>-- Pilih salah satu --</option>
                      <option value="YA" class="dropdown-item">YA</option>
                      <option value="TIDAK" class="dropdown-item">TIDAK</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <select class="custom-select custom-select-sm col-sm" name="tubuh_tato">
                      <option value="null" class="dropdown-item" selected>-- Pilih salah satu --</option>
                      <option value="YA" class="dropdown-item">YA</option>
                      <option value="TIDAK" class="dropdown-item">TIDAK</option>
                    </select>
                    <!-- <input type="text" name="tubuh_tato" class="form-control" placeholder="Masukkan Tato" value="<?= old('tubuh_tato'); ?>"> -->
                  </div>
                  <div class="col-md-4">
                    <select class="custom-select custom-select-sm col-sm" name="tubuh_tindik">
                      <option value="null" class="dropdown-item" selected>-- Pilih salah satu --</option>
                      <option value="YA" class="dropdown-item">YA</option>
                      <option value="TIDAK" class="dropdown-item">TIDAK</option>
                    </select>
                    <!-- <input type="text" name="tubuh_tindik" class="form-control" placeholder="Masukkan Tindik" value="<?= old('tubuh_tindik'); ?>"> -->
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="form-group <?= ($validation->hasError('nik_petugas')) ? 'has-error has-danger' : ''; ?>">
                    <label class="col-md-12" for="tinggi_badan">Tinggi Badan</span>
                    </label>
                    <div class="col-md-12">
                        <input type="text" id="tinggi_badan" name="tinggi_badan" class="form-control" placeholder="Masukkan Tinggi Badan" value="<?= old('tinggi_badan'); ?>">
                    </div>
                    <div class="help-block with-errors ml-3">
                      <ul class="list-unstyled">
                        <li><?= $validation->getError('nik_petugas'); ?></li>
                      </ul>
                </div> -->

            <div class="form-group">
              <label class="col-md-12" for="hasil_periksa"><span>Hasil Pemeriksaan</span>
              </label>
              <div class="col-md-12">
                <select class="custom-select custom-select-sm col-sm" name="hasil_periksa">
                  <option value="null" class="dropdown-item" selected>-- Pilih salah satu --</option>
                  <option value="SEHAT" class="dropdown-item">SEHAT</option>
                  <option value="TIDAK SEHAT" class="dropdown-item">TIDAK SEHAT</option>
                </select>
              </div>
            </div>
            <!-- <div class="form-group  <?= ($validation->hasError('pass_pas')) ? 'has-error has-danger' : ''; ?>">
              <label class="col-md-12" for="password_surat"><span>Password Untuk Validasi</span></label>
              <div class="col-md-12">
                <input type="password" name="pass_pas" class="form-control" placeholder="Password Validasi">
              </div>
              <div class="help-block with-errors ml-3">
                <ul class="list-unstyled">
                  <li><?= $validation->getError('pass_pas'); ?></li>
                </ul>
              </div>
              <small style="color: red;">*Password digunakan saat melakukan validasi surat jadi harus mudah di ingat</small>
            </div> -->
            <input type="hidden" name="nip_kapus" value="<?= $data_kapus; ?>">
            <input type="hidden" name="tgl_dibuat" value="<?= date("Y-m-d", time()); ?>">
            <button type="submit" class="btn btn-info waves-effect waves-light m-r-10">Submit</button>
            <a href="<?php base_url(); ?>/admin/surat_sehat/" class="btn btn-inverse waves-effect waves-light">Cancel</a>
          </form>
        </div>
      </div>

    </div>
    <!-- /row -->

  </div>

  <!-- /.container-fluid -->
  <?= $this->endSection(); ?>