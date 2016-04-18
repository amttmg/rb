
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
                        <?php /*echo $this->table->generate();*/ ?>


                          <table class="table table-hover" id="product_table">
                            <thead>
                              <tr>
                                <th>Model Number</th>
                                <th>Category</th>
                                <th>Net Weight</th>
                                <th>Gross Weight</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Actions</th>
                              </tr>
                            </thead>
                            <tfoot>
                              <tr>
                                <th>Model Number</th>
                                <th>Category</th>
                                <th>Net Weight</th>
                                <th>Gross Weight</th>
                                <th>Price</th>
                              </tr>
                            </tfoot>
                      
                          </table>
                            

                        <script type="text/javascript">
                          $(document).ready(function() {
                            $('.image-popup-link').magnificPopup({type:'image'});
                          });
                        </script>
                        
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
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="">Model Number</label>
                                <input type="text" name="model_no" class="form-control" id="model_no" placeholder="Model Number">
                                <span></span>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
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
                        </div>
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
                                                    <th>Metal Type</th>
                                                   <th>Metal</th>
                                                   <th>Weight</th>
                                                   <th></th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                               <tbody id="metal_grid">
                                            <tr>
                                                <td>
                                                  <div class="form-group" id="metal_dropdown">
                                                          <select name="m_metaltype" id="m_metaltype" class="form-control" required="required">
                                                              <?php foreach ($metal_type as $metal): ?>
                                                                  <option value=""><?php echo($metal->metal_type) ?></option>
                                                              <?php endforeach ?>
                                                          </select>
                                                          <span></span>
                                                      </div>
                                                  
                                                </td>
                                                <td>
                                                    <div class="form-group" id="metal_dropdown">
                                                        <select name="m_metal" id="m_metal" class="form-control" required="required">
                                                            <option value="0">--Select metal--</option>
                                                            
                                                        </select>
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
                                                        <button type="button" class="btn btn-primary" id="add_metalto_grid">Add</button>
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
                                                        <button type="button" class="btn btn-primary" id="add_stoneto_togrid">Add</button>
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
                    <div class="row">
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <div class="form-group">
                              <label for="">Gross Weight</label>
                              <input type="number" name="grossweight" class="form-control" id="grossweight" placeholder="Gross Weight">
                              <span></span>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <div class="form-group">
                                <label for="">Net Weight</label>
                                <input type="number" name="netweight"  class="form-control" id="netweight" placeholder="Net Weight">
                                <span></span>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <div class="form-group">
                                <label for="">Weight loss</label>
                                <input type="number" name="weight_loss"  class="form-control" id="weight_loss" placeholder="Net Weight">
                                <span></span>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="text" name="price" class="form-control" id="price" placeholder="Price">
                                <span></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" name="photo" id="photo">
                        </div>
                    </div>
                 </form>
            </div>
            <div class="modal-footer">
            <span class="label label-success pull-left" id="product_save_message" style="display:none">New product added successfully !</span>
                <button type="button" class="btn btn-primary" id="btn_product_add">Save</button>
                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
           
        </div>
    </div>
</div>

<!-- modal starts -->
  <div class="modal fade" id="product_edit_modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Edit Product</h4>
        </div>
        <div class="modal-body">
            <form action="<?php echo('product/update') ?>" method="POST" role="form" id="product_update_form">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="">Model Number</label>
                                <input type="text" name="model_no" class="form-control" id="model_no" placeholder="Model Number">
                                <span></span>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
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
                        </div>
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
                                                    <th>Metal Type</th>
                                                   <th>Metal</th>
                                                   <th>Weight</th>
                                                   <th></th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                               <tbody id="metal_grid">
                                            <tr>
                                                <td>
                                                  <div class="form-group" id="metal_dropdown">
                                                          <select name="m_metaltype" id="m_metaltype" class="form-control" required="required">
                                                              <?php foreach ($metal_type as $metal): ?>
                                                                  <option value=""><?php echo($metal->metal_type) ?></option>
                                                              <?php endforeach ?>
                                                          </select>
                                                          <span></span>
                                                      </div>
                                                  
                                                </td>
                                                <td>
                                                    <div class="form-group" id="metal_dropdown">
                                                        <select name="m_metal" id="m_metal" class="form-control" required="required">
                                                            <option value="0">--Select metal--</option>
                                                            
                                                        </select>
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
                                                        <button type="button" class="btn btn-primary" id="add_metalto_grid">Add</button>
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
                                                        <button type="button" class="btn btn-primary" id="add_stoneto_togrid">Add</button>
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
                    <div class="row">
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <div class="form-group">
                              <label for="">Gross Weight</label>
                              <input type="number" name="grossweight" class="form-control" id="grossweight" placeholder="Gross Weight">
                              <span></span>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <div class="form-group">
                                <label for="">Net Weight</label>
                                <input type="number" name="netweight"  class="form-control" id="netweight" placeholder="Net Weight">
                                <span></span>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <div class="form-group">
                                <label for="">Weight loss</label>
                                <input type="number" name="weight_loss"  class="form-control" id="weight_loss" placeholder="Net Weight">
                                <span></span>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="text" name="price" class="form-control" id="price" placeholder="Price">
                                <span></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" name="photo" id="photo">
                        </div>
                    </div>
                 </form>
        </div>
        <div class="modal-footer">
          <span class="label label-success pull-left" id="product_update_message" style="display:none">Product update successfully !</span>
           <button type="button" class="btn btn-primary" id="btn_product_update">Update</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!-- modal end -->

