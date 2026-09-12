<?php

require('../../fpdf/fpdf.php');
require('../../config/koneksi.php');

$pdf = new FPDF('L','mm','A4');

$pdf->AddPage();

$pdf->SetFont('Arial','B',16);

$pdf->Cell(
    0,
    10,
    'LAPORAN DATA MAHASISWA',
    0,
    1,
    'C'
);

$pdf->Ln(5);

$pdf->SetFont('Arial','B',11);

$pdf->Cell(15,10,'No',1);
$pdf->Cell(50,10,'NPM',1);
$pdf->Cell(90,10,'Nama',1);
$pdf->Cell(50,10,'Kelas',1);
$pdf->Cell(70,10,'Prodi',1);

$pdf->Ln();

$data = mysqli_query(
    $koneksi,
    "SELECT * FROM mahasiswa"
);

$no = 1;

$pdf->SetFont('Arial','',10);

while($d = mysqli_fetch_assoc($data)){

    $pdf->Cell(15,10,$no++,1);
    $pdf->Cell(50,10,$d['npm'],1);
    $pdf->Cell(90,10,$d['nama'],1);
    $pdf->Cell(50,10,$d['kelas'],1);
    $pdf->Cell(70,10,$d['prodi'],1);

    $pdf->Ln();
}

$pdf->Output(
    'I',
    'Laporan_Mahasiswa.pdf'
);