-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 28, 2016 at 12:50 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

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
  `kode` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `keterangan` text,
  `id_kegiatan_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `kode`, `nama`, `tanggal_mulai`, `tanggal_selesai`, `keterangan`, `id_kegiatan_status`) VALUES
(1, 'AB001', 'Kegiatan A', '2016-07-18', '2016-07-27', 'Keteranga Oke', 2);

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_kompetensi`
--

CREATE TABLE `kegiatan_kompetensi` (
  `id` int(11) NOT NULL,
  `id_kegiatan` int(11) DEFAULT NULL,
  `uraian` text,
  `cpr` varchar(20) DEFAULT NULL,
  `fpr` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan_kompetensi`
--

INSERT INTO `kegiatan_kompetensi` (`id`, `id_kegiatan`, `uraian`, `cpr`, `fpr`) VALUES
(1, 1, 'Uraian Lorem', '9', '4'),
(2, 1, 'oke', 'cpr', 'fpr'),
(3, 1, 'uraian', 'cpr', 'fpr'),
(4, 1, 'dadan', '2', '1'),
(5, 1, 'baru', '3', '3');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_kompetensi_rincian`
--

CREATE TABLE `kegiatan_kompetensi_rincian` (
  `id` int(11) NOT NULL,
  `id_kegiatan_kompetensi` int(11) DEFAULT NULL,
  `uraian` text,
  `cpr` varchar(20) DEFAULT NULL,
  `fpr` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan_kompetensi_rincian`
--

INSERT INTO `kegiatan_kompetensi_rincian` (`id`, `id_kegiatan_kompetensi`, `uraian`, `cpr`, `fpr`) VALUES
(1, 1, 'uraian Rincian A', '3', '5'),
(2, 5, 'sub rincian ', '4', '1'),
(3, 1, 'uraian B', '02', '23'),
(4, 1, 'Uraian C', '02', '22');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_kompetensi_rincian_hasil`
--

CREATE TABLE `kegiatan_kompetensi_rincian_hasil` (
  `id` int(11) NOT NULL,
  `id_kegiatan_kompetensi_rincian` int(11) NOT NULL,
  `id_kegiatan_penilai` int(11) NOT NULL,
  `hasil` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan_kompetensi_rincian_hasil`
--

INSERT INTO `kegiatan_kompetensi_rincian_hasil` (`id`, `id_kegiatan_kompetensi_rincian`, `id_kegiatan_penilai`, `hasil`) VALUES
(43, 1, 1, '7'),
(44, 3, 1, '6'),
(45, 4, 1, '5'),
(46, 2, 1, '10');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_penilai`
--

CREATE TABLE `kegiatan_penilai` (
  `id` int(11) NOT NULL,
  `id_kegiatan` int(11) DEFAULT NULL,
  `id_penilai_peran` int(11) DEFAULT NULL,
  `id_pegawai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan_penilai`
--

INSERT INTO `kegiatan_penilai` (`id`, `id_kegiatan`, `id_penilai_peran`, `id_pegawai`) VALUES
(1, 1, 1, 3),
(2, 1, 3, 8);

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
  `uraian` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kompetensi`
--

INSERT INTO `kompetensi` (`id`, `uraian`) VALUES
(1, 'Kompetensi');

-- --------------------------------------------------------

--
-- Table structure for table `kompetensi_rincian`
--

CREATE TABLE `kompetensi_rincian` (
  `id` int(11) NOT NULL,
  `id_kompetensi` int(11) DEFAULT NULL,
  `uraian` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) DEFAULT NULL,
  `nip` varchar(25) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `nama`, `nip`, `username`, `password`, `email`) VALUES
(3, 'Dr. H. Gering Supriyadi, MM', '195404071975011001', 'gering', '$2y$13$xrkIYQ5HcS5B.XxXX/1f7OEFwrbTE8tOubcrm2W5pKPQSDx7tvCMq', 'thomas.alfa.edison@gmail.com'),
(7, 'Wawan D. Setiawan, SH.,M.Si', '195411171986031001', 'wawan1117', '$2y$13$XgVHilxjoC/A/4TVFxg2AuVx0LKXhFqbL6M.XfYUNG4b89QbbFpAC', 'wawan.setiawan@lan.go.id'),
(8, 'Dra. Hj. Ara Ruhara, M.Si', '195601011986032001', NULL, NULL, ''),
(9, 'Dr. H. Baban Sobandi, SE.,M.Si', '196705011993031001', 'baban0501', '$2y$13$OEtNs2c.FJ/LTScrthysDO4FIAxIsnhjmVfK5cmIWMK4tE4tg9iJi', 'baban.sobandi@lan.go.id'),
(10, 'Dra. Yetty Ntseso, M.eng.', '196210231991032002', NULL, NULL, 'yntesso@yahoo.com'),
(11, 'Dr. H. Joni Dawud, DEA ', '196805311994011001', 'joni0531', '$2y$13$jy5nSwnuP9FFtBnfCOonPe5L6OzwmZuj0wp7HLdwmO8LRuDKBiili', 'joni.dawud@lan.go.id'),
(12, 'Dra. Nefi Aris Ambar A., MA', '196311251988032001', NULL, NULL, 'nefi_asmara@yahoo.com'),
(13, 'Drs. Dayat Hidayat, M.Si.', '196107021988031001', 'dayat0702', '$2y$13$CG8sbAHHfFNpEXycppAAiuqBqPcz5uhxensJbxzvpTsP9Pe4cxT1W', ''),
(14, 'Ir. Euis Nurmalia, MM', '196708811994012001', 'euis0811', '$2y$13$WMFWKUsv4qzqYqCAX9j5eeQf84xJartmj45AZP7uFlAda/P7fd1TO', ''),
(15, 'Drs. Riyadi, M.Si.', '196711301994031001', 'yadi1130', '$2y$13$1CMfWf4A5oe2iPTf5yPrVOs55BpciXqVwhz0Ge6KlNt.F6GqsQO2m', 'Rydonks10@gmail.com'),
(16, 'Hari Nugraha, SE.,MPM.', '196810131994011001', 'hari1013 ', '$2y$13$09Prt1Srr/.saipt6O3xZu9WE3oDrh3M9F1ah.qef2DR/MAbErCVK', 'phadika@yahoo.com'),
(17, 'Dra. Enni Iriani, M.Ed.', '196207091989032001', 'enni0709  ', '$2y$13$XHuW6pmJKQTt9oXSxPPOOecmwmsKnNnHwofnDAy6HyYx.k9dYe4fq', 'Enni_iriani@yahoo.com'),
(18, 'Drs. Sabar Gunawan, MA', '196512051996031001', NULL, NULL, ''),
(19, 'Rahmat, S.Pd.,MA.', '197103031996031001', NULL, NULL, ''),
(20, 'Drs. Syarifudin Hidayat, M.Si      ', '196001011989031001', 'syarif0101', '$2y$13$.JwxqkwqwrPj9KKkP/tbWOu5nWrYdf5QFCZZxNsWtlEJhN1edk7ia', 'Syarif_lan@yohoo.com'),
(26, 'H. Gugum Gumelar, SH.          ', '196109171993031001', 'gugum0917', '$2y$13$KDqlglWMSFTxAW2AkPWF0OURhSsShisgdOL1STkVLKaXuxq2F4pwK', 'gilangprat@yahoo.com'),
(27, 'Dra. Marifa Ayu Kencana, MIS  ', '196804081993032001', 'ana0408', '$2y$13$adYrTZW0ZRd/rnkSXFtCoO5Dr1ePb/0ghpnsO61lBedJvHpBMyvjm', 'shezheana@yahoo.com'),
(28, 'Anita Ilyas, S.Sos.         ', '196409261988032001', 'nita0926', '$2y$13$Pmi9SbGm4ataa4eBak8MjOZqV4HdaCJKwKZp/p9sJ1piGZv3ZsOlm', 'anita_ilyas@yahoo.com'),
(30, 'Sukarna, S.Sos   ', '196302161985031001', 'karna0216', '$2y$13$E5w8yfrdjC26FF2VLazIjeHsUFOsmkoAqnxxTzo9N.BSkUSe1.DL.', ''),
(31, 'Zulpikar, S.Sos, MM.       ', '197305131997021001', 'zulpikar0513', '$2y$13$Ggj2scj1o8l.ZtHqx7Y02.9zMcRFlRWg0LxUnJFYzjOyq348a7Kh2', 'zzulpikar@yahoo.com'),
(32, 'Ade Juariah, S.Sos.          ', '196307151991032001', 'juariah0715', '$2y$13$kWuyayZ5Br52M2.ZiblfdujfF45B28is5Ux4d9Pqtjf2aDTx0hLqe', ''),
(33, 'Haris Rusmana, A.Md               ', '196612181985031001', 'haris1218', '$2y$13$GsX7Jdm8cLDhuUyABmT9le44324ipMB2WcprsKIe4fcVs3uddZabq', 'harisrck@yahoo.com'),
(34, 'Putri Wulandari A. Rejeki, S.Si., ME.', '198202172005012001', 'putri0217', '$2y$13$ehXY6UR1M6UIwYY9RwZ5gOPH8cQsJumLbyBkC1OB80TGMPcgqQVrS', 'pu3_wulandari@yahoo.com'),
(35, 'Awan Hari Murtiadi, SE', '197603262003121001', NULL, NULL, ''),
(36, 'Suryati  ', '19680620-198903-2-001', 'inay0620', '$2y$13$wUOgxDzlzD/cWdTfXalQ4.CgjuGtN3FtEeEjwU0M1w00c3L2yVXtS', 'innay_lanbandung@yahoo.co.id'),
(37, 'Lilis Multati, S.Sos.                                  ', '19640105-198303-2-001', 'lilis0105', '$2y$13$KIpu9LIe5lS51O72IU2WZOXf9eAhrJ5qQXvljEeYd.EuChUeB5GYa', ''),
(38, 'Krismiyati, ST., M.Ec.', '19780525-200604-2-002', 'kris0525', '$2y$13$qb38gL0cEEvAsRcJ1h0qQe8UB4HoTcH6zvjlcxYDMYw3EJCXbBA3m', 'chrissie_tasri@yahoo.com'),
(39, 'Yudiantarti Safitri, SE.                  ', '19830927-200604-2-004', NULL, NULL, 'yudiantarti_safitri@yahoo.co.id '),
(40, 'Susy Ella, S.Si.        ', '19821023-200804-2-001', 'ella1023', '$2y$13$Dhtrjd7VbOVDIqWi6rQgeOFI1wOGpiPWwaAMxju5aw.CqaN427BMO', ''),
(41, 'Novel Saleh Seff, S.Sos.      ', '19710820-200112-1-001', 'novel0820', '$2y$13$YMxFTI1T/qxxSydD3ElGtuelND4Dmi95vPajvBlD/Ru.jicrd8Ca6', 'novi2071@yahoo.com'),
(42, 'Tia Setiawati, S.Si.', '19821208-200604-2-001', 'tia1208', '$2y$13$G6SwNHpjkWunwmdcS/3Na.7frnS4BGnXWkwzHqbEbUkh05DCAZ1zq', 'tia_812@yahoo.com / tia812@gmail.com'),
(43, 'Agus Wahyuadianto, S.Psi., SE.    ', '19790802-200804-1-002', 'agus0802', '$2y$13$dGkqAZVzte9hpX2NrhA93.gYRps1T3mLy6LFVgz5YVqZCiVgpxHey', 'adianto123@yahoo.com'),
(44, 'Depdi Respatiawan, SE.   ', '19801009-200804-1-002', 'depdi1009', '$2y$13$h8mhWNfub813T/kHybscLOKnbKrIT9vvNlPGKYbMB8FTCsb945AFG', 'depdirespatiawan@yahoo.co.id / depdimenoreh@yahoo.com'),
(45, 'RR. Harida Indraswari, S.Sos.    ', '19820926-200804-2-002', 'rida0926', '$2y$13$fX/.aGtBfx69dc6UJ.rd3eNU9A9tq0Ir7if6JxcaH5XoGGh.lCLmS', 'harida.indraswari@gmail.com '),
(46, 'Wuri Indri Pramesti, S.Sos.,M.BIS          ', '19800628-200804-2-001', 'wuri0628', '$2y$13$kMPIlOW.ShDinFOeozGig.McjN6t0wfDUMI2N8/lKdIdcaDN1yw6m', ''),
(47, 'Yunni Susanty, SE.      ', '19850608-200804-2-001', 'yunni0608', '$2y$13$ZLQRF/q3SZNoy1YaBTq6e.Oyuz7X3..jEwsoAsBFzqZ.VLsDZyHAq', 'yunni.susanty@yahoo.com '),
(48, 'Kurnia Anggraeni Dewi, ST.           ', '19730505-200501-2-001', 'nia0505', '$2y$13$WZf4NMPb4MmK.faLIw.ntu54JAGhp6WiYwN.WX5/e3OBQwY7om586', 'nhiya55@gmail.com/kurnia_angraeni@yahoo.com'),
(49, 'Ade Suhendar, ST.       ', '19810902-200804-1-001', 'suhendar0902', '$2y$13$exSy2Fhu8JMOQmK9iw.8lu1ixN3dRDxwnSDJWRYrlHsSFBkiCEsPa', 'adesuhendar_99@yahoo.co.id'),
(50, 'Yuyu Yuningsih, SE.  ', '19811120-200804-2-001', 'yuyu1120', '$2y$13$v1eGQoHnxNy7mc6PyhYZy.EIHIZjXA9Vh3Lcs5ZMEgdFwPZEgU/a6', 'nie_you2@yahoo.com'),
(51, 'M. Dani Ramadansyah, ST.', '19820701-200804-1-001', 'dani0701', '$2y$13$97jtliqUDytJwGO2GYC.7uREv24jvzam1Wt6t78tZCR2AvnEDSN9S', 'dramadansyah@yahoo.com'),
(52, 'M. Fahrurozi R. Nasution, S.Psi. ', '198207092009121003', 'fahrul0709', '$2y$13$HSjhNurpiVpie0mQwPCLfuhF51yZ0W2HH2rMLbPAavouHw6JEq3wu', 'fahrulnasution@gmail.com/fahrulnst@gmail.com'),
(53, 'Rosita Novi Andari, S.Sos.    ', '19861105-200912-2-002', 'pipin1105', '$2y$13$gNKOmcM1c6bBwUJPg5VDiu1XdtYePAxoSLIwRPMUeFhW.UIv6odDm', 'rositanovi@gmail.com / rose_mile86@yahoo.co.id'),
(54, 'Shafiera Amalia, S.IP.       ', '19860222-200912-2-002', 'fira0222', '$2y$13$ywihHyXCgsbpZg00N00lzeFtD2DyIlRjgX4Jqb1kwrAzAq/ropv0i', ''),
(55, 'Rizky Fitria, SE', '19880602-200912-2-002', NULL, NULL, 'fitria.rizky@gmail.com / frizky26@yahoo.com'),
(56, 'Sulistianingsih, S.Pd.           ', '19840923-200912-2-002', 'sulis0923', '$2y$13$/6wwpnRx6A3nJu2B7XrIc.3EQnpDNlZzbzKlg7AYbTCRnXoKyy726', 'liez_tia84@yahoo.com'),
(57, 'Muhammad Afif Muttaqin, S.Sos.    ', '19860417-200912-1-001', 'afif0417', '$2y$13$Fs0rhu08B3HZCKdvCEtjpOMPu2pH0N8WcpvlpSVSp/dsWDH1tZ1Q2', 'gopips786@9mail.com'),
(58, 'Wahyudin                      ', '19630830-198503-1-002', 'wahyu0830', '$2y$13$Q51HWw14Fv8oQk6njelSmubl2.n/GwThr078oSutokuZhqisKa536', ''),
(59, 'Suparni              ', '19630706-198503-2-012', 'parni0706', '$2y$13$ZSDka99JZK1YhDyoiD8Kku8L9BKKqH93yCCmVpY1loVRGQus1mcG.', ''),
(60, 'Tanti Piani Puspita, A.Md.               ', '198005072005012001', 'tanti0507', '$2y$13$wtyh3svI/g4z.x4KJGppku1IaVJr4.cW6szLWL06qoOr43nOjO9.2', 'humainah_ku@yahoo.com'),
(61, 'Dikdik Hendarin, A.Md.          ', '19741001-200501-1-001', 'dikdik1001', '$2y$13$bCsx5Hc2DNnmFpbBJyisWeC/C9Kx7ofNDa6VJ1MSGGCe2WnfBFjtG', ''),
(62, 'Holidin                 ', '19640420-199103-1-001', 'holidin0420', '$2y$13$ycQ2MMTNdQW0tF1mWkBmUOJlTF0fB50/5wq44zmThJvRDEJhUccMi', ''),
(63, 'Tino Trisno Mulya, S.Sos.        ', '19720816-200212-1-001', 'tino0816', '$2y$13$POoLNpMCSSQnbIa4pJ9XK..74TI7sHS1P8VOSOUJbXYhmebwJhniC', 'tino.mulya@yahoo.com '),
(64, 'Rahmawati, A.Md.,SAP            ', '19790502-200804-2-002', 'rahma0502', '$2y$13$syYCTyvWJXuCURoEDMjz9.wlJv6Oswdl0mFG8TXpCCtj/TY/6TWNm', 'rahma_d2@yahoo.com'),
(65, 'Kezia Larasati Suparno, A.Mk.         ', '19810508-200912-2-00', 'kezia0508', '$2y$13$HM.fTC04b/L.ccSVpfNz/eUDuEL8r6wx1PXsv3VAw2NuGoHEWAqgi', 'Kezia_larasati_s@yahoo.com'),
(66, 'Sujono           ', '19600803-199103-1-001', 'jono0803', '$2y$13$v0ska/XTjRymvPmRFArAYecAAUEsTZMJksLonzc97k/tev8pk7S.e', ''),
(67, 'Jujun Junaedi       ', '19650914-199103-1-001', 'jujun0914', '$2y$13$93eNS9soQANZv.dED5BJROhImmwZUJ26W3qFfu3OqP7Bz.Mnm/JRO', ''),
(68, 'Priswanti Rahayu, S.Sos.    ', '19820418-200312-2-001', 'pris0418', '$2y$13$7eJc4QUCsA6N1Yq8QsILT.BVLY9mgxkLopdZP368xuDEbRZtYNmjW', 'priswanti_rahayu@yahoo.co.id  priswantirahayu@yahoo.com '),
(69, 'Budi Permana,S.Sos          ', '197502202005011001', 'budi0220', '$2y$13$n05O00q//5ZfTVlRn4lKm.TZBxLboZb6l9srYpgaJCEJpIFMHPC0G', 'hulk0275@yahoo.com'),
(70, 'Indra Risni Utami    ', '19820913-200501-2-001', 'indra0913', '$2y$13$ohBz3evasrt1NxMgK7XleOFcLnf8okkfCp9MKoDlrpt8d5Mo5TC5m', 'indra_lanbdg@yahoo.com  ym: iyamagnifique@yahoo.co.id'),
(71, 'Tata Tardiyat     ', '19690917-200604-1-002', 'tata0917', '$2y$13$m1bHitbjiTYFCUtpWNgx1e0H6E10rUHL64IhlXEcMwy2KcDjuMSo.', 'tata_tardiyat@yahoo.com'),
(72, 'Andi Sutisna          ', '19670808-200604-1-004', 'andi0808', '$2y$13$q8POY9p.J9IPA84Nf3499.gWlXw6SlGp09pMCnK0.lxlP8ggBFIvK', ''),
(73, 'Sumarna          ', '19650202-200604-1-002', 'sumarna0202', '$2y$13$yJ7UKVPF3v.Kz2blo9sOG.YHx4oJ/qih3UdQlKmWZyMFMth31IjLq', ''),
(74, 'Hidayat           ', '19630706-200604-1-003', 'aay0706', '$2y$13$oXnBZDmOoN9Pe3uLMz98t.tOx2wGYu2dqo791JlJz/V3R0R7CRbuq', ''),
(75, 'Denar Lukmansyah   ', '19640630-200604-1-001', 'denar0630', '$2y$13$NkVDHJ7/3D1lsKn3X5GJFOXERbglt8Ao7tgGkhIo74QLI0GStWhpC', ''),
(76, 'Opan Sopandi              ', '19680727-200604-1-007', 'opan0727', '$2y$13$REGZc8AkhL3g04vL8o7ENu2HNzUPdUxUCEfeCx.jFcdO2eXTs.CK.', ''),
(77, 'Herdy Erawan     ', '19630724-200604-1-001', 'herdi0724', '$2y$13$6NZ7JsKFDRdNOMBtPikAc.vlBmN8kVE4e0mJQZXthShoZqleCqL0i', ''),
(78, 'Didi Supriyadi        ', '19630805-200604-1-001', 'didi0805', '$2y$13$cs9KxN54QhRoZKBqPxw8q.0Q2IuomwkU9O5955bcaEU8VtkBVFhNC', ''),
(79, 'Nasep Soviana      ', '19640717-200604-1-001', 'nasep0717', '$2y$13$qVtk0uZiN108S00fkgmJXO11GGXH3mKUk9FVhCgEJME.b5BT2LCwG', ''),
(80, 'Ano          ', '19670903-200604-1-002', 'ano0903', '$2y$13$3LbyJpGMq4EY2MD8o3crfOxIvCiiRehJXkfUu37S2.NtViDPuakg.', ''),
(81, 'Maman Suparman         ', '196403102007011002', 'maman0310', '$2y$13$mXyl9cSfquqKcarTre8fx.nofzm/UMNE/ijbyu0dqOpdw7PqP2f.G', ''),
(82, 'Dana Sutisna       ', '19681115-200701-1-002', 'dana1115', '$2y$13$xaEJTk6bAfPGvEJ7ZAgvF.rFZON3sL7KBUN2cUrlFyZ/ylLkadRpi', ''),
(83, 'Erni Driyantini, SAB         ', '19820526-200501-2-001', 'erni0526', '$2y$13$NcODLnj6M6sUPiOevPRRt.r0S4QegcNTUlc4.gD1QcNg1uh9qbbHi', 'ernilan@gmail.com'),
(84, 'Mujiono           ', '19670224-200604-1-002', 'muji0224', '$2y$13$8bKd8jRR/YbCO3G0pbLPX.aJabcD4JMadQCBPnbGzEvE4aVP5S18O', ''),
(85, 'Jeje Hidayat            ', '19700711-200604-1-003', 'jeje0711', '$2y$13$OKSa7RmRWICyOu5bp87FauFrJsmdk1XqzU1S94xApS6.NV5ILDrh6', ''),
(86, 'Enang                ', '19731023-200701-1-002', 'dadang1023', '$2y$13$3efWo6awP.iqaw1eX6vEluCKq5Kv5IhUEpjFUwVdHgOW1SbE0BDaq', ''),
(87, 'Pratiwi, S.Sos', '198703152011012015', 'tiwi0315', '$2y$13$N5wK3scC05tqDGs0Uox72eKu0piENTk4gfydWdpAF2R3z5tzzrJxm', 'pratiwisaja@ymail.com pratiwi_saja@yahoo.com'),
(88, 'Octarian Wirahadi Kusuma, SH', '198410102011011023', 'rian1010', '$2y$13$Hq4N/1U5I134tGF4qfkRy.3V15weOCjsDJ0obnKJDQ8uY1/X/QSYy', 'octarianwirahadik@yahoo.com'),
(89, 'Pupung Puad Hasan, SE., M.Ec.Dev.', '198308072011011008', 'pupung0807', '$2y$13$silcXQkJe3A32c/wp90n9uvDwLlT/fs./HNGKHbfGP7qM0TEAV4ZW', 'pupungph@gmail.com'),
(90, 'Budi Prayitno, S.IP., M.Si', '198206272011011009', NULL, NULL, 'Budi_cun2@yahoo.com Mekrat_teran@yahoo.co.id'),
(91, 'RR. Esty Widyaningsih, S.Pi., M.Si', '198401282011012010', 'esty0128', '$2y$13$onoWh1.PBGxaGnxcB1mlGOd/T/92Cw1CmGkpd68nfrsfNrddCwWwu', 'st.widya@yahoo.com'),
(92, 'Danik Wijayanti, S.Psi, M.Psi', '198011202011012006', 'danik1120', '$2y$13$Hbz.P3ihl2TYKmrxCC2ObuadZeKCA.0oH0VLzufRSUxkQoFATAhC2', 'danik_sweet@yahoo.com'),
(93, 'Iman Arisudana, S.Sos., MA', '198204042011011011', 'iman0404', '$2y$13$FXw79YDl/tjnHrDLrma5hezXa73VzJTLV1KLWBu1A5QrVqo.uWeJa', 'pidadh@yahoo.com'),
(94, 'Nurhusna Frinovia, St., S.Psi., M.Psi', '197811172011012008', 'novi1117', '$2y$13$9Yurbk8cwiEdpWIHEUHO0u93vclq1V71L9FjEU6QXc5xerxiZnsFq', 'Nurhusna.frinovia@yahoo.com'),
(95, 'Dewi Ariani Hertina, S.Psi', '198501032011012015', 'dewi0103', '$2y$13$AD9LQq2EQWSJVmu10w.9HuFpvC6BxLsC4D9aWyJhv6cUJ.a5KwIEe', 'Dewi.ariani@gmail.com'),
(96, 'Candra Setya Nugroho, SH', '198807012011011006', 'candra0701', '$2y$13$F6rTY.Jb36HpcFOy8KehcedhqodvpZxZ.yzBY4SoEGCtJ/nv8CVkW', 'candrasetyanugroho@yahoo.com'),
(97, 'Ir. Dayat Nurhayat SW, M.Sc.', '195609061987011001', 'dayat0906', '$2y$13$kEdyou98XLL7r/DTRGG9RuP162/LpolaQYXMfLCSS395kO4bKkniq', ''),
(98, 'Ir. Dayat Nurhayat SW, M.Sc.', '195609061987011001', NULL, NULL, ''),
(99, 'Dr. Satwiko Darmesto', '195304291975031002', 'satwiko0429', '$2y$13$/Ki4T6fduI09VgTBDRYWUePBqcjt6FeTuaWSaoWXZgyEBhz1oVWh2', ''),
(100, 'Dr. Ir. TB. Hisni, M.Si.', '195308171979101003', NULL, NULL, ''),
(101, 'Drs. Awang Anwaruddin, M.Ed.', '195506261988031001', 'awang0626', '$2y$13$WXiVlvBGin9vNEu3nlPt9e6/poPbWeuYKqnIpNP.xx7MzapKEKrOK', ''),
(102, 'Dr. H. Dedi A. Barnadi, Drs., SH., M.Si.', '195503171983011002', 'dedi0317', '$2y$13$UE2p.8gXntgdruS5nNIXSOvy3nSFQIUmxcPx4KxM3khtaKylveVQy', ''),
(103, 'Ir. Bambang Subagio, M.Si.', '195802141986031010', 'bambang0214', '$2y$13$EkOsKHbwMZUM5JQsM585xeLzhL.brCDuoungY4FUI6dz70XZG3i2m', ''),
(104, 'Dr. Hj. Sri A. Kusumawardani, SH., M.Hum.', '195603201989032001', 'sri0320', '$2y$13$QOFnw5QX16AfFpeUMmXn5.o6Kv8XNFWuFlc6ENBpU0cEmxWOaVr12', ''),
(105, 'Toni Syarif, S.Pd.', '198508302009121002', 'syarif', '$2y$13$4wY342fOn41swXni4.Zueehv31K1p63Mu6J4xagKpINhKO0s4LRu.', ''),
(106, 'Kenan Kurnia Hidayat, S.Psi.,M.Psi.,Psikolog', '198406282014031001', NULL, NULL, ''),
(107, 'Nuniya Dwiwastie, S.Psi', '198505152014032001', NULL, NULL, ''),
(108, 'Guruh Muamar Khadafi, S.IP', '19870929201403002', NULL, NULL, ''),
(109, 'Yuwin Ella Chandean, S.H.', '199003282014032003', NULL, NULL, ''),
(110, 'RITA FUZI LESTARI, AMd', '198906142014032001', NULL, NULL, ''),
(111, 'Dewanggi Agsha Putri, S.KOM', '199206202015022001', NULL, NULL, ''),
(112, 'Elfira Pusparani.ST.', '198710112015022002', NULL, NULL, ''),
(113, 'Ulifah, A.Md', '1985121720015022002', NULL, NULL, ''),
(114, '', '', NULL, NULL, ''),
(115, 'Drs. Asna, M.Ed.', '195710161987031001', NULL, NULL, ''),
(117, 'Dadan Satria', '212100063', 'Aldanzein', 'aldanzein', 'dans_bsj@yahoo.co.id');

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
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role_id`) VALUES
(1, 'admin', 'bisabisa', 1),
(2, 'fahrul0709', 'fahrul0709', 1),
(3, 'denar0630', 'denar0630', 2),
(4, 'rita', 'rita', 1),
(5, 'hari1013', 'rita', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
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
-- Indexes for table `kompetensi_rincian`
--
ALTER TABLE `kompetensi_rincian`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kegiatan_kompetensi`
--
ALTER TABLE `kegiatan_kompetensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `kegiatan_kompetensi_rincian`
--
ALTER TABLE `kegiatan_kompetensi_rincian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `kegiatan_kompetensi_rincian_hasil`
--
ALTER TABLE `kegiatan_kompetensi_rincian_hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `kegiatan_penilai`
--
ALTER TABLE `kegiatan_penilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kegiatan_status`
--
ALTER TABLE `kegiatan_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kompetensi`
--
ALTER TABLE `kompetensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kompetensi_rincian`
--
ALTER TABLE `kompetensi_rincian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;
--
-- AUTO_INCREMENT for table `penilai_peran`
--
ALTER TABLE `penilai_peran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
