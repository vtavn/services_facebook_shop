 <div class="col-md-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Quản Lý Tài Khoản Thành Viên</h3>

                                <button type="button" class="btn btn-success pull-right" style="display: none;" data-toggle="modal" data-target="#edit-vip" id="btn-edit">Chỉnh Sửa</button>
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
            load_mem();
            $('#result-vip').on( 'click', 'tr', function () {
                if ( $(this).hasClass('active') ) {
                    $(this).removeClass('active');
                    $("#btn-edit").fadeOut('slow');
                }else {
                    $('#result-vip').DataTable().$('tr.active').removeClass('active');
                    $(this).addClass('active');
                    $("#btn-edit").fadeOut('slow', function(){
                        $("#btn-edit").fadeIn('slow');
                    });
                    var data = $("#result-vip").DataTable().rows('.active').data();
                    var vnd = data[0][5].replace(',', '');
                    var tpl = '<div class="modal fade" id="edit-vip" tabindex="-1" role="dialog">\
                        <div class="modal-dialog" role="document">\
                            <div class="modal-content">\
                                <div class="modal-header">\
                                    <h4 class="modal-title">Chỉnh Sửa Thông Tin Tài Khoản Cho ID '+data[0][1]+'</h4>\
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
                                            <label for="fbid-up">FULL NAME</label>\
                                        </div>\
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">\
                                            <div class="form-group">\
                                                <div class="form-line">\
                                                    <input type="text" id="fullname-up" class="form-control" value="'+data[0][1]+'">\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>\
                                    <div class="row clearfix">\
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">\
                                            <label for="name-up">USER NAME</label>\
                                        </div>\
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">\
                                            <div class="form-group">\
                                                <div class="form-line">\
                                                    <input type="text" id="user-up" class="form-control" value="'+data[0][2]+'">\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>\
                                    <div class="row clearfix">\
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">\
                                            <label for="name-up">EMAIL</label>\
                                        </div>\
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">\
                                            <div class="form-group">\
                                                <div class="form-line">\
                                                    <input type="text" id="email-up" class="form-control" value="'+data[0][3]+'">\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>\
                                <div class="row clearfix">\
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">\
                                            <label for="name-up">SĐT</label>\
                                        </div>\
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">\
                                            <div class="form-group">\
                                                <div class="form-line">\
                                                    <input type="number" id="sdt-up" class="form-control" value="'+data[0][4]+'">\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>\
                                    <div class="row clearfix">\
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">\
                                            <label for="name-up">VNĐ</label>\
                                        </div>\
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">\
                                            <div class="form-group">\
                                                <div class="form-line">\
                                                    <input type="text" id="vnd-up" class="form-control" value="'+vnd+'">\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>\
                                <div class="modal-footer">\
                                    <button type="button" class="btn btn-success" id="btn2" onclick="update_vip()"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Chỉnh Sửa</button>\
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Đóng</button>\
                                </div>\
                            </div>\
                        </div>\
                    </div>';
                    $("#show-modal").html(tpl);
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
                    t       : 'action-member',
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
        function update_vip(){
            var fullname = $("#fullname-up").val();
            var user = $("#user-up").val();
            var email = $("#email-up").val();
            var vnd = $("#vnd-up").val();
            var sdt = $("#sdt-up").val();
            if (!fullname || !user || !email || !vnd) {
                showNotification('bg-red','Vui Lòng Điền Đầy Đủ Thông Tin!');
                return;
            }
            $("#btn2").html('<i class="fa fa-refresh fa-spin"></i> Vui Lòng Đợi');
            $.ajax({
                url     : '../core/xt_modun/modun.php',
                type    : 'POST',
                dataType: 'JSON',
                data    : {
                    t           : 'update-member',
                    id          : $('#id-up').val(),
                    fullname         : fullname,
                    user        : user,
                    email        : email,
                    vnd         : vnd,
                    sdt         : sdt
                },
                success : (data) => {
                    $("#btn2").html('<i class="fa fa-check-square-o" aria-hidden="true"></i> Hoàn Thành');
                    if (data.error) {
                        toastr.error(data.msg, "Thông Báo Lỗi");
                    } else {
                        toastr.success(data.msg, "Thông Báo");
                        load_mem();
                    }
                    setTimeout(function(){
                        $('#edit-vip').modal('hide');
                    }, 500);
                }
            })
        }
        function load_mem(){
            $('#result-vip').DataTable({
                destroy: true,
                "ajax": '../core/xt_modun/modun.php?t=load-member',
                "columns": [{
                        title: "ID"
                    },
                    {
                        title: "FULL NAME"
                    },
                    {
                        title: "USER NAME"
                    },
                    {
                        title: "EMAIL"
                    },
                    {
                        title: "SĐT"
                    },
                    {
                        title: "VNĐ"
                    }
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
    </script>