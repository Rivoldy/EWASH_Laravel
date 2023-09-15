<?php
include '../../proses/conn.php';
include '../../plugins/fpdf/fpdf.php';
include 'makefont/makefont.php';

$kp = $_GET['kp'];
if (isset($_GET['tgl'])) {
	$tgl = $_GET['tgl'];
	$ttgal = "Tanggal";
} else {
	$tgl = $ttgal = '';
}
if ($tgl == '') {
	$ftgl = "";
	$utgl = "";
} else {
	$ftgl = " and modified like '$tgl%'";
	$utgl = "tgl=$tgl";
}
$qkp = mysqli_query($sap, "SELECT * from ordersap where VBELN='$kp' limit 1");
$dkp = mysqli_fetch_assoc($qkp);
$pdf = new FPDF('L', 'mm', 'Legal');
$pdf->AddFont('helvetica', '', 'helvetica.php');
$pdf->SetMargins(5, 5, 5);
$dok = 'ActualPackingList';
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(20, 5, 'Buyer', 0, 0);
$pdf->Cell(90, 5, ': UNIQLO', 0, 0);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(95, 5, 'PT Eco Smart Garment Indonesia', 0, 1, 'C');
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(20, 5, 'KP', 0, 0);
$pdf->Cell(90, 5, ': ' . $kp, 0, 0);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(95, 5, 'Desa Blumbang RT 04 RW 01 Kec. Klego', 0, 1, 'C');
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(20, 5, 'Style', 0, 0);
$pdf->Cell(90, 5, ': ' . substr($dkp['ZSAMPLECODE'], 2), 0, 0);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(95, 5, 'Boyolali', 0, 1, 'C');
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(20, 5, $ttgal, 0, 0);
$pdf->Cell(90, 5, ': ' . $tgl, 0, 0);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(95, 5, 'Summary Packed Secondary Process', 0, 1, 'C');
$pdf->SetFont('helvetica', 'B', 8);

$pdf->SetFont('helvetica', 'B', 9);
$pdf->Cell(50, 5, '', 0, 1, 'C');
$pdf->Cell(50, 5, '', 0, 1, 'C');

$qsize = mysqli_query($conn, "SELECT size from t_bag where kp='$kp' $ftgl group by size ORDER BY (CASE WHEN size REGEXP '(\d)+' THEN 0 ELSE 1 END) ASC,
  field(size,'3-4Y(110)','4-5Y(110)','5-6Y(120)','6-7Y(120)','7-8Y(130)','8-9Y(130)','9-10Y(140)','10-11Y(140)','11-12Y(150)','12-13Y(150)','13Y(160)','14Y(160)','XXS', 'XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL','3XL'),size");
if (mysqli_num_rows($qsize) != 0) {
	while ($dsize = mysqli_fetch_array($qsize)) {
		$nmsize[] = $dsize['size'];
	}
}
$pdf->Cell(30, 8, 'Color / Size', 1, 0, 'C');
for ($i = 0; $i < count($nmsize); $i++) {
	$pdf->Cell(30, 8, $nmsize[$i], 1, 0, 'C');
}

$pdf->Cell(30, 8, 'Total Pcs', 1, 0,);
$pdf->Cell(30, 8, 'Total Pack', 1, 1,);

$q = mysqli_query($conn, "SELECT *, count(distinct(bid)) as karung from t_bag where kp='$kp' $ftgl group by color");
$totbag = $totqty = $totnw = $totgw = 0;
while ($dt = mysqli_fetch_assoc($q)) {
	$color = $dt['color'];
	$qtybag = $dt['qty'];
	$jmlbag = $dt['karung'];
	$totbag = $totbag + $jmlbag;

	$pdf->Cell(30, 8,  $color, 1, 0, 'C');
	$jmlpcs = 0;
	for ($i = 0; $i < count($nmsize); $i++) {
		$qsi = mysqli_query($conn, "SELECT sum(qty) as qty from t_bag where kp='$kp' and color='$color' and size='$nmsize[$i]'");
		$dsi = mysqli_fetch_assoc($qsi);
		$jmlpcs = $jmlpcs + $dsi['qty'];
		$pdf->Cell(30, 8, number_format($dsi['qty']), 1, 0, 'R');
	}
	$pdf->Cell(30, 8, number_format($jmlpcs), 1, 0, 'R');
	$pdf->Cell(30, 8, number_format($jmlbag), 1, 1, 'R');
}

$pdf->Output($dok . '.pdf', 'I');
