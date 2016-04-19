<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Orders
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <section class="content">
        <?php if ($this->session->flashdata('message')): ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong><?php echo($this->session->flashdata('message')) ?></strong>
            </div>
        <?php endif ?>
        <!-- Default box -->
        <div id="message">

        </div>
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
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title">Customer Order</h3></div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                <label for="">Swap Card</label>
                                                <input type="text" class="form-control" name="card_no" id="card_no">
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Customer Name</label>
                                                    <select name="customer" id="customer" class="form-control"
                                                            required="required">
                                                    </select>
                                                    <span></span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Order date</label>
                                                    <input type="date" name="order_date" class="form-control"
                                                           id="order_date"
                                                           placeholder="Order Date">
                                                    <span></span>
                                                </div>
                                                <span></span>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Deadline date</label>
                                                    <input type="date" name="deadline_date" class="form-control"
                                                           id="deadline_date"
                                                           placeholder="Order Date">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label>Advance payment</label>
                                                    <input type="text" name="discount" class="form-control"
                                                           id="discount"
                                                           placeholder="Advance Payment">
                                                    <span></span>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label>Remarks</label>
                                                    <textarea class="form-control" name="remarks" id="remarks"
                                                              rows="2"></textarea>
                                                    <span></span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="user_info" style="margin-top: 15px">
                                            <div class="panel-default panel">
                                                <div class="panel-heading"><h4 class="panel-title">Customer Details</h4></div>
                                                <div class="panel-body">
                                                    <div class="col-md-8">
                                                        <table class="table">
                                                            <tr>
                                                                <td class="text-bold">Name </td>
                                                                <td>:</td>
                                                                <td>.........</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold">Address </td>
                                                                <td>:</td>
                                                                <td>.........</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold">Phone </td>
                                                                <td>:</td>
                                                                <td>.........</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="thumbnail" style="height: 136px; width: 120px; background-color: #f5f5f5"> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="overlay" style="display:none">
                                            <i class="fa fa-refresh fa-spin"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div id="">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                            id="btn_reference_product"><i
                                                            class="fa a-folder-open"></i>Order from Reference
                                                    </button>
                                                </div>
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Model No</th>
                                                        <th>Price</th>
                                                        <th>Qty</th>
                                                        <th>Image</th>
                                                        <td>Remarks</td>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="product_container">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

