<div class="content-wrapper">


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            New Sales
            <small>New Sales</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <section class="content">

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
                    <form action="" method="POST" role="form" id="product_order_form">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">Sales Date</label>
                                    <input type="date" value="<?php echo getCurrentDate() ?>" name="saledate" id="saledate" class="form-control"
                                           required="required"/>
                                    <span></span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">Bill No</label>
                                    <input type="billno" name="billno" id="billno" class="form-control"
                                           required="required"/>
                                    </select>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">Customer Name</label>
                                    <select name="customer" id="customer" class="form-control" required="required">
                                    </select>
                                    <span></span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div id="user_info">
                                </div>
                                <div class="overlay" style="display:none">
                                    <i class="fa fa-refresh fa-spin"></i>
                                </div>


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <button type="button" id="btnorder" data-customerid="<?php echo "21" ?>" class="btn btn-primary btn-sm">View Orders</button>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

                            </div>
                        </div>

                        <button type="button" class="btn btn-primary pull-right" id="btn_save_orders">Save</button>
                    </form>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- Main content -->

</div><!-- /.content-wrapper -->
<script>
    $(document).ready(function () {
        fill_combobox('order/fill_combobox', 'customer_list');
    })
    $('#customer').change(function () {
        var customer_id = $(this).val();
        if ($('#customer').val() !== '0') {
            $('.overlay').show('fast', function () {

                $.ajax({
                    url: '<?php echo(site_url("customer/get_customer_by_id")) ?>' + '/' + customer_id,
                    type: 'POST',
                    dataType: 'html',
                    success: function (data) {
                        $('#user_info').html(data);
                        $('.overlay').hide();
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });

            });
        }
        else {
            $('.overlay').hide();
        }
    });
    $('#btnorder').click(function(){
        $.ajax({
            url:'<?php echo base_url('order/getActiveOrdersByCustomer').'/' ?>'+$('#customer').val(),
            success:function(data){
                alert(data);
            }
        })
    })
    function fill_combobox(url, combo_id='') {

        $.ajax({
            url: '<?php echo(site_url()) ?>' + url,
            type: 'post',
            dataType: 'html',
            success: function (data) {
                $('#customer').html(data);
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
