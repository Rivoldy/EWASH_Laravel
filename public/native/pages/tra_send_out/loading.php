<?php
require_once '../../proses/conn.php';
$id = $_GET['i'];
$q = mysqli_query($conn, "SELECT * FROM pl_send WHERE id = '$id'");
$r = mysqli_fetch_array($q);

$q1 = mysqli_query($sap, "SELECT SUM(ZQTY) AS ZQTY FROM ordersap WHERE ZMATGEN = '{$r['style']}' AND VBELN = '{$r['kp']}'");
$r1 = mysqli_fetch_array($q1);
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>E - Wash</title>
  <link rel="icon" href="../../dist/img/fav2.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-fixedcolumns/css/fixedColumns.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../plugins/moment/moment.min.js"></script>
  <script src="../../plugins/select2/js/select2.full.min.js"></script>
  <script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../../plugins/jszip/jszip.min.js"></script>
  <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script src="../../plugins/datatables-fixedcolumns/js/dataTables.fixedColumns.min.js"></script>
  <script src="../../plugins/datatables-fixedcolumns/js/fixedColumns.bootstrap4.min.js"></script>
  <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
  <script src="../../dist/js/adminlte.min.js"></script>

<body onload="display_ct();">
  <div class="container-fluid animatedParent animateOnce pt-4">
    <div class="card pt-3 border-danger col-sm-12">
      <div class="animated fadeInUpShort d-flex justify-content-between">
        <h5><?= $r['pl'] ?></h5>
        <h5 class="text-center"><i class="fas fa-truck-loading fa-fade text-danger"></i> <b>Loading Container</b></h5>
        <h4><span class="badge badge-success" id="ct"></span></h4>
      </div>
      <table style="font-size: 14pt" class="bold">
        <tr>
          <td colspan="4" align="right">

          </td>
        </tr>
        <tr>
          <td rowspan="2" style="min-width: 250pt">
            <h5><?= $r['style'] ?></h5>
          </td>
          <td rowspan="2" style="min-width: 250pt" valign="bottom" align="center"><i class="fas fa-map-pin text-info"></i> <b>Total Scanned Sesi ini:</b></td>
          <td>
            <h5>QTY Order + Allowance (2%)</h5>
          </td>
          <td>
            <h5><?= $r1['ZQTY'] + (round($r1['ZQTY'] * 0.02)) ?></h5>
          </td>
          <td>
            <h5>Pcs</h5>
          </td>
        </tr>
        <tr>
          <td>
            <h5>Total Pcs Scanned</h5>
          </td>
          <td>
            <?php
            $q2 = mysqli_query($conn, "SELECT SUM(qty) AS qty FROM t_scale WHERE style = '{$r['style']}' AND kp = '{$r['kp']}'");
            $r2 = mysqli_fetch_array($q2);
            echo '<h5>' . $r2['qty'] == null ? 0 : $r2['qty'] . '</h5>';
            ?>
          </td>
          <td>
            <h5>Pcs<h5>
          </td>
        </tr>
        <tr>
          <td>
            <h5><?= $r['kp'] ?></h5>
          </td>
          <td rowspan="3" style="min-width: 250pt" class="text-center">
            <h1 class="display-1"><span class="badge badge-info badge-pill" id="qtysesi">0</span></h1>
          </td>
          <td>
            <h5>Total Pcs Loaded</h5>
          </td>
          <td id="pcsloaded">
            <?php
            $q2 = mysqli_query($conn, "SELECT SUM(qty) AS qty FROM t_scale WHERE pl_id = '$id'");
            if (mysqli_num_rows($q2) == 0) {
              $plo = 0;
            } else {
              $r2 = mysqli_fetch_array($q2);
              $plo = $r2['qty'] == null ? 0 : $r2['qty'];
            }
            echo '<h5>' . $plo . '</h5>';
            ?>
          </td>
          <td>
            <h5>Pcs</h5>
          </td>
        </tr>
        <tr>
          <td>
            <h5><?= $r['dest'] ?></h5>
          </td>
          <td>
            <h5>Total Bag Scanned</h5>
          </td>
          <td>
            <?php
            $q2 = mysqli_query($conn, "SELECT * FROM t_scale WHERE style = '{$r['style']}' AND kp = '{$r['kp']}' GROUP BY bid");
            if (mysqli_num_rows($q2) == 0) {
              $bl = 0;
            } else {
              $bl = mysqli_num_rows($q2);
            }
            echo '<h5>' . $bl . '</h5>';
            ?>
          <td>
            <h5>Bag</h5>
          </td>
          </td>
        </tr>
        <tr>
          <td>

          </td>
          <td>
            <h5>Total Bag Loaded</h5>
          </td>
          <td id="bagloaded">
            <?php
            $q2 = mysqli_query($conn, "SELECT * FROM t_scale WHERE style = '{$r['style']}' AND kp = '{$r['kp']}' AND pl_id = '$id' GROUP BY bid");
            if (mysqli_num_rows($q2) == 0) {
              $bl = 0;
            } else {
              $bl = mysqli_num_rows($q2);
            }
            echo '<h5>' . $bl . '</h5>';
            ?>
          </td>
          <td>
            <h5>Bag</h5>
          </td>
        </tr>
      </table>
      <table class="table table-bordered table-hover" id="tableku" style="width: 100%;">
        <thead class="thead-dark">
          <tr>
            <th>Bag ID</th>
            <th>Style</th>
            <th>KP</th>
            <th>Color</th>
            <th>Qty</th>
            <th>Loading Date</th>
            <th>PIC</th>
          </tr>
        </thead>
      </table>
      <div class="col-lg-12 d-flex justify-content-around mt-3">
        <a href="../tra_send_out/" onclick="return confirm('Anda yakin ingin kembali ke list Packing List?')" class="btn btn-danger p-2 ml-5">Back to List</a>
      </div>

      <input type="text" name="cartonid" autocomplete="off" autofocus onblur="$(this).focus()">
      <style>
        input:focus {
          outline: #ffffff none !important;
          box-shadow: 0 0 10px #ffffff;
        }

        input {
          width: 0px;
          height: 0px;
          border: 0px;
        }
      </style>
      <div>
        <audio id="audiocom">
          <source src="../../sound/complete.wav" type="audio/mpeg">
        </audio>
        <audio id="audiowrong">
          <source src="../../sound/wrong.wav" type="audio/mpeg">
        </audio>
      </div>
    </div>

  </div>
