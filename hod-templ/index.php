<?php /* Template Name: Confirm */ ?>
<?php
require("./jphpmailer.php");
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
if(!$_COOKIE['order_cookies']) {    
    header('Location:http://heartofdarknessbrewery.com/');
    die();
}
setcookie('incart', '', time() + 86400, "/");
setcookie('order_cookies','', time() + 86400, "/");
setcookie('order_hod','', time() + 86400, "/");
setcookie('shipcost','', time() + 86400, "/");
setcookie('methodPay','', time() + 86400, "/");
setcookie('noteOrder','', time() + 86400, "/");
setcookie('err_pay','', time() + 86400, "/");
include(APP_PATH."libs/head.php");
?>
<meta http-equiv="refresh" content="5;url=<?php echo APP_URL; ?>" />
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
        $order_code = $_SESSION['order_code'];
        $email_book = $_SESSION['email'];
        $address = $_SESSION['address'];
        $city = $_SESSION['city'];
        $country = $_SESSION['country'];
        $fullname = $_SESSION['fullname'];
        $phone = $_SESSION['phone'];
        $grandTotal = $_SESSION['grand_total'];
        $grandTotal_novat = $_SESSION['totalCost_novat'];
        $payment = $_COOKIE['methodPay'];
        $shipcost = $_SESSION['shipcost'];
        $cmt_order = $_COOKIE['noteOrder'];
        if($_SESSION['paymemnt_status']) {
            $paidstt = $_SESSION['paymemnt_status'];
        } else {
            $paidstt = '';
        }
        if($_SESSION['transactionNo']) {
            $pay_info = $_SESSION['transactionNo'];
        } else {
            $pay_info = '';
        }

        $order_post = array(
                'post_title'    => $order_code,
                'post_content'    => $cmt_order,
                'post_status'   => 'publish',
                'post_type' => 'customer_order'
        );
        $pid = wp_insert_post($order_post); 
        add_post_meta($pid, 'cf_email', $email_book);
        add_post_meta($pid, 'cf_grand_total', $grandTotal);
        add_post_meta($pid, 'cf_payment_method', $payment);
        add_post_meta($pid, 'cf_address', $address);
        add_post_meta($pid, 'cf_city', $city);
        add_post_meta($pid, 'cf_country', $country);
        add_post_meta($pid, 'cf_fullname', $fullname);
        add_post_meta($pid, 'cf_phone', $phone);
        add_post_meta($pid, 'cf_shipping_cost',$shipcost );
        add_post_meta($pid, 'paymemnt_status',$paidstt );
        add_post_meta($pid, 'pay_information',$pay_info );
        add_post_meta($pid, 'cf_order_status', 'in progress');
        

        //LIST PORDUCT
        $f_isset = $_SERVER['DOCUMENT_ROOT'].'/ajax/tmp/'.$_COOKIE['order_hod'].'.json';
        $order_detail  = json_decode(file_get_contents($f_isset),true);
        $count_product = count($order_detail);
        add_post_meta($pid, 'cf_order_products_list', $count_product, true);
        for($i=0;$i<=$count_product;$i++) {
            $order_options = 'Chose:'.$order_detail[$i]['option_add'].'(Choose up to sauces:'.$order_detail[$i]['option_list'].')';
            $sub_field_name1 = 'cf_order_products_list'.'_'.$i.'_'.'cf_product_name';
            $sub_field_name2 = 'cf_order_products_list'.'_'.$i.'_'.'cf_quantity';
            $sub_field_name3 = 'cf_order_products_list'.'_'.$i.'_'.'cf_options';
            $sub_field_name4 = 'cf_order_products_list'.'_'.$i.'_'.'cf_note';
            add_post_meta($pid, $sub_field_name1, $order_detail[$i]['name'], false);
            add_post_meta($pid, $sub_field_name2, $order_detail[$i]['quantity'], false);
            add_post_meta($pid, $sub_field_name3, $order_options, false);
            add_post_meta($pid, $sub_field_name4, $order_detail[$i]['note'], false);
        }

        // AFTER SUBMIT
        unlink($f_isset);

        $aMailto = array("khangpham421@gmail.com", "orderhodb@gmail.com");
        // $aMailto = array("khangpham421@gmail.com");
        $from = "orderhodb@gmail.com";
        
        mb_internal_encoding("UTF-8");

        $subject = "BOOKING SUMMARY FROM HEART OF DARKNESS";
        $msgBody = "
        <p>Fullname : $fullname</p>
        <p>Phone : $phone</p>
        <p>Address : $address - $city</p>
        <p>Order Code : $order_code</p>
        ";
        if($cmt_order != '') {
            $msgBody .= "
            <div>Note : $cmt_order</div>
            ";
        }
        if($paidstt == 'Paid') {
        $msgBody .= "
        <p>Paymemnt Status : <strong>$paidstt via $payment</strong></p>
        ";
        }
        $msgBody .= "
        <br>
        <table style='border:1px solid #000;border-collapse: collapse;border-spacing: 0;'>
            <tr style='font-weight:bold; padding:5px'>
                <td style='border:1px solid #000;padding:5px;text-align:center'>PRODUCTS</td>
                <td style='border:1px solid #000;padding:5px;text-align:center'>PRICE</td>
                <td style='border:1px solid #000;padding:5px;text-align:center'>QTY</td>
                <td style='border:1px solid #000;padding:5px;text-align:center'>OPTIONS</td>
                <td style='border:1px solid #000;padding:5px;text-align:center'>NOTE</td>
                <td style='border:1px solid #000;padding:5px;text-align:center'>TOTAL</td>
            </tr>
       ";
       for($i=0;$i<=($count_product-1);$i++) {
        $tt = $order_detail[$i]['price'] * $order_detail[$i]['quantity'];
        $msgBody .= "   
            <tr>
                <td style='border:1px solid #000;padding:5px'>".$order_detail[$i]['name']."</td>
                <td style='border:1px solid #000;padding:5px'>".number_format($order_detail[$i]['price'])."</td>
                <td style='border:1px solid #000;padding:5px'>".$order_detail[$i]['quantity']."</td>
                <td style='border:1px solid #000;padding:5px'>
        ";

        if($order_detail[$i]['option_list']!='undefined') {
            $msgBody .= "<strong>".$order_detail[$i]['option_list']."</strong>";
        }
        $msgBody .= "
                </td>    
                <td style='border:1px solid #000;padding:5px'>".$order_detail[$i]['note']."</td>
                <td style='border:1px solid #000;padding:5px'>".number_format($tt)."VND</td>
            </tr>
        ";
        }
        $msgBody .= " 
            <tr>
                <td style='border:1px solid #000;padding:5px;text-align:right' colspan='6'>VAT(10%):".number_format(($grandTotal_novat * 10) / 100)." VND</td>
            </tr>
            <tr>
                <td style='border:1px solid #000;padding:5px;text-align:right' colspan='6'>Shipping Fee:".number_format($shipcost)." VND</td>
            </tr>
            <tr>
                <td style='border:1px solid #000;padding:5px;text-align:right' colspan='6'>".number_format($grandTotal)." VND</td>
            </tr>
        </table>
        ";

        $subject1 = "CONFIRM BOOKING SUMMARY FROM HEART OF DARKNESS";
        $msgBody_customer = "
        <p>Fullname : $fullname</p>
        <p>Phone : $phone</p>
        <p>Address : $address - $city</p>
        <p>Order Code : $order_code</p>
        <br>
        <table style='border:1px solid #000;border-collapse: collapse;border-spacing: 0;'>
            <tr style='font-weight:bold; padding:5px'>
                <td style='border:1px solid #000;padding:5px;text-align:center'>PRODUCTS</td>
                <td style='border:1px solid #000;padding:5px;text-align:center'>PRICE</td>
                <td style='border:1px solid #000;padding:5px;text-align:center'>QTY</td>
                <td style='border:1px solid #000;padding:5px;text-align:center'>OPTIONS</td>
                <td style='border:1px solid #000;padding:5px;text-align:center'>NOTE</td>
                <td style='border:1px solid #000;padding:5px;text-align:center'>TOTAL</td>
            </tr>
       ";
       for($i=0;$i<=($count_product-1);$i++) {
        $tt = $order_detail[$i]['price'] * $order_detail[$i]['quantity'];
        $msgBody_customer .= "   
            <tr>
                <td style='border:1px solid #000;padding:5px'>".$order_detail[$i]['name']."</td>
                <td style='border:1px solid #000;padding:5px'>".number_format($order_detail[$i]['price'])."</td>
                <td style='border:1px solid #000;padding:5px'>".$order_detail[$i]['quantity']."</td>
                <td style='border:1px solid #000;padding:5px'>
        ";

        if($order_detail[$i]['option_list']!='undefined') {
            $msgBody_customer .= "<strong>".$order_detail[$i]['option_list']."</strong>";
        }
        $msgBody_customer .= "
            </td>
            <td style='border:1px solid #000;padding:5px'>".$order_detail[$i]['note']."</td>
            <td style='border:1px solid #000;padding:5px'>".number_format($tt)."</td>
            </tr>
        ";
        }
        $msgBody_customer .= " 
            <tr>
            <td style='border:1px solid #000;padding:5px;text-align:right' colspan='6'>VAT(10%):".number_format(($grandTotal_novat * 10) / 100)." VND</td>
            </tr>
            <tr>
                <td style='border:1px solid #000;padding:5px;text-align:right' colspan='6'>Shipping Fee:".number_format($shipcost)." VND</td>
            </tr>
            <tr>
                <td style='border:1px solid #000;padding:5px;text-align:right' colspan='6'>".number_format($grandTotal)." VND</td>
            </tr>    
        </table>

        <p>---------------------------------------------------------------</p>
        <p>
        <img src='http://heartofdarknessbrewery.com/common/img/header/logo.jpg'><br>
        HEART OF DARKNESS VIETNAM Co., Ltd<br>
        31D Ly Tu Trong, District 1, HCMC, Vietnam<br>
        Contact us : 0903 017 596</p>
        <p>---------------------------------------------------------------</p>
        ";

        $fromname = "HEART OF DARKNESS BOOKING SYSTEM";

        //Mail to Customer
        $email1 = new JPHPmailer();
        $email1->addTo($email_book);
        $email1->setFrom($from,$fromname);
        $email1->setSubject($subject1);
        $email1->setBody($msgBody_customer);
        $email1->CharSet = 'UTF-8';
        if($email1->Send()) {
            $_SESSION['address'] = '';
            $_SESSION['grand_total'] = '';
            $_SESSION['totalCost_novat'] = '';
            $_SESSION['payment'] = '';
            $_SESSION['shipcost'] = '';
            $_SESSION['order_code'] = '';
            $_SESSION['paymemnt_status'] = '';
            $_SESSION['transactionNo'] = '';
        };

        
        //Mail to Admin
        $email = new JPHPmailer();
        for($i = 0; $i < count($aMailto); $i++)
        {
            $email->addTo($aMailto[$i]);
        }
        $email->setFrom($email_book, 'HOD Booking System');
        $email->setSubject($subject);
        $email->setBody($msgBody);
        $email->CharSet = 'UTF-8';
        if($email->Send()) {
            echo "
            <div class='boxThx'>
                <p class='warningTxt'><i class='fa fa-check-circle'></i>Your order has been placed</p>
            </div>
            ";
        }
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