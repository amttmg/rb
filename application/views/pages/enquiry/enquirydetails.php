
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

            </div>
            <div class="box-body">
                <table class="table table-bordered" id="tblcustomers">
                    <thead>
                    <tr>
                        <th>
                            SN
                        </th>
                        <th>
                            Customer Name
                        </th>
                        <th>
                            Enquiry item
                        </th>
                        <th>
                            Enquiry type
                        </th>
                        <th>
                           Intended purchase mode
                        </th>
                        <th>
                            Enquiry date
                        </th>
                        <th>
                            followup date
                        </th>
                        <th>
                            Min price range
                        </th>
                        <th>
                            Max price range
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $sn=1; ?>
                    <?php if ($enquirydetails): ?>
                         <?php foreach ($enquirydetails as $enquiry): ?>
                            <tr>
                                <td><?php echo($sn) ?></td>
                                <td><?php echo($enquiry->fname) ?></td>
                                <td><?php echo($enquiry->enquiry_items) ?></td>
                                <td><?php echo($enquiry->enquiry_type) ?></td>
                                <td><?php echo($enquiry->intended_purchasemode) ?></td>
                                <td><?php echo($enquiry->enquiry_date) ?></td>
                                <td><?php echo($enquiry->followup_date) ?></td>
                                <td><?php echo($enquiry->price_range_min) ?></td>
                                <td><?php echo($enquiry->price_range_max) ?></td>
                             </tr>

                            <?php $sn++;  ?>
                         <?php endforeach ?>
                    <?php endif ?>
                    </tbody>
                </table>
            </div>

        </div>

    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- DataTables -->

<script>
    $('#tblcustomers').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true
    });
</script>
