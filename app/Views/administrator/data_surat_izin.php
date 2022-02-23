<?php $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Data Surat Izin</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?php base_url(); ?>/">Puskesmas</a></li>
                    <li class="active">Data Surat Izin</li>
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
                    <!-- <ul class="nav navbar-right hidden-xs mr-1 mb-2">
                        <li>
                            <form role="search" class="app-search hidden-xs" action="<?php base_url(); ?>/Admin/surat_izin/" method="post">
                                <input type="text" name="keyword" placeholder="Search..." class="form-control">
                                <button class="btn btn-rounded " type="submit" name="submit"><span class="fa fa-search"></span></button>
                            </form>
                        </li>
                    </ul> -->
                    <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">Nama Pasien</th>
                                <th rowspan="2">Nip Pasien</th>
                                <th rowspan="2">Kepentingan</th>
                                <th rowspan="2">Tanggal Dibuat</th>
                                <th colspan="2">Aksi</th>
                            </tr>
                            <tr>
                                <th>Edit</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <!-- <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Pasien</th>
                            <th>Nip Pasien</th>
                            <th>Kepentingan</th>
                            <th>Tanggal Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot> -->
                        <tbody>
                            <?php $n = 1 + (10 * ($currentPage - 1)); ?>
                            <?php $n = 1; ?>
                            <?php foreach ($data_surat as $ds) : ?>
                                <tr>
                                    <td><?= $n++; ?></td>
                                    <td><?= $ds['nama_pasien']; ?></td>
                                    <td><?= ($ds['nip_pasien']) ? $ds['nip_pasien'] : '-'; ?></td>
                                    <td><?= $ds['kepentingan']; ?></td>
                                    <td><?= $ds['tgl_dibuat']; ?></td>
                                    <td><a href="<?php base_url(); ?>/admin/surat_izin/cetak_surat_izin/<?= $ds['nomor_surat']; ?>" class="btn btn-inverse btn-rounded">Cetak</a></td>
                                    <td>
                                        <form action="<?php base_url(); ?>/Admin/surat_izin/<?= $ds['nomor_surat']; ?>" method="post">
                                            <?php csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger btn-rounded" onclick="return confirm('Apakah Anda Yakin ?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    <?= $this->endSection(); ?>