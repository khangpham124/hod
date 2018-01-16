<?php /* Template Name: Career */ ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
include(APP_PATH."libs/head.php"); 
?>
</head>

<body id="career">
<!--===================================================-->

<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->

<div id="wrapper">
<h2 class="h2_site">CAREER</h2>
    
    <div class="innerCareer greyBox">
        <ul class="listCountries clearfix f_lapresse pc">
			<?php
                $i=0;
                $args=array(
                'post_type' => 'career',
                'child_of' => 0,
                'orderby' =>'ID',
                'order' => 'DESC',
                'hide_empty' => 0,
                'taxonomy' => 'careercat',
                'number' => '0',
                'pad_counts' => false
                );
                $categories = get_categories($args);
                foreach ( $categories as $category ):
                $slug = $category->slug;
                $i++;
            ?>	
            <li><a href="javascript:void(0)" id="call<?php echo $i; ?>"><?php echo $category->name; ?></a></li>
            <?php endforeach; ?>
        </ul>
        
        <?php
                $i=0;
                $args=array(
                'post_type' => 'career',
                'child_of' => 0,
                'orderby' =>'ID',
                'order' => 'DESC',
                'hide_empty' => 0,
                'taxonomy' => 'careercat',
                'number' => '0',
                'pad_counts' => false
                );
                $categories = get_categories($args);
                foreach ( $categories as $category ):
                $slug = $category->slug;
                $term_id = $category->term_id;
                $i++;
        ?>
        <p class="btnMenu_sp sp" id="menu<?php echo $i; ?>"><?php echo $category->name; ?></p>
        <div class="tabBox taC" id="tab1">
            <?php echo desc_cate = get_field( 'desc_career', 'careercat_'.$term_id.'' ); ?>
        </div>
        <?php endforeach; ?>
    </div>
    
    
<!--Footer-->
<?php include(APP_PATH."libs/footer.php"); ?>
<!--/Footer-->
<!--===================================================-->
</div>
<!--/wrapper-->
<!--===================================================-->
<script>
    $(document).ready(function(){
        $('#tab1').show();
        $('#call1').parent('li').addClass('active');
        $('#menu1').addClass('active');
		$('.listCountries li').click(function(){
			var elm = $(this).find('a');
			var id_elm = elm.attr('id');
			var id_show = id_elm.substr(id_elm.length - 1);
			$('.tabBox').fadeOut(300);
			$('#tab' + id_show).fadeIn(300);
			$('.listCountries li').removeClass('active');
			$(this).addClass('active');
		});	
        
        $('.btnMenu_sp').click(function(){
            var elm = $(this);
            if (elm.next(".tabBox").is(":visible")) {
                $(this).next('.tabBox').slideUp(300);
                $(this).removeClass('active');
            } else {
                $(".loadingFood").fadeIn(200).delay(2000).fadeOut(200);
                $('.tabBox').slideUp(300);
                $(this).next('.tabBox').slideDown(300);
                $('.btnMenu_sp').removeClass('active');
                $(this).addClass('active');
            }
		});
        
    });    
</script>

    
</body>
</html>	