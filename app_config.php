<?php
define("APP_URL", "http://heartofdarknessbrewery.com/");
define("APP_PATH", "/home/accroot/public_html/");
define("APP_PATH_WP", "/home/accroot/public_html/hod/");
function getArrUrl($var)
	  {
			$nvar = Array();
			$na = explode("/", $var);
			for($i=0; $i<count($na)-1;$i+=4)
			{
				$nvar["$na[$i]"] = $na[$i+1];
			}
			return $nvar;
	  }
$args = getArrUrl($_GET['args']);
$_SESSION['cart'] = 'true';
?>