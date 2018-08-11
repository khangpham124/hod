<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
include(APP_PATH . '/hod/wp-load.php');
$id =  $_POST['id_customer'];
$fullname = $_POST['update_name'];
$phone =  $_POST['update_phone'];
$address =  $_POST['update_address'];
$city =  $_POST['update_city'];

$old_pass =  $_POST['oldPass'];
$new_pass =  $_POST['update_password'];
$re_pass =  $_POST['re_password'];
$md5_pass = md5($new_pass);

$new_post = array(
    'ID'    => $id,
	'post_status'   => 'publish',
	'post_type' => 'customer'
    );  
$pid = wp_update_post($new_post);
update_post_meta($id, 'cf_phone', $phone);
update_post_meta($id, 'cf_fullname', $fullname);
update_post_meta($id, 'cf_address', $address);
update_post_meta($id, 'cf_city', $city);
if(($old_pass!='')&&($new_pass!='')&&($re_pass!='')){
    update_post_meta($id, 'cf_pass', $md5_pass);
    session_destroy();
} else {
$_SESSION['customer']['fullname'] = $fullname;
$_SESSION['customer']['phone'] = $phone;
$_SESSION['customer']['address'] = $address;
$_SESSION['customer']['city'] = $city;
}
?>