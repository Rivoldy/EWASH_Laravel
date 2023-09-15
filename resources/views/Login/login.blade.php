<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E-WASH</title>
  <link rel="icon" type="image/png" sizes="16x16" href="{{asset('native/dist/img/fav.png')}}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('native/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('native/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('native/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
  <img src="{{asset('/native/dist/img/fav.png')}}" class="img-size-50 mr-1"><a href="#"><b>E - </b>WASH</a>
  </div>
  <!-- /.login-logo -->
  @if (session('error'))
     <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
    </div>
  @endif
  @if (session('Loginerror'))
     <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('Loginerror') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
    </div>
  @endif
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="{{asset ('loginApi') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input name="nik" type="number" class="form-control" placeholder="NIK" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card-alt"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="pass" type="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row d-flex justify-content-center">
          <!-- /.col -->
          <div>
          <button type="button" class="btn btn-danger mr-4" data-target="#forget" data-toggle='modal'><i class="fal fa-question"></i> Forgot Password</button>
              <button type="submit" class="btn btn-primary"><i class="far fa-sign-in-alt"></i> Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="modal fade" id="forget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="{{asset('native/proses/reset.php')}}" method="POST">
                <div class="modal-body">
                  <div class="input-group">
                    <input class="form-control" type="number" name="cnik" id="cnik" placeholder="Search NIK">
                    <div class="input-group-append">
                      <button type="button" class="btn btn-success" id="bnik"><i class="far fa-search"></i> Check</button>
                    </div>
                  </div>
                  <div id="content" style="display: none;">
                    <div class="row mt-3">
                      <label class="col-2">Nama: </label><span class="col-9" id="lname"></span>
                    </div>
                    <div class="form-group mt-3">
                      <label>Quest 1: </label><span id="lq1"></span>
                      <input class="form-control" required name="ans1" placeholder="Jawaban 1">
                    </div>
                    <div class="form-group mt-3">
                      <label>Quest 2: </label><span id="lq2"></span>
                      <input class="form-control" required name="ans2" placeholder="Jawaban 2">
                    </div>
                    <div class="form-group mt-3">
                      <label>Masukkan password baru anda:</label>
                      <input class="form-control" type="password" name="pass1" required minlength="6" placeholder="Type Your New Password">
                    </div>
                    <div class="form-group mt-3">
                      <label>Ketik ulang password baru anda:</label>
                      <input class="form-control" type="password" name="pass2" required minlength="6" placeholder="Retype Your New Password">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" id="bchange" disabled class="btn btn-danger">Save changes</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
          </div>
        </div>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('native/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('native/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('native/dist/js/adminlte.min.js')}}"></script>
<script>
$(document).on('click', '#bnik', function() {
    var id = $('#cnik').val();
    $.ajax({
        method: "POST",
        url: "/native/ajax/ceknikp.php", // URL langsung ke file di dalam direktori public
        data: {
            id: id
        },
        success: function(hasil) {
            if (hasil == 'nv') {
                $("#content").hide();
                $('#bchange').prop('disabled', true);
                alert('NIK tidak terdaftar!!');
            } else {
                param = hasil.split(",..,");
                $("#content").show();
                $('#bchange').prop('disabled', false);
                $('#lname').text(param[0]);
                $('#lq1').text(param[1]);
                $('#lq2').text(param[2]);
            }
            // $('#nama').val(hasil);
        }
    });
});
</script>

</body>
</html>
