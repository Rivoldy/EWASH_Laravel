<?php
require_once '../../../proses/conn.php';

$reason = $_POST['reason'];
$nikau = $_POST['nikau'];
$dono = $_POST['dono'];
$nik = $_SESSION['packnik'];
if (isset($_POST['packkey'])) {
  $stat = 's';

  if (strlen($_POST['packkey']) > 14) {
    $packkey = str_replace("D", "", str_replace("-", "", str_replace("@", "", $_POST['packkey'])));
  } else {
    $packkey = $_POST['packkey'];
  }
  $cek = mysqli_query($db, "SELECT * from listcarton where packkey='$packkey' and donumber='$dono'");
}
if (isset($_POST['cartoncode'])) {
  $stat = 'm';
  $cartoncode = $_POST['cartoncode'];
  $cek = mysqli_query($db, "SELECT * from listcarton where cartoncode like '%$cartoncode' and donumber='$dono'");
}
if (mysqli_num_rows($cek) > 0) {
  $dek = mysqli_fetch_assoc($cek);
  if ($dek['status'] == 'Delivery') {
    echo 'deliv';
  } elseif ($dek['scanstatus'] != 'Complete') {
    echo 'kosong';
  } else {
    echo $carton = $dek['cartoncode'];
    $setname = $dek['setname'];
    $idpo = $dek['idpo'];
    $idcolor = $dek['idcolor'];
    $idsize = $dek['idsize'];
    $qty = $dek['qtyscan'];
    $packkey = $dek['packkey'];
    $picsp = $dek['userid'];
    $tglsp = $dek['modified'];
    $q = mysqli_query($db, "INSERT into unpackhistory values('$nikau','$nik',NOW(),'$idpo','$carton','$idcolor','$idsize',$qty,'$reason','','YES','$stat','$picsp','$tglsp');");
    $qepc = mysqli_query($db, "SELECT epc from detailepc where packkey='$packkey'");
    while ($depc = mysqli_fetch_assoc($qepc)) {
      $epc = $depc['epc'];
      $q = mysqli_query($db, "INSERT into history_epc values(0,'$idpo','$carton','$packkey','$epc','',now(),'" . $_SESSION['packnik'] . "');");
      $q = mysqli_query($db, "UPDATE and_t_epc set unpack_time=NOW() where epc='$epc' order by ratio_time desc limit 1;");
    }
    $q = mysqli_query($db, "DELETE from detailepc where packkey='$packkey';");
    $q = mysqli_query($db, "DELETE from detailsscc where packkey='$packkey';");
    $q = mysqli_query($db, "UPDATE listcarton set scanstatus= NULL, qtyscan= NULL, kdct= NULL, packkey= NULL, workshop=NULL, beratcartoncomplete=NULL, tanggal=NULL, bookedby=NULL, bookedtime=NULL where cartoncode='$carton' and donumber='$dono';");
  }
} else {
  echo 'not';
}
