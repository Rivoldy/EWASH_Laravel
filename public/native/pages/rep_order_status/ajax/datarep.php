<?php
require_once '../../../proses/conn.php';

if (isset($_POST['kp'])) {
  $style = $_POST['style'];
  $kp = $_POST['kp'];
  if ($kp == 'All') {
    $kkp = "";
    $lem = "kp=all";
  } else {
    $kkp = " and kp = '$kp'";
    $lem = "kp=$kp";
  }

?>
  <table class="table table-sm table-hover table-bordered table-striped table-bordered" style="width: 100%;" id="tabsku">
    <thead>
      <tr>
        <th class="text-center">KP</th>
        <th class="text-center">Color</th>
        <th class="text-center">Size</th>
        <th class="text-center">Qty Order + Allowance</th>
        <th class="text-center">Qty Packed</th>
        <th class="text-center">Qty Balance Packed</th>
        <th class="text-center">Qty Loaded</th>
        <th class="text-center">Qty Received</th>
        <th class="text-center">Balance</th>
        <th class="text-center">Completion</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $torder = $tpacked = $tbal = $tplo = 0;
      $q = mysqli_query($conn, "SELECT * from t_scale where style = '$style' $kkp GROUP BY kp, color, size order by kp, color");
      while ($dt = mysqli_fetch_assoc($q)) {
      ?>
        <tr>
          <td><?= $dt['kp'] ?></td>
          <td><?= $dt['color'] ?></td>
          <td><?= $dt['size'] ?></td>
          <?php
          $q1 = mysqli_query($sap, "SELECT SUM(ZQTY) AS ZQTY FROM ordersap WHERE ZMATGEN = '{$dt['style']}' AND VBELN = '{$dt['kp']}' AND ZCOLOR = '{$dt['color']}' AND ZSIZES = '{$dt['size']}'");
          $r1 = mysqli_fetch_array($q1);

          $q2 = mysqli_query($conn, "SELECT SUM(qty) AS qty FROM t_scale WHERE style = '{$dt['style']}' AND kp = '{$dt['kp']}' AND color = '{$dt['color']}' AND size = '{$dt['size']}'");
          $r2 = mysqli_fetch_array($q2);

          $q3 = mysqli_query($conn, "SELECT SUM(qty) AS qty FROM t_scale WHERE pl_id = '{$dt['pl_id']}' AND style = '{$dt['style']}' AND kp = '{$dt['kp']}' AND color = '{$dt['color']}' AND size = '{$dt['size']}'");
          if (mysqli_num_rows($q3) == 0) {
            $plo = 0;
          } else {
            $r3 = mysqli_fetch_array($q3);
            $plo = $r3['qty'] == null ? 0 : $r3['qty'];
          }

          $order = $r1['ZQTY'] + (round($r1['ZQTY'] * 0.02));
          $packed = $r2['qty'] == null ? 0 : $r2['qty'];
          $bal = $packed - $order;

          $torder += $order;
          $tpacked += $packed;
          $tbal += $bal;
          $tplo += $plo;
          ?>
          <td class="text-right"><?= number_format($order) ?></td>
          <td class="text-right"><?= number_format($packed) ?></td>
          <td class="text-right <?= $bal < 0 ? 'text-danger' : '' ?>"><?= number_format($bal) ?></td>
          <td class="text-right"><?= number_format($plo) ?></td>
          <td class="text-right"><?= number_format(0) ?></td>
          <td class="text-right"><?= number_format($packed - $plo) ?></td>
          <td class="text-right"><?= number_format($plo / $order * 100) ?>%</td>
        </tr>
      <?php

      }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <th></th>
        <th></th>
        <th class="text-right">TOTAL</th>
        <th class="text-right"><?= number_format($torder) ?></th>
        <th class="text-right"><?= number_format($tpacked) ?></th>
        <th class="text-right <?= $tbal < 0 ? 'text-danger' : '' ?>"><?= number_format($tbal) ?></th>
        <th class="text-right"><?= number_format($tplo) ?></th>
        <th class="text-right"><?= number_format(0) ?></th>
        <th class="text-right"><?= number_format($tpacked - $tplo) ?></th>
        <th class="text-right"><?= number_format($tplo / $torder * 100) ?>%</th>
      </tr>
    </tfoot>

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
    $('div.toolbar').html('<a target="_blank" href="http://127.0.0.1:8000/storage/ewash/pages/rep_order_status/report.php?style=<?= $style . '&' . $lem ?>" class="btn btn-danger"><i class="fal fa-file-pdf"></i> Export</a>');
  </script>
  <style>
    .toolbar {
      float: right;
    }
  </style>
<?php
}