<script type="text/javascript">
    $(document).ready(function() {
      var selected_value=$('#m_metaltype').find("option:selected").text()
      var productid='';
      fill_metal_combo(selected_value,'save');//functon for fill metal combobox when page first load
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
            $('#metal_grid').append('<tr class="success"><td>'+$('#m_metaltype').find("option:selected").text()+'</td><td><input type="hidden" name="metal[]" value="'+$('#m_metal').val()+'">'+$('#m_metal').find("option:selected").text()+'</td><td><input type="hidden" name="weight[]" value="'+$('#m_weight').val()+'">'+$('#m_weight').val()+'</td><td><a href="#" class="remove"><span class="label label-danger">Remove</span></a></td></tr>');
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
              $('#stone_grid').append('<tr class="success"><td><input type="hidden" name="stone[]" value="'+$('#m_stone').val()+'">'+$('#m_stone').find("option:selected").text()+'</td><td><input type="hidden" name="pcs[]" value="'+$('#m_pcs').val()+'">'+$('#m_pcs').val()+'</td><td><input type="hidden" name="cts[]" value="'+$('#m_cts').val()+'">'+$('#m_cts').val()+'</td><td><a href="#" class="remove"><span class="label label-danger">Remove</span></a></td></tr>');
              //reseting value of input field
              $('#m_stone').val('0');
              $('#m_pcs').val('');
              $('#m_cts').val('');
          }
              
      });
      $("body").on("click",'.remove', function() {
        $(this).closest('tr').remove();
      });

      $('.modal').on('hidden.bs.modal', function(){
          $(this).find('form')[0].reset();
      });
      //for edit product
      $('body').on('click','.btnedit',function() {
        $("#product_update_form #stone_grid tr").not("tr:eq(0)").not("tbody:first").remove();
        $("#product_update_form #metal_grid tr").not("tr:eq(0)").not("tbody:first").remove();
          productid=$(this).data('productid');
          var selected_value=$('#product_update_form #m_metaltype').find("option:selected").text();
          fill_metal_combo(selected_value,'update');
          $.ajax({
            url: '<?php echo(site_url("product/get_product_detail")) ?>'+'/'+productid,
            dataType: 'json',
            success:function(data){
              $('#product_update_form #model_no').val(data[0].model_no);
              $('#product_update_form #category').val(data[0].category_id);
              $('#product_update_form #grossweight').val(data[0].gross_weight);
              $('#product_update_form #netweight').val(data[0].net_weight);
              $('#product_update_form #weight_loss').val(data[0].weight_loss);
              $('#product_update_form #price').val(data[0].price);

                $.ajax({
                  url: '<?php echo(site_url("metal/get_metal_details")) ?>'+'/'+productid,
                  dataType: 'json',
                  success:function(data)
                  {
                    console.log(data);
                    $.each(data, function(index, val) {
                      $('#product_update_form #metal_grid').append('<tr class="success"><td>'+val.metal_type+'</td><td><input type="hidden" name="metal[]" value="'+val.metal_id+'">'+val.metal+'</td><td><input type="hidden" name="weight[]" value="'+val.weight+'">'+val.weight+'</td><td><a href="#" class="remove"><span class="label label-danger">Remove</span></a></td></tr>')
                    });
                  }
                })
                .fail(function() {
                  alert("something went wrong please contact capital eye for technical support");
                })
                .always(function() {
                  console.log("complete");
                });

                //ajax for get data for stone details
                $.ajax({
                  url: '<?php echo(site_url("stone/get_stone_details")) ?>'+'/'+productid,
                  dataType: 'json',
                  success:function(data)
                  {
                    console.log(data);
                    $.each(data, function(index, val) {
                       $('#product_update_form #stone_grid').append('<tr class="success"><td><input type="hidden" name="stone[]" value="'+val.stone_id+'">'+val.stone_id+'</td><td><input type="hidden" name="pcs[]" value="'+val.pcs+'">'+val.pcs+'</td><td><input type="hidden" name="cts[]" value="'+val.cts+'">'+val.cts+'</td><td><a href="#" class="remove"><span class="label label-danger">Remove</span></a></td></tr>');
                    });
                  }
                })
                .fail(function() {
                  alert("something went wrong please contact capital eye for technical support");
                })
                .always(function() {
                  console.log("complete");
                });

                
            }
          })
          .fail(function() {
            alert('something went wrong please contact capital eye for technical support.');
          });
          $('#product_edit_modal').modal('show');
      });
      //add metal to grid on edit
      $('#product_update_form #add_metalto_grid').click(function() {
          if($('#product_update_form #m_metal').val()==='0' || $('#product_update_form #m_unit').val()==='' || $('#product_update_form #m_weight').val()==='')
          {
              if ($('#product_update_form #m_metal').val()==='0') 
              {
                $('#product_update_form #m_metal').next().html('<p class="text-warning">Please select metal</p>');
              }
              if($('#product_update_form #m_unit').val()==='')
              {
                $('#product_update_form #m_unit').next().html('<p class="text-warning">Unit field is empty !</p>');
              }
              if($('#product_update_form #m_weight').val()==='')
              {
                $('#product_update_form #m_weight').next().html('<p class="text-warning">Weight field is empty !</p>');
              }

          }
          else
          {
            $('#product_update_form #metal_grid').append('<tr class="success"><td>'+$('#product_update_form #m_metaltype').find("option:selected").text()+'</td><td><input type="hidden" name="metal[]" value="'+$('#product_update_form #m_metal').val()+'">'+$('#product_update_form #m_metal').find("option:selected").text()+'</td><td><input type="hidden" name="weight[]" value="'+$('#product_update_form #m_weight').val()+'">'+$('#product_update_form #m_weight').val()+'</td><td><a href="#" class="remove"><span class="label label-danger">Remove</span></a></td></tr>');
              $('#product_update_form #m_metal').val('0');
              $('#product_update_form #m_unit').val('');
              $('#product_update_form #m_weight').val('');
          }
        
      });
      //add stone to grid on edit
       $('#product_update_form #add_stoneto_togrid').click(function() {

        if($('#product_update_form #m_stone').val()==='0' || $('#product_update_form #m_pcs').val()==='' || $('#product_update_form #m_cts').val()==='')
          {
              if ($('#product_update_form #m_stone').val()==='0') 
              {
                $('#product_update_form #m_stone').next().html('<p class="text-warning">Please select stone</p>');
              }
              if($('#product_update_form #m_pcs').val()==='')
              {
                $('#product_update_form #m_pcs').next().html('<p class="text-warning">Pcs field is empty !</p>');
              }
              if($('#product_update_form #m_cts').val()==='')
              {
                $('#product_update_form #m_cts').next().html('<p class="text-warning">Cts field is empty !</p>');
              }

          }
          else
          {
              $('#product_update_form #stone_grid').append('<tr class="success"><td><input type="hidden" name="stone[]" value="'+$('#product_update_form #m_stone').val()+'">'+$('#product_update_form #m_stone').find("option:selected").text()+'</td><td><input type="hidden" name="pcs[]" value="'+$('#product_update_form #m_pcs').val()+'">'+$('#product_update_form #m_pcs').val()+'</td><td><input type="hidden" name="cts[]" value="'+$('#product_update_form #m_cts').val()+'">'+$('#product_update_form #m_cts').val()+'</td><td><a href="#" class="remove"><span class="label label-danger">Remove</span></a></td></tr>');
              //reseting value of input field
              $('#product_update_form #m_stone').val('0');
              $('#product_update_form #m_pcs').val('');
              $('#product_update_form #m_cts').val('');
          }
              
      });
      $('#product_update_form #m_metaltype').change(function() {
            var selected_value=$('#product_update_form #m_metaltype').find("option:selected").text()
            if($('#product_update_form #m_metaltype').val()!=='0')
            {
              fill_metal_combo(selected_value,user_form='update');
            }
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
        $('#m_metaltype').change(function() {
            var selected_value=$('#m_metaltype').find("option:selected").text()
            if($('#m_metaltype').val()!=='0')
            {
              fill_metal_combo(selected_value,save='save');
            }
        });

        //add new product 
      $('#btn_product_add').click(function() {
          var formData = new FormData($('#product_add_form')[0]);
            $(this).prop('disabled',true);
            $(this).text('Saving........');
          $.ajax({
              url: '<?php echo(site_url("product/add")) ?>',
              type: 'POST',
              dataType: 'json',
              cache: false,
              contentType: false,
              processData: false,
              data: formData,/*$('#product_add_form').serialize(),*/
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
              },
              error:function(data)
              {
                alert("An error occured please contact capital eye for technical support");
              }
          })
          .fail(function() {
              console.log("error");
          });          
      });

      $('#btn_product_update').click(function() {
          var formData = new FormData($('#product_update_form')[0]);
            $(this).prop('disabled',true);
            $(this).text('Updating........');
          $.ajax({
              url: '<?php echo(site_url("product/update")) ?>'+'/'+productid,
              type: 'POST',
              dataType: 'json',
              cache: false,
              contentType: false,
              processData: false,
              data: formData,/*$('#product_add_form').serialize(),*/
              success:function(data)
              {
                console.log(data);
                if(data.status==false)
                {
                    $('#btn_product_update').prop('disabled',false);
                    $('#btn_product_update').text('Update');
                    $.each(data, function(index, val) {
                        $('#product_update_form #'+val.error_string).next().html(val.input_error);
                        $('#product_update_form #'+val.error_string).parent().parent().addClass('has-error');
                    });
                  
                }
                else
                {
                        $('#product_update_message').show();
                        location.reload();
                }
              },
              error:function(data)
              {
                $('#btn_product_update').prop('disabled',false);
                alert("An error occured please contact capital eye for technical support");
              }
          })
          .fail(function() {
              console.log("error");
          });          
      });

    });

