<?php /* Template Name: Account Order */ ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
if($_SESSION['customer']['email']=='') {
    header('Location:http://heartofdarknessbrewery.com/');
    die();
}
include(APP_PATH."libs/head.php");
?>
<!--<meta http-equiv="refresh" content="5; url=<?php echo APP_URL; ?>"> !-->
</head>

<body id="checkout">
<!--===================================================-->

<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->
<div id="wrapper">
    <h2 class="h2_site">Booking Success</h2>
    
    
            <div class='boxThx'>
            <p class='warningTxt'><i class="fa fa-check-circle"></i>Booking successful!</p>
            <p>
            We look forward to the pleasure of having you as our guest.<br> <br>   
Depending on bookings and walk-in traffic, we cannot hold your table longer than 15 minutes past your expected arrival time. Thank you!</p>
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