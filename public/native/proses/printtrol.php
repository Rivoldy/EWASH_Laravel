<?php
require_once("conn.php");
session_start();

include '../plugins/qrcode/qrlib.php';
require('../plugins/fpdf/rotate.php');
include '../plugins/fpdf/makefont/makefont.php';

$troll = base64_decode(base64_decode($_POST['troll']));
$q = mysqli_query($conn, "SELECT * from listtrolli a inner join master_tipe_trolley b on a.l_tipe=b.t_id where l_id='$troll'");
$dt = mysqli_fetch_assoc($q);
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

QRCode::png($troll, $tempdir . $troll . '.png', $quality1, $ukuran1, $padding1);
$pdf->AddPage();
$pdf->Image($tempdir . $troll . '.png', 1, 1, -330);
$pdf->Cell(30, 0, '', 0, 0);
$pdf->Cell(15, 8, 'ID', 1, 0);
$pdf->Cell(0, 8, ': ' . $troll, 1, 1);
$pdf->Cell(30, 0, '', 0, 0);
$pdf->Cell(15, 8, 'Jenis', 1, 0);
$pdf->Cell(0, 8, ': ' . $dt['t_kategori'] . ' ' . $dt['t_nama'], 1, 1);
$pdf->Cell(30, 0, '', 0, 0);
$pdf->Cell(15, 8, 'No.', 1, 0);
$pdf->Cell(0, 8, ': ' . substr($troll, -3), 1, 1);
$files = glob('temp/*'); //get all file names
foreach ($files as $file) {
	if (is_file($file))
		unlink($file); //delete file
}
$pdf->Output('Trolley ID.pdf', 'I');
