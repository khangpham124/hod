<?php 
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
include(APP_PATH . '/hod/wp-load.php');
$addtocart = $_GET['addtocart'];	
?>
<div class="innerPopcart">
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
        $pt = get_post_type();
        $add_option = get_field('cf_add_options');
        $chose_option = get_field('list_chose_options');
?>
    <div class="clearfix">
        <?php if($pt!='food') { ?>
        <div class="thumbPop"><img src="<?php echo $image_shop[0]; ?>" id="thumbImg" alt="<?php the_title(); ?>"></div>
        <?php } ?>
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
            <?php
                if(($pt=='food')&&(($add_option!='')||($add_option!=''))) {
            ?>
                <h3 class="f_lapresse">OPTIONS</h3>
                 <div class="optionsBox flexBox">
                     <div class="left">
                        <?php
                            if(get_field('cf_add_options')):
                        ?>
                        <p class="optionsBox__title">Choose:</p>
                        <?php     
                            $f=0;   
                            while(has_sub_field('cf_add_options')):
                            $f++;
                        ?>
                            <p class="itemChose">
                                <input name="addOpt" type="radio" value="<?php echo get_sub_field('options'); ?>" class="radioFood addOptRad" id="addOpt_<?php echo $f; ?>"><label for="addOpt_<?php echo $f; ?>" class="labelFood"><?php echo get_sub_field('options'); ?></label></p>
                                <input type="hidden" name="hide_addOpt" id="hide_addOpt" value="">
                        <?php endwhile;endif; ?>
                        <?php
                            if(get_field('list_chose_options')):
                        ?>
                        <p class="optionsBox__title">Choose up to sauces:</p>
                        <table>
                            <?php
                                $f=0;            
                                while(has_sub_field('list_chose_options')):
                                $f++;
                            ?>
                                <tr>
                                    <td><input type="radio" name="listOpt" value="<?php echo get_sub_field('options'); ?>" class="radioFood listOptRad" id="listOpt_<?php echo $f; ?>">
                                    <input type="hidden" name="hide_listOpt" id="hide_listOpt" value="">
                                    </td>
                                    <td><label class="labelFood" for="listOpt_<?php echo $f; ?>"><?php echo get_sub_field('options'); ?></label></td>
                                </tr>
                            <?php endwhile; ?>
                        </table>
                        <?php endif; ?>
                     </div>
                     <div class="right">
                        <p class="optionsBox__title">Additional Information</p>
                         <textarea id="note_order" name="note_order"></textarea>
                     </div>
                 </div>       
            <?php } ?>
            <div class="flex">
                <table>
                    <thead>
                        <?php if($slug=='t-shirt') { ?>
                        <td>SIZE</td>
                        <?php } ?>
                        <td>QTY</td>
                        <td>PRICE</td>
                    </thead>
                    <tbody>
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
            <?php if($slug=='t-shirt') { ?>
                <div class="select-style mt30">
                <select id="sizetshirt">
                    <?php $size = get_field('cf_size');
                    foreach($size as $s) {
                    ?>
                    <option value="<?php echo $s ?>"><?php echo $s ?></option>
                    <?php } ?>
                </select>
                </div>    
             <?php } ?>
            <?php if($slug=='framed-poster') { ?>
            <?php $type_frame = get_field('label_poster');
                foreach($type_frame as $labelID) {
                    $thumb = get_post_thumbnail_id($labelID);
                    $imgEmbed = wp_get_attachment_image_src($thumb,'fll');
            ?>
                <p style="display:none" id="p_<?php echo $labelID ?>"><?php echo thumbCrop($imgEmbed[0],0,320); ?></p>
            <?php } ?>
                <div class="select-style mt30">
                <select id="framePoster">
                    <?php foreach($type_frame as $label) { ?>
                        <option value="<?php echo $label ?>"><?php echo get_the_title($label); ?></option>
                    <?php } ?>
                </select>
                </div>    
            <?php } ?>
        </div>
    </div>
    <!--<p class="taR_popup">
    <a href="javascript:void(0)" class="contBtn">continue shopping</a>
    <?php if($_COOKIE['cart_'.$pt.'_'.$post->ID]) { ?>
    <a href="javascript:void(0)" class="addToCard disable" data-id="<?php echo $pt ?>_<?php the_ID(); ?>" data-price="<?php the_field('cf_price'); ?>"><i class="fa fa-shopping-cart"></i>Added</a>
    <?php } else { ?>
    <a href="javascript:void(0)" class="addToCard" data-id="<?php echo $pt ?>_<?php the_ID(); ?>" data-price="<?php the_field('cf_price'); ?>">add to cart</a>    
    <?php } ?>    
    </p>!-->
    <p class="taR_popup">
    <a href="javascript:void(0)" class="contBtn">continue shopping</a>
    <a href="javascript:void(0)" class="addToCard" data-id="<?php echo $pt ?>_<?php the_ID(); ?>" data-price="<?php the_field('cf_price'); ?>" data-title="<?php the_title(); ?>">add to cart</a>    
    </p>
<?php endwhile;endif; ?>
</div>
<span class="closeBtn"><i class="fa fa-times" aria-hidden="true"></i></span>

<script>
$(".button").click(function(){
    var $button = $(this);
    var oldValue = $button.parent().find("input").val();
    if ($button.attr("rel") == '+') {
        var newVal = parseFloat(oldValue) + 1;
    } else {
        if (oldValue > 0) {
            var newVal = parseFloat(oldValue) - 1;
        } else {
            newVal = 0;
        }
    }
    $('.updateBtn').removeClass('disable');
    $button.parent().find("input").val(newVal);
    var dg = $(this).parent().parent().parent().prev().find('.priceNumb').val();
    var calc = parseInt(dg) * parseInt(newVal);
    var numb_calc = parseInt(calc);
    $(this).parent().parent().parent().next().find('.qtyPro .totalNumb').val(numb_calc);
});

$(".addOptRad").click(function(){
    $('#hide_addOpt').val('');
    var addOpt = $(this).val();
    $('#hide_addOpt').val(addOpt);
});

$(".listOptRad").click(function(){
    $('#hide_listOpt').val('');
    var addOpt = $(this).val();
    $('#hide_listOpt').val(addOpt);
});



</script>