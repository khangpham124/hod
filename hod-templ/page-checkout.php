<?php /* Template Name: Checkout */ ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
if(!$_COOKIE['order_cookies']) {    
header('Location:http://heartofdarknessbrewery.com/');
die();
}
include(APP_PATH."libs/head.php"); 
?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBV7fW4OF5FqFFlLakpTOvf1Kuq_qHXcqY&libraries=places"></script>    
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
                <li <?php if((!$_GET['step'])||($_GET['step']==1)) { ?>class="active"<?php } ?>><a href="javascript:void(0)" id="call1">Cart</a></li>
                <li <?php if($_GET['step']==2) { ?>class="active"<?php } ?>><a href="javascript:void(0)" id="call2">Shipping</a></li>
                <li <?php if($_GET['step']==3) { ?>class="active"<?php } ?>><a href="javascript:void(0)" id="call3">Payment and billing</a></li>
            </ul>
    </div>
    
    <?php if((!$_GET['step'])||($_GET['step']==1)) { ?>
    <div class="clearfix innerCart">
    <?php
    $f_isset = $_SERVER['DOCUMENT_ROOT'].'/ajax/tmp/'.$_COOKIE['order_hod'].'.json';
    $curr_cart  = json_decode(file_get_contents($f_isset));
    if (!empty($curr_cart)) {
    ?>
    <div class="leftCart">    
    <table class="tblCart">
    <thead>
        <td class="detailPro">PRODUCTS</td>
        <td>PRICE</td>
        <td>QTY</td>
        <td class="subTotal_col">SUBTOTAL</td>
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
        
            $wp_query = new WP_Query();
            $param=array(
            'post_type' => array( 'shop', 'food','bottles'),
            'posts_per_page' => '-1',
            'post__in'=> $arr_ids
            );
            $wp_query->query($param);
            if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                $i++;
                $thumb = get_post_thumbnail_id($post->ID);
                $img_label = wp_get_attachment_image_src($thumb,'full');
                $img_cup = wp_get_attachment_image_src(get_field('image_beer'),'full');
                $post_t = get_post_type();
                $cost = get_field('cf_price');
                $curr_wty = $mydata->quantity;
                $total_curr = $mydata->price * $curr_wty;
        ?>
        <tr>
        <td class="detailPro">
            <div class="clearfix">
                <?php if($img_label[0]!='') { ?>
                <p class="thumbPro_tab"><img src="<?php echo thumbCrop($img_label[0],70,70) ?>" alt=""></p>
                <?php } ?>
                <div class="descPro_tab">
                    <p class="title"><?php the_title(); ?></p>
                    <p class="sku"><?php the_field('cf_sku'); ?></p>
                    <span class="removeItem" data-id="<?php echo $post_t; ?>_<?php echo $post->ID; ?>"><i class="fa fa-trash" aria-hidden="true"></i></span>
                </div>
            </div>
            
        </td>
        <td class="pricePro"><input type="text" style="display:none;" readonly class="priceNumb" value="<?php echo number_format($mydata->price); ?>">
        <span><?php echo number_format($mydata->price); ?></span> VND
        </td>
        <td>
            <div class="qtyPro">
            <div class="numbers-row clearfix">
                <div class='inc button cal' rel='+' ><i class="fa fa-caret-up" aria-hidden="true"></i></div>
                <div class='dec button cal' id='dec'><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                <input type="text" id="<?php echo $post_t.'_'.$post->ID; ?>"  class="input_cal qtyNumb" readonly  value="<?php echo $curr_wty; ?>"> 
            </div>
            </div>
        </td>
        <td><p class="subTotal qtyPro"><input style="display:none;"  type="number" readonly class="totalNumb totalCost" value="<?php echo $total_curr; ?>" alt="">
            <span><?php echo number_format($total_curr); ?></span> VND
        </p></td>
        </tr>
        <?php
            $cf_sku = get_field('cf_sku');
            $tt_order[$i] = array('sku'=>$cf_sku,'qty'=> $curr_wty);
        ?>
        <?php endwhile;endif;?>
        <?php } ?>
    </tbody>
    </table>
    </div>
       
    <div class="rightCart">
        <table class="tblTotal">
            <tr>
                <td>SUBTOTAL</td>
                <td>VAT</td>
                <td class="last">GRAND TOTAL</td>
            </tr>
            <tr>
                
                <?php
                $arr_price = array();
                foreach($curr_cart as $mydata)
                    {
                        $count_price = ($mydata->quantity * $mydata->price);
                        $arr_price[] = $count_price;
                    }
                ?>
                <td><span class="currentCost" style="display:none;"><?php echo array_sum($arr_price); ?></span><?php echo number_format(array_sum($arr_price)); ?> <em>VND</em></td>
                <td>10%</td>
                <td class="last"><span class="grandCost"></span> <em>VND</em></td>
            </tr>
        </table>
        <a href="<?php echo APP_URL; ?>checkout?step=2" class="proceedBtn">proceed to checkout</a>
        <?php 
        $_SESSION["totalCost_novat"] = array_sum($arr_price);
        $_SESSION["totalCost"] = array_sum($arr_price); ?>
    </div>    
    <?php } else { ?>
    <p class="txtNotice">Your cart is empty</p>
    <?php } ?>
    </div>    
    <?php } else if($_GET['step']==2) { ?>
        <?php setcookie('err_pay','', time() + 86400, "/"); ?>
        <form class="formShipping" action="<?php echo APP_URL; ?>checkout/?step=3" method="POST">
        <div class="clearfix">
            <div class="leffShiping">
            <p class="titleForm">Shipping Information</p>
            <div class="inputForm">
                <label>Address <span>*</span></label>
                <input name="address" type="text" value="<?php if($_SESSION['address']) { echo $_SESSION['address']; } ?>" id="autocomplete" placeholder="Enter your address" onFocus="geolocate()" required>
            </div>

            <div class="inputForm">
                <label>Full Name <span>*</span></label>
                <input name="fullname" class="orderInput" placeholder="Your fullname" value="<?php echo $_SESSION['fullname'] ?>" type="text" required>
            </div>
            <div class="inputForm">
                <label>Email <span>*</span></label>
                <input name="email" class="orderInput" placeholder="Your Email" value="<?php echo $_SESSION['email'] ?>" type="text" required>
            </div>
            <div class="inputForm">
                <label>Phone <span>*</span></label>
                <input name="phone" class="orderInput" type="tel" placeholder="Your Phone" value="<?php echo $_SESSION['phone'] ?>" required>
            </div>
            
            <!-- <div class="inputForm">
            <?php //include(APP_PATH."libs/list-country.php"); ?>
            </div> -->
        </div>
        
        <div class="shipCost">
            <div class="boxSummary">
                <p class="titleForm titleForm--red">ORDER SUMMARY</p>
                <table class="tblTotal">
                    <tr>
                        <td>SUBTOTAL</td>
                        <td>VAT</td>
                        <td class="last">GRAND TOTAL</td>
                    </tr>
                    <tr>
                        <td><span class="currentCost" style="display:none;"><?php echo $_SESSION["totalCost"]; ?></span><?php echo number_format($_SESSION["totalCost"]); ?><em>VND</em></td>
                        <td>10%</td>
                        <td class="last"><span class="grandCost"></span> <em>VND</em></td>
                    </tr>

                    <tr>
                        <td><i class="fa fa-truck" aria-hidden="true"></i></td>
                        <td></td>
                        <td class="last"><span class="shipFee">0</span></td>
                    </tr>

                    <tr>
                        <td>TOTAL</td>
                        <td></td>
                        <td class="last"><span class="grandCost_ship grandCost"></span> <em>VND</em></td>
                    </tr>
                </table>
            </div>
            <div class="inputForm distanceBox">
                <label>Distance</label>
                <input name="distance" type="text" id="add_field" class="disa" readonly>
                <label>Shipping Fee</label>
                <input type="text" id="shipcost_fake" class="disa" readonly>
                <input name="shipcost" style="display:none" type="text" id="shipcost" class="disa" readonly>
            </div>
            <div id="ggmap"></div>
        </div>
        </div>    
        <p class="taC boxBtn">
            <a href="<?php echo APP_URL; ?>checkout" class="contBtn">BACK</a>
            <input type="submit" class="submitBtn cant" value="SUBTMIT ORDER">
        </p>
        <?php
            $totalCost =  (($_SESSION["totalCost"] * 10) /100) + $_SESSION["totalCost"] ;
        ?>    
        <input type="hidden" value="<?php echo $_COOKIE['order_hod']; ?>" name="order_code" >
        <input type="hidden" value="<?php echo $totalCost; ?>" name="grand_total" >    
        </form>
    <?php } else if($_GET['step']==3) { ?>
        <?php
            if($_POST['distance']!='') {
            $_SESSION["distance"] = $_POST['distance'];
            }
            if($_POST['shipcost']!='') {
            $_SESSION["shipcost"] = $_POST['shipcost'];
            }

            if($_POST['grand_total']!='') {
            $grand_total_ship = $_POST['grand_total'] + $_COOKIE['shipcost'];
            $_SESSION['grand_total'] = $grand_total_ship;
            }

            if($_POST['order_code']!='') {
            $_SESSION['order_code'] = $_POST['order_code'];
            }
            if($_POST['address']!='') {
            $_SESSION['address'] = $_POST['address'];
            }
            if($_POST['city']!='') {
            $_SESSION['city'] = $_POST['city'];
            }
            if($_POST['country']!='') {
            $_SESSION['country'] = $_POST['country'];
            }
            if($_POST['fullname']!='') {
            $_SESSION['fullname'] = $_POST['fullname'];
            }
            if($_POST['email']!='') {
            $_SESSION['email'] = $_POST['email'];
            }
            if($_POST['phone']!='') {
            $_SESSION['phone'] = $_POST['phone'];
            } 
        ?>
        <form class="formShipping" action="<?php echo APP_URL; ?>confirm" method="POST">
            <div class="clearfix">
            <div class="leffShiping">
                <?php if($_COOKIE['err_pay']!='') { ?>
                    <p class="errPay"><?php echo $_SESSION['err_pay']; ?></p>
                <?php } ?>
                <p class="titleForm">PAYMENT METHOD</p>
                <p class="inputRadio"><input type="radio" name="payment" value="cod"><label>COD</label></p>
                <p class="inputRadio"><input type="radio" name="payment" value="atm"><label>ATM</label></p>
                <p class="inputRadio"><input type="radio" name="payment" value="creditcard"><label>Credit Card</label></p>
                <p class="titleForm mt20">NOTE</p>
                <textarea id="note_order" name="comt_order"></textarea>
            </div>
            <div class="shipCost">
            <div class="boxSummary">
                <p class="titleForm titleForm--red">ORDER SUMMARY</p>
                <table class="tblTotal">
                    <tr>
                        <td>SUBTOTAL</td>
                        <td>VAT</td>
                        <td class="last">GRAND TOTAL</td>
                    </tr>
                    <tr>
                        <td><span class="currentCost" style="display:none;"><?php echo $_SESSION["totalCost"]; ?></span><?php echo number_format($_SESSION["totalCost"]); ?><em>VND</em></td>
                        <td>10%</td>
                        <td class="last"><span class="grandCost"></span> <em>VND</em></td>
                    </tr>

                    <tr>
                        <td><i class="fa fa-truck" aria-hidden="true"></i></td>
                        <td></td>
                        <td class="last"><span class="shipFee"><?php echo number_format($_COOKIE["shipcost"]); ?> VND</span></td>
                    </tr>

                    <tr>
                        <td>TOTAL</td>
                        <td></td>
                        <td class="last"><span class=""><?php echo number_format($_SESSION['grand_total']); ?></span> <em>VND</em></td>
                    </tr>
                </table>
            </div>
            </div>
            </div>
            <input type="hidden" value="<?php echo $grand_total_ship; ?>" name="grand_total" >
            <p class="taC boxBtn">
                <a href="<?php echo APP_URL; ?>checkout?step=2" class="contBtn">BACK</a>
                <a href="javascript:void(0)" class="methodPay">COMPLETE</a>
            </p>
            <?php $_SESSION['shipcost'] = $_COOKIE["shipcost"]; ?>
        </form>
    <?php } ?>
    
<!--Footer-->
<?php include(APP_PATH."libs/footer.php"); ?>
<!--/Footer-->
<!--===================================================-->
</div>
<!--/wrapper-->
<!--===================================================-->
<script type="text/javascript" src="<?php echo APP_URL; ?>common/js/direction.js"></script>

</body>
</html>	