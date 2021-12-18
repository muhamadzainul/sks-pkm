<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>/plugins/images/favicon.png">
    <title>SKS Puskesmas</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url(); ?>/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>/plugins/bower_components/footable/css/footable.core.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>/plugins/bower_components/bootstrap-table/dist/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
    <!-- Menu CSS -->
    <link href="<?= base_url(); ?>/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>/plugins/bower_components/tablesaw-master/dist/tablesaw.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>/plugins/bower_components/dropify/dist/css/dropify.min.css">
    <!-- morris CSS -->
    <link href="<?= base_url(); ?>/plugins/bower_components/morrisjs/morris.css" rel="stylesheet" type="text/css">
    <!-- animation CSS -->
    <link href="<?= base_url(); ?>/css/animate.css" rel="stylesheet" type="text/css">
    <!--alerts CSS -->
    <link href="<?= base_url(); ?>/plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <!-- Custom CSS -->
    <link href="<?= base_url(); ?>/css/style.min.css" rel="stylesheet" type="text/css">

    <!-- color CSS -->
    <link href="<?= base_url(); ?>/css/colors/megna.css" id="theme" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

    <?= $this->include('/layout/publik_topbar'); ?>

    <?= $this->renderSection('content'); ?>


    <footer class="footer text-center"> Surat Keterangan Sehat Online</footer>
    </div>
    <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="<?= base_url(); ?>/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?= base_url(); ?>/bootstrap/dist/js/tether.min.js"></script>
    <script src="<?= base_url(); ?>/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="<?= base_url(); ?>/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="<?= base_url(); ?>/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?= base_url(); ?>/js/waves.js"></script>
    <!--Morris JavaScript -->
    <script src="<?= base_url(); ?>/plugins/bower_components/raphael/raphael-min.js"></script>
    <script src="<?= base_url(); ?>/plugins/bower_components/morrisjs/morris.js"></script>
    <!-- Sparkline chart JavaScript -->
    <script src="<?= base_url(); ?>/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!-- jQuery peity -->
    <script src="<?= base_url(); ?>/plugins/bower_components/peity/jquery.peity.min.js"></script>
    <script src="<?= base_url(); ?>/plugins/bower_components/peity/jquery.peity.init.js"></script>
    <script src="<?= base_url(); ?>/plugins/bower_components/tablesaw-master/dist/tablesaw.js"></script>
    <script src="<?= base_url(); ?>/plugins/bower_components/tablesaw-master/dist/tablesaw-init.js"></script>
    <!-- Sweet-Alert  -->
    <script src="<?= base_url(); ?>/plugins/bower_components/sweetalert/sweetalert.min.js"></script>
    <script src="<?= base_url(); ?>/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>
    <!-- <script src="<?= base_url(); ?>/js/sweetalert/sweetalert2.all.min.js"></script> -->
    <!-- <script src="<?= base_url(); ?>/js/sweetalert/jquery.slim.min.js"> -->

    </script>
    <script src="<?= base_url(); ?>/js/myscript.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?= base_url(); ?>/js/custom.min.js"></script>
    <script src="<?= base_url(); ?>/js/dashboard1.js"></script>
    <script src="<?= base_url(); ?>/plugins/bower_components/bootstrap-table/dist/bootstrap-table.min.js"></script>
    <script src="<?= base_url(); ?>/plugins/bower_components/bootstrap-table/dist/bootstrap-table.ints.js"></script>
    <!-- Footable -->
    <script src="<?= base_url(); ?>/plugins/bower_components/footable/js/footable.all.min.js"></script>
    <script src="<?= base_url(); ?>/plugins/bower_components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <!--FooTable init-->
    <script src="<?= base_url(); ?>/js/footable-init.js"></script>
    <!-- jQuery file upload -->
    <script src="<?= base_url(); ?>/plugins/bower_components/dropify/dist/js/dropify.min.js"></script>
    <script>
        $(document).ready(function() {
            // Basic
            $('.dropify').dropify();
            // Translated
            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-déposez un fichier ici ou cliquez',
                    replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                    remove: 'Supprimer',
                    error: 'Désolé, le fichier trop volumineux'
                }
            });
            // Used events
            var drEvent = $('#input-file-events').dropify();
            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });
            drEvent.on('dropify.afterClear', function(event, element) {
                alert('File deleted');
            });
            drEvent.on('dropify.errors', function(event, element) {
                console.log('Has Errors');
            });
            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function(e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })
        });
    </script>
    <!--Style Switcher -->
    <script src="<?= base_url(); ?>/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>