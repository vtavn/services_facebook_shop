<?php
	error_reporting(0);
	$servername = "localhost";
	$username = "hethongson3da0";
	$password = "5463d3288e5f0e25";
	$dbname = "hethongsong_3da0";
		
	$vtasystem = mysqli_connect($servername,$username,$password,$dbname);
		
	if(!$vtasystem){
		die('Ket Noi that bai:'.mysqli_connct_error());
	}
?>
