-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 03, 2015 at 11:24 PM
-- Server version: 5.5.40-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ruanggur_updated`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_username` varchar(40) NOT NULL,
  `admin_password` varchar(40) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE IF NOT EXISTS `bank` (
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_title` varchar(255) NOT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Table structure for table `cs_email`
--

CREATE TABLE IF NOT EXISTS `cs_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1337 ;

-- --------------------------------------------------------

--
-- Table structure for table `discount_general`
--

CREATE TABLE IF NOT EXISTS `discount_general` (
  `code` varchar(50) NOT NULL,
  `max_amount` int(10) unsigned DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `expire_date` datetime DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `discount_general_condition`
--

CREATE TABLE IF NOT EXISTS `discount_general_condition` (
  `code` varchar(50) NOT NULL,
  `type` enum('percent','nominal') NOT NULL,
  `value` int(10) unsigned NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `discount_general_usage`
--

CREATE TABLE IF NOT EXISTS `discount_general_usage` (
  `discount_code` varchar(50) NOT NULL,
  `invoice_code` varchar(50) NOT NULL,
  `used_by` int(10) unsigned NOT NULL,
  `used_when` datetime NOT NULL,
  `nominal_value` int(10) unsigned NOT NULL,
  `description` text NOT NULL COMMENT 'Harus diisi! i.e: class_id, or session_id, or anything else',
  KEY `FK_discount_general_usage_discount_general` (`discount_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `discount_main`
--

CREATE TABLE IF NOT EXISTS `discount_main` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `class_id` int(10) unsigned NOT NULL,
  `session_id` int(10) unsigned NOT NULL,
  `scope` enum('public','target') DEFAULT NULL,
  `max_amount` int(10) unsigned DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `expire_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_class_id` (`class_id`,`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `discount_usage`
--

CREATE TABLE IF NOT EXISTS `discount_usage` (
  `discount_id` int(10) unsigned NOT NULL,
  `invoice_code` varchar(50) NOT NULL,
  `used_by` int(10) unsigned NOT NULL,
  `used_when` datetime NOT NULL,
  `nominal_value` int(10) unsigned NOT NULL,
  PRIMARY KEY (`discount_id`,`invoice_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `discount_value`
--

CREATE TABLE IF NOT EXISTS `discount_value` (
  `discount_id` int(10) unsigned NOT NULL,
  `type` enum('percent','idr') NOT NULL,
  `value` int(10) unsigned NOT NULL,
  PRIMARY KEY (`discount_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `duta_guru`
--

CREATE TABLE IF NOT EXISTS `duta_guru` (
  `duta_guru_id` int(11) NOT NULL AUTO_INCREMENT,
  `duta_guru_daftar` datetime NOT NULL,
  `duta_guru_email` varchar(255) NOT NULL,
  `duta_guru_password` varchar(40) NOT NULL,
  `duta_guru_nama` varchar(255) NOT NULL,
  `duta_guru_alamat` text NOT NULL,
  `duta_guru_alamat_domisili` text,
  `duta_guru_kota` int(11) NOT NULL,
  `duta_guru_hp` varchar(20) NOT NULL,
  `duta_guru_hp_2` varchar(20) DEFAULT NULL,
  `duta_guru_telp_rumah` varchar(20) DEFAULT NULL,
  `duta_guru_telp_kantor` varchar(255) DEFAULT NULL,
  `duta_guru_gender` tinyint(4) NOT NULL,
  `duta_guru_tempatlahir` varchar(255) NOT NULL,
  `duta_guru_lahir` date NOT NULL,
  `source_info_id` varchar(11) DEFAULT NULL,
  `duta_guru_active` tinyint(1) NOT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `duta_guru_bank_rekening` varchar(30) DEFAULT NULL,
  `duta_guru_bank_pemilik` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`duta_guru_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50132 ;

-- --------------------------------------------------------

--
-- Table structure for table `feedback_answer`
--

CREATE TABLE IF NOT EXISTS `feedback_answer` (
  `feedback_answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `feedback_question_id` int(11) NOT NULL,
  `feedback_answer_title` varchar(255) NOT NULL,
  `feedback_answer_score` float NOT NULL,
  `feedback_answer_sort` int(5) NOT NULL,
  PRIMARY KEY (`feedback_answer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Table structure for table `feedback_question`
--

CREATE TABLE IF NOT EXISTS `feedback_question` (
  `feedback_question_id` int(11) NOT NULL AUTO_INCREMENT,
  `feedback_question_title` text NOT NULL,
  `feedback_question_sort` int(11) NOT NULL,
  PRIMARY KEY (`feedback_question_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `galeri_kelas`
--

CREATE TABLE IF NOT EXISTS `galeri_kelas` (
  `galeri_id` int(11) NOT NULL AUTO_INCREMENT,
  `kelas_guru_id` int(11) NOT NULL,
  `galeri_foto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`galeri_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE IF NOT EXISTS `guru` (
  `guru_id` int(11) NOT NULL AUTO_INCREMENT,
  `guru_email` varchar(255) NOT NULL,
  `guru_password` varchar(40) NOT NULL,
  `guru_nama` varchar(255) NOT NULL,
  `guru_nik` varchar(100) NOT NULL,
  `guru_nik_image` varchar(255) NOT NULL,
  `guru_nik_image_modified` datetime DEFAULT NULL,
  `guru_nik_verified` tinyint(1) DEFAULT '0',
  `guru_gender` int(1) NOT NULL,
  `pendidikan_id` int(11) NOT NULL,
  `guru_pendidikan_instansi` varchar(100) NOT NULL,
  `guru_pendidikan_verified` tinyint(1) DEFAULT '0',
  `guru_tempatlahir` varchar(30) NOT NULL,
  `guru_lahir` date NOT NULL,
  `guru_hp` varchar(20) NOT NULL,
  `guru_hp_2` varchar(20) DEFAULT NULL,
  `guru_telp_rumah` varchar(20) DEFAULT NULL,
  `guru_telp_kantor` varchar(20) DEFAULT NULL,
  `guru_alamat` text NOT NULL,
  `guru_alamat_domisili` text,
  `guru_fb` varchar(255) NOT NULL,
  `guru_twitter` varchar(255) NOT NULL,
  `guru_video` varchar(255) NOT NULL,
  `guru_jenis_video` tinyint(1) NOT NULL,
  `guru_referral` int(11) NOT NULL,
  `source_info_id` varchar(11) DEFAULT NULL,
  `kategori_id` int(11) NOT NULL,
  `guru_rating` float NOT NULL,
  `guru_rating_sma` char(1) NOT NULL DEFAULT '0',
  `guru_rating_diploma` char(1) NOT NULL DEFAULT '0',
  `guru_rating_s1_top` char(1) NOT NULL DEFAULT '0',
  `guru_rating_s1` char(1) NOT NULL DEFAULT '0',
  `guru_rating_s2_top` char(1) NOT NULL DEFAULT '0',
  `guru_rating_s2` char(1) NOT NULL DEFAULT '0',
  `guru_rating_s3_top` char(1) NOT NULL DEFAULT '0',
  `guru_rating_s3` char(1) NOT NULL DEFAULT '0',
  `guru_rating_beasiswa` char(1) NOT NULL DEFAULT '0',
  `guru_rating_sertifikat` char(1) NOT NULL DEFAULT '0',
  `guru_rating_toefl_ibt` char(1) NOT NULL DEFAULT '0',
  `guru_rating_toefl_itp` char(1) NOT NULL DEFAULT '0',
  `guru_rating_ielts` char(1) NOT NULL DEFAULT '0',
  `guru_rating_gre` char(1) NOT NULL DEFAULT '0',
  `guru_rating_gmat` char(1) NOT NULL DEFAULT '0',
  `guru_rating_cfa` char(1) NOT NULL DEFAULT '0',
  `guru_rating_bio` char(1) NOT NULL,
  `guru_ispro` tinyint(1) DEFAULT NULL,
  `guru_bio` text NOT NULL,
  `guru_review` text NOT NULL,
  `guru_kualifikasi` text NOT NULL,
  `guru_pengalaman` text NOT NULL,
  `guru_metode` varchar(5) NOT NULL,
  `guru_active` tinyint(1) NOT NULL DEFAULT '0',
  `guru_blocked` tinyint(1) NOT NULL DEFAULT '0',
  `bank_id` int(11) DEFAULT NULL,
  `guru_bank_rekening` varchar(30) DEFAULT NULL,
  `guru_bank_pemilik` varchar(255) DEFAULT NULL,
  `guru_last_login` datetime NOT NULL,
  `guru_daftar` datetime NOT NULL,
  PRIMARY KEY (`guru_id`),
  KEY `guru_nama` (`guru_nama`,`guru_active`),
  KEY `guru_email` (`guru_email`,`guru_password`,`guru_active`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16828 ;

--
-- Triggers `guru`
--
DROP TRIGGER IF EXISTS `guru_nik_image`;
DELIMITER //
CREATE TRIGGER `guru_nik_image` BEFORE UPDATE ON `guru`
 FOR EACH ROW BEGIN
     IF NEW.guru_nik_image <> OLD.guru_nik_image THEN
     SET NEW.guru_nik_image_modified = NOW();     
     END IF;
     END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `guru_jadwal`
--

CREATE TABLE IF NOT EXISTS `guru_jadwal` (
  `guru_id` int(11) NOT NULL,
  `guru_jadwal_day` int(11) NOT NULL,
  `guru_jadwal_hour` int(11) NOT NULL,
  KEY `guru_id` (`guru_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `guru_lamaran`
--

CREATE TABLE IF NOT EXISTS `guru_lamaran` (
  `guru_id` int(11) NOT NULL,
  `guru_request_home_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `guru_lokasi`
--

CREATE TABLE IF NOT EXISTS `guru_lokasi` (
  `guru_id` int(11) NOT NULL,
  `lokasi_id` int(11) NOT NULL,
  KEY `guru_id` (`guru_id`),
  KEY `lokasi_id` (`lokasi_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `guru_matpel`
--

CREATE TABLE IF NOT EXISTS `guru_matpel` (
  `guru_id` int(11) NOT NULL,
  `matpel_id` int(11) NOT NULL,
  `guru_matpel_tarif` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`guru_id`,`matpel_id`),
  KEY `guru_id` (`guru_id`),
  KEY `matpel_id` (`matpel_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `guru_sertifikat`
--

CREATE TABLE IF NOT EXISTS `guru_sertifikat` (
  `guru_sertifikat_id` int(11) NOT NULL AUTO_INCREMENT,
  `guru_id` int(11) NOT NULL,
  `guru_sertifikat_title` varchar(255) NOT NULL,
  `guru_sertifikat_file` varchar(255) NOT NULL,
  `guru_sertifikat_checked` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`guru_sertifikat_id`),
  KEY `guru_id` (`guru_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2760 ;

-- --------------------------------------------------------

--
-- Table structure for table `guru_unggulan`
--

CREATE TABLE IF NOT EXISTS `guru_unggulan` (
  `guru_unggulan_id` int(11) NOT NULL AUTO_INCREMENT,
  `guru_id` int(11) DEFAULT NULL,
  `nama_guru_unggulan` varchar(100) NOT NULL,
  `prestasi_guru_unggulan` text NOT NULL,
  PRIMARY KEY (`guru_unggulan_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_kelas_guru`
--

CREATE TABLE IF NOT EXISTS `jadwal_kelas_guru` (
  `jadwal_id` int(11) NOT NULL AUTO_INCREMENT,
  `kelas_guru_id` int(11) NOT NULL,
  `kelas_guru_tanggal` date NOT NULL,
  `kelas_guru_jam_mulai` int(4) NOT NULL,
  `kelas_guru_jam_selesai` int(4) NOT NULL,
  `kelas_guru_menit_mulai` int(4) NOT NULL,
  `kelas_guru_menit_selesai` int(4) NOT NULL,
  `kelas_guru_waktu` tinyint(1) NOT NULL,
  PRIMARY KEY (`jadwal_id`),
  KEY `jadwal_id` (`jadwal_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `jenjang_pendidikan`
--

CREATE TABLE IF NOT EXISTS `jenjang_pendidikan` (
  `jenjang_pendidikan_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenjang_pendidikan_title` varchar(255) NOT NULL,
  `jenjang_pendidikan_index` int(11) NOT NULL,
  PRIMARY KEY (`jenjang_pendidikan_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `kategori_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_title` varchar(255) NOT NULL,
  PRIMARY KEY (`kategori_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `kelas_id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL,
  `murid_id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `duta_guru_id` int(11) NOT NULL,
  `duta_murid_id` int(11) NOT NULL,
  `matpel_id` int(11) NOT NULL,
  `kelas_mulai` date NOT NULL,
  `kelas_frekuensi` int(11) NOT NULL,
  `kelas_durasi` float NOT NULL,
  `lokasi_id` int(11) DEFAULT NULL,
  `kelas_total_jam` float NOT NULL DEFAULT '0',
  `kelas_harga` int(11) NOT NULL DEFAULT '0',
  `kelas_total_harga` int(11) NOT NULL,
  `kelas_discount` tinyint(1) NOT NULL,
  `kelas_tahapan_pembayaran` tinyint(1) NOT NULL,
  `kelas_persen_pembayaran` tinyint(1) NOT NULL,
  `kelas_pembayaran_murid` int(11) NOT NULL DEFAULT '0',
  `kelas_pembayaran_murid_kedua` tinyint(4) NOT NULL,
  `kelas_rek_murid` varchar(50) NOT NULL,
  `kelas_date_verified` date NOT NULL,
  `kelas_date_verified_kedua` date NOT NULL,
  `kelas_pembayaran_guru_setengah` int(11) NOT NULL DEFAULT '0',
  `kelas_date_payment1` date NOT NULL,
  `kelas_pembayaran_guru_penuh` int(11) NOT NULL,
  `kelas_date_payment2` date NOT NULL,
  `kelas_pembayaran_duta_guru` int(11) NOT NULL,
  `kelas_pembayaran_duta_murid` int(11) NOT NULL,
  `kelas_testimoni` text NOT NULL,
  `kelas_status` tinyint(6) NOT NULL,
  `kelas_feedback_status` int(11) NOT NULL DEFAULT '0',
  `kelas_pembayaran_status` tinyint(1) NOT NULL,
  `kelas_pembayaran_kedua_status` tinyint(1) NOT NULL,
  `kelas_jenis_pembayaran_guru` tinyint(1) NOT NULL,
  `kelas_catatan` text NOT NULL,
  PRIMARY KEY (`kelas_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=878 ;

-- --------------------------------------------------------

--
-- Table structure for table `kelas_feedback`
--

CREATE TABLE IF NOT EXISTS `kelas_feedback` (
  `kelas_feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `kelas_id` int(11) NOT NULL,
  `feedback_question_id` int(11) NOT NULL,
  `feedback_answer_id` int(11) NOT NULL,
  PRIMARY KEY (`kelas_feedback_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=571 ;

-- --------------------------------------------------------

--
-- Table structure for table `kelas_guru`
--

CREATE TABLE IF NOT EXISTS `kelas_guru` (
  `kelas_guru_id` int(11) NOT NULL AUTO_INCREMENT,
  `guru_id` int(11) NOT NULL,
  `kelas_guru_nama` varchar(150) NOT NULL,
  `kelas_guru_deskripsi` text NOT NULL,
  `kelas_guru_matpel` int(11) DEFAULT NULL,
  `kelas_guru_harga` int(11) NOT NULL,
  `kelas_guru_lokasi` text,
  `kelas_guru_target` varchar(255) DEFAULT NULL,
  `kelas_guru_matpel_lain` varchar(255) DEFAULT NULL,
  `kelas_guru_video` varchar(255) DEFAULT NULL,
  `kelas_guru_image` varchar(255) DEFAULT NULL,
  `kelas_guru_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`kelas_guru_id`),
  KEY `kelas_guru_id` (`kelas_guru_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kelas_guru_rating`
--

CREATE TABLE IF NOT EXISTS `kelas_guru_rating` (
  `kelas_guru_id` int(10) NOT NULL,
  `murid_id` int(10) NOT NULL,
  `rate_value` int(10) DEFAULT NULL,
  `rate_createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`kelas_guru_id`,`murid_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kelas_guru_review`
--

CREATE TABLE IF NOT EXISTS `kelas_guru_review` (
  `kelas_guru_id` int(10) NOT NULL,
  `murid_id` int(10) NOT NULL,
  `review` text,
  `review_createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`kelas_guru_id`,`murid_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kelas_murid`
--

CREATE TABLE IF NOT EXISTS `kelas_murid` (
  `kelas_murid_id` int(11) NOT NULL AUTO_INCREMENT,
  `kelas_guru_id` int(11) NOT NULL,
  `murid_id` int(11) NOT NULL,
  KEY `kelas_murid_id` (`kelas_murid_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kelas_notifikasi`
--

CREATE TABLE IF NOT EXISTS `kelas_notifikasi` (
  `kelas_notif_id` int(11) NOT NULL AUTO_INCREMENT,
  `kelas_id` int(11) NOT NULL,
  `kelas_tgl` date NOT NULL,
  `kelas_ket` text NOT NULL,
  PRIMARY KEY (`kelas_notif_id`),
  KEY `kelas_notif_id` (`kelas_notif_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `kelas_pertemuan`
--

CREATE TABLE IF NOT EXISTS `kelas_pertemuan` (
  `kelas_pertemuan_id` int(11) NOT NULL AUTO_INCREMENT,
  `kelas_id` int(11) NOT NULL,
  `kelas_pertemuan_date` date NOT NULL,
  `kelas_pertemuan_jam_mulai` time NOT NULL,
  `kelas_pertemuan_jam_selesai` time NOT NULL,
  `kelas_pertemuan_status_id` int(11) NOT NULL,
  PRIMARY KEY (`kelas_pertemuan_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=964 ;

-- --------------------------------------------------------

--
-- Table structure for table `kelas_pertemuan_status`
--

CREATE TABLE IF NOT EXISTS `kelas_pertemuan_status` (
  `kelas_pertemuan_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `kelas_pertemuan_status_title` varchar(255) NOT NULL,
  PRIMARY KEY (`kelas_pertemuan_status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `komunitas`
--

CREATE TABLE IF NOT EXISTS `komunitas` (
  `komunitas_id` int(11) NOT NULL AUTO_INCREMENT,
  `guru_id` int(11) NOT NULL,
  `komunitas_nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `komunitas_deskripsi` text COLLATE utf8_unicode_ci NOT NULL,
  `komunitas_logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`komunitas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE IF NOT EXISTS `lokasi` (
  `lokasi_id` int(11) NOT NULL AUTO_INCREMENT,
  `provinsi_id` int(11) NOT NULL,
  `lokasi_title` varchar(255) NOT NULL,
  PRIMARY KEY (`lokasi_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=601 ;

-- --------------------------------------------------------

--
-- Table structure for table `matpel`
--

CREATE TABLE IF NOT EXISTS `matpel` (
  `matpel_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenjang_pendidikan_id` int(11) NOT NULL,
  `matpel_title` varchar(255) NOT NULL,
  PRIMARY KEY (`matpel_id`),
  KEY `matpel_pendidikan` (`jenjang_pendidikan_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=318 ;

-- --------------------------------------------------------

--
-- Table structure for table `murid`
--

CREATE TABLE IF NOT EXISTS `murid` (
  `murid_id` int(11) NOT NULL AUTO_INCREMENT,
  `murid_email` varchar(255) NOT NULL,
  `murid_password` varchar(40) NOT NULL,
  `murid_nama` varchar(255) NOT NULL,
  `murid_nik` varchar(30) DEFAULT NULL,
  `murid_alamat` text NOT NULL,
  `murid_alamat_domisili` text,
  `murid_kota` int(11) NOT NULL,
  `murid_hp` varchar(20) NOT NULL,
  `murid_hp_2` varchar(20) DEFAULT NULL,
  `murid_telp_rumah` varchar(20) DEFAULT NULL,
  `murid_telp_kantor` varchar(20) DEFAULT NULL,
  `murid_instansi` varchar(255) NOT NULL,
  `murid_gender` tinyint(4) NOT NULL,
  `murid_tempatlahir` varchar(255) DEFAULT NULL,
  `murid_lahir` date DEFAULT NULL,
  `murid_referral` int(11) NOT NULL,
  `source_info_id` varchar(11) DEFAULT NULL,
  `murid_active` tinyint(1) NOT NULL,
  `murid_call_status` tinyint(1) NOT NULL,
  `murid_call_progress` tinyint(1) NOT NULL,
  `murid_handle_by` tinyint(1) DEFAULT NULL,
  `murid_daftar` datetime NOT NULL,
  PRIMARY KEY (`murid_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3271 ;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(8) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `status_payment` varchar(50) NOT NULL,
  `json_response` text NOT NULL,
  `transaction_date` datetime NOT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `transaction_id` (`transaction_id`),
  KEY `transaction_id_2` (`transaction_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `payment_transfer`
--

CREATE TABLE IF NOT EXISTS `payment_transfer` (
  `TRX_ID` varchar(10) NOT NULL,
  `user_type` enum('registered','unregistered') NOT NULL,
  `user_id` varchar(10) NOT NULL,
  PRIMARY KEY (`TRX_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment_transfer_anonymous`
--

CREATE TABLE IF NOT EXISTS `payment_transfer_anonymous` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `main_phone` varchar(50) NOT NULL,
  `other_phone` varchar(50) DEFAULT NULL,
  `id_type` enum('ktp','sim','student_id','nik') NOT NULL,
  `id_number` varchar(50) NOT NULL,
  `address` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `type_id` (`id_type`,`id_number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `payment_transfer_cart`
--

CREATE TABLE IF NOT EXISTS `payment_transfer_cart` (
  `TRX_ID` varchar(10) NOT NULL,
  `transaction_type` enum('kelas') NOT NULL,
  `transaction_type_id` int(10) unsigned NOT NULL,
  `price` float(12,2) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `discount` float(12,2) unsigned NOT NULL,
  `total_price` float(12,2) unsigned NOT NULL,
  KEY `TRX_ID` (`TRX_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment_transfer_process`
--

CREATE TABLE IF NOT EXISTS `payment_transfer_process` (
  `TRX_ID` varchar(10) NOT NULL,
  `group_total_wo_discount` float(12,2) unsigned NOT NULL,
  `discount` float(12,2) unsigned NOT NULL,
  `unique_number` int(3) unsigned NOT NULL,
  `grand_total` float(12,2) unsigned NOT NULL,
  `issued_datetime` datetime NOT NULL,
  `payment_datetime` datetime DEFAULT NULL,
  `payment_total` float(12,2) unsigned DEFAULT NULL,
  `payment_description` text,
  `confirm_datetime` datetime DEFAULT NULL,
  `confirm_by_admin` int(11) DEFAULT NULL,
  KEY `TRX_ID_process` (`TRX_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE IF NOT EXISTS `pembayaran` (
  `pembayaran_id` int(11) NOT NULL AUTO_INCREMENT,
  `pembayaran_user_referral` tinyint(1) NOT NULL,
  `pembayaran_kelas_id` int(11) NOT NULL,
  `pembayaran_title` varchar(255) NOT NULL,
  `pembayaran_amount` int(11) NOT NULL,
  `pembayaran_user_id` int(11) NOT NULL,
  `pembayaran_type` varchar(20) NOT NULL,
  `pembayaran_date_verified` date NOT NULL,
  `pembayaran_status_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pembayaran_id`),
  KEY `pembayaran_type` (`pembayaran_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_status`
--

CREATE TABLE IF NOT EXISTS `pembayaran_status` (
  `pembayaran_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `pembayaran_status_title` varchar(255) NOT NULL,
  PRIMARY KEY (`pembayaran_status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan`
--

CREATE TABLE IF NOT EXISTS `pendidikan` (
  `pendidikan_id` int(11) NOT NULL AUTO_INCREMENT,
  `pendidikan_title` varchar(10) NOT NULL,
  PRIMARY KEY (`pendidikan_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE IF NOT EXISTS `provinsi` (
  `provinsi_id` int(11) NOT NULL,
  `provinsi_title` varchar(120) NOT NULL,
  PRIMARY KEY (`provinsi_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `registrasi_event`
--

CREATE TABLE IF NOT EXISTS `registrasi_event` (
  `id_registrasi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_registrasi` varchar(255) NOT NULL,
  `telepon_registrasi` varchar(13) NOT NULL,
  `email_registrasi` varchar(150) NOT NULL,
  `institusi_registrasi` varchar(255) NOT NULL,
  `status_registrasi` tinyint(1) NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `follow_coaching` tinyint(1) NOT NULL,
  `send_ticket` tinyint(1) NOT NULL,
  `tgl_registrasi` datetime NOT NULL,
  UNIQUE KEY `id_registrasi_2` (`id_registrasi`),
  KEY `id_registrasi` (`id_registrasi`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=167 ;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `murid_id` int(11) NOT NULL,
  `matpel_id` int(11) NOT NULL,
  `lokasi_id` int(11) NOT NULL,
  `request_catatan` text NOT NULL,
  `request_frekuensi` int(11) NOT NULL,
  `referal_code` varchar(10) NOT NULL,
  `request_budget` varchar(255) NOT NULL,
  `request_jadwal` varchar(255) NOT NULL,
  `request_mulai` varchar(255) NOT NULL,
  `request_gender` int(11) NOT NULL,
  `request_code` varchar(50) NOT NULL,
  `request_get_disc` tinyint(1) NOT NULL,
  `request_metode` varchar(5) DEFAULT NULL,
  `request_status` tinyint(4) NOT NULL DEFAULT '1',
  `request_pilih_status` tinyint(1) NOT NULL,
  `requested_by` tinyint(1) NOT NULL,
  `request_progress` tinyint(1) NOT NULL,
  `request_handle_by` tinyint(1) DEFAULT NULL,
  `request_date` datetime NOT NULL,
  PRIMARY KEY (`request_id`),
  KEY `murid_id` (`murid_id`),
  KEY `request_code` (`request_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1484 ;

-- --------------------------------------------------------

--
-- Table structure for table `request_durasi`
--

CREATE TABLE IF NOT EXISTS `request_durasi` (
  `request_durasi_id` int(11) NOT NULL AUTO_INCREMENT,
  `request_durasi_title` varchar(50) NOT NULL,
  PRIMARY KEY (`request_durasi_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `request_guru`
--

CREATE TABLE IF NOT EXISTS `request_guru` (
  `request_guru_id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `request_guru_priority` tinyint(4) DEFAULT NULL,
  `request_guru_status_id` int(11) NOT NULL,
  PRIMARY KEY (`request_guru_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1965 ;

-- --------------------------------------------------------

--
-- Table structure for table `request_guru_home`
--

CREATE TABLE IF NOT EXISTS `request_guru_home` (
  `request_guru_home_id` int(11) NOT NULL AUTO_INCREMENT,
  `request_guru_home_title` varchar(255) NOT NULL,
  `lokasi_id` int(11) NOT NULL,
  `request_guru_home_text` text NOT NULL,
  `request_guru_home_active` tinyint(4) NOT NULL DEFAULT '1',
  `request_guru_home_date` date NOT NULL,
  PRIMARY KEY (`request_guru_home_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

-- --------------------------------------------------------

--
-- Table structure for table `request_guru_status`
--

CREATE TABLE IF NOT EXISTS `request_guru_status` (
  `request_guru_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `request_guru_status_title` varchar(50) NOT NULL,
  PRIMARY KEY (`request_guru_status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `request_langsung`
--

CREATE TABLE IF NOT EXISTS `request_langsung` (
  `id_request` int(11) NOT NULL AUTO_INCREMENT,
  `nama_request` varchar(255) NOT NULL,
  `telp_request` varchar(15) NOT NULL,
  `email_request` varchar(100) NOT NULL,
  `matpel_request` varchar(255) NOT NULL,
  `request_request` text NOT NULL,
  `lokasi_request` text NOT NULL,
  `status_request` tinyint(1) NOT NULL,
  `progress_request` tinyint(1) NOT NULL,
  `handle_request` tinyint(1) NOT NULL,
  `date_request` datetime NOT NULL,
  PRIMARY KEY (`id_request`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=127 ;

-- --------------------------------------------------------

--
-- Table structure for table `request_matpel`
--

CREATE TABLE IF NOT EXISTS `request_matpel` (
  `request_matpel_id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL,
  `matpel_id` int(11) NOT NULL,
  PRIMARY KEY (`request_matpel_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `rg_sessions`
--

CREATE TABLE IF NOT EXISTS `rg_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `source_info`
--

CREATE TABLE IF NOT EXISTS `source_info` (
  `source_info_id` int(11) NOT NULL AUTO_INCREMENT,
  `source_info_title` varchar(255) NOT NULL,
  `source_info_sort` int(11) NOT NULL,
  PRIMARY KEY (`source_info_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `student_account`
--

CREATE TABLE IF NOT EXISTS `student_account` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `verification_code` varchar(20) NOT NULL,
  `has_email_verify` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE IF NOT EXISTS `subscribe` (
  `subscriber_id` int(11) NOT NULL AUTO_INCREMENT,
  `subscriber_nama` varchar(255) NOT NULL,
  `subscriber_email` varchar(255) NOT NULL,
  PRIMARY KEY (`subscriber_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=292 ;

-- --------------------------------------------------------

--
-- Table structure for table `template_email`
--

CREATE TABLE IF NOT EXISTS `template_email` (
  `sender` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `template_email` text NOT NULL,
  KEY `sender` (`sender`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_category_list`
--

CREATE TABLE IF NOT EXISTS `vendor_category_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(150) NOT NULL,
  `category_description` text,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_class`
--

CREATE TABLE IF NOT EXISTS `vendor_class` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(10) NOT NULL,
  `class_uri` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `class_nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `class_deskripsi` text COLLATE utf8_unicode_ci,
  `class_lokasi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `class_perserta_target` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class_peserta_min` int(5) unsigned NOT NULL DEFAULT '2',
  `class_peserta_max` int(5) unsigned NOT NULL,
  `class_harga` int(7) DEFAULT NULL,
  `class_paket` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '0 = single, 1 = series, 2 = package',
  `class_peta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `class_alasan` text COLLATE utf8_unicode_ci,
  `class_include` text COLLATE utf8_unicode_ci,
  `class_catatan` text COLLATE utf8_unicode_ci,
  `class_view` tinyint(1) NOT NULL DEFAULT '1',
  `class_video` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '-1 = reject, 0 = pending, 1 = accepted, 4 = request unpublished',
  `active` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = unpublish, 1 = publish',
  PRIMARY KEY (`id`),
  UNIQUE KEY `class_uri` (`class_uri`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_class_category`
--

CREATE TABLE IF NOT EXISTS `vendor_class_category` (
  `class_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  PRIMARY KEY (`class_id`,`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_class_featured`
--

CREATE TABLE IF NOT EXISTS `vendor_class_featured` (
  `class_id` int(10) NOT NULL,
  `sort` smallint(3) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `start_time` int(10) unsigned DEFAULT NULL COMMENT 'in Unix',
  `end_time` int(10) unsigned DEFAULT NULL COMMENT 'in Unix',
  PRIMARY KEY (`class_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_class_gallery`
--

CREATE TABLE IF NOT EXISTS `vendor_class_gallery` (
  `galeri_id` int(10) NOT NULL AUTO_INCREMENT,
  `class_id` int(10) NOT NULL,
  `galeri_foto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`class_id`,`galeri_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_class_hits`
--

CREATE TABLE IF NOT EXISTS `vendor_class_hits` (
  `class_id` int(10) unsigned NOT NULL,
  `hits` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`class_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_class_jadwal`
--

CREATE TABLE IF NOT EXISTS `vendor_class_jadwal` (
  `jadwal_id` int(10) NOT NULL AUTO_INCREMENT,
  `class_id` int(10) NOT NULL,
  `class_tanggal` date NOT NULL,
  `class_jam_mulai` int(2) unsigned zerofill NOT NULL,
  `class_jam_selesai` int(2) unsigned zerofill NOT NULL,
  `class_menit_mulai` int(2) unsigned zerofill NOT NULL,
  `class_menit_selesai` int(2) unsigned zerofill NOT NULL,
  `class_jadwal_topik` text,
  `class_waktu` tinyint(1) NOT NULL,
  PRIMARY KEY (`jadwal_id`),
  KEY `jadwal_id` (`jadwal_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_class_level`
--

CREATE TABLE IF NOT EXISTS `vendor_class_level` (
  `class_id` int(10) NOT NULL,
  `level_id` int(10) NOT NULL,
  PRIMARY KEY (`class_id`,`level_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_class_message`
--

CREATE TABLE IF NOT EXISTS `vendor_class_message` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `class_id` int(10) NOT NULL,
  `type` enum('peserta','pendaftar','semua') NOT NULL,
  `subject` varchar(100) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `attachment` varchar(50) DEFAULT NULL,
  `sent_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`class_id`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_class_participant`
--

CREATE TABLE IF NOT EXISTS `vendor_class_participant` (
  `code` varchar(10) NOT NULL,
  `pemesan_id` int(10) unsigned NOT NULL,
  `participant_id` int(10) unsigned NOT NULL COMMENT 'vendor_class_student',
  `class_id` int(10) unsigned NOT NULL,
  `jadwal_id` int(10) unsigned NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '-1: not paid, 0: unknown cancel, 1:checked out, 2:book (waiting for payment), 3: paid',
  UNIQUE KEY `participant_id_class_id_jadwal_id` (`participant_id`,`class_id`,`jadwal_id`),
  KEY `code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_class_pemesan`
--

CREATE TABLE IF NOT EXISTS `vendor_class_pemesan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_class_price`
--

CREATE TABLE IF NOT EXISTS `vendor_class_price` (
  `class_id` int(10) NOT NULL,
  `price_per_session` int(10) unsigned NOT NULL,
  `discount` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`class_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_class_rating`
--

CREATE TABLE IF NOT EXISTS `vendor_class_rating` (
  `class_id` int(10) NOT NULL,
  `murid_id` int(10) NOT NULL,
  `rate_value` int(10) DEFAULT NULL,
  `rate_createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`class_id`,`murid_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_class_review`
--

CREATE TABLE IF NOT EXISTS `vendor_class_review` (
  `class_id` int(10) NOT NULL,
  `murid_id` int(10) NOT NULL,
  `review` text,
  `review_createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`class_id`,`murid_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_class_student`
--

CREATE TABLE IF NOT EXISTS `vendor_class_student` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_class_tag`
--

CREATE TABLE IF NOT EXISTS `vendor_class_tag` (
  `vendor_id` int(10) unsigned NOT NULL,
  `tag_words` varchar(50) NOT NULL,
  PRIMARY KEY (`vendor_id`,`tag_words`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_class_ticket`
--

CREATE TABLE IF NOT EXISTS `vendor_class_ticket` (
  `ticket_code` varchar(50) NOT NULL,
  `invoice_code` varchar(50) NOT NULL,
  `class_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ticket_code`),
  UNIQUE KEY `invoice_code_class_id` (`invoice_code`,`class_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_class_transaction`
--

CREATE TABLE IF NOT EXISTS `vendor_class_transaction` (
  `code` varchar(50) NOT NULL,
  `subtotal` int(10) unsigned NOT NULL,
  `discount` int(10) unsigned NOT NULL,
  `unique_code` smallint(3) unsigned DEFAULT NULL,
  `total` int(10) unsigned NOT NULL,
  `pemesan_id` int(10) unsigned NOT NULL,
  `student_id` int(10) unsigned NOT NULL,
  `status_1` datetime NOT NULL COMMENT 'Add to cart',
  `status_2` datetime DEFAULT NULL COMMENT 'Sent Invoice',
  `status_3` datetime DEFAULT NULL COMMENT 'Payment Confirmation',
  `status_3_bank_from` int(10) unsigned DEFAULT NULL,
  `status_3_bank_from_other` varchar(50) DEFAULT NULL,
  `status_3_bank_to` int(10) unsigned DEFAULT NULL,
  `status_3_upload_file` varchar(50) DEFAULT NULL,
  `status_4` datetime DEFAULT NULL COMMENT 'Payment is confirmed',
  `status_4_approval` int(10) unsigned DEFAULT NULL,
  `status_fail` datetime DEFAULT NULL,
  `status_fail_reason` text,
  `status_fail_by` int(11) DEFAULT '0' COMMENT '0: by system, > 0: by ops',
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_class_wishlist`
--

CREATE TABLE IF NOT EXISTS `vendor_class_wishlist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pemesan_id` int(10) unsigned NOT NULL,
  `participant_id` int(10) unsigned NOT NULL COMMENT 'vendor_class_student',
  `class_id` int(10) unsigned NOT NULL,
  `jadwal_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `participant_id_class_id_jadwal_id` (`participant_id`,`class_id`,`jadwal_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_info`
--

CREATE TABLE IF NOT EXISTS `vendor_info` (
  `vendor_id` int(10) NOT NULL,
  `is_institute` tinyint(1) NOT NULL DEFAULT '1',
  `vendor_description` text,
  `vendor_logo` varchar(100) DEFAULT NULL,
  `contact_person_name` varchar(100) DEFAULT NULL,
  `contact_person_jabatan` varchar(100) DEFAULT NULL,
  `contact_person_phone` varchar(20) DEFAULT NULL,
  `contact_person_mobile` varchar(20) DEFAULT NULL,
  `contact_person_email` varchar(100) DEFAULT NULL,
  `class_room_address` text,
  `class_room_phone` varchar(20) DEFAULT NULL,
  `class_room_capacity` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`vendor_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_level_list`
--

CREATE TABLE IF NOT EXISTS `vendor_level_list` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `sort` varchar(5) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_profile`
--

CREATE TABLE IF NOT EXISTS `vendor_profile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(250) NOT NULL,
  `main_phone` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_rekening`
--

CREATE TABLE IF NOT EXISTS `vendor_rekening` (
  `vendor_id` int(10) unsigned NOT NULL,
  `bank_id` int(10) NOT NULL COMMENT 'Mengacu pada table "bank"',
  `bank_lain` varchar(100) DEFAULT NULL,
  `no_rek` varchar(100) NOT NULL,
  `atasnama` varchar(100) NOT NULL,
  `cabang` varchar(100) NOT NULL,
  PRIMARY KEY (`vendor_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_rel_guru`
--

CREATE TABLE IF NOT EXISTS `vendor_rel_guru` (
  `guru_id` int(10) NOT NULL,
  `vendor_id` int(10) NOT NULL,
  PRIMARY KEY (`guru_id`,`vendor_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_socmed`
--

CREATE TABLE IF NOT EXISTS `vendor_socmed` (
  `vendor_id` int(10) unsigned NOT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `instagram` varchar(100) DEFAULT NULL,
  `pinterest` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`vendor_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_tag_collections`
--

CREATE TABLE IF NOT EXISTS `vendor_tag_collections` (
  `tag_words` varchar(50) NOT NULL,
  `counter` int(10) unsigned NOT NULL,
  PRIMARY KEY (`tag_words`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `discount_general_condition`
--
ALTER TABLE `discount_general_condition`
  ADD CONSTRAINT `FK__discount_general` FOREIGN KEY (`code`) REFERENCES `discount_general` (`code`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `discount_general_usage`
--
ALTER TABLE `discount_general_usage`
  ADD CONSTRAINT `FK_discount_general_usage_discount_general` FOREIGN KEY (`discount_code`) REFERENCES `discount_general` (`code`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `discount_usage`
--
ALTER TABLE `discount_usage`
  ADD CONSTRAINT `FK_discount_id_usage` FOREIGN KEY (`discount_id`) REFERENCES `discount_main` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `discount_value`
--
ALTER TABLE `discount_value`
  ADD CONSTRAINT `FK_discount_id_value` FOREIGN KEY (`discount_id`) REFERENCES `discount_main` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `payment_transfer_cart`
--
ALTER TABLE `payment_transfer_cart`
  ADD CONSTRAINT `TRX_ID_cart` FOREIGN KEY (`TRX_ID`) REFERENCES `payment_transfer` (`TRX_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `payment_transfer_process`
--
ALTER TABLE `payment_transfer_process`
  ADD CONSTRAINT `TRX_ID_process` FOREIGN KEY (`TRX_ID`) REFERENCES `payment_transfer` (`TRX_ID`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
