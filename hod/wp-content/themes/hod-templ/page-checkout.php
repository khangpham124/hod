<?php /* Template Name: Checkout */ ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
if(!$_COOKIE['totalcart']) {    
header('Location:http://heartofdarknessbrewery.com/');
die();
}
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
                <li <?php if((!$_GET['step'])||($_GET['step']==1)) { ?>class="active"<?php } ?>><a href="javascript:void(0)" id="call1">Cart</a></li>
                <li <?php if($_GET['step']==2) { ?>class="active"<?php } ?>><a href="javascript:void(0)" id="call2">Shipping</a></li>
                <li <?php if($_GET['step']==3) { ?>class="active"<?php } ?>><a href="javascript:void(0)" id="call3">Payment and billing</a></li>
            </ul>
    </div>
    
    <?php if((!$_GET['step'])||($_GET['step']==1)) { ?>
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
        $tt_order = array();
        $i=-1;
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
        <?php
            $cf_sku = get_field('cf_sku');
            $tt_order[$i] = array('sku'=>$cf_sku,'qty'=> $curr_wty);
        ?>
        <?php endwhile;endif;
        $_SESSION['order'] = $tt_order;
        ?>
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
                <td>10%</td>
                <td class="last grandCost"></td>
            </tr>
        </table>
        <a href="<?php echo APP_URL; ?>checkout?step=2" class="proceedBtn">proceed to checkout</a>
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
                <label>Full Name *</label>
                <input name="fullname" value="<?php echo $_SESSION['customer']['fullname'] ?>" type="text" required>
            </div>
            <div class="inputForm">
                <label>Phone *</label>
                <input name="phone" type="number" value="<?php echo $_SESSION['customer']['phone'] ?>" required>
            </div>
            <div class="inputForm">
                <label>Address *</label>
                <input name="address" type="text" <?php echo $_SESSION['customer']['address']; ?> required>
            </div>
            <div class="inputForm">
                <label>City *</label>
                <input name="city" type="text" <?php echo $_SESSION['customer']['city'] ?> required>
            </div>
            <div class="inputForm">
                <label>Country *</label>
                <div class="select-style">
                <select name="country" id="country" required>
                <option value="">Select a country</option>
                <option value="Afghanistan">Afghanistan</option>
                <option value="Albania">Albania</option>
                <option value="Algeria">Algeria</option>
                <option value="American Samoa">American Samoa</option>
                <option value="Andorra">Andorra</option>
                <option value="Angola">Angola</option>
                <option value="Anguilla">Anguilla</option>
                <option value="Antartica">Antarctica</option>
                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                <option value="Argentina">Argentina</option>
                <option value="Armenia">Armenia</option>
                <option value="Aruba">Aruba</option>
                <option value="Australia">Australia</option>
                <option value="Austria">Austria</option>
                <option value="Azerbaijan">Azerbaijan</option>
                <option value="Bahamas">Bahamas</option>
                <option value="Bahrain">Bahrain</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="Barbados">Barbados</option>
                <option value="Belarus">Belarus</option>
                <option value="Belgium">Belgium</option>
                <option value="Belize">Belize</option>
                <option value="Benin">Benin</option>
                <option value="Bermuda">Bermuda</option>
                <option value="Bhutan">Bhutan</option>
                <option value="Bolivia">Bolivia</option>
                <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
                <option value="Botswana">Botswana</option>
                <option value="Bouvet Island">Bouvet Island</option>
                <option value="Brazil">Brazil</option>
                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                <option value="Brunei Darussalam">Brunei Darussalam</option>
                <option value="Bulgaria">Bulgaria</option>
                <option value="Burkina Faso">Burkina Faso</option>
                <option value="Burundi">Burundi</option>
                <option value="Cambodia">Cambodia</option>
                <option value="Cameroon">Cameroon</option>
                <option value="Canada">Canada</option>
                <option value="Cape Verde">Cape Verde</option>
                <option value="Cayman Islands">Cayman Islands</option>
                <option value="Central African Republic">Central African Republic</option>
                <option value="Chad">Chad</option>
                <option value="Chile">Chile</option>
                <option value="China">China</option>
                <option value="Christmas Island">Christmas Island</option>
                <option value="Cocos Islands">Cocos (Keeling) Islands</option>
                <option value="Colombia">Colombia</option>
                <option value="Comoros">Comoros</option>
                <option value="Congo">Congo</option>
                <option value="Congo">Congo, the Democratic Republic of the</option>
                <option value="Cook Islands">Cook Islands</option>
                <option value="Costa Rica">Costa Rica</option>
                <option value="Cota D'Ivoire">Cote d'Ivoire</option>
                <option value="Croatia">Croatia (Hrvatska)</option>
                <option value="Cuba">Cuba</option>
                <option value="Cyprus">Cyprus</option>
                <option value="Czech Republic">Czech Republic</option>
                <option value="Denmark">Denmark</option>
                <option value="Djibouti">Djibouti</option>
                <option value="Dominica">Dominica</option>
                <option value="Dominican Republic">Dominican Republic</option>
                <option value="East Timor">East Timor</option>
                <option value="Ecuador">Ecuador</option>
                <option value="Egypt">Egypt</option>
                <option value="El Salvador">El Salvador</option>
                <option value="Equatorial Guinea">Equatorial Guinea</option>
                <option value="Eritrea">Eritrea</option>
                <option value="Estonia">Estonia</option>
                <option value="Ethiopia">Ethiopia</option>
                <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
                <option value="Faroe Islands">Faroe Islands</option>
                <option value="Fiji">Fiji</option>
                <option value="Finland">Finland</option>
                <option value="France">France</option>
                <option value="France Metropolitan">France, Metropolitan</option>
                <option value="French Guiana">French Guiana</option>
                <option value="French Polynesia">French Polynesia</option>
                <option value="French Southern Territories">French Southern Territories</option>
                <option value="Gabon">Gabon</option>
                <option value="Gambia">Gambia</option>
                <option value="Georgia">Georgia</option>
                <option value="Germany">Germany</option>
                <option value="Ghana">Ghana</option>
                <option value="Gibraltar">Gibraltar</option>
                <option value="Greece">Greece</option>
                <option value="Greenland">Greenland</option>
                <option value="Grenada">Grenada</option>
                <option value="Guadeloupe">Guadeloupe</option>
                <option value="Guam">Guam</option>
                <option value="Guatemala">Guatemala</option>
                <option value="Guinea">Guinea</option>
                <option value="Guinea-Bissau">Guinea-Bissau</option>
                <option value="Guyana">Guyana</option>
                <option value="Haiti">Haiti</option>
                <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
                <option value="Holy See">Holy See (Vatican City State)</option>
                <option value="Honduras">Honduras</option>
                <option value="Hong Kong">Hong Kong</option>
                <option value="Hungary">Hungary</option>
                <option value="Iceland">Iceland</option>
                <option value="India">India</option>
                <option value="Indonesia">Indonesia</option>
                <option value="Iran">Iran (Islamic Republic of)</option>
                <option value="Iraq">Iraq</option>
                <option value="Ireland">Ireland</option>
                <option value="Israel">Israel</option>
                <option value="Italy">Italy</option>
                <option value="Jamaica">Jamaica</option>
                <option value="Japan">Japan</option>
                <option value="Jordan">Jordan</option>
                <option value="Kazakhstan">Kazakhstan</option>
                <option value="Kenya">Kenya</option>
                <option value="Kiribati">Kiribati</option>
                <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
                <option value="Korea">Korea, Republic of</option>
                <option value="Kuwait">Kuwait</option>
                <option value="Kyrgyzstan">Kyrgyzstan</option>
                <option value="Lao">Lao People's Democratic Republic</option>
                <option value="Latvia">Latvia</option>
                <option value="Lebanon">Lebanon</option>
                <option value="Lesotho">Lesotho</option>
                <option value="Liberia">Liberia</option>
                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                <option value="Liechtenstein">Liechtenstein</option>
                <option value="Lithuania">Lithuania</option>
                <option value="Luxembourg">Luxembourg</option>
                <option value="Macau">Macau</option>
                <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
                <option value="Madagascar">Madagascar</option>
                <option value="Malawi">Malawi</option>
                <option value="Malaysia">Malaysia</option>
                <option value="Maldives">Maldives</option>
                <option value="Mali">Mali</option>
                <option value="Malta">Malta</option>
                <option value="Marshall Islands">Marshall Islands</option>
                <option value="Martinique">Martinique</option>
                <option value="Mauritania">Mauritania</option>
                <option value="Mauritius">Mauritius</option>
                <option value="Mayotte">Mayotte</option>
                <option value="Mexico">Mexico</option>
                <option value="Micronesia">Micronesia, Federated States of</option>
                <option value="Moldova">Moldova, Republic of</option>
                <option value="Monaco">Monaco</option>
                <option value="Mongolia">Mongolia</option>
                <option value="Montserrat">Montserrat</option>
                <option value="Morocco">Morocco</option>
                <option value="Mozambique">Mozambique</option>
                <option value="Myanmar">Myanmar</option>
                <option value="Namibia">Namibia</option>
                <option value="Nauru">Nauru</option>
                <option value="Nepal">Nepal</option>
                <option value="Netherlands">Netherlands</option>
                <option value="Netherlands Antilles">Netherlands Antilles</option>
                <option value="New Caledonia">New Caledonia</option>
                <option value="New Zealand">New Zealand</option>
                <option value="Nicaragua">Nicaragua</option>
                <option value="Niger">Niger</option>
                <option value="Nigeria">Nigeria</option>
                <option value="Niue">Niue</option>
                <option value="Norfolk Island">Norfolk Island</option>
                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                <option value="Norway">Norway</option>
                <option value="Oman">Oman</option>
                <option value="Pakistan">Pakistan</option>
                <option value="Palau">Palau</option>
                <option value="Panama">Panama</option>
                <option value="Papua New Guinea">Papua New Guinea</option>
                <option value="Paraguay">Paraguay</option>
                <option value="Peru">Peru</option>
                <option value="Philippines">Philippines</option>
                <option value="Pitcairn">Pitcairn</option>
                <option value="Poland">Poland</option>
                <option value="Portugal">Portugal</option>
                <option value="Puerto Rico">Puerto Rico</option>
                <option value="Qatar">Qatar</option>
                <option value="Reunion">Reunion</option>
                <option value="Romania">Romania</option>
                <option value="Russia">Russian Federation</option>
                <option value="Rwanda">Rwanda</option>
                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
                <option value="Saint LUCIA">Saint LUCIA</option>
                <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
                <option value="Samoa">Samoa</option>
                <option value="San Marino">San Marino</option>
                <option value="Sao Tome and Principe">Sao Tome and Principe</option> 
                <option value="Saudi Arabia">Saudi Arabia</option>
                <option value="Senegal">Senegal</option>
                <option value="Seychelles">Seychelles</option>
                <option value="Sierra">Sierra Leone</option>
                <option value="Singapore">Singapore</option>
                <option value="Slovakia">Slovakia (Slovak Republic)</option>
                <option value="Slovenia">Slovenia</option>
                <option value="Solomon Islands">Solomon Islands</option>
                <option value="Somalia">Somalia</option>
                <option value="South Africa">South Africa</option>
                <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
                <option value="Span">Spain</option>
                <option value="SriLanka">Sri Lanka</option>
                <option value="St. Helena">St. Helena</option>
                <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
                <option value="Sudan">Sudan</option>
                <option value="Suriname">Suriname</option>
                <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
                <option value="Swaziland">Swaziland</option>
                <option value="Sweden">Sweden</option>
                <option value="Switzerland">Switzerland</option>
                <option value="Syria">Syrian Arab Republic</option>
                <option value="Taiwan">Taiwan, Province of China</option>
                <option value="Tajikistan">Tajikistan</option>
                <option value="Tanzania">Tanzania, United Republic of</option>
                <option value="Thailand">Thailand</option>
                <option value="Togo">Togo</option>
                <option value="Tokelau">Tokelau</option>
                <option value="Tonga">Tonga</option>
                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                <option value="Tunisia">Tunisia</option>
                <option value="Turkey">Turkey</option>
                <option value="Turkmenistan">Turkmenistan</option>
                <option value="Turks and Caicos">Turks and Caicos Islands</option>
                <option value="Tuvalu">Tuvalu</option>
                <option value="Uganda">Uganda</option>
                <option value="Ukraine">Ukraine</option>
                <option value="United Arab Emirates">United Arab Emirates</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="United States">United States</option>
                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                <option value="Uruguay">Uruguay</option>
                <option value="Uzbekistan">Uzbekistan</option>
                <option value="Vanuatu">Vanuatu</option>
                <option value="Venezuela">Venezuela</option>
                <option value="Vietnam">Viet Nam</option>
                <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
                <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
                <option value="Western Sahara">Western Sahara</option>
                <option value="Yemen">Yemen</option>
                <option value="Yugoslavia">Yugoslavia</option>
                <option value="Zambia">Zambia</option>
                <option value="Zimbabwe">Zimbabwe</option>
                </select>
                </div>
            </div>
        </div>
        
        <div class="shipCost">
            <?php if($_SESSION['customer']['email']=='') { ?>
            <div class="boxEstimate">
                <p class="titleForm">CHECKOUT METHOD</p>
                <p class="inputRadio"><input name="acc" type="radio" value="have" id="chose1" required><label for="chose1">No need login</label></p>
                <p class="inputRadio"><input name="acc" type="radio" value="nohave" id="chose2" required><label for="chose2">Have login ?</label></p>
            </div>
            <?php } ?>
            <div class="boxSummary">
                <p class="titleForm titleForm--red">ORDER SUMMARY</p>
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
            </div>
        </div>
        </div>    
        <p class="taC boxBtn">
            <a href="<?php echo APP_URL; ?>checkout" class="contBtn">BACK</a>
            <input type="submit" class="submitBtn" value="SUBTMIT ORDER">
        </p>
        <?php
            $order_code = 'HOD_';
            $curr_date = str_replace('/','',date('Y/m/d'));
            $order_code.= $curr_date;
            $rand_code = '_'.rand(1000, 9999);
            $order_code.= $rand_code;
            $_SESSION['order_code'] = $order_code;
            $vat_fee = ($_COOKIE['totalCost'] * 10) / 100;
            $totalCost =  $_COOKIE['totalCost'] + $vat_fee;                          
        ?>    
        <input type="hidden" value="<?php echo $_SESSION['order_code']; ?>" name="order_code" >
        <input type="hidden" value="<?php echo $totalCost ?>" name="grand_total" >    
        </form>    
    <?php } else if($_GET['step']==3) { ?>
        <form class="formShipping" action="<?php echo APP_URL; ?>confirm" method="POST">
            <div class="clearfix">
            <div class="leffShiping">
                <p class="titleForm">PAYMENT METHOD</p>
                <?php if($_POST['country']=='Vietnam') { ?>
                <p class="inputRadio"><input type="radio" name="payment" value="cod"><label>COD</label></p>
                <?php } ?>
                <p class="inputRadio"><input type="radio" name="payment" value="credit"><label>Credit Card</label></p>

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
                        <td class="currentCost"><?php echo $_COOKIE['totalCost']; ?></td>
                        <td>10%</td>
                        <td class="last grandCost"></td>
                    </tr>
                </table>
            </div>
            </div>
            </div>
            <?php 
                $_SESSION['order_code'] = $_POST['order_code'];
                $_SESSION['grand_total'] = $_POST['grand_total']; 
                $_SESSION['address'] = $_POST['address'];
                $_SESSION['city'] = $_POST['city'];
                $_SESSION['country'] = $_POST['country'];
                $_SESSION['fullname'] = $_POST['fullname'];
                $_SESSION['phone'] = $_POST['phone'];                       
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
<script>
var currentCost = parseInt($('.currentCost').text());
var grandCost = ((currentCost * 10) / 100) + currentCost;
$('.grandCost').text(grandCost.toLocaleString());
</script>
    
</body>
</html>	