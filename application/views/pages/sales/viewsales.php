<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           View Sales
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
                <h3 class="box-title">Sales Bills</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
<!--                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>-->
                </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered" id="tblsales">
                    <thead>
                    <tr>
                        <th>
                            SN
                        </th>
                        <th>
                            Bill No
                        </th>
                        <th>
                            Customer
                        </th>
                        <th>
                           Sales Date
                        </th>
                        <th>
                            Entry Date
                        </th>
                        <th>
                            Bill Amount
                        </th>
                        <th>
                           Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $count=1; foreach($sales as $s){ ?>
                        <tr>
                            <td>
                                <?php echo $count; $count++ ?>
                            </td>
                            <td>
                               <?php echo  $s->bill_no ?>
                            </td>
                            <td>
                                <?php echo  $s->customer_id ?>
                            </td>
                            <td>
                                <?php echo  $s->sales_date ?>
                            </td>
                            <td>
                                <?php echo  $s->entry_date ?>
                            </td>
                            <td>
                                <?php echo  $s->gtotal_amount ?>
                            </td>
                            <td>
                                <a href="<?php echo base_url('sales/salesdetails/?salesid='.md5($s->sales_id)) ?>" class="btn btn-sm btn-primary">View Details</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
<script>
    $('#tblsales').DataTable();
</script>
            </div><!-- /.box-body -->
            <div class="box-footer">
                Footer
            </div><!-- /.box-footer-->
        </div><!-- /.box -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->