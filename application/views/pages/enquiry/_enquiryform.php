<script type="text/javascript" src="<?php echo(base_url('assets/jquery.toast.min.js')) ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo(base_url('assets/jquery.toast.min.css')) ?>">

<script type="text/javascript">


    $(document).ready(function() {
        $('#save').prop('disabled',true);
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

        $('#enquiry_items').blur(function() {

            $.ajax({
                url: '<?php echo(site_url("product/product_status")) ?>'+'/'+$(this).val(),
                type: 'POST',
                success:function(data)
                {
                    if(data==='true')
                    {
                        $('#status_success').remove();
                        $('#enquiry_items').before('<label class="control-label" id="status_success" for="inputSuccess"><i class="fa fa-check"></i></label>');
                        $('#enquiry_items').parent().parent().addClass('has-success');
                        $('.overlay').hide();
                        $('#save').prop('disabled',false);
                    }
                    else
                    {
                        $('#save').prop('disabled',true);
                        $('#status_success').remove();
                        $('#enquiry_items').next().html('<p class="text-danger">Product not found with given model number !!</p>');
                        $('#enquiry_items').parent().parent().addClass('has-error');
                        $('.overlay').hide();
                    }
                }
            })
            .done(function() {
                console.log("success");
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
            
          
        });
        
        $('#save').click(function() {
            var formData = new FormData($('#myform')[0]);
            $.ajax({
            url: '<?php  echo site_url("enquiry/addEnquiry"); ?>',
            type: 'POST',
            dataType: 'json',
            data:formData,
            cache: false,
            contentType: false,
            processData: false,
            success:function(data){
                 $('.overlay').hide();
                if (data.status==false)
                    {
                        $.each(data, function(index, val)
                        {

                            $('#'+val.error_string).next().html(val.input_error);
                            $('#'+val.error_string).parent().parent().addClass('has-error');
                            console.log(val.input_error);

                        });
                    }
                    else
                    {
                        $('#save').prop('disabled', true);
                        $.toast({
                            text: data.message,
                            position: 'mid-center',
                            stack: false,
                            icon: 'success',
                            afterHidden: function () {
                                $(':input','#myform')
                                 .not(':button, :submit, :reset, :hidden')
                                 .val('')
                                 .removeAttr('checked')
                                 .removeAttr('selected');
                                 $('#save').prop('disabled', false);
                                }
                            })
                    }
            }
        })
        .fail(function() {
            console.log("error");
        })

        });

    });
</script>
<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header with-border">Customer Info</div>
        <div id="message" style="display:none">
            <div>successfully saved data</div>
        </div>
        <div class="box-body">
            <div class="col-md-8">
            <div id="data">
            </div>
                <table class="table table-bordered">
                    <tr>
                        <td>
                            Full Name
                        </td>
                        <td>
                            <?php echo $customer->fname . ' ' . $customer->mname . ' ' . $customer->lname ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Address
                        </td>
                        <td>
                            <?php echo $customer->address ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Email
                        </td>
                        <td>
                            <?php echo $customer->email ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Phone
                        </td>
                        <td>
                            <?php echo $customer->phone1 ?>
                        </td>
                    </tr>

                </table>
            </div>
            <div class="col-md-4">
                <img class="image thumbnail"
                     src="<?php echo base_url('uploads/' . $customer->customer_image) ?>" height="150px">
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header with-border">Enquiry Form</div>
        <div class="box-body">
            <?php echo form_open_multipart('enquiry/addEnquiry', array('id' => 'myform')); ?>
<input type="hidden" name="customer_id" value="<?php echo $customer->customer_id ?>">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Enquiry Date</label>
                        <input
                         type="date" class="form-control" name="enquiry_date" id="enquiry_date"
                               placeholder="Enquiry date" value="<?php echo(set_value('enquiry_date')) ?>">
                               <span class="help-block"></span>
                        <?php echo(form_error('enquiry_date')) ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Enquiry Time</label>
                        <input type="time" class="form-control" name="enquiry_time" id="enquiry_time"
                               placeholder="Enquiry Time" value="<?php echo(set_value('enquiry_time')) ?>">
                               <span class="help-block"></span>
                        <?php echo(form_error('enquiry_time')) ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Enquiry Type</label>
                        <select name="enquiry_type" id="enquiry_type" class="form-control">
                            <option value="">Select Enquiry Type</option>
                            <?php foreach ($enquiry_type as $type) {
                                ?>
                                <option value="<?php echo $type->enquirytype_id ?>"><?php echo $type->enquiry_type ?></option>
                                <?php
                            } ?>
                        </select>
                        <!--                        <input required type="text" class="form-control" name="enquiry_type" id="enquiry_type"-->
                        <!--                               placeholder="Enquiry Type" value="-->
                        <?php //echo(set_value('enquiry_type')) ?><!--">-->
                         <span class="help-block"></span>
                        <?php echo(form_error('enquiry_type')) ?>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Followup Date</label>
                        <input required type="date" class="form-control" name="followup_date" id="followup_date"
                               placeholder="Followup date" value="<?php echo(set_value('followup_date')) ?>">
                                <span class="help-block"></span>
                        <?php echo(form_error('followup_date')) ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Enquired Model No</label>
                        <input type="text" class="form-control" name="enquiry_items" id="enquiry_items"
                               placeholder="Enquiry Items" value="<?php echo(set_value('enquiry_items')) ?>">
                                <span class="help-block"></span>
                        <?php echo(form_error('enquiry_items')) ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Intended Purchase Mode</label>
                       <select name="intended_purchasemode" class="form-control">
                           <option value="Cash">Cash</option>
                           <option value="Credit Card">Credit Card</option>
                       </select>
                        <span class="help-block"></span>
                        <?php echo(form_error('intended_purchasemode')) ?>
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">Price Min</label>
                        <input required type="number" class="form-control" name="price_range_min" id="price_range_min"
                               placeholder="Price Min" value="<?php echo(set_value('price_range_min')) ?>">
                                <span class="help-block"></span>
                        <?php echo(form_error('price_range_min')) ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">Price Max</label>
                        <input required type="number" class="form-control" name="price_range_max" id="price_range_max"
                               placeholder="Price Max" value="<?php echo(set_value('price_range_max')) ?>">
                                <span class="help-block"></span>
                        <?php echo(form_error('price_range_max')) ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Reference Image</label>
                        <input type="file" class="form-control" name="reference_img" id="reference_img"
                               placeholder="Reference Image" value="<?php echo(set_value('reference_img')) ?>">
                               <span class="help-block"></span>
                        <?php echo(form_error('reference_img')) ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Remarks</label>
                        <input required type="text" class="form-control" name="remarks" id="remarks"
                               placeholder="Remarks" value="<?php echo(set_value('remarks')) ?>">
                                <span class="help-block"></span>
                        <?php echo(form_error('remarks')) ?>
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="button" id="save"  class="btn btn-primary btn-sm">Save </button>
                    <button type="submit" class="btn btn-primary btn-sm">Order Product</button>
                </div>
            </div>
            <?php echo(form_close()) ?>
        </div>

    </div>
</div>