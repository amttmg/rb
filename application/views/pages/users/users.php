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
                <button class="btn btn-primary btn-sm" id="btnnewgroup"><i class="fa fa-plus"></i> New User</button>

                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i
                            class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i
                            class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
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
                               <?php echo $count ?>
                            </td>
                            <td>
                                <?php echo $user->first_name.' '.$user->last_name ?>
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
                                <?php echo $user->created_on ?>
                            </td>
                            <td>
                                <?php echo $user->last_login ?>
                            </td>
                            <td>
                                <?php echo $user->active ?>
                            </td>
                            <td>

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

<div class="modal fade" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" id='modalnewgroup'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">New Group</h4>
            </div>
            <?php echo form_open() ?>
            <div class="modal-body clearfix">

                <div class="form-group">
                    <label>Group name</label>
                    <input type="text" name="group_name" id="group_name" class="form-control">
                </div>
                <div class="form-group">
                    <label>Group Description</label>
                    <input type="text" name="description" id="description" class="form-control">
                </div>
                <div class="form-group col-md-6">

                    <div class="checkbox">
                        <label>
                            <input type="checkbox">
                            Checkbox 1
                        </label>
                    </div>
                    <div class="checkbox ">
                        <label>
                            <input type="checkbox">
                            Checkbox 1
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox">
                            Checkbox 1
                        </label>
                    </div>
                    <div class="checkbox ">
                        <label>
                            <input type="checkbox">
                            Checkbox 1
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox">
                            Checkbox 1
                        </label>
                    </div>
                    <div class="checkbox ">
                        <label>
                            <input type="checkbox">
                            Checkbox 1
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox">
                            Checkbox 1
                        </label>
                    </div>
                    <div class="checkbox ">
                        <label>
                            <input type="checkbox">
                            Checkbox 1
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox">
                            Checkbox 1
                        </label>
                    </div>
                    <div class="checkbox ">
                        <label>
                            <input type="checkbox">
                            Checkbox 1
                        </label>
                    </div>


                </div>
                <div class="form-group col-md-6">

                    <div class="checkbox">
                        <label>
                            <input type="checkbox">
                            Checkbox 1
                        </label>
                    </div>
                    <div class="checkbox ">
                        <label>
                            <input type="checkbox">
                            Checkbox 1
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox">
                            Checkbox 1
                        </label>
                    </div>
                    <div class="checkbox ">
                        <label>
                            <input type="checkbox">
                            Checkbox 1
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox">
                            Checkbox 1
                        </label>
                    </div>
                    <div class="checkbox ">
                        <label>
                            <input type="checkbox">
                            Checkbox 1
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox">
                            Checkbox 1
                        </label>
                    </div>
                    <div class="checkbox ">
                        <label>
                            <input type="checkbox">
                            Checkbox 1
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox">
                            Checkbox 1
                        </label>
                    </div>
                    <div class="checkbox ">
                        <label>
                            <input type="checkbox">
                            Checkbox 1
                        </label>
                    </div>


                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="submit" value="1">
                <button type="submit" name="" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            <?php echo form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $('#btnnewgroup').click(function () {
        $('#modalnewgroup').modal('show');
    })
</script>