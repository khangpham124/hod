<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
include(APP_PATH . '/hod/wp-load.php');
include(APP_PATH."libs/head.php"); 
?>
<link rel="stylesheet" type="text/css" href="<?php echo APP_URL; ?>common/css/easydropdown.css"/>
</head>

<body id="find">
<!--===================================================-->

<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->

<div class="greyBox">
        <div class="inner">
            <h2 class="h2_site">find our beer</h2>
            <h3 class="sub_h2_site">
                Data is based on distributors’ shipments to stores/restaurants/bars in the last 30 days. Before you make a trip, please<br class="pc">
                check with the establishment to confirm availability. If you don’t find locations near you, please reach out to our<br class="pc"> distributor in your area or send us a note. For International customers, please contact our distributors in your country.
            </h3>
            
            <!--
            <ul class="listCountries clearfix f_lapresse pc">
				<li><a href="javascript:void(0)" id="call1">VIETNAM</a></li>
				<li><a href="javascript:void(0)" id="call2">THAILAND</a></li>
                <li><a href="javascript:void(0)" id="call3">SINGAPORE</a></li>
                <li><a href="javascript:void(0)" id="call4">TAIWAN</a></li>
            </ul> !-->
        
            <div class="wrapBox">
            <?php 
                        $n=0;
                        $args=array(
                        'post_type' => 'find',
                        'parent' => 0,
                        'orderby' =>'ID',
                        'order' => 'ASC',
                        'hide_empty' => 0,
                        'taxonomy' => 'findcat',
                        'number' => '0',
                        'pad_counts' => false
                        );
                        $categories = get_categories($args);
                        foreach ( $categories as $category ):
                        $termid = $category->term_id;
                        $n++;
            ?>
            <p class="btnMenu_sp sp" id="menu<?php $n; ?>"><?php echo $category->name; ?></p>
            <div class="tabBox" id="tab<?php echo $n; ?>">
            <div class="clearfix mapPlace">
             <div class="leftStore">
                <select tabindex="5" class="dropdown" data-settings='{"cutOff": 12}' id="tabs<?php echo $n; ?>">
                        <option value="">Province/ City</option>
                        <?php
                            $args1 = array(
                            'post_type' => 'find',
                            'child_of' => $category->term_id,
                            'orderby' =>'ID',
                            'order' => 'ASC',
                            'hide_empty' => 1,
                            'taxonomy' => 'findcat',
                            'number' => '0',
                            'pad_counts' => false
                            );
                            //var_dump($args1);
                            $cate = get_categories( $args1 );
                            foreach ($cate as $cat)
                            {
                            $slug_cate = $cat->slug;
                        ?>
                        <option value="<?php echo $slug_cate ?>" data-load="<?php echo $slug_cate ?>" title="Group <?php echo $slug_cate ?>"><?php echo $cat->name; ?></option>
                        <?php } ?>
                </select>

                 <div class="boxShop">
                  <div id="controls-mixed<?php echo $n; ?>" class="slimscroll"></div>
                 </div>
             </div>

            <div id="gmap-mixed<?php echo $n; ?>"></div>
            </div>
                    
                    <p class="btnMore btnIntro f_lapresse" id="stf" style="margin-bottom:30px"><a href="https://maps.google.com/?q=10.767035,106.692222" target="_blank">send to phone</a></p>
                
                    <ul class="lstCity pc">
                    <?php
                            $args1 = array(
                            'post_type' => 'find',
                            'child_of' => $category->term_id,
                            'orderby' =>'ID',
                            'order' => 'ASC',
                            'hide_empty' => 1,
                            'taxonomy' => 'findcat',
                            'number' => '0',
                            'pad_counts' => false
                            );
                            //var_dump($args1);
                            $cate = get_categories( $args1 );
                            foreach ($cate as $cat)
                            {
                            $slug_cate = $cat->slug;
                    ?> 
                        <li>
                            <h4><?php echo $cat->name; ?></h4>
                            <ul class="clearfix">
                            <?php 
                                $wp_query = new WP_Query();
                                $param=array(
                                'post_type'=>'find',
                                'order' => 'DESC',
                                'posts_per_page' => '-1',
                                'tax_query' => array(
                                array(
                                'taxonomy' => 'findcat',
                                'field' => 'slug',
                                'terms' => $slug_cate
                                )
                                )
                                );
                                $wp_query->query($param);
                                if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                            ?> 
                                <li>
                                <p class="name"><?php the_title() ?></p>
                                <div class="add matchHeight"><?php the_field('cf_address'); ?></div>
                                <a href="<?php the_field('cf_web'); ?>" target="_blank" class="web">Visit website <span>>></span></a>
                                </li>
                            <?php endwhile;endif; ?>    
                            </ul>
                        </li>
                    <?php } ?>    
                    </ul>
                </div>
                <?php endforeach; ?>
            </div> 
        
    </div>
