<?php
include '../../proses/conn.php';
include '../../plugins/fpdf/fpdf.php';
include 'makefont/makefont.php';

class PDF extends FPDF
{
	function Footer()
	{
		// Go to 1.5 cm from bottom
		$this->SetY(-15);
		// Select Arial italic 8
		$this->SetFont('Arial', 'I', 8);
		// Print current and total page numbers
		$this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
	}
}

$kp = $_GET['kp'];
if (isset($_GET['tgl'])) {
	$tgl = $_GET['tgl'];
	$ttgal = "Closing Time";
} else {
	$tgl = $ttgal = '';
}
if ($tgl == '') {
	$ftgl = "";
	$utgl = "";
} else {
	$ftgl = " and closing like '$tgl%'";
	$utgl = "tgl=$tgl";
}
$qkp = mysqli_query($conn, "SELECT * from t_bag where kp='$kp' limit 1");
$dkp = mysqli_fetch_assoc($qkp);
$q = mysqli_query($conn, "SELECT * FROM pl_send WHERE id = '{$dkp['pl_id']}'");
$r = mysqli_fetch_array($q);
$pdf = new PDF('L', 'mm', 'Legal');
$pdf->AliasNbPages();
$pdf->AddFont('helvetica', '', 'helvetica.php');
$pdf->SetMargins(5, 5, 5);
$dok = 'ActualPackingList';
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(25, 5, 'Buyer', 0, 0);
$pdf->Cell(90, 5, ': UNIQLO', 0, 0);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(100, 5, 'PT Eco Smart Garment Indonesia', 0, 0, 'C');
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(60, 5, '', 0, 0);
$pdf->Cell(25, 5, 'Destination', 0, 0);
$pdf->Cell(99, 5, ': ' . $r['dest'], 0, 1);
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(25, 5, 'KP', 0, 0);
$pdf->Cell(90, 5, ': ' . $kp, 0, 0);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(100, 5, 'Desa Blumbang RT 04 RW 01 Kec. Klego', 0, 0, 'C');
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(60, 5, '', 0, 0);
$pdf->Cell(25, 5, 'Truck No', 0, 0);
$pdf->Cell(99, 5, ': ' . $r['truck'], 0, 1);
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(25, 5, 'Style', 0, 0);
$pdf->Cell(90, 5, ': ' . $dkp['style'], 0, 0);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(100, 5, 'Boyolali', 0, 0, 'C');
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(60, 5, '', 0, 0);
$pdf->Cell(25, 5, 'Driver', 0, 0);
$pdf->Cell(99, 5, ': ' . $r['driver'], 0, 1);
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(25, 5, $ttgal, 0, 0);
$pdf->Cell(90, 5, ': ' . $tgl, 0, 0);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(100, 5, 'Detail Loaded CMT Out', 0, 0, 'C');
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(60, 5, '', 0, 0);
$pdf->Cell(25, 5, 'CP', 0, 0);
$pdf->Cell(99, 5, ': ' . $r['contact'], 0, 1);
$pdf->SetFont('helvetica', 'B', 8);

$pdf->SetFont('helvetica', 'B', 9);
$pdf->Cell(50, 5, '', 0, 1, 'C');
$pdf->Cell(50, 5, '', 0, 1, 'C');



$pdf->Cell(30, 8, 'Bag ID', 1, 0,);
$pdf->Cell(30, 8, 'Style', 1, 0,);
$pdf->Cell(30, 8, 'Size', 1, 0,);
$pdf->Cell(30, 8, 'Color', 1, 0);
$pdf->Cell(30, 8, 'QTY', 1, 1);

$q = mysqli_query($conn, "SELECT * from t_bag where kp='$kp' $ftgl");
while ($dt = mysqli_fetch_assoc($q)) {


	$pdf->Cell(30, 8, $dt['bid'], 1, 0, 'C');
	$pdf->Cell(30, 8, $dt['style'], 1, 0, 'C');
	$pdf->Cell(30, 8, $dt['size'], 1, 0, 'C');
	$pdf->Cell(30, 8, $dt['color'], 1, 0, 'C');
	$pdf->Cell(30, 8, number_format($dt['qty']), 1, 1, 'C');
}

$pdf->Output($dok . '.pdf', 'I');
