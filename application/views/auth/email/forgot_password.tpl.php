<html>
<body>
<div style="width:600px;border:2px #ccc solid;background:#f2f2f2;padding:15px;margin-left:auto;margin-right:auto">
    <div style="width:70%;margin-left:17%"><img src="<?php echo base_url('images/logo/logo.png') ?>">
    </div>
    <br>
    <hr>
    Hello User, <br><br><?php echo sprintf(lang('email_forgot_password_heading'), $identity);?>
    <p><?php echo sprintf(lang('email_forgot_password_subheading'), anchor('users/reset_password/'. $forgotten_password_code, lang('email_forgot_password_link')));?></p>
    <br><br>Best Regards,<br>RB Diamond
</div>
</body>
</html>
