<?php
	error_reporting(0);
	$config_db = array(
		'db_host' => 'localhost',
		'db_user' => 'hethongson3da0',
		'db_name' => 'hethongsong_3da0',
		'db_pass' => '5463d3288e5f0e25'
	);
	$vtasystem = mysqli_connect($config_db['db_host'], $config_db['db_user'], $config_db['db_pass'], $config_db['db_name']);
	mysqli_set_charset($vtasystem,"utf8");

	/*$servername = "localhost";
	$username = "hethongson3da0";
	$password = "5463d3288e5f0e25";
	$dbname = "hethongsong_3da0";
		
	$vtasystem = mysqli_connect($servername,$username,$password,$dbname);
		
	if(!$vtasystem){
		die('Ket Noi that bai:'.mysqli_connct_error());
	}*/
	$setting = mysqli_fetch_assoc(mysqli_query($vtasystem, "SELECT * FROM `setting_ht` WHERE `id`='1'"));
	 ?>
