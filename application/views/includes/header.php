<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Customer Information- {title}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>template/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>template/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url() ?>template/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url() ?>template/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo base_url() ?>template/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url() ?>template/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url() ?>template/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url() ?>template/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url() ?>template/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url() ?>template/plugins/datatables/dataTables.bootstrap.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://localhost/rb/template/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url() ?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">CIS</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">Customer Information System</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
<!--                    <li class="dropdown notifications-menu">-->
<!--                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
<!--                          <i class="fa fa-bell-o"></i>-->
<!--                          <span class="label label-warning">10</span>-->
<!--                        </a>-->
<!--                        <ul class="dropdown-menu">-->
<!--                          <li class="header">You have 10 notifications</li>-->
<!--                          <li>-->
<!--                            <!-- inner menu: contains the actual data -->-->
<!--                            <ul class="menu">-->
<!--                                --><?php //if (pending_customer()): ?>
<!--                                    <li>-->
<!--                                        <a href="--><?php //echo(site_url('customer/pending_customers')) ?><!--">-->
<!--                                          <i class="fa fa-users text-aqua"></i>You have --><?php //echo(pending_customer()) ?><!-- pending customer.-->
<!--                                        </a>-->
<!--                                    </li>-->
<!--                                --><?php //endif ?>
<!--                              <li>-->
<!--                                <a href="#">-->
<!--                                  <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems-->
<!--                                </a>-->
<!--                              </li>-->
<!--                              <li>-->
<!--                                <a href="#">-->
<!--                                  <i class="fa fa-users text-red"></i> 5 new members joined-->
<!--                                </a>-->
<!--                              </li>-->
<!---->
<!--                              <li>-->
<!--                                <a href="#">-->
<!--                                  <i class="fa fa-shopping-cart text-green"></i> 25 sales made-->
<!--                                </a>-->
<!--                              </li>-->
<!--                              <li>-->
<!--                                <a href="#">-->
<!--                                  <i class="fa fa-user text-red"></i> You changed your username-->
<!--                                </a>-->
<!--                              </li>-->
<!--                            </ul>-->
<!--                          </li>-->
<!--                          <li class="footer"><a href="#">View all</a></li>-->
<!--                        </ul>-->
<!--                      </li>-->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo base_url() ?>template/dist/img/121.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php echo $this->session->userdata('username') ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="<?php echo base_url() ?>template/dist/img/121.jpg" class="img-circle" alt="User Image">
                                <p>
                                    Amrit Tamang - Software Developer
                                    <small>Member since Nov. 2012</small>
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?php echo base_url('welcome/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
