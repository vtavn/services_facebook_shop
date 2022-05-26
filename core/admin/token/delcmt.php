<?php
if($getuser['level'] != 1) { 
echo '<meta http-equiv=refresh content="0; URL=/index.php">';
}else{
?>
<div class="col-lg-12">
 <div class="panel panel-default">
                   <div class="panel-heading">
                             <b><i class="fa fa-gears"></i>  DELETE ACCESS TOKENXóa Access Token Die Trên Hệ Thống Có <?php echo $tokenhethong2; ?></b>
                        </div>
<div class="panel-body">
                            <div class="row clearfix add-package">
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-danger waves-effect" id="btn" onclick="getTokenToServer();"><i class="fa fa-superpowers" aria-hidden="true"></i> Tiến Hành Xóa</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

    <script type="text/javascript">
    var TOKENDIE = new Array();
    function getTokenToServer(){
        $("#btn").html('<i class="fa fa-refresh fa-spin"></i> Đang Lấy Dữ Liệu Từ Server...');
        $.ajax({
            url: '../core/xt_modun/modun.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                t: 'get-token-cmt'
            },
            success: (data) => {
                init(data);
            }
        })
    }
    function init(access_token){
        $("#btn").html('<i class="fa fa-refresh fa-spin"></i> Đang Check Live...');
        $.each(access_token, (i, item) => {
            $.ajax({
                url: 'https://graph.facebook.com/me',
                type: 'GET',
                dataType: 'JSON',
                data: {
                    access_token: item
                },
                error: (data) => {
                    TOKENDIE.push(item)
                }
            })
        })
        setTimeout(function(){
            delToken()
        }, 3000)
    }
    function delToken(){
        $("#btn").html('<i class="fa fa-refresh fa-spin"></i> Đang Xóa..');
        $.ajax({
            url: '../core/xt_modun/modun.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                t: 'del-token-cmt',
                token_die: TOKENDIE
            },
            success: (data) => {
                $("#btn").prop( "disabled", true);
                $("#btn").html('<i class="fa fa-pie-chart" aria-hidden="true"></i> Hoàn Tất');
                if (data.error == 1) {
					swal(
						'Thông báo lỗi!',
						data.msg,
						'error'
					);
                } else {
					swal(
						'Thông báo!',
						data.msg,
						'success'
					);              
					}
            }
        })
    }
    </script>
	<?php
}
?>