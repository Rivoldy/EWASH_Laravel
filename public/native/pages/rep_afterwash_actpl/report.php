<?php
include '../../proses/conn.php';
include '../../plugins/fpdf/fpdf.php';
include 'makefont/makefont.php';

class PDF extends FPDF
{
	function Footer()
	{
		$this->SetY(-15);
		$this->SetFont('helvetica', 'I', 8);
		$this->Cell(0, 10, 'Page ' . $this->PageNo() . " / {nb}", 0, 0, 'R');
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
$qkp = mysqli_query($conn, "SELECT * from t_scale where kp='$kp' limit 1");
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
$pdf->Cell(100, 5, 'Summary Loaded CMT Out', 0, 0, 'C');
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(60, 5, '', 0, 0);
$pdf->Cell(25, 5, 'CP', 0, 0);
$pdf->Cell(99, 5, ': ' . $r['contact'], 0, 1);
$pdf->SetFont('helvetica', 'B', 8);

$pdf->SetFont('helvetica', 'B', 9);
$pdf->Cell(50, 5, '', 0, 1, 'C');
$pdf->Cell(50, 5, '', 0, 1, 'C');

$qsize = mysqli_query($conn, "SELECT size from t_scale where kp='$kp' AND closing_status = 1 $ftgl group by size ORDER BY (CASE WHEN size REGEXP '(\d)+' THEN 0 ELSE 1 END) ASC,
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
$pdf->Cell(30, 8, 'Total Pack', 1, 0,);
$pdf->Cell(30, 8, 'Total NW', 1, 0,);
$pdf->Cell(30, 8, 'Total GW', 1, 1,);

$q = mysqli_query($conn, "SELECT *,sum(nw) as nett, sum(gw) as gross, count(distinct(bid)) as karung from t_scale where kp='$kp' AND closing_status = 1 $ftgl group by color");
$totbag = $totqty = $totnw = $totgw = 0;
while ($dt = mysqli_fetch_assoc($q)) {
	$color = $dt['color'];
	$qtybag = $dt['qty'];
	$jmlbag = $dt['karung'];
	$totbag = $totbag + $jmlbag;
	$totnw = $totnw + $dt['nett'];
	$totgw = $totgw + $dt['gross'];

	$pdf->Cell(30, 8,  $color, 1, 0, 'C');
	$jmlpcs = 0;
	for ($i = 0; $i < count($nmsize); $i++) {
		$qsi = mysqli_query($conn, "SELECT sum(qty) as qty from t_scale where kp='$kp' AND closing_status = 1 and color='$color' and size='$nmsize[$i]'");
		$dsi = mysqli_fetch_assoc($qsi);
		$jmlpcs = $jmlpcs + $dsi['qty'];
		$pdf->Cell(30, 8, number_format($dsi['qty']), 1, 0, 'R');
	}
	$pdf->Cell(30, 8, number_format($jmlpcs), 1, 0, 'R');
	$pdf->Cell(30, 8, number_format($jmlbag), 1, 0, 'R');
	$pdf->Cell(30, 8, number_format($dt['nett'], 2), 1, 0, 'R');
	$pdf->Cell(30, 8, number_format($dt['gross'], 2), 1, 1, 'R');
}

$pdf->Output($dok . '.pdf', 'I');
