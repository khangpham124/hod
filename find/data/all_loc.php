<?php
include($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
include(APP_PATH . '/hod/wp-load.php');
$s = $_GET['s'];
?>
<?php
	$wp_query = new WP_Query();
	$param = array (
	'posts_per_page' => '-1',
	'post_type' => 'find',
	'post_status' => 'publish',
	'order' => 'DESC',
    's' => $s,
	);
	$wp_query->query($param);
	if($wp_query->have_posts()): while($wp_query->have_posts()) :$wp_query->the_post();
    $lat = get_field('cf_lat');
	$long = get_field('cf_long');
?>
https://maps.google.com/?q=<?php echo $lat; ?>,<?php echo $long; ?>
<?php endwhile;endif; ?>

