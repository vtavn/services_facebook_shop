<?php 
include '../../core/functions.php'; 
include 'func.php'; 
$t = $_REQUEST['t']; 
if ($t === 'add-token') { 
    $arrToken = $_POST['arr_access']; 
    $arrID = $_POST['arr_id']; 
    if(addMultiToken($arrToken, $arrID)){ 
        $return['msg']   = 'Đã Thêm Thành Công '.count($arrToken).' Access Token Vào CSDL'; 
        die(json_encode($return)); 
    } else { 
        $return['error'] = 1; 
        $return['msg']   = 'Đã Xảy Ra Lỗi'; 
        die(json_encode($return)); 
    } 
} 
if ($t === 'add-token-cmt') { 
    $arrToken = $_POST['arr_access']; 
    $arrID = $_POST['arr_id']; 
    if(addMultiTokencmt($arrToken, $arrID)){ 
        $return['msg']   = 'Đã Thêm Thành Công '.count($arrToken).' Access Token Vào CSDL'; 
        die(json_encode($return)); 
    } else { 
        $return['error'] = 1; 
        $return['msg']   = 'Đã Xảy Ra Lỗi'; 
        die(json_encode($return)); 
    } 
} 
if ($t === 'get-token-cmt') { 
    $type = 'tokencmt'; 
    $lol = $_POST['lol']; 
    if ($lol == 'add') { 
        $getToken = getTokenToServercmt('idfb'); 
    } else { 
        $getToken = getTokenToServercmt('token'); 
    } 
    die(json_encode($getToken)); 
}
if ($t === 'del-token-cmt') { 
    $tokenDIE = $_POST['token_die']; 
    if(count($tokenDIE) == 0){ 
        $return['msg']   = 'Bạn Không Có Token DIE Nào'; 
        die(json_encode($return)); 
    } 
    if(delMultiTokencmt($tokenDIE)){ 
        $return['msg']   = 'Đã Xóa Thành Công '.count($tokenDIE).' Access Token DIE'; 
        die(json_encode($return)); 
    } else { 
        $return['error'] = 1; 
        $return['msg']   = 'Đã Xảy Ra Lỗi'; 
        die(json_encode($return)); 
    } 
} 
if ($t === 'get-token') { 
    $type = ($_POST['type']); 
    $lol = $_POST['lol']; 
    if ($lol == 'add') { 
        $getToken = getTokenToServer('idfb'); 
    } else { 
        $getToken = getTokenToServer('token'); 
    } 
    die(json_encode($getToken)); 
} 
if ($t === 'del-token') { 
    $tokenDIE = $_POST['token_die']; 
    if(count($tokenDIE) == 0){ 
        $return['msg']   = 'Bạn Không Có Token DIE Nào'; 
        die(json_encode($return)); 
    } 
    if(delMultiToken($tokenDIE)){ 
        $return['msg']   = 'Đã Xóa Thành Công '.count($tokenDIE).'/3000 Access Token DIE'; 
        die(json_encode($return)); 
    } else { 
        $return['error'] = 1; 
        $return['msg']   = 'Đã Xảy Ra Lỗi'; 
        die(json_encode($return)); 
    } 
} 
    if ($t === 'get_name_package') { 
        die(json_encode(get_package())); 
    } 

    if($t === 'load-log-vip-bot'){ 
        $idUser = $_GET['idUser']; 
        $data = file_get_contents('https://hethongsongao.com/cronhethong/vipBot.log.txt'); 
        $data = explode("\n", $data); 
        $json = array(); 
        for($i=count($data)-2; $i >= 0; $i--){ 
            $value = explode("||", $data[$i]); 
            if ($idUser === $value[1]) { 
                if ($value[5] === 'Cookie Post') { 
                    $a = '<img class="img-circle" src="https://www.fordservicepricepromise.com/img/ford_lodding.gif" width = "30" height="30" /> <a target="_blank" href="https://fb.com/"> ' . $value[6] . '</a>'; 
                } else { 
                    $a = '<img class="img-circle" src="https://graph.facebook.com/' . $value[5] . '/picture?width=30&height=30" /> <a target="_blank" href="https://fb.com/' . $value[5] . '"> ' . $value[6] . '</a>'; 
                } 
                $json[] = array( 
                    '<a target="_blank" href="https://fb.com/' . $value[1] . '"> ' . $value[1] . '</a>', 
                    '<img class="img-circle" src="https://graph.facebook.com/' . $value[1] . '/picture?width=30&height=30" /> <a target="_blank" href="https://fb.com/' . $value[1] . '"> ' . $value[2] . '</a>', 
                    '<a target="_blank" href="https://fb.com/'.$value[3].'"> '.$value[3].'</a>', 
                    $value[4], 
                    $a, 
                    $value[7] 
                ); 
            } 
        } 
        $response = array(); 
        $response['data'] = $json; 
        echo json_encode($response); 
    } 
    if($t === 'notify'){ 
        if (isAdmin() == 0) { 
            $return['error'] = 1; 
            $return['msg']   = 'Nếu Bạn Là Hacker Thì Có Thể :))'; 
            die(json_encode($return)); 
        } 
        $notify = _p($_POST['notify']); 
        _saveNotify($notify.'||'.date("H:i d/m/Y")."\n"); 
        $return['msg'] = 'Đã Tạo Thông Báo Thành Công'; 
        die(json_encode($return)); 
    } 
    if($t === 'create-gift'){ 
        if (isAdmin() == 0) { 
            $return['error'] = 1; 
            $return['msg']   = 'Không Được Đâu Sói Ạ.'; 
            die(json_encode($return)); 
        } 
        $number = _p($_POST['number']); 
        $vnd = _p($_POST['vnd']); 
        $gift = array(); 
        for ($i=0; $i < $number ; $i++) {  
            $creat = create_gift($vnd); 
            if ($creat) { 
                $gift[] = $creat; 
            } 
        } 
        if (count($gift) > 0) { 
            die(json_encode($gift)); 
        } 
    } 
    if ($t === 'load-gift-code') { 
        $gift = get_gift_code(); 
        $data = array(); 
        $long = count($gift); 
        for ($i=0; $i < $long; $i++) { 
            $data[] = array( 
                $gift[$i]['id'], 
                $gift[$i]['gift'], 
                number_format($gift[$i]['vnd']). 'VNĐ', 
                date('H:i d/m/Y', $gift[$i]['time']+(10*24*60*60)), 
            ); 
        } 
        $return = array('data' => $data); 
        die(json_encode($return)); 
    } 
    if ($t === 'gift') { 
        global $vtasystem;
        $gift = _p($_POST['gift']); 
        $vnd = gift($gift); 
        $gioihan = 120; //Tính bằng giây 
        $hientai = time(); 
        $getuser = mysqli_fetch_assoc(mysqli_query($vtasystem, "SELECT * FROM `account` WHERE `id`=".$_SESSION['id']."")); 
        $res = mysqli_query($vtasystem, "SELECT * FROM block WHERE username = '".$getuser['username']."'"); 
        $block = mysqli_fetch_assoc($res,  MYSQLI_ASSOC); 
        $dacho = $hientai - $block['thoigian']; 
        $conlai = $gioihan - $dacho; 
         
        if($conlai > $dacho){ 
            $return['error'] = 1; 
            $return['msg'] = 'Thời Gian Chờ Nhận Gift Tiếp Theo Còn '.$conlai.' Giây!'; 
            die(json_encode($return));     
        }else if($vnd > 0){ 
            $return['error'] = 0; 
            $return['msg'] = 'Bạn Đã Nhận Được '.number_format($vnd).' VNĐ từ mã gift '.$gift; 
            die(json_encode($return)); 
        }else{ 
            $return['error'] = 1; 
            $return['msg']   = 'Mã Gift Không Tồn Tại Hoặc Đã Được Sử Dụng.'; 
            die(json_encode($return)); 
        } 
    } 
    if ($t === 'buff-like') { 
        $sl = _p($_POST['sl']); 
        $getToken = getTokenBySL($sl);  
        if ($getToken) { 
            $return['msg'] = "GET Token Thành Công"; 
            $return['token'] = $getToken; 
            die(json_encode($return)); 
        } else { 
            $return['error'] = 1; 
            $return['msg']   = 'Đã Xãy Ra Lỗi'; 
            die(json_encode($return)); 
        } 
    } 

    if ($t === 'load-member') { 
        if (isAdmin() == 0) { 
            $return['error'] = 1; 
            $return['msg']   = 'Không Được Đâu Sói Ạ.'; 
            die(json_encode($return)); 
        } 
        $mem = get_member(); 
        $data = array(); 
        $long = count($mem); 
        if ($vip !== 0) { 
            for ($i=0; $i < $long; $i++) { 
                $data[] = array( 
                    $mem[$i]['id'], 
                    $mem[$i]['fullname'], 
                    $mem[$i]['username'], 
                    $mem[$i]['mail'], 
                    $mem[$i]['sdt'], 
                    $mem[$i]['vnd'] 
                ); 
            } 
            $return = array('data' => $data); 
            die(json_encode($return)); 
        } 
    } 

    if ($t === 'action-member') { 
        if (isAdmin() == 0) { 
            $return['error'] = 1; 
            $return['msg']   = 'Không Được Đâu Sói Ạ.'; 
            die(json_encode($return)); 
        } 
        $checked = _p($_POST['checked']); 
        $value = _p($_POST['value']); 
        if (action_member($checked, $value)) { 
            if ($checked == 'checked') { 
                $return['error'] = 1; 
                $return['msg'] = 'Tài Khoản Người Dùng Này Đã Bị Tạm Khóa'; 
            } else { 
                $return['msg'] = 'Đã Mở Khóa Cho Tài Khoản Người Dùng Này'; 
            } 
            die(json_encode($return)); 
        } else { 
            $return['error'] = 1; 
            $return['msg']   = 'Đã Xảy Ra Lỗi'; 
            die(json_encode($return)); 
        } 
    } 

    if ($t === 'update-member') { 
        if (isAdmin() == 0) { 
            $return['error'] = 1; 
            $return['msg']   = 'Không Được Đâu Sói Ạ.'; 
            die(json_encode($return)); 
        } 
        $id  = _p($_POST['id']); 
        $fullname = _p($_POST['fullname']); 
        $user = _p($_POST['user']); 
        $email = _p($_POST['email']); 
        $vnd = _p($_POST['vnd']);  
        $sdt = _p($_POST['sdt']); 
        $update = updateMember($id, $fullname, $user, $email, $sdt, $vnd); 
        if ($update) { 
            $return['msg'] = "Chỉnh Sửa Thành Công"; 
            die(json_encode($return)); 
        } else { 
            $return['error'] = 1; 
            $return['msg'] = "Không Thể Chỉnh Sửa"; 
            die(json_encode($return)); 
        } 
    } 
    if ($t === 'load-vip-like') { 
        global $vtasystem;
        $vip = get_vip_like($_SESSION['id']); 
        $data = array(); 
        $long = count($vip); 
        if ($vip !== 0) { 
            for ($i=0; $i < $long; $i++) { 
                $get_package = mysqli_query($vtasystem, "SELECT * FROM package_vip WHERE id = '".$vip[$i]['name_package']."' LIMIT 1"); 
                if ($get_package) { 
                    $package = mysqli_fetch_assoc($get_package); 
                    $maxlike = $package['limit_like']; 
                } 
                $data[] = array( 
                    $vip[$i]['id'], 
                    '<a href="http://facebook.com/'.$vip[$i]['fbid'].'" target="_blank" data-toggle="tooltip" title="" style="color:black" data-original-title="Xem Thông Tin"><b><img class="img-circle" src="https://graph.facebook.com/'.$vip[$i]['fbid'].'/picture?width=15&amp;height=15"></b></a>', 
                    $vip[$i]['fbid'], 
                    $vip[$i]['name'], 
                    ''.$maxlike.' CẢM XÚC', 
                    $vip[$i]['camxuc'], 
                    date('H:i d/m/Y', $vip[$i]['time_buy']+($vip[$i]['limit_time']*30*86400)), 
                    $vip[$i]['speed'], 
                    '<div class="switch"> 
                        <label> 
                            <input type="checkbox" class="btnActionModuleItem" '.$vip[$i]['status'].' value="'.$vip[$i]['id'].'"> 
                            <span class="lever switch-col-light-blue"></span> 
                        </label> 
                    </div>' 
                ); 
            } 
            $return = array('data' => $data); 
            die(json_encode($return)); 
        } 
    } 
    if ($t === 'action-vip-like') { 
        $checked = _p($_POST['checked']); 
        $value = _p($_POST['value']); 
        if (action_vip_like($checked, $value)) { 
            if ($checked == 'checked') { 
                $return['msg'] = 'Đã Kích Hoạt Trở Lại VIP LIKE Cho Người Dùng Này'; 
            } else { 
                $return['error'] = 1; 
                $return['msg'] = 'Đã Tạm Dừng VIP LIKE Cho Người Dùng Này'; 
            } 
            die(json_encode($return)); 
        } else { 
            $return['error'] = 1; 
            $return['msg']   = 'Đã Xảy Ra Lỗi'; 
            die(json_encode($return)); 
        } 
    } 
    if ($t === 'update-vip-like') { 
        $id  = _p($_POST['id']); 
        $fbid = _p($_POST['fbid']); 
        $speed = _p($_POST['speed']); 
        $name = _p($_POST['name']); 
        $camxuc = _p($_POST['camxuc']); 
        $update = updateVipLikeByUser($id, $fbid, $name, $speed, $camxuc); 
        if ($update) { 
            $return['msg'] = "Chỉnh Sửa Thành Công"; 
            die(json_encode($return)); 
        } else { 
            $return['error'] = 1; 
            $return['msg'] = "Không Thể Chỉnh Sửa"; 
            die(json_encode($return)); 
        } 
    } 


    if ($t === 'delete-vip') { 
        global $vtasystem;
        $id = _p($_POST['id']); 
        $type= _p($_POST['type']); 
        $infouser = mysqli_fetch_array(mysqli_query($vtasystem, "SELECT * FROM '$type' WHERE id = '$id' LIMIT 1")); 
        if ($infouser['id_buy'] != $getuser['id']) { 
            $return['error'] = 1; 
            $return['msg']   = 'Bạn không phải chủ uid này!'; 
            die(json_encode($return)); 
        } else { 
            $id = _p($_POST['id']); 
            $type= _p($_POST['type']); 
            if (delete_vip($id,$type)) { 
                $return['msg'] = 'Xóa Thành Công!'; 
                die(json_encode($return)); 
            } 
        }  
    } 
?> 

