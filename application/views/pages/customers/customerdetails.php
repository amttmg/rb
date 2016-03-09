<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Customer Details
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Customer</a></li>
            <li><a href="#">Customers</a></li>
            <li class="active">Customer Details</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
            <?php if ($this->session->flashdata('message')): ?>
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong><?php echo($this->session->flashdata('message')); ?></strong> 
                        </div>
                    <?php endif ?>
                <h3 class="box-title"><a href="<?php echo base_url('customer/customers') ?>"
                                         class="btn btn-primary btn-sm"> <span
                            class="glyphicon glyphicon-backward"></span> Back</a></h3>

            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    Full Name
                                </td>
                                <td>
                                    <?php echo $customer->fname . ' ' . $customer->mname . ' ' . $customer->lname ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Address
                                </td>
                                <td>
                                    <?php echo $customer->address ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Email
                                </td>
                                <td>
                                    <?php echo $customer->email ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Phone
                                </td>
                                <td>
                                    <?php echo $customer->phone1 ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Gender
                                </td>
                                <td>
                                    <?php echo $customer->gender ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Date of birth
                                </td>
                                <td>
                                    <?php echo $customer->dob ?>
                                </td>
                            </tr>
                            <?php if ($customer->marital_status) { ?>
                                <tr>
                                    <td>
                                        Anniversary Date
                                    </td>
                                    <td>
                                        <?php echo $customer->anniversary_date ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <img class="image thumbnail"
                             src="<?php echo base_url('uploads/' . $customer->customer_image) ?>" height="200px">
                    </div>
                </div>
                <a href="#">See More</a>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a class="btn-success btn btn-sm" href="<?php echo(site_url('customer/verify/'.$this->uri->segment(3))) ?>"><i class="glyphicon glyphicon-ok"></i> Verify Customer</a>
                <a class="btn-primary btn btn-sm" href="#"><i class="glyphicon glyphicon-credit-card"></i> Add Card</a>
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->