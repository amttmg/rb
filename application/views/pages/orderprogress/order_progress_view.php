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
                        <div class="table-responsive">
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
                              <div class="box-header with-border">
                                <h3 class="box-title">Customer Details</h3>
                              </div>
                              <div class="box-body">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <span class="label">Customer Name</span>
                                                <select name="customer" id="customer" class="form-control" required="required">
                                                    <option value="">--Select Customer</option>
                                                    <?php foreach ($customers as $customer): ?>
                                                        <option value="<?php echo($customer->customer_id) ?>"><?php echo($customer->fname.' '.$customer->mname.' '.$customer->lname) ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 ">
                                                   <div>
                                                        <img src="sanfran.jpg" class="img-responsive img-thumbnail" alt="Cinque Terre" style="width:204px;height:auto;">
                                                        <h3 class="profile-username">Dipesh Pokhrel</h3>
                                                        <address>
                                                            Address: Dhankuta<br/>
                                                            <span class="badge label-primary"><i class="fa fa-envelope"></i> Email: dipbro_jpt36@gmail.com</span><br/>
                                                            <span class="badge label-primary"><i class="fa fa-phone"></i> Contact: 9814369528</span><br/>
                                                        </address>

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

<script type="text/javascript">
    $(document).ready(function() {
        var customer_id='';

        $('body').on('click','.btn_edit_order',function(){
            customer_id=$('#customer').val();
            get_customer_detail (customer_id)
            $('#modal-edit_order').modal('show');
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
