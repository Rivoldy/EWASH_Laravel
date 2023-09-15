<?php
require_once("conn.php");
session_start();
if (!isset($_POST['konfirm'])) {
	header('location:../allocate.php');
}

$qwt = mysqli_query($conn, "SELECT distinct kp from wash_transaction where kp is not null and kp not in (SELECT kp from master_kp)");
while ($dwt = mysqli_fetch_assoc($qwt)) {
	$qos = mysqli_query($sap, "SELECT VBELN as kp, ZMATGEN as style from ordersap where VBELN='" . $dwt['kp'] . "'");
	$dos = mysqli_fetch_assoc(($qos));
	$qms = mysqli_query($logs, "SELECT product_cat.p_category as cat from product_cat, style_cat where style_cat.s_name='" . $dos['style'] . "' and style_cat.category=product_cat.p_id");
	$dms = mysqli_fetch_assoc($qms);
	$q = mysqli_query($conn, "INSERT into master_kp values('" . $dwt['kp'] . "','" . $dos['style'] . "','" . $dms['cat'] . "','" . date('Y-m-d H:i:s') . "','" . $_SESSION['wnik'] . "')");
}

if ($q) { ?>
	<script>
		alert('Berhasil Syncronize KP');
		document.location = '../allocate.php';
	</script>
<?php
} else { ?>
	<script>
		alert('Semua KP telah di Syncronize!!');
		document.location = '../allocate.php';
	</script>
<?php
}
