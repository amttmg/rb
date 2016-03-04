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
                    <button class="btn btn-default btn-sm" id="btnnewpriority">New Customer Priority</button>
                </div>
                <!-- /. tools -->
            </div>
            <div class="box-body">
                <?php $count = 1;
                foreach ($priorities as $pr) {
                    ?>
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $count ?>) <?php echo $pr['priority']->title ?></h3>

                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div id="<?php echo 'div' .$pr['priority']->priority_id ?>">
                                <?php
                                $c = 1;
                                foreach ($pr['options'] as $opt) {
                                    echo '<p>' . $c . ') ' . $opt->option_title . '</p>';
                                    $c++;
                                }
                                ?>
                            </div>
                            <div class="col-xs-2" style="padding: 5px 5px 0px 0px!important;">
                                <input type="text" name="opt" class="form-control input-sm" placeholder="new option"
                                       id="txtnewoption<?php echo $pr['priority']->priority_id ?>">
                            </div>
                            <button class="btn btn-primary btn-sm btnnewoption"
                                    data-id="<?php echo $pr['priority']->priority_id ?>"
                                    style="margin: 5px 5px 0px 0px!important;">Add
                            </button>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <?php
                    $count++;
                } ?>


                <!-- /.box -->
            </div>
            <div class="box-footer clearfix">
                <!--                <button class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i>-->
                <!--                </button>-->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->

<div class="modal fade" tabindex="-1" role="dialog" id="modalnewpriority">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">New Customer Priority Entry</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="prioritytitle">Priority Title</label>
                        <input type="text" class="form-control" id="prioritytitle" name="prioritytitle">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $('#btnnewpriority').click(function () {
        $('#modalnewpriority').modal('show');
    })
    $('.btnnewoption').click(function () {
        var id = $(this).data('id');
        var opt = $('#txtnewoption' + id).val();

        $.ajax({
            url:'<?php echo base_url('customerpriority/addOption') ?>/'+opt+'/'+id,
            success:function(res){
                alert(res)
            }
        })
    });
</script>
