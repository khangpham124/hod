<p id="pageTop"><span>back to top</span></p>
<footer id="footer">
   <div class="footerInner">
        
       <div class="contactInfo">
           <h3>CONTACT US</h3>
           <a href="" class="sp btnTel_sp btnFooter">
               <img src="<?php echo APP_URL; ?>common/img/footer/phone_icon_white.svg" alt="">
               <em>If you have any question simply call<br>
                <span>0903 017 596</span>
                </em>
           </a>
           <p class="txtOr sp">or</p>
           <a href="" class="sp btnChat_sp btnFooter f_lapresse"><i class="fa fa-comment" aria-hidden="true"></i>send message</a>
           
           <div class="taC pc">
           <p class="p1"><img src="<?php echo APP_URL; ?>common/img/footer/phone_icon.svg" alt="">
                <span>If you have any question simply call our<br> 
                    emergency number .</span>
           <em>0903 017 596</em>
           </p>
           <p class="p3">or</p>
           <p class="p2"><a href="javascript:void(0)" class="chatFb"><i class="fa fa-comment" aria-hidden="true"></i>SEND MESSAGE</a></p>
           </div>       
       </div>
       <p class="taC pc"><img src="<?php echo APP_URL; ?>common/img/footer/img_footer.png" alt=""></p>
    </div>
</footer>

<div class="footBar clearfix">
    <ul class="lstFoot clearfix f_lapresse">
        <li><a href="<?php echo APP_URL; ?>">HOME</a></li>
        <li><a href="<?php echo APP_URL; ?>location">LOCATION</a></li>
        <li><a href="<?php echo APP_URL; ?>find">find our beer</a>
            <ul class="clearfix sp">
                <li><a href="https://www.facebook.com/heartofdarknessbrewery/"><img src="<?php echo APP_URL; ?>common/img/footer/icon_fb.svg" alt=""></a></li>
                <li><a href="https://www.instagram.com/heart_of_darkness_brewery/"><img src="<?php echo APP_URL; ?>common/img/footer/icon_ins.svg" alt=""></a></li>
                <li><a href="https://goo.gl/U3kvyG"><img src="<?php echo APP_URL; ?>common/img/footer/icon_trip.svg" alt=""></a></li>
                <li><a href=""><img src="<?php echo APP_URL; ?>common/img/footer/icon_gg.svg" alt=""></a></li>
            </ul>
        </li>
    </ul>
    <p class="addHod pc">31D Ly Tu Trong, District 1, HCMC, Vietnam</p>
    <p class="copyright pc">Copyright <span class="f_lapresse">HEART OF DARKNESS VIETNAM</span> Co., Ltd. All Rights Reserved.</p>
</div>

<p class="copyright sp">Copyright <span class="f_lapresse">HEART OF DARKNESS VIETNAM</span> Co., Ltd.<br> All Rights Reserved.</p>

<div class="followBox pc">
    <img src="<?php echo APP_URL; ?>img/top/beer1.png" class="" alt="">
    <p class="f_lapresse txtConn">
    connect<br>with us
    </p>
    <ul class="clearfix lstSs">
        <li><a href="https://www.facebook.com/heartofdarknessbrewery/"><img src="<?php echo APP_URL; ?>common/img/footer/icon_fb.svg" alt=""></a></li>
        <li><a href="https://www.instagram.com/heart_of_darkness_brewery/"><img src="<?php echo APP_URL; ?>common/img/footer/icon_ins.svg" alt=""></a></li>
        <li><a href="https://goo.gl/U3kvyG"><img src="<?php echo APP_URL; ?>common/img/footer/icon_trip.svg" alt=""></a></li>
        <li><a href=""><img src="<?php echo APP_URL; ?>common/img/footer/icon_gg.svg" alt=""></a></li>
    </ul>
</div>

<div class="overlay"></div>
<div class="age_rest">
    <img src="<?php echo APP_URL; ?>common/img/header/logo.svg" alt="">
    <p class="txtAge_desc">
        <span>heart of darkness brewery</span> is <br>committed to responsible drinking. You must be <span>at least 18</span> to enter this site.
    </p>
    <p class="txtAge">
        <span class="floatL ageChose" data-age="up18">I AM 18 OR OLDER</span>
        <span class="floatR ageChose" data-age="under18">I AM UNDER 18</span>
    </p>
</div>

<script src="<?php  echo APP_URL; ?>common/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?php  echo APP_URL; ?>common/js/smoothscroll.js"></script>
<script type="text/javascript" src="<?php  echo APP_URL; ?>common/js/common.js"></script>
<script type="text/javascript" src="<?php  echo APP_URL; ?>common/js/jquery-scrolltofixed.js"></script>
<script type="text/javascript" src="<?php  echo APP_URL; ?>common/js/jquery.matchHeight.min.js"></script>
<script type="text/javascript" src="<?php  echo APP_URL; ?>common/js/biggerlink.js"></script>
<script type="text/javascript" src="<?php  echo APP_URL; ?>common/js/cookies.js"></script>
<script type="text/javascript">
    $(function(){	
        $('.biggerlink li').biggerlink();
        $('#pageTop').click(function(){$('body,html').animate({scrollTop:0},800);});
        $('.matchHeight').matchHeight();
        
        $(window).scroll(function(){
            var sT = $(window).scrollTop();
            var vWrap = $('#wrapper').offset().top;
            var vFoot = $('#pageTop').offset().top;
            var h_btot = $('#pageTop').height();
            var h_foot = $('#footer').height();
            var outFix = h_btot + h_foot + 100;
            var vInfix = vFoot - 450;
            //console.log(vFoot);
            if((sT >= vWrap) && (sT < vInfix)) {
                $(".followBox").addClass("fixedFollow");
            } else if(sT < vWrap) {
                $(".followBox").removeClass("fixedFollow");
            }
        });
        
        $('.menuCircle').click(function() {
            $(this).toggleClass('active');
            $('#menuSP').slideToggle(200);
            $('body').toggleClass('layer');
            if ($('body').hasClass("layer")) {
                $('.menuOver').animate({
                    left: "0"
                }, 300);
            } else {
                $('.menuOver').animate({
                    left: "-100%"
                }, 300);
            }
        });

        $('.closeBtn').click(function() {
            $('#menuSP').slideUp(200);
             $('body').toggleClass('layer');
        });

        $('.hassub').click(function() {
            $(this).find('ul').slideToggle(200);
            $(this).toggleClass('active');
        });
        
        $('.chatFb').click(function() {
            $('#ztb-fbc-show-widget').trigger('click');
        });    

    });
</script>    

<script type="text/javascript">
(function(d,s,id){var z=d.createElement(s);z.type="text/javascript";z.id=id;z.async=true;z.src="//static.zotabox.com/d/1/d1b972bbdf6ee10b0c1e806d3a96699d/widgets.js";var sz=d.getElementsByTagName(s)[0];sz.parentNode.insertBefore(z,sz)}(document,"script","zb-embed-code"));
</script>