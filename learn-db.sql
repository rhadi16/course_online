-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.24-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for learn
CREATE DATABASE IF NOT EXISTS `learn` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `learn`;

-- Dumping structure for table learn.accounts
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` varchar(150) NOT NULL DEFAULT '',
  `email` varchar(150) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table learn.accounts: ~11 rows (approximately)
INSERT INTO `accounts` (`id`, `email`, `password`, `is_active`, `date_created`) VALUES
	('1234', 'admin@admin.com', '$2y$10$RdNpenTQ4vbOZV69UcQRAeRR/ZtP04JN8jJ3EmwFMloImYtKljC.G', 1, '2022-08-24 23:22:20'),
	('G0001', 'rhadi.indrawankkpi@gmail.com', '$2y$10$KApRFSasEX4NStVipsRil.sMzs/eJwaQUNwOmLWil9GidyV9DFS1a', 1, '2022-08-30 00:40:06'),
	('G0002', 'indrawanrhadi@gmail.com', '$2y$10$qCPHtSCLaodjouiLGdckuuIYd1ml9j9qIz8IL/PJtaZPQrkL.iBke', 1, '2022-08-30 00:44:36'),
	('G0003', 'irman@gmail.com', '$2y$10$8/PYPh3hgIBJ1NC1dtKHrueE1rl447qp8ykzLPCXIFISuMh7vpr1e', 1, '2022-09-22 01:04:43'),
	('G0004', 'ardi@ardi.com', '$2y$10$jky7iEj3xO5UrX2kPsMF5OpDBatx4DQlsgG8oyWcQByPSLibokism', 1, '2022-09-27 07:46:59'),
	('G0005', 'adrian@adrian.com', '$2y$10$tKf/88x3ezsoshWh7BeoIeX065sjHUPLWpL.8sd9C7h4soUxtKyxe', 1, '2022-09-28 06:20:30'),
	('M0001', 'aswar@aswar.com', '$2y$10$6T.XVER201tEHZoTDXt5iOL9stybQZ63yEg5MSRq7wNOh2NQDc2Hm', 1, '2022-08-31 05:43:13'),
	('M0002', 'adnan@adnan.com', '$2y$10$6JDVOe8ubTs1qf98urZ1GOSfIZ.8oYTRGSyhQD5u5ozUgNudmpeU.', 1, '2022-08-31 06:23:20'),
	('M0003', 'farhan@farhan.com', '$2y$10$tfXjPp.uyTYFxNVFuvLSweivJsI8t3OiQ.GHLN3c1XXYDGTeMzUu6', 1, '2022-09-06 02:57:03'),
	('M0004', 'arman@arman.com', '$2y$10$rQ8jLu5RBCZAS2pSofJeZuL3gAtBRgD0yq.18ouneRpK5Kxda.FUm', 1, '2022-09-25 05:11:39'),
	('M0005', 'ahmad@ahmad.com', '$2y$10$VKwBHpTQCR0zQX6NUfJff.jxgfh4W86yyxXTPt2Io0d37N1ezyDJC', 1, '2022-09-27 07:49:32');

-- Dumping structure for table learn.jadwal
CREATE TABLE IF NOT EXISTS `jadwal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kls` varchar(150) DEFAULT NULL,
  `id_mapel` int(11) DEFAULT NULL,
  `hari` varchar(50) DEFAULT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL,
  `id_mentor` varchar(150) DEFAULT NULL,
  `program` varchar(50) DEFAULT NULL,
  `link_kls` text DEFAULT NULL,
  `link_meet` text DEFAULT NULL,
  `materi` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table learn.jadwal: ~5 rows (approximately)
INSERT INTO `jadwal` (`id`, `nama_kls`, `id_mapel`, `hari`, `jam_masuk`, `jam_keluar`, `id_mentor`, `program`, `link_kls`, `link_meet`, `materi`) VALUES
	(23, 'Online Private I', 1, 'Jumat', '09:20:00', '11:00:00', 'G0002', 'Online Private', NULL, NULL, NULL),
	(25, 'Online Private I', 5, 'Senin', '09:10:00', '11:00:00', 'G0003', 'Online Private', NULL, NULL, NULL),
	(26, 'Offline Private I', 6, 'Rabu', '07:30:00', '09:10:00', 'G0003', 'Offline Private', NULL, NULL, NULL),
	(27, 'Offline Private I', 6, 'Senin', '09:20:00', '11:00:00', 'G0003', 'Offline Private', NULL, NULL, NULL),
	(28, 'Online Private I', 4, 'Kamis', '07:30:00', '09:10:00', 'G0003', 'Online Private', NULL, NULL, NULL);

-- Dumping structure for table learn.lokasi_internasional
CREATE TABLE IF NOT EXISTS `lokasi_internasional` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `negara` varchar(150) DEFAULT NULL,
  `provinsi` varchar(150) DEFAULT NULL,
  `kota` varchar(150) DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table learn.lokasi_internasional: ~3 rows (approximately)
INSERT INTO `lokasi_internasional` (`id`, `negara`, `provinsi`, `kota`, `alamat`) VALUES
	(2, 'Malaysia', 'Kuala Lumpur', 'Kuala Lumpur', 'Kuala Lumpur'),
	(3, 'Indonesia', 'Sul-sel', 'Makassar', 'Pongtiku'),
	(4, 'Indonesia', 'Gowa', 'Gowa', 'Palangga');

-- Dumping structure for table learn.marketing
CREATE TABLE IF NOT EXISTS `marketing` (
  `id` varchar(150) NOT NULL DEFAULT 'NULL',
  `status` varchar(150) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table learn.marketing: ~5 rows (approximately)
INSERT INTO `marketing` (`id`, `status`) VALUES
	('M0001', 'Glow'),
	('M0002', 'Elite'),
	('M0003', 'TS'),
	('M0004', 'DS'),
	('M0005', 'Shine');

-- Dumping structure for table learn.mentor
CREATE TABLE IF NOT EXISTS `mentor` (
  `id` varchar(150) NOT NULL,
  `mapel` varchar(150) NOT NULL,
  PRIMARY KEY (`id`,`mapel`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table learn.mentor: ~10 rows (approximately)
INSERT INTO `mentor` (`id`, `mapel`) VALUES
	('G0001', '1'),
	('G0001', '2'),
	('G0001', '3'),
	('G0002', '1'),
	('G0002', '3'),
	('G0003', '4'),
	('G0003', '5'),
	('G0003', '6'),
	('G0004', '1'),
	('G0004', '4');

-- Dumping structure for table learn.new_akun
CREATE TABLE IF NOT EXISTS `new_akun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) DEFAULT NULL,
  `asal` varchar(150) DEFAULT NULL,
  `no_hp` varchar(150) DEFAULT NULL,
  `tglahir` date DEFAULT NULL,
  `image` text DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `lok_inter` int(11) DEFAULT NULL,
  `password` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table learn.new_akun: ~0 rows (approximately)

