<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
include(APP_PATH . '/hod/wp-load.php');
?>
<h3 class="h3_popup f_lapresse">CART</h3>
<p class="h3_popup_sub"><?php  if($_COOKIE['totalcart']!=0) { echo $_COOKIE['totalcart']; } else { ?>0<?php } ?> item(s)</p>
<?php 
    $listCart = array();
    $arr_ids = array();
    foreach ($_COOKIE as $key=>$val)
    {
        if(strpos($key, 'cart_') !== false) $listCart[] = $key;
    }
    foreach($listCart as $id_pro)
    {
        $full_id = explode('_',$id_pro);
        $arr_ids[] = $full_id[2];
        $arr_qty[] = $full_id[3];
    }
    if (!empty($arr_ids)) {
    ?>
    <table class="tblCart">
    <thead>
        <td class="detailPro">PRODUCTS</td>
        <td>PRICE</td>
        <td>QTY</td>
        <td>SUBTOTAL</td>
    </thead>    
    <tbody>
        <?php    
        $wp_query = new WP_Query();
        $param=array(
        'post_type' => array( 'shop', 'food','bottles'),
        'posts_per_page' => '-1',
        'post__in'=> $arr_ids
        );
        $wp_query->query($param);
        if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
            $thumb = get_post_thumbnail_id($post->ID);
            $img_label = wp_get_attachment_image_src($thumb,'full');
            $img_cup = wp_get_attachment_image_src(get_field('image_beer'),'full');
            $post_t = get_post_type();
        ?>
        <tr>
        <td class="detailPro">
            <div class="clearfix">
                <p class="thumbPro_tab"><img src="<?php echo thumbCrop($img_label[0],70,70) ?>" alt=""></p>
                <div class="descPro_tab">
                    <p class="title"><?php the_title(); ?></p>
                    <p class="sku"><?php the_field('cf_sku'); ?></p>
                    <span class="removeItem" data-id="cart_<?php echo $post_t; ?>_<?php echo $post->ID; ?>">Remove</span>
                </div>
            </div>
            
        </td>
        <td><p class="pricePro"><input type="text" readonly class="priceNumb" value="<?php echo $cost = number_format(get_field('cf_price')); ?>"></p></td>
        <td class="qtyField">
            <div class="qtyPro">
            <div class="numbers-row clearfix">
                <div class='inc button cal' rel='+' ><i class="fa fa-caret-up" aria-hidden="true"></i></div>
                <div class='dec button cal' id='dec'><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                <input type="number" id="<?php echo 'cart_'.$post_t.'_'.$post->ID; ?>"  class="input_cal qtyNumb" readonly  value="<?php echo  $curr_wty = $_COOKIE['cart_'.$post_t.'_'.$post->ID]; ?>"> 
            </div>
            </div>
        </td>
        <td><p class="subTotal qtyPro"><input type="number" readonly class="totalNumb totalCost" value="<?php echo number_format($total_curr = $cost * $curr_wty); ?>" alt=""></p></td>
        </tr> 
        <?php endwhile;endif; ?>
    </tbody>    
    </table>

<p class="taR_popup">
    <a href="javascript:void(0)" class="contBtn">continue shopping</a>
    <a href="javascript:void(0)" class="updateBtn disable">Update Cart</a>
    <a href="<?php echo APP_URL; ?>checkout" class="checkOut" >Checkout</a>
</p>
<?php } else { ?>
    <p class="taC"><a href="javascript:void(0)" class="contBtn">continue shopping</a></p>
<?php } ?>
<span class="closeBtn"><i class="fa fa-times" aria-hidden="true"></i></span>