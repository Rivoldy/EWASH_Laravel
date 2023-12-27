<?php
if (!isset($_POST['nik'])) {
  header('location:unpack.php');
}
require_once '../../proses/conn.php';
include '../../encdec/sclass.php';
$dono = $_POST['dono'];
$reason = $_POST['reason'];
$qtypo = $_POST['qtypo'];
$dest = $_POST['dest'];
$overship = $_POST['overship'];
$podate = $_POST['podate'];
$total1 = $_POST['total'];
$nik = $_POST['nik'];
$pass = enc($_POST['pass']);
$lahir = date('Y-m-d', strtotime($_POST['lahir']));
$akses = mysqli_query($db, "select * from akses where nik='$nik'");
$da = mysqli_fetch_assoc($akses);
if ($da['otentikasi'] == "False" or $da['otentikasi'] == "") {
?>
  <script language="JavaScript">
    alert('User Approval Tidak Ada Akses!!');
    document.location = '../modunpack'
  </script><?php
          } else {
            $cek = mysqli_query($man, "SELECT * from users where nik='$nik' and password='$pass' and tgllahir='$lahir' ");
            if (mysqli_num_rows($cek) == 0) {
            ?>
    <script language="JavaScript">
      alert('User Approval Tidak Valid!!');
      document.location = '../modunpack'
    </script>
<?php
            }
          }
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <?php include '../head.php'; ?>
  <title>Pack&GO</title>

  <script>

  </script>
  <!--Sidebar End-->

<body onload="display_ct();">
  <div class="container-fluid animatedParent animateOnce pt-4">
    <div class="card pt-3 border-danger col-sm-12">
      <div class="animated fadeInUpShort d-flex justify-content-center">
        <h2 class="text-center">Unpack Carton Manual</h2>
      </div>
      <div class="d-flex justify-content-center">
        <input type="text" name="cartonid" placeholder="Type Carton Number" class="form-control col-4" autocomplete="off" autofocus>
      </div>
      <table class="" style="font-size: 14pt">
        <tr>
          <td colspan="4" align="right">
            <p id="ct"></p>
          </td>
        </tr>
        <tr>
          <td style="min-width: 650pt"><?= $dono ?></td>
          <td>QTY PO + Allowance</td>
          <td><?= $total1 ?></td>
          <td>Pcs</td>
        </tr>
        <tr>
          <td><?= $dest ?> (PO Date: <?= $podate ?>)</td>
          <td>Total PO Carton</td>
          <td><?= $total = mysqli_num_rows(mysqli_query($db, "select * from listcarton where donumber='$dono' group by cartoncode")) ?></td>
          <td>Carton</td>
        </tr>
        <tr>
          <td style="font-size: 15pt;">Unpack Reason: <label class="badge badge-warning"><?= $reason ?> </label></td>
          <td>Total Finished Scan&Pack</td>
          <td><?= $scanned = mysqli_num_rows(mysqli_query($db, "select * from listcarton where donumber='$dono' and scanstatus='Complete' group by cartoncode")) ?></td>
          <td>Carton</td>
        </tr>
        <tr>
          <td>Total Unpack: <label class="badge badge-danger"><b id="jumctn"></b> Carton</label></td>
          <td>Total Not Finished Scan&Pack</td>
          <td><?= $total - $scanned ?></td>
          <td>Carton</td>
        </tr>
      </table>
      <div class="card-body pl-3">
        <div class="table-responsive" style="width: 90%; margin-left: 5%; ">
          <table id="example" class="table table-sm table-hover table-striped table bordered">
            <thead>
              <tr>
                <th>Carton Code</th>
                <th>Setname</th>
                <th>Color</th>
                <th>Size</th>
                <th>Qty</th>
              </tr>
            </thead>
            <tbody id="bodit">
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="text-center">
          <a href="../modunpack" onclick="return confirm('Finish Unpack Scan?')" class="btn btn-danger btn-lg ml-5"><i class="far fa-sign-out"></i> Finish</a>
        </div>
      </div>
    </div>
    <div>
      <audio id="audiocom">
        <source src="../../sound/scsunpack.mp3" type="audio/mpeg">
      </audio>
      <audio id="audiowrong">
        <source src="../../sound/wrong.wav" type="audio/mpeg">
      </audio>
    </div>
  </div>
</body>
<style>
  input {
    text-align: center;
  }
</style>
<script>
  var complete = document.getElementById("audiocom");
  var wrong = document.getElementById("audiowrong");
  $('input[name=cartonid]').on('keypress', function() {
    complete.pause();
    wrong.pause();
  })

  function playcomplete() {
    complete.currentTime = 0;
    complete.play();
    setTimeout(() => {
      complete.pause();
    }, 2000);
  }

  function playwrong() {
    wrong.currentTime = 0;
    wrong.play();
    setTimeout(() => {
      wrong.pause();
    }, 3000);
  }
  $('input[name=cartonid]').keypress(function(e) {
    if (e.which == '13') {
      var cartoncode = $(this).val();
      if (cartoncode != '') {
        var nikau = '<?= $nik ?>';
        var reason = '<?= $reason ?>';
        var dono = '<?= $dono ?>';
        $.ajax({
          url: 'http://127.0.0.1:8000/storage/ewash/pages/tra_unpack/ajax/cekunscan.php',
          method: 'post',
          data: {
            cartoncode,
            reason,
            nikau,
            dono
          },
          success: function(a) {
            $('input[name=cartonid]').val('');
            if (a == 'deliv') {
              playwrong();
              alert('Gagal Unpack! Status Carton sudah Delivery')
            } else if (a == 'kosong') {
              playwrong();
              alert('Gagal Unpack! Status Carton belum Scanpack')
            } else if (a == 'not') {
              playwrong();
              alert('Gagal Unpack! Carton tidak terdaftar atas DO ' + dono);
            } else {
              $.ajax({
                url: 'http://127.0.0.1:8000/storage/ewash/pages/tra_unpack/ajax/getcarton.php',
                method: 'post',
                data: {
                  carton: a
                },
                success: function(as) {
                  $('#bodit').append(as);
                  var jumctn = $('#bodit tr').length;
                  $('#jumctn').text(jumctn - 1);
                }
              });
              playcomplete();
            }
          }
        })
      }
    }
  });

  $(document).ready(function() {
    $('.do').select2({
      placeholder: 'Select DO',
    });
    $('.remark').select2({
      placeholder: 'Select Reason',
    });
    $('#example').DataTable({
      scrollY: '50vh',
      scrollCollapse: true,
      paging: false,
      "searching": false,
      "ordering": false,
      bInfo: false
    });
  });

  function display_c() {
    var refresh = 1000; // Refresh rate in milli seconds
    mytime = setTimeout('display_ct()', refresh)
  }

  function display_ct() {
    var x = new Date();
    var mo = x.getMonth() + 1;
    var x1 = x.getDate() + "/" + mo + "/" + x.getFullYear();
    x1 = x1 + " - " + x.getHours() + ":" + x.getMinutes() + ":" + x.getSeconds();
    document.getElementById('ct').innerHTML = x1;
    display_c();
  }

  function validateform() {
    var remark = document.forms["myForm"]["remark"].value;
    if (remark == "") {
      alert("Silahkan pilih Reason dulu!!");
      return false;
    }
  };
</script>
</body>

</html>