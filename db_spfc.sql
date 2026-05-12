-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2026 at 08:17 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

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
(2, 1),
(3, 4),
(4, 5),
(5, 6),
(6, 7),
(7, 8),
(8, 9),
(9, 10),
(10, 11),
(12, 13),
(13, 14),
(14, 15),
(15, 16),
(16, 17),
(17, 18),
(18, 19),
(19, 20),
(20, 21),
(21, 22),
(22, 23),
(23, 24),
(24, 25),
(25, 26),
(26, 27),
(27, 28),
(28, 29),
(29, 30),
(30, 31),
(31, 32),
(32, 33),
(33, 34),
(34, 35),
(35, 0),
(36, 0),
(37, 12);

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
(1, 0),
(1, 0),
(1, 0),
(1, 0),
(1, 0),
(1, 0),
(1, 0),
(1, 0),
(2, 3),
(2, 6),
(2, 12),
(2, 8),
(2, 11),
(2, 13),
(2, 5),
(2, 9),
(3, 3),
(3, 6),
(3, 12),
(3, 14),
(3, 5),
(3, 7),
(3, 9),
(4, 17),
(4, 15),
(4, 19),
(4, 18),
(5, 24),
(5, 31),
(5, 20),
(6, 21),
(6, 22),
(6, 20),
(6, 10),
(7, 30),
(7, 29),
(7, 26),
(8, 3),
(8, 26),
(8, 25),
(9, 30),
(9, 29),
(9, 16),
(9, 26),
(9, 25),
(9, 23),
(10, 34),
(10, 32),
(10, 31),
(12, 34),
(12, 32),
(12, 33),
(12, 31),
(13, 52),
(13, 51),
(13, 58),
(13, 63),
(13, 59),
(14, 54),
(14, 60),
(14, 51),
(14, 58),
(14, 59),
(15, 54),
(15, 60),
(15, 51),
(15, 58),
(15, 59),
(16, 56),
(16, 60),
(16, 51),
(16, 58),
(16, 59),
(17, 55),
(17, 60),
(17, 51),
(17, 58),
(17, 59),
(18, 55),
(18, 56),
(18, 60),
(18, 51),
(18, 58),
(18, 59),
(19, 60),
(19, 51),
(19, 58),
(19, 59),
(20, 57),
(20, 60),
(20, 51),
(20, 58),
(20, 59),
(21, 65),
(21, 66),
(21, 64),
(21, 59),
(22, 51),
(22, 67),
(23, 51),
(23, 68),
(24, 69),
(24, 70),
(24, 51),
(25, 40),
(25, 50),
(25, 47),
(25, 41),
(25, 48),
(25, 49),
(25, 45),
(25, 39),
(25, 44),
(25, 46),
(25, 43),
(26, 40),
(26, 50),
(26, 47),
(26, 41),
(26, 48),
(26, 49),
(26, 39),
(26, 44),
(26, 46),
(26, 43),
(27, 72),
(27, 73),
(27, 74),
(27, 75),
(27, 76),
(27, 27),
(27, 71),
(28, 78),
(28, 77),
(28, 79),
(28, 92),
(28, 75),
(28, 76),
(28, 91),
(28, 93),
(29, 82),
(29, 81),
(29, 83),
(29, 80),
(29, 85),
(29, 87),
(29, 84),
(29, 88),
(29, 86),
(30, 89),
(30, 91),
(30, 90),
(31, 81),
(31, 80),
(31, 85),
(31, 87),
(31, 84),
(31, 88),
(31, 86),
(32, 78),
(32, 77),
(32, 92),
(32, 91),
(32, 93),
(32, 94),
(33, 78),
(33, 77),
(33, 92),
(33, 95),
(33, 91),
(33, 93),
(33, 94),
(34, 78),
(34, 77),
(34, 97),
(34, 91),
(34, 93),
(34, 94),
(34, 96),
(37, 33),
(37, 31);

-- --------------------------------------------------------

--
-- Table structure for table `detail_konsultasi`
--

