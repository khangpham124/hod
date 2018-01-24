<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/projects/hod/app_config.php');
include(APP_PATH."libs/head.php"); 
?>
<link rel="stylesheet" href="<?php echo APP_URL; ?>common/css/slick.css">
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
</head>

<body id="beer">
<!--===================================================-->

<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->

<div id="wrapper">

<div class="greyBox">
    <div class="inner clearfix">
    <ul class="tabBeer pc">
        <li class="active"><a href="#flag">flagship beers</a></li>
        <li><a href="#season">seasonals</a></li>
        <li><a href="#bottles">bottles</a></li>
    </ul>
    
    <div class="rightBeer" id="rightBeer" ng-app="">
        <div id="part1">
        <p class="pc wrapSerch">
        <input type="text" class="search searchInut" id="search1" ng-model="search1" placeholder="Search your favourite beer" />
        <span class="toClick"></span>    
        </p>
        
        <h2 id="flag" class="h2_site">flagship beers<span>always available</span></h2>
        <ul class="lstBeer clearfix listSearch" id="flagSlide">
        <li>
        <p class="thumb">
            <img src="<?php echo APP_URL; ?>img/top/b1.png" class="imgBeer" alt="">
            <img src="<?php echo APP_URL; ?>img/top/cupBeer.png" class="cupB_sp sp" alt="">
        </p>
        <div class="wrap">
            <div class="inner">
                    <img src="<?php echo APP_URL; ?>img/top/cupBeer.png" class="cupB" alt="">
                    <div class="info">
                        <p class="nameBeer">55555.3% ABV Khang</p>
                        <p class="subName">35 IBU</p>
                    </div>    
                    <p class="flag"><span>Flagship</span></p>
                
            </div>
            <div class="flipCard">
            A pilsner with a refreshing and flavorful twist. Using all New Zealand hops, the light golden body compliments the fruity crushed gooseberry and lime flavors coming from the Motueka and Nelson Sauvin. Perfect for Saigon’s hot climate and extended drinking sessions with friends.
                <img src="<?php echo APP_URL; ?>img/beer/medal.png" class="imgMedal" alt="">    
            </div>
        </div>
    </li>
        <li>
           <p class="thumb">
            <img src="<?php echo APP_URL; ?>img/top/b2.png" class="imgBeer" alt="">
            <img src="<?php echo APP_URL; ?>img/top/cupBeer.png" class="cupB_sp sp" alt="">
            </p>
            <div class="wrap">
                <div class="inner">
                    
                        <img src="<?php echo APP_URL; ?>img/beer/beer2.png" class="cupB" alt="">
                        <div class="info">
                            <p class="nameBeer">5.3% ABN</p>
                            <p class="subName">35 IBU</p>
                        </div>
                        <p class="flag"><span>Flagship</span></p>
                    
                </div>
                <div class="flipCard">
                Our take on the classic British Ale. Beautifully hoppy on the back of both Pale and Crystal malts with a beautiful copper hue and a sweet long finish. Using US Citra hops as the main hop, it features tastes of grapefruit, lime, passion fruit, and lychee. You may even be able to pick out hints of melon and gooseberry. A clean and crisp Pale Ale with a lot of late edition hops and a flavor that will dance on your tongue.
                </div>
            </div>
        </li>
        <li>
            <p class="thumb">
            <img src="<?php echo APP_URL; ?>img/top/b3.png" class="imgBeer" alt="">
            <img src="<?php echo APP_URL; ?>img/top/cupBeer.png" class="cupB_sp sp" alt="">
        </p>
            <div class="wrap">
                <div class="inner">
                    
                        <img src="<?php echo APP_URL; ?>img/beer/beer3.png" class="cupB" alt="">
                        <div class="info">
                            <p class="nameBeer">5.3% ABV</p>
                            <p class="subName">35 IBU</p>
                        </div>
                        <p class="flag"><span>Flagship</span></p>
                    
                </div>
                <div class="flipCard">
                This is our gateway to craft beer. It has a beautiful hue and a long, smooth finish with just a hint of caramel and passion fruit. A light, crisp and refreshing ale with a playful, Asian twist which is low enough in alcohol to be enjoyed throughout those hot, sunny days and well into the evening. 
                </div>
            </div>
        </li>
        <li>
            <p class="thumb">
            <img src="<?php echo APP_URL; ?>img/top/b4.png" class="imgBeer" alt="">
            <img src="<?php echo APP_URL; ?>img/top/cupBeer.png" class="cupB_sp sp" alt="">
        </p>
            <div class="wrap">
                <div class="inner">
                    
                        <img src="<?php echo APP_URL; ?>img/top/cupBeer.png" class="cupB" alt="">
                        <div class="info">
                            <p class="nameBeer">test 10% ABV</p>
                            <p class="subName">35 IBU</p>
                        </div>    
                        <p class="flag"><span>Flagship</span></p>
                    
                </div>
                <div class="flipCard">
                A pilsner with a refreshing and flavorful twist. Using all New Zealand hops, the light golden body compliments the fruity crushed gooseberry and lime flavors coming from the Motueka and Nelson Sauvin. Perfect for Saigon’s hot climate and extended drinking sessions with friends.
                    <img src="<?php echo APP_URL; ?>img/beer/medal.png" class="imgMedal" alt="">    
                </div>
            </div>
        </li>
        <li>
            <p class="thumb">
            <img src="<?php echo APP_URL; ?>img/top/b5.png" class="imgBeer" alt="">
            <img src="<?php echo APP_URL; ?>img/top/cupBeer.png" class="cupB_sp sp" alt="">
        </p>
            <div class="wrap">
                <div class="inner">
                    
                        <img src="<?php echo APP_URL; ?>img/top/cupBeer.png" class="cupB" alt="">
                        <div class="info">
                            <p class="nameBeer">5.3% ABV</p>
                            <p class="subName">35 IBU</p>
                        </div>
                        <p class="flag"><span>Flagship</span></p>
                   
                </div>
                <div class="flipCard">
                Pale and hazy in true “New England” fashion. Big pineapple, tangerine and stone fruit on the nose. Rich and creamy mouthfeel. Finishes with a tropical kick of lime, guava and pomelo.
                </div>
            </div>
        </li>
        <li>
            <p class="thumb">
            <img src="<?php echo APP_URL; ?>img/top/b6.png" class="imgBeer" alt="">
            <img src="<?php echo APP_URL; ?>img/top/cupBeer.png" class="cupB_sp sp" alt="">
        </p>
            <div class="wrap">
                <div class="inner">
                    <img src="<?php echo APP_URL; ?>img/top/cupBeer.png" class="cupB" alt="">
                        <div class="info">
                            <p class="nameBeer">5.3% ABV</p>
                            <p class="subName">35 IBU</p>
                        </div>
                        <p class="flag"><span>Flagship</span></p>
                    
                </div>
                <div class="flipCard">
                    Darkest ruby to black in colour. Deep roasty coffee-like aroma dominates with a hint of chocolate in the background. Roast and pleasant bitterness also dominates the flavour and contrasts the creamy mouthfeel. Easy drinking and moreish despite the intensity of flavour. Classic pairing – freshly shucked oysters. Also pairs with roast meats and dark desserts. 
                </div>
            </div>
        </li>
    </ul>
    <p class="btnMore btnIntro f_lapresse">find our beers near you</p>
    </div>    
    <div id="part2">
        
    <h2 id="season" class="h2_site mt120">seasonals<span>currently on tap</span></h2>
        <ul class="lstBeer clearfix listSearch" id="seasonSlide">
        <li>
            <p class="thumb">
            <img src="<?php echo APP_URL; ?>img/top/b1.png" class="imgBeer" alt="">
            <img src="<?php echo APP_URL; ?>img/top/cupBeer.png" class="cupB_sp sp" alt="">
            </p>
            <div class="wrap">
                <div class="inner">
                        <img src="<?php echo APP_URL; ?>img/beer/beer1.png" class="cupB" alt="">
                        <div class="info">
                            <p class="nameBeer">khang5.3% ABV</p>
                            <p class="subName">35 IBU</p>
                        </div>    
                        <p class="flag"><span>Flagship</span></p>                    
                </div>
                <div class="flipCard">
                <p>
                Heart of Darkness' biggest, hoppiest beer. A wonderfully vibrant beer, with grapefruit and piney tones, we’ve crammed in 7 kinds of hops which deliver a full blown assault on your taste buds. This is a big, but beautifully balanced IPA, with a bright and fun bitter flavour - a true hop head's delight.
                </p>
                </div>
            </div>
            
        </li>
        <li>
            <p class="thumb">
            <img src="<?php echo APP_URL; ?>img/top/b1.png" class="imgBeer" alt="">
            <img src="<?php echo APP_URL; ?>img/top/cupBeer.png" class="cupB_sp sp" alt="">
            </p>
            <div class="wrap">
                <div class="inner">
                    
                        <img src="<?php echo APP_URL; ?>img/beer/beer2.png" class="cupB" alt="">
                        <div class="info">
                            <p class="nameBeer">5.3% ABV</p>
                            <p class="subName">35 IBU</p>
                        </div>
                        <p class="flag"><span>Flagship</span></p>
                    
                </div>
                <div class="flipCard">
                Our take on the classic British Ale. Beautifully hoppy on the back of both Pale and Crystal malts with a beautiful copper hue and a sweet long finish. Using US Citra hops as the main hop, it features tastes of grapefruit, lime, passion fruit, and lychee. You may even be able to pick out hints of melon and gooseberry. A clean and crisp Pale Ale with a lot of late edition hops and a flavor that will dance on your tongue.
                </div>
            </div>
        </li>
        <li>
            <p class="thumb">
            <img src="<?php echo APP_URL; ?>img/top/b1.png" class="imgBeer" alt="">
            <img src="<?php echo APP_URL; ?>img/top/cupBeer.png" class="cupB_sp sp" alt="">
            </p>
            <div class="wrap">
                <div class="inner">
                    
                        <img src="<?php echo APP_URL; ?>img/beer/beer3.png" class="cupB" alt="">
                        <div class="info">
                            <p class="nameBeer">5.3% ABV</p>
                            <p class="subName">35 IBU</p>
                        </div>
                        <p class="flag"><span>Flagship</span></p>
                    
                </div>
                <div class="flipCard">
                This is our gateway to craft beer. It has a beautiful hue and a long, smooth finish with just a hint of caramel and passion fruit. A light, crisp and refreshing ale with a playful, Asian twist which is low enough in alcohol to be enjoyed throughout those hot, sunny days and well into the evening. 
                </div>
            </div>
        </li>
            
        <li>
            <p class="thumb">
            <img src="<?php echo APP_URL; ?>img/top/b1.png" class="imgBeer" alt="">
            <img src="<?php echo APP_URL; ?>img/top/cupBeer.png" class="cupB_sp sp" alt="">
            </p>
            <div class="wrap">
                <div class="inner">
                        <img src="<?php echo APP_URL; ?>img/beer/beer1.png" class="cupB" alt="">
                        <div class="info">
                            <p class="nameBeer">khang5.3% ABV</p>
                            <p class="subName">35 IBU</p>
                        </div>    
                        <p class="flag"><span>Flagship</span></p>                    
                </div>
                <div class="flipCard">
                <p>
                Heart of Darkness' biggest, hoppiest beer. A wonderfully vibrant beer, with grapefruit and piney tones, we’ve crammed in 7 kinds of hops which deliver a full blown assault on your taste buds. This is a big, but beautifully balanced IPA, with a bright and fun bitter flavour - a true hop head's delight.
                </p>
                </div>
            </div>
            
        </li>
        <li>
            <p class="thumb">
            <img src="<?php echo APP_URL; ?>img/top/b1.png" class="imgBeer" alt="">
            <img src="<?php echo APP_URL; ?>img/top/cupBeer.png" class="cupB_sp sp" alt="">
            </p>
            <div class="wrap">
                <div class="inner">
                    
                        <img src="<?php echo APP_URL; ?>img/beer/beer2.png" class="cupB" alt="">
                        <div class="info">
                            <p class="nameBeer">5.3% ABV</p>
                            <p class="subName">35 IBU</p>
                        </div>
                        <p class="flag"><span>Flagship</span></p>
                    
                </div>
                <div class="flipCard">
                Our take on the classic British Ale. Beautifully hoppy on the back of both Pale and Crystal malts with a beautiful copper hue and a sweet long finish. Using US Citra hops as the main hop, it features tastes of grapefruit, lime, passion fruit, and lychee. You may even be able to pick out hints of melon and gooseberry. A clean and crisp Pale Ale with a lot of late edition hops and a flavor that will dance on your tongue.
                </div>
            </div>
        </li>
        <li>
            <p class="thumb">
            <img src="<?php echo APP_URL; ?>img/top/b1.png" class="imgBeer" alt="">
            <img src="<?php echo APP_URL; ?>img/top/cupBeer.png" class="cupB_sp sp" alt="">
            </p>
            <div class="wrap">
                <div class="inner">
                    
                        <img src="<?php echo APP_URL; ?>img/beer/beer3.png" class="cupB" alt="">
                        <div class="info">
                            <p class="nameBeer">5.3% ABV</p>
                            <p class="subName">35 IBU</p>
                        </div>
                        <p class="flag"><span>Flagship</span></p>
                    
                </div>
                <div class="flipCard">
                This is our gateway to craft beer. It has a beautiful hue and a long, smooth finish with just a hint of caramel and passion fruit. A light, crisp and refreshing ale with a playful, Asian twist which is low enough in alcohol to be enjoyed throughout those hot, sunny days and well into the evening. 
                </div>
            </div>
        </li>
            
        <li>
            <p class="thumb">
            <img src="<?php echo APP_URL; ?>img/top/b1.png" class="imgBeer" alt="">
            <img src="<?php echo APP_URL; ?>img/top/cupBeer.png" class="cupB_sp sp" alt="">
            </p>
            <div class="wrap">
                <div class="inner">
                        <img src="<?php echo APP_URL; ?>img/beer/beer1.png" class="cupB" alt="">
                        <div class="info">
                            <p class="nameBeer">khang5.3% ABV</p>
                            <p class="subName">35 IBU</p>
                        </div>    
                        <p class="flag"><span>Flagship</span></p>                    
                </div>
                <div class="flipCard">
                <p>
                Heart of Darkness' biggest, hoppiest beer. A wonderfully vibrant beer, with grapefruit and piney tones, we’ve crammed in 7 kinds of hops which deliver a full blown assault on your taste buds. This is a big, but beautifully balanced IPA, with a bright and fun bitter flavour - a true hop head's delight.
                </p>
                </div>
            </div>
            
        </li>
        <li>
            <p class="thumb">
            <img src="<?php echo APP_URL; ?>img/top/b1.png" class="imgBeer" alt="">
            <img src="<?php echo APP_URL; ?>img/top/cupBeer.png" class="cupB_sp sp" alt="">
            </p>
            <div class="wrap">
                <div class="inner">
                    
                        <img src="<?php echo APP_URL; ?>img/beer/beer2.png" class="cupB" alt="">
                        <div class="info">
                            <p class="nameBeer">5.3% ABV</p>
                            <p class="subName">35 IBU</p>
                        </div>
                        <p class="flag"><span>Flagship</span></p>
                    
                </div>
                <div class="flipCard">
                Our take on the classic British Ale. Beautifully hoppy on the back of both Pale and Crystal malts with a beautiful copper hue and a sweet long finish. Using US Citra hops as the main hop, it features tastes of grapefruit, lime, passion fruit, and lychee. You may even be able to pick out hints of melon and gooseberry. A clean and crisp Pale Ale with a lot of late edition hops and a flavor that will dance on your tongue.
                </div>
            </div>
        </li>
        <li>
            <p class="thumb">
            <img src="<?php echo APP_URL; ?>img/top/b1.png" class="imgBeer" alt="">
            <img src="<?php echo APP_URL; ?>img/top/cupBeer.png" class="cupB_sp sp" alt="">
            </p>
            <div class="wrap">
                <div class="inner">
                    
                        <img src="<?php echo APP_URL; ?>img/beer/beer3.png" class="cupB" alt="">
                        <div class="info">
                            <p class="nameBeer">5.3% ABV</p>
                            <p class="subName">35 IBU</p>
                        </div>
                        <p class="flag"><span>Flagship</span></p>
                    
                </div>
                <div class="flipCard">
                This is our gateway to craft beer. It has a beautiful hue and a long, smooth finish with just a hint of caramel and passion fruit. A light, crisp and refreshing ale with a playful, Asian twist which is low enough in alcohol to be enjoyed throughout those hot, sunny days and well into the evening. 
                </div>
            </div>
        </li>    
        <li class="no_label">
            <div class="wrap">
                <div class="inner">
                    
                        <img src="<?php echo APP_URL; ?>img/top/cupBeer.png" class="cupB" alt="">
                        <div class="info">
                            <p class="nameBeer">5.3% ABV</p>
                            <p class="subName">35 IBU</p>
                        </div>    
                        <p class="flag"><span>Flagship</span></p>
                    
                </div>
                <div class="flipCard">
                A pilsner with a refreshing and flavorful twist. Using all New Zealand hops, the light golden body compliments the fruity crushed gooseberry and lime flavors coming from the Motueka and Nelson Sauvin. Perfect for Saigon’s hot climate and extended drinking sessions with friends.
                    <img src="<?php echo APP_URL; ?>img/beer/medal.png" class="imgMedal" alt="">    
                </div>
            </div>
        </li>
        <li class="no_label">
            <div class="wrap">
                <div class="inner">
                    
                        <img src="<?php echo APP_URL; ?>img/top/cupBeer.png" class="cupB" alt="">
                        <div class="info">
                            <p class="nameBeer">5.3% ABV</p>
                            <p class="subName">35 IBU</p>
                        </div>
                        <p class="flag"><span>Flagship</span></p>
                   
                </div>
                <div class="flipCard">
                Pale and hazy in true “New England” fashion. Big pineapple, tangerine and stone fruit on the nose. Rich and creamy mouthfeel. Finishes with a tropical kick of lime, guava and pomelo.
                </div>
            </div>
        </li>
        <li class="no_label">
            <div class="wrap">
                <div class="inner">
                    <img src="<?php echo APP_URL; ?>img/top/cupBeer.png" class="cupB" alt="">
                        <div class="info">
                            <p class="nameBeer">5.3% ABV</p>
                            <p class="subName">35 IBU</p>
                        </div>
                        <p class="flag"><span>Flagship</span></p>
                    
                </div>
                <div class="flipCard">
                    Darkest ruby to black in colour. Deep roasty coffee-like aroma dominates with a hint of chocolate in the background. Roast and pleasant bitterness also dominates the flavour and contrasts the creamy mouthfeel. Easy drinking and moreish despite the intensity of flavour. Classic pairing – freshly shucked oysters. Also pairs with roast meats and dark desserts. 
                </div>
            </div>
        </li>
            
        <li class="no_label">
            <div class="wrap">
                <div class="inner">
                    
                        <img src="<?php echo APP_URL; ?>img/top/cupBeer.png" class="cupB" alt="">
                        <div class="info">
                            <p class="nameBeer">5.3% ABV</p>
                            <p class="subName">35 IBU</p>
                        </div>
                        <p class="flag"><span>Flagship</span></p>
                   
                </div>
                <div class="flipCard">
                Pale and hazy in true “New England” fashion. Big pineapple, tangerine and stone fruit on the nose. Rich and creamy mouthfeel. Finishes with a tropical kick of lime, guava and pomelo.
                </div>
            </div>
        </li>
        <li class="no_label">
            <div class="wrap">
                <div class="inner">
                    <img src="<?php echo APP_URL; ?>img/top/cupBeer.png" class="cupB" alt="">
                        <div class="info">
                            <p class="nameBeer">5.3% ABV</p>
                            <p class="subName">35 IBU</p>
                        </div>
                        <p class="flag"><span>Flagship</span></p>
                    
                </div>
                <div class="flipCard">
                    Darkest ruby to black in colour. Deep roasty coffee-like aroma dominates with a hint of chocolate in the background. Roast and pleasant bitterness also dominates the flavour and contrasts the creamy mouthfeel. Easy drinking and moreish despite the intensity of flavour. Classic pairing – freshly shucked oysters. Also pairs with roast meats and dark desserts. 
                </div>
            </div>
        </li>    
    </ul>
    <p class="btnMore btnIntro f_lapresse">find our beers near you</p>
    </div>    
        
    </div>
    </div>
