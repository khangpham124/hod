<?php
include($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
include(APP_PATH . '/hod/wp-load.php');
$pagename = str_replace(array('/', '.php', '?s='), '', $_SERVER['REQUEST_URI']);
$pagename = str_replace("wp", '', $_SERVER['REQUEST_URI']);
$pagename = $pagename ? $pagename : 'default';

switch ($pagename) {
	
	case "/shop/":
        $shop = get_post(569);
        $thumb_shop = get_post_thumbnail_id(569);
		$img_shop = wp_get_attachment_image_src($thumb_shop,'full');
        $titlepage = $shop->post_title;
		$desPage = get_post_meta( 569, 'description', true );
		$img_og = $img_shop[0];
	break;
        
    case "/about/":
        $about = get_post(568);
        $thumb_about = get_post_thumbnail_id(568);
		$img_about = wp_get_attachment_image_src($thumb_about,'full');
        $titlepage = $about->post_title;
		$desPage = get_post_meta( 568, 'description', true );
		$img_og = $img_about[0];
	break;
        
    case "/career/":
        $career = get_post(567);
        $thumb_career = get_post_thumbnail_id(567);
		$img_career = wp_get_attachment_image_src($thumb_career,'full');
        $titlepage = $career->post_title;
		$desPage = get_post_meta( 567, 'description', true );
		$img_og = $img_career[0];
	break;
        
    case "/press/":
        $press = get_post(566);
        $thumb_press = get_post_thumbnail_id(566);
		$img_press = wp_get_attachment_image_src($thumb_press,'full');
        $titlepage = $press->post_title;
		$desPage = get_post_meta( 566, 'description', true );
		$img_og = $img_press[0];
	break; 
    
    case "/find/":
        $find = get_post(565);
        $thumb_find = get_post_thumbnail_id(565);
		$img_find = wp_get_attachment_image_src($thumb_find,'full');
        $titlepage = $find->post_title;
		$desPage = get_post_meta( 565, 'description', true );
		$img_og = $img_find[0];
	break;
        
    case "/location/":
        $location = get_post(564);
        $thumb_location = get_post_thumbnail_id(564);
		$img_location = wp_get_attachment_image_src($thumb_location,'full');
        $titlepage = $location->post_title;
		$desPage = get_post_meta( 564, 'description', true );
		$img_og = $img_location[0];
	break;
        
    case "/food/":
        $food = get_post(563);
        $thumb_food = get_post_thumbnail_id(563);
		$img_food = wp_get_attachment_image_src($thumb_food,'full');
        $titlepage = $food->post_title;
		$desPage = get_post_meta( 563, 'description', true );
		$img_og = $img_food[0];
	break;
        
    case "/beer/":
        $beer = get_post(562);
        $thumb_beer = get_post_thumbnail_id(562);
		$img_beer = wp_get_attachment_image_src($thumb_beer,'full');
        $titlepage = $beer->post_title;
		$desPage = get_post_meta( 562, 'description', true );
		$img_og = $img_beer[0];
	break;    
	 
    default:
        $top = get_post(717);
        $thumb_top = get_post_thumbnail_id(717);
        $img_top = wp_get_attachment_image_src($thumb_top,'full');
        $img_og = $img_top[0];
		if((!$titlepage)||(!$titlepage=='')) {
            $titlepage = $top->post_title;
        }
        if((!$desPage)||(!$desPage=='')) {
		$desPage = get_post_meta( 717, 'description', true );
        }
		$txtH1 = "Heart of Darkness Craft Brewery in Saigon Vietnam";
}
?>