<?php $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Edit Data petugas</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="<?php base_url(); ?>/">Puskesmas</a></li>
                    <li class="active">Edit Data petugas</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <!-- row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <!-- <h3 class="box-title">Basic Information</h3> -->
                    <?= view('Myth\Auth\Views\_message_block') ?>

                    <p><?= lang('Auth.enterCodeEmailPassword') ?></p>

                    <form action="<?= route_to('reset-password') ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="form-group">
                            <label for="token"><?= lang('Auth.token') ?></label>
                            <input type="text" class="form-control <?php if (session('errors.token')) : ?>is-invalid<?php endif ?>" name="token" placeholder="<?= lang('Auth.token') ?>" value="<?= old('token', $token ?? '') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors.token') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email"><?= lang('Auth.email') ?></label>
                            <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors.email') ?>
                            </div>
                        </div>

                        <br>

                        <div class="form-group">
                            <label for="password"><?= lang('Auth.newPassword') ?></label>
                            <input type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password">
                            <div class="invalid-feedback">
                                <?= session('errors.password') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass_confirm"><?= lang('Auth.newPasswordRepeat') ?></label>
                            <input type="password" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" name="pass_confirm">
                            <div class="invalid-feedback">
                                <?= session('errors.pass_confirm') ?>
                            </div>
                        </div>

                        <br>

                        <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.resetPassword') ?></button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /row -->

    </div>

    <!-- /.container-fluid -->
    <?= $this->endSection(); ?>