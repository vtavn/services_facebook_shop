<link rel="stylesheet" href="../../giaodien/toastr.css">
<script type="text/javascript" src="../../giaodien/toastr.min.js"></script>

<?php
include '../../config.php';
$now = getdate();
 function get_curl($url)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);

        $str = curl_exec($curl);
        if(empty($str)) $str = $this->curl_exec_follow($curl);
        curl_close($curl);

        return $str;
    }

 function signature_hash($parnerID, $secreckey,$telco,$serial,$mathe,$tranid)
    {
        return md5($parnerID.'-'.$secreckey.'-'.$telco.'-'.$serial.'-'.$mathe.'-'.$tranid);
    }

$TxtCard = isset($_POST['card_type_id']) ? addslashes(mysql_escape_string($_POST['card_type_id'])) : "";
$TxtMaThe = isset($_POST['txtpin']) ? addslashes(mysql_escape_string($_POST['txtpin'])) : "";
$TxtSeri = isset($_POST['txtseri']) ? addslashes(mysql_escape_string($_POST['txtseri'])) : "";
$users = isset($_POST['txtuser']) ? addslashes(mysql_escape_string($_POST['txtuser'])) : "";

$url = 'http://api.banthe247.com/CardCharge.ashx';
        $url .= '?partnerId=16099';
        $url .= '&telco='.$TxtCard;
        $url .= '&serial='.$TxtSeri;
        $url .= '&cardcode='.$TxtMaThe;
        $transid = rand().'_16099';
        $url .= '&transId='.$transid;
        $url .= '&key='.signature_hash('16099','716481752_75182_D247',$TxtCard,$TxtSeri,$TxtMaThe,$transid);
      
$response = get_curl($url);

$jsondata = json_decode($response, TRUE);


if(empty($TxtMaThe) || empty($TxtSeri)){
    echo '<script>toastr.error("Mã thẻ hoặc số seri không thể trống!!", "Thông báo lỗi");</script>'; 

    exit();
}
if(strlen($TxtMaThe) < 8 || strlen($TxtSeri) < 8 || strlen($TxtMaThe) > 20 || strlen($TxtSeri) > 20){
    echo '<script>toastr.error("Độ dài mã thẻ hoặc số seri không hợp lệ.", "Thông báo lỗi");</script>'; 
    exit();
}
if($jsondata['ResCode'] == 1) {

$cash = $jsondata['Amount']*1000;

mysql_query("UPDATE `account` SET `vnd` = `vnd` + '".$cash."', `napthe` = `napthe` + '".$cash."' WHERE `username`  ='".$users."'");
mysql_query("INSERT INTO `log_card` SET `nguoinhan` = '".$users."', `time`='".date("d.m.Y, H:i:s")."', `mathe`='".$TxtMaThe."', `seri`='".$TxtSeri."', `loaithe`='".$TxtCard."', `thang` = '".$now['mon']."', `menhgia`='".$cash."'");

echo '<script>toastr.success("Nạp Thẻ Thành Công!!", "Thông báo");</script>'; 

}else{
echo '<script>toastr.error("Nạp thẻ không thành công", "Thông báo lỗi");</script>'; 

}

?>