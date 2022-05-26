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
        <script type="text/javascript"> 
            window.onload = function(){ 
    document.getElementById('warnings').click(); 
}; 
        </script> 

<?php 
$src = file_get_contents('https://hethongsongao.com/core/xt_modun/notify.txt');  
$arr_src = explode("\n", $src); 
$htmlNotify = ''; 
for ($i=count($arr_src)-2; $i >= 0; $i--) { 
    $notify = explode("||", $arr_src[$i]); 
    $img = '<i class="fa fa-bullhorn" aria-hidden="true"></i>'; 
    if ($i == count($arr_src)-2) { 
        $img = '<img src="giaodien/img/hotqua.gif" /> '; 
    } 
    if ($i == count($arr_src)-3) { 
        $img = '<img src="giaodien/img/hot.gif" /> '; 
    } 
    if ($i == count($arr_src)-4) { 
        $img = '<img src="giaodien/img/new.png" /> '; 
    } 
    $htmlNotify .= '<div class="vta"> 
                    <img class="direct-chat-img" src="https://graph.facebook.com/100009580369715/picture?type=large" alt="Admin"> 
                    <div class="direct-chat-text"> 
                    <p>'.$img.' '.$notify[0].'</p> 
                    <i class="fa fa-calendar"></i> '.$notify[1].'</span> 
                    </div></div>'; 
} 
?> 

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


        <div class="col-md-6"> 
          <div class="box box-success" style="height: 200px; overflow: hidden;"> 
            <div class="box-header"> 
              <i class="fa fa-edit"></i> 

              <h3 class="box-title">Thông Báo Mới</h3> 
            </div> 
                    <div class="panel-body notify-box"> 
                        <div style="overflow: hidden;"> 
                            <?php echo $htmlNotify; ?> 
                        </div> 
                    </div> 
                  </div> 
  </div>  

<div class="col-lg-6"> 
<!-- code start --> 
<div class="twPc-div"> 
 <?php if($getuser['level'] == '4'){ echo '<a class="twPc-bg-vip twPc-block"></a>';}else{echo '<a class="twPc-bg twPc-block"></a>';}?> 
    <div> 
        <a title="<?php echo $getuser['fullname']; ?>" href="#" class="twPc-avatarLink"> 
            <img alt="<?php echo $getuser['fullname']; ?>" src="https://graph.facebook.com/<?php echo $getuser['idfb'];?>/picture?type=large" class="twPc-avatarImg"> 
        </a> 
        <div class="twPc-divUser"> 
            <div class="twPc-divName"> 
                <?php if($getuser['level'] == '4'){ echo '<a href="#"><font color="red"><i class="fa fa-star fa-spin" aria-hidden="true"></i> '.$getuser['fullname'].' </font></a>';}else{ 
                    echo '<a href="#"><i class="fa fa-empire fa-spin" aria-hidden="true"></i> '.$getuser['fullname'].'</a>';}?>- <?php if($getuser['level'] == '1'){ echo "<font color='red'>ADMIN</font>";}elseif($getuser['level'] == '2'){ echo "<font color='#00a65a'>ĐẠI LÝ</font>";}elseif($getuser['level'] == '3'){ echo "<font color='#3c8dbc'>CỘNG TÁC VIÊN</font>";}elseif($getuser['level'] == '4'){echo "<font color='red'>VIP MEMBER <i class='fa fa-star fa-spin' aria-hidden='true'></i></font>";}else{echo"Khách VIP";} ?>   
            </div> 
            <span> 
                <a href="#">@<span><?php echo $getuser['username']; ?></span></a> 
            </span> 
        </div> 

        <div class="twPc-divStats"> 
            <ul class="twPc-Arrange"> 
                <li class="twPc-ArrangeSizeFit"> 
                    <b> 
                        <span class="twPc-StatLabel twPc-block">VNĐ</span> 
                        <span class="twPc-StatValue"><?php echo number_format($getuser['vnd']); ?> VNĐ</span> 
                    </b> 
                </li> 
                <li class="twPc-ArrangeSizeFit"> 
                    <b> 
                        <span class="twPc-StatLabel twPc-block">Doanh Thu</span> 
                        <span class="twPc-StatValue"><?php echo number_format($getuser['doanhthu']); ?> VNĐ</span> 
                    </b> 
                </li> 
                <li class="twPc-ArrangeSizeFit"> 
                    <b> 
                        <span class="twPc-StatLabel twPc-block">Báo Danh</span> 
                        <span class="twPc-StatValue"><?php echo number_format($getuser['sao']); ?> LẦN</span> 
                    </b> 
                </li> 
            </ul> 
        </div> 
    </div> 
