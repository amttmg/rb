<!-- Content Wrapper. Contains page content -->
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
                                        <input type="radio" name="gender" id="male" value="male" checked="checked">Male
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" id="female" value="female">Female
                                    </label>
                                    
                                </div>
                                <div class="form-group">
                                    <label>Choose Image</label>
                                    <input type="file" name="photo">
                                    <?php echo(form_error('photo')); ?>
                                </div>
                                
                            
                        </div><!--col-lg-6 (left side form end)-->
                        
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><!--middle form started-->
                            <div class="form-group">
                                <label for="">Middle Name</label>
                                <input type="name" tabindex="2" class="form-control" name="mname" id="mname" placeholder="Middle Name " value="<?php echo(set_value('mname')) ?>">
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
                            <div class="form-group">
                                <label>Aniversary Date</label>
                                <input type="date" class="form-control" name="aniversary_date" id="aniversary_date" placeholder="Aniversary Date" value="<?php echo(set_value('aniversary_date')) ?>">
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
                            
                            <div class="form-group">
                                <label>Marital Status</label>
                                <label class="radio-inline">
                                    <input type="radio" name="marital_status" id="marital_status_yes" value="1" checked="">yes
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="marital_status" id="marital_status_no" value="0" checked="">No
                                </label>
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
            name: {
                required: true,
            },
            address: {
                required: true,
            },
            email: {
                required: true,
                email:true
            },
            phone1: {
                required: true
            },
            gender: {
                required: true
            }

        },
        message: {
            name: {
                required: "This field is required"
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
