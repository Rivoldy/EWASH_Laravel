<?php
require_once("conn.php");
session_start();
if (!isset($_POST['konfirm'])) {
	header('location:../allocate.php');
}
$kp = $_POST['konfirm'];
$size = $_POST['size'];
$qty = $_POST['qty'];

$cek = mysqli_query($conn, "SELECT qty from wash_transaction where qty>=$qty and size='$size' and kp is null order by qty limit 1");
if (mysqli_num_rows($cek) > 0) {
	$d = mysqli_fetch_assoc($cek);
	if ($d['qty'] == $qty) {
		$q = mysqli_query($conn, "UPDATE wash_transaction set kp='$kp'");
	} else {
		$pis = $d['qty'] - $qty;
		$q = mysqli_query($conn, "UPDATE wash_transaction set kp='$kp', qty=$pis where id=" . $d['id'] . ";");
		$sisa = $qty - $pis;
		$q .= mysqli_query($conn, "INSERT into wash_transaction values(0,'" . $d['wid'] . "','$kp','" . $d['color'] . "','" . $d['size'] . "',$sisa,'" . $d['pack'] . "','" . $d['addi'] . "','" . $d['modified'] . "','" . $d['pic'] . "')");
	}
} else {
	$cek = mysqli_query($conn, "SELECT * from wash_transaction where size='$size' and kp is null order by qty");
	while ($dt = mysqli_fetch_assoc($cek)) {
		$hasil = $dt['qty'] - $qty;
		if ($hasil == 0) {
			$q = mysqli_query($conn, "UPDATE wash_transaction set kp='$kp' where id=" . $dt['id']);
			break;
		} elseif ($hasil < 0) {
			$q = mysqli_query($conn, "UPDATE wash_transaction set kp='$kp' where id=" . $dt['id']);
			$qty = abs($hasil);
		} else {
			$q = mysqli_query($conn, "UPDATE wash_transaction set kp='$kp', qty=$qty where id=" . $dt['id'] . ";");
			$q .= mysqli_query($conn, "INSERT into wash_transaction values(0,'" . $dt['wid'] . "',NULL,'" . $dt['color'] . "','" . $dt['size'] . "',$hasil,'" . $dt['pack'] . "','" . $dt['addi'] . "','" . $dt['modified'] . "','" . $dt['pic'] . "');");
			break;
		}
	}
}

if ($q) { ?>
	<script>
		alert('Data telah disimpan');
		document.location = '../allocate.php';
	</script>
<?php } else { ?>
	<script>
		alert('Gagal menyimpan data!!');
		document.location = '../allocate.php';
	</script>
<?php }
