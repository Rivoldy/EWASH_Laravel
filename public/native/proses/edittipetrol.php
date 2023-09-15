<?php
require_once("conn.php");
session_start();
$idtroll = str_replace("123qwer","",base64_decode(urldecode($_POST['idtroll'])));
$namat = strtoupper($_POST['namat']);
$kate = $_POST['kate'];
$q = mysqli_query($conn, "UPDATE master_tipe_trolley set pic='" . $_SESSION['wnik'] . "', modified='" . date('Y-m-d H:i:s') . "', t_nama='$namat', t_kategori='$kate' where t_id=$idtroll ");
if ($q) { ?>
	<script>
		alert('Berhasil Update data');
		document.location = '../mas_trolley_type.php';
	</script>
<?php } else { 
	?>
	<script>
		alert('Data tidak disimpan!!');
		document.location = '../mas_trolley_type.php';
	</script>
<?php

}
