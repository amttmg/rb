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
                        <input type="text" name="model_no" class="form-control" id="model_no" placeholder="Model Number">
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
                                      <div class="table-responsive table-bordered">
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
                                                <td>
                                                    <div class="form-group" id="metal_dropdown">
                                                        <select name="m_metal" id="m_metal" class="form-control" required="required">
                                                            <option value="0">--Select metal--</option>
                                                            <?php foreach ($metals as $metal): ?>
                                                                <option value="<?php echo($metal->metal_id) ?>"><?php echo($metal->metal) ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                        <span></span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group" id="unit">
                                                        <input type="text" name="m_unit" id="m_unit" class="form-control" placeholder="Unit" >
                                                        <span></span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group" id="weight">
                                                        <input type="text" name="m_weight" id="m_weight" class="form-control" placeholder="Weight" >
                                                        <span></span>
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
                                                        <select name="m_stone" id="m_stone" class="form-control" required="required">
                                                            <option value="0">--select lot no--</option>
                                                             <?php foreach ($stones as $stone): ?>
                                                                <option value="<?php echo($stone->stone_id) ?>"><?php echo($stone->lot_no) ?></option>
                                                             <?php endforeach ?>
                                                        </select>
                                                        <span></span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" name="m_pcs" id="m_pcs" class="form-control" value="" placeholder="Pcs">
                                                        <span></span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" name="m_cts" id="m_cts" class="form-control" value="" placeholder="Cts">
                                                        <span></span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <button type="button" class="btn btn-warning" id="add_stoneto_togrid">Add</button>
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
                        <input type="number" name="grossweight" class="form-control" id="grossweight" placeholder="Gross Weight">
                        <span></span>
                    </div>
                    <div class="form-group">
                        <label for="">Net Weight</label>
                        <input type="number" name="netweight"  class="form-control" id="netweight" placeholder="Net Weight">
                        <span></span>
                    </div>
                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="text" name="price" class="form-control" id="price" placeholder="Price">
                        <span></span>
                    </div>
                    <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" name="photo" id="photo">
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
          if($('#m_metal').val()==='0' || $('#m_unit').val()==='' || $('#m_weight').val()==='')
          {
              if ($('#m_metal').val()==='0') 
              {
                $('#m_metal').next().html('<p class="text-warning">Please select metal</p>');
              }
              if($('#m_unit').val()==='')
              {
                $('#m_unit').next().html('<p class="text-warning">Unit field is empty !</p>');
              }
              if($('#m_weight').val()==='')
              {
                $('#m_weight').next().html('<p class="text-warning">Weight field is empty !</p>');
              }

          }
          else
          {
              $('#metal_grid').append('<tr class="success"><td><input type="hidden" name="metal[]" value="'+$('#m_metal').val()+'">'+$('#m_metal').find("option:selected").text()+'</td><td><input type="hidden" name="unit[]" value="'+$('#m_unit').val()+'">'+$('#m_unit').val()+'</td><td><input type="hidden" name="weight[]" value="'+$('#m_weight').val()+'">'+$('#m_weight').val()+'</td><td><button class="remove btn btn-info btn-sm" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button></td></tr>');
              $('#m_metal').val('0');
              $('#m_unit').val('');
              $('#m_weight').val('');
          }
        
      });

      $('#add_stoneto_togrid').click(function() {

        if($('#m_stone').val()==='0' || $('#m_pcs').val()==='' || $('#m_cts').val()==='')
          {
              if ($('#m_stone').val()==='0') 
              {
                $('#m_stone').next().html('<p class="text-warning">Please select stone</p>');
              }
              if($('#m_pcs').val()==='')
              {
                $('#m_pcs').next().html('<p class="text-warning">Pcs field is empty !</p>');
              }
              if($('#m_cts').val()==='')
              {
                $('#m_cts').next().html('<p class="text-warning">Cts field is empty !</p>');
              }

          }
          else
          {
              $('#stone_grid').append('<tr class="success"><td><input type="hidden" name="stone[]" value="'+$('#m_stone').val()+'">'+$('#m_stone').find("option:selected").text()+'</td><td><input type="hidden" name="pcs[]" value="'+$('#m_pcs').val()+'">'+$('#m_pcs').val()+'</td><td><input type="hidden" name="cts[]" value="'+$('#m_cts').val()+'">'+$('#m_cts').val()+'</td><td><button class="remove btn btn-info btn-sm" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button></td></tr>');
              //reseting value of input field
              $('#m_stone').val('0');
              $('#m_pcs').val('');
              $('#m_cts').val('');
          }
              
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