</div>

<div class="boxBeerPage">
    <div class="inner clearfix">
        <div class="rightBeer">
                <h2 id="bottles" class="h2_site">bottles</h2>
            <ul class="listFeature clearfix listSearch" id="bottlesSlide">
                <li>
                    <p class="listFeature__thumb">
                        <img src="<?php echo APP_URL; ?>img/beer/bottle1.png" class="img_bottle" alt="">
                        <img src="<?php echo APP_URL; ?>img/beer/label1.png" class="img_label" alt="">
                    </p>
                    <div class="pa1">
                    <div class="pa2">
                    <div class="pa3">    
                        <p class="listFeature__name nameBeer"><a href="" style="color:#017451">Khang's Insane IPA</a></p>
                        <div class="listFeature__desc matchHeight subName">
                        7.1% ABV - 102 IBU - 330ml
                        </div>
                    </div>
                    </div>
                    </div>
                    <p class="listFeature__price">VND 330,000</p>
                    <a href="" class="listFeature__btn">add to cart</a>
                </li>

                <li>
                    <p class="listFeature__thumb">
                        <img src="<?php echo APP_URL; ?>img/beer/bottle1.png" class="img_bottle" alt="">
                        <img src="<?php echo APP_URL; ?>img/beer/label1.png" class="img_label" alt="">
                    </p>
                    <div class="pa1">
                    <div class="pa2">
                    <div class="pa3">    
                        <p class="listFeature__name nameBeer"><a href="" style="color:#017451">Kutz's Insane IPA</a></p>
                        <div class="listFeature__desc matchHeight subName">
                        8.5% ABV - 102 IBU - 330ml
                        </div>
                    </div>
                    </div>
                    </div>
                    <p class="listFeature__price">VND 330,000</p>
                    <a href="" class="listFeature__btn">add to cart</a>
                </li>

                <li>
                    <p class="listFeature__thumb">
                        <img src="<?php echo APP_URL; ?>img/beer/bottle1.png" class="img_bottle" alt="">
                        <img src="<?php echo APP_URL; ?>img/beer/label1.png" class="img_label" alt="">
                    </p>
                    <div class="pa1">
                    <div class="pa2">
                    <div class="pa3">    
                        <p class="listFeature__name nameBeer"><a href="" style="color:#017451">Test's Insane IPA</a></p>
                        <div class="listFeature__desc matchHeight subName">
                        10% ABV - 102 IBU - 330ml
                        </div>
                    </div>
                    </div>
                    </div>
                    <p class="listFeature__price">VND 330,000</p>
                    <a href="" class="listFeature__btn">add to cart</a>
                </li>
                
                <li>
                    <p class="listFeature__thumb">
                        <img src="<?php echo APP_URL; ?>img/beer/bottle1.png" class="img_bottle" alt="">
                        <img src="<?php echo APP_URL; ?>img/beer/label1.png" class="img_label" alt="">
                    </p>
                    <div class="pa1">
                    <div class="pa2">
                    <div class="pa3">    
                        <p class="listFeature__name nameBeer"><a href="" style="color:#017451">Kutz's Insane IPA</a></p>
                        <div class="listFeature__desc matchHeight subName">
                        5.5% ABV - 102 IBU - 330ml
                        </div>
                    </div>
                    </div>
                    </div>
                    <p class="listFeature__price">VND 330,000</p>
                    <a href="" class="listFeature__btn">add to cart</a>
                </li>
            </ul>
        </div>
    </div>
