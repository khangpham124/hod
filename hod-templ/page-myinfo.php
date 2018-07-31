<?php /* Template Name: Account Info */ ?>
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
    <h2 class="h2_site">My Information</h2>
    <div class='boxThx'>
        <form action="<?php echo APP_URL; ?>ajax/updateInfo.php" id="ajaxform" method="POST">
            <label class="labelStep">Fullname</label>
            <input type="text" class="inputBook" name="update_name" required value="<?php if($_SESSION['customer']['fullname']) { echo $_SESSION['customer']['fullname']; } ?>">
            <label class="labelStep">Phone</label>        
            <input type="text" class="inputBook" name="update_phone" required value="<?php if($_SESSION['customer']['phone']) { echo $_SESSION['customer']['phone']; } ?>">
            <label class="labelStep">Email</label>        
            <input type="text" class="inputBook disableInput" name="update_email" disabled required value="<?php if($_SESSION['customer']['email']) { echo $_SESSION['customer']['email']; } ?>">
            <label class="labelStep">Address</label>        
            <input type="text" class="inputBook" name="update_address" value="<?php if($_SESSION['customer']['address']) { echo $_SESSION['customer']['address']; } ?>">
            <label class="labelStep">City</label>        
            <input type="text" class="inputBook" name="update_city" value="<?php if($_SESSION['customer']['city']) { echo $_SESSION['customer']['city']; } ?>">
            <label class="labelStep">Change Password</label>
            <div class="checkBox">
            <input type="password" class="inputBook" name="oldPass" value="" id="oldpass" placeholder="Old Password"><label id="checkPass"></label>
            </div>
            <input type="password" class="inputBook" name="update_password" id="pass" value="" placeholder="New Password">
            <div class="checkBox">
            <input type="password" class="inputBook" name="re_password" id="repass" value="" placeholder="Retype New Password">
            <label id="checkPass3"></label>
            </div>
            <input type="hidden" name="id_customer" value="<?php echo $_SESSION['customer']['id']; ?>">
            <div class="clearfix buttonBook taC">
                <input type="submit" class="btnNext floatR" id="btnSend" value="UPDATE">
            </div>
        </form>
        <p id="simple-msg" class="taC"></p>
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
                        window.location.href = "http://heartofdarknessbrewery.com/account-info/";
					},
					error: function(jqXHR, textStatus, errorThrown) 
					{
						$("#simple-msg").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
					}
				});
				e.preventDefault();
				e.unbind();
			});
	});

    $('#oldpass').on('keyup', function () {
        var old = $(this).val();
        var pass_crr = readCookie('c_pass');
        if(old!=pass_crr) {
            $("#checkPass").html('<i class="fa fa-times-circle"></i>');
        } else {
            $("#checkPass").html('<i class="fa fa-check-circle"></i>');
        }
    });

    $('#repass').on('keyup', function () {
        var repass = $(this).val();
        var pass1 = $('#pass').val();
        if(repass!=pass1) {
            $("#checkPass3").html('<i class="fa fa-times-circle"></i>');
        } else {
            $("#checkPass3").html('<i class="fa fa-check-circle"></i>');
        }
    });    
});
</script>
</body>
</html>	