<div class="col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Tools Get Access Token Not Checkpoint 100%</h3>
        </div>
        <div class="panel-body">
            <form role="form">
                <div class="form-group">
                    <label for="email">Email hoặc SĐT</label>
                    <input type="text" class="form-control" id="email" placeholder="Email hoặc SĐT"> </div>
                <div class="form-group">
                    <label for="pass">Mật khẩu</label>
                    <input type="password" class="form-control" id="pass" placeholder="Nhập Pass"> </div>
                <button type="submit" class="btn btn-purple waves-effect waves-light btn-block">Lấy Token</button>
            </form>
        </div>
        <!-- panel-body -->
    </div>
    <!-- panel -->
</div>


<div class="col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Kết quả</h3>
        </div>
        <div class="panel-body" id="result">

        </div>
        <!-- panel-body -->
    </div>
    <!-- panel -->
</div>

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Dán đoạn mã vào đây - sẽ tự động lọc token</h3>
        </div>
        <div class="panel-body" id="result">
  <div class="input-group">
    <input type="text" class="form-control" placeholder="Dán đoạn mã vào đây" id="loc_token">
    <div class="input-group-btn">
      <button class="btn btn-default">
        <i class="fa fa-cogs"></i>
      </button>
      <p id="thongbao"></p>
    </div>
  </div>

        </div>
        <!-- panel-body -->
    </div>
    <!-- panel -->
</div>

<script type="text/javascript">
	$('#loc_token').change(function(){
		var json_token = jQuery.parseJSON($(this).val());
		if(json_token.access_token){
			$(this).val(json_token.access_token);
            swal(
                        'Thành Công!',
                        'Đã lọc token, token của bạn sẽ hiển thị ở ô bạn vừa dán mã',
                        'success'
                    );
		}else{
            swal(
                        'Thông báo lỗi!',
                        'Có lỗi xảy ra, Vui lòng thử lại.!',
                        'error'
                    );
		}
		
		
	});
	$('form').submit(function(){
		var user = $('#email').val();
		var pass = $('#pass').val();

		$.post('/core/tools/gettoken/get.php', {u : user, p: pass}).done(function(data){
			$('#result').html('<ul class="list-group"><li class="list-group-item"><strong>Bước 1:</strong>Click<a href="'+data+'" class="btn-info btn" target="_blank"> vào đây</a> để sau đó nhấn<kbd>Ctrl + A</kbd> sau đó nhấn<kbd>Ctrl + C</kbd> để copy toàn bộ.</li><li class="list-group-item"><b> Bước 2</b>: Dán mã vào form bên dưới để lấy Access_Token</li></ul>');
		});
		return false
	});

</script>