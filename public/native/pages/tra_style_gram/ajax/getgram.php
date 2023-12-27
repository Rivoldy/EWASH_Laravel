<?php
require_once '../../../proses/conn.php';

if (isset($_POST['style'])) {
  $style = $_POST['style'];
  $q = mysqli_query($sap, "SELECT distinct(ZSIZES) as nmsize from ordersap where ZMATGEN='$style'");

?>

  <table id="tabsgram" class="table table-sm table-bordered table-striped table-hover" style="width: 100%;">
    <thead>
      <tr>
        <th>Size</th>
        <th>Gramasi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($dt = mysqli_fetch_assoc($q)) {
        $size = $dt['nmsize'];
        $qgr = mysqli_query($conn, "SELECT * from m_gramasi where g_style='$style' and g_size='$size'");
        if (mysqli_num_rows($qgr) == 0) {
          $gram = 0;
        } else {
          $dgr = mysqli_fetch_assoc($qgr);
          $gram = $dgr['g_val'];
        }
      ?>
        <tr>
          <td><?= $dt['nmsize'] ?> <input type="hidden" readonly value="<?= $size ?>" class="nmsize"></td>
          <td><input class="inputgram form-control form-control-sm" type="number" step="0.01" value="<?= $gram ?>"></td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
  </div>
  <div class="d-flex justify-content-around mt-4">
    <button onclick="undogram()" class="btn btn-danger"><i class="far fa-undo"></i> Undo</button>
    <button onclick="savegram()" class="btn btn-primary"><i class="far fa-save"></i> Save Data</button>
  </div>
  </div>
  <script>
    function savegram() {
      if (confirm('Apakah data sudah diisi dengan benar?')) {
        var style = '<?= $style ?>';
        var nmsize = [];
        var gram = [];
        $(".nmsize").each(function() {
          nmsize.push($(this).val());
        });
        $(".inputgram").each(function() {
          gram.push($(this).val());
        });
        $.ajax({
          url: 'http://127.0.0.1:8000/storage/ewash/pages/tra_style_gram/ajax/savegram.php',
          method: 'post',
          data: {
            style,
            nmsize,
            gram
          },
          success: function(a) {
            if (a == 'scs') {
              alert('Data berhasil disimpan');
              $('#btncari').click();
                getgram(style);
            } else {
              alert('Gagal ' + a);
            }
          }
        })
      }
    }

    function undogram() {
      if (confirm('Perabahan data akan dibatalkan. Anda yakin?')) {
        getgram('<?= $style ?>');
      }
    }

    $(document).ready(function() {
      $('#tabsgram').DataTable({
        dom: '<"toolbar">frtip',
        scrollY: '55vh',
        scrollCollapse: true,
        paging: false,
      });
      $('div.toolbar').html('<h4 class="text-primary">Detail Gramasi <?= $style ?></h4>');
    });
  </script>
  <style>
    .toolbar {
      float: left
    }

    </?style><?php
            }
