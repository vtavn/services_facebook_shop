         </div> 
        </section> 
    </div> 
<footer class="main-footer">  
        <div class="col-md-3 hidden-xs"> 
          <i class="fa fa-home"></i> Liên Kết Trang 
          <ul> 
            <li><a href="/">Trang chủ</a></li> 
            <li><a href="#" target="_blank">Hướng dẫn</a></li> 
            <li><a href="#" target="_blank">Giới thiệu</a></li> 
            <li><a href="https:/M.ME/100009580369715" target="_blank">Liên Hệ</a></li> 
          </ul> 
        </div> 
        <div class="col-md-6"> 
          <center> 
            <div style="text-align:center"> 
              <p><b>HETHONGSONGAO.COM<br>Hệ Thống VIP LIKE Hiện Đại Nhất Hiện Nay</b></p> 
              <div> 
                <a><i class="fa fa-twitter-square" style="font-size:36px;color:#000000"></i></a> &nbsp;&nbsp; 
                <a><i class="fa fa-facebook-square" style="font-size:36px;color:#000000"></i></a> &nbsp;&nbsp; 
                <a><i class="fa fa-google-plus-square" style="font-size:36px;color:#000000"></i></a> &nbsp;&nbsp; 
                <a><i class="fa fa-youtube-square" style="font-size:36px;color:#000000"></i></a><br> 
                <small>Development By <i class="fa fa-paper-plane-o"></i> Vũ Tiến Anh</small><br> 
                <small>© 2017 - 2018 VTASYSTEM.COM</small><br> 
              </div> 
            </div>  
          </center> 
        </div> 
        <div class="col-md-3 hidden-xs"> 
          <i class="fa fa-link"></i> Liên Kết Site 
          <ul> 
            <li><a href="https://www.facebook.com/100009580369715" target="_blank">Facebook</a></li> 
            <li><a href="//tuongtac.me" target="_blank">VIP BOT CẢM XÚC PRO</a></li> 
            <li><center><a href="https://hethongsongao.com/"><img src="https://www.easycounter.com/counter.php?hethongsongao" 
border="0" alt="stats counter"></a></center></li> 
          </ul> 
        </div> 
      </footer> 

    <aside class="control-sidebar control-sidebar-dark"> 
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs"> 
            <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li> 
            <!--li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li--> 
        </ul> 
        <div class="tab-content"> 
            <div class="tab-pane active" id="control-sidebar-home-tab"> 
                      <ul class="control-sidebar-menu"> 
                                <li class="list-group-item"> 
                                    <h4> 
                                    <p class="text-danger">Welcome To HeThongSongAo 
                                    </p> 
                                    </h4> 
                                </li> 
<li class="list-group-item"><p class="text-info"><?php echo $user['fullname']; ?></p></li> 
                            </ul>    
                <h3 class="control-sidebar-heading">Recent Updates</h3> 
                <ul class="control-sidebar-menu"> 
                    <li> 
                        <a href="#" data-toggle="modal" data-target="#Modal" data-popup="Update"> 
                            <i class="menu-icon fa fa-thumbs-o-up bg-red"></i> 
                            <div class="menu-info"> 
                                <h4 class="control-sidebar-subheading">VIP LIKE RANDOM REACTIONS</h4> 
                                <p>01 - 01 - 2018</p> 
                            </div> 
                        </a> 
                    </li> 
                </ul>    
                <h3 class="control-sidebar-heading">Support</h3> 
                <ul class="control-sidebar-menu"> 
                    <li> 
                        <a href="https://www.facebook.com/100009580369715" target="_blank"> 
                            <img src="https://graph.facebook.com/100009580369715/picture" class="dev" alt="Vũ Tiến Anh"> 
                            <div class="menu-info"> 
                                <h4 class="control-sidebar-subheading">Vũ Tiến Anh</h4> 
                                <p>Administrators</p> 
                            </div> 
                        </a> 
                    </li> 
                </ul> 
                <ul class="control-sidebar-menu"> 
                    <li> 
                        <a href="https://www.facebook.com/100008312432081" target="_blank"> 
                            <img src="https://graph.facebook.com/100008312432081/picture" class="dev" alt="Văn Thắng Đặng"> 
                            <div class="menu-info"> 
                                <h4 class="control-sidebar-subheading">Văn Thắng Đặng</h4> 
                                <p>Manager & Support</p> 
                            </div> 
                        </a> 
                    </li> 
                </ul> 


            </div> 
            <div class="tab-pane" id="control-sidebar-settings-tab"> 
                <h3 class="control-sidebar-heading">Languages</h3> 
                <ul class="control-sidebar-menu"> 
                    <li> 
                        <a> 
                         <i class="menu-icon fa fa-language bg-red"></i> 
                            <div class="menu-info"> 
                               <h4 class="control-sidebar-subheading">Google Translate</h4> 
                                <p><div id="google_translate_element"></div></p> 
                            </div> 
                        </a> 
                    </li> 
                </ul> 
            </div> 
        </div> 
    </aside> 