</div>

    
<!--Footer-->
<?php include(APP_PATH."libs/footer.php"); ?>
<!--/Footer-->
<!--===================================================-->

<script>
    $(document).ready(function(){
        $('.btnIntro').click(function() {
            $('.hideTxt').slideToggle('200');
            $(this).toggleClass('active');
        });
        
        $('#tab1').addClass('active');
        $('#call1').parent('li').addClass('active');
		$('.listCountries li').click(function(){
			var elm = $(this).find('a');
			var id_elm = elm.attr('id');
			var id_show = id_elm.substr(id_elm.length - 1);
			$('.tabBox').removeClass('active');
			$('#tab' + id_show).addClass('active');
			$('.listCountries li').removeClass('active');
			$(this).addClass('active');
		});
        
        $('#menu1').addClass('active');
        $('.btnMenu_sp').click(function(){
            var elm = $(this);
            if (elm.next(".tabBox").is(":visible")) {
                $(this).next('.tabBox').slideUp(300);
                $(this).removeClass('active');
            } else {
                $('.tabBox').removeClass('active');
                var sTo = $(this).next('.tabBox').offset().top;
                //$('body,html').animate({scrollTop:sTo},800);
                $(this).next('.tabBox').addClass('active');
                $(this).next('.tabBox').slideDown(300);
                $('.btnMenu_sp').removeClass('active');
                $(this).addClass('active');
            }
		});
        
    });    
</script>

<script type="text/javascript" src="<?php echo APP_URL; ?>common/js/jquery.slimscroll.js"></script>
<script type="text/javascript" src="<?php echo APP_URL; ?>common/js/jquery.easydropdown.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBV7fW4OF5FqFFlLakpTOvf1Kuq_qHXcqY"></script>
<script src="<?php echo APP_URL; ?>common/js/maplace-0.1.3.js"></script>
<?php for($i=0;$i<=4;$i++) { ?>
<script type="text/javascript">
    var maplace<?php echo $i; ?> = new Maplace({
        map_div: '#gmap-mixed<?php echo $i; ?>',
        controls_div: '#controls-mixed<?php echo $i; ?>',
        controls_type: 'list',
        controls_on_map: false
    });

    $('#tabs<?php echo $i; ?>').change(function(e) {
        e.preventDefault();
        var index = $(this).attr('value');
        //alert(index);
        showGroup<?php echo $i; ?>(index);
    });
    
    $('.ullist li').click(function() {
        alert('tes');
    });    

    function showGroup<?php echo $i; ?>(index) {
        var el = $('#g'+index);
        $('#tabs<?php echo $i; ?> li').removeClass('active');
        //$(el).parent().addClass('active');
        $.getJSON('data/ajax<?php echo $i; ?>.php', { type: index }, function(data) {
            //loads data into the map
            maplace<?php echo $i; ?>.Load({
                locations: data.locations,
                view_all_text: data.title,
                type: data.type,
                force_generate_controls: true
            });
        });
    }
    showGroup1('hochiminh');
</script>
<?php } ?>


<script>
     $(function(){
       if($(window).width() > 767) {
        $('.slimscroll').slimScroll({
            height: '450px'
        });
       } else {
        $('.slimscroll').slimScroll({
            height: '200px'
        });  
       }
    });
</script>

</body>
</html>	