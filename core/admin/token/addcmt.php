<?php
if($getuser['level'] != 1) { 
echo '<meta http-equiv=refresh content="0; URL=/index.php">';
}else{
?>
<div class="col-lg-12">
 <div class="panel panel-default">
                   <div class="panel-heading">
                             <b><i class="fa fa-gears"></i> ACCESS TOKEN Công cụ thêm, xóa, chỉnh sửa Access Token Trên Hệ Thống</b>
                        </div>
<div class="panel-body">
                            <div class="row clearfix add-package">
                                <div class="col-md-12">
                                    <label for="email_address">Nhập Vào Mã Access Token</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea name="" id="access-token" class="form-control" rows="10" required="required"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" id="progress" style="display: none;">
                                    <div class="progress">
                                        <div class="progress-bar bg-cyan progress-bar-striped active" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                            CYAN PROGRESS BAR
                                        </div>
                                    </div>
                                    <span class="label label-primary">Tổng: <b id="total">0</b></span>
                                    <span class="label label-success">Live: <b id="live">0</b></span>
                                    <span class="label label-danger">Die: <b id="die">0</b></span>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-success waves-effect" id="btn" onclick="checkLive();"><i class="fa fa-superpowers" aria-hidden="true"></i> Check Live</button>
                                    <button type="button" class="btn btn-primary waves-effect" id="add-token" onclick="getTokenToServer();" style="display: none;"><i class="fa fa-pie-chart" aria-hidden="true"></i> Thêm Access Token Vào CSDL</button>
                                </div>
                            </div>
   </div>
      </div>   </div>
<div class="col-lg-12">
 <div class="panel panel-default">
                   <div class="panel-heading">
                             <b><i class="fa fa-gears"></i> TOKEN LIVE</b>
                        </div>
<div class="panel-body">
                            <div class="row clearfix add-package">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea name="" id="access-token-live" class="form-control" rows="10" required="required"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
   
    <script type="text/javascript">
    var FBID1 = new Array();
    var TOKEN1 = new Array();
    var FBID2 = new Array();
    var TOKEN2 = new Array();
    var FBID3 = new Array();
    var TOKEN3 = new Array();
    //var ARR_ACCESS = new Array();
    function checkLive(){
        TOKEN1 = [];
        var access_token = $("#access-token").val();
        if (!access_token) {
            toastr.error('Vui Lòng Nhập Vào Access Token', 'Thông báo lỗi!');
            return;
        }
        $("#btn").html('<i class="fa fa-refresh fa-spin"></i> Vui Lòng Đợi');
        access_token = access_token.split("\n");
        var long = access_token.length;
        var tong = 0,
            live = 0,
            die  = 0;
        $("#live").text(0);
        $("#die").text(0);
        $("#total").text(0);
        $(".progress-bar").css('width', '0%');
        $(".progress-bar").text('0%');
        $("#progress").fadeIn('slow');
        for(var i = 0; i < long; i++){
            ! function(i){
                $.ajax({
                    url: 'https://graph.facebook.com/me',
                    type: 'GET',
                    dataType: 'JSON',
                    data: {
                        access_token: access_token[i]
                    }
                }).success((data) => {
                    live++;
                    $("#live").text(live);
                    TOKEN1.push(access_token[i]);
                    FBID1.push(data.id);
                    $("#access-token-live").append(access_token[i].trim()+"\n");
                }).error((data) => {
                    die++;
                    $("#die").text(die)
                }).always((data) => {
                    tong++;
                    $("#total").text(tong);
                    if (tong === long) {
                        $(".progress-bar").css('width', (tong*100)/long+'%');
                        $(".progress-bar").text((tong*100)/long+'%');
                        $("#add-token").fadeIn('slow');
                        $("#btn").html('<i class="fa fa-superpowers" aria-hidden="true"></i> Check Live');
                        toastr.success('Check Live Thành Công', 'Thông báo!');
                    }
                })
            }(i)
        }
    }
    function addAccess(){
            $("#add-token").html('<i class="fa fa-refresh fa-spin"></i> Vui Lòng Đợi');
            $.ajax({
            url: '../core/xt_modun/modun.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                t: 'add-token-cmt',
                arr_access: TOKEN3,
                arr_id:  FBID3
            },
            success: (data) => {
                $("#add-token").html('<i class="fa fa-pie-chart" aria-hidden="true"></i> Thêm Access Token Vào CSDL');
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
                    $("#gift").val('');
                }
            }
        })
    }
    function locTrung(){
        $("#add-token").html('<i class="fa fa-refresh fa-spin"></i> Đang Lọc Trùng...');
        $.each(FBID1, (i, item) => {
            if(!in_array(item, FBID2)){
                FBID3.push(item);
                TOKEN3.push(TOKEN1[i]);
            }
        })
        setTimeout(function(){
            addAccess();
        },2000)
    }
    function getTokenToServer(){
        $("#add-token").html('<i class="fa fa-refresh fa-spin"></i> Đang Lấy Dữ Liệu Từ Server...');
        $.ajax({
            url: '../core/xt_modun/modun.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                t: 'get-token-cmt',
                lol: 'add'
            },
            success: (data) => {
                FBID2 = data;
                setTimeout(function(){
                    locTrung()
                }, 1000)
            }
        })
    }
    function in_array(needle, haystack){
        return haystack.indexOf(needle) !== -1;
    }
    </script>
<?php
}
?>