<script> 
    $(document).ready(function(){ 
    $(".form-control").tooltip({ placement: 'right'}); 
}); 
</script> 
<?php 
if(!$_SESSION['user']){ 
?> 

<meta http-equiv=refresh content="0; URL=/index.php"> 
<script>alert("ĐĂNG NHẬP ĐI BẠN ƠI !!!!"); </script> 

<?php 
}else{ 
?> 

        <div class="col-md-6"> 
          <div class="box box-success"> 
            <div class="box-header"> 
              <h3 class="box-title">NẠP TIỀN HỆ THỐNG 
</h3> 
            </div> 
            <div class="box-body pad table-responsive"> 
<div class="form-group"> 
<label class="control-label">Tài khoản <star>*</star></label> 
<input class="form-control error" id="txtuser" name="txtuser" value="<?php echo $getuser['username'];?>" disabled=""> 
</div> 
<div class="form-group"> 
<label class="control-label">Loại thẻ <star>*</star></label> 
                                <select class="form-control" name="card_type_id" id="card_type_id"> 
                                    <option value="VTT">Viettel</option> 
                                    <option value="VMS">Mobiphone</option> 
                                    <option value="VNP">Vinaphone</option> 
                                    <option value="FPT">Gate</option> 
                                    <option value="VNM">Vietnammobile</option> 
                                    <option value="MGC">Megacard</option> 
                                    <option value="ONC">OnCash</option> 
                                </select> 
</div> 
<div class="form-group"> 
<label class="control-label">Mã thẻ <star>*</star></label> 
<input class="form-control" id="txtpin" name="txtpin" placeholder="Mã thẻ" data-toggle="tooltip" data-title="Mã số sau lớp bạc mỏng"/> 
</div> 
<div class="form-group"> 
<label class="control-label">Số seri <star>*</star></label> 
<input class="form-control" id="txtseri" name="txtseri" placeholder="Số seri" data-toggle="tooltip" data-title="Mã seri nằm sau thẻ"/> 
</div> 

<div class="footer text-center"> 
<button id="postdata" class="btn btn-info btn-fill btn-wd" name="napthe" onclick="napthe()">Nhập Quà</button> 
</div> 


<div id="ketqua"></div> 
</div>   

</div></div> 

        <div class="col-md-6"> 
          <div class="box box-success"> 
            <div class="box-header"> 
              <h3 class="box-title">NẠP TIỀN BẰNG VÍ ĐIỆN TỬ HOẶC CHUYỂN KHOẢN 
</h3> 
            </div> 
            <div class="box-body pad table-responsive"> 

      <div class="list-group-item"> 
<center>Tiền của bạn sẽ được cộng ngay lập tức từ 1 đến 2p sau khi nạp qua ngân hàng 
</center> 
</div> 
     
    <div class="table-responsive"> 
<table class="table table-bordered"> 
<thead> 
<tr class="active"> 
<th><center>Ngân hàng</center></th> 
<th><center><font color="red">Thông tin chuyển khoản</font></center></th></tr></thead><tbody> 

<tr><td><center><b>VIETCOMBANK</b><br><img src="http://hacklike.vn/files/vietcombank.jpg"></center></td><td><b>- Số tài khoản: <font color="red">0021000407369</font></b><br> 
- Tên : <font color="red">NGUYEN DINH QUANG</font><br> 
- Chi nhánh: <font color="red">Chi Nhánh Hà Nội</font></br> 
- Nội Dung Chuyển Khoản: <font color="red"><b><?php echo $getuser['username']; ?> Nap Tien Mua Vip</b></font ></br> 
</td></tr> 


<tr><td><center><b>MEGA CARD</b><br><img src="https://megacard.vn/images/logo.png"></center></td><td><b>- Tài khoản: <font color="red">vutienanh2901@gmail.com</font></b><br> 
- Tên : <font color="red">VŨ TIẾN ANH</font><br> 
- Nội Dung Chuyển Khoản: <font color="red"><b><?php echo $getuser['username']; ?> Nap Tien Mua Vip</b></font ></br> 
</td></tr> 

<tr><td><center><b>THẺ CÀO SIÊU RẺ</b><br><img src="https://thecaosieure.com/images/logo.png" height="35px" weight="32px"></center></td><td><b>- Tài khoản: <font color="red">nhianhlove</font></b><br> 
- Tên : <font color="red">VŨ TIẾN ANH</font><br> 
- Nội Dung Chuyển Khoản: <font color="red"><b><?php echo $getuser['username']; ?> Nap Tien Mua Vip</b></font ></br> 
</td></tr> 

<tr><td><center><b>BÁN THẺ 247 - BANTHE247.COM</b><br><img src="https://banthe247.com/images/logo.png"></center></td><td><b>- Tài khoản: <font color="red">vutienanh2901@gmail.com</font></b><br> 
- Tên : <font color="red">VŨ TIẾN ANH</font><br> 
- Nội Dung Chuyển Khoản: <font color="red"><b><?php echo $getuser['username']; ?> Nap Tien Mua Vip</b></font ></br> 
</td></tr> 

</tbody></table> 
      </div>    </div> 
    </div> 
    </div> 

        <div class="col-md-12"> 
          <div class="box box-success"> 
            <div class="box-header"> 
              <h3 class="box-title">10 GIAO DỊCH GẦN NHẤT 
</h3> 
            </div> 
            <div class="box-body pad table-responsive"> 
     
    <div class="table-responsive"> 
        <table id="dataTable" class="table table-bordered table-striped"> 
          <thead> 
            <tr> 
              <th>Tên</th> 
              <th>Mã Thẻ</th> 
              <th>Seri</th> 
              <th>Nạp Lúc</th> 
              <th>Mệnh Giá</th> 
              <th>Loại Thẻ</th> 
            </tr> 
          </thead> 
          <tbody> 
            <?php 
$req = mysqli_query($vtasystem, "SELECT * FROM `log_card` WHERE `nguoinhan`= '".$getuser['username']."' LIMIT 10"); 
while($res = mysqli_fetch_assoc($req)){ 
?> 
            <tr> 
              <td> 
                <?php echo $res['nguoinhan']; ?> 
              </td> 
              <td> 
                <?php echo $res['mathe']; ?> 
              </td> 
              <td> 
                <?php echo $res['seri']; ?> 
              </td> 
              <td> 
                <?php echo $res['time']; ?> 
              </td> 
              <td> 
                <?php echo $res['menhgia']; ?> 
              </td> 
              <td> 
                <?php echo $res['loaithe']; ?> 
              </td> 
            </tr> 
            <?php 
} 
?> 
          </tbody> 
        </table> 
       </div> 
<div class="category"><star>*</star> Là mã dự thưởng khi có event.</div> 

</div> 
</div>   
</div> 

</div>   

<script> 
function napthe() { 
if(!$('#txtuser').val()) { 
toastr.error('Chưa nhập tên người nhận sao nhận đây', 'Thông báo lỗi'); 
}else if(!$('#txtpin').val()) { 
toastr.error('Bạn chưa nhập mã thẻ!', 'Thông báo lỗi'); 
}else if(!$('#txtseri').val()) { 
toastr.error('Bạn chưa nhập mã seri!', 'Thông báo lỗi'); 
}else if(!$('#card_type_id').val()) { 
toastr.error('Chưa chọn loại thẻ!', 'Thông báo lỗi'); 
}else { 
xuly(); 
} 
} 

   function xuly(){ 
      $('#postdata').html('<i class="fa fa-spinner fa-spin"></i> Đang Xử Lý'); 
                $.ajax({ 
                    url : "../core/xt_modun/xulythe.php", 
                    type : "post", 
                    dateType:"text", 
                    data : { 
                         txtuser : $('#txtuser').val(),  
                         txtpin : $('#txtpin').val(), 
                         txtseri : $('#txtseri').val(), 
                         card_type_id : $('#card_type_id').val() 
                    }, 
                    success : function (result){ 
                        $('#ketqua').html(result); 
   $('#postdata').html('Nạp Thẻ'); 
                    } 
                }); 
            } 

</script> 

<?php } ?> 