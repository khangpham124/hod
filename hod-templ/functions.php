<?php
session_start();
error_reporting(0);
//login logo
function custom_login_logo() {
        echo '<style type="text/css">h1 a { background: url('.get_bloginfo('template_directory').'/images/logo.svg) 50% 50% no-repeat !important; width:112px !important;height:86px !important }</style>';
}

add_action('login_head', 'custom_login_logo');
add_theme_support('post-thumbnails');

//timthumb

define('THEME_DIR', get_template_directory_uri());
/* Timthumb CropCropimg */
function thumbCrop($img='', $w=false, $h=false, $zc=1){
    if($h)
        $h = "&amp;h=$h";
    else
        $h = "";
        
    if($w)
        $w = "&amp;w=$w";
    else
        $w = "";
    $img = str_replace(get_bloginfo('url'), '', $img);
    $image_url = THEME_DIR . "/timthumb/timthumb.php?src=" . $img . $h . $w ;
    return $image_url;

}
//$image_cache = THEME_DIR . "/php/cache/";
//chmod($image_cache, 0777);



function custom_admin_footer() {
    echo 'Heart of Darkness Craft Brewery ';
}
add_filter('admin_footer_text', 'custom_admin_footer');

/* term drop down function */
function todo_restrict_manage_posts() {
    global $typenow;
    $args=array( 'public' => true, '_builtin' => false );
    $post_types = get_post_types($args);
    if ( in_array($typenow, $post_types) ) {
    $filters = get_object_taxonomies($typenow);
        foreach ($filters as $tax_slug) {
            $tax_obj = get_taxonomy($tax_slug);
            wp_dropdown_categories(array(
                'show_option_all' => __('Filter '),
                'taxonomy' => $tax_slug,
                'name' => $tax_obj->name,
                'orderby' => 'term_order',
                'selected' => $_GET[$tax_obj->query_var],
                'hierarchical' => $tax_obj->hierarchical,
                'show_count' => false,
                'hide_empty' => true
            ));
        }
    }
}
function todo_convert_restrict($query) {
    global $pagenow;
    global $typenow;
    if ($pagenow=='edit.php') {
        $filters = get_object_taxonomies($typenow);
        foreach ($filters as $tax_slug) {
            $var = &$query->query_vars[$tax_slug];
            if ( isset($var) ) {
                $term = get_term_by('id',$var,$tax_slug);
                $var = $term->slug;
            }
        }
    }
    return $query;
}
add_action( 'restrict_manage_posts', 'todo_restrict_manage_posts' );
add_filter('parse_query','todo_convert_restrict');
/* term drop down function end*/

//for archives
global $my_archives_post_type;
add_filter( 'getarchives_where', 'my_getarchives_where', 10, 2 );
function my_getarchives_where( $where, $r ) {
  global $my_archives_post_type;
  if ( isset($r['post_type']) ) {
    $my_archives_post_type = $r['post_type'];
    $where = str_replace( '\'post\'', '\'' . $r['post_type'] . '\'', $where );
  } else {
    $my_archives_post_type = '';
  }
  return $where;
}
add_filter( 'get_archives_link', 'my_get_archives_link' );
function my_get_archives_link( $link_html ) {
  global $my_archives_post_type;
  if ( '' != $my_archives_post_type )
    $add_link .= '?post_type=' . $my_archives_post_type;
	$link_html = preg_replace("/href=\'(.+)\'\s/","href='$1".$add_link."'",$link_html);

  return $link_html;
}

// paging
$option_posts_per_page = get_option( 'posts_per_page' );
add_action( 'init', 'my_modify_posts_per_page', 0);
function my_modify_posts_per_page() {
    add_filter( 'option_posts_per_page', 'my_option_posts_per_page' );
}


// Custom post


