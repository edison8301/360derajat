-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2017 at 08:51 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `360degree`
--

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` int(11) NOT NULL,
  `id_kegiatan_induk` int(11) NOT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `target` varchar(255) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `keterangan` text,
  `id_kegiatan_status` int(11) DEFAULT NULL,
  `status_hitung` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `id_kegiatan_induk`, `kode`, `nama`, `target`, `tanggal_mulai`, `tanggal_selesai`, `keterangan`, `id_kegiatan_status`, `status_hitung`) VALUES
(6, 1, 'LAN/I/2017', 'Uji Coba ', '', '2017-03-01', '2017-04-30', '', 1, NULL),
(7, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_induk`
--

CREATE TABLE `kegiatan_induk` (
  `id` int(11) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `target` varchar(255) DEFAULT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `id_kegiatan_status` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan_induk`
--

INSERT INTO `kegiatan_induk` (`id`, `kode`, `nama`, `target`, `tanggal_mulai`, `tanggal_selesai`, `keterangan`, `id_kegiatan_status`) VALUES
(1, 'LAN/I/2017', 'Uji Coba', 'Manajer', '2017-03-01', '2017-04-30', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_kompetensi`
--

CREATE TABLE `kegiatan_kompetensi` (
  `id` int(11) NOT NULL,
  `id_kegiatan` int(11) DEFAULT NULL,
  `uraian` text,
  `cpro` varchar(20) DEFAULT NULL,
  `fpro` varchar(20) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan_kompetensi`
--

INSERT INTO `kegiatan_kompetensi` (`id`, `id_kegiatan`, `uraian`, `cpro`, `fpro`, `urutan`) VALUES
(21, 6, 'INTEGRITAS (Int) Level 2 : Berdedikasi dan konsisten dalam melaksanakan tugas organisasi', '8', '9', 1),
(22, 6, 'PEMBELAJARAN BERKELANJUTAN (PB) Level 2 : Mengidentifikasi peluang pembelajaran dalam rangka meningkatkan efektivitas tugas yang menjadi tanggung jawabnya', '9', '9', 2),
(23, 6, 'KESADARAN BERORGANISASI (KB) Level 2 : Menerapkan pemahaman mengenai organisasi dalam pekerjaan', '8', '8', 3);

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_kompetensi_rincian`
--

CREATE TABLE `kegiatan_kompetensi_rincian` (
  `id` int(11) NOT NULL,
  `id_kegiatan` int(11) DEFAULT NULL,
  `id_kegiatan_kompetensi` int(11) DEFAULT NULL,
  `uraian` text,
  `cpro` varchar(20) DEFAULT NULL,
  `fpro` varchar(20) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan_kompetensi_rincian`
--

INSERT INTO `kegiatan_kompetensi_rincian` (`id`, `id_kegiatan`, `id_kegiatan_kompetensi`, `uraian`, `cpro`, `fpro`, `urutan`) VALUES
(33, 6, 21, 'Melaksanakan tugas sesuai dengan aturan atau standar prosedur yang berlaku secara konsisten', '9', '9', 1),
(34, 6, 21, 'Terbuka terhadap masukan saat terjadi kesalahan kerja di lingkup tangungungjawabnya', '9', '9', NULL),
(35, 6, 21, 'Memperbaiki kesalahan ketika terjadi kesalahan dalam pelaksanaan kerja sesuai tanggungjawab dan kewenangannya', '9', '9', NULL),
(36, 6, 21, 'Bertanggung jawab terhadap keputusan/tindakan yang berdampak pada kelangsungan pekerjaan di lingkup tugasnya', '9', '9', NULL),
(37, 6, 22, 'Menggali masukan untuk pengembangan diri berdasarkan saran dan masukan dari orang lain', '9', '9', NULL),
(38, 6, 22, 'Berbagi pengetahuan dengan orang lain dalam rangka meningkatkan pengetahuan dan wawasan yang bermanfaat dalam lingkungan kerja', '9', '9', NULL),
(39, 6, 22, 'Menggali informasi mengenai program-program pengembangan kompetensi yang relevan dengan tugas', '9', '9', NULL),
(40, 6, 22, 'Antusias dan bersemangat dalam menanggapi peluang pembelajaran yang tersedia di lingkungan kerjanya', '9', '9', NULL),
(41, 6, 23, 'Melakukan koordinasi dengan unit kerja terkait sesuai dengan tugas dan peranan di dalam organisasi', '9', '9', NULL),
(42, 6, 23, 'Menerapkan pola koordinasi sesuai dengan mekanisme proses bisnis organisasi secara konsisten', '9', '9', NULL),
(43, 6, 23, 'Mengidentifikasi pihak-pihak yang berperan penting dalam organisasi dalam menunjang kelancaran tugas di lingkungannya', '9', '9', NULL),
(44, 6, 23, 'Berdiskusi secara informal dengan berbagai pihak di organisasi dalam konteks pelaksanaan tugas', '9', '9', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_kompetensi_rincian_hasil`
--

CREATE TABLE `kegiatan_kompetensi_rincian_hasil` (
  `id` int(11) NOT NULL,
  `id_kegiatan` int(11) DEFAULT NULL,
  `id_kegiatan_kompetensi` int(11) DEFAULT NULL,
  `id_kegiatan_kompetensi_rincian` int(11) NOT NULL,
  `id_kegiatan_penilai` int(11) NOT NULL,
  `cp` varchar(20) DEFAULT NULL,
  `cpr` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan_kompetensi_rincian_hasil`
--

INSERT INTO `kegiatan_kompetensi_rincian_hasil` (`id`, `id_kegiatan`, `id_kegiatan_kompetensi`, `id_kegiatan_kompetensi_rincian`, `id_kegiatan_penilai`, `cp`, `cpr`) VALUES
(45, 6, 21, 34, 19, '5', 6),
(46, 6, 21, 35, 19, '7', 6),
(47, 6, 21, 36, 19, '8', 9),
(48, 6, 21, 33, 19, '7', 6),
(49, 6, 22, 37, 19, '5', 5),
(50, 6, 22, 38, 19, '6', 6),
(51, 6, 22, 39, 19, '7', 7),
(52, 6, 22, 40, 19, '5', 8),
(53, 6, 23, 41, 19, '6', 6),
(54, 6, 23, 42, 19, '7', 7),
(55, 6, 23, 43, 19, '8', 7),
(56, 6, 23, 44, 19, '7', 8),
(57, 6, 21, 34, 20, '7', 6),
(58, 6, 21, 35, 20, '8', 9),
(59, 6, 21, 36, 20, '8', 7),
(60, 6, 21, 33, 20, '6', 8),
(61, 6, 22, 37, 20, '7', 6),
(62, 6, 22, 38, 20, '8', 9),
(63, 6, 22, 39, 20, '9', 8),
(64, 6, 22, 40, 20, '7', 8),
(65, 6, 23, 41, 20, '7', 8),
(66, 6, 23, 42, 20, '8', 7),
(67, 6, 23, 43, 20, '7', 9),
(68, 6, 23, 44, 20, '9', 8),
(69, 6, 21, 34, 21, '10', 7),
(70, 6, 21, 35, 21, '7', 8),
(71, 6, 21, 36, 21, '8', 7),
(72, 6, 21, 33, 21, '8', 8),
(73, 6, 22, 38, 21, '8', 7),
(74, 6, 22, 39, 21, '8', 8),
(75, 6, 22, 40, 21, '8', 7),
(76, 6, 23, 41, 21, '7', 6),
(77, 6, 23, 42, 21, '6', 7),
(78, 6, 23, 43, 21, '7', 6),
(79, 6, 23, 44, 21, '6', 7),
(80, 6, 22, 37, 21, NULL, 7),
(81, 6, 21, 34, 22, '1', 10),
(82, 6, 21, 35, 22, '1', 10),
(83, 6, 21, 36, 22, '1', 9),
(84, 6, 21, 33, 22, '1', 10),
(85, 6, 22, 37, 22, '5', 4),
(86, 6, 22, 38, 22, '3', 5),
(87, 6, 22, 39, 22, '1', 9),
(88, 6, 22, 40, 22, '3', 9),
(89, 6, 23, 41, 22, '2', 3),
(90, 6, 23, 42, 22, '10', 8),
(91, 6, 23, 43, 22, '8', 10),
(92, 6, 23, 44, 22, '1', 10),
(93, 6, 21, 34, 18, '10', 10),
(94, 6, 21, 35, 18, '10', 10),
(95, 6, 21, 36, 18, '10', 10),
(96, 6, 21, 33, 18, '10', 10),
(97, 6, 22, 37, 18, '10', 10),
(98, 6, 22, 38, 18, '10', 10),
(99, 6, 22, 39, 18, '10', 10),
(100, 6, 22, 40, 18, '10', 10),
(101, 6, 23, 41, 18, '10', 10),
(102, 6, 23, 42, 18, '10', 10),
(103, 6, 23, 43, 18, '10', 10),
(104, 6, 23, 44, 18, '10', 10),
(105, 6, 21, 34, 23, '1', 2),
(106, 6, 21, 35, 23, '3', 4),
(107, 6, 21, 36, 23, '5', 6),
(108, 6, 21, 33, 23, '7', 8),
(109, 6, 22, 37, 23, '10', 9),
(110, 6, 22, 38, 23, '8', 7),
(111, 6, 22, 39, 23, '6', 5),
(112, 6, 22, 40, 23, '4', 3),
(113, 6, 23, 41, 23, '2', 3),
(114, 6, 23, 42, 23, '2', 3),
(115, 6, 23, 43, 23, '4', 3),
(116, 6, 23, 44, 23, '4', 5),
(117, NULL, NULL, 45, 18, '10', 10),
(118, NULL, NULL, 46, 18, '10', 10),
(119, NULL, NULL, 47, 18, '10', 10),
(120, NULL, NULL, 48, 18, '10', 10);

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_penilai`
--

CREATE TABLE `kegiatan_penilai` (
  `id` int(11) NOT NULL,
  `id_kegiatan` int(11) DEFAULT NULL,
  `id_penilai_peran` int(11) DEFAULT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `divisi` varchar(255) DEFAULT NULL,
  `departemen` varchar(255) DEFAULT NULL,
  `uraian_deskripsi` text,
  `status_penilaian` int(11) DEFAULT '0',
  `status_hitung` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan_penilai`
--

INSERT INTO `kegiatan_penilai` (`id`, `id_kegiatan`, `id_penilai_peran`, `id_pegawai`, `jabatan`, `divisi`, `departemen`, `uraian_deskripsi`, `status_penilaian`, `status_hitung`) VALUES
(2, 2, 1, 9, 'Jabatan A', 'Divisi A', 'Departemen A', NULL, 0, 1),
(3, 2, 2, 30, 'Jabatan B', 'Divisi C', 'Departemen C', NULL, 0, 1),
(6, 3, 1, 7, 'Jabatan B', 'Divisi B', 'Departemen B', NULL, 0, 1),
(7, 4, 1, 8, 'Jabatan C', 'Divisi C', 'Departemen C', NULL, 0, 1),
(8, 2, 3, 57, 'Jabatan C', 'Divisi E', 'Departemen E', NULL, 0, 1),
(11, 5, 1, 3, 'Jabatan A', 'Unit A', 'Instansi A', NULL, 0, 1),
(12, 5, 2, 7, 'Jabatan B', 'Divisi C', 'Departemen A', NULL, 0, 1),
(13, 5, 3, 8, 'Jabatan C', 'Divisi C', 'Departemen E', NULL, 0, 1),
(14, 5, 4, 9, 'Jabatan A', 'Unit A', 'Instansi A', NULL, 0, 1),
(15, 5, 2, 10, 'Jabatan A', 'Unit A', 'Instansi A', NULL, 0, 1),
(16, 5, 4, 12, 'Jabatan A', 'Divisi A', 'Departemen E', NULL, 0, 1),
(18, 6, 1, 92, 'Kasubbid Pengembangan Instrumen', 'Bidang PKKA', 'PKP2A I LAN', 'tes 13', 1, 0),
(19, 6, 2, 14, 'Kabid PKKA', 'Bidang PKKA', 'PKP2A I LAN', NULL, 1, 1),
(20, 6, 3, 57, 'Kasubbid DIHP', 'Bidang PKKA', 'PKP2A I LAN', NULL, 1, 1),
(21, 6, 3, 93, 'Kasubbid Penyelenggaraan dan Penilaian', 'Bidang PKKA', 'PKP2A I LAN', NULL, 1, 1),
(22, 6, 4, 106, 'Pengelola Penilaian ', 'Bidang PKKA', 'PKP2A I LAN', NULL, 1, 0),
(23, 6, 4, 91, 'Assessor SDM Aparatur Muda', 'Bidang PKKA', 'PKP2A I LAN', NULL, 1, 1),
(25, 7, 1, 26, 'Peneliti', '1', 'PKP2A LAN Bandung', NULL, 0, 1),
(27, 8, 1, 14, '', '', '', NULL, 0, 1),
(28, 6, 4, 9, '', '', '', NULL, 0, 0),
(29, 6, 4, 51, '2313', '', '', NULL, 0, 1),
(30, 7, 3, 92, '', '', '', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_status`
--

CREATE TABLE `kegiatan_status` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan_status`
--

INSERT INTO `kegiatan_status` (`id`, `nama`) VALUES
(1, 'Aktif'),
(2, 'Non-Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `kompetensi`
--

CREATE TABLE `kompetensi` (
  `id` int(11) NOT NULL,
  `id_kompetensi_jenis` int(11) DEFAULT NULL,
  `level` int(11) NOT NULL,
  `uraian` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kompetensi`
--

INSERT INTO `kompetensi` (`id`, `id_kompetensi_jenis`, `level`, `uraian`) VALUES
(1, 1, 1, 'Menunjukkan komitmen dan dapat dipercaya untuk melaksanakan tugas organisasi.'),
(3, 1, 2, 'Berdedikasi dan konsisten dalam melaksanakan tugas organisasi'),
(4, 1, 3, 'Menerapkan nilai dan etika kerja di organisasi serta berupaya memeliharanya sehingga berdampak positif pada lingkungan kerjanya.'),
(5, 1, 4, 'Mendorong rekan kerja dan anak buah untuk menerapkan etika organisasi secara konsisten'),
(6, 1, 5, 'Mewujudkan organisasi yang memiliki integritas dengan mendorong anggota organisasi untuk menerapkan nilai dan etika organisasi secara berkesinambungan'),
(7, 2, 1, 'Mengidentifikasi kebutuhan belajar yang diperlukan untuk meningkatkan kompetensi pribadi dalam melaksanakan tugas'),
(8, 2, 2, 'Mengidentifikasi peluang pembelajaran dalam rangka meningkatkan efektivitas tugas yang menjadi tanggung jawabnya'),
(9, 2, 3, 'Mencari peluang pembelajaran agar dapat berkontribusi bagi lingkungan kerja'),
(10, 2, 4, 'Menyelaraskan upaya pengembangan diri sesuai dengantujuan dan sasaran organisasi'),
(11, 2, 5, 'Mengembangkan  diri secara antisipatif dengan mempertimbangkan perubahan di lingkungan eksternal organisasi'),
(12, 3, 1, 'Memahami struktur formal organisasi'),
(13, 3, 2, 'Menerapkan pemahaman mengenai organisasi dalam pekerjaan'),
(14, 3, 3, 'Memahami dan memanfaatkan budaya organisasi'),
(15, 3, 4, 'Memahami isu/persoalan aktualyang berkembang dan mengantisipasi masalah potensial dalam organisasi'),
(16, 3, 5, 'Memahami isu strategik yang berdampak luas pada organisasi'),
(17, 4, 1, 'Melaksanakan tugas dengan merujuk pada standar kualitas yang berlaku dalam unit kerjanya'),
(18, 4, 2, 'Menunjukkan upaya untuk meningkatkan kualitas kerja yang menjadi tanggung jawabnya.'),
(19, 4, 3, 'Mengevaluasi standar kualitas kerja dan mengupayakan perbaikan di lingkungan unit kerjanya'),
(20, 4, 4, 'Menyempurnakan sistem dan mekanisme kerja untuk mencapai standar kualitas kerja yang lebih tinggi'),
(21, 4, 5, 'Mewujudkan budaya organisasi yang berorientasi pada kualitas.'),
(22, 5, 1, 'Terbuka terhadap ide dan sudut pandang dari pihak lain'),
(23, 5, 2, 'Menggali alternatif ide/gagasan untuk diterapkan dalam menangani suatu permasalahan'),
(24, 5, 3, 'Menentukan ide/gagasan untuk menghadapi situasi dan kondisi yang ada dengan mempertimbangkan alternatif yang tersedia'),
(25, 5, 4, 'Menghasilkan ide/gagasan baru yang relevan dengan situasi dan kondisi'),
(26, 5, 5, 'Menerapkan ide/gagasan baru yang relevan dengan memperhatikan kepentingan yang lebih luas.'),
(27, 6, 1, 'Menindaklanjuti kebutuhan pemangku kepentingansesuai prosedur dan standar pelayanan'),
(28, 6, 2, 'Bertanggung jawab secara pribadi dalam memenuhi kebutuhan dan menangani keluhan pemangku kepentingan'),
(29, 6, 3, 'Bertindak proaktif mengidentifikasi kebutuhan pemangku kepentingan dan mengevaluasi  efektivitas pemenuhannya'),
(30, 6, 4, 'Membina hubungan kemitraan yang saling memberi manfaat dengan pemangku kepentingan untuk mendukung terciptanya pelayanan jangka panjang'),
(31, 6, 5, 'Mewujudkan budaya organisasi yang berfokus pada pelayanan'),
(32, 7, 1, 'Mampu mengidentifikasi berbagai gejala yang terdapat dalam masalah'),
(33, 7, 2, 'Menggali informasi dari berbagai sumber untuk menambah pemahaman terhadap masalah'),
(34, 7, 3, 'Mengidentifikasi keterkaitan antar gejala masalah'),
(35, 7, 4, 'Menggunakan metode/pendekatan konseptual sebagai dasar dalam memahami masalah dari sudut pandang yang lebih luas'),
(36, 7, 5, 'Berpikir sistemik dalam menelaah masalah dan menyusun konsep'),
(37, 8, 1, 'Sigap dalam mengambil keputusan'),
(38, 8, 2, 'Membuat keputusan sederhana'),
(39, 8, 3, 'Mengembangkan alternatif pemecahan masalah yang relevan, berdasarkan data faktual'),
(40, 8, 4, 'Mengambil keputusan dengan mempertimbangkan berbagai aspek penting masalah'),
(41, 8, 5, 'Membuat keputusan strategik dengan mempertimbangkan -konsekuensi serta mengembangkan tindakan mitigasinya'),
(42, 9, 1, 'Melakukan tugas dengan mengikuti standar yang ditetapkan organisasi'),
(43, 9, 2, 'Membuat jadwal kegiatan untuk menuntaskan tugas yang dilimpahkan kepadanya'),
(44, 9, 3, 'Menyusun rangkaian kegiatan dengan mempertimbangkan skala prioritas'),
(45, 9, 4, 'Mengendalikan setiap tahap kegiatan agar dapat berjalan sesuai dengan yang direncanakan'),
(46, 9, 5, 'Menetapkan langkah antisipatif untuk mengatasi kendala yang berpotensi muncul'),
(47, 10, 1, 'Mampu bekerja dan bertindak sesuai dengan peran atau posisi yang diemban'),
(48, 10, 2, 'Mampu merespon secara positif perbedaan maupun perubahan yang terjadi di lingkungan kerja'),
(49, 10, 3, 'Mampu menetapkan tindakan yang efektif ketika menghadapi perubahan'),
(50, 10, 4, 'Mampu menetapkan sejumlah tindakan yang efektif dalam situasi kerja yang mengandung ketidakpastian'),
(51, 10, 5, 'Mendorong tumbuhnya perilaku adaptif terhadap perbedaan maupun perubahan di lingkungan organisasi'),
(52, 11, 1, 'Menyimak informasi dari pihak lain dan dapat memberikan tanggapan yang relevan dalam konteks komunikasi interpersonal'),
(53, 11, 2, 'Menyampaikan secara aktif dan jelas informasi dan hasil pemikirannya dalam forum berskala kecil'),
(54, 11, 3, 'Mengembangkan sikap dan gaya penyampaian gagasan yang efektif, baik secara lisan maupun tertulis, dalam konteks koordinasi antar unit'),
(55, 11, 4, 'Menyampaikan hasil pemikiran secara jelas dalam bentuk tulisan yang terstruktur (proposal) dan mempresentasikannya dalam forum. '),
(56, 11, 5, 'Menguasai teknik komunikasi dan presentasi, serta aktif menjalin komunikasi di dalam/antar organisasi'),
(57, 12, 1, 'Berpartisipasi dalam tim'),
(58, 12, 2, 'Menciptakan suasana partisipatif dalam tim'),
(59, 12, 3, 'Berperan dalam  meningkatkan efektivitas kerja tim '),
(60, 12, 4, 'Membangun sinergi antar tim kerja'),
(61, 12, 5, 'Mewujudkan budaya kerjasama yang efektif, baik di internal tim kerja maupun antar tim kerja dalam organisasi'),
(62, 13, 1, 'Menyampaikan pemikiran kepada orang lain terkait upaya pencapaian tujuan'),
(63, 13, 2, 'Mempengaruhi atau mengarahkan orang lain sesuai batasan kewenangan formal'),
(64, 13, 3, 'Mengelola informasi dan stimulus sekitar sebagai dasar mempengaruhi atau menggalang komitmen dari orang lain'),
(65, 13, 4, 'Membangun situasi kerja yang kondusif'),
(66, 13, 5, 'Menggunakan strategi yang kompleks dalam membangun komitmen berkelanjutan'),
(67, 14, 1, 'Mampu melakukan bimbingan teknis untuk membantu orang lain'),
(68, 14, 2, 'Mengenali kompetensi anak buah atau pihak lain dan membantu mereka untuk dapat memanfaatkannya secara efektif dalam pekerjaan'),
(69, 14, 3, 'Mengoptimalkan pemberdayaan anak buah atau pihak lain'),
(70, 14, 4, 'Membuat program pengembangan kompetensi yang sistematik'),
(71, 14, 5, 'Melakukan pengembangan dengan perspektif jangka panjang'),
(72, 15, 1, 'Berorientasi jangka pendek'),
(73, 15, 2, 'Memahami dan menyesuaikan tindakan dengan visi, misi, serta tujuan organisasi'),
(74, 15, 3, 'Memahami kondisi organisasi secara komprehensif untuk mengidentifikasi kebutuhan di masa yang mendatang'),
(75, 15, 4, 'Mengembangkan pemikiran strategik guna meningkatkan kapabilitas internal untuk mendukung pencapaian visi organisasi\r\n'),
(76, 15, 5, 'Memformulasikan visi dan strategi organisasi'),
(77, 16, 1, 'Mengelola tugas pribadi untuk memenuhi standar kinerja'),
(78, 16, 2, 'Menyusun rencana kerja sesuai dengan rencana operasional yang telah ada'),
(79, 16, 3, 'Mengelola pelaksanaan kerja unit dengan mempertimbangkan kapabilitas unit dalam mencapai target yang ditetapkan'),
(80, 16, 4, 'Mengintegrasikan dan mengevaluasi perencanaan untuk mendukung tujuan satuan kerja'),
(81, 16, 5, 'Menyusun perencanaan strategis dengan mempertimbangkan sinergisitas operasional dalam pelaksanaannya'),
(82, 17, 1, 'Menjalin dan mempertahankan hubungan dengan rekan kerja serta memanfaatkannya untuk menyelesaikan tugas pribadi'),
(83, 17, 2, 'Menjalin dan mempertahankan hubungan dengan unit kerja lain, serta memanfaatkannya untuk pelaksanaan/penyelesaian  tugas unit kerja'),
(84, 17, 3, 'PENGEMBANGAN JEJARING KERJA (PJK) Level 3 : Mempertahankan jejaring kerja dengan pemangku kepentingan baik dari dalam atau luar organisasi'),
(85, 17, 4, 'Membangun dan memperluas jejaring kerja dengan pihak eksternal untuk mendukung kinerja organisasi'),
(86, 17, 5, 'Menjaga dan meningkatkan intensitas hubungan yang telah terbentuk dengan instansi lain'),
(87, 18, 1, 'Menyadari perlunya perubahan'),
(88, 18, 2, 'Melakukan upaya untuk memulai perubahan'),
(89, 18, 3, 'Mengelola proses perubahan'),
(90, 18, 4, 'Melakukan evaluasi dan perbaikan terhadap proses perubahan yang telah dilakukan'),
(91, 18, 5, 'Menanamkan  nilai-nilai, sikap  dan budaya  sesuai  dengan  dinamika perubahan'),
(92, 19, 1, 'Memperlihatkan sikap kooperatif dalam menghadapi pihak yang terlibat konflik'),
(93, 19, 2, ' Mampu menyimak kebutuhan semua pihak yang bertikai dan tidak berpihak'),
(94, 19, 3, 'Mampu mengajak pihak yang terlibat -konflik untuk memahami persoalan secara lebih objektif'),
(95, 19, 4, 'Mengupayakan kesepakatan yang saling menguntungkan (win-win solution)'),
(96, 19, 5, 'Mengubah konflik menjadi situasi yang produktif '),
(97, 20, 1, 'Menjalin komunikasi dua arah'),
(98, 20, 2, 'Mengakomodasi kepentingan pihak lain'),
(99, 20, 3, 'Mempersuasi pihak lain agar mendukung kepentingan yang disampaikan'),
(100, 20, 4, 'Berkompromi untuk mencapai kesepakatan terkait berbagai kepentingan'),
(101, 20, 5, 'Berkolaborasi untuk mencapai kesepakatan yang menguntungkan kedua belah pihak');

-- --------------------------------------------------------

--
-- Table structure for table `kompetensi_jenis`
--

CREATE TABLE `kompetensi_jenis` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kompetensi_jenis`
--

INSERT INTO `kompetensi_jenis` (`id`, `nama`) VALUES
(1, 'INTEGRITAS (Int)'),
(2, 'PEMBELAJARAN BERKELANJUTAN (PB)'),
(3, 'KESADARAN BERORGANISASI (KB)'),
(4, 'BERORIENTASI PADA KUALITAS (BpK)'),
(5, 'INOVASI (INO)'),
(6, 'PERHATIAN KEPADA PEMANGKU KEPENTINGAN (PPK)'),
(7, 'BERPIKIR ANALITIS (BA)'),
(8, 'PENGAMBILAN KEPUTUSAN (PK)'),
(9, 'PENGELOLAAN DIRI (PD)'),
(10, 'FLEKSIBILITAS KERJA (FK)'),
(11, 'KOMUNIKASI ORGANISASI (KmO)'),
(12, 'KERJASAMA TIM (KT)'),
(13, 'KEPEMIMPINAN (Kp)'),
(14, 'MENGEMBANGKAN ORANG LAIN (MOL)'),
(15, 'BERORIENTASI STRATEGIS (BS)'),
(16, 'PERENCANAAN DAN PENGELOLAAN (PP)'),
(17, 'PENGEMBANGAN JEJARING KERJA (PJK)'),
(18, 'MANAJEMEN PERUBAHAN (MP)'),
(19, 'MANAJEMEN KONFLIK (MK)'),
(20, 'NEGOSIASI (Neg)');

-- --------------------------------------------------------

--
-- Table structure for table `kompetensi_old`
--

CREATE TABLE `kompetensi_old` (
  `id` int(11) NOT NULL,
  `uraian` text NOT NULL,
  `level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kompetensi_old`
--

INSERT INTO `kompetensi_old` (`id`, `uraian`, `level`) VALUES
(1, 'INTEGRITAS (Int) Level 1 : Menunjukkan komitmen dan dapat dipercaya untuk melaksanakan tugas organisasi.', 0),
(3, 'INTEGRITAS (Int) Level 2 : Berdedikasi dan konsisten dalam melaksanakan tugas organisasi', 0),
(4, 'INTEGRITAS (Int) Level 3 : Menerapkan nilai dan etika kerja di organisasi serta berupaya memeliharanya sehingga berdampak positif pada lingkungan kerjanya.', 0),
(5, 'INTEGRITAS (Int) Level 4 : Mendorong rekan kerja dan anak buah untuk menerapkan etika organisasi secara konsisten', 0),
(6, 'INTEGRITAS (Int) Level 5 : Mewujudkan organisasi yang memiliki integritas dengan mendorong anggota organisasi untuk menerapkan nilai dan etika organisasi secara berkesinambungan', 0),
(7, 'PEMBELAJARAN BERKELANJUTAN (PB) Level 1 : Mengidentifikasi kebutuhan belajar yang diperlukan untuk meningkatkan kompetensi pribadi dalam melaksanakan tugas', 0),
(8, 'PEMBELAJARAN BERKELANJUTAN (PB) Level 2 : Mengidentifikasi peluang pembelajaran dalam rangka meningkatkan efektivitas tugas yang menjadi tanggung jawabnya', 0),
(9, 'PEMBELAJARAN BERKELANJUTAN (PB) Level 3 : Mencari peluang pembelajaran agar dapat berkontribusi bagi lingkungan kerja', 0),
(10, 'PEMBELAJARAN BERKELANJUTAN (PB) Level 4 : Menyelaraskan upaya pengembangan diri sesuai dengantujuan dan sasaran organisasi', 0),
(11, 'PEMBELAJARAN BERKELANJUTAN (PB) Level 5 : Mengembangkan  diri secara antisipatif dengan mempertimbangkan perubahan di lingkungan eksternal organisasi', 0),
(12, 'KESADARAN BERORGANISASI (KB) Level 1 : Memahami struktur formal organisasi', 0),
(13, 'KESADARAN BERORGANISASI (KB) Level 2 : Menerapkan pemahaman mengenai organisasi dalam pekerjaan', 0),
(14, 'KESADARAN BERORGANISASI (KB) Level 3 : Memahami dan memanfaatkan budaya organisasi', 0),
(15, 'KESADARAN BERORGANISASI (KB) Level 4 : Memahami isu/persoalan aktualyang berkembang dan mengantisipasi masalah potensial dalam organisasi', 0),
(16, 'KESADARAN BERORGANISASI (KB) Level 5 : Memahami isu strategik yang berdampak luas pada organisasi', 0),
(17, 'BERORIENTASI PADA KUALITAS (BpK) Level 1 : Melaksanakan tugas dengan merujuk pada standar kualitas yang berlaku dalam unit kerjanya', 0),
(18, 'BERORIENTASI PADA KUALITAS (BpK) Level 2 : Menunjukkan upaya untuk meningkatkan kualitas kerja yang menjadi tanggung jawabnya.', 0),
(19, 'BERORIENTASI PADA KUALITAS (BpK) Level 3 : Mengevaluasi standar kualitas kerja dan mengupayakan perbaikan di lingkungan unit kerjanya', 0),
(20, 'BERORIENTASI PADA KUALITAS (BpK) Level 4 : Menyempurnakan sistem dan mekanisme kerja untuk mencapai standar kualitas kerja yang lebih tinggi', 0),
(21, 'BERORIENTASI PADA KUALITAS (BpK) Level 5 : Mewujudkan budaya organisasi yang berorientasi pada kualitas.', 0),
(22, 'INOVASI (INO) Level 1 : Terbuka terhadap ide dan sudut pandang dari pihak lain', 0),
(23, 'INOVASI (INO) Level 2 : Menggali alternatif ide/gagasan untuk diterapkan dalam menangani suatu permasalahan', 0),
(24, 'INOVASI (INO) Level 3 : Menentukan ide/gagasan untuk menghadapi situasi dan kondisi yang ada dengan mempertimbangkan alternatif yang tersedia', 0),
(25, 'INOVASI (INO) Level 4 : Menghasilkan ide/gagasan baru yang relevan dengan situasi dan kondisi', 0),
(26, 'INOVASI (INO) Level 5 : Menerapkan ide/gagasan baru yang relevan dengan memperhatikan kepentingan yang lebih luas.', 0),
(27, 'PERHATIAN KEPADA PEMANGKU KEPENTINGAN (PPK) Level 1 : Menindaklanjuti kebutuhan pemangku kepentingansesuai prosedur dan standar pelayanan', 0),
(28, 'PERHATIAN KEPADA PEMANGKU KEPENTINGAN (PPK) Level 2 : Bertanggung jawab secara pribadi dalam memenuhi kebutuhan dan menangani keluhan pemangku kepentingan', 0),
(29, 'PERHATIAN KEPADA PEMANGKU KEPENTINGAN (PPK) Level 3 : Bertindak proaktif mengidentifikasi kebutuhan pemangku kepentingan dan mengevaluasi  efektivitas pemenuhannya', 0),
(30, 'PERHATIAN KEPADA PEMANGKU KEPENTINGAN (PPK) Level 4 : Membina hubungan kemitraan yang saling memberi manfaat dengan pemangku kepentingan untuk mendukung terciptanya pelayanan jangka panjang', 0),
(31, 'PERHATIAN KEPADA PEMANGKU KEPENTINGAN (PPK) Level 5 : Mewujudkan budaya organisasi yang berfokus pada pelayanan', 0),
(32, 'BERPIKIR ANALITIS (BA) Level 1 : Mampu mengidentifikasi berbagai gejala yang terdapat dalam masalah', 0),
(33, 'BERPIKIR ANALITIS (BA) Level 2 : Menggali informasi dari berbagai sumber untuk menambah pemahaman terhadap masalah', 0),
(34, 'BERPIKIR ANALITIS (BA) Level 3 : Mengidentifikasi keterkaitan antar gejala masalah', 0),
(35, 'BERPIKIR ANALITIS (BA) Level 4 : Menggunakan metode/pendekatan konseptual sebagai dasar dalam memahami masalah dari sudut pandang yang lebih luas', 0),
(36, 'BERPIKIR ANALITIS (BA) Level 5 : Berpikir sistemik dalam menelaah masalah dan menyusun konsep', 0),
(37, 'PENGAMBILAN KEPUTUSAN (PK) Level 1 : Sigap dalam mengambil keputusan', 0),
(38, 'PENGAMBILAN KEPUTUSAN (PK) Level 2 : Membuat keputusan sederhana', 0),
(39, 'PENGAMBILAN KEPUTUSAN (PK) Level 3 : Mengembangkan alternatif pemecahan masalah yang relevan, berdasarkan data faktual', 0),
(40, 'PENGAMBILAN KEPUTUSAN (PK) Level 4 : Mengambil keputusan dengan mempertimbangkan berbagai aspek penting masalah', 0),
(41, 'PENGAMBILAN KEPUTUSAN (PK) Level 5 : Membuat keputusan strategik dengan mempertimbangkan -konsekuensi serta mengembangkan tindakan mitigasinya', 0),
(42, 'PENGELOLAAN DIRI (PD) Level 1 : Melakukan tugas dengan mengikuti standar yang ditetapkan organisasi', 0),
(43, 'PENGELOLAAN DIRI (PD) Level 2 : Membuat jadwal kegiatan untuk menuntaskan tugas yang dilimpahkan kepadanya', 0),
(44, 'PENGELOLAAN DIRI (PD) Level 3 : Menyusun rangkaian kegiatan dengan mempertimbangkan skala prioritas', 0),
(45, 'PENGELOLAAN DIRI (PD) Level 4 : Mengendalikan setiap tahap kegiatan agar dapat berjalan sesuai dengan yang direncanakan', 0),
(46, 'PENGELOLAAN DIRI (PD) Level 5 : Menetapkan langkah antisipatif untuk mengatasi kendala yang berpotensi muncul', 0),
(47, 'FLEKSIBILITAS KERJA (FK) Level 1 : Mampu bekerja dan bertindak sesuai dengan peran atau posisi yang diemban', 0),
(48, 'FLEKSIBILITAS KERJA (FK) Level 2 : Mampu merespon secara positif perbedaan maupun perubahan yang terjadi di lingkungan kerja', 0),
(49, 'FLEKSIBILITAS KERJA (FK) Level 3 : Mampu menetapkan tindakan yang efektif ketika menghadapi perubahan', 0),
(50, 'FLEKSIBILITAS KERJA (FK) Level 4 : Mampu menetapkan sejumlah tindakan yang efektif dalam situasi kerja yang mengandung ketidakpastian', 0),
(51, 'FLEKSIBILITAS KERJA (FK) Level 5 : Mendorong tumbuhnya perilaku adaptif terhadap perbedaan maupun perubahan di lingkungan organisasi', 0),
(52, 'KOMUNIKASI ORGANISASI (KmO) Level 1 : Menyimak informasi dari pihak lain dan dapat memberikan tanggapan yang relevan dalam konteks komunikasi interpersonal', 0),
(53, 'KOMUNIKASI ORGANISASI (KmO) Level 2 : Menyampaikan secara aktif dan jelas informasi dan hasil pemikirannya dalam forum berskala kecil', 0),
(54, 'KOMUNIKASI ORGANISASI (KmO) Level 3 : Mengembangkan sikap dan gaya penyampaian gagasan yang efektif, baik secara lisan maupun tertulis, dalam konteks koordinasi antar unit', 0),
(55, 'KOMUNIKASI ORGANISASI (KmO) Level 4 : Menyampaikan hasil pemikiran secara jelas dalam bentuk tulisan yang terstruktur (proposal) dan mempresentasikannya dalam forum. ', 0),
(56, 'KOMUNIKASI ORGANISASI (KmO) Level 5 : Menguasai teknik komunikasi dan presentasi, serta aktif menjalin komunikasi di dalam/antar organisasi', 0),
(57, 'KERJASAMA TIM (KT) Level 1 : Berpartisipasi dalam tim', 0),
(58, 'KERJASAMA TIM (KT) Level 2 : Menciptakan suasana partisipatif dalam tim', 0),
(59, 'KERJASAMA TIM (KT) Level 3 : Berperan dalam  meningkatkan efektivitas kerja tim ', 0),
(60, 'KERJASAMA TIM (KT) Level 4 : Membangun sinergi antar tim kerja', 0),
(61, 'KERJASAMA TIM (KT) Level 5 : Mewujudkan budaya kerjasama yang efektif, baik di internal tim kerja maupun antar tim kerja dalam organisasi', 0),
(62, 'KEPEMIMPINAN (Kp) Level 1 : Menyampaikan pemikiran kepada orang lain terkait upaya pencapaian tujuan', 0),
(63, 'KEPEMIMPINAN (Kp) Level 2 : Mempengaruhi atau mengarahkan orang lain sesuai batasan kewenangan formal', 0),
(64, 'KEPEMIMPINAN (Kp) Level 3 : Mengelola informasi dan stimulus sekitar sebagai dasar mempengaruhi atau menggalang komitmen dari orang lain', 0),
(65, 'KEPEMIMPINAN (Kp) Level 4 : Membangun situasi kerja yang kondusif', 0),
(66, 'KEPEMIMPINAN (Kp) Level 5 : Menggunakan strategi yang kompleks dalam membangun komitmen berkelanjutan', 0),
(67, 'MENGEMBANGKAN ORANG LAIN (MOL) Level 1 : Mampu melakukan bimbingan teknis untuk membantu orang lain', 0),
(68, 'MENGEMBANGKAN ORANG LAIN (MOL) Level 2 : \r\nMengenali kompetensi anak buah atau pihak lain dan membantu mereka untuk dapat memanfaatkannya secara efektif dalam pekerjaan', 0),
(69, 'MENGEMBANGKAN ORANG LAIN (MOL) Level 3 : Mengoptimalkan pemberdayaan anak buah atau pihak lain', 0),
(70, 'MENGEMBANGKAN ORANG LAIN (MOL) Level 4 : Membuat program pengembangan kompetensi yang sistematik', 0),
(71, 'MENGEMBANGKAN ORANG LAIN (MOL) Level 5 : Melakukan pengembangan dengan perspektif jangka panjang', 0),
(72, 'BERORIENTASI STRATEGIS (BS) Level 1 : Berorientasi jangka pendek', 0),
(73, 'BERORIENTASI STRATEGIS (BS) Level 2 : Memahami dan menyesuaikan tindakan dengan visi, misi, serta tujuan organisasi', 0),
(74, 'BERORIENTASI STRATEGIS (BS) Level 3 : Memahami kondisi organisasi secara komprehensif untuk mengidentifikasi kebutuhan di masa yang mendatang', 0),
(75, 'BERORIENTASI STRATEGIS (BS) Level 4 : Mengembangkan pemikiran strategik guna meningkatkan kapabilitas internal untuk mendukung pencapaian visi organisasi\r\n', 0),
(76, 'BERORIENTASI STRATEGIS (BS) Level 5 : Memformulasikan visi dan strategi organisasi', 0),
(77, 'PERENCANAAN DAN PENGELOLAAN (PP) Level 1 : Mengelola tugas pribadi untuk memenuhi standar kinerja', 0),
(78, 'PERENCANAAN DAN PENGELOLAAN (PP) Level 2 : Menyusun rencana kerja sesuai dengan rencana operasional yang telah ada', 0),
(79, 'PERENCANAAN DAN PENGELOLAAN (PP) Level 3 : Mengelola pelaksanaan kerja unit dengan mempertimbangkan kapabilitas unit dalam mencapai target yang ditetapkan', 0),
(80, 'PERENCANAAN DAN PENGELOLAAN (PP) Level 4 : Mengintegrasikan dan mengevaluasi perencanaan untuk mendukung tujuan satuan kerja', 0),
(81, 'PERENCANAAN DAN PENGELOLAAN (PP) Level 5 : Menyusun perencanaan strategis dengan mempertimbangkan sinergisitas operasional dalam pelaksanaannya', 0),
(82, 'PENGEMBANGAN JEJARING KERJA (PJK) Level 1 : Menjalin dan mempertahankan hubungan dengan rekan kerja serta memanfaatkannya untuk menyelesaikan tugas pribadi', 0),
(83, 'PENGEMBANGAN JEJARING KERJA (PJK) Level 2 : Menjalin dan mempertahankan hubungan dengan unit kerja lain, serta memanfaatkannya untuk pelaksanaan/penyelesaian  tugas unit kerja', 0),
(84, 'PENGEMBANGAN JEJARING KERJA (PJK) Level 3 : Mempertahankan jejaring kerja dengan pemangku kepentingan baik dari dalam atau luar organisasi', 0),
(85, 'PENGEMBANGAN JEJARING KERJA (PJK) Level 4 : Membangun dan memperluas jejaring kerja dengan pihak eksternal untuk mendukung kinerja organisasi', 0),
(86, 'PENGEMBANGAN JEJARING KERJA (PJK) Level 5 : Menjaga dan meningkatkan intensitas hubungan yang telah terbentuk dengan instansi lain', 0),
(87, 'MANAJEMEN PERUBAHAN (MP) Level 1 : Menyadari perlunya perubahan', 0),
(88, 'MANAJEMEN PERUBAHAN (MP) Level 2 : Melakukan upaya untuk memulai perubahan', 0),
(89, 'MANAJEMEN PERUBAHAN (MP) Level 3 : Mengelola proses perubahan', 0),
(90, 'MANAJEMEN PERUBAHAN (MP) Level 4 : Melakukan evaluasi dan perbaikan terhadap proses perubahan yang telah dilakukan', 0),
(91, 'MANAJEMEN PERUBAHAN (MP) Level 5 : Menanamkan  nilai-nilai, sikap  dan budaya  sesuai  dengan  dinamika perubahan', 0),
(92, 'MANAJEMEN KONFLIK (MK) Level 1 : Memperlihatkan sikap kooperatif dalam menghadapi pihak yang terlibat konflik', 0),
(93, 'MANAJEMEN KONFLIK (MK) Level 2 : Mampu menyimak kebutuhan semua pihak yang bertikai dan tidak berpihak', 0),
(94, 'MANAJEMEN KONFLIK (MK) Level 3 : Mampu mengajak pihak yang terlibat -konflik untuk memahami persoalan secara lebih objektif', 0),
(95, 'MANAJEMEN KONFLIK (MK) Level 4 : Mengupayakan kesepakatan yang saling menguntungkan (win-win solution)', 0),
(96, 'MANAJEMEN KONFLIK (MK) Level 5 : Mengubah konflik menjadi situasi yang produktif ', 0),
(97, 'NEGOSIASI (Neg) Level 1 : Menjalin komunikasi dua arah', 0),
(98, 'NEGOSIASI (Neg) Level 2 : Mengakomodasi kepentingan pihak lain', 0),
(99, 'NEGOSIASI (Neg) Level 3 : Mempersuasi pihak lain agar mendukung kepentingan yang disampaikan', 0),
(100, 'NEGOSIASI (Neg) Level 4 : Berkompromi untuk mencapai kesepakatan terkait berbagai kepentingan', 0),
(101, 'NEGOSIASI (Neg) Level 5 : Berkolaborasi untuk mencapai kesepakatan yang menguntungkan kedua belah pihak', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kompetensi_rincian`
--

CREATE TABLE `kompetensi_rincian` (
  `id` int(11) NOT NULL,
  `id_kompetensi` int(11) DEFAULT NULL,
  `uraian` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kompetensi_rincian`
--

INSERT INTO `kompetensi_rincian` (`id`, `id_kompetensi`, `uraian`) VALUES
(1, 1, 'Menyelesaikan tugas pokok jabatan dengan tepat waktu'),
(2, 1, 'Menyelesaikan tugas pokok jabatan dengan mengacu pada peraturan'),
(3, 1, 'Menghindari perilaku atau tindakan yang menyalahi aturan atau kode etik jabatan'),
(4, 1, 'Menyelesaikan sasaran kinerja yang telah disepakati'),
(5, 2, 'Melaksanakan tugas sesuai dengan aturan atau standar prosedur yang berlaku secara konsisten'),
(6, 2, 'Terbuka terhadap masukan saat terjadi kesalahan kerja di lingkup tangungungjawabnya'),
(7, 2, 'Memperbaiki kesalahan ketika terjadi kesalahan dalam pelaksanaan kerja sesuai tanggungjawab dan kewenangannya'),
(8, 2, 'Bertanggung jawab terhadap keputusan/tindakan yang berdampak pada kelangsungan pekerjaan di lingkup tugasnya'),
(10, 3, 'Melaksanakan tugas sesuai dengan aturan atau standar prosedur yang berlaku secara konsisten'),
(11, 3, 'Terbuka terhadap masukan saat terjadi kesalahan kerja di lingkup tangungungjawabnya'),
(12, 3, 'Memperbaiki kesalahan ketika terjadi kesalahan dalam pelaksanaan kerja sesuai tanggungjawab dan kewenangannya'),
(13, 3, 'Bertanggung jawab terhadap keputusan/tindakan yang berdampak pada kelangsungan pekerjaan di lingkup tugasnya'),
(14, 5, 'Mengajak orang-orang di lingkungan kerjanya untuk berkomitmen dalam menyelesaikan tugas secara konsisten'),
(15, 5, 'Memberikan umpan balik berupa penghargaan, kritik atau sanksi terhadap orang-orang di lingkungan kerjanya sesuai standar nilai dan etika yang berlaku'),
(17, 5, 'Menanggung konsekuensi atas kesalahan di lingkungan kerja yang menjadi tanggungjawabnya'),
(18, 6, 'Memberikan contoh nyata dalam bekerja untuk penerapan nilai dan etika yang berlaku secara konsisten'),
(19, 6, 'Mengajak semua anggota organisasi dalam berbagai kesempatan untuk menerapkan nilai dan etika organisasi'),
(20, 6, 'Mendiskusikan nilai-nilai atau etika bekerja di lingkungan organisasi sesuai perkembangan dan perubahan lingkungan strategis yang ada'),
(22, 7, 'Melakukan identifikasi terhadap kemampuan (kekuatan dan kelemahan diri) dalam bekerja'),
(23, 7, 'Meminta atasan untuk memberikan umpan balik atas pekerjaan yang ditangani'),
(24, 7, 'Menggali umpan balik dari rekan kerja atas pekerjaan yang ditangani'),
(25, 7, 'Terbuka terhadap perubahan di lingkup pekerjaan sebagai bagian dalam proses pembelajaran dalam organisasi'),
(26, 8, 'Menggali masukan untuk pengembangan diri berdasarkan saran dan masukan dari orang lain'),
(27, 8, 'Berbagi pengetahuan dalam rangka meningkatkan pengetahuan dan wawasan yang bermanfaat dalam lingkungan kerja'),
(28, 8, 'Menggali informasi mengenai program-program pengembangan kompetensi yang relevan dengan tugas'),
(30, 9, 'Aktif dalam mengikuti kesempatan pembelajaran yang diselenggarakan di lingkungan organisasinya'),
(31, 9, 'Terbuka terhadap cara atau metode baru dalam menunjang pelaksanaan tugas di lingkungan kerjanya'),
(32, 9, 'Membagikan pengetahuan yang didapatkan secara pribadi terkait pelaksanaan tugas kepada orang-orang di lingkungan kerjanya'),
(33, 9, 'Menerapkan pengetahuan yang didapatkan secara praktis bagi peningkatan kualitas di lingkungan kerjanya'),
(34, 10, 'Mencari berbagai informasi mengenai kesempatan pengembangan kemampuan kerja yang berkaitan dengan bidang kerja yang ditanganinya saat ini'),
(35, 10, 'Mengikuti forum-forum pembelajaran terkait profesi kebidangan yang dikuasainya untuk meningkatkan perannya bagi proses bisnis organisasi secara umum'),
(36, 10, 'Mengikuti diklat-diklat  dalam upaya pengembangan jabatan yang dikuasainya guna menambah nilai positif bagi kemajuan organisasi'),
(37, 10, 'Menunjukkan inisiatif untuk berbagi pengetahuan dalam forum baik skala kecil maupun besar di lingkungan organisasi terkait pengetahuan kebidangan yang dikuasai'),
(38, 11, 'Peka dan reaktif terhadap perubahan yang memberikan pengaruh positif bagi kemajuan organisasi'),
(39, 11, 'Mengembangkan kapasitas diri secara terarah sesuai dengan kebutuhan organisasi'),
(40, 11, 'Aktif mencari peluang pengembangan organisasi dengan melakukan studi banding ke organisasi lain'),
(41, 12, 'Memahami pola kerja yang ada dalam organisasi '),
(42, 12, 'Memahami peran, tugas dan posisinya dalam mekanisme kerja organisasi'),
(43, 12, 'Menerapkan aturan atau standar prosedur dalam berelasi secara formal dalam organisasi'),
(44, 12, 'Mengetahui arah dan target kerja baik secara individu maupun tim dalam mendukung kinerja organisasi'),
(45, 13, 'Melakukan koordinasi dengan unit kerja terkait sesuai dengan tugas dan peranan di dalam organisasi'),
(47, 13, 'Mengidentifikasi pihak-pihak yang berperan penting dalam organisasi dalam menunjang kelancaran tugas di lingkungannya'),
(48, 13, 'Berdiskusi secara informal dengan berbagai pihak di organisasi dalam konteks pelaksanaan tugas'),
(49, 14, 'Memahami arah dan misi dari organisasi melalui mekanisme kerja yang dilakukan selama ini'),
(50, 14, 'Memahami nilai-nilai yang ditetapkan organisasi dan perwujudannya dalam contoh perilaku praktis dan konkrit'),
(51, 14, 'Menerapkan nilai-nilai organisasi dalam menjalankan peran, fungsi dan hubungan kerjanya dengan pihak lain di organisasi'),
(52, 14, 'Memahami konsekuensi atau dampak hasil kerjanya bagi kelangsungan proses bisnis organisasi'),
(53, 14, 'Mengumpulkan informasi terkini mengenai kondisi organisasi yang berpengaruh terhadap kelancaran mekanisme kerja organisasi'),
(54, 15, 'Memahami peran pimpinan maupun pegawai yang memegang peran penting yang berpengaruh terhadap kelancaran kinerja'),
(55, 15, 'Memahami potensi permasalahan yang akan menghambat kinerja secara umum'),
(56, 15, 'Melakukan pendekatan melalui komunikasi untuk menjaga sinergi dan kekompakan dalam bekerja'),
(57, 15, 'Menunjukkan inisiatif terlibat dalam berbagai kegiatan bersama guna menjaga keeratan antar anggota organisasi'),
(59, 16, 'Mengumpulkan informasi aktual dari berbagai media di skala nasional maupun internasional sebagai bahan penguatan posisi strategis organisasi'),
(60, 16, 'Memelihara hubungan kerja dengan berbagai pihak diluar organisasi yang bisa mendatangkan kemanfaatan bagi organisasi'),
(61, 16, 'Mengikuti forum komunikasi antar lembaga dalam rangka mengantisipasi perubahan peran dan eksistensi organisasi kedepan'),
(62, 16, 'Mengembangkan jejaring relasi dengan berbagai pihak dalam rangka menaikkan peran strategis organisasi di mata publik'),
(63, 17, 'Menjalankan pekerjaan dengan teliti dan meminimalkan kesalahan dengan mengacu pada prosedur (SOP) yang ada'),
(64, 17, 'Menjalankan tugas dengan mengacu pada langkah-langkah teknis operasional sesuai arahan pimpinan'),
(65, 17, 'Menyelesaikan tugas yang menjadi tanggungjawabnya untuk mencapai standar minimal yang ditetapkan organisasi'),
(66, 18, 'Memperbaiki cara kerja yang sudah ada untuk memperoleh pola kerja yang lebih effektif'),
(67, 18, 'Menerapkan cara kerja baru yang lebih baik agar dapat diterapkan di pelaksanaan tugas'),
(68, 18, 'Meningkatkan kualitas kerja berdasarkan cara kerja baru yang dipelajari'),
(69, 18, 'Mengadopsi standar kualitas kerja unit lain yang lebih baik agar dapat diterapkan di pelaksanaan tugas pribadi'),
(70, 18, 'Menggali umpan balik atau masukan dari lingkungan kerjanyasebagai bahan evaluasi standar capaian'),
(71, 19, 'Meninjau ulang hasil kerjanya berdasar masukan pihak lain secara konsisten'),
(72, 19, 'Memodifikasi cara-cara tertentu diluar cara yang sudah ada untuk memperbaiki kualitas kerjanya secara konsisten'),
(73, 19, 'Meminta umpan balik tentang kualitas kerjanya ke para pemangku kepentingan di internal organisasi'),
(74, 19, 'Mengusulkan perbaikan cara kerja yang lebih baik dari yang sudah ada di lingkungan tugasnya agar diperoleh kualitas kerja yang lebih baik'),
(75, 20, 'Mengidentifikasi tahapan kerja yang berpotensi menyebabkan penurunan kualitas hasil kerja'),
(76, 20, 'Menyiapkan langkah-langkah antisipatif untuk menghindari terjadinya masalah yang dapat menimbulkan penurunan kualitas hasil kerja'),
(77, 20, 'Melakukan pemantauan secara periodik untuk menjamin capaian standar kualitas kerja di lingkungan kerjanya'),
(78, 20, 'Mengelola proses capaian kerja secara konsisten di lingkungan kerjanya dalam rangka perbaikan'),
(79, 21, 'Mengajak anggota organisasi untuk mengembangkan ide-ide baru di lingkungan organisasi dalam rangka meningkatkan kualitas kerja'),
(80, 21, 'Menciptakan sistem atau mekanisme yang mampu mendeteksi secara dini tren penurunan kualitas kerja di lingkungan organisasi'),
(81, 21, 'Menerapkan sistem reward dan punishment dalam rangka menumbuhkan semangat perbaikan standar kualitas kerja di lingkungan organisasi'),
(82, 21, 'Proaktif dalam menindaklanjuti ide-ide pengembangan standar kualitas kerja menjadi standar baku yang ditetapkan dalam skala makro organisasi'),
(83, 22, 'Terbuka terhadap masukan atau umpan balik dalam rangka perbaikan kinerjanya'),
(84, 22, 'Menunjukkan kemauan untuk mempelajari hal-hal baru dalam kaitannya dengan pelaksanaan tugas'),
(85, 22, 'Proaktif dalam situasi diskusi dilingkungan kerja dalam rangka mengatasi masalah bersama'),
(86, 22, 'Menerapkan cara-cara baru dalam konteks pelaksanaan tugas yang ditetapkan organisasi'),
(87, 23, 'Mengumpulkan gagasan atau ide baru untuk menangani permasalahan kerja di lingkungan tugasnya'),
(88, 23, 'Memanfaatkan pengalaman dan wawasan pribadinya untuk mengatasi tantangan atau permasalahan kerja yang ditangani'),
(89, 23, 'Berinisiatif untuk memberikan gagasan pemecahan masalah kepada orang-orang di lingkungan kerjanya'),
(90, 23, 'Menerapkan cara baru yang ditemukannya untuk menunjang pelaksanaan tugas pekerjaan individu agar lebih efektif dan efisien'),
(91, 24, 'Mengajak orang lain untuk memikirkan alternatif penanganan masalah/tantangan kerja secara konsisten'),
(92, 24, 'Menyusun langkah penyelesaian masalah berdasarkan cara baru dengan mempertimbangkan efek atau dampaknya bagi lingkungan kerja'),
(93, 24, 'Meneliti kesesuaian prosedur kerja yang ada dengan alternative gagasan baru ketika hendak menerapkan cara-cara baru dalam pekerjaan'),
(94, 24, 'Mengusulkan cara kerja baru di lingkungan tugasnya disertai upaya penjelasan yang memadai'),
(95, 25, 'Mengkaji ulang beberapa alternatif cara pemecahan masalah/tantangan di lingkungan organisasi untuk menentukan solusi praktis yang tepat'),
(96, 25, 'Menggali masukan atau alternatif ide inovatif dari orang lain di lingkungan organisasi yang dapat bermanfaat bagi proses bisnis secara umum'),
(97, 25, 'Menyusun rencana kerja praktis dalam rangka penerapan inovasi di lingkungan kerjanya dengan mempertimbangkan konsekuensi atau dampaknya'),
(98, 25, 'Mengintegrasikan beberapa ide/gagasan menjadi satu gagasan inovatif dan diterapkan untuk meningkatkan kinerja organisasi'),
(99, 26, 'Memantau penerapan inovasi bagi kemanfaatan proses bisnis organisasi'),
(100, 26, 'Mengevaluasi inovasi yang diterapkan dilingkungan organisasi dalam rangka perbaikan berkesinambungan'),
(101, 26, 'Menerjemahkan arah inovasi yang dibutuhkan organisasi dalam bentuk contoh-contoh praktis ke semua elemen organisasi'),
(102, 27, 'Menjalankan prosedur dan standar pelayanan yang ada dalam memberikan pelayanan'),
(103, 27, 'Memberikan penjelasan dan informasi dasar yang dibutuhkan kepada stakeholder'),
(104, 27, 'Mengajak komunikasi interaktif dengan dialog atau diskusi kepada stakeholder dalam konteks pelayanan atau keluhan atas pelayanan'),
(105, 27, 'Menunjukkan kesediaan untuk menampung umpan balik atau masukan dari stakeholder atas layanan yang diberikan'),
(106, 28, 'Inisiatif melayani para stakeholder'),
(107, 28, 'Proaktif dalam menanyakan kebutuhan stakeholder ketika proses pelayanan berlangsung'),
(108, 28, 'Memenuhi kebutuhan dan keluhan dari stakeholder sesuai kemampuan yang dimiliki'),
(109, 28, 'Melakukan komunikasi non-formal dengan stakeholder dalam rangka menggali umpan balik dari mereka'),
(110, 29, 'Menggali masukan atau umpan balik atas pelayanan yang diberikan kepada stakeholder'),
(111, 29, 'Mengidentifikasi kebutuhan aktual pelanggan melebihi dari standar pelayanan untuk meyakinkan kepuasan stakeholder'),
(112, 29, 'Melakukan pemantauan secara periodik dan sistematis atas pelayanan yang diberikan kepada stakeholder di lingkungan kerjanya'),
(113, 29, 'Mengkaji ulang cara-cara penerapan standar pelayanan dalam proses pelayanan untuk menjamin pelayanan yang lebih baik secara berkesinambungan'),
(114, 30, 'Membina hubungan positif dan konstruktif dengan stakeholder'),
(115, 30, 'Mengkomunikasikan berbagai informasi penting yang relevan dengan kebutuhan stakeholder di luar pelayanan yang diberikan oleh bidang yang dikuasainya'),
(116, 30, 'Memenuhi tuntutan kebutuhan stakeholder yang belum tercakup dalam standar pelayanan maupun prosedur pelayanan organisasi'),
(117, 30, 'Merumuskan model pelayanan yang mampu memberikan nilai kemanfaatan lebih bagi stakeholder '),
(118, 30, 'Mengadakan kegiatan forum komunikasi dengan para stakeholder organisasi'),
(119, 31, 'Menetapkan standar-standar pelayanan sebagai bagian standar kerja sehari hari agar anggota organisasi mampu memahami dan mempraktikannya'),
(120, 31, 'Mengadaptasi implementasi kebijakan skala nasional maupun internasional dalam rangka meningkatkan kualitas pelayanan organisasi'),
(121, 31, 'Mengikuti forum dalam skala luas dalam rangka merumuskan rencana strategis peningkatan peran organisasi dalam pelayanan publik'),
(122, 31, 'Merumuskan rencana strategis dalam mendayagunakan peran organisasi bagi peningkatan kualitas pelayanan birokrasi seluruh instansi publik'),
(124, 32, 'Memilah data atau informasi penting dan tidak penting terkait pekerjaannya'),
(125, 32, 'Menentukan data atau informasi yang diperlukan untuk menyelesaikan permasalahan'),
(126, 32, 'Mengenali permasalahan umum   terkait dengan pekerjaannya'),
(127, 33, 'Menelusuri informasi pendukung dalam rangka memahami permasalahan secara lebih mendalam'),
(128, 33, 'Mengumpulkan informasi dari narasumber yang tepat dalam rangka memahami persoalan secara lebih mendalam'),
(129, 33, 'Mengkaitkan informasi yang diperoleh dengan persoalan yang dihadapi dalam rangka menambah pemahaman.'),
(130, 34, 'Menjelaskan sebab akibat antar gejala permasalahan yang sedang dihadapi dalam tugas'),
(131, 34, 'Menelaah data atau informasi faktual dan membuat kesimpulan yang tepat'),
(132, 34, 'Mengkaitkan beberapa permasalahan yang memiliki substansi isi permasalahan yang berbeda'),
(133, 35, 'Menelaah permasalahan di lingkup unit kerjanya dari sudut pandang yang lebih luas dengan mengaitkan sumber daya pendukung seperti SDM, anggaran, cara kerja, perlengkapan dan kebijakan'),
(134, 35, 'Menggunakan metode tertentu untuk menelaah permasalahan di lingkup satuan kerjanya'),
(135, 35, 'Menggunakan metode analisis untuk mengintegrasikan berbagai aspek persoalan dalam rangka memahami masalah secara komprehensif'),
(136, 35, 'Menelusuri akar permasalahan yang terjadi di lingkup satuan kerjanya'),
(138, 36, 'Mengidentifikasi kondisi internal dan eksternal organisasi dan mengintegrasikan dalam sebuah rumusan konsep'),
(139, 36, 'Menjelaskan permasalahan yang terjadi di organisasi dan  dampaknya dari sisi internal dan eksternal organisasi'),
(140, 36, 'Menjelaskan model ataupun konsep yang dapat menjelaskan situasi permasalahan yang kompleks di dalam organisasi'),
(141, 37, 'Mengambil keputusan secara cepat walaupun minim informasi yang dijadikan bahan pertimbangan'),
(142, 37, 'Mengambil keputusan dengan menggunakan pengalaman pribadinya atau pengetahuan praktisnya'),
(143, 37, 'Menindaklanjuti permasalahan yang muncul terkait tugasnya secara satu persatu'),
(144, 38, 'Mengambil keputusan dengan berdasar aturan dan prosedur'),
(145, 38, 'Memberikan saran tindakan penyelesaian masalah di lingkup bidang tugasnya'),
(146, 38, 'Membuat keputusan dengan pertimbangan sederhana dan bersifat teknis operasional'),
(147, 39, 'Menyampaikan beberapa alternatif solusi yang relevan atas permasalahan yang terjadi'),
(148, 39, 'Memanfaatkan masukan dari narasumber atau para ahli untuk dijadikan pertimbangan dalam mengambil keputusan'),
(149, 39, 'Menggunakan informasi pendukung untuk memperkuat pertimbangan dalam mengambil keputusan'),
(150, 39, 'Mencari referensi dengan membaca buku literatur lainnya  untuk mengembangkan solusi.'),
(151, 40, 'Sigap mengambil keputusan berdasar sejumlah alternatif yang tersedia'),
(152, 40, 'Mengambil keputusan dengan mempertimbangkan kapabilitas organisasi dan dampaknya terhadap internal maupun eksternal organisasi'),
(153, 40, 'Menentukan alternatif pemecahan masalah yang paling tepat dengan mempertimbangkan kelebihan dan kekurangan yang menyertainya'),
(154, 41, 'Menentukan implikasi jangka panjang dari keputusan yang diambil '),
(155, 41, 'Membuat keputusan strategis dengan mempertimbangkan kapabilitas dan dampaknya pada setiap komponen organisasi'),
(156, 41, 'Menetapkan langkah antisipasi untuk meminimalisir resiko atau dampak negatif dari keputusan yang diambilnya'),
(157, 42, 'Mengerjakan tugas sesuai dengan perintah dari atasan'),
(158, 42, 'Memastikan kesesuaian antara pelaksanaan tugas dengan SOP'),
(160, 42, 'Melaksanakan tugas sesuai dengan tupoksi  yang sudah ditetapkan'),
(161, 43, 'Menyusun jadwal tugas secara mandiri dalam rangka menyelesaikan tugas sehari hari'),
(162, 43, 'Memeriksa dan mengatur jadwal kerja agar tidak berbenturan'),
(163, 43, 'Menyelesaikan tugas sesuai dengan tenggat waktu yang telah ditentukan'),
(164, 44, 'Mengidentifikasi prioritas kerja dalam lingkup tugasnya'),
(165, 44, 'Melaksanakan tugas berdasar prioritas penyelesaian waktu dan urgensi substansi tugas'),
(166, 44, 'Menentukan sumber daya (manusia, anggaran, sapras, teknik dsb) secara tepat untuk menyelesaikan tugas'),
(167, 45, 'Menentukan cara pengendalian dan sumber daya yang dibutuhkan untuk memperbaiki tahapan tugas yang tidak sesuai target'),
(168, 45, 'Menugaskan bawahan agar memperbaiki tahapan yang tidak sesuai target'),
(169, 45, 'Mengawasi setiap tahap pelaksanaan tugas di satuan kerjanya guna memastikan tugas selesai sesuai dengan target'),
(170, 45, 'Meminta bawahan/staf membuat laporan kemajuan secara periodik'),
(171, 46, 'Memprediksikan kemungkinan hambatan dan kendala yang akan muncul selama pelaksanaan tugas'),
(172, 46, 'Membuat sejumlah rencana tindakan untuk mengantisipasi kendala yang berpotensi muncul selama pelaksanaan tugas'),
(173, 46, 'Menentukan sumber daya yang diperlukan untuk mengatasi potensi kendala dan hambatan'),
(174, 47, 'Menjalankan tugas sesuai dengan tanggungjawab dan posisi jabatannya'),
(175, 47, 'Bertindak sesuai dengan norma dan etika jabatannya'),
(176, 47, 'Mengikuti pola hubungan sosial yang ada di lingkungan kerja'),
(177, 48, 'Menerima adanya perbedaan karakter personal di lingkungan kerjanya'),
(178, 48, 'Mempelajari tuntutan tugas yang baru dengan mencari referensi dari berbagai media yang relevan'),
(179, 48, 'Mempelajari tuntutan tugas baru dengan berdiskusi dengan rekan yang memiliki pengetahuan yang relevan'),
(180, 49, 'Memahami perubahan tuntutan tugas yang baru'),
(181, 49, 'Menentukan langkah kerja dan kebutuhan sumber daya untuk memenuhi tuntutan tugas baru'),
(182, 49, 'Memperbaiki/memodifikasi cara  kerja untuk mengantisipasi perubahan tuntutan tugas'),
(183, 49, 'Memanfaatkan perubahan sebagai sarana pembelajaran untuk memperbaiki kualitas hasil kerja '),
(184, 50, 'Mengevaluasi situasi krisis dalam pekerjaan yang menghambat pencapaian target kerja dan mengidentifikasi penyebabnya'),
(185, 50, 'Menunjukkan ketenangan diri ketika dihadapkan dengan perubahan yang mendadak dengan menyiapkan langkah-langkah untuk mengatasi dampak yang terjadi'),
(186, 50, 'Melakukan pekerjaan secara produktif (ada output yang dihasilkan) walaupun situasi kerja tidak menentu'),
(187, 51, 'Menunjukkan sikap tenang dalam menghadapi situasi kerja yang tidak menentu'),
(188, 51, 'Mengajak orang lain untuk memunculkan ide atau masukan baru guna mengatasi permasalahan yang timbul dari situasi kerja baru'),
(189, 51, 'Menugaskan bawahan untuk  menyiapkan alternatif langkah tindakan atau pemecahan masalah ketika terjadi perubahan situasi kerja'),
(190, 52, 'Menyampaikan informasi yang dapat dimengertioleh orang lain yang terkait dengan penyelesaian tugas di unitnya'),
(191, 52, 'Melaksanakan kegiatan surat menyurat sesuai tata naskah organisasi'),
(192, 52, 'Bertanya kepada orang lain untuk klarifikasi informasi yang diterima dari lawan bicara terkait dengan gagasan atau pendapat mereka'),
(193, 52, 'Memberikan tanggapan yang relevan atas pertanyaan yang diajukan terkait dengan pekerjaan'),
(194, 53, 'Memimpin dan memfasilitasi jalannya diskusi/rapat dalam tim kerja'),
(195, 53, 'Mengajak orang-orang di lingkungan kerja untuk mendiskusikan hasil pemikirannya'),
(196, 53, 'Menyusun laporan kegiatan, laporan evaluasi dan laporan tertulis lainnya dengan mengikuti sistematika penulisan laporan yang baku'),
(197, 53, 'Melakukan koordinasi dengan berbagai orang di lingkungan kerjanya'),
(198, 53, 'Mempresentasikan laporan tertulis kepada forum diskusi dengan bahasa yang mudah dipahami oleh orang lain dari berbagai kalangan'),
(200, 54, 'Memaparkan rancana/ langkah kerja unit, baik secara lisan maupun tertulis kepada unit kerja lain'),
(201, 54, 'Mempresentasikan gagasannya di hadapan sekelompok orang dengan menggunaan media komunikasi yang tepat'),
(202, 54, 'Menggunakan komunikasi nonverbal atau gaya penyampaian pendapat yang efektif'),
(203, 54, 'Memberikan pemaparan ide/gagasan disesuaikan dengan karakter pendengar sehingga mudah dipahami oleh berbagai kalangan'),
(204, 55, 'Memaparkan hasil pemikiran dengan sistematik sehingga mudah dimengerti publik'),
(206, 55, 'Berkomunikasi dengan pihak lain terkait koordinasi pelaksanaan tugas unit'),
(207, 55, 'Menyusun proposal atau laporan sesuai kaidah penulisan yang baku'),
(208, 55, 'Mengajak orang-orang didalam atau pun di luar unit kerjanya untuk berdiskusi dan saling bertukar informasi'),
(209, 56, 'Menguasai teknik presentasi sehingga mudah dipahami oleh publik'),
(210, 56, 'Membina komunikasi dengan pihak eksternal organisasi baik formal maupun informal'),
(211, 56, 'Menerjemahkan visi dan kebijakan organisasi kepada semua anggota organisasi dengan bahasa yang mudah dimengerti oleh semua kalangan'),
(212, 56, 'Memelihara jejaring komunikasi dengan pihak eksternal organisasi'),
(213, 57, 'Berpartisipasi dalam penyelesaian tugas tim'),
(214, 57, 'Menjalankan tugas sesuai dengan peran/tuntutan yang diberikan dalam kelompok kerjanya'),
(215, 57, 'Menyampaikan gagasan maupun pendapatnya kepada tim dalam rangka mencapai tujuan tim'),
(216, 57, 'Berbagi pengalaman dan pengetahuan baru kepada rekan kerja/kelompok'),
(217, 57, 'Menjalankan kesepakatan kelompok meskipun tidak sesuai dengan pendapat pribadi'),
(218, 58, 'Terbuka terhadap gagasan yang disampaikan rekan kerja yang memiliki sudut pandang berbeda'),
(219, 58, 'Memfasilitasi tim kerjanya dengan mempersilahkan mereka untuk menyampaikan pendapat masing-masing'),
(220, 58, 'Membantu rekan kerja/anggota tim yang mengalami kesulitan dalam menyelesaikan tugasnya '),
(221, 59, 'Mengelaborasi berbagai pendapat dan gagasan dari rekan timnya dalam rangka mencapai tujuan tim'),
(222, 59, 'Mengarahkan proses kerja tim dalam penyelesaian tugas'),
(223, 59, 'Memberikan solusi terhadap perbedaan pendapat dan perselisihan yang terjadi dalam tim kerja'),
(224, 60, 'Memotivasi anggota tim kerja untuk berkinerja lebih baik'),
(225, 60, 'Berinisiatif mengadakan kegiatan informal untuk menambah keakraban pada kelompok kerja'),
(227, 60, 'Mengintegrasikan berbagai kepentingan yang berbeda antara tim kerja dalam rangka mecapai tujuan organisasi'),
(228, 61, 'Membantu memberikan solusi yang sesuai dengan konteks permasalahan tim kerja'),
(229, 61, 'Mengintegrasikan berbagai tujuan dan sasaran strategis masing-masing tim dalam rangka mencapai visi organisasi '),
(230, 61, 'Mewujudkan suasana kerja organisasi yang kondusif'),
(231, 61, 'Mengarahkan seluruh tim dalam organisasi untuk menampilkan kinerja terbaik'),
(232, 62, 'Menyampaikan ide gagasan kepada orang lain dengan argumentasi/alasan yang logis'),
(233, 62, 'Memberikan arahan sederhana terkait pelaksanaan tugas kepada bawahan atau rekan satu tim'),
(234, 62, 'Menjelaskan pemikiran kepada bawahan atau rekan satu tim secara runtut'),
(235, 62, 'Berani menyampaikan pendapat meskipun berbeda dengan pendapat orang lain'),
(236, 63, 'Memberikan argumentasi yang logis dengan data dan informasi aktual pada saat berdiskusi'),
(237, 63, 'Memberikan pemahaman secara konsisten kepada orang lain walau berbeda pandangan'),
(238, 63, 'Menjelaskan cara pelaksanaan tugas kepada orang lain sesuai dengan tugas dan fungsi mereka'),
(239, 63, 'Mempertahankan pendapat dalam berbagai situasi dengan argumentasi yang logis dan sesuai fakta'),
(240, 64, 'Menyesuaikan pendekatan ke orang lain dengan mempertimbangkan kondisi dan karakter orang lain'),
(241, 64, 'Menyesuaikan gaya bicara yang berbeda terhadap orang lain yang memiliki karakter yang berbeda'),
(242, 64, 'Memberikan pekerjaan/tugas sesuai dengan kompetensi dan kapasitas dari bawahan '),
(243, 65, 'Menyatukan berbagai pendapat yang berbeda sesuai dengan konteks permasalahan yang ada'),
(244, 65, 'Melakukan diskusi secara formal dalam bentuk rapat dengan berbagai pihak'),
(245, 65, 'Melakukan diskusi secara informal untuk membahas permasalahan di unit kerja agar suasananya lebih terbuka'),
(246, 65, 'Mengalokasikan waktu khusus bagi bawahan untuk berdiskusi secara personal maupun kelompok untuk membahas kinerja mereka'),
(247, 65, 'Mengadakan rapat kerja untuk membahas permasalahan yang ada di unitnya'),
(248, 65, 'Mengadakan coffee morning bersama-sama dengan tim kerjanya sekaligus mendiskusikan masalah pekerjaan secara santai'),
(249, 66, 'Melakukan pemetaan kompetensi terhadap SDM yang ada untuk mengetahui kekuatan dan kelemahannya'),
(250, 66, 'Membuat talent pool pegawai sebagai pedoman pengelolaan SDM dalam organisasi'),
(251, 66, 'Melakukan pengembangan kompetensi SDM sesuai visi misi dan rencana strategis organisasi'),
(255, 66, 'Melakukan perubahan terhadap cara atau proses kerja sesuai tuntutan perubahan dalam rangka mencapai tujuan organisasi '),
(256, 66, 'Melakukan berbagai upaya dengan seluruh tim kerjanya untuk membangun kebersamaan'),
(258, 67, 'Memberikan arahan teknis terkait langkah penyelesaian tugas kepada orang lain'),
(259, 67, 'Melakukan koreksi atas hasil kerja orang lain mengacu pada standar teknis yang berlaku'),
(260, 67, 'Memberikan umpan balik atas hasil pekerjaan orang lain'),
(261, 68, 'Memberikan apresiasi atas hasil kerja bawahan/orang lain untuk mendorong perbaikan lebih lanjut'),
(262, 68, 'Berbagi pengalaman dan pengetahuan baru kepada bawahan/orang lain untuk meningkatkan kualitas kerja mereka'),
(263, 68, 'Memetakan kompetensi bawahan/rekan satu tim dengan baik'),
(264, 68, 'Memberikan penugasan sesuai dengan kompetensi/kemampuan yang dimiliki pegawai'),
(265, 68, 'Mengenali kekurangan dan kelebihan anak buah atau rekan satu tim untuk mengembangkan kemampuan mereka'),
(266, 69, 'Memberdayakan kapasitas anak buah/rekan satu tim dengan cara memberikan penugasan yang lebih menantang diluar tugas rutinnya'),
(267, 69, 'Mendelegasikan wewenang kepada bawahan/ rekan satu tim dengan mempertimbangkan kemampuan atau kapasitas mereka'),
(268, 69, 'Menjadwalkan diskusi untuk memantau progress kerja/membahas permasalahan di dalam organisasi'),
(269, 69, 'Memberikan umpan balik serta coaching dan counselling kepada bawahan/rekan satu tim dalam penyelesaian pekerjaan '),
(270, 69, 'Melakukan pembinaan terkait sikap dan perilaku kerja kepada bawahan melalui teguran/surat secara pribadi'),
(271, 69, 'Meluangkan waktu khusus bagi bawahan atau rekan satu tim untuk membahas permasalahan pribadi'),
(272, 70, 'Menganalisis kesenjangan kompetensi SDM yang ada saat ini dibandingkan dengan tuntutan tugas yang akan datang'),
(273, 70, 'Menyusun program pengembangan pegawai untuk mengatasi kesenjangan kompetensi dari SDM yang ada saat ini agar dapat menghadapi tuntutan yang akan datang'),
(274, 70, 'Mengawasi penugasan yang diberikan serta memberikan koreksi jika dibutuhkan'),
(275, 70, 'Mengevaluasi setiap tahapan kegiatan pelaksanaan tugas yang dilakukan oleh bawahan/ rekan kerja satu tim guna perbaikan atau peningkatan kinerja'),
(277, 71, 'Menginventarisir aspirasi setiap bawahan/pihak lain terhadap perkembangan karir/kompetensi mereka'),
(278, 71, 'Memberikan penugasan, bimbingan dan kesempatan belajar guna pengembangan kompetensi bawahan/rekan satu tim'),
(279, 71, 'Mengetahui tuntutan kedepan dari organisasi terkait dengan kompetensi SDM yang dibutuhkan'),
(280, 71, 'Membimbing bawahan yang potensial untuk menjadi penggantinya/kader atau untuk menduduki jabatan tertentu'),
(281, 71, 'Mengintegrasikan aspirasi bawahan dengan kebutuhan organisasi dalam rangka pengembangan karir/kompetensi'),
(282, 72, 'Menyelesaikan pekerjaan sesuai dengan tugas dan fungsi yang melekat pada jabatannya'),
(283, 72, 'Sigap menyelesaikan permasalahan yang bersifat teknis/administratif yang terjadi dalam pelaksanaan tugas'),
(284, 72, 'Segera menyelesaikan masalah yang ada dihadapannya dengan tujuan agar tugas/kegiatan dapat terselesaikan'),
(285, 73, 'Menyusun rencana kerja unitnya dengan mengacu pada sasaran kinerja unit maupun organisasi secara keseluruhan'),
(286, 73, 'Menyelenggarakan kegiatan atau pelaksanaan tugas sesuai dengan Renstra organisasi'),
(287, 74, 'Mampu mengidentifikasi seluruh sumber daya yang dimiliki, dari aspek kelebihan dan kekurangannya dalam rangka mencapai tujuan organisasi'),
(288, 74, 'Mengetahui perubahan situasi organisasi sebagai bahan pertimbangan dalam penyusunan rencana kerja'),
(289, 74, 'Mengetahui tuntutan pihak eksternal dalam rangka menyusun langkah antisipasi perubahan yang perlu dilakukan'),
(290, 75, 'Merumuskan rencana kerja jangka panjang dalam bentuk dokumen rencana strategis jangka panjang organisasi'),
(291, 75, 'Menghitung kemampuan sumber daya internal yang dimiliki organisasi dalam mencapai target 5 tahun ke depan'),
(292, 75, 'Menetapkan perencanaan dalam meningkatan kemampuan sumber daya internal organisasi guna mencapai target 5 tahun ke depan'),
(294, 76, 'Mengidentifikasi dinamika tuntutan lingkungan organisasi yang berdampak pada kebutuhan perubahan visi organisasi'),
(295, 76, 'Merancang dan menetapkan visi organisasi sesuai dengan perubahan situasi internal dan ekternal organisasi'),
(296, 76, 'Menyiapkan berbagai langkah antisipasi guna memastikan tercapainya visi dan misi yang ditetapkan'),
(297, 77, 'Menjadikan petunjuk pelaksanaan yang berlaku sebagai acuan dalam melakukan pekerjaan'),
(298, 77, 'Menjelaskan jenis-jenis pekerjaan yang menjadi tanggung jawab jabatannya'),
(299, 77, 'Mengutamakan penyelesaian pekerjaan yang menjadi tanggung jawab di jabatannya sebelum mengerjakan tugas tambahan lainnya'),
(300, 78, 'Menentukan hal-hal apa saja yang diperlukan untuk menyelesaikan suatu pekerjaan'),
(301, 78, 'Mengidentifikasi pihak-pihak yang dianggap dapat membantu penyelesaian suatu pekerjaan'),
(302, 78, 'Menentukan jenis-jenis pekerjaan yang harus diselesaikan terlebih dahulu dengan mempertimbangkan urgensinya'),
(303, 78, 'Menyusun langkah-langkah kerja operasional dalam rangka penyelesaian tugas'),
(304, 78, 'Membagi suatu pekerjaan menjadi tahapan-tahapan yang terperinci dengan mencantumkan jangka waktu penyelesaiannya'),
(305, 79, 'Menetapkan target yang harus dicapai unit kerjanya'),
(306, 79, 'Menyampaikan target-target pekerjaan yang harus diselesaikan oleh tiap anak buah di unitnya'),
(307, 79, 'Memantau penyelesaian pekerjaan dari masing-masing bawahan secara berkala'),
(308, 79, 'Mendistribusikan beban pekerjaan tiap bawahan di unit dengan berdasarkan kemampuan dan kompetensi anak buah'),
(309, 80, 'Mengecek kesesuaian program kerja unit yang dibuatnya dengan rencana strategis organisasi'),
(310, 80, 'Berkoordinasi dengan unit lain dalam rangka mensinergikan program kerja yang disusun pada masing-masing unit'),
(311, 80, 'Berkoordinasi dengan unit lain dalam rangka menentukan sumber daya yang dibutuhkan dalam pelaksanaan program kerja secara menyeluruh'),
(312, 81, 'Menyusun dokumen rencana strategis sesuai dengan kondisi internal dan ekternal organisasi'),
(313, 81, 'Menetapkan target kerja jangka panjang dengan mempertimbangkan visi dan misi organisasi'),
(314, 81, 'Menyusun rencana jangka panjang untuk meningkatkan sumber daya yang ada guna tercapainya tujuan organisasi 5 tahun ke depan'),
(315, 82, 'Mengetahui rekan kerja yang dapat diajak bekerjasama untuk penyelesaian tugas/kegiatan'),
(316, 82, 'Menghadiri rapat/diskusi/pertemuan untuk menjaga hubungan baik dengan pihak-pihak yang bekerjasama dengan unit kerja'),
(317, 82, 'Menyesuaikan gaya berkomunikasi dengan berbagai karakter orang  yang dihadapinya'),
(318, 82, 'Meminta rekan kerja untuk memberikan saran terkait dengan penyelesaian tugas'),
(319, 83, 'Mengidentifikasi personel kunci dari pihak di luar unit kerja'),
(320, 83, 'Berdiskusi dengan berbagai pihak terkait dengan penyelesaian tugas unit kerja masing-masing'),
(321, 83, 'Memelihara hubungan kerja baik secara formal maupun informal dengan pihak lain dalam rangka mencapai tujuan masing-masing unit kerja'),
(322, 83, 'Bertukar informasi dan gagasan dengan pihak lain yang berhubungan dengan pekerjaan'),
(323, 84, 'Mencari informasi mengenai kebutuhan pemangku kepentingan melalui berbagai media komunikasi atau informasi'),
(324, 84, 'Berinisiatif memberikan informasi yang diperlukan oleh pemangku kepentingan dalam rangka penyelesaian tugas masing-masing pihak'),
(325, 84, 'Melakukan diskusi rutin dengan pemangku kepentingan terkait dengan pencapaian tujuan masing-masing pihak'),
(326, 84, 'Melakukan komunikasi baik formal maupun informal kepada pemangku kepantingan guna mencapai tujuan unit kerja'),
(327, 85, 'Bekerjasama dengan pihak eksternal dalam rangka mencapai tujuan organisasi yang saling menguntungkan'),
(328, 85, 'Mengidentifikasi keuntungan yang diperoleh ketika bekerjasama dengan pihak- pihak diluar organisasi/eksternal'),
(329, 85, 'Mengikuti berbagai forum ataupun komunitas di luar organisasi untuk mengembangkan jejaring sosial'),
(330, 85, 'Mengikuti berbagai forum atau kegiatan yang melibatkan berbagai pihak eksternal'),
(331, 86, 'Mengidentifikasi peluang untuk membentuk jalinan kerjasama atau komunitas yang memiliki tujuan yang sama'),
(332, 86, 'Berinteraksi dengan pimpinan organisasi lain terutama yang memiliki potensi kerjasama dengan instansinya'),
(333, 86, 'Melakukan kerjasama yang saling menguntungkan dalam jangka panjang dengan pihak atau instansi lain'),
(334, 87, 'Mengenali adanya permasalahan dalam organisasi yang berdampak pada kurang optimalnya kinerja'),
(335, 87, 'Mencari pemecahan masalah sesuai tuntutan perubahan yang terjadi di lingkungan kerja'),
(336, 87, 'Memilih langkah perubahan atau perbaikan proses kerja yang harus dilakukan terkait dengan lingkup pekerjaannya'),
(337, 88, 'Memberikan saran cara pengerjaan baru yang lebih efektif dan efisien untuk mendapatkan hasil optimal dalam bekerja'),
(338, 88, 'Menggerakkan orang lain dalam proses perubahan untuk meningkatkan efektivitas dan efisiensi proses kerja'),
(340, 89, 'Menentukan sumber daya manusia pendukung yang kompeten untuk pelaksanaan rancangan perubahan atau perbaikan proses kerja di unit kerja'),
(341, 89, 'Menentukan kebutuhan teknis pendukung pelaksanaan rancangan perubahan atau perbaikan proses kerja di unit kerja'),
(342, 89, 'Menentukan sasaran atau target perubahan yang akan dicapai dalam rangka perbaikan kinerja di lingkungan unit kerjanya'),
(343, 89, 'Melakukan pendataan mengenai hal yang dapat mendukung maupun hal yang dapat menghambat upaya perubahan sistem di lingkungan unit/instansinya'),
(344, 89, 'Melakukan pembagian peran dalam suatu tim pelaksana program peningkatan kinerja unit/organisasi'),
(345, 90, 'Melakukan pemantauan berkala mengenai keberhasilan tahapan perubahan yang telah ditargetkan dalam pelaksanaan program perubahan'),
(346, 90, 'Bersedia menerima masukan dan saran terkait proses perubahan atau perbaikan kinerja yang tengah dilakukan di lingkungan unit kerja/organisasi'),
(347, 90, 'Melakukan rapat tim untuk mengevaluasi proses pelaksanaan program perubahan'),
(348, 90, 'Membahas langkah-langkah alternative ketika program perubahan dianggap kurang memenuhi target perubahan ataupun efektifitas kerja unit/organisasi yang telah ditentukan sebelumnya'),
(349, 90, 'Mengusulkan alternatif pemberdayaan sumber daya aparatur melalui diklat untuk mengantisipasi perubahan'),
(350, 91, 'Melakukan sosialisasi program perubahan nilai kepada seluruh unsur melalui berbagai media komunikasi yang ada di organisasi'),
(351, 91, 'Melakukan proses internalisasi perubahan nilai kepada seluruh unsur organisasi'),
(352, 91, 'Menjadikan diri sendiri sebagai contoh dari pelaksana perubahan dalam unit/organisasi'),
(353, 91, 'Menetapkan dan memberlakukan mekanisme reward & punishment secara konsisten sehingga mendukung konsistensi pelaksanaan program perubahan di unit kerja/organisasi'),
(354, 92, 'Menjadi penengah ketika terjadi konflik di lingkungan kerja'),
(355, 92, 'Berdiskusi bersama pihak-pihak yang terlibat dalam konflik untuk mencari penyelesaian masalah dengan mengacu pada prosedur kerja yang berlaku di unit kerja/organisasi'),
(356, 92, 'Mendorong masing-masing pihak yang terlibat konflik agar dapat memahami perbedaan sudut pandang sehingga pekerjaan tetap dapat terselesaikan'),
(357, 93, 'Bersikap objektif, tidak memihak salah satu pihak yang terlibat di dalam konflik'),
(358, 93, 'Menggali informasi dari berbagai pihak untuk mendapatkan keterangan mengenai alasan timbulnya konflik'),
(359, 93, 'Berdiskusi dengan pihak yang berselisih paham secara terpisah untuk memahami sudut pandang dari masing-masing pihak'),
(360, 93, 'Meminta dari tiap pihak untuk memberikan usul solusi yang dianggap dapat menyelesaikan konflik'),
(361, 94, 'Berdiskusi dengan tiap pihak yang berselisih paham dengan membahas sudut pandang dari pihak lainnya'),
(362, 94, 'Memberikan kesempatan kepada masing-masing pihak yang berselisih paham untuk dapat mengidentifikasi kemungkinan penyebab perbedaan pendapat/pandangan yang terjadi'),
(363, 95, 'Meminta masing-masing pihak yang berselisih paham untuk memberikan usulan solusi penyelesaian masalah dengan mempertimbangkan kondisi/kepentingan kedua belah pihak'),
(364, 95, 'Membahas kemungkinan kendala yang muncul dari tiap solusi yang diusulkan oleh pihak yang berselisih paham'),
(365, 95, 'Berdiskusi bersama kedua pihak yang terlibat konflik untuk mencari jalan tengah yang dapat diambil oleh keduanya'),
(366, 96, 'Mendorong berbagai pihak terkait pentingnya untuk menanggalkan ego sektoral dalam rangka pencapaian tujuan organisasi'),
(367, 96, 'Menginisiasi forum yang bertujuan untuk mengumpulkan informasi dan membahas langkah penyelesaian kendala yang terjadi dalam koordinasi pelaksanaan tugas'),
(368, 96, 'Mengusulkan kegiatan team building yang bertujuan agar masing-masing personil organisasi dapat saling mengenal dan memahami rekannya dalam bekerja'),
(369, 96, 'Menginisiasi forum komunikasi non-formal melalui berbagai media komunikasi yang bertujuan agar personil yang ada di organisasi dapat berkomunikasi dan berkoordinasi dalam berbagai kesempatan'),
(370, 97, 'Berinisiatif menyampaikan kepentingan unit/organisasi kepada pihak lain'),
(371, 97, 'Menyimak kebutuhan/kepentingan yang disampaikan oleh pihak lain ketika melakukan penjajakan kemungkinan kerjasama'),
(372, 97, 'Mengindentifikasi persamaan dan perbedaan kepentingan dalam menjalin koordinasi maupun kerjasama dengan pihak terkait'),
(373, 98, 'Mengenali peluang keuntungan yang didapat dari pihak lain yang dapat menunjang pencaaian tujuan unit/organisasi'),
(374, 98, 'Mengidentifikasi langkah yang perlu dilakukan dalam rangka memenuhi kepentingan unit/organisasi lain'),
(375, 98, 'Melakukan kerjasama dengan unit terkait meski tidak semua kepentingan unitnya dapat terakomodasi'),
(376, 98, 'Memenuhi kebutuhan pihak lain dengan memberdayakan sumber daya yang dimiliki unit/organisasi'),
(377, 99, 'Menyandingkan informasi terkait kepentingan dari kedua belah pihak sebagai bahan rujukan dalam menyusun argumentasi agar pihak lain mendukung kepentingan unit/organisasi'),
(378, 99, 'Menyampaikan argumentasi pendukung yang logis dengan mempertimbangkan kepentingan pihak lain dengan tujuan untuk meyakinkan pihak lain menerima kepentingan unit/organisasi'),
(379, 99, 'Menggunakan berbagai pendekatan dalam meyakinkan pihak lain agar dapat menerima kepentingan unit/organisasi'),
(380, 100, 'Memberikan kesempatan kepada pihak lain untuk menyampaikan kepentingannya ketika mendapati adanya perbedaan kepentingan di antara kedua belah pihak'),
(381, 100, 'Mengusulkan jalan tengah yang mengakomodasi kepentingan kedua belah pihak'),
(382, 100, 'Bersedia untuk menerima kesepakatan di antara kedua belah pihak meskipun tidak seluruh kepentingan unit/organisasi dapat terakomodasi'),
(383, 101, 'Menjelaskan secara rinci dan logis perbedaan kepentingan dari sudut pandang kedua belah pihak'),
(384, 101, 'Menjelaskan keuntungan dan kerugian dari terjalinnya kerjasama dalam rangka pemenuhan kepentingan bagi kedua belah pihak'),
(385, 101, 'Menjelaskan keuntungan dari kerjasama bagi kedua belah pihak, sehingga kesepakatan dapat tercapai tanpa tantangan berarti'),
(386, 101, 'Menjelaskan manfaat kerjasama sehingga menggugah pemikiran pihak lain untuk dapat menjalin kerjasama  yang saling menguntungkan'),
(387, 4, 'Mengungkapkan dan mempertahankan pendapat sesuai norma dan etika yang ada di lingkungan kerjanya.'),
(388, 4, 'Mengklarifikasi dan mengajak berdiskusi apabila terjadi perbedaan pendapat di lingkungan kerjanya'),
(389, 4, 'Menghargai perbedaan pendapat dalam lingkup pelaksanaan tugas bersama di lingkungan kerjanya'),
(391, 4, 'Mendorong rekan kerja untuk bersama-sama melaksanakan hasil kesepakatan/komitmen bersama'),
(392, 3, 'Melaksanakan hasil kesepakatan/ komitmen bersama');

-- --------------------------------------------------------

--
-- Table structure for table `lembaga`
--

CREATE TABLE `lembaga` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lembaga`
--

INSERT INTO `lembaga` (`id`, `nama`, `alamat`, `telepon`) VALUES
(1, 'PKP2A I LAN', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `id_lembaga` int(11) DEFAULT NULL,
  `id_pegawai_status` int(11) DEFAULT NULL,
  `nama` varchar(128) DEFAULT NULL,
  `nip` varchar(25) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `token` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `id_lembaga`, `id_pegawai_status`, `nama`, `nip`, `username`, `password`, `email`, `token`) VALUES
(9, 1, NULL, 'Dr. H. Baban Sobandi, SE.,M.Si', '196705011993031001', 'baban0501', '$2y$13$8MvdlrmHuuHo9CQGI47Fo.wa6iwYYaINc1Dz7SN9n23mmsnn7C61m', 'baban.sobandi@lan.go.id', 'MjWMaIDX3f7XOZ8WqA8qhFDHfxWEhgObc8dy9TOs3tq2Pu5d3PxWGRmlhNs1YNYN'),
(13, 1, NULL, 'Drs. Dayat Hidayat, M.Si.', '196107021988031001', 'dayat0702', '$2y$13$tAPyYEjpNvO77xXgg4QyTek1CIsmK8z50Od7tL45J1RGp6giwEtw.', '', 'MQxjXt4gyCOfcsZSqqOoDbuK30IIXVbv3DWwCpvDmKv7VUHINcm9ckp3dzNBd4fJ'),
(14, 1, NULL, 'Ir. Euis Nurmalia, M.Si.', '196708811994012001', 'euis0811', '$2y$13$89uGBg7WrEKliUypzj7k/uvUx8g2mIPBPaIjQJEJRmZ11eRZEJrD6', '', 'mFUJwi7lVhY4vpC5mARCwKtjwhu2aLxfuwbdEpbVXT0x5E4restVXL48Dd8rwD3N'),
(16, 1, NULL, 'Hari Nugraha, SE.,MPM.', '196810131994011001', 'hari1013 ', '$2y$13$lAI2/o.HfhnTeTKQnJqZRupS2T4zhpxNj1xXsoWkyLDqXIJk4QsG2', 'phadika@yahoo.com', 'iHpCJsl84TnnW0YAXF0RVFuDJgBX0C086J9pLCMwbGXlGMRp9IfTH0EWgmAKXaLY'),
(17, 1, NULL, 'Dra. Enni Iriani, M.Ed.', '196207091989032001', 'enni0709  ', '$2y$13$U34Z.t01987NohJGzotEgeSJKXhFPs5I3rgLWty.o96CP4SW/3AcW', 'Enni_iriani@yahoo.com', 'TQN4Har5o0rPUTodLGzj3mNiTYF1qtDeHcdt6F7ljj1S3V98wjCA9rpnOSvnB0k9'),
(20, 1, NULL, 'Drs. Syarifudin Hidayat, M.Si      ', '196001011989031001', 'syarif0101', '$2y$13$SwZVtxmLYmUcPGiiSl9EhuSxvg8CWgf6TDa2AQ0B1i6wII7QqUeSK', 'Syarif_lan@yohoo.com', 'wSXcoRhtdElHoJHNAfADFiy2m2BeWg8l1HFETxi6FrPHqW7uFjC6TIvUhDq8TqPS'),
(26, 1, NULL, 'H. Gugum Gumelar, SH.          ', '196109171993031001', 'gugum0917', '$2y$13$aUsAC6D3e1j9Mm7rYebl8OslUvkO2g0fOAJkgP9I3uiWGLa3F6fD2', 'gilangprat@yahoo.com', '81oGA7EbBUt2coMGmw92bCt7QDFxwRreoBBB7eneD5wFo6REhfKxrUZDwIPFKQP5'),
(27, 1, NULL, 'Dra. Marifa Ayu Kencana, MIS  ', '196804081993032001', 'ana0408', '$2y$13$SroIYFBFyO7lPkhgadMfDOJ0raSU/EWp5DQDOe.wJoMLaN5NhMWdW', 'shezheana@yahoo.com', 'jbU2A1dpbwY8qWQyXT634YzyWb676OyaBuxVCmFIUNV3fqCCfioEepo0wOTZUO71'),
(28, 1, NULL, 'Anita Ilyas, S.Sos. MAP   ', '196409261988032001', 'nita0926', '$2y$13$18Xd2Jv42kewPIXgDcnRfu0QP5GEyEEFI8RHruxVkpvmDYdZVYdHa', 'anita_ilyas@yahoo.com', 'y0o0MZv0VFL5R0LqbBTT2nFnui8jbVLYjCXtCDFhObpYJ0q3AJfeUMhMpEug8O9g'),
(30, 1, NULL, 'Sukarna, S.Sos   ', '196302161985031001', 'karna0216', '$2y$13$x2NmGTdrWNdEbBnP8Bi1denPwgTZ9Qu0elYHfTu1wpDnMGaxvXh8C', '', 'VgMBgJQLuHRC1fFkp5SH2B1ikfDvmtzOVjLNmqqU1S2hlWzxjLYHR909TQVNzTvq'),
(31, 1, NULL, 'Zulpikar, S.Sos, MM.       ', '197305131997021001', 'zulpikar0513', '$2y$13$Z0zI/ai.oeNa2M4xH9R1buy.8L/4jnPJm5ZXanOLCA5MB0XoA1rEC', 'zzulpikar@yahoo.com', 'iz3OhbgoVj7efn4sWTZfnQXK1hp078ewFcBuaVLIknUVRbWqhTJmEM7IxkS0GUMX'),
(32, 1, NULL, 'Ade Juariah, S. Sos., MAP.        ', '196307151991032001', 'juariah0715', '$2y$13$oHYH5BSaydtZ7CQxH1WV0elmFI9YEpHvXBGBjnQCmr2MPBLbbwU.6', '', 'Z2kLIVPybp2kamW2nRwmXsRTitSJKQOBbdxaCoYcaokAuYRKBz0q37wHr9zz53Vq'),
(33, 1, NULL, 'Haris Rusmana, SAP.      ', '196612181985031001', 'haris1218', '$2y$13$xkchs/Uu8GJk.7/ECQC9Lexoq0UYCA8bTPUpVfI3xSGFxrHmV1X.m', 'harisrck@yahoo.com', 'kEZcVGh1i1gMdZj9VKqNVFnFRJkly0YiGloTyYEPl3Ym0oQZRP6oNCX6nwckYkOD'),
(34, 1, NULL, 'Putri Wulandari A. Rejeki, S.Si., ME.', '198202172005012001', 'putri0217', '$2y$13$iX81I2nd5jIT7BQfZxJ1Ye.qrp2dN3R4ba7wZQhmcCIOiR3s8TWFK', 'pu3_wulandari@yahoo.com', 'qaySEnbATvUP6MhVkNyHZBNgs13tS7Z3KAoBWdz8R2GgrHzXedQ4XsWL5IDwHCce'),
(36, 1, NULL, 'Suryati  ', '19680620-198903-2-001', 'inay0620', '$2y$13$3ZqB7q9ocj76O0vnGCYsU./SrXsGevZzLMd6zP30YzJ3p46Iz2WVq', 'innay_lanbandung@yahoo.co.id', 'Sij1Xgu5aGvkzhlUy5djpv6IrFbnbLlZzepfaYeMLx29QrkvbjgH6uEHvZ8k1B0d'),
(37, 1, NULL, 'Lilis Multati, S.Sos.                                  ', '19640105-198303-2-001', 'lilis0105', '$2y$13$nTF2Swar9gh4U7LoyXNawehu.oIFuoahpNKZAA/BQiIverOSCGIsO', '', 'S2Wu7vnKggF979MV5pb1YeayP9ipo1OxgrnyipqHQtgEaeYqHYxSN9ocHDJ4lPyR'),
(38, 1, NULL, 'Krismiyati, ST., M.Ec.', '19780525-200604-2-002', 'kris0525', '$2y$13$5aSYlpOe8e/GXl5l0YDC1et0ju0dauyJsUvYrbzVnKHLQ8PEM9Lg2', 'chrissie_tasri@yahoo.com', 'sQxn9Fr0DZdfFk7F29rtuAOa55YzIbMr432AvvcmNVtx9lPF3Fjjmq4jdrP5IfEE'),
(40, 1, NULL, 'Susy Ella, S.Si., MA.  ', '19821023-200804-2-001', 'ella1023', '$2y$13$CvUOe4WPgzGIyrDfuCTafehFSdW9bGIPBtMlQSs9ZdNimPpkZXK6.', '', 'W3Es7ZZhtK9FLQ6qgLhSjl8mCESWTeJjRdTtMT92mmPW96q2uZ4kSPysNwO4uD1M'),
(41, 1, NULL, 'Novel Saleh Seff, S. Sos., MAP.  ', '19710820-200112-1-001', 'novel0820', '$2y$13$aeBNc2rEhB.soTkLrN5HRuhv1mdM0lXr04jlAtXqN5fHMQF6xL8xm', 'novi2071@yahoo.com', 'bzef3F4zUHULasbtqK7o9Icitqbf8ClymcmukUI98NW6ZBXVCvliy07CDnfjfzmh'),
(42, 1, NULL, 'Tia Setiawati, S.Si.', '19821208-200604-2-001', 'tia1208', '$2y$13$mzYslV3VLyd1Ta3chq/TeuNQn1LnOfYP1sgtqq6uCxIK02qfjGi76', 'tia_812@yahoo.com / tia812@gmail.com', 'y4vooNtVdUAHvbMfmWOTtU6wf7DcE8z5Tznn44TndcKuyYuQ2OUZzjmgIkwV6SrY'),
(43, 1, NULL, 'Agus Wahyuadianto, S.Psi., SE., M.Bus. (Adv.)', '19790802-200804-1-002', 'agus0802', '$2y$13$ignOw1QkkNaKT.34S48W7eWK/HQkwgYznveG1zY5YBz.6EXEAk4qO', 'adianto123@yahoo.com', 'RLqaNPuzYGa4LNDDSmzDfJhDdpgtoquWKhWuGYfjrTh7tgOA9jo0QlYUoC67t60q'),
(44, 1, NULL, 'Depdi Respatiawan, SE.   ', '19801009-200804-1-002', 'depdi1009', '$2y$13$5SFinvFSNOPc2v3ncTf41.57UUvI3wqbBW/rtHmV/Sq6HVqPumUOO', 'depdirespatiawan@yahoo.co.id / depdimenoreh@yahoo.com', 'TWgatLt9ZhKRkqpHqtuQfhDnL1fOIwQOaUSevUp3iOlPClwjMouhmdOJ4EPlIxFT'),
(45, 1, NULL, 'RR. Harida Indraswari, S.Sos., M.Pub.Admin.', '19820926-200804-2-002', 'rida0926', '$2y$13$XYrZtBQpFt3yFmqvDQpc/ekKc6ylA.npQbX4p9bz8nSgttF2l7mKW', 'harida.indraswari@gmail.com ', 'xk1E07qvODwxLxeZgOCHmkov3QKrWGjBw7RpSA7CxzeX9Porg59YI0AMUWZdnJl0'),
(46, 1, NULL, 'Wuri Indri Pramesti, S.Sos.,M.BIS          ', '19800628-200804-2-001', 'wuri0628', '$2y$13$RgeyYh6iYFxgRWhuWmR2oup2BAuuRw/GDwQPHxwWiQ5IpUrwNKZd6', '', 'lCAxy4kZitTMUObFVFBHxid0JgvIN9NZOaMKsUpVuYZjwIca6g75XcZd2gmc7aVq'),
(47, 1, NULL, 'Yunni Susanty, SE, MM', '19850608-200804-2-001', 'yunni0608', '$2y$13$20BWbJsYcm6/5BE6fkyZeuGqo0JZl./f0.wzDF1gR4cb/XJ2fMXUm', 'yunni.susanty@yahoo.com ', 'od88xLwmuCrmHnJOxVTXtjabD0ngW4MlTqaKv0h6ecqf6haJCX2R28C5sjC2f1EC'),
(48, 1, NULL, 'Kurnia Anggraeni Dewi, ST.           ', '19730505-200501-2-001', 'nia0505', '$2y$13$Bw1Ux4szflIk2.aZiHAFcehXQbxE978HCvAsuc85VLc8dNeJ5kedK', 'nhiya55@gmail.com/kurnia_angraeni@yahoo.com', 'wsJS07K2H2bmhXjZHzUeJwt9acsdrZNEvq7xcxqLAGml1g2S1VgshqNTMFdAKBD7'),
(49, 1, NULL, 'Ade Suhendar, ST., M.A.P ', '19810902-200804-1-001', 'suhendar0902', '$2y$13$TmYw1zKIhDe5cgwBIFG1Kemgoo5XCm7dRTQAVelqMEbOeEeh0OgEC', 'adesuhendar_99@yahoo.co.id', 'ncuunlI3NgFGWm5KvKs3Ej3NuiFCsQVhaUflhVxgsHsqLI0lP3ltaMqPBBBqAPuH'),
(50, 1, NULL, 'Yuyu Yuningsih, SE.  ', '19811120-200804-2-001', 'yuyu1120', '$2y$13$L75OouX/ptw1lntLtCgx6ezqp0YoXT1LDwkBnTWU0tRUEEzybHW/O', 'nie_you2@yahoo.com', 'E8x5iTYSgPEGqgTiW3BI6774HuR6httqP9BxTn1HpXxiPz9NPs9XKFOftGjj7c02'),
(51, 1, NULL, 'M. Dani Ramadansyah, ST.', '19820701-200804-1-001', 'dani0701', '$2y$13$FeCusRxm3kc1Z/rngpPXfOfxD91u77htj.SI4Q93/FV/a58IkhEEe', 'dramadansyah@yahoo.com', 'h3hvm7pDHjUyaOP80tzdKywrF0QBoobmwLOfiLHyRm3hOzDLpKasapLWKjibA3tj'),
(52, 1, NULL, 'M. Fahrurozi R. Nasution, S.Psi. ', '198207092009121003', 'fahrul0709', '$2y$13$f9n8Wocr7bXozj6OaW2xwe3E7EZw7HHQXpYrRVUz5EWwY4hXRs8ga', 'fahrulnasution@gmail.com/fahrulnst@gmail.com', 'chbdwgUP33BaTc8BydNMjRasJlOWFwrzAvwgBMl8HhMpXwnJSaUyHeGi8cK5Rnvo'),
(53, 1, NULL, 'Rosita Novi Andari, S.Sos.    ', '19861105-200912-2-002', 'pipin1105', '$2y$13$FxxDnbbIBp3.lxHnDfLh6Ov3ZPTFtkC3Ohk6HY3vH431EXGVP7MbO', 'rositanovi@gmail.com / rose_mile86@yahoo.co.id', 'STIb5UHfUy5xB1xOH0sbK3hHwYEJOkxNqpguRWk7jCzRMQVezUQFkcVN3SM5qKYE'),
(54, 1, NULL, 'Shafiera Amalia, S.IP.       ', '19860222-200912-2-002', 'fira0222', '$2y$13$CukvABpxx65rYWc7HStL4uEo0CLRPiTXnUWPIQeZ3T8GxpyUp.7h6', '', 'v1l9FUIzr4ppN9mR91YP9nV5JumBMbfi2QtKLWD0CHdjC6rJoXT9GDydEoFJV16u'),
(56, 1, NULL, 'Sulistianingsih, S.Pd.           ', '19840923-200912-2-002', 'sulis0923', '$2y$13$J7CgjBuVi8WhfzGilbnl0.he8GNTOHK9Y9Fn/1trsDXKDffzHMlWG', 'liez_tia84@yahoo.com', 'CsNa0ZItQregcUQdd6ihyDhQPPsYLuUR5hFvkJffSmxc2PZjtpY9m3a4F2aqCCjn'),
(57, 1, NULL, 'Muhammad Afif Muttaqin, S.Sos.    ', '19860417-200912-1-001', 'afif', '$2y$13$AJ7daHEMbN2/9eDBPQPOGeZoW6Z1yDyKs.sVWhejaQaKxVvzLa6Lu', 'gopips786@9mail.com', 'NmqdtHGuUNGM3fXpWQ3YeyT1UIGeIsULcPmbBPaeqgUAGd5MCf5ZbnKvbMsjqLLK'),
(58, 1, NULL, 'Wahyudin                      ', '19630830-198503-1-002', 'wahyu0830', '$2y$13$s3ClHBMEFv/YFsrZGg2p6eMSUYm1B2TGIR3FdxUjZKtZIbncRtDpG', '', 'Coq2Zbx9nGJKFefEZ6yLSAbFP67j7sGen27fXUB9FM5ooDuG2q6hU5416EDYNiMb'),
(59, 1, NULL, 'Suparni              ', '19630706-198503-2-012', 'parni0706', '$2y$13$N7QkLyCpReGy16H/yUJnRORvcUDvhoI4qaJOwQGONYXIMK4/vQgs2', '', 'hmzcUxwh2gH8bQO3CcfadcCGpZDnQMZGmqYMMxVRDf09PgU2zkKqtUOnkJFDIOKP'),
(60, 1, NULL, 'Tanti Piani Puspita, SAB          ', '198005072005012001', 'tanti0507', '$2y$13$hCrLwrL0wk62qxc6Wj/epuFGfD0uR3cdSaf/SCVWhudB6b1/nxMs2', 'humainah_ku@yahoo.com', 'SB5rA3QRPJ4oQ4WFWItD4ZEVcuytJu9mZ4RrJ1VJ4HcdSUwqHWwNG2SfURooGcMH'),
(61, 1, NULL, 'Dikdik Hendarin, SAP.', '19741001-200501-1-001', 'dikdik1001', '$2y$13$yyfY.gW6ffbXYiHSEKqKSeMazJ2zAeSP0LEWQyUbpU6MgvfaRAf3a', '', 'Y9WA1R0p0dGw8nTV9j2BxS0NkR74EFeShAmarzCj9wM0aLDdY20vn1ytIxBweDjY'),
(62, 1, NULL, 'Holidin                 ', '19640420-199103-1-001', 'holidin0420', '$2y$13$oJlIF5YRipsDsTWaiApjXeY3e11e8ax6pnfYeYn/LXx.RsOr77qz2', '', 'CTh0metld7OhOQ6X0EDkbCGFufzY9zehdZHplnqjAXMF0NledcAD9r5TZZsTquuK'),
(63, 1, NULL, 'Tino Trisno Mulya, SAB   ', '19720816-200212-1-001', 'tino0816', '$2y$13$km0rXFuDFg8u4NWmQt7tv.XLqpRVcm.CLIpqtP9.D2z/6AXXDH59C', 'tino.mulya@yahoo.com ', 'CwfGh6CZs37x1WNm0wzpCqjhlrnYBhECQFcRBP46o2u5uQdb1qVsVrmZp3bStjga'),
(64, 1, NULL, 'Rahmawati, SAP     ', '19790502-200804-2-002', 'rahma0502', '$2y$13$Zcq6yoC7USl9trW4K9O1xeR2I2ghQbWJnYFZYJXZDv1rKeR48rhB2', 'rahma_d2@yahoo.com', 'dtas5UtZZ0HKsjntFghJJpo0wljYrJvXLzee33hTlAuDJbQjCLb3psUR88ZxWqAY'),
(65, 1, NULL, 'Kezia Larasati Suparno, A.Mk.         ', '19810508-200912-2-00', 'kezia0508', '$2y$13$TABQqH8WIdy9TNy3ZP/Ycued/MiqYQ9BlkHz12wOm5utw8APKahhy', 'Kezia_larasati_s@yahoo.com', '9CYZqruriVLiZhsg4tbFoxadgCAWBiuuouuqZu7k8kZVtpEeDzNYu6bz1kNppbDs'),
(66, 1, NULL, 'Sujono           ', '19600803-199103-1-001', 'jono0803', '$2y$13$gRa9GZX/lXX5u3DfrVCx.e5KNvj3uqIvBj73p0B23vYzamouJaCV2', '', 'WnWBUpTzGPLnmhBrO5f6kkQtyOVB0x2sWlxLm06e2khJywJevkxs5SqpyADQn0Co'),
(67, 1, NULL, 'Jujun Junaedi       ', '19650914-199103-1-001', 'jujun0914', '$2y$13$nOqmkkljNDfNZiSnxoFyQukwvDCdmx.MipKSSZnxSmneGZKa8L9S2', '', 'TZ0naKqdwSRjkQpMTdQ3r44MUuH21dcBLIyVMB8W69SBlFVOzSbUgPF6rZFuQFFt'),
(68, 1, NULL, 'Priswanti Rahayu, SAB   ', '19820418-200312-2-001', 'pris0418', '$2y$13$HIr/JtND8ynKdKJJ0Uck/OB3zPF0S9x8rLX5EoU6D.FlaZWg8sZye', 'priswanti_rahayu@yahoo.co.id  priswantirahayu@yahoo.com ', 'lAVxAaiyxFHAqIqFK9qbcPtQVLTUAB1hbIb69fBuSyc4NHZeiwiXIAlezQpjbrBO'),
(69, 1, NULL, 'Budi Permana, S.Sos., M.I.Kom.        ', '197502202005011001', 'budi0220', '$2y$13$qi5jcCUliie/hgmPYJ.LgOMh6MVFY.m2A2dFrqNOzODyPMqBjmo3u', 'hulk0275@yahoo.com', 'aLEMv4dd4poYiZevjfynUDNT57jO5Z6EqpNuW1FBSWpcDqDMj7EPugwQ3bwtIKEx'),
(70, 1, NULL, 'Indra Risni Utami, A.Md.', '19820913-200501-2-001', 'indra0913', '$2y$13$.i1tnBq85Et8ORxq/0iwm.X.hS3zeh/5SDIfOfAE0capRvuyzroVO', 'indra_lanbdg@yahoo.com  ym: iyamagnifique@yahoo.co.id', 'MJuIFEJ2Id8nWQwrsRcvWoSXNolI63XsvuVeBAfpiE4xCW429YcTmKiU7B7FPlt6'),
(71, 1, NULL, 'Tata Tardiyat     ', '19690917-200604-1-002', 'tata0917', '$2y$13$S.uHzpPHsnUEy5h455nRj.f7d/qJPJVcvMwdrANJ9O3Ml9u8GZCnq', 'tata_tardiyat@yahoo.com', 'recjrV8wZOSFwasJwLQbTkwovjbbaXmY5YjvCRRzUdXzIiVL2c05kgTrrEFE4yU2'),
(72, 1, NULL, 'Andi Sutisna          ', '19670808-200604-1-004', 'andi0808', '$2y$13$W0IT0O4iYIK2Gc1GkMFdeOUpW8AuwqijzaT8llqZ.J4Sy4WLU4W0i', '', 'OwDfhuriSiTgcgsfXDCldf4HaKEs7sgV1NLyEpoh3ZpHfQVVH5AGCOR1aHPBEj4p'),
(73, 1, NULL, 'Sumarna          ', '19650202-200604-1-002', 'sumarna0202', '$2y$13$wWY68RxB84I95mnlMQY.0OoCNcqFTiCgRy7vVms/PSGXcdv7QiCvi', '', '8PDyYMa6Yaedh2rDHTMcHqutqa5L2kdzs6JRdjXXLkjvgcmfnTwus60DeoEWMcN5'),
(74, 1, NULL, 'Hidayat           ', '19630706-200604-1-003', 'aay0706', '$2y$13$T8W.YmhbYk5KPt8BoQ7HmejAztg0kTtkw7i0HQ/2grJedJpr8iMVi', '', 'fc4pQwprLhTlYGy4lu5AxpigY7orus6QaPFgF7mf93yHD1mIHaYYTi0AyCpPxwGV'),
(75, 1, NULL, 'Denar Lukmansyah   ', '19640630-200604-1-001', 'denar0630', '$2y$13$o7CGnq8Bu7Scc0yWMaaJHON0.x6BAZaOGJXoFS0MoQOjzUUA622lS', '', 'I2UXcg4yKDPZNhMOUmTGj3x4RHIJYF07M18M8kmACFTVO30ULLaNwAL78pThiust'),
(76, 1, NULL, 'Opan Sopandi              ', '19680727-200604-1-007', 'opan0727', '$2y$13$xHsedP8LBdIETeG4T6RzuueDUUKtpN/y7BwRW95BzYmMz6rIQjkBi', '', 'cXRJtJfLtIyM7qoQmQe14jCE3uwaYcN6tKNUCjfzHyRzEBHlotVT0evToBdmBwS6'),
(77, 1, NULL, 'Herdi Erawan', '19630724-200604-1-001', 'herdi0724', '$2y$13$lVfhNBIye9hDs7.px3BxaO5PpsXk1UI508wwPFSRl1I0WyofQoquG', '', 'WPXIVxSZHxdE7CIw4S3KOu8j7q7yxs27xWO5cPsaBsA14MKpWBy1E0pP5JnRiJXj'),
(78, 1, NULL, 'Didi Supriyadi        ', '19630805-200604-1-001', 'didi0805', '$2y$13$Ktd0EG/2jadG7VX.EQ0PMekAjY83b/GQ/NEk0dOKbuLvTQLcc3pym', '', 'efNJGegKW98vDNCqBkyolrmKx8kJokU7pxXHUHyaYyvzRfBbbUabcBzBsYYH0twY'),
(79, 1, NULL, 'Nasep Soviana      ', '19640717-200604-1-001', 'nasep0717', '$2y$13$adLOfgJlrwazx3CNp6qVS.xCA8Imfe7dJP0e4jSLIZNweG4lU7Ihi', '', 'Ny88VBtvN5pbvO80huJcdrBzrNxnRTQTrUohFBglPTbQ4D4lKyy2gjHfwEfWU4Fg'),
(80, 1, NULL, 'Ano          ', '19670903-200604-1-002', 'ano0903', '$2y$13$L/pskPSVq8ExL1K.O/62KOEriBE7TyX8f03ebRScMk3Ke8umFIGQa', '', 'xDVYQ3sWp8hAbXD2jpAWgl0Un2Kg4kTD5dZENswsOQ92HlXb6bxDEQKSd0Q48QBN'),
(81, 1, NULL, 'Maman Suparman         ', '196403102007011002', 'maman0310', '$2y$13$/Dmn.wEYV9mlALmL7Q3yV.zVAXLlcItvb59sqRgBZ6eyiaPfyEG42', '', 'yRUomAalPLgp22ArMp0Je0hlw69PGwzydwHEp13EItkZ7OxpZHZXTCsszIBwRoIn'),
(82, 1, NULL, 'Dana Sutisna       ', '19681115-200701-1-002', 'dana1115', '$2y$13$KC9DWAEExl/dtAx6uX4yNe/mujbMYjqziGK.o4B2Mez.IdBuw1LAG', '', 'f57r4vYWA1P0spcQLElA3qazaViHIQeVZBXor9VIYatwCCklXmJRKevklSuHhX4K'),
(83, 1, NULL, 'Erni Driyantini, SAB         ', '19820526-200501-2-001', 'erni0526', '$2y$13$OecfYrlS0MFkKfAOdsodr.jT0jARi0EEoMwNvdNBOrNMtHZauLTjy', 'ernilan@gmail.com', 'VAKW14CCe5h2EvMDj3tZcxoN3jQ2HR0rNr8l94ihJcabGmGdjplXaTyQ59A85oX4'),
(84, 1, NULL, 'Mujiono           ', '19670224-200604-1-002', 'muji0224', '$2y$13$QlyEnUHKtuelQ1oPaOWkFuib6W76The7VeMVTlfAE2w1iAKOL8TnC', '', 'j7zfn8mqM9iOpd0BgWFzcOdHf3A4WKtltbQq5k1xh1Tff0J19Ijut2l6nTsKa1ms'),
(85, 1, NULL, 'Jeje Hidayat            ', '19700711-200604-1-003', 'jeje0711', '$2y$13$4hA2uYX.lQfx3tKeKYIPueyDfNAMPxxtYCsg/YKQJnkuMEx1stZQq', '', 'kVlzdbIqfmBNZWFSjCknIh39dS8oh3qHHNDzI0WDRh1mqXI7wO9KdjwKqmcyEMXl'),
(86, 1, NULL, 'Enang                ', '19731023-200701-1-002', 'dadang1023', '$2y$13$YeJ4b2ts23RNvPDhoKpf7OfJgUfp8tzdRX1wr9NFh.w4GkYWEUUZq', '', 'GP40Oa2liLcqst2hIOfBPxgRq14SPo8wkY9P6z6Yjx14aWSFeJEy2iYynjpVuQ6n'),
(87, 1, NULL, 'Pratiwi, S.Sos', '198703152011012015', 'tiwi0315', '$2y$13$Vvl71on0dhjRaL/T6bVg.ukveug3zZWdGGADzxTbA.Lsu4rztporG', 'pratiwisaja@ymail.com pratiwi_saja@yahoo.com', 'lMxXpiAOBSrqNK3UjZPxznbHvznPYBPrXNdKJ6BgirRhLHBvGk4AyFis38GfLoVa'),
(88, 1, NULL, 'Octarian Wirahadi Kusuma, SH', '198410102011011023', 'rian1010', '$2y$13$7dObktXqwwbf1hnjXswBcu9X.dRI15AwM/MQiqEo9T4LZctZEksxS', 'octarianwirahadik@yahoo.com', 'ZnlAOVs3KdpubGTV0J6wsFSAvsOGMmjqxogU8GI5iI2xX35GADhO1GYG2rGzlpxI'),
(89, 1, NULL, 'Pupung Puad Hasan, SE., M.Ec.Dev.', '198308072011011008', 'pupung0807', '$2y$13$8E66SPntpuT/BDeVWnY68.GD0JeKOy/HLkK1dCx9XVAEUmSIOp2Lq', 'pupungph@gmail.com', '2LmSPVvsAV9WeZDICaJ570R1aKIVTCNbCaqoWjiooINUrq6djfRgPrgtrzOu6NkO'),
(91, 1, NULL, 'RR. Esty Widyaningsih, S.Pi., M.Si', '198401282011012010', 'esty0128', '$2y$13$.U4VafH17DCFlwVRvIIeJuQsjV6/rqsSNxgjoes8BAUDTElN/O/BC', 'st.widya@yahoo.com', 't1P3bJQxiG3LQpJeeaKhtm8L912JIWYaOC9g6SX8f7ZZ5qY7RT3Bk2UpuaYvL86k'),
(92, 1, NULL, 'Danik Wijayanti, S.Psi, M.Si.', '198011202011012006', 'danik1120', '$2y$13$VaNPKYtaYzcqNDccscL/ruopiPw3F0MQnkKhNdwRTcRIRg4QwtNq.', 'danik_sweet@yahoo.com', 'arvaw6ndMdfqKINHPZGbn3XvYnKTNiPTsNjnmj8kXq42XeyDSnmIFMOi88ATpcep'),
(93, 1, NULL, 'Iman Arisudana, S.Sos., MA', '198204042011011011', 'iman0404', '$2y$13$wKmZUJFlR/oQ3dmcI5ggsOO5/Jqwnzdq6xc2I3UxqW8TdgUa.LltW', 'pidadh@yahoo.com', 'pc0azUgTTyLrXAOGRvJmwkV7TtAxwLELSaMaATJMCqbGJeTGnQLcdbTH9g9lpRN9'),
(94, 1, NULL, 'Nurhusna Frinovia, ST., S.Psi., M.Psi.', '197811172011012008', 'novi1117', '$2y$13$UTr.FH1IRqKzjLSEkzVKsOslnoRvyOQNYvwCZLxQ3RS105uNzs8yK', 'Nurhusna.frinovia@yahoo.com', 'AcRBX2D5yaMPoPZ7O7JB4rz6D2r3uN0ODarWxajtcKvNhmM6Vp8VtFiI3jL3WTlP'),
(95, 1, NULL, 'Dewi Ariani Hertina, S.Psi.', '198501032011012015', 'dewi0103', '$2y$13$8Km4kMmHXztxM7svIVJKweHInDUE4a0D6/eyX2blKz6nEASBcIJ/q', 'Dewi.ariani@gmail.com', 'CeEpkS7s11FmZL7CAPuKgHuxiicTqopRQBC1Cpczo0sZusmu09YnItKdGctmrC9F'),
(96, 1, NULL, 'Candra Setya Nugroho, SH', '198807012011011006', 'candra0701', '$2y$13$jM1z3tG/szq8Z0J.w5CJYOLgIxhWhUkt2ttoQJ5T1ca/KwA.nLmSW', 'candrasetyanugroho@yahoo.com', 'fOHajtLVweDjXoiaiS9xhw2rmpe3hoIHFRKBF9BbFSYHrihrOmlrrbeNmY8oM9pA'),
(97, 1, NULL, 'Ir. Dayat Nurhayat SW, M.Sc.', '195609061987011001', 'dayat0906', '$2y$13$ns0AdLFl6J3Yh1qakQp4qudqaSC4d7DvMINP36P.lCVOPwrNWPAOC', '', 'ConlSRuZB3lKNQ7QnFT7OAVs5i3viKxjm8gR8QBPNJX78zYgil1cYlRKnvRV2UTF'),
(99, 1, NULL, 'Dr. Satwiko Darmesto', '195304291975031002', 'satwiko0429', '$2y$13$ErIQjbDEU1Cd69/2NQHnbe/b2GUpRGXjcxEcbuiQgYerzIoetw932', '', 'tvdM4V4J9nsUvCpXvtUNSoYaC1sGYRMdfa210vxgo3nXweg2q7WWxpCR2aii7MH1'),
(101, 1, NULL, 'Drs. Awang Anwaruddin, M.Ed.', '195506261988031001', 'awang', '$2y$13$HtaF3rflHKymZTOH/2yVmeg./2kLQ/oWdkzceJechOga2D8KxJV2G', '', '8mTXNFQ39YO82BpUxGH9dM2c1YFH73dPYhuXIHCdOqHeKq2Xsn5BQX6hIYvPpn5O'),
(102, 1, NULL, 'Dr. H. Dedi A. Barnadi, Drs., SH., M.Si.', '195503171983011002', 'dedi0317', '$2y$13$BUmm6noClCbTCXIYOF0Dy.PA61t4U231W1fkD/vX4pVgz5pnBIOja', '', 'gV9zHaOpkUtpcFHQ9mQbs603GLVc1vv8xbFBzOaeDIuhcCfmuk1z9KByx0VXWiVq'),
(103, 1, NULL, 'Ir. Bambang Subagio, M.Si.', '195802141986031010', 'bambang0214', '$2y$13$cqCwIEiJFQq7.jZ9iw4DJuOpmwJ4.30uD8CtbqVh4HcbDyYVNsd6m', '', 'MInbN1iAcHXC6aGCl4UygacA1PJZMiZYI2iBZMVSJeUtMN6NSAPoziEVbLdfwdV7'),
(104, 1, NULL, 'Dr. Hj. Sri A. Kusumawardani, SH., M.Hum.', '195603201989032001', 'sri0320', '$2y$13$KQ13byQeoICmhbFhcvpHFu05PKXQl/7iGOaXVJiiYbu7IK0XbcTb6', '', 'zwrxcjVPY3vbouP6gYttieSJ3lnAxvahp1bFeq7X8KzLIj7wX5lclJLDqFkwHvra'),
(105, 1, NULL, 'Toni Syarif, S.Pd.', '198508302009121002', 'syarif', '$2y$13$qUJMewDU2SAqFaoLGfZz6eolIvurqSLkqQ3roKR9tQIHtBm.1iSDa', '', 'VzLZEJUFiJXbwmb4otR4QWXsNg16hf428rRvoF8hoy2Rwax0zIgkViUe3nilJVcs'),
(106, 1, NULL, 'Kenan Kurnia Hidayat, S.Psi., M.Psi.', '198406282014031001', 'kenan', '$2y$13$.vk7D6dJ4KIlf.Ihtg47P.nT/UOWpX9YnoXLcyu6zMNXvd695yLla', '', 'fQhVTCYP3cxOm6XYmICmhbHil6MWpsO09M6C5Ce5IIeCojXJXQM12BviJDmney0j'),
(107, 1, NULL, 'Nuniya Dwiwastie, S.Psi', '198505152014032001', 'nuniya', '$2y$13$kPOVLPNAA9wKcQM7WrkLReNeRZfoCD.kMpT6A4/ABXV5VGdEINYq2', '', 'BtKPalZZxmikLbO17YXOHg9eRd7hedxCuR7prsR2KDTF8cAJZA73MDnZuf3nlBVJ'),
(108, 1, NULL, 'Guruh Muamar Khadafi, S.IP', '19870929201403002', 'guruh', '$2y$13$moG1IHwPhhxjdteVX1WjxOVUVYKPJ7GEfOX2Tb15gWvXvUaCOccx.', '', 'PMvrEFoDHbVma8d1V3B9hT0BJPdGsrj8SmflJpDJrtWJD5r80UpsPHrS6nqlnHch'),
(109, 1, NULL, 'Yuwin Ella Chandean, SH.', '199003282014032003', 'yuwin', '$2y$13$d39EtK8IxQZzsvQil4hgQ.uMtdfFoD0fqGcaVB9aWLM9W6Dtp.Qw6', '', 'k481T3dO1iFSqxrZCIodYNcc9P1pnft050tvJobL4qZkoYmFVYyB8kxFegISK0Np'),
(110, 1, NULL, 'Rita Fuzi Lestari, A.Md.', '198906142014032001', 'fuzi', '$2y$13$Lb8uTDa65o2ZoGLqhVPd2.lHqT8xwQHDQHFrgMTeLosDB4vL9HfwG', '', 'BnA5UkpSJp4495LKd5FkQesk5TqfrXkk0TwNzT2IajOTSoAZTa7Oj9KxjSR0yI9l'),
(111, 1, NULL, 'Dewanggi Agsha Putri, S.Kom.', '199206202015022001', 'dewanggi', '$2y$13$YK1KlLsIXsyHQVmPavSSE.fdR.sB9ShgfvhMtdVCwVHk4y9Ly9mQ.', '', 'meEuhtC9Mz1zzYPgaLeJTKN9EqKC4GDshaup4GjxMXarKerHXR8WgZToQlEsTR2U'),
(112, 1, NULL, 'Elfira Pusparani.ST.', '198710112015022002', 'elfirapusparani', '$2y$13$xFFRK8RYnY1IyFmJnLJfjuZBWVyRrdOGVUNr/WwWJJXkpN.9AqBl.', '', 'sGLHfa9diPLulcz6NgVw8DYV27i7Y6oWt3syd7Mv7zsDWUf26ONLTc4RNLfCUvPZ'),
(113, 1, NULL, 'Ulifah, A.Md', '1985121720015022002', 'ulifah1985', '$2y$13$6.svaRfYTFWwlAps79d/mefdz9FLgQAjgvYchBEMtJnfKcyhcoht2', '', 'vUMEeKxwlUb1Y5KKsAuQ8yjfUktZi25t8cgcRcYYGN9ZUCSi9AGKGJ3Ob4Mfnqlj'),
(115, 1, NULL, 'Drs. Asna, M.Ed.', '195710161987031001', 'asna', '$2y$13$Af1FFlTSdeFZ8NcYQY0I..584uGvl5/NflZgvFai/AeLr1MFgze1e', '', 'lsNX3oKScqrmFs6Ru3bdC5k2JPb2BXpW9yjJl7JaqoSH8fVRg3oDFgjRV0wDrAWG'),
(119, 1, NULL, 'Wawan D. Setiawan, SH, M.Si.', NULL, 'wawan1117', '$2y$13$WQ62p9pQ9Q50hvBJaOgmj.n.Q7sBeErtU81Lhu77ezyaNMLsXdopS', NULL, 'MIZzkJK0MQip7TeWdCZNADaRTQGgxU8vObf0GmSRCYrpPXM7vP6X5U58B2FllkG3'),
(120, 1, NULL, 'Drs. Desi Fernanda, M.Soc.Sc.', NULL, 'fernanda', '$2y$13$S5SI98MLjtNUtxlVRjR/bufS7kQW0MUCvT87GNNl0/XdtV7YAqIy.', NULL, 'DWQwXESIlonFKdf0eCOhhRhlqHd6gzS9gZS8cfo8VqEwWmG9lgKIZF7yT7XP34rY'),
(121, 1, NULL, 'Ati Rahmawati, S.IP, ME.', NULL, 'ati', '$2y$13$YquUsTtmPpw38z0c.tDxGOzOzQm9vxVO12koZSEdUWJCTWtu.2jWC', NULL, 'qh52GcC9jmjdYFbKXABO1ezyWSEDvV6aSpdjPp6ZSVqaBha6tQNmve5waakcVfhj'),
(122, 1, NULL, 'Detty Kartika Sari, ST', NULL, 'detty', '$2y$13$94vsZ.w3BAbFfRMuNhHCHO0jKV1Bf.Pxb1up5id9Cd7ooypXsNhxe', NULL, 'UYV7hIN9EtuJ1sdaGKcRlgSgUbh49ONsAobZkiOOqD2qTQVJydOtNAyJkLz0GS1T');

-- --------------------------------------------------------

--
-- Table structure for table `penilai_peran`
--

CREATE TABLE `penilai_peran` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilai_peran`
--

INSERT INTO `penilai_peran` (`id`, `nama`) VALUES
(1, 'Self'),
(2, 'Superior'),
(3, 'Peer'),
(4, 'Subordinat');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role_id`) VALUES
(1, 'admin', '$2y$13$oldYIQRyEIKgUBrHM2oveemtdX6rEmMJ6G9QvA8KTbU1mdH87/VU2', 1),
(6, 'lorem', '$2y$13$FGlBu1zJnc7yKH1iz.Oog.F4CyBK1oDXEaMoNhhTOmIzPjEs7HRv6', 2),
(7, 'dolor', '$2y$13$eZpXQ4wNcng4ocAdRcp9MOvS7.8aHNmFKyr8ONr/LkPt1QQaYNySe', 1),
(8, 'superadmin', '$2y$13$8.cXBejJXdOy35ZlJ74mG.ff0E2N06NL/808v4uGMwOQHj/8gBSka', 2),
(9, 'sit', '$2y$13$.oEgoao7XUGRDxWAUov7Uuh3H.V0wZRRgAvHSa1OpJ4w1sSr4le9i', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatan_induk`
--
ALTER TABLE `kegiatan_induk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatan_kompetensi`
--
ALTER TABLE `kegiatan_kompetensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatan_kompetensi_rincian`
--
ALTER TABLE `kegiatan_kompetensi_rincian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatan_kompetensi_rincian_hasil`
--
ALTER TABLE `kegiatan_kompetensi_rincian_hasil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatan_penilai`
--
ALTER TABLE `kegiatan_penilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatan_status`
--
ALTER TABLE `kegiatan_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kompetensi`
--
ALTER TABLE `kompetensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kompetensi_jenis`
--
ALTER TABLE `kompetensi_jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kompetensi_old`
--
ALTER TABLE `kompetensi_old`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kompetensi_rincian`
--
ALTER TABLE `kompetensi_rincian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lembaga`
--
ALTER TABLE `lembaga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penilai_peran`
--
ALTER TABLE `penilai_peran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `kegiatan_induk`
--
ALTER TABLE `kegiatan_induk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kegiatan_kompetensi`
--
ALTER TABLE `kegiatan_kompetensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `kegiatan_kompetensi_rincian`
--
ALTER TABLE `kegiatan_kompetensi_rincian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `kegiatan_kompetensi_rincian_hasil`
--
ALTER TABLE `kegiatan_kompetensi_rincian_hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;
--
-- AUTO_INCREMENT for table `kegiatan_penilai`
--
ALTER TABLE `kegiatan_penilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `kegiatan_status`
--
ALTER TABLE `kegiatan_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kompetensi`
--
ALTER TABLE `kompetensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT for table `kompetensi_jenis`
--
ALTER TABLE `kompetensi_jenis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `kompetensi_old`
--
ALTER TABLE `kompetensi_old`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT for table `kompetensi_rincian`
--
ALTER TABLE `kompetensi_rincian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=393;
--
-- AUTO_INCREMENT for table `lembaga`
--
ALTER TABLE `lembaga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;
--
-- AUTO_INCREMENT for table `penilai_peran`
--
ALTER TABLE `penilai_peran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