<!-- code end --> 
      <br> 
             </div> 
      </div>   <br> 

                                        <div class="col-lg-4"> 
                                            <div class="panel"> 
                                                <header class="panel-heading"><center style="font-size: 20px;">VIP LIKE</center><center style="font-size: 14px;">Tự Động Tăng Lượt Thích Các Bài Viết Mới Của Bạn.</center></header> 
                                                <div class="panel-body"> 
                                                    <div class="row"> 
                                                        <div class="col-xs-6"> 
                                                            <a href="index.php?vip=add_viplikecx" class="btn btn-block btn-success">MUA</a> 
                                                        </div> 
                                                        <div class="col-xs-6"> 
                                                            <a href="index.php?vip=manager_viplikecx" class="btn btn-block btn-success">QUẢN LÍ</a> 
                                                        </div> 
                                                    </div> 
                                                </div> 
                                            </div> 
                                        </div> 
  
                                        <div class="col-lg-4"> 
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
                                        </div>   

                                        <div class="col-lg-4"> 
                                            <div class="panel"> 
                                                <header class="panel-heading"><center style="font-size: 20px;">VIP BOT</center><center style="font-size: 14px;">Giúp Bạn Thả Cảm Xúc Tự Động Cho Bạn Bè.</center></header> 
                                                <div class="panel-body"> 
                                                    <div class="row"> 
                                                        <div class="col-xs-6"> 
                                                            <a href="index.php?vip=add_vipbot" class="btn btn-block btn-success">MUA</a> 
                                                        </div> 
                                                        <div class="col-xs-6"> 
                                                            <a href="index.php?vip=manager_vipbot" class="btn btn-block btn-success">QUẢN LÍ</a> 
                                                        </div> 
                                                    </div> 
                                                </div> 
                                            </div> 
                                        </div>  

<div class="col-lg-12"> 
    <div class="panel-group"> 

                    <div class="panel panel-default"> 
                      <div class="panel-heading"><b>LỊCH SỬ GẦN ĐÂY 
                      </div> 
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

