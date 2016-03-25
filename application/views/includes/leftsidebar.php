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
                    <?php if(checkaccess('customer/add')) { ?>
                    <li><a href="<?php echo base_url('customer/add') ?>"><i class="fa fa-user-plus"></i> New Customer </a></li>
                    <?php } ?>
                    <li><a href="<?php echo base_url('customer') ?>"><i class="fa fa-eye"></i> Customers </a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-external-link"></i>
                    <span>Enquiry</span>

                </a>
                <ul class="treeview-menu">
                    <li class="list"><a href="<?php echo base_url('enquiry/newEnquiry') ?>"><i class="fa fa-plus"></i>New Enquiry</a></li>
                    <li class="list"><a href="<?php echo base_url('enquiry') ?>"><i class="fa fa-eye"></i>View Enquiryes</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-android"></i>
                    <span>Master</span>
                </a>
                <ul class="treeview-menu">
                    <li class="list"><a href="<?php echo base_url('customerpriority') ?>"><i class="fa fa-info-circle"></i>Customer
                            Priority</a></li>
                    <li class="list"><a href="<?php echo base_url('metal') ?>"><i class="fa fa-info-circle"></i>Metal
                    </a></li>
                    <li class="list"><a href="<?php echo base_url('stone') ?>"><i class="fa fa-info-circle"></i>Stone
                    </a></li>
                    <li class="list"><a href="<?php echo base_url('category') ?>"><i class="fa fa-info-circle"></i>Product Category
                    </a></li>
                    <li class="list"><a href="<?php echo base_url('product') ?>"><i class="fa fa-info-circle"></i>Products
                    </a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-android"></i>
                    <span>User Management</span>

                </a>
                <ul class="treeview-menu">
                    <li class="list"><a href="<?php echo base_url('users') ?>"><i class="fa fa-user"></i>Users Management</a></li>
                    <li class="list"><a href="<?php echo base_url('users/group') ?>"><i class="fa fa-users"></i>Group Management</a></li>
                </ul>
            </li>


</aside>
<!--<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url() ?>template/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?php echo base_url() ?>template/plugins/validation/jquery.validate.min.js"></script>
<script src="<?php echo base_url() ?>template/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>template/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>template/plugins/imageview/jquery.magnific-popup.min.js"></script>
<script>
    $(document).ready(function() {
        $('.image-link').magnificPopup({type:'image'});
    });
</script>