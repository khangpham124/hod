<?php /* Template Name: Confirm */ ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
setcookie('incart', '', time()-300);
setcookie('order_cookies','', time() + 86400, "/");
setcookie('order_hod','', time() + 86400, "/");
include(APP_PATH."libs/head.php");
?>
<!-- <meta http-equiv="refresh" content="5;url=<?php echo APP_URL; ?>" /> -->
</head>

<body id="checkout">
<!--===================================================-->

<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->
<div id="wrapper">
    <h2 class="h2_site">Success order</h2>
    <?php
        // $_SESSION['payment'] = $_POST['payment'];
        // $order_code = $_SESSION['order_code'];
        // $customer_mail = $_SESSION['customer']['email'];
        // $address = $_SESSION['address'];
        // $city = $_SESSION['city'];
        // $country = $_SESSION['country'];
        // $fullname = $_SESSION['fullname'];
        // $phone = $_SESSION['phone'];
        // $grandTotal = $_SESSION['grand_total'];
        // $payment = $_SESSION['payment'];


        // $order_post = array(
        //         'post_title'    => $order_code,
        //         'post_status'   => 'publish',
        //         'post_type' => 'customer_order'
        // );
        // $pid = wp_insert_post($order_post); 
        // add_post_meta($pid, 'cf_customer', $customer_mail);
        // add_post_meta($pid, 'cf_grand_total', $grandTotal);
        // add_post_meta($pid, 'cf_payment_method', $payment);
        // add_post_meta($pid, 'cf_address', $address);
        // add_post_meta($pid, 'cf_city', $city);
        // add_post_meta($pid, 'cf_country', $country);
        // add_post_meta($pid, 'cf_fullname', $fullname);
        // add_post_meta($pid, 'cf_phone', $phone);

        // //LIST PORDUCT
        // $f_isset = $_SERVER['DOCUMENT_ROOT'].'/ajax/tmp/'.$_COOKIE['order_hod'].'.json';
        // $order_detail  = json_decode(file_get_contents($f_isset),true);
        // $count_product = count($order_detail);
        // add_post_meta($pid, 'cf_order_products_list', $count_product, true);
        // for($i=0;$i<=$count_product;$i++) {
        //     $order_options = 'Chose:'.$order_detail[$i]['option_add'].'(Choose up to sauces:'.$order_detail[$i]['option_list'].') Note:'.$order_detail[$i]['note'];
        //     $sub_field_name1 = 'cf_order_products_list'.'_'.$i.'_'.'cf_product_name';
        //     $sub_field_name2 = 'cf_order_products_list'.'_'.$i.'_'.'cf_quantity';
        //     $sub_field_name3 = 'cf_order_products_list'.'_'.$i.'_'.'cf_options';
        //     add_post_meta($pid, $sub_field_name1, $order_detail[$i]['name'], false);
        //     add_post_meta($pid, $sub_field_name2, $order_detail[$i]['quantity'], false);
        //     add_post_meta($pid, $sub_field_name3, $order_options, false);
        // }

        //AFTER SUBMIT
        // unlink($f_isset);
    
        $aMailto = array("khangpham421@gmail.com");
        $from = "ann@heartofdarknessbrewery.com";
        
        // require($_SERVER['DOCUMENT_ROOT']."/book_confirm/jphpmailer.php");
        mb_internal_encoding("UTF-8");

        $msgBody = "
        Fullname : $fullname
        ";

        $subject = "BOOKING SUMMARY FROM HEART OF DARKNESS";
        

        
        $subject1 = "CONFIRM BOOKING SUMMARY FROM HEART OF DARKNESS";
        $msgBody_customer = "
        Fullname : $fullname
        ---------------------------------------------------------------
        HEART OF DARKNESS VIETNAM Co., Ltd
        31D Ly Tu Trong, District 1, HCMC, Vietnam
        Contact us : 0903 017 596
        ---------------------------------------------------------------
        ";	
        $fromname = "HEART OF DARKNESS BOOKING SYSTEM";
        // $email1 = new JPHPmailer();
        // $email1->addTo($email_book);
        // $email1->setFrom($from,$fromname);
        // $email1->setSubject($subject1);
        // $email1->setBody($msgBody_customer);
        // $email1->CharSet = 'UTF-8';
        // if($email1->Send()) {};

        // // $email = new JPHPmailer();
        // for($i = 0; $i < count($aMailto); $i++)
        // {
        //     $email->addTo($aMailto[$i]);
        // }
        // $email->setFrom($email_book, 'HOD Booking System');
        // $email->setSubject($subject);
        // $email->setBody($msgBody);
        // $email->CharSet = 'UTF-8';
        // if($email->Send()) {
        //     echo "
        //     <div class='boxThx'>
        //         <p class='warningTxt'><i class='fa fa-check-circle'></i>Your order has been placed</p>
        //     </div>
        //     ";
        // }
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