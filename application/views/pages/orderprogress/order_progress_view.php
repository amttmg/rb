<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Orders Progress
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
                <h3 class="box-title"></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                    <div id="container">

                            <table class="table table-hover" id="order_progress">
                                <thead>
                                    <tr>
                                        <th>Sn</th>
                                        <th>Customer Name</th>
                                        <th>Ordered Id</th>
                                        <th>Ordered Date</th>
                                        <th>Deadline Date</th>
                                        <th>Order Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                
                            </table>

                    </div>
                </div><!-- /.box-body -->
          </div><!-- /.box -->

    </section>
    <!-- Main content -->

</div><!-- /.content-wrapper -->

<div class="modal fade" id="modal-edit_order">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Order</h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST" role="form">

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                           <div class="box box-default">
                              <div class="box-body">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div id="user_info">
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="row">
                                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="">Order Date</label>
                                                        <input type="date" name="order_date" class="form-control" id="order_date" placeholder="Input field">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Advance Payment</label>
                                                        <input type="text" name="advance" class="form-control" id="advance" placeholder="Input Advance">
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="">Deadline Date</label>
                                                        <input type="date" name="deadline_date" class="form-control" id="deadline_date" placeholder="Input field">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Remarks</label>
                                                        <textarea name="remarks" id="remarks" class="form-control" rows="2" required="required"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                     <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div id="">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                                id="btn_reference_product"><i
                                                                class="fa a-folder-open"></i>Order from Reference
                                                        </button>
                                                    </div>
                                                    <table class="table table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>Model No</th>
                                                            <th>Price</th>
                                                            <th>Qty</th>
                                                            <th>Image</th>
                                                            <td>Remarks</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="product_container">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  
                              </div><!-- /.box-body -->
                            </div>
                        </div>
                       
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save</button>
                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mdl_reference_product">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Reference Product List</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
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

                </div>

            </div>
            <div class="modal-footer">
                <span class="label label-success pull-left" id="save_order_message" style="display:none">Ordered saved successfully !</span>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var customer_id='';
        $('body').on('click','.btn_edit_order',function(){
            customer_id=$(this).data('customerid');
            $('#modal-edit_order').modal('show');

            $.ajax({
                url: '<?php echo(site_url("customer/get_customer_by_id")) ?>' + '/' + customer_id,
                type: 'POST',
                dataType: 'html',
                success: function (data) {
                    $('#user_info').html(data);
                    $('.overlay').hide();
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });

        $('body').on('change','#customer',function(){
            customer_id=$(this).val();
            alert(customer_id);
            get_customer_detail (customer_id);
        });
       
    });

    function get_customer_detail (customer_id) 
    {
       $.ajax({
           url: '<?php echo(site_url("customer/get_customer_by_id")) ?>'+'/'+customer_id+'/'+0,
           type: 'POST',
           dataType: 'json',
           success:function(data)
           {
             console.log(data);
           },
           error:function(data)
           {
             console.log(data);
           }
       });
       
    }
</script>
<script>

      table = $('#order_progress').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('order_progress/datatables')?>",
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0,-1,-2,-3,-4], //last column
            "orderable": false, //set not orderable
        },
        ],
  });
      
</script>
