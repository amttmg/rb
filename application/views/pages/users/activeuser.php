<html>
<head>
    <link rel="stylesheet" href="<?php echo base_url() ?>template/bootstrap/css/bootstrap.min.css">
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
        <form action="<?php echo base_url('users/setPassword') ?>" method="post">
            <div class="panel-body">

                <div class="form-group">
                    <label>New Password</label>
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <input type="hidden" name="code" value="<?php echo $code ?>">
                    <input type="hidden" name="identity" value="<?php echo $identity ?>">
                    <input type="text" name="password" id="password" class="form-control">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="text" name="confpassword" id="confpassword" class="form-control">
                </div>

            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-primary btn-sm">Active Account</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>