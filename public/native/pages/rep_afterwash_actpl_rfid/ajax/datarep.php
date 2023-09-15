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

  $qsize = mysqli_query($conn, "SELECT size from t_bag where kp='$kp' AND closing_status = 1 $ftgl group by size ORDER BY (CASE WHEN size REGEXP '(\d)+' THEN 0 ELSE 1 END) ASC,
  field(size,'3-4Y(110)','4-5Y(110)','5-6Y(120)','6-7Y(120)','7-8Y(130)','8-9Y(130)','9-10Y(140)','10-11Y(140)','11-12Y(150)','12-13Y(150)','13Y(160)','14Y(160)','XXS', 'XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL','3XL'),size");
  if (mysqli_num_rows($qsize) != 0) {
    while ($dsize = mysqli_fetch_array($qsize)) {
      $nmsize[] = $dsize['size'];
    }
  }

?>
  <table class="table table-sm table-hover table-bordered table-striped table-bordered" style="width: 100%;" id="tabsku">
    <thead>
      <tr>
        <th class="text-center"><sub>Color</sub> / <sup>Size</sup></th>
        <?php
        for ($i = 0; $i < count($nmsize); $i++) {
          echo '<th class="text-center">' . $nmsize[$i] . '</th>';
        }
        ?>
        <th class="text-center">TOTAL QTY</th>
        <th class="text-center">TOTAL BAG</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $q = mysqli_query($conn, "SELECT *,sum(nw) as nett, sum(gw) as gross, count(distinct(bid)) as karung from t_bag where kp='$kp' AND closing_status = 1 $ftgl group by color");
      $totbag = $totqty = $totnw = $totgw = 0;
      while ($dt = mysqli_fetch_assoc($q)) {
        $color = $dt['color'];
        $qtybag = $dt['qty'];
        $jmlbag = $dt['karung'];
        $totbag = $totbag + $jmlbag;
      ?>
        <tr>
          <td><?= $color ?></td>
          <?php
          $jmlpcs = 0;
          for ($i = 0; $i < count($nmsize); $i++) {
            $qsi = mysqli_query($conn, "SELECT sum(qty) as qty from t_bag where kp='$kp' AND closing_status = 1 and color='$color' and size='$nmsize[$i]'");
            $dsi = mysqli_fetch_assoc($qsi);
            $jmlpcs = $jmlpcs + $dsi['qty'];
            echo '<td class="text-right">' . number_format($dsi['qty']) . '</td>';
          }
          $totqty = $totqty + $jmlpcs;
          ?>
          <td class="text-right"><?= number_format($jmlpcs) ?></td>
          <td class="text-right"><?= number_format($jmlbag) ?></td>
        </tr>
      <?php

      }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <th class="text-center" colspan="<?= count($nmsize) + 1 ?>">GRAND TOTAL</th>
        <th class="text-right"><?= number_format($totqty) ?></th>
        <th class="text-right"><?= number_format($totbag) ?></th>
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
    $('div.toolbar').html('<a target="_blank" href="report.php?kp=<?= $kp . '&' . $utgl ?>" class="btn btn-danger"><i class="fal fa-file-pdf"></i> Export</a>');
  </script>
  <style>
    .toolbar {
      float: right;
    }
  </style>
<?php
}
