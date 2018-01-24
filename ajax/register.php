<?php 
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
include(APP_PATH . '/hod/wp-load.php');
			$email =  $_POST['regis1'];
            $phone =  str_replace(array(',','.','+','(',')','#','*','e'),array('','','','','','','',''),$_POST['regis2']);
			$pass =  md5($_POST['regis3']);
			$fullname =  $_POST['regis4'];
			$gender =  $_POST['regis5'];
			$arr_mail = array();
			$wp_query = new WP_Query();
			$param = array (
			'posts_per_page' => '-1',
			'post_type' => 'customer',
			'post_status' => 'publish',
			);
			$wp_query->query($param);
			if($wp_query->have_posts()): while($wp_query->have_posts()) :$wp_query->the_post();
			 $arr_mail[] = $post->post_title;
            $arr_tell[] = get_field('cf_phone');
			endwhile;endif;
			
			if ((in_array($email, $arr_mail))||(in_array($phone, $arr_tell))) {
				echo'
                <p class="iconSuc"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></p>
                <p class="txtRegister">Account already exists</p>
                ';
			} else {
			 	$new_post = array(
					'post_title'    => $email,
					'post_status'   => 'publish',
					'post_type' => 'customer'
				);
				$pid = wp_insert_post($new_post); 
				add_post_meta($pid, 'cf_phone', $phone);
                add_post_meta($pid, 'cf_pass', $pass);
				add_post_meta($pid, 'cf_fullname', $fullname);
                add_post_meta($pid, 'cf_gender', $gender);
				//exit;
                $_SESSION['customer']['email'] = $email;
                $_SESSION['customer']['gender'] = $gender;
                $_SESSION['customer']['fullname'] = $fullname;
                echo'
                <p class="iconSuc"><i class="fa fa-check-circle" aria-hidden="true"></i></p>
                <p class="txtRegister">Register Successful</p>';
                exit;
			}

	?>