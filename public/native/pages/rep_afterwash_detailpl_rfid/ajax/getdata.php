<?php
require_once '../../../proses/conn.php';

if (isset($_POST['style'])) {
  $style = $_POST['style'];
  $kp = $_POST['kp'];

  echo '<option></option>';
  if ($kp == '') {
    $q = mysqli_query($conn, "SELECT distinct(kp) from pl_send where style='$style'");
    while ($dt = mysqli_fetch_array($q)) {
      echo '<option>' . $dt[0] . '</option>';
    }
  } else {
    $q = mysqli_query($conn, "SELECT distinct cast(closing as date) from pl_send where kp='$kp' AND closing IS NOT NULL");
    if (mysqli_num_rows($q) > 1) {
      echo '<option>All</option>';
    }
    while ($dt = mysqli_fetch_array($q)) {
      echo '<option>' . $dt[0] . '</option>';
    }
  }
}
