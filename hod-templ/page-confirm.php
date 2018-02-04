<?php /* Template Name: Confirm */ ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
if(!$_SESSION['cart'])  {
header('Location:http://heartofdarknessbrewery.com/');
die();
}
include(APP_PATH."libs/head.php"); 
?>
</head>

<body id="checkout">
<!--===================================================-->

<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->
<div id="wrapper">
    <h2 class="h2_site">Success order</h2>
    <p>Customer : <?php echo $_SESSION['email']; ?></p>
    <p>Order : <?php var_dump($_SESSION['order']); ?></p>
    <p>Order Code : <?php echo $_SESSION['order_code']; ?></p>
    <p>Info : <?php echo $_SESSION['address']; echo $_SESSION['city']; echo $_SESSION['country']; ?></p>
    <p>Payment : <?php echo $_SESSION['payment'] = $_POST['payment']; ?></p>
    <p>Total : <?php echo $_SESSION['grand_total']; ?></p>
<!--Footer-->
<?php include(APP_PATH."libs/footer.php"); ?>
<!--/Footer-->
<!--===================================================-->
</div>
<!--/wrapper-->
<!--===================================================-->

</body>
</html>	