-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2021 at 10:11 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ktravel_invoice`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(7) NOT NULL,
  `nip_customer` varchar(17) DEFAULT NULL,
  `ktp` varchar(30) DEFAULT NULL,
  `nama_customer` varchar(150) DEFAULT NULL,
  `is_anggota_kopkar` int(1) DEFAULT NULL COMMENT '(Apakah customer anggota Kopkar)\r\n0 : Tidak ; 1 : Ya',
  `divisi` char(8) DEFAULT NULL COMMENT 'source from : tabel_divisi',
  `jenis_kelamin` varchar(25) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `created_by` varchar(15) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `nip_customer`, `ktp`, `nama_customer`, `is_anggota_kopkar`, `divisi`, `jenis_kelamin`, `tgl_lahir`, `created_by`, `created_date`, `updated_date`, `updated_by`) VALUES
(6, '123', '3603122802950003', 'Dita', 0, '9', 'Perempuan', NULL, '0010013589', '2021-11-15 15:41:28', '2021-12-02 10:32:39', '0010013589'),
(7, 'T123', '23456765', 'Tia', 1, '5', 'Perempuan', NULL, '0010013589', '2021-11-15 15:42:04', NULL, NULL),
(8, 'NIP123', '1231298321', 'Makarena', 1, '9', 'Laki - laki', NULL, '0010013589', '2021-11-19 09:51:50', '2021-12-02 10:32:48', '0010013589');

-- --------------------------------------------------------

--
-- Table structure for table `cust_perusahaan`
--

CREATE TABLE `cust_perusahaan` (
  `cust_perusahaan_id` int(7) NOT NULL,
  `nm_cust_perusahaan` varchar(150) DEFAULT NULL,
  `alamat_perusahaan` varchar(220) DEFAULT NULL,
  `no_telepon` varchar(15) DEFAULT NULL,
  `created_by` varchar(15) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cust_perusahaan`
--

INSERT INTO `cust_perusahaan` (`cust_perusahaan_id`, `nm_cust_perusahaan`, `alamat_perusahaan`, `no_telepon`, `created_by`, `created_date`, `updated_date`, `updated_by`) VALUES
(3, 'PT Dainka', 'Tangerang', '02159300042', '0010013589', '2021-12-02 17:20:35', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `divisi_id` int(5) NOT NULL,
  `perusahaan_id` int(11) NOT NULL,
  `nama_divisi` varchar(150) DEFAULT NULL,
  `alamat_divisi` varchar(220) DEFAULT NULL,
  `nama_sekretaris` varchar(150) DEFAULT NULL,
  `nm_group_head` varchar(150) DEFAULT NULL,
  `no_telepon` varchar(15) DEFAULT NULL,
  `created_by` varchar(15) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL,
  `updated_by` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`divisi_id`, `perusahaan_id`, `nama_divisi`, `alamat_divisi`, `nama_sekretaris`, `nm_group_head`, `no_telepon`, `created_by`, `created_date`, `updated_date`, `updated_by`) VALUES
(5, 1, 'tim hore ', 'surabaya', 'aceng', 'baba', '02182298181032', '0010013589', '2021-11-15 07:47:37', '0000-00-00 00:00:00', ''),
(9, 3, 'GTS', 'Wisma Mandiri', 'Sarah', 'Yulia', '02159300042', '0010013589', '2021-12-01 16:26:52', '2021-12-18 12:32:39', '0010013589'),
(10, 1, 'Exercitationem unde ', 'Adipisicing saepe al', 'Sunt harum ex fugia', 'Et nesciunt quae am', '5', '0010013589', '2021-12-18 12:00:53', '2021-12-18 12:32:46', '0010013589');

-- --------------------------------------------------------

--
-- Table structure for table `history_foll_up`
--

