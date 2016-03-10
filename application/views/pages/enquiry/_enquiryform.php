<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header with-border">Customer Info</div>
        <div class="box-body">
            <div class="col-md-8">

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
        <div class="box-body">Hello</div>
    </div>
</div>