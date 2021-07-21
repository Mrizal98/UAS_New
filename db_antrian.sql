-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2021 at 07:14 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_antrian`
--

-- --------------------------------------------------------

--
-- Table structure for table `antrian`
--

CREATE TABLE `antrian` (
  `id` int(11) UNSIGNED NOT NULL,
  `tanggal` datetime NOT NULL,
  `no_antrian` varchar(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `waktu_panggil` timestamp NOT NULL DEFAULT current_timestamp(),
  `waktu_selesai` timestamp NOT NULL DEFAULT current_timestamp(),
  `pelayanan_id` int(11) NOT NULL,
  `loket_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `antrian`
--

INSERT INTO `antrian` (`id`, `tanggal`, `no_antrian`, `status`, `waktu_panggil`, `waktu_selesai`, `pelayanan_id`, `loket_id`) VALUES
(116, '2021-07-21 12:01:00', 'B7', 'dilayani', '2021-07-20 17:01:50', '2021-07-21 05:01:01', 2, 3),
(117, '2021-07-21 12:01:04', 'A10', 'selesai', '2021-07-20 17:01:19', '2021-07-20 17:01:46', 1, 3),
(118, '2021-07-21 12:01:08', 'D2', 'dilayani', '2021-07-20 17:02:34', '2021-07-20 17:02:25', 4, 4);

-- --------------------------------------------------------

--
-- Stand-in structure for view `dashboard`
-- (See below for the actual view)
--
CREATE TABLE `dashboard` (
`id` int(11) unsigned
,`no_antrian` varchar(11)
,`waktu_panggil` timestamp
,`status` varchar(50)
,`nama` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `detail_loket`
-- (See below for the actual view)
--
CREATE TABLE `detail_loket` (
`id` int(11) unsigned
,`nama` varchar(100)
,`nama_layanan` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `loket`
--

CREATE TABLE `loket` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `pelayanan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loket`
--

INSERT INTO `loket` (`id`, `nama`, `keterangan`, `pelayanan_id`) VALUES
(3, 'loket1', NULL, 2),
(4, 'loket2', NULL, 4),
(7, 'loket3', NULL, 0),
(8, 'loket4', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2021-07-17-152626', 'App\\Database\\Migrations\\Pelayanan', 'default', 'App', 1626547451, 1),
(2, '2021-07-17-152641', 'App\\Database\\Migrations\\Antrian', 'default', 'App', 1626547593, 2),
(3, '2021-07-17-152647', 'App\\Database\\Migrations\\Loket', 'default', 'App', 1626547593, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pelayanan`
--

CREATE TABLE `pelayanan` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `kode` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pelayanan`
--

INSERT INTO `pelayanan` (`id`, `nama`, `keterangan`, `kode`) VALUES
(1, 'Customer Sevice', NULL, 'A'),
(2, 'Perpanjangan', NULL, 'B'),
(3, 'Pengaduan', NULL, 'C'),
(4, 'Permohonan Baru', NULL, 'D');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_all`
-- (See below for the actual view)
--
CREATE TABLE `view_all` (
`id_antrian` int(11) unsigned
,`no_antrian` varchar(11)
,`tanggal` datetime
,`waktu_panggil` timestamp
,`waktu_selesai` timestamp
,`id_loket` int(11) unsigned
,`nama_loket` varchar(100)
,`id_pelayanan` int(11) unsigned
,`nama_layanan` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_detail`
-- (See below for the actual view)
--
CREATE TABLE `view_detail` (
`id_antrian` int(11) unsigned
,`no_antrian` varchar(11)
,`tanggal` datetime
,`id_loket` int(11) unsigned
,`nama_loket` varchar(100)
,`id_pelayanan` int(11) unsigned
,`nama_layanan` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_user`
-- (See below for the actual view)
--
CREATE TABLE `view_user` (
`no_antrian` varchar(11)
,`nama` varchar(100)
,`nama_pelayanan` varchar(100)
);

-- --------------------------------------------------------

--
-- Structure for view `dashboard`
--
DROP TABLE IF EXISTS `dashboard`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dashboard`  AS SELECT `antrian`.`id` AS `id`, `antrian`.`no_antrian` AS `no_antrian`, `antrian`.`waktu_panggil` AS `waktu_panggil`, `antrian`.`status` AS `status`, `loket`.`nama` AS `nama` FROM (`antrian` join `loket` on(`antrian`.`loket_id` = `loket`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `detail_loket`
--
DROP TABLE IF EXISTS `detail_loket`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detail_loket`  AS SELECT `loket`.`id` AS `id`, `loket`.`nama` AS `nama`, `pelayanan`.`nama` AS `nama_layanan` FROM (`loket` join `pelayanan` on(`loket`.`pelayanan_id` = `pelayanan`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_all`
--
DROP TABLE IF EXISTS `view_all`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_all`  AS SELECT `antrian`.`id` AS `id_antrian`, `antrian`.`no_antrian` AS `no_antrian`, `antrian`.`tanggal` AS `tanggal`, `antrian`.`waktu_panggil` AS `waktu_panggil`, `antrian`.`waktu_selesai` AS `waktu_selesai`, `loket`.`id` AS `id_loket`, `loket`.`nama` AS `nama_loket`, `pelayanan`.`id` AS `id_pelayanan`, `pelayanan`.`nama` AS `nama_layanan` FROM ((`antrian` join `loket` on(`antrian`.`loket_id` = `loket`.`id`)) join `pelayanan` on(`antrian`.`pelayanan_id` = `pelayanan`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_detail`
--
DROP TABLE IF EXISTS `view_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_detail`  AS SELECT `antrian`.`id` AS `id_antrian`, `antrian`.`no_antrian` AS `no_antrian`, `antrian`.`tanggal` AS `tanggal`, `loket`.`id` AS `id_loket`, `loket`.`nama` AS `nama_loket`, `pelayanan`.`id` AS `id_pelayanan`, `pelayanan`.`nama` AS `nama_layanan` FROM ((`antrian` join `loket` on(`antrian`.`loket_id` = `loket`.`id`)) join `pelayanan` on(`antrian`.`pelayanan_id` = `pelayanan`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_user`
--
DROP TABLE IF EXISTS `view_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_user`  AS SELECT `antrian`.`no_antrian` AS `no_antrian`, `loket`.`nama` AS `nama`, `pelayanan`.`nama` AS `nama_pelayanan` FROM ((`antrian` join `loket` on(`antrian`.`loket_id` = `loket`.`id`)) join `pelayanan` on(`antrian`.`pelayanan_id` = `pelayanan`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loket`
--
ALTER TABLE `loket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelayanan`
--
ALTER TABLE `pelayanan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `loket`
--
ALTER TABLE `loket`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelayanan`
--
ALTER TABLE `pelayanan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
