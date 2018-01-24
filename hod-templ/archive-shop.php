<?php /* Template Name: Career */ ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
include(APP_PATH."libs/head.php");
$pt = 'shop';
?>
</head>

<body id="shop">
<!--===================================================-->

<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->

<div id="wrapper">
<h2 class="h2_site">featured items</h2>
        <?php
            $wp_query = new WP_Query();
            $param=array(
            'order' => 'DESC',
            'posts_per_page' => '1',
            'tax_query' => array(
            array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => 'shoppage'
            )
            )
            );
            $wp_query->query($param);
            if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
        ?> 
       <h3 class="sub_h2_site"><?php echo $post->post_content; ?></h3>
        <?php endwhile;endif; ?>   
    <div class="container">
        <ul class="listFeature clearfix">
            <?php
                $wp_query = new WP_Query();
                $param = array (
                'posts_per_page' => '-1',
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
                <?php if(($slug=='framed-poster')||($slug=='poster')) { ?> 
                    <p><?php the_field('t_shirt_type'); ?>Choose from 12 styles</p>
                <?php } ?>    
                </div>
                <p class="listFeature__price">VND <?php the_field('cf_price'); ?></p>
                <?php if ( is_user_logged_in() ) { ?>
                <a href="javascript:void(0)" class="listFeature__btn" data-id="<?php the_ID(); ?>">add to cart</a>
                <?php } ?>
            </li>
            <?php endwhile;endif; ?>
        </ul>
    </div>
    
    
<!--Footer-->
<?php include(APP_PATH."libs/footer.php"); ?>
<!--/Footer-->
<!--===================================================-->
</div>
<!--/wrapper-->
<div id="popupCart"></div>
<!--===================================================-->
<script type="text/javascript" src="<?php  echo APP_URL; ?>common/js/addcart.js"></script>
<script>
    $(function() { 
        $('.listFeature__btn').click(function() {
            $('#popupCart').fadeIn(200);
            $('.overlay_regis').fadeIn(200);
            var d_cart = $(this).attr('data-id');
            $('#popupCart').html('<div class="taC"><img src="<?php echo APP_URL; ?>common/img/other/load.gif" alt=""></div>');
            $.ajax({
                data: {},
                url: '/ajax/loadPro.php?addtocart=' + d_cart,
                type: 'GET',
                success: function(data){
                    $('#popupCart').html(data);
                }
            })
        });
});   
</script>
    
<?php include( APP_PATH .'ajax/function.php' ); ?>    
    
</body>
</html>	