<?php
session_start();
if (isset($_POST['id'])) {
	$hostname  = "192.168.100.190";
$username  = "kampusmerdeka";
$password  = "Magang@12";
$dbname  = "ewash";
$logs = mysqli_connect($hostname, $username, $password, $dbname);
$id = strtoupper($_POST['id']);
$q = mysqli_query($logs,"SELECT * from akses where nik='$id'");
if (mysqli_num_rows($q)>0) {
$data = mysqli_fetch_assoc($q);
echo $data['nik'].',..,'.$data['question1'].',..,'.$data['question2'];
}else{
	echo 'nv';
}
}
