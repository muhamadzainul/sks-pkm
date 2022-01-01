<?php $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row bg-title">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Data Kepala Puskesmas</h4>
      </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
          <li><a href="<?php base_url(); ?>/">Puskesmas</a></li>
          <li class="active">Data Kepala Puskesmas</li>
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
          <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="pesan_flash" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>
          <?php else : ?>
            <div class="error_flash" data-flashdata="<?= session()->getFlashdata('pesan_error'); ?>"></div>
          <?php endif; ?>
          <!-- <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success alert-dismissable mt-3">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                   <?= session()->getFlashdata('pesan'); ?>
                </div>
              <?php endif; ?> -->
          <ul class="nav navbar-left hidden-xs">
            <li><a href="" class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#tambahKapus"><i class="fa fa-fw fa-plus-square"></i> Tambah Data</a></li>
          </ul>
          <ul class="nav navbar-right hidden-xs mr-1 mb-2">
            <li>
              <form role="search" class="app-search hidden-xs" action="<?php base_url(); ?>/Admin/data_kapus/" method="post">
                <input type="text" name="keyword" placeholder="Search..." class="form-control"><button class="btn btn-rounded " type="submit" name="submit"><span class="fa fa-search"></span></button>
              </form>
            </li>
          </ul>
          <div class="table-responsive kol-fix">
            <table class="table-striped table-hover table">
              <thead>
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">Nama Kapus</th>
                  <th scope="col">NIP</th>
                  <th scope="col" colspan="2">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($data_kapus)) : ?>
                  <td colspan="13">
                    <h5 class="text-grey-500 text-center">Data kapus Belum Ada</h5>
                  </td>
                <?php else : ?>
                  <?php $n = 1 + (10 * ($currentPage - 1)); ?>
                  <?php foreach ($data_kapus as $dk) : ?>
                    <tr>
                      <?php if ($dk['active'] == 1) : ?>
                        <td><?= $n++; ?></td>
                        <td><?= $dk['nama_kapus']; ?></td>
                        <td><?= $dk['nip_kapus']; ?></td>
                        <!-- <td><a href="<?php base_url(); ?>/admin/data_kapus/edit_kapus/<?= $dk['slug']; ?>" class="btn btn-success btn-rounded">Edit</a></td> -->
                        <td><a href="" data-toggle="modal" data-target="#Edit_kapus<?= $dk['id_kapus']; ?>" class="btn btn-success btn-sm btn-rounded"><i class="fa fa-fw fa-edit"></i>Edit</a></td>
                        <td>
                          <form action="<?php base_url(); ?>/Admin/kapus/hapus_data/<?= $dk['slug']; ?>" method="post">
                            <?php csrf_field(); ?>
                            <input type="hidden" name="id_kapus">
                            <button type="submit" class="btn btn-danger btn-sm btn-rounded" onclick="return confirm('Apakah Anda Yakin ?')">Hapus</button>
                          </form>
                        </td>
                      <?php endif; ?>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
            <?= $pager->Links(); ?>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div>
  <?php foreach ($data_kapus as $dk) : ?>
    <!-- Modal Edit -->
    <div class="modal fade" id="Edit_kapus<?= $dk['id_kapus']; ?>" tabindex="-1" role="dialog" aria-labelledby="pelamarEditLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="pelamarEditLabel">Edit Data Kapus</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= base_url() ?>/admin/kapus/simpan/<?= $dk['id_kapus']; ?>" method="POST">
            <div class="modal-body">
              <div class="form-group">
                <label for="nama_kapus">Nama Kapus</label>
                <input type="hidden" name="slug" value="<?= $dk['slug'] ?>">
                <input type="hidden" name="pesan" value="Edit">
                <input type="text" class="form-control" id="nama_kapus" name="nama_kapus" value="<?= $dk['nama_kapus']; ?>" placeholder="Nama Kapus">
              </div>
              <div class="form-group">
                <label for="nip_kapus">Nip Kapus</label>
                <input type="text" class="form-control" name="nip_kapus" id="nip_kapus" placeholder="Nip Kapus" value="<?= $dk['nip_kapus']; ?>" readonly>
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
  <?php endforeach; ?>

  <!-- Modal Tambah Kapus -->
  <div class="modal fade" id="tambahKapus" tabindex="-1" role="dialog" aria-labelledby="userBaruLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="userBaruLabel">Tambah Kapus</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form action="<?= base_url(); ?>/admin/kapus/simpan" method="POST" class="needs-validation" validate>
          <div class="modal-body">
            <div class="form-group">
              <label for="nama_kapus">Nama Kapus</label>
              <input type="text" class="form-control" name="nama_kapus" id="nama_kapus" placeholder="Nama Kapus" required>
              <input type="hidden" name="pesan" value="Tambahkan">
            </div>
            <!-- <div class="form-group">
						<input type="text" class="form-control" name="email" id="email" placeholder="Email Kapus">
					</div> -->
            <div class="form-group">
              <label for="nip_kapus">Nip Kapus</label>
              <input type="text" class="form-control cekkarakter1 req1" name="nip_kapus" id="nip_kapus" placeholder="Nip Kapus" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </form>

      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
  <?= $this->endSection(); ?>