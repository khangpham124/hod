<?php 
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
include(APP_PATH . '/hod/wp-load.php');
$user = $_POST['field1'];
$pass = $_POST['field2'];
?>
<?php
        $wp_query = new WP_Query();
        $param = array (
                'posts_per_page' => '1',
                'post_type' => 'customer',
                'post_status' => 'publish',
                'order' => 'DESC',
                's'=> $user
        );
        $wp_query->query($param);
        if($wp_query->have_posts()): while($wp_query->have_posts()) :$wp_query->the_post();
            $pass_true = get_field('cf_pass');
            $fullname = get_field('cf_fullname');
            $gender = get_field('cf_gender');
            $phone = get_field('cf_phone');
            $address = get_field('cf_address');
            $city = get_field('cf_city');
            $country = get_field('cf_country');
            $pass_in =  md5($pass);
        if($pass_true == $pass_in ) { 
?>
<p class="iconSuc"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></p>
<p class="txtRegister">Login Successful</p>
<?php
    $_SESSION['customer']['email'] = $user;
    $_SESSION['customer']['fullname'] = $fullname;
    $_SESSION['customer']['gender'] = $gender;
    $_SESSION['customer']['phone'] = $phone;
    $_SESSION['customer']['address'] = $address;
    $_SESSION['customer']['city'] = $city;
    $_SESSION['customer']['country'] = $country;
?>
<?php } else { ?>
<p class="iconSuc"><i class="fa fa-check-circle" aria-hidden="true"></i></p>
<p class="txtRegister">Login Failed</p>
<?php } ?>
<?php endwhile;endif; ?>