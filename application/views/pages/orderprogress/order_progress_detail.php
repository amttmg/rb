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
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i
                            class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title=""
                            data-original-title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div id="container">
                    <div class="row">
                       <div class="col-md-6"> <div class="panel-default panel">
                               <div class="panel-heading"><h4 class="panel-title">Customer Details</h4></div>
                               <div class="panel-body">
                                   <div class="row">
                                       <div class="col-md-8">
                                           <table class="table">
                                               <tr>
                                                   <td class="text-bold">Name</td>
                                                   <td>:</td>
                                                   <td><?php echo $customer_detail[0]->fname . ' ' . $customer_detail[0]->mname . ' ' . $customer_detail[0]->lname ?></td>
                                               </tr>
                                               <tr>
                                                   <td class="text-bold">Address</td>
                                                   <td>:</td>
                                                   <td> <?php echo $customer_detail[0]->address ?></td>
                                               </tr>
                                               <tr>
                                                   <td class="text-bold">Phone</td>
                                                   <td>:</td>
                                                   <td> <?php echo $customer_detail[0]->phone1 ?></td>
                                               </tr>
                                           </table>
                                       </div>
                                       <div class="col-md-4">
                                           <img class="img-circle thumbnail pull-right" alt="Cinque Terre" height="136"
                                                src="<?php echo(base_url('uploads/' . $customer_detail[0]->customer_image)) ?>"">
                                       </div>
                                   </div>
                               </div>
                           </div></div>
                    </div>
                    <?php if ($customer_detail[0]->remarks != ''): ?>
                        <div class="panel panel-default">
                            <div class="panel-heading clearfix">
                                <h4 class="panel-title">Order Remarks</h4>

                                <?php if ($customer_detail[0]->order_detail_status == true): ?>
                                    <?php if ($customer_detail[0]->complated_at != null): ?>
                                        <small class="label label-success"><i class="fa fa-check"></i> Completed
                                            !! <?php echo($customer_detail[0]->complated_at) ?></small>
                                    <?php endif ?>
                                    <?php if (tag_check($customer_detail[0]->order_no)): ?>
                                        <small class="label label-success"><i class="fa fa-check"></i> Taged !!</small>
                                    <?php endif ?>

                                <?php else: ?>
                                    <small class="label label-danger"><i class="fa fa-clock-o"></i> Order Canceled !!
                                    </small>
                                <?php endif ?>

                                <!--                                      <a href="#" class="btn btn-primary orderremarks pull-right" data-orderremarksid="-->
                                <?php //echo($customer_detail[0]->order_id) ?><!--">Edit</a>-->
                                <!--                                    <div class="box-tools pull-right">-->
                                <!--                                    </div>-->
                            </div>
                            <div class="panel-body">
                                <?php if (!tag_check($customer_detail[0]->order_no)): ?>

                                    <h4 class="text-light-blue"><?php echo "Product Details: " . ($customer_detail[0]->remarks) ?></h4>

                                <?php else: ?>
                                    <h4 class="text-light-blue"><b>
                                            <?php
                                            echo "Model No: ";  ?> <a href="#" class="product_detail" data-productid="<?php echo(find_taged_product_id($customer_detail[0]->order_no)) ?>"> <?php echo find_taged_model_no($customer_detail[0]->order_no); ?></a>

                                           </b></h4>
                                <?php endif ?>


                                <?php if ($customer_detail[0]->updated_at != null): ?>
                                    <small class="label label-default"><i class="fa fa-clock-o"></i>
                                        Updated <?php echo($customer_detail[0]->updated_at); ?></small>
                                <?php endif ?>

                                <div class="pull-right" style="margin-bottom: 10px">
                                    <?php if ($customer_detail[0]->order_detail_status == true): ?>
                                        <?php if ($customer_detail[0]->complated_at == null): ?>
                                            <a href="<?php echo(site_url("order_progress_detail/complate_order" . '/' . $customer_detail[0]->order_id . '/' . $customer_detail[0]->order_detail_id)) ?>"
                                               onclick="return confirm('Are you sure want to complete this order ?')"
                                               class=" btn btn-xs btn-primary"><i class="fa fa-briefcase"></i> Complete
                                                this order !</a>
                                        <?php else: ?>
                                            <?php if (!tag_check($customer_detail[0]->order_no)): ?>
                                                <a href="#" class=" btn btn-xs btn-primary complate"
                                                   data-orderdetailid="<?php echo($customer_detail[0]->order_no) ?>"><i
                                                        class="fa fa-briefcase"></i> Tag to product !</a>
                                                <a href="#" data-orderno="<?php echo($customer_detail[0]->order_no) ?>"
                                                   class=" btn btn-xs btn-primary btn_add_product"><i
                                                        class="fa fa-briefcase"></i>Add to product !</a>
                                            <?php endif ?>
                                        <?php endif ?>
                                        <?php if (!tag_check($customer_detail[0]->order_no)): ?>
                                            <a href="<?php echo(site_url('order_progress_detail/cancel_order')) ?>/<?php echo $this->uri->segment(3); ?>/<?php echo($customer_detail[0]->order_detail_id) ?>"
                                               onclick="return confirm('Are you sure want to cancel this order?')"
                                               class=" btn btn-xs btn-danger"><i class="fa fa-times"></i> Cancel Order !</a>
                                        <?php endif ?>

                                    <?php endif ?>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>SN.</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th>Remarks</th>
                                                    <th>Updated By</th>
                                                    <?php if ($customer_detail[0]->complated_at == null && $customer_detail[0]->order_detail_status == true): ?>
                                                        <th>Action</th>
                                                    <?php endif ?>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $count = 1; ?>
                                                <?php if ($remarks_progress): ?>
                                                    <?php foreach ($remarks_progress as $progress): ?>
                                                        <tr>
                                                            <td><?php echo($count);
                                                                $count++; ?></td>
                                                            <td><?php echo($progress->order_status) ?></td>
                                                            <td><?php echo($progress->date) ?></td>
                                                            <td><?php echo($progress->remarks) ?></td>
                                                            <td><?php echo($progress->username) ?>
                                                                <?php if ($progress->updated_at != null): ?>
                                                                    <small class="label label-default"><i
                                                                            class="fa fa-clock-o"></i>
                                                                        Updated <?php echo($progress->updated_at); ?>
                                                                    </small>
                                                                <?php endif ?></td>
                                                            <?php if ($customer_detail[0]->complated_at == null && $customer_detail[0]->order_detail_status == true): ?>
                                                                <td><a href="#"
                                                                       class="btn_edit_status btn btn-xs btn-primary"
                                                                       data-orderprogressid="<?php echo($progress->order_progress_id) ?>"><i
                                                                            class="fa fa-edit"></i> Edit</a></td>
                                                            <?php endif ?>
                                                        </tr>
                                                    <?php endforeach ?>
                                                <?php endif ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <?php if ($customer_detail[0]->complated_at == null && $customer_detail[0]->order_detail_status == true): ?>
                                  <div class="panel panel-default">
                                    <div class="panel-footer">
                                        <form action="<?php echo(site_url('order_progress_detail/save_progress/' . $customer_detail[0]->order_detail_id . '/' . $this->uri->segment(3))) ?>"
                                              method="post">
                                            <div class="row">

                                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                    <div class="form-group">
                                                        <label for="">Select Status</label>
                                                        <select name="order_status" class="form-control"
                                                                required="required">
                                                            <option value="0">--Select Status--</option>
                                                            <?php if ($order_status): ?>
                                                                <?php foreach ($order_status as $status): ?>
                                                                    <option
                                                                        value="<?php echo($status->order_status_id) ?>"><?php echo($status->status) ?></option>
                                                                <?php endforeach ?>
                                                            <?php endif ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                    <div class="form-group">
                                                        <label for="">Date</label>
                                                        <input type="date" value="<?php echo getCurrentDate() ?>" name="date" class="form-control"
                                                               required="true">
                                                    </div>

                                                </div>
                                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                    <div class="form-group">
                                                        <label for="">Remarks</label>
                                                        <input type="text" name="remarks" class="form-control"
                                                               placeholder="Remarks" required="true">
                                                    </div>
                                                </div>
                                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                    <h1></h1>
                                                    <button type="submit" class="btn btn-primary">Add Progress</button>

                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                  </div>
                                <?php endif ?>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    <?php endif ?>
                    <?php $count = 1; ?>
                    <?php if (isset($order_details)): ?>
                    <?php foreach ($order_details as $order): ?>
                    <div class="box box-default collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <?php if (tag_check($order['order_details']->order_no)): ?>
                                    <h4><b><a href="#" class="product_detail" data-productid="<?php echo($order['order_details']->product_id) ?>"><?php echo(find_taged_model_no($order['order_details']->order_no)) ?></a></b>
                                    </h4>
                                <?php else: ?>
                                    <h4><b><?php echo($count);
                                    $count++; ?>. <a href="#" class="product_detail" data-productid="<?php echo($order['order_details']->product_id) ?>"><?php echo($order['order_details']->model_no) ?></a></b></h4>
                                <?php endif ?>

                            </h3>
                            <?php if ($order['order_details']->status != true): ?>
                                <small class="label label-danger"><i class="fa fa-check"></i> Order Canceled !!</small>
                            <?php else: ?>
                                <?php if ($order['order_details']->complated_at != null): ?>
                                    <small class="label label-success"><i class="fa fa-check"></i> Completed
                                        !! <?php echo($order['order_details']->complated_at) ?></small>
                                <?php endif ?>
                                <?php if (tag_check($order['order_details']->order_no)): ?>
                                    <small class="label label-success"><i class="fa fa-check"></i> Taged !!</small>
                                <?php endif ?>
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
                                <?php if ($order['order_details']->status == true): ?>

                                    <?php if ($order['order_details']->complated_at == null): ?>
                                        <a href="<?php echo(site_url("order_progress_detail/complate_order" . '/' . $order['order_details']->order_id . '/' . $order['order_details']->order_detail_id)) ?>"
                                           data-orderdetailid="<?php echo($order['order_details']->order_no) ?>"
                                           onclick="return confirm('Are you sure want to complete this order ?')"
                                           class=" btn btn-xs btn-primary"><i class="fa fa-briefcase"></i>Complete this
                                            product !</a>
                                    <?php else: ?>

                                        <?php if (!tag_check($order['order_details']->order_no)): ?>
                                            <a href="#"
                                               data-orderdetailid="<?php echo($order['order_details']->order_no) ?>"
                                               class=" btn btn-xs btn-primary complate"><i class="fa fa-briefcase"></i>Tag
                                                to product !</a>
                                            <a href="#"
                                               data-orderdetailid="<?php echo($order['order_details']->order_no) ?>"
                                               data-orderno="<?php echo($order['order_details']->order_no) ?>"
                                               class=" btn btn-xs btn-primary btn_add_product"><i
                                                    class="fa fa-briefcase"></i>Add to product !</a>
                                        <?php endif ?>

                                    <?php endif ?>
                                    <?php if (!tag_check($order['order_details']->order_no)): ?>
                                        <a href="<?php echo(site_url('order_progress_detail/cancel_order')) ?>/<?php echo $this->uri->segment(3); ?>/<?php echo($order['order_details']->order_detail_id) ?>"
                                           onclick="return confirm('Are you sure want to cancel this order ?')"
                                           class=" btn btn-xs btn-danger"><i class="fa fa-times"></i> Cancel This Order
                                            !</a>
                                    <?php endif ?>

                                <?php endif ?>

                            </div>
                            <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>SN.</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Remarks</th>
                                                <th>Updated By</th>
                                                <?php if ($order['order_details']->complated_at == '' && $order['order_details']->status == true): ?>
                                                    <th>Action</th>
                                                <?php endif ?>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $count = 1; ?>
                                            <?php if ($order['order_progress']): ?>
                                                <?php foreach ($order['order_progress'] as $progress): ?>
                                                    <tr>
                                                        <td><?php echo($count);
                                                            $count++; ?></td>
                                                        <td><?php echo($progress->status) ?></td>
                                                        <td><?php echo($progress->date) ?></td>
                                                        <td><?php echo($progress->remarks) ?></td>
                                                        <td><?php echo($progress->username) ?>
                                                            <?php if ($progress->updated_at != null): ?>
                                                                <small class="label label-default"><i
                                                                        class="fa fa-clock-o"></i>
                                                                    Updated <?php echo($progress->updated_at); ?>
                                                                </small>
                                                            <?php endif ?>
                                                        </td>
                                                        <?php if ($order['order_details']->complated_at == '' && $order['order_details']->status == true): ?>
                                                            <td><a href="#"
                                                                   class="btn_edit_status btn btn-xs btn-primary"
                                                                   data-orderprogressid="<?php echo($progress->order_progress_id) ?>"><i
                                                                        class="fa fa-edit"></i> Edit</a></td>
                                                        <?php endif ?>
                                                    </tr>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php if ($order['order_details']->complated_at == '' && $order['order_details']->status == true): ?>
                                <div class="row">
                                    <div class="well">
                                        <div class="row">
                                            <form
                                                action="<?php echo(site_url('order_progress/save/' . $order['order_details']->order_detail_id . '/' . $this->uri->segment(3))) ?>"
                                                method="post">
                                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                    <div class="form-group">
                                                        <label for="">Select Status</label>
                                                        <select name="order_status" class="form-control"
                                                                required="required">
                                                            <option value="0">--Select Status--</option>
                                                            <?php if ($order_status): ?>
                                                                <?php foreach ($order_status as $status): ?>
                                                                    <option
                                                                        value="<?php echo($status->order_status_id) ?>"><?php echo($status->status) ?></option>
                                                                <?php endforeach ?>
                                                            <?php endif ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                    <div class="form-group">
                                                        <label for="">Date</label>
                                                        <input type="date" value="<?php echo getCurrentDate() ?>" name="date" class="form-control"
                                                               required="required">

                                                    </div>

                                                </div>
                                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                    <div class="form-group">
                                                        <label for="">Remarks</label>
                                                        <input type="text" name="remarks" class="form-control"
                                                               placeholder="Remarks" required="required">
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
                <?php endif ?>
            </div>
            <!-- /.box-body -->

        </div>
        <!-- /.box -->

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
                                    <option
                                        value="<?php echo($status->order_status_id) ?>"><?php echo($status->status) ?></option>
                                <?php endforeach ?>
                            <?php endif ?>
                        </select>
                        <span></span>
                    </div>
                    <div class="form-group">
                        <label for="">Date</label>
                        <input type="date" value="<?php echo getCurrentDate() ?>" name="date" class="form-control" id="date">
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
<!-- modal for tag order to product -->

