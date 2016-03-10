<script type="text/javascript">
    $(document).ready(function() {
        $('#seemore').click(function() {
            $.ajax({
                url: '<?php echo(site_url("customer/customer_all_records")) ?>',
                type: 'POST',
                dataType: "json",
                data: {customer_id: '<?php echo($this->uri->segment(3)) ?>'},
                success:function (data) {
                        $('#family_details').show('slow', function() {
                            $.each(data, function(index, val) {
                                var image="<?php echo base_url('uploads/"+val.image_url+"'); ?>";
                                 $('#families').append('<tr><td>'+val.name+'</td><td>'+val.address+'</td><td>'+val.phone1+'</td><td>'+val.phone2+'</td><td>'+val.relation+'</td><td><img height="30px" src="'+image+'"></td></tr>');
                           });
                        });
                }
            })
            .fail(function() {
                console.log("error");
            })
        });
    });
</script>
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
                <a href="#" id="seemore">See More</a>
                <div class="row" id="family_details" style="display: none">
                    <div class="col-md-8">
                        <div class="box">
                            <div class="box-header with-border">
                              <h3 class="box-title">Families</h3>
                              <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                              </div>
                            </div>
                            <div class="box-body" style="display: block;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Phone 1</th>
                                            <th>Phone 2</th>
                                            <th>Relation</th>
                                            <th>Photo</th>
                                        </tr>
                                    </thead>
                                    <tbody id="families">
                                        
                                    </tbody>
                                </table>
                            </div><!-- /.box-body -->
                          </div>
                        
                    </div>
                </div>
                 
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <?php if($customer->status!='verified') {?>
                <a class="btn-success btn btn-sm" href="<?php echo(site_url('customer/verify/'.$customer->customer_id)) ?>"><i class="glyphicon glyphicon-ok"></i> Verify Customer</a>
               <?php } ?>
                <a class="btn-primary btn btn-sm" href="#"><i class="glyphicon glyphicon-credit-card"></i> Add Card</a>
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->