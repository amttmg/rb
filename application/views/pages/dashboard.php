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
                              <th>Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><a href="pages/examples/invoice.html">OR9842</a></td>
                              <td>Call of Duty IV</td>
                              <td><span class="label label-success">Shipped</span></td>
                              
                            </tr>
                           
                          </tbody>
                        </table>
                      </div><!-- /.table-responsive -->
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix" style="display: block;">
                      <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                      <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                    </div><!-- /.box-footer -->
                  </div>
            </div>

            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Recently Added Products</h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <ul class="products-list product-list-in-box">
                      <li class="item">
                        <div class="product-img">
                          <img src="dist/img/default-50x50.gif" alt="Product Image">
                        </div>
                        <div class="product-info">
                          <a href="javascript::;" class="product-title">Samsung TV <span class="label label-warning pull-right">$1800</span></a>
                          <span class="product-description">
                            Samsung 32" 1080p 60Hz LED Smart HDTV.
                          </span>
                        </div>
                      </li><!-- /.item -->
                      <li class="item">
                        <div class="product-img">
                          <img src="dist/img/default-50x50.gif" alt="Product Image">
                        </div>
                        <div class="product-info">
                          <a href="javascript::;" class="product-title">Bicycle <span class="label label-info pull-right">$700</span></a>
                          <span class="product-description">
                            26" Mongoose Dolomite Men's 7-speed, Navy Blue.
                          </span>
                        </div>
                      </li><!-- /.item -->
                      <li class="item">
                        <div class="product-img">
                          <img src="dist/img/default-50x50.gif" alt="Product Image">
                        </div>
                        <div class="product-info">
                          <a href="javascript::;" class="product-title">Xbox One <span class="label label-danger pull-right">$350</span></a>
                          <span class="product-description">
                            Xbox One Console Bundle with Halo Master Chief Collection.
                          </span>
                        </div>
                      </li><!-- /.item -->
                      <li class="item">
                        <div class="product-img">
                          <img src="dist/img/default-50x50.gif" alt="Product Image">
                        </div>
                        <div class="product-info">
                          <a href="javascript::;" class="product-title">PlayStation 4 <span class="label label-success pull-right">$399</span></a>
                          <span class="product-description">
                            PlayStation 4 500GB Console (PS4)
                          </span>
                        </div>
                      </li><!-- /.item -->
                    </ul>
                  </div><!-- /.box-body -->
                  <div class="box-footer text-center">
                    <a href="javascript::;" class="uppercase">View All Products</a>
                  </div><!-- /.box-footer -->
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->

</div><!-- /.content-wrapper -->