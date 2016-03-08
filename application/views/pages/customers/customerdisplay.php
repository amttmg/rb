<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Customers
            <small></small>
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
                <h3 class="box-title">Customers</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered" id="tblcustomers">
                    <thead>
                    <tr>
                        <th>
                            SN
                        </th>
                        <th>
                            Full Name
                        </th>
                        <th>
                            Address
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Phone
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $count=1; foreach($customers as $cust){ ?>
                    <tr>
                        <td>
                            <?php echo $count ?>
                        </td>
                        <td>
                            <?php echo $cust->fname.' '.$cust->mname.' '.$cust->lname ?>
                        </td>
                        <td>
                            <?php echo $cust->address ?>
                        </td>
                        <td>
                            <?php echo $cust->email ?>
                        </td>
                        <td>
                            <?php echo $cust->phone1 ?>
                        </td>
                        <td>
                            <?php echo anchor( base_url('customer/customerdetails/'.$cust->customer_id),'View Details',array('href'=>'#', 'class'=>'btn btn-primary btn-sm btn-block') ) ?>
                        </td>
                    </tr>
                    <?php $cust++; } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                Footer
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->