CREATE TABLE `detail_konsultasi` (
  `idkonsultasi` int(11) NOT NULL,
  `idgejala` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_konsultasi`
--

INSERT INTO `detail_konsultasi` (`idkonsultasi`, `idgejala`) VALUES
(1, 33),
(1, 31),
(2, 69),
(2, 70),
(2, 51);

-- --------------------------------------------------------

--
-- Table structure for table `detail_penyakit`
--

CREATE TABLE `detail_penyakit` (
  `idkonsultasi` int(11) NOT NULL,
  `idpenyakit` int(11) NOT NULL,
  `persentase` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_penyakit`
--

INSERT INTO `detail_penyakit` (`idkonsultasi`, `idpenyakit`, `persentase`) VALUES
(1, 6, 33),
(1, 11, 33),
(1, 12, 100),
(1, 13, 50),
(2, 14, 20),
(2, 15, 20),
(2, 16, 20),
(2, 17, 20),
(2, 18, 20),
(2, 19, 17),
(2, 20, 25),
(2, 21, 20),
(2, 23, 50),
(2, 24, 50),
(2, 25, 100);

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
(3, 'Batuk '),
(5, 'Sesak '),
(6, 'Dada terasa seperti terikat'),
(7, 'Suara nafas seperti grok grok atau basah'),
(8, 'Mengi (seperti suara ngik ngik saat bernafas)'),
(9, 'Sulit bernafas'),
(10, 'Semakin parah saat pagi hari'),
(11, 'Semakin parah saat malam hari'),
(12, 'Gejala memperberat (beraktivitas berat / bulu hewan / perokok di sekitar / perubahan cuaca)'),
(13, 'Sering merasakan gejala serupa sebelumnya'),
(14, 'Perokok aktif'),
(15, 'Dahak berwarna hijau atau kuning'),
(16, 'Dahak berwarna putih atau bening'),
(17, 'Batuk > 2 minggu'),
(18, 'Penurunan Berat Badan (BB)'),
(19, 'Keringat malam'),
(20, 'Pilek'),
(21, 'Bersin-bersin'),
(22, 'Ingus meler / cair'),
(23, 'Terasa bengkak di tenggorokan'),
(24, 'Hidung mampet'),
(25, 'Radang tenggorokan'),
(26, 'Nyeri menelan'),
(27, 'Pusing berputar'),
(28, 'Keluar darah saat batuk'),
(29, 'Bau nafas'),
(30, 'Batu amandel / batu tonsil'),
(31, 'Nyeri kepala'),
(32, 'Lokasi di kepala bagian belakang'),
(33, 'Lokasi di kepala bagian kiri atau kanan'),
(34, 'Leher dan bahu terasa pegal atau berat'),
(35, 'Nyeri pinggang'),
(36, 'Nyeri menjalar hingga ke paha'),
(37, 'Nyeri menjalar hingga kaki bagian bawah'),
(38, 'Sering duduk atau berdiri lama'),
(39, 'Nyeri saat BAK (Buang Air Kecil)'),
(40, 'BAK terasa tidak tuntas'),
(41, 'Frekuensi BAK bertambah / semakin sering BAK'),
(42, 'Terasa panas atau perih saat BAK'),
(43, 'Sudah menikah'),
(44, 'Saat berhubungan dengan pasangan tidak langsung di bilas / dibersihkan'),
(45, 'Nanah atau cairan berwarna putih / kuning / keabuan dari organ genital'),
(46, 'Sering gonta ganti pasangan'),
(47, 'Cebok dari belakang ke depan pada wanita'),
(48, 'Jarang ganti pembalut (normalnya ganti per 4 jam)'),
(49, 'Keputihan'),
(50, 'Bau di area genital'),
(51, 'Kemerahan atau gatal di kulit'),
(52, 'Di area kulit dan rambut kepala'),
(53, 'Di area dagu dan jenggot'),
(54, 'Di area sekitar anus atau bokong, perut bagian bawah'),
(55, 'Di area kaki'),
(56, 'Di area tangan'),
(57, 'Di area lain selain area kepala, kaki, tangan, jenggot, dagu, sekitar anus dan perut bawah'),
(58, 'Memelihara hewan di rumah'),
(59, 'Sering berkeringat'),
(60, 'Jarang mandi / mengganti pakaian'),
(61, 'Jarang ganti kaos kaki'),
(62, 'Sering lembab di area kaki dan jari-jari'),
(63, 'Sering berhubungan dengan tanah'),
(64, 'Semakin gatal saat malam hari'),
(65, 'Di sela-sela jari atau lipatan tubuh'),
(66, 'Sekolah di pesantren atau asrama (atau riwayat sering tidur bersama dengan orang lain, sering bertukar pakaian atau alat mandi)'),
(67, 'Memiliki riwayat alergi (cuaca, jenis kain tertentu, bulu hewan, dll)'),
(68, 'Sering kontak dengan bahan yang mengandung iritan (detergen, bahan kimia tertentu atau bahan tertentu dari tempat kerja)'),
(69, 'Benjolan atau gelembung isi air'),
(70, 'Di area tertentu (leher saja / dada kiri atau kanan saja / lengan atas atau bawah saja / punggung bagian kiri atau kanan saja)'),
(71, 'Terasa seperti mengambang, tidak menapak'),
(72, 'Bila berubah posisi gejala semakin parah'),
(73, 'Bila dengar suara berisik, gejala semakin parah'),
(74, 'Bila melihat cahaya dari gelap tiba-tiba terang, gejala semakin parah'),
(75, 'Mual'),
(76, 'Muntah'),
(77, 'BAB cair / mencret'),
(78, 'BAB > 3x'),
(79, 'BAB disertai lendir / darah'),
(80, 'Nyeri ulu hati'),
(81, 'Menjalar / tembus hingga punggung'),
(82, 'Dada terasa perih atau panas terbakar'),
(83, 'Mulut atau lidah terasa asam atau pahit'),
(84, 'Riwayat suka makan pedas'),
(85, 'Riwayat suka makan / minum yang asam'),
(86, 'Riwayat suka minum kopi / teh'),
(87, 'Riwayat suka makan makanan bersantan'),
(88, 'Riwayat suka makanan berlemak'),
(89, 'Perut terasa kembung / begah'),
(90, 'Sering sendawa / kentut / buang gas'),
(91, 'Perut terasa tidak nyaman'),
(92, 'Jarang mencuci tangan saat akan makan'),
(93, 'Suka jajan sembarangan / jajan pinggir jalan'),
(94, 'Terasa lemas'),
(95, 'Masih kuat minum'),
(96, 'Tidak ingin / malas minum'),
(97, 'Mata cekung'),
(98, 'Di area kuku kaki atau tangan');

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `idkonsultasi` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `konsultasi`
--

INSERT INTO `konsultasi` (`idkonsultasi`, `tanggal`, `nama`) VALUES
(1, '2026-05-06', 'Jessy'),
(2, '2026-05-11', 'Jessica Marta');

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
(4, 'PPOK', 'Penyakit paru kronis karena adanya obstruksi kronis di paru', 'Tidak merokok'),
(5, 'TBC', 'Penyakit paru karena infeksi bakteri Mycobacterium tuberculosis', 'Pakai masker saat berada di luar rumah, selesaikan terapi OAT hingga tuntas'),
(6, 'Sinusitis', 'Penyakit karena peradangan pada saluran nafas di hidung', 'Rajin irigasi nasal (cuci hidung) dengan cairan NaCl bila gejala pilek / hidung mampet'),
(7, 'Rhinitis Alergi', 'Penyakit karena peradangan pada saluran nafas di hidung karena alergi', 'Hindari alergen'),
(8, 'Tonsilitis', 'Peradangan pada tonsil (amandel) karena infeksi bakteri / virus', 'Hindari makanan / minuman dengan pemanis buatan, minum antibiotik dan obat radang bila perlu'),
(9, 'Faringitis', 'Peradangan pada faring karena infeksi bakteri / virus', 'Hindari makanan / minuman dengan pemanis buatan, minum antibiotik dan obat radang bila perlu'),
(10, 'Tonsilofaringitis', 'Peradangan pada tonsil (amandel) & faring karena infeksi bakteri / virus', 'Hindari makanan / minuman dengan pemanis buatan, minum antibiotik dan obat radang bila perlu'),
(11, 'TTH', 'Nyeri kepala, umumnya berada di kepala bagian belakang, disertai tegang otot di area leher - bahu', 'Istirahat cukup, minum obat nyeri kepala (paracetamol / ibuprofen) dan pelemas otot bila perlu'),
(12, 'Migrain', 'Nyeri kepala sebelah', 'Istirahat cukup, minum obat nyeri kepala (paracetamol / ibuprofen) bila perlu'),
(13, 'LBP', 'Nyeri pada punggung / pinggang bagian tengah hingga bawah, dapat menjalar hingga kaki', 'Fisioterapi, rontgen area tulang belakang, minum obat anti nyeri bila perlu'),
(14, 'Tinea Kapitis', 'Penyakit karena infeksi jamur di area kulit & rambut kepala', 'Minum obat / salep anti jamur, jaga higienitas diri'),
(15, 'Tinea Barbae', 'Penyakit karena infeksi jamur di area dagu & jenggot', 'Minum obat / salep anti jamur, jaga higienitas diri'),
(16, 'Tinea Cruris', 'Penyakit karena infeksi jamur di area anus - bokong, perut bagian bawah', 'Minum obat / salep anti jamur, jaga higienitas diri'),
(17, 'Tinea Manus', 'Penyakit karena infeksi jamur di area tangan', 'Minum obat / salep anti jamur, jaga higienitas diri'),
(18, 'Tinea Pedis', 'Penyakit karena infeksi jamur di area kaki', 'Minum obat / salep anti jamur, jaga higienitas diri'),
(19, 'Tinea Pedis et Manum', 'Penyakit karena infeksi jamur di area tangan & kaki', 'Minum obat / salep anti jamur, jaga higienitas diri'),
(20, 'Tinea Unguium', 'Penyakit karena infeksi jamur di area kuku jari tangan & kaki', 'Minum obat / salep anti jamur, jaga higienitas diri'),
(21, 'Tinea Korporis', 'Penyakit karena infeksi jamur di area lain selain yang disebutkan di atas', 'Minum obat / salep anti jamur, jaga higienitas diri'),
(22, 'Scabies', 'Penyakit karena infeksi tungau Scabies', 'Rendam pakaian, sprei, handuk dll dengan air panas, dan cuci bersih, pakai salep Permethrin (untuk skabies)'),
(23, 'Dermatitis Kontak Alergi', 'Peradangan pada kulit karena reaksi alergi', 'Hindari alergen, pakai salep anti radang'),
(24, 'Dermatitis Kontak Iritan', 'Peradangan pada kulit karena paparan bahan iritan (detergen, alat pembersih dll)', 'Hindari bahan iritan, pakai salep anti radang'),
(25, 'Herpes Zoster', 'Penyakit karena infeksi virus pada saraf & kulit karena reaktivasi virus Varicella Zoster (VZV)', 'Minum obat anti virus hingga tuntas, jangan pecahkan gelembung air, jangan di garuk'),
(26, 'Gonorrhea', 'Penyakit infeksi menular seksual', 'Jangan gonta-ganti pasangan, pakai pengaman saat berhubungan, suntik / minum obat antibiotik sesuai terapi'),
(27, 'ISK', 'Penyakit infeksi saluran kemih', 'Jaga higienitas area genital, minum air mineral min 2L/hari, jangan tahan BAK, habiskan antibiotik'),
(28, 'BPPV', 'Penyakit karena gangguan sistem vestibular yang ditandai serangan vertigo karena perubahan posisi', 'Hindari stress, istirahat cukup, minum obat vertigo'),
(29, 'GEA', 'Penyakit karena peradangan / infeksi di saluran cerna', 'Minum oralit untuk mengganti cairan yang hilang, minum antibiotik sesuai anjuran, minum obat diare & mual muntah'),
(30, 'GERD', 'Penyakit kronis di sistem pencernaan karena naiknya asam lambung hingga ke kerongkongan karena melemahnya otot esofagus', 'Hindari makan pedas, santan, lemak, kopi, teh, jangan telat makan, minum obat lambung bila perlu, hindari stress'),
(31, 'Gastritis', 'Peradangan di mukosa (salah satu lapisan) di lambung umumnya karena infeksi bakteri', 'Jaga pola makan, hindari stress, minum obat lambung bila perlu'),
(32, 'Dispepsia', 'Kumpulan gejala masalah pencernaan bagian atas seperti nyeri di ulu hati', 'Jaga pola makan, hindari stress, minum obat lambung bila perlu'),
(33, 'Diare', 'Penyakit karena infeksi bakteri / virus / parasit di saluran pencernaan', 'Jaga kebersihan makanan / minuman yang di konsumsi, jaga higienitas diri, minum obat diare bila perlu'),
(34, 'Dehidrasi Ringan Sedang (DRS)', 'Kondisi kekurangan cairan umumnya karena diare / mual muntah', 'Minum oralit untuk mengganti cairan yang hilang'),
(35, 'Dehidrasi Sedang Berat (DSB)', 'Kondisi kekurangan cairan umumnya karena diare / mual muntah', 'Minum oralit untuk mengganti cairan yang hilang, bawa ke IGD untuk di infus untuk mengejar cairan & observasi lanjutan');

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
(1, 'Ester', '184e88c34d99fadfd71366cff8388225', 'Dokter'),
(2, 'Admin', 'e3afed0047b08059d0fada10f400c1e5', 'Admin'),
(3, 'Jessica', '88e11caee979ba2bf6c1aa459b2cd77b', 'Pasien');

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
  MODIFY `idaturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `gejala`
--
ALTER TABLE `gejala`
  MODIFY `idgejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `idkonsultasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `idpenyakit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idusers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
