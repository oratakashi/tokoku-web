<?php 
include('include/config.php');
include 'fpdf/fpdf.php';
$td= date("His");
$judul = "DAFTAR HARGA";
$pdf = new FPDF("P","cm","A4");
$pdf->AddPage();
$pdf->SetFont('Arial','B','13');
$pdf->Cell(0,1, $judul, '0', 1, 'C');
$pdf->ln();
    $pdf->SetFont('Arial','B','8');
    $pdf->Cell(1,1,'No','LRTB',0,'C');
    $pdf->Cell(8,1,'Nama Barang','LRTB',0,'C');
    $pdf->Cell(3,1,'Qty','LRTB',0,'C');
    $pdf->Cell(3,1,'Harga Umum','LRTB',0,'C');
$pdf->Cell(3,1,'Harga Grosir','LRTB',0,'C');
//$pdf->Cell(3,1,'Harga Bengkel','LRTB',0,'C');

	
$pdf->ln();
$pdf->SetFont('');
$query = mysql_query("SELECT * FROM stok_bahan ORDER BY nama_bahan ASC ");
$no = 1;
while ($data = mysql_fetch_array($query)) {
    $pdf->Cell(1,1,$no,'LRTB',0,'C');
    $pdf->Cell(8,1,ucwords($data['nama_bahan']),'LRTB',0,'L');
    $pdf->Cell(3,1,$data['jumlah'].' '.$data['satuan'],'LRTB',0,'C');
    $pdf->Cell(3,1,'Rp. '.number_format($data['hargaj']),'LRTB',0,'R');
$pdf->Cell(3,1,'Rp. '.number_format($data['hargag1']),'LRTB',0,'R');
//$pdf->Cell(3,1,'Rp. '.number_format($data['hargag2']),'LRTB',0,'R');
$pdf->ln();
$no++;
}
$pdf->Output("Price-list-$td.pdf","I");
?>