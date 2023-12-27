<?php
require_once '../../proses/conn.php';

// $style = $_GET['s'];
// $kp = $_GET['k'];
// $tipe = $_GET['t'];
$style = $_POST['style'];
$kp = $_POST['kp'];
$tipe = $_POST['tipe'];
$nik = $_POST['nik'];
$reason = $_POST['reason'];

if ($tipe == 'scan') {
  $judul = 'Scan';
} else if ($tipe == 'manual') {
  $judul = 'Manual';
}

$q1 = mysqli_query($sap, "SELECT SUM(ZQTY) AS ZQTY FROM ordersap WHERE ZMATGEN = '$style' AND VBELN = '$kp'");
$r1 = mysqli_fetch_array($q1);
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <?php include '../head.php'; ?>
  <title>E - Wash</title>
</head>

<body onload="display_ct();">
  <div class="container-fluid animatedParent animateOnce pt-4">
    <div class="card pt-3 border-danger col-sm-12">
      <div class="animated fadeInUpShort d-flex justify-content-center">
        <h2 class="text-center">Unpack <?= $judul ?></h2>
      </div>
      <?php if ($tipe == 'manual') { ?>
        <div class="d-flex justify-content-center">
          <input type="text" name="bid" placeholder="Type Bag Number" class="form-control col-4" autocomplete="off" autofocus>
        </div>
      <?php } ?>
      <table class="" style="font-size: 14pt">
        <tr>
          <td colspan="4" align="right">
            <p id="ct"></p>
          </td>
        </tr>
        <tr>
          <td style="min-width: 650pt"><?= $style ?></td>
          <td>QTY Order + Allowance (2%)</td>
          <td><?= $r1['ZQTY'] + (round($r1['ZQTY'] * 0.02)) ?></td>
          <td>Pcs</td>
        </tr>
        <tr>
          <td><?= $kp ?></td>
          <td>Total Pcs Scanned</td>
          <td>
            <?php
            $q2 = mysqli_query($conn, "SELECT SUM(qty) AS qty FROM t_scale WHERE style = '$style' AND kp = '$kp'");
            $r2 = mysqli_fetch_array($q2);
            echo '<h5>' . $r2['qty'] == null ? 0 : $r2['qty'] . '</h5>';
            ?>
          </td>
          <td>Pcs</td>
        </tr>
        <tr>
          <td style="font-size: 15pt;">Unpack Reason: <label class="badge badge-warning"><?= $reason ?> </label></td>
          <td>Total Bag Scanned</td>
          <td>
            <?php
            $q2 = mysqli_query($conn, "SELECT * FROM t_scale WHERE style = '$style' AND kp = '$kp' GROUP BY bid");
            if (mysqli_num_rows($q2) == 0) {
              $bl = 0;
            } else {
              $bl = mysqli_num_rows($q2);
            }
            echo '<h5>' . $bl . '</h5>';
            ?>
          </td>
          <td>Bag</td>
        </tr>
        <tr>
          <td>Total Unpack: <label class="badge badge-danger"><b id="jumctn"></b> Pcs</label></td>
        </tr>
      </table>
      <div class="card-body pl-3">
        <div class="table-responsive" style="width: 90%; margin-left: 5%; ">
          <table id="example" class="table table-sm table-hover table-striped table bordered">
            <thead>
              <tr>
                <th>Bag ID</th>
                <th>Style</th>
                <th>KP</th>
                <th>Qty</th>
                <th>Unpack Date</th>
                <th>PIC</th>
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
        <div class="text-center mt-2">
          <a href="../tra_unpack" onclick="return confirm('Finish Unpack Scan?')" class="btn btn-danger btn-lg ml-5"><i class="far fa-sign-out"></i> Finish</a>
        </div>
        <?php if ($tipe == 'scan') { ?>
          <input type="text" name="bid" style="height:0px;width:0px;border:none" autocomplete="off" autofocus onblur="$(this).focus()">
        <?php } ?>
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

<script>
  var complete = document.getElementById("audiocom");
  var wrong = document.getElementById("audiowrong");
  $('input[name=bid]').on('keypress', function() {
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

  $('input[name=bid]').keypress(function(e) {
    if (e.which == '13') {
      var bid = $(this).val();
      if (bid != '') {
        $.ajax({
          url: 'ajax/index.php',
          method: 'post',
          data: {
            tipe: 'cek',
            bid: bid,
          },
          success: function(a) {
            $('input[name=bid]').val('');
            if (a == 'sukses') {
              $.ajax({
                url: 'ajax/index.php',
                method: 'post',
                data: {
                  bid: bid,
                  oten: '<?= $nik ?>',
                  reason: '<?= $reason ?>',
                  mode: '<?= $tipe ?>',
                  tipe: 'unpack',
                },
                success: function(as) {
                  $('#bodit').append(as);
                  var jumctn = $('#bodit tr').length;
                  $('#jumctn').text(jumctn - 1);
                }

              });
              playcomplete();
            } else {
              Swal.fire('Error', a, 'error');
              playwrong();
            }
          }
        })
      }
    }
  });

  $(document).ready(function() {
    $('#bodit .odd').hide();
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
</script>
</body>

</html>