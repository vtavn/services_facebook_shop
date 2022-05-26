<?php
mysqli_query($vtasystem, "UPDATE `account`SET `otp`='1' WHERE `napthe` > '10000'"); 
if($getuser['otp'] === '3') {
echo'<div class="col-lg-12"> 
          <div class="box box-danger"> 
            <div class="box-header with-border"> 
              <h3 class="box-title">TÀI KHOẢN BỊ KHÓA TRUY CẬP!</h3> 
            </div> 
<div class="panel-body"><center> 
<div class="form-group"> 
<p>TÀI KHOẢN CỦA BẠN KHÔNG CÒN QUYỀN SỬ DỤNG CHỨC NĂNG NÀY!</p> 
</div> 
<p><strong><a class="btn btn-danger" href="/index.php" target="_blank" title="QUAY LẠI TRANG CHỦ">QUAY LẠI TRANG CHỦ</a></strong></p> 
<p><strong>THÂN CHÀO!</strong></p> 
     </center> </div> 
    </div> 
  </div>'; 
}else if($getuser['otp'] === '0') {
echo'<div class="col-lg-12"> 
          <div class="box box-danger"> 
            <div class="box-header with-border"> 
              <h3 class="box-title">TÀI KHOẢN CỦA BẠN CHƯA ĐỦ ĐIỀU KIỆN THAM GIA!</h3> 
            </div> 
<div class="panel-body"><center> 
<div class="form-group"> 
<p>CHỨC NĂNG NÀY CHỈ DÀNH CHO NGƯỜI ĐÃ TỪNG NẠP THẺ TẠI HỆ THỐNG!</p> 
</div> 
<p><strong><a class="btn btn-danger" href="/index.php" target="_blank" title="QUAY LẠI TRANG CHỦ">QUAY LẠI TRANG CHỦ</a></strong></p> 
<p><strong>THÂN CHÀO!</strong></p> 
     </center> </div> 
    </div> 
  </div>'; 
}else if($getuser['otp'] === '1'){ 
?>
<div class="col-md-12">
    <div class="panel panel-border panel-inverse">
        <div class="panel-heading">
            <h3 class="panel-title">Nạp GifCode</h3> </div>
        <div class="panel-body">
            <form class="form">
                <div class="form-group">
                    <label for="code">* Gif Code :</label>
                    <input type="text" class="form-control" id="code" placeholder="Dán gif code vào đây..." name="code"></div>
                <button class="btn btn-block btn-info" type="submit">Nhận Quà!</button>
            </form>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="panel panel-border panel-inverse">
        <div class="panel-heading">
            <h3 class="panel-title">Danh sách gif code đã nạp</h3> </div>
        <div class="panel-body">
            	<?php

            		$result = mysqli_query($vtasystem, "SELECT * FROM log_gifcode WHERE user = '".$getuser['id']."'");
            		?>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Code</th>
        <th>Mệnh giá</th>
        <th>Thời gian</th>
      </tr>
    </thead>
    <tbody>


            		<?php
            		$i = 1;
            		while($gif = mysqli_fetch_array($result)){
            				?>

      <tr>
        <td><?=$i++?></td>
        <td><?=$gif['code']?></td>
        <td><?=number_format($gif['menhgia'])?> vnđ</td>
        <td><?=$gif['thoigian']?></td>
      </tr>

            				<?php
            		}

            	?>
    </tbody>
    </table>

        </div>
    </div>
</div>
<script type="text/javascript">
	$("form").submit(function() {
        $(':input[type="submit"]').prop('disabled', true);
	    $.post('core/xt_modun/ctv-gifcode.php', $(this).serialize()).done(function(data) {
	        if(data == 'error') {
	            swal("Lỗi", "Gif code này hiện không khả dụng hoặc đã hết hạn.", "warning");
               setTimeout(function(){ 
                 window.location = window.location;
               }, 1500);
	        } else {
	            swal("Thành công", data, "success");
               setTimeout(function(){ 
                 window.location = window.location;
               }, 1500);
	        }
	    }).fail(function() {
	        alert('Loi');
	    });

   		return false;
	});
</script>
<?php
}
?>