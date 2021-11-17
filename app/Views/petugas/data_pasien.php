<?php $this->extend('layout/publik_template'); ?>

<?= $this->section('content'); ?>


<!-- Page Content -->
<!-- <div id="page-wrapper"> -->
<div class="container-fluid">
    <!-- <div class="row bg-title">
        <div class="col-lg-3">
        </div>
    </div> -->
    <!-- /row -->
    <div class="row">
      <div class="col-12">
        <div class="white-box">
          <div class="pesan_flash" data-flashdata="<?= session()->getFlashdata('pesan');?>"></div>
          <h4 class="page-title"><strong>Data Pasien</strong></h4>
          <ul class="nav navbar-right hidden-xs mr-1 mb-2">
              <li>
                  <form role="search" class="app-search hidden-xs" action="/Admin/data_pasien/" method="post">
                      <input type="text" name="keyword" placeholder="Search..." class="form-control"><button class="btn btn-rounded " type="submit" name="submit"><span class="fa fa-search"></span></button>
                  </form>
              </li>
          </ul>
          <div class="table-responsive kol-fix">
            <table class="table-striped table-hover table-bordered table-sm" style="width:100%;">
              <thead>
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">Nama Pasien</th>
                  <th scope="col">NIK</th>
                  <th scope="col">Jenis Kelamin</th>
                  <th scope="col">Alamat</th>
                  <th scope="col">No Hp</th>
                  <th scope="col">Email</th>
                  <th scope="col">Foto KTP</th>
                  <th scope="col">Foto KK</th>
                  <th  scope="col"colspan="2">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($data_pasien)) : ?>
                  <td colspan="13">
                    <h5 class="text-grey-500 text-center">Data Pasien Belum Ada</h5>
                  </td>
                <?php else : ?>
                <?php $n = 1 + (10 * ($currentPage - 1)); ?>
                <?php foreach ($data_pasien as $dp): ?>
                <tr>
                  <td><?= $n++;?></td>
                  <td><?= $dp['nama_pasien'];?></td>
                  <td><?= $dp['nik_pasien'];?></td>
                  <td><?= $dp['jenis_kelamin'];?></td>
                  <td><?= $dp['alamat'];?></td>
                  <td><?= $dp['no_hp'];?></td>
                  <td><?= $dp['email'];?></td>
                  <?php if (empty($dp['foto_ktp'])): ?>
                    <td><span class="label label-danger">Belum</span></td>
                  <?php else: ?>
                    <td><span class="label label-success">Sudah</span></td>
                  <?php endif; ?>
                  <?php if (empty($dp['foto_kk'])): ?>
                    <td><span class="label label-danger">Belum</span></td>
                  <?php else: ?>
                    <td><span class="label label-success">Sudah</span></td>
                  <?php endif; ?>
                  <td><a href="/petugas/data_pasien/detail_pasien/<?= $dp['slug'];?>" class="btn btn-success btn-rounded">Detail</a></td>
                  <td>
                    <!-- <a href="" class="btn btn-danger btn-rounded swal_delete" data-hapusId="/admin/data_pasien/<?= $dp['id_pasien'];?>">Hapus</a> -->
                    <!-- <span class="delete_url" ></span> -->
                    <form action="/Petugas/data_pasien/<?= $dp['id_pasien'];?>" method="post">
                      <?php csrf_field();?>
                      <input type="hidden" name="_method" value="DELETE">
                      <button type="submit" class="btn btn-danger btn-rounded" onclick="return confirm('Apakah Anda Yakin ?')">Hapus</button>
                    </form>
                  </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
            <?= $pager->Links();?>
          </div>
        </div>
      </div>
    </div>
<!-- /.row -->
<!-- </div> -->
<!-- /.container-fluid -->
<?= $this->endSection(); ?>
