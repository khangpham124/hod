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
<meta property="og:url" content="<?php echo $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>">
<meta property="og:image" content="<?php echo $img_og; ?>">
<meta property="og:site_name" content="Heart of Darkness Craft Brewery">
<meta property="og:description" content="<?php echo $desPage; ?>">
<!--/facebook-->

<!--css-->
<link rel="stylesheet" href="<?php echo APP_URL; ?>common/css/base.css" media="all">
<link rel="stylesheet" href="<?php echo APP_URL; ?>common/css/style.css?v=<?php echo time(); ?>" media="all">
<link rel="stylesheet" href="<?php echo APP_URL; ?>common/css/media.css?v=<?php echo time(); ?>" media="all">
<!--/css-->

<!--favicons-->
<link rel="icon" href="<?php echo APP_URL; ?>common/img/icon/favicon.ico" type="image/vnd.microsoft.icon">
<link rel="apple-touch-icon" href="<?php echo APP_URL; ?>common/img/icon/apple-touch-icon.png" />
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo APP_URL; ?>common/img/icon/apple-touch-icon-57x57.png" />
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo APP_URL; ?>common/img/icon/apple-touch-icon-72x72.png" />
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo APP_URL; ?>common/img/icon/apple-touch-icon-76x76.png" />
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo APP_URL; ?>common/img/icon/apple-touch-icon-114x114.png" />
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo APP_URL; ?>common/img/icon/apple-touch-icon-120x120.png" />
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo APP_URL; ?>common/img/icon/apple-touch-icon-144x144.png" />
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo APP_URL; ?>common/img/icon/apple-touch-icon-152x152.png" />
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo APP_URL; ?>common/img/icon/apple-touch-icon-180x180.png" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700&amp;subset=vietnamese" rel="stylesheet">