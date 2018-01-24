<?php /* Template Name: Cart */ ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
/* if(!$_SESSION['cart'])  {
header('Location:http://heartofdarknessbrewery.com/');
} */
include(APP_PATH."libs/head.php"); 
?>
</head>

<body id="cart">
<!--===================================================-->

<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->
<div id="wrapper">
    <div class="clearfix innerCart">
    <div class="leftCart">
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
        <td>PRODUCTS</td>
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
        <td>
            <div class="clearfix">
                <p class="thumbPro_tab"><img src="<?php echo thumbCrop($img_label[0],70,70) ?>" alt=""></p>
                <div class="descPro_tab">
                    <p class="title"><?php the_title(); ?></p>
                    <p class="sku"><?php the_field('cf_sku'); ?></p>
                </div>
            </div>
            
        </td>
        <td><p class="pricePro"><input type="number" class="priceNumb" value="<?php echo intval(get_field('cf_price')); ?>"</p></td>
        <td>
            <div class="qtyPro">
            <div class="numbers-row clearfix">
                <div class='inc button cal' rel='+' ><i class="fa fa-caret-up" aria-hidden="true"></i></div>
                <div class='dec button cal' id='dec'><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                <input type="text"  class="input_cal qtyNumb" readonly  value="<?php echo $_COOKIE['cart_'.$post_t.'_'.$post->ID]; ?>"> 
            </div>
            </div>
        </td>
        <td><p class="subTotal"><input type="number" readonly class="totalNumb" alt=""></p></td>
        </tr>    
        <?php endwhile;endif; ?>
    </tbody>    
    </table>
    </div>
        
    <div class="rightCart"></div>    
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
<script type="text/javascript" src="<?php  echo APP_URL; ?>common/js/addcart.js"></script>
<script>
$(function() {
    $('.tblCart tbody tr td').each(function() {
        var dg = $('.priceNumb').val();
        var sl = $('.qtyNumb').val();   
        var calc = parseInt(dg) * parseInt(sl);
        $('.totalNumb').val(calc);
    });
}); 
</script>
</body>
</html>	