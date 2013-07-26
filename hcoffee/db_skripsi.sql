-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 13, 2013 at 06:24 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_skripsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `msaccount`
--

CREATE TABLE IF NOT EXISTS `msaccount` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(23) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `encrypted_password` varchar(80) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `status` enum('Active','Non-Active') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `unique_id` (`unique_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `msaccount`
--

INSERT INTO `msaccount` (`uid`, `unique_id`, `name`, `email`, `encrypted_password`, `salt`, `status`, `created_at`, `updated_at`) VALUES
(1, '50dff0a8a9a790.63717319', 'Wahyu Aditya Nugraha', 'blaxxbear@gmail.com ', 'mXWeTP12VeDcaDcpeFoUJ/H31UI4NDI5MTg4ZGU4', '8429188de8', 'Active', '2012-12-30 14:43:36', NULL),
(3, '50e2ad42369085.29974755', 'Yasin', 'yasin@gmail.com', 'tVBw8p9bInPwZkv7SsD4UmJ9rnY3ZWRkM2MzOTNm', '7edd3c393f', 'Active', '2013-01-01 16:32:50', NULL),
(4, '50e9aac80b1aa7.75718674', 'Miranty Lestary', 'miranty@gmail.com', 'ftjE5xA7yMa6z6XYrCNY296qurEzMjcwZjNjOTVm', '3270f3c95f', 'Active', '2013-01-06 23:48:08', NULL),
(5, '50f2f39b445741.48284120', 'Test', '', '2mK853kC3n8BswDofBQ0GUoaxGJjN2RiZWE5Nzhh', 'c7dbea978a', 'Active', '2013-01-14 00:49:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mscoffee`
--

CREATE TABLE IF NOT EXISTS `mscoffee` (
  `Coffee_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Coffee_Name` varchar(255) NOT NULL,
  `Coffee_Status` enum('Active','Non-Active') NOT NULL,
  `Coffee_Description` text NOT NULL,
  `Date_Entry` date NOT NULL,
  `Date_Updated` date NOT NULL,
  `User_ID` varchar(255) NOT NULL,
  PRIMARY KEY (`Coffee_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `mscoffee`
--

INSERT INTO `mscoffee` (`Coffee_ID`, `Coffee_Name`, `Coffee_Status`, `Coffee_Description`, `Date_Entry`, `Date_Updated`, `User_ID`) VALUES
(8, 'Robusta', 'Active', 'Robusta', '2012-12-23', '2012-12-23', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `msdiseases`
--

CREATE TABLE IF NOT EXISTS `msdiseases` (
  `Diseases_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Coffee_ID` int(11) NOT NULL,
  `Diseases_Name` varchar(255) NOT NULL,
  `Diseases_Latin` varchar(250) NOT NULL,
  `Diseases_Image` varchar(250) NOT NULL,
  `Diseases_Status` enum('Active','Non-Active') NOT NULL,
  `Diseases_Description` text NOT NULL,
  `Diseases_Medicine` text NOT NULL,
  `Date_Entry` date NOT NULL,
  `Date_Updated` date NOT NULL,
  `User_ID` varchar(255) NOT NULL,
  PRIMARY KEY (`Diseases_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `msdiseases`
--

INSERT INTO `msdiseases` (`Diseases_ID`, `Coffee_ID`, `Diseases_Name`, `Diseases_Latin`, `Diseases_Image`, `Diseases_Status`, `Diseases_Description`, `Diseases_Medicine`, `Date_Entry`, `Date_Updated`, `User_ID`) VALUES
(1, 8, 'Karat Daun Kopi', 'Hemileia vastatrix', 'Screen_Shot_2013-01-09_at_10.29_.43_PM_.png', 'Active', 'Penyakit karat daun kopi disebabkan oleh H. vastatrix yang dapat menyerang dipembibitan sampai tanaman dewasa. Gejala tanaman terserang, daun yang sakit timbul bercak kuning kemudian berubah menjadi coklat (lihat gambar). Permukaan bercak pada sisi bawah daun terdapat uredospora seperti tepung berwarna oranye atau jingga. Pada serangan berat pohon tampak kekuningan, daunnya gugur akhirnya pohon menjadi gundul.', 'Pengendalian penyakit dengan memperkuat kebugaran tanaman melalui pemupukan berimbang, pemangkasan dan pengaturan naungan untuk mengurangi kelembaban kebun dan memberikan sinar matahari yang cukup pada tanaman.\r\nPenanaman varietas kopi yang tahan atau toleran merupakan cara yang perlu diperhatikan, seperti: S 795, S 1934, USDA 62, Kartika 1 dan 2.', '2012-12-23', '2013-01-09', 'miranty@gmail.com'),
(2, 8, 'Bercak Daun Kopi', 'Mycosphaerella coffeicola', 'Screen_Shot_2013-01-09_at_10.34_.19_PM_.png', 'Active', 'Penyakit ini disebabkan oleh jamur C. coffeicola yang dapat muncul di pembibitan sampai tanaman dewasa serta menyerang buah kopi. Daun yang sakit timbul bercak berwarna kuning yang tepinya dikelilingi halo (lingkaran) berwarna kuning. Buah yang terserang timbul bercak berwarna coklat, biasanya pada sisi yang lebih banyak menerima cahaya matahari. Bercak ini membusuk dan dapat sampai ke biji sehingga menurunkan kualitas.', 'Pengendalian penyakit dengan sanitasi kebun dan membuang bagian-bagian yang sakit, kemudian membenamkannya di dalam tanah. Mengurangi kelembaban kebun dengan pemangkasan, pengaturan naungan dan membuat parit drainase. Melakukan pemupukan dan hindari penggunaan bibit yang telah terserang penyakit ini.', '2012-12-23', '2013-01-09', 'miranty@gmail.com'),
(6, 8, 'Jamur Akar Coklat', 'Phellinus noxius', 'Screen_Shot_2013-01-09_at_10.39_.07_PM_.png', 'Active', 'Gejala tanaman terserang warna daun hijau kekuningan, kusam, layu dan menggantung. Seluruh daun menguning kemudian layu secara serempak, akhirnya mengering di cabang.nGejala khas jamur akar coklat, terutama akar tunggang tertutup oleh kerak yang terdiri dari butir-butir tanah yang melekat kuat. Diantara butir-butir tanah tampak adanya anyaman benang jamur coklat kehitaman. kayu akar yang sakit membusuk, kering dan lunak.', 'Membongkar pohon terserang sampai keakarnya, lalu membakar. Lubang bekas bongkaran dibiarkan terbuka selama + 1 tahun. Pohon sehat disekitar pohon sakit dan pohon-pohon sisipan ditaburi Trichoderma 200 gr/pohon dan pupuk kandang/pupuk organik. Diulang setiap 6 bulan sampai areal tersebut bebas dari jamur akar.', '2013-01-09', '2013-01-09', 'miranty@gmail.com'),
(4, 8, 'Nematoda', 'Pratylenchus coffeae', 'Screen_Shot_2013-01-09_at_10.34_.52_PM_.png', 'Active', 'Pratylenchus coffeae dan Radopholus similis adalah jenis nematoda endoparasit yang berpindah-pindah. Daur hidup P. coffeae sekitar 45 hari dan R. similis 1 bulan.nTanaman kopi yang terserang kelihatan kerdil, daun menguning dan gugur. Pertumbuhan cabang-cabang primer terhambat sehingga menghasilkan sedikit bunga, buah prematur dan banyak yang kosong. Bagian akar serabut membusuk dan putus sehingga habis. Pada serangan berat tanaman akhirnya mati.', 'Pengendalian dilakukan dengan memberikan pupuk kandang 12 kg/ pohon/tahun. Membongkar pohon kopi yang terserang berat. Untuk mencegah penularannya perlu dibuat parit isolasi disekeliling tanaman sakit (dalam 40 cm dan lebar 30 cm) pada jarak 60 cm dari pangkal akar. Menanam jenis kopi yang tahan untuk digunakan sebagai batang bawah, misalnya: kopi ekselsa, kopi robusta klon BP 961.\r\nAkar kopi yang diserang nematoda (kanan) dan yang masih sehat (kiri)\r\nBulu akar hilang akibat serangan nematoda', '2012-12-23', '2013-01-09', 'miranty@gmail.com'),
(5, 8, 'Jamur Upas', 'Corticium salmonicolor', 'Screen_Shot_2013-01-09_at_10.36_.31_PM_.png', 'Active', 'Jamur C. salmonicolor dapat menyerang batang, cabang, ranting dan buah kopi. Infeksi jamur ini pertama kali terjadi pada sisi bagian bawah cabang ataupun ranting. Serangan dimulai dengan adanya benang-benang jamur tipis seperti sutera, berbentuk sarang laba- laba. Selanjutnya pada bagian tersebut terjadi nekrosis kemudian membusuk sehingga warnanya menjadi coklat tua atau hitam.nNekrosis pada buah bermula dari pangkal buah disekitar tangkai, kemudian meluas keseluruh permukaan dan mencapai endosperma.', 'Batang dan cabang sakit dipotong sampai 10 cm di bawah pangkal dari bagian yang sakit. Potongan- potongan ini dikumpulkan kemudian di bakar. Memetik buah-buah yang sakit, dikumpulkan dan dibakar atau dipendam. Pemangkasan pohon pelindung untuk mengurangi kelembaban kebun sehingga sinar matahari dapat masuk ke areal pertanaman kopi.\r\nJamur upas pada buah kopi', '2013-01-04', '2013-01-09', 'miranty@gmail.com'),
(7, 8, 'Jamur Akar Hitam', 'Rosellinia bunodes', 'Screen_Shot_2013-01-09_at_10.39_.00_PM_.png', 'Active', 'Gejala tanaman terserang warna daun hijau kekuningan, kusam, layu dan menggantung. Seluruh daun menguning kemudian layu secara serempak, akhirnya mengering di cabang.Gejala khas jamur akar hitam, pada pangkal batang dan permukaan kayu akar terdapat titik-titik hitam', 'Membongkar pohon terserang sampai keakarnya, lalu membakar. Lubang bekas bongkaran dibiarkan terbuka selama + 1 tahun. Pohon sehat disekitar pohon sakit dan pohon-pohon sisipan ditaburi Trichoderma 200 gr/pohon dan pupuk kandang/pupuk organik. Diulang setiap 6 bulan sampai areal tersebut bebas dari jamur akar.', '2013-01-09', '2013-01-09', 'miranty@gmail.com'),
(8, 8, 'Jamur Akar Putih', 'Rigidoporus microporus', 'Screen_Shot_2013-01-09_at_10.39_.00_PM_.png', 'Active', 'Gejala tanaman terserang warna daun hijau kekuningan, kusam, layu dan menggantung. Seluruh daun menguning kemudian layu secara serempak, akhirnya mengering di cabang.namur akar putih pada permukaan akar terdapat benang jamur berwarna putih menjalar sepanjang akar dan pada ujungnya meluas seperti bulu. Penyebaran dan perkembangan penyakit lebih cepat pada tanah berpasir dan lembab.', 'Membongkar pohon terserang sampai keakarnya, lalu membakar. Lubang bekas bongkaran dibiarkan terbuka selama + 1 tahun. Pohon sehat disekitar pohon sakit dan pohon-pohon sisipan ditaburi Trichoderma 200 gr/pohon dan pupuk kandang/pupuk organik. Diulang setiap 6 bulan sampai areal tersebut bebas dari jamur akar.', '2013-01-09', '2013-01-09', 'miranty@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `mssymptom`
--

CREATE TABLE IF NOT EXISTS `mssymptom` (
  `Symptom_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Symptom_Name` varchar(255) NOT NULL,
  `Symptom_Image` varchar(255) NOT NULL DEFAULT 'noimage.jpg',
  `Symptom_Status` enum('Show','Hide') NOT NULL,
  `Symptom_Overview` text NOT NULL,
  `Date_Entry` date NOT NULL,
  `Date_Updated` date NOT NULL,
  `Coffee_ID` int(11) NOT NULL,
  `Diseases_ID` int(11) NOT NULL,
  `User_ID` varchar(255) NOT NULL,
  PRIMARY KEY (`Symptom_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `mssymptom`
--

INSERT INTO `mssymptom` (`Symptom_ID`, `Symptom_Name`, `Symptom_Image`, `Symptom_Status`, `Symptom_Overview`, `Date_Entry`, `Date_Updated`, `Coffee_ID`, `Diseases_ID`, `User_ID`) VALUES
(26, 'Daun Menguning', 'Screen_Shot_2013-01-09_at_10.29__.43_PM__.png', 'Show', 'Gejala Pertama Karat Daun Kopi', '2013-01-13', '2013-01-13', 8, 1, 'miranty@gmail.com'),
(24, 'Test', 'UI-Apps1.png', 'Show', 'Tests', '2012-12-23', '2012-12-23', 9, 3, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `msuser`
--

CREATE TABLE IF NOT EXISTS `msuser` (
  `AID` int(11) NOT NULL AUTO_INCREMENT,
  `User_Name` varchar(250) NOT NULL,
  `User_ID` varchar(255) NOT NULL,
  `User_Password` char(40) NOT NULL,
  PRIMARY KEY (`AID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `msuser`
--

INSERT INTO `msuser` (`AID`, `User_Name`, `User_ID`, `User_Password`) VALUES
(3, 'Miranty Lestari', 'miranty@gmail.com', '90c33245201a025b48f23cd8912645c39e84115d'),
(2, 'Wahyu aditya Nugraha', 'administrator@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997'),
(4, 'yurie', 'yurie@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964');

-- --------------------------------------------------------

--
-- Table structure for table `trhistory`
--

CREATE TABLE IF NOT EXISTS `trhistory` (
  `hid` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(23) NOT NULL,
  `AID` int(11) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `Diseases_ID` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `created_at` date NOT NULL,
  `valid` enum('Active','Non-Active') NOT NULL,
  PRIMARY KEY (`hid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `trhistory`
--

INSERT INTO `trhistory` (`hid`, `unique_id`, `AID`, `lat`, `lng`, `Diseases_ID`, `location`, `created_at`, `valid`) VALUES
(12, '50dff0a8a9a790.63717319', 0, '-6.253258333333334', '105.85323833333332', 1, '', '2013-01-13', 'Non-Active'),
(11, '105.85323833333332', 0, '', '-6.253258333333334', 1, '', '2013-01-13', 'Non-Active'),
(10, '50dff0a8a9a790.63717319', 0, '-6.253258333333334', '105.85323833333332', 1, '', '2013-01-13', 'Active'),
(9, '50dff0a8a9a790.63717319', 0, '-6.253258333333334', '106.85323833333332', 1, '', '2013-01-13', 'Active');
