<?php
$f_isset = './tmp/'.$_COOKIE['order_hod'].'.json';
$curr_cart  = json_decode(file_get_contents($f_isset),true);
// $curr_cart  = file_get_contents($f_isset);
// var_dump($curr_cart);
$curr_cart = array_values($curr_cart);
$c = count($curr_cart);
for($i=0;$i<=$c;$i++)
{    
    echo $curr_cart[$i]['id'];
    if($_GET['proid'] == $curr_cart[$i]['id']) {
        unset($curr_cart[$i]);
    }
}

$recurr_cart = array_values($curr_cart);

$formattedData = json_encode($recurr_cart);

$handle = fopen($f_isset,'w+');
fwrite($handle,$formattedData);
fclose($handle);
$curr_cookie = $_COOKIE['incart'];
$update_cookie = $curr_cookie - $_GET['qual'];
setcookie('incart', $update_cookie, time() + 86400, "/");
if(sizeof($curr_cart)== 0) {
    unlink($f_isset);
    setcookie('order_cookies','', time() + 86400, "/");
    setcookie('order_hod','', time() + 86400, "/");
    setcookie('incart', 0, time() + 86400, "/");
}
unset($_COOKIE['incart']);
?>

