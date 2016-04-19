<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo($total_orders); ?></h3>
                  <p>New Orders</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="<?php echo(site_url("order_progress" )); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-purple">
                <div class="inner">
                  <h3><?php echo($total_customer); ?></h3>
                  <p>New Users</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="<?php echo(site_url("customer" )); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo($total_enquiry) ?></h3>
                  <p>Customer Enquiry</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="<?php echo(site_url("enquiry" )) ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo($total_products); ?></h3>
                  <p>Unique Products</p>
                </div>
                <div class="icon">
                  <i class="glyphicon glyphicon-shopping-cart"></i>
                </div>
                <a href="<?php echo(site_url('product' )) ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">Latest Orders</h3>
                      <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div><!-- /.box-header -->
                    <div class="box-body" style="display: block;">
                      <div class="table-responsive">
                        <table class="table no-margin">
                          <thead>
                            <tr>
                              <th>Order ID</th>
                              <th>Item</th>
                              <th>Order Date</th>
                              <th>Deadline Date</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                              <?php if (isset($latest_orders)): ?>
                                  <?php foreach ($latest_orders as $order): ?>
                                    <tr>
                                      <td><?php echo $order['order_no']; ?></td>
                                      <td><?php echo($order['product_name']) ?></td>
                                      <td><?php echo($order['order_date']) ?></td>
                                      <td><?php echo($order['deadline_date']) ?></td>
                                      <td><span class="label label-info">Processing</span></td>
                                      <td><a href="<?php echo(site_url('order_progress_detail/view_progress'.'/'.$order['order_id'])) ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> View Detail</a></td>
                                    </tr>

                                  <?php endforeach ?>
                              <?php endif ?>
                          </tbody>
                        </table>
                      </div><!-- /.table-responsive -->
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix" style="display: block;">
                      <a href="<?php echo(site_url('order')) ?>" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                      <a href="<?php echo(site_url('order_progress')) ?>" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                    </div><!-- /.box-footer -->
                  </div>
            </div>
        </div>
    </section>

    <!-- Main content -->

</div><!-- /.content-wrapper -->