</body>
<script>
  var qtysesi = 0;
  var complete = document.getElementById("audiocom");
  var wrong = document.getElementById("audiowrong");
  $('input[name=cartonid]').on('keypress', function() {
    complete.pause();
    wrong.pause();
  })

  function playcomplete() {
    complete.play();
  }

  function playwrong() {
    wrong.play();
    setTimeout(() => {
      wrong.pause();
    }, 1000);
  }
  $(document).ready(function() {
    var tableku = $('#tableku').DataTable({
      scrollY: '50vh',
      scrollX: true,
      scrollCollapse: true,
      processing: true,
      serverSide: true,
      ajax: {
        url: "ajax/index.php",
        dataType: "json",
        type: "POST",
        data: {
          pl_id: '<?= $id ?>',
          tipe: 'datatemp',
        }
      },
      paging: false,
      // pageLength: 50,
      // lengthMenu: [
      //   [50, 100, 200, 300, -1],
      //   [50, 100, 200, 300, "All"]
      // ],
      ordering: false,
      filter: false,
      "columns": [{
          "data": "bid"
        },
        {
          "data": "style"
        },
        {
          "data": "kp"
        },
        {
          "data": "color"
        },
        {
          "data": "qty"
        },
        {
          "data": "loading"
        },
        {
          "data": "pic_loading"
        },
      ]
    });
    $('input[name=cartonid]').on('keypress', function(e) {
      if (e.which == 13) {
        var bid = $(this).val();
        $.ajax({
          url: 'ajax/index.php',
          method: 'post',
          data: {
            bid: bid,
            pl_id: '<?= $id ?>',
            style: '<?= $r['style'] ?>',
            kp: '<?= $r['kp'] ?>',
            tipe: 'cekloading',
          },
          dataType: 'json',
          success: function(a) {
            if (a.isi[0].notif == 'not') {
              playwrong();
              setTimeout(() => {
                alert('Bag tidak terdaftar pada Style dan KP yang sesuai!');
              }, 500);
            } else if (a.isi[0].notif == 'deli') {
              playwrong();
              setTimeout(() => {
                alert('Bag sudah terdaftar di Packing List');
              }, 500);
            } else {
              qtysesi++;
              $("#qtysesi").html(qtysesi);
              playcomplete();
              tableku.ajax.reload();
              var bagloaded = parseInt($('#bagloaded').text());
              var pcsloaded = parseInt($('#pcsloaded').text());
              $('#bagloaded').text(bagloaded + 1)
              $('#pcsloaded').text(a.isi[0].pcs)
              $('#btnsubmit').fadeIn();
            }
            $('input[name=cartonid]').val('');
          }
        })
      }
    })
  });

  function display_c() {
    var refresh = 1000; // Refresh rate in milli seconds
    mytime = setTimeout('display_ct()', refresh)
  }

  function display_ct() {
    var x = new Date();
    var mo = x.getMonth() + 1;
    var x1 = x.getDate() + "/" + mo + "/" + x.getFullYear();
    x1 = x1 + " - " + x.getHours() + ":" + x.getMinutes() + ":" + x.getSeconds() + ' WIB';
    document.getElementById('ct').innerHTML = x1;
    display_c();
  }
</script>
</body>

</html>