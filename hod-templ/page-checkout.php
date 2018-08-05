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
                <p class="thumbPro_tab"><img src="<?php echo thumbCrop($img_label[0],70,70) ?>" alt=""></p>
                <div class="descPro_tab">
                    <p class="title"><?php the_title(); ?></p>
                    <p class="sku"><?php the_field('cf_sku'); ?></p>
                    <span class="removeItem" data-id="<?php echo $post_t; ?>_<?php echo $post->ID; ?>">Remove</span>
                </div>
            </div>
            
        </td>
        <td><p class="pricePro"><input type="text" readonly class="priceNumb" value="<?php echo number_format($mydata->price); ?>"></p></td>
        <td>
            <div class="qtyPro">
            <div class="numbers-row clearfix">
                <div class='inc button cal' rel='+' ><i class="fa fa-caret-up" aria-hidden="true"></i></div>
                <div class='dec button cal' id='dec'><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                <input type="number" id="<?php echo $post_t.'_'.$post->ID; ?>"  class="input_cal qtyNumb" readonly  value="<?php echo $curr_wty; ?>"> 
            </div>
            </div>
        </td>
        <td><p class="subTotal qtyPro"><input type="number" readonly class="totalNumb totalCost" value="<?php echo $total_curr; ?>" alt=""></p></td>
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
                <td class="currentCost"><?php echo array_sum($arr_price); ?></td>
                <td>10%</td>
                <td class="last grandCost"></td>
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
                <input name="fullname" class="orderInput" value="<?php echo $_SESSION['fullname'] ?>" type="text" required>
            </div>
            <div class="inputForm">
                <label>Email <span>*</span></label>
                <input name="email" class="orderInput" value="<?php echo $_SESSION['email'] ?>" type="text" required>
            </div>
            <div class="inputForm">
                <label>Phone <span>*</span></label>
                <input name="phone" class="orderInput" type="number" value="<?php echo $_SESSION['phone'] ?>" required>
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
                        <td class="currentCost"><?php echo $_SESSION["totalCost"]; ?></td>
                        <td>10%</td>
                        <td class="last grandCost"></td>
                    </tr>
                </table>
            </div>
            <div class="inputForm distanceBox">
                <label>Distance</label>
                <input name="distance" type="text" id="add_field" class="disa" readonly>
                <label>Shipping Fee</label>
                <input name="shipcost" type="text" id="shipcost" class="disa" readonly>
            </div>

            <div id="ggmap"></div>
        </div>
        </div>    
        <p class="taC boxBtn">
            <a href="<?php echo APP_URL; ?>checkout" class="contBtn">BACK</a>
            <input type="submit" class="submitBtn" value="SUBTMIT ORDER">
        </p>
        <?php
            $totalCost =  (($_SESSION["totalCost"] * 10) /100) + $_SESSION["totalCost"] ;
        ?>    
        <input type="hidden" value="<?php echo $_COOKIE['order_hod']; ?>" name="order_code" >
        <input type="hidden" value="<?php echo $totalCost; ?>" name="grand_total" >    
        </form>    
    <?php } else if($_GET['step']==3) { ?>
        <?php 
            $_SESSION["distance"] = $_POST['distance'];
            $_SESSION["shipcost"] = $_POST['shipcost'];
            $grand_total_ship = $_POST['grand_total'] + $_COOKIE['shipcost'];
        ?>
        <form class="formShipping" action="<?php echo APP_URL; ?>confirm" method="POST">
            <div class="clearfix">
            <div class="leffShiping">
                <p class="titleForm">PAYMENT METHOD</p>
                
                <p class="inputRadio"><input type="radio" name="payment" value="COD"><label>COD</label></p>
                <p class="inputRadio"><input type="radio" name="payment" value="ATM"><label>ATM</label></p>
                <div class="btnPay">
                    <a href="javascript:void(0)" id="payAtm" class="methodPay" data-pay="atm">Pay with ATM</a>
                </div>
                <p class="inputRadio"><input type="radio" name="payment" value="Credit card"><label>Credit Card</label></p>
                <div class="btnPay">
                    <button id="payAtm" class="methodPay">Pay with Credit Card</button>
                </div>

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
                        <td class="current_Cost"><?php echo $_SESSION["totalCost_novat"]; ?></td>
                        <td>10%</td>
                        <td class="last grand_Cost"><?php echo $grand_total_ship; ?></td>
                    </tr>
                </table>
            </div>
            </div>
            </div>
            <input type="hidden" value="<?php echo $grand_total_ship; ?>" name="grand_total" >
            <?php 
                $_SESSION['order_code'] = $_POST['order_code'];
                $_SESSION['grand_total'] = $grand_total_ship; 
                $_SESSION['address'] = $_POST['address'];
                $_SESSION['city'] = $_POST['city'];
                $_SESSION['country'] = $_POST['country'];
                $_SESSION['fullname'] = $_POST['fullname'];
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['phone'] = $_POST['phone'];
                $_SESSION['shipcost'] = $_COOKIE["shipcost"]; 
            ?>
            <p class="taC boxBtn">
                <a href="<?php echo APP_URL; ?>checkout?step=2" class="contBtn">BACK</a>
                <input type="submit" class="submitBtn" value="COMPLETE">
            </p>
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