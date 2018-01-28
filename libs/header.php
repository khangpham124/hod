<!--Google Tag Manager-->
<!--End Google Tag Manager-->
<header id="header">
    <div class="headerInner clearfix">
        <h1 id="logo"><a href="<?php echo APP_URL; ?>"><img src="<?php echo APP_URL; ?>common/img/header/logo.svg" alt="<?php echo $txtH1; ?>"></a></h1>
        <div class="rightHead clearfix">
            <p class="menuCircle sp"><span></span></p>
            <div class="clearfix langSp pc">
                <ul class="clearfix lstLang f_lapresse">
                    <li class="active"><a href="">EN</a></li>
                    <li><a href="">/ VI</a></li>
                </ul>
            </div>    
            <div class="naviBar clearfix">
            <?php if ( is_user_logged_in() ) { ?>
                <div class="infoUser clearfix">
                    <p class="iconCart"><a href="javascript:void(0)" class="viewCart"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span id="numbCart">0</span><em>My cart</em></a></p>
                    
                    <?php                    
                    if($_SESSION['customer']['email']=='') { ?>
                    <p class="iconLogin" id="iconLogin"><a href="javascript:void(0)"><i class="fa fa-user" aria-hidden="true"></i><em>Sign In/ <br class="sp">Register</em></a></p>
                    <?php } else { ?>
                    <p class="iconLogin" id="iconLogout"><a href="javascript:void(0)"><i class="fa fa-user" aria-hidden="true"></i>
                        <em>Hello, <?php echo $_SESSION['customer']['gender']; ?> <?php echo $_SESSION['customer']['fullname']; ?>
                    </em></a></p>
                    <?php } ?>
                </div> 
            <?php } ?>
                <ul class="gNavi f_lapresse clearfix pc">
                    <li><a href="<?php echo APP_URL; ?>">HOME</a></li>
                    <li><a href="<?php echo APP_URL; ?>beer">BEER</a></li>
                    <li><a href="<?php echo APP_URL; ?>food">FOOD</a></li>
                    <li><a href="<?php echo APP_URL; ?>location">LOCATION</a></li>
                    <li><a href="javascript:void(0)" class="whaton">WHAT'S ON</a></li>
                    <li><a href="<?php echo APP_URL; ?>find">FIND OUR BEER</a></li>
                    <li><a href="<?php echo APP_URL; ?>press">PRESS</a></li>
                    <li><a href="<?php echo APP_URL; ?>career">CAREER</a></li>
                    <li><a href="<?php echo APP_URL; ?>about">ABOUT</a></li>
                    <li><a href="<?php echo APP_URL; ?>shop">SHOP</a></li>
                </ul>
            </div>
        </div>
    </div>
    <?php if ( is_user_logged_in() ) { ?>
        <div class="boxRegis">
            <div class="inner">
                <?php if($_SESSION['customer']['email']=='') { ?>
                <p class="label">Sign in with:</p>
                <div class="btnSoc">
                    <a href="#" onclick='login();'><img src="<?php echo APP_URL; ?>common/img/header/btn_fb.svg" alt ></a>
                    
                    <a href=""><img src="<?php echo APP_URL; ?>common/img/header/btn_gg.svg" alt ></a>
                </div>
                <p class="label">Or sign in as a member:</p>
                <a href="" class="btnRegis">HEART OF DARKNESS account</a>
                <p class="txtRegis">Not a member yet? <a href="javascript:void(0)" class="linkRegis">REGISTER NOW</a></p>
                <?php } else { ?>
                <ul>
                    <li><a href=""><i class="fa fa-truck" aria-hidden="true"></i>My order</a></li>
                    <li><a href=""><i class="fa fa-info-circle" aria-hidden="true"></i>My Info</a></li>
                    <li><a href="<?php echo APP_URL; ?>logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Log out</a></li>
                </ul>
                <?php } ?>
            </div>    
        </div>
    <?php } ?>
    
</header>

<div class="sp" id="menuSP">
	<ul class="naviSP f_lapresse">
        <li><a href="<?php echo APP_URL; ?>">HOME</a></li>
        <li><a href="<?php echo APP_URL; ?>beer">BEER</a></li>
        <li><a href="<?php echo APP_URL; ?>food">FOOD</a></li>
        <li><a href="<?php echo APP_URL; ?>location">LOCATION</a></li>
        <li><a href="javascript:void(0)" class="whaton">WHAT'S ON</a></li>
        <li><a href="<?php echo APP_URL; ?>find">FIND OUR BEER</a></li>
        <li><a href="<?php echo APP_URL; ?>press">PRESS</a></li>
        <li><a href="<?php echo APP_URL; ?>career">CAREER</a></li>
        <li><a href="<?php echo APP_URL; ?>about">ABOUT</a></li>
        <li><a href="<?php echo APP_URL; ?>shop">SHOP</a></li>
	</ul>
    <div class="clearfix followSp">
        <img src="<?php echo APP_URL; ?>img/top/beer1.png" class="img_beer_sp" alt="">
        <div class="overflow">
            <p class="f_lapresse txt_Conn_sp">
            <span>connect with us</span>
            </p>
            <ul class="clearfix listIcon">
                <li><a href="https://www.facebook.com/heartofdarknessbrewery/"><img src="<?php echo APP_URL; ?>common/img/footer/icon_fb.svg" alt=""></a></li>
                <li><a href="https://www.instagram.com/heart_of_darkness_brewery/"><img src="<?php echo APP_URL; ?>common/img/footer/icon_ins.svg" alt=""></a></li>
                <li><a href="https://goo.gl/U3kvyG"><img src="<?php echo APP_URL; ?>common/img/footer/icon_trip.svg" alt=""></a></li>
                <li><a href=""><img src="<?php echo APP_URL; ?>common/img/footer/icon_gg.svg" alt=""></a></li>
            </ul>
        </div>
    </div>
</div>