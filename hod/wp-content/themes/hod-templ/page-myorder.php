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
    <h2 class="h2_site">My order</h2>
        <div class='boxThx'>
        <table class="tblCart">
            <thead>
                <td class="detailPro">PRODUCTS</td>
                <td class="detailPro">STATUS</td>
            </thead>
            <tbody>
                <?php
                $wp_query = new WP_Query();
                $param = array (
                    'posts_per_page' => '-1',
                    'post_type' => 'customer_order',
                    'post_status' => 'publish',
                    'order' => 'DESC',
                    'meta_query' => array(
                        array(
                            'key' => 'cf_customer',
                            'value' => $_SESSION['customer']['email'] ,
                            'compare' => '='
                        ))
                );
                $wp_query->query($param);
                if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                ?>
                <tr>
                    <td><?php the_title(); ?></td>
                    <td><?php the_field('paymemnt_status'); ?></td>
                </tr>
                <?php endwhile;endif; ?>
            </tbody>
        </table>    
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