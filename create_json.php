<?php
$data = array();
$insert_data = array();
//format the data

$seed = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                 .'0123456789'); // and any other characters
shuffle($seed); // probably optional since array_is randomized; this may be redundant
$rand = '';
foreach (array_rand($seed, 5) as $k) 
$rand .= $seed[$k];

// $id_prod = str_replace('','',$_GET['proid']);

//set the filename
$filename = './tmp/hod_order_'.$rand.'_'.time().'.json';
//open or create the file
if(!isset($_COOKIE['order_hod'])) {
    $data =array (
        array(
        "id"=>$_GET['proid'],
        "name"=>$_GET['name_pro'],
        "quantity"=>$_GET['qual'],
        "price"=>$_GET['price'],
        "cost"=>$_GET['cost'],
        "option_add"=>$_GET['option_add'],
        "option_list"=>$_GET['option_list'],
        "note"=>urldecode($_GET['note'])
        )
    );
    // $formattedData = json_encode($data);
    $formattedData = json_encode($data,JSON_FORCE_OBJECT);
    $handle = fopen($filename,'w+');
    $cookie_name = 'order_cookies';
    $cookie_value = 'hod_order_'.$rand.'_'.time();
    setcookie($cookie_name, $cookie_value, time() + 86400, "/");
    setcookie('order_hod', $cookie_value, time() + 86400, "/");
    //write the data into the file
    fwrite($handle,$formattedData);
    fclose($handle);
    setcookie('incart', $_GET['qual'], time() + 86400, "/");
} else {
    if($_GET['options']=='') {
        $_GET['options']= 'null';
    }
    
    $f_isset = './tmp/'.$_COOKIE['order_hod'].'.json';
    $formattedData_curr = file_get_contents($f_isset);
    $formattedData_get = json_decode($formattedData_curr,true);
    $data =
    array(
        "id"=>$_GET['proid'],
        "name"=>$_GET['name_pro'],
        "quantity"=>$_GET['qual'],
        "price"=>$_GET['price'],
        "cost"=>$_GET['cost'],
        "option_add"=>$_GET['option_add'],
        "option_list"=>$_GET['option_list'],
        "note"=>urldecode($_GET['note'])
    );
    array_push($formattedData_get,$data);
    $formattedData = json_encode($formattedData_get,JSON_FORCE_OBJECT);
    // $formattedData_get = file_get_contents($f_isset,FALSE, NULL,0,($count_char - 1));
    $handle = fopen($f_isset,'w+');
    fwrite($handle,$formattedData);
    fclose($handle);
    $curr_cookie = $_COOKIE['incart'];
    $update_cookie = $curr_cookie + $_GET['qual'];
    setcookie('incart', $update_cookie, time() + 86400, "/");
}
?> 