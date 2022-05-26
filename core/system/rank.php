<div class="col-lg-6"> 
<div class="panel-group"> 
                    <div class="panel panel-default"> 
                      <div class="panel-heading"><b>TOP 10</b> Thành Viên Sử Dụng Nhiều Tiền Nhất <b>Tháng <?php echo $now['mon'];?></b> 
                      </div> 
                        <div class="panel-body"> 
<div class="table-responsive"> 
 <table class="table"> 
                                <thead> 
                                    <tr> 
                                      <th>TOP</th> 
                                      <th>Tên</th> 
                                      <th>Số Tiền Sử Dụng</th> 
                                    </tr> 
                                </thead> 
                              <tbody> 
                        <?php 
                        $i=1; 
            $reqs = mysqli_query($vtasystem, "SELECT doanhthu,username,idfb,kichhoat FROM account WHERE level != 1 AND level !=2 AND kichhoat !=0 ORDER BY doanhthu DESC LIMIT 0,10"); 
            while($ress = mysqli_fetch_assoc($reqs)){ 
            ?> 
              <tr> 
               <td> 
                <b><?php echo $i++; ?></b> 
              </td> 
              <td> 
              <span class="badge bg-red"><?php echo $ress['username']; ?></span> 
                 
              </td> 
              <td> 
              <span class="badge bg-success"><?php echo number_format($ress['doanhthu']);?> VNĐ</span> 
                 
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
                <li><a href="#"><i class="fa fa-circle-o text-red"></i> Bảng Xếp Hạng sẽ được reset sau mỗi tháng.</a></li> 
                <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Các thành viên có số tiền cài đặt với số tiền nhiều TOP 1, TOP 2, TOP 3 sẽ nhận được các phần quà tương đương như sau.</a></li> 
        </ul> 
           </div> 
       </div></div></div>  
<?php 
$infongdung = mysqli_query($vtasystem, "SELECT * FROM `ACCOUNT`"); 
$tongtien = 0; 
while ($getvtadz= mysqli_fetch_array($infongdung)){ 
$tongtien = $tongtien + $getvtadz[vnd]; 
  } 
?>        
<div class="col-lg-12"> 
<div class="panel-group"> 
  <div class="panel panel-default"> 
      <div class="panel-heading"> 
       Thống Kê Hệ Thống</div> 
       <div class="panel-body"> 
       <ul class="nav nav-pills nav-stacked"> 
                <li><a href="#"><i class="fa fa-circle-o text-red"></i>Tổng Tiền Trên Hệ Thống : <b><?php echo number_format($tongtien);?> VNĐ</b></a></li> 
                <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> </a></li> 
                
               
        </ul> 
           </div> 
       </div></div></div>     