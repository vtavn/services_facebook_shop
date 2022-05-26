
<?php 
header('Content-Type: text/html; charset=utf-8'); 
require_once '../config.php'; 
require_once 'fbspeed.class.php'; 
echo '<pre>'; 
$vip = mysqli_query($vtasystem, "SELECT * FROM vip_cmt WHERE status = 0 ORDER BY RAND() LIMIT 25"); 
if (mysqli_num_rows($vip) === 0) die('Chưa Có Người Dùng'); 
reset_token(); 
if ($vip) { 
    while ($row = mysqli_fetch_array($vip)) { 
        $TOKEN = array(); 
        if (time() < $row['time_buy']+$row['limit_time']*30*86400) { 
            $getPackage = mysqli_fetch_assoc(mysqli_query($vtasystem, "SELECT limit_cmt, limit_post FROM package_vipcmt WHERE id = '".$row['name_package']."' LIMIT 1")); 
            $limitPost = $getPackage['limit_post']; 
            $speedCmt = $row['speed']; 
            $tokens = get_tokens_random(10); 
            while ($token = mysqli_fetch_array($tokens)) { 
                $checkToken = checkToken($token['token']); 
                if ($checkToken == 1) { 
                    $ACCESS_TOKEN = $token['token']; 
                    break; 
                } 
            } 
            $getPost = getPost($row['fbid'], $ACCESS_TOKEN); 
            if ($getPost != 0) { 
                $posts = array(); 
                $count_posts = count($getPost); 
                if ($count_posts > $limitPost) { 
                    for ($i = $count_posts - $limitPost; $i < $count_posts; $i++) { 
                        array_push($posts, $getPost[$i]); 
                    } 
                } else { 
                    $posts = $getPost; 
                } 
                foreach ($posts as $key => $post) { 
                    $limitCmt = $getPackage['limit_cmt']; 
                    $TOKEN = array(); 
                    $post_data = array(); 
                    $comments = array(); 
                    $sttID = $post->id; 
                    $countCmt = $post->comments->data ? count($post->comments->data) : 0; //  
                    $message = $post->message ? $post->message : "NULL"; 
                    if ($countCmt > 0) {  
                        foreach ($post->comments->data as $comment) { 
                            array_push($comments, $comment->message); 
                        } 
                        $comments = array_diff(explode("\n", $row['noidung']), $comments); 
                    } else { 
                        $comments = explode("\n", $row['noidung']); 
                    } 
                    shuffle($comments); 
                    if (preg_match('/#c_\d{1,}/', $message, $match)) { 
                        $rl = str_replace('#c_', '', $match[0]); 
                        if ($rl < $limitCmt) { 
                            $limitCmt = $rl; 
                        } else { 
                            echo 'ID_POST: <b>'.$sttID.'</b>||FBID: <b>'.$row['fbid'].'</b>||FBNAME:<b style="color: blue;">'.$row['name'].'</b>||Số Cmt Yêu Cầu: <b style="color: red;">'.$limitCmt.'</b>||Trạng Thái: <b style="color: red;">HashTag Vượt Quá Số Cmt Cho Phép</b><br />'; 
                        } 
                    } 
                    $cmtConLai = $limitCmt - $countCmt; 
                    if ($cmtConLai < $speedCmt) { 
                        if ($cmtConLai <= 0) { 
                            echo 'ID_POST: <b>'.$sttID.'</b>||FBID: <b>'.$row['fbid'].'</b>||FBNAME:<b style="color: blue;">'.$row['name'].'</b>||Số Cmt Yêu Cầu: <b style="color: red;">'.$limitCmt.'</b>||Trạng Thái: <b style="color: #62e262;">OK</b><br />'; 
                        } else { 
                            echo 'ID_POST: <b>'.$sttID.'</b>||FBID: <b>'.$row['fbid'].'</b>||FBNAME:<b style="color: blue;">'.$row['name'].'</b>||Số Cmt Yêu Cầu: <b style="color: red;">'.$limitCmt.'</b>||Số Cmt Còn Thiếu: <b style="color: red;">'.$cmtConLai.'</b><br />'; 
                            $getTokenCmt = get_tokens_random(ss($cmtConLai, count($comments))); 
                            while ($T = mysqli_fetch_assoc($getTokenCmt)) { 
                                $TOKEN[] = $T['token']; 
                                has_used($T['token']); 
                            } 
                            $post_data = array( 
                                'time_delay' => 1000, 
                                'id' => $sttID, 
                                'arr_message' => $comments, 
                                'access_token' => $TOKEN 
                            ); 
                        } 
                    } else { 
                        echo 'ID_POST: <b>'.$sttID.'</b>||FBID: <b>'.$row['fbid'].'</b>||FBNAME:<b style="color: blue;">'.$row['name'].'</b>||Số Cmt Yêu Cầu: <b style="color: red;">'.$limitCmt.'</b>||Trạng Thái: <b style="color: green;">Đang Chạy...</b><br />'; 
                        $getTokenCmt = get_tokens_random(ss($speedCmt, count($comments))); 
                        while ($T = mysqli_fetch_assoc($getTokenCmt)) { 
                            $TOKEN[] = $T['token']; 
                            has_used($T['token']); 
                        } 
                        $post_data = array( 
                            'time_delay' => 1000, 
                            'id' => $sttID, 
                            'arr_message' => $comments, 
                            'access_token' => $TOKEN 
                        ); 
                    } 
                    if (count($comments) > 0) { 
                        $_Neiht->setType('Auto-Cmt'); 
                        $_Neiht->setPostData($post_data); 
                        $_Neiht->execCurl(); 
                        $response = $_Neiht->getResponse(); 
                        var_dump($response); 
                    } 
                } 
            } 
        }  else { 
            $update = mysqli_query($vtasystem, "UPDATE vip_cmt SET status = 2 WHERE id = '".$row['id']."'"); 
        } 
    } 
} 

