<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
include(APP_PATH."libs/head.php"); 
?>
</head>

<body id="press">
<!--===================================================-->

<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->

<div id="wrapper">
    <h2 class="h2_site">Press</h2>
    
    <div class="innerPress">
        <ul class="clearfix lstPress">
            <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                query_posts($query_string . '&orderby=post_date&order=desc&posts_per_page=-1&paged=' . $paged); 
                if(have_posts()):while(have_posts()) : the_post();
                $img = get_post_thumbnail_id($post->ID);
                $thumb_url = wp_get_attachment_image_src($img,'full');
            ?>
            <li class="clearfix _matchHeight">
                <div class="wrap clearfix matchHeight">
                    <p class="thumb"><a href="<?php the_field('cf_url'); ?>" target="_blank"><img src="<?php echo $thumb_url[0] ?>" alt=""></a></p>
                <div class="overflow">
                    <p class="title"><a href="<?php the_field('cf_url'); ?>" target="_blank"><?php the_title(); ?></a></p>
                    <div class="desc ">
                        <?php if(mb_strlen($post->post_content)>180) { $cont= mb_substr($post->post_content,0,180) ; echo strip_tags($cont. '...' );} else {echo strip_tags($post->post_content);} ?>
                    </div>
                    <a href="<?php the_field('cf_url'); ?>" target="_blank" class="link">Read full story <span>>></span></a>
                </div>
                </div>    
            </li>
            <?php endwhile;endif; ?>
        </ul>
        
        
        <p class="scrollmore">SCROLL FOR MORE</p>
        
        
    </div>
<!--Footer-->
<?php include(APP_PATH."libs/footer.php"); ?>
<!--/Footer-->
<!--===================================================-->
</div>
<!--/wrapper-->
<!--===================================================-->
  
<?php
	$count_posts = wp_count_posts('press');
	$total = $count_posts->publish;
?>    
<script>
$('.lstPress li').hide();
$(document).ready(function () {
	size_li = $(".lstPress li").size();
	x = 8;
	if(size_li>= 8) {
		$('.lstPress li:lt('+x+')').show(300);
		$(window).scroll(function() {
			var sT = $(window).scrollTop();
            var a = $('.scrollmore').offset().top;
            var toS = a - 200;
            if (sT > toS) {
                x = (x+8 <= size_li) ? x+8 : size_li;
                $('.lstPress li:lt('+x+')').show(300);
                $('.lstPress li:lt('+x+')').addClass('showItem');
			}
            size_li_show = $(".lstPress .showItem").size();
            if(size_li_show == <?php echo $total ?> ) {
                $('.scrollmore').hide(200);
            }
		});	
	}
});
</script>  
</body>
</html>	