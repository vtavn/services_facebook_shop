
<title>Cron vip bot token 2002</title> 
<?php 
require_once '../config.php'; 
$date = date("d/m/Y H:i:s"); 
$result = mysqli_query($vtasystem, "SELECT * FROM vip_bot WHERE status = 0 ORDER BY RAND() LIMIT 20"); 
if (mysqli_num_rows($result) === 0) die('Chưa có người dùng'); 
echo '<pre>'; 
$arrReact = ['LIKE', 'LOVE', 'HAHA', 'WOW', 'SAD', 'ANGRY']; 
while ($getpu = mysqli_fetch_assoc($result)) { 
$token= $getpu['token']; 
$camxuc= $getpu['camxuc']; 
$gioihan = $getpu['gioihan'] + '1'; 
$getid = json_decode(file_get_contents('https://graph.facebook.com/v2.4/me/home?fields=comments{reactions.limit(1).summary(true)},reactions.limit(1).summary(true),from,type&limit='.$gioihan.'&access_token='.$token),true); 
if(count($getid['data']) == 0) 
{ 
$cookie= $getpu['cookie']; 
$url = curl("https://www.facebook.com/profile.php",$cookie); 
    if(preg_match('#access_token:"(.+?)"#is',$url, $_puaru)) 
    { 
        $token = $_puaru[1]; 
         mysqli_query($vtasystem,  
         "UPDATE  
            `vip_bot` 
         SET 

            `token` = '" . $token . "' 
            WHERE 
            `id` = " . $getpu['id'] . " 
      "); 
         
         $getid = json_decode(file_get_contents("https://graph.facebook.com/v2.4/me/home?field=id&limit=".$gioihan."&access_token=".$token),true); 
    } 
    else 
    { 
         mysqli_query($vtasystem,  
         "UPDATE  
            `vip_bot` 
         SET 

            `status` = '3' 
            WHERE 
            `id` = " . $getpu['id'] . " 
      "); 
    } 

     
} 
for($i=0;$i<count($getid['data']); $i++) 
{ 
$idstt = $getid['data'][$i]['id']; 
$idu = explode("_", $idstt); 

if(!file_exists("log/".$getpu['idfb']."_" . $idstt.".txt") && $idu[0] < 100999999999999){ 
    if($camxuc == "LIKE") 
    { 
$ketqua = post_data("https://graph.facebook.com/v2.4/$idstt/likes?access_token=$token","debug=all&format=json&method=post&pretty=0&suppress_http_code=1"); 
    } 
    else if($camxuc == "random") 
    { 
    $camxuc = $arrReact[array_rand($arrReact)]; 
    $ketqua = post_data("https://graph.facebook.com/v2.4/$idstt/reactions?access_token=$token","debug=all&format=json&method=post&pretty=0&suppress_http_code=1&type=".$camxuc); 
}else{ 
$ketqua = post_data("https://graph.facebook.com/v2.4/$idstt/reactions?access_token=$token","debug=all&format=json&method=post&pretty=0&suppress_http_code=1&type=".$camxuc); 
} 

if (strpos($ketqua, 'true') !== false)  
{ 
        $ketqua = 'Da Tha Tim'; 
        mysqli_query($vtasystem,  
         "UPDATE  
            `vip_bot` 
         SET 

            `solanchay` = `solanchay` + '1' 
            WHERE 
            `id` = " . $getpu['id'] . " 
      "); 
    } 
    else 
    { 
        $ketqua = 'Loi'; 
    } 
    echo $ketqua." - ".$idstt."<br>"; 
saveFile($getpu['name_buy'].'||'.$getpu['idfb'].'||'.$getpu['name'].'||'. $idstt.'||'. $camxuc.'||'.$date."\n"); 
file_put_contents("log/".$getpu['idfb']."_" . $idstt.".txt", $ketqua); 
} 
} 
} 

$vips = mysqli_query($vtasystem, "SELECT * FROM vip_bot "); 
    while ($row = mysqli_fetch_array($vips)) { 
if(time() < $row['time']){ 
            } else { 
            $update = mysqli_query($vtasystem, "UPDATE vip_bot SET status = 2 WHERE id = '".$row['id']."'"); 
        } 
    } 

function saveFile($id){ 
    $file = @fopen('vipBot.log.txt', 'a+'); 
    @fwrite($file, $id); 
    @fclose($file); 
} 
function curl($url,$cookie) 
{ 
    $ch = @curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url); 
    $head[] = "Connection: keep-alive"; 
    $head[] = "Keep-Alive: 300"; 
    $head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7"; 
    $head[] = "Accept-Language: en-us,en;q=0.5"; 
    curl_setopt($ch, CURLOPT_USERAGENT, 'Opera/9.80 (Windows NT 6.0) Presto/2.12.388 Version/12.14'); 
    curl_setopt($ch, CURLOPT_ENCODING, ''); 
    curl_setopt($ch, CURLOPT_COOKIE, $cookie); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, $head); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 60); 
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60); 
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array( 
        'Expect:' 
    )); 
    $page = curl_exec($ch); 
    curl_close($ch); 
    return $page; 
}  
function post_data($site,$data){ 
    $datapost = curl_init(); 
    $headers = array("Expect:"); 
    curl_setopt($datapost, CURLOPT_URL, $site); 
    curl_setopt($datapost, CURLOPT_TIMEOUT, 40000); 
    curl_setopt($datapost, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36'); 
    curl_setopt($datapost, CURLOPT_POST, TRUE); 
    curl_setopt($datapost, CURLOPT_POSTFIELDS, $data);     
    curl_setopt($datapost, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($datapost, CURLOPT_SSL_VERIFYHOST, FALSE); 
    curl_setopt($datapost, CURLOPT_SSL_VERIFYPEER, FALSE);     
    curl_setopt($datapost, CURLOPT_FOLLOWLOCATION, TRUE); 
    ob_start(); 
    return curl_exec ($datapost); 
    ob_end_clean(); 
    curl_close ($datapost); 
    unset($datapost);  
}   
?> 

