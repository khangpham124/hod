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
				<li><a href="javascript:void(0)" id="call1">SALES</a></li>
				<li><a href="javascript:void(0)" id="call2">brewery</a></li>
                <li><a href="javascript:void(0)" id="call3">BAR AND RESTAURANT</a></li>
			</ul>
        <p class="btnMenu_sp sp" id="menu1">Sales</p>
        <div class="tabBox taC" id="tab1">
            We are <span>GROWING...FAST!</span><br>
<em>Heart of Darkness</em> is now recruiting a young dynamic fun sales team to join the <em>Dark Army</em> and get out there to sell the beer! Yes, this is for real! you could have a job that involves selling great craft beer to great people and then following up and managing or relationship with those customers.<br><br>
We need young driven hard working but fun people that love craft beer and want to be involved in this dynamic and fun scene.<br>
We are also looking for a sales assistant to help manage all the incoming orders and delivery logistics.<br><br>
The right candidate will have logistics experience be very comfortable working with Excel and data bases. The role requires someone that enjoys working with people and has a major focus on customer service and building strong relationships. Both roles require people with excellent English, a drive to succeed, great people skills and no wish to work in a regular 9-5 job.
If this sound like something that would rock your world then please email <a href="mailto:hopdo@heartofdarknessbrewery.com">hopdo@heartofdarknessbrewery.com</a>
        </div>
        <p class="btnMenu_sp sp" id="menu2">brewery</p>
        <div class="tabBox" id="tab2"></div>
        
        <p class="btnMenu_sp sp" id="menu1">BAR AND RESTAURANT</p>
        <div class="tabBox" id="tab3"></div>
    
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