<?php
header('Content-Type: application/json');
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
include(APP_PATH_WP."wp-load.php");
$t = $_GET['type'];
if(!$t) {
$t = 'ho-chi-minh';
}

switch($t) {
	case 'ho-chi-minh':
	$name ='Hồ Chí Minh';
	break;
	
	case 'ha-noi':
	$name ='Hà Nội';
	break;
	
	case 'da-nang':
	$name ='Đà Nẵng';
	break;
	
	case 'hai-phong':
	$name ='Hải Phòng';
	break;
	
	case 'can-tho':
	$name ='Cần Thơ';
	break;
	
	case 'an-giang':
	$name ='An Giang';
	break;
	
	case 'ba-ria-vung-tau':
	$name ='Bà Rịa Vũng tàu';
	break;
	
	case 'bac-kan':
	$name ='Bắc Kạn';
	break;
	
	case 'bac-lieu':
	$name ='Bạc Liêu';
	break;
	
	case 'bac-ninh':
	$name ='Bắc Ninh';
	break;
	
	case 'ben-tre':
	$name = 'Bến Tre';
	break;
	
	case 'binh-dinh':
	$name = 'Bình Định';
	break;
	
	case 'binh-duong':
	$name = 'Bình Dương';
	break;
	
	case 'binh-phuoc':
	$name = 'Bình Phước';
	break;
	
	case 'binh-thuan':
	$name = 'Bình Thuận';
	break;
	
	case 'ca-mau':
	$name = 'Cà Mau';
	break;
	
	case 'dak-lak':
	$name = 'Đắk Lắk';
	break;
	
	case 'dien-bien':
	$name = 'Điện Biên';
	break;
	
	case 'dong-nai':
	$name = 'Đồng Nai';
	break;
	
	case 'gia-lai':
	$name = 'Gia Lai';
	break;
	
	case 'ha-nam':
	$name = 'Hà Nam';
	break;
	
	case 'ha-tinh':
	$name = 'Hà Tĩnh';
	break;
	
	case 'hau-giang':
	$name = 'Hậu Giang';
	break;
	
	case 'hung-yen':
	$name = 'Hưng Yên';
	break;
	
	case 'khanh-hoa':
	$name = 'Khánh Hoà';
	break;
	
	case 'kontum':
	$name = 'KonTum';
	break;
	
	case 'lam-dong':
	$name = 'Lâm Đồng';
	break;
	
	case 'lang-son':
	$name = 'Lạng Sơn';
	break;
	
	case 'long-an':
	$name = 'Long An';
	break;
	
	case 'lao-cai':
	$name = 'Lào Cai';
	break;
	
	case 'nam-dinh':
	$name = 'Nam Định';
	break;
	
	case 'nghe-an':
	$name = 'Nghệ An';
	break;
	
	case 'ninh-binh':
	$name = 'Ninh Bình';
	break;
	
	case 'ninh-thuan':
	$name = 'Ninh Thuận';
	break;
	
	case 'phu-tho':
	$name = 'Phú Thọ';
	break;
	
	case 'phu-yen':
	$name = 'Phú Yên';
	break;
	
	case 'quang-binh':
	$name = 'Quảng Bình';
	break;
	
	case 'quang-nam':
	$name = 'Quảng Nam';
	break;
	
	case 'quang-ngai':
	$name = 'Quảng Ngãi';
	break;
	
	case 'quang-ninh':
	$name = 'Quảng Ninh';
	break;
	
	case 'quang-tri':
	$name = 'Quảng Trị';
	break;
	
	case 'soc-trang':
	$name = 'Sóc Trăng';
	break;
	
	case 'son-la':
	$name = 'Sơn La';
	break;
	
	case 'tay-ninh':
	$name = 'Tây Ninh';
	break;
	
	case 'thai-binh':
	$name = 'Thái Bình';
	break;
	
	case 'thai-nguyen':
	$name = 'Thái Nguyên';
	break;
	
	case 'thanh-hoa':
	$name = 'Thanh Hoá';
	break;
	
	case 'tien-giang':
	$name = 'Tiền Giang';
	break;
	
	case 'tra-vinh':
	$name = 'Trà Vinh';
	break;
	
	case 'tuyen-quang':
	$name = 'Tuyên Quang';
	break;
	
	case 'vinh-long':
	$name = 'Vĩnh Long';
	break;
	
	case 'lai-chau':
	$name = 'Lai Châu';
	break;
	
	case 'dong-thap':
	$name = 'Đồng Tháp';
	break;
	
	case 'dak-nong':
	$name = 'Đắk Nông';
	break;

	case 'hai-duong':
	$name = 'Hải Dương';
	break;
	
}

?>

{
		"title":"<?php echo $name; ?>",
		"type":"marker",
		"locations":[
<?php	
	$c=0;	
	$wp_query = new WP_Query();
	$param = array (
	'posts_per_page' => '-1',
	'post_type' => 'store',
	'post_status' => 'publish',
	'order' => 'DESC',
	'paged' => $paged,
	'tax_query' => array(
	 array(
		 'taxonomy' => 'storecat',
		'field' => 'slug',
		'terms' => $t
		  )
		  )
	);
	$wp_query->query($param);
	if($wp_query->have_posts()): while($wp_query->have_posts()) :$wp_query->the_post();
	$c++;
	
	$location = get_field('google_map');
	
	
		
	$count = total_cat_post_count($t);
	
	
//	 $count = count( get_posts( $args2 ) );
	if(($c == $count)) {$char ='';} else {$char=',';}
	?>
		{
		"lat":<?php echo $location['lat']; ?>,"lon":<?php echo $location['lng']; ?>,"title":"<?php the_title(); ?>",
		"html":"<h3><?php the_title(); ?></h3><p><?php echo $location['address']; ?></p>",
		"icon":"http://gioneemobile.vn/img/support/ico_map.png",
		"zoom":16
		}<?php echo $char;?>	
<?php	endwhile; endif; ?>
]}