-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2014 at 05:13 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sistem_praktikum_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_absensi`
--

CREATE TABLE IF NOT EXISTS `tb_absensi` (
  `praktikan_nim` varchar(10) NOT NULL,
  `modul_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `praktikan_nim` (`praktikan_nim`,`modul_id`),
  KEY `modul_id` (`modul_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_absen_asisten`
--

CREATE TABLE IF NOT EXISTS `tb_absen_asisten` (
  `absen_asisten_id` int(11) NOT NULL AUTO_INCREMENT,
  `absen_asisten_keterangan` text NOT NULL,
  `asisten_nim` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`absen_asisten_id`),
  KEY `asisten_nim` (`asisten_nim`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_asisten`
--

CREATE TABLE IF NOT EXISTS `tb_asisten` (
  `asisten_kode` varchar(3) NOT NULL,
  `asisten_nama` varchar(50) NOT NULL,
  `asisten_email` varchar(50) NOT NULL,
  `asisten_telp` varchar(15) NOT NULL,
  `asisten_foto` text NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `asisten_nim` varchar(10) NOT NULL,
  `lab_id` int(11) NOT NULL,
  `asisten_status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`asisten_nim`),
  KEY `jabatan_id` (`role_id`),
  KEY `user_id` (`user_id`),
  KEY `lab_id` (`lab_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_asisten`
--

INSERT INTO `tb_asisten` (`asisten_kode`, `asisten_nama`, `asisten_email`, `asisten_telp`, `asisten_foto`, `role_id`, `user_id`, `asisten_nim`, `lab_id`, `asisten_status`, `created_at`, `updated_at`) VALUES
('a', 'a', 'a', '1', '', 3, 32, '1', 6, 1, '2014-07-08 16:19:28', '2014-07-08 16:19:28'),
('DNA', 'Diana Meiriana', 'asdlkj', '08112343928', '', 3, 29, '1106110042', 3, 1, '2014-07-13 08:11:45', '2014-07-13 01:11:45'),
('RNI', 'Rini Setya', 'lkjl', '08273731980', '', 3, 30, '1106110089', 3, 1, '2014-07-13 08:14:10', '2014-07-13 01:14:10');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_jadwal_praktikan`
--

CREATE TABLE IF NOT EXISTS `tb_detail_jadwal_praktikan` (
  `jadwal_id` int(11) NOT NULL,
  `praktikan_nim` varchar(10) NOT NULL,
  `absen` varchar(1) NOT NULL DEFAULT '0',
  `keterangan` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `jadwal_id` (`jadwal_id`,`praktikan_nim`),
  KEY `praktikan_nim` (`praktikan_nim`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_detail_jadwal_praktikan`
--

INSERT INTO `tb_detail_jadwal_praktikan` (`jadwal_id`, `praktikan_nim`, `absen`, `keterangan`, `created_at`, `updated_at`) VALUES
(9, '1106110000', '0', NULL, '2014-09-04 10:31:45', '2014-09-04 10:31:45'),
(11, '1106110000', '0', NULL, '2014-09-05 22:15:05', '2014-09-05 22:15:05');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_praktikan_kelas`
--

CREATE TABLE IF NOT EXISTS `tb_detail_praktikan_kelas` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `praktikan_nim` varchar(10) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`no`),
  KEY `detail_praktikan_kelas_praktikan_nim` (`praktikan_nim`,`kelas_id`),
  KEY `kelas_id` (`kelas_id`),
  KEY `praktikan_nim` (`praktikan_nim`),
  KEY `kelas_id_2` (`kelas_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tb_detail_praktikan_kelas`
--

INSERT INTO `tb_detail_praktikan_kelas` (`no`, `praktikan_nim`, `kelas_id`, `created_at`, `updated_at`) VALUES
(2, '1106110009', 1, '2014-07-04 01:00:53', '2014-07-04 01:00:53'),
(3, '1106110010', 1, '2014-07-04 01:12:08', '2014-07-04 01:12:08'),
(4, '1106110000', 1, '2014-07-13 21:27:35', '2014-07-13 21:27:35'),
(5, '1106110042', 1, '2014-09-04 19:16:16', '2014-09-04 19:16:16');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_praktikum_asisten`
--

CREATE TABLE IF NOT EXISTS `tb_detail_praktikum_asisten` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `asisten_nim` varchar(10) NOT NULL,
  `praktikum_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`no`),
  KEY `asisten_nim` (`asisten_nim`,`praktikum_id`),
  KEY `praktikum_id` (`praktikum_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_praktikum_praktikan`
--

CREATE TABLE IF NOT EXISTS `tb_detail_praktikum_praktikan` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `praktikan_nim` varchar(10) NOT NULL,
  `praktikum_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`no`),
  KEY `praktikan_nim` (`praktikan_nim`,`praktikum_id`),
  KEY `praktikum_id` (`praktikum_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_dosen`
--

CREATE TABLE IF NOT EXISTS `tb_dosen` (
  `dosen_nip` varchar(15) NOT NULL,
  `dosen_nama` varchar(50) NOT NULL,
  `dosen_email` varchar(50) NOT NULL,
  `dosen_telp` varchar(15) NOT NULL,
  `dosen_foto` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `dosen_status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`dosen_nip`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_dosen`
--

INSERT INTO `tb_dosen` (`dosen_nip`, `dosen_nama`, `dosen_email`, `dosen_telp`, `dosen_foto`, `user_id`, `dosen_status`, `created_at`, `updated_at`) VALUES
('1106110009', 'Rahmadi', 'rahmadi@gmail.com', '01231245435', '1106110009', 38, 1, '2014-07-13 14:52:37', '2014-07-13 07:52:37'),
('1106110010', 'Dosen', 'dosen@dosen.com', '01231245435', '1106110010', 39, 1, '2014-07-13 07:30:49', '2014-07-13 00:30:49'),
('1106110011', 'Dosen', 'rahmadi@gmail.com', '123123', '1106110099', 40, 1, '2014-09-04 13:24:41', '2014-07-13 00:30:49'),
('1106110012', 'Dosen Dosen', 'dosen@dosen.com', '1231232', '1106110012', 41, 1, '2014-07-13 00:36:44', '2014-07-13 00:36:44'),
('1106110013', 'dosenrmd', 'dosenrmd@gmail.com', '12312', '1106110013', 53, 1, '2014-09-04 06:34:19', '2014-09-04 06:34:19'),
('1106110041', 'Dosencobalagi', 'Dosencobalagi@gmail.com', '1231232', '1106110041', 54, 1, '2014-09-04 12:16:31', '2014-09-04 12:16:31'),
('1106110050', 'YRL', 'yrl@gmail.com', '123123', '1106110050', 43, 1, '2014-09-04 06:06:45', '2014-09-04 06:06:45'),
('123456789', 'dosennoeah', 'dosennoeah@gmail.com', '12312312', '123456789', 52, 1, '2014-09-04 06:32:16', '2014-09-04 06:32:16');

-- --------------------------------------------------------

--
-- Table structure for table `tb_item`
--

CREATE TABLE IF NOT EXISTS `tb_item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_nama` varchar(50) NOT NULL,
  `item_kode` varchar(50) NOT NULL,
  `item_status` int(1) NOT NULL DEFAULT '1',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`item_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tb_item`
--

INSERT INTO `tb_item` (`item_id`, `user_id`, `item_nama`, `item_kode`, `item_status`, `updated_at`, `created_at`) VALUES
(1, 12, '1148dc4839d73535e1f169251b5cf64f2', '148dc4839d73535e1f169251b5cf64f2', 1, '2014-09-07 04:55:29', '2014-09-07 04:55:29'),
(2, 12, '2522900d73e8d8a6b6e323beeb3ec08bc', '522900d73e8d8a6b6e323beeb3ec08bc', 1, '2014-09-07 14:12:54', '2014-09-07 14:12:54'),
(3, 12, '9e05ec36c0465a698053e2c90600f6d5', '9e05ec36c0465a698053e2c90600f6d5', 1, '2014-09-07 14:29:42', '2014-09-07 14:29:42'),
(4, 12, 'Yusril Maulidan Raji.zip', '8426da060fbee67ebc9c582bd0dbfef8.zip', 1, '2014-09-07 14:48:29', '2014-09-07 14:48:29'),
(5, 12, 'Yusril Maulidan Raji.zip', 'ee78de31179f7f7b21530639414c88f6.zip', 1, '2014-09-07 14:52:00', '2014-09-07 14:52:00'),
(6, 12, 'yo.zip', '8babf637a630f98c17f23b84d6056685.zip', 1, '2014-09-07 14:52:52', '2014-09-07 14:52:52'),
(7, 12, 'yo.zip', '4ff8ad88919889fcc217e816ca82735c.zip', 1, '2014-09-07 15:54:16', '2014-09-07 15:54:16'),
(8, 12, 'yo.zip', '54143ecf89463527d80cce42cf72cbe9.zip', 1, '2014-09-07 15:54:35', '2014-09-07 15:54:35'),
(9, 12, 'yo.zip', 'ef1de040982261a4c6988cda7c617756.zip', 1, '2014-09-07 18:13:48', '2014-09-07 18:13:48');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal`
--

CREATE TABLE IF NOT EXISTS `tb_jadwal` (
  `jadwal_id` int(11) NOT NULL AUTO_INCREMENT,
  `jadwal_nama` varchar(20) NOT NULL,
  `jadwal_shift` int(1) NOT NULL,
  `jadwal_jam_mulai` time NOT NULL,
  `jadwal_jam_selesai` time NOT NULL,
  `ruangan_id` int(11) NOT NULL,
  `jadwal_hari` int(1) NOT NULL,
  `jadwal_status` int(11) NOT NULL DEFAULT '1',
  `praktikum_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`jadwal_id`),
  KEY `ruangan_id` (`ruangan_id`),
  KEY `praktikum_id` (`praktikum_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tb_jadwal`
--

INSERT INTO `tb_jadwal` (`jadwal_id`, `jadwal_nama`, `jadwal_shift`, `jadwal_jam_mulai`, `jadwal_jam_selesai`, `ruangan_id`, `jadwal_hari`, `jadwal_status`, `praktikum_id`, `created_at`, `updated_at`) VALUES
(8, 'PRO-A-142-4', 4, '12:30:00', '14:10:00', 2, 4, 0, 6, '2014-09-03 15:01:49', '2014-09-03 08:01:49'),
(9, 'PRO-STR-142-1', 1, '06:30:00', '08:10:00', 2, 1, 0, 4, '2014-09-01 04:38:43', '2014-08-31 21:38:43'),
(10, 'SIS-ASD-143-8-2', 8, '20:30:00', '22:10:00', 3, 2, 1, 7, '2014-09-05 22:11:50', '2014-09-05 22:11:50'),
(11, 'PRO-ALP-144-3-1', 1, '06:30:00', '08:10:00', 2, 2, 1, 3, '2014-09-07 06:36:56', '2014-09-06 23:36:56'),
(12, 'PRO-STR-144-7-1', 7, '18:30:00', '20:10:00', 4, 1, 0, 4, '2014-09-07 06:36:20', '2014-09-06 23:36:20'),
(13, 'PRO-A-144-4-4', 4, '12:30:00', '14:10:00', 4, 4, 1, 6, '2014-09-07 04:43:19', '2014-09-07 04:43:19');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jawaban`
--

CREATE TABLE IF NOT EXISTS `tb_jawaban` (
  `jawaban_id` int(11) NOT NULL AUTO_INCREMENT,
  `jawaban_text` text,
  `jawaban_benar` varchar(255) DEFAULT NULL,
  `soal_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`jawaban_id`),
  KEY `soal_id` (`soal_id`),
  KEY `jawaban_id` (`jawaban_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_jawaban_user`
--

CREATE TABLE IF NOT EXISTS `tb_jawaban_user` (
  `jawaban_user_id` int(11) NOT NULL,
  `jawaban_user_text` text,
  `praktikan_nim` varchar(10) DEFAULT NULL,
  `jadwal_id` int(11) DEFAULT NULL,
  `jawaban_user_point` int(11) DEFAULT NULL,
  `soal_id` int(11) NOT NULL,
  `jawaban_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`jawaban_user_id`),
  KEY `jadwal_id` (`jadwal_id`),
  KEY `soal_id` (`soal_id`),
  KEY `jawaban_id` (`jawaban_id`),
  KEY `praktikan_nim` (`praktikan_nim`),
  KEY `praktikan_nim_2` (`praktikan_nim`),
  KEY `praktikan_nim_3` (`praktikan_nim`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE IF NOT EXISTS `tb_kelas` (
  `kelas_id` int(11) NOT NULL AUTO_INCREMENT,
  `kelas_nama` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`kelas_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`kelas_id`, `kelas_nama`, `created_at`, `updated_at`) VALUES
(1, 'SI-36-01', '2014-07-04 03:22:46', '0000-00-00 00:00:00'),
(2, 'SI-36-02', '2014-07-04 03:22:46', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_lab`
--

CREATE TABLE IF NOT EXISTS `tb_lab` (
  `lab_id` int(11) NOT NULL AUTO_INCREMENT,
  `lab_nama` varchar(50) NOT NULL,
  `lab_keterangan` text NOT NULL,
  `lab_ruang` varchar(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lab_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`lab_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tb_lab`
--

INSERT INTO `tb_lab` (`lab_id`, `lab_nama`, `lab_keterangan`, `lab_ruang`, `created_at`, `updated_at`, `lab_status`) VALUES
(1, 'Proadse', 'programming', 'C200', '2014-07-08 15:14:55', '2014-07-08 08:14:55', 1),
(2, 'Sisjar', 'sistem operasi', 'C204', '2014-07-08 15:14:15', '2014-07-08 08:14:15', 1),
(3, 'BPAD', 'bisnis proses', 'C220', '2014-07-08 21:34:28', '2014-07-08 14:34:28', 1),
(4, 'asdasd', 'asdasda', '2asda', '2014-07-08 23:18:10', '2014-07-08 16:18:10', 0),
(5, 'asdasd', 'asdasgghjkj', '09876', '2014-07-08 23:18:34', '2014-07-08 16:18:34', 0),
(6, 'a', 'a', 'a', '2014-07-08 23:19:33', '2014-07-08 16:19:33', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_modul`
--

CREATE TABLE IF NOT EXISTS `tb_modul` (
  `modul_id` int(11) NOT NULL AUTO_INCREMENT,
  `modul_nama` varchar(255) NOT NULL,
  `praktikum_id` int(11) NOT NULL,
  `modul_date` date NOT NULL,
  `modul_timestart` time NOT NULL,
  `modul_timeend` time NOT NULL,
  `modul_file` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`modul_id`),
  KEY `praktikum_id` (`praktikum_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_praktikan`
--

CREATE TABLE IF NOT EXISTS `tb_praktikan` (
  `praktikan_nim` varchar(10) NOT NULL,
  `praktikan_nama` varchar(50) NOT NULL,
  `praktikan_email` varchar(50) NOT NULL,
  `praktikan_telp` varchar(15) NOT NULL,
  `praktikan_foto` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `praktikan_status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`praktikan_nim`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_praktikan`
--

INSERT INTO `tb_praktikan` (`praktikan_nim`, `praktikan_nama`, `praktikan_email`, `praktikan_telp`, `praktikan_foto`, `user_id`, `praktikan_status`, `created_at`, `updated_at`) VALUES
('1106110000', 'Praktikan', 'praktikan@email.com', '123456789', '1106110000', 42, 1, '2014-07-13 21:27:35', '2014-07-13 21:27:35'),
('1106110009', 'YUSUF RAHMADI', 'yusufrahmadi.id@gmail.com', '085224622336', '1106110009', 23, 1, '2014-07-04 01:00:53', '2014-07-04 01:00:53'),
('1106110010', 'YUSUF RAHMADI', 'yusufrahmadi.id@gmail.com', '085224622336', '1106110010', 25, 1, '2014-07-04 01:12:08', '2014-07-04 01:12:08'),
('1106110042', 'praktikancoba', 'praktikancoba@gmail.com', '085224622336', '1106110042', 55, 1, '2014-09-04 19:16:16', '2014-09-04 19:16:16');

-- --------------------------------------------------------

--
-- Table structure for table `tb_praktikum`
--

CREATE TABLE IF NOT EXISTS `tb_praktikum` (
  `praktikum_id` int(11) NOT NULL AUTO_INCREMENT,
  `praktikum_nama` varchar(50) NOT NULL,
  `praktikum_keterangan` text NOT NULL,
  `lab_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`praktikum_id`),
  KEY `lab_id` (`lab_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tb_praktikum`
--

INSERT INTO `tb_praktikum` (`praktikum_id`, `praktikum_nama`, `praktikum_keterangan`, `lab_id`, `created_at`, `updated_at`) VALUES
(2, 'EAI', 'Enterprise Arsitekstur 2', 3, '2014-07-24 13:26:29', '2014-07-24 06:26:29'),
(3, 'Alpro', 'algoritma dasar', 1, '2014-07-08 14:35:20', '2014-07-08 14:35:20'),
(4, 'Strukdat', 'Struktur Data ', 1, '2014-07-08 21:35:37', '2014-07-08 14:35:37'),
(6, 'a', 'a', 6, '2014-07-08 16:19:12', '2014-07-08 16:19:12'),
(7, 'asd', 'asdad', 3, '2014-07-24 06:26:39', '2014-07-24 06:26:39');

-- --------------------------------------------------------

--
-- Table structure for table `tb_quiz`
--

CREATE TABLE IF NOT EXISTS `tb_quiz` (
  `quiz_id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_nama` text,
  `quiz_keterangan` text,
  `quiz_intro` text,
  `modul_id` int(11) DEFAULT NULL,
  `quiz_durasi` int(11) NOT NULL,
  `quiz_urutan` int(11) NOT NULL,
  `quiz_status` int(11) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`quiz_id`),
  KEY `modul_id` (`modul_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tb_quiz`
--

INSERT INTO `tb_quiz` (`quiz_id`, `quiz_nama`, `quiz_keterangan`, `quiz_intro`, `modul_id`, `quiz_durasi`, `quiz_urutan`, `quiz_status`, `created_at`, `updated_at`) VALUES
(1, 'Tes Awal', 'Ini tes awal', 'Kerjain bro', 2, 10, 0, 1, '2014-09-03 06:13:04', '2014-09-03 06:13:04');

-- --------------------------------------------------------

--
-- Table structure for table `tb_role`
--

CREATE TABLE IF NOT EXISTS `tb_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) NOT NULL,
  `role_status` int(11) NOT NULL DEFAULT '1',
  `role_keterangan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tb_role`
--

INSERT INTO `tb_role` (`role_id`, `role_name`, `role_status`, `role_keterangan`, `created_at`, `updated_at`) VALUES
(0, 'admin', 1, '', '2014-07-08 22:39:54', '0000-00-00 00:00:00'),
(1, 'kordas', 1, '', '2014-07-08 22:39:56', '0000-00-00 00:00:00'),
(2, 'korprak', 1, '', '2014-07-08 22:39:59', '0000-00-00 00:00:00'),
(3, 'asisten', 1, '', '2014-07-08 22:40:03', '0000-00-00 00:00:00'),
(4, 'praktikan', 1, '', '2014-07-08 22:40:11', '0000-00-00 00:00:00'),
(5, 'dosen', 1, '', '2014-07-08 22:40:15', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ruang`
--

CREATE TABLE IF NOT EXISTS `tb_ruang` (
  `ruang_id` int(11) NOT NULL AUTO_INCREMENT,
  `ruang_nama` varchar(255) NOT NULL,
  `ruang_quota` int(11) NOT NULL,
  `ruang_keterangan` text NOT NULL,
  `ruang_status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ruang_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tb_ruang`
--

INSERT INTO `tb_ruang` (`ruang_id`, `ruang_nama`, `ruang_quota`, `ruang_keterangan`, `ruang_status`, `created_at`, `updated_at`) VALUES
(1, 'C200', 200, 'Banyak', 0, '2014-08-03 08:13:49', '2014-08-03 01:13:49'),
(2, 'Ruang Lab 1', 1, 'Sebelah Ruang SI INT test11', 1, '2014-09-07 11:42:53', '2014-09-07 04:42:53'),
(3, 'C222', 300, 'Qouta 30 C222', 0, '2014-09-06 05:12:15', '2014-09-05 22:12:15'),
(4, 'Comlab 1', 30, 'Praktikum Centra Lab SI', 1, '2014-09-05 22:13:34', '2014-09-05 22:13:34'),
(5, 'Kamar YRL', 70, 'JOS', 0, '2014-09-07 06:37:52', '2014-09-06 23:37:52');

-- --------------------------------------------------------

--
-- Table structure for table `tb_running`
--

CREATE TABLE IF NOT EXISTS `tb_running` (
  `running_id` int(11) NOT NULL AUTO_INCREMENT,
  `running_start` datetime NOT NULL,
  `running_end` datetime NOT NULL,
  `running_duration` int(11) NOT NULL,
  `jadwal_id` int(11) NOT NULL,
  `modul_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`running_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_soal`
--

CREATE TABLE IF NOT EXISTS `tb_soal` (
  `soal_id` int(11) NOT NULL AUTO_INCREMENT,
  `soal_text` text,
  `soal_point` int(11) DEFAULT NULL,
  `soal_type` varchar(255) DEFAULT NULL,
  `soal_parent` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`soal_id`),
  KEY `quiz_id` (`quiz_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `user_status` int(11) NOT NULL DEFAULT '1',
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `user_name`, `password`, `user_status`, `role_id`, `created_at`, `updated_at`) VALUES
(12, 'rahmadimaru_admin', '$2y$10$Rh7RlMBH9dLopSyHo0SFcOLTGjRAU7GfsCIe1ehv.JxEPXs1bGHLO', 1, 0, '2014-08-24 08:02:56', '2014-07-02 23:12:05'),
(23, 'rahmadimaru', '$2y$10$Rh7RlMBH9dLopSyHo0SFcOLTGjRAU7GfsCIe1ehv.JxEPXs1bGHLO', 1, 2, '2014-09-06 02:50:48', '2014-07-04 01:00:53'),
(24, 'a', '$2y$10$ihHdtamGOxMxDmcA3mPGFeyVX1hUc7eVGrkmb35XmJg/1B/qLw.vm', 1, 4, '2014-07-05 05:15:19', '2014-07-04 01:04:28'),
(25, 'asd', '$2y$10$hdCHx4qw7O9Vz7dsej860efT5Y8AudixGj7OKlyixm9c8rqtZ5oN2', 1, 4, '2014-07-05 05:15:19', '2014-07-04 01:12:08'),
(26, 'admin1', '$2y$10$nOp57Yd0QGBHhQGw90GiseVOvJU23d8hVxF1RkcsefF.W6OtQ8qEu', 1, 0, '2014-07-05 22:37:07', '2014-07-05 22:37:07'),
(27, '18236', '$2y$10$..p9HLgqPeYXJUcEZTAaMuSkJzdn5hf3rEWUNSkCF8oH6b0NFkI6O', 1, 3, '2014-07-08 15:38:35', '2014-07-08 15:38:35'),
(28, '123123', '$2y$10$Toptj8znj1JUs3.B2JTfUec9BuOiDpHqydvLGqUDK8uM.EbTP/vCK', 1, 3, '2014-07-08 15:40:30', '2014-07-08 15:40:30'),
(29, '123', '$2y$10$YUUN6VEF2/eQCV9IYqGhzeQTchKQdqCG24XpPt/we243hy/s.7el2', 1, 3, '2014-07-08 15:41:37', '2014-07-08 15:41:37'),
(30, '97', '$2y$10$moArBeVI9z4xhW8JzgwdieggT2JcKQQqi6z.1Ley5gLQhzTCo05G6', 1, 3, '2014-07-08 15:42:21', '2014-07-08 15:42:21'),
(31, '232234', '$2y$10$IDjmhj7uiPJ58Lt5O2FHku7Va3fVNhrOd3pQmPpHC7NA30qGU290O', 1, 3, '2014-07-08 16:14:46', '2014-07-08 16:14:46'),
(32, '1', '$2y$10$gd9DFeMiquu/K02QbbnaP.EhrGYFg11IWINMimycFU89W1rvkoNQO', 1, 3, '2014-07-08 16:19:28', '2014-07-08 16:19:28'),
(33, 'aku', '', 1, 2, '2014-07-08 23:53:18', '0000-00-00 00:00:00'),
(34, '87', '$2y$10$YRrRpN6btzreL9/7x3b/sO0QXrA0p4gFAc3d4zRiAUZ16w9PJQU2C', 1, 3, '2014-07-10 02:12:34', '2014-07-10 02:12:34'),
(38, 'D0senBaru', '$2y$10$HsmBjvGpEB6gA9LKoevTVeiWr9DochTXhyXsD8qDzNGctRAAVa036', 1, 5, '2014-07-13 14:52:37', '2014-07-13 07:52:37'),
(39, 'D0senBaru2', '$2y$10$no8vC6.Zq0fKBGiLJRLY3ea23O9nPT61by2CicPqQBiFRuxfSd5cO', 1, 5, '2014-07-13 07:30:49', '2014-07-13 00:30:49'),
(40, 'd0senbaru3', '$2y$10$oF7EnhaMIKrio03fYzxbZ.6sROipV.O0TxOki9.eG0pgJ9SisGLIq', 1, 5, '2014-07-13 07:30:49', '2014-07-13 00:30:49'),
(41, 'dosenohdosen', '$2y$10$Ec9musnkQLZvGIZF6opapOoRtVmJUwQ0VjV7UdkHpUqoH7GSZagWu', 1, 5, '2014-07-13 00:36:44', '2014-07-13 00:36:44'),
(42, 'praktikan', '$2y$10$iBAKvLJDZi3OYMOKlwMs1OJ7mM07I8/ZaRSeC5Xf2cecesLZF/yVu', 1, 4, '2014-07-13 21:27:35', '2014-07-13 21:27:35'),
(43, 'dosenyrl', '$2y$10$RjcjwrZZmAij0tFLHB79eOOxEpnVJGkQj.trUiOmzdNGHRsB/gRi.', 1, 5, '2014-09-04 06:06:45', '2014-09-04 06:06:45'),
(52, 'dosennoeah', '$2y$10$U4p9lT/GeYwr/WsAOPYBh.K8REbVwm2Ju3wLfD4COOG0L6IKB0Ce.', 1, 5, '2014-09-04 06:32:16', '2014-09-04 06:32:16'),
(53, 'dosenrmd', '$2y$10$LMhM7TiTt3DSeUTEfsh6New0LfhOVFWOT4Re4Pblfpkz01qFK.14G', 1, 5, '2014-09-04 06:34:19', '2014-09-04 06:34:19'),
(54, 'Dosencobalagi', '$2y$10$g1W6wcQzX4S0LRLw/pz2Je/xxLmpqAPdKfiBF4f.m6fNoqeshfbBG', 1, 5, '2014-09-04 12:16:30', '2014-09-04 12:16:30'),
(55, 'praktikancoba', '$2y$10$f9h1mar1f9Z80YFAQQTuv.kdcekHZjypMxcyWGMc9ifIQfQGmFGbW', 1, 4, '2014-09-04 19:16:16', '2014-09-04 19:16:16'),
(58, 'praktikancoba1', '$2y$10$Eufkupp4n/jaB4r0lcPLQ.hbfoonUqqqKwYQY8M0HbShPGMVvu8wy', 1, 4, '2014-09-04 19:19:33', '2014-09-04 19:19:33');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_datajadwal`
--
CREATE TABLE IF NOT EXISTS `view_datajadwal` (
`praktikum_nama` varchar(50)
,`running_start` datetime
,`running_end` datetime
,`running_id` int(11)
,`running_duration` int(11)
,`user_id` int(11)
,`praktikan_nim` varchar(10)
,`jadwal_hari` int(1)
,`jadwal_jam_mulai` time
,`jadwal_jam_selesai` time
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `view_datasoal`
--
CREATE TABLE IF NOT EXISTS `view_datasoal` (
`running_id` int(11)
,`quiz_id` int(11)
,`quiz_durasi` int(11)
,`soal_id` int(11)
,`soal_text` text
,`soal_type` varchar(255)
,`soal_point` int(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `view_register_praktikum`
--
CREATE TABLE IF NOT EXISTS `view_register_praktikum` (
`lab_nama` varchar(50)
,`praktikum_nama` varchar(50)
,`jadwal_hari` int(1)
,`jadwal_shift` int(1)
,`jadwal_jam_mulai` time
,`jadwal_jam_selesai` time
,`praktikan_nim` varchar(10)
,`praktikum_id` int(11)
,`jadwal_id` int(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `view_user_praktikan`
--
CREATE TABLE IF NOT EXISTS `view_user_praktikan` (
`user_id` int(11)
,`user_name` varchar(50)
,`user_status` int(11)
,`role_id` int(11)
,`praktikan_nim` varchar(10)
,`praktikan_nama` varchar(50)
,`praktikan_email` varchar(50)
,`praktikan_telp` varchar(15)
,`praktikan_foto` text
);
-- --------------------------------------------------------

--
-- Structure for view `view_datajadwal`
--
DROP TABLE IF EXISTS `view_datajadwal`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_datajadwal` AS select `tb_praktikum`.`praktikum_nama` AS `praktikum_nama`,`tb_running`.`running_start` AS `running_start`,`tb_running`.`running_end` AS `running_end`,`tb_running`.`running_id` AS `running_id`,`tb_running`.`running_duration` AS `running_duration`,`tb_user`.`user_id` AS `user_id`,`tb_praktikan`.`praktikan_nim` AS `praktikan_nim`,`tb_jadwal`.`jadwal_hari` AS `jadwal_hari`,`tb_jadwal`.`jadwal_jam_mulai` AS `jadwal_jam_mulai`,`tb_jadwal`.`jadwal_jam_selesai` AS `jadwal_jam_selesai` from (((((`tb_user` join `tb_praktikan` on((`tb_user`.`user_id` = `tb_praktikan`.`user_id`))) join `tb_detail_jadwal_praktikan` on((`tb_praktikan`.`praktikan_nim` = `tb_detail_jadwal_praktikan`.`praktikan_nim`))) join `tb_jadwal` on((`tb_detail_jadwal_praktikan`.`jadwal_id` = `tb_jadwal`.`jadwal_id`))) join `tb_praktikum` on((`tb_jadwal`.`praktikum_id` = `tb_praktikum`.`praktikum_id`))) join `tb_running` on((`tb_detail_jadwal_praktikan`.`jadwal_id` = `tb_running`.`jadwal_id`))) where ((now() > `tb_running`.`running_start`) and (now() < `tb_running`.`running_end`));

-- --------------------------------------------------------

--
-- Structure for view `view_datasoal`
--
DROP TABLE IF EXISTS `view_datasoal`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_datasoal` AS select `tb_running`.`running_id` AS `running_id`,`tb_quiz`.`quiz_id` AS `quiz_id`,`tb_quiz`.`quiz_durasi` AS `quiz_durasi`,`tb_soal`.`soal_id` AS `soal_id`,`tb_soal`.`soal_text` AS `soal_text`,`tb_soal`.`soal_type` AS `soal_type`,`tb_soal`.`soal_point` AS `soal_point` from (((`tb_running` join `tb_modul` on((`tb_running`.`modul_id` = `tb_modul`.`modul_id`))) join `tb_quiz` on((`tb_running`.`modul_id` = `tb_quiz`.`modul_id`))) join `tb_soal` on((`tb_quiz`.`quiz_id` = `tb_soal`.`quiz_id`)));

-- --------------------------------------------------------

--
-- Structure for view `view_register_praktikum`
--
DROP TABLE IF EXISTS `view_register_praktikum`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_register_praktikum` AS select `tb_lab`.`lab_nama` AS `lab_nama`,`tb_praktikum`.`praktikum_nama` AS `praktikum_nama`,`tb_jadwal`.`jadwal_hari` AS `jadwal_hari`,`tb_jadwal`.`jadwal_shift` AS `jadwal_shift`,`tb_jadwal`.`jadwal_jam_mulai` AS `jadwal_jam_mulai`,`tb_jadwal`.`jadwal_jam_selesai` AS `jadwal_jam_selesai`,`tb_detail_jadwal_praktikan`.`praktikan_nim` AS `praktikan_nim`,`tb_praktikum`.`praktikum_id` AS `praktikum_id`,`tb_jadwal`.`jadwal_id` AS `jadwal_id` from (((`tb_lab` join `tb_praktikum` on((`tb_lab`.`lab_id` = `tb_praktikum`.`lab_id`))) join `tb_jadwal` on((`tb_praktikum`.`praktikum_id` = `tb_jadwal`.`praktikum_id`))) join `tb_detail_jadwal_praktikan` on((`tb_jadwal`.`jadwal_id` = `tb_detail_jadwal_praktikan`.`jadwal_id`)));

-- --------------------------------------------------------

--
-- Structure for view `view_user_praktikan`
--
DROP TABLE IF EXISTS `view_user_praktikan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_user_praktikan` AS select `tb_user`.`user_id` AS `user_id`,`tb_user`.`user_name` AS `user_name`,`tb_user`.`user_status` AS `user_status`,`tb_user`.`role_id` AS `role_id`,`tb_praktikan`.`praktikan_nim` AS `praktikan_nim`,`tb_praktikan`.`praktikan_nama` AS `praktikan_nama`,`tb_praktikan`.`praktikan_email` AS `praktikan_email`,`tb_praktikan`.`praktikan_telp` AS `praktikan_telp`,`tb_praktikan`.`praktikan_foto` AS `praktikan_foto` from (`tb_user` join `tb_praktikan` on((`tb_user`.`user_id` = `tb_praktikan`.`user_id`)));

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD CONSTRAINT `tb_absensi_ibfk_1` FOREIGN KEY (`praktikan_nim`) REFERENCES `tb_praktikan` (`praktikan_nim`),
  ADD CONSTRAINT `tb_absensi_ibfk_2` FOREIGN KEY (`modul_id`) REFERENCES `tb_modul` (`modul_id`);

--
-- Constraints for table `tb_absen_asisten`
--
ALTER TABLE `tb_absen_asisten`
  ADD CONSTRAINT `tb_absen_asisten_ibfk_1` FOREIGN KEY (`asisten_nim`) REFERENCES `tb_asisten` (`asisten_nim`);

--
-- Constraints for table `tb_asisten`
--
ALTER TABLE `tb_asisten`
  ADD CONSTRAINT `tb_asisten_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `tb_role` (`role_id`),
  ADD CONSTRAINT `tb_asisten_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`user_id`),
  ADD CONSTRAINT `tb_asisten_ibfk_3` FOREIGN KEY (`lab_id`) REFERENCES `tb_lab` (`lab_id`);

--
-- Constraints for table `tb_detail_jadwal_praktikan`
--
ALTER TABLE `tb_detail_jadwal_praktikan`
  ADD CONSTRAINT `tb_detail_jadwal_praktikan_ibfk_2` FOREIGN KEY (`praktikan_nim`) REFERENCES `tb_praktikan` (`praktikan_nim`),
  ADD CONSTRAINT `tb_detail_jadwal_praktikan_ibfk_3` FOREIGN KEY (`jadwal_id`) REFERENCES `tb_jadwal` (`jadwal_id`);

--
-- Constraints for table `tb_detail_praktikan_kelas`
--
ALTER TABLE `tb_detail_praktikan_kelas`
  ADD CONSTRAINT `tb_detail_praktikan_kelas_ibfk_1` FOREIGN KEY (`praktikan_nim`) REFERENCES `tb_praktikan` (`praktikan_nim`),
  ADD CONSTRAINT `tb_detail_praktikan_kelas_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `tb_kelas` (`kelas_id`);

--
-- Constraints for table `tb_detail_praktikum_asisten`
--
ALTER TABLE `tb_detail_praktikum_asisten`
  ADD CONSTRAINT `tb_detail_praktikum_asisten_ibfk_1` FOREIGN KEY (`asisten_nim`) REFERENCES `tb_asisten` (`asisten_nim`),
  ADD CONSTRAINT `tb_detail_praktikum_asisten_ibfk_2` FOREIGN KEY (`praktikum_id`) REFERENCES `tb_praktikum` (`praktikum_id`);

--
-- Constraints for table `tb_detail_praktikum_praktikan`
--
ALTER TABLE `tb_detail_praktikum_praktikan`
  ADD CONSTRAINT `tb_detail_praktikum_praktikan_ibfk_1` FOREIGN KEY (`praktikan_nim`) REFERENCES `tb_praktikan` (`praktikan_nim`),
  ADD CONSTRAINT `tb_detail_praktikum_praktikan_ibfk_2` FOREIGN KEY (`praktikum_id`) REFERENCES `tb_praktikum` (`praktikum_id`);

--
-- Constraints for table `tb_dosen`
--
ALTER TABLE `tb_dosen`
  ADD CONSTRAINT `tb_dosen_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`user_id`);

--
-- Constraints for table `tb_item`
--
ALTER TABLE `tb_item`
  ADD CONSTRAINT `tb_item_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`user_id`);

--
-- Constraints for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD CONSTRAINT `tb_jadwal_ibfk_1` FOREIGN KEY (`ruangan_id`) REFERENCES `tb_ruang` (`ruang_id`),
  ADD CONSTRAINT `tb_jadwal_ibfk_2` FOREIGN KEY (`praktikum_id`) REFERENCES `tb_praktikum` (`praktikum_id`);

--
-- Constraints for table `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  ADD CONSTRAINT `tb_jawaban_ibfk_1` FOREIGN KEY (`soal_id`) REFERENCES `tb_soal` (`soal_id`);

--
-- Constraints for table `tb_jawaban_user`
--
ALTER TABLE `tb_jawaban_user`
  ADD CONSTRAINT `tb_jawaban_user_ibfk_1` FOREIGN KEY (`soal_id`) REFERENCES `tb_soal` (`soal_id`),
  ADD CONSTRAINT `tb_jawaban_user_ibfk_2` FOREIGN KEY (`jadwal_id`) REFERENCES `tb_jawaban` (`jawaban_id`),
  ADD CONSTRAINT `tb_jawaban_user_ibfk_3` FOREIGN KEY (`praktikan_nim`) REFERENCES `tb_praktikan` (`praktikan_nim`);

--
-- Constraints for table `tb_modul`
--
ALTER TABLE `tb_modul`
  ADD CONSTRAINT `tb_modul_ibfk_1` FOREIGN KEY (`praktikum_id`) REFERENCES `tb_praktikum` (`praktikum_id`),
  ADD CONSTRAINT `tb_modul_ibfk_3` FOREIGN KEY (`modul_id`) REFERENCES `tb_quiz` (`modul_id`);

--
-- Constraints for table `tb_praktikan`
--
ALTER TABLE `tb_praktikan`
  ADD CONSTRAINT `tb_praktikan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`user_id`);

--
-- Constraints for table `tb_praktikum`
--
ALTER TABLE `tb_praktikum`
  ADD CONSTRAINT `tb_praktikum_ibfk_1` FOREIGN KEY (`lab_id`) REFERENCES `tb_lab` (`lab_id`);

--
-- Constraints for table `tb_soal`
--
ALTER TABLE `tb_soal`
  ADD CONSTRAINT `tb_soal_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `tb_quiz` (`quiz_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
