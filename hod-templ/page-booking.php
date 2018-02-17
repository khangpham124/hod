<?php /* Template Name: Booking */ ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
require_once(APP_PATH."ajax/recaptchalib.php");
include(APP_PATH."libs/head.php"); 
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body id="booking">
<!--===================================================-->

<!--===================================================-->
<!--Header-->
<?php include(APP_PATH."libs/header.php"); ?>
<!--/Header-->

<div id="wrapper">
    <h2 class="h2_site">BOOKING</h2>
    <div class="greyBox bookingBox">
            <ul class="listCountries clearfix f_lapresse pc">
                <li <?php if($_GET['step']=='') { ?>class="active"<?php } ?>><a href="<?php echo APP_URL; ?>booking/" id="call1">STEP 1</a></li>
                <li <?php if($_GET['step']==2) { ?>class="active"<?php } ?>><a href="<?php echo APP_URL; ?>booking/?step=2" id="call2">STEP 2</a></li>
            </ul>
            <?php if(($_GET['step']==2)&&($_POST['time']!='')) { ?>   
                <p class="btnMenu_sp sp"><a href="<?php echo APP_URL; ?>booking/?step=2">STEP 1</a></p>
                <p class="btnMenu_sp sp active"><a href="<?php echo APP_URL; ?>booking/?step=2">STEP 2</a></p>
                <form action="<?php echo APP_URL; ?>book_confirm/" id="ajaxform" method="POST">
                <div class="summaryBox">
                    <p class="titleSum">BOOKING SUMMARY</p>
                    <div class="wrapSum">
                    <table class="tblSum">
                        <tr>
                            <th>GUEST(S):</th>
                            <td><?php echo $_POST['guests']; ?></td>
                        </tr>
                        <tr>
                            <th>KID(S):</th>
                            <td><?php echo $_POST['kids']; ?></td>
                        </tr>
                        <tr>
                            <th>DATE:</th>
                            <td><?php echo $_POST['datechose']; ?></td>
                        </tr>
                        <tr>
                            <th>TIME:</th>
                            <td><?php echo $_POST['time']; ?></td>
                        </tr>
                    </table>
                    </div>
                </div>
            <div class="bookingContent">        
            <label class="labelStep">Fullname*</label>
            <input type="text" class="inputBook" name="book_name" required value="<?php if($_SESSION['customer']['fullname']) { echo $_SESSION['customer']['fullname']; } ?>">
            <label class="labelStep">Phone*</label>        
            <input type="text" class="inputBook" name="book_phone" required value="<?php if($_SESSION['customer']['phone']) { echo $_SESSION['customer']['phone']; } ?>">
            <label class="labelStep">Email*</label>        
            <input type="text" class="inputBook" name="book_email" required value="<?php if($_SESSION['customer']['email']) { echo $_SESSION['customer']['email']; } ?>">
            <!--<label class="labelStep">Message</label> 
            <textarea name="book_message" class="textAreaBook"></textarea> !-->
            
            <div class="g-recaptcha mt30" data-sitekey="6LfMFEYUAAAAABgON63tzlMcRpI2HwY-kmL0tw1h"></div>
            <?php 
                $secret = "6LfMFEYUAAAAABgON63tzlMcRpI2HwY-kmL0tw1h";
                // empty response
                $response = null;
                // check secret key
                $reCaptcha = new ReCaptcha($secret);
                if ($_POST["g-recaptcha-response"]) {
                    $response = $reCaptcha->verifyResponse(
                        $_SERVER["REMOTE_ADDR"],
                        $_POST["g-recaptcha-response"]
                    );
                }
            ?>    
            </div>    
                    <input type="hidden" name="date" value="<?php echo $_POST['datechose']; ?>">
                    <input type="hidden" name="time" value="<?php echo $_POST['time']; ?>">
                    <input type="hidden" name="guests" value="<?php echo $_POST['guests']; ?>">
                    <input type="hidden" name="kids" value="<?php echo $_POST['kids']; ?>">
                    <input type="hidden" name="action" value="send">
                    <div class="clearfix buttonBook">
                        <a href="javascript:void(0)" class="btnBack_book floatL">BACK</a>
                        <input type="submit" class="btnNext floatR" id="btnSend" value="CONFIRM">
                    </div>
            </form>
            <p id="simple-msg" class="taC"></p>
            <?php } else { ?>
            <p class="btnMenu_sp sp active"><a href="<?php echo APP_URL; ?>booking/?step=2">STEP 1</a></p>
            <p class="btnMenu_sp sp"><a href="<?php echo APP_URL; ?>booking/?step=2">STEP 2</a></p>
            <form action="<?php echo APP_URL; ?>booking/?step=2" method="POST">
            <div class="bookingContent">
                <div class="clearfix">
                    <div class="leftBooking">
                        <input type="text" id="datechose" name="datechose" value="">
                        <div id="datepicker"></div>
                    </div>
                    <div class="rigthBooking flex_sp">
                        <div class="bookGuys">    
                            <label class="guyBook">GUEST(S)</label>
                            <div class="numbers-row clearfix">
                                <div class='inc button cal' rel='+' ><i class="fa fa-caret-up" aria-hidden="true"></i></div>
                                <div class='dec button cal' id='dec'><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                                <input type="text" class="qtyBook" name="guests" readonly  value="1">
                            </div> 
                        </div>

                        <div class="bookGuys">
                            <label class="guyBook">KID(S)</label>
                            <div class="numbers-row clearfix">
                                <div class='inc button cal' rel='+' ><i class="fa fa-caret-up" aria-hidden="true"></i></div>
                                <div class='dec button cal' id='dec'><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                                <input type="text" class="qtyBook" name="kids" readonly  value="0"> 
                            </div>
                        </div>
                    </div>
                </div>
                <p class="txtBooking">Please pick a time:</p>
                <div class="radioBox">
                    <?php
                    $i=0;      
                    while(has_sub_field('schedule')):
                    $stt = get_sub_field('status');
                    $i++;
                    ?>
                    <input type="radio" name="time" value="<?php echo get_sub_field('time'); ?>" id="time<?php echo $i; ?>" class="radioBook">
                    <label for="time<?php echo $i; ?>" class="labelBook <?php if($stt=='Full') { ?>disable<?php } ?>"><?php echo get_sub_field('time'); ?></label>
                    <?php endwhile; ?>
                </div>
                
            </div>
            <div class="buttonBook">
            <input type="submit" class="btnNext" value="NEXT">
                </div>    
            </form>    
            <?php } ?>
    </div>

