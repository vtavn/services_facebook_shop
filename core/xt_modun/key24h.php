
<link rel="stylesheet" href="../../giaodien/toastr.css"> 
<script type="text/javascript" src="../../giaodien/toastr.min.js"></script> 

<?php 
session_start(); 
$now = getdate(); 


include '../../config.php'; 
include 'card_charging_api.php';  
     
        // Api config 
    $config = array(); 
    $config['PartnerID']    = '1514694756'; // Được cung cấp trong mục Tích Hợp API trên KEY24H 
    $config['PartnerKey']   = '46f78f06421b'; // Được cung cấp trong mục Tích Hợp API trên KEY24H  

    // Call lib 
    try { 
        $api = new Card_charging_api($config); 
    } 
    catch (Card_charging_Exception $e) { 
        exit($e->getMessage()); 
    } 

    $users      = $_POST['txtuser']; 
    $key        = $_POST['key']; //loai the cua nha mang 
    $code       = $_POST['code']; // ma the 
    $serial     = $_POST['serial']; //serial the 
    $request_id = time(); //Mã tự sinh trong mỗi giao dịch và không giống nhau (Chúng tôi sẽ lưu lại mã này để đối chiếu khi có khiếu nại) 
     
    $res = $api->check_card($key, $code, $serial, $request_id); 

$getuser = mysqli_fetch_assoc(mysqli_query($vtasystem, "SELECT * FROM `account` WHERE `username`='".$users."'")); 

if(empty($code) || empty($serial)){ 
    echo '<script>toastr.error("Mã thẻ hoặc số seri không thể trống!!", "Thông báo lỗi");</script>';  

    exit(); 
} 
if(strlen($code) < 8 || strlen($serial) < 8 || strlen($code) > 20 || strlen($serial) > 20){ 
    echo '<script>toastr.error("Độ dài mã thẻ hoặc số seri không hợp lệ.", "Thông báo lỗi");</script>';  
    exit(); 
} 

    //thành công 
    if(isset($res->status) && $res->status == '0') 
    { 
        $amount     = $res->amount; //mệnh giá thẻ 
        $key        = $res->key; //Loại thẻ 
        $serial     = $res->serial; //serial 
        $code       = $res->code; //mã thẻ 
        $request_id =  $res->amount; //request_id ma đối tác gửi sang 
        $transid    = $res->transid; //mã giao dịch bên key24h.com 
        
        $getkm = $setting['khuyenmai']; 
        $km = $amount * 20 / 100; 
        $thanhtoan = $km + $amount; 

        //$luotlike = $amount * 5 / 1000; 
        $menhgiathe = number_format($amount);
    mysqli_query($vtasystem, "UPDATE `account` SET  
        `vnd` = `vnd` + '".$thanhtoan."',
        `napthe` = `napthe` + '".$amount."' WHERE `username`  ='".$users."'"); 
    mysqli_query($vtasystem, "INSERT INTO `log_card` SET `nguoinhan` = '".$users."', `time`='".date("d.m.Y, H:i:s")."', `mathe`='".$code."', `seri`='".$serial."', `loaithe`='".$key."', `thang` = '".$now['mon']."', `menhgia`='".$amount."'"); 
    //up log 
    $timess = time(); 
    $content1 = "<b>".$users."</b> vừa nạp thẻ ".$key.". Mệnh giá <b>" . number_format($amount) . " VNĐ. Tổng thanh toán <b>" . number_format($thanhtoan) . " VNĐ</b>"; 
    mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='NAPTHE',`content`='$content1',`time`='".$timess."'"); 
    echo '<script>swal(
                        "Thông báo!",
                        "Nạp Thẻ Thành Công!! Mệnh giá ' . number_format($thanhtoan) . ' VNĐ. Khuyến Mại 20%!",
                        "success"
                    );</script>';
    //echo '<script>toastr.success("Nạp Thẻ Thành Công!! Mệnh giá '.$menhgiathe.' VNĐ.", "Thông báo");</script>';  
    } 
    //có lỗi 
    else 
    { 
        $thongbao = isset($res->message) ? $res->message : 'Nạp Thẻ Không Thành Công'; 
    //echo '<script>toastr.error("'.$thongbao.'", "Thông báo lỗi");</script>';  
    echo '<script>swal(
                        "Thông báo!",
                        "'.$thongbao.'",
                        "error"
                    );</script>';
    } 

       
         
