
<?php 
session_start(); 
error_reporting(0); 
include "config.php"; 
$dongcua = '0'; //1 là đóng của 0 là mở cửa 
if($dongcua == '1'){ 
    echo '<title>Hệ Thống Bảo Trì</title>'; 
    echo '<i>Hệ thống bảo trì 10 Phút!!</i>'; 
    echo '<iframe src="https://www.nhaccuatui.com/mh/background/f32o3Q4f6Q" width="1" height="1" frameborder="0" allowfullscreen></iframe>'; 
}else{ 
include "./core/head.php"; 
if($_GET['vip'] == 'Top_Nap_The'){ 
include "core/system/topcard.php"; 
} 
if($_GET['vip'] == 'Top_Tieu_Tien'){ 
include "core/system/rank.php"; 
} 
if($_GET['vip'] == 'Huong_Dan_QR'){ 
include "core/system/qr.php"; 
} 
if($_GET['vip'] == 'HETHONGSONGAO_COM'){ 
include "core/system/vipthanhvien.php"; 
} 
if($_GET['vip'] == 'Get_Token'){ 
include "core/tools/gettoken/gettoken.php"; 
} 
if(!$_SESSION['user']){ 

//chưa login 
if($_GET['vip'] == null){ 
include "core/system/homepage.php"; 
} 

if($_GET['vip'] == 'tao_tai_khoan'){ 
    include'core/system/reg.php'; 
} 
if($_GET['vip'] == 'login_page'){ 
    include'core/system/login.php'; 
} 
if($_GET['vip'] == 'lay_mat_khau'){ 
    include'core/system/forgot-password.php'; 
} 
}else{ 
if($getuser['kichhoat'] <  '1') { 
if($_GET['vip'] == null){ 
include "core/system/kichhoat.php"; 
} 
if($_GET['vip'] == 'nap_the'){ 
    include"core/member/napthe.php"; 
}   
} else if($getuser['block'] == '2'){ 
  if($_GET['vip'] == null){ 
include "core/system/blockcmnr.php"; 
}   
}else /*if($getuser['otp'] == '1'){ 
if($_GET['vip'] == null){ 
include "core/member/otp.php"; 
} 
} else if($getuser['qrcode'] == '1' && ){  

if($_GET['vip'] == null){ 
include "core/system/tet2018.php"; 
} 

}else*/ { 
if($_GET['vip'] == 'Qua_Tang_Tet_2018_Hethongsongao-team'){ 
include "core/system/tet2018.php"; 
} 
//đã login 
if($_GET['vip'] == null){ 
    include "core/system/menu2.php"; 
} 

if($_GET['vip'] == 'menu'){ 
    include"core/system/menu.php"; 
} 

if($_GET['vip'] == 'logout'){ 
    include"core/system/logout.php"; 
} 
//báo danh 
if($_GET['vip'] == 'bao_danh'){ 
    include"core/system/bao_danh.php"; 
} 

//chung 
if($_GET['vip'] == 'nap_the2'){ 
    include"core/member/napthe.php"; 
} 
if($_GET['vip'] == 'nap_the'){ 
    include"core/member/doithe.php"; 
} 
//ticket 
if($_GET['vip'] == 'ticket'){ 
    include"core/ticket/ticket.php"; 
} 
if($_GET['vip'] == 'view_ticket'){ 
    include"core/ticket/view.php"; 
} 
if($_GET['vip'] == 'quanly_ticket'){ 
    include"core/ticket/adminticket.php"; 
} 
if($_GET['vip'] == 'viewadmin_ticket'){ 
    include"core/ticket/adminview.php"; 
} 
//tools  
if($_GET['vip'] == 'get_id_user'){ 
    include"core/tools/get_id_user.php"; 
} 
if($_GET['vip'] == 'get_id_post'){ 
    include"core/tools/get_id_post.php"; 
} 
//Vip buff 
if($_GET['vip'] == 'buff-react'){ 
    include"core/vipbuff/buff_react.php"; 
} 

//vip buff like 
if($_GET['vip'] == 'vip_buff_like'){ 
    include 'core/vipbuff/vip_buff_like.php'; 
} 
//Vip bot cmt 
if($_GET['vip'] == 'add_vipbot_cmt'){  
    include'core/vipbotcmt/add.php'; 
} 
if($_GET['vip'] == 'manager_vipbot_cmt'){  
    include'core/vipbotcmt/list.php'; 
} 
if($_GET['vip'] == 'update_vipbot_cmt'){  
    include'core/vipbotcmt/update.php'; 
} 


//token  
if($_GET['vip'] == 'add_token'){ 
    include'core/admin/token/add.php'; 
} 
if($_GET['vip'] == 'del_token'){ 
    include'core/admin/token/del.php'; 
} 
if($_GET['vip'] == 'add_token_cmt'){ 
    include'core/admin/token/addcmt.php'; 
} 
if($_GET['vip'] == 'del_token_cmt'){ 
    include'core/admin/token/delcmt.php'; 
} 
//Vip bot cx 
if($_GET['vip'] == 'add_vipbot'){ 
    include"core/vipbot/add.php"; 
} 
if($_GET['vip'] == 'manager_vipbot'){ 
    include"core/vipbot/list.php"; 
} 
if($_GET['vip'] == 'update_vipbot'){ 
    include"core/vipbot/update.php"; 
} 
if($_GET['vip'] == 'log-vip-bot'){ 
    include"core/vipbot/log.php"; 
} 

//Vip bot cmt sticker
if($_GET['vip'] == 'add_vipbot_sticker'){ 
    include"core/botsticker/add.php"; 
} 
if($_GET['vip'] == 'manager_vipbot'){ 
    include"core/vipbot/list.php"; 
} 
if($_GET['vip'] == 'update_vipbot'){ 
    include"core/vipbot/update.php"; 
} 
if($_GET['vip'] == 'log-vip-bot'){ 
    include"core/vipbot/log.php"; 
} 

//Vip like cx 
if($_GET['vip'] == 'add_viplikecx'){ 
    include"core/viplikecx/add.php"; 
} 
if($_GET['vip'] == 'manager_viplikecx'){ 
    include"core/viplikecx/list.php"; 
} 
if($_GET['vip'] == 'update_viplikecx'){ 
    include"core/viplikecx/update.php"; 
} 

if($_GET['vip'] == 'manage_vip_like'){ 
    include"core/viplikecx/view_list.php"; 
} 
//Vip cmt 
if($_GET['vip'] == 'add_vipcmt'){ 
    include"core/vipcmt/add.php"; 
} 
if($_GET['vip'] == 'manager_vipcmt'){ 
    include"core/vipcmt/list.php"; 
} 
if($_GET['vip'] == 'update_vipcmt'){ 
    include"core/vipcmt/update.php"; 
} 
//packer like 
if($_GET['vip'] == 'add_package_like'){ 
    include"core/package/like/add.php"; 
} 
if($_GET['vip'] == 'list_package_like'){ 
    include"core/package/like/list.php"; 
} 
if($_GET['vip'] == 'edit_package_like'){ 
    include"core/package/like/edit.php"; 
} 

//packer cmt 
if($_GET['vip'] == 'add_package_cmt'){ 
    include"core/package/cmt/add.php"; 
} 
if($_GET['vip'] == 'list_package_cmt'){ 
    include"core/package/cmt/list.php"; 
} 
if($_GET['vip'] == 'edit_package_cmt'){ 
    include"core/package/cmt/edit.php"; 
} 

//gift code 
if($_GET['vip'] == 'tao_gift'){ 
    include"core/admin/system/gifcode.php"; 
} 
if($_GET['vip'] == 'nhan_gift'){ 
    include"core/member/gif_code.php"; 
} 

//Admin 
//ajax 
if($_GET['vip'] == 'manager_member'){ 
    include"core/admin/member/view_member.php"; 
} 
// end 

if($_GET['vip'] == 'setting'){ 
    include"core/admin/system/setting.php"; 
} 
if($_GET['vip'] == 'edit_thong_bao'){ 
    include"core/admin/system/editthongbao.php"; 
} 
if($_GET['vip'] == 'statics'){ 
    include"core/admin/system/statics.php"; 
} 
if($_GET['vip'] == 'list_id_vip_camxuc'){ 
    include"core/admin/system/list_id_vip_camxuc.php"; 
} 
if($_GET['vip'] == 'list_id_vip_bot'){ 
    include"core/admin/system/list_id_bot.php"; 
} 
if($_GET['vip'] == 'update_like_admin'){ 
    include"core/xt_modun/update_like_admin.php"; 
} 

if($_GET['vip'] == 'update_tai_khoan_hethong'){ 
    include"core/xt_modun/edit_member.php"; 
} 
if($_GET['vip'] == 'lich_su_he_thong'){ 
    include"core/admin/system/lich_su.php"; 
} 
if($_GET['vip'] == 'tao_thong_bao'){ 
    include"core/admin/system/taothongbao.php"; 
} 
if($_GET['vip'] == 'them_coupon'){ 
    include"core/admin/system/magiamgia.php"; 
} 
//Tài khoản 
if($_GET['vip'] == 'tai_khoan_core'){ 
    include"core/admin/member/tai_khoan_core.php"; 
} 
if($_GET['vip'] == 'update_tai_khoan_core'){ 
    include"core/xt_modun/edit_member.php"; 
} 
if($_GET['vip'] == 'quan_ly_dai_ly'){ 
    include"core/admin/member/danh_sach_daily.php"; 
} 
if($_GET['vip'] == 'quan_ly_ctv'){ 
    include"core/admin/member/danh_sach_ctv.php"; 
} 
if($_GET['vip'] == 'them_chuc_vu'){ 
    include"core/admin/member/them_chuc_vu.php"; 
} 
if($_GET['vip'] == 'chuyen_tien'){ 
    include"core/admin/member/chuyen_tien.php"; 
} 

//member 
if($_GET['vip'] == 'change_pass'){ 
    include"core/member/doi_pass.php"; 
} 
if($_GET['vip'] == 'change_pass_2'){ 
    include"core/member/change_pass.php"; 
} 
if($_GET['vip'] == 'change_info'){ 
    include"core/member/change_info.php"; 
} 
if($_GET['vip'] == 'log_active'){ 
    include"core/member/lich_su.php"; 
} 
//đại lý 
if($_GET['vip'] == 'them_ctv'){ 
    include"core/daily/them_ctv.php"; 
} 
if($_GET['vip'] == 'quan_ly_ctv_cuaminh'){ 
    include"core/daily/quan_ly_ctv_cuaminh.php"; 
} 
} 

} 
include "./core/foot.php"; 
} 
?>  
