<div class="col-lg-12">
 <div class="panel panel-default">
                   <div class="panel-heading">
                             <b><i class="fa fa-gears"></i>  Quản Lý BOT CMT</b>
                        </div>
       <div class="panel-body">
<div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Tên</th>
              <th>Nội dung</th>
              <th>Ảnh</th>
              <th>Live Token</th>
             <th>Hạn Sử Dụng</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tbody>
            <?php
$req = mysql_query("SELECT * FROM `vip_botcmt` WHERE `id_buy`=".$getuser['id']."");
while($res = mysql_fetch_assoc($req)){
$token = $res['access_token'];
$me = json_decode(file_get_contents('https://graph.facebook.com/me?access_token='.$token),true);
$live = '';										if(!$me['id']){
$live = "<button class='btn btn-rounded btn-xs btn-danger'><i class='fa fa-times'></i> <b>Tạm Dừng</b></button>";
}else{											$live = "<button class='btn btn-rounded btn-xs btn-success'><i class='fa fa-check'></i> <b>Hoạt Động</b></button>";
}
                      $noidung = $res['noidung'];
                    if(strripos($res['noidung'], "\n")){
                        $noidung = str_replace("\n", ",", $res['noidung']);
                    }
?>

            <tr>
              
              <td>
                <?php echo $res['name']; ?>
              </td>
              <td>
                <?php echo $res['noidung']; ?>
              </td>
              <td>
			  <img class="media-object img-responsive" style="width: 150px;height: auto;border-radius: 4px;box-shadow: 0 1px 3px rgba(0,0,0,.15);" src="<?php echo $res['linkanh']; ?>" alt="Photo">
                
              </td> 
               <td>
                <?php echo $live; ?>
              </td>
              
              <td>
                <?php echo date("d-m-20y", $res['time']); ?>
              </td>
              <td>
<a href="/index.php?vip=update_vipbot_cmt&edit=<?php echo $res['id']; ?>" data-toggle="tooltip" title="Chỉnh Sửa" class="btn btn-success btn-simple btn-xs"><i style="font-size:15px;" class="fa fa-edit"></i></a>
<a href="/index.php?vip=manager_vipbot_cmt&xoa=<?php echo $res['id']; ?>" data-toggle="tooltip" title="Xóa ID" class="btn btn-danger btn-simple btn-xs"><i style="font-size:15px;" class="fa fa-times"></i></a>
              </td>
            </tr>
            <?php
}
?>
          </tbody>
        </table>
       </div>
    </div>
  </div>
</div>

<?php
if($_GET['xoa']){
$infongdung = mysql_fetch_array(mysql_query("SELECT * FROM `vip_botcmt` WHERE `id` = '".$_GET[xoa]."' LIMIT 1"));
if($infongdung['id_buy'] != $_SESSION['id']){
echo '<meta http-equiv=refresh content="0; URL=/index.php?vip=manager_vipbot_cmt">';
die('<script>alert("Không thể xóa Tài Khoản của người khác!", "Thông báo");</script>');
} else {
mysql_query("DELETE FROM `vip_botcmt` WHERE id ='" . mysql_real_escape_string($_GET[xoa]) . "'");

    //up log
        $timess = time();
        $content = "<b>" .$getuser['username']. "</b> ĐÃ XÓA BOT CMT của ID <b>".$infongdung['user_id'].".</b>";
        mysql_query("INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='BOTCMT',`content`='$content',`time`='".$timess."'");
    //show

echo '<meta http-equiv=refresh content="0; URL=/index.php?vip=manager_vipbot_cmt">';
die('<script>alert("Xóa Thành Công!", "Thông báo");</script>');
exit;
}
}
?>