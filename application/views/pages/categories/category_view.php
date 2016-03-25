<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Category
            <small>Control panel</small>
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
                <h3 class="box-title"><button type="button" class="btn btn-primary" id="btn_add_new_productcategory"><i class="fa fa-plus"></i> Add New</button></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <div class="table-responsive">
                                <table class="table table-hover" id="tblproductcategory">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Category Name</th>
                                            <th>Remarks</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo($count=1) ?>
                                        <?php foreach ($categories as $category): ?>
                                            <tr>
                                                <td><?php echo($count) ?></td>
                                                <td><?php echo($category->category) ?></td>
                                                <td><?php echo($category->remarks) ?></td>
                                                <td>
                                                        <div class="btn-group">
                                                        <button type="button" class="btn_edit_productcategory btn btn-info" data-productcategoryid="<?php echo($category->category_id) ?>">Edit</button>
                                                        <button type="button" class="btn btn-info">Action</button>
                                                        </div>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box-body -->
          </div><!-- /.box -->

    </section>
    <!-- Main content -->

</div><!-- /.content-wrapper -->

<!-- this section is used for add new modal form -->

<!-- this model for add new product category -->
<div class="modal fade" id="mdl_add_productcategory">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add new category</h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST" role="form" id="add_productcategory_form">
                    <div class="form-group">
                        <label for="">Category</label>
                        <input type="text" name="category" class="form-control" id="category" placeholder="Category Name">
                        <span></span>
                    </div>
                    <div class="form-group">
                        <label for="">Remarks</label>
                        <input type="text" name="remarks" class="form-control" id="remarks" placeholder="Remarks">
                        <span></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            <span class="label label-success pull-left" id="productcategory_save_message" style="display:none">Product category insert successfully !</span>
                <button type="button" class="btn btn-primary" id="btn_save_productcategory">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- this modal for edit product category -->
<div class="modal fade" id="mdl_edit_productcategory">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Product Category</h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST" role="form" id="productcategory_edit_form">
                    <input type="hidden" name="original_category_name">
                    <div class="form-group">
                        <label for="">Category Name</label>
                        <input type="text" name="category" class="form-control" id="category" placeholder="Category Name">
                        <span></span>
                    </div>
                    <div class="form-group">
                        <label for="">Remarks</label>
                        <input type="text" name="remarks" class="form-control" id="remarks" placeholder="Remarks">
                        <span></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            <span class="label label-success pull-left" id="productcategory_update_message" style="display:none">Product category update successfully !</span>
                <button type="button" class="btn btn-primary" id="btn_productcategory_update">Update</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var productcategoryid='';
        $('#btn_add_new_productcategory').click(function() {
            $('#mdl_add_productcategory').modal('show');
        });
        //this for edit product category
        $('.btn_edit_productcategory').click(function() {
            productcategoryid=$(this).data('productcategoryid');
            $.ajax({
                url: '<?php echo(site_url("category/get_productcategory_details")) ?>'+'/'+productcategoryid,
                dataType: 'json',
                success:function(data)
                {
                    $('#productcategory_edit_form #category').val(data[0].category);
                    $('#productcategory_edit_form #remarks').val(data[0].remarks);
                    $('#productcategory_edit_form #original_category_name').val(data[0].category);
                    $('#mdl_edit_productcategory').modal('show');
                }
            })
            .fail(function() {
                console.log("error");
            });
            
            /*$('#mdl_edit_productcategory').modal('show');*/
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

        $('#btn_save_productcategory').click(function() {
            $('#btn_save_productcategory').text('saving.......');
            $('#btn_save_productcategory').prop('disabled',true);
            $.ajax({
                url: '<?php echo(site_url("category/add")) ?>',
                type: 'POST',
                dataType: 'json',
                data: $('#add_productcategory_form').serialize(),
                success:function(data)
                {
                    if(data.status==true)
                    {
                        $('#productcategory_save_message').show();
                        location.reload();
                    }
                    else
                    {
                        $.each(data, function(index, val) {
                             $('#'+val.error_string).next().html(val.input_error);
                             $('#'+val.error_string).parent().parent().addClass('has-error');
                        });
                        $('#btn_save_productcategory').text('Save');
                        $('#btn_save_productcategory').prop('disabled',false);
                    }
                }
            })
            .fail(function() {
                console.log("error");
            });
            
        });

        /*for update product category*/
        $('#btn_productcategory_update').click(function() {
            $('#btn_productcategory_update').text('Updating......');
            $('#btn_productcategory_update').prop('disabled',true);
           $.ajax({
               url: '<?php echo(site_url("category/update")) ?>'+'/'+productcategoryid,
               type: 'POST',
               dataType: 'json',
               data: $('#productcategory_edit_form').serialize(),
               success:function(data)
               {
                        if (data.status==true) 
                        {
                            $('#productcategory_update_message').show();
                            location.reload();
                        }
                        else
                        {
                             $.each(data, function(index, val) {
                                 $('#productcategory_edit_form #'+val.error_string).next().html(val.input_error);
                                 $('#productcategory_edit_form #'+val.error_string).parent().parent().addClass('has-error');
                            });
                            $('#btn_productcategory_update').text('Update');
                            $('#btn_productcategory_update').prop('disabled',false);
                        }
               }
           })
           .fail(function() {
               console.log("error");
           });
           
        });
    });

    $('#tblproductcategory').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true
        });
</script>