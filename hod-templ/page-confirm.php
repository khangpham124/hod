<?php /* Template Name: Confirm */ ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
if(!$_SESSION['cart'])  {
header('Location:http://heartofdarknessbrewery.com/');
die();
}
include(APP_PATH."libs/head.php");
//include(APP_PATH."mailer/class.phpmailer.php"); 
//include(APP_PATH."mailer/class.smtp.php"); 
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
        add_post_meta($pid, 'cf_customer', $customer_mail);
        add_post_meta($pid, 'cf_grand_total', $grandTotal);
        add_post_meta($pid, 'cf_payment_method', $payment);
        add_post_meta($pid, 'cf_address', $address);
        add_post_meta($pid, 'cf_city', $city);
        add_post_meta($pid, 'cf_country', $country);
        add_post_meta($pid, 'cf_fullname', $fullname);
        add_post_meta($pid, 'cf_phone', $phone);
        //LIST PORDUCT
        $count_product = count($order_detail);
        add_post_meta($pid, 'cf_order_products_list', $count_product, true);
        for($i=0;$i<=$count_product;$i++) {
            $sub_field_name1 = 'cf_order_products_list'.'_'.$i.'_'.'cf_product_name';
            $sub_field_name2 = 'cf_order_products_list'.'_'.$i.'_'.'cf_quantity';
            add_post_meta($pid, $sub_field_name1, $order_detail[$i]['sku'], false);
            add_post_meta($pid, $sub_field_name2, $order_detail[$i]['qty'], false);
        }
        $mail = new PHPMailer();
        $mail->IsSMTP(); // set mailer to use SMTP
        $mail->Host = "localhost"; // specify main and backup server
        $mail->Port = 25; // set the port to use
        $mail->SMTPAuth = false; // turn on SMTP authentication
        $mail->SMTPSecure = 'none';
        $mail->Username = "khang.pham@vmmedia.vn"; // your SMTP username or your gmail username
        $mail->Password = ""; // your SMTP password or your gmail password
        $from = "khang.pham@vmmedia.vn"; // Reply to this email
        
        $to="khangpham421@gmail.com";
        $name="HOD System "; // Recipient's name
        
        $mail->From = $from;
        $mail->FromName = "HOD System"; // Name to indicate where the email came from when the recepient received
        $mail->AddAddress($to,$name);
        $mail->WordWrap = 50; // set word wrap
        $mail->IsHTML(true); // send as HTML
        $mail->Subject = "#No.".$order_code." New Order form HOD";
        $mail->CharSet = 'UTF-8';
        $mail->Body = "
        <b>Order Detail</b><br><br>
        <table style='background:#eeeeee;border-collapse:collapse;line-height:100%!important;margin:0;padding:0;width:100%!important'>
        <tr>
        <th>Order number</th>
        <td>$order_code</td>
        </tr>
        <tr>
        <th>Customer</th>
        <td>$customer_mail</td>
        </tr>
        <tr>
        <th>Total</th>
        <td>$grandTotal</td>
        </tr>
        <th>Payment Status</th>
        <td>$payment</td>
        </tr>
        <tr>
        <th>Fullname</th>
        <td>$fullname</td>
        </tr>
        <tr>
        <th>Phone</th>
        <td>$phone</td>
        </tr>
        <tr>
        <th>Shipping Information</th>
        <td>$address, $city, $country</td>
        </tr>    
        </table>
        "; //HTML Body
        $mail->AltBody = "Mail nay duoc goi bang phpmailer class."; //Text Body
        //$mail->SMTPDebug = 2;
        if(!$mail->Send())
        {
            echo "<h1>Loi khi goi mail: " . $mail->ErrorInfo . '</h1>';
        }
        else
        {
        ?>
            <div class='boxThx'>
            <p class='warningTxt'><i class='fas fa-check-circle'></i>Your order has been placed</p>
            </div>
        <?php } ?>
<!--Footer-->
<?php include(APP_PATH."libs/footer.php"); ?>
<!--/Footer-->
<!--===================================================-->
</div>
<!--/wrapper-->
<!--===================================================-->

</body>
</html>	