<?php
header('Content-Type: application/json');
include($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
include(APP_PATH . '/hod/wp-load.php');
$t = $_GET['type'];
if($t=='') {
	$t = 'hochiminh';
}

?>
{
"title":"All",
"type":"marker",
"locations":[
<?php	
	$c=0;
	$wp_query = new WP_Query();
	$param = array (
	'posts_per_page' => '-1',
	'post_type' => 'find',
	'post_status' => 'publish',
	'order' => 'DESC',
	'tax_query' => array(
	 array(
		'taxonomy' => 'findcat',
		'field' => 'slug',
		'terms' => $t
		)
	)
	);
	$wp_query->query($param);
	if($wp_query->have_posts()): while($wp_query->have_posts()) :$wp_query->the_post();
	$c++;
	$lat = get_field('cf_lat');
	$long = get_field('cf_long');
	$count = total_cat_post_count($t);
	if(($c == $count)) {$char ='';} else {$char=',';}
	?>
{
"lat":<?php echo $lat; ?>,"lon":<?php echo $long; ?>,"title":"<?php the_title(); ?>",
"html":"<h3><?php the_title(); ?></h3><p><?php echo get_field('cf_address'); ?></p>",
"icon":"http://heartofdarknessbrewery.com/img/find/icon_map.png",
"zoom":16
}<?php echo $char;?>	
<?php endwhile; endif; ?>
]}