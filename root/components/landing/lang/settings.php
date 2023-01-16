<?php
session_start();
$langsAllowed=array('pt-pt','en-us');

if(isset($_GET['lang'])===true && in_array($_GET['lang'], $langsAllowed)){
	$_SESSION['flag'] = $_GET['lang'];
}else{
	$_SESSION['flag'] = 'pt-pt';
}

include($_SESSION['flag'].'.php');
session_destroy();
?>