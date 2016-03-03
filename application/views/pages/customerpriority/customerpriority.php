<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Customer Priority
            <small>Customer Priority is Behaviour of customers</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-info" style="position: relative;">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
                <i class="fa fa-user"></i>

                <h3 class="box-title">Customer Priority</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <button class="btn btn-default btn-sm">New Customer Priority</button>
                </div>
                <!-- /. tools -->
            </div>
            <div class="box-body">
                <?php $count=1; foreach($priorities as $pr){
                    ?>
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $count ?>) <?php echo $pr['priority']->title ?></h3>

                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <?php
                            $c=1;
                            foreach($pr['options'] as $opt){
                                echo $c.')'.$opt->option_title.'<br/>';
                                $c++;
                            }
                            ?>
                        </div>
                        <!-- /.box-body -->
                    </div>
                <?php
             $count++;   } ?>


                <!-- /.box -->
            </div>
            <div class="box-footer clearfix">
                <button class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i>
                </button>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->
