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
            <?php if ($this->session->flashdata('message')): ?>
                <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <strong><?php echo($this->session->flashdata('message')) ?></strong>
                </div>
          <?php endif ?>
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
                        <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="<?php echo(base_url('uploads/'.$customer_detail[0]->customer_image)) ?>" alt="user image">
                            <span class="username">
                              <a href="<?php echo(site_url('customer/customerdetails/'.md5($customer_detail[0]->customer_id))) ?>"><?php echo($customer_detail[0]->fname.' '.$customer_detail[0]->mname.' '.$customer_detail[0]->lname) ?></a>
                              <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                            </span>
                          </div>
        
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                 <address style="margin-left:5%">
                                   Address: <?php echo($customer_detail[0]->address) ?><br>
                                    Phone: <?php echo($customer_detail[0]->phone1)  ?><br>
                                    Email: <?php echo($customer_detail[0]->email) ?>
                                </address>
                            </div>
                        </div>
                          <?php if ($customer_detail[0]->remarks!=''): ?>
                              <div class="box">
                                  <div class="box-header with-border">
                                    <h4 class="box-title">Order Remarks</h4>
                                              <?php if ($customer_detail[0]->complated_at!=null):?>
                                                  <small class="label label-success"><i class="fa fa-clock-o"></i> Complated !! <?php echo($customer_detail[0]->complated_at) ?></small>
                                              <?php else: ?>
                                                  <a href="<?php echo(site_url('order_progress_detail/complate_order')) ?>/<?php echo $this->uri->segment(3); ?>/<?php echo($customer_detail[0]->order_detail_id) ?>" class=" btn btn-xs btn-primary"><i class="fa fa-briefcase"></i> Click here to complate order !</a>
                                              <?php endif ?>
                                              <a href="<?php echo(site_url('order_progress_detail/complate_order')) ?>/<?php echo $this->uri->segment(3); ?>/<?php echo($customer_detail[0]->order_detail_id) ?>" class=" btn btn-xs btn-danger"><i class="fa fa-times"></i> Cancel Order !</a>
                                      <a href="#" class="orderremarks" data-orderremarksid="<?php echo($customer_detail[0]->order_id) ?>"><span class="label label-primary pull-right">Edit</span></a>
                                    <div class="box-tools pull-right">
                                    </div>
                                  </div>
                                  <div class="box-body">
                                    <?php echo ($customer_detail[0]->remarks) ?> 
                                      <?php if ($customer_detail[0]->updated_at!=null): ?>
                                           <small class="label label-default"><i class="fa fa-clock-o"></i> Updated  <?php echo($customer_detail[0]->updated_at); ?></small>
                                      <?php endif ?>
                                      <h1></h1>
                                      <div class="row">
                                          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                              <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>SN.</th>
                                                                <th>Status</th>
                                                                 <th>Date</th>
                                                                <th>Remarks</th>
                                                                <th>Updated By</th>
                                                                <?php if ($customer_detail[0]->complated_at==null): ?>
                                                                  <th>Action</th>
                                                                <?php endif ?>
                                                            </tr>
                                                          </thead>
                                                        <tbody>
                                                          <?php $count=1; ?>
                                                            <?php if ($remarks_progress): ?>
                                                            <?php foreach ($remarks_progress as $progress): ?>
                                                                <tr>
                                                                    <td><?php echo($count); $count++; ?></td>
                                                                    <td><?php echo($progress->status) ?></td>
                                                                    <td><?php echo($progress->date) ?></td>
                                                                    <td><?php echo($progress->remarks) ?></td>
                                                                    <td><?php echo($progress->username) ?> 
                                                                    <?php if ($progress->updated_at!=null): ?>
                                                                        <small class="label label-default"><i class="fa fa-clock-o"></i> Updated  <?php echo($progress->updated_at); ?></small>
                                                                    <?php endif ?></td>
                                                                    <?php if ($customer_detail[0]->complated_at==null): ?>
                                                                        <td><a href="#" class="btn_edit_status btn btn-xs btn-primary" data-orderprogressid="<?php echo($progress->order_progress_id) ?>"><i class="fa fa-edit"></i> Edit</a></td>
                                                                    <?php endif ?>
                                                                </tr>
                                                            <?php endforeach ?>
                                                      <?php endif ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                          </div>
                                      </div>
                                      <?php if ($customer_detail[0]->complated_at==null): ?>
                                          <div class="row">
                                              <div class="well">
                                                            <div class="row">
                                                                <form action="<?php echo(site_url('order_progress_detail/save_progress/'.$customer_detail[0]->order_detail_id.'/'.$this->uri->segment(3))) ?>" method="post">
                                                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                                      <div class="form-group">
                                                                          <label for="">Select Status</label>
                                                                           <select name="order_status" class="form-control" required="required">
                                                                              <option value="0">--Select Status--</option>
                                                                              <?php if ($order_status): ?>
                                                                                  <?php foreach ($order_status as $status): ?>
                                                                                        <option value="<?php echo($status->order_status_id) ?>"><?php echo($status->status) ?></option>
                                                                                  <?php endforeach ?>
                                                                              <?php endif ?>
                                                                            </select>  
                                                                      </div>
                                                                </div>

                                                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                                   <div class="form-group">
                                                                      <label for="">Date</label>
                                                                      <input type="date" name="date" class="form-control">

                                                                    </div>

                                                                </div>
                                                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                                   <div class="form-group">
                                                                      <label for="">Remarks</label>
                                                                      <input type="text" name="remarks" class="form-control"  placeholder="Remarks">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                                        <h1></h1>
                                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                                  
                                                                </div>
                                                               
                                                            </div>
                                                        </div>
                                                      </form>

                                          </div>
                                      <?php endif ?>
                                  </div><!-- /.box-body -->
                            </div>
                          <?php endif ?>
                        <?php $count=1; ?>
                          <?php foreach ($order_details as $order): ?>
                                <div class="box box-default collapsed-box">
                                      <div class="box-header with-border">
                                          <h3 class="box-title"><?php echo($count); $count++; ?>. <?php echo($order['order_details']->model_no) ?></h3>

                                            <?php if ($order['order_details']->complated_at!=null): ?>
                                                 <small class="label label-success"><i class="fa fa-check"></i> Complated !! <?php echo($order['order_details']->complated_at) ?></small>
                                            <?php endif ?>
                                            
                                          <div class="box-tools pull-right">
                                              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                              </button>
                                          </div>
                                          <!-- /.box-tools -->
                                      </div>
                                      <!-- /.box-header -->
                                      <div class="box-body" style="display: none;">
                                            <div class="pull-right">
                                                  <?php if ($order['order_details']->complated_at==null):?>
                                                      <a href="<?php echo(site_url('order_progress_detail/complate_order')) ?>/<?php echo $this->uri->segment(3); ?>/<?php echo($order['order_details']->order_detail_id) ?>" class=" btn btn-xs btn-primary"><i class="fa fa-briefcase"></i> Click here to complate order !</a>
                                                  <?php endif ?>
                                                    <a href="<?php echo(site_url('order_progress_detail/cancel_order')) ?>/<?php echo $this->uri->segment(3); ?>/<?php echo($order['order_details']->order_detail_id) ?>" class=" btn btn-xs btn-danger"><i class="fa fa-times"></i> Cancel This Order !</a>
                                              </div>
                                              <div class="row">
                                            
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="table-responsive">
                                                  <table class="table table-hover">
                                                    <thead>
                                                      <tr>
                                                        <th>SN.</th>
                                                        <th>Status</th>
                                                         <th>Date</th>
                                                        <th>Remarks</th>
                                                        <th>Updated By</th>
                                                        <?php if ($order['order_details']->complated_at==''): ?>
                                                           <th>Action</th>
                                                        <?php endif ?>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                      <?php $count=1; ?>
                                                      <?php if ($order['order_progress']): ?>
                                                            <?php foreach ($order['order_progress'] as $progress): ?>
                                                                <tr>
                                                                    <td><?php echo($count); $count++; ?></td>
                                                                    <td><?php echo($progress->status) ?></td>
                                                                    <td><?php echo($progress->date) ?></td>
                                                                    <td><?php echo($progress->remarks) ?></td>
                                                                    <td><?php echo($progress->username) ?>
                                                                    <?php if ($progress->updated_at!=null): ?>
                                                                        <small class="label label-default"><i class="fa fa-clock-o"></i> Updated   <?php echo($progress->updated_at); ?></small>
                                                                    <?php endif ?>
                                                                    </td>
                                                                    <?php if ($order['order_details']->complated_at==''): ?>
                                                                        <td><a href="#" class="btn_edit_status btn btn-xs btn-primary" data-orderprogressid="<?php echo($progress->order_progress_id) ?>"><i class="fa fa-edit"></i> Edit</a></td>
                                                                    <?php endif ?>
                                                                </tr>
                                                            <?php endforeach ?>
                                                      <?php endif ?>
                                                    </tbody>
                                                  </table>
                                                </div>
                                            </div>
                                          </div>
                                             <?php if ($order['order_details']->complated_at==''): ?>
                                                <div class="row">
                                                    <div class="well">
                                                        <div class="row">
                                                            <form action="<?php echo(site_url('order_progress/save/'.$order['order_details']->order_detail_id.'/'.$this->uri->segment(3))) ?>" method="post">
                                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                                  <div class="form-group">
                                                                      <label for="">Select Status</label>
                                                                       <select name="order_status" class="form-control" required="required">
                                                                          <option value="0">--Select Status--</option>
                                                                          <?php if ($order_status): ?>
                                                                              <?php foreach ($order_status as $status): ?>
                                                                                    <option value="<?php echo($status->order_status_id) ?>"><?php echo($status->status) ?></option>
                                                                              <?php endforeach ?>
                                                                          <?php endif ?>
                                                                        </select>  
                                                                  </div>
                                                            </div>

                                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                               <div class="form-group">
                                                                  <label for="">Date</label>
                                                                  <input type="date" name="date" class="form-control">

                                                                </div>

                                                            </div>
                                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                               <div class="form-group">
                                                                  <label for="">Remarks</label>
                                                                  <input type="text" name="remarks" class="form-control"  placeholder="Remarks">
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                                    <h1></h1>
                                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                              
                                                            </div>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif ?>
                                          
                                            </form>
                                          </div>
                                      </div>
                                      <!-- /.box-body -->
                                  </div>
                          <?php endforeach ?>
                </div><!-- /.box-body -->

          </div><!-- /.box -->

    </section>
    <!-- Main content -->

