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
                    <form role="search" class="app-search hidden-xs" action="<?php base_url(); ?>/Admin/surat_izin/tambah_data_suratIzin/" method="post">
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
                                                <td><?= $dp['nip_pasien']; ?></td>
                                                <td><?= $dp['jenis_kelamin']; ?></td>
                                                <td><?= $dp['alamat']; ?></td>
                                                <td><a href="<?php base_url(); ?>/admin/surat_izin/tambah_data_suratIzin_ada/<?= $dp['id_pasien']; ?>" class="btn btn-primary btn-rounded">Tambahkan Data</a></td>
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
                    <form class="form-material form-horizontal" action="<?php base_url(); ?>/Admin/surat_izin/simpan" method="post" enctype="">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label class="col-md-12" for="nomor_surat"><span>No. Suat</span>
                            </label>
                            <div class="col-md-12">
                                <input type="text" name="nomor_surat" class="form-control" placeholder="Masukkan Nomor SUrat" value="<?= old('nomor_surat'); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12 m-t-10 m-b-10" for="data_diri"><span>DATA DIRI PASIEN</span></label>
                            <div class="row">
                                <div class="com-md-12">
                                    <label for="nama_pasien" class="col-md-12"><span>Nama Pasien</span></label>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" name="nama_pasien" class="form-control" placeholder="Masukkan Nama Pasien" value="<?= old('nama_pasien'); ?>">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md">
                                    <label class="col-md-6" for="nik_pasien"><span>NIK Pasien</span></label>
                                    <label class="col-md-6" for="nip_pasien"><span>NIP Pasien</span></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="col-md-6">
                                        <input type="text" name="nik_pasien" class="form-control" placeholder="Masukkan NIK Pasien" value="<?= old('nik_pasien'); ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="nip_pasien" class="form-control" placeholder="Masukkan NIP Pasien" value="<?= old('nip_pasien'); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <label class="col-md-6" for="jenis_kelamin"><span>Jenis Kelamin</span></label>
                                    <label class="col-md-6" for="tgl_lahir"><span>Tanggal Lahir</span></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="col-md-6">
                                        <select class="form-control" name="jenis_kelamin">
                                            <option value="null" class="dropdown-item" selected>-- Pilih salah satu --</option>
                                            <option class="dropdown-item">Laki-laki</option>
                                            <option class="dropdown-item">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="date" name="tgl_lahir" class="form-control" placeholder="Masukkan Tanggal Lahir" value="<?= old('tgl_lahir'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md">
                                    <label class="col-md-6" for="nik_pasien"><span>Pangkat/Gol. Ruang</span></label>
                                    <label class="col-md-6" for="nip_pasien"><span>Jabatan</span></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="col-md-6">
                                        <input type="text" name="pangkat" class="form-control" placeholder="Masukkan Pangkat/Gol. Ruang" value="<?= old('pekerjaan'); ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="Jabatan" class="form-control" placeholder="Masukkan Jabatan" value="<?= old('jabatan'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 m-t-10 m-b-10" for="fisik"><span>Bisa Masuk Pada :</span></label>
                            <div class="row">
                                <div class="col-md">
                                    <label class="col-md-6" for="nik_pasien"><span>Hati</span></label>
                                    <label class="col-md-6" for="nip_pasien"><span>tanggal</span></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="col-md-6">
                                        <select class="form-control" name="hari">
                                            <option value="null" class="dropdown-item" selected>-- Pilih salah satu --</option>
                                            <option class="dropdown-item">Senin</option>
                                            <option class="dropdown-item">Selasa</option>
                                            <option class="dropdown-item">Rabu</option>
                                            <option class="dropdown-item">Kamis</option>
                                            <option class="dropdown-item">Jum'at</option>
                                            <option class="dropdown-item">Sabtu</option>
                                            <option class="dropdown-item">Minggu</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="date" name="tanggal" class="form-control" placeholder="Masukkan Tanggal Lahir" value="<?= old('tanggal'); ?>">
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
                            <label class="col-md-12" for="password_surat"><span>Password Untuk Validasi</span></label>
                            <div class="col-md-12">
                                <input type="password" name="pass_pas" class="form-control" placeholder="Password Validasi">
                            </div>
                            <small style="color: red;">*Password digunakan saat melakukan validasi surat jadi harus mudah di ingat</small>
                        </div>
                        <input type="hidden" name="nip_kapus" value="<?= $data_kapus; ?>">
                        <input type="hidden" name="tgl_dibuat" value="<?= date("Y-m-d", time()); ?>">
                        <button type="submit" class="btn btn-info waves-effect waves-light m-r-10">Submit</button>
                        <a href="<?php base_url(); ?>/admin/surat_izin/" class="btn btn-inverse waves-effect waves-light">Cancel</a>
                    </form>
                </div>
            </div>

        </div>
        <!-- /row -->

    </div>

    <!-- /.container-fluid -->
    <?= $this->endSection(); ?>