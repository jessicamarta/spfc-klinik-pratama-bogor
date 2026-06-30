-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 30, 2026 at 10:56 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spfc`
--

-- --------------------------------------------------------

--
-- Table structure for table `basis_aturan`
--

CREATE TABLE `basis_aturan` (
  `idaturan` int(11) NOT NULL,
  `idpenyakit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `basis_aturan`
--

INSERT INTO `basis_aturan` (`idaturan`, `idpenyakit`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(20, 20),
(21, 21),
(22, 22),
(23, 23),
(24, 24),
(25, 25),
(26, 26),
(27, 27),
(28, 28),
(29, 29),
(30, 30),
(31, 31),
(32, 32),
(33, 33);

-- --------------------------------------------------------

--
-- Table structure for table `detail_basis_aturan`
--

CREATE TABLE `detail_basis_aturan` (
  `idaturan` int(11) NOT NULL,
  `idgejala` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_basis_aturan`
--

INSERT INTO `detail_basis_aturan` (`idaturan`, `idgejala`) VALUES
(1, 1),
(1, 4),
(1, 9),
(1, 5),
(1, 8),
(1, 10),
(1, 3),
(1, 6),
(2, 1),
(2, 4),
(2, 9),
(2, 11),
(2, 10),
(2, 3),
(2, 2),
(2, 6),
(3, 14),
(3, 12),
(3, 16),
(3, 15),
(4, 21),
(4, 28),
(4, 17),
(5, 18),
(5, 19),
(5, 17),
(5, 7),
(6, 27),
(6, 26),
(6, 23),
(7, 1),
(7, 23),
(7, 22),
(8, 27),
(8, 26),
(8, 13),
(8, 23),
(8, 22),
(8, 20),
(9, 31),
(9, 29),
(9, 28),
(10, 30),
(10, 28),
(11, 31),
(11, 29),
(11, 30),
(11, 28),
(12, 49),
(12, 48),
(12, 55),
(12, 60),
(12, 56),
(13, 51),
(13, 57),
(13, 48),
(13, 55),
(13, 56),
(14, 51),
(14, 57),
(14, 48),
(14, 55),
(14, 56),
(15, 53),
(15, 57),
(15, 48),
(15, 55),
(15, 56),
(16, 52),
(16, 57),
(16, 48),
(16, 55),
(16, 56),
(17, 52),
(17, 53),
(17, 57),
(17, 48),
(17, 55),
(17, 56),
(18, 57),
(18, 48),
(18, 55),
(18, 56),
(19, 54),
(19, 57),
(19, 48),
(19, 55),
(19, 56),
(20, 62),
(20, 63),
(20, 61),
(20, 56),
(21, 48),
(21, 64),
(22, 48),
(22, 65),
(23, 66),
(23, 67),
(23, 48),
(24, 37),
(24, 47),
(24, 44),
(24, 38),
(24, 45),
(24, 46),
(24, 42),
(24, 36),
(24, 41),
(24, 43),
(24, 40),
(25, 37),
(25, 47),
(25, 44),
(25, 38),
(25, 45),
(25, 46),
(25, 36),
(25, 41),
(25, 43),
(25, 40),
(26, 69),
(26, 70),
(26, 71),
(26, 72),
(26, 73),
(26, 24),
(26, 68),
(27, 75),
(27, 74),
(27, 76),
(27, 89),
(27, 72),
(27, 73),
(27, 88),
(27, 90),
(28, 79),
(28, 78),
(28, 80),
(28, 77),
(28, 82),
(28, 84),
(28, 81),
(28, 85),
(28, 83),
(29, 86),
(29, 88),
(29, 87),
(30, 78),
(30, 77),
(30, 82),
(30, 84),
(30, 81),
(30, 85),
(30, 83),
(31, 75),
(31, 74),
(31, 89),
(31, 88),
(31, 90),
(31, 91),
(32, 75),
(32, 74),
(32, 89),
(32, 92),
(32, 88),
(32, 90),
(32, 91),
(33, 75),
(33, 74),
(33, 89),
(33, 94),
(33, 88),
(33, 90),
(33, 91),
(33, 93);

-- --------------------------------------------------------

--
-- Table structure for table `detail_konsultasi`
--

CREATE TABLE `detail_konsultasi` (
  `idkonsultasi` int(11) NOT NULL,
  `idgejala` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_penyakit`
--

CREATE TABLE `detail_penyakit` (
  `idkonsultasi` int(11) NOT NULL,
  `idpenyakit` int(11) NOT NULL,
  `persentase` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gejala`
--

CREATE TABLE `gejala` (
  `idgejala` int(11) NOT NULL,
  `nmgejala` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`idgejala`, `nmgejala`) VALUES
(1, 'Batuk '),
(2, 'Suara nafas seperti grok grok atau basah'),
(3, 'Sesak '),
(4, 'Dada terasa seperti terikat'),
(5, 'Mengi (seperti suara ngik ngik saat bernafas)'),
(6, 'Sulit bernafas'),
(7, 'Semakin parah saat pagi hari'),
(8, 'Semakin parah saat malam hari'),
(9, 'Gejala memperberat (beraktivitas berat / bulu hewan / perokok di sekitar / perubahan cuaca)'),
(10, 'Sering merasakan gejala serupa sebelumnya'),
(11, 'Perokok aktif'),
(12, 'Dahak berwarna hijau atau kuning'),
(13, 'Dahak berwarna putih atau bening'),
(14, 'Batuk > 2 minggu'),
(15, 'Penurunan Berat Badan (BB)'),
(16, 'Keringat malam'),
(17, 'Pilek'),
(18, 'Bersin-bersin'),
(19, 'Ingus meler / cair'),
(20, 'Terasa bengkak di tenggorokan'),
(21, 'Hidung mampet'),
(22, 'Radang tenggorokan'),
(23, 'Nyeri menelan'),
(24, 'Pusing berputar'),
(25, 'Keluar darah saat batuk'),
(26, 'Bau nafas'),
(27, 'Batu amandel / batu tonsil'),
(28, 'Nyeri kepala'),
(29, 'Lokasi di kepala bagian belakang'),
(30, 'Lokasi di kepala bagian kiri atau kanan'),
(31, 'Leher dan bahu terasa pegal atau berat'),
(32, 'Nyeri pinggang'),
(33, 'Nyeri menjalar hingga ke paha'),
(34, 'Nyeri menjalar hingga kaki bagian bawah'),
(35, 'Sering duduk atau berdiri lama'),
(36, 'Nyeri saat BAK (Buang Air Kecil)'),
(37, 'BAK terasa tidak tuntas'),
(38, 'Frekuensi BAK bertambah / semakin sering BAK'),
(39, 'Terasa panas atau perih saat BAK'),
(40, 'Sudah menikah'),
(41, 'Saat berhubungan dengan pasangan tidak langsung di bilas / dibersihkan'),
(42, 'Nanah atau cairan berwarna putih / kuning / keabuan dari organ genital'),
(43, 'Sering gonta ganti pasangan'),
(44, 'Cebok dari belakang ke depan pada wanita'),
(45, 'Jarang ganti pembalut (normalnya ganti per 4 jam)'),
(46, 'Keputihan'),
(47, 'Bau di area genital'),
(48, 'Kemerahan atau gatal di kulit'),
(49, 'Di area kulit dan rambut kepala'),
(50, 'Di area dagu dan jenggot'),
(51, 'Di area sekitar anus atau bokong, perut bagian bawah'),
(52, 'Di area kaki'),
(53, 'Di area tangan'),
(54, 'Di area lain selain area kepala, kaki, tangan, jenggot, dagu, sekitar anus dan perut bawah'),
(55, 'Memelihara hewan di rumah'),
(56, 'Sering berkeringat'),
(57, 'Jarang mandi / mengganti pakaian'),
(58, 'Jarang ganti kaos kaki'),
(59, 'Sering lembab di area kaki dan jari-jari'),
(60, 'Sering berhubungan dengan tanah'),
(61, 'Semakin gatal saat malam hari'),
(62, 'Di sela-sela jari atau lipatan tubuh'),
(63, 'Sekolah di pesantren atau asrama (atau riwayat sering tidur bersama dengan orang lain, sering bertukar pakaian atau alat mandi)'),
(64, 'Memiliki riwayat alergi (cuaca, jenis kain tertentu, bulu hewan, dll)'),
(65, 'Sering kontak dengan bahan yang mengandung iritan (detergen, bahan kimia tertentu atau bahan tertentu dari tempat kerja)'),
(66, 'Benjolan atau gelembung isi air'),
(67, 'Di area tertentu (leher saja / dada kiri atau kanan saja / lengan atas atau bawah saja / punggung bagian kiri atau kanan saja)'),
(68, 'Terasa seperti mengambang, tidak menapak'),
(69, 'Bila berubah posisi gejala semakin parah'),
(70, 'Bila dengar suara berisik, gejala semakin parah'),
(71, 'Bila melihat cahaya dari gelap tiba-tiba terang, gejala semakin parah'),
(72, 'Mual'),
(73, 'Muntah'),
(74, 'BAB cair / mencret'),
(75, 'BAB > 3x'),
(76, 'BAB disertai lendir / darah'),
(77, 'Nyeri ulu hati'),
(78, 'Menjalar / tembus hingga punggung'),
(79, 'Dada terasa perih atau panas terbakar'),
(80, 'Mulut atau lidah terasa asam atau pahit'),
(81, 'Riwayat suka makan pedas'),
(82, 'Riwayat suka makan / minum yang asam'),
(83, 'Riwayat suka minum kopi / teh'),
(84, 'Riwayat suka makan makanan bersantan'),
(85, 'Riwayat suka makanan berlemak'),
(86, 'Perut terasa kembung / begah'),
(87, 'Sering sendawa / kentut / buang gas'),
(88, 'Perut terasa tidak nyaman'),
(89, 'Jarang mencuci tangan saat akan makan'),
(90, 'Suka jajan sembarangan / jajan pinggir jalan'),
(91, 'Terasa lemas'),
(92, 'Masih kuat minum'),
(93, 'Tidak ingin / malas minum'),
(94, 'Mata cekung'),
(95, 'Di area kuku kaki atau tangan');

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `idkonsultasi` int(11) NOT NULL,
  `idusers` int(11) NOT NULL DEFAULT 0,
  `tanggal` date NOT NULL,
  `nama` varchar(50) NOT NULL,
  `usia` int(3) NOT NULL DEFAULT 0,
  `alamat` varchar(200) NOT NULL DEFAULT '',
  `berat_badan` decimal(5,2) NOT NULL DEFAULT 0.00,
  `tinggi_badan` decimal(5,2) NOT NULL DEFAULT 0.00,
  `golongan_darah` varchar(3) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `idpasien` int(11) NOT NULL,
  `idusers` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`idpasien`, `idusers`, `nama_lengkap`, `created_at`) VALUES
(1, 7, 'Yohannes', '2026-06-01 04:36:25'),
(2, 8, 'Jeremy', '2026-06-01 05:13:25');

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `idpenyakit` int(11) NOT NULL,
  `nmpenyakit` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `solusi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`idpenyakit`, `nmpenyakit`, `keterangan`, `solusi`) VALUES
(1, 'Asma ', 'Penyakit karena adanya gangguan pada saluran nafas', 'Jauhi alergen (penyebab alergi), selalu sedia obat sesak, minum obat sesak bila sesak'),
(2, 'PPOK', 'Penyakit paru kronis karena adanya obstruksi kronis di paru', 'Tidak merokok'),
(3, 'TBC', 'Penyakit paru karena infeksi bakteri Mycobacterium tuberculosis', 'Pakai masker saat berada di luar rumah, selesaikan terapi OAT hingga tuntas'),
(4, 'Sinusitis', 'Penyakit karena peradangan pada saluran nafas di hidung', 'Rajin irigasi nasal (cuci hidung) dengan cairan NaCl bila gejala pilek / hidung mampet'),
(5, 'Rhinitis Alergi', 'Penyakit karena peradangan pada saluran nafas di hidung karena alergi', 'Hindari alergen'),
(6, 'Tonsilitis', 'Peradangan pada tonsil (amandel) karena infeksi bakteri / virus', 'Hindari makanan / minuman dengan pemanis buatan, minum antibiotik dan obat radang bila perlu'),
(7, 'Faringitis', 'Peradangan pada faring karena infeksi bakteri / virus', 'Hindari makanan / minuman dengan pemanis buatan, minum antibiotik dan obat radang bila perlu'),
(8, 'Tonsilofaringitis', 'Peradangan pada tonsil (amandel) & faring karena infeksi bakteri / virus', 'Hindari makanan / minuman dengan pemanis buatan, minum antibiotik dan obat radang bila perlu'),
(9, 'TTH', 'Nyeri kepala, umumnya berada di kepala bagian belakang, disertai tegang otot di area leher - bahu', 'Istirahat cukup, minum obat nyeri kepala (paracetamol / ibuprofen) dan pelemas otot bila perlu'),
(10, 'Migrain', 'Nyeri kepala sebelah', 'Istirahat cukup, minum obat nyeri kepala (paracetamol / ibuprofen) bila perlu'),
(11, 'LBP', 'Nyeri pada punggung / pinggang bagian tengah hingga bawah, dapat menjalar hingga kaki', 'Fisioterapi, rontgen area tulang belakang, minum obat anti nyeri bila perlu'),
(12, 'Tinea Kapitis', 'Penyakit karena infeksi jamur di area kulit & rambut kepala', 'Minum obat / salep anti jamur, jaga higienitas diri'),
(13, 'Tinea Barbae', 'Penyakit karena infeksi jamur di area dagu & jenggot', 'Minum obat / salep anti jamur, jaga higienitas diri'),
(14, 'Tinea Cruris', 'Penyakit karena infeksi jamur di area anus - bokong, perut bagian bawah', 'Minum obat / salep anti jamur, jaga higienitas diri'),
(15, 'Tinea Manus', 'Penyakit karena infeksi jamur di area tangan', 'Minum obat / salep anti jamur, jaga higienitas diri'),
(16, 'Tinea Pedis', 'Penyakit karena infeksi jamur di area kaki', 'Minum obat / salep anti jamur, jaga higienitas diri'),
(17, 'Tinea Pedis et Manum', 'Penyakit karena infeksi jamur di area tangan & kaki', 'Minum obat / salep anti jamur, jaga higienitas diri'),
(18, 'Tinea Unguium', 'Penyakit karena infeksi jamur di area kuku jari tangan & kaki', 'Minum obat / salep anti jamur, jaga higienitas diri'),
(19, 'Tinea Korporis', 'Penyakit karena infeksi jamur di area lain selain yang disebutkan di atas', 'Minum obat / salep anti jamur, jaga higienitas diri'),
(20, 'Scabies', 'Penyakit karena infeksi tungau Scabies', 'Rendam pakaian, sprei, handuk dll dengan air panas, dan cuci bersih, pakai salep Permethrin (untuk skabies)'),
(21, 'Dermatitis Kontak Alergi', 'Peradangan pada kulit karena reaksi alergi', 'Hindari alergen, pakai salep anti radang'),
(22, 'Dermatitis Kontak Iritan', 'Peradangan pada kulit karena paparan bahan iritan (detergen, alat pembersih dll)', 'Hindari bahan iritan, pakai salep anti radang'),
(23, 'Herpes Zoster', 'Penyakit karena infeksi virus pada saraf & kulit karena reaktivasi virus Varicella Zoster (VZV)', 'Minum obat anti virus hingga tuntas, jangan pecahkan gelembung air, jangan di garuk'),
(24, 'Gonorrhea', 'Penyakit infeksi menular seksual', 'Jangan gonta-ganti pasangan, pakai pengaman saat berhubungan, suntik / minum obat antibiotik sesuai terapi'),
(25, 'ISK', 'Penyakit infeksi saluran kemih', 'Jaga higienitas area genital, minum air mineral min 2L/hari, jangan tahan BAK, habiskan antibiotik'),
(26, 'BPPV', 'Penyakit karena gangguan sistem vestibular yang ditandai serangan vertigo karena perubahan posisi', 'Hindari stress, istirahat cukup, minum obat vertigo'),
(27, 'GEA', 'Penyakit karena peradangan / infeksi di saluran cerna', 'Minum oralit untuk mengganti cairan yang hilang, minum antibiotik sesuai anjuran, minum obat diare & mual muntah'),
(28, 'GERD', 'Penyakit kronis di sistem pencernaan karena naiknya asam lambung hingga ke kerongkongan karena melemahnya otot esofagus', 'Hindari makan pedas, santan, lemak, kopi, teh, jangan telat makan, minum obat lambung bila perlu, hindari stress'),
(29, 'Gastritis', 'Peradangan di mukosa (salah satu lapisan) di lambung umumnya karena infeksi bakteri', 'Jaga pola makan, hindari stress, minum obat lambung bila perlu'),
(30, 'Dispepsia', 'Kumpulan gejala masalah pencernaan bagian atas seperti nyeri di ulu hati', 'Jaga pola makan, hindari stress, minum obat lambung bila perlu'),
(31, 'Diare', 'Penyakit karena infeksi bakteri / virus / parasit di saluran pencernaan', 'Jaga kebersihan makanan / minuman yang di konsumsi, jaga higienitas diri, minum obat diare bila perlu'),
(32, 'Dehidrasi Ringan Sedang (DRS)', 'Kondisi kekurangan cairan umumnya karena diare / mual muntah', 'Minum oralit untuk mengganti cairan yang hilang'),
(33, 'Dehidrasi Sedang Berat (DSB)', 'Kondisi kekurangan cairan umumnya karena diare / mual muntah', 'Minum oralit untuk mengganti cairan yang hilang, bawa ke IGD untuk di infus untuk mengejar cairan & observasi lanjutan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idusers` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idusers`, `username`, `pass`, `role`) VALUES
(1, 'Ester', '184e88c34d99fadfd71366cff8388225', 'Perawat'),
(2, 'Admin', 'e3afed0047b08059d0fada10f400c1e5', 'Perawat'),
(3, 'Jessica', '88e11caee979ba2bf6c1aa459b2cd77b', 'Pasien'),
(5, 'Perawat', '88302402fc4986121efe4a68ba6f5706', 'Perawat'),
(7, 'Yohannes', 'd0ee211fef77bd2fed4e9c3c04486a1c', 'Pasien'),
(8, 'Jeremy', '877b13f232fe100743d38e5bcb9a82d3', 'Pasien');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basis_aturan`
--
ALTER TABLE `basis_aturan`
  ADD PRIMARY KEY (`idaturan`);

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`idgejala`);

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`idkonsultasi`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`idpasien`);

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`idpenyakit`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idusers`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `basis_aturan`
--
ALTER TABLE `basis_aturan`
  MODIFY `idaturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `gejala`
--
ALTER TABLE `gejala`
  MODIFY `idgejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `idkonsultasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `idpasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `idpenyakit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idusers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
