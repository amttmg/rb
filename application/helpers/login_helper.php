<?php

function isArray($data, $addition)
{
    ?>
    <table <?php echo $addition ?>>
        <?php foreach ($data as $key => $value) {
            echo '<th>' . $key . '</th>';
        } ?>
        <?php foreach ($data as $key => $value) {
            print_r($value);
        } ?>
    </table>
    <?php
}

function is_logged_in()
{
    $CI =& get_instance();
    if ($CI->session->userdata('logged_in')) {
        return true;
    } else {
        redirect('welcome', 'refresh');
    }

}

function checkSession()
{
    $CI =& get_instance();
    if ($CI->session->userdata('logged_in')) {
        redirect('home', 'refresh');
    }
}

function sendRandomPassword($email)
{

// the message
    $msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg, 70);

// send email
    mail("amt.tmg@gmail.com", "My subject", $msg);

}

function ordinal($number)
{
    $ends = array('th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th');
    if ((($number % 100) >= 11) && (($number % 100) <= 13))
        return $number . 'th';
    else
        return $number . $ends[$number % 10];
}

function checkaccess($url)
{
    $CI =& get_instance();
    if (!$CI->ion_auth->logged_in())
    {
        redirect('welcome', 'refresh');
    }
    $user = ($CI->ion_auth->user()->row());
    $group = $CI->ion_auth->get_users_groups($user->id)->row();
    $sql="select * from function_group inner join tbl_functions ON tbl_functions.function_id=function_group.function_id where group_id=$group->id and url='$url'";
    $data = $CI->db->query($sql);
    if ($data->num_rows() > 0) {
        return true;
    } else {
        return false;
    }


}

function getCurrentUserID(){
    $CI =& get_instance();
    $user = ($CI->ion_auth->user()->row());
    return $user->id;
}

function show_access_denied(){
    $CI =& get_instance();
    $CI->load->view('errors/access/accessdenied');
}
function currenturl(){
    $CI =& get_instance();
    return  $CI->router->fetch_class().'/'.$CI->router->fetch_method();
}

?>