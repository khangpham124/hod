<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
include(APP_PATH . '/hod/wp-load.php');
$more = $_GET['more'];
?>
<ul class="clearfix lstPress">
            <?php
                $wp_query = new WP_Query();
                $param = array (
                'posts_per_page' => '4',
                'post_type' => 'press',
                'post_status' => 'publish',
                'order' => 'DESC',
                'offset' => $more,
                );
                $wp_query->query($param);
                if($wp_query->have_posts()): while($wp_query->have_posts()) :$wp_query->the_post();
                $img = get_post_thumbnail_id($post->ID);
                $thumb_url = wp_get_attachment_image_src($img,'full');
            ?>
            <li class="clearfix matchHeight">
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

<script>
$(function(){
	$('.besideBox').each(function(index){
		var lenghtList = $(this).children().find('li').length;
		if(lenghtList < 10){
			$('<div id="noMore"></div>').appendTo(this);
			$(".more").hide();
		}
	});
	
});
</script>