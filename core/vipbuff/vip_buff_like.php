
<script type="text/javascript"> 
    function check(id) { 
        if (confirm('Bạn có chắc chắn muốn xóa VIP ID này ?') == true) { 
            window.location = 'index.php??vtasystem=Auto_Like_Post&xoa=' + id; 
        } else { 
            return false; 
        } 
    } 
</script> 
<?php 
if($getuser['chinhthuc'] != '2') {
echo'<div class="col-lg-12"> 
          <div class="box box-danger"> 
            <div class="box-header with-border"> 
              <h3 class="box-title">BẢO TRÌ!</h3> 
            </div> 
<div class="panel-body"><center> 
<div class="form-group"> 
<p>VIP BUFF LIKE BẢO TRÌ!</p> 
</div> 
<p><strong><a class="btn btn-danger" href="/index.php" target="_blank" title="QUAY LẠI TRANG CHỦ">QUAY LẠI TRANG CHỦ</a></strong></p> 
<p><strong>THÂN CHÀO!</strong></p> 
     </center> </div> 
    </div> 
  </div>'; 
}elseif($getuser['chinhthuc'] != '1') {  
echo'<div class="col-lg-12"> 
          <div class="box box-danger"> 
            <div class="box-header with-border"> 
              <h3 class="box-title">TÀI KHOẢN CHƯA ĐỦ ĐIỀU KIỆN ĐỂ ĐƯỢC TRẢI NGHIỆM</h3> 
            </div> 
<div class="panel-body"><center> 
<div class="form-group"> 
<p>Tài khoản của bạn chưa đủ điều kiện để thử nghiệm vip buzz tại hệ thống!</p> 
<p>Ấn vào nút phía dưới để đăng kí trải nghiệm.</p> 
</div> 
<p><strong><a class="btn btn-danger" href="https://hethongsongao.com/index.php?vip=nap_the" target="_blank" title="ĐĂNG KÝ THUI">ĐĂNG KÝ THUI</a></strong></p> 
<p><strong>THÂN CHÀO!</strong></p> 
     </center> </div> 
    </div> 
  </div>'; 
       } else { 
?> 
<div class="col-lg-12"> 
 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
                             <b><i class="fa fa-gears"></i> Panel Cài Đặt</b> 
                        </div> 
<div class="panel-body"> 
<?php 
if(isset($_POST['submit'])){    
    $token = 'EAAAAUaZA8jlABAPrSI8uVZBS9ZC4VNoOH0SNdA4xfEDZCsaRh00rkWMReue0hiKc2G5vjZAAyqD8cfZALelo7vECL44ZBLJpxht0wkM0dKvqHC3MgElk60l2LnEnK5JwTCyn44N8WqSAchRVH1BjM3pWCOhLZBQCGsYZD'; 
    $id = mysqli_real_escape_string($vtasystem, $_POST['id']); 
    $chuthich = $_POST['chuthich']; 
    $maxlike = intval($_POST['solike']); 
    $checkvip = mysqli_result(mysqli_query($vtasystem, "SELECT COUNT(*) FROM `vip_buff` WHERE `idfb`= '$id' LIMIT 1"),  0); 
    $check = mysqli_result(mysqli_query($vtasystem, "SELECT COUNT(*) FROM `vip_buff` WHERE `user`=".$getuser['id'].""),  0); 
    $facebook = json_decode(file_get_contents('https://graph.fb.me/'.$id.'/likes?summary=true&access_token='.$token),true); 
    $bandau = $facebook['summary']['total_count']; 
    $ketthuc = $bandau + $maxlike; 
    $idbuy = $getuser['id']; 
    $namebuy = $getuser['username']; 
      if($getuser['luotlike'] < $maxlike){ 
        $loi['thieulike'] = '<font color=red>Bạn không đủ số like đã đặt! Vui lòng đặt số nhỏ hơn số like bạn có!</font>'; 
      }elseif($maxlike < '100'){ 
        $loi['gioihan'] = '<font color=red>Số lượng sedding quá ít, vui lòng nhập số lượng sedding nhiều hơn 100!</font>'; 
      }else{ 
        mysqli_query($vtasystem, "UPDATE `account` SET `luotlike`=`luotlike`-'".intval($maxlike)."' WHERE `id`=".$getuser['id'].""); 

        mysqli_query($vtasystem, "INSERT INTO vip_buff(chuthich, idpost, maxlike, id_buy, name_buy, likegoc, likechay, tinhtrang)  
          VALUES ('$chuthich', '$id', '$maxlike', '$idbuy', '$namebuy', '$bandau', '$ketthuc', '0');"); 

        echo '<div class="alert alert-success">Thêm ID VIP Thành công! Chờ like nhảy nha!!</div>'; 
      } 
} 

?>     <form action="index.php?vip=vip_buff_like" method="POST"> 
            <p><strong>Lượt Like Hiện Có : <?php echo number_format($getuser['luotlike']);?> Like.</strong></p> 

            <div class="alert alert-warning hidden"></div> 
                <div class="form-group"> 
                <label>ID Cần Tăng LIKE</label> 
                <input type="number" class="form-control" name="id" placeholder="Nhập id post cần tăng..." required> 
                </div> 
                <div class="form-group"> 
                <label>Số Like Cần Tăng</label> 
                <input type="number" class="form-control" name="solike" placeholder="Số like nhỏ hơn số like bạn có..." required> 
         <?php echo isset($loi['thieulike']) ? $loi['thieulike'] : ''; ?> 
         <?php echo isset($loi['gioihan']) ? $loi['gioihan'] : ''; ?> 
                </div> 
               <div class="form-group"> 
                <label>Nội dung ghi chú</label> 
                <textarea class="form-control" rows="3" name="chuthich" placeholder="Khi chú để nhận biết"></textarea> 
                </div> 
               
               <div class="form-group"> 
      <button type="submit" name="submit" class="btn btn-danger">Cài Like</button> 
               </div> 
             </form> 
        </div> 
        </div> 
         </div> 


<div class="col-lg-12"> 
 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
                             <b><i class="fa fa-gears"></i> Quản Lý ID Của Bạn</b> 
                        </div> 
<div class="panel-body"> 
  <div class="table-responsive"> 
        <table id="example1" class="table table-bordered table-striped"> 
          <thead> 
            <tr> 
              <th>ID POST</th> 
              <th>Giới hạn like</th> 
              <th>Ban Đầu</th> 
              <th>Kết Thúc</th> 
              <th>Tình Trạng</th>  
              <th>Chú thích</th>  
              <th>Hành động</th> 
            </tr> 
          </thead> 
          <tbody> 
           <?php 
$req = mysqli_query($vtasystem, "SELECT * FROM `vip_buff` WHERE `id_buy`=".$getuser['id'].""); 
while($res = mysqli_fetch_assoc($req)){ 
  $id = $res['id']; 
?> 
            <tr> 
              <td> 
                <a href="http://facebook.com/<?php echo $res['idpost']; ?>" target="_blank" data-toggle="tooltip" title="Xem Thông Tin" style="color:black"><b><?php echo $res['idpost']; ?></b></a> 
              </td> 
              <td> 
                <?php echo $res['maxlike']; ?> Like 
              </td> 
              <td> 
        <?php echo $res['likegoc'];?> Like 
              </td> 
              <td> 
           <?php echo $res['likechay']; ?> Like 
              </td> 
              <td>               
                 <?php if ($res['tinhtrang']==0){ ?><span class="label label-success">Đang chạy</span>  
                 <?php } ?> 
                 <?php if ($res['tinhtrang']==1){ ?><span class="label label-primary">Đang dừng</span><?php } ?> 
                 <?php if ($res['tinhtrang']==2){ ?><span class="label label-primary">Chạy xong.!</span><?php } ?> 
              </td> 
         <td> 
           <?php echo $res['chuthich']; ?> 
              </td> 
              <td> 

<a href="index.php?vip=vip_buff_like&xoa=<?php echo $res['id'];?>" class='btn btn-danger' data-toggle="tooltip" title="Xóa ID">Xóa</a> 

              </td> 
            </tr> 
<?php 
if($_GET['xoa']){ 
    $infongdung = mysqli_fetch_array(mysqli_query($vtasystem, "SELECT * FROM `vip_buff` WHERE `id` = '".$_GET['xoa']."' LIMIT 1")); 
    if($infongdung['id_buy'] != $_SESSION['id']){ 
      echo "<meta http-equiv=refresh content='0; URL=/index.php?vip=vip_buff_like'>"; 
      die("<script>alert('Không thể xóa Tài Khoản của người khác'); </script>"); 
    } else { 
      mysqli_query($vtasystem, "DELETE FROM `vip_buff` WHERE `id` = '".$_GET['xoa']."'"); 
      echo "<meta http-equiv=refresh content='0; URL=/index.php?vip=vip_buff_like'>"; 
      die("<script>alert('Xóa Thành Công!!'); </script>"); 
    exit; 
    } 
} 
} 
?> 
          </tbody> 
        </table> 
       </div> 
      </div> 
       </div> 
    </div> 


<?php 
  function load($url){ 
    $ch =  curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
    $duy = curl_exec($ch); 
    return $duy; 
    curl_close($ch); 
  } 

} 
?> 
