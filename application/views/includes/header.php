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
    <link rel="stylesheet" type="text/css" href="<?php echo(base_url('template\plugins\imageview/magnific-popup.css')) ?>">
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
<!--                            <!-- inner menu: contains the actual data -->
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
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <i class="fa fa-bell-o"></i>
                          <?php 
                          $order_notification=order_reminder();
                          $count=count($order_notification);
                           ?>
                          <span class="label label-warning"><?php echo($count) ?></span>
                        </a>
                        <ul class="dropdown-menu">
                          <li class="header">You have <?php echo($count) ?> notifications</li>
                          <li>
                            <!-- inner menu: contains the actual data -->
                            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">
                            
                              <?php foreach ($order_notification as  $order): ?>
                                  <li>
                                    <a href="#" data-orderid="<?php  echo($order->order_id) ?>" class="order_notification">
                                     <?php echo($order->fname.' '.$order->mname.' '.$order->lname) ?>(deadline date <?php echo($order->deadline_date) ?>)
                                    </a>
                                  </li>
                              <?php endforeach ?>
                            </ul><div class="slimScrollBar" style="width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; background: rgb(0, 0, 0);"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div></div>
                          </li>
                          <li class="footer"><a href="#">View all</a></li>
                        </ul>
                      </li>
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo base_url() ?>template/dist/img/121.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php
                                $user=($this->ion_auth->user()->row());
                                echo $user->username;
                                 ?></span>
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

    <div class="modal fade" id="modal-order-notification">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Order Notification</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <a class="btn btn-default" href="" id="on_progress" role="button">View Progress</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <form id="order_notification_form">
                                <div class="form-group">
                                    <label for="">Remind me after</label>
                                    <select name="days" id="days" class="form-control" required="required">
                                        <option value="+1 days" >1 days</option>
                                        <option value="+2 days">2 days</option>
                                        <option value="+3 days">3 days</option>
                                        <option value="+4 days">4 days</option>
                                        <option value="+5 days">5 days</option>
                                    </select>
                                </div>
                            </form>
                           
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            
                        </div>

                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" id="ok" class="btn btn-default">Ok</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
