<?php if($_GET[id]){  ?>
<div class="col-lg-12">
 <div class="panel panel-default">
                   <div class="panel-heading">
                             <b>LOG VIP BOT <small>Lịch sử hoạt động </small></b>
                        </div>
       <div class="panel-body">
<div class="table-responsive">
                            <table class="table table-bordered" width="100%" id="log-ibot">
                            </table>
       </div>
    </div>
  </div>
</div>
  <script type="text/javascript">
        $(document).ready(function(){
            load_vip();
        });
        function load_vip(){
            $('#log-ibot').DataTable({
                destroy: true,// bị cl gì thế nhỉ hự hự trk có 1 lần e hỏi a cái này. cùng dính cái í sau bó tay :V
                "ajax":'../core/xt_modun/modun.php?t=load-log-vip-bot&idUser=<?php echo $_GET[id];?>',
                "columns": [
                    {
                        title: "IDFB"
                    },
                    {
                        title: "FB NAME"
                    },
                    {
                        title: "ID THẢ"
                    },
                    {
                        title: "CẢM XÚC"
                    },
                    {
                        title: "THẢ CHO ID"
                    },
                    {
                        title: "VÀO LÚC"
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
    </script>
    <?php } ?>