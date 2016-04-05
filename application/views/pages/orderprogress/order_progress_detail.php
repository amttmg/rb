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
    <?php if ($this->session->flashdata('message')): ?>
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><?php echo($this->session->flashdata('message')) ?></strong>
          </div>
    <?php endif ?>
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
                        <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="<?php echo(base_url('uploads/'.$customer_detail[0]->customer_image)) ?>" alt="user image">
                            <span class="username">
                              <a href="#"><?php echo($customer_detail[0]->fname.' '.$customer_detail[0]->mname.' '.$customer_detail[0]->lname) ?></a>
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
                        <?php $count=1; ?>
                          <?php foreach ($order_details as $order): ?>
                                <div class="box box-default collapsed-box">
                                      <div class="box-header with-border">
                                          <h3 class="box-title"><?php echo($count); $count++; ?>. <?php echo($order['order_details']->model_no) ?></h3>

                                          <div class="box-tools pull-right">
                                              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                              </button>
                                          </div>
                                          <!-- /.box-tools -->
                                      </div>
                                      <!-- /.box-header -->
                                      <div class="box-body" style="display: none;">
                                          <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="table-responsive">
                                                  <table class="table table-hover">
                                                    <thead>
                                                      <tr>
                                                        <th>SN.</th>
                                                        <th>Remarks</th>
                                                        <th>Change Date</th>
                                                        <th>User Name</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                      <?php $count=1; ?>
                                                      <?php if ($order['order_progress']): ?>
                                                            <?php foreach ($order['order_progress'] as $progress): ?>
                                                                <tr>
                                                                    <td><?php echo($count); $count++; ?></td>
                                                                    <td><?php echo($progress->remarks) ?></td>
                                                                    <td><?php echo($progress->date) ?></td>
                                                                    <td><?php echo($progress->username) ?></td>
                                                                </tr>
                                                            <?php endforeach ?>
                                                      <?php endif ?>
                                                    </tbody>
                                                  </table>
                                                </div>
                                            </div>
                                          </div>

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
                                            </form>
                                          </div>
                                      </div>
                                      <!-- /.box-body -->
                                  </div>
                          <?php endforeach ?>
                        
                    </div>
                </div><!-- /.box-body -->
          </div><!-- /.box -->

    </section>
    <!-- Main content -->

</div><!-- /.content-wrapper -->
                          