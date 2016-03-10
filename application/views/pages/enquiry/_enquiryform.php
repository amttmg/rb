<div class="col-md-12">
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
            <tr>
                <td>
                    Gender
                </td>
                <td>
                    <?php echo $customer->gender ?>
                </td>
            </tr>
            <tr>
                <td>
                    Date of birth
                </td>
                <td>
                    <?php echo $customer->dob ?>
                </td>
            </tr>
            <?php if ($customer->marital_status) { ?>
                <tr>
                    <td>
                        Anniversary Date
                    </td>
                    <td>
                        <?php echo $customer->anniversary_date ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <div class="col-md-4">
        <img class="image thumbnail"
             src="<?php echo base_url('uploads/' . $customer->customer_image) ?>" height="200px">
    </div>
</div>
<hr>
<div class="col-md-12">
Hello Hello
</div>