</div>    
    
<!--Footer-->
<?php include(APP_PATH."libs/footer.php"); ?>
<!--/Footer-->
<!--===================================================-->
</div>
<!--/wrapper-->
<!--===================================================-->


<script src="<?php echo APP_URL; ?>common/js/slick.min.js"></script>
<script>
$(function() {
    
    $('#search1').focus(function() {
        $('.listSearch li').addClass('ready');
        if($(this).val() != '') {
            $(this).val("");
            $('.ready').css('display','block');
            $('.listSearch li').removeClass('still');
        }
    });
    
    $('#search1').on('keyup', function () {
        if($(this).val() == '') {
           $('.ready').css('display','block');
            $('.listSearch li').removeClass('still');
        }
    });
    
    $('.toClick').click(function() {
        var search = $('#search1').val().toLowerCase();
        $('.listSearch li').each(function() {
            var parent = $(this);
            var name_val = $(this).find('.nameBeer');
            var sub_val = $(this).find('.subName');
            var n = name_val.text().toLowerCase();
            var s = sub_val.text().toLowerCase();
            var q1 = n.indexOf(search);
            var q2 = s.indexOf(search);
            console.log(n);
            if((q1 >= 0)||(q2 >= 0)) {
                parent.addClass('still');
                $('.ready').css('display','none');
            }
        });
    });
        
    $('.lstBeer li').click(function() {
        $(this).find('.wrap').toggleClass('flipped');
    });
    
    /* $(window).scroll(function(){
            var sT = $(window).scrollTop();
            var vWrap = $('#wrapper').offset().top;
            var p_season = $('#season').offset().top;
            var p_bottles = $('#bottles').offset().top;
            var act_season  = p_season - 200;
            var act_bottles  = p_bottles - 250;
        
            if((sT > 120)) {
                $(".tabBeer").css("top", sT +'px');
            } else {
               $(".tabBeer").css("top", '0px');
            }
            
            if(sT < act_season) {
                $(".tabBeer li").removeClass('active');
                $(".tabBeer li:nth-child(1)").addClass('active');
            }
            
            if((sT > act_season)&&(sT < act_bottles)) {
                $(".tabBeer li").removeClass('active');
                $(".tabBeer li:nth-child(2)").addClass('active');
            } else {
                $(".tabBeer li:nth-child(2)").removeClass('active');
            }
        
            if(sT > act_bottles) { 
                $(".tabBeer li").removeClass('active');
                $(".tabBeer li:nth-child(3)").addClass('active');
            }
    }); */
    
    
var options = {
  dots: false,
  infinite: true,
  speed: 400,
  autoplay: false,
  arrows:true,
  autoplaySpeed: 3000,
  slidesToShow: 4,
  slidesToScroll: 1,
  responsive: [
    {
            breakpoint: 9999,
            settings: "unslick"
    },
    {
      breakpoint: 767,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
          dots: true ,
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        dots: true ,
        slidesToScroll: 1
      }
    }
   
  ]
};
$('#flagSlide').slick(options);
$('#seasonSlide').slick(options);
$('#bottlesSlide').slick(options);
});
</script>
<!-- https://desandro.github.io/3dtransforms/examples/card-01.html 
https://codepen.io/desandro/pen/wfaGu
http://listjs.com/
https://codepen.io/javve/pen/isInl
!-->
    
</body>
</html>	