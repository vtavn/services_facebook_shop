<?php 
include '../config.php'; 
//mysql_query("DELETE FROM `vip_like` WHERE `id_buy`='812'"); 
//mysql_query("UPDATE `account`SET `sao`='0'"); 
//mysql_query("DELETE FROM `account` WHERE `vnd`='1000' AND `idfb`='4'"); 
//mysql_query("DELETE FROM `account` WHERE `kichhoat`='0'"); 
//mysqli_query($vtasystem, "UPDATE `account`SET `napthe`='0'"); 
//mysqli_query($vtasystem, "UPDATE `account`SET `doanhthu`='0'"); 
//mysqli_query($vtasystem, "UPDATE `account`SET `chinhthuc`='0'"); 
//mysql_query("UPDATE `account`SET `qrcode`='0'"); 
//mysql_query("UPDATE `vip_like`SET `status`='checked' WHERE status = '0'"); 
//mysql_query("UPDATE `account`SET `qrcode`='0'"); 
//mysqli_query($vtasystem, "DELETE FROM `vip_like` WHERE status = '2'"); 
//mysqli_query($vtasystem, "UPDATE `account` SET `idfb`='4' WHERE `idfb` = '0'"); 
//mysqli_query($vtasystem, "DELETE FROM `account` WHERE `vnd`='1000' AND `idfb`='0' AND `idvip`='0'"); 
mysqli_query($vtasystem, "DELETE FROM `vip_cmt` WHERE status = '2'"); 
mysqli_query($vtasystem, "UPDATE `account` SET `level`='0' WHERE `level`='3' AND vnd <= '100000'"); 
//xóa vip bot hết hạn 
$vip = mysqli_query($vtasystem, "SELECT * FROM vip_bot "); 
    while ($row = mysqli_fetch_array($vip)) { 
if(time() < $row['time']){ 
            } else { 
            $update = mysqli_query($vtasystem, "UPDATE vip_bot SET status = 2 WHERE id = '".$row['id']."'"); 
        } 
    } 
mysqli_query($vtasystem, "DELETE FROM `vip_bot` WHERE status = '2'"); 
//end// 
echo '<div class="list1">Cút Địt Cụ Mày OK !</div>'; 
?> 