<style>@media screen and (max-width:640px) { .vta{display:none} }</style> 
<style> 
.dash-box { 
    position: relative; 
    background: rgb(255, 86, 65); 
    background: -moz-linear-gradient(top, rgba(255, 86, 65, 1) 0%, rgba(253, 50, 97, 1) 100%); 
    background: -webkit-linear-gradient(top, rgba(255, 86, 65, 1) 0%, rgba(253, 50, 97, 1) 100%); 
    background: linear-gradient(to bottom, rgba(255, 86, 65, 1) 0%, rgba(253, 50, 97, 1) 100%); 
    filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#ff5641', endColorstr='#fd3261', GradientType=0); 
    border-radius: 4px; 
    text-align: center; 
    margin: 60px 0 50px; 
} 
.dash-box-icon { 
    position: absolute; 
    transform: translateY(-50%) translateX(-50%); 
    left: 50%; 
} 
.dash-box-action { 
    transform: translateY(-50%) translateX(-50%); 
    position: absolute; 
    left: 50%; 
} 
.dash-box-body { 
    padding: 50px 20px; 
} 
.dash-box-icon:after { 
    width: 60px; 
    height: 60px; 
    position: absolute; 
    background: rgba(247, 148, 137, 0.91); 
    content: ''; 
    border-radius: 50%; 
    left: -10px; 
    top: -10px; 
    z-index: -1; 
} 
.dash-box-icon > i { 
    background: #ff5444; 
    border-radius: 50%; 
    line-height: 40px; 
    color: #FFF; 
    width: 40px; 
    height: 40px; 
    font-size:22px; 
} 
.dash-box-icon:before { 
    width: 75px; 
    height: 75px; 
    position: absolute; 
    background: rgba(253, 162, 153, 0.34); 
    content: ''; 
    border-radius: 50%; 
    left: -17px; 
    top: -17px; 
    z-index: -2; 
} 
.dash-box-action > button { 
    border: none; 
    background: #FFF; 
    border-radius: 19px; 
    padding: 7px 16px; 
    text-transform: uppercase; 
    font-weight: 500; 
    font-size: 11px; 
    letter-spacing: .5px; 
    color: #003e85; 
    box-shadow: 0 3px 5px #d4d4d4; 
} 
.dash-box-body > .dash-box-count { 
    display: block; 
    font-size: 30px; 
    color: #FFF; 
    font-weight: 300; 
} 
.dash-box-body > .dash-box-title { 
    font-size: 13px; 
    color: rgba(255, 255, 255, 0.81); 
} 

.dash-box.dash-box-color-2 { 
    background: rgb(252, 190, 27); 
    background: -moz-linear-gradient(top, rgba(252, 190, 27, 1) 1%, rgba(248, 86, 72, 1) 99%); 
    background: -webkit-linear-gradient(top, rgba(252, 190, 27, 1) 1%, rgba(248, 86, 72, 1) 99%); 
    background: linear-gradient(to bottom, rgba(252, 190, 27, 1) 1%, rgba(248, 86, 72, 1) 99%); 
    filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#fcbe1b', endColorstr='#f85648', GradientType=0); 
} 
.dash-box-color-2 .dash-box-icon:after { 
    background: rgba(254, 224, 54, 0.81); 
} 
.dash-box-color-2 .dash-box-icon:before { 
    background: rgba(254, 224, 54, 0.64); 
} 
.dash-box-color-2 .dash-box-icon > i { 
    background: #fb9f28; 
} 

