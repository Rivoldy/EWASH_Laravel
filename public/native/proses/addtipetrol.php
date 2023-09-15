<?php
require_once("conn.php");
session_start();
$kate = $_POST['kate'];
if ($kate == 'Karung') {
$cek = mysqli_query($conn,"SELECT * from master_tipe_trolley where t_kategori='$kate'");
if (mysqli_num_rows($cek)>0) { ?>
	<script>
		alert('Karung Sudah Ada. Data tidak disimpan!!');
		document.location = '../mas_trolley_type.php';
	</script>
<?php }else{
	$namat = '';
	$capa = 0;
} 
}else {
	$namat = strtoupper($_POST['namat']);
	$capa = $_POST['capa'];
}
$q = mysqli_query($conn, "INSERT into master_tipe_trolley values(0,'$namat','$kate',$capa,'" . $_SESSION['wnik'] . "','" . date('Y-m-d H:i:s') . "')");
if ($q) { ?>
	<script>
		alert('Data berhasil disimpan');
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
