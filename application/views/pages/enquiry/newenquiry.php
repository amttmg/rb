<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            New Enquiry
            <!--            <small>it all starts here</small>-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Enquiry</a></li>
            <li class="active">New Enquiry</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box box-info">
            <div class="overlay" style="display:none">
                <i class="fa fa-refresh fa-spin"></i> Please wait.....
            </div>
            <div class="box-header with-border">
                <h3 class="box-title">Enter Customer Code or Swap Smart Card</h3>

                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i
                            class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i
                            class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-inline">
                            <div class="form-group">
                                <input name="cardno" type="number" class="form-control" id="card_no">
                                <!--                                <button class="btn btn-primary" id="btnsearch">Search</button>-->
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($this->session->flashdata('message')): ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i><?php echo $this->session->flashdata('message'); ?></h4>
                    </div>
                <?php endif ?>

                <br/>

                <div class="row collapse" id="divcustomer">

                </div>
            </div>
            <!-- /.box-body -->

        </div>
        <!-- /.box -->


    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
    $(document).ready(function () {
        $(document).ajaxStart(function () {
            $('.overlay').show();
        });
        $('#card_no').on('keypress', function (event) {
            if (event.keyCode == 13) {
                var card_no = $('#card_no').val();
                $.ajax({
                    url: '<?php echo base_url('Enquiry/getCustomer') ?>/' + card_no,
                    success: function (res) {
                        $('.overlay').hide();
                        $('#divcustomer').html(res);
                        $('#divcustomer').collapse('show');
                    }
                })
            }
        });
    })
</script>