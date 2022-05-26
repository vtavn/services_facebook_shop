<?php 
include '../config.php'; 
$gettoken = mysqli_query($vtasystem, "SELECT * FROM `tokencmt` ORDER BY RAND() LIMIT 0,250"); 
  while ($get = mysqli_fetch_array($gettoken)){ 
  $token = $get['token']; 
$check = json_decode(auto('https://graph.facebook.com/me?access_token='.$token),true); 
if($check['id']){ 

echo '<b style="color:green">Acc của tao token live đừng xóa</b></br>'; 
//@mysql_query("DELETE FROM token WHERE token ='".$token."'"); 
//continue; 
} 
else{ 
    echo '<b style="color:red">Die mẹ rồi xóa giùm tao cho nhẹ dữ liệu =))</b></br>'; 
    @mysqli_query($vtasystem, "DELETE FROM tokencmt WHERE token ='".$token."'"); 
} 
} 
echo 'Delete Token Done'; 
function auto($url) { 
   $ch = curl_init(); 
   curl_setopt_array($ch, array( 
      CURLOPT_CONNECTTIMEOUT => 5, 
      CURLOPT_RETURNTRANSFER => true, 
      CURLOPT_URL            => $url, 
      ) 
   ); 
   $result = curl_exec($ch); 
   curl_close($ch); 
   return $result; 
} 
?> 