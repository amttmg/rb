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
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Swap Card</label>
                                    <input type="number" name="card_no" id="card_no" class="form-control">
                                    <span></span>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Customer Name</label>
                                    <select name="customer" id="customer" class="form-control" required="required">
                                    </select>
                                    <span></span>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div id="user_info" style="margin-top: 15px">
                                </div>
                                <div class="overlay" style="display:none">
                                    <i class="fa fa-refresh fa-spin"></i>
                                </div>


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Sales Date</label>
                                    <input type="date" value="<?php echo getCurrentDate() ?>" name="saledate"
                                           id="saledate" class="form-control"
                                           required="required"/>
                                    <span></span>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="">Bill No</label>
                                    <input type="billno" name="billno" id="billno" class="form-control"
                                           required="required"/>
                                    </select>
                                    <span></span>
                                </div>
                            </div>
                        </div>

                        <div class="row well">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>
                                        Order No
                                    </th>
                                    <th>
                                        Model No
                                    </th>
                                    <th>
                                        Order Date
                                    </th>
                                    <th>
                                        Deadline
                                    </th>
                                    <th>
                                        Category
                                    </th>
                                    <th>
                                        Product Name
                                    </th>
                                    <th>
                                        Gross Weight
                                    </th>
                                    <th>
                                        Net. Weight
                                    </th>
                                    <th>
                                        Weight Loss
                                    </th>
                                    <th>
                                        Price
                                    </th>
                                    <th>
                                        Image
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
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
        show_customer($(this).val());
    });

    $('#card_no').on('keypress', function (event) {
        if (event.keyCode == 13) {
            var card_no = $('#card_no').val();
            $.ajax({
                url: '<?php echo base_url('customer/getCustomerID') ?>/' + card_no,
                success: function (res) {

                    if (res > 0) {
                        $('#customer').val(res);
                        show_customer(res);
                    }
                    else {
                        $('#user_info').html("Sorry ! Costumer is not found");
                        $('#customer').val(0);
                    }
                }
            })
        }
    });
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
    function show_customer(customer_id) {

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
    }
</script>
