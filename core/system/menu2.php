        <div id="vtasystemnoti" class="modal fade" role="dialog"> 
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal">&times;</button> 
                <h4 class="modal-title"><center><strong>Thông Báo Mới</strong></center></h4> 
            </div> 
            <div class="modal-body"> 
                        <span class="h4"> 
                            <?php $xinchao = $getsetting['nguyennhan'];  
                             echo $xinchao; ?> 
                        </span> 
            </div> 
                    <div class="modal-footer"> 
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button> 
                    </div> 
                </div> 

            </div> 
        </div> 
<style type="text/css">
    .profile-user-img-vta {
    margin: 0 auto;
    /*width: 100px;*/
    padding: 3px;
    border: 3px solid #dd4b39;
}
</style>
    <?php 
if($getuser['mk2'] == 'e10adc3949ba59abbe56e057f20f883e') {  
                echo'<div class="col-md-12"> 
               <div class="alert alert-danger alert-dismissible"> 
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> 
                <h4><i class="icon fa fa-ban"></i> Bảo mật cao!</h4> 
                Chúng tôi yêu cầu bạn đổi mật khẩu cấp 2 để bảo mật tài khoản. Vui Lòng Click <a href="index.php?vip=change_pass_2" type="button" class="btn btn-success btn-xs">ĐỔI MẬT KHẨU</a>! Hãy dành ra 1 Phút để đổi mật khẩu tăng bảo mật cho tài khoản! 
              </div></div>';} 

if($getuser['vnd'] <= 50000) {  
echo'<div class="col-md-12"> 
               <div class="alert alert-danger alert-dismissible"> 
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> 
                <h4><i class="icon fa fa-ban"></i> Alert!</h4> 
                Tài Khoản Của Bạn Sắp Hết Tiền! Nạp Tiền Để Sử Dụng. <a href="index.php?vip=nap_the" type="button" class="btn btn-primary btn-xs">NẠP TIỀN LUÔN</a> 
              </div></div>';} 
               
              if($getuser['idfb'] == 4) {  
                echo'<div class="col-md-12"> 
               <div class="alert alert-danger alert-dismissible"> 
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> 
                <h4><i class="icon fa fa-ban"></i> Alert!</h4> 
                Tài Khoản Chưa Cập Nhập Thông Tin Chính Sác Vui Lòng Click <a href="index.php?vip=change_info" type="button" class="btn btn-success btn-xs">ĐỔI THÔNG TIN</a>! Trong Vòng 24h Không cập nhập HỆ THỐNG TỰ ĐỘNG XÓA TÀI KHOẢN CỦA BẠN! VÀ SẼ KHÔNG NHẬN ĐƯỢC TIỀN BỒI THƯỜNG! 
              </div></div>';} 
?> 
<div class="row"> 
<div class="col-lg-12"> 
<div class="col-md-4"> 
<div class="box box-danger">
            <div class="box-body box-profile">
              <img class="profile-user-img-vta img-responsive img-circle" alt="<?php echo $getuser['fullname']; ?>" src="https://graph.facebook.com/<?php echo $getuser['idfb'];?>/picture?type=large">

              <h3 class="profile-username text-center"><?php if($getuser['level'] == '4'){ echo '<a href="#"><font color="red">'.$getuser['fullname'].' </font></a>';}else{ 
                    echo '<a href="#"><font color="red">'.$getuser['fullname'].'</font></a>';}?> - <?php if($getuser['level'] == '1'){ echo "<font color='red'>ADMIN</font>";}elseif($getuser['level'] == '2'){ echo "<font color='#00a65a'>ĐẠI LÝ</font>";}elseif($getuser['level'] == '3'){ echo "<font color='#3c8dbc'>CTV</font>";}elseif($getuser['level'] == '4'){echo "<font color='red'>VIP MEMBER <i class='fa fa-star fa-spin' aria-hidden='true'></i></font>";}else{echo"Khách VIP";} ?></h3>

              <p class="text-muted text-center">@<?php echo $getuser['username']; ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Số tiền</b> <b class="pull-right"><?php echo number_format($getuser['vnd']); ?> <sup>vnđ</sup></b>
                </li>
                <li class="list-group-item">
                  <b>Đã nạp</b> <b class="pull-right"><?php echo number_format($getuser['napthe']); ?> <sup>vnđ</sup></b>
                </li>
                <li class="list-group-item">
                  <b>Báo danh</b> <b class="pull-right"><?php echo number_format($getuser['sao']); ?> <sup>lần</sup></b>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>HETHONGSONGAO.COM</b></a>
            </div>
            <!-- /.box-body -->
          </div>
</div>  

<div class="col-lg-8">
<div class="box box-success"> 
<!-- code start --> 
                                            <div class="panel"> 
                                                <header class="panel-heading"><center style="font-size: 20px;">VIP LIKE (<b><font color="red">Bảo trì</font></b>)</center><center style="font-size: 14px;">Tự Động Tăng Lượt Thích Các Bài Viết Mới Của Bạn.</center></header> 
                                                <div class="panel-body"> 
                                                    <div class="row"> 
                                                        <div class="col-xs-6"> 
                                                            <a href="#" class="btn btn-block btn-success">MUA</a> 
                                                        </div> 
                                                        <div class="col-xs-6"> 
                                                            <a href="index.php?vip=manager_viplikecx" class="btn btn-block btn-success">QUẢN LÍ</a> 
                                                        </div> 
                                                    </div> 
                                                </div> 
                                            </div> 
                                            <div class="panel"> 
                                                <header class="panel-heading"><center style="font-size: 20px;">VIP CMT</center><center style="font-size: 14px;">Tự Động Tăng Bình Luận Các Bài Viết Mới Của Bạn.</center></header> 
                                                <div class="panel-body"> 
                                                    <div class="row"> 
                                                        <div class="col-xs-6"> 
                                                            <a href="index.php?vip=add_vipcmt" class="btn btn-block btn-success">MUA</a> 
                                                        </div> 
                                                        <div class="col-xs-6"> 
                                                            <a href="index.php?vip=manager_vipcmt" class="btn btn-block btn-success">QUẢN LÍ</a> 
                                                        </div> 
                                                    </div> 
                                                </div> 
                                            </div>
                                            <div class="panel"> 
                                                <header class="panel-heading"><center style="font-size: 20px;">VIP BOT</center><center style="font-size: 14px;">Giúp Bạn Thả Cảm Xúc Tự Động Cho Bạn Bè.</center></header> 
                                                <div class="panel-body"> 
                                                    <div class="row"> 
                                                        <div class="col-xs-6"> 
                                                            <a target="_blank" href="//tuongtac.me" class="btn btn-block btn-success">MUA</a> 
                                                        </div> 
                                                        <div class="col-xs-6"> 
                                                            <a href="index.php?vip=manager_vipbot" class="btn btn-block btn-success">QUẢN LÍ</a> 
                                                        </div> 
                                                    </div> 
                                                </div> 
                                            </div>             
</div> 
</div>
</div>
</div>

<div class="col-lg-12"> 
    <div class="panel-group"> 
              <div class="box box-warning"> 
                <div class="box-header with-border"> 
                  <h3 class="box-title">LỊCH SỬ GẦN ĐÂY</h3> 
                  <div class="box-tools pull-right"> 
                    <span class="label label-danger">LỊCH SỬ CỦA BẠN</span> 
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> 
                    </button> 
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i> 
                    </button> 
                  </div> 
                </div> 
                <!-- /.box-header --> 
                        <div class="panel-body"> 
                            <div class="table-responsive"> 
                                <div id="lichsu"></div> 
                                            </div> 
                                        </div>  
                                    </div> 
    </div> 
</div> 

<div class="col-lg-12"> 
    <div class="panel-group"> 
              <div class="box box-danger"> 
                <div class="box-header with-border"> 
                  <h3 class="box-title">ĐẠI LÝ UY TÍN</h3> 
                  <div class="box-tools pull-right"> 
                    <span class="label label-danger">HETHONGSONGAO</span> 
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> 
                    </button> 
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i> 
                    </button> 
                  </div> 
                </div> 
                <!-- /.box-header --> 
                <div class="box-body no-padding"> 
                  <ul class="users-list clearfix"> 
                    <?php 
                      $i = 1; 
                      $req = mysqli_query($vtasystem, "SELECT * FROM account WHERE level=2 AND vnd >= 500000 AND chinhthuc = 1 ORDER BY id ASC");  
                      while($x = mysqli_fetch_assoc($req)){  
                    ?> 
                    <li>
                    <a target="_blank" href="https://facebook.com/<?php echo $x['idfb']; ?>">
                      <img class="img-thumbnail img-circle img-responsive" src="https://graph.facebook.com/<?php echo $x['idfb']; ?>/picture?width=128&amp;height=128" alt="User Image"> 
                      <v class="users-list-name"><?php echo $x['fullname']; ?></v>
                    </a> 
                      <span class="badge badge-danger">Đại Lý</span>
                    </li> 
                    <?php } ?>  
                  </ul> 
                  <!-- /.users-list --> 
                </div> 
                <!-- /.box-body --> 
                <!-- /.box-footer --> 
              </div> 
              <!--/.box --> 
    </div> 
</div> 

<script type="text/javascript"> 
    setInterval(function(){ 
        $("#lichsu").load('load.php') 
    }, 5000); 
    window.onload = function(){ 
    document.getElementById('warnings').click(); 
    }; 
</script> 