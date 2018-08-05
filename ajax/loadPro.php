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
        $price = get_field('cf_price');
?>
    <div class="flexBox">
        <div class="infoProduct">
            <?php if($image_shop[0]!='') { ?>
            <div class="thumbPop_food"><img src="<?php echo $image_shop[0]; ?>" id="thumbImg" alt="<?php the_title(); ?>"></div>
            <?php } ?>
            <div class="titlePop">
                <p class="title"><?php the_title(); ?></p>
                <?php if($post->post_content!='') { ?>
                <div class="descPop">
                    <?php echo $post->post_content; ?>
                </div>
                <?php } ?>
                <p class="price"><input type="text" class="priceNumb" readonly value="<?php echo number_format($price); ?>" name="currCost" id="currentCost" data-price="<?php echo $price; ?>"></p>        
            </div>
        </div>
        
        <div class="optionProduct">
            <?php
                if(($pt=='food')&&(($add_option!='')||($chose_option!=''))) {
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
                                <input name="addOpt" <?php if($f==1) { ?>checked<?php } ?> type="radio" value="<?php echo get_sub_field('options'); ?>" data-attribute="<?php echo get_sub_field('cost'); ?>" class="radioFood addOptRad" id="addOpt_<?php echo $f; ?>"><label for="addOpt_<?php echo $f; ?>" class="labelFood"><?php echo get_sub_field('options'); ?></label></p>
                                <input type="hidden" name="hide_addOpt" id="hide_addOpt" value="">
                        <?php endwhile;endif; ?>
                    </div>
                    <div class="right">
                        <?php
                            if(get_field('list_chose_options')):
                        ?>
                        <p class="optionsBox__title">Choose Your Style:</p>
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
                </div>    
                 <div class="noteArea">
                    <p class="optionsBox__title">Additional Information</p>
                    <textarea id="note_order" name="note_order"></textarea>
                </div>
                <table class="tblLoad">
                    <thead>
                        <td class="labelTbl"><h3 class="f_lapresse">QUANTITY</h3></td>
                    </thead>
                    <tbody>
                        <td>
                            <div class="numbers-row clearfix">
                                <div class='inc button cal' rel='+' ><i class="fa fa-plus" aria-hidden="true"></i></div>
                                <div class='dec button cal cant' id='dec' rel="-"><i class="fa fa-minus" aria-hidden="true"></i></div>
                                <input type="text" id="quantity" class="input_cal" readonly  value="1"> 
                                </div>
                        </td>
                    </tbody>
                </table>
            <?php } ?>
            
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

    <p class="taR_popup">
    <a href="javascript:void(0)" class="contBtn">continue shopping</a>
    <a href="javascript:void(0)" class="addToCard" data-id="<?php echo $pt ?>_<?php the_ID(); ?>" data-pricereal="<?php the_field('cf_price'); ?>" data-price="<?php the_field('cf_price'); ?>" data-title="<?php the_title(); ?>">add to cart</a>
    <a href="<?php echo APP_URL; ?>checkout" class="checkOut unshow" >Checkout</a>
    </p>
<?php endwhile;endif; ?>
</div>
<span class="closeBtn"><i class="fa fa-times" aria-hidden="true"></i></span>

<script>
$(".button").click(function(){
    var curr_quant = $('#quantity').attr('value');
    var button = $(this);
    var rel = button.attr("rel");
    if (rel == '+') {
        var newVal = parseFloat(curr_quant) + 1;
        $('#dec').removeClass('cant');
    } 
    if (rel == '-') {
        if (curr_quant > 0) {
            var newVal = parseFloat(curr_quant) - 1;
            if( newVal == 1) {
                $('#dec').addClass('cant');
            }
        }
        
    }
    button.parent().find("input").val(newVal);
    var dg = $(this).parent().parent().parent().prev().find('.priceNumb').val();
    var calc = parseInt(dg) * parseInt(newVal);
    var numb_calc = numeral(parseInt(calc)).format('0,0');
    $(this).parent().parent().parent().next().find('.qtyPro .totalNumb').val(numb_calc);
});

$(".addOptRad").click(function(){
    $('#hide_addOpt').val('');
    var addOpt = $(this).val();
    var costAdd = parseInt($(this).attr('data-attribute'));
    var currCost = parseInt($('.addToCard').attr('data-pricereal'));
    var newCost = currCost + costAdd;
    $('#hide_addOpt').val(addOpt);
    $('#currentCost').attr('value',numeral(parseInt(newCost)).format('0,0'));
    $('.addToCard').attr('data-price',newCost);
});

$(".listOptRad").click(function(){
    $('#hide_listOpt').val('');
    var addOpt = $(this).val();
    $('#hide_listOpt').val(addOpt);
});
</script>