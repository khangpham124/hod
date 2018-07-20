<?php
$data = array();
$data['members'] = array(
	0 => array('Jackson','Barbara','27','F','Florida'),
	1 => array('Kimball','Andrew','25','M','Texas'),
	2 => array('Baker','John','28','M','Arkansas'),
	3 => array('Gamble','Edward','29','M','Virginia'),
	4 => array('Anderson','Kimberly','23','F','Tennessee'),
	5 => array('Houston','Franchine','25','F','Idaho'),
	6 => array('Franklin','Howard','24','M','California'),
	7 => array('Chen','Dan','26','M','Washington'),
	8 => array('Daniel','Carolyn','27','F','North Carolina'),
	9 => array('Englert','Grant','25','M','Delaware')
);

//format the data
$formattedData = json_encode($data);

//set the filename
$filename = 'members.json';

//open or create the file
$handle = fopen($filename,'w+');

//write the data into the file
fwrite($handle,$formattedData);

//close the file
fclose($handle);

?>