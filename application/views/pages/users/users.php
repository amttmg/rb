
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Users Management
            <small>it all starts here</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">User Management</a></li>
            <li class="active">Group Management</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <button class="btn btn-primary btn-sm" id="btnnewuser"><i class="fa fa-plus"></i> New User</button>

                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i
                            class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i
                            class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <?php if ($this->session->flashdata('message')): ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong><?php echo($this->session->flashdata('message')); ?></strong>
                    </div>
                <?php endif ?>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>
                            SN
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            UserName
                        </th>
                        <th>
                            Phone
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Group
                        </th>
                        <th>
                            Created On
                        </th>
                        <th>
                            Last Login
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $count = 1;
                    foreach ($users as $user) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $count;
                                $count++ ?>
                            </td>
                            <td>
                                <?php echo $user->first_name . ' ' . $user->last_name ?>
                            </td>
                            <td>
                                <?php echo $user->username ?>
                            </td>
                            <td>
                                <?php echo $user->phone ?>
                            </td>
                            <td>
                                <?php echo $user->email ?>
                            </td>
                            <td>
                                <?php echo($this->ion_auth->get_users_groups($user->id)->row()->name); ?>
                            </td>

                            <td>
                                <?php echo unix_to_human($user->created_on) ?>
                            </td>
                            <td>
                                <?php echo unix_to_human($user->last_login) ?>
                            </td>
                            <td>
                                <?php echo ($user->active == 1) ? 'Actve' : 'Inactive' ?>
                            </td>
                            <td>
                                <a href="#" class="btnuseredit" data-userid="<?php echo $user->id ?>"><label
                                        class="label label-primary">Edit</label></a>
                                <a href="#" class="btnuserdisable" data-userid="<?php echo $user->id ?>"><label
                                        class="label label-warning">Disable</label></a>
                            </td>
                        </tr>
                        <?php
                    } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">

            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->

<div class="modal fade" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" id='modalnewuser'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">New Users</h4>
            </div>

            <div class="modal-body">

                <?php echo form_open('users/createUser', array('id' => 'frmnewuser')) ?>
                <div class="form-group">
                    <label class="control-label" for="first_name">First Name</label>

                    <div>
                        <input required type="text" name="first_name" id="first_name" class="form-control">
                        <span></span>
                    </div>

                </div>
                <div class="form-group">
                    <label>Last Name</label>

                    <div>
                        <input required type="text" name="last_name" id="last_name" class="form-control">
                        <span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label>Username</label>

                    <div>
                        <input required type="text" name="identity" id="identity" class="form-control">
                        <span></span>
                    </div>

                </div>
                <div class="form-group">
                    <label>Phone</label>

                    <div>
                        <input required type="text" name="phone" id="phone" class="form-control">
                        <span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label>Email</label>

                    <div>
                        <input required type="text" name="email" id="email" class="form-control">
                        <span></span>
                    </div>
                </div>

                <div class="form-group">
                    <label>User Group</label>

                    <div>
                        <select required name="group" class="form-control" id="group">
                            <option value="">Select Group</option>
                            <?php
                            $groups = $this->ion_auth->groups()->result();
                            foreach ($groups as $group) {
                                ?>
                                <option value="<?php echo $group->id ?>"><?php echo $group->name ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <span></span>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnsave" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $('#btnnewuser').click(function () {
        $('#modalnewuser').modal('show');
    })
    //    $('#frmnewuser').validate({
    //        rules: {
    //            password: "required",
    //            password_confirm: {
    //                equalTo: "#password"
    //            }
    //        },
    //
    //        highlight: function (element) {
    //            $(element).closest('.form-group').addClass('has-error');
    //        },
    //        unhighlight: function (element) {
    //            $(element).closest('.form-group').removeClass('has-error');
    //        },
    //        errorElement: 'span',
    //        errorClass: 'help-block',
    //        errorPlacement: function (error, element) {
    //            if (element.parent('.input-group').length) {
    //                error.insertAfter(element.parent());
    //            } else {
    //                error.insertAfter(element);
    //            }
    //        }
    //    });
    $("input").change(function () {
        $(this).parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function () {
        $(this).parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function () {
        $(this).parent().removeClass('has-error');
        $(this).next().empty();
    });
    $(document).ajaxStart(function () {
        $('.overlay').show();
    });
    $('#btnsave').click(function () {
        var formData = new FormData($('#frmnewuser')[0]);
        $.ajax({
            url: '<?php  echo site_url("users/createUser"); ?>',
            type: 'POST',
            dataType: 'json',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $('.overlay').hide();
                if (data.status == false) {
                    $.each(data, function (index, val) {

                        $('#' + val.error_string).next().html(val.input_error);
                        $('#' + val.error_string).parent().addClass('has-error');
                        console.log(val.input_error);

                    });
                }
                else {
                    location.reload();
                }
            }
        });
    });
</script>