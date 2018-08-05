<?php
include(APP_PATH."libs/head.php");
//echo $_SESSION['order_code'];
$vpc_AccessCode = md5('ECAFAB');
$vpc_MerchTxnRef=md5('test');
$vpc_Merchant= md5('SMLTEST');
$vpc_OrderInfo= md5($_COOKIE['order_hod']);
$vpc_Amount= md5('200000000');
$vpc_ReturnURL= md5('http://heartofdarknessbrewery.com/confirm/checkpay.php');
$vpc_BackURL= md5('http://heartofdarknessbrewery.com/confirm/checkpay.php');
$vpc_Locale= md5('vn');
$vpc_CurrencyCode= md5('VND');
$vpc_TicketNo = md5('210.245.0.11');
$vpc_PaymentGateway= md5('ATM');
$vpc_CardType= md5('SML');
$vpc_SecureHash = md5('test');

$url_napas = 'https://sandbox.napas.com.vn/gateway/vpcpay.do?vpc_Version=2.0&vpc_Command=pay&vpc_AccessCode='.$vpc_AccessCode.'&vpc_MerchTxnRef='.$vpc_MerchTxnRef.'&vpc_Merchant='.$vpc_Merchant.'&vpc_OrderInfo='.$vpc_OrderInfo.'&vpc_Amount='.$vpc_Amount.'&vpc_ReturnURL='.$vpc_ReturnURL.'&vpc_BackURL='.$vpc_BackURL.'&vpc_Locale='.$vpc_Locale.'
&vpc_CurrencyCode='.$vpc_CurrencyCode.'&vpc_TicketNo='.$vpc_TicketNo.'&vpc_PaymentGateway='.$vpc_PaymentGateway.'&vpc_CardType='.$vpc_CardType.'&vpc_SecureHash='.$vpc_SecureHash;
echo str_replace(' ','',$url_napas);
?>
