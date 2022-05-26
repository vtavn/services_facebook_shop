<?php
    //goi thu vien
    include "class.smtp.php";
    include "class.phpmailer.php"; 
    include "func.php"; 
    $title = 'TEST GỬI MAIL NÈ';
    $content = 'TEST GỬI MAIL THÔI';
    $nTo = 'Huudepzai';
    $mTo = 'vutienanh2901@gmail.com';
    $diachicc = 'hethongsongao@gmail.com';
    //test gui mail
    $mail = guimailvta($title, $content, $nTo, $mTo,$diachicc='');
    if($mail==1)
    echo 'mail của bạn đã được gửi đi hãy kiếm tra hộp thư đến để xem kết quả. ';
    else echo 'Co loi!';
?>