-- Dumping structure for table learn.profile
CREATE TABLE IF NOT EXISTS `profile` (
  `id` varchar(150) NOT NULL DEFAULT '',
  `nama` varchar(150) DEFAULT NULL,
  `asal` varchar(150) DEFAULT NULL,
  `no_hp` varchar(150) DEFAULT NULL,
  `tglahir` date DEFAULT NULL,
  `image` text DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `lok_inter` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table learn.profile: ~11 rows (approximately)
INSERT INTO `profile` (`id`, `nama`, `asal`, `no_hp`, `tglahir`, `image`, `role_id`, `lok_inter`) VALUES
	('1234', 'Admin Default', 'admin', '12345', '2022-08-29', 'not.jpg', 1, NULL),
	('G0001', 'Rhadi Indrawan', 'Makassar', '085255554789', '2000-04-16', 'WhatsApp_Image_2022-08-31_at_15_23_58.jpeg', 2, 2),
	('G0002', 'Indrawan Rhadi', 'Makassar', '085255554789', '2001-09-16', 'WhatsApp_Image_2022-08-31_at_15_13_30.jpeg', 2, 3),
	('G0003', 'Irman Rama', 'Maros', '023423', '1995-03-12', 'itachi-uchiha-naruto-1.jpg', 2, 4),
	('G0004', 'Ardiansyah', 'Makassar', '28348345', '1995-04-12', 'not.jpg', 2, 4),
	('G0005', 'Adrian', 'Pare-pare', '37458723', '1999-04-12', '539978531.jpg', 2, 3),
	('M0001', 'Aswar Manaf', 'Makassar', '085234123', '2004-12-23', 'naruto.jpg', 3, 2),
	('M0002', 'Adnan', 'Makassar', '082345', '2004-04-12', 'not.jpg', 3, NULL),
	('M0003', 'farhan', 'Barcelona', '12345', '2004-04-12', 'not.jpg', 3, 3),
	('M0004', 'Arman', 'Makassar', '085255554789', '1995-04-23', 'not.jpg', 3, NULL),
	('M0005', 'ahmad', 'Bantaeng', '083242', '1999-04-23', 'not.jpg', 3, NULL);

-- Dumping structure for table learn.ref_mapel
CREATE TABLE IF NOT EXISTS `ref_mapel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_mapel` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table learn.ref_mapel: ~6 rows (approximately)
INSERT INTO `ref_mapel` (`id`, `nama_mapel`) VALUES
	(1, 'matematika'),
	(2, 'bahasa indonesia'),
	(3, 'bahasa inggris'),
	(4, 'Fisika'),
	(5, 'bahasa arab'),
	(6, 'bahasa spanyol');

-- Dumping structure for table learn.role
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table learn.role: ~3 rows (approximately)
INSERT INTO `role` (`id`, `role`) VALUES
	(1, 'admin'),
	(2, 'mentor'),
	(3, 'marketing');

-- Dumping structure for table learn.santri
CREATE TABLE IF NOT EXISTS `santri` (
  `id` varchar(50) NOT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `jkl` varchar(50) DEFAULT NULL,
  `asal` varchar(150) DEFAULT NULL,
  `tglahir` date DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `hafalan` varchar(150) DEFAULT NULL,
  `kemampuan_ngaji` varchar(150) DEFAULT NULL,
  `kemampuan_bahasa` varchar(150) DEFAULT NULL,
  `ustadz-dzah` varchar(150) DEFAULT NULL,
  `no_hp` varchar(50) DEFAULT NULL,
  `program` varchar(50) DEFAULT NULL,
  `wkt_bljr` varchar(150) DEFAULT NULL,
  `wkt_luang` varchar(150) DEFAULT NULL,
  `nama_kls` varchar(150) DEFAULT NULL,
  `pa` varchar(150) DEFAULT NULL,
  `bukti_byr` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table learn.santri: ~6 rows (approximately)
INSERT INTO `santri` (`id`, `nama`, `jkl`, `asal`, `tglahir`, `alamat`, `hafalan`, `kemampuan_ngaji`, `kemampuan_bahasa`, `ustadz-dzah`, `no_hp`, `program`, `wkt_bljr`, `wkt_luang`, `nama_kls`, `pa`, `bukti_byr`) VALUES
	('S0001', 'Ardi siro', 'L', 'Surabaya', '2000-04-12', 'jl. surabaya', '2 juz', 'Al-Qur\'an', 'Masif Inggris', 'Ustadz', '28348345', 'Online Reguler', 'SRJ', 'Cuman Bisa Pagi', NULL, 'M0001', NULL),
	('S0002', 'Arsan Raham', 'L', 'Baghdad', '1994-04-12', 'jl. baghdad', '5 juz', 'Al-Qur\'an', 'Masif Inggris', 'Ustadz', '0234239', 'Offline Private', 'SRJ', 'Cuman Bisa Sore', NULL, 'M0002', NULL),
	('S0003', 'Ardinda', 'P', 'Wajo', '1999-05-08', 'jl. wajo', '3 juz', 'Al-Qur\'an', 'Masif Inggris', 'Ustadzah', '34924823', 'Online Private', 'SRJ', 'Cuman Bisa Pagi', 'Online Private I', 'M0003', 'An_example_for_a_nailed_note2.jpg'),
	('S0004', 'Amanda', 'P', 'Pangkep', '2007-02-14', 'jl. pangkep', 'Belum ada', 'Iqra', 'Masif Inggris', 'Ustadzah', '0298954', 'Online Private', 'SRJ', 'Setiap Sore', 'Online Private I', 'M0004', 'An_example_for_a_nailed_note.jpg'),
	('S0005', 'Arsan Putra', 'L', 'Maros', '1994-08-07', 'jl. maros', 'Juz 12', 'Al-Qur\'an', 'Masif Inggris', 'Ustadz', '09298243', 'Online Reguler', 'SRJ', 'Setiap Sore', 'Offline Private I', 'M0005', 'An_example_for_a_nailed_note1.jpg'),
	('S0006', 'Arsal Arsim', 'L', 'Pangkep', '2007-03-12', 'jl. pangkep', 'Juz 30', 'Al-Qur\'an', 'Masif Inggris', 'Ustadz', '234223', 'Online Reguler', 'SRJ', 'Setiap Sore', NULL, 'M0005', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
