<?php /* Template Name: Checkout */ ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
/* if(!$_SESSION['cart'])  {
header('Location:http://heartofdarknessbrewery.com/');
} */
include(APP_PATH."libs/head.php"); 
?>
</head>

<body id="checkout">
<!--===================================================-->

<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->
<div id="wrapper">
    <div class="greyBox innerCheck">
            <ul class="listCountries clearfix f_lapresse pc">
                <li class="active"><a href="javascript:void(0)" id="call1">Cart</a></li>
                <li><a href="javascript:void(0)" id="call2">Shipping</a></li>
                <li><a href="javascript:void(0)" id="call3">Payment and billing</a></li>
            </ul>
    </div>
    <div class="clearfix innerCart">    
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
    <div class="leftCart">    
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
        <td><p class="pricePro"><input type="text" readonly class="priceNumb" value="<?php echo $cost = get_field('cf_price'); ?>"></p></td>
        <td>
            <div class="qtyPro">
            <div class="numbers-row clearfix">
                <div class='inc button cal' rel='+' ><i class="fa fa-caret-up" aria-hidden="true"></i></div>
                <div class='dec button cal' id='dec'><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                <input type="number" id="<?php echo 'cart_'.$post_t.'_'.$post->ID; ?>"  class="input_cal qtyNumb" readonly  value="<?php echo  $curr_wty = $_COOKIE['cart_'.$post_t.'_'.$post->ID]; ?>"> 
            </div>
            </div>
        </td>
        <td><p class="subTotal qtyPro"><input type="number" readonly class="totalNumb totalCost" value="<?php echo $total_curr = $cost * $curr_wty; ?>" alt=""></p></td>
        </tr>
        <?php endwhile;endif; ?>
    </tbody>
    </table>
    <p class="taR_popup">
        <a href="javascript:void(0)" class="updateBtn disable">Update Cart</a>
    </p>
    </div>
        
    <div class="rightCart">
        <table class="tblTotal">
            <tr>
                <td>SUBTOTAL</td>
                <td>VAT</td>
                <td class="last">GRAND TOTAL</td>
            </tr>
            <tr>
                <td class="currentCost"><?php echo $_COOKIE['totalCost']; ?></td>
                <td>10</td>
                <td class="last grandCost"></td>
            </tr>
        </table>
        <a href="?step2" class="proceedBtn">proceed to checkout</a>
        <p>or</p>
        <a href="" class="contBtn contBtn_block">checkout with <img src="<?php echo APP_URL; ?>common/img/other/txtPay.png"></a>
        
    </div>    
    <?php } else { ?>
    Your cart is empty    
    <?php } ?>
    </div>
<!--Footer-->
<?php include(APP_PATH."libs/footer.php"); ?>
<!--/Footer-->
<!--===================================================-->
</div>
<!--/wrapper-->
<!--===================================================-->
<script>
var currentCost = parseInt($('.currentCost').text());
var grandCost = ((currentCost * 10) / 100) + currentCost;
$('.grandCost').text(grandCost);
</script>
    
</body>
</html>	