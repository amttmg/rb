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
        <div class="panel-body">

            <div class="form-group">
                <label>New Password</label>
                <input type="hidden" name="identity" value="<?php echo $user->identity ?>">
                <input type="text" name="new" id="new" class="form-control">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="text" name="new_confirm" id="new_confirm" class="form-control">
            </div>

        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-primary btn-sm">Active Account</button>
            <button type="submit" class="btn btn-primary btn-sm">Login Page</button>
        </div>
    </div>
</div>
</body>
</html>