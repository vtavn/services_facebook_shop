<link rel="stylesheet" href="../../giaodien/toastr.css"> 
<script type="text/javascript" src="../../giaodien/toastr.min.js"></script> 
<?php
error_reporting(0);
session_start(); 
$now = getdate(); 
include '../../config.php'; 
        /**type
        *Viettel : VTT
        *Vinaphone: VNP
        *Gate: GATE
        *MTOP: MTOP
        */
        $mtop_username = "0919257664"; // tên đăng nhập
        $mtop_password = "nhianhbn123"; // mật khẩu
        $mtop_stk = "0839760379"; // số tài khoản
        $TxtCard  = $_POST['key'];
        $TxtMaThe = $_POST['code'];
        $TxtSeri  = $_POST['serial'];
        $users      = $_POST['txtuser']; 
        $result = curl('https://my.mtop.vn/dang-nhap');
        $cookie = getcookie($result[0]);
        $pass = md5($mtop_password);
        $post = "username=$mtop_username&password=$pass";
        $result = curl('https://my.mtop.vn/login',$post,'',$cookie);
        $cookie = getcookie($result[0]);
        $result = curl('https://my.mtop.vn/',false,'',$cookie);
        $result = curl('https://my.mtop.vn/thong-tin-ca-nhan/auth-method',false,'',$cookie);
        $post1 = '{"issuer":"'.$TxtCard.'","cardSerial":"'.$TxtSeri.'","cardCode":"'.$TxtMaThe.'","accountNo":"'.$mtop_stk.'"}';
        $result1 = curl_json('https://my.mtop.vn/giao-dich/nap-tien-bang-the-cao',$post1,'',$cookie);        
        $response = json_decode($result1[1],true);
         
        if($response['code'] == '01') { 
                $info_card = $response['data']['price']; // tiền
                mysqli_query($vtasystem, "UPDATE `account` SET  `vnd` = `vnd` + '".$info_card."', `napthe` = `napthe` + '".$info_card."' WHERE `username`  ='".$users."'"); 
                mysqli_query($vtasystem, "INSERT INTO `log_card` SET `nguoinhan` = '".$users."', `time`='".date("d.m.Y, H:i:s")."', `mathe`='".$TxtMaThe."', `seri`='".$TxtSeri."', `loaithe`='".$TxtCard."', `thang` = '".$now['mon']."', `menhgia`='".$info_card."'"); 
                //up log 
                $timess = time(); 
                $content = "<b>".$users."</b> vừa nạp thẻ ".$TxtCard.". Mệnh giá <b>" . number_format($info_card) . " VNĐ. Tổng thanh toán <b>" . number_format($info_card) . " VNĐ</b>"; 
                mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='NAPTHE',`content`='$content',`time`='".$timess."'"); 
                echo '<script>swal(
                                    "Thông báo!",
                                    "Nạp Thẻ Thành Công!! Mệnh giá ' . number_format($info_card) . ' VNĐ.",
                                    "success"
                                );</script>';
                //echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Nạp thẻ thành công"));
        }
        else {
            $err = isset($response['message']) ? $response['message'] : 'Nạp thẻ không thành công';
            //echo json_encode(array('status' => "error", 'title' => "Lỗi", 'msg' => $err));
                echo '<script>swal(
                        "Thông báo!",
                        "'.$err.'",
                        "error"
                    );</script>';
        }

        function curl($url,$post = false,$ref = '', $cookie = false,$cookies = false,$header = true,$headers = false,$follow = false)
        {
            $ch=curl_init($url);
            if($ref != '') {
                curl_setopt($ch, CURLOPT_REFERER, $ref);
            }
            if($cookie){
            curl_setopt($ch, CURLOPT_COOKIE, $cookie);
            }
            if($cookies)
            {
            curl_setopt($ch, CURLOPT_COOKIEJAR, $cookies);
            curl_setopt($ch, CURLOPT_COOKIEFILE, $cookies);
            }
            if($post){
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_POST, 1);
            }
              curl_setopt($ch, CURLOPT_HEADER, 1);
            if($headers)        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);
            $result[0] = curl_exec($ch);
            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $result[1] = substr($result[0], $header_size);
            curl_close($ch);
            return $result;

        }

        function curl_json($url,$post = false,$ref = '', $cookie = false,$cookies = false,$header = true,$headers = false,$follow = false)
        {
            $ch=curl_init($url);
            if($ref != '') {
                curl_setopt($ch, CURLOPT_REFERER, $ref);
            }
            if($cookie){
            curl_setopt($ch, CURLOPT_COOKIE, $cookie);
            }
            if($cookies)
            {
            curl_setopt($ch, CURLOPT_COOKIEJAR, $cookies);
            curl_setopt($ch, CURLOPT_COOKIEFILE, $cookies);
            }
            if($post){
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_POST, 1);
            }
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_ENCODING, '');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);
            $result[0] = curl_exec($ch);
            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $result[1] = substr($result[0], $header_size);
            curl_close($ch);
            return $result;

        }


        function getcookie($content){
            preg_match_all('/Set-Cookie: (.*);/U',$content,$temp);
            $cookie = $temp[1];
            $cookies = "";
            $a = array();
            foreach($cookie as $c){
                $pos = strpos($c, "=");
                $key = substr($c, 0, $pos);
                $val = substr($c, $pos+1);
                $a[$key] = $val;
            }
            foreach($a as $b => $c){
                $cookies .= "{$b}={$c};";
            }
            return $cookies;
        }

?>