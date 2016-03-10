<div class="col-md-6">
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
<div class="col-md-6">

</div>