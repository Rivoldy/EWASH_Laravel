<?php
require_once '../../../proses/conn.php';

if (isset($_POST['style'])) {
  $style = $_POST['style'];

  echo '<option></option>';
  $q = mysqli_query($conn, "SELECT distinct(kp) from t_scale where style='$style'");
  while ($dt = mysqli_fetch_array($q)) {
    echo '<option>' . $dt[0] . '</option>';
  }
}
