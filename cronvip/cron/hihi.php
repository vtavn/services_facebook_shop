<?php
header('Content-Type: text/html; charset=utf-8');// a edut iwr cáu bnaft kyiib cxung đc
require_once '../config.php';
require_once 'fbspeed.class.php';
if($_GET['vip']){
	$req = mysql_query("SELECT * FROM ".$_GET['vip']);
	while($res = mysql_fetch_assoc($req)) {
		echo $res['token'].'<br>';
	}
}
?>