<?php $this->extend('layout/template_login'); ?>

<?= $this->section('content'); ?>
<section id="wrapper" class="login-register">
    <div class="login-box login-sidebar">
        <div class="white-box">

            <?= view('Myth\Auth\Views\_message_block') ?>

            <a href="javascript:void(0)" class="text-center db"><img src="<?= base_url(); ?>/plugins/images/eliteadmin-logo-dark.png" alt="Home" />
                <br /><img src="<?= base_url(); ?>/plugins/images/eliteadmin-text-dark.png" alt="Home" /></a>
            <form class="form-horizontal form-material" action="<?= route_to('login') ?>" method="post">
                <?= csrf_field() ?>

                <div class="form-group m-t-40">
                    <div class="col-xs-12">
                        <input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.email') ?>">
                    </div>
                    <div class="invalid-feedback">
                        <?= session('errors.login') ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>">
                    </div>
                    <div class="invalid-feedback">
                        <?= session('errors.password') ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <div class="checkbox checkbox-primary pull-left p-t-0">
                            <?php if ($config->allowRemembering) : ?>
                                <input id="checkbox-signup" type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
                                <label for="checkbox-signup"> Tetap masuk </label>
                            <?php endif; ?>
                        </div>
                        <?php if ($config->activeResetter) : ?>
                            <a href="<?= route_to('forgot') ?>" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Lupa Password</a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                    </div>
                </div>
                <!-- <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                            <div class="social">
                                <a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip" title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a>
                                <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip" title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a>
                            </div>
                        </div>
                    </div> -->
                <div class="form-group m-b-0">
                    <div class="col-sm-12 text-center">
                        <p>Belum Punya Akun ? <a href="<?= route_to('register'); ?>" class="text-primary m-l-5"><b>Daftar</b></a></p>
                    </div>
                </div>
            </form>
            <form class="form-horizontal" id="recoverform" action="index.html">
                <div class="form-group ">
                    <div class="col-xs-12">
                        <h3>Recover Password</h3>
                        <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                    </div>
                </div>
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" required="" placeholder="Email">
                    </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>