<?php
$url = $_GET['url'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://findmyfbid.com/");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            "url=$url");
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$server_output = curl_exec ($ch);
curl_close ($ch);
echo $server_output;

?>