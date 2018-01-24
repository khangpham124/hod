<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
include(APP_PATH."libs/head.php"); 
?>
<link rel="stylesheet" href="<?php echo APP_URL; ?>common/css/slick.css">
</head>

<body id="top">
<!--===================================================-->

<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->

<!--<div id="slider">
    <div class="videoWrapper" data-youtube-id="BL8h9G1BCsE" data-numberSlide="3">
        <div id="video-placeholder"></div>
    </div>
    <p class="hashTag">#enterthedarkness</p>
</div> !-->
    
<div id="sliderTop">    
<section class="main-slider">
    <?php
        $wp_query = new WP_Query();
        $param = array (
        'posts_per_page' => '5',
        'post_type' => 'video',
        'post_status' => 'publish',
        'order' => 'DESC',
        'meta_query' => array(
        array(
        'key' => 'cf_hideshow',
        'value' => 'yes',
        'compare' => '='
        ))

        );
        $wp_query->query($param);
        if($wp_query->have_posts()): while($wp_query->have_posts()) :$wp_query->the_post();
        $url_video = get_field('cf_youtube_link');
        $id_video = get_id_youtube($url_video);
    ?>
    <div class="item youtube">
        <iframe class="embed-player slide-media" width="980" height="520" src="https://www.youtube.com/embed/<?php echo $id_video; ?>?enablejsapi=1&controls=0&fs=0&iv_load_policy=3&rel=0&showinfo=0&loop=1&playlist=<?php echo $id_video; ?>&start=0" frameborder="0" allowfullscreen></iframe> 
    </div>
    <?php endwhile;endif; ?>
</section>
<p class="hashTag">#enterthedarkness</p>
<span id="muteBtn"><i class="fa fa-volume-off" aria-hidden="true"></i></span>    
</div>    

<div class="boxTop01">
    <div class="inner clearfix">
        <p class="imgIntro"><img src="<?php echo APP_URL; ?>img/top/beer1.png" class="" alt=""></p>
        <div class="txtInto" id="introText">
        <?php
            $wp_query = new WP_Query();
            $param=array(
            'order' => 'DESC',
            'posts_per_page' => '1',
            'tax_query' => array(
            array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => 'toppage'
            )
            )
            );
            $wp_query->query($param);
            if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
            $txt_food = get_field('cf_food_text');
            $txt_deliver = get_field('cf_text_deliver');
            $txt_ww = get_field('cf_text_world_wide');
            $txt_find = get_field('cf_find_beer');
        ?>    
            <div class="pc"><?php echo $post->post_content; ?></div>
            <div class="sp"><?php the_field('mobile_content'); ?></div>
        <?php endwhile;endif; ?>    
            <p class="btnMore btnIntro f_lapresse pc"><a href="javascript:void(0)">MORE</a></p>
        </div>
    </div>
    <p class="btnMore f_lapresse ps btnIntro sp"><a href="javascript:void(0)">MORE</a></p>
</div>    
<div id="wrapper">
    
