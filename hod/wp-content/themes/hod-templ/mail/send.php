<?
include "class.phpmailer.php"; 
include "class.smtp.php"; 

$input1 = $_POST['input1'];
$input2 = $_POST['input2'];
$input3 = $_POST['input3'];
$input4 = $_POST['input4'];
$input5 = nl2br($_POST['input5']);


$mail = new PHPMailer();
$mail->IsSMTP(); // set mailer to use SMTP
$mail->Host = "smtp.gmail.com"; // specify main and backup server
$mail->Port = 465; // set the port to use
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->SMTPSecure = 'ssl';
$mail->Username = "teddycoder421@gmail.com"; // your SMTP username or your gmail username
$mail->Password = "A0935416803a"; // your SMTP password or your gmail password
$from = "teddycoder421@yahoo.com"; // Reply to this email

$to="khangpham421@gmail.com";

$to2= $input2; // mail nhan

$name="Teddycoder.com"; // Recipient's name
$name2="Teddycoder Confirm"; // Recipient's name

$mail->From = $from;
$mail->FromName = "Mail form TeddyCoder"; // Name to indicate where the email came from when the recepient received
$mail->AddAddress($to,$name);
$mail->AddAddress($to2,$name2);

//$mail->AddReplyTo($from,"khang test");
$mail->WordWrap = 50; // set word wrap
$mail->IsHTML(true); // send as HTML
$mail->Subject = "Mail form TeddyCoder Confirm";
$mail->CharSet = 'UTF-8';
$mail->Body = "
<b>Liên hệ</b><br><br>


Họ tên: $input1<br>
Số điện thoại: $input3<br>
Website: $input4<br>
E-mail: $input2<br>

Nội dung : <br>
$input5<br>


---------------------------------------------------------------<br>
From TeddyCoder.com<br>
Khangpham - Tel : 0903189404<br>
Email:khangpham421@gmail.com<br>
Skype:khangpham124<br>
---------------------------------------------------------------

"; //HTML Body
$mail->AltBody = "Mail nay duoc goi bang phpmailer class."; //Text Body
//$mail->SMTPDebug = 2;
if(!$mail->Send())
{
	echo "<h1>Loi khi goi mail: " . $mail->ErrorInfo . '</h1>';
}
else
{
	echo "<h1>Send mail thanh cong</h1>";
}
?>