<?php
session_start();
if (!isset($_SESSION['wnik'])) {
  header('location:index.php');
}
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
                  <h3 class="card-title mr-auto">Tipe Trolley</h3><button class="btn btn-primary" data-toggle="modal" data-target="#addtipe"><i class="fal fa-plus-circle"></i> Trolley Type</button>
                  <div class="modal fade" id="addtipe">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Input Data Trolley Type</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="proses/addtipetrol.php" method="post">
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-6">
                                <label>Tipe </label>
                                <input name="namat" style="text-transform: uppercase;" class="form-control" required placeholder="Isi tipe dari trolley" minlength="5">
                              </div>
                              <div class="col-6">
                                <label>Capacity</label>
                                <input type="number" name="capa" class="form-control" required placeholder="Capacity trolley">
                              </div>
                            </div>
                            <div class="form-group">
                              <label>Kategory</label><br>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input required checked type="radio" class="custom-control-input" id="customRadio" name="kate" value="Trolley">
                                <label class="custom-control-label" for="customRadio">Trolley</label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input required type="radio" class="custom-control-input" id="customRadio2" name="kate" value="Karung">
                                <label class="custom-control-label" for="customRadio2">Karung</label>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Proceed</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </form>
                      </div>
                    </div>

                  </div>
                </div>
                <div class="card-body">
                  <table class="table table-sm table-bordered">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Tipe Trolley</th>
                        <th>Kategory</th>
                        <th>Capacity</th>
                        <th>PIC</th>
                        <th>Modified</th>
                        <th>Opsi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $q = mysqli_query($conn, "SELECT * from master_tipe_trolley");
                      $no = 1;
                      while ($d = mysqli_fetch_array($q)) {
                      ?>
                        <tr>
                          <td><?= $no ?></td>
                          <td><?= $d['t_kategori'] . ' ' . $d['t_nama'] ?></td>
                          <td><?= $d['t_kategori'] ?></td>
                          <td><?= $d['t_qty'] ?></td>
                          <td><?= $d['pic'] ?></td>
                          <td><?= $d['modified'] ?>WIB</td>
                          <td align="center"><a href="" data-toggle="modal" data-target="#my<?= $d['t_id'] ?>"><i class="far fa-edit text-warning"></i></a></td>
                          <div class="modal fade" id="my<?= $d['t_id'] ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">Edit Trolley <?= $d['t_nama'] ?></h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <form action="proses/edittipetrol.php" method="post">
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <label>Tipe Trolley</label>
                                      <input value="<?= $d['t_nama'] ?>" name="namat" style="text-transform: uppercase;" class="form-control" required placeholder="Isi tipe dari trolley" minlength="5">
                                    </div>
                                    <div class="form-group">
                                      <label>Kategory</label><br>
                                      <div class="form-check-inline">
                                        <label>
                                          <input <?php
                                                  if ($d['t_kategori'] == 'Trolley') {
                                                    echo 'checked';
                                                  }
                                                  ?> type="radio" name="kate" value="Trolley">
                                          Trolley</label>
                                      </div>
                                      <div class="form-check-inline">
                                        <label>
                                          <input <?php
                                                  if ($d['t_kategori'] == 'Karung') {
                                                    echo 'checked';
                                                  }
                                                  ?> type="radio" name="kate" value="Karung">
                                          Karung</label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" name="idtroll" value="<?= urlencode(base64_encode($d['t_id'] . '123qwer')) ?>">Proceed</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </tr>
                      <?php
                        $no++;
                      }
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