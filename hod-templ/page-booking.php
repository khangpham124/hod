<?php /* Template Name: Booking */ ?>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/app_config.php');
include(APP_PATH."libs/head.php"); 
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                <li <?php if($_GET['step']=='') { ?>class="active"<?php } ?>><a href="<?php echo APP_URL; ?>booking-now/" id="call1">STEP 1</a></li>
                <li <?php if($_GET['step']==2) { ?>class="active"<?php } ?>><a href="<?php echo APP_URL; ?>booking-now/?step=2" id="call2">STEP 2</a></li>
            </ul>
            <?php if($_GET['step']==2) { ?>
                <?php echo $_POST['time']; ?>
            <?php } else { ?>
            <form action="<?php echo APP_URL; ?>booking-now/?step=2" method="POST">
            <div class="bookingContent">
                <div class="clearfix">
                    <div class="leftBooking">
                        <input type="text" id="datechose" name="datechose">
                        <div id="datepicker"></div>
                    </div>
                    <div class="rigthBooking"></div>
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
            <input type="submit" class="btnNext" value="NEXT">
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
    var dateToday = new Date();  
    $('#datepicker').datepicker({
    inline: true,
    dateFormat: 'dd-mm-yy',
    minDate: dateToday,
    altField: '#datechose'
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
    
    $('#datechose').change(function(){  
        var choseDate = $(this).val();
        alert(choseDate);
        /*
        var currTime = new Date();
        var hour = currTime.getHours();
        var hourText = hour.toString()
        var minutes = currTime.getMinutes();
        var minText = minutes.toString();
        var timeCompText = hourText + minText;
        var timeComp = parseInt(timeCompText);
        
        var currDate =currTime.getDate()+"-"+(currTime.getMonth()+1)+"-"+currTime.getFullYear();

        var compare_chose = Date.parse(choseDate);
        var compare_curr = Date.parse(currDate);
        
        if(compare_chose==compare_curr){
            alert('trong ngay');
        } else if(compare_chose > compare_curr){
            alert('ngay mai');
        }
            $('.labelBook').each(function(){
                var hourLabel = $(this).text();
                var hourLabel_rep = hourLabel.replace(':','');
                var hourComp = parseInt(hourLabel_rep);
                if(hourComp < timeComp) {
                    $(this).addClass('disable');
                }
            }); */
    });    
    
  });
</script>  
</body>
</html>	