<?php /* Template Name: Confirm */ ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
if(!$_SESSION['cart'])  {
header('Location:http://heartofdarknessbrewery.com/');
die();
}
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
        $order_detail = $_SESSION['order'];
        $address = $_SESSION['address'];
        $city = $_SESSION['city'];
        $country = $_SESSION['country'];
        $fullname = $_SESSION['fullname'];
        $phone = $_SESSION['phone'];
        $grandTotal = $_SESSION['grand_total'];
        $payment = $_SESSION['payment'];
        $new_post = array(
					'post_title'    => $order_code,
					'post_status'   => 'publish',
					'post_type' => 'customer_order'
				);
        $pid = wp_insert_post($new_post); 
        /* add_post_meta($pid, 'cf_customer', $customer_mail);
        add_post_meta($pid, 'cf_grand_total', $grandTotal);
        add_post_meta($pid, 'cf_payment_method', $payment);
        add_post_meta($pid, 'cf_address', $address);
        add_post_meta($pid, 'cf_city', $city);
        add_post_meta($pid, 'cf_country', $country);
        add_post_meta($pid, 'cf_fullname', $fullname);
        add_post_meta($pid, 'cf_phone', $phone);*/
        //LIST PORDUCT
        var_dump($order_detail);
        $count_product = count($order_detail);
        //add_post_meta($pid, 'cf_order_products_list', $count_product, true);
        /*add_post_meta($pid, '_'.'cf_order_products_list', $repeater_key, true);*/
        for($i=0;$i<=$count_product;$i++) {
            $sub_field_name1 = 'cf_order_products_list'.'_'.$i.'_'.'cf_product_name';
            $sub_field_name2 = 'cf_order_products_list'.'_'.$i.'_'.'cf_quantity';
            //add_post_meta($pid, $sub_field_name1, $order_detail['sku'], false);
            //add_post_meta($pid, $sub_field_name1, $order_detail[$i], false);
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