<div class="col-lg-12">
 <div class="panel panel-default">
                   <div class="panel-heading">
                             <b><i class="fa fa-gears"></i> Lấy ID FACEBOOK</b>
                        </div>
                    <div class="panel-body">

								
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-link"></span></span>
											<input type="text" class="form-control" id="get_id_stt_input" placeholder="Nhập Link Status/Ảnh/Video cần lấy ID" required="">
											<span class="input-group-btn">
												<button type="submit" class="btn btn-default" id="get_id">GET</button>
											</span>
										</div>
									</div>
								
								<div id="get_id_stt_result" style="display: block;">
							</div>
						</div>
							</div>	
 <div class="panel panel-default">
                   <div class="panel-heading">
                             <b><i class="fa fa-gears"></i> HƯỚNG DẪN</b>
                        </div>
                    <div class="panel-body"><center>
<p>1. Các bạn vào <b>status/ảnh/video cần lấy id</b></p>
<p>2. <b>Chọn Coppy</b> cả dòng như ảnh, <b>dán vào ô nhập link</b> phía trên rồi <b>ấn GET</b></p>
<p><img src="https://i.imgur.com/XBojhSm.png" /></p>
<p><strong>Chúc các bạn thành công</strong></p>
							</center>
						</div>
									</div>
												</div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script>
$('#get_id').click(function() {
var str = document.getElementById("get_id_stt_input").value;
var m= str.match(/(.*)\/photo.php\?fbid=([0-9]{8,})/);
if(!m){var m= str.match(/(.*)\/video.php\?v=([0-9]{8,})/);}
if(!m){var m= str.match(/(.*)\/story.php\?story_fbid=([0-9]{8,})/);}
if(!m){var m= str.match(/(.*)\/permalink.php\?story_fbid=([0-9]{8,})/);}
if(!m){var m= str.match(/(.*)\/([0-9]{8,})/);}
var n= str.match(/(.*)comment_id=([0-9]{8,})/);
if(n){
var i= m[2]+"_"+n[2];
}else{
var i= m[2];
}
        $('#get_id_stt_result').html('<h4>ID BÀI ĐĂNG LÀ :</h4><div class="form-group has-success has-feedback"><div class="input-group"><span class="input-group-addon"><span class="fa fa-info"></span></span><input type="text" id="get_id_stt_success" class="form-control" value="'+i+'" aria-describedby="inputSuccess5Status">  <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span></div></div>'); 
});
</script> 