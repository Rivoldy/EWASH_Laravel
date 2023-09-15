<?php
session_start();
include '../encdec/sclass.php';
$hostname  = "192.168.155.109";
$username  = "webadmin";
$password  = "2021masihpakaisql?";
$dbname  = "userman";
$logs = mysqli_connect($hostname, $username, $password, $dbname);
$cnik = $_POST['cnik'];
$ans1 = $_POST['ans1'];
$ans2 = $_POST['ans2'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];

$cek = mysqli_query($logs, "SELECT * from users where nik='$cnik'");
$dek = mysqli_fetch_assoc($cek);
if ($dek['answer1'] != "$ans1" || $dek['answer2'] != "$ans2") {
?>
	<script>
		alert('Wrong Answer!!');
		document.location = '../index.php'
	</script>
<?php
} elseif ($pass1 != $pass2) {
?>
	<script>
		alert('Password Not Match!!');
		document.location = '../index.php'
	</script>
	<?php
} else {
	$q = mysqli_query($logs, "UPDATE users set password='".enc($pass1)."' where nik='$cnik'");
	if ($q) {
	?>
		<script>
			alert('Password has been change');
			document.location = '../index.php'
		</script>
	<?php
	} else {
	?>
		<script>
			alert('Gagal menyimpan data!!');
			document.location = '../index.php'
		</script>
<?php
	}
}
?>