<?php
if($getuser['level'] != 1) {  
echo '<meta http-equiv=refresh content="0; URL=/index.php">'; 
}else{ 
function radom_code($length = 12) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
<script src="/giaodien/edit-table/jquery.tabledit.min.js"></script>

<div class="col-md-6">
    <div class="panel panel-border panel-inverse">
        <div class="panel-heading">
            <h3 class="panel-title">Tạo GifCode</h3> </div>
        <div class="panel-body">
            <form class="form">
                <div class="form-group">
                    <label for="code">* CODE :</label>
                    <input type="text" class="form-control" id="code" placeholder="Gif Code" value="VTA<?=radom_code()?>HTSA" name="code"> </div>
                <div class="form-group">
                    <label for="limit">* Giới hạn (lượt) : </label>
                    <input type="number" class="form-control" id="limit" placeholder="Giới hạn cho gif code" name="limit" required=""> </div>
                <input type="hidden" name="action" value="creat">
                <div class="form-group">
                    <label for="price">* Mệnh giá :</label>
                    <input type="number" class="form-control" id="price" placeholder="Mệnh giá của gif code" name="menhgia" required=""> </div>
                <button class="btn btn-block btn-info" type="submit">Tạo Gif</button>
            </form>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="panel panel-border panel-inverse">
        <div class="panel-heading">
            <h3 class="panel-title">Code gần đây</h3> </div>
        <div class="panel-body">
            <?php 
            $gif_code  = mysqli_query($vtasystem, "SELECT  * FROM gif_code ORDER BY `id` DESC LIMIT 0,3"); 
                while($code = mysqli_fetch_array($gif_code)){ 
                    echo '<b> Gif Code :</b> '.$code['code'].'<br>'; 
                    echo '<b> Lượt còn lại : </b>'.$code['limited'].' lượt<br>'; 
                    echo '<b> Mệnh giá : </b>'.number_format($code['menhgia']).' vnđ <br>'; 
                    echo '----------------------------------<br>'; 
                } 

            ?>     
        </div>
    </div>
</div>


<div class="col-md-12">
    <div class="panel panel-border panel-inverse">
        <div class="panel-heading">
            <h3 class="panel-title">Quản lý các gif code</h3> </div>
        <div class="panel-body">
            <table class="table table-responsive" id="edit_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>CODE</th>
                        <th>Còn lại</th>
                        <th>Mệnh giá</th>
                    </tr>
                </thead>
                <tbody>
                    <?php    
                     $select=mysqli_query($vtasystem, "SELECT * FROM gif_code");  
                    while ($user=mysqli_fetch_array($select)) { ?> 
                    <tr> 
                        <td><?=$user['id']?></td> 
                        <td><?=$user['code']?></td> 
                        <td><?=$user['limited']?></td> 
                        <td><?=$user['menhgia']?></td> 
                    </tr> 
                    <?php } ?>  </tbody>
            </table>
        </div>
    </div>
    </div>

<script type="text/javascript">
$("form").submit(function() {
    $.post('core/xt_modun/admin-gifcode.php', $(this).serialize()).done(function(data) {
        if(data == 'error') {
            swal("Lỗi", "Gif code này đã được tạo trước đó xin thử gif khác", "warning");
        } else {
            swal("Thành công", "Tạo Gif thành công", "success");
        }
    }).fail(function() {
        alert('Loi');
    });
    return false;
});
         
    $('#edit_table').Tabledit({
    url: 'core/xt_modun/admin-gifcode.php',
    columns: {


        identifier: [0, 'id'],
        editable: [[2, 'conlai'], [3, 'menhgia']]
    },
    onDraw: function() {
        console.log('onDraw()');
    },
    onSuccess: function(data, textStatus, jqXHR) {
        console.log('onSuccess(data, textStatus, jqXHR)');
        console.log(data);
        console.log(textStatus);
        console.log(jqXHR);
    },
    onFail: function(jqXHR, textStatus, errorThrown) {
        console.log('onFail(jqXHR, textStatus, errorThrown)');
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
    },
    onAlways: function() {
        console.log('onAlways()');
    },
    onAjax: function(action, serialize) {
        console.log('onAjax(action, serialize)');
        console.log(action);
        console.log(serialize);
    },

});
</script>
<?php
}
?>