
<?php 
session_start(); 
error_reporting(0); 
include '../../config.php'; 
include '../../core/functions.php'; 
if($_POST['type'] == 'get-package'){ 
    $username = $getuser['username']; 
    $id = $_POST['id_package']; 
    $time = $_POST['time']; 
    $return = array('error' => 0); 
    $get_package = mysqli_query($vtasystem, "SELECT * FROM package_vip WHERE id = $id LIMIT 1"); 
    if ($get_package) { 
        $package = mysqli_fetch_assoc($get_package); 
        $price = $package['giatien']*$time; 
    }  
    $coppon = $_POST['coppon']; 
    $getcoppon = mysqli_fetch_assoc(mysqli_query($vtasystem, "SELECT * FROM coupon_ht WHERE username = '$username'")); 
    $giamgia = $getcoppon['code']; 
    $giam = $getcoppon['giam']; 
}  
    if($coppon !== $giamgia){ 
        if ($getuser['level'] == '2') { 
                    $price -= $price * 15 / 100; 
                } else if ($getuser['level'] == '3') { 
                    $price -= $price * 5 / 100; 
                }else if ($getuser['level'] == '0') { 
                    $price = $price; 
                }else if ($getuser['level'] == '1') { 
                    $price -= $price * 50 / 100; 
                }else if ($getuser['level'] == '4') { 
                    $price -= $price * 20 / 100; 
                } 
                $return['kq'] = false; 
                $return['price'] = $price; 
                $return['thongbao'] = 'Mã giảm giá không tồn tại hoặc đã hết hạn!'; 
    }else if($coppon === $giamgia){ 
        if ($getuser['level'] == '2') { 
                        $tong = 15 + $giam; 
                    $price -= $price * $tong / 100; 
                } else if ($getuser['level'] == '3') { 
                        $tong = 5 + $giam; 
                    $price -= $price * 5 + $tong / 100; 
                }else if ($getuser['level'] == '0') { 
                    $price = $price * $giam / 100; 
                }else if ($getuser['level'] == '1') { 
                    $tong = 20 + $giam; 
                    $price -= $price * $tong / 100; 
                }else if ($getuser['level'] == '4') { 
                    $tong = 20 + $giam; 
                    $price -= $price * $tong / 100; 
                } 
        $return['kq'] = true; 
        $return['price'] = $price; 
        $return['thongbao'] = 'Bạn vừa sử dụng mã giảm giá '.$giam.'%!'; 
    } 
    die(json_encode($return)); 
?>  
