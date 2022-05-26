<div class="col-lg-6">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Kích Hoạt Tài Khoản</h3>
            </div>
<div class="panel-body">
  <p>Cách duy nhất để kích hoạt là nạp tiền vào hệ thống để được xác minh</p>
  <button type="button" class="btn btn-primary btn-lg" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Vui lòng chờ...">NẠP TIỀN</button>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"> Hướng Dẫn</h3>
            </div>
<div class="panel-body">
<strong>Các bước thực hiện :</strong>
<ol>
<li>Coppy dòng mã trong khung MÃ XÁC NHẬN.</li>
<li>Dán dòng mã vừa coppy trên vào khung nhập mã.</li>
<li>Click OK. Vậy là đã kích hoạt thành công</li>
</ol>
<strong>Tài khoản lập sau 1 tiếng mà không kích hoạt hệ thống tự động xóa tài khoản!</strong>
</div>
</div>
</div>
<script type="text/javascript">
$('.btn').on('click', function() {
    var $this = $(this);
  $this.button('loading');
    setTimeout(function() {
       $this.button('reset');
   }, 8000);
      window.location.href = "/index.php?vip=nap_the";
});

</script>