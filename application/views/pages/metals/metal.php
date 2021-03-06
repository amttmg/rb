<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Metals
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
                <h3 class="box-title"><button type="button" class="btn btn-primary" id="btn_add_new_metal"><i class="fa fa-plus"></i> Add New</button></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">

                      <table class="table table-bordered" id="tblmetals">
                          <col width="80">
                          <col width="80">
                          <col width="130">
                          <col width="80">
                          <col width="70">
                          <thead>
                              <tr>
                                  <th>SN.</th>
                                  <th>Metal Name</th>
                                  <th>Metal Type</th>
                                  <th>Unit</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                          <?php $count=1; ?>
                              <?php foreach ($metals as $metal): ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo($metal->metal) ?></td>
                                    <td><?php echo($metal->metal_type) ?></td>
                                    <td><?php echo($metal->unit) ?></td>
                                    <td>
                                        <a href="#" class="btn_edit_metal btn btn-xs btn-primary" data-metalid="<?php echo($metal->metal_id) ?>"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="#" class="btn_edit_metal btn  btn-xs btn-danger" data-metalid="<?php echo($metal->metal_id) ?>"><i class="fa fa-edit"></i> Deactive</a>
                                    </td>
                                </tr>
                                <?php $count++; ?>
                              <?php endforeach ?>
                          </tbody>
                      </table>

                </div><!-- /.box-body -->
          </div><!-- /.box -->

    </section>

    <!-- Main content -->

</div><!-- /.content-wrapper -->

<!-- modal for add new metal -->
<div class="modal fade" id="add_new_metal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add new metal</h4>
            </div>
            <div class="modal-body">
                    <form action="" method="POST" role="form" id="add_new_metal_form">
                        <div class="form-group">
                            <label for="">Metal Name</label>
                            <input type="text" name="metalname" class="form-control" id="metalname" placeholder="Metal name">
                            <span></span>
                        </div>
                        <div class="form-group">
                            <label>Metal Type</label>
                              <select class="form-control" name="metaltype" id="metaltype">
                                <option value="0">Choose Metal Type</option>
                                <option value="gold">Gold</option>
                                <option value="silver">Silver</option>
                              </select>
                              <span></span>
                        </div>
                        <div class="form-group">
                            <label for="">Unit</label>
                            <input type="text" name="unit" class="form-control" id="unit" placeholder="Metal Type">
                            <span></span>
                        </div>
                    </form>
            </div>
            <div class="modal-footer">
                <span class="label label-success pull-left" id="metal_save_message" style="display:none">Metal saved successfully !</span>
                <button type="button" class="btn btn-primary" id="btn_metal_save">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- model for edit metal -->
<div class="modal fade" id="edit_metal_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Metal</h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST" role="form" id="edit_metal_form">
                        <div class="form-group">
                            <label for="">Metal Name</label>
                            <input type="text" name="metal" class="form-control" id="metal" placeholder="Metal name">
                            <span></span>
                        </div>
                        <div class="form-group">
                            <label>Metal Type</label>
                              <select class="form-control" name="metaltype" id="metaltype">
                                <option value="0">Choose Metal Type</option>
                                <option value="gold">Gold</option>
                                <option value="silver">Silver</option>
                              </select>
                              <span></span>
                        </div>
                        <div class="form-group">
                            <label for="">Unit</label>
                            <input type="text" name="unit" class="form-control" id="unit" placeholder="Metal Type">
                            <span></span>
                        </div>
                </form>
            </div>
            <div class="modal-footer">
            <span class="label label-success pull-left" id="metal_update_message" style="display:none">Metal updated successfully !</span>
                <button type="button" class="btn btn-primary" id="btn_update_metal">Update</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var metal_id;
        //function for open modal add new metal
        $('#btn_add_new_metal').click(function() {
            $('#add_new_metal').modal('show');
        });
        //open model for edit metal
        $('.btn_edit_metal').click(function() {
            metal_id=$(this).data('metalid');
            $.ajax({
                url: '<?php echo(site_url("metal/get_metal")) ?>'+'/'+metal_id,
                type: 'POST',
                dataType: 'json',
                success:function (data) {
                    $('#edit_metal_form #metal').val(data[0].metal);
                    $('#edit_metal_form #metaltype').val(data[0].metal_type);
                    $('#edit_metal_form #unit').val(data[0].unit);
                }
            })
            .fail(function() {
                console.log("error");
            });
            $('#edit_metal_modal').modal('show');
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

        /*function for save new metal*/
        $('#btn_metal_save').click(function() {
            $('#btn_metal_save').text('saving.......');
            $('#btn_metal_save').prop('disabled',true);
           $.ajax({
               url: '<?php echo(site_url("metal/add")) ?>',
               type: 'POST',
               dataType: 'json',
               data: $('#add_new_metal_form').serialize(),
               success:function(data)
               {
                console.log(data);
                    if(data.status==true)
                    {
                        $('#metal_save_message').show();
                        location.reload();
                    }
                    else
                    {
                        $('#btn_metal_save').prop('disabled',false);
                        $('#btn_metal_save').text('Save');
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
        /*end add new metal section*/

        /*function starts for edit metals*/
        $('#btn_update_metal').click(function() {
            $(this).prop('disabled', true);
            $(this).text('Updating......');
            $.ajax({
                url: '<?php echo(site_url("metal/update")) ?>'+'/'+metal_id,
                type: 'POST',
                dataType: 'json',
                data: $('#edit_metal_form').serialize(),
                success:function(data)
                {
                    if(data.status==true)
                    {
                        $('#metal_update_message').show();
                        location.reload();
                    }
                    else
                    {
                        $('#btn_update_metal').prop('disabled',false);
                        $('#btn_update_metal').text('Update');
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
       /* end edit metal form*/
    });

$('#tblmetals').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true
        });
</script>