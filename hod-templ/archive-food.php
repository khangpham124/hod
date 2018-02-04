<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
include(APP_PATH."libs/head.php"); 
?>
<link rel="stylesheet" href="<?php echo APP_URL; ?>common/css/slick.css">
</head>

<body id="food">
<!--===================================================-->

<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->

<div id="slider_Food">
    <ul class="listMenu__food">
         <?php
                $args=array(
                    'post_type' => 'food',
                    'child_of' => '5',
                    'orderby' =>'ID',
                    'order' => 'DESC',
                    'hide_empty' => 0,
                    'taxonomy' => 'foodcat',
                    'number' => '0',
                    'pad_counts' => false
                    );
                    $categories = get_categories($args);
                    foreach ( $categories as $category ):
                    $slug = $category->slug;
                    $term_id=$category->term_id;
                    $img_cate = get_field( 'slide_food', 'foodcat_'.$term_id.'' );
                    $image_c = wp_get_attachment_image_src( $img_cate, 'full' );
           ?>
            <li><img src="<?php echo $image_c[0]; ?>" alt="">
                <p class="nameFood"><?php echo $category->name ?></p>
                <div class="orderBnt">
                    <!-- <a href="#h3_bar_snacks">ORDER NOW</a> !-->
                    <!-- <p><span>DELIVERY IN SAIGON ONLY</span></p> !-->
                </div>
            </li>
            <?php endforeach; ?>
    </ul>
</div>    

<div class="introFood">
    <div class="inner">
    <?php
            $wp_query = new WP_Query();
            $param=array(
            'order' => 'DESC',
            'posts_per_page' => '1',
            'tax_query' => array(
            array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => 'foodpage'
            )
            )
            );
            $wp_query->query($param);
            if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
    ?>
    <?php echo $post->post_content; ?>                  
    <?php endwhile;endif; ?>
    </div>
</div>
    
<div id="wrapper">
    
<h2 class="h2_site" id="menuFood">OUR MENU</h2>
    
      <div class="greyBox">
        <div class="inner">
            
            <ul class="listCountries clearfix f_lapresse pc">
                <?php
                    $i=0;
                    $args = array(
                    'post_type' => 'food',
                    'parent' => 0,
                    'hide_empty' => 0,
                    'taxonomy' => 'foodcat',
                    'pad_counts' => false );
                    $categories = get_categories( $args );
                    if ( is_user_logged_in() ) {
                     
                    }
                    foreach ($categories as $cat)
                    {
                    $i++;    
                ?>
				<li><a href="javascript:void(0)" id="call<?php echo $i; ?>"><?php echo $cat->name; ?></a></li>
                <?php } ?>
			</ul>
            <p class="btnMenu_sp sp" id="menu1"><?php $term1 = get_term( 5, foodcat ); echo $term1->name; ?></p>
            <div class="tabBox" id="tab1">
                <div class="container tabletPad">
                    <div class="loadingFood">
                        <img src="<?php echo APP_URL; ?>common/img/other/load.gif" alt="">
                    </div>
                <?php
                    $i=0;
                    $args=array(
                    'post_type' => 'food',
                    'child_of' => '5',
                    'orderby' =>'ID',
                    'order' => 'DESC',
                    'hide_empty' => 0,
                    'taxonomy' => 'foodcat',
                    'number' => '0',
                    'pad_counts' => false
                    );
                    $categories = get_categories($args);
                    foreach ( $categories as $category ):
                    $slug = $category->slug;
                    $i++;
                ?>
                <h3 class="h3_food f_lapresse" id="h3_<?php echo $slug ?>"><span>-<?php echo $category->name; ?>-</span></h3>
                <ul class="clearfix listFeature foodList" id="typeFood<?php echo $i; ?>">
                <?php    
                    $wp_query = new WP_Query();
                    $param=array(
                    'post_type'=>'food',
                    'order' => 'DESC',
                    'posts_per_page' => '-1',
                    'tax_query' => array(
                    array(
                    'taxonomy' => 'foodcat',
                    'field' => 'slug',
                    'terms' => $slug
                    )
                    )
                    );
                    $wp_query->query($param);
                    if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                    $thumb = get_post_thumbnail_id($post->ID);
                    $image_thumb = wp_get_attachment_image_src($thumb,'full');
                ?>    
                    <li>
                        <p class="listFeature__thumb"><img src="<?php echo $image_thumb[0]; ?>" class="" alt=""></p>
                        <p class="listFeature__name matchHeight"><a href=""><?php the_title(); ?></a></p>
                        <div class="listFeature__desc matchHeight"><?php echo $post->post_content; ?></div>
                        <p class="listFeature__price"><span <?php if(get_field('vegetarian')=='no') { ?>class="noBg"<?php } ?>>VND <?php the_field('cf_price'); ?></span></p>
                <?php if ( is_user_logged_in() ) { ?>
                <a href="javascript:void(0)" class="listFeature__btn" data-id="<?php the_ID(); ?>">add to cart</a>
                <?php } ?>
                    </li>
                <?php endwhile;endif; ?>
                </ul>
                <?php endforeach; ?>
            </div> 
            </div>
            
            <p class="btnMenu_sp sp" id="menu2"><?php $term2 = get_term( 11, foodcat ); echo $term2->name; ?></p>
            <div class="tabBox" id="tab2">
                <div class="container tabletPad">
                <div class="loadingFood">
                <img src="<?php echo APP_URL; ?>common/img/other/load.gif" alt="">
                </div>
                    <div class="descCat"><?php echo term_description(11,'foodcat') ?></div>    
                <ul class="clearfix listFeature foodList" id="typeDaily">
                <?php    
                    $wp_query = new WP_Query();
                    $param=array(
                    'post_type'=>'food',
                    'order' => 'DESC',
                    'posts_per_page' => '-1',
                    'tax_query' => array(
                    array(
                    'taxonomy' => 'foodcat',
                    'field' => 'slug',
                    'terms' => 'kurtz-weekly-specials'
                    )
                    )
                    );
                    $wp_query->query($param);
                    if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                    $thumb = get_post_thumbnail_id($post->ID);
                    $image_thumb = wp_get_attachment_image_src($thumb,'full');
                    ?>
                    <li>
                        <p class="listFeature__thumb"><img src="<?php echo $image_thumb[0]; ?>" class="" alt=""></p>
                        <p class="listFeature__name matchHeight"><a href=""><?php the_title(); ?></a></p>
                        <div class="listFeature__desc matchHeight"><?php echo $post->post_content; ?></div>
                        <p class="listFeature__price"><span <?php if(get_field('vegetarian')=='no') { ?>class="noBg"<?php } ?>>VND <?php the_field('cf_price'); ?></span></p>
                <?php if ( is_user_logged_in() ) { ?>
                <a href="javascript:void(0)" class="listFeature__btn" data-id="<?php the_ID(); ?>">add to cart</a>
                <?php } ?>
                    </li>
                <?php endwhile;endif; ?>      
                </ul>
                </div>         
            </div>

            <p class="btnMenu_sp sp" id="menu3"><?php $term3 = get_term( 12, foodcat ); echo $term3->name; ?></p>
            <div class="tabBox" id="tab3">
                <div class="container tabletPad">
                <div class="loadingFood">
                    <img src="<?php echo APP_URL; ?>common/img/other/load.gif" alt="">
                </div>
                <!--<h3 class="h3_food f_lapresse" id="h3_breakfast-burrito"><span>-special festival promotion-</span></h3>!-->
                <div class="descCat"><?php echo term_description(12,'foodcat') ?></div>        
                <ul class="clearfix listFeature foodList" id="typeSpecial">
                <?php    
                    $wp_query = new WP_Query();
                    $param=array(
                    'post_type'=>'food',
                    'order' => 'DESC',
                    'posts_per_page' => '-1',
                    'tax_query' => array(
                    array(
                    'taxonomy' => 'foodcat',
                    'field' => 'slug',
                    'terms' => 'breakfast-burrito'
                    )
                    )
                    );
                    $wp_query->query($param);
                    if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                    $thumb = get_post_thumbnail_id($post->ID);
                    $image_thumb = wp_get_attachment_image_src($thumb,'full');
                    ?>
                    <li>
                        <p class="listFeature__thumb"><img src="<?php echo $image_thumb[0]; ?>" class="" alt=""></p>
                        <p class="listFeature__name matchHeight"><a href=""><?php the_title(); ?></a></p>
                        <div class="listFeature__desc matchHeight"><?php echo $post->post_content; ?></div>
                        <p class="listFeature__price"><span <?php if(get_field('vegetarian')=='no') { ?>class="noBg"<?php } ?>>VND <?php the_field('cf_price'); ?></span></p>
                <?php if ( is_user_logged_in() ) { ?>
                <a href="javascript:void(0)" class="listFeature__btn" data-id="<?php the_ID(); ?>">add to cart</a>
                <?php } ?>
                    </li>
                <?php endwhile;endif; ?>      
                </ul>
                </div>         
            </div>
            
        </div>
    </div>
    
