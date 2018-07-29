<?php /* Template Name: Confirm */ ?>
<?php
include($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
setcookie('incart', '', time()-300);
        setcookie('order_cookies','', time() + 86400, "/");
        setcookie('order_hod','', time() + 86400, "/");
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
    <h2 class="h2_site">Success order</h2>
    <?php
        $_SESSION['payment'] = $_POST['payment'];
        $order_code = $_SESSION['order_code'];
        $customer_mail = $_SESSION['customer']['email'];
        $address = $_SESSION['address'];
        $city = $_SESSION['city'];
        $country = $_SESSION['country'];
        $fullname = $_SESSION['fullname'];
        $phone = $_SESSION['phone'];
        $grandTotal = $_SESSION['grand_total'];
        $payment = $_SESSION['payment'];


        $order_post = array(
					'post_title'    => $order_code,
					'post_status'   => 'publish',
					'post_type' => 'customer_order'
				);
        $pid = wp_insert_post($order_post); 
        add_post_meta($pid, 'cf_customer', $customer_mail);
        add_post_meta($pid, 'cf_grand_total', $grandTotal);
        add_post_meta($pid, 'cf_payment_method', $payment);
        add_post_meta($pid, 'cf_address', $address);
        add_post_meta($pid, 'cf_city', $city);
        add_post_meta($pid, 'cf_country', $country);
        add_post_meta($pid, 'cf_fullname', $fullname);
        add_post_meta($pid, 'cf_phone', $phone);
        //LIST PORDUCT
        $f_isset = $_SERVER['DOCUMENT_ROOT'].'/ajax/tmp/'.$_COOKIE['order_hod'].'.json';
        $order_detail  = json_decode(file_get_contents($f_isset),true);
        $count_product = count($order_detail);
        add_post_meta($pid, 'cf_order_products_list', $count_product, true);
        for($i=0;$i<=$count_product;$i++) {
            $sub_field_name1 = 'cf_order_products_list'.'_'.$i.'_'.'cf_product_name';
            $sub_field_name2 = 'cf_order_products_list'.'_'.$i.'_'.'cf_quantity';
            $sub_field_name3 = 'cf_order_products_list'.'_'.$i.'_'.'cf_options';
            add_post_meta($pid, $sub_field_name1, $order_detail[$i]['id'], false);
            add_post_meta($pid, $sub_field_name2, $order_detail[$i]['quantity'], false);
            add_post_meta($pid, $sub_field_name3, $order_detail[$i]['options'], false);
        }
        
        //AFTER SUBMIT
        unlink($f_isset);
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