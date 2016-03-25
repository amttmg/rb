<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Stones
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <section class="content">

          <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                <h3 class="box-title"><button type="button" class="btn btn-primary" id="btn_add_new_stone"><i class="fa fa-plus"></i>Add new</button></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="tblstones">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Lot Number</th>
                                    <th>Type</th>
                                    <th>Color</th>
                                    <th>Clarity</th>
                                    <th>Size</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $count=1; ?>
                                <?php foreach ($stones as $stone): ?>
                                    <tr>
                                        <td><?php echo($count) ?></td>
                                        <th><?php echo($stone->lot_no) ?></th>
                                        <th><?php echo($stone->type) ?></th>
                                        <th><?php echo($stone->color) ?></th>
                                        <th><?php echo($stone->clarity) ?></th>
                                        <th><?php echo($stone->size) ?></th>
                                        <th>
                                            
                                            <a href="#" class="btn_edit_stone btn-xs btn-primary" data-stoneid="<?php echo($stone->stone_id) ?>"><i class="fa fa-edit"></i> Edit</a>
                                            
                                            
                                        </th>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.box-body -->
          </div><!-- /.box -->

    </section>

    <!-- Main content -->

</div><!-- /.content-wrapper -->

<!-- modal for add new stone -->
<div class="modal fade" id="mdl_add_new_stone">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Stone</h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST" role="form" id="add_stone_form">
                    <div class="form-group">
                        <label for="">Lot Number</label>
                        <input type="text" name="lot_no" class="form-control" id="lot_no" placeholder="Input field">
                        <span></span>
                    </div>
                    <div class="form-group">
                        <label for="">Type</label>
                        <input type="text" name="type" class="form-control" id="type" placeholder="Input field">
                        <span></span>
                    </div>
                    <div class="form-group">
                        <label for="">Color</label>
                        <input type="text" name="color" class="form-control" id="color" placeholder="Input field">
                        <span></span>
                    </div>
                    <div class="form-group">
                        <label for="">Clarity</label>
                        <input type="text" name="clarity" class="form-control" id="clarity" placeholder="Input field">
                        <span></span>
                    </div>
                    <div class="form-group">
                        <label for="">Size</label>
                        <input type="text" name="size" class="form-control" id="size" placeholder="Input field">
                        <span></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            <span class="label label-success pull-left" id="stone_save_message" style="display:none">Stone inserted successfully !</span>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn_save_stone">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- modal for edit stone -->
<div class="modal fade" id="mdl_edit_stone">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Stone</h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST" role="form" id="edit_stone_form">
                    <div class="form-group">
                        <label for="">Lot Number</label>
                        <input type="text" name="lot_no" class="form-control" id="lot_no" placeholder="Input field">
                        <span></span>
                    </div>
                    <div class="form-group">
                        <label for="">Type</label>
                        <input type="text" name="type" class="form-control" id="type" placeholder="Input field">
                        <span></span>
                    </div>
                    <div class="form-group">
                        <label for="">Color</label>
                        <input type="text" name="color" class="form-control" id="color" placeholder="Input field">
                        <span></span>
                    </div>
                    <div class="form-group">
                        <label for="">Clarity</label>
                        <input type="text" name="clarity" class="form-control" id="clarity" placeholder="Input field">
                        <span></span>
                    </div>
                    <div class="form-group">
                        <label for="">Size</label>
                        <input type="text" name="size" class="form-control" id="size" placeholder="Input field">
                        <span></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            <span class="label label-success pull-left" id="stone_update_message" style="display:none">Stone inserted successfully !</span>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn_update_stone">Update</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        //open modal for insert new stones
        var stone_id;
        $('#btn_add_new_stone').click(function() {
            $('#mdl_add_new_stone').modal('show');
        });

        $('.btn_edit_stone').click(function() {
            stone_id=$(this).data('stoneid');
            $.ajax({
                url: '<?php echo(site_url("stone/get_stone")) ?>'+'/'+stone_id,
                type: 'POST',
                dataType:'json',
                success:function(data)
                {
                    $.each(data[0], function(index, val) {
                         $('#edit_stone_form #'+index).val(val);
                    });
                }
            })
            .fail(function() {
                console.log("error");
            });
            $('#mdl_edit_stone').modal('show');

        });

        /*function starts for dealing with errors*/
        $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
        });
        $("textarea").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("select").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        /*functon ends for dealing errors*/
        //save new stones

        $('#btn_save_stone').click(function() {
            $('#btn_save_stone').text('saving.......');
            $('#btn_save_stone').prop('disabled',true);
            $.ajax({
               url: '<?php echo(site_url("stone/add")) ?>',
               type: 'POST',
               dataType: 'json',
               data: $('#add_stone_form').serialize(),
               success:function(data)
               {
                console.log(data);
                    if(data.status==true)
                    {
                        $('#stone_save_message').show();
                        location.reload();
                    }
                    else
                    {
                        $('#btn_save_stone').prop('disabled',false);
                        $('#btn_save_stone').text('Save');
                        $.each(data, function(index, val) {
                             $('#'+val.error_string).next().html(val.input_error);
                            $('#'+val.error_string).parent().parent().addClass('has-error');
                        });
                    }
               }
           })
           .fail(function() {
               console.log("error");
           });
        });
        
        /*edit stone*/
        $('#btn_update_stone').click(function() {
            $('#btn_update_stone').prop('disabled',true);
            $('#btn_update_stone').text('Updating......');
            $.ajax({
                url: '<?php echo(site_url("stone/update")) ?>'+'/'+stone_id,
                type: 'POST',
                dataType: 'json',
                data: $('#edit_stone_form').serialize(),
                success:function(data)
                {
                    if(data.status==true)
                    {
                        $('#stone_update_message').show();
                        location.reload();
                    }
                    else
                    {
                        $('#btn_update_stone').prop('disabled',false);
                        $('#btn_update_stone').text('Update');
                        $.each(data, function(index, val) {
                             $('#edit_stone_form #'+val.error_string).next().html(val.input_error);
                            $('#edit_stone_form #'+val.error_string).parent().parent().addClass('has-error');
                        });
                    }
                }
            })
            .fail(function() {
                console.log("error");
            });
        });
        /*end edit stone*/
    });

    $('#tblstones').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true
        });
</script>
