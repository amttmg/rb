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
        <div id="message">
        </div>
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
                    <?php echo(form_open('sales/add', array('id' => 'sles_form'))); ?>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">Swap Card</label>
                                    <input type="number" name="card_no" id="card_no" class="form-control">
                                    <span></span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">Customer Name</label>
                                    <select name="customer" id="customer" class="form-control" required="required">
                                    </select>
                                    <span></span>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">Sales Date</label>
                                    <input type="date" value="<?php echo getCurrentDate() ?>" name="saledate"
                                           id="saledate" class="form-control"
                                           required="required"/>
                                    <span></span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">Bill No</label>
                                    <input type="billno" name="billno" id="billno" class="form-control"
                                           required="required"/>

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
                                        <div class="thumbnail pull-right" style="height: 136px; width: 120px; background-color: #f5f5f5" > </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="overlay" id="customer_overlay" style="display:none">
                            <i class="fa fa-refresh fa-spin"></i>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Orders</div>
                                <div id="tblcontent"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Products</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="">Model No.</label>
                                                <input type="text" name="m_model_no" class="form-control"
                                                       id="m_model_no" placeholder="Input model number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div id="order_content"></div>
                                            <div class="overlay" id="new_order_overlay" style="display: none;">
                                                <i class="fa fa-refresh fa-spin"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Selected Product</div>
                                <div class="panel-body">
                                    <table class="table table-bordered" id="selected_product">
                                        <thead>
                                        <tr>
                                            <th>
                                                SN
                                            </th>
                                            <th>
                                                Model No
                                            </th>
                                            <th>
                                                Product category
                                            </th>
                                            <th>
                                                Price
                                            </th>
                                            <th>
                                                Disount( % )
                                            </th>
                                            <th>
                                                Net. Price.
                                            </th>
                                            <th>
                                                Action
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody id="ordered_product">

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-lg-offset-8">
                            <table class="pull-right">
                                <tbody>
                                <fieldset>
                                    <tr>
                                        <th>Sub Total</th>
                                        <td>
                                            <input type="text" name="sub_total" id="sub_total" class="form-control"
                                                   readonly="readonly"></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>VAT(13%)&nbsp;</th>
                                        <td><input type="text" name="vat" id="vat" class="form-control"
                                                   readonly="readonly"></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Grand Total</th>
                                        <td><input type="text" name="grand_total" id="grand_total" class="form-control"
                                                   readonly="readonly"></td>
                                        <td></td>
                                    </tr>
                                </fieldset>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                    <button type="button" class="btn btn-primary pull-right" id="btn_sales">Save</button>
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

        $("input").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("textarea").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("select").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });


        $('body ').on('keyup', '.discount', function () {
            if ($(this).val() != '') {
                var net_price = parseFloat($(this).closest("td").next().find("input").val());
                var price = parseFloat($(this).closest("td").prev().find("input").val());
                var discount = parseFloat($(this).val());
                var total_net_price = price - (price * (discount / 100));
                $(this).closest("td").next().empty();
                $(this).closest("td").next().empty().html('<input type="hidden" name="net_price[]" class="net_price" value="' + total_net_price.toFixed(2) + '">' + total_net_price.toFixed(2));
                update_all();
            }
            else {
                var net_price = parseFloat($(this).closest("td").next().find("input").val());
                var price = parseFloat($(this).closest("td").prev().find("input").val());
                var discount = 0;
                var total_net_price = price - discount;
                $(this).closest("td").next().empty();
                $(this).closest("td").next().empty().html('<input type="hidden" name="net_price[]" class="net_price" value="' + total_net_price.toFixed(2) + '">' + total_net_price.toFixed(2));
                update_all();
            }

        });

        $('body').on('click', '.btnaddorder', function () {
            var data = '<tr><td></td>'
            data += '<td><input type="hidden" name="model_no[]" class="model_no" value="' + $(this).closest('tr').find('td:eq(0)').html() + '">' + $(this).closest('tr').find('td:eq(0)').html() + '</td>';
            data += '<td><input type="hidden" name="product_category[]" class="product_category" value="' + $(this).closest('tr').find('td:eq(1)').html() + '">' + $(this).closest('tr').find('td:eq(1)').html() + '</td>';
            data += '<td><input type="hidden" name="price[]" class="price" value="' + $(this).closest('tr').find('td:eq(7)').html() + '">' + $(this).closest('tr').find('td:eq(7)').html() + '</td>';
            data += '<td><input type="text" name="discount[]" class="discount" value="0"></td>';
            data += '<td><input type="hidden" name="net_price[]" class="net_price" value="' + $(this).closest('tr').find('td:eq(7)').html() + '">' + $(this).closest('tr').find('td:eq(7)').html() + '</td>';
            data += '<td><button type="button" class="remove btn btn-danger btn-sm">Remove</button></td></tr>';
            $('#ordered_product').append(data);

            update_all();

            $(this).prop('disabled', true);
            $(this).append('<i class="fa fa-check"></i>');
        });

        $('body').on('click', '.remove', function () {
            var ans = confirm("Are you sure you want to remove ?");
            if (ans === true) {
                $(this).closest('tr').remove();
                update_all();
            }

        })

        $('#m_model_no').keypress(function (event) {

            if (event.keyCode === 13) {
                event.preventDefault();
                $('#new_order_overlay').show();
                show_order("na", $(this).val());
            }
        });

        $('body').on('click', '.btnaddneworder', function () {
            var data = '<tr><td></td>'
            data += '<td><input type="hidden" name="model_no[]" class="model_no" value="' + $(this).closest('tr').find('td:eq(0)').html() + '">' + $(this).closest('tr').find('td:eq(0)').html() + '</td>';
            data += '<td><input type="hidden" name="product_category[]" class="product_category" value="' + $(this).closest('tr').find('td:eq(1)').html() + '">' + $(this).closest('tr').find('td:eq(1)').html() + '</td>';
            data += '<td><input type="hidden" name="price[]" class="price" value="' + $(this).closest('tr').find('td:eq(5)').html() + '">' + $(this).closest('tr').find('td:eq(5)').html() + '</td>';
            data += '<td><input type="text" name="discount[]" class="discount" value="0"></td>';
            data += '<td><input type="hidden" name="net_price[]" class="net_price" value="' + $(this).closest('tr').find('td:eq(5)').html() + '">' + $(this).closest('tr').find('td:eq(5)').html() + '</td>';
            data += '<td><button type="button"  class="remove btn btn-danger btn-sm">Remove</button></td></tr>';
            $('#ordered_product').append(data);

            update_all();

            $(this).prop('disabled', true);
            $(this).append('<i class="fa fa-check"></i>');
        });

        $('#btn_sales').click(function () {
            $(this).prop('disabled', true);
            $(this).text('Saving.......');
            $.ajax({
                url: '<?php echo(site_url("sales/add")) ?>',
                type: 'POST',
                dataType: 'json',
                data: $('#sles_form').serialize(),
                success: function (data) {

                    if (data.status === false) {
                        $.each(data, function (index, val) {
                            $('#sles_form #' + val.error_string).next().html(val.input_error);
                            $('#sles_form #' + val.error_string).parent().parent().addClass('has-error');
                        });

                        $('#btn_sales').prop('disabled', false);
                        $('#btn_sales').text('Save');
                        $("html, body").animate({scrollTop: 0}, "slow");
                        return false;

                    }
                    else {

                        reset_form();//reset all input fields

                        $('#btn_sales').prop('disabled', false);
                        $('#btn_sales').text('Save');
                        reset_box();
                        var message = '<div class="alert alert-success">';
                        message += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                        message += '<strong>Sales saved successfully !</strong></div>';

                        $('#message').append(message);
                        $("html, body").animate({scrollTop: 0}, "slow");
                        return false;
                    }

                },
                error: function (data) {
                    console.log(data);
                }

            });

        });
    });

    $('#customer').change(function () {
        if ($(this).val()==='0') 
        {
            customer_info();
        }
        show_customer($(this).val());
        show_order($(this).val());
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
                        show_order(res);
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
            $('#customer_overlay').show('fast', function () {

                $.ajax({
                    url: '<?php echo(site_url("customer/get_customer_by_id")) ?>' + '/' + customer_id,
                    type: 'POST',
                    dataType: 'html',
                    success: function (data) {
                        $('#user_info').html(data);
                        $('#customer_overlay').hide();
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
    function show_order(customer_id='', model_no='') {
        if (model_no) {

            $.ajax({
                url: '<?php echo base_url('order/getActiveOrdersByModelNo') ?>/' + model_no,
                success: function (data) {
                    $('#new_order_overlay').hide();
                    if (data === '') {
                        $('#order_content').html("No Orders Found");
                    } else {
                        $('#order_content').html(data);
                    }

                }
            })

        }
        if (customer_id != 'na') {

            $.ajax({
                url: '<?php echo base_url('order/getActiveOrdersByCustomer') ?>/' + customer_id,
                success: function (data) {
                    if (data === '') {
                        $('#tblcontent').html("No Orders Found");
                    } else {
                        $('#tblcontent').html(data);
                    }

                }
            })

        }

    }


    function calculate_total_price() {
        var total = 0;
        $('#selected_product .price').each(function () {

            var temp = $(this).val();
            total = total + parseFloat(temp);
        });

        return (total);
        //return total;
    }

    function sb_total() {
        var total = 0;
        $('#selected_product .net_price').each(function () {

            var temp = $(this).val();
            total = total + parseFloat(temp);
        });
        return (total);
    }

    function calculate_vat(sb_total) {
        return parseFloat(sb_total) * 0.13;
    }

    function gnd_total(sb_total, vat) {
        return parseFloat(sb_total) + parseFloat(vat);
    }

    function update_all() {
        var sub_total = sb_total();
        $('#sub_total').val(sub_total.toFixed(2));

        var vat = calculate_vat(sb_total());
        $('#vat').val(vat.toFixed(2));

        var grand_total = gnd_total(sb_total(), calculate_vat(sb_total()));
        $('#grand_total').val(grand_total.toFixed(2));
    }

    function reset_box() {
        $('#order_content table').remove();
        $('#tblcontent table').remove();
        $('#selected_product tbody').empty();
    }

    function activate_disable_product(model_no) {

    }

    function reset_form () 
    {
         // $('#sles_form').find("input[type=text], textarea").val("");
          $(':input','#sles_form')
         .not(':button, :submit, :reset, :hidden')
         .val('')
         .removeAttr('checked')
         .removeAttr('selected');
         $('#customer').val('0');
         $('#sub_total').val('0');
         $('#vat').val('0');
         $('#grand_total').val('0');

    }


    function customer_info () 
    {
        var data='<div class="panel-default panel">';
            data+='<div class="panel-heading"><h4 class="panel-title">Customer Details</h4></div>';
            data+='<div class="panel-body">';
            data+='<div class="col-md-8">';
            data+='<table class="table">';
            data+='<tr><td class="text-bold">Name </td><td>:</td><td>.........</td></tr>';
            data+='<tr><td class="text-bold">Address </td> <td>:</td><td>.........</td></tr>';
            data+='<tr><td class="text-bold">Phone </td><td>:</td><td>.........</td></tr>';
            data+='</table></div><div class="col-md-4"><div class="thumbnail pull-right" style="height: 136px; width: 120px; background-color: #f5f5f5" > </div>';
            data+='</div></div></div>';
            
            $('#user_info').html(data);
    }
</script>
