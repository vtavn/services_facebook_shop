<?php 
if($getuser['level'] != 1) { 
echo '<meta http-equiv=refresh content="0; URL=/index.php">'; 
}else{ 
function count_sys($table){ 
    global $vtasystem;
    $result = mysqli_query($vtasystem, "SELECT id FROM $table"); 
    return mysqli_num_rows($result); 
} 
function count_hethan($table){ 
    global $vtasystem;
    $result = mysqli_query($vtasystem, "SELECT id FROM $table WHERE status = '2'"); 
    return mysqli_num_rows($result); 
} 
function count_tamdung($table){ 
    global $vtasystem;
    $result = mysqli_query($vtasystem, "SELECT id FROM $table WHERE status = '1'"); 
    return mysqli_num_rows($result); 
} 
function count_chay($table){ 
    global $vtasystem;
    $result = mysqli_query($vtasystem, "SELECT id FROM $table WHERE status = 'checked'"); 
    return mysqli_num_rows($result); 
} 

function count_nghi($table){ 
    global $vtasystem;
    $result = mysqli_query($vtasystem, "SELECT id FROM $table WHERE has_used = '1'"); 
    return mysqli_num_rows($result); 
} 

function count_chaytoken($table){ 
    global $vtasystem;
    $result = mysqli_query($vtasystem, "SELECT id FROM $table WHERE has_used = '0'"); 
    return mysqli_num_rows($result); 
} 
?> 
<div class="col-lg-3 col-xs-12"> 
  <!-- small box --> 
  <div class="small-box bg-green"> 
    <div class="inner"> 
      <h3>+ <?php echo number_format(count_chay('vip_like'));?> ID</h3> 

      <p>ID VIP ĐANG CHẠY</p> 
    </div> 
    <div class="icon"> 
      <i class="fa fa-heart" aria-hidden="true"></i> 

    </div> 
    <a href="#" class="small-box-footer"> 
      More info <i class="fa fa-arrow-circle-right"></i> 
    </a> 
  </div> 
</div> 
        <!-- ./col --> 
        <div class="col-lg-3 col-xs-12"> 
          <!-- small box --> 
          <div class="small-box bg-red"> 
            <div class="inner"> 
              <h3>+ <?php echo number_format(count_hethan('vip_like'));?> ID</h3> 

              <p>ID VIP HẾT HẠN</p> 
            </div> 
            <div class="icon"> 
              <i class="fa fa-times" aria-hidden="true"></i> 
            </div> 
            <a href="#" class="small-box-footer"> 
              More info <i class="fa fa-arrow-circle-right"></i> 
            </a> 
          </div> 
        </div> 
        <!-- ./col --> 
        <div class="col-lg-3 col-xs-12"> 
          <!-- small box --> 
          <div class="small-box bg-yellow"> 
            <div class="inner"> 
              <h3>+ <?php echo number_format(count_tamdung('vip_like'));?> ID</h3> 

              <p>ID VIP ĐANG DỪNG</p> 
            </div> 
            <div class="icon"> 
              <i class="fa fa-heartbeat" aria-hidden="true"></i> 
            </div> 
            <a href="#" class="small-box-footer"> 
              More info <i class="fa fa-arrow-circle-right"></i> 
            </a> 
          </div> 
        </div> 
        <!-- ./col --> 
        <div class="col-lg-3 col-xs-12"> 
          <!-- small box --> 
          <div class="small-box bg-red"> 
            <div class="inner"> 
              <h3>+ <?php echo number_format($taikhoans); ?> Tài Khoản</h3> 

              <p>Tổng Số Tài Khoản</p> 
            </div> 
            <div class="icon"> 
              <i class="fa fa-user" aria-hidden="true"></i> 
            </div> 
            <a href="#" class="small-box-footer"> 
              More info <i class="fa fa-arrow-circle-right"></i> 
            </a> 
          </div> 
        </div> 
        <!-- ./col --> 
        <div class="col-lg-3 col-xs-12"> 
          <!-- small box --> 
          <div class="small-box bg-red"> 
            <div class="inner"> 
              <h3>+ <?php echo number_format($botcamxuc); ?> BOT</h3> 

              <p>Tổng Số Người Cài Bot</p> 
            </div> 
            <div class="icon"> 
<i class="fa fa-smile-o" aria-hidden="true"></i> 
            </div> 
            <a href="#" class="small-box-footer"> 
              More info <i class="fa fa-arrow-circle-right"></i> 
            </a> 
          </div> 
        </div> 
        <!-- ./col --> 
        <div class="col-lg-3 col-xs-12"> 
          <!-- small box --> 
          <div class="small-box bg-yellow"> 
            <div class="inner"> 
              <h3>+ <?php echo number_format(count_sys('token'));?></h3> 

              <p>TOKEN HỆ THỐNG</p> 
            </div> 
            <div class="icon"> 
              <i class="fa fa-play" aria-hidden="true"></i> 
            </div> 
            <a href="#" class="small-box-footer"> 
              More info <i class="fa fa-arrow-circle-right"></i> 
            </a> 
          </div> 
        </div> 
        <div class="col-lg-3 col-xs-12"> 
          <!-- small box --> 
          <div class="small-box bg-aqua"> 
            <div class="inner"> 
              <h3>+ <?php echo number_format(count_nghi('token'));?></h3> 

              <p>TOKEN ĐANG NGHỈ</p> 
            </div> 
            <div class="icon"> 
              <i class="fa fa-stop" aria-hidden="true"></i> 
            </div> 
            <a href="#" class="small-box-footer"> 
              More info <i class="fa fa-arrow-circle-right"></i> 
            </a> 
          </div> 
        </div> 
        <!-- ./col --> 
        <div class="col-lg-3 col-xs-12"> 
          <!-- small box --> 
          <div class="small-box bg-green"> 
            <div class="inner"> 
              <h3>+ <?php echo number_format($thunhap); ?></h3> 

              <p><?php echo number_format($tonggiaodich); ?> Giao Dịch Trong Tháng <?php echo $now['mon'];?></p> 
            </div> 
            <div class="icon"> 
              <i class="fa fa-money" aria-hidden="true"></i> 
            </div> 
            <a href="#" class="small-box-footer"> 
              More info <i class="fa fa-arrow-circle-right"></i> 
            </a> 
          </div> 
        </div> 
        <!-- ./col --> 
</div> 
<div class="row"> 
<div class="col-lg-6"> 
<div class="panel-group"> 
                    <div class="panel panel-default"> 
                      <div class="panel-heading"><b>TOP 5</b> Đại Gia Trên Hệ Thống 
                      </div> 
                        <div class="panel-body"> 
<div class="table-responsive"> 
 <table class="table"> 
                                <thead> 
                                    <tr> 
                                      <th>TOP</th> 
                                      <th>Tên</th> 
                                      <th>Số Tiền</th> 
                                    </tr> 
                                </thead> 
                              <tbody> 
                        <?php 
            $i=1; 
      $reqs = mysqli_query($vtasystem, "SELECT vnd,username,idfb,kichhoat,block FROM account WHERE level != 1 AND block != 1 ORDER BY vnd DESC LIMIT 0,5"); 
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
        <span class="badge bg-success"><?php echo number_format($ress['vnd']);?> VNĐ</span> 

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
                      <div class="panel-heading"><b>TOP 5</b> Thành Viên Doanh Thu Cao Nhất 
                      </div> 
                        <div class="panel-body"> 
<div class="table-responsive"> 
 <table class="table"> 
                                <thead> 
                                    <tr> 
                                      <th>TOP</th> 
                                      <th>Tên</th> 
                                      <th>Số Tiền</th> 
                                    </tr> 
                                </thead> 
                              <tbody> 
                        <?php 
            $i=1; 
      $reqss = mysqli_query($vtasystem, "SELECT doanhthu,username,idfb,kichhoat,block FROM account WHERE level != 1 AND block != 1 ORDER BY doanhthu DESC LIMIT 0,5"); 
      while($ress = mysqli_fetch_assoc($reqss)){ 
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
<?php 
$infongdung = mysqli_query($vtasystem, "SELECT * FROM `account` WHERE level != '1' AND vnd != '1000' "); 
$tongtien = 0; 
while ($getvtadz= mysqli_fetch_array($infongdung)){ 
$tongtien = $tongtien + $getvtadz['vnd']; 
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
    </ul> 
           </div> 
       </div></div> 
<?php 
} 
?> 