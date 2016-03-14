<script type="text/javascript">
     $(document).ready(function() {
        $("textarea").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("select").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $('#btn_update').click(function() {
            var formData = new FormData($('#myform')[0]);
            $.ajax({
            url: '<?php  echo site_url("enquiry/update_enquiry"); ?>',
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
                        location.reload();
                    }
            }
        })
        .fail(function() {
            console.log("error");
        })

        });

    });
</script>

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
                        <th>
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $sn=1; ?>
                    <?php if ($enquirydetails): ?>
                         <?php foreach ($enquirydetails as $enquiry): ?>
                            <?php $rw_class="" ;
                            if ($enquiry->en_status==0) {
                                $rw_class="danger";
                            }
                            ?>
                            <tr class="<?php echo($rw_class) ?>">
                                <td><?php echo($sn) ?></td>
                                <td><?php echo($enquiry->fname) ?></td>
                                <td><?php echo($enquiry->enquiry_items) ?></td>
                                <td><?php echo($enquiry->enquiry_type) ?></td>
                                <td><?php echo($enquiry->intended_purchasemode) ?></td>
                                <td><?php echo($enquiry->enquiry_date) ?></td>
                                <td><?php echo($enquiry->followup_date) ?></td>
                                <td><?php echo($enquiry->price_range_min) ?></td>
                                <td><?php echo($enquiry->price_range_max) ?></td>
                                <td><a  href='#editEnquiry' class="btnedit" data-enquiryid="<?php echo $enquiry->enquiry_id ?>"><span class="label label-primary">Edit</span></a>
                               <?php if ($enquiry->en_status==1): ?>
                                   <a href="<?php echo(site_url('enquiry/edit_enquiry/'.$enquiry->enquiry_id.'/'.$enquiry->en_status)) ?>"><span class="label label-info">Disable</span></a>
                               <?php else: ?>
                                   <a href="<?php echo(site_url('enquiry/edit_enquiry/'.$enquiry->enquiry_id.'/'.$enquiry->en_status)) ?>"><span class="label label-info">Enable</span></a>
                               <?php endif ?>
                                </td>
                             </tr>

                            <?php $sn++;  ?>
                         <?php endforeach ?>
                    <?php endif ?>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="modal fade" id="editEnquiry">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Edit Enquiry</h4>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open_multipart('enquiry/addEnquiry', array('id' => 'myform')); ?>
                        <input type="hidden" name="enquiry_id" id="enquiry_id">
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
                                                    <label for="">Enquiry Items</label>
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
                                        <?php echo(form_close()) ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btn_update">Update</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- DataTables -->

<script>
$('.btnedit').click(function(event) {
    var enqid= $(this).data('enquiryid');
    $('#enquiry_id').val(enqid);
    $.ajax({
        url: '<?php echo site_url("enquiry/get_enquiry"); ?>'+'/'+enqid,
        success:function (data) {
           var obj= jQuery.parseJSON(data);
            $.each(obj, function(index, val) {
                 $('#'+index).val(val);
            });
            $('#editEnquiry').modal('show');
        }
    })
    .fail(function() {
        console.log("error");
    })
    
});
    $('#tblcustomers').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true
    });
</script>
