<?php
if($getuser['level'] != 1) { 
echo '<meta http-equiv=refresh content="0; URL=/index.php">';
}else{
?>
   

 <div class="col-md-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Danh sách Package Comments</h3>
            </div>
                    <div class="panel-body">

<div class="table-responsive">
        <table id="example2" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Tên</th>
              <th>Max CMT</th>
              <th>MAX POST</th>
              <th>Giá</th>
              <th>Hành Động</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $req = mysqli_query($vtasystem, "SELECT * FROM `package_vipcmt`"); 
            while($res = mysqli_fetch_assoc($req)){ 
            ?> 
            <tr>
              <td>
                <?php echo $res['id']; ?>
              </td>
              <td>
                <?php echo $res['name']; ?>
              </td>
              <td>
                <?php echo number_format($res['limit_cmt']); ?></b> CMT
              </td>
              <td>
                <?php echo number_format($res['limit_post']); ?> POST
              </td>
              <td>
                <?php echo number_format($res['giatien']); ?> VNĐ
              </td>
<td>
                <a title="Chỉnh sửa" class="btn btn-xs btn-danger" href="/index.php?vip=edit_package_cmt&edit=<?php echo $res['id']; ?>"><b> Cập nhật</b></a>   
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>   
      </div>
   </div>
     </div>
   </div>
<?php
}
?>