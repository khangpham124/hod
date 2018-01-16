<?php
$pagename = str_replace(array('/', '.php', '?s='), '', $_SERVER['REQUEST_URI']);
$pagename = str_replace("wp", '', $_SERVER['REQUEST_URI']);
$pagename = $pagename ? $pagename : 'default';

switch ($pagename) {
    case "aboutus":
		$titlepage = "About us title";
		$desPage = "";
		$keyPage = "";
		$txtH1 = "H1 content for about us";
	break;
	 
    default:
		$titlepage = "Heart of Darkness Craft Brewery | The Best Craft Beer in Saigon, Vietnam";			
		$desPage = "Some people say we make the best craft beer in Saigon/HCMC, Vietnam. Don’t believe them? Come and decide for yourself... Close your eyes and think to yourself right now… When was the last time you went on a real journey?
We’re here to take you on your next true journey… a journey that will revolutionize the way you think of, taste, smell, and see beer. We want to share with you that there are much more, much better choices than mass-produced beer.
In our first 12 months alone, we have brewed over 100 different styles of craft beer. Each and every one of those beers are brewed to the same amazing standard of quality, every single time.";
		$keyPage = "";
		$txtH1 = "Heart of Darkness Craft Brewery in Saigon Vietnam";
}
?>