<?php
$data = array();
$data['order'] = array(
    $_GET['proid']=> array(
        'quantity' => $_GET['qual'],
        'cost' => $_GET['cost'],
        'options' => $_GET['options'],
        'note' => urldecode($_GET['note']),
    ),
);

//format the data
$formattedData = json_encode($data);

$seed = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                 .'0123456789'); // and any other characters
shuffle($seed); // probably optional since array_is randomized; this may be redundant
$rand = '';
foreach (array_rand($seed, 5) as $k) 
$rand .= $seed[$k];

//set the filename
$filename = './tmp/hod_order_'.$rand.'_'.time().'.json';
//open or create the file
if(!isset($_COOKIE['order_hod'])) {
    $handle = fopen($filename,'w+');
    $cookie_name = 'order_cookies';
    $cookie_value = 'hod_order_'.$rand.'_'.time();
    setcookie($cookie_name, $cookie_value, time() + 86400, "/");
    setcookie('order_hod', $cookie_value, time() + 86400, "/");
    //write the data into the file
    fwrite($handle,$formattedData);
    fclose($handle);
} else {
    $f_isset = './tmp/'.$_COOKIE['order_hod'].'.json';
    $formattedData_curr = file_get_contents('tmp/'.$_COOKIE['order_hod'].'.json');
    $handle = fopen($f_isset,'w+');
    $formattedData = $formattedData_curr.$formattedData;
    fwrite($handle,$formattedData);
    fclose($handle);
}
?> 