CREATE TABLE `history_foll_up` (
  `history_id` int(7) NOT NULL,
  `tgl_foll_up` date DEFAULT NULL,
  `invoice_no` varchar(20) NOT NULL,
  `pic` varchar(150) DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `created_by` varchar(15) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(5) NOT NULL,
  `no_invoice` varchar(17) DEFAULT NULL,
  `tgl_invoice` datetime DEFAULT current_timestamp(),
  `divisi` int(7) DEFAULT NULL,
  `pic` int(7) DEFAULT NULL,
  `alamat_perusahaan` int(7) DEFAULT NULL,
  `alamat_divisi` int(7) DEFAULT NULL,
  `email_perusahaan` int(7) DEFAULT NULL,
  `nm_divisi` int(7) DEFAULT NULL,
  `nm_group_head` int(7) DEFAULT NULL,
  `nm_cust_perusahaan` int(7) DEFAULT NULL,
  `penanda_tangan` int(7) DEFAULT NULL,
  `email` int(7) DEFAULT NULL,
  `bank_cabang` int(7) DEFAULT NULL,
  `atas_nama` int(7) DEFAULT NULL,
  `keterangan` varchar(220) DEFAULT NULL,
  `status` int(1) DEFAULT NULL COMMENT '0 : Unprocess, 1 : Process, 2 : Paid, 3 : Overdue, 4 : Follow Up',
  `harga_jual` int(13) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `created_by` varchar(15) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `maskapai`
--

CREATE TABLE `maskapai` (
  `maskapai_id` int(8) NOT NULL,
  `akomodasi` varchar(44) DEFAULT NULL,
  `nama_maskapai` varchar(150) DEFAULT NULL,
  `alamat` varchar(220) DEFAULT NULL,
  `no_telepon` varchar(15) DEFAULT NULL,
  `created_by` varchar(15) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `maskapai`
--

INSERT INTO `maskapai` (`maskapai_id`, `akomodasi`, `nama_maskapai`, `alamat`, `no_telepon`, `created_by`, `created_date`, `updated_date`, `updated_by`) VALUES
(3, 'Kereta', 'Argo Sumber jaya', NULL, NULL, '0010013589', '2021-11-23 09:58:56', NULL, NULL),
(4, 'Pesawat', 'Lion Airx', NULL, NULL, '0010013589', '2021-11-23 09:59:18', '2021-11-23 11:09:25', '0010013589');

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `perusahaan_id` int(7) NOT NULL,
  `nm_perusahaan` varchar(150) DEFAULT NULL,
  `alamat_perusahaan` varchar(220) DEFAULT NULL,
  `no_telepon` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `bank_cabang` varchar(100) DEFAULT NULL,
  `no_rekening` varchar(18) DEFAULT NULL,
  `atas_nama` varchar(220) DEFAULT NULL,
  `penanda_tangan` varchar(220) DEFAULT NULL,
  `created_by` varchar(15) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`perusahaan_id`, `nm_perusahaan`, `alamat_perusahaan`, `no_telepon`, `email`, `bank_cabang`, `no_rekening`, `atas_nama`, `penanda_tangan`, `created_by`, `created_date`, `updated_date`, `updated_by`) VALUES
(1, 'PT. Koperasi Karyawan Bank Syariah Mandiri', 'Lt. 7, Wisma Antara, Jalan Medan Merdeka Selatan No.17, Gambir, RT.11/RW.2, Gambir, Kecamatan Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10110', '(021) 34830313', 'bsdm.info@gmail.com', 'Mandiri Syariah Jakartax', '001100000000', 'Mr X', 'Bapak xs', '0010013589', '2021-11-24 16:19:24', '2021-12-01 16:13:38', '0010013589'),
(3, 'PT x', 'Tangerang', '02159300042', 'ucupajaoke@gmail.com', 'BRI', '00001', 'Bapa X', 'Mr X', '0010013589', '2021-12-01 16:14:45', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pic`
--

CREATE TABLE `pic` (
  `pic_id` int(5) NOT NULL,
  `nip_pic` varchar(17) DEFAULT NULL,
  `customer` int(7) DEFAULT NULL COMMENT 'source from : tabel_customer	',
  `perusahaan` int(7) DEFAULT NULL COMMENT 'source from : tabel_customer_perusahaan	',
  `divisi` int(7) DEFAULT NULL,
  `pic` varchar(150) DEFAULT NULL,
  `status` int(1) NOT NULL COMMENT '0 : inactive ; 1 : active',
  `no_hp` varchar(15) DEFAULT NULL,
  `created_by` varchar(15) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pic`
--

INSERT INTO `pic` (`pic_id`, `nip_pic`, `customer`, `perusahaan`, `divisi`, `pic`, `status`, `no_hp`, `created_by`, `created_date`, `updated_date`, `updated_by`) VALUES
(5, '09877x', 6, NULL, 5, 'kakanda', 1, '089679860115', '0010013589', '2021-11-16 15:53:02', '2021-11-19 09:56:22', '0010013589'),
(8, 'DD123x', NULL, NULL, 5, 'Siapa aku', 1, '082298181032', '0010013589', '2021-11-18 16:55:04', '2021-12-22 02:22:00', '0010013589'),
(9, 'PP123', 7, NULL, 5, 'Parigi', 1, '0822981832', '0010013589', '2021-11-19 09:52:25', '2021-11-19 09:56:11', '0010013589');

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `route_id` int(5) NOT NULL,
  `kd_route` varchar(12) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `created_by` varchar(15) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL,
  `updated_by` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`route_id`, `kd_route`, `keterangan`, `created_by`, `created_date`, `updated_date`, `updated_by`) VALUES
(2, 'JKT001', 'Route Jakarta -  Surabaya', '0010013589', '2021-12-03 14:58:07', '2021-12-06 09:26:04', '0010013589'),
(4, 'Nostrum quo ', 'Rerum ducimus eaque', '0010013589', '2021-12-16 09:51:28', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `tiket_id` int(5) NOT NULL,
  `tgl_berangkat` date DEFAULT NULL,
  `tgl_issued` date DEFAULT NULL,
  `pic_tiket` varchar(150) DEFAULT NULL,
  `divisi` int(7) DEFAULT NULL,
  `akomodasi` int(7) DEFAULT NULL,
  `maskapai` int(7) DEFAULT NULL,
  `hotel` varchar(150) DEFAULT NULL,
  `alamat_hotel` varchar(220) DEFAULT NULL,
  `route` int(7) DEFAULT NULL,
  `vendor` int(7) DEFAULT NULL,
  `hpp` int(11) DEFAULT NULL,
  `service_fee` int(11) DEFAULT NULL,
  `biaya_lain` int(11) DEFAULT NULL,
  `harga_jual` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `created_by` varchar(15) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tiket`
--

INSERT INTO `tiket` (`tiket_id`, `tgl_berangkat`, `tgl_issued`, `pic_tiket`, `divisi`, `akomodasi`, `maskapai`, `hotel`, `alamat_hotel`, `route`, `vendor`, `hpp`, `service_fee`, `biaya_lain`, `harga_jual`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, '2021-12-08', '2021-12-08', 'aa111', 5, 1, 3, 'aaaa', 'aaaa', 2, 4, 1111, 1111, 11111, 11111, '2021-12-18 09:56:58', '1', '2021-12-18 03:34:36', '1'),
(2, '2021-11-01', '2021-11-30', 'bbbb', 9, 2, 4, 'bbb222', 'bbbb2222', 4, 5, 222, 222, 222, 222, '2021-12-18 09:56:58', '1', '2021-12-18 03:34:36', '1'),
(3, '2021-12-10', '2021-12-06', 'sadasd', 5, 5, 3, 'sdfsdf', 'sdfsdf', 4, 6, 1222, 1222, 3333, 3223, '2021-12-22 01:19:22', '1', '2021-12-21 19:18:15', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(5) NOT NULL,
  `nasabah_id` varchar(15) NOT NULL COMMENT 'Lemparan data dari api Login',
  `level` varchar(100) DEFAULT NULL COMMENT 'admin / user',
  `status` int(1) DEFAULT NULL COMMENT '0 : inactive, 1 : active',
  `created_date` datetime DEFAULT current_timestamp(),
  `created_by` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `nasabah_id`, `level`, `status`, `created_date`, `created_by`, `updated_date`, `updated_by`, `last_login`) VALUES
(1, '0010008881', 'admin', 1, '2021-11-22 12:08:35', NULL, NULL, NULL, NULL),
(10, '0010008881', 'admin', 1, '2021-11-22 12:08:35', NULL, NULL, NULL, NULL),
(11, '0010010336', 'admin', 1, '2021-11-22 12:08:35', NULL, NULL, NULL, NULL),
(12, '0010013270', 'admin', 1, '2021-11-22 12:08:35', NULL, NULL, NULL, NULL),
(13, '0010013589', 'admin', 1, '2021-11-22 12:08:35', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` int(7) NOT NULL,
  `nm_vendor` varchar(150) DEFAULT NULL,
  `alamat_vendor` varchar(220) DEFAULT NULL,
  `no_telepon` int(15) DEFAULT NULL,
  `mark_up` float DEFAULT NULL,
  `pic` varchar(150) DEFAULT NULL,
  `created_by` varchar(15) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL,
  `updated_by` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `nm_vendor`, `alamat_vendor`, `no_telepon`, `mark_up`, `pic`, `created_by`, `created_date`, `updated_date`, `updated_by`) VALUES
(4, 'Voltrasx', 'Jakarta', 2147483647, NULL, '9', '0010013589', '2021-12-01 16:12:24', '2021-12-01 16:12:32', '0010013589'),
(5, 'Royal', 'jakarta', 2147483647, NULL, 'Pak Dadang', '0010013589', '2021-12-01 17:16:57', '0000-00-00 00:00:00', NULL),
(6, 'xRoyalx', 'Surabaya', 2147483647, 0.1, '', '0010013589', '2021-12-10 11:27:14', '2021-12-10 11:35:01', '0010013589');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `cust_perusahaan`
--
ALTER TABLE `cust_perusahaan`
  ADD PRIMARY KEY (`cust_perusahaan_id`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`divisi_id`);

--
-- Indexes for table `history_foll_up`
--
ALTER TABLE `history_foll_up`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `maskapai`
--
ALTER TABLE `maskapai`
  ADD PRIMARY KEY (`maskapai_id`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`perusahaan_id`);

--
-- Indexes for table `pic`
--
ALTER TABLE `pic`
  ADD PRIMARY KEY (`pic_id`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cust_perusahaan`
--
ALTER TABLE `cust_perusahaan`
  MODIFY `cust_perusahaan_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `divisi_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `history_foll_up`
--
ALTER TABLE `history_foll_up`
  MODIFY `history_id` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maskapai`
--
ALTER TABLE `maskapai`
  MODIFY `maskapai_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `perusahaan_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pic`
--
ALTER TABLE `pic`
  MODIFY `pic_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `route_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
