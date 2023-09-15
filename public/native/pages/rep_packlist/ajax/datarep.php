<?php
require_once '../../../proses/conn.php';

if (isset($_POST['pl_id'])) {
  $id = $_POST['pl_id'];

  $q = mysqli_query($conn, "SELECT * FROM pl_send WHERE id = '$id'");
  $r = mysqli_fetch_array($q);
  $delivery = $r['delivery'];
  $style = $r['style'];
  $kp = $r['kp'];
  $dest = $r['dest'];


  $qsize = mysqli_query($conn, "SELECT size from t_scale where pl_id = '$id' AND closing_status = 1 group by size ORDER BY (CASE WHEN size REGEXP '(\d)+' THEN 0 ELSE 1 END) ASC,
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
        <th class="text-center">Delivery</th>
        <th class="text-center">Style</th>
        <th class="text-center">KP</th>
        <th class="text-center">Dest</th>
        <th class="text-center">Bag ID</th>
        <th class="text-center"><sub>Color</sub> / <sup>Size</sup></th>
        <?php
        for ($i = 0; $i < count($nmsize); $i++) {
          echo '<th class="text-center">' . $nmsize[$i] . '</th>';
        }
        ?>
        <th class="text-center">TOTAL</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $q = mysqli_query($conn, "SELECT * from t_scale where pl_id = '$id' AND closing_status = 1 group by bid");
      $totbag = $totqty = $totnw = $totgw = 0;
      while ($dt = mysqli_fetch_assoc($q)) {
        $color = $dt['color'];
        $bid = $dt['bid'];
        $qtybag = $dt['qty'];
      ?>
        <tr>
          <td><?= $delivery ?></td>
          <td><?= $style ?></td>
          <td><?= $kp ?></td>
          <td><?= $dest ?></td>
          <td><?= $bid ?></td>
          <td><?= $color ?></td>
          <?php
          $jmlpcs = 0;
          for ($i = 0; $i < count($nmsize); $i++) {
            $qsi = mysqli_query($conn, "SELECT sum(qty) as qty from t_scale where pl_id = '$id' AND bid = '$bid' AND closing_status = 1 and color='$color' and size='$nmsize[$i]'");
            $dsi = mysqli_fetch_assoc($qsi);
            $jmlpcs = $jmlpcs + $dsi['qty'];
            echo '<td class="text-right">' . number_format($dsi['qty']) . '</td>';
          }
          ?>
          <td class="text-right"><?= number_format($jmlpcs) ?></td>
        </tr>
      <?php
      }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <th class="text-center" colspan="6">GRAND TOTAL</th>
        <?php
        $total = 0;
        for ($i = 0; $i < count($nmsize); $i++) {
          $totsize = 0;
          $qsi = mysqli_query($conn, "SELECT sum(qty) as qty from t_scale where pl_id = '$id' AND closing_status = 1 and size='$nmsize[$i]'");
          $dsi = mysqli_fetch_assoc($qsi);
          $totsize = $totsize + $dsi['qty'];
          echo '<th class="text-right">' . $totsize . '</th>';
          $total += $totsize;
        }

        echo '<th class="text-right">' . $total . '</th>';
        ?>
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
    $('div.toolbar').html('<a target="_blank" href="report.php?id=<?= $id ?>" class="btn btn-danger"><i class="fal fa-file-pdf"></i> Export</a>');
  </script>
  <style>
    .toolbar {
      float: right;
    }
  </style>
<?php
}
