<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
include(APP_PATH . '/hod/wp-load.php');
?>

<?php 
$f_isset = './tmp/'.$_COOKIE['order_hod'].'.json';
$curr_cart  = json_decode(file_get_contents($f_isset));
?>
<script>
    var start = readCookie('incart');
    if (start) {
        $('#itemCarts').html(start);
    } else {
        $('#itemCarts').html(0);
    }
</script>
<h3 class="h3_popup f_lapresse">CART</h3>
<p class="h3_popup_sub"><span id="itemCarts"></span> item(s)</p>

    <table class="tblCart">
    <thead>
        <td class="detailPro">PRODUCTS</td>
        <td>PRICE</td>
        <td>QTY</td>
        <td>SUBTOTAL</td>
    </thead>    
    <tbody>
        <?php
        foreach($curr_cart as $mydata)
        {
            $full_id = explode('_',$mydata->id);
            $arr_ids = array();
            if(!in_array($full_id[1],$arr_ids)) {
                $arr_ids[] = $full_id[1];
            }
            $wp_query = new WP_Query();
            $param=array(
            'post_type' => array( 'shop', 'food'),
            'posts_per_page' => '-1',
            'post__in'=> $arr_ids
            );
            $wp_query->query($param);
            if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
            $thumb = get_post_thumbnail_id($post->ID);
            $img_label = wp_get_attachment_image_src($thumb,'full');
            $img_cup = wp_get_attachment_image_src(get_field('image_beer'),'full');
            $post_t = get_post_type();
            $cost = get_field('cf_price');
            $curr_wty = $mydata->quantity;
            $total_curr = $cost * $curr_wty;
        ?>
        <tr>
        <td class="detailPro">
            <div class="clearfix">
                <p class="thumbPro_tab"><img src="<?php echo thumbCrop($img_label[0],70,70) ?>" alt=""></p>
                <div class="descPro_tab">
                    <p class="title"><?php the_title(); ?></p>
                    <p class="sku"><?php the_field('cf_sku'); ?></p>
                    <span class="removeItem" data-id="<?php echo $post_t; ?>_<?php echo $post->ID; ?>">Remove</span>
                </div>
            </div>
            
        </td>
        <td><p class="pricePro"><input type="text" readonly class="priceNumb" value="<?php echo number_format($cost); ?>"></p></td>
        <td class="qtyField">
            <div class="qtyPro">
            <div class="numbers-row clearfix">
                <div class='inc button cal' rel='+' ><i class="fa fa-caret-up" aria-hidden="true"></i></div>
                <div class='dec button cal' id='dec'><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                <input type="number" id="<?php echo $post_t.'_'.$post->ID; ?>"  class="input_cal qtyNumb" readonly  value="<?php echo $curr_wty; ?>"> 
            </div>
            </div>
        </td>
        <td><p class="subTotal qtyPro"><input type="number" readonly class="totalNumb totalCost" value="<?php echo strval($total_curr); ?>" alt=""></p></td>
        </tr>
        <?php endwhile;endif; ?>
        <?php } ?>
    </tbody>    
    </table>

<p class="taR_popup">
    <a href="javascript:void(0)" class="contBtn">continue shopping</a>
    <a href="javascript:void(0)" class="updateBtn disable">Update Cart</a>
    <a href="<?php echo APP_URL; ?>checkout" class="checkOut" >Checkout</a>
</p>

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