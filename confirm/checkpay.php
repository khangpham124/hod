
<?php
session_start();
if(!$_COOKIE['order_cookies']) {    
    header('Location:http://heartofdarknessbrewery.com/');
    die();
}
?>
<?php
if($_COOKIE['methodPay']!='cod') {    
$_SESSION['paymemnt_status'] = 'Paid';
}
header('Location:http://heartofdarknessbrewery.com/confirm/');
?>