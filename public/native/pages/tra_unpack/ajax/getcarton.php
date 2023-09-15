<?php
require_once '../../../proses/conn.php';
$carton = $_POST['carton'];
$q = mysqli_query($db, "SELECT * from listcarton where cartoncode='$carton' group by cartoncode");
$dt = mysqli_fetch_assoc($q);
$qc = mysqli_query($db, "SELECT * from mastercolor where idcolor=" . $dt['idcolor']);
$qs = mysqli_query($db, "SELECT * from mastersize where idsize=" . $dt['idsize']);
$dc = mysqli_fetch_assoc($qc);
$ds = mysqli_fetch_assoc($qs);
?>
<tr>
  <td><?= $carton ?></td>
  <td><?= $dt['setname'] ?></td>
  <td><?= $dc['nmcolor'] ?></td>
  <td><?= $ds['nmsize'] ?></td>
  <td><?= $dt['contentofbox'] ?></td>
</tr>