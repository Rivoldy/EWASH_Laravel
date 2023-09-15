<?php
require_once("conn.php");

include '../plugins/qrcode/qrlib.php';
require('../plugins/fpdf/rotate.php');
include '../plugins/fpdf/makefont/makefont.php';

$troli = $_POST['troli'];
$amon = $_POST['amon'];

$qdet = mysqli_query($conn, "SELECT * from master_tipe_trolley where t_id=$troli");
$det = mysqli_fetch_array($qdet);
$nama = $det['t_nama'];
if ($det['t_kategori'] == 'Trolley') {
	$fw = 'TRY';
} else {
	$fw = 'KRG';
}

if (strlen($troli) == 1) {
	$tipe = '00' . $troli;
} elseif (strlen($troli) == 2) {
	$tipe = '0' . $troli;
} else {
	$tipe = $troli;
}
$q = mysqli_query($conn, "SELECT * from listtrolli where l_tipe=$troli order by l_id desc limit 1");
if (mysqli_num_rows($q) == 0) {
	$bil = 1;
} else {
	$d = mysqli_fetch_assoc($q);
	$bil = intval(substr($d['l_id'], -3)) + 1;
}

$tempdir = "temp/";
if (!file_exists($tempdir))
	mkdir($tempdir);
$quality1 = 'H';
$ukuran1 = 15;
$padding1 = 2;

$pdf = new FPDF('L', 'mm', array(30, 80));
$pdf->AddFont('helvetica', '', 'helvetica.php');
$pdf->SetMargins(1, 3, 2, 1);
$pdf->SetAutoPageBreak(false, 0);
$pdf->SetFont('helvetica', '', 9);

for ($i = 1; $i <= $amon; $i++) {
	if (strlen($bil) == 1) {
		$urut = '00' . $bil;
	} elseif (strlen($bil) == 2) {
		$urut = '0' . $bil;
	} else {
		$urut = $bil;
	}
	$id = $fw . $tipe . $urut;
	$qins = mysqli_query($conn, "INSERT into listtrolli values('$id','$troli','" . $_SESSION['wnik'] . "','" . date('Y-m-d H:i:s') . "')");
	$bil++;
	QRCode::png($id, $tempdir . $id . '.png', $quality1, $ukuran1, $padding1);
	$pdf->AddPage();
	$pdf->Image($tempdir . $id . '.png', 1, 1, -330);
	$pdf->Cell(30, 0, '', 0, 0);
	$pdf->Cell(15, 8, 'ID', 1, 0);
	$pdf->Cell(0, 8, ': ' . $id, 1, 1);
	$pdf->Cell(30, 0, '', 0, 0);
	$pdf->Cell(15, 8, 'Jenis', 1, 0);
	$pdf->Cell(0, 8, ': ' . $det['t_kategori'] . ' ' . $nama, 1, 1);
	$pdf->Cell(30, 0, '', 0, 0);
	$pdf->Cell(15, 8, 'No.', 1, 0);
	$pdf->Cell(0, 8, ': ' . substr($id, -3), 1, 1);
}
$files = glob('temp/*'); //get all file names
foreach ($files as $file) {
	if (is_file($file))
		unlink($file); //delete file
}
$pdf->Output($det['t_kategori'] . ' ID.pdf', 'I');