<h2 class="h2_site">OUR BEER</h2>
    <ul class="lstBeer clearfix">
        <?php
            $wp_query = new WP_Query();
            $param=array(
            'post_type'=>'beer',
            'posts_per_page' => '-1',
             'meta_query' => array(array('key' => '_thumbnail_id')),    
            'tax_query' => array(
            array(
            'taxonomy' => 'beercat',
            'field' => 'slug',
            'terms' => array('flagship-beer','seasonal')
            )
            )
            );
            $wp_query->query($param);
            if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
            $thumb = get_post_thumbnail_id($post->ID);
            $img_label = wp_get_attachment_image_src($thumb,'full');
            $img_cup = wp_get_attachment_image_src(get_field('image_beer'),'full');
            $terms = get_the_terms($post->ID, 'beercat');
            foreach($terms as $term) { 
            $termname = $term->name;
            }
        ?>
        <li class="matchHeight">
            <p class="thumb">
                <img src="<?php echo $img_label[0]; ?>" class="imgBeer" alt="<?php the_title(); ?>">
            </p>
            <div class="wrap">
                <div class="inner">
                        <img src="<?php echo $img_cup[0]; ?>" class="cupB" alt="<?php the_title(); ?>">
                        <div class="info">
                            <p class="nameBeer"><?php the_field('cf_abv'); ?> ABV</p>
                            <p class="subName"><?php the_field('cf_ibu'); ?> IBU</p>
                        </div>    
                        <p class="flag"><span><?php echo $termname; ?></span></p>

                </div>
                <div class="flipCard">
                    <?php echo $post->post_content; ?>
                </div>
            </div>
        </li>
        <?php endwhile; endif; ?>
    </ul>
    
    <div class="wrap15">
    <p class="btnMore f_lapresse"><a href="<?php echo APP_URL; ?>beer">MORE</a></p>
    </div>
    
    <div class="boxMenu" id="menuPart">
        <h2 class="h2_site">MENU</h2>
        <h3 class="sub_h2_site">
            <?php echo $txt_food; ?>
        </h3>
        <div class="inner pc">
            <ul class="lstMenu clearfix">
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
                    $term_id=$category->term_id;
                    $img_cate = get_field( 'image_menu', 'foodcat_'.$term_id.'' );
                    $image_c = wp_get_attachment_image_src( $img_cate, 'full' );
                    $i++;
                    if($i%3==0) {$ul='</ul><ul class="lstMenu clearfix lstMenu--center">';} else {$ul='';}
                ?>
                <li>
                    <img src="<?php echo $image_c[0]; ?>" class="" alt="">
                    <p class="name"><?php echo $category->name; ?></p>
                    <div class="invi f_lapresse">
                        <img src="<?php echo $image_c[0]; ?>" class="" alt="">
                        <div class="invi_info">
                            <p class="name_invi"><?php echo $category->name; ?></p>
                            <p class="btnMore"><a href="<?php echo APP_URL; ?>food/#h3_<?php echo $slug; ?>">MORE</a></p>
                        </div>    
                    </div>
                </li>
                <?php echo $ul; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        
        
        <div class="inner sp">
            <ul class="lstMenu clearfix biggerlink">
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
                    $img_cate = get_field( 'image_menu', 'foodcat_'.$term_id.'' );
                    $image_c = wp_get_attachment_image_src( $img_cate, 'full' );
                ?>
                <li>
                    <img src="<?php echo $image_c[0]; ?>" class="" alt="">
                    <p class="name"><a href="<?php echo APP_URL; ?>food/#h3_<?php echo $slug; ?>"><?php echo $category->name; ?></a></p>
                </li>
                <?php endforeach; ?>
            </ul>
            
        </div>
        
        <div class="btnMenu">
            <div class="clearfix">
                <a href="<?php echo APP_URL; ?>food" class="btnMenu__btn1">view full menu</a>
                <a href="javascript:void(0)" class="btnMenu__btn2 chatFb">BOOK A TABLE!</a>
            </div>    
            <p class="txtDeliver"><span><?php echo $txt_deliver; ?></span></p>
        </div>
    </div>
    
    <h2 class="h2_site">featured items</h2>
    <div class="container tabletPad">
        <ul class="listFeature clearfix">
            <?php
                $wp_query = new WP_Query();
                $param = array (
                'posts_per_page' => '10',
                'post_type' => 'shop',
                'post_status' => 'publish',
                'order' => 'DESC',
                'paged' => $paged,
                );
                $wp_query->query($param);
                if($wp_query->have_posts()): while($wp_query->have_posts()) :$wp_query->the_post();
                $thumb_shop = get_post_thumbnail_id($post->ID);
                $image_shop = wp_get_attachment_image_src($thumb_shop,'full');
                $terms = get_the_terms($post->ID, 'shopcat');
                foreach($terms as $term) { 
                $slug = $term->slug;
                }
            ?>
            <li>
                <p class="listFeature__thumb"><img src="<?php echo $image_shop[0]; ?>" class="" alt=""></p>
                <p class="listFeature__name"><a href=""><?php the_title(); ?></a></p>
                <div class="listFeature__desc matchHeight">
                <?php if($slug=='t-shirt') { ?>    
                    <p><?php the_field('t_shirt_type'); ?></p>
                    <p><?php the_field('cf_size'); ?></p>
                <?php } ?>
                </div>
    
                <p class="listFeature__price">VND <?php the_field('cf_price'); ?></p>
                <!-- <a href="" class="listFeature__btn">add to cart</a> !-->
            </li>
            <?php endwhile;endif; ?>
        </ul>
        <p class="btnMore f_lapresse"><a href="<?php echo APP_URL; ?>shop">shop now</a></p>
        <p class="txtNote pc"><span><?php echo $txt_ww; ?></span></p>
    
    </div>    
    
    <div class="greyBox">
        <div class="inner">
            <h2 class="h2_site">find our beer</h2>
            <h3 class="sub_h2_site"><?php echo $txt_find; ?></h3>
            
            <div class="pc">
            <!--<ul class="listCountries clearfix f_lapresse">
				<li><a href="javascript:void(0)" id="call1">VIETNAM</a></li>
				<li><a href="javascript:void(0)" id="call2">THAILAND</a></li>
                <li><a href="javascript:void(0)" id="call3">SINGAPORE</a></li>
                <li><a href="javascript:void(0)" id="call4">TAIWAN</a></li>
			</ul> !-->
            <?php 
                $n=0;
                $args=array(
                'post_type' => 'find',
                'parent' => 0,
                'orderby' =>'ID',
                'order' => 'ASC',
                'hide_empty' => 0,
                'taxonomy' => 'findcat',
                'number' => '0',
                'pad_counts' => false
                );
                $categories = get_categories($args);
                foreach ( $categories as $category ):
                $termid = $category->term_id;
                $n++;
            ?>
            <div class="tabBox" id="tab<?php echo $n; ?>">
                <ul class="lstCity">
                    <?php
                    $args1 = array(
                    'post_type' => 'find',
                    'child_of' => $category->term_id,
                    'orderby' =>'ID',
                    'order' => 'ASC',
                    'hide_empty' => 1,
                    'taxonomy' => 'findcat',
                    'number' => '0',
                    'pad_counts' => false
                    );
                    //var_dump($args1);
                    $cate = get_categories( $args1 );
                    foreach ($cate as $cat)
                    {
                    $slug_cate = $cat->slug;
                    ?> 
                    <li>
                        <h4><?php echo $cat->name; ?></h4>
                        <ul class="clearfix">
                            <?php 
                                $wp_query = new WP_Query();
                                $param=array(
                                'post_type'=>'find',
                                'order' => 'DESC',
                                'posts_per_page' => '-1',
                                'tax_query' => array(
                                array(
                                'taxonomy' => 'findcat',
                                'field' => 'slug',
                                'terms' => $slug_cate
                                )
                                )
                                );
                                $wp_query->query($param);
                                if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                            ?>
                            <li>
                                <p class="name"><?php the_title() ?></p>
                                <div class="add matchHeight"><?php the_field('cf_address'); ?></div>
                                <a href="<?php the_field('cf_web'); ?>" class="web">Visit website <span>>></span></a>
                            </li>
                            <?php endwhile;endif; ?>
                        </ul>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <?php endforeach; ?>
            </div>    
            <p class="btnMore f_lapresse"><a href="<?php echo APP_URL; ?>find">FIND OUR BEER NEAR YOU</a></p>
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
        $('.btnIntro').click(function() {
            $('.hideTxt').slideToggle('200');
            $(this).toggleClass('active');
        });
        
        $('#tab1').show();
        $('#call1').parent('li').addClass('active');
		$('.listCountries li').click(function(){
			var elm = $(this).find('a');
			var id_elm = elm.attr('id');
			var id_show = id_elm.substr(id_elm.length - 1);
			$('.tabBox').fadeOut(300);
			$('#tab' + id_show).fadeIn(300);
			$('.listCountries li').removeClass('active');
			$(this).addClass('active');
		});	
    });    
</script>
<script src="<?php echo APP_URL; ?>common/js/slick.min.js"></script>
<script>
$(function() {    
$('.listFeature').slick({
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
        slidesToShow: 5,
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
});
});
</script>

<script src="<?php echo APP_URL; ?>common/js/index.js"></script>
    <script>
        $(function() {
            $('.lstBeer li').click(function() {
            $(this).find('.wrap').toggleClass('flipped');
            });
        });
    </script>
    
</body>
</html>	