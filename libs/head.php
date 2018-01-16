<?php echo('<?xml version="1.0" encoding="UTF-8"?>'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">

<!--responsive or smartphone-->
<meta name="format-detection" content="telephone=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<?php
	// set viewport by user agent.
	require_once 'ua.class.php';
	$ua = new UserAgent();
	if($ua->set() === 'tablet') :
		// set width when you use the tablet
		$width = '1024px';
?>
<meta content="width=<?php echo $width; ?>" name="viewport">
<?php else: ?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
<?php endif; ?>
<!--responsive or smartphone-->
<?php include(APP_PATH."libs/argument.php"); ?>
<title><?php echo $titlepage; ?></title>
<meta name="description" content="<?php echo $desPage; ?>">
<meta name="keywords" content="<?php echo $keyPage; ?>">

<!--facebook-->
<meta property="og:title" content="<?php echo $titlepage; ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo APP_URL; ?>">
<meta property="og:image" content="">
<meta property="og:site_name" content="">
<meta property="og:description" content="<?php echo $desPage; ?>">
<!--/facebook-->

<!--css-->
<link rel="stylesheet" href="<?php echo APP_URL; ?>common/css/base.css?v=<?php echo time() ?>" media="all">
<link rel="stylesheet" href="<?php echo APP_URL; ?>common/css/style.css?v=<?php echo time() ?>" media="all">
<link rel="stylesheet" href="<?php echo APP_URL; ?>common/css/media.css?v=<?php echo time() ?>" media="all">
<!--/css-->

<!--favicons-->
<link rel="icon" href="<?php echo APP_URL; ?>common/img/icon/favicon.ico" type="image/vnd.microsoft.icon">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700&amp;subset=vietnamese" rel="stylesheet">
    
<?php
	//wp_head();
?>
