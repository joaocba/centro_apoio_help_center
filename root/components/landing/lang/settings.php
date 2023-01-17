<?php
session_start();
$langsAllowed=array('pt-pt','en-us');

if(isset($_GET['lang'])===true && in_array($_GET['lang'], $langsAllowed)){
	$_SESSION['flag'] = $_GET['lang'];
	$_SESSION['lang_set'] = '?lang='.$_SESSION['flag'];
}else{
	$_SESSION['flag'] = 'pt-pt';
	$_SESSION['lang_set'] = '?lang=pt-pt';
}

include($_SESSION['flag'].'.php');
?>