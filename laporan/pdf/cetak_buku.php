<?php

require('../../fpdf/fpdf.php');
require('../../config/koneksi.php');

$pdf = new FPDF('L','mm','A4');

$pdf->AddPage();

/* =========================
   HEADER
========================= */

$pdf->SetFont('Arial','B',16);
$pdf->Cell(
    0,
    10,
    'LAPORAN DATA BUKU',
    0,
    1,
    'C'
);

$pdf->SetFont('Arial','',11);
$pdf->Cell(
    0,
    8,
    'Sistem Peminjaman Buku Laboratorium Software',
    0,
    1,
    'C'
);

$pdf->Cell(
    0,
    8,
    'Tanggal Cetak : ' . date('d-m-Y H:i:s'),
    0,
    1,
    'C'
);

$pdf->Ln(5);

/* =========================
   HEADER TABEL
========================= */

$pdf->SetFont('Arial','B',11);

$pdf->Cell(15,10,'No',1,0,'C');
$pdf->Cell(35,10,'Kode Buku',1,0,'C');
$pdf->Cell(110,10,'Judul Buku',1,0,'C');
$pdf->Cell(70,10,'Penulis',1,0,'C');
$pdf->Cell(25,10,'Stok',1,1,'C');

/* =========================
   DATA
========================= */

$data = mysqli_query(
    $koneksi,
    "SELECT * FROM buku ORDER BY id_buku ASC"
);

$no = 1;

$pdf->SetFont('Arial','',10);

while($d = mysqli_fetch_assoc($data)){

    $pdf->Cell(15,10,$no++,1,0,'C');
    $pdf->Cell(35,10,$d['kode_buku'],1);
    $pdf->Cell(110,10,$d['judul'],1);
    $pdf->Cell(70,10,$d['penulis'],1);
    $pdf->Cell(25,10,$d['stok'],1,1,'C');

}

/* =========================
   OUTPUT
========================= */

$pdf->Output(
    'I',
    'Laporan_Data_Buku.pdf'
);

?>