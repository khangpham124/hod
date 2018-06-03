<?php /* Template Name: About */ ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
include(APP_PATH."libs/head.php"); 
?>
<link rel="stylesheet" type="text/css" href="<?php echo APP_URL; ?>common/css/slick.css"/>
</head>

<body id="about">
<!--===================================================-->

<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->

<div id="wrapper">
    <h2 class="h2_site">ABOUT</h2>
    <h3 class="sub_h2_site w700">
    About our CEO John or <span>How the Darkness Descended...</span>
    </h3>
    <div class="innerAbout">
        <?php $main_image = wp_get_attachment_image_src(get_field('main_image'),'full'); ?>
        <p class="imgAbout"><img src="<?php echo $main_image[0]; ?>" alt=""></p>
         
        <div class="txtAbout">
        <div class="part1 clearfix">
            <div class="txt"><?php echo $post->post_content; ?></div>
            <?php $image1 = wp_get_attachment_image_src(get_field('image_1'),'full'); ?>
            <img src="<?php echo $image1[0]; ?>" alt="">
        </div>
            
        <?php if(get_field('slider1')): ?>
        <div class="wrapSlide">
            <h2 class="f_lapresse"><?php the_field('text_slide_1'); ?></h2>
            <ul id="slider_img1" class="clearfix">
                <?php
                while(has_sub_field('slider1')):
                $image = wp_get_attachment_image_src(get_sub_field('image'),'full');
                ?>
                <li><img src="<?php echo $image[0]; ?>" alt=""></li>
                <?php endwhile;?>
            </ul>
        </div>
        <?php endif; ?>    
        
        <div class="part2 clearfix">
            <div class="txt"><?php the_field('dialogue_2'); ?></div>
            <?php $image2 = wp_get_attachment_image_src(get_field('image_2'),'full'); ?>
            <img src="<?php echo $image2[0]; ?>" alt="">
        </div>
            
        <?php if(get_field('slider2')): ?>
        <div class="wrapSlide">
            <h2 class="f_lapresse"><?php the_field('text_slide_2'); ?></h2>
            <ul id="slider_img2" class="clearfix">
                <?php
               while(has_sub_field('slider2')):
                $image = wp_get_attachment_image_src(get_sub_field('image'),'full');
                ?>
                <li><img src="<?php echo $image[0]; ?>" alt=""></li>
                <?php endwhile;?>
            </ul>
        </div>
        <?php endif; ?>    

        <div class="part1 clearfix">
            <div class="txt"><?php the_field('dialogue_3'); ?></div>
            <?php $image2 = wp_get_attachment_image_src(get_field('image_3'),'full'); ?>
            <img src="<?php echo $image2[0]; ?>" alt="">
        </div> 
        <?php if(get_field('slider3')): ?>
        <div class="wrapSlide">
            <h2 class="f_lapresse"><?php the_field('text_slide_3'); ?></h2>
            <ul id="slider_img3" class="clearfix">
               <?php
                while(has_sub_field('slider3')):
                $image = wp_get_attachment_image_src(get_sub_field('image'),'full');
                ?>
                <li><img src="<?php echo $image[0]; ?>" alt=""></li>
                <?php endwhile; ?>
            </ul>
        </div>
        <?php endif; ?>    
            
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
var options = {
  dots: false,
  infinite: true,
  speed: 400,
  autoplay: true,
  arrows:true,
  autoplaySpeed: 2500,
  slidesToShow: 3,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 5,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 767,
      settings: {
        slidesToShow: 1,
        centerMode: true,
        centerPadding: '30px',
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        centerMode: true,
        centerPadding: '20px',
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
   
  ]
};

$(function() {    
$('#slider_img1').slick(options);
$('#slider_img2').slick(options);
$('#slider_img3').slick(options);
});
</script>

</body>
</html>	