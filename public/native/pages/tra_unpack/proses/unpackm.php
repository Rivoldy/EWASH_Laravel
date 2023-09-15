<?php
require_once '../../../proses/conn.php';
if (!isset($_POST['token'])) {
	header('location:../');
}
$c = $_POST['token'];
$remark = $_POST['remark'];
$q = mysqli_query($db, "SELECT * from unpack_temp where userid='" . $_SESSION['packnik'] . "'");
while ($d = mysqli_fetch_assoc($q)) {
	$carton = $d['cartonid'];
	$idpo = $d['idpo'];
	$setname = $d['setname'];
	$color = $d['idcolor'];
	$size = $d['idsize'];
	$qty = $d['qty'];
	$waktu = $d['waktu'];
	$ot = $d['userot'];
	$ins = mysqli_query($db, "insert into unpackhistory values('$ot','" . $_SESSION['packnik'] . "','$waktu','$idpo','$carton','$color','$size','$qty','$remark','','YES','m');");
	$ins .= mysqli_query($db, "delete from detailepc where packkey in (select packkey from listcarton where cartoncode='$carton' and idpo='$idpo');");
	$ins .= mysqli_query($db, "delete from detailsscc where packkey in (select packkey from listcarton where cartoncode='$carton' and idpo='$idpo');");
	$ins .= mysqli_query($db, "update listcarton set scanstatus= NULL, qtyscan= NULL, kdct= NULL, packkey= NULL, workshop=NULL, beratcartoncomplete=NULL, tanggal=NULL, bookedby=NULL, bookedtime=NULL where cartoncode='$carton' and idpo='$idpo';");
}
if ($ins) {
?>
	<script language="JavaScript">
		alert('Carton telah di Unpack');
		document.location = '../'
	</script><?php
					} else {
						?>
	<script language="JavaScript">
		alert('Gagal Unpack Carton!!');
		document.location = '../'
	</script><?php
					}
						?>