<div class="modal fade" id="mdl_reference_product">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Reference Product List</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="product_table">
                        <thead>
                        <tr>
                            <th>Model Number</th>
                            <th>Category</th>
                            <th>Net Weight</th>
                            <th>Gross Weight</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Model Number</th>
                            <th>Category</th>
                            <th>Net Weight</th>
                            <th>Gross Weight</th>
                            <th>Price</th>
                        </tr>
                        </tfoot>

                    </table>

                </div>

            </div>
            <div class="modal-footer">
                <span class="label label-success pull-left" id="save_order_message" style="display:none">Ordered saved successfully !</span>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function () {
        $('.image-link').magnificPopup({type: 'image'});
        $('#save_order_message').hide();
        fill_combobox('order/fill_combobox', 'customer_list');

        $("input").change(function () {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
            $('#message').empty();
        });
        $("textarea").change(function () {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
            $('#message').empty();
        });
        $("select").change(function () {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
            $('#message').empty();
        });

        display_ordered_product();
        $('#btn_save_orders').click(function () {
            $('#btn_save_orders').prop('disabled', true);
            $('#btn_save_orders').text('Saving..........');

            $.ajax({
                url: '<?php echo(site_url("order/order_products")) ?>',
                type: 'POST',
                dataType: 'json',
                data: $('#product_order_form').serialize(),
                success: function (data) {

                    if (data.status === true) {
                        var message = '<div class="alert alert-success">';
                        message += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                        message += '<strong>Order saved successfully !</strong> </div>';
                        $('#message').append(message);
                        $('#save_order_message').show();
                        clearForm();
                        $('#product_order_form #btn_save_orders').prop('disabled', false);
                        $('#product_order_form #btn_save_orders').text('Save');
                        
                        $("html, body").animate({scrollTop: 0}, "slow");
                        return false;
                        display_ordered_product();
                    }
                    else {
                        $('#product_order_form #btn_save_orders').prop('disabled', false);
                        $('#product_order_form #btn_save_orders').text('Save');

                        $.each(data, function (index, val) {
                            $('#product_order_form #' + val.error_string).next().html(val.input_error);
                            $('#product_order_form #' + val.error_string).parent().parent().addClass('has-error');
                        });
                    }
                },
                error: function (data) {
                    console.log(data.responseText);
                }
            });

        });

        $("body").on("click", '.remove', function () {
            $(this).closest('tr').remove();
            var rowid = $(this).data('rowid');
            remove_product(rowid);//function call for remove ordered product
        });

        $('#btn_new_orders').click(function () {
            $('#mdl-order').modal('show');
        });

        $('#btn_reference_product').click(function () {
            $('#mdl_reference_product').modal('show');
        });
        $('body').on('click', '.btn_order_product', function () {
            var product_id = $(this).data('productid');
            $.ajax({
                url: '<?php echo(site_url("order/add_to_order")) ?>' + '/' + product_id,
                type: 'POST',
                dataType: 'json',
                success: function (data) {
                    if (data.status === true) {
                        alert('Product Successfully Added to cart');
                        display_ordered_product();
                    }
                    else {
                        alert('Something went wrong please contact capital eye for technical support');
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });

        });


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
    function clearForm() {
        $('#card_no').val('');
        $('#customer').val('');
        $('#order_date').val('');
        $('#deadline_date').val('');
        $('#discount').val('');
        $('#remarks').val('');
        $('#user_info').html('');
    }
    function display_ordered_product() {
        $('#product_container').empty();
        $.ajax({
            url: '<?php echo(site_url("order/display_ordered_products")) ?>',
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                if (data.status === true) {
                    $.each(data.products, function (index, val) {
                        var temp = '<tr>';
                        temp += '<td>';
                        temp += '<input type="hidden" name="model_no[]" class="form-control"  value="' + val.product_id + '">' + val.model_no;
                        temp += '</td>';
                        temp += '<td>';
                        temp += '<input type="hidden" name="price[]" class="form-control"  value="' + val.price + '">' + val.price;
                        temp += '</td>';
                        temp += '<td>'
                        temp += '<input type="hidden" name="qty[]" class="form-control"  value="' + val.qty + '">' + val.qty;
                        temp += '</td>';
                        temp += '<td>';
                        temp += '<a class="image-popup-link" href="' + val.image_url + '">';
                        temp += '<img src="' + val.image_url + '" width="50px"></a>';
                        temp += '</td>';
                        temp += '<td>';
                        temp += '<input type="text" name="product_remarks" id="product_remarks" >';
                        temp += '</td>';
                        temp += '<td>';
                        temp += '<a href="#" class="remove btn btn-danger btn-xs" data-rowid="' + val.row_id + '"><i class="glyphicon glyphicon-remove"></i> Remove</a>';
                        temp += '</td>';
                        temp += '</tr>';
                        $('#product_container').append(temp);
                    });

                }
                else {
                    alert('Something went wrong please contact capital eye for technical support');
                }
            },
            error: function (data) {
                console.log(data);
            }
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
    function remove_product(rowid) {
        $.ajax({
            url: '<?php echo(site_url("order/remove_ordered_product")) ?>' + '/' + rowid,
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                if (data.status === true) {
                    alert('successfully removed product');
                }
                else {
                    alert('Something went wrong ');
                }
            },
            error: function (data) {
                console.log(data);
                alert('Something went wrong please contact capital eye for technical support');
            }
        });

    }
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
<script type="text/javascript">
    var i = 0;
    $('#product_table tfoot th').each(function () {
        i++;
        var title = $(this).text();
        $(this).html('<input type="text" class="search-input-text" placeholder="Search' + title + '" data-column="' + i + '" size="10"/>');
    });

    $('.search-input-text').keyup(function () {   // for text boxes
        var i = $(this).attr('data-column');  // getting column index
        var v = $(this).val();  // getting search input value
        table.columns(i).search(v).draw();
    });
    table = $('#product_table').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('product/product_order_datatable')?>",
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [
            {
                "targets": [-1, -2], //last column
                "orderable": false, //set not orderable
            },
        ],


    });

</script>