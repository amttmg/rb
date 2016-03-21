<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Products
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
                <h3 class="box-title"><button type="button" class="btn btn-primary" id="btn_add_new_product"><i class="fa fa-plus"></i> Add New</button></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                    <div id="container">
                      
                    </div>
                </div><!-- /.box-body -->
          </div><!-- /.box -->

    </section>
    <!-- Main content -->

</div><!-- /.content-wrapper -->

<!-- section starts for modal -->
<div class="modal fade" id="mdl_add_products" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add New Product</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo('product/add') ?>" method="POST" role="form" id="product_add_form">
                    <div class="form-group">
                        <label for="">Model Number</label>
                        <input type="text" name="model_no" class="form-control" id="model_no" placeholder="Input field">
                        <span></span>
                    </div>
                    <div class="form-group">
                        <label for="">Category</label>
                        <select name="category" id="category" class="form-control">
                            <option value="0">-- Select Category --</option>
                            <?php foreach ($product_categories as $category): ?>
                                <option value="<?php echo($category->category_id) ?>"><?php echo($category->category) ?></option>
                            <?php endforeach ?>
                        </select>
                        <span></span>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <table class="table">
                                           <thead>
                                               <tr>
                                                   <th>Metal</th>
                                                   <th>unit</th>
                                                   <th>Weight</th>
                                                   <th></th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                               <tbody id="metal_grid">
                                            <tr>
                                                <td width="200">
                                                    <div class="form-group" id="metal_dropdown">
                                                        <select name="metal[]" class="metal form-control" required="required">
                                                            <option value="">--Select metal--</option>
                                                            <?php foreach ($metals as $metal): ?>
                                                                <option value="<?php echo($metal->metal_id) ?>"><?php echo($metal->metal) ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td width="150">
                                                    <div class="form-group" id="unit">
                                                        <input type="text" name="unit[]" class="unit form-control" >
                                                    </div>
                                                </td>
                                                <td width="150">
                                                    <div class="form-group" id="weight">
                                                        <input type="text" name="weight[]" class="weight form-control" >
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-warning" id="add_metalto_grid">Add</button>
                                                    </div>
                                                </td>
                                                
                                            </tr>
                                        </tbody>
                                           </tbody>
                                       </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <table class="table">
                                           <thead>
                                               <tr>
                                                   <th>Stone</th>
                                                   <th>pcs</th>
                                                   <th>cts</th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                               <tbody id="stone_grid">
                                            <tr>
                                                <td width="200">
                                                    <div class="form-group" id="stone_dropdown">
                                                        <select name="stone[]" class="stone form-control" required="required">
                                                            <option value="">--select lot no--</option>
                                                             <?php foreach ($stones as $stone): ?>
                                                                <option value="<?php echo($stone->stone_id) ?>"><?php echo($stone->lot_no) ?></option>
                                                             <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td width="120">
                                                    <div class="form-group" id="pcs">
                                                        <input type="text" name="pcs[]" class="pcs form-control" value=""  title="">
                                                    </div>
                                                </td>
                                                <td width="120">
                                                    <div class="form-group" id="cts">
                                                        <input type="text" name="cts[]" class="cts form-control" value=""   title="">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-warning" id="add_stoneto_togr">Add</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                           </tbody>
                                       </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Gross Weight</label>
                        <input type="text" name="grossweight" class="form-control" id="grossweight" placeholder="Input field">
                    </div>
                    <div class="form-group">
                        <label for="">Net Weight</label>
                        <input type="text" name="netweight"  class="form-control" id="netweight" placeholder="Input field">
                    </div>
                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="text" name="price" class="form-control" id="price" placeholder="Input field">
                    </div>
                    <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" class="form-control" id="" placeholder="Input field">
                    </div>
                
            </div>
            <div class="modal-footer">
            <span class="label label-success pull-left" id="product_save_message" style="display:none">New product added successfully !</span>
                <button type="button" class="btn btn-primary" id="btn_product_add">Save</button>
                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
      $('#btn_add_new_product').click(function() {
          $('#mdl_add_products').modal('show');
      }); 
      //add data to metal grid
      $('#add_metalto_grid').click(function() {

        $('#metal_grid').append('<tr><td>'+$('#metal_dropdown').html()+'</td><td>'+$('#unit').html()+'</td><td>'+$('#weight').html()+'</td><td><button class="remove btn btn-info btn-sm" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button></td></tr>');
      });

      $('#add_stoneto_togr').click(function() {
        $('#stone_grid').append('<tr><td>'+$('#stone_dropdown').html()+'</td><td>'+$('#pcs').html()+'</td><td>'+$('#cts').html()+'</td><td><button class="remove btn btn-info btn-sm" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button></td></tr>');
      });
      $("body").on("click",'.remove', function() {
        $(this).closest('tr').remove();
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
      $('#btn_product_add').click(function() {
            $(this).prop('disabled',true);
            $(this).text('Saving........');
          $.ajax({
              url: '<?php echo(site_url("product/add")) ?>',
              type: 'POST',
              dataType: 'json',
              data: $('#product_add_form').serialize(),
              success:function(data)
              {
                console.log(data);
                if(data.status==false)
                {
                    $('#btn_product_add').prop('disabled',false);
                    $('#btn_product_add').text('Save');
                    $.each(data, function(index, val) {
                        $('#product_add_form #'+val.error_string).next().html(val.input_error);
                        $('#product_add_form #'+val.error_string).parent().parent().addClass('has-error');
                    });
                  
                }
                else
                {
                        $('#product_save_message').show();
                        location.reload();
                }
              }
          })
          .fail(function() {
              console.log("error");
          });          
      });

    });
</script>