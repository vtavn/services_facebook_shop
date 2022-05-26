<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bá Nhừ V2.1</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container" style="margin-top: 15px;">
        <div class="row">
<div class="col-lg-12">
 <div class="panel panel-default">
                   <div class="panel-heading">
                             <b>ADD TOKEN GET</b>
                        </div>
<div class="panel-body">
<?php
if(isset($_POST[add])){
    $time = time();
    $link = 'https://vutienanh.me/token/files/'.date('d-m-20y H:i:s', $time).'.txt';
    $text = $_POST['token'];
    /*$fp = fopen('token.txt', 'a+');
        fwrite($fp, $text."\n");
        fclose($fp);*/

$fp = fopen('link.txt', 'a+');
        fwrite($fp, $link."\n");
        fclose($fp);

if(!file_exists("files/".date("d-m-20y H:i:s", $time).".txt")){
file_put_contents("files/".date("d-m-20y H:i:s", $time).".txt", $text);
    }
echo '<div class="alert alert-success">THÊM THÀNH CÔNG!</div>';
} 
?>
<form action="" method="POST">
	<div class="form-group">
	  <textarea type="text" class="form-control" name="token" id="token"></textarea>
	</div>
	<button type="submit" name="add" class="btn btn-danger btn-block">Đăng</button>
</form>
                        </div>
                    </div>
                </div>
</body>
</html>