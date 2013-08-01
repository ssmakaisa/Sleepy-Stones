<?php

if(!isset($includeMode)){
	require_once("../../../wp-load.php"); 
}


$fromDateArray = explode("/",$_GET['from']);
$toDateArray = explode("/",$_GET['to']);


if(strtotime($fromDateArray[2]."-".$fromDateArray[1]."-".$fromDateArray[0]) >= strtotime($toDateArray[2]."-".$toDateArray[1]."-".$toDateArray[0])){
echo json_encode(array());
die();
}



echo json_encode(searchAccommodation($fromDateArray[2]."-".$fromDateArray[1]."-".$fromDateArray[0],$toDateArray[2]."-".$toDateArray[1]."-".$toDateArray[0]));