function getPost($fbid, $token){ 
    $start_day_time = count_time_to_current_in_day(date("d/m/Y")) - 7200; 
    $getPost = json_decode(file_get_contents('https://graph.facebook.com/' . $fbid . '/feed?fields=id,comments,message&since=' . $start_day_time . '&until=' . time() . '&access_token=' . $token . '&limit=20')); 
        if ($getPost->data[0]->id) { 
            return $getPost->data; 
        } 
        return 0; 
} 
function checkToken($token){ 
    $get = json_decode(file_get_contents('https://graph.facebook.com/me/?access_token='.$token.'&field=id'), true); 
    if ($get['id']) { 
        return 1; 
    } 
    return 0; 
} 
function saveFile($txt){ 
    $file = @fopen('vipCmt.log.txt', 'a+'); 
    @fwrite($file, $txt."\n"); 
    @fclose($file); 
} 
function count_time_to_current_in_day($now){ 
    $date = DateTime::createFromFormat("d/m/Y", $now); 
    $year = $date->format("Y"); 
    $month = $date->format("m"); 
    $day = $date->format("d"); 
    $dt = $day . "-" . $month . "-" . $year . " 00:00:00"; 
    $d = new DateTime($dt, new DateTimeZone('Asia/Ho_Chi_Minh')); 
    return $d->getTimestamp(); 
} 
function get_tokens_random($limit){ 
	global $vtasystem;
    return mysqli_query($vtasystem, "SELECT token FROM tokencmt WHERE has_used = 0 ORDER BY RAND() LIMIT " . $limit); 
} 
function has_used($token){ 
	global $vtasystem;
    return mysqli_query($vtasystem, "UPDATE tokencmt SET has_used = 1 WHERE token = '$token'"); 
} 
function reset_token(){ 
	global $vtasystem;
    $result = mysqli_query($vtasystem, "SELECT id FROM tokencmt WHERE has_used = 0"); 
    if(mysqli_num_rows($result) < 50 ){ 
        return mysqli_query($vtasystem, "UPDATE tokencmt SET has_used = 0"); 
    } 
} 
function ss($a, $b){ 
    if ($a > $b) return $b; 
    elseif ($a < $b) return $a; 
    else return $a; 
} 
?> 
