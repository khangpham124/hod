<?php
include(APP_PATH."libs/head.php");
$method = $_GET['method'];
$vpc_AccessCode = 'ECAFAB';
$vpc_MerchTxnRef='test';
$vpc_Merchant= 'SMLTEST';
$vpc_OrderInfo= $_SESSION['order_code'];
$vpc_Amount= $_SESSION['grand_total'];
$vpc_ReturnURL= 'http://heartofdarknessbrewery.com/confirm/checkpay.php';
$vpc_BackURL= 'http://heartofdarknessbrewery.com/checkout/?step=3';
$vpc_Locale= 'vn';
$vpc_CurrencyCode= 'VND';
$vpc_TicketNo = '2.0';
if($method == 'atm') {
$vpc_PaymentGateway= 'ATM';
} else {
$vpc_PaymentGateway= 'visa';
}    
$vpc_CardType= 'SML';
$vpc_SecureHash = md5('TEST');


echo $url_napas = 'https://sandbox.napas.com.vn/gateway/vpcpay.do?vpc_Version=2.0&vpc_Command=pay&vpc_AccessCode='.$vpc_AccessCode.'&vpc_MerchTxnRef='.$vpc_MerchTxnRef.'&vpc_Merchant='.$vpc_Merchant.'&vpc_OrderInfo='.$vpc_OrderInfo.'&vpc_Amount='.$vpc_Amount.'&vpc_ReturnURL='.$vpc_ReturnURL.'&vpc_BackURL='.$vpc_BackURL.'&vpc_Locale='.$vpc_Locale.'
&vpc_CurrencyCode='.$vpc_CurrencyCode.'&vpc_TicketNo='.$vpc_TicketNo.'&vpc_PaymentGateway='.$vpc_PaymentGateway.'&vpc_CardType='.$vpc_CardType.'&vpc_SecureHash='.$vpc_SecureHash;
?>


