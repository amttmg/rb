
<html>
<head>

    <link rel="stylesheet" href="<?php echo base_url() ?>template/bootstrap/css/bootstrap.min.css">
    <script src="<?php echo base_url() ?>template/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="<?php echo base_url() ?>template/plugins/validation/jquery.validate.min.js"></script>
</head>
<title>

</title>

<body>
<div class="col-md-4 col-lg-offset-4">
    <img
        src="<?php echo base_url('images/logo/logo.png') ?>"
        class="CToWUd" height="140px">

    <div class="panel panel-default">
        <div class="panel-heading"><h2 class="panel-title">New Password</h2></div>
        <div class="text-center"><?php echo $message;?></div>
        <?php echo form_open('users/reset_password/' . $code);?>
        <div class="panel-body">
                <div class="form-group">
                    <label>New Password</label>
                    <?php echo form_input($user_id);?>
                    <?php echo form_hidden($csrf); ?>
                    <?php echo form_input($new_password);?>
                    <?php echo(form_error('new')) ?>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <?php echo form_input($new_password_confirm);?>
                    <?php echo(form_error('new_confirm')) ?>
                </div>

            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-primary btn-sm">Save</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>

