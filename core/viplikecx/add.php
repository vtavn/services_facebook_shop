<script src="giaodien/iCheck/icheck.min.js"></script> 
<link rel="stylesheet" href="giaodien/iCheck/all.css"> 
<?php 
$result = mysqli_query($vtasystem, "SELECT * FROM package_vip WHERE block != 1"); 
if ($result) { 
    $opt = ''; 
    while ($row = mysqli_fetch_array($result)) { 
        $opt .= '<option value="'.$row['id'].'">'.$row['name'].'</option>'; 
    } 
} 
if ($_POST) { 
    $tonggoipackage = mysqli_num_rows(mysqli_query($vtasystem, "SELECT  * FROM package_vip")); 
    $loi = array(); 
    $fbid = $_POST['fbid']; 
    $name = $_POST['name']; 
    $name_package = $_POST['package']; 
    $time = $_POST['time']; 
    $speed = $_POST['speed']; 
    $camxuc = ''; 
    if (isset($_POST['camxuc'])) { 
        foreach ($_POST['camxuc'] as $value) { 
            $camxuc .= $value.'|'; 
        } 
        $camxuc = rtrim($camxuc, '|'); 
    } 
    $timelike = time() + $times * 24 * 3600; 
    if(!$fbid || !$name || !$name_package || !$time || !$speed){ 
        // Thông báo lỗi trống 
            $loi["nhap"] = '<div class="alert alert-danger alert-dismissible disabled" role="alert"> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
                Error : vui lòng nhập đầy đủ thông tin! 
              </div>'; 
    } else { 
        //Lấy thông tin gói vip 
        if ($time <= 0 || $time > 12) { 
            echo "<meta http-equiv=refresh content='0; URL=/index.php?vip=add_viplikecx'>"; 
            die("<script>alert('Error : Hệ thống phát hiện bạn đang có hành phi hack. Đã gửi thông báo đến admin!'); </script>"); 
            } 
        if(($name_package <= 0) || ($name_package > $tonggoipackage)){ 
            echo '<meta http-equiv=refresh content="0; URL=/index.php?vip=add_viplikecx">'; 
            die("<script>alert('Error : Hệ thống phát hiện bạn đang có hành vi hack. Đã gửi thông báo đến admin!'); </script>"); 
        }     
    $sql = "SELECT * FROM vip_like WHERE fbid = '".$fbid."' LIMIT 1";
    $result=mysqli_query($vtasystem, $sql);
    $checkvip = mysqli_num_rows($result);
            //mã giảm giá 
            $coppon = $_POST['coppon']; 
            $getcoppon = mysqli_fetch_assoc(mysqli_query($vtasystem, "SELECT * FROM coupon_ht WHERE username = '".$getuser['username']."'")); 
            $giamgia = $getcoppon['code']; 
            $giam = $getcoppon['giam']; 
            //end mã giảm giá 
        $get_package = mysqli_query($vtasystem, "SELECT * FROM package_vip WHERE id = $name_package LIMIT 1"); 
        if ($get_package) { 
            $package = mysqli_fetch_assoc($get_package); 
            $price = $package['giatien']*$time; 
            $namepackage = $package['name']; 
            $get_user = mysqli_query($vtasystem, "SELECT id, username, vnd FROM account WHERE id = '".$_SESSION['id']."'"); 
            $user = mysqli_fetch_assoc($get_user); 
            if($coppon !== $giamgia){ 
                if ($getuser['level'] == '2') { 
                            $price -= $price * 15 / 100; 
                        } else if ($getuser['level'] == '3') { 
                            $price -= $price * 5 / 100; 
                        }else if ($getuser['level'] == '0') { 
                            $price = $price; 
                        }else if ($getuser['level'] == '1') { 
                            $price -= $price * 50 / 100; 
                        }else if ($getuser['level'] == '4') { 
                            $price -= $price * 20 / 100; 
                        } 
            }else if($coppon === $giamgia){ 
            if ($getuser['level'] == '2') { 
                        $tong = 15 + $giam; 
                    $price -= $price * $tong / 100; 
                } else if ($getuser['level'] == '3') { 
                        $tong = 5 + $giam; 
                    $price -= $price * 5 + $tong / 100; 
                }else if ($getuser['level'] == '0') { 
                    $price = $price * $giam / 100; 
                }else if ($getuser['level'] == '1') { 
                    $tong = 20 + $giam; 
                    $price -= $price * $tong / 100; 
                }else if ($getuser['level'] == '4') { 
                    $tong = 20 + $giam; 
                    $price -= $price * $tong / 100; 
                } 
                } 

            if ($checkvip == 0) { 
                if ($user['vnd'] >= $price) {
                $insert_vip = mysqli_query($vtasystem, "INSERT INTO vip_like(fbid, name, name_buy, id_buy, name_package, camxuc, limit_time, time_buy, speed, status) VALUES ('$fbid', '$name', '".$user['username']."', '".$user['id']."', '$name_package', '$camxuc', '$time', '$timelike', '$speed', 'checked')");
                if ($insert_vip) { 
                    $vnd_conlai = $user['vnd'] - $price; 
                    $doanhthu = $user['doanhthu'] + $price; 
                    $idvip = $user['idvip'] + 1; 
                    $update_vnd = mysqli_query($vtasystem, "UPDATE account SET vnd = '$vnd_conlai' WHERE id = '".$user['id']."'"); 
                    $update_doanhthu = mysqli_query($vtasystem, "UPDATE account SET doanhthu  = '$doanhthu' WHERE id = '".$user['id']."'"); 
                    $update_idvip = mysqli_query($vtasystem, "UPDATE account SET idvip = '$idvip' WHERE id = '".$user['id']."'"); 
                    $xoacoppon = mysqli_query($vtasystem, "DELETE FROM `coupon_ht` WHERE `code` = '".$coppon."'");  
                    //up log 
                    $timess = time(); 
                       $content = "<b>" .$user['username']. "</b> vừa thêm VIP Cảm Xúc cho ID <b>$fbid</b>. Thời hạn <b>$time</b> tháng, gói <b>$namepackage</b>, Loại CX: <b>$camxuc</b>, tổng thanh toán <b>" . number_format($price) . " VNĐ </b>"; 
                    $update_log = mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='LIKE',`content`='$content',`time`='".$timess."'"); 
                     
                    if($coppon === $giamgia){ 
                    $contentcp = "<b>" .$user['username']. "</b> đã dùng mã coupon <b>".$coppon."</b> (Giảm ".$giam." %) cho dịch vụ Vip Like"; 
                    $update_logcp = mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='LIKE',`content`='$contentcp',`time`='".$timess."'"); 
                    } 
                                //show 
                    $loi["adds"] = '<div class="alert alert-success alert-dismissible disabled" role="alert"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
                        Success! Thêm Thành Công UID <b>'.$fbid.'</b> - Gói <b>'.$namepackage.'</b> Loại <b>'.$camxuc.'</b> - Thời Hạn <b>'.$time.'</b> Tháng. 
                      </div>'; 
                } else { 
                    $loi["adds2"] = '<div class="alert alert-danger alert-dismissible disabled" role="alert"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
                        Error : đã có lỗi xảy ra, vui lòng thử lại! 
                      </div>';                } 
            }else { 
                    $loi["adds3"] = '<div class="alert alert-danger alert-dismissible disabled" role="alert"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
                        Error : Tài khoản của bạn hiện không đủ để mua gói vip này! 
                      </div>';                } 
            }else{ 
                    $loi["adds4"] = '<div class="alert alert-danger alert-dismissible disabled" role="alert"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
                        Error : UID <b>'.$fbid.'</b> Đã có trên hệ thống. Vui lòng kiểm tra lại! 
                      </div>';            } 
        } 
    } 
} 
?> 
<div class="col-lg-8"> 
 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
                        <b><i class="fa fa-gears"></i> Thêm ID VIP Cảm Xúc</b>  
                        <span href="#vtasystemnoti" id="warning" data-toggle="modal" class="wow fadeInUp badge pull-right bg-red">Hướng Dẫn</span> 

                        </div> 
<div class="panel-body"> 
                <!--show log--> 
                            <?php echo isset($loi['nhap']) ? $loi['nhap'] : ''; ?> 
                            <?php echo isset($loi['adds']) ? $loi['adds'] : ''; ?> 
                            <?php echo isset($loi['adds2']) ? $loi['adds2'] : ''; ?> 
                            <?php echo isset($loi['adds3']) ? $loi['adds3'] : ''; ?> 
                            <?php echo isset($loi['adds4']) ? $loi['adds4'] : ''; ?> 
            <form action="index.php?vip=add_viplikecx" method="POST"> 
                <div class="form-group"> 
                    <label for="usr">ID Người Dùng: <b>*</b><b><font color="red">**</font></b></label> 
                    <input type="number" class="form-control" name="fbid" id="fbid" onchange="update()" placeholder="100065656325xxx" oninput="show_price()" value=""> 
                </div> 
                <div class="row"> 
                <div class="col-md-6 col-sm-6 col-xs-12"> 
                <div class="form-group"> 
                    <label for="usr">Loại Cảm Xúc: <b>*</b></label><br> 
                    <label style="padding-right: 10px"><input type="checkbox" value="LIKE" name="camxuc[]" id="camxuc" checked class="flat-red"><img src="/giaodien/img/like.png" width="25" height="25"></label> 
                    <label style="padding-right: 10px"><input type="checkbox" value="LOVE" name="camxuc[]" id="camxuc" class="flat-red"><img src="/giaodien/img/love.png" width="25" height="25"></label> 
                    <label style="padding-right: 10px"><input type="checkbox" value="HAHA" name="camxuc[]" id="camxuc" class="flat-red"><img src="/giaodien/img/haha.png" width="25" height="25"></label> 
                    <label style="padding-right: 10px"><input type="checkbox" value="WOW" name="camxuc[]" id="camxuc" class="flat-red"><img src="/giaodien/img/wow.png" width="25" height="25"></label> 
                    <label style="padding-right: 10px"><input type="checkbox" value="SAD" name="camxuc[]" id="camxuc" class="flat-red"><img src="/giaodien/img/sad.png" width="25" height="25"></label> 
                    <label style="padding-right: 10px"><input type="checkbox" value="ANGRY" name="camxuc[]" id="camxuc" class="flat-red"><img src="/giaodien/img/angry.png" width="25" height="25"></label> 
                </div></div> 

                <div class="col-md-6 col-sm-6 col-xs-12"> 
                <div class="form-group"> 
                    <label for="usr">Chọn Gói VIP: <b>*</b></label> 
                    <select name="package" id="package" class="form-control" onchange="show_price()" oninput="update()"> 
                        <?php echo $opt; ?> 
                    </select> 
                </div></div> 
                <div class="col-md-6 col-sm-6 col-xs-12"> 
                <div class="form-group" > 
                    <label for="usr">Tốc Độ Lên Like: <b class="btn btn-success btn-simple btn-xs" id="show-speed">10</b></label> 
                    <input data-slider-orientation="horizontal" 
                         data-slider-selection="before" data-slider-tooltip="show" data-slider-id="red" type="range" name="speed" id="speed" value="10" min="10" max="100" step="1" onchange="range()" oninput="update()"> 
                </div> 
                </div> 
                <div class="col-md-6 col-sm-6 col-xs-12"> 
                <div class="form-group"> 
                    <label for="usr">Thời Gian Sử Dụng: <b>*</b></label> 
                    <select name="time" id="time" class="form-control" onchange="show_price()" oninput="update()"> 
                        <option value="1">1 Tháng</option> 
                        <option value="2">2 Tháng</option> 
                        <option value="3">3 Tháng</option> 
                        <option value="4">4 Tháng</option> 
                    </select> 
                </div> 
                </div> 

                <div class="col-md-6 col-sm-6 col-xs-12"> 
                <div class="form-group"> 
                    <label for="usr">Mã Giảm Giá: <b></b></label> 
                    <input type="text" class="form-control" name="coppon" id="coppon" onchange="update()" placeholder="Mã giảm giá admin cung cấp" oninput="show_price()" value=""> 
                </div> 
                </div> 
                                </div> 
                <div class="form-group"> 
                    <label for="usr">Ghi Chú: <b>*</b></label> 
                    <textarea class="form-control" rows="3" name="name" id="name" onchange="update()" placeholder="Khi chú để nhận biết"></textarea> 
                </div>     

                <ul> 
                                        <li> 
                                            <p class="font-bold font-underline col-pink">Lưu ý:</p> 
                                            <ul> 
                                                <li><p class="font-bold"><font color="red">**</font> : Chỉ điền uid cá nhân hoặc uid page. Không điền id post hoặc username!</li> 
                                                <li><p class="font-bold">Các trường hợp có dấu <b>*</b> là bắt buộc phải có.</p></li> 
                                                <li><p class="font-bold">Cám ơn đã sử dụng dịch vụ của chúng tôi.</p></li> 
                                            </ul> 
                                        </li> 
                                    </ul>         
        </div> 
        </div> 
            </div> 
<div class="col-lg-4"> 
 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
                             <b>Chi Tiết Đơn Hàng</b> 
                        </div> 
<div class="panel-body"> 
<li class="list-group-item">ID VIP: <span class="badge pull-right bg-red" id="id-user">NULL</span></li> 
<li class="list-group-item">Thời Hạn: <span class="badge pull-right bg-red" id="times">NULL</span></li> 
<li class="list-group-item">Gói Số: <span class="badge pull-right bg-red" id="goi">NULL</span></li> 
<li class="list-group-item">Tốc Độ: <span class="badge pull-right bg-red" id="tocdo">NULL</span></li> 
<li class="list-group-item">Chú Thích: <span class="badge pull-right bg-red" id="chuthich">NULL</span></li> 
<li class="list-group-item">Giá Thanh Toán (vnđ) :  <span class="badge pull-right bg-red" id="show-price">0</span> </li><br>
<center>
    <?php           
    if($getuser['vnd'] >= '10000')  { 
        echo '<button type="submit" name="submit" class="btn btn-info"><i class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i> Thanh Toán</button>'; 
        }else{   
              echo '<button class="btn btn-danger" disabled><i class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i> Không Thể Thanh Toán</button>'; 
        } 
     ?> 
</center>
</form> 
        </div> 
    </div> 
</div> 

        <div id="vtasystemnoti" class="modal fade" role="dialog"> 
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal">&times;</button> 
                <h4 class="modal-title"><center><strong>Hướng Dẫn Sử Dụng</strong></center></h4> 
            </div> 
            <div class="modal-body"> 
                <div class="alert alert-info"> 
      <strong>Giới thiệu và hướng dẫn sử dụng:</strong> 
      <li>Chạy Đủ Số Bài Viết Giới Hạn Trong Một Ngày. (Tối đa <b>20 Bài</b>/<b>1 Ngày</b>)</li> 
      <li>Tùy Biến Tốc Độ Chạy Nhanh Chậm Khác Nhau.</li> 
      <li>Đặt Giới Hạn Bằng Hashtag <strong>#l_x</strong> ( trong đó <strong>x</strong> là số like muốn tăng ).</li> 
      <li>Ví Dụ: Muốn Đặt Limit Là 150 Cảm Xúc Thì Ghi Lệnh <b>#l_150</b> .</li> 
      </div> 
            </div> 
                    <div class="modal-footer"> 
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Đã Hiểu</button> 
                    </div> 
                </div> 

            </div> 
        </div> 

<script type="text/javascript"> 
    function range(){ 
        $("#show-speed").text($("#speed").val()); 
    } 
    var Check_cp = function (){ 
        setTimeout(show_price,0); 
    } 
    function show_price(){ 
        var coppon = $("#coppon").val(); 
        var package = $("#package").val(); 
        var time = $("#time").val(); 
        $.ajax({ 
            url: "core/viplikecx/tinhtien.php", 
            type: "POST", 
            dataType: "JSON", 
            data:{ 
                type: "get-package", 
                id_package: package, 
                time: time, 
                coppon: coppon 

            }, 
            success: (data)=>{ 
                if(data.kq == false){ 
                    $("#show-price").text(data.price); 
                    toastr.error(data.thongbao, 'Thông báo!'); 
                }else{ 
                    $("#show-price").text(data.price); 
                    toastr.success(data.thongbao, 'Thông báo!'); 
                }  

            }, 
        }) 
    } 
    function update(){ 
            var id = $("#fbid").val(); 
            var chuthich = $("#name").val(); 
            var times = $("#time").val(); 
            var goi = $("#package").val(); 
            var tocdo = $("#speed").val(); 
             
            $("#id-user").text(id); 
            $("#chuthich").text(chuthich); 
            $("#times").text(times+' Tháng'); 
            $("#goi").text(goi); 
            $("#tocdo").text(tocdo+' Like/Phút'); 
        } 


    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({ 
      checkboxClass: 'icheckbox_minimal-blue', 
      radioClass: 'iradio_minimal-blue' 
    }); 
    //Red color scheme for iCheck 
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({ 
      checkboxClass: 'icheckbox_minimal-red', 
      radioClass: 'iradio_minimal-red' 
    }); 
    //Flat red color scheme for iCheck 
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({ 
      checkboxClass: 'icheckbox_flat-green', 
      radioClass: 'iradio_flat-green' 
    }); 

    //Colorpicker 
    $(".my-colorpicker1").colorpicker(); 
    //color picker with addon 
    $(".my-colorpicker2").colorpicker(); 

    //Timepicker 
    $(".timepicker").timepicker({ 
      showInputs: false 
    }); 
</script> 
