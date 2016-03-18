<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Group Management
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
                <button class="btn btn-primary btn-sm" id="btnnewgroup"><i class="fa fa-plus"></i> New Group</button>

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
                            Description
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $count = 1;
                    foreach ($groups as $group) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $count ?>
                            </td>
                            <td>
                                <?php echo $group->name ?>
                            </td>
                            <td>
                                <?php echo $group->description ?>
                            </td>
                            <td>
                                <button class="btn btn-primary btn-xs btnedit" data-id="<?php echo $group->id ?>">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-remove"></i>
                                    Deactive
                                </button>
                            </td>
                        </tr>
                        <?php
                        $count++;
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
<!-- modal for new group-->
<div class="modal fade" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" id='modalnewgroup'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">New Group</h4>
            </div>
            <?php echo form_open('', array('id' => 'frmnewgroup')) ?>
            <div class="modal-body clearfix">

                <div class="form-group">
                    <label>Group name</label>
                    <input required type="text" name="group_name" id="group_name" class="form-control">
                </div>
                <div class="form-group">
                    <label>Group Description</label>
                    <input required type="text" name="description" id="description" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <?php foreach ($functions as $function) {
                        ?>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="functions[]" value=" <?php echo $function->function_id ?>">
                                <?php echo $function->function ?>
                            </label>
                        </div>
                        <?php
                    } ?>
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

<!-- modal for edit group-->
<div class="modal fade" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" id='modaleditgroup'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Group</h4>
            </div>
            <?php echo form_open('users/editGroup', array('id' => 'frmnewgroup')) ?>
            <div class="modal-body clearfix">

                <div class="form-group">
                    <label>Group name</label>
                    <input type="hidden" name="group_id" id="group_id1">
                    <input required type="text" name="group_name" id="group_name1" class="form-control">
                </div>
                <div class="form-group">
                    <label>Group Description</label>
                    <input required type="text" name="description" id="description1" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <?php foreach ($functions as $function) {
                        ?>
                        <div class="checkbox">
                            <label>
                                <input class="editcheckbox" type="checkbox" name="functions[]" id="<?php echo 'edit'.$function->function_id ?>"
                                       value=" <?php echo $function->function_id ?>">
                                <?php echo $function->function ?>
                            </label>
                        </div>
                        <?php
                    } ?>
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
    $('.btnedit').click(function () {
        var group_id = $(this).data('id');
        $.ajax({
            url:'<?php echo base_url('users/getGroup') ?>/'+group_id,
            success: function(res){
              var obj=jQuery.parseJSON(res);
                $('#group_name1').val(obj.name);
                $('#group_id1').val(obj.id);
                $('#description1').val(obj.description);
                $('#modaleditgroup').modal('show');
            }
        })
        $.ajax({
            url:'<?php echo base_url('users/getGroupFunctions') ?>/'+group_id,
            success: function(res){
                var obj=jQuery.parseJSON(res);
                $('.editcheckbox').prop('checked',false);
                $.each(obj, function(index, val) {
                    $('#edit'+val.function_id).prop('checked',true);
                });
            }
        })

    })
    $('#frmnewgroup').validate();
</script>