<div class="modal fade" id="modal_tag_product">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Tag Product</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="product_table">
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
                <!--  <button type="button" class="btn btn-primary">Tag</button> -->
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="mdl_add_products">
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
                                <input type="text" name="model_no" class="form-control" id="model_no"
                                       placeholder="Model Number">
                                <span></span>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="">Category</label>
                                <select name="category" id="category" class="form-control">
                                    <option value="0">-- Select Category --</option>
                                    <?php foreach ($product_categories as $category): ?>
                                        <option
                                            value="<?php echo($category->category_id) ?>"><?php echo($category->category) ?></option>
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
                                                            <select name="m_metaltype" id="m_metaltype"
                                                                    class="form-control" required="required">
                                                                <?php foreach ($metal_type as $metal): ?>
                                                                    <option
                                                                        value=""><?php echo($metal->metal_type) ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                            <span></span>
                                                        </div>

                                                    </td>
                                                    <td>
                                                        <div class="form-group" id="metal_dropdown">
                                                            <select name="m_metal" id="m_metal" class="form-control"
                                                                    required="required">
                                                                <option value="0">--Select metal--</option>

                                                            </select>
                                                            <span></span>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="form-group" id="weight">
                                                            <input type="text" name="m_weight" id="m_weight"
                                                                   class="form-control" placeholder="Weight">
                                                            <span></span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <button type="button" class="btn btn-primary"
                                                                    id="add_metalto_grid">Add
                                                            </button>
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
                                                        <select name="m_stone" id="m_stone" class="form-control"
                                                                required="required">
                                                            <option value="0">--select lot no--</option>
                                                            <?php foreach ($stones as $stone): ?>
                                                                <option
                                                                    value="<?php echo($stone->stone_id) ?>"><?php echo($stone->lot_no) ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                        <span></span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" name="m_pcs" id="m_pcs"
                                                               class="form-control" value="" placeholder="Pcs">
                                                        <span></span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" name="m_cts" id="m_cts"
                                                               class="form-control" value="" placeholder="Cts">
                                                        <span></span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <button type="button" class="btn btn-primary"
                                                                id="add_stoneto_togrid">Add
                                                        </button>
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
                                <input type="number" name="grossweight" class="form-control" id="grossweight"
                                       placeholder="Gross Weight">
                                <span></span>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <div class="form-group">
                                <label for="">Net Weight</label>
                                <input type="number" name="netweight" class="form-control" id="netweight"
                                       placeholder="Net Weight">
                                <span></span>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <div class="form-group">
                                <label for="">Weight loss</label>
                                <input type="number" name="weight_loss" class="form-control" id="weight_loss"
                                       placeholder="Net Weight">
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

