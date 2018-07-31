<?php /* Template Name: visa charge */ ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
/*if(!$order_code)  {
header('Location:http://heartofdarknessbrewery.com/');
die();
}*/
include(APP_PATH."libs/head.php");
?>
</head>

<body id="checkout">
<!--===================================================-->

<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->
<div id="wrapper">
    <h2 class="h2_site">Visa Charging</h2>
    <?php
       $access_key = isset($_GET["access_key"]) ? $_GET["access_key"] : NULL;
       $amount = isset($_GET["amount"]) ? $_GET["amount"] : NULL;
       $order_id = isset($_GET["order_id"]) ? $_GET["order_id"] : NULL;
       $order_info = isset($_GET["order_info"]) ? $_GET["order_info"] : NULL;
       $order_type = isset($_GET["order_type"]) ? $_GET["order_type"] : NULL;
       $request_time = isset($_GET["request_time"]) ? $_GET["request_time"] : NULL;
       $response_code = isset($_GET["response_code"]) ? $_GET["response_code"] : NULL;
       $response_message = isset($_GET["response_message"]) ? $_GET["response_message"] : NULL;
       $response_time = isset($_GET["response_time"]) ? $_GET["response_time"] : NULL;
       $trans_ref = isset($_GET["trans_ref"]) ? $_GET["trans_ref"] : NULL;
       $trans_status = isset($_GET["trans_status"]) ? $_GET["trans_status"] : NULL;
    
       $secret="vvah3c87zudw76vu2eeb7slv9ucdurz5"; 
       $data_result = "access_key=".$access_key
           ."&amount=".$amount
           ."&order_id=".$order_id
           ."&order_info=".$order_info
           ."&order_type=".$order_type
           ."&request_time=".$request_time
           ."&response_code=".$response_code
           ."&response_message=".$response_message
           ."&response_time=".$response_time
           ."&trans_ref=".$trans_ref
           ."&trans_status=".$trans_status;
    
       $signature1 = hash_hmac("sha256", $data_result, $secret);
       $signature = isset($_GET["signature"]) ? $_GET["signature"] : NULL;
      
      if($signature1==$signature)
       {
        if($response_code == "00")
          {
          echo $response_message."-".$amount;
          }
        else 
          {
          echo $response_message;
          }
       }
      else 
        echo "Wrong Signature";
    ?>

<!--Footer-->
<?php include(APP_PATH."libs/footer.php"); ?>
<!--/Footer-->
<!--===================================================-->
</div>
<!--/wrapper-->
<!--===================================================-->

</body>
</html>	