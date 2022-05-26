
<div class="col-lg-6"> 
<div class="panel-group"> 
                    <div class="panel panel-default"> 
                      <div class="panel-heading"><b>TOP 10</b> Thành viên nạp thẻ nhiều nhất. 
                      </div> 
                        <div class="panel-body"> 
<div class="table-responsive"> 
 <table class="table"> 
                                <thead> 
                                    <tr> 
                                                        <th>TOP</th> 
                                      <th>Tên</th> 
                                      <th>Số Đã Nạp</th> 
                                    </tr> 
                                </thead> 
                              <tbody> 
                        <?php 
                        $i=1; 
            $reqs = mysqli_query($vtasystem, "SELECT napthe,username,idfb,kichhoat FROM account WHERE level != 1 ORDER BY napthe DESC LIMIT 0,10"); 
            while($ress = mysqli_fetch_assoc($reqs)){ 
            ?> 
              <tr> 
               <td> 
                <b><?php echo $i++; ?></b> 
              </td> 
              <td> 
                <?php if($getuser['level'] == '1'){
                 ?>
              <span class="badge bg-red"><?php echo $ress['username'];?></span>
                  <?php }else if($getuser['username'] == $ress['username']){
                    ?>
              <span class="badge bg-red"><?php echo $ress['username'];?></span>
                  <?}else{?>
              <span class="badge bg-red"><?php echo substr($ress['username'],0,5);?>***</span>
                  <?php } ?>
              </td> 
              <td> 
              <span class="badge bg-warning"><?php echo number_format($ress['napthe']);?> VNĐ</span> 
                 
              </td> 
              </tr> 
            <?php } ?> 
                              </tbody> 
                            </table> 
                        </div> 
                    </div></div> 
                    </div> 
    </div> 
<div class="col-lg-6"> 
<div class="panel-group"> 
  <div class="panel panel-default"> 
      <div class="panel-heading"> 
       Thông Báo</div> 
       <div class="panel-body"> 
       <ul class="nav nav-pills nav-stacked"> 
                <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Các thành viên có số tiền cài đặt với số tiền nhiều TOP 1, TOP 2, TOP 3 sẽ nhận được các phần quà tương đương như sau.</a></li> 
                <center><li> <strong>TOP 1: Cộng lại 20% số tiền đã nạp vào tài khoản.</strong></li> 
                <li> <strong>TOP 2: Cộng lại 15% số tiền đã nạp vào tài khoản.</strong></li> 
                <li> <strong>TOP 3: Cộng lại 10% số tiền đã nạp vào tài khoản.</strong></li></center> 
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> PHẦN QUÀ SẼ TRAO VÀO NGÀY CUỐI CÙNG CỦA THÁNG!</a></li> 

        </ul> 
           </div> 
       </div></div></div>  