<div class="modal fade" id="mdl_product_details">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Product Details</h4>
            </div>
            <div class="modal-body">
                <div id="product_details">
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {

        $('.product_detail').click(function() {    
           $.ajax({
               url: '<?php echo(site_url("product/product_detail_by_productid")) ?>'+'/'+$(this).data('productid'),
               type: 'POST',
               dataType: 'html',
               success:function(data)
               {
                    $('#mdl_product_details').modal('show')
                    $('#product_details').html(data);
               }
           });
           
           
        });

        $('#update_progress_message').hide();
        $('#update_remarks_message').hide();

        var productid = '';
        var orderprogressid = '';
        var orderdetailid = '';

        $('.btn_edit_status').click(function () {
            $('#mdl_edit_status').modal('show');
            orderprogressid = $(this).data('orderprogressid');
            get_order_progress(orderprogressid);
        });

        $('#btn_update_progress').click(function () {
            upate_order_progress(orderprogressid);
        });

        var orderremarksid = '';

        $('.orderremarks').click(function () {
            orderremarksid = $(this).data('orderremarksid');
            $('#mdl_order_remarks').modal('show');
            get_remarks(orderremarksid);
        });

        $('#btn_update_remarks').click(function () {
            update_remarks(orderremarksid);
        });

        $("input").change(function () {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("textarea").change(function () {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("select").change(function () {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });

        $('body').on('click', '.complate', function () {
            orderdetailid = $(this).data('orderdetailid');
            $('#modal_tag_product').modal('show');
        });

        var r = '';

        $('body').on('click', '.btn_tag_order', function () {
            r = confirm("Are you sure want to tag product ?");
            productid = $(this).data('productid');
            $('#modal_tag_product').modal('hide');
            //window.location.href = "<?php echo(site_url('order_progress_detail/view_progress')) ?>"+'/'+'<?php echo($this->uri->segment(3)) ?>';
            location.reload(true);

        });


        $('#modal_tag_product').on('hidden.bs.modal', function (e) {


            if (r === true) {
                $.ajax({
                    url: '<?php echo(site_url("tag_product/tag")) ?>' + '/' + productid + '/' + orderdetailid,
                    type: 'POST',
                    dataType: 'json',
                    success: function (data) {
                        location.reload(true);
                    },
                    error: function (data) {

                        console.log(data);
                    }
                });
            }


        })

    });

    function get_order_progress(progress_id) {
        $.ajax({
            url: '<?php echo site_url("order_progress_detail/get_order_progress"); ?>' + '/' + '1/' + progress_id,
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $('#update_progress_form #date').val(data[0].date);
                $('#update_progress_form #remarks').val(data[0].remarks);
                $('#update_progress_form #order_status').val(data[0].order_status_id);
            },
            error: function (data) {
                console.log(data);
                //alert(data.responseText);
            }
        });

    }

    function upate_order_progress(progress_id) {
        $('#btn_update_progress').prop('disabled', true);
        $('#btn_update_progress').text('Updating...........');
        $.ajax({
            url: '<?php echo(site_url("order_progress/update")) ?>' + '/' + progress_id,
            type: 'POST',
            dataType: 'json',
            data: $('#update_progress_form').serialize(),
            success: function (data) {
                if (data.status === true) {
                    $('#update_progress_message').show();
                    //$('#mdl_edit_status').modal('hide');
                    //$('update_progress_form #btn_update_progress').prop('disabled',false);
                    location.reload();
                }
                else {
                    console.log(data);
                    $.each(data, function (index, val) {
                        $('#update_progress_form #' + val.error_string).next().html(val.input_error);
                        $('#update_progress_form #' + val.error_string).parent().parent().addClass('has-error');
                    });
                    $('update_progress_form #btn_update_progress').prop('disabled', false);
                }

            },
            error: function (data) {
                console.log(data);
            }

        });

    }

    function get_remarks(order_id) {
        $.ajax({
            url: '<?php echo(site_url("order/get_remarks")) ?>' + '/' + order_id,
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                if (data) {
                    $('#order_remarks_form #remarks').val(data[0].remarks);
                }
            }
        });

    }

    function update_remarks(order_id) {
        $('#btn_update_remarks').text('Updating.............');
        $('#btn_update_remarks').prop('disabled', true);
        $.ajax({
            url: '<?php echo(site_url("order/update_remarks")) ?>' + '/' + order_id,
            type: 'POST',
            dataType: 'json',
            data: $('#order_remarks_form').serialize(),
            success: function (data) {
                if (data) {
                    $('#update_remarks_message').show();
                    location.reload();
                }
            },
            error: function (data) {
                alert(data);
            }
        });

    }
</script>

<script type="text/javascript">
    var i = 0;
    $('#product_table tfoot th').each(function () {
        i++;
        var title = $(this).text();
        $(this).html('<input type="text" class="search-input-text" placeholder="Search' + title + '" data-column="' + i + '" size="10"/>');
    });

    $('.search-input-text').keyup(function () {   // for text boxes
        var i = $(this).attr('data-column');  // getting column index
        var v = $(this).val();  // getting search input value
        table.columns(i).search(v).draw();
    });
    table = $('#product_table').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('product/product_order_datatable')?>",
            "type": "POST",
            "data": {'tag': 'yes'}
        },
        //Set column definition initialisation properties.
        "columnDefs": [
            {
                "targets": [-1, -2], //last column
                "orderable": false, //set not orderable
            },
        ],


    });

