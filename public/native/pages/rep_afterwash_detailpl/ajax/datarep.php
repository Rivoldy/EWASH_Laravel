<?php
require_once '../../../proses/conn.php';

if (isset($_POST['kp'])) {
  $kp = $_POST['kp'];
  $tgl = $_POST['tgl'];
  if ($tgl == 'All') {
    $ftgl = "";
    $utgl = "";
  } else {
    $ftgl = " and closing like '$tgl%'";
    $utgl = "tgl=$tgl";
  }

?>
  <table class="table table-sm table-hover table-bordered table-striped table-bordered" style="width: 100%;" id="tabsku">
    <thead>
      <tr>
        <th class="text-center">Bag ID</th>
        <th class="text-center">Style</th>
        <th class="text-center">Size</th>
        <th class="text-center">Color</th>
        <th class="text-center">GW</th>
        <th class="text-center">NW</th>
        <th class="text-center">QTY</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $q = mysqli_query($conn, "SELECT * from t_scale where kp='$kp' AND closing_status = 1 $ftgl order by bid");
      while ($dt = mysqli_fetch_assoc($q)) {
      ?>
        <tr>
          <td><?= $dt['bid'] ?></td>
          <td><?= $dt['style'] ?></td>
          <td><?= $dt['size'] ?></td>
          <td><?= $dt['color'] ?></td>
          <td class="text-right"><?= number_format($dt['gw'], 3) ?></td>
          <td class="text-right"><?= number_format($dt['nw'], 3) ?></td>
          <td class="text-right"><?= number_format($dt['qty']) ?></td>
        </tr>
      <?php

      }
      ?>
    </tbody>

  </table>
  <script>
    $('#tabsku').DataTable({
      dom: '<"toolbar">frtip',
      scrollY: '50vh',
      scrollX: true,
      scrollCollapse: true,
      paging: false,
      ordering: false,
      searching: false,
      bInfo: false,
    });
    $('div.toolbar').html('<a target="_blank" href="http://127.0.0.1:8000/storage/ewash/pages/rep_afterwash_detailpl/report.php?kp=<?= $kp . '&' . $utgl ?>" class="btn btn-danger"><i class="fal fa-file-pdf"></i> Export</a>');
  </script>
  <style>
    .toolbar {
      float: right;
    }
  </style>
<?php
}
