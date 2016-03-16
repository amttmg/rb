<script type="text/javascript">
    $(document).ready(function () {
        $("#btncardprint").click(function (e) {

        });
        var flip = 0;
        $('#seemore').click(function () {
            flip++;
            if (flip % 2 === 0) {
                $("html, body").animate({scrollTop: 0}, 1000);
                $('#seemore').html("See More <i class='glyphicon glyphicon-arrow-down'></i>");
            } else {
                $("html, body").animate({scrollTop: 400}, 1000);
                $('#seemore').html("Less <i class='glyphicon glyphicon-arrow-up'></i>");
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
            }
            $('#family_details').toggle("slow", function () {

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
                        <a href="<?php echo base_url('customer/customers') ?>"
                           class="btn btn-warning btn-sm btn-block ">
                            <span class="glyphicon glyphicon-backward pull-left"></span> Back</a>
                        <?php if ($customer->status != 'verified') { ?>
                            <a class="btn-success btn btn-sm btn-block"
                               onclick="return confirm('Are you sure want to verify this customer?')"
                               href="<?php echo(site_url('customer/verify/' . md5($customer->customer_id))) ?>"><i
                                    class="glyphicon glyphicon-ok pull-left"></i> Verify Customer</a>
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


                        <button class="btn-primary btn btn-sm btn-block pull-left" id="btnnewenq"><i
                                class="glyphicon glyphicon-edit pull-left"></i> New Enquiry
                        </button>
                        <button class="btn-primary btn btn-sm btn-block pull-left" id="btnenqhostory"><i
                                class="glyphicon glyphicon-folder-open pull-left"></i> Enquiry History
                        </button>
                        <!--                        <button class="btn-primary btn btn-sm btn-block pull-left" id=""><i-->
                        <!--                                class="glyphicon glyphicon-edit pull-left"></i> New Order-->
                        <!--                        </button>-->
                        <!--                        <button class="btn-primary btn btn-sm btn-block pull-left" id=""><i-->
                        <!--                                class="glyphicon glyphicon-folder-open pull-left"></i> Order History-->
                        <!--                        </button>-->


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
                <button class="btn btn-primary btn-xs" id="seemore">See More <i class="glyphicon glyphicon-arrow-down"></i></button>

                <div class="btn-group pull-right">

                    <a href="#" id="btneditcustomer" class=" btn btn-primary btn-sm"><i
                            class="glyphicon glyphicon-edit"></i> Edit</a>
                </div>

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
                                <button class="btn btn-primary btn-sm" id="btn_addfamily">Add New</button>
                                </br>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Phone 1</th>
                                        <th>Phone 2</th>
                                        <th>Relation</th>
                                        <th>Photo</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="families">
                                    <?php foreach ($customer_family as $family): ?>
                                        <tr>
                                            <td><?php echo $family->name; ?></td>
                                            <td><?php echo $family->address; ?></td>
                                            <td><?php echo $family->phone1; ?></td>
                                            <td><?php echo $family->phone2; ?></td>
                                            <td><?php echo $family->relation ?></td>
                                            <td><img src="<?php echo(base_url('uploads/' . $family->image_url)) ?> "
                                                     width="20px"></td>
                                            <td>
                                                <button class="btnFamilyEdit btn btn-primary"
                                                        data-familyid="<?php echo($family->id) ?>">Edit
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                    </tbody>

                                </table>
                                <script>
                                    $(".btnEditFamily").click(function (e) {
                                        alert('hello');
                                    })
                                </script>
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
            <input type="hidden" name="customer_id" id="customer_id" value="<?php echo $customer->customer_id ?>">
            <input type="hidden" name="md5_customer_id" id="md5_customer_id"
                   value="<?php echo(md5($customer->customer_id)); ?>">

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

<div class="modal fade" tabindex="-1" role="dialog" id="enqhistor">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h4 class="modal-title">Enquiry History</h4>
            </div>
            <div class="modal-body clearfix" id="printpage">
                <table class="table table-bordered">
                    <thead>
                    <td>
                        Date Time
                    </td>
                    <td>
                        Enquiry Type
                    </td>
                    <td>
                        Followup Date
                    </td>
                    <td>
                        Enquiry Items
                    </td>
                    <td>
                        Price Min
                    </td>
                    <td>
                        Price Max
                    </td>
                    </thead>
                    <?php foreach ($enquiry as $enq) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $enq->enquiry_date . ' ' . $enq->enquiry_time ?>
                            </td>
                            <td>
                                <?php echo $enq->enquiry_type ?>
                            </td>
                            <td>
                                <?php echo $enq->followup_date ?>
                            </td>
                            <td>
                                <?php echo $enq->enquiry_items ?>
                            </td>
                            <td>
                                <?php echo $enq->price_range_min ?>
                            </td>
                            <td>
                                <?php echo $enq->price_range_max ?>
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

<div class="modal fade" id="newEnquiry">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">New Enquery</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('enquiry/addEnquiry', array('id' => 'myform')); ?>
                <input type="hidden" name="customer_id" value="<?php echo $customer->customer_id ?>">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Enquiry Date</label>
                            <input
                                type="date" class="form-control" name="enquiry_date" id="enquiry_date"
                                placeholder="Enquiry date" value="<?php echo(set_value('enquiry_date')) ?>">
                            <span class="help-block"></span>
                            <?php echo(form_error('enquiry_date')) ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Enquiry Time</label>
                            <input type="time" class="form-control" name="enquiry_time" id="enquiry_time"
                                   placeholder="Enquiry Time" value="<?php echo(set_value('enquiry_time')) ?>">
                            <span class="help-block"></span>
                            <?php echo(form_error('enquiry_time')) ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Enquiry Type</label>
                            <select name="enquiry_type" id="enquiry_type" class="form-control">
                                <option value="">Select Enquiry Type</option>
                                <?php foreach ($enquiry_type as $type) {
                                    ?>
                                    <option
                                        value="<?php echo $type->enquirytype_id ?>"><?php echo $type->enquiry_type ?></option>
                                    <?php
                                } ?>
                            </select>
                            <!--                        <input required type="text" class="form-control" name="enquiry_type" id="enquiry_type"-->
                            <!--                               placeholder="Enquiry Type" value="-->
                            <?php //echo(set_value('enquiry_type')) ?><!--">-->
                            <span class="help-block"></span>
                            <?php echo(form_error('enquiry_type')) ?>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Followup Date</label>
                            <input required type="date" class="form-control" name="followup_date" id="followup_date"
                                   placeholder="Followup date" value="<?php echo(set_value('followup_date')) ?>">
                            <span class="help-block"></span>
                            <?php echo(form_error('followup_date')) ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Enquiry Items</label>
                            <input type="text" class="form-control" name="enquiry_items" id="enquiry_items"
                                   placeholder="Enquiry Items" value="<?php echo(set_value('enquiry_items')) ?>">
                            <span class="help-block"></span>
                            <?php echo(form_error('enquiry_items')) ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Intended Purchase Mode</label>
                            <select name="intended_purchasemode" class="form-control">
                                <option value="Cash">Cash</option>
                                <option value="Credit Card">Credit Card</option>
                            </select>
                            <span class="help-block"></span>
                            <?php echo(form_error('intended_purchasemode')) ?>
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Price Min</label>
                            <input required type="number" class="form-control" name="price_range_min"
                                   id="price_range_min"
                                   placeholder="Price Min" value="<?php echo(set_value('price_range_min')) ?>">
                            <span class="help-block"></span>
                            <?php echo(form_error('price_range_min')) ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Price Max</label>
                            <input required type="number" class="form-control" name="price_range_max"
                                   id="price_range_max"
                                   placeholder="Price Max" value="<?php echo(set_value('price_range_max')) ?>">
                            <span class="help-block"></span>
                            <?php echo(form_error('price_range_max')) ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Reference Image</label>
                            <input type="file" class="form-control" name="reference_img" id="reference_img"
                                   placeholder="Reference Image" value="<?php echo(set_value('reference_img')) ?>">
                            <span class="help-block"></span>
                            <?php echo(form_error('reference_img')) ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Remarks</label>
                            <input required type="text" class="form-control" name="remarks" id="remarks"
                                   placeholder="Remarks" value="<?php echo(set_value('remarks')) ?>">
                            <span class="help-block"></span>
                            <?php echo(form_error('remarks')) ?>
                        </div>
                    </div>


                </div>
                <?php echo(form_close()) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="save">Save changes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>

    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="editcustomer">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Customer Edit</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <?php echo form_open('customer/update', array('id' => 'customer_edit_form')); ?>
                        <input type="hidden" name="customer_id" id="update_customer">

                        <div class="form-group">
                            <label for="">First Name</label>
                            <input required type="name" tabindex="1" class="form-control" name="fname" id="fname"
                                   placeholder="first Name">
                            <span></span>
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <input required type="text" tabindex="4" class="form-control" name="address" id="address"
                                   placeholder="Address">
                            <span></span>
                        </div>
                        <div class="form-group">
                            <label for="">Phone 2</label>
                            <input type="text" tabindex="7" class="form-control" name="phone2" id="phone2"
                                   placeholder="Phone 2">
                            <span></span>
                        </div>
                        <div class="form-group">
                            <label>Marital Status</label><br/>
                            <label class="radio-inline">
                                <input type="radio" name="marital_status" tabindex="10" id="marital_status_yes"
                                       value="1">yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="marital_status" tabindex="11" id="marital_status_no"
                                       value="0">No
                            </label>
                            <span></span>
                        </div>


                    </div>
                    <!--col-lg-6 (left side form end)-->

                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><!--middle form started-->
                        <div class="form-group">
                            <label for="">Middle Name</label>
                            <input type="name" tabindex="15" class="form-control" name="mname" id="mname"
                                   placeholder="Middle Name ">
                            <span></span>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" tabindex="5" class="form-control" name="email" id="email"
                                   placeholder="Email">
                            <span></span>
                        </div>
                        <div class="form-group">
                            <label>Date of birth</label>
                            <input required type="date" tabindex="8" class="form-control" name="dob" id="dob"
                                   placeholder="date of birth">
                            <span></span>
                        </div>
                        <div class="form-group" id="aniversary_date">
                            <label>Aniversary Date</label>
                            <input type="date" class="form-control" name="anniversary_date" id="anniversary_date"
                                   placeholder="Aniversary Date">
                            <span></span>
                        </div>
                    </div>
                    <!-- middle form end -->

                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><!-- right form started -->
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input required type="name" tabindex="3" class="form-control" name="lname" id="lname"
                                   placeholder="Last Name" value="<?php echo(set_value('lname')) ?>">
                            <span></span>
                        </div>
                        <div class="form-group">
                            <label for="">Phone 1</label>
                            <input required type="text" tabindex="6" class="form-control" name="phone1" id="phone1"
                                   placeholder="Phone 1" value="<?php echo(set_value('phone1')) ?>">
                            <span></span>
                        </div>
                        <div class="form-group">
                            <label>Gender</label><br/>
                            <label class="radio-inline">
                                <input type="radio" tabindex="9" name="gender" id="male" value="male">Male
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="gender" id="female" value="female">Female
                            </label>

                        </div>
                        <?php echo form_close(); ?>
                    </div>
                    <!-- right form end -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_customer_edit">Save changes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="addfamily">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add new family member</h4>
            </div>
            <div class="modal-body">
                <?php echo(form_open_multipart('customer/add_new_family', array('id' => 'add_new_family_form'))) ?>
                <div class="form-group">
                    <label for="">name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                    <span></span>
                </div>
                <div class="form-group">
                    <label for="">address</label>
                    <input type="text" name="address" class="form-control" id="address" placeholder="address">
                    <span></span>
                </div>
                <div class="form-group">
                    <label for="">Phone 1</label>
                    <input type="text" name="phone1" class="form-control" id="phone1" placeholder="Phone 1">
                    <span></span>
                </div>
                <div class="form-group">
                    <label for="">Phone 2</label>
                    <input type="text" name="phone2" class="form-control" id="phone2" placeholder="Phone 2">
                    <span></span>
                </div>
                <div class="form-group">
                    <label for="">Relation</label>
                    <input type="text" name="relation" class="form-control" id="relation" placeholder="Relation">
                    <span></span>
                </div>
                <div class="form-group">
                    <label for="">Photo</label>
                    <input type="file" name="photo" id="photo">
                    <span></span>
                </div>

                <?php echo(form_close()) ?>
            </div>
            <div class="modal-footer">
                <span class="label label-success pull-left" style="display:none" id="message">New family member added successfully !</span>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn_save_family">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- modal for edit family member -->
<div class="modal fade" abindex="-1" role="dialog" id="edit_family">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Family Edit form</h4>
            </div>
            <div class="modal-body">
                <?php echo(form_open_multipart('family/update/' . $customer->customer_id, array('id' => 'family_edit_form'))) ?>
                <input type="hidden" name="family_id" id="family_id">

                <div class="form-group">
                    <label for="">Name</label>
                    <input type="name" name="faname" class="form-control" id="faname" placeholder="Name">
                    <span></span>
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <input type="text" name="faaddress" class="form-control" id="faaddress" placeholder="Address">
                    <span></span>
                </div>
                <div class="form-group">
                    <label for="">Phone 1</label>
                    <input type="number" name="faphone1" class="form-control" id="faphone1" placeholder="Phone 1">
                    <span></span>
                </div>
                <div class="form-group">
                    <label for="">Phone 2</label>
                    <input type="number" name="faphone2" class="form-control" id="faphone2" placeholder="Phone 2">
                    <span></span>
                </div>
                <div class="form-group">
                    <label for="">relation</label>
                    <input type="text" name="farelation" class="form-control" id="farelation" placeholder="Phone 2">
                    <span></span>
                </div>
                <div class="form-group">
                    <label for="">Photo</label>
                    <input type="file" name="faphoto" id="faphoto">
                    <span></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">update</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#marital_status_no').click(function () {
        $('#anniversary_date').val('');
        $('#aniversary_date').hide();
    });
    $('#marital_status_yes').click(function () {
        $('#aniversary_date').show();
    });

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
    $('#btnenqhostory').click(function () {
        $('#enqhistor').modal('show');
    })

    $('#btnnewenq').click(function () {
        $('#newEnquiry').modal('show');
    })
    $('#btneditcustomer').click(function () {

        var customer_id = $('#md5_customer_id').val();
        $.ajax({
            url: '<?php echo site_url("customer/get_customer"); ?>' + '/' + customer_id,
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data.marital_status == '1') {
                    $('#marital_status_yes').prop('checked', true);
                    $('#aniversary_date').show();
                }
                else {
                    $('#marital_status_no').prop('checked', true);
                    $('#aniversary_date').hide();
                }
                if (data.gender == 'male') {
                    $('#male').prop('checked', true);
                }
                else {
                    $('#female').prop('checked', true);
                }
                $.each(data, function (index, val) {
                    $('#' + index).val(val);


                });
            }
        })
            .done(function () {
                console.log("success");
            })
            .fail(function () {
                console.log("error");
            })
        $('#editcustomer').modal('show');
    })
    //it opens the modal for add family
    $('#btn_addfamily').click(function () {
        $('#addfamily').modal('show');
    });
    //it opens the modal for family edit
    $('.btnFamilyEdit').click(function () {
        var temp = $(this).data('familyid');
        $('#family_id').val(temp);
        $.ajax({
            url: '<?php  echo site_url("family/get_family/"); ?>' + '/' + temp,
            type: 'POST',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $.each(data[0], function (index, val) {
                    $('#fa' + index).val(val);
                });
            }
        })
            .fail(function () {
                console.log("error");
            });
        $('#edit_family').modal('show');
    });

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("input").change(function () {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("textarea").change(function () {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("select").change(function () {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        //thsi function is used for update customer

        $('#btn_customer_edit').click(function () {
            var formData1 = new FormData($('#customer_edit_form')[0]);
            $.ajax({
                url: '<?php  echo site_url("customer/update/"); ?>' + '/' + $('#customer_id').val(),
                type: 'POST',
                dataType: 'json',
                data: formData1,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {

                    if (data.status == false) {
                        $.each(data, function (index, val) {
                            $('#' + val.error_string).next().html(val.input_error);
                            $('#' + val.error_string).parent().parent().addClass('has-error');

                        });
                    }
                    else {
//                        window.location.replace("<?php //echo base_url('customer/customerdetails/'.md5($customer->customer_id)) ?>//");
                        location.reload();
                    }
                }
            })
                .fail(function () {
                    console.log("error");
                })

        });

        //this function is used for saving custmer enquiry
        $('#save').click(function () {
            var formData = new FormData($('#myform')[0]);
            $.ajax({
                url: '<?php  echo site_url("enquiry/addEnquiry"); ?>',
                type: 'POST',
                dataType: 'json',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.status == false) {
                        $.each(data, function (index, val) {

                            $('#' + val.error_string).next().html(val.input_error);
                            $('#' + val.error_string).parent().parent().addClass('has-error');


                        });
                    }
                    else {
//                        window.location.replace("<?php //echo base_url('customer/customerdetails/'.md5($customer->customer_id)) ?>//");
                        location.reload();
                    }
                }
            })
                .fail(function () {
                    console.log("error");
                })

        });

        //its calls ajax for save new family
        $('#btn_save_family').click(function (event) {

            var formData = new FormData($('#add_new_family_form')[0]);
            $.ajax({
                url: '<?php  echo site_url("customer/add_new_family/"); ?>' + '/' + $('#customer_id').val(),
                type: 'POST',
                dataType: 'json',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.status == false) {
                        $.each(data, function (index, val) {

                            $('#' + val.error_string).next().html(val.input_error);
                            $('#' + val.error_string).parent().parent().addClass('has-error');

                        });
                    }
                    else {
//                        window.location.replace("<?php //echo base_url('customer/customerdetails/'.md5($customer->customer_id)) ?>//");
                        $('#btn_save_family').prop('disable', true);
                        $('#message').show('fast', function () {
                            setTimeout(sample, 2000);
                        })
                        location.reload();
                    }
                }
            })
                .fail(function () {
                    console.log("error");
                })

        });
    });

</script>
