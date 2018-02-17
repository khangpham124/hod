<?php /* Template Name: Booking success */ ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
if(!$_POST['guests']) {
    header('Location:http://heartofdarknessbrewery.com/booking/');
    die();
}
include(APP_PATH."libs/head.php");
?>
<!--<meta http-equiv="refresh" content="5; url=<?php echo APP_URL; ?>"> !-->
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
        if(isset($_POST['g-recaptcha-response'])){
        $captcha=$_POST['g-recaptcha-response'];
    }
    if(!$captcha){
    ?>
        <div class='boxThx'>
        <p class='warningTxt'><i class="fa fa-exclamation-circle"></i>Please check the the captcha form</p>
        </div>
    <?php 
        exit;
    }
    $secretKey = "6LfMFEYUAAAAAPLNIfl5QjjTR9MBSeFJ5QDZa-Gt";
    $ip = $_SERVER['REMOTE_ADDR'];
    $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
    $responseKeys = json_decode($response,true);
    if(intval($responseKeys["success"]) !== 1) {
        echo '<h2>You are spammer ! Stop spam</h2>';
        die();
    } else {
        require(APP_PATH."hod/wp-content/themes/hod-templ/mailer/jphpmailer.php");

        $aMailto = array("khangpham421@gmail.com", "khang.pham@vmmedia.vn");
        $from = "khang.pham@vmmedia.vn";
        $name_book = $_POST['book_name'];
        $phone = $_POST['book_phone'];
        $email = $_POST['book_email'];
        $message = $_POST['book_message'];
        $guests = $_POST['guests'];
        $kids = $_POST['kids'];
        $time = $_POST['time'];
        $date = $_POST['date'];
        if($kids!=0) {$kid=$kids;} else {$kid='n/a';}
        if($message!='') {$content= 'Message:'.$message;} else {$content='';}
        
        $msgBody = "
        BOOKING SUMMARY FROM HEART OF DARKNESS
        Fullname: $name_book
        Number of guest(s): $guests
        Kid(s): $kid
        Phone: $phone
        Email: $email
        Time: [$date] at [$time]
        $content
        ";

        $subject = "BOOKING SUMMARY FROM HEART OF DARKNESS";
        $body = "
        $msgBody
        ";

        //お客様用メッセージ
        $subject1 = "CONFIRM BOOKING SUMMARY FROM HEART OF DARKNESS";
        $msgBody_customer = "
        Dear $name_book,

        Number of guest(s): $guests
        Kid(s): $kid
        Phone: $phone
        Email: $email
        $content
    
        Thanks for confirming your reservation, we look forward to seeing you on [$date] at [$time].
        ---------------------------------------------------------------
        <img src='http://heartofdarknessbrewery.com/common/img/header/logo.svg' alt=''>
        HEART OF DARKNESS VIETNAM Co., Ltd
        31D Ly Tu Trong, District 1, HCMC, Vietnam
        Contact us : 0903 017 596
        ---------------------------------------------------------------
        ";

            $fromname = "HEART OF DARKNESS";
            $email1 = new JPHPmailer();
            $email1->addTo($email);
            $email1->setFrom($from,$fromname);
            $email1->setSubject($subject1);
            $email1->setBody($msgBody_customer);
            if($email1->Send()) {};
            
            $email = new JPHPmailer();
            for($i = 0; $i < count($aMailto); $i++)
            {
                $email->addTo($aMailto[$i]);
            }
            $email->setFrom($email, $name_book);
            $email->setSubject($subject);
            $email->setBody($msgBody);
            if($email->Send()) {
        ?>
            <div class='boxThx'>
            <p class='warningTxt'><i class="fa fa-check-circle"></i>Booking successful!</p>
            <p>
            We look forward to the pleasure of having you as our guest.<br> <br>   
Depending on bookings and walk-in traffic, we cannot hold your table longer than 15 minutes past your expected arrival time. Thank you!</p>
            </div>
        <?php } ?>    
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