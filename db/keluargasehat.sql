-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2021 at 03:49 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `keluargasehat`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota_keluarga`
--

CREATE TABLE `anggota_keluarga` (
  `nik` varchar(16) NOT NULL,
  `nkk` varchar(16) NOT NULL,
  `nama` varchar(54) NOT NULL,
  `tanggal_lahir` varchar(10) NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `hubungan_keluarga` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota_keluarga`
--

INSERT INTO `anggota_keluarga` (`nik`, `nkk`, `nama`, `tanggal_lahir`, `jenis_kelamin`, `hubungan_keluarga`) VALUES
('3210030103540001', '3210030102341119', 'OHING', '1954-03-01', '1', '1'),
('3210030211070021', '3210031019281102', 'ALDIANSYAH HANPI', '2007-11-02', '1', '3'),
('3210030505770021', '3210032705120003', 'MAMAN NURYAMAN', '1977-05-05', '1', '1'),
('3210030804670000', '3210030607030001', 'YAYA SUGIANA', '1967-08-01', '1', '1'),
('3210031003570001', '3210036019282001', 'OJO', '1957-03-10', '1', '1'),
('3210031012650041', '3210031019281102', 'ATENG', '1965-12-10', '1', '1'),
('3210031012700001', '3210030607090021', 'HASANUDIN', '1970-10-12', '1', '1'),
('3210031109050001', '3210030607090021', 'MUHAMMAD PADLI NURDING', '2005-11-08', '1', '3'),
('3210031805030001', '3210031019281102', 'MOH SOPI ABDUL MUIS', '2003-05-18', '1', '3'),
('3210032102930041', '3210036019282001', 'BENI RAHMAN', '1993-02-21', '1', '3'),
('3210032408140001', '3210040509930021', 'DESTA ALGIFARI', '2014-08-24', '1', '3'),
('3210032703130003', '3210032705120003', 'MUHAMAD ARSAD NURYAMAN', '2013-03-27', '1', '3'),
('3210032906020001', '3210032705120003', 'ENJANG NURHIDAYAT', '2002-06-29', '1', '3'),
('3210033009920001', '3210033001120003', 'DENI UMARDANI', '1992-12-30', '1', '1'),
('3210034107460042', '3210031019281102', 'PERSIH', '1946-07-01', '2', '6'),
('3210034312970041', '3210030102341119', 'RIFAMELIA', '1997-12-03', '2', '3'),
('3210034512700041', '3210030102341119', 'EMEH', '1970-12-05', '2', '2'),
('3210034610760000', '3210030607030001', 'YENI SETIANINGSIH', '1976-10-06', '2', '2'),
('3210035012790001', '3210032705120003', 'CICIH', '1979-12-10', '2', '2'),
('3210035102990001', '3210030607090021', 'VINA PERMATA HASANAH', '1999-02-11', '2', '3'),
('3210035103950081', '3210040509930021', 'DESI AMALIAH', '1995-03-11', '2', '2'),
('3210035110780001', '3210030607090021', 'NUNUNG NURJANAH', '1987-10-11', '2', '2'),
('3210035607750021', '3210031019281102', 'EUIS KARWATI', '1975-07-16', '2', '2'),
('3210036106010000', '3210030607030001', 'IIS SITI HODIJAH', '2001-06-21', '2', '3'),
('3210036111660001', '3210036019282001', 'IYAH', '1966-11-21', '2', '2'),
('3210036811940001', '3210033001120003', 'ATIN ROSMIATI', '1994-11-28', '2', '2'),
('3210040509930021', '3210040509930021', 'MUHAMAD RIZAL', '1993-09-05', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `defuzzyfikasi`
--

CREATE TABLE `defuzzyfikasi` (
  `id_defuzzyfikasi` int(11) NOT NULL,
  `id_pendataan` int(11) NOT NULL,
  `luas` double NOT NULL,
  `momen` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `defuzzyfikasi`
--

INSERT INTO `defuzzyfikasi` (`id_defuzzyfikasi`, `id_pendataan`, `luas`, `momen`) VALUES
(1, 1, 16.65, 224.01),
(2, 1, 2.22, 91.2),
(3, 2, 20, 1533.33),
(4, 2, 10, 950),
(5, 7, 5, 233.33),
(6, 7, 5, 266.67),
(7, 8, 16.65, 224.01),
(8, 8, 2.22, 91.2),
(9, 9, 5, 233.33),
(10, 9, 5, 266.67);

-- --------------------------------------------------------

--
-- Table structure for table `fuzzyfikasi`
--

CREATE TABLE `fuzzyfikasi` (
  `id_fuzzyfikasi` int(11) NOT NULL,
  `id_pendataan` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fuzzyfikasi`
--

INSERT INTO `fuzzyfikasi` (`id_fuzzyfikasi`, `id_pendataan`, `id_kriteria`, `id_kategori`, `nilai`) VALUES
(1, 1, 2, 7, 0.333),
(2, 1, 2, 8, 0),
(3, 1, 2, 9, 0),
(4, 1, 1, 1, 0),
(5, 1, 1, 5, 0),
(6, 1, 1, 6, 1),
(7, 2, 2, 7, 0),
(8, 2, 2, 8, 0),
(9, 2, 2, 9, 1),
(10, 2, 1, 1, 0),
(11, 2, 1, 5, 0),
(12, 2, 1, 6, 1),
(13, 7, 2, 7, 0),
(14, 7, 2, 8, 1),
(15, 7, 2, 9, 0),
(16, 7, 1, 1, 0),
(17, 7, 1, 5, 0),
(18, 7, 1, 6, 1),
(19, 8, 2, 7, 0.333),
(20, 8, 2, 8, 0),
(21, 8, 2, 9, 0),
(22, 8, 1, 1, 0),
(23, 8, 1, 5, 0),
(24, 8, 1, 6, 1),
(25, 9, 2, 7, 0),
(26, 9, 2, 8, 1),
(27, 9, 2, 9, 0),
(28, 9, 1, 1, 0),
(29, 9, 1, 5, 0),
(30, 9, 1, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_pendataan` int(11) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `id_pendataan`, `nilai`) VALUES
(1, 1, 16.7),
(2, 2, 82.78),
(3, 7, 50),
(4, 8, 16.7),
(5, 9, 50);

-- --------------------------------------------------------

--
-- Table structure for table `hasil_indikator`
--

CREATE TABLE `hasil_indikator` (
  `id_hasil_indikator` int(11) NOT NULL,
  `id_pendataan` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `id_indikator` varchar(8) NOT NULL,
  `jawaban` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasil_indikator`
--

INSERT INTO `hasil_indikator` (`id_hasil_indikator`, `id_pendataan`, `nik`, `id_indikator`, `jawaban`) VALUES
(1, 1, '3210030804670000', '1', 'N'),
(2, 1, '3210030804670000', '2', 'N'),
(3, 1, '3210030804670000', '3', 'N'),
(4, 1, '3210030804670000', '4', 'N'),
(5, 1, '3210030804670000', '5', 'N'),
(6, 1, '3210030804670000', '6', 'N'),
(7, 1, '3210030804670000', '7', 'T'),
(8, 1, '3210030804670000', '8', 'N'),
(9, 1, '3210030804670000', '9', 'T'),
(10, 1, '3210030804670000', '10', 'T'),
(11, 1, '3210030804670000', '11', 'Y'),
(12, 1, '3210030804670000', '12', 'Y'),
(13, 1, '3210034610760000', '1', 'N'),
(14, 1, '3210034610760000', '2', 'N'),
(15, 1, '3210034610760000', '3', 'N'),
(16, 1, '3210034610760000', '4', 'N'),
(17, 1, '3210034610760000', '5', 'N'),
(18, 1, '3210034610760000', '6', 'N'),
(19, 1, '3210034610760000', '7', 'T'),
(20, 1, '3210034610760000', '8', 'N'),
(21, 1, '3210034610760000', '9', 'Y'),
(22, 1, '3210034610760000', '10', 'T'),
(23, 1, '3210034610760000', '11', 'Y'),
(24, 1, '3210034610760000', '12', 'Y'),
(25, 1, '3210036106010000', '1', 'N'),
(26, 1, '3210036106010000', '2', 'N'),
(27, 1, '3210036106010000', '3', 'N'),
(28, 1, '3210036106010000', '4', 'N'),
(29, 1, '3210036106010000', '5', 'N'),
(30, 1, '3210036106010000', '6', 'N'),
(31, 1, '3210036106010000', '7', 'N'),
(32, 1, '3210036106010000', '8', 'N'),
(33, 1, '3210036106010000', '9', 'Y'),
(34, 1, '3210036106010000', '10', 'T'),
(35, 1, '3210036106010000', '11', 'Y'),
(36, 1, '3210036106010000', '12', 'Y'),
(37, 2, '3210031012700001', '1', 'N'),
(38, 2, '3210031012700001', '2', 'N'),
(39, 2, '3210031012700001', '3', 'N'),
(40, 2, '3210031012700001', '4', 'N'),
(41, 2, '3210031012700001', '5', 'N'),
(42, 2, '3210031012700001', '6', 'N'),
(43, 2, '3210031012700001', '7', 'N'),
(44, 2, '3210031012700001', '8', 'N'),
(45, 2, '3210031012700001', '9', 'Y'),
(46, 2, '3210031012700001', '10', 'Y'),
(47, 2, '3210031012700001', '11', 'Y'),
(48, 2, '3210031012700001', '12', 'Y'),
(49, 2, '3210031109050001', '1', 'N'),
(50, 2, '3210031109050001', '2', 'N'),
(51, 2, '3210031109050001', '3', 'N'),
(52, 2, '3210031109050001', '4', 'N'),
(53, 2, '3210031109050001', '5', 'N'),
(54, 2, '3210031109050001', '6', 'N'),
(55, 2, '3210031109050001', '7', 'N'),
(56, 2, '3210031109050001', '8', 'N'),
(57, 2, '3210031109050001', '9', 'Y'),
(58, 2, '3210031109050001', '10', 'Y'),
(59, 2, '3210031109050001', '11', 'Y'),
(60, 2, '3210031109050001', '12', 'Y'),
(61, 2, '3210035102990001', '1', 'N'),
(62, 2, '3210035102990001', '2', 'N'),
(63, 2, '3210035102990001', '3', 'N'),
(64, 2, '3210035102990001', '4', 'N'),
(65, 2, '3210035102990001', '5', 'N'),
(66, 2, '3210035102990001', '6', 'N'),
(67, 2, '3210035102990001', '7', 'N'),
(68, 2, '3210035102990001', '8', 'N'),
(69, 2, '3210035102990001', '9', 'Y'),
(70, 2, '3210035102990001', '10', 'Y'),
(71, 2, '3210035102990001', '11', 'Y'),
(72, 2, '3210035102990001', '12', 'Y'),
(73, 2, '3210035110780001', '1', 'N'),
(74, 2, '3210035110780001', '2', 'N'),
(75, 2, '3210035110780001', '3', 'N'),
(76, 2, '3210035110780001', '4', 'N'),
(77, 2, '3210035110780001', '5', 'N'),
(78, 2, '3210035110780001', '6', 'N'),
(79, 2, '3210035110780001', '7', 'N'),
(80, 2, '3210035110780001', '8', 'N'),
(81, 2, '3210035110780001', '9', 'Y'),
(82, 2, '3210035110780001', '10', 'Y'),
(83, 2, '3210035110780001', '11', 'Y'),
(84, 2, '3210035110780001', '12', 'Y'),
(169, 5, '3210031003570001', '1', 'N'),
(170, 5, '3210031003570001', '2', 'N'),
(171, 5, '3210031003570001', '3', 'N'),
(172, 5, '3210031003570001', '4', 'N'),
(173, 5, '3210031003570001', '5', 'N'),
(174, 5, '3210031003570001', '6', 'N'),
(175, 5, '3210031003570001', '7', 'N'),
(176, 5, '3210031003570001', '8', 'N'),
(177, 5, '3210031003570001', '9', 'Y'),
(178, 5, '3210031003570001', '10', 'Y'),
(179, 5, '3210031003570001', '11', 'Y'),
(180, 5, '3210031003570001', '12', 'Y'),
(181, 5, '3210032102930041', '1', 'N'),
(182, 5, '3210032102930041', '2', 'N'),
(183, 5, '3210032102930041', '3', 'N'),
(184, 5, '3210032102930041', '4', 'N'),
(185, 5, '3210032102930041', '5', 'N'),
(186, 5, '3210032102930041', '6', 'N'),
(187, 5, '3210032102930041', '7', 'N'),
(188, 5, '3210032102930041', '8', 'N'),
(189, 5, '3210032102930041', '9', 'Y'),
(190, 5, '3210032102930041', '10', 'Y'),
(191, 5, '3210032102930041', '11', 'Y'),
(192, 5, '3210032102930041', '12', 'Y'),
(193, 5, '3210036111660001', '1', 'N'),
(194, 5, '3210036111660001', '2', 'N'),
(195, 5, '3210036111660001', '3', 'N'),
(196, 5, '3210036111660001', '4', 'N'),
(197, 5, '3210036111660001', '5', 'N'),
(198, 5, '3210036111660001', '6', 'N'),
(199, 5, '3210036111660001', '7', 'N'),
(200, 5, '3210036111660001', '8', 'N'),
(201, 5, '3210036111660001', '9', 'Y'),
(202, 5, '3210036111660001', '10', 'Y'),
(203, 5, '3210036111660001', '11', 'Y'),
(204, 5, '3210036111660001', '12', 'Y'),
(205, 7, '3210030103540001', '1', 'N'),
(206, 7, '3210030103540001', '2', 'N'),
(207, 7, '3210030103540001', '3', 'N'),
(208, 7, '3210030103540001', '4', 'N'),
(209, 7, '3210030103540001', '5', 'N'),
(210, 7, '3210030103540001', '6', 'T'),
(211, 7, '3210030103540001', '7', 'N'),
(212, 7, '3210030103540001', '8', 'N'),
(213, 7, '3210030103540001', '9', 'T'),
(214, 7, '3210030103540001', '10', 'T'),
(215, 7, '3210030103540001', '11', 'Y'),
(216, 7, '3210030103540001', '12', 'Y'),
(217, 7, '3210034512700041', '1', 'N'),
(218, 7, '3210034512700041', '2', 'N'),
(219, 7, '3210034512700041', '3', 'N'),
(220, 7, '3210034512700041', '4', 'N'),
(221, 7, '3210034512700041', '5', 'N'),
(222, 7, '3210034512700041', '6', 'N'),
(223, 7, '3210034512700041', '7', 'N'),
(224, 7, '3210034512700041', '8', 'N'),
(225, 7, '3210034512700041', '9', 'Y'),
(226, 7, '3210034512700041', '10', 'T'),
(227, 7, '3210034512700041', '11', 'Y'),
(228, 7, '3210034512700041', '12', 'Y'),
(229, 7, '3210034312970041', '1', 'N'),
(230, 7, '3210034312970041', '2', 'N'),
(231, 7, '3210034312970041', '3', 'N'),
(232, 7, '3210034312970041', '4', 'N'),
(233, 7, '3210034312970041', '5', 'N'),
(234, 7, '3210034312970041', '6', 'N'),
(235, 7, '3210034312970041', '7', 'N'),
(236, 7, '3210034312970041', '8', 'N'),
(237, 7, '3210034312970041', '9', 'T'),
(238, 7, '3210034312970041', '10', 'T'),
(239, 7, '3210034312970041', '11', 'Y'),
(240, 7, '3210034312970041', '12', 'Y'),
(241, 8, '3210031012650041', '1', 'N'),
(242, 8, '3210031012650041', '2', 'N'),
(243, 8, '3210031012650041', '3', 'N'),
(244, 8, '3210031012650041', '4', 'N'),
(245, 8, '3210031012650041', '5', 'N'),
(246, 8, '3210031012650041', '6', 'N'),
(247, 8, '3210031012650041', '7', 'T'),
(248, 8, '3210031012650041', '8', 'N'),
(249, 8, '3210031012650041', '9', 'T'),
(250, 8, '3210031012650041', '10', 'T'),
(251, 8, '3210031012650041', '11', 'Y'),
(252, 8, '3210031012650041', '12', 'Y'),
(253, 8, '3210035607750021', '1', 'N'),
(254, 8, '3210035607750021', '2', 'N'),
(255, 8, '3210035607750021', '3', 'N'),
(256, 8, '3210035607750021', '4', 'N'),
(257, 8, '3210035607750021', '5', 'N'),
(258, 8, '3210035607750021', '6', 'N'),
(259, 8, '3210035607750021', '7', 'Y'),
(260, 8, '3210035607750021', '8', 'N'),
(261, 8, '3210035607750021', '9', 'Y'),
(262, 8, '3210035607750021', '10', 'T'),
(263, 8, '3210035607750021', '11', 'Y'),
(264, 8, '3210035607750021', '12', 'Y'),
(265, 8, '3210030211070021', '1', 'N'),
(266, 8, '3210030211070021', '2', 'N'),
(267, 8, '3210030211070021', '3', 'N'),
(268, 8, '3210030211070021', '4', 'N'),
(269, 8, '3210030211070021', '5', 'N'),
(270, 8, '3210030211070021', '6', 'N'),
(271, 8, '3210030211070021', '7', 'N'),
(272, 8, '3210030211070021', '8', 'N'),
(273, 8, '3210030211070021', '9', 'Y'),
(274, 8, '3210030211070021', '10', 'T'),
(275, 8, '3210030211070021', '11', 'Y'),
(276, 8, '3210030211070021', '12', 'Y'),
(277, 8, '3210031805030001', '1', 'N'),
(278, 8, '3210031805030001', '2', 'N'),
(279, 8, '3210031805030001', '3', 'N'),
(280, 8, '3210031805030001', '4', 'N'),
(281, 8, '3210031805030001', '5', 'N'),
(282, 8, '3210031805030001', '6', 'N'),
(283, 8, '3210031805030001', '7', 'N'),
(284, 8, '3210031805030001', '8', 'N'),
(285, 8, '3210031805030001', '9', 'Y'),
(286, 8, '3210031805030001', '10', 'T'),
(287, 8, '3210031805030001', '11', 'Y'),
(288, 8, '3210031805030001', '12', 'Y'),
(289, 8, '3210034107460042', '1', 'N'),
(290, 8, '3210034107460042', '2', 'N'),
(291, 8, '3210034107460042', '3', 'N'),
(292, 8, '3210034107460042', '4', 'N'),
(293, 8, '3210034107460042', '5', 'N'),
(294, 8, '3210034107460042', '6', 'T'),
(295, 8, '3210034107460042', '7', 'N'),
(296, 8, '3210034107460042', '8', 'N'),
(297, 8, '3210034107460042', '9', 'Y'),
(298, 8, '3210034107460042', '10', 'T'),
(299, 8, '3210034107460042', '11', 'Y'),
(300, 8, '3210034107460042', '12', 'Y'),
(301, 9, '3210033009920001', '1', 'N'),
(302, 9, '3210033009920001', '2', 'N'),
(303, 9, '3210033009920001', '3', 'N'),
(304, 9, '3210033009920001', '4', 'N'),
(305, 9, '3210033009920001', '5', 'N'),
(306, 9, '3210033009920001', '6', 'N'),
(307, 9, '3210033009920001', '7', 'N'),
(308, 9, '3210033009920001', '8', 'N'),
(309, 9, '3210033009920001', '9', 'T'),
(310, 9, '3210033009920001', '10', 'T'),
(311, 9, '3210033009920001', '11', 'Y'),
(312, 9, '3210033009920001', '12', 'Y'),
(313, 9, '3210036811940001', '1', 'N'),
(314, 9, '3210036811940001', '2', 'N'),
(315, 9, '3210036811940001', '3', 'N'),
(316, 9, '3210036811940001', '4', 'N'),
(317, 9, '3210036811940001', '5', 'N'),
(318, 9, '3210036811940001', '6', 'N'),
(319, 9, '3210036811940001', '7', 'N'),
(320, 9, '3210036811940001', '8', 'N'),
(321, 9, '3210036811940001', '9', 'Y'),
(322, 9, '3210036811940001', '10', 'Y'),
(323, 9, '3210036811940001', '11', 'Y'),
(324, 9, '3210036811940001', '12', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `implikasi`
--

CREATE TABLE `implikasi` (
  `id_implikasi` int(11) NOT NULL,
  `id_pendataan` int(11) NOT NULL,
  `nilai_implikasi` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `implikasi`
--

INSERT INTO `implikasi` (`id_implikasi`, `id_pendataan`, `nilai_implikasi`) VALUES
(1, 1, 0),
(2, 1, 0),
(3, 1, 0),
(4, 1, 0),
(5, 1, 0),
(6, 1, 0),
(7, 1, 0.333),
(8, 1, 0),
(9, 1, 0),
(10, 2, 0),
(11, 2, 0),
(12, 2, 0),
(13, 2, 0),
(14, 2, 0),
(15, 2, 0),
(16, 2, 0),
(17, 2, 0),
(18, 2, 1),
(19, 7, 0),
(20, 7, 0),
(21, 7, 0),
(22, 7, 0),
(23, 7, 0),
(24, 7, 0),
(25, 7, 0),
(26, 7, 1),
(27, 7, 0),
(28, 8, 0),
(29, 8, 0),
(30, 8, 0),
(31, 8, 0),
(32, 8, 0),
(33, 8, 0),
(34, 8, 0.333),
(35, 8, 0),
(36, 8, 0),
(37, 9, 0),
(38, 9, 0),
(39, 9, 0),
(40, 9, 0),
(41, 9, 0),
(42, 9, 0),
(43, 9, 0),
(44, 9, 1),
(45, 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `indikator`
--

CREATE TABLE `indikator` (
  `id_indikator` int(8) NOT NULL,
  `indikator` text NOT NULL,
  `jenis_indikator` int(1) NOT NULL,
  `id_kriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `indikator`
--

INSERT INTO `indikator` (`id_indikator`, `indikator`, `jenis_indikator`, `id_kriteria`) VALUES
(1, 'Ibu melakukan persalinan di fasilitas kesehatan ', 4, 1),
(2, 'Bayi mendapat imunisasi dasar lengkap', 6, 1),
(3, 'Bayi mendapat air susu ibu (ASI) eksklusif', 6, 1),
(4, 'Balita mendapatkan pemantauan pertumbuhan', 6, 1),
(5, 'Penderita tuberkulosis paru mendapatkan pengobatan sesuai standard', 1, 1),
(6, 'Penderita hipertensi melakukan pengobatan secara teratur', 1, 1),
(7, 'Keluarga mengikuti program Keluarga Berencana (KB)', 2, 2),
(8, 'Penderita gangguan jiwa mendapatkan pengobatan dan tidak ditelantarkan', 1, 2),
(9, 'Anggota keluarga tidak ada yang merokok', 1, 2),
(10, 'Keluarga sudah menjadi anggota Jaminan Kesehatan Nasional (JKN)', 1, 2),
(11, 'Keluarga mempunyai akses sarana air bersih', 1, 2),
(12, 'Keluarga mempunyai akses atau menggunakan jamban sehat', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nama_kategori` varchar(128) NOT NULL,
  `left_side` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `right_side` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `id_kriteria`, `nama_kategori`, `left_side`, `mid`, `right_side`, `type`) VALUES
(1, 1, 'Tidak sehat', 0, 10, 40, 1),
(5, 1, 'Pra-sehat', 30, 40, 50, 2),
(6, 1, 'Sehat', 40, 50, 60, 3),
(7, 2, 'Tidak Baik', 0, 10, 40, 1),
(8, 2, 'Cukup Baik', 30, 40, 50, 2),
(9, 2, 'Baik', 40, 50, 60, 3),
(10, 3, 'Tidak Sehat', 0, 10, 50, 1),
(11, 3, 'Pra-sehat', 40, 50, 60, 2),
(12, 3, 'Sehat', 50, 90, 100, 3);

-- --------------------------------------------------------

--
-- Table structure for table `keluarga`
--

CREATE TABLE `keluarga` (
  `nkk` varchar(16) NOT NULL,
  `kepala_keluarga` varchar(64) NOT NULL,
  `jumlah_art` int(11) NOT NULL,
  `kelurahan` varchar(32) NOT NULL,
  `rt` varchar(3) NOT NULL,
  `rw` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keluarga`
--

INSERT INTO `keluarga` (`nkk`, `kepala_keluarga`, `jumlah_art`, `kelurahan`, `rt`, `rw`) VALUES
('3210030102341119', 'OHING', 3, 'Sindang', '002', '001'),
('3210030607030001', 'YAYAN SUGIANA', 3, 'Sindang', '001', '002'),
('3210030607090021', 'HASANUDIN', 4, 'Sindang', '001', '002'),
('3210031019281102', 'ATENG', 5, 'Sindang', '001', '006'),
('3210033001120003', 'DENI UMAR DANI', 2, 'Sindang', '002', '001'),
('3210040509930021', 'MUHAMMAD RIZAL', 3, 'Sindang', '007', '002');

-- --------------------------------------------------------

--
-- Table structure for table `kelurahan`
--

CREATE TABLE `kelurahan` (
  `id_kel` char(10) NOT NULL,
  `nama` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelurahan`
--

INSERT INTO `kelurahan` (`id_kel`, `nama`) VALUES
('3210032001', 'Sukasari'),
('3210032002', 'Cisoka'),
('3210032003', 'Sindangpanji'),
('3210032004', 'Cikijing'),
('3210032005', 'Sindang'),
('3210032006', 'Banjaransari'),
('3210032007', 'Kasturi'),
('3210032008', 'Cidulang'),
('3210032009', 'Jagasari'),
('3210032010', 'Bagjasari'),
('3210032011', 'Sunalari'),
('3210032012', 'Cipulus'),
('3210032013', 'Kancana'),
('3210032014', 'Sukamukti'),
('3210032015', 'Cilancang');

-- --------------------------------------------------------

--
-- Table structure for table `komposisi_aturan`
--

CREATE TABLE `komposisi_aturan` (
  `id_komposisi` int(11) NOT NULL,
  `id_pendataan` int(11) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komposisi_aturan`
--

INSERT INTO `komposisi_aturan` (`id_komposisi`, `id_pendataan`, `nilai`) VALUES
(1, 1, 36.68),
(2, 1, 50),
(3, 2, 50),
(4, 2, 90),
(5, 7, 40),
(6, 7, 50),
(7, 7, 60),
(8, 8, 36.68),
(9, 8, 50),
(10, 9, 40),
(11, 9, 50),
(12, 9, 60);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `keterangan` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama`, `keterangan`) VALUES
(1, 'Kesehatan Anggota Keluarga', 'input'),
(2, 'Prilaku Hidup Sehat', 'input'),
(3, 'status kesehatan', 'output');

-- --------------------------------------------------------

--
-- Table structure for table `pendataan`
--

CREATE TABLE `pendataan` (
  `id_pendataan` int(11) NOT NULL,
  `nkk` varchar(16) NOT NULL,
  `tgl_pendataan` varchar(10) NOT NULL,
  `tahun_aktif` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status_pendataan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pendataan`
--

INSERT INTO `pendataan` (`id_pendataan`, `nkk`, `tgl_pendataan`, `tahun_aktif`, `id_user`, `status_pendataan`) VALUES
(1, '3210030607030001', '2020-08-30', 2020, 12, 1),
(2, '3210030607090021', '2020-08-10', 2020, 12, 1),
(5, '3210036019282001', '2020-08-12', 2020, 12, 1),
(6, '3210040509930021', '2020-08-18', 2020, 12, 0),
(7, '3210030102341119', '2020-02-10', 2020, 12, 1),
(8, '3210031019281102', '2020-04-14', 2020, 12, 1),
(9, '3210033001120003', '2020-05-11', 2020, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tahun_aktif`
--

CREATE TABLE `tahun_aktif` (
  `tahun_aktif` varchar(32) NOT NULL,
  `tanggal_pembukaan` varchar(32) NOT NULL,
  `tanggal_penutupan` varchar(32) NOT NULL,
  `status_aktif` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tahun_aktif`
--

INSERT INTO `tahun_aktif` (`tahun_aktif`, `tanggal_pembukaan`, `tanggal_penutupan`, `status_aktif`) VALUES
('2018', '2018-01-01', '2018-12-31', 0),
('2019', '2019-01-01', '2019-12-31', 0),
('2020', '2020-10-25', '2020-12-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `name` varchar(64) NOT NULL,
  `level` int(1) NOT NULL,
  `active` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `level`, `active`, `created_at`, `updated_at`) VALUES
(1, 'admin@admin.com', '$2y$10$YW2iZQZS280cm9Fq0/GYxuxte7ylK4D4I0SgpOHPqJ7TmcdXIkmPK', 'Nuranggi Hermawan', 1, 1, '2020-08-30 06:26:55', '2020-11-01 22:04:47'),
(11, 'sahdibeni@gmail.com', '$2y$10$bMJ1Duw1v22efvkyWL5p6exotBn8TNy7Nd/yFTI9kPxQ55hMn3BbC', 'Sahdi Beni', 2, 1, '2020-10-03 21:26:39', '2020-10-03 21:26:39'),
(12, 'nurmilah@gmail.com', '$2y$10$7WlcRcJBoZmadhZ8d9.MjOkXrdso/HElua9GetDHXigNDYaMyBkLi', 'NURMILAH, A.Md.Keb.', 3, 1, '2020-10-03 21:27:58', '2020-10-03 21:27:58'),
(13, 'adeelsa@gmail.com', '$2y$10$2UX10/Sef/w18mfyT1/PTOjPosCG.qLs/kRzZp5dQmmwaKs33jvCa', 'ADE ELSA NURUL SIFA, A.Md.Keb.', 3, 1, '2020-10-03 21:29:02', '2020-10-03 21:29:02'),
(14, 'dewirahmayati@gmail.com', '$2y$10$6zyPGuE9.eHxFL5jRQsEhu6rX1n2gnM4iFKTQyrOauMbzqnh/IgZe', 'DEWI RAHMAYATI, A.Md.Keb', 3, 1, '2020-10-03 21:29:59', '2020-10-03 21:29:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota_keluarga`
--
ALTER TABLE `anggota_keluarga`
  ADD PRIMARY KEY (`nik`),
  ADD KEY `nkk` (`nkk`);

--
-- Indexes for table `defuzzyfikasi`
--
ALTER TABLE `defuzzyfikasi`
  ADD PRIMARY KEY (`id_defuzzyfikasi`),
  ADD KEY `id_pendataan` (`id_pendataan`);

--
-- Indexes for table `fuzzyfikasi`
--
ALTER TABLE `fuzzyfikasi`
  ADD PRIMARY KEY (`id_fuzzyfikasi`),
  ADD KEY `id_pendataan` (`id_pendataan`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_pendataan` (`id_pendataan`);

--
-- Indexes for table `hasil_indikator`
--
ALTER TABLE `hasil_indikator`
  ADD PRIMARY KEY (`id_hasil_indikator`),
  ADD KEY `id_kuesioner` (`id_indikator`),
  ADD KEY `nik` (`nik`),
  ADD KEY `id_pendataan` (`id_pendataan`);

--
-- Indexes for table `implikasi`
--
ALTER TABLE `implikasi`
  ADD PRIMARY KEY (`id_implikasi`),
  ADD KEY `id_pendataan` (`id_pendataan`);

--
-- Indexes for table `indikator`
--
ALTER TABLE `indikator`
  ADD PRIMARY KEY (`id_indikator`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `keluarga`
--
ALTER TABLE `keluarga`
  ADD PRIMARY KEY (`nkk`);

--
-- Indexes for table `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD PRIMARY KEY (`id_kel`);

--
-- Indexes for table `komposisi_aturan`
--
ALTER TABLE `komposisi_aturan`
  ADD PRIMARY KEY (`id_komposisi`),
  ADD KEY `id_implikasi` (`id_pendataan`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `pendataan`
--
ALTER TABLE `pendataan`
  ADD PRIMARY KEY (`id_pendataan`),
  ADD KEY `nkk` (`nkk`),
  ADD KEY `tahun_aktif` (`tahun_aktif`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tahun_aktif`
--
ALTER TABLE `tahun_aktif`
  ADD PRIMARY KEY (`tahun_aktif`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `defuzzyfikasi`
--
ALTER TABLE `defuzzyfikasi`
  MODIFY `id_defuzzyfikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `fuzzyfikasi`
--
ALTER TABLE `fuzzyfikasi`
  MODIFY `id_fuzzyfikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hasil_indikator`
--
ALTER TABLE `hasil_indikator`
  MODIFY `id_hasil_indikator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=325;

--
-- AUTO_INCREMENT for table `implikasi`
--
ALTER TABLE `implikasi`
  MODIFY `id_implikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `indikator`
--
ALTER TABLE `indikator`
  MODIFY `id_indikator` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `komposisi_aturan`
--
ALTER TABLE `komposisi_aturan`
  MODIFY `id_komposisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pendataan`
--
ALTER TABLE `pendataan`
  MODIFY `id_pendataan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
