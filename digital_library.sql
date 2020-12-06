-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 06, 2020 at 02:22 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digital_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `eisbn` varchar(255) DEFAULT NULL,
  `tahun_terbit` varchar(255) NOT NULL,
  `stok` int(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `id_kategori` int(11) NOT NULL,
  `update_by` varchar(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `penulis`, `penerbit`, `isbn`, `eisbn`, `tahun_terbit`, `stok`, `deskripsi`, `image`, `id_kategori`, `update_by`, `updated_at`) VALUES
(1, 'BUKU WEB', 'Mr. Programmer', 'Hikam Pustaka', '000-000-000-001', '000-000-000-000', '2020', 78, 'Sebagai seorang Web Design atau Programmer belajar adalah suatu hal yang di haruskan, karena dengan belajar kita akan menjadi seorang yang ahli di bidang Web Design atau Programmer. Belajar bisa di lakukan dengan banyak cara, contohnya seperti searching di internet tentang tutorial, artikel, video yang berhubungan dengan apa yang kita mau pelajari, atau bertanya dengan teman yang sudah ahli di bidang yang ingin kita pelajari, atau mencari buku-buku referensi di toko-toko buku untuk mempelajari apa yang ingin kita pelajari, dan sebagainya.', '5f8acad6df275.png', 16, '1', '2020-12-05 14:29:30'),
(2, 'BUku judul baru', 'tes', 'tes', 'tes', 'tes', '2020', 60, 'tes', '5f8acabb89a7d.png', 2, '1', '2020-12-05 14:29:30'),
(3, 'tes Judul', 'ds', 'tes', 'tes', 'tes', '2019', 13, 'tes', '5f8adb1076751.png', 2, '1', '2020-11-15 18:47:40');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `buku` varchar(255) NOT NULL,
  `member` int(11) DEFAULT NULL,
  `update_by` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`, `update_by`) VALUES
(1, 'website', NULL),
(2, 'mobile', NULL),
(3, 'acounting', NULL),
(16, 'tes', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kurir`
--

CREATE TABLE `kurir` (
  `id_kurir` int(255) NOT NULL,
  `kurir` varchar(255) NOT NULL,
  `biaya` int(255) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kurir`
--

INSERT INTO `kurir` (`id_kurir`, `kurir`, `biaya`, `update_by`) VALUES
(1, 'Kurir Digital Library', 20000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id_member` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_wa` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status_pekerjaan` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id_member`, `nama`, `email`, `no_wa`, `image`, `alamat`, `password`, `status_pekerjaan`, `jenis_kelamin`, `token`) VALUES
(1, 'Agung', 'tes123@gmail.com', '0887', '5fc178957d495.png', 'Cirimekar', 'e10adc3949ba59abbe56e057f20f883e', 'Mahasiswa', 'Laki-Laki', NULL),
(2, 'Hanif', 'hanif@gmail.com', '088704145010', '-', 'jl jalan-jalan aja', '', 'mahasiswa', 'Laki-Laki', NULL),
(3, 'Sumi', 'sumi@gmail.com', '088704145111', '-', 'jl jalan terus', '', 'mahasiswa', 'Perempuan', NULL),
(4, 'Agung Maulana', 'agung040100@gmail.com', '088704145010', '-', 'jl jalan', 'e10adc3949ba59abbe56e057f20f883e', 'Mahasiswa', 'Laki-Laki', '11dc1f675b490207567d876e8403dd8614e1b600b1fd579f47433b88e8d8529101b1ad7ba75798f2907ce3bd921346bf'),
(5, 'test', 'test', 'tes', NULL, 'test', 'test', 'test', 'Perempuan', NULL),
(14, 'Ag', 'ag@gmail', '00', '-', 'al', '123', 'Mahasiswa', 'Laki-Laki', NULL),
(17, 'Agung', 'bernard@andtechnology.mobi', '0887', '5fc1784c7bceb.png', 'Cirimekar', 'e10adc3949ba59abbe56e057f20f883e', 'Mahasiswa', 'Laki-Laki', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_buku` varchar(255) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_kurir` int(11) DEFAULT NULL,
  `kirim` tinyint(1) NOT NULL DEFAULT 0,
  `total_buku` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `gambar_bukti` varchar(255) DEFAULT NULL,
  `tanggal_pinjam` date NOT NULL DEFAULT current_timestamp(),
  `tanggal_harus_kembali` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `tanggal_update` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `update_by` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_buku`, `id_member`, `id_kurir`, `kirim`, `total_buku`, `status`, `gambar_bukti`, `tanggal_pinjam`, `tanggal_harus_kembali`, `tanggal_kembali`, `tanggal_update`, `update_by`) VALUES
(1, '1,2', 1, 1, 1, '1,1', 'SELESAI', '-', '2020-10-24', '2020-10-30', '2020-10-24', '2020-11-07 21:00:31', '0'),
(2, '1,2', 1, 1, 1, '1,1', 'SELESAI', '-', '2020-10-24', '2020-10-30', '2020-10-24', '2020-11-07 21:00:38', '0'),
(3, '3', 3, 1, 1, '1', 'BATAL', '-', '2020-10-24', '2020-10-30', NULL, '2020-11-07 20:59:49', '0'),
(4, '3', 3, 1, 1, '2', 'DIKIRIM', '-', '2020-10-24', '2020-10-30', NULL, '2020-12-05 14:25:49', '0'),
(5, '3', 3, 1, 1, '2', 'BATAL', '-', '2020-10-24', '2020-10-30', '2020-11-14', '2020-11-14 21:31:24', '0'),
(6, '3', 3, 1, 1, '2', 'DIKIRIM', '-', '2020-10-24', '2020-10-30', NULL, '2020-11-15 18:46:41', '0'),
(7, '3', 3, 1, 1, '2', 'TERKIRIM', '-', '2020-10-24', '2020-10-30', NULL, '2020-11-02 22:14:02', '0'),
(8, '1,2', 1, 1, 1, '1,1', 'SELESAI', '-', '2020-10-24', '2020-10-30', '2020-11-14', '2020-11-14 21:22:48', '0'),
(9, '1', 1, NULL, 0, '1', 'SELESAI', NULL, '2020-11-14', NULL, '2020-11-14', '2020-11-14 21:24:32', '1'),
(10, '2,3,1', 1, NULL, 0, '1,1,1', 'DIPINJAM', NULL, '2020-11-14', NULL, NULL, NULL, '1'),
(11, '2', 2, NULL, 0, '3', 'DIPINJAM', NULL, '2020-11-14', NULL, NULL, NULL, '1'),
(12, '1', 3, NULL, 0, '1', 'DIPINJAM', NULL, '2020-11-14', NULL, NULL, NULL, '1'),
(13, '1', 3, NULL, 0, '1', 'DIPINJAM', NULL, '2020-11-14', NULL, NULL, NULL, '1'),
(14, '3,2,1', 1, NULL, 0, '1,1,1', 'SELESAI', NULL, '2020-11-14', '2020-11-03', '2020-11-14', '2020-11-14 21:00:59', '1'),
(15, '1', 1, NULL, 0, '1', 'DIPINJAM', NULL, '2020-11-14', '2020-11-19', NULL, NULL, '1'),
(16, '2', 1, NULL, 0, '3', 'SELESAI', NULL, '2020-11-14', '2020-11-18', '2020-11-14', '2020-11-14 21:24:42', '1'),
(17, '1', 2, NULL, 0, '1', 'DIPINJAM', NULL, '2020-11-15', '2020-11-19', NULL, NULL, '1'),
(18, '3,1', 3, NULL, 0, '1,1', 'DIPINJAM', NULL, '2020-11-15', '2020-11-20', NULL, NULL, '1'),
(19, '1,2', 1, 1, 1, '1,1', 'DIKIRIM', NULL, '2020-11-28', NULL, NULL, '2020-12-05 14:25:54', '1'),
(20, '1,2', 1, 1, 1, '1,1', 'BATAL', NULL, '2020-11-28', NULL, NULL, '2020-11-28 06:41:17', 'M1'),
(21, '1,2', 1, 0, 0, '1,1', 'BATAL', NULL, '2020-11-28', NULL, NULL, '2020-11-28 06:41:06', 'M1'),
(22, '1,2', 1, 0, 0, '1,1', 'DIPINJAM', NULL, '2020-11-28', '2020-11-27', NULL, '2020-12-05 15:17:54', 'M1'),
(23, '1,2', 1, 0, 0, '1,2', 'DIPINJAM', NULL, '2020-11-28', '2020-12-23', NULL, '2020-12-05 15:18:29', 'M1'),
(24, '1,2', 1, 0, 0, '12,11', 'DIPINJAM', 'tes.jpg', '2020-11-28', '2020-12-31', NULL, '2020-12-06 09:25:36', 'M1'),
(25, '1,2', 1, 0, 0, '1,2', 'DIPINJAM', NULL, '2020-12-05', NULL, NULL, '2020-12-05 14:29:43', 'M1');

-- --------------------------------------------------------

--
-- Table structure for table `pengunjung`
--

CREATE TABLE `pengunjung` (
  `id_pengunjung` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `keperluan` varchar(255) NOT NULL,
  `tanggal_kunjungan` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengunjung`
--

INSERT INTO `pengunjung` (`id_pengunjung`, `nama`, `alamat`, `status`, `jenis_kelamin`, `keperluan`, `tanggal_kunjungan`) VALUES
(1, 'Agung', 'ciluar', 'Mahasiswa', 'Laki-Laki', 'Belajar', '2020-11-15 00:00:00'),
(2, 'tes', 'tes', 'tes', 'Laki-Laki', 'tes', '2020-11-15 00:00:00'),
(3, 'Agung', 'ciluar1', 'Mahasiswa', 'Perempuan', 'Belajar', '2020-11-15 00:00:00'),
(4, 'tes', 'ciluar1', 'Mahasiswa', 'Perempuan', 'ds', '2020-11-15 00:00:00'),
(6, 'Hanif', 'jl jalan-jalan aja', 'mahasiswa', 'Laki-Laki', 'tes', '2020-11-15 00:00:00'),
(7, 'Sumi', 'jl jalan terus', 'mahasiswa', 'Perempuan', 'tes', '2020-11-15 00:00:00'),
(8, 'Agung', 'jl kesana kesini', 'mahasiswa', 'Laki-Laki', 'tes', '2020-11-15 00:00:00'),
(9, 'Ridho', 'Cirimekar', 'Mahasiswa', 'Laki-Laki', 'Belajar', '2020-11-15 00:00:00'),
(10, 'Agung', 'jl kesana kesini', 'mahasiswa', 'Laki-Laki', 'Belajar', '2020-11-15 00:00:00'),
(11, 'tesdaftar', 'test', 'Mahasiswa', 'Laki-Laki', 'tes', '2020-11-15 00:00:00'),
(12, 'Agung Maulana', 'ciluar', 'Mahasiswa', 'Laki-Laki', 'tes', '2020-11-15 22:45:45'),
(13, 'tes', 'ciluar1', 'Mahasiswa', 'Laki-Laki', 'tes', '2020-11-15 22:58:52'),
(14, 'Agung', 'ciluar1', 'Mahasiswa', 'Laki-Laki', 'tes', '2020-11-15 22:59:12'),
(15, 'Agung', 'ciluar1', 'Mahasiswa', 'Laki-Laki', 'tes', '2020-11-15 22:59:48'),
(16, 'Agung', 'ciluar1', 'Mahasiswa', 'Laki-Laki', 'tes', '2020-11-15 22:59:54');

-- --------------------------------------------------------

--
-- Table structure for table `tb_anggota`
--

CREATE TABLE `tb_anggota` (
  `id_anggota` int(255) NOT NULL,
  `nama_anggota` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `kelas` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_anggota`
--

INSERT INTO `tb_anggota` (`id_anggota`, `nama_anggota`, `alamat`, `kelas`) VALUES
(1, 'Agung Maulana', 'Bogor Ciluar s', 'TI411'),
(2, 'Firdaus Pratama', 'Bogor', 'TI411'),
(3, 'Sumiati', '-', 'KA'),
(4, 'Rocky Oktavianus', '-', 'AP'),
(5, 'Hanif Prasetyo Taufikurrahman\r\n', '-', 'AP'),
(6, 'Ni Putu Roshinta Dewi', '-', 'AP');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jumlah_login` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `jumlah_login`) VALUES
(1, 'Admin', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 20),
(2, 'Admin2', 'admin2', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(3, 'Agung M', 'm4gung', 'e10adc3949ba59abbe56e057f20f883e', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`id_kurir`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id_member`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE;

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indexes for table `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD PRIMARY KEY (`id_pengunjung`);

--
-- Indexes for table `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kurir`
--
ALTER TABLE `kurir`
  MODIFY `id_kurir` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pengunjung`
--
ALTER TABLE `pengunjung`
  MODIFY `id_pengunjung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_anggota`
--
ALTER TABLE `tb_anggota`
  MODIFY `id_anggota` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