</div><!-- /.content-wrapper -->

<div class="modal fade" id="mdl_edit_status">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Edit Progress Status</h4>
      </div>
      <div class="modal-body">
            <form action="" method="POST" id="update_progress_form" role="form">
              <div class="form-group">
                  <label for="">Select Status</label>
                   <select name="order_status" id="order_status" class="form-control" required="required">
                      <option value="0">--Select Status--</option>
                      <?php if ($order_status): ?>
                          <?php foreach ($order_status as $status): ?>
                                <option value="<?php echo($status->order_status_id) ?>"><?php echo($status->status) ?></option>
                          <?php endforeach ?>
                      <?php endif ?>
                    </select>  
                    <span></span>
               </div>
               <div class="form-group">
                    <label for="">Date</label>
                    <input type="date" name="date" class="form-control" id="date">
                    <span></span>
                </div>
                <div class="form-group">
                    <label for="">Remarks</label>
                    <input type="text" name="remarks" class="form-control" id="remarks" placeholder="Input field">
                    <span></span>
                </div>
            </form>
      </div>
      <div class="modal-footer">
          <span class="label label-success pull-left" id="update_progress_message" style="display:none">order status updated successfully!</span>
        <button type="button" class="btn btn-primary" id="btn_update_progress">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="mdl_order_remarks">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Edit Order Remarks</h4>
      </div>
      <div class="modal-body">
          <form action="" method="POST" role="form" id="order_remarks_form">

            <div class="form-group">
              <label for="">Remarks</label>
              <input type="text" name="remarks" class="form-control" id="remarks" placeholder="Input field">
            </div>

          </form>
      </div>
      <div class="modal-footer">
      <span class="label label-success pull-left" id="update_remarks_message" style="display:none">Order Remarks updated successfully!</span>
        <button type="button" class="btn btn-primary" id="btn_update_remarks">Update</button>
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#update_progress_message').hide();
    $('#update_remarks_message').hide();
    var orderprogressid='';
    $('.btn_edit_status').click(function() {
       $('#mdl_edit_status').modal('show');
       orderprogressid=$(this).data('orderprogressid');
       get_order_progress(orderprogressid);
    });

    $('#btn_update_progress').click(function() 
    {
      upate_order_progress(orderprogressid);
    });

    var orderremarksid='';
    $('.orderremarks').click(function() 
    {
      orderremarksid=$(this).data('orderremarksid');
      $('#mdl_order_remarks').modal('show');
      get_remarks(orderremarksid);
    });

    $('#btn_update_remarks').click(function() {
        update_remarks(orderremarksid);
    });

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
   
  });

  function get_order_progress(progress_id) 
  {
    $.ajax({
      url: '<?php echo site_url("order_progress_detail/get_order_progress"); ?>'+'/'+'1/'+progress_id,
      type: 'POST',
      dataType: 'json',
      success:function(data)
      {
        console.log(data);
        $('#update_progress_form #date').val(data[0].date);
        $('#update_progress_form #remarks').val(data[0].remarks);
        $('#update_progress_form #order_status').val(data[0].order_status_id);
      },
      error:function(data) 
      {
        console.log(data);
        //alert(data.responseText);
      }
    });
    
  }

  function upate_order_progress(progress_id) 
  {
    $('#btn_update_progress').prop('disabled',true);
    $('#btn_update_progress').text('Updating...........');
    $.ajax({
      url: '<?php echo(site_url("order_progress/update")) ?>'+'/'+progress_id,
      type: 'POST',
      dataType: 'json',
      data: $('#update_progress_form').serialize(),
      success:function(data)
      {
        if(data.status===true)
        {
           $('#update_progress_message').show();
           //$('#mdl_edit_status').modal('hide');
           //$('update_progress_form #btn_update_progress').prop('disabled',false);
            location.reload();
        }
        else
        {
          console.log(data);
          $.each(data, function(index, val) {
              $('#update_progress_form #'+val.error_string).next().html(val.input_error);
             $('#update_progress_form #'+val.error_string).parent().parent().addClass('has-error');
          });
          $('update_progress_form #btn_update_progress').prop('disabled',false);
        }
       
      },
      error:function(data)
      {
        console.log(data);
      }

    });
    
  }

  function get_remarks(order_id) 
  {
      $.ajax({
        url: '<?php echo(site_url("order/get_remarks")) ?>'+'/'+order_id,
        type: 'POST',
        dataType: 'json',
        success:function(data)
        {
            if(data)
            {
              $('#order_remarks_form #remarks').val(data[0].remarks);
            }
        }
      });
      
  }

  function update_remarks(order_id) 
  {
    $('#btn_update_remarks').text('Updating.............');
    $('#btn_update_remarks').prop('disabled',true);
    $.ajax({
      url: '<?php echo(site_url("order/update_remarks")) ?>'+'/'+order_id,
      type: 'POST',
      dataType: 'json',
      data: $('#order_remarks_form').serialize(),
      success:function(data)
      {
         if (data) 
          {
            $('#update_remarks_message').show();
            location.reload();
          }
      },
      error:function(data)
      {
        alert(data);
      }
    });
    
  }
</script>
                          