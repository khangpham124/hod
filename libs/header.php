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
    <a href="javascript:void(0)" class="viewCart sp"><i class="fa fa-shopping-cart" aria-hidden="true"></i>(<span class="numbCart">0</span>)</a>
    <div class="headerInner clearfix">
        <div class="rightHead clearfix">
            <p class="menuCircle sp"><span></span></p>
            <div class="clearfix langSp pc">
                <ul class="clearfix lstLang f_lapresse">
                    <li class="active"><a href="">EN</a></li>
                    <li><a href="">/ VI</a></li>
                </ul>
            </div>    
            
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
                <li><a href="javascript:void(0)" class="viewCart"><i class="fa fa-shopping-cart" aria-hidden="true"></i>(<span class="numbCart">0</span>)</a></li>
                </ul>
            
        </div>
    </div>
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