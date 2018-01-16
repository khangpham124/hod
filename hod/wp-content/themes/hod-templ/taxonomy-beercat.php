<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
include(APP_PATH."libs/head.php"); 
?>
<link rel="stylesheet" href="<?php echo APP_URL; ?>common/css/slick.css">
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
    <?php $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );  ?>
    <div class="rightBeer" id="rightBeer" ng-app="">
        <div id="part1">
        <p class="pc wrapSerch">
        <input type="text" class="search searchInut" id="search1" ng-model="search1" placeholder="Search your favourite beer" />
        <span class="toClick"></span>    
        </p>
        
        <h2 id="flag" class="h2_site">flagship beers<span>always available</span></h2>
        <ul class="lstBeer clearfix listSearch" id="flagSlide">
            <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                query_posts($query_string . '&orderby=post_date&order=desc&posts_per_page=10&paged=' . $paged); 
                if(have_posts()):while(have_posts()) : the_post();
                $thumb = get_post_thumbnail_id($post->ID);
                $img_label = wp_get_attachment_image_src($thumb,'full');
                $img_cup = wp_get_attachment_image_src(get_field('image_beer'),'full');
                $terms = get_the_terms($post->ID, 'beercat');
                foreach($terms as $term) { 
                $termname = $term->name;
                }
            ?>
            <li>
            <p class="thumb">
                <img src="<?php echo $img_label[0]; ?>" class="imgBeer" alt="">
                <img src="<?php echo $img_cup[0]; ?>" class="cupB_sp sp" alt="">
            </p>
            <div class="wrap">
                <div class="inner">
                        <img src="<?php echo $img_cup[0]; ?>" class="cupB" alt="">
                        <div class="info">
                            <p class="nameBeer"><?php the_field('cf_abv'); ?> ABV</p>
                            <p class="subName"><?php the_field('cf_ibu'); ?> IBU</p>
                        </div>    
                        <p class="flag"><span><?php echo $termname; ?></span></p>

                </div>
                <div class="flipCard">
                    <?php echo $post->post_content; ?>
                </div>
            </div>
            </li>
            <?php endwhile;endif; ?>
        </ul>
    <p class="btnMore btnIntro f_lapresse">find our beers near you</p>
    </div>     
        
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
    
</body>
</html>	