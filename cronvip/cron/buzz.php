
<title>Cron Ahihi 1</title> 
<?php 
/* 
Source AutoBuff By VTA 10/01/2018 
Cre : _Neiht 2017 
*/ 
include '../config.php'; 
class FbAuto 
{ 
    protected $_url, $_type, $_post_data, $_webpage; 
    public function execCurl() 
    { 
        $data_string = json_encode($this->_post_data);  
        $ch          = curl_init($this->_url . $this->_type); 
        curl_setopt($ch, CURLOPT_POST, 1); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array( 
            'Content-Type: application/json', 
            'Content-Length: ' . strlen($data_string) 
        )); 
        $this->_webpage = curl_exec($ch); 
        curl_close($ch); 
    } 
    public function setURL($url = false) 
    { 
        $this->_url = $url; 
    } 
    public function setType($type = false) 
    { 
        $this->_type = $type; 
    } 
    public function setPostData($data = false) 
    { 
        $this->_post_data = $data; 
    } 
    public function getResponse() 
    { 
        $return = $this->_webpage; 
        $return = json_decode($return); 
        return $return; 
    } 
} 

$token = array(); 
$result = mysqli_query($vtasystem, "SELECT * FROM token ORDER BY RAND() LIMIT 0,50"); 
if ($result) { 
    while ($row = mysqli_fetch_array($result)) { 
        $token[] = $row['token']; 
    } 
} 
$res  = mysqli_query($vtasystem, "SELECT * FROM vip_buff ORDER BY RAND() LIMIT 0,50"); 
while ($post = mysqli_fetch_array($res)) { 
    $maxlike = $post['likechay']; 
    $post_id = $post['idpost']; 
    $countLike = count_react($post_id, 'EAAAAUaZA8jlABAPrSI8uVZBS9ZC4VNoOH0SNdA4xfEDZCsaRh00rkWMReue0hiKc2G5vjZAAyqD8cfZALelo7vECL44ZBLJpxht0wkM0dKvqHC3MgElk60l2LnEnK5JwTCyn44N8WqSAchRVH1BjM3pWCOhLZBQCGsYZD'); // có thể dùng biến $token để get hoặc dùng 1 token cụ thể 
    $tinhtrang = $post['tinhtrang']; 
if($tinhtrang == 2) {  
echo '<b style="color:red">'.$post_id.'</b> - Đã Hết Hạn<br>';    
}else{ 
    if ($countLike <= $maxlike) { 
        $post_data = array( 
            'time_delay' => 100, // thời gian cách nhau giữa 2 lần auto (millisecond) 
            'id' => $post_id, // Đối với Auto Reaction định dạng ID phải là ID USER_ID POST 
            'access_token' => $token // Mảng lưu số token auto. 
        ); 
        $Jurou = new FbAuto; 
        $Jurou->setURL('https://hethongsongao.herokuapp.com/'); //Có dấu "/" ở cuối 
        $Jurou->setType('Auto@Like'); 
        /* 
        setType('AutoLike') -> Auto Like 
        setType('AutoReact') -> Auto Cảm Xúc 
        setType('AutoShare') -> Auto Chia Sẽ 
        setType('AutoSub') -> Auto Theo Dõi 
        setType('AutoAddFriend') -> Auto Kết Bạn 
        */ 
        $Jurou->setPostData($post_data); 
        $Jurou->execCurl(); 
        $response = $Jurou->getResponse(); 
        var_dump($response); 
        delay(1); 
    }else{ 
    $update = mysqli_query($vtasystem, "UPDATE `vip_buff` SET `tinhtrang`='2' WHERE `idpost`='".$post_id."'"); 
} 
} 
} 
function get_post($userID, $token) 
{ 
    $get_post = file_get_contents('https://graph.facebook.com/' . $userID . '/feed?limit=1&access_token=' . $token); 
    $get_post = json_decode($get_post, true); 
    if ($get_post['data'][0]['id']) { 
        return $get_post; 
    } else { 
        return 0; 
    } 
} 
function count_react($post_id, $token){ 
    $get_json = json_decode(file_get_contents('https://graph.facebook.com/'.$post_id.'/likes?summary=true&access_token='.$token),true); 
    if($get_json['summary']['total_count']){ 
        return $get_json['summary']['total_count']; 
    } else { 
        return 0; 
    } 
} 
?> 
