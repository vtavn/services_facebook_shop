<script src="giaodien/iCheck/icheck.min.js"></script>
<link rel="stylesheet" href="giaodien/iCheck/all.css">
<div class="col-md-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">MANAGE VIP CẢM XÚC</h3>
                            <ul class="header-dropdown pull-right" style="display: none;" id="btn-action">
                                <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#edit-vip"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Chỉnh Sửa</button>
                                <button type="button" class="btn btn-danger waves-effect" onclick="del_package()">Xóa</button>

                            </ul>
            </div>
                    <div class="panel-body table-responsive">
                            <table class="table table-bordered table-hover" width="100%" id="result-vip">
                            </table>
                        </div>
                    </div>
                </div>
            <div id="show-modal">
                <div class="modal fade" id="edit-vip" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Không Thể Thực Hiện Hành Động</h4>
                            </div>
                            <div class="modal-body">
                                Vui Lòng Chọn 1 Mục Cần Chỉnh Sửa
                            </div> 
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <script type="text/javascript">
        $(document).ready(function(){
            load_vip();
            $('#result-vip').on( 'click', 'tr', function () {
                if ( $(this).hasClass('active') ) {
                    $(this).removeClass('active');
                    $("#btn-action").fadeOut('slow');
                }else {
                    $('#result-vip').DataTable().$('tr.active').removeClass('active');
                    $(this).addClass('active');
                    $("#btn-action").fadeOut('slow', function(){
                        $("#btn-action").fadeIn('slow');
                    });
                    var data = $("#result-vip").DataTable().rows('.active').data();
                    var tpl = '<div class="modal fade" id="edit-vip" tabindex="-1" role="dialog">\
                        <div class="modal-dialog" role="document">\
                            <div class="modal-content">\
                                <div class="modal-header">\
                                    <h4 class="modal-title">Chỉnh Sửa Chi Tiết</h4>\
                                </div>\
                                <div class="modal-body">\
                                    <div class="row clearfix">\
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">\
                                            <label for="id-up">ID</label>\
                                        </div>\
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">\
                                            <div class="form-group">\
                                                <div class="form-line">\
                                                    <input type="text" disabled id="id-up" class="form-control" value="'+data[0][0]+'">\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>\
                                    <div class="row clearfix">\
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">\
                                            <label for="fbid-up">FBID</label>\
                                        </div>\
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">\
                                            <div class="form-group">\
                                                <div class="form-line">\
                                                    <input type="text" id="fbid-up" class="form-control" value="'+data[0][2]+'">\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>\
                                    <div class="row clearfix">\
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">\
                                            <label for="name-up">NAME</label>\
                                        </div>\
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">\
                                            <div class="form-group">\
                                                <div class="form-line">\
                                                    <input type="text" id="name-up" class="form-control" value="'+data[0][3]+'">\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>\
                                    <div class="row clearfix">\
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">\
                                            <label for="name-up">SPEED</label>\
                                        </div>\
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">\
                                            <div class="form-group">\
                                                <div class="form-line">\
                                                    <input type="text" id="speed-up" class="form-control" value="'+data[0][7]+'">\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>\
                                    <div class="row clearfix">\
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">\
                                            <label for="name-up">Tùy Chỉnh Cảm Xúc</label>\
                                        </div>\
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">\
                                            <div class="form-group">\
                                                <input name="camxuc[]" checked type="checkbox" class="filled-in" id="like" value="LIKE" />\
                                                <label for="like" style="margin-right: 20px;"><img src="/giaodien/img/like.png" style="width:24px" data-toggle="tooltip" title="" data-original-title="Thích"></label>\
                                                <input name="camxuc[]" type="checkbox" class="filled-in" id="love" value="LOVE" />\
                                                <label for="love" style="margin-right: 20px;"><img src="/giaodien/img/love.png" style="width:24px" data-toggle="tooltip" title="" data-original-title="Yêu Thích"></label>\
                                                <input name="camxuc[]" type="checkbox" class="filled-in" id="haha" value="HAHA" />\
                                                <label for="haha" style="margin-right: 20px;"><img src="/giaodien/img/haha.png" style="width:24px" data-toggle="tooltip" title="" data-original-title="Cười Lớn"></label>\
                                                <input name="camxuc[]" type="checkbox" class="filled-in" id="wow" value="WOW" />\
                                                <label for="wow" style="margin-right: 20px;"><img src="/giaodien/img/wow.png" style="width:24px" data-toggle="tooltip" title="" data-original-title="Ngạc Nhiên"></label>\
                                                <input name="camxuc[]" type="checkbox" class="filled-in" id="sad" value="SAD" />\
                                                <label for="sad" style="margin-right: 20px;"><img src="/giaodien/img/sad.png" style="width:24px" data-toggle="tooltip" title="" data-original-title="Buồn"></label>\
                                                <input name="camxuc[]" type="checkbox" class="filled-in" id="angry" value="ANGRY" />\
                                                <label for="angry" style="margin-right: 20px;"><img src="/giaodien/img/angry.png" style="width:24px" data-toggle="tooltip" title="" data-original-title="Phẫn Nộ"></label>\
                                            </div>\
                                        </div>\
                                    </div>\
                                <div class="modal-footer">\
                                    <button type="button" class="btn btn-success waves-effect" id="btn2" onclick="update_vip()"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Chỉnh Sửa</button>\
                                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Đóng</button>\
                                </div>\
                            </div>\
                        </div>\
                    </div>';
                    $("#show-modal").html(tpl);
                    get_package();
                    $('[data-toggle="tooltip"]').tooltip();
                }
            })

        });
        $(document).on('click', '.btnActionModuleItem', function(){
            var _that = $(this);
            if (_that.is(":checked")) {
                var checked = 'checked';
                var value = _that.val();
            } else {
                var checked = '';
                var value = _that.val();
            }
            $.ajax({
                url     : '../core/xt_modun/modun.php',
                type    : 'POST',
                dataType: 'JSON',
                data    : {
                    t       : 'action-vip-like',
                    checked      : checked,
                    value : value
                },
                success: (data) => {
                    if (data.error) {
                        toastr.error(data.msg, "Thông Báo Lỗi");
                    } else {
                        toastr.success(data.msg, "Thông Báo");
                    }
                }
            })
        })
        function get_package(){
            var option = '';
            $.ajax({
                url     : '../core/xt_modun/modun.php',
                type    : 'POST',
                dataType: 'JSON',
                data    : {
                    t           : 'get_name_package',
                },
                success : (data) => {
                    $.each(data, (i, item) => {
                        option += '<option value="'+item.name+'">'+item.name+'</option>';
                    })

                    setTimeout(function(){
                        $("#package-vip").html(option);
                    }, 500);
                }
            })
        }
        function trim(s){
            while (s.substring(0,1) == "|"){
                s = s.substring(1, s.length);
            }
            while (s.substring(s.length-1, s.length) == "|") {
                s = s.substring(0,s.length-1);
            }
            return s;
        }
        function update_vip(){
            var fbid = $("#fbid-up").val();
            var name = $("#name-up").val();
            var speed = $("#speed-up").val();
            var cx = '';
            $('.filled-in:checked').each(function(){
                var values = $(this).val();
                cx += values+'|';
            })
            if (!fbid || !name) {
                showNotification('bg-red','Vui Lòng Điền Đầy Đủ Thông Tin!');
                return;
            }
            $("#btn2").html('<i class="fa fa-refresh fa-spin"></i> Vui Lòng Đợi');
            $.ajax({
                url     : '../core/xt_modun/modun.php',
                type    : 'POST',
                dataType: 'JSON',
                data    : {
                    t           : 'update-vip-like',
                    id          : $('#id-up').val(),
                    name        : name,
                    fbid         : fbid,
                    speed       : speed,
                    camxuc  : trim(cx)
                },
                success : (data) => {
                    $("#btn2").html('<i class="fa fa-check-square-o" aria-hidden="true"></i> Hoàn Thành');
                    if (data.error) {
                        toastr.error(data.msg, "Thông Báo Lỗi");
                    } else {
                        toastr.success(data.msg, "Thông Báo");
                        load_vip();
                    }
                    setTimeout(function(){
                        $('#edit-vip').modal('hide');
                    }, 500);
                }
            })
        }
        function del_package(){
            var data = $("#result-vip").DataTable().rows('.active').data();
            if (data.length == 0) {
                toastr.error('Vui lòng chọn 1 gói VIP để xóa!', 'Thông báo');
                return;
            }
            swal({
              title: 'Bạn muốn xóa gói VIP ' + data[0][2],
              text: "Không thể phục hồi sau khi xóa",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Vâng, Tôi muốn xóa!',
              cancelButtonText: 'Trở về'
            }).then(function() {
              submit_del(data[0][0]);
            })
        }
        function submit_del(id){
            $.ajax({
                url     : '../core/xt_modun/modun.php',
                type    : 'POST',
                dataType: 'JSON',
                data    : {
                    t           : 'delete-vip',
                    id          : id, 
                    type        : 'vip_like' 
                },
                success : (data) => {
                    if (data.error) {
                        toastr.error(data.msg, "Thông Báo Lỗi");
                    } else {
                        toastr.success(data.msg, "Thông Báo");
                        load_vip();
                    }
                }
            })
        }

        function load_vip(){
            $('#result-vip').DataTable({
                destroy: true,
                "ajax": '../core/xt_modun/modun.php?t=load-vip-like',
                "columns": [{
                        title: "ID"
                    },
                    {
                        title: "AVT"
                    },
                    {
                        title: "FB ID"
                    },
                    {
                        title: "NAME"
                    },
                    {
                        title: "GÓI"
                    },
                    {
                        title: "TYPE REACT"
                    },
                    {
                        title: "NGÀY HẾT HẠN"
                    },
                    {
                        title: "TỐC ĐỘ"
                    },
                    {
                        title: "STATUS"
                    },
                ],
                "language": {
                    "search": "Tìm Kiếm",
                    "paginate": {
                        "first": "Về Đầu",
                        "last": "Về Cuối",
                        "next": "Tiến",
                        "previous": "Lùi"
                    },
                    "info": "Hiển thị _START_ đến _END_ của _TOTAL_ mục",
                    "infoEmpty": "Hiển thị 0 đến 0 của 0 mục",
                    "lengthMenu": "Hiển thị _MENU_ mục",
                    "loadingRecords": "Đang tải...",
                    "emptyTable": "Không có gì để hiển thị",
                }
            });
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