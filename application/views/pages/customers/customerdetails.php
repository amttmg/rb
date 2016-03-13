<script type="text/javascript">
    $(document).ready(function () {
        $("#btncardprint").click(function (e) {

        });
        $('#seemore').click(function () {

            $('#family_details').toggle("slow", function () {
                $('#families').empty();
                $.ajax({
                        url: '<?php echo(site_url("customerpriority/get_priority")) ?>',
                        type: 'POST',
                        data: {customer_id: '<?php echo($customer->customer_id) ?>'},
                        success: function (data) {
                            $('#priorites').html(data);
                        }
                    })
                    .fail(function () {
                        console.log("error");
                    })

                $.ajax({
                        url: '<?php echo(site_url("customer/customer_all_records")) ?>',
                        type: 'POST',
                        dataType: "json",
                        data: {customer_id: '<?php echo($customer->customer_id) ?>'},
                        success: function (data) {

                            $.each(data.families, function (index, val) {
                                var image = "<?php echo base_url('uploads/"+val.image_url+"'); ?>";
                                $('#families').append('<tr><td>' + val.name + '</td><td>' + val.address + '</td><td>' + val.phone1 + '</td><td>' + val.phone2 + '</td><td>' + val.relation + '</td><td><img height="30px" src="' + image + '"></td></tr>');
                            });

                        }
                    })
                    .fail(function () {
                        console.log("error");
                    })
            });

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
                <h3 class="box-title"></h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2">
                        <a href="<?php echo base_url('customer/customers') ?>" class="btn btn-danger btn-sm btn-block ">
                            <span class="glyphicon glyphicon-backward pull-left"></span> Back</a>
                        <?php if ($customer->status != 'verified') { ?>
                            <a class="btn-success btn btn-sm btn-block"
                               href="<?php echo(site_url('customer/verify/' . md5($customer->customer_id))) ?>"><i
                                    class="glyphicon glyphicon-ok"></i> Verify Customer</a>
                        <?php } ?>

                        <button class="btn-primary btn btn-sm btn-block pull-left" id="btnAddCard"><i
                                class="glyphicon glyphicon-credit-card pull-left"></i>
                            <?php if ($hascard) {
                                echo "Update Card";
                            } else {
                                echo "Add Card";
                            } ?>
                        </button>
                        <?php if ($hascard) {
                            ?>
                            <button class="btn-primary btn btn-sm btn-block pull-left" id="btncardprint"><i
                                    class="glyphicon glyphicon-print pull-left"></i> Print Card
                            </button>
                            <button class="btn-primary btn btn-sm btn-block pull-left" id="btncardhistory"><i
                                    class=" glyphicon glyphicon-folder-open pull-left"></i> Card History
                            </button>
                            <?php
                        } ?>


                        <button class="btn-primary btn btn-sm btn-block pull-left" id=""><i
                                class="glyphicon glyphicon-edit pull-left"></i> New Enquiry
                        </button>
                        <button class="btn-primary btn btn-sm btn-block pull-left" id=""><i
                                class="glyphicon glyphicon-folder-open pull-left"></i> Enquiry History
                        </button>
                        <button class="btn-primary btn btn-sm btn-block pull-left" id=""><i
                                class="glyphicon glyphicon-edit pull-left"></i> New Order
                        </button>
                        <button class="btn-primary btn btn-sm btn-block pull-left" id=""><i
                                class="glyphicon glyphicon-folder-open pull-left"></i> Order History
                        </button>


                    </div>
                    <div class="col-md-7">

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
                            <tr>
                                <td>
                                    Status
                                </td>
                                <td>
                                    <label class="label-success label"><i
                                            class="glyphicon glyphicon-ok"></i> <?php echo $customer->status ?></label>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <img class="image thumbnail"
                             src="<?php echo base_url('uploads/' . $customer->customer_image) ?>" height="200px">
                    </div>

                </div>
                <a href="#" id="seemore">See More</a>

                <div class="row" id="family_details" style="display: none">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Priorities</h3>

                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                            title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                                            title="Remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body" id="priorites" style="display: block;">


                            </div>
                            <!-- /.box-body -->
                        </div>
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Families</h3>

                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                            title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                                            title="Remove"><i class="fa fa-times"></i></button>
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
                            </div>
                            <!-- /.box-body -->
                        </div>

                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <!--                --><?php //if ($customer->status != 'verified') { ?>
                <!--                    <a class="btn-success btn btn-sm"-->
                <!--                       href="-->
                <?php //echo(site_url('customer/verify/' . md5($customer->customer_id))) ?><!--"><i-->
                <!--                            class="glyphicon glyphicon-ok"></i> Verify Customer</a>-->
                <!--                --><?php //} ?>
                <!--                <button class="btn-primary btn btn-sm" id="btnAddCard"><i class="glyphicon glyphicon-credit-card"></i> Add Card</button>-->
                <!--                <button class="btn-primary btn btn-sm" id="btncardprint"><i class="glyphicon glyphicon-credit-card"></i> Print Card</button>-->
                <!--            </div>-->
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->

<div class="modal fade" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" id="modaladdcard">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add Card</h4>
            </div>
            <?php echo form_open('card/addcard', array('id' => 'frmaddcard')); ?>
            <input type="hidden" name="customer_id" value="<?php echo $customer->customer_id ?>">

            <div class="modal-body">

                <div class="form-group">
                    <label for="">Please Swap Your Card</label>
                    <input required type="text" class="form-control" name="card_no" id="card_no"
                           placeholder="Card No" value="<?php echo(set_value('card_no')) ?>">
                    <?php echo(form_error('card_no')) ?>
                </div>
                <div class="form-group">
                    <label for="">Card Issue Date</label>
                    <input required type="date" class="form-control" name="added_date" id="added_date"
                           value="<?php echo(set_value('added_date')) ?>">
                    <?php echo(form_error('added_date')) ?>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>

            </div>
            <?php echo(form_close()) ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="cardhistory">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title">Card History</h4>
            </div>
            <div class="modal-body clearfix" id="printpage">
                <table class="table table-bordered">
                    <thead>
                    <td>
                        Card No
                    </td>
                    <td>
                        Issue date
                    </td>
                    <td>
                        Status
                    </td>
                    </thead>
                    <?php foreach ($cards as $card) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $card->card_no ?>
                            </td>
                            <td>
                                <?php echo $card->added_date ?>
                            </td>
                            <td>
                                <?php echo $card->status ?>
                            </td>
                        </tr>
                        <?php
                    } ?>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    $('#btnAddCard').click(function () {
        $('#modaladdcard').modal();
    })
    $('#frmaddcard').validate();
    $('#btncardprint').click(function () {
        window.open("<?php echo base_url('customer/printcard/'.$customer->customer_id) ?>", "_blank", " width=500, height=300");
    })
    $('#btncardhistory').click(function () {
        $('#cardhistory').modal('show');
    })


</script>
