<?php /* Template Name: About */ ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
include(APP_PATH."libs/head.php"); 
?>
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
        
        <div class="part2 clearfix">
            <div class="txt"><?php the_field('dialogue_2'); ?></div>
            <?php $image2 = wp_get_attachment_image_src(get_field('image_2'),'full'); ?>
            <img src="<?php echo $image2[0]; ?>" alt="">
        </div>


        <div class="part1 clearfix">
            <div class="txt"><?php the_field('dialogue_3'); ?></div>
            <?php $image2 = wp_get_attachment_image_src(get_field('image_3'),'full'); ?>
            <img src="<?php echo $image2[0]; ?>" alt="">
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


</body>
</html>	