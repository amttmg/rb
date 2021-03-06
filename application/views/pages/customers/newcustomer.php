<!-- Content Wrapper. Contains page content -->
<script type="text/javascript" src="<?php echo(base_url('assets/jquery-ui.js')) ?>"></script>
<script type="text/javascript" src="<?php echo(base_url('assets/jquery-ui.css')) ?>"></script>
<!-- <script language="JavaScript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
 -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#aniversary_date').hide();
        $('#marital_status_yes').click(function () {
            $('#aniversary_date').show();
        });
        $('#marital_status_no').click(function () {
            $('#aniversary_text').val("");
            $('#aniversary_date').hide();
        });

        $(function () {
            $("#reference").autocomplete({
                source: '<?php echo site_url("customer/test"); ?>',
                select: function (event, ui) {
                    //alert(ui.item.label);
                    //$("#txtAllowSearch").val(); // display the selected text
                    $("#refered_id").val(ui.item.value); // save selected id to hidden input
                }
            }).autocomplete("widget").addClass("list-unstyled panel panel-primary cursor:pointer");
            ;
        });

    });
</script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            New Customer
            <small>all * fields are mandatory</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-info" style="position: relative;">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
                <i class="fa fa-user"></i>

                <h3 class="box-title">Create new Customer</h3>
                <?php if ($this->session->flashdata('message')): ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong><?php echo($this->session->flashdata('message')); ?></strong>
                    </div>
                <?php endif ?>
                <div class="pull-right box-tools">
                    <!--                    <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>-->
                </div>
                <!-- /. tools -->
            </div>
            <div class="box-body">
                <?php echo form_open_multipart('customer/add', array('id' => 'myform')); ?>
                <div class="row">

                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

                        <div class="form-group">
                            <label for="">First Name</label>
                            <input required type="name" tabindex="1" class="form-control" name="fname" id="fname"
                                   placeholder="first Name" value="<?php echo(set_value('fname')) ?>">
                            <?php echo(form_error('fname')) ?>
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <input required type="text" tabindex="4" class="form-control" name="address" id="address"
                                   placeholder="Address" value="<?php echo(set_value('address')) ?>">
                            <?php echo(form_error('address')) ?>
                        </div>
                        <div class="form-group">
                            <label for="">Phone 2</label>
                            <input type="text" tabindex="7" class="form-control" name="phone2" id="phone2"
                                   placeholder="Phone 2" value="<?php echo(set_value('phone2')) ?>">
                            <?php echo(form_error('phone2')) ?>
                        </div>
                        <div class="form-group">
                            <label for="">Customer Title</label>
                            <input type="text"  class="form-control" name="title" id="title"
                                   placeholder="Customer Title" value="<?php echo(set_value('title')) ?>">
                            <?php echo(form_error('title')) ?>
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <label class="radio-inline">
                                <input type="radio" tabindex="9" name="gender" id="male" value="male" checked="checked">Male
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="gender" id="female" value="female">Female
                            </label>

                        </div>
                        <div class="form-group">
                            <label>Marital Status</label>
                            <label class="radio-inline">
                                <input type="radio" name="marital_status" tabindex="10" id="marital_status_yes"
                                       value="1" checked="">yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="marital_status" tabindex="11" id="marital_status_no" value="0"
                                       checked="">single
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="marital_status" tabindex="10" id="divorced"
                                       value="2" >Divorced
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="marital_status" tabindex="10" id="divorced"
                                       value="3" >Married but single
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="marital_status" tabindex="10" id="seperated"
                                       value="4" >seperated
                            </label>

                        </div>
                        <div class="form-group">
                            <label>Choose Image</label>
                            <input  accept="image/gif, image/jpeg, image/png" id="src" type="file" name="photo" tabindex="12">
                            <?php echo(form_error('photo')); ?>
                        </div>
                        <script>
                            function showImage(src,target) {
                                var fr=new FileReader();
                                // when image is loaded, set the src of the image where you want to display it
                                fr.onload = function(e) { target.src = this.result; };
                                src.addEventListener("change",function() {
                                    // fill fr with image data
                                    fr.readAsDataURL(src.files[0]);
                                });
                            }

                            var src = document.getElementById("src");
                            var target = document.getElementById("snaped_image");
                            showImage(src,target);
                        </script>


                    </div>
                    <!--col-lg-6 (left side form end)-->

                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><!--middle form started-->
                        <div class="form-group">
                            <label for="">Middle Name</label>
                            <input type="name" tabindex="2" class="form-control" name="mname" id="mname"
                                   placeholder="Middle Name " value="<?php echo(set_value('mname')) ?>">
                            <?php echo(form_error('name')) ?>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" tabindex="5" class="form-control" name="email" id="email"
                                   placeholder="Email" value="<?php echo(set_value('email')) ?>">
                            <?php echo(form_error('email')) ?>
                        </div>
                        <div class="form-group">
                            <label>Date of birth</label>
                            <input required type="date" tabindex="8" class="form-control" name="dob" id="dob"
                                   placeholder="date of birth" value="<?php echo(set_value('dob')) ?>">
                            <?php echo(form_error('dob')) ?>
                        </div>
                        <div class="form-group">
                            <label for="">Company name</label>
                            <input type="text"  class="form-control" name="company" id="company"
                                   placeholder="Company Name" value="<?php echo(set_value('company')) ?>">
                            <?php echo(form_error('company')) ?>
                        </div>
                        <div class="form-group" id="aniversary_date">
                            <label>Aniversary Date</label>
                            <input type="date" class="form-control" name="aniversary_date" id="aniversary_text"
                                   placeholder="Aniversary Date" value="<?php echo(set_value('aniversary_date')) ?>">
                            <?php echo(form_error('aniversary_date')) ?>
                        </div>

                        <button type="button" id="snap" class="btn btn-info"><i class="glyphicon glyphicon-camera"></i>  Take Snap</button>
                        <h1></h1>
                        <img src="" id="snaped_image" height="150px">
                        <input type="hidden" id="snap_image_code" name="snap_image_code" value="" >
                        <h1></h1>
                    </div>
                    <!-- middle form end -->

                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><!-- right form started -->
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input required type="name" tabindex="3" class="form-control" name="lname" id="lname"
                                   placeholder="Last Name" value="<?php echo(set_value('lname')) ?>">
                            <?php echo(form_error('lname')) ?>
                        </div>
                        <div class="form-group">
                            <label for="">Phone 1</label>
                            <input required type="text" tabindex="6" class="form-control" name="phone1" id="phone1"
                                   placeholder="Phone 1" value="<?php echo(set_value('phone1')) ?>">
                            <?php echo(form_error('phone1')) ?>
                        </div>
                        <div class="form-group">
                            <label>Refered By</label>

                            <div class="radio">
                                <label>
                                    <input type="radio" name="customer_refer" id="inhouse" value="1" checked="">Inhouse
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="customer_refer" id="existing" value="0">Existing Customer
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="text" tabindex="9" class="form-control" name="reference"
                                       id="reference" placeholder="" value="<?php echo(set_value('reference')) ?>">
                            </div>
                            <input type="hidden" name="refered_id" id="refered_id">
                        </div>
                    </div>
                    <!-- right form end -->

                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <h2 class="box-title">Customer Priority</h2>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <?php $count = 1;
                                foreach ($priorities as $priority): ?><!-- foreach started for priorities -->

                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <label><?php echo($count) ?>
                                            ) <?php echo $priority['priority']->title; ?></label>
                                        <?php if ($priority['priority']->multichoice): ?><!-- check if priority is multichoice or not if yes then make chekbox else make radio -->
                                        <?php foreach ($priority['options'] as $option): ?>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="<?php echo($option->option_id); ?>"
                                                           name="<?php echo($priority['priority']->priority_id); ?>[]"><?php echo($option->option_title . '-' . $option->remarks); ?>
                                                </label>
                                            </div>
                                        <?php endforeach ?>
                                        <?php else: ?>
                                            <?php foreach ($priority['options'] as $option): ?><!-- foreach started for options -->
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio"
                                                               name="<?php echo $priority['priority']->priority_id; ?>"
                                                               id="optionsRadios1"
                                                               value="<?php echo($option->option_id); ?>"
                                                               checked=""><?php echo($option->option_title . '-' . $option->remarks); ?>
                                                    </label>
                                                </div>
                                            <?php endforeach ?><!-- foreach end of options -->
                                        <?php endif ?>
                                    </div>
                                </div>
                                <?php $count++; ?>
                                <?php endforeach ?><!-- foreach end of priorites -->
                            </div>
                            <!-- /.box-body -->
                        </div>


                    </div>
                    <!--end col-lg-12 of priorities and options-->
                </div>
                <div class="row1"><!-- customer family secton begins -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Customer Family details</h3>

                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                        title="Collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row"><!-- family first row start -->
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label for="">Name</label>

                                    <div class="form-group">
                                        <input  type="faname1" tabindex="20" class="form-control" name="faname1"
                                               id="faname1" placeholder="family name"
                                               value="<?php echo(set_value('faname1')) ?>">
                                        <?php echo(form_error('faname1')) ?>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label for="">Address</label>

                                    <div class="form-group">
                                        <input  type="faaddress1" tabindex="21" class="form-control"
                                               name="faaddress1" id="faaddress1" placeholder="address"
                                               value="<?php echo(set_value('faaddress1')) ?>">
                                        <?php echo(form_error('faaddress1')) ?>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label for="">Phone 1</label>

                                    <div class="form-group">
                                        <input  type="faphone1" tabindex="22" class="form-control"
                                               name="faphone1" id="faphone1" placeholder="phone 1"
                                               value="<?php echo(set_value('faphone1')) ?>">
                                        <?php echo(form_error('faphone1')) ?>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label for="">Phone 2</label>

                                    <div class="form-group">
                                        <input  type="faphone21" tabindex="23" class="form-control"
                                               name="faphone21" id="faphone21" placeholder="phone 2"
                                               value="<?php echo(set_value('faphone21')) ?>">
                                        <?php echo(form_error('faphone21')) ?>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label for="">relation</label>

                                    <div class="form-group">
                                        <input  type="farelation1" tabindex="24" class="form-control"
                                               name="farelation1" id="farelation1" placeholder="Relation"
                                               value="<?php echo(set_value('farelation1')) ?>">
                                        <?php echo(form_error('farelation1')) ?>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <label for="">Image</label>

                                    <div class="form-group">
                                        <input  type="file" name="faphoto1" tabindex="25">
                                        <?php echo(form_error('faphoto1')); ?>
                                    </div>
                                </div>
                            </div>
                            <!-- family first row end -->
                            <div class="row"><!-- family second row start -->
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <input  type="faname2" tabindex="26" class="form-control" name="faname2"
                                               id="faname2" placeholder="family name"
                                               value="<?php echo(set_value('faname2')) ?>">
                                        <?php echo(form_error('faname2')) ?>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <input  type="faaddress2" tabindex="27" class="form-control"
                                               name="faaddress2" id="faaddress2" placeholder="address"
                                               value="<?php echo(set_value('faaddress2')) ?>">
                                        <?php echo(form_error('faaddress2')) ?>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <input  type="faphone2" tabindex="28" class="form-control"
                                               name="faphone2" id="faphone2" placeholder="phone 1"
                                               value="<?php echo(set_value('faphone2')) ?>">
                                        <?php echo(form_error('faphone2')) ?>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <input  type="faphone22" tabindex="29" class="form-control"
                                               name="faphone22" id="faphone22" placeholder="phone 2"
                                               value="<?php echo(set_value('faphone22')) ?>">
                                        <?php echo(form_error('faphone22')) ?>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <input  type="farelation2" tabindex="30" class="form-control"
                                               name="farelation2" id="farelation2" placeholder="Relation"
                                               value="<?php echo(set_value('farelation2')) ?>">
                                        <?php echo(form_error('farelation2')) ?>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <input  type="file" name="faphoto2" tabindex="31">
                                        <?php echo(form_error('faphoto2')); ?>
                                    </div>
                                </div>
                            </div>
                            <!-- family second row end -->
                            <div class="row"><!-- family third row start -->
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <input  type="faname3" tabindex="32" class="form-control" name="faname3"
                                               id="faname3" placeholder="family name"
                                               value="<?php echo(set_value('faname3')) ?>">
                                        <?php echo(form_error('faname3')) ?>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <input  type="faaddress3" tabindex="33" class="form-control"
                                               name="faaddress3" id="faaddress3" placeholder="address"
                                               value="<?php echo(set_value('faaddress3')) ?>">
                                        <?php echo(form_error('faaddress3')) ?>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <input  type="faphone3" tabindex="34" class="form-control"
                                               name="faphone3" id="faphone3" placeholder="phone 1"
                                               value="<?php echo(set_value('faphone3')) ?>">
                                        <?php echo(form_error('faphone3')) ?>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <input  type="faphone23" tabindex="35" class="form-control"
                                               name="faphone23" id="faphone23" placeholder="phone 2"
                                               value="<?php echo(set_value('faphone23')) ?>">
                                        <?php echo(form_error('faphone23')) ?>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <input  type="farelation3" tabindex="36" class="form-control"
                                               name="farelation3" id="farelation3" placeholder="Relation"
                                               value="<?php echo(set_value('farelation3')) ?>">
                                        <?php echo(form_error('farelation3')) ?>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <input  type="file" name="faphoto3" tabindex="37">
                                        <?php echo(form_error('faphoto3')); ?>
                                    </div>
                                </div>
                            </div>
                            <!-- family third row end -->
                            <div class="row"><!-- family fourth row start -->
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <input  type="faname4" tabindex="38" class="form-control" name="faname4"
                                               id="faname4" placeholder="family name"
                                               value="<?php echo(set_value('faname4')) ?>">
                                        <?php echo(form_error('faname4')) ?>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <input  type="faaddress4" tabindex="39" class="form-control"
                                               name="faaddress4" id="faaddress4" placeholder="address"
                                               value="<?php echo(set_value('faaddress4')) ?>">
                                        <?php echo(form_error('faaddress4')) ?>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <input  type="faphone4" tabindex="40" class="form-control"
                                               name="faphone4" id="faphone4" placeholder="phone 1"
                                               value="<?php echo(set_value('faphone4')) ?>">
                                        <?php echo(form_error('faphone4')) ?>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <input  type="faphone24" tabindex="41" class="form-control"
                                               name="faphone24" id="faphone24" placeholder="phone 2"
                                               value="<?php echo(set_value('faphone24')) ?>">
                                        <?php echo(form_error('faphone24')) ?>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <input  type="farelation4" tabindex="42" class="form-control"
                                               name="farelation4" id="farelation4" placeholder="Relation"
                                               value="<?php echo(set_value('farelation4')) ?>">
                                        <?php echo(form_error('farelation4')) ?>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <input  type="file" name="faphoto4" tabindex="43">
                                        <?php echo(form_error('faphoto4')); ?>
                                    </div>
                                </div>
                            </div>
                            <!-- family fourth row end -->
                            <div class="row">
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <input  type="faname5" tabindex="44" class="form-control" name="faname5"
                                               id="faname5" placeholder="family name"
                                               value="<?php echo(set_value('faname5')) ?>">
                                        <?php echo(form_error('faname5')) ?>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <input  type="faaddress5" tabindex="45" class="form-control"
                                               name="faaddress5" id="faaddress5" placeholder="address"
                                               value="<?php echo(set_value('faaddress5')) ?>">
                                        <?php echo(form_error('faaddress5')) ?>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <input  type="faphone5" tabindex="46" class="form-control"
                                               name="faphone5" id="faphone5" placeholder="phone 1"
                                               value="<?php echo(set_value('faphone5')) ?>">
                                        <?php echo(form_error('faphone5')) ?>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <input  type="faphone25" tabindex="47" class="form-control"
                                               name="faphone25" id="faphone25" placeholder="phone 2"
                                               value="<?php echo(set_value('faphone25')) ?>">
                                        <?php echo(form_error('faphone25')) ?>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <input  type="farelation5" tabindex="48" class="form-control"
                                               name="farelation5" id="farelation5" placeholder="Relation"
                                               value="<?php echo(set_value('farelation5')) ?>">
                                        <?php echo(form_error('farelation5')) ?>
                                    </div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <input  type="file" name="faphoto5" tabindex="49">
                                        <?php echo(form_error('faphoto5')); ?>
                                    </div>
                                </div>
                            </div>
                            <?php echo $this->session->userdata('customer_id'); ?>
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- customer family secton ends -->

                    <button type="submit" class="btn btn-primary pull-right">Submit</button>

                </div>
                <?php echo(form_close()) ?>
            </div>
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->

