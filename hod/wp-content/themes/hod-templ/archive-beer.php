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
    
    <div class="rightBeer" id="rightBeer" ng-app="">
        <div id="part1">
        <p class="pc wrapSerch">
        <input type="text" class="search searchInut" id="search1" ng-model="search1" placeholder="Search your favourite beer" />
        <span class="toClick"></span>    
        </p>
        
        <h2 id="flag" class="h2_site">flagship beers<span>always available</span></h2>
        <ul class="lstBeer clearfix listSearch" id="flagSlide">
            <?php
                $wp_query = new WP_Query();
                $param=array(
                'post_type'=>'beer',
                'posts_per_page' => '-1',
                'tax_query' => array(
                array(
                'taxonomy' => 'beercat',
                'field' => 'slug',
                'terms' => 'flagship-beer'
                )
                )
                );
                $wp_query->query($param);
                if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
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
                            <p class="nameBeer"><?php the_field('cf_abv'); ?> ABV</p><span class="sp_ib">-</span>
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
    <p class="btnMore btnIntro f_lapresse"><a href="<?php echo APP_URL; ?>find/">find our beers near you</a></p>
    </div>    
    <div id="part2">
        
    <h2 id="season" class="h2_site mt120">seasonals<span>currently on tap</span></h2>
        <ul class="lstBeer clearfix listSearch" id="seasonSlide">
        <?php
                $wp_query = new WP_Query();
                $param=array(
                'post_type'=>'beer',
                'posts_per_page' => '-1',
                'tax_query' => array(
                array(
                'taxonomy' => 'beercat',
                'field' => 'slug',
                'terms' => 'seasonal'
                )
                )
                );
                $wp_query->query($param);
                if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                $thumb = get_post_thumbnail_id($post->ID);
                $img_label = wp_get_attachment_image_src($thumb,'full');
                $img_cup = wp_get_attachment_image_src(get_field('image_beer'),'full');
                $terms = get_the_terms($post->ID, 'beercat');
                foreach($terms as $term) { 
                $termname = $term->name;
                }
        ?>
        <li class="<?php if($img_label=='') { ?>no_label<?php } else { ?> matchHeight<?php } ?>" >
            <?php if(($img_label!='')&&($img_cup!='')) { ?>
            <p class="thumb">
                <img src="<?php echo $img_label[0] ; ?>" class="imgBeer" alt="">
                <img src="<?php echo $img_cup[0]; ?>" class="cupB_sp sp" alt="">
            </p>
            <?php } ?>
            <div class="wrap">
                <div class="inner">
                    <img src="<?php echo thumbCrop($img_cup[0],0,250); ?>" class="cupB" alt="">
                        <div class="info">
                            <?php if($img_label=='') { ?>
                            <p class="titleBeer matchHeight"><?php the_title(); ?></p>
                            <p class="nameBeer"><?php the_field('cf_abv'); ?> ABV - <?php the_field('cf_ibu'); ?> IBU</p>
                            <?php } else { ?>
                            <p class="nameBeer"><?php the_field('cf_abv'); ?> ABV</p><span class="sp_ib">-</span>
                            <p class="subName"><?php the_field('cf_ibu'); ?> IBU</p>
                            <?php } ?>
                        </div>
                        <p class="flag"><span><?php echo $termname; ?></span></p>
                    
                </div>
                <div class="flipCard"><?php echo $post->post_content; ?></div>
            </div>
        </li>
        <?php endwhile;endif; ?>
    </ul>
        <p class="btnMore btnIntro f_lapresse"><a href="<?php echo APP_URL; ?>find/">find our beers near you</a></p>
    </div>    
        
    </div>
    </div>
</div>

<div class="boxBeerPage">
    <div class="inner clearfix">
        <div class="rightBeer">
            <h2 id="bottles" class="h2_site">bottles<span>Coming soon</span></h2>
            <ul class="listFeature clearfix listSearch" id="bottlesSlide">
                <?php
                $wp_query = new WP_Query();
                $param=array(
                'post_type'=>'beer',
                'posts_per_page' => '-1',
                'tax_query' => array(
                array(
                'taxonomy' => 'beercat',
                'field' => 'slug',
                'terms' => 'bottles'
                )
                )
                );
                $wp_query->query($param);
                if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                $thumb = get_post_thumbnail_id($post->ID);
                $img_label = wp_get_attachment_image_src($thumb,'full');
                $img_bottle = wp_get_attachment_image_src(get_field('image_bottle_beer'),'full');
                $terms = get_the_terms($post->ID, 'beercat');
                foreach($terms as $term) { 
                $termname = $term->name;
                }
                ?>
                <li>
                    <p class="listFeature__thumb">
                        <img src="<?php echo $img_bottle[0]; ?>" class="img_bottle" alt="">
                        <img src="<?php echo $img_label[0]; ?>" class="img_label" alt="">
                    </p>
                    <div class="pa1">
                    <div class="pa2">
                    <div class="pa3">    
                        <p class="listFeature__name nameBeer"><a href="" style="color:<?php the_field('color_title'); ?>"><?php the_title(); ?></a></p>
                        <div class="listFeature__desc matchHeight subName">
                        <?php the_field('cf_abv'); ?> ABV - <?php the_field('cf_ibu'); ?> IBU - <?php the_field('cf_volume'); ?>ml
                        </div>
                    </div>
                    </div>
                    </div>
                    <?php if(get_field('price')) { ?>
                    <p class="listFeature__price">VND <?php the_field('price'); ?></p>
                    <?php } ?>
                    <!-- <a href="" class="listFeature__btn">add to cart</a> !-->
                </li>
                <?php endwhile;endif; ?>
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
            var title_val = $(this).find('.titleBeer');
            var n = name_val.text().toLowerCase();
            var s = sub_val.text().toLowerCase();
            var t = title_val.text().toLowerCase();
            var q1 = n.indexOf(search);
            var q2 = s.indexOf(search);
            var q3 = t.indexOf(search);
            
            if((q1 >= 0)||(q2 >= 0)||(q3 >= 0)) {
                parent.addClass('still');
                $('.ready').css('display','none');
            }
        });
    });
        
    $('.lstBeer li').click(function() {
        $(this).find('.wrap').toggleClass('flipped');
    });
    
    $(window).scroll(function(){
            var sT = $(window).scrollTop();
        console.log(sT);
            var vWrap = $('#wrapper').offset().top;
            var p_season = $('#season').offset().top;
            var p_bottles = $('#bottles').offset().top;
            var act_season  = p_season - 200;
            var act_bottles  = p_bottles - 250;
        
            if((sT > 60)) {
               $(".tabBeer").css("transform", 'translate3d(0px, 0px, 0px)');
               $(".tabBeer").addClass('fixed');
            } else {
               $(".tabBeer").css("transform", 'none');
               $(".tabBeer").removeClass('fixed');
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
    });
    
    
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
          customPaging: function (slider, i) {
            console.log(slider);
            return (i + 1) + '/' + slider.slideCount;
        },
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        dots: true ,
        customPaging: function (slider, i) {
            console.log(slider);
            return (i + 1) + '/' + slider.slideCount;
        },
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