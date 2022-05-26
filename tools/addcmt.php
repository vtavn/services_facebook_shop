<?php 
include '../config.php'; 
?> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <meta property="og:site_name" content="detail"/> 
        <meta property="og:url" content=""/> 
        <meta property="og:type" content="website"/> 
        <meta property="og:title" content="VIP PANEL - LỌC TOKEN" /> 
        <title>THÊM TOKEN 2</title> 
        <meta property="og:description" content="" /> 
        <link rel="shortcut icon" href="https://i.imgur.com/h6NWYI8.png"> 
        <meta property="og:image" content="http://i.imgur.com/o6OEfwa.jpg" /> 
    <!-- Bootstrap core CSS     --> 
        <link href="./css/bootstrap.min.css" rel="stylesheet" /> 
    <!-- Animation library for notifications   --> 

    <!--  Light Bootstrap Table core CSS    --> 
    <!--  CSS for Demo Purpose, don't include it in your project     --> 
    <!--     Fonts and icons     --> 
        <!-- Latest compiled and minified CSS --> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> 

<!-- Optional theme --> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"> 

<!-- Latest compiled and minified JavaScript --> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> 

        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> 
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'> 
        <script src='https://www.google.com/recaptcha/api.js?hl=vi'></script> 
</head> 
<br /><br /> <br /> 

<html> 
<body> 
<center> 
<form method="post"> 
<textarea rows="20" cols="100" type="text"  name="intoken" placeholder="Nhập Token vào đây ..."></textarea><br> 
<input class="btn btn-success" name="input2" type="submit" value="Token CMT"></input> 
<a href="index.php" target="_blank"><input type="button" value="Xóa Token DIE" class="btn btn-success"> </input> </a> </p> 

</form> 
</center> 
</body> 
</html> 

<?php 
// 
if(isset($_POST['input2'])){ 

    $token = $_POST['intoken']; 
    $data  = explode("\n", $token); 
    $i=0; 
    $insert = $update = 0; 
    $table='tokencmt'; //Tên Cột Chứa Token Ví Dụ: Likers, token,feri 
    foreach($data as $token){ 
        $token = trim($token); 
        $me = me($token); 
        if($me['id']){ 
            //auto($domain.'?token='.$token); 
            //$i++; 
             if (mysqli_num_rows(mysqli_query($vtasystem, "SELECT `ten` FROM ".$table." WHERE idfb = '" . mysqli_real_escape_string($vtasystem, $me['id']) . "'"))) { 
         mysqli_query($vtasystem, "UPDATE ".$table." SET `token` = '" . mysqli_real_escape_string($vtasystem, $token) . "' WHERE `idfb` = " . $me['id'] . ""); 
         ++$insert; 
      } else { 
        $id = $me['id']; 
        $name = $me['name']; 
 mysqli_query($vtasystem, "INSERT INTO tokencmt(idfb, ten, token, has_used) VALUES ('$id', '$name','$token', '0')"); 
         ++$update; 
      } 

        } 
    } 


//echo '<p>'.$i.' Thành Viên Đã Được Nhập Vào.</p>'; 
echo '<center><p><b style="color:green"> Đã Được INSERT ' . $insert.' Thành Viên .</p>'; 
echo '<br><p> <b style="color:red"> ' . $update.' </b>Thành Viên Đã Được Nhập Vào.</b></p></center>'; 
} 
// 
// 

function me($star){ 
return json_decode(auto('https://graph.facebook.com/me?access_token='.$star),true); 
} 
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

