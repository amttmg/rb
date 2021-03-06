<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sales Details
            <small>All Sales Bills</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Sales Details</h3>

                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i
                            class="fa fa-minus"></i></button>
                    <!--                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>-->
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-5">
                    <div class="panel-default panel">
                        <div class="panel-heading">Sales Details</div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <table class="table">
                                    <tr>
                                        <td class="text-bold">Bill No</td>
                                        <td>:</td>
                                        <td> <?php echo $sales[0]->bill_no ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Sales Date</td>
                                        <td>:</td>
                                        <td> <?php echo $sales[0]->sales_date ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Entered By</td>
                                        <td>:</td>
                                        <td> <?php echo $sales[0]->user_id ?></td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="panel-default panel">
                        <div class="panel-heading">Customer Details</div>
                        <div class="panel-body">
                            <div class="col-md-8">
                                <table class="table">
                                    <tr>
                                        <td class="text-bold">Customer Name</td>
                                        <td>:</td>
                                        <td><?php echo $customer->fname . ' ' . $customer->mname . ' ' . $customer->lname ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Address</td>
                                        <td>:</td>
                                        <td><?php echo $customer->address ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">Phone</td>
                                        <td>:</td>
                                        <td><?php echo $customer->phone1 ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <img class="img-circle thumbnail pull-right" alt="Cinque Terre" height="100"
                                     src="<?php echo base_url('uploads/' . $customer->customer_image) ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel-default panel">
                        <div class="panel-heading">Items Details</div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <table class="table">
                                    <tr STYLE="background-color: #f5f5f5">
                                        <th>
                                            Model No.
                                        </th>
                                        <th>
                                            Product ID
                                        </th>
                                        <th>
                                            Gross Weight
                                        </th>
                                        <th>
                                            Net Weight
                                        </th>
                                        <th>
                                            Weight Loss
                                        </th>
                                        <th>
                                            Price
                                        </th>
                                        <th>
                                            Discount Per
                                        </th>
                                        <th>
                                            Discount Amount
                                        </th>
                                        <th>
                                            Net Price
                                        </th>
                                    </tr>
                                    <?php foreach ($sales_details as $sd) {

                                        ?>
                                        <tr>
                                            <td>
                                                <a href="#" data-productid="<?php echo $sd->product_id ?>" class="btnproductdetails"><?php echo $sd->model_no ?></a>
                                            </td>
                                            <td>
                                                <?php echo $sd->product_id ?>
                                            </td>
                                            <td>
                                                <?php echo $sd->gross_weight ?>
                                            </td>
                                            <td>
                                                <?php echo $sd->net_weight ?>
                                            </td>
                                            <td>
                                                <?php echo $sd->weight_loss ?>
                                            </td>
                                            <td>
                                                <?php echo $sd->price ?>
                                            </td>
                                            <td>
                                                <?php echo $sd->dis_per ?>
                                            </td>
                                            <td>
                                                <?php echo $sd->dis_amount ?>
                                            </td>
                                            <td>
                                                <?php echo $sd->net_price ?>
                                            </td>
                                        </tr>
                                        <?php
                                    } ?>
                                    <tr>
                                        <td colspan="7"></td>
                                        <td>Total</td>
                                        <td> <?php echo $sales[0]->total_amount ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7"></td>
                                        <td>Total Discount</td>
                                        <td> <?php echo $sales[0]->total_amount ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7"></td>
                                        <td>13 % Vat</td>
                                        <td> <?php echo $sales[0]->vat_amount ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7"></td>
                                        <td>Net Bill Amount</td>
                                        <td> <?php echo $sales[0]->gtotal_amount ?></td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="form-group">
                    <button class="btn btn-primary"><i class="glyphicon glyphicon-print"></i> Print Bill</button>
                </div>
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->
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
<script>
    $('.btnproductdetails').click(function () {
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
</script>