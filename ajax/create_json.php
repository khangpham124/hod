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

//set the filename
$filename = './tmp/hod_order_'.$rand.'_'.time().'.json';
//open or create the file
if(!isset($_COOKIE['order_hod'])) {
    $data['order'] = array(
        $_GET['proid']=> array(
            'quantity' => $_GET['qual'],
            'cost' => $_GET['cost'],
            'options' => $_GET['options'],
            'note' => urldecode($_GET['note']),
        ),
    );
    $formattedData = json_encode($data);
    $handle = fopen($filename,'w+');
    $cookie_name = 'order_cookies';
    $cookie_value = 'hod_order_'.$rand.'_'.time();
    setcookie($cookie_name, $cookie_value, time() + 86400, "/");
    setcookie('order_hod', $cookie_value, time() + 86400, "/");
    //write the data into the file
    fwrite($handle,$formattedData);
    fclose($handle);
} else {
    if($_GET['options']=='') {
        $_GET['options']= 'null';
    } 
    $formattedData =',"'.$_GET['proid'].'":{"quantity":"'.$_GET['qual'].'","cost":"'.$_GET['cost'].'","options":'.$_GET['options'].',"note":"'.urldecode($_GET['note']).'"}}}';
    $f_isset = './tmp/'.$_COOKIE['order_hod'].'.json';
    $formattedData_curr = file_get_contents($f_isset);
    $count_char = strlen($formattedData_curr);
    $formattedData_get = file_get_contents($f_isset,FALSE, NULL,0,($count_char - 2));
    $handle = fopen($f_isset,'w+');
    //$formattedData = $formattedData_get.$formattedData;
    $formattedData = $formattedData_get.$formattedData;
    fwrite($handle,$formattedData);
    fclose($handle);
}
?> 