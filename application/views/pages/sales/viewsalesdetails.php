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
               <div class="col-md-6">
                   <div class="panel-default panel">
                       <div class="panel-heading">Customer Details</div>
                       <div class="panel-body">
                           <div class="col-md-8">
                               <table class="table">
                                   <tr>
                                       <td class="text-bold">Customer Name </td>
                                       <td>:</td>
                                       <td><?php echo $customer->fname.' '.$customer->mname.' '.$customer->lname ?></td>
                                   </tr>
                                   <tr>
                                       <td class="text-bold">Address </td>
                                       <td>:</td>
                                       <td> Kathmandu</td>
                                   </tr>
                                   <tr>
                                       <td class="text-bold">Phone </td>
                                       <td>:</td>
                                       <td> 9842411793</td>
                                   </tr>
                               </table>
                           </div>
                           <div class="col-md-4">
                               <img class="img-circle thumbnail pull-right" alt="Cinque Terre" height="136"
                                    src="<?php echo base_url('uploads/' . $customer->customer_image) ?>">
                           </div>
                       </div>
                   </div>
               </div>
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