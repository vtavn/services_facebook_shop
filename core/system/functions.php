<?php 
error_reporting(0); 
//Thông Tin 
$getuser = mysqli_fetch_assoc(mysqli_query($vtasystem, "SELECT * FROM `account` WHERE `id`=".$_SESSION['user']."")); 
$get = mysqli_fetch_assoc(mysqli_query($vtasystem, "SELECT * FROM `thongbao` WHERE `id`='1'")); 
?> 