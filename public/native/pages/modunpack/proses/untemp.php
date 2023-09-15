<?php
require_once '../../../proses/conn.php';
require_once '../../../encdec/sclass.php';
$c = $_POST['cartonid'];
$k = base64_decode(urldecode($_GET['k']));
$d = base64_decode(urldecode($_GET['d']));
$w = base64_decode(urldecode($_GET['w']));
$q = base64_decode(urldecode($_GET['q']));
$pa = dec(base64_decode(urldecode($_GET['pa'])));
$l = base64_decode(urldecode($_GET['l']));
$t = base64_decode(urldecode($_GET['t']));
$o = base64_decode(urldecode($_GET['o']));
$p = base64_decode(urldecode($_GET['p']));

$cek = mysqli_query($db, "SELECT * from listcarton where packkey='$c' and donumber='$d'");
if (mysqli_num_rows($cek) > 0) {
	$dek = mysqli_fetch_assoc($cek);
	if ($dek['status'] == 'Delivery') {
?>
		<script language="JavaScript">
			alert('Gagal Unpack, Status Carton sudah Delivery!!');
		</script>

		<form method=post action="../unpackscan.php" name="member_signup">
			<input type="text" name="dono" value="<?= $d ?>">
			<input type="text" name="qtypo" value="<?= $q ?>">
			<input type="text" name="dest" value="<?= $w ?>">
			<input type="text" name="overship" value="<?= $o ?>">
			<input type="date" name="podate" value="<?= $p ?>">
			<input type="text" name="total" value="<?= $t ?>">
			<input type="text" name="nik" value="<?= $k ?>">
			<input type="date" name="lahir" value="<?= $l ?>">
			<input type="password" name="pass" value="<?= $pa ?>">

			<input type='submit' name='btnSignIn' id='btnSignIn' />
		</form>
	<?php

	} elseif ($dek['scanstatus'] != 'Complete') {
	?>
		<script language="JavaScript">
			alert('Gagal Unpack, Qty Carton Kosong!!');
		</script>
		<form method=post action="../unpackscan.php" name="member_signup">
			<input type="text" name="dono" value="<?= $d ?>">
			<input type="text" name="qtypo" value="<?= $q ?>">
			<input type="text" name="dest" value="<?= $w ?>">
			<input type="text" name="overship" value="<?= $o ?>">
			<input type="date" name="podate" value="<?= $p ?>">
			<input type="text" name="total" value="<?= $t ?>">
			<input type="text" name="nik" value="<?= $k ?>">
			<input type="date" name="lahir" value="<?= $l ?>">
			<input type="password" name="pass" value="<?= $pa ?>">
			<input type='submit' name='btnSignIn' id='btnSignIn' />
		</form>
	<?php
	} else {
		$carton = $dek['cartoncode'];
		$setname = $dek['setname'];
		$idpo = $dek['idpo'];
		$idcolor = $dek['idcolor'];
		$idsize = $dek['idsize'];
		$qty = $dek['qtyscan'];
		$ot = $k;
		$q = mysqli_query($db, "insert into unpack_temp values('$carton','$idpo','$setname','$idcolor','$idsize','$qty','" . date('Y-m-d H:i:s') . "','$ot','" . $_SESSION['packnik'] . "')");
	?>
		<form method=post action="../unpackscan.php" name="member_signup">
			<input type="text" name="dono" value="<?= $d ?>">
			<input type="text" name="qtypo" value="<?= $q ?>">
			<input type="text" name="dest" value="<?= $w ?>">
			<input type="text" name="overship" value="<?= $o ?>">
			<input type="date" name="podate" value="<?= $p ?>">
			<input type="text" name="total" value="<?= $t ?>">
			<input type="text" name="nik" value="<?= $k ?>">
			<input type="date" name="lahir" value="<?= $l ?>">
			<input type="password" name="pass" value="<?= $pa ?>">

			<input type='submit' name='btnSignIn' id='btnSignIn' />
		</form>
	<?php
	}
} else {
	?>
	<script language="JavaScript">
		alert('Gagal Unpack Nomor Carton tidak terdaftar atas nomor DO!!');
	</script>
	<form method=post action="../unpackscan.php" name="member_signup">
		<input type="text" name="dono" value="<?= $d ?>">
		<input type="text" name="qtypo" value="<?= $q ?>">
		<input type="text" name="dest" value="<?= $w ?>">
		<input type="text" name="overship" value="<?= $o ?>">
		<input type="date" name="podate" value="<?= $p ?>">
		<input type="text" name="total" value="<?= $t ?>">
		<input type="text" name="nik" value="<?= $k ?>">
		<input type="date" name="lahir" value="<?= $l ?>">
		<input type="password" name="pass" value="<?= $pa ?>">

		<input type='submit' name='btnSignIn' id='btnSignIn' />
	</form>
<?php
}
?>
<style>
	form,
	input {
		height: 0px !important;
		width: 0px !important;
		border: none
	}
</style>
<script type="text/javascript">
	window.onload = function() {
		document.forms['member_signup'].submit();
	}
</script>