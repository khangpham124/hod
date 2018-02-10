<?php /* Template Name: Booking success */ ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
if(!$_POST['guests']) {
    header('Location:http://heartofdarknessbrewery.com/booking-now/');
    die();
}
include(APP_PATH."libs/head.php");
?>
<meta http-equiv="refresh" content="5; url=<?php echo APP_URL; ?>">
</head>

<body id="checkout">
<!--===================================================-->

<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->
<div id="wrapper">
    <h2 class="h2_site">Booking Success</h2>
    <?php
        $name_book = $_POST['book_name'];
        $phone = $_POST['book_phone'];
        $email = $_POST['book_email'];
        $message = $_POST['book_message'];
        $guests = $_POST['guests'];
        $kids = $_POST['kids'];
        $time = $_POST['time'];
        $date = $_POST['date'];
        if($kids!=0) {$kid=$kids;} else {$kid='n/a';}
        if($message!='') {$content=$message;} else {$content='';}
        $mail = new PHPMailer();
        $mail->IsSMTP(); // set mailer to use SMTP
        $mail->Host = "localhost"; // specify main and backup server
        $mail->Port = 25; // set the port to use
        $mail->SMTPAuth = false; // turn on SMTP authentication
        $mail->SMTPSecure = 'none';
        $mail->Username = "ann@heartofdarknessbrewery.com"; // your SMTP username or your gmail username
        $mail->Password = ""; // your SMTP password or your gmail password
        $from = "booking@heartofdarknessbrewery.com"; // Reply to this email
        
        $to="ann@heartofdarknessbrewery.com";
        $to_user = $email;
        $name="HOD Booking System"; // Recipient's name
        
        $mail->From = $from;
        $mail->FromName = "HOD Booking System"; // Name to indicate where the email came from when the recepient received
        $mail->AddAddress($to,$name);
        $mail->AddAddress($to_user,$name);
        $mail->WordWrap = 50; // set word wrap
        $mail->IsHTML(true); // send as HTML
        $mail->Subject = "New booking form HOD";
        $mail->CharSet = 'UTF-8';
        $mail->Body = "
        <b>BOOKING SUMMARY FROM HEART OF DARKNESS</b><br><br> 
        Number of guest(s): $guests<br>
        Kid(s): $kid<br>
        Message: $content<br>
        <br><br>
        Thanks for confirming your reservation, we look forward to seeing you on [$date] at [$time].
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
            <p class='warningTxt'><i class="fa fa-check-circle"></i>Booking successful!</p>
            <p>
            We look forward to the pleasure of having you as our guest.<br> <br>   
Depending on bookings and walk-in traffic, we cannot hold your table longer than 15 minutes past your expected arrival time. Thank you!</p>
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