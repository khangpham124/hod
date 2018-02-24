<?php
//email list
$aMailto = array("khangpham421@gmail.com", "annheartofdarkness@gmail.com","ryo@heartofdarknessbrewery.com");
//$aMailto = array("khangpham421@gmail.com");
$from = "ann@heartofdarknessbrewery.com";

// 設定
require("./jphpmailer.php");
$script = "index.php";
$gtime = time();

// グローバル変数とサニタイジング
$action = htmlspecialchars($_POST['action']);

// 処理分岐
if($action == "confim"){
//======================================================================================== お問い合わせ確認画面

?>



<?php
}elseif($action == "send"){
//========================================================================================== お問い合わせ確認画面
mb_internal_encoding("UTF-8");

$name_book = $_POST['book_name'];
$phone = $_POST['book_phone'];
$email_book = $_POST['book_email'];
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
Email: $email_book
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
Email: $email_book
$content
    
        Thanks for confirming your reservation, we look forward to seeing you on [$date] at [$time].
        ---------------------------------------------------------------
        HEART OF DARKNESS VIETNAM Co., Ltd
        31D Ly Tu Trong, District 1, HCMC, Vietnam
        Contact us : 0903 017 596
        ---------------------------------------------------------------
        ";	
$fromname = "HEART OF DARKNESS BOOKING SYSTEM";


$email1 = new JPHPmailer();
$email1->addTo($email_book);
$email1->setFrom($from,$fromname);
$email1->setSubject($subject1);
$email1->setBody($msgBody_customer);
$email1->CharSet = 'UTF-8';
if($email1->Send()) {};

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
    ?>
        <div class='boxThx'>
        <p class='warningTxt'><i class="fa fa-check-circle"></i>Booking successful!</p>
        <p>
        We look forward to the pleasure of having you as our guest.<br> <br>   
Depending on bookings and walk-in traffic, we cannot hold your table longer than 15 minutes past your expected arrival time. Thank you!</p>
        </div>
    <?php } ?>    
<?php } ?>
