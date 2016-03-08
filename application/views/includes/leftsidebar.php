<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->


        <!-- search form -->

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">

            <li class="treeview" style="padding-top: 10px; padding-bottom: 10px;">
                <img src="<?php echo base_url() ?>images/logo/logo.png" class="" alt="User Image" height="70px">
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Customers</span>

                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('customer') ?>"><i class="fa fa-plus"></i> New Customer
                        </a></li>
                    <li><a href="<?php echo base_url('customer/customers') ?>"><i class="fa fa-eye"></i> Customers
                        </a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-android"></i>
                    <span>Master</span>

                </a>
                <ul class="treeview-menu">
                    <li class="list"><a href="<?php echo base_url('customerpriority') ?>"><i class="fa fa-plus"></i>Customer
                            Priority</a></li>
                </ul>
            </li>

</aside>
<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url() ?>template/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?php echo base_url() ?>template/plugins/validation/jquery.validate.min.js"></script>
<script src="<?php echo base_url() ?>template/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>template/plugins/datatables/dataTables.bootstrap.min.js"></script>