function fill_metal_combo(metal_type,user_form)
{
    if(user_form!=='update')
    {
      $.ajax({
                url: '<?php echo("product/fill_metal_combo") ?>'+'/'+metal_type,
                type: 'POST',
                dataType: 'json',
                success:function(data)
                {
                  $('#m_metal').empty();
                  $('#m_metal').append('<option value="0">--Please select metal--</option>');
                  $.each(data, function(index, val) {
                    var temp_opt='<option value="'+val.metal_id+'">'+val.metal+'</option>';
                    $('#m_metal').append(temp_opt);
                  });
                }
              })
              .done(function() {
                console.log("success");
              })
              .fail(function() {
                console.log("error");
              })
              .always(function() {
                console.log("complete");
              });
    }
    else
    {
      $.ajax({
                url: '<?php echo("product/fill_metal_combo") ?>'+'/'+metal_type,
                type: 'POST',
                dataType: 'json',
                success:function(data)
                {
                  $('#product_update_form #m_metal').empty();
                  $('#product_update_form #m_metal').append('<option value="0">--Please select metal--</option>');
                  $.each(data, function(index, val) {
                    var temp_opt='<option value="'+val.metal_id+'">'+val.metal+'</option>';
                    $('#product_update_form #m_metal').append(temp_opt);
                  });
                }
              })
              .fail(function() {
                console.log("error");
              });
              
    }
}
</script>

<script type="text/javascript">
var i=0;
  $('#product_table tfoot th').each( function () {
        i++;
        var title = $(this).text();
        $(this).html( '<input type="text" class="search-input-text" placeholder="Search'+title+'" data-column="'+i+'" size="10"/>' );
    } );
  
  $('.search-input-text').keyup( function () {   // for text boxes
    var i =$(this).attr('data-column');  // getting column index
    var v =$(this).val();  // getting search input value
    table.columns(i).search(v).draw();
  } );
table = $('#product_table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('product/ajax_list')?>",
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1,-2 ], //last column
            "orderable": false, //set not orderable
        },
        ],


    });

</script>