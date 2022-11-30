<?php
require('fpdf184/fpdf.php');
require 'controller/koneksi.php';
$info = mysqli_query($koneksi, "SELECT * FROM tkategoribuku");
//membuat objek baru bernama pdf dari class FPDF
//dan melakukan setting kertas l : landscape, A5 : ukuran kertas
$pdf = new FPDF('l','mm','A5');
// membuat halaman baru
$pdf->AddPage();
// menyetel font yang digunakan, font yang digunakan adalah arial, bold dengan ukuran 16
$pdf->SetFont('Arial','B',16);
// judul
$pdf->Cell(190,7,'Laporan Kategori Buku',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,7,'PERIODE 2022',0,1,'C');
 
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);
 
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,6,'NOMOR',1,0);
$pdf->Cell(80,6,'KATEGORI',1,0);
$pdf->Cell(25,6,'STATUS',1,0);
$pdf->Cell(35,6,'RILIS DATA',1,1);
 
$pdf->SetFont('Arial','',10);
 
$no = 1;
while ($data = mysqli_fetch_array($info)){
    if($data['statuskategori']==1){
        $ket = "Active";
    }else{
        $ket = "Non-Active";
    }
    $pdf->Cell(20,6,$no++,1,0);
    $pdf->Cell(80,6,$data['kategoribuku'],1,0);
    $pdf->Cell(25,6,$ket,1,0);
    $pdf->Cell(35,6,$data['create_at'],1,1); 
}
 
$pdf->Output();


?>