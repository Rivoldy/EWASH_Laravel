<?php
require_once '../../../proses/conn.php';
if (isset($_POST['season'])) {
  $season=$_POST['season'];
  $q = mysqli_query($db, "SELECT idpo,po from purchase_order where season='$season'");
  echo '<option></option>';
  while ($dt = mysqli_fetch_assoc($q)) {
    echo '<option value="' . $dt['idpo'] . '">' . $dt['po'] . '</option>';
  }
}
if (isset($_POST['idpo'])) {
  $idpo = $_POST['idpo'];
  $q = mysqli_query($db, "SELECT donumber from podonumber where idpo='$idpo'");
  echo '<option></option>';
  while ($dt = mysqli_fetch_assoc($q)) {
    echo '<option>' . $dt['donumber'] . '</option>';
  }
}
