
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
if(!$_COOKIE['order_cookies']) {    
    header('Location:http://heartofdarknessbrewery.com/');
    die();
}
include(APP_PATH."libs/head.php");
?>

<?php
    $_SESSION['paymemnt_status'] = 'Paid';
?>