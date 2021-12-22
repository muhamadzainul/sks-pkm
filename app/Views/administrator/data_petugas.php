<?php $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row bg-title">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Data Satgas</h4>
      </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
          <li><a href="<?php base_url(); ?>/">Puskesmas</a></li>
          <li class="active">Data Satgas</li>
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
              <form role="search" class="app-search hidden-xs" action="<?php base_url(); ?>/Admin/data_petugas/" method="post">
                <input type="text" name="keyword" placeholder="Search..." class="form-control"><button class="btn btn-rounded " type="submit" name="submit"><span class="fa fa-search"></span></button>
              </form>
            </li>
          </ul>
          <div class="kol-fix">
            <table class="table-striped table-hover table">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama Petugas</th>
                  <th scope="col">Email</th>
                  <th scope="col">Foto Profil</th>
                  <th scope="col" colspan="3">Aksi</th>
                </tr>
              </thead>
              <tbody>

                <?php if (empty($data_petugas)) : ?>
                  <td colspan="13">
                    <h5 class="text-grey-500 text-center">Data Petugas Belum Ada</h5>
                  </td>
                <?php else : ?>
                  <?php $n = 1; ?>
                  <?php foreach ($data_petugas as $dp) : ?>
                    <?php if ($dp['akses'] != 1) : ?>
                      <tr>
                        <td><?= $n++; ?></td>
                        <td><?= $dp['fullname']; ?></td>
                        <td><?= $dp['email']; ?></td>
                        <?php if (empty($dp['user_profile'])) : ?>
                          <td><span class="label label-danger">Belum</span></td>
                        <?php else : ?>
                          <td><span class="label label-success">Sudah</span></td>
                        <?php endif; ?>
                        <td><a href="<?php base_url(); ?>/admin/data_petugas/detail_petugas/<?= $dp['id_satgas']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-fw fa-edit"></i>Detail</a></td>
                        <td>
                          <!-- <a href="" class="btn btn-danger btn-rounded swal_delete" data-hapusId="<?php base_url(); ?>/admin/data_pasien/<?= $dp['id_satgas']; ?>">Hapus</a> -->
                          <!-- <span class="delete_url" ></span> -->
                          <form action="<?php base_url(); ?>/Admin/data_petugas/<?= $dp['id_satgas']; ?>" method="post">
                            <?php csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin ?')"><i class="fa fa-fw fa-trash"></i>Hapus</button>
                          </form>
                        </td>
                      </tr>
                    <?php endif; ?>
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