<!--Footer-->
<?php include(APP_PATH."libs/footer.php"); ?>
<!--/Footer-->
<!--===================================================-->
</div>
<!--/wrapper-->
<!--===================================================-->

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    var currTime = new Date();  
    var hour = currTime.getHours();
    var hourText = hour.toString()
    var minutes = currTime.getMinutes();
    var minText = minutes.toString();
    var timeCompText = hourText + minText;
    var timeComp = parseInt(timeCompText);
    $('.labelBook').each(function(){
            var hourLabel = $(this).text();
            var hourLabel_rep = hourLabel.replace(':','');
            var hourComp = parseInt(hourLabel_rep);
            var hourComp_real = hourComp - 100;
            if( hourComp_real < timeComp) {
                $(this).addClass('disable');
            }
    });
      
    var dateToday = new Date();  
    $('#datepicker').datepicker({
    inline: true,
    dateFormat: 'd-m-yy',
    minDate: dateToday,
    altField: '#datechose',
    onSelect: function (date) {
        var currTime = new Date();
        var currDate =currTime.getDate()+"-"+(currTime.getMonth()+1)+"-"+currTime.getFullYear();
        var choseDate = $(this).val();
        if(choseDate==currDate) {
            var hour = currTime.getHours();
            var hourText = hour.toString()
            var minutes = currTime.getMinutes();
            var minText = minutes.toString();
            var timeCompText = hourText + minText;
            var timeComp = parseInt(timeCompText);  
            $('.labelBook').each(function(){
                var hourLabel = $(this).text();
                var hourLabel_rep = hourLabel.replace(':','');
                var hourComp = parseInt(hourLabel_rep);
                var hourComp_real = hourComp - 100;
                if( hourComp_real < timeComp) {
                    $(this).addClass('disable');
                }
            });        
        } else {
            $('.labelBook').removeClass('disable');
        }
    }
    });

    $('#datechose').change(function(){
        $('#datepicker').datepicker('setDate', $(this).val());
    });
      
    $('.labelBook').each(function(){
        $(this).click(function(){
            $('.labelBook').removeClass('selected');    
            $(this).addClass('selected');
        });
    });    
  });
</script>

<script>
$(document).ready(function(){
    $(document).bind("contextmenu",function(e){
        e.preventDefault();
    });

    $("#btnSend").click(function()
		{
			$("#ajaxform").submit(function(e)
			{
				$("#simple-msg").html("<img src='<?php echo APP_URL; ?>common/img/other/load.gif' alt=''>");
				var postData = $(this).serializeArray();
				var formURL = $(this).attr("action");
				$.ajax(
				{
					url : formURL,
					type: "POST",
					data : postData,
					success:function(data, textStatus, jqXHR) 
					{
                        window.location.href = "http://heartofdarknessbrewery.com/booking/success/";
					},
					error: function(jqXHR, textStatus, errorThrown) 
					{
						$("#simple-msg").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
					}
				});
				e.preventDefault();	//STOP default action
				e.unbind();
			});
	});
});
</script>

</body>
</html>	