.dash-box.dash-box-color-3 { 
    background: rgb(183,71,247); 
    background: -moz-linear-gradient(top, rgba(183,71,247,1) 0%, rgba(108,83,220,1) 100%); 
    background: -webkit-linear-gradient(top, rgba(183,71,247,1) 0%,rgba(108,83,220,1) 100%); 
    background: linear-gradient(to bottom, rgba(183,71,247,1) 0%,rgba(108,83,220,1) 100%); 
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b747f7', endColorstr='#6c53dc',GradientType=0 ); 
} 
.dash-box-color-3 .dash-box-icon:after { 
    background: rgba(180, 70, 245, 0.76); 
} 
.dash-box-color-3 .dash-box-icon:before { 
    background: rgba(226, 132, 255, 0.66); 
} 
.dash-box-color-3 .dash-box-icon > i { 
    background: #8150e4; 
} 
.twPc-div { 
    background: #fff none repeat scroll 0 0; 
    border: 1px solid #e1e8ed; 
    border-radius: 6px; 
    height: 220px; 
     // orginal twitter width: 290px; 
} 
.twPc-bg { 
    background-image: url("https://pbs.twimg.com/profile_banners/50988711/1384539792/600x200"); 
    background-position: 0 50%; 
    background-size: 100% auto; 
    border-bottom: 1px solid #e1e8ed; 
    border-radius: 4px 4px 0 0; 
    height: 95px; 
    width: 100%; 
} 
.twPc-bg-tet { 
    background-image: url("https://png.pngtree.com/thumb_back/fh260/back_pic/04/60/00/12586bb11914c7a.jpg"); 
    background-position: 0 50%; 
    background-size: 100% auto; 
    border-bottom: 1px solid #e1e8ed; 
    border-radius: 4px 4px 0 0; 
    height: 95px; 
    width: 100%; 
} 
.twPc-bg-tet:hover { 
    background-image: url("https://png.pngtree.com/thumb_back/fh260/back_pic/03/59/24/8657a41496a9c28.jpg"); 
    background-position: 0 50%; 
    background-size: 100% auto; 
    border-bottom: 1px solid #e1e8ed; 
    border-radius: 4px 4px 0 0; 
    height: 95px; 
    width: 100%; 
} 
.twPc-bg-vip { 
    background-image: url("https://c4.contentfun.net/files/repository/3/7/70/all/all/image/banner---vip_1462883153.jpg?6B9v&1EoR&T0Je"); 
    background-position: 0 50%; 
    background-size: 100% auto; 
    border-bottom: 1px solid #e1e8ed; 
    border-radius: 4px 4px 0 0; 
    height: 95px; 
    width: 100%; 
} 
.twPc-block { 
    display: block !important; 
} 
.twPc-button { 
    margin: -35px -10px 0; 
    text-align: right; 
    width: 100%; 
} 
.twPc-avatarLink { 
    background-color: #fff; 
    border-radius: 6px; 
    display: inline-block !important; 
    float: left; 
    margin: -30px 5px 0 8px; 
    max-width: 100%; 
    padding: 1px; 
    vertical-align: bottom; 
} 
.twPc-avatarImg { 
    border: 2px solid #fff; 
    border-radius: 7px; 
    box-sizing: border-box; 
    color: #fff; 
    height: 72px; 
    width: 72px; 
} 
.twPc-divUser { 
    margin: 5px 0 0; 
} 
.twPc-divName { 
    font-size: 18px; 
    font-weight: 700; 
    line-height: 21px; 
} 
.twPc-divName a { 
    color: inherit !important; 
} 
.twPc-divStats { 
    margin-left: 11px; 
    padding: 10px 0; 
} 
.twPc-Arrange { 
    box-sizing: border-box; 
    display: table; 
    margin: 0; 
    min-width: 100%; 
    padding: 0; 
    table-layout: auto; 
} 
ul.twPc-Arrange { 
    list-style: outside none none; 
    margin: 0; 
    padding: 0; 
} 
.twPc-ArrangeSizeFit { 
    display: table-cell; 
    padding: 0; 
    vertical-align: top; 
} 
.twPc-ArrangeSizeFit a:hover { 
    text-decoration: none; 
} 
.twPc-StatValue { 
    display: block; 
    font-size: 18px; 
    font-weight: 500; 
    transition: color 0.15s ease-in-out 0s; 
} 
.twPc-StatLabel { 
    color: #8899a6; 
    font-size: 10px; 
    letter-spacing: 0.02em; 
    overflow: hidden; 
    text-transform: uppercase; 
    transition: color 0.15s ease-in-out 0s; 
} 
</style>  
<script type="text/javascript"> 
    $(document).ready(function() { 
        setTimeout(i, 2e3); 
        function i() { 
            $(".notify-box .vta:first").each(function() { 
                $(this).animate({ 
                    marginTop: -$(this).outerHeight(true), 
                    opacity: "hide" 
                }, 2e3, function() { 
                    $(this).insertAfter(".notify-box .vta:last"), $(this).fadeIn(), $(this).css({ 
                        marginTop: 0 
                    }), setTimeout(function() { 
                        i() 
                    }, 2e3) 
                }) 
            }) 
        } 
    }); 
    setInterval(function(){ 
        $("#lichsu").load('load.php') 
    }, 5000); 
</script> 