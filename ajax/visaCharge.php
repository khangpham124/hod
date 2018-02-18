<?php 
function execPostRequest($url, $data)
{
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch, CURLOPT_POST, 1);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
 curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 $result = curl_exec($ch);
 curl_close($ch);
 return $result;
}

$access_key = "chq5oygkn9ikaptt66bf";           // require your access key from 1pay
$secret = "vvah3c87zudw76vu2eeb7slv9ucdurz5";               // require your secret key from 1pay
$return_url = "http://heartofdarknessbrewery.com/visa/"; 

$amount = $_POST['amount'];   // >10000
$order_id = $_POST['order_id'];  
$order_info = $_POST['order_info']; 

$data = "access_key=".$access_key."&amount=".$amount."&order_id=".$order_id."&order_info=".$order_info;
$signature = hash_hmac("sha256", $data, $secret);
$data.= "&signature=".$signature."&return_url=".$return_url;
$json_visaCharging = execPostRequest('http://visa.1pay.vn/visa-charging/api/handle/request', $data);
 
$decode_visaCharging=json_decode($json_visaCharging,true);  // decode json
$pay_url = $decode_visaCharging["pay_url"];
header("Location: $pay_url");
?>