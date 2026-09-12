-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Database: `db_peminjaman_buku_lab`
-- MariaDB / MySQL
--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- ========================================================
-- DATABASE
-- ========================================================

CREATE DATABASE IF NOT EXISTS `db_peminjaman_buku_lab`
  DEFAULT CHARACTER SET latin1
  COLLATE latin1_swedish_ci;

USE `db_peminjaman_buku_lab`;


-- ========================================================
-- TABLE: buku
-- ========================================================

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `kode_buku` varchar(20) DEFAULT NULL,
  `judul` varchar(200) NOT NULL,
  `penulis` varchar(100) DEFAULT NULL,
  `penerbit` varchar(100) DEFAULT NULL,
  `tahun_terbit` year(4) DEFAULT NULL,
  `stok` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `cover` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- ========================================================
-- DATA: buku
-- ========================================================

INSERT INTO `buku`
(`id_buku`, `kode_buku`, `judul`, `penulis`, `penerbit`, `tahun_terbit`, `stok`, `created_at`, `cover`)
VALUES
(8, 'BK006', 'Born to Stand Out', 'R.D Asti', NULL, NULL, 4, '2026-06-20 16:13:49', '1781972029_Born to Stand Out.jpg');


-- ========================================================
-- TABLE: mahasiswa
-- ========================================================

CREATE TABLE `mahasiswa` (
  `npm` varchar(15) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` varchar(20) DEFAULT NULL,
  `prodi` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- ========================================================
-- DATA: mahasiswa
-- ========================================================

INSERT INTO `mahasiswa`
(`npm`, `nama`, `kelas`, `prodi`, `created_at`)
VALUES
('24000001', 'Mahasiswa 1', 'MI4D', 'Manajemen Informatika', '2026-06-18 06:45:46'),
('24000002', 'Mahasiswa 2', 'MI4D', 'Manajemen Informatika', '2026-06-18 06:45:22'),
('24000003', 'Mahasiswa 3', 'MI4D', 'Manajemen Informatika', '2026-06-18 06:28:14'),
('24000004', 'Mahasiswa 4', 'MI4D', 'Manajemen Informatika', '2026-06-18 06:44:58'),
('24000005', 'Mahasiswa 5', 'MI4D', 'Manajemen Informatika', '2026-06-18 06:46:07'),
('24000006', 'Mahasiswa 6', 'MI4A', 'Manajemen Informatika', '2026-06-22 13:29:25');


-- ========================================================
-- TABLE: peminjaman
-- ========================================================

CREATE TABLE `peminjaman` (
  `id_pinjam` int(11) NOT NULL,
  `npm` varchar(15) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_jatuh_tempo` date NOT NULL,
  `status` enum('Dipinjam','Dikembalikan') DEFAULT 'Dipinjam'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- ========================================================
-- DATA: peminjaman
-- ========================================================

INSERT INTO `peminjaman`
(`id_pinjam`, `npm`, `tanggal_pinjam`, `tanggal_jatuh_tempo`, `status`)
VALUES
(1, '24000001', '2026-06-18', '2026-06-25', 'Dikembalikan'),
(2, '24000001', '2026-06-18', '2026-06-25', 'Dikembalikan'),
(3, '24000002', '2026-06-18', '2026-06-25', 'Dikembalikan'),
(4, '24000003', '2026-06-18', '2026-06-25', 'Dikembalikan'),
(5, '24000004', '2026-06-18', '2026-06-25', 'Dikembalikan'),
(6, '24000001', '2026-06-20', '2026-06-27', 'Dikembalikan'),
(7, '24000005', '2026-06-22', '2026-06-29', 'Dipinjam');


-- ========================================================
-- TABLE: detail_peminjaman
-- ========================================================

CREATE TABLE `detail_peminjaman` (
  `id_detail` int(11) NOT NULL,
  `id_pinjam` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- ========================================================
-- DATA: detail_peminjaman
-- ========================================================

INSERT INTO `detail_peminjaman`
(`id_detail`, `id_pinjam`, `id_buku`, `jumlah`)
VALUES
(6, 6, 8, 1);


-- ========================================================
-- TABLE: users
-- ========================================================

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- ========================================================
-- DATA: users
-- ========================================================

INSERT INTO `users`
(`id_user`, `username`, `password`, `nama_lengkap`, `created_at`)
VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'Administrator', '2026-06-17 23:06:33');


-- ========================================================
-- PRIMARY KEY & INDEX
-- ========================================================

ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD UNIQUE KEY `kode_buku` (`kode_buku`);


ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`npm`);


ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `fk_peminjaman_mahasiswa` (`npm`);


ALTER TABLE `detail_peminjaman`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `fk_detail_pinjam` (`id_pinjam`),
  ADD KEY `fk_detail_buku` (`id_buku`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);


-- ========================================================
-- AUTO_INCREMENT
-- ========================================================

ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;


ALTER TABLE `detail_peminjaman`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


ALTER TABLE `peminjaman`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;


ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


-- ========================================================
-- FOREIGN KEY
-- ========================================================

ALTER TABLE `detail_peminjaman`
  ADD CONSTRAINT `fk_detail_buku`
    FOREIGN KEY (`id_buku`)
    REFERENCES `buku` (`id_buku`)
    ON DELETE CASCADE,

  ADD CONSTRAINT `fk_detail_pinjam`
    FOREIGN KEY (`id_pinjam`)
    REFERENCES `peminjaman` (`id_pinjam`)
    ON DELETE CASCADE;


ALTER TABLE `peminjaman`
  ADD CONSTRAINT `fk_peminjaman_mahasiswa`
    FOREIGN KEY (`npm`)
    REFERENCES `mahasiswa` (`npm`);


COMMIT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;