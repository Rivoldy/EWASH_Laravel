<?php
require_once('proses/conn.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E - WASH</title>
  <link rel="icon" type="image/png" sizes="16x16" href="dist/img/fav.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?php require_once('sidebar.php') ?>
    <div class="content-wrapper">

      <section class="content">

        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header d-flex">
                  <h3 class="card-title mr-auto">Allocate</h3>
                  <form action="proses/synckp.php" method="post">
                    <button name="konfirm" onclick="return confirm('Anda ingin Maintenance KP?')" class="btn btn-danger">Sync Style to KP</button>
                  </form>
                </div>
                <div class="card-body">
                  <table id="tableku" class="table table-sm table-bordered table-hover" style="width: 100%;">
                    <thead>
                      <tr>
                        <th>KP</th>
                        <th>Qty Pack</th>
                        <th>Qty Send</th>
                        <th>Date Send</th>
                        <th>Qty Rcvd</th>
                        <th>Completion</th>
                        <th>Finishing</th>
                        <th>Balance</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $q = mysqli_query($conn, "SELECT distinct(wash_transaction.kp) as kp from wash_transaction, master_kp where wash_transaction.kp=master_kp.kp and master_kp.category='DYING' and wash_transaction.kp is not null");
                      while ($d = mysqli_fetch_assoc($q)) {
                        $cek = mysqli_query($conn, "SELECT sum(qty) as pack from wash_transaction where wid='W020' and kp='" . $d['kp'] . "';");
                        $dek = mysqli_fetch_assoc(($cek));
                        $pack = $dek['pack'];
                        $cek = mysqli_query($conn, "SELECT sum(qty) as send, modified from wash_transaction where wid='W030' and kp='" . $d['kp'] . "';");
                        $dek = mysqli_fetch_assoc(($cek));
                        $send = $dek['send'];
                        $tglsend = $dek['modified'];
                        $cek = mysqli_query($conn, "SELECT sum(qty) as rcvd from wash_transaction where wid='W040' and kp='" . $d['kp'] . "';");
                        $dek = mysqli_fetch_assoc(($cek));
                        $rcvd = $dek['rcvd'];
                        $cek = mysqli_query($conn, "SELECT sum(qty) as finish from wash_transaction where wid='W081' and kp='" . $d['kp'] . "';");
                        $dek = mysqli_fetch_assoc(($cek));
                        $finish = $dek['finish'];
                      ?>
                        <tr>
                          <td><?= $d['kp'] ?></td>
                          <td><?= $pack ?></td>
                          <td><?= $send ?></td>
                          <td><?= $tglsend ?></td>
                          <td><?= $rcvd ?></td>
                          <td><?= number_format($rcvd / $send * 100) ?>%</td>
                          <td><?= $finish ?></td>
                          <td><?= $rcvd - $finish ?></td>
                          <td align="center">
                            <?php
                            if ($rcvd - $finish > 0) { ?>
                              <a href="#" data-toggle="modal" data-target="#e<?= $d['kp'] ?>"><i class="text-danger far fa-edit"></i></a>

                              <div class="modal fade" id="e<?= $d['kp'] ?>" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Allocation KP <?= $d['kp'] ?></h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form action="proses/allocate.php" method="POST">
                                      <div class="modal-body">
                                        <div class="row">
                                          <table class="table table-sm table-bordered table-hover">
                                            <thead>
                                              <tr>
                                                <th>Size</th>
                                                <th>Qty Rcvd</th>
                                                <th>Completion</th>
                                                <th>Finishing</th>
                                                <th>Balance</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <?php
                                              $qsize = mysqli_query($conn, "SELECT distinct(size) as size from wash_transaction where kp='" . $d['kp'] . "'");
                                              while ($dsize = mysqli_fetch_assoc($qsize)) {
                                                $cek = mysqli_query($conn, "SELECT sum(qty) as send from wash_transaction where wid='W030' and kp='" . $d['kp'] . "' and size='" . $dsize['size'] . "';");
                                                $dek = mysqli_fetch_assoc(($cek));
                                                $send = $dek['send'];
                                                $cek = mysqli_query($conn, "SELECT sum(qty) as rcvd from wash_transaction where wid='W040' and kp='" . $d['kp'] . "' and size='" . $dsize['size'] . "';");
                                                $dek = mysqli_fetch_assoc(($cek));
                                                $rcvd = $dek['rcvd'];
                                                $cek = mysqli_query($conn, "SELECT sum(qty) as finish from wash_transaction where wid='W081' and kp='" . $d['kp'] . "' and size='" . $dsize['size'] . "';");
                                                $dek = mysqli_fetch_assoc(($cek));
                                                $finish = $dek['finish'];
                                              ?>
                                                <tr>
                                                  <td><?= $dsize['size'] ?></td>
                                                  <td><?= $rcvd ?></td>
                                                  <td><?= abs(number_format(($rcvd / $send * 100) + 0)) ?>%</td>
                                                  <td><?= $finish ?></td>
                                                  <td><?= $rcvd - $finish ?></td>
                                                </tr>
                                              <?php
                                              }


                                              ?>
                                            </tbody>
                                          </table>
                                        </div>
                                        <hr>
                                        <div class="row">
                                          <div class="col-9">
                                            <table class="table table-sm table-bordered table-hover">
                                              <thead>
                                                <tr>
                                                  <th>Size</th>
                                                  <th>Qty</th>
                                                  <th>Date Rcvd</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <?php
                                                $qs = mysqli_query($conn, "SELECT sum(qty) as qty, size, modified from wash_transaction where kp is null group by size");
                                                while ($ds = mysqli_fetch_assoc($qs)) { ?>
                                                  <tr>
                                                    <td align="center"> <input name="size" required id="<?= $ds['size'] ?>" class="form-check-input" type="radio" value="<?= $ds['size'] ?>"> <label class="form-check-label" for="<?= $ds['size'] ?>"><?= $ds['size'] ?></label></td>
                                                    <td><?= $ds['qty'] ?></td>
                                                    <td><?= $ds['modified'] ?></td>
                                                  </tr>
                                                <?php }
                                                ?>
                                              </tbody>
                                            </table>
                                          </div>
                                          <div class="form-group col-3">
                                            <label>Input Qty</label>
                                            <input class="form-control border-danger" name="qty" required min="1" max="<?= $rcvd - $finish ?>">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="submit" name="konfirm" value="<?= $d['kp'] ?>" class="btn btn-primary">Proceed</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            <?php }
                            ?>
                          </td>
                        </tr>
                      <?php }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <?php require_once 'footer.php' ?>

  </div>

  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
  <script src="dist/js/demo.js"></script>
  <script>
   
    $(document).ready(function() {
      $("ul.nav-sidebar a").each(function() {
        var navItem = $(this);
        if ('/ewash/' + navItem.attr("href") == location.pathname) {
          navItem.addClass("bg-white");
          navItem.parentsUntil(".nav-sidebar > .nav-treeview")
            .css({
              'display': 'block'
            })
            .addClass('menu-open').prev('a')
            .addClass('active');
        }
      });

    });
  </script>
</body>

</html>