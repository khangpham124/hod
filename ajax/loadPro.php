<?php 
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
include(APP_PATH . '/hod/wp-load.php');
$addtocart = $_GET['addtocart'];	
?>
<div class="innerPopcart">
    <h3 class="f_lapresse">OPTIONS</h3>
<?php
        $wp_query = new WP_Query();
        $param = array (
                'posts_per_page' => '1',
                'post_type' => array( 'shop', 'food','bottles'),
                'post_status' => 'publish',
                'order' => 'DESC',
                'p' => $addtocart,
        );
        $wp_query->query($param);
        if($wp_query->have_posts()): while($wp_query->have_posts()) :$wp_query->the_post();
        $thumb_shop = get_post_thumbnail_id($post->ID);
		$image_shop = wp_get_attachment_image_src($thumb_shop,'full');
		$terms = get_the_terms($post->ID, 'shopcat');
		foreach($terms as $term) { 
		$slug = $term->slug;
		}
        $pt =get_post_type();
?>
    <div class="clearfix">
        <p class="thumbPop"><img src="<?php echo $image_shop[0]; ?>" alt="<?php the_title(); ?>"></p>
        <div class="overflow">
            <p class="titlePop"><?php the_title(); ?></p>
            <?php if($slug=='t-shirt') { ?>    
                <p><?php the_field('t_shirt_type'); ?></p>
            <?php } ?>
            <?php if(($slug=='framed-poster')||($slug=='poster')) { ?> 
            <?php } ?> 
            <div class="descPop">
            <?php echo $post->post_content; ?>
            </div>
            <div class="flex">
                <table>
                    <thead>
                        <?php if($slug=='t-shirt') { ?>
                        <td>SIZE</td>
                        <?php } ?>
                        <td>QTY</td>
                        <td>PRIZE</td>
                    </thead>
                    <tbody>
                        <?php if($slug=='t-shirt') { ?>
                        <td>
                            <select id="sizetshirt">
                                <?php $size = get_field('cf_size');
                                foreach($size as $s) {
                                ?>
                                <option value="<?php echo $s ?>"><?php echo $s ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <?php } ?>
                        <td>
                            <div class="numbers-row clearfix">
                                <div class='inc button cal' rel='+' ><i class="fa fa-caret-up" aria-hidden="true"></i></div>
                                <div class='dec button cal' id='dec'><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                                <input type="text" id="quantity" class="input_cal" readonly  value="1"> 
                             </div>
                        </td>
                        <td><?php the_field('cf_price'); ?></td>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
    <p class="taR">
    <a href="javascript:void(0)" class="contBtn">continue shopping</a>
    <?php if($_COOKIE['cart_'.$pt.'_'.$post->ID]) { ?>
    <a href="javascript:void(0)" class="addToCard disable" data-id="<?php echo $pt ?>_<?php the_ID(); ?>"><i class="fa fa-shopping-cart"></i>Added</a>
    <?php } else { ?>
    <a href="javascript:void(0)" class="addToCard" data-id="<?php echo $pt ?>_<?php the_ID(); ?>">add to cart</a>    
    <?php } ?>    
    </p>    
<?php endwhile;endif; ?>
</div>
<span class="closeBtn"><i class="fa fa-times" aria-hidden="true"></i></span>