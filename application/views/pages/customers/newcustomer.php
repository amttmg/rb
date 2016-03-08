<!-- Content Wrapper. Contains page content -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#aniversary_date').hide();
        $('#marital_status_yes').click(function() {
             $('#aniversary_date').show();
        });
         $('#marital_status_no').click(function() {
            $('#aniversary_text').val("");
            $('#aniversary_date').hide();
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
                    </div><!-- /. tools -->
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <?php echo form_open_multipart('customer/add',array('id'=>'myform')); ?>
                                <div class="form-group">
                                    <label for="">First Name</label>
                                    <input required type="name" tabindex="1" class="form-control" name="fname" id="fname" placeholder="first Name" value="<?php echo(set_value('fname')) ?>">
                                    <?php echo(form_error('fname')) ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input required type="text" tabindex="4" class="form-control" name="address" id="address" placeholder="Address" value="<?php echo(set_value('address')) ?>">
                                     <?php echo(form_error('address')) ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Phone 2</label>
                                    <input type="text" tabindex="7" class="form-control" name="phone2" id="phone2" placeholder="Phone 2" value="<?php echo(set_value('phone2')) ?>">
                                    <?php echo(form_error('phone2')) ?>
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
                                        <input type="radio" name="marital_status" tabindex="10" id="marital_status_yes" value="1" checked="">yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="marital_status" tabindex="11" id="marital_status_no" value="0" checked="">No
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Choose Image</label>
                                    <input type="file" name="photo" tabindex="12">
                                    <?php echo(form_error('photo')); ?>
                                </div>
                                
                            
                        </div><!--col-lg-6 (left side form end)-->
                        
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><!--middle form started-->
                            <div class="form-group">
                                <label for="">Middle Name</label>
                                <input type="name" tabindex="15" class="form-control" name="mname" id="mname" placeholder="Middle Name " value="<?php echo(set_value('mname')) ?>">
                                <?php echo(form_error('name')) ?>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" tabindex="5" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo(set_value('email')) ?>">
                                <?php echo(form_error('email')) ?>
                            </div>
                            <div class="form-group">
                                <label>Date of birth</label>
                                <input required type="date" tabindex="8" class="form-control" name="dob" id="dob" placeholder="date of birth" value="<?php echo(set_value('dob')) ?>">
                                <?php echo(form_error('dob')) ?>
                            </div>
                            <div class="form-group" id="aniversary_date">
                                <label>Aniversary Date</label>
                                <input type="date" class="form-control" name="aniversary_date" id="aniversary_text" placeholder="Aniversary Date" value="<?php echo(set_value('aniversary_date')) ?>">
                                <?php echo(form_error('aniversary_date')) ?>
                            </div>
                        </div><!-- middle form end -->

                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><!-- right form started -->
                            <div class="form-group">
                                <label for="">Last Name</label>
                                <input required type="name" tabindex="3" class="form-control" name="lname" id="lname" placeholder="Last Name" value="<?php echo(set_value('lname')) ?>">
                                <?php echo(form_error('lname')) ?>
                            </div>
                            <div class="form-group">
                                <label for="">Phone 1</label>
                                <input required type="text" tabindex="6" class="form-control" name="phone1" id="phone1" placeholder="Phone 1" value="<?php echo(set_value('phone1')) ?>">
                                <?php echo(form_error('phone1')) ?>
                            </div>
                            
                        </div><!-- right form end -->
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="box box-default">
                                <div class="box-header with-border">
                                  <h2 class="box-title">Customer Priority</h2>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                <?php $count=1; foreach ($priorities as $priority): ?><!-- foreach started for priorities -->

                                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                                <div class="form-group">
                                                <label><?php echo($count) ?>) <?php echo $priority['priority']->title; ?></label>
                                                <?php if ($priority['priority']->multichoice): ?><!-- check if priority is multichoice or not if yes then make chekbox else make radio -->
                                                    <?php foreach ($priority['options'] as $option): ?>
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" value="<?php echo($option->option_id); ?>" name="<?php echo($priority['priority']->priority_id); ?>[]"><?php echo($option->option_title); ?>
                                                            </label>
                                                        </div>
                                                    <?php endforeach ?>
                                                <?php else: ?>
                                                    <?php foreach ($priority['options'] as $option): ?><!-- foreach started for options -->
                                                       <div class="radio">
                                                            <label>
                                                                <input type="radio" name="<?php echo $priority['priority']->priority_id;  ?>" id="optionsRadios1" value="<?php echo($option->option_id); ?>" checked=""><?php echo($option->option_title); ?>
                                                            </label>
                                                        </div>
                                                    <?php endforeach ?><!-- foreach end of options -->
                                                <?php endif ?>   
                                            </div>
                                            </div>
                                        <?php $count++; ?>
                                <?php endforeach ?><!-- foreach end of priorites -->
                                </div><!-- /.box-body -->
                              </div>
                           
                            
                        </div><!--end col-lg-12 of priorities and options-->
                    </div>

                    <div class="row"><!-- customer family secton begins -->
                        <div class="box">
                              <div class="box-header with-border">
                                <h3 class="box-title">Customer Family details</h3>
                                <div class="box-tools pull-right">
                                  <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                </div>
                              </div>
                              <div class="box-body">
                                     <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                         <label for="">Name</label>
                                         <div class="form-group">
                                            <input required type="faname1" tabindex="20" class="form-control" name="faname1" id="faname1" placeholder="family name" value="<?php echo(set_value('faname1')) ?>">
                                            <?php echo(form_error('faname1')) ?>
                                        </div>
                                        <div class="form-group">
                                            <input required type="faname2" tabindex="26" class="form-control" name="faname2" id="faname2" placeholder="faname2" value="<?php echo(set_value('faname2')) ?>">
                                            <?php echo(form_error('faname2')) ?>
                                        </div>
                                        <div class="form-group">
                                            <input required type="faname3" tabindex="32" class="form-control" name="faname3" id="faname3" placeholder="faname3" value="<?php echo(set_value('faname3')) ?>">
                                            <?php echo(form_error('faname3')) ?>
                                        </div>
                                        <div class="form-group">
                                            <input required type="faname4" tabindex="38" class="form-control" name="faname4" id="faname4" placeholder="faname4" value="<?php echo(set_value('faname4')) ?>">
                                            <?php echo(form_error('faname4')) ?>
                                        </div>
                                        <div class="form-group">
                                            <input required type="faname5" tabindex="44" class="form-control" name="faname5" id="faname5" placeholder="faname5" value="<?php echo(set_value('faname5')) ?>">
                                            <?php echo(form_error('faname5')) ?>
                                        </div>
                                     </div>
                                     <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                         <label for="">Address</label>
                                         <div class="form-group">
                                            <input required type="faaddress1" tabindex="21" class="form-control" name="faaddress1" id="faaddress1" placeholder="faname4" value="<?php echo(set_value('faaddress1')) ?>">
                                            <?php echo(form_error('faaddress1')) ?>
                                        </div>
                                        <div class="form-group">
                                            <input required type="faaddress1" tabindex="27" class="form-control" name="faaddress1" id="faaddress1" placeholder="faname4" value="<?php echo(set_value('faaddress1')) ?>">
                                            <?php echo(form_error('faaddress1')) ?>
                                        </div>
                                        <div class="form-group">
                                            <input required type="faaddress1" tabindex="33" class="form-control" name="faaddress1" id="faaddress1" placeholder="faname4" value="<?php echo(set_value('faaddress1')) ?>">
                                            <?php echo(form_error('faaddress1')) ?>
                                        </div>
                                        <div class="form-group">
                                            <input required type="faaddress1" tabindex="39" class="form-control" name="faaddress1" id="faaddress1" placeholder="faname4" value="<?php echo(set_value('faaddress1')) ?>">
                                            <?php echo(form_error('faaddress1')) ?>
                                        </div>
                                        <div class="form-group">
                                            <input required type="faaddress1" tabindex="45" class="form-control" name="faaddress1" id="faaddress1" placeholder="faname4" value="<?php echo(set_value('faaddress1')) ?>">
                                            <?php echo(form_error('faaddress1')) ?>
                                        </div>
                                     </div>
                                     <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                         <label for="">Phone 1</label>
                                         <div class="form-group">
                                            <input required type="faphone1" tabindex="22" class="form-control" name="faphone1" id="faphone1" placeholder="faname4" value="<?php echo(set_value('faphone1')) ?>">
                                            <?php echo(form_error('faphone1')) ?>
                                        </div>
                                        <div class="form-group">
                                            <input required type="faphone1" tabindex="28" class="form-control" name="faphone1" id="faphone1" placeholder="faname4" value="<?php echo(set_value('faphone1')) ?>">
                                            <?php echo(form_error('faphone1')) ?>
                                        </div>
                                        <div class="form-group">
                                            <input required type="faphone1" tabindex="34" class="form-control" name="faphone1" id="faphone1" placeholder="faname4" value="<?php echo(set_value('faphone1')) ?>">
                                            <?php echo(form_error('faphone1')) ?>
                                        </div>
                                        <div class="form-group">
                                            <input required type="faphone1" tabindex="40" class="form-control" name="faphone1" id="faphone1" placeholder="faname4" value="<?php echo(set_value('faphone1')) ?>">
                                            <?php echo(form_error('faphone1')) ?>
                                        </div>
                                        <div class="form-group">
                                            <input required type="faphone1" tabindex="46" class="form-control" name="faphone1" id="faphone1" placeholder="faname4" value="<?php echo(set_value('faphone1')) ?>">
                                            <?php echo(form_error('faphone1')) ?>
                                        </div>
                                     </div>
                                     <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                         <label for="">Phone 2</label>
                                         <div class="form-group">
                                            <input required type="faphone2" tabindex="23" class="form-control" name="faphone2" id="faphone2" placeholder="faname4" value="<?php echo(set_value('faphone2')) ?>">
                                            <?php echo(form_error('faphone2')) ?>
                                        </div>
                                         <div class="form-group">
                                            <input required type="faphone2" tabindex="29" class="form-control" name="faphone2" id="faphone2" placeholder="faname4" value="<?php echo(set_value('faphone2')) ?>">
                                            <?php echo(form_error('faphone2')) ?>
                                        </div>
                                         <div class="form-group">
                                            <input required type="faphone2" tabindex="35" class="form-control" name="faphone2" id="faphone2" placeholder="faname4" value="<?php echo(set_value('faphone2')) ?>">
                                            <?php echo(form_error('faphone2')) ?>
                                        </div>
                                         <div class="form-group">
                                            <input required type="faphone2" tabindex="41" class="form-control" name="faphone2" id="faphone2" placeholder="faname4" value="<?php echo(set_value('faphone2')) ?>">
                                            <?php echo(form_error('faphone2')) ?>
                                        </div>
                                         <div class="form-group">
                                            <input required type="faphone2" tabindex="47" class="form-control" name="faphone2" id="faphone2" placeholder="faname4" value="<?php echo(set_value('faphone2')) ?>">
                                            <?php echo(form_error('faphone2')) ?>
                                        </div>
                                     </div>
                                     <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                         <label for="">relation</label>
                                         <div class="form-group">
                                            <input required type="farelation1" tabindex="24" class="form-control" name="farelation1" id="farelation1" placeholder="faname4" value="<?php echo(set_value('farelation1')) ?>">
                                            <?php echo(form_error('farelation1')) ?>
                                        </div>
                                        <div class="form-group">
                                            <input required type="farelation1" tabindex="30" class="form-control" name="farelation1" id="farelation1" placeholder="faname4" value="<?php echo(set_value('farelation1')) ?>">
                                            <?php echo(form_error('farelation1')) ?>
                                        </div>
                                        <div class="form-group">
                                            <input required type="farelation1" tabindex="36" class="form-control" name="farelation1" id="farelation1" placeholder="faname4" value="<?php echo(set_value('farelation1')) ?>">
                                            <?php echo(form_error('farelation1')) ?>
                                        </div>
                                        <div class="form-group">
                                            <input required type="farelation1" tabindex="42" class="form-control" name="farelation1" id="farelation1" placeholder="faname4" value="<?php echo(set_value('farelation1')) ?>">
                                            <?php echo(form_error('farelation1')) ?>
                                        </div>
                                        <div class="form-group">
                                            <input required type="farelation1" tabindex="48" class="form-control" name="farelation1" id="farelation1" placeholder="faname4" value="<?php echo(set_value('farelation1')) ?>">
                                            <?php echo(form_error('farelation1')) ?>
                                        </div>
                                     </div>
                                     <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                         <label for="">Image</label>
                                         <div class="form-group">
                                            <input required type="file" name="photo1" tabindex="25">
                                            <?php echo(form_error('photo1')); ?>
                                        </div>
                                        <div class="form-group">
                                            <input required type="file" name="photo1" tabindex="31">
                                            <?php echo(form_error('photo1')); ?>
                                        </div>
                                        <div class="form-group">
                                            <input required type="file" name="photo1" tabindex="37">
                                            <?php echo(form_error('photo1')); ?>
                                        </div>
                                        <div class="form-group">
                                            <input required type="file" name="photo1" tabindex="43">
                                            <?php echo(form_error('photo1')); ?>
                                        </div>
                                        <div class="form-group">
                                            <input required type="file" name="photo1" tabindex="49">
                                            <?php echo(form_error('photo1')); ?>
                                        </div>
                                     </div>
                                <?php echo $this->session->userdata('customer_id'); ?>
                            </div><!-- /.box -->
                    </div><!-- customer family secton ends -->
                    
                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                    <?php echo(form_close()) ?>
                </div>
            </div>
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->
<script type="text/javascript">
    
    $('#myform').validate({
        rules: {
            fname: {
                required: true,
            },
            lname: {
                required: true,
            },
             address: {
                required: true,
            },
            email: {
                required: true,
            },
            phone1: {
                required: true
            },
            gender: {
                required: true
            }

        },
        message: {
            fname: {
                required: "This field is required"
            },
            lname: {
                required: "This field is required",
            },
            address: {
                required: "This field is required",
            },
            email: {
                required: "This field is required"
            },
            phone1: {
                required: "This field is required"
            },
            gender: {
                required: "This field is required"
            }
        },

        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    })
</script>
