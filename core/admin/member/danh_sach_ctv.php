
<?php 
if($getuser['level'] != 1) {  
echo '<meta http-equiv=refresh content="0; URL=/index.php">'; 
}else{ 
?> 
    

 <div class="col-md-12"> 
          <div class="box box-success"> 
            <div class="box-header with-border"> 
              <h3 class="box-title">Quản Lý Tài Khoản Đại Lý</h3> 
            </div> 
                    <div class="panel-body"> 

<div class="table-responsive"> 
        <table id="example2" class="table table-bordered table-striped"> 
          <thead> 
            <tr> 
              <th>ID</th> 
              <th>Tài Khoản</th> 
              <th>Tên Hiển Thị</th> 
              <th>Số Lượng ID</th> 
              <th>Tiền</th> 
              <th>ID VIP</th> 
              <th>Doanh Thu Tháng</th> 
              <th>Người Tạo</th> 
              <th>Kích Hoạt</th> 
            </tr> 
          </thead> 
          <tbody> 
            <?php 
            $req = mysqli_query($vtasystem, "SELECT * FROM `account` WHERE `level` = 3"); 
            while($res = mysqli_fetch_assoc($req)){ 
            ?> 
            <tr> 
              <td> 
                <?php echo $res['id']; ?> 
              </td> 
              <td> 
                <a href="http://facebook.com/<?php echo $res['idfb']; ?>" target="_blank" data-toggle="tooltip" title="" style="color:black" data-original-title="Xem Thông Tin"> 
                <?php echo htmlspecialchars($res['username'], ENT_QUOTES, 'UTF-8'); ?> 
                </a> 
              </td> 
              <td> 
                <?php echo $res['fullname']; ?> 
              </td> 
              <td> 
                <?php echo $res['toida']; ?></b> ID  
              </td> 
              <td> 
                <?php echo number_format($res['vnd']); ?> VNĐ 
              </td> 
              <td> 
                <?php echo number_format($res['idvip']); ?> ID 
              </td> 
              <td> 
                <?php echo number_format($res['doanhthu']); ?> VNĐ 
              </td> 
              <td> 
                <?php echo $res['nguoitao']; ?> 
              </td> 
          <td> 
                 <?php if ($res['kichhoat']==0){ ?><span class="label label-danger">Chưa Kích Hoạt</span><?php } ?> 
                 <?php if ($res['kichhoat']==1){ ?><span class="label label-success">Đã Kích Hoạt</span><?php } ?> 
              </td> 
            </tr> 
            <?php } ?> 
          </tbody> 
        </table>    
      </div> 
   </div> 
     </div> 
   </div> 
<?php 
} 
?>