</script>

<script type="text/javascript">
    $(document).ready(function () {

        var order_no = '';
        $('body').on('click', '.btn_add_product', function () {
            $('#mdl_add_products').modal('show');
            order_no = $(this).data('orderno');
        });

        var selected_value = $('#m_metaltype').find("option:selected").text();
        var productid = '';
        fill_metal_combo(selected_value);//functon for fill metal combobox when page first load
        //add data to metal grid
        $('#add_metalto_grid').click(function () {
            if ($('#m_metal').val() === '0' || $('#m_unit').val() === '' || $('#m_weight').val() === '') {
                if ($('#m_metal').val() === '0') {
                    $('#m_metal').next().html('<p class="text-warning">Please select metal</p>');
                }
                if ($('#m_unit').val() === '') {
                    $('#m_unit').next().html('<p class="text-warning">Unit field is empty !</p>');
                }
                if ($('#m_weight').val() === '') {
                    $('#m_weight').next().html('<p class="text-warning">Weight field is empty !</p>');
                }

            }
            else {
                $('#metal_grid').append('<tr class="success"><td>' + $('#m_metaltype').find("option:selected").text() + '</td><td><input type="hidden" name="metal[]" value="' + $('#m_metal').val() + '">' + $('#m_metal').find("option:selected").text() + '</td><td><input type="hidden" name="weight[]" value="' + $('#m_weight').val() + '">' + $('#m_weight').val() + '</td><td><a href="#" class="remove"><span class="label label-danger">Remove</span></a></td></tr>');
                $('#m_metal').val('0');
                $('#m_unit').val('');
                $('#m_weight').val('');
            }

        });

        $('#add_stoneto_togrid').click(function () {

            if ($('#m_stone').val() === '0' || $('#m_pcs').val() === '' || $('#m_cts').val() === '') {
                if ($('#m_stone').val() === '0') {
                    $('#m_stone').next().html('<p class="text-warning">Please select stone</p>');
                }
                if ($('#m_pcs').val() === '') {
                    $('#m_pcs').next().html('<p class="text-warning">Pcs field is empty !</p>');
                }
                if ($('#m_cts').val() === '') {
                    $('#m_cts').next().html('<p class="text-warning">Cts field is empty !</p>');
                }

            }
            else {
                $('#stone_grid').append('<tr class="success"><td><input type="hidden" name="stone[]" value="' + $('#m_stone').val() + '">' + $('#m_stone').find("option:selected").text() + '</td><td><input type="hidden" name="pcs[]" value="' + $('#m_pcs').val() + '">' + $('#m_pcs').val() + '</td><td><input type="hidden" name="cts[]" value="' + $('#m_cts').val() + '">' + $('#m_cts').val() + '</td><td><a href="#" class="remove"><span class="label label-danger">Remove</span></a></td></tr>');
                //reseting value of input field
                $('#m_stone').val('0');
                $('#m_pcs').val('');
                $('#m_cts').val('');
            }

        });
        $("body").on("click", '.remove', function () {
            $(this).closest('tr').remove();
        });

        $('.modal').on('hidden.bs.modal', function () {
            $(this).find('form')[0].reset();
        });


        $('#m_metaltype').change(function () {
            selected_value = $('#m_metaltype').find("option:selected").text()
            if ($('#m_metaltype').val() !== '0') {
                fill_metal_combo(selected_value);
            }
        });

        //add new product 
        $('#btn_product_add').click(function () {
            var formData = new FormData($('#product_add_form')[0]);
            $(this).prop('disabled', true);
            $(this).text('Saving........');
            $.ajax({
                url: '<?php echo(site_url("product/add")) ?>' + '/' + order_no,
                type: 'POST',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: formData, /*$('#product_add_form').serialize(),*/
                success: function (data) {
                    console.log(data);
                    if (data.status == false) {
                        $('#btn_product_add').prop('disabled', false);
                        $('#btn_product_add').text('Save');
                        $.each(data, function (index, val) {
                            $('#product_add_form #' + val.error_string).next().html(val.input_error);
                            $('#product_add_form #' + val.error_string).parent().parent().addClass('has-error');
                        });

                    }
                    else {
                        $('#product_save_message').show();
                        location.reload();
                    }
                },
                error: function (data) {
                    console.log(data);
                    alert("An error occured please contact capital eye for technical support");
                }
            })
                .fail(function () {
                    console.log("error");
                });
        });

        $('#btn_product_update').click(function () {
            var formData = new FormData($('#product_update_form')[0]);
            $(this).prop('disabled', true);
            $(this).text('Updating........');
            $.ajax({
                url: '<?php echo(site_url("product/update")) ?>' + '/' + productid,
                type: 'POST',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: formData, /*$('#product_add_form').serialize(),*/
                success: function (data) {
                    console.log(data);
                    if (data.status == false) {
                        $('#btn_product_update').prop('disabled', false);
                        $('#btn_product_update').text('Update');
                        $.each(data, function (index, val) {
                            $('#product_update_form #' + val.error_string).next().html(val.input_error);
                            $('#product_update_form #' + val.error_string).parent().parent().addClass('has-error');
                        });

                    }
                    else {
                        $('#product_update_message').show();
                        location.reload();
                    }
                },
                error: function (data) {
                    $('#btn_product_update').prop('disabled', false);
                    alert("An error occured please contact capital eye for technical support");
                }
            })
                .fail(function () {
                    console.log("error");
                });
        });

    });

    function fill_metal_combo(metal_type) {
        $.ajax({
            url: '<?php echo(site_url("product/fill_metal_combo")) ?>' + '/' + metal_type,
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                $('#m_metal').empty();
                $('#m_metal').append('<option value="0">--Please select metal--</option>');
                $.each(data, function (index, val) {
                    var temp_opt = '<option value="' + val.metal_id + '">' + val.metal + '</option>';
                    $('#m_metal').append(temp_opt);
                });
            }
        })
            .done(function () {
                console.log("success");
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                console.log("complete");
            });

    }
</script>