<div class="modal fade" id="modal-snap">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-camera fa-3x text-green"></i></h4>
            </div>
            <div class="modal-body">
            <div class="row">
                    <div style="width:330px;float:left;">
                    
                        <div style="margin:5px;">
                            <img src="<?php echo(base_url('template/plugins/cam')) ?>/webcamlogo.png" style="vertical-align:text-top"/>
                            <select id="cameraNames" size="1" onChange="changeCamera()" style="width:245px;font-size:10px;height:25px;">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <input type="hidden" id="temp_code">
                        <div id="webcam">
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="pull-right">
                            <p><img id="image" style="width:200px;height:153px;"/></p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div style="width:135px;float:left;">
                        <p><button class="btn btn-small btn-primary" id="take_snap" onclick="base64_toimage()"><i class="glyphicon glyphicon-camera"></i> Take Snap</button></p>
                        </div>
                    </div>
                </div>
                
                
            </div>
            <div class="modal-footer">
                <button type="button" id="snap_ok" class="btn btn-primary">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




        <script language="JavaScript" src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
        
        <script language="JavaScript"> 

            
            

            $(document).ready(function() {

                $('#snap_ok').click(function() {
                   /*$('#snap_image_code').val($.scriptcam.getFrameAsBase64());*/
                   $('#snap_image_code').val($('#temp_code').val());
                   $('#modal-snap').modal('hide');
                  /* $('#snaped_image').attr("src","data:image/png;base64,"+$.scriptcam.getFrameAsBase64());*/
                  var img=$('#image').attr('src');
                  $('#snaped_image').attr('src', img);
                  
                });

                $("#webcam").scriptcam({
                    showMicrophoneErrors:false,
                    onError:onError,
                    cornerRadius:20,
                    cornerColor:'e3e5e2',
                    onWebcamReady:onWebcamReady,
                    path:'<?php echo(base_url("template/plugins/cam/")) ?>/',
                    uploadImage:'upload.gif',
                    onPictureAsBase64:base64_tofield_and_image
                });
            });
            var temp_code;
            function base64_tofield() {
                $('#formfield').val($.scriptcam.getFrameAsBase64());
            };
            function base64_toimage() {
                $('#image').attr("src","data:image/png;base64,"+$.scriptcam.getFrameAsBase64());
                /*temp_code=$.scriptcam.getFrameAsBase64();*/
                $('#temp_code').val($.scriptcam.getFrameAsBase64());

            };
            
            function base64_tofield_and_image(b64) {
                $('#formfield').val(b64);
                $('#image').attr("src","data:image/png;base64,"+b64);
            };
            function changeCamera() {
                $.scriptcam.changeCamera($('#cameraNames').val());
            }
            function onError(errorId,errorMsg) {
                $( "#btn1" ).attr( "disabled", true );
                $( "#take_snap" ).attr( "disabled", true );
                alert(errorMsg);
            }           
            function onWebcamReady(cameraNames,camera,microphoneNames,microphone,volume) {
                $.each(cameraNames, function(index, text) {
                    $('#cameraNames').append( $('<option></option>').val(index).html(text) )
                }); 
                $('#cameraNames').val(camera);
            }
        </script> 
   


<script type="text/javascript">
    $(document).ready(function() {
        $('#snap').click(function() {
           $('#modal-snap').modal('show');
        });
    });
</script>
