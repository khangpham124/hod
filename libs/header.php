<script async src="https://www.googletagmanager.com/gtag/js?id=UA-114860470-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-114860470-1');
</script>

<div id="fb-root"></div>
<script>
    // Load facebook SDK
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&"
 + "version=v2.7&appId=554020094959929"; // Đổi App ID của bạn ở đây
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<!--End Google Tag Manager-->
<header id="header">
    <h1 id="logo"><a href="<?php echo APP_URL; ?>"><img src="<?php echo APP_URL; ?>common/img/header/logo.svg" alt="<?php echo $txtH1; ?>"></a></h1>
    <div class="headerInner clearfix">
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
                    
                    <?php if(($_SESSION['customer']['email']!='')||($_COOKIE['fb_acc']!='')) { ?>
                        <p class="iconLogin" id="iconLogout"><a href="javascript:void(0)"><i class="fa fa-user" aria-hidden="true"></i>
                            <?php if($_SESSION['customer']['email']!='') { ?>
                            <em><?php echo $_SESSION['customer']['gender']; ?> <?php echo $_SESSION['customer']['fullname']; ?></em>
                            <?php } else { ?>
                            <em><?php echo $_COOKIE['fb_name']; ?></em>
                            <?php } ?>   
                        </a></p>
                    <?php } else { ?>
                        <p class="iconLogin" id="iconLogin"><a href="javascript:void(0)"><i class="fa fa-user" aria-hidden="true"></i><em>Sign In/ <br class="sp">Register</em></a></p>
                    <?php } ?>
                </div> 
            <?php } ?>
                <ul class="gNavi f_lapresse pc">        
                 <?php
                    $param = array (
                        'posts_per_page' => '-1',
                        'post_type' => 'menutab', 
                        'post_status' => 'publish',
                        'meta_query' => array(
                        array(
                        'key' => 'cf_show',
                        'value' => 'yes',
                        'compare' => '='
                        ))
                        );
                        $posts_array = get_posts( $param );
                        foreach ($posts_array as $sale ) {
                ?>
                <li>
                    <?php if(get_field('pop_up',$sale->ID)!='yes') { ?>
                    <a href="<?php echo APP_URL; ?><?php echo get_field('cf_url',$sale->ID); ?>">
                    <?php } else { ?>
                    <a href="javascript:void(0)" class="whaton">
                    <?php } ?>
                    <?php echo $sale->post_title; ?></a>    
                </li>
                 <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <?php if ( is_user_logged_in() ) { ?>
        <div class="boxRegis">
            <div class="inner">
                <?php if(($_SESSION['customer']['email']!='')||($_COOKIE['fb_acc']!='')) { ?>
                <ul class="listInfo">
                    <li><a href="<?php echo APP_URL; ?>account-order"><i class="fa fa-truck" aria-hidden="true"></i>My order</a></li>
                    <li><a href="<?php echo APP_URL; ?>account-info"><i class="fa fa-info-circle" aria-hidden="true"></i>My Info</a></li>
                    <li><a href="<?php echo APP_URL; ?>logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Log out</a></li>
                </ul>
                <?php } else { ?>
                <p class="label">Sign in with:</p>
                <div class="btnSoc">
                    <a href="#" onclick="checkLoginState()"><img src="<?php echo APP_URL; ?>common/img/header/btn_fb.svg" alt ></a>
                    
                    <a href=""><img src="<?php echo APP_URL; ?>common/img/header/btn_gg.svg" alt ></a>
                </div>
                <p class="label">Or sign in as a member:</p>
                <a href="javascript:void(0)" class="btnRegis">HEART OF DARKNESS account</a>
                <p class="txtRegis">Not a member yet? <a href="javascript:void(0)" class="linkRegis">REGISTER NOW</a></p>
                <?php } ?>
            </div>    
        </div>
    <?php } ?>
    
</header>

<div class="sp" id="menuSP">
	<ul class="naviSP f_lapresse">
        <?php
            $param = array (
                'posts_per_page' => '-1',
                'post_type' => 'menutab', 
                'post_status' => 'publish',
                'meta_query' => array(
                array(
                'key' => 'cf_show',
                'value' => 'yes',
                'compare' => '='
                ))
                );
                $posts_array = get_posts( $param );
                foreach ($posts_array as $sale ) {
        ?>
            <li>
                <?php if(get_field('pop_up',$sale->ID)!='yes') { ?>
                <a href="<?php echo APP_URL; ?><?php echo get_field('cf_url',$sale->ID); ?>">
                <?php } else { ?>
                <a href="javascript:void(0)" class="whaton">
                <?php } ?>
                <?php echo $sale->post_title; ?></a>    
            </li>
        <?php } ?>   
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