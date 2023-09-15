<?php
require_once("conn.php");
include '../encdec/sclass.php';
$nik = $_POST['nik'];
$pass = enc($_POST['pass']);
$masuk = mysqli_query($logs, "SELECT * from users where nik='$nik' and password='$pass'");
$cek = mysqli_num_rows($masuk);
if ($cek > 0) {
	$par = explode("/", $_SERVER['REQUEST_URI']);
	$data = mysqli_fetch_assoc($masuk);
	$_SESSION['wnik'] = $data['nik'];
	$_SESSION['wnama'] = $data['nama'];
	$_SESSION['wdept'] = $data['dept'];
	$_SESSION['wlevel'] = substr($data[$par[1]], 2);
	$q = mysqli_query($conn, "INSERT into user_log values('$nik','" . $data[$par[1]] . "','" . gethostname() . "','" . date('Y-m-d H:i:s') . "')");
?> <script>
		alert('Anda berhasil Masuk (<?php echo $data['nama'] ?>)!!');
		document.location = '../pages/modhome/';
	</script><?php
			} else { ?>
	<script>
		alert('NIK atau Password salah!!');
		document.location = '../index.php'
	</script>
<?php
			}
?>