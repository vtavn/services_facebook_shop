<?php 
include "../config.php"; 
$timess = time(); 
$t = date('H:i:s d/m/Y', $timess); 

mysqli_query($vtasystem, "UPDATE `account` SET `chinhthuc`='1' WHERE `napthe` >= '50000'"); 

echo $t; 
?> 
<title>Thời gian hiện tại là <?php echo $t;?></title> 
  
