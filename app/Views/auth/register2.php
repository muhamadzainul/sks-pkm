<?php $this->extend('layout/template_login'); ?>

<?= $this->section('content'); ?>

    <section id="wrapper" class="login-register">
        <div class="login-box login-sidebar">
            <div class="white-box">

                <?= view('Myth\Auth\Views\_message_block') ?>

                <form class="form-horizontal form-material" action="<?= route_to('register') ?>" method="post">
                  <?= csrf_field() ?>

                    <a href="javascript:void(0)" class="text-center db"><img src="<?= base_url();?>/plugins/images/eliteadmin-logo-dark.png" alt="Home" />
                        <br/><img src="<?= base_url();?>/plugins/images/eliteadmin-text-dark.png" alt="Home" /></a>
                    <h3 class="box-title m-t-40 m-b-0">Daftar Sekarang</h3><small>Buat akunmu di bawah sini</small>

                    <div class="form-group m-t-20">
                        <div class="col-xs-12">
                            <input type="text" class="form-control" name="fullname" placeholder="Nama Lengkap" value="<?= old('fullname') ?>"> </div>
                    </div>

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" type="email" name="email" aria-describedby="emailHelp" placeholder="<?=lang('Auth.email')?>" value="<?= old('email') ?>">
                     <small id="emailHelp" class="form-text text-muted">Kami tidak akan membagikan informasi email anda</small>
                          </div>
                    </div>

                    <div class="form-group ">
                        <div class="col-xs-12">
                          <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.password')?>" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                          <input type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.repeatPassword')?>" autocomplete="off">
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <div class="col-md-12">
                            <div class="checkbox checkbox-primary p-t-0">
                                <input id="checkbox-signup" type="checkbox">
                                <label for="checkbox-signup"> I agree to all <a href="#">Terms</a></label>
                            </div>
                        </div>
                    </div> -->
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit"><?=lang('Auth.register')?></button>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p>Sudah Mempunyai akun <a href="<?= route_to('login');?>" class="text-primary m-l-5"><b>Log In</b></a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <?= $this->endSection(); ?>
