<?php
session_start();
$hostname  = "192.168.100.190";
$username  = "kampusmerdeka";
$password  = "Magang@12";
$dbname  = "ewash";
$conn = mysqli_connect($hostname, $username, $password, $dbname) or die ('Koneksi database gagal! ');

$hostname  = "192.168.100.190";
$username  = "kampusmerdeka";
$password  = "Magang@12";
$dbname  = "userman";
$logs = mysqli_connect($hostname, $username, $password, $dbname) or die ('Koneksi database gagal! ');

$hostname  = "192.168.100.190";
$username  = "kampusmerdeka";
$password  = "Magang@12";
$dbname  = "packngo_sap";
$sap = mysqli_connect($hostname, $username, $password, $dbname) or die ('Koneksi database gagal! ');
ini_set('date.timezone', 'Asia/Jakarta');