<!--Footer-->
<?php include(APP_PATH."libs/footer.php"); ?>
<!--/Footer-->
<!--===================================================-->
</div>
<!--/wrapper-->
<!--===================================================-->

<script>
    $(document).ready(function(){
        $('#tab1').addClass('active');
        $('#call1').parent('li').addClass('active');
        $('#menu1').addClass('active');
        $('.listCountries li').click(function(){
            $(".loadingFood").fadeIn(200).delay(300).fadeOut(200);
            var elm = $(this).find('a');
			var id_elm = elm.attr('id');
			var id_show = id_elm.substr(id_elm.length - 1);
			$('.tabBox').removeClass('active');
			$('#tab' + id_show).addClass('active');
			$('.listCountries li').removeClass('active');
			$(this).addClass('active');
		});
        $('.btnMenu_sp').click(function(){
            var elm = $(this);
            $(".loadingFood").fadeIn(200).delay(300).fadeOut(200);
            $('.tabBox').removeClass('active');
            elm.next('.tabBox').addClass('active');
            $('.btnMenu_sp').removeClass('active');
            elm.addClass('active');
            var scr = $(this).offset().top;
		});
    });    
</script>
<script src="<?php echo APP_URL; ?>common/js/slick.min.js"></script>
<script>
$(function() {    
    $('.listMenu__food').slick({
      dots: true,
      infinite: true,
      speed: 600,
      autoplay: true,
      arrows:true,
      autoplaySpeed: 3500,
      centerMode: true,
      centerPadding: '200px',
      slidesToShow: 1,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            centerMode: true,
            centerPadding: '180px',
            infinite: true,
            dots: false
          }
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 1,
            centerMode: true,
            centerPadding: '60px',
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            centerMode: true,
            centerPadding: '50px',
            slidesToScroll: 1
          }
        }

      ]
    });

    
var options = {
    dots: false,
  infinite: true,
  speed: 400,
  autoplay: true,
  arrows:true,
  autoplaySpeed: 2500,
  slidesToShow: 4,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 767,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    }
   
  ]
};
$('#typeFood1').slick(options);
$('#typeFood2').slick(options);
$('#typeFood3').slick(options);    
$('#typeFood4').slick(options);
$('#typeFood5').slick(options);
$('#typeDaily').slick(options);
$('#typeSpecial').slick(options);
});
</script>

</body>
</html>	