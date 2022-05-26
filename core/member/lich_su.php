<?php 
date_default_timezone_set('Asia/Ho_Chi_Minh');  
?> 
<div class="col-lg-12"> 
 <div class="panel panel-default"> 
                   <div class="panel-heading"> 
                             <b><i class="fa fa-gears"></i> Quản Lý Lịch Sử</b> 
                        </div> 
<div class="panel-body"> 
<div class="table-responsive"> 
        <table id="example1" class="table table-bordered table-striped"> 
          <thead> 
            <tr> 
              <th>ID</th> 
              <th>Hành Động</th> 
          <th>Thời Gian</th> 

            </tr>  
          </thead> 
          <tbody> 
           <?php 
$req = mysqli_query($vtasystem, "SELECT * FROM `log_ht` WHERE `id_user`=".$getuser['id'].""); 
while($res = mysqli_fetch_assoc($req)){ 
?> 
            <tr> 
              <td> 
               <?php echo $res['id']; ?> 
              </td> 
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
       </div> 
              </div> 
      </div> 

    </div> 