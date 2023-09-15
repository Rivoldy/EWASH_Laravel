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

$style = $_GET['style'];
$lem = $_GET['kp'];
if ($lem == "all") {
	$kp = "";
} else {
	$kp = " AND kp = '$lem'";
}
$qkp = mysqli_query($conn, "SELECT * from t_scale where style='$style' $kp limit 1");
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
$pdf->Cell(100, 5, 'PT Eco Smart Garment Indonesia', 0, 1, 'C');
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(25, 5, 'Style', 0, 0);
$pdf->Cell(90, 5, ': ' . $style, 0, 0);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(100, 5, 'Desa Blumbang RT 04 RW 01 Kec. Klego', 0, 1, 'C');
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(25, 5, '', 0, 0);
$pdf->Cell(90, 5, '', 0, 0);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(100, 5, 'Boyolali', 0, 1, 'C');
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(25, 5, '', 0, 0);
$pdf->Cell(90, 5, '', 0, 0);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(100, 5, 'Order Status CMT Out', 0, 0, 'C');
$pdf->SetFont('helvetica', 'B', 8);

$pdf->SetFont('helvetica', 'B', 9);
$pdf->Cell(50, 5, '', 0, 1, 'C');
$pdf->Cell(50, 5, '', 0, 1, 'C');


$pdf->Cell(30, 8, 'KP', 1, 0,);
$pdf->Cell(30, 8, 'Color', 1, 0,);
$pdf->Cell(30, 8, 'Size', 1, 0,);
$pdf->Cell(40, 8, 'Qty Order + Allowance', 1, 0);
$pdf->Cell(30, 8, 'Qty Packed', 1, 0);
$pdf->Cell(30, 8, 'Qty Loaded', 1, 0);
$pdf->Cell(30, 8, 'Qty Received', 1, 0);
$pdf->Cell(30, 8, 'Balance', 1, 0);
$pdf->Cell(30, 8, 'Completion', 1, 1);

$q = mysqli_query($conn, "SELECT * from t_scale where style = '$style' $kp GROUP BY kp, color, size order by kp, color");
while ($dt = mysqli_fetch_assoc($q)) {
	$q1 = mysqli_query($sap, "SELECT SUM(ZQTY) AS ZQTY FROM ordersap WHERE ZMATGEN = '{$dt['style']}' AND VBELN = '{$dt['kp']}' AND ZCOLOR = '{$dt['color']}' AND ZSIZES = '{$dt['size']}'");
	$r1 = mysqli_fetch_array($q1);

	$q2 = mysqli_query($conn, "SELECT SUM(qty) AS qty FROM t_scale WHERE style = '{$dt['style']}' AND kp = '{$dt['kp']}' AND color = '{$dt['color']}' AND size = '{$dt['size']}'");
	$r2 = mysqli_fetch_array($q2);

	$q3 = mysqli_query($conn, "SELECT SUM(qty) AS qty FROM t_scale WHERE pl_id = '{$dt['pl_id']}' AND style = '{$dt['style']}' AND kp = '{$dt['kp']}' AND color = '{$dt['color']}' AND size = '{$dt['size']}'");
	if (mysqli_num_rows($q3) == 0) {
		$plo = 0;
	} else {
		$r3 = mysqli_fetch_array($q3);
		$plo = $r3['qty'] == null ? 0 : $r3['qty'];
	}

	$pdf->Cell(30, 8, $dt['kp'], 1, 0, 'C');
	$pdf->Cell(30, 8, $dt['color'], 1, 0, 'C');
	$pdf->Cell(30, 8, $dt['size'], 1, 0, 'C');
	$pdf->Cell(40, 8, number_format($order = $r1['ZQTY'] + (round($r1['ZQTY'] * 0.02))), 1, 0, 'C');
	$pdf->Cell(30, 8, number_format($packed = $r2['qty'] == null ? 0 : $r2['qty']), 1, 0, 'C');
	$pdf->Cell(30, 8, number_format($plo), 1, 0, 'C');
	$pdf->Cell(30, 8, number_format(0), 1, 0, 'C');
	$pdf->Cell(30, 8, number_format($packed - $plo), 1, 0, 'C');
	$pdf->Cell(30, 8, number_format($plo / $order * 100) . '%', 1, 1, 'C');
}

$pdf->Output($dok . '.pdf', 'I');
