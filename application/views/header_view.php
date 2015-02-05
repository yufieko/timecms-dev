<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=$title;?> // timecms</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" href="<?= base_url(); ?>public/img/avatar_144bf176a04f_128.png">
    <link rel="apple-touch-icon-precomposed" href="<?= base_url(); ?>public/img/avatar_144bf176a04f_128.png">

    <link href="<?=base_url();?>public/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?=base_url();?>public/css/ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="<?=base_url();?>public/js/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="<?=base_url();?>public/js/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="<?=base_url();?>public/js/plugins/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Color Picker -->
    <link href="<?=base_url();?>public/js/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
    <!-- Bootstrap time Picker -->
    <link href="<?=base_url();?>public/js/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
    <!-- DATA TABLES -->
    <link href="<?=base_url();?>public/js/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?=base_url();?>public/js/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?=base_url();?>public/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>public/js/plugins/iCheck/all.css" rel="stylesheet" type="text/css" />

    <!-- javascript -->
    <!-- Pace 1.0.0 --
    <script src="js/plugins/pace/pace.js" type="text/javascript"></script-->

    <script src="<?=base_url();?>public/js/jquery.min.js"></script>
    <script src="<?=base_url();?>public/js/bootstrap.min.js" type="text/javascript"></script>
    
    <!-- DATA TABES SCRIPT -->
    <script src="<?=base_url();?>public/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="<?=base_url();?>public/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- InputMask -->
    <script src="<?=base_url();?>public/js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="<?=base_url();?>public/js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="<?=base_url();?>public/js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="<?=base_url();?>public/js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="<?=base_url();?>public/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="<?=base_url();?>public/js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- bootstrap time picker -->
    <script src="<?=base_url();?>public/js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?=base_url();?>public/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?=base_url();?>public/js/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="<?=base_url();?>public/js/plugins/chartjs/Chart.min.js" type="text/javascript"></script>
    <!-- CK Editor -->
    <script src="<?=base_url();?>public/js/plugins/ckeditor/ckeditor.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?=base_url();?>public/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="<?=base_url();?>public/js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="<?=base_url();?>public/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>public/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?=base_url();?>public/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>

    <!-- timecms -->
    <script src="<?=base_url();?>public/js/app.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>public/js/misc.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var value = "#li-" + window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
            //alert(value);
            $(value).addClass("active");
        });
    </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body class="fixed skin-blue">
    <div class="wrapper">
        <!-- header logo: style can be found in header.less -->
        <header class="main-header">
            <!-- Logo -->
            <a href="<?=base_url();?>dashboard" class="logo">
                <img src="<?=base_url();?>public/img/logo@2x.png" alt="timecms" style="width:70%;" />
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?=base_url();?>public/img/user-default.jpg" class="user-image" alt="User Image" />
                                <span class="hidden-xs"><?=$this->access->get_username();?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?=base_url();?>public/img/user-default.jpg" class="img-circle" alt="User Image" />
                                    <p>
                                        <?=$this->access->get_username();?>
                                        <small>sebagai <?=$this->access->get_role();?></small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?=base_url();?>dashboard/profil" class="btn btn-default btn-flat">Profil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?=base_url();?>dashboard/logout" class="btn btn-default btn-flat">Keluar</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?=base_url();?>public/img/user-default.jpg" class="img-circle" alt="User Image" />
                    </div>
                    <div class="pull-left info">
                        <p><?=$this->access->get_username();?></p>

                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <!-- search form -->
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search..." />
                        <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
                    </div>
                </form>
                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li class="header">MAIN NAVIGATION</li>
                    <li id="li-dashboard">
                        <a href="<?=base_url();?>dashboard">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <?php
                        if(!empty($menu)){
                            echo $menu;
                        }
                    ?>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
