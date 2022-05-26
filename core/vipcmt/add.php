
<?php 
$result = mysqli_query($vtasystem, "SELECT * FROM package_vipcmt"); 
if ($result) { 
    $opt = ''; 
    while ($row = mysqli_fetch_array($result)) { 
        $opt .= '<option value="'.$row['id'].'">'.$row['name'].'</option>'; 
    } 
} 
if ($_POST) { 
    $tonggoipackage = mysqli_num_rows(mysqli_query($vtasystem, "SELECT  * FROM package_vipcmt")); 
    $loi = array(); 
    $fbid = $_POST['fbid']; 
    $name = $_POST['name']; 
    $name_package = $_POST['package']; 
    $time = $_POST['time']; 
    $speed = $_POST['speed']; 
    $noidung = $_POST['noidung']; 
    $timecmt = time() + $times * 24 * 3600; 
    if(!$fbid || !$name || !$name_package || !$time || !$speed || !$noidung){ 
        // Thông báo lỗi trống 
            $loi["nhap"] = '<div class="alert alert-danger alert-dismissible disabled" role="alert"> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
                Error : vui lòng nhập đầy đủ thông tin! 
              </div>'; 
    } else { 
     
        if ($time <= 0 || $time > 12) { 
            echo "<meta http-equiv=refresh content='0; URL=/index.php?vip=add_vipcmt'>"; 
            die("<script>alert('Error : Hệ thống phát hiện bạn đang có hành phi hack. Đã gửi thông báo đến admin!'); </script>"); 
            } 
        if(($name_package <= 0) || ($name_package > $tonggoipackage)){ 
            echo '<meta http-equiv=refresh content="0; URL=/index.php?vip=add_vipcmt">'; 
            die("<script>alert('Error : Hệ thống phát hiện bạn đang có hành vi hack. Đã gửi thông báo đến admin!'); </script>"); 
        }     
    $sql = "SELECT * FROM vip_cmt WHERE fbid = '".$fbid."' LIMIT 1";
    $result=mysqli_query($vtasystem, $sql);
    $checkvip = mysqli_num_rows($result);          
        //mã giảm giá 
            $coppon = $_POST['coppon']; 
            $getcoppon = mysqli_fetch_assoc(mysqli_query($vtasystem, "SELECT * FROM coupon_ht WHERE username = '".$getuser['username']."'")); 
            $giamgia = $getcoppon['code']; 
            $giam = $getcoppon['giam']; 
            //end mã giảm giá 
        $get_package = mysqli_query($vtasystem, "SELECT * FROM package_vipcmt WHERE id = $name_package LIMIT 1"); 
        if ($get_package) { 
            $package = mysqli_fetch_assoc($get_package); 
            $price = $package['giatien']*$time; 
            $namepackage = $package['name']; 
            $get_user = mysqli_query($vtasystem, "SELECT id, username, vnd FROM account WHERE id = '".$_SESSION['id']."'"); 
            $user = mysqli_fetch_assoc($get_user); 
            //tính tiền chất chơi người dơi :# :v 
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
                $insert_vip = mysqli_query($vtasystem, "INSERT INTO vip_cmt(fbid, name, name_buy, id_buy, name_package, noidung, limit_time, time_buy, speed, status) VALUES ('$fbid', '$name', '".$user['username']."', '".$user['id']."', '$name_package', '$noidung', '$time', '$timecmt', '$speed', '0')"); // 
                if ($insert_vip) { 
                    $vnd_conlai = $user['vnd'] - $price; 
                    $doanhthu = $user['doanhthu'] + $price; 
                    $idvip = $user['idvip'] + 1; 
                    $update_vnd = mysqli_query($vtasystem, "UPDATE account SET vnd = '$vnd_conlai' WHERE id = '".$user['id']."'"); 
                    $update_doanhthu = mysqli_query($vtasystem, "UPDATE account SET doanhthu  = '$doanhthu' WHERE id = '".$user['id']."'"); 
                    $update_idvip = mysqli_query($vtasystem, "UPDATE account SET idvip = '$idvip' WHERE id = '".$user['id']."'"); 
                                        //up log 
                    $timess = time(); 
                   $content = "<b>" .$user['username']. "</b> vừa thêm VIP CMT cho ID <b>$fbid</b>. Thời hạn <b>$time</b> tháng, gói <b>$namepackage</b>, tổng thanh toán <b>" . number_format($price) . " VNĐ </b>"; 
                                $update_log = mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='CMT',`content`='$content',`time`='".$timess."'"); 
                                 
                    if($coppon === $giamgia){ 
                    $contentcp = "<b>" .$user['username']. "</b> đã dùng mã coupon <b>".$coppon."</b> (Giảm ".$giam." %) cho dịch vụ Vip CMT"; 
                    $update_logcp = mysqli_query($vtasystem, "INSERT INTO `log_ht` SET `id_user`='".$getuser['id']."', `type`='LIKE',`content`='$contentcp',`time`='".$timess."'"); 
                    } 
                                //show 
                    $loi["adds"] = '<div class="alert alert-success alert-dismissible disabled" role="alert"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
                        Success! Thêm Thành Công UID <b>'.$fbid.'</b> - Gói <b>'.$namepackage.'</b> - Thời Hạn <b>'.$time.'</b> Tháng. 
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
                        <b><i class="fa fa-gears"></i> Thêm ID VIP Comments</b>  
                        <span href="#vtasystemnoti" id="warning" data-toggle="modal" class="wow fadeInUp badge pull-right bg-red">Hướng Dẫn</span> 

                        </div> 
<div class="panel-body"> 
                <!--show log--> 
                            <?php echo isset($loi['nhap']) ? $loi['nhap'] : ''; ?> 
                            <?php echo isset($loi['adds']) ? $loi['adds'] : ''; ?> 
                            <?php echo isset($loi['adds2']) ? $loi['adds2'] : ''; ?> 
                            <?php echo isset($loi['adds3']) ? $loi['adds3'] : ''; ?> 
                            <?php echo isset($loi['adds4']) ? $loi['adds4'] : ''; ?> 
            <form action="index.php?vip=add_vipcmt" method="POST"> 
                <div class="form-group"> 
                    <label for="usr">ID Người Dùng: </label> 
                    <input type="number" class="form-control" name="fbid" id="fbid" onchange="update()" placeholder="100065656325xxx" oninput="show_price()" value=""> 
                </div> 
                <div class="form-group"> 
                    <label for="usr">Chọn Gói VIP:</label> 
                    <select name="package" id="package" class="form-control" onchange="show_price()" oninput="update()"> 
                        <?php echo $opt; ?> 
                    </select> 
                </div> 
                <div class="form-group"> 
                    <label for="usr">Nội Dung CMT:</label> 
                    <textarea class="form-control" id="noidung" name="noidung" rows="5" placeholder="Mỗi nội dung trên 1 dòng số cmt nên gấp 3 lần số cmt của gói để tránh trùng lặp." required="" autofocus="" onchange="update()"></textarea> 
                </div>     
                <div class="form-group"> 
                    <label for="usr">Thời Gian Sử Dụng:</label> 
                    <select name="time" id="time" class="form-control" onchange="show_price()" oninput="update()"> 
                        <option value="1">1 Tháng</option> 
                        <option value="2">2 Tháng</option> 
                        <option value="3">3 Tháng</option> 
                        <option value="4">4 Tháng</option> 
                    </select> 
                </div> 
                <div class="form-group" > 
                    <label for="usr">Tốc Độ Lên CMT: (Càng nhỏ càng thật)<b class="btn btn-success btn-simple btn-xs" id="show-speed">1</b></label> 
                    <input data-slider-orientation="horizontal" 
                         data-slider-selection="before" data-slider-tooltip="show" data-slider-id="red" type="range" name="speed" id="speed" value="1" min="1" max="20" step="1" onchange="range()" oninput="update()"> 
                </div> 
                <div class="form-group"> 
                    <label for="usr">Ghi Chú:</label> 
                    <textarea class="form-control" rows="3" name="name" id="name" onchange="update()" placeholder="Khi chú để nhận biết"></textarea> 
                </div>     
                 
                <div class="form-group"> 
                    <label for="usr">Mã Giảm Giá: <b></b></label> 
                    <input type="text" class="form-control" name="coppon" id="coppon" onchange="update()" placeholder="Mã giảm giá admin cung cấp" oninput="show_price()" value=""> 
                </div> 
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
<!--li class="list-group-item">Nội Dung: <span class="badge pull-right bg-red" id="noidungs">NULL</span></li--> 
<button type="button" class="btn bg-olive margin">Giá Thanh Toán : <b id="show-price">0</b> VNĐ.</button> 
<button type="submit" name="submit" class="btn btn-info">Thanh Toán</button> 
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
                Update hướng dẫn.. 
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
    function show_price(){ 
        var coppon = $("#coppon").val(); 
        var package = $("#package").val(); 
        var time = $("#time").val(); 
        $.ajax({ 
            url: "core/vipcmt/tinhtien.php", 
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
            error: (data) => { 
                console.log(data) 
            } 
        }) 
    } 
    function update(){ 
            var id = $("#fbid").val(); 
            var chuthich = $("#name").val(); 
            var times = $("#time").val(); 
            var goi = $("#package").val(); 
            var tocdo = $("#speed").val(); 
            var noidungs = $("#noidung").val(); 

            $("#id-user").text(id); 
            $("#chuthich").text(chuthich); 
            $("#times").text(times+' Tháng'); 
            $("#goi").text(goi); 
            $("#tocdo").text(tocdo+' CMT/Phút'); 
            $("#noidungs").text(noidungs); 
        } 
</script> 
