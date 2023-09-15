<?php
require_once '../../../proses/conn.php';

if (isset($_POST['season'])) {
  $season = $_POST['season'];
  $q = mysqli_query($sap, "SELECT *,count(distinct(ZSIZES)) as jmlsize from ordersap where ZSEAS='$season' group by ZMATGEN");

?>
  <div class="row">
    <div class="col-6">
      <table id="tabsku" class="table table-sm table-bordered table-striped table-hover" style="width: 100%;">
        <thead>
          <tr>
            <th>Style</th>
            <th>Size Varian</th>
            <th>Gramasi Varian</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($dt = mysqli_fetch_assoc($q)) {
            $style = $dt['ZMATGEN'];
            $gram = mysqli_num_rows(mysqli_query($conn, "SELECT * from m_gramasi where g_style='$style' and g_val!=0"));
          ?>
            <tr>
              <td><?= $dt['ZMATGEN'] ?></td>
              <td><?= $dt['jmlsize'] ?></td>
              <td><?= $gram ?></td>
              <td class="text-center"><a onclick="getgram('<?= $dt['ZMATGEN'] ?>')" href="#"><i class="text-primary fas fa-edit"></i></a></td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
    <div class="col-6" id="subkontent">

    </div>
  </div>
  <script>
    function getgram(style) {
      $("#subkontent").html('<h6 class="pt-5 mt-5 text-center text-info"><i class="fad fa-spinner fa-spin"></i> Preparing your data..</h6>');
      $.ajax({
        url: 'ajax/getgram.php',
        method: 'post',
        data: {
          style
        },
        success: function(a) {
          setTimeout(() => {
            $("#subkontent").html(a);
          }, 500);
        }
      })
    }

    $(document).ready(function() {
      $('#tabsku').DataTable({
        scrollY: '55vh',
        scrollCollapse: true,
        paging: false,
      });
    });
  </script>
<?php
}
