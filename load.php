
<title>LOAD 1</title> 
<?php 
session_start(); 
error_reporting(0); 
include 'config.php'; 
?> 
        <table class="table table-bordered table-striped"> 
          <thead> 
            <tr> 
         <th>Hành Động</th> 
          <th>Thời Gian</th> 

            </tr> 
          </thead> 
          <tbody> 
           <?php  
           $id = $_SESSION['id']; 
$req = mysqli_query($vtasystem, "SELECT * FROM `log_ht` WHERE `id_user`=".$_SESSION['user']." ORDER BY id DESC LIMIT 5"); 
while($res = mysqli_fetch_assoc($req)){ 
?> 
            <tr> 
              <td> 
                <?php echo $res['content']; ?> 
              </td> 
            <td> 
                <?php echo date('d/m/Y H:i:s', $res['time']); ?> 
              </td> 
            </tr> 
            <?php 
} 
?> 
          </tbody> 
        </table> 