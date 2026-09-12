<?php

require('../../fpdf/fpdf.php');
require('../../config/koneksi.php');

$pdf = new FPDF('L','mm','A4');

$pdf->AddPage();

$pdf->SetFont('Arial','B',16);

$pdf->Cell(
    0,
    10,
    'LAPORAN DATA PEMINJAMAN',
    0,
    1,
    'C'
);

$pdf->Ln(5);

$pdf->SetFont('Arial','B',10);

$pdf->Cell(15,10,'ID',1);
$pdf->Cell(40,10,'NPM',1);
$pdf->Cell(70,10,'Nama',1);
$pdf->Cell(40,10,'Tgl Pinjam',1);
$pdf->Cell(50,10,'Jatuh Tempo',1);
$pdf->Cell(50,10,'Status',1);

$pdf->Ln();

$query = mysqli_query(

    $koneksi,

    "SELECT
        p.id_pinjam,
        p.npm,
        m.nama,
        p.tanggal_pinjam,
        p.tanggal_jatuh_tempo,
        p.status
     FROM peminjaman p
     JOIN mahasiswa m
     ON p.npm = m.npm"

);

$pdf->SetFont('Arial','',10);

while($d = mysqli_fetch_assoc($query)){

    $pdf->Cell(15,10,$d['id_pinjam'],1);
    $pdf->Cell(40,10,$d['npm'],1);
    $pdf->Cell(70,10,$d['nama'],1);
    $pdf->Cell(40,10,$d['tanggal_pinjam'],1);
    $pdf->Cell(50,10,$d['tanggal_jatuh_tempo'],1);
    $pdf->Cell(50,10,$d['status'],1);

    $pdf->Ln();
}

$pdf->Output(
    'I',
    'Laporan_Peminjaman.pdf'
);