</div><!-- END --> 


<script>  
            function startTime()  
            {  
                var today = new Date(); 
                var h = today.getHours(); 
                var m = today.getMinutes(); 
                var s = today.getSeconds(); 
                m = checkTime(m); 
                s = checkTime(s); 
                document.getElementById('timer').innerHTML = h + ":" + m + ":" + s; 
                var t = setTimeout(function() { 
                    startTime(); 
                }, 500); 
            } 
            function checkTime(i)  
            { 
                if (i < 10) { 
                    i = "0" + i; 
                } 
                return i; 
            } 
console.log("%c Source Code: VIP Facebook Auto System - (c) 2017-2018 Code By VTA - Release Date: 29/1/2018 MUA SOURCE LIÊN HỆ 0919.257.664 - FACEBOOK.COM/100009580369715 - CÒN CÓ Ý ĐỊNH COPPY THÌ XIN PHÉP :) ĐỊT THẲNG VÀO MẶT CON MẸ MÀY NHÉ :)) XÚC VẬT!", "color:red; font-size:24px")
   window.fbMessengerPlugins = window.fbMessengerPlugins || {        init: function () {          FB.init({            appId            : '1678638095724206',            autoLogAppEvents : true,            xfbml            : true,            version          : 'v2.10'          });        }, callable: []      };      window.fbAsyncInit = window.fbAsyncInit || function () {        window.fbMessengerPlugins.callable.forEach(function (item) { item(); });        window.fbMessengerPlugins.init();      };      setTimeout(function () {        (function (d, s, id) {          var js, fjs = d.getElementsByTagName(s)[0];          if (d.getElementById(id)) { return; }          js = d.createElement(s);          js.id = id;          js.src = "//connect.facebook.net/en_US/sdk/xfbml.customerchat.js";          fjs.parentNode.insertBefore(js, fjs);        }(document, 'script', 'facebook-jssdk'));      }, 0);      </script>            <div        class="fb-customerchat"        page_id="1941732149410907"        ref="">      </div>     

<!-- Modal --> 
<div id="banggia" class="modal fade" role="dialog"> 
  <div class="modal-dialog"> 

    <!-- Modal content--> 
    <div class="modal-content"> 
      <div class="modal-header"> 
        <button type="button" class="close" data-dismiss="modal">&times;</button> 
        <h4 class="modal-title">Bảng Giá VTASYSTEM.COM</h4> 
      </div> 
      <div class="modal-body"> 
                        <ul class="nav nav-tabs"> 
                            <li class="active"> 
                                <a  href="#like" data-toggle="tab">VIP Cảm Xúc</a> 
                            </li> 
                            <li><a href="#cmt" data-toggle="tab">VIP CMT</a> 
                            </li> 
                        </ul> 
                        <div class="tab-content"> 
                            <div class="tab-pane active" id="like"> 
                                <div class="table-responsive"> 
                                    <table class="table table-bordered"> 
                                        <tr style="color:red"> 
                                            <th>Max CX</th> 
                                            <th>Limit Post</th> 
                                            <th>Giá(Member <font color="red">*</font>)</th> 
                                            <th>Giá (CTV <font color="red">**</font>)</th> 
                                            <th>Giá (Đại Lí <font color="red">***</font>)</th> 

                                        </tr> 
                                        <?php 
                    $get_user = mysqli_query($vtasystem, "SELECT * FROM package_vip ORDER BY id ASC"); 
                                        while ($x = mysqli_fetch_assoc($get_user)) { 
                                            $member = $x['giatien']; 
                                            $daily = $x['giatien'] - $x['giatien'] * 15 / 100; 
                                            $ctv = $x['giatien'] - $x['giatien'] * 5 / 100; 
                                            ?> 
                                            <tr style="font-weight: bold"> 
                                                <td><?php echo $x['name'] . ''; ?></td> 
                                                <td><?php echo $x['limit_post'] . ' Bài/Ngày'; ?></td> 
                                                <td><?php echo number_format($member) . ' VNĐ / Tháng'; ?></td> 
                                                <td><?php echo number_format($ctv) . ' VNĐ / Tháng'; ?></td> 
                                                <td><?php echo number_format($daily) . ' VNĐ / Tháng'; ?></td> 
                                            </tr> 
                                        <?php } ?> 
                                    </table> 
                                </div> 
                            </div> 

                            <div class="tab-pane" id="cmt"> 
                                <div class="table-responsive"> 
                                    <table class="table table-bordered"> 
                                        <tr style="color:red"> 
                                            <th>Max CMT</th> 
                                            <th>Limit Post</th> 
                                            <th>Giá(Member <font color="red">*</font>)</th> 
                                            <th>Giá (CTV <font color="red">**</font>)</th> 
                                            <th>Giá (Đại Lí <font color="red">***</font>)</th> 

                                        </tr> 
                                        <?php 
                                    $get_user = mysqli_query($vtasystem, "SELECT * FROM package_vipcmt ORDER BY id ASC"); 
                                        while ($x = mysqli_fetch_assoc($get_user)) { 
                                            $member = $x['giatien']; 
                                            $daily = $x['giatien'] - $x['giatien'] * 15 / 100; 
                                            $ctv = $x['giatien'] - $x['giatien'] * 5 / 100; 
                                            ?> 
                                            <tr style="font-weight: bold"> 
                                                <td><?php echo $x['name'] . ''; ?></td> 
                                                <td><?php echo $x['limit_post'] . ' Bài/Ngày'; ?></td> 
                                                <td><?php echo number_format($member) . ' VNĐ / Tháng'; ?></td> 
                                                <td><?php echo number_format($ctv) . ' VNĐ / Tháng'; ?></td> 
                                                <td><?php echo number_format($daily) . ' VNĐ / Tháng'; ?></td> 
                                            </tr> 
                                        <?php } ?> 
                                    </table> 
                                </div> 
                            </div> 
                        </div> 
                                 <p><font color="red">(*)</font>: Giá này được áp dụng khi bạn là <b>Member thường </b>trên hệ thống<br /> 
<font color="red">(**)</font>: Giá này được áp dụng khi bạn là <b>Cộng tác viên</b> của hệ thống (Min 200K - 500K )</b><br /> 
<font color="red">(***)</font>: Giá này được áp dụng khi bạn là <b>Đại Lí</b> của hệ thống ( Min 1 - 3 triệu )</b><br /> 
<b>Tất cả đều được hệ thống <font color="red">Tự động giảm</font> khi Thêm VIP ID!<br /> 
<b>Chú ý: Bảng giá trên được áp dụng với <font color="red">số dư tài khoản của bạn trên hệ thống</font>.</b></p> 
                    </div> 
      <div class="modal-footer"> 
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button> 
      </div> 
    </div> 

  </div> 
</div> 

<!-- Mainly scripts --> 
<!--<script type="text/javascript" src="https://yourjavascript.com/141525167513/hieuungphaohoa.js"></script>--> 

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-78749618-6"></script> 
<script> 
  window.dataLayer = window.dataLayer || []; 
  function gtag(){dataLayer.push(arguments);} 
  gtag('js', new Date()); 

  gtag('config', 'UA-78749618-6'); 
</script> 

        <script> 
$(document).ajaxStart(function() { Pace.restart(); });  
    $(function () { 
        $('#example1, #example2,#example3,#example4').DataTable({ 
            "paging": true, 
            "lengthChange": true, 
            "searching": true, 
            "ordering": true, 
            "info": true, 
            "autoWidth": true, 
            "order": [[0, "desc"]] 
        }); 
         
        
    }); 
$(document).ready(function(){ 
toastr.options = { 
  "closeButton": true, 
  "debug": false, 
  "newestOnTop": false, 
  "progressBar": true, 
  "positionClass": "toast-top-right", 
  "preventDuplicates": false, 
  "onclick": null, 
  "showDuration": "300", 
  "hideDuration": "1000", 
  "timeOut": "5000", 
  "extendedTimeOut": "1000", 
  "showEasing": "swing", 
  "hideEasing": "linear", 
  "showMethod": "fadeIn", 
  "hideMethod": "fadeOut" 
} 
}); 
        </script> 
</body> 
</html> 


