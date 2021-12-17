<?php $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row bg-title">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Data Surat Sehat</h4>
      </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
          <li><a href="<?php base_url(); ?>/">Puskesmas</a></li>
          <li class="active">Data Surat Sehat</li>
        </ol>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="white-box">
          <!-- <h3 class="box-title m-b-0">Kitchen Sink</h3> -->
          <!-- <p class="text-muted m-b-20">Swipe Mode, ModeSwitch, Minimap, Sortable, SortableSwitch</p> -->
          <div class="pesan_flash" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>
          <!-- <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success alert-dismissable mt-3">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                   <?= session()->getFlashdata('pesan'); ?>
                </div>
              <?php endif; ?> -->
          <ul class="nav navbar-right hidden-xs mr-1 mb-2">
            <li>
              <form role="search" class="app-search hidden-xs" action="<?php base_url(); ?>/Admin/surat_sehat/" method="post">
                <input type="text" name="keyword" placeholder="Search..." class="form-control">
                <button class="btn btn-rounded " type="submit" name="submit"><span class="fa fa-search"></span></button>
              </form>
            </li>
          </ul>
          <div class="table-responsive table-bordered kol-fix">
            <table class="table-striped table-hover table-bordered table">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama Pasien</th>
                  <th scope="col">Umur</th>
                  <th scope="col">Kepentingan</th>
                  <th scope="col">Hasil Pemeriksaan</th>
                  <th scope="col">Tanggal dibuat</th>
                  <th scope="col" colspan="2">Aksi</th>
                </tr>
              </thead>
              <tbody>

                <?php if (empty($data_surat)) : ?>
                  <td colspan="13">
                    <h5 class="text-grey-500 text-center">Data Surat Sehat Belum Ada</h5>
                  </td>
                <?php else : ?>
                  <?php $n = 1; ?>
                  <?php foreach ($data_surat as $ds) : ?>
                    <tr>
                      <td><?= $n++; ?></td>
                      <td><?= $ds['nama_pasien']; ?></td>
                      <td><?= floor($ds['umur'] / 12); ?> <span>tahun</span> </td>
                      <td><?= $ds['kepentingan']; ?></td>
                      <td><?= $ds['hasil_periksa']; ?></td>
                      <td><?= $ds['tanggal_diubah']; ?></td>
                      <td><a href="<?php base_url(); ?>/admin/surat_sehat/detail_surat/<?= $ds['id_sks']; ?>" class="btn btn-warning btn-rounded">Detail</a></td>
                      <td>
                        <!-- <a href="" class="btn btn-danger btn-rounded swal_delete" data-hapusId="<?php base_url(); ?>/admin/data_pasien/<?= $ds['id_sks']; ?>">Hapus</a> -->
                        <!-- <span class="delete_url" ></span> -->
                        <form action="<?php base_url(); ?>/Admin/surat_sehat/<?= $ds['id_sks']; ?>" method="post">
                          <?php csrf_field(); ?>
                          <input type="hidden" name="_method" value="DELETE">
                          <button type="submit" class="btn btn-danger btn-rounded" onclick="return confirm('Apakah Anda Yakin ?')">Hapus</button>
                        </form>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
  <?= $this->endSection(); ?>