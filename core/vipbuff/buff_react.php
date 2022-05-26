<?php
if($getuser['qrcode'] != 1) { 
echo '<meta http-equiv=refresh content="0; URL=/index.php">';
}else{
?>
<div class="col-lg-12">
 <div class="panel panel-default">
                   <div class="panel-heading">
                             <b><i class="fa fa-gears"></i> BUFF REACTION</b>
                        </div>
<div class="panel-body">
                            <div class="row clearfix add-package">
                                <div class="col-md-6">
                                    <label for="input" class="control-label">ID Bài Viết</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="id" class="form-control" placeholder="Nhập Vào ID Bài Viết">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="input" class="control-label">Số Lượng</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" id="sl" value="500" class="form-control" placeholder="Nhập Vào Số Lượng">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="input" class="control-label">Lựa Chọn Cảm Xúc</label>
                                        <select id="reaction" class="form-control">
                                            <option value="LIKE">Cảm Xúc LIKE</option>
                                            <option value="LOVE">Cảm Xúc LOVE</option>
                                            <option value="WOW">Cảm Xúc WOW</option>
                                            <option value="HAHA">Cảm Xúc HAHA</option>
                                            <option value="SAD">Cảm Xúc SAD</option>
                                            <option value="ANGRY">Cảm Xúc ANGRY</option>
                                            <option value="random">Cảm Xúc Ngẫu Nhiên</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="input" class="control-label">Thời Gian Giữa 2 Lần Like (e.g: 1000 = 1s) </label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="delay" class="form-control" placeholder="Thời gian delay ví dụ 1000 = 1 giây">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-success waves-effect" id="btn" onclick="init();"><i class="fa fa-gear" aria-hidden="true"></i> BUFF REACTION</button>
                                </div>
                                <br />
                                <div id="result-gift">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

    <script type="text/javascript">
    var Neiht = 0;
    function init(){
        var id_post = $('#id').val();
        var sl = $('#sl').val();
        var delay = $('#delay').val();
        var reaction = $('#reaction').val();
        if (!id_post || !sl || !delay) {
                  toastr.error('Vui lòng điền đầy đủ thông tin!', 'Thông báo');
            return;
        }
        $("#btn").html('<i class="fa fa-refresh fa-spin"></i> Đang Lấy Token Từ Server...');
        $.ajax({
            url: 'core/xt_modun/modun.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                t: 'buff-like',
                sl: sl
            },
            success: (data) => {
                if (data.error == 1) {
                  toastr.success(data.msg, 'Thông báo');
                    return;
                }
                $("#btn").html('<i class="fa fa-refresh fa-spin"></i> Đang Thực Hiện Quá Trình Buff Like');
                buffLike(id_post, data.token, delay, reaction);
            }
        })
    }
    function buffLike(id_post, token, delay, reaction){
        for(var i = 0; i < token.length; i++){
            ++Neiht;
            ! function(i){
                setTimeout(()=> {
                    AutoReact(i, id_post, token[i], reaction);
                }, i*delay)
            }
            (i)
        }
    }
    function AutoReact(i, id_post, token, reaction){
        if (i == Neiht - 1) {
            $("#btn").html('<i class="fa fa-gear"></i> Thành Công!');
                  toastr.success('Buff Thành Công Nhé Man!', 'Thông báo');

        }
        if (reaction == 'random') {
            var arrReact = ['LIKE', 'LOVE', 'HAHA', 'WOW', 'SAD', 'ANGRY']
            reaction = arrReact[Math.floor(Math.random() * arrReact.length)]
        }
        $.getJSON('https://graph.facebook.com/' + id_post + '/reactions?method=post&type=' + reaction + '&access_token=' + token, {}, (data) => {
            console.log(data+'|'+reaction);
        })
    }
   </script>
<?php
}
?>