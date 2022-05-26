<?php 
session_start(); 
include '../../config.php'; 
$getuser = mysqli_fetch_assoc(mysqli_query($vtasystem, "SELECT * FROM `account` WHERE `id`=".$_SESSION['id']."")); 

function getTokenBySL($sl) {
    global $vtasystem;
    $token  = array();
    $result = mysqli_query($vtasystem, "SELECT token FROM token ORDER BY RAND() LIMIT $sl");
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $token[] = $row['token'];
        }
    }
    return $token;
}

function addMultiToken($arrToken, $arrID){ //cua e là token k thôi 
    global $vtasystem;
    $sql = array(); 
    for ($i = 0; $i < count($arrToken); $i++) { 
        $sql[] = '(' . ($arrID[$i]) . ', "' . $arrToken[$i] . '")'; 
    } 
    $insert = mysqli_query($vtasystem, 'INSERT INTO token (idfb, token) VALUES '.implode(',', $sql)); 
    if ($insert) return 1; 
    return 0; 
} 
function addMultiTokencmt($arrToken, $arrID){ //cua e là token k thôi 
    global $vtasystem;
    $sql = array(); 
    for ($i = 0; $i < count($arrToken); $i++) { 
        $sql[] = '(' . ($arrID[$i]) . ', "' . $arrToken[$i] . '")'; 
    } 
    $insert = mysqli_query($vtasystem, 'INSERT INTO tokencmt(idfb, token) VALUES '.implode(',', $sql)); 
    if ($insert) return 1; 
    return 0; 
} 
function getTokenToServercmt($type) { 
    global $vtasystem;
    $token  = array(); 
    $result = mysqli_query($vtasystem, "SELECT $type FROM token ORDER BY RAND()");  
    if ($result) { 
        while ($row = mysqli_fetch_assoc($result)) { 
            $token[] = $row[$type]; 
        } 
    } 
    return $token; 
} 
function delMultiTokencmt($tokendie) { 
    global $vtasystem;
    foreach ($tokendie as $key => $value) { 
        mysqli_query($vtasystem, "DELETE FROM tokencmt WHERE token = '$value'"); 
    } 
    return 1; 
} 
//add vào thử 
function getTokenToServer($type) { 
    global $vtasystem;
    $token  = array(); 
    $result = mysqli_query($vtasystem, "SELECT $type FROM token ORDER BY RAND() LIMIT 3000");  
    if ($result) { 
        while ($row = mysqli_fetch_assoc($result)) { 
            $token[] = $row[$type]; 
        } 
    } 
    return $token; 
} 
function delMultiToken($tokendie) { 
    global $vtasystem;
    foreach ($tokendie as $key => $value) { 
        mysqli_query($vtasystem, "DELETE FROM token WHERE token = '$value'"); 
    } 
    return 1; 
} 
function get_package(){ 
     global $vtasystem;
   $return = array(); 
    $result = mysqli_query($vtasystem, "SELECT * FROM package_vip"); 
    if (mysqli_num_rows($result) > 0){ 
        while ($row = mysqli_fetch_assoc($result)) { 
            $return[] = $row; 
        } 
        return $return; 
    } 
    return 0; 
} 
function isAdmin(){ 
    global $vtasystem;
    if ($_SESSION['id'] == 1) return 1; 
    return 0; 
} 
function checklogin(){
    if(isset($_SESSION['user'])){
        return true;
    }else{
        return false;
    }
}

function _saveNotify($txt){ 
    global $vtasystem;
    $file = @fopen('notify.txt', 'a+'); 
    @fwrite($file, $txt); 
    @fclose($file); 
} 
function _p($t) {
    //$t = addslashes($t);
    //$t = stripslashes($t);
    return $t;
}
function create_gift($vnd){ 
    global $vtasystem;
    $gift = generateRandomString(); 
    $result = mysqli_query($vtasystem, "INSERT INTO gift_code (gift, vnd, `time`) VALUES ('$gift', '$vnd', '".time()."')"); 
    //up log 
    $getuser = mysqli_fetch_assoc(mysqli_query($vtasystem, "SELECT * FROM `account` WHERE `id`=".$_SESSION['id']."")); 
    $timess = time(); 
    $nguoitao = $getuser['username']; 
    $content = "<b>".$nguoitao."</b> vừa thêm tạo mã gift <b>".$gift."</b>. Mệnh giá <b>" . number_format($vnd) . " VNĐ</b>"; 
    $result = mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$_SESSION['id']."', `type`='GIFT',`content`='$content',`time`='".$timess."'"); 
            //end 
    if ($result) return $gift; 
    return 0; 
} 
function get_gift_code(){ 
    global $vtasystem;
    $return = array(); 
    $result = mysqli_query($vtasystem, "SELECT * FROM gift_code"); 
    if (mysqli_num_rows($result) > 0){ 
        while ($row = mysqli_fetch_assoc($result)) { 
            $return[] = $row; 
        } 
        return $return; 
    } 
} 
function generateRandomString($length = 10) { 
    global $vtasystem;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $charactersLength = strlen($characters); 
    $randomString = ''; 
    for ($i = 0; $i < $length; $i++) { 
        $randomString .= $characters[rand(0, $charactersLength - 1)]; 
    } 
    return strtoupper($randomString); 
} 
function gift($gift){ 
    global $vtasystem;
    $result = mysqli_query($vtasystem, "SELECT * FROM gift_code WHERE gift = '$gift' LIMIT 1"); 
    if (mysqli_num_rows($result) > 0) { 
        $gift = mysqli_fetch_assoc($result); 
        $gioihan = 120; //Tính bằng giây 
        $hientai = time(); 
        $res = mysqli_query($vtasystem, "SELECT * FROM block WHERE username = '".$getuser['username']."'"); 
        $block = mysqli_fetch_assoc($res,  MYSQLI_ASSOC); 
        $dacho = $hientai - $block['thoigian']; 
        $conlai = $gioihan - $dacho; 
        $getUser = getUser($_SESSION['id']); 
        updateVNDUser($getUser['vnd'] + $gift['vnd']); 
        $getgift = mysqli_fetch_assoc(mysqli_query($vtasystem, "SELECT * FROM `gift_code` WHERE `id` = ".$gift['id']."")); 
        $getuser = mysqli_fetch_assoc(mysqli_query($vtasystem, "SELECT * FROM `account` WHERE `id`=".$_SESSION['id']."")); 
        //up log 
        $result = mysqli_query($vtasystem, "DELETE FROM `block` WHERE `username` = '".$getuser['username']."'"); 
        $result = mysqli_query($vtasystem, "INSERT INTO `block` SET `username` = '".$getuser['username']."', `thoigian` = '".$hientai."'"); 
        $timess = time(); 
        $nguoitao = $getuser['username']; 
        $magiftt = $getgift['gift']; 
        $content = "<b>".$nguoitao."</b> vừa nhận được mã gift <b>".$magiftt."</b>. Mệnh giá <b>" . number_format($gift['vnd']) . " VNĐ</b>"; 
        $result = mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$_SESSION['id']."', `type`='GIFT',`content`='$content',`time`='".$timess."'"); 
            $del_gift = mysqli_query($vtasystem, "DELETE FROM gift_code WHERE id = '".$gift['id']."'"); 
                //end 
        if ($result) return $gift['vnd']; 
        } 
        return 0; 
} 
function getUser($id){ 
    global $vtasystem;
    $result = mysqli_query($vtasystem, "SELECT * FROM account WHERE id = '$id' LIMIT 1"); 
    $row    = mysqli_fetch_assoc($result); 
    return $row; 
} 
function updateVNDUser($newVND){ 
    global $vtasystem;
    $result = mysqli_query($vtasystem, "UPDATE account SET vnd = '$newVND' WHERE id = '".$_SESSION['id']."'"); 
    if($result) { 
        $_SESSION['vnd'] = $newVND; 
        return 1; 
    } 
    return 0; 
} 

function updateMember($id, $fullname, $user, $email, $sdt, $vnd) { 
    global $vtasystem;
    $update = mysqli_query($vtasystem, "UPDATE account SET fullname = '$fullname', username = '$user', mail = '$email', sdt = '$sdt', vnd = '$vnd' WHERE id = '$id'"); 
    if ($update) { 
        return 1; 
    } 
    return 0; 
} 
function get_member() { 
    global $vtasystem;
    $return = array(); 
    $result = mysqli_query($vtasystem, "SELECT * FROM account"); 
    if (mysqli_num_rows($result) > 0) { 
        while ($row = mysqli_fetch_assoc($result)) { 
            $return[] = $row; 
        } 
        return $return; 
    } 
} 
function updateVipLikeByUser($id, $fbid, $name, $speed, $camxuc) { 
    global $vtasystem;
    $update = mysqli_query($vtasystem, "UPDATE vip_like SET fbid = '$fbid', name = '$name', speed = '$speed', camxuc = '$camxuc' WHERE id = '$id'"); 
    if ($update) { 
        return 1; 
    } 
    return 0; 
} 
function action_vip_like($checked, $value) { 
    global $vtasystem;
    $result = mysqli_query($vtasystem, "UPDATE vip_like SET status = '$checked' WHERE id = '$value'"); 
    if ($result) 
        return 1; 
    return 0; 
} 
function get_vip_like($id_buy) { 
    global $vtasystem;
    $return = array(); 
    if ($id_buy == '1') { 
        $result = mysqli_query($vtasystem, "SELECT * FROM vip_like"); 
    } else { 
        $result = mysqli_query($vtasystem, "SELECT * FROM vip_like WHERE id_buy = '$id_buy'"); 
    } 
    if (mysqli_num_rows($result) > 0) { 
        while ($row = mysqli_fetch_assoc($result)) { 
            $return[] = $row; 
        } 
        return $return; 
    } 
} 
function delete_vip($id, $type) { 
    global $vtasystem;
    $result = mysqli_query($vtasystem, "DELETE FROM $type WHERE id = '$id'"); 
    if ($result) 
        return 1; 
    return 0; 
} 
//function isMEM($id, $type){ 
//$infouser = mysql_fetch_array(mysql_query("SELECT * FROM $type WHERE id = '$id' LIMIT 1")); 
    //if ($infouser['id_buy'] == $_SESSION['id']) return 1; 
    //return 0; 
//} 
?> 
