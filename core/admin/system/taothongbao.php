<?php
if($getuser['level'] != 1) { 
echo '<meta http-equiv=refresh content="0; URL=/index.php">';
}else{
?>

<div class="col-lg-12">
 <div class="panel panel-default">
                   <div class="panel-heading">
                             <b>NOTIFICATION <br> <small>Gửi thông báo đền khách hàng</small></b>
                        </div>
<div class="panel-body">
                            <div class="row clearfix add-package">
                                <div class="col-md-12">
                                    <label for="email_address">Nội Dung Thông Báo</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea name="" id="notify" class="form-control" rows="6" required="required"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-success waves-effect" id="btn" onclick="notify();"><i class="fa fa-bullhorn" aria-hidden="true"></i> Tiến Hành</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <script type="text/javascript">
    function notify(){
        var notify = $("#notify").val();
        if (!notify) {
          toastr.error('Vui Lòng Nhập Vào Nội Dung Thông Báo', 'Thông báo lỗi');
            return;
        }
        $("#btn").html('<i class="fa fa-refresh fa-spin"></i> Vui Lòng Đợi');
        $.ajax({
            url: '../core/xt_modun/modun.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                t: 'notify',
                notify: notify
            },
            success: (data) => {
                $('#btn').html('<i class="fa fa-bullhorn" aria-hidden="true"></i> Tiến Hành');
                if (data.error == 1) {
                  toastr.error(data.msg, 'Thông báo lỗi');
                } else {
                  toastr.success(data.msg, 'Thông báo');
 
                    $("#notify").val('');
                }
            }
        })
    }
    </script>
<?php } ?>