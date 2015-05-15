<?php 
$tgl=date("d M Y"); 
//koneksi ke database 
include("../../_db.php");
//akhir koneksi 
  
#ambil data di tabel dan masukkan ke array 
$query = "SELECT kodepasien, namapasien, kodekelas, alamat, biayakamar, biayaperawatan, biayadokter FROM pasien ORDER BY kodepasien"; 
$sql = mysql_query ($query); 
$data = array(); 
while ($row = mysql_fetch_assoc($sql)) { 
  array_push($data, $row); 
} 
  
#setting judul laporan dan header tabel 
$judul = "LAPORAN DATA PASIEN";
$judul1= "RUMAH SAKIT CINTA SEJATI";
$judul2= "Jalan Kamboja 21 Semarang"; 
$header = array( 
    array("label"=>"Kode", "length"=>15, "align"=>"L"), 
    array("label"=>"Nama Pasien", "length"=>35, "align"=>"L"), 
    array("label"=>"Kelas", "length"=>20, "align"=>"L"), 
    array("label"=>"Alamat", "length"=>40, "align"=>"L"), 
    array("label"=>"Biaya Kamar", "length"=>26, "align"=>"L"), 
    array("label"=>"Biaya Perawatan", "length"=>26, "align"=>"L"), 
    array("label"=>"Biaya Dokter", "length"=>26, "align"=>"L"), 
  ); 
  
#sertakan library FPDF dan bentuk objek 
require_once ("fpdf16/fpdf.php"); 
$pdf = new FPDF(); 
$pdf->AddPage(); 
  
#tampilkan judul laporan 
$pdf->SetFont('Arial','B','16'); 
$pdf->Cell(0,5, $judul, '0', 1, 'C');
$pdf->SetFont('Arial','B','16'); 
$pdf->Cell(0,5, $judul1, '0', 1, 'C');
$pdf->SetFont('Arial','B','16'); 
$pdf->Cell(0,5, $judul2, '0', 1, 'C'); 
  
#buat header tabel 
$pdf->SetFont('Arial','','9'); 
$pdf->SetFillColor(255,0,0); 
$pdf->SetTextColor(255); 
$pdf->SetDrawColor(128,0,0); 
foreach ($header as $kolom) { 
  $pdf->Cell($kolom['length'], 5, $kolom['label'], 1, '0', $kolom['align'], 
true); 
} 
$pdf->Ln(); 
  
#tampilkan data tabelnya 
$pdf->SetFillColor(224,235,255); 
$pdf->SetTextColor(0); 
$pdf->SetFont(''); 
$fill=false; 
foreach ($data as $baris) { 
  $i = 0; 
  foreach ($baris as $cell) { 
    $pdf->Cell($header[$i]['length'], 5, $cell, 1, '0', $kolom['align'], 
$fill); 
    $i++; 
  } 
  $fill = !$fill; 
  $pdf->Ln(); 
} 
$pdf->SetFont('Arial','B','10'); 
$pdf->Cell(0,10, "Semarang, $tgl", '0', 1, 'R');
$pdf->Cell(0,25, "Dr. Romeo, Sp    ", '0', 1, 'R');
  
#output file PDF 
$pdf->Output(); 
?> 