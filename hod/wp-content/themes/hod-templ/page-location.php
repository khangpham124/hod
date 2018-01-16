<?php /* Template Name: Location */ ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
include(APP_PATH."libs/head.php"); 
?>
<link rel="stylesheet" type="text/css" href="<?php echo APP_URL; ?>common/css/slick.css"/>
</head>

<body id="location">
<!--===================================================-->

<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->

<div class="greyBox">
        <div class="inner">
            <h2 class="h2_site">Location</h2>
            <h3 class="sub_h2_site w700">
            <?php echo $post->post_content; ?>
            </h3>        
        
    </div>  
</div>

<div id="map"></div>

<div class="wrapSp">
<p class="btnMore btnIntro f_lapresse"><a href="<?php the_field('send_to_phone'); ?>" target="_blank">send to phone</a></p>
</div>
<div class="txtLocation pc">
    <p class="nameLocation f_lapresse"><span>Heart of Darkness</span> Bar <em>&</em> Restaurant</p>
    <p>31D Ly Tu Trong, Ben Nghe Ward, District 1, HCMC, Vietnam<br>
    0903 017 596</p>
</div>

<div class="wrapSlide">
    <h2 class="f_lapresse">OPEN DAILY FROM <br class="sp">11 AM TO MIDNIGHT</h2>
    <ul id="slider_img" class="clearfix">
        <?php
        if(get_field('slider_image')): 
        while(has_sub_field('slider_image')):
        $image = wp_get_attachment_image_src(get_sub_field('image'),'full');
        ?>
        <li><img src="<?php echo $image[0]; ?>" alt=""></li>
        <?php endwhile;endif; ?>
    </ul>
    
</div>
    

<!--Footer-->
<?php include(APP_PATH."libs/footer.php"); ?>
<!--/Footer-->
<!--===================================================-->

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBV7fW4OF5FqFFlLakpTOvf1Kuq_qHXcqY"></script>
<script type="text/javascript">
            // When the window has finished loading create our google map below
            google.maps.event.addDomListener(window, 'load', init);
        
            function init() {
                // Basic options for a simple Google Map
                // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
                var mapOptions = {
                    // How zoomed in you want the map to start at (always required)
                    zoom: 17,
					scrollwheel: false,
					scaleControl: false,
					draggable: true,
					clickableIcons: false,
                    // The latitude and longitude to center the map (always required)
                    center: new google.maps.LatLng(<?php the_field('cf_positon'); ?>),

                    // How you would like to style the map. 
                    // This is where you would paste any style found on Snazzy Maps.
                   // styles: [{"featureType":"all","elementType":"all","stylers":[{"saturation":-120},{"gamma":0.8}]}]
                };

                // Get the HTML DOM element that will contain your map 
                // We are using a div with id="map" seen below in the <body>
                var mapElement = document.getElementById('map');

                // Create the Google Map using our element and options defined above
                var map = new google.maps.Map(mapElement, mapOptions);

                // Let's also add a marker while we're at it
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(<?php the_field('cf_positon'); ?>),
                    map: map,
					icon: new google.maps.MarkerImage('<?php echo APP_URL; ?>img/find/icon_map.png',null,null, null)
                });
            }
			
</script>
<script src="<?php echo APP_URL; ?>common/js/slick.min.js"></script>
<script>
$(function() {    
$('#slider_img').slick({
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
});
});
</script>

</body>
</html>	