<!-- Left navbar-header -->
      <div class="navbar-default sidebar" role="navigation">
          <div class="sidebar-nav navbar-collapse slimscrollsidebar">
              <ul class="nav" id="side-menu">
                  <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                      <!-- input-group -->
                      <div class="input-group custom-search-form">
                          <input type="text" class="form-control" placeholder="Search..."> <span class="input-group-btn">
          <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
          </span> </div>
                      <!-- /input-group -->
                  </li>

                  <?php if (in_groups('admin')) : ?>
                  <li class="nav-small-cap m-t-10">--- Kelola Data Petugas</li>
                  <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user-md p-r-10"></i> <span class="hide-menu"> Petugas <span class="fa arrow"></span></span></a>
                      <ul class="nav nav-second-level">
                          <li> <a href="<?= base_url();?>/admin/data_petugas/">Data Petugas</a> </li>
                          <li> <a href="<?= base_url();?>/admin/data_petugas/tambah_data_petugas">Tambah Data Petugas</a> </li>
                      </ul>
                  </li>
                  <!-- <li><a href="#" class="waves-effect"><i class="fa fa-code-fork p-r-10"></i>  Hak Akses Peetugas</a></li> -->
                  <li><a href="javascript:void(0);" href="<?= base_url();?>/admin/kapus" class="waves-effect"><i class="fa fa-user p-r-10"></i><span class="hide-menu">  Kepala Puskesmas</span></a></li>
                  <?php endif; ?>

                  <li class="nav-small-cap m-t-10">--- Kelola Data Surat</li>
                  <li> <a href="javascript:void(0);" class="waves-effect"><i class="icon-people p-r-10"></i> <span class="hide-menu"> Pasien <span class="fa arrow"></span></span></a>
                      <ul class="nav nav-second-level">
                          <li> <a href="<?= base_url();?>/admin/data_pasien/">Data Pasien</a> </li>
                          <li> <a href="<?= base_url();?>/admin/data_pasien/tambah_data_pasien">Tambah Data Patient</a> </li>
                      </ul>
                  </li>
                  <li> <a href="javascript:void(0);" class="waves-effect"><i class="icon-docs p-r-10"></i> <span class="hide-menu"> Surat Kesehatan <span class="fa arrow"></span></span></a>
                      <ul class="nav nav-second-level">
                          <li> <a href="<?= base_url();?>/admin/surat_sehat/">Data Surat</a> </li>
                          <li> <a href="<?= base_url();?>/admin/surat_sehat/tambah_data_surat">Tambah Data Surat</a> </li>
                      </ul>
                  </li>
              </ul>
          </div>
      </div>
      <!-- Left navbar-header end -->
