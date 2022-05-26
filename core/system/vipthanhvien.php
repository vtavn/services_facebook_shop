

<div class="col-md-12"> 
              <!-- USERS LIST --> 
              <div class="box box-danger"> 
                <div class="box-header with-border"> 
                  <h3 class="box-title">QUẢN LÝ & ĐIỀU HÀNH HỆ THỐNG</h3> 

                  <div class="box-tools pull-right"> 
                    <span class="label label-danger">2 New Members</span> 
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> 
                    </button> 
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i> 
                    </button> 
                  </div> 
                </div> 
                <!-- /.box-header --> 
                <div class="box-body no-padding"> 
                  <ul class="users-list clearfix"> 
                    <?php 
                      $i = 1; 
                      $req = mysqli_query($vtasystem, "SELECT * FROM account WHERE level=1 ORDER BY id ASC");  
                      while($x = mysqli_fetch_assoc($req)){  
                    ?> 
                    <li>  
                      <img src="https://graph.facebook.com/<?php echo $x['idfb']; ?>/picture?width=128&amp;height=128" alt="User Image"> 
                      <a class="users-list-name" href="#"><?php echo $x['fullname']; ?></a> 
                      <span class="users-list-date">Admin</span> 
                    </li> 
                    <?php } ?>  
                  </ul> 
                  <!-- /.users-list --> 
                </div> 
                <!-- /.box-body --> 
                <div class="box-footer text-center"> 
                  <a href="javascript:void(0)" class="uppercase">View All Users</a> 
                </div> 
                <!-- /.box-footer --> 
              </div> 
              <!--/.box --> 
            </div> 
<div class="col-md-12"> 
              <!-- USERS LIST -->   
              <div class="box box-danger"> 
                <div class="box-header with-border"> 
                  <h3 class="box-title">ĐẠI LÝ UY TÍN</h3> 
                  <div class="box-tools pull-right"> 
                    <span class="label label-danger">3 New Members</span> 
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> 
                    </button> 
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i> 
                    </button> 
                  </div> 
                </div> 
                <!-- /.box-header --> 
                <div class="box-body no-padding"> 
                  <ul class="users-list clearfix"> 
                    <?php 
                      $i = 1; 
                      $req = mysqli_query($vtasystem, "SELECT * FROM account WHERE level=2 AND otp = 1 ORDER BY id ASC");  
                      while($x = mysqli_fetch_assoc($req)){  
                    ?> 
                    <li>  
                      <img src="https://graph.facebook.com/<?php echo $x['idfb']; ?>/picture?width=128&amp;height=128" alt="User Image"> 
                      <a class="users-list-name" href="#"><?php echo $x['fullname']; ?></a> 
                      <span class="users-list-date">Đại Lý</span> 
                    </li> 
                    <?php } ?>  
                  </ul> 
                  <!-- /.users-list --> 
                </div> 
                <!-- /.box-body --> 
                <div class="box-footer text-center"> 
                  <a href="javascript:void(0)" class="uppercase">View All Users</a> 
                </div> 
                <!-- /.box-footer --> 
              </div> 
              <!--/.box --> 
            </div> 
            