add_action('init', 'my_custom_flagship');
function my_custom_flagship()
{
  $labels = array(
    'name' => _x('Flagship', 'post type general name'),
    'singular_name' => _x('Flagship', 'post type singular name'),
    'add_new' => _x('Add Flagship', 'news'),
    'add_new_item' => __('Flagship'),
    'edit_item' => __('Edit Flagship'),
    'new_item' => __('Flagship'),
    'view_item' => __('Flagship'),
    'search_staff' => __(''),
    'not_found' =>  __('not found'),
    'not_found_in_trash' => __('not found'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array('title','editor','thumbnail'),
    'has_archive' => true,
  );
  register_post_type('flagship',$args);
}

add_action('init', 'my_custom_seasonal');
function my_custom_seasonal()
{
  $labels = array(
    'name' => _x('Seasonal', 'post type general name'),
    'singular_name' => _x('Seasonal', 'post type singular name'),
    'add_new' => _x('Add Seasonal', 'news'),
    'add_new_item' => __('Seasonal'),
    'edit_item' => __('Edit Seasonal'),
    'new_item' => __('Seasonal'),
    'view_item' => __('Seasonal'),
    'search_staff' => __(''),
    'not_found' =>  __('not found'),
    'not_found_in_trash' => __('not found'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array('title','editor','thumbnail'),
    'has_archive' => true,
  );
  register_post_type('seasonal',$args);
}

add_action('init', 'my_custom_bottles');
function my_custom_bottles()
{
  $labels = array(
    'name' => _x('Bottles', 'post type general name'),
    'singular_name' => _x('Bottles', 'post type singular name'),
    'add_new' => _x('Add Bottles', 'news'),
    'add_new_item' => __('Bottles'),
    'edit_item' => __('Edit Seasonal'),
    'new_item' => __('Seasonal'),
    'view_item' => __('Seasonal'),
    'search_staff' => __(''),
    'not_found' =>  __('not found'),
    'not_found_in_trash' => __('not found'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array('title','editor','thumbnail'),
    'has_archive' => true,
  );
  register_post_type('bottles',$args);
}


add_action('init', 'my_custom_food');
function my_custom_food()
{
  $labels = array(
    'name' => _x('Food', 'post type general name'),
    'singular_name' => _x('Food', 'post type singular name'),
    'add_new' => _x('Add Food', 'news'),
    'add_new_item' => __('Food'),
    'edit_item' => __('Edit Food'),
    'new_item' => __('Food'),
    'view_item' => __('Food'),
    'search_staff' => __(''),
    'not_found' =>  __('not found'),
    'not_found_in_trash' => __('not found'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array('title','editor','thumbnail'),
    'has_archive' => true,
  );
  register_post_type('food',$args);
}

add_action ('init','create_foodcat_taxonomy','0');
function create_foodcat_taxonomy () {
	$taxonomylabels = array(
	'name' => _x('foodcat','post type general name'),
	'singular_name' => _x('foodcat','post type singular name'),
	'search_items' => __('foodcat'),
	'all_items' => __('foodcat'),
	'parent_item' => __( 'Parent Cat' ),
	'parent_item_colon' => __( 'Parent Cat:' ),
	'edit_item' => __('foodcat'),
	'add_new_item' => __('foodcat'),
	'menu_name' => __( 'categories' ),
	);
	$args = array(
	'labels' => $taxonomylabels,
	'hierarchical' => true,
	'has_archive' => true,
	'show_ui' => true,
	 'query_var' => true,
	 'rewrite' => array( 'slug' => 'foodcat' )
	);
	register_taxonomy('foodcat','food',$args);
}

add_action('init', 'my_custom_shop');
function my_custom_shop()
{
  $labels = array(
    'name' => _x('Shop', 'post type general name'),
    'singular_name' => _x('Shop', 'post type singular name'),
    'add_new' => _x('Add Shop', 'news'),
    'add_new_item' => __('Shop'),
    'edit_item' => __('Edit Shop'),
    'new_item' => __('Shop'),
    'view_item' => __('Shop'),
    'search_staff' => __(''),
    'not_found' =>  __('not found'),
    'not_found_in_trash' => __('not found'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array('title','editor','thumbnail'),
    'has_archive' => true,
  );
  register_post_type('shop',$args);
}


add_action ('init','create_shopcat_taxonomy','0');
function create_shopcat_taxonomy () {
	$taxonomylabels = array(
	'name' => _x('shopcat','post type general name'),
	'singular_name' => _x('shopcat','post type singular name'),
	'search_items' => __('shopcat'),
	'all_items' => __('shopcat'),
	'parent_item' => __( 'Parent Cat' ),
	'parent_item_colon' => __( 'Parent Cat:' ),
	'edit_item' => __('shopcat'),
	'add_new_item' => __('add shopcat'),
	'menu_name' => __( 'categories' ),
	);
	$args = array(
	'labels' => $taxonomylabels,
	'hierarchical' => true,
	'has_archive' => true,
	'show_ui' => true,
	 'query_var' => true,
	 'rewrite' => array( 'slug' => 'shopcat' )
	);
	register_taxonomy('shopcat','shop',$args);
}

add_action('init', 'my_custom_find');
function my_custom_find()
{
  $labels = array(
    'name' => _x('Find', 'post type general name'),
    'singular_name' => _x('Find', 'post type singular name'),
    'add_new' => _x('Add Find', 'news'),
    'add_new_item' => __('Find'),
    'edit_item' => __('Edit Find'),
    'new_item' => __('Find'),
    'view_item' => __('Find'),
    'search_staff' => __(''),
    'not_found' =>  __('not found'),
    'not_found_in_trash' => __('not found'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array('title'),
    'has_archive' => true,
  );
  register_post_type('find',$args);
}

add_action ('init','create_findcat_taxonomy','0');
function create_findcat_taxonomy () {
	$taxonomylabels = array(
	'name' => _x('findcat','post type general name'),
	'singular_name' => _x('findcat','post type singular name'),
	'search_items' => __('findcat'),
	'all_items' => __('findcat'),
	'parent_item' => __( 'Parent Cat' ),
	'parent_item_colon' => __( 'Parent Cat:' ),
	'edit_item' => __('findcat'),
	'add_new_item' => __('findcat'),
	'menu_name' => __( 'categories' ),
	);
	$args = array(
	'labels' => $taxonomylabels,
	'hierarchical' => true,
	'has_archive' => true,
	'show_ui' => true,
	 'query_var' => true,
	 'rewrite' => array( 'slug' => 'findcat' )
	);
	register_taxonomy('findcat','find',$args);
}

add_action('init', 'my_custom_press');
function my_custom_press()
{
  $labels = array(
    'name' => _x('Press', 'post type general name'),
    'singular_name' => _x('Press', 'post type singular name'),
    'add_new' => _x('Add Press', 'news'),
    'add_new_item' => __('Press'),
    'edit_item' => __('Edit Press'),
    'new_item' => __('Press'),
    'view_item' => __('Press'),
    'search_staff' => __(''),
    'not_found' =>  __('not found'),
    'not_found_in_trash' => __('not found'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array('title','editor','thumbnail'),
    'has_archive' => true,
  );
  register_post_type('Press',$args);
}


add_action('init', 'my_custom_career');
function my_custom_career()
{
  $labels = array(
    'name' => _x('Career', 'post type general name'),
    'singular_name' => _x('Career', 'post type singular name'),
    'add_new' => _x('Add Career', 'news'),
    'add_new_item' => __('Career'),
    'edit_item' => __('Edit Career'),
    'new_item' => __('Career'),
    'view_item' => __('Career'),
    'search_staff' => __(''),
    'not_found' =>  __('not found'),
    'not_found_in_trash' => __('not found'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array('title','editor','thumbnail'),
    'has_archive' => true,
  );
  register_post_type('career',$args);
}


add_action ('init','create_careercat_taxonomy','0');
function create_careercat_taxonomy () {
	$taxonomylabels = array(
	'name' => _x('careercat','post type general name'),
	'singular_name' => _x('careercat','post type singular name'),
	'search_items' => __('careercat'),
	'all_items' => __('careercat'),
	'parent_item' => __( 'Parent Cat' ),
	'parent_item_colon' => __( 'Parent Cat:' ),
	'edit_item' => __('careercat'),
	'add_new_item' => __('add careercat'),
	'menu_name' => __( 'categories' ),
	);
	$args = array(
	'labels' => $taxonomylabels,
	'hierarchical' => true,
	'has_archive' => true,
	'show_ui' => true,
	 'query_var' => true,
	 'rewrite' => array( 'slug' => 'careercat' )
	);
	register_taxonomy('careercat','career',$args);
}

add_action('init', 'my_custom_video');
function my_custom_video()
{
  $labels = array(
    'name' => _x('Video', 'post type general name'),
    'singular_name' => _x('Video', 'post type singular name'),
    'add_new' => _x('Add Video', 'news'),
    'add_new_item' => __('Video'),
    'edit_item' => __('Edit Video'),
    'new_item' => __('Video'),
    'view_item' => __('Video'),
    'search_staff' => __(''),
    'not_found' =>  __('not found'),
    'not_found_in_trash' => __('not found'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array('title'),
    'has_archive' => true,
  );
  register_post_type('video',$args);
}

add_action('init', 'my_custom_customer');
function my_custom_customer()
{
  $labels = array(
    'name' => _x('Customer', 'post type general name'),
    'singular_name' => _x('Customer', 'post type singular name'),
    'add_new' => _x('Add Customer', 'news'),
    'add_new_item' => __('Customer'),
    'edit_item' => __('Edit Customer'),
    'new_item' => __('Customer'),
    'view_item' => __('Customer'),
    'search_staff' => __(''),
    'not_found' =>  __('not found'),
    'not_found_in_trash' => __('not found'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array('title'),
    'has_archive' => true,
  );
  register_post_type('customer',$args);
}

add_action('init', 'my_custom_order');
function my_custom_order() {
	$labels = array(
		'name' => _x('Order', 'post type general name'),
		'singular_name' => _x('Order', 'post type singular name'),
		'add_new' => _x('Thêm', 'product'),
		'add_new_item' => __('Add'),
		'edit_item' => __('Edit'),
		'new_item' => __('Add'),
		'view_item' => __('Xem'),
		'search_item' => __('Search'),
		'not_found' =>  __('Not found'),
		'not_found_in_trash' => __('Not found in trash'),
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'supports' => array('title', 'editor'),
		'has_archive' => true,
		//'menu_icon' => 'dashicons-media-spreadsheet',
	);
	register_post_type('customer_order',$args);
}



/* SPECIFIC FUNCTION */

add_action( 'admin_menu', 'remove_menus' );
  
  function remove_menus() {
    global $menu;
    global $submenu;
    // Hide some menus
    if ( wp_get_current_user()->ID == 3 ) {
        remove_menu_page( 'edit.php' );
        remove_menu_page( 'edit.php?post_type=find' );
        remove_menu_page( 'edit.php?post_type=press' );
        remove_menu_page( 'edit.php?post_type=career' );
        remove_menu_page( 'edit.php?post_type=video' );
        remove_menu_page( 'edit.php?post_type=customer' );
        remove_menu_page( 'edit.php?post_type=customer_order' );
        remove_menu_page( 'edit-comments.php' );
        remove_menu_page( 'admin.php?page=wpcf7');   //Pages
        remove_menu_page( 'upload.php' );          //Comments
        remove_menu_page( 'themes.php' );
        remove_menu_page( 'edit.php?post_type=page' );
    }
      
    if ( wp_get_current_user()->ID == 4 ) {
        remove_menu_page( 'edit.php');
        remove_menu_page( 'edit.php?post_type=find' );
        remove_menu_page( 'edit.php?post_type=beer' );
        remove_menu_page( 'edit.php?post_type=shop' );
        remove_menu_page( 'edit.php?post_type=food' );
        remove_menu_page( 'edit.php?post_type=press' );
        remove_menu_page( 'edit.php?post_type=career' );
        remove_menu_page( 'edit.php?post_type=video' );
        remove_menu_page( 'edit.php?post_type=customer' );
        remove_menu_page( 'edit-comments.php' );
        remove_menu_page( 'admin.php?page=wpcf7');   //Pages
        remove_menu_page( 'upload.php' );          //Comments
        remove_menu_page( 'themes.php' );
        remove_menu_page( 'edit.php?post_type=page');
    }
  }


function total_cat_post_count( $slug ){
  $q = new WP_Query( array(
      'nopaging' => true,
      'tax_query' => array(
          array(
              'taxonomy' => 'findcat', // taxonmy name
              'field' => 'slug',
              'terms' => $slug,
              'include_children' => true,
          ),
      ),
      'fields' => 'ids',
  ) );
  return $q->post_count;
}



function get_id_youtube($link) {
	parse_str( parse_url( $link, PHP_URL_QUERY ), $vars );
	return $vars['v'];
}
