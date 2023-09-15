<?php
require_once('proses/conn.php');
if (!isset($_SESSION['wnik'])) {
  header('location:index.php');
}
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
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
  <script src="dist/js/demo.js"></script>
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
                  <h3 class="card-title mr-auto">Trolley Number ID</h3><button class="btn btn-primary" data-toggle="modal" data-target="#addtipe"><i class="fal fa-plus-circle"></i> Generate ID</button>
                  <div class="modal fade" id="addtipe">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Generate ID</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="proses/addidtrol.php" method="post" target="_blank">
                          <div class="modal-body">
                            <div class="form-group">
                              <label>Select Master Data</label>
                              <select class="form-control" name="troli">
                                <?php
                                $qs = mysqli_query($conn, "SELECT * from master_tipe_trolley");
                                while ($ds = mysqli_fetch_array($qs)) { ?>
                                  <option value="<?= $ds['t_id'] ?>"><?= $ds['t_kategori'] . ' ' . $ds['t_nama'] ?></option>
                                <?php }
                                ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Input Amount</label>
                              <input name="amon" class="form-control" type="number" required min="1">
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Generate ID</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </form>
                      </div>
                    </div>

                  </div>
                </div>
                <div class="card-body">
                  <table class="table table-sm table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>ID Trolley</th>
                        <th>Tipe</th>
                        <th>Kategory</th>
                        <th>PIC</th>
                        <th>Modified</th>
                        <th>Opsi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $q = mysqli_query($conn, "SELECT * from listtrolli");
                      while ($d = mysqli_fetch_assoc($q)) {
                        $qm = mysqli_query($conn, "SELECT * from master_tipe_trolley where t_id=" . $d['l_tipe']);
                        $dm = mysqli_fetch_assoc($qm);
                      ?>
                        <tr>
                          <td><?= $d['l_id'] ?></td>
                          <td><?= $dm['t_kategori'] . ' ' . $dm['t_nama'] ?></td>
                          <td><?= $dm['t_kategori'] ?></td>
                          <td><?= $d['pic'] ?></td>
                          <td><?= $d['modified'] ?>WIB</td>
                          <td align="center">
                            <form action="proses/printtrol.php" method="post" target="_blank">
                              <button name="troll" style="background: none; border: none;" type="submit" value="<?= base64_encode(base64_encode($d['l_id'])) ?>" onclick="return confirm('Anda ingin Cetak QR Code Trolley <?= $d['l_id'] ?>?')"><i class="far fa-qrcode text-danger"></i></button>
                            </form>
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