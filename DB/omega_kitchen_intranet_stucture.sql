-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 27, 2019 at 12:26 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `omega_kitchen_intranet`
--

-- --------------------------------------------------------

--
-- Table structure for table `s_backup_database`
--

CREATE TABLE `s_backup_database` (
  `group_id` int(14) UNSIGNED NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `group_file` varchar(255) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_document`
--

CREATE TABLE `s_document` (
  `id` int(10) UNSIGNED NOT NULL,
  `fo_id` int(11) DEFAULT NULL,
  `images` varchar(50) DEFAULT NULL,
  `doc_name` varchar(255) DEFAULT NULL,
  `sorts` int(11) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_first_order`
--

CREATE TABLE `s_first_order` (
  `fo_id` int(14) UNSIGNED NOT NULL,
  `cd_name` varchar(255) NOT NULL,
  `cd_address` varchar(255) NOT NULL,
  `cd_province` int(11) NOT NULL,
  `cd_tel` varchar(50) NOT NULL,
  `cd_fax` varchar(50) NOT NULL,
  `fs_id` varchar(20) NOT NULL,
  `r_id` varchar(20) NOT NULL,
  `garun_id` varchar(20) DEFAULT NULL,
  `date_forder` date NOT NULL,
  `cg_type` int(11) NOT NULL,
  `ctype` int(11) NOT NULL,
  `pro_type` int(11) NOT NULL,
  `po_id` varchar(20) NOT NULL,
  `pro_pod1` varchar(50) NOT NULL,
  `pro_pod2` varchar(50) NOT NULL,
  `pro_pod3` varchar(50) NOT NULL,
  `pro_pod4` varchar(50) NOT NULL,
  `pro_pod5` varchar(50) NOT NULL,
  `pro_pod6` varchar(50) NOT NULL,
  `pro_pod7` varchar(50) NOT NULL,
  `pro_sn1` varchar(50) NOT NULL,
  `pro_sn2` varchar(50) NOT NULL,
  `pro_sn3` varchar(50) NOT NULL,
  `pro_sn4` varchar(50) NOT NULL,
  `pro_sn5` varchar(50) NOT NULL,
  `pro_sn6` varchar(50) NOT NULL,
  `pro_sn7` varchar(50) NOT NULL,
  `c_contact` varchar(50) NOT NULL,
  `c_tel` varchar(50) NOT NULL,
  `loc_name` varchar(50) NOT NULL,
  `loc_address` varchar(255) NOT NULL,
  `loc_shopping` varchar(255) NOT NULL,
  `shipS1` int(1) NOT NULL,
  `shipS2` int(1) NOT NULL,
  `shipS3` int(1) NOT NULL,
  `shipS4` int(1) NOT NULL,
  `shipS5` int(1) NOT NULL,
  `shipL1` varchar(255) NOT NULL,
  `shipL2` varchar(255) NOT NULL,
  `shipL3` varchar(255) NOT NULL,
  `shipL4` varchar(255) NOT NULL,
  `shipL5` varchar(255) NOT NULL,
  `warter01` varchar(11) NOT NULL,
  `warter02` varchar(11) NOT NULL,
  `warter03` varchar(11) NOT NULL,
  `warter04` varchar(11) NOT NULL,
  `warter05` varchar(11) NOT NULL,
  `warter06` varchar(11) NOT NULL,
  `warter07` varchar(11) NOT NULL,
  `cpro1` varchar(11) NOT NULL,
  `cpro2` varchar(11) NOT NULL,
  `cpro3` varchar(11) NOT NULL,
  `cpro4` varchar(11) NOT NULL,
  `cpro5` varchar(11) NOT NULL,
  `cpro6` varchar(11) NOT NULL,
  `cpro7` varchar(11) NOT NULL,
  `camount1` varchar(11) NOT NULL,
  `camount2` varchar(11) NOT NULL,
  `camount3` varchar(11) NOT NULL,
  `camount4` varchar(11) NOT NULL,
  `camount5` varchar(11) NOT NULL,
  `camount6` varchar(11) NOT NULL,
  `camount7` varchar(11) NOT NULL,
  `cprice1` varchar(20) NOT NULL,
  `cprice2` varchar(20) NOT NULL,
  `cprice3` varchar(20) NOT NULL,
  `cprice4` varchar(20) NOT NULL,
  `cprice5` varchar(20) NOT NULL,
  `cprice6` varchar(20) NOT NULL,
  `cprice7` varchar(20) NOT NULL,
  `ccomment` text NOT NULL,
  `cs_pro1` varchar(100) NOT NULL,
  `cs_pro2` varchar(100) NOT NULL,
  `cs_pro3` varchar(100) NOT NULL,
  `cs_pro4` varchar(100) NOT NULL,
  `cs_pro5` varchar(100) NOT NULL,
  `cs_amount1` varchar(11) NOT NULL,
  `cs_amount2` varchar(11) NOT NULL,
  `cs_amount3` varchar(11) NOT NULL,
  `cs_amount4` varchar(11) NOT NULL,
  `cs_amount5` varchar(11) NOT NULL,
  `cs_sign` varchar(150) NOT NULL,
  `date_quf` date NOT NULL,
  `date_qut` date NOT NULL,
  `qucomment` text NOT NULL,
  `cs_contact` varchar(50) NOT NULL,
  `cs_tel` varchar(50) NOT NULL,
  `cs_ship` date NOT NULL,
  `cs_setting` date NOT NULL,
  `cs_company` varchar(50) NOT NULL,
  `cs_sell` varchar(50) NOT NULL,
  `cs_aceep` varchar(50) NOT NULL,
  `remark` text NOT NULL,
  `st_setting` int(11) NOT NULL,
  `separate` int(1) NOT NULL,
  `cusid` varchar(25) NOT NULL,
  `money_garuntree` int(10) NOT NULL,
  `money_setup` int(10) NOT NULL,
  `notvat1` int(1) NOT NULL,
  `notvat2` int(1) NOT NULL,
  `feeder` int(1) NOT NULL,
  `feeder_type` varchar(100) NOT NULL,
  `feeder_type2` varchar(100) NOT NULL,
  `feeder_type3` varchar(100) NOT NULL,
  `feeder_type4` varchar(100) NOT NULL,
  `feeder_type5` varchar(100) NOT NULL,
  `feeder_type6` varchar(100) NOT NULL,
  `service_type` int(11) NOT NULL,
  `status_use` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group`
--

CREATE TABLE `s_group` (
  `group_id` int(14) UNSIGNED NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_custommer`
--

CREATE TABLE `s_group_custommer` (
  `group_id` int(14) UNSIGNED NOT NULL,
  `group_cus_id` varchar(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_fix`
--

CREATE TABLE `s_group_fix` (
  `group_id` int(14) UNSIGNED NOT NULL,
  `group_fix_id` varchar(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_pod`
--

CREATE TABLE `s_group_pod` (
  `group_id` int(14) UNSIGNED NOT NULL,
  `group_spro_id` varchar(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `group_stock` int(14) DEFAULT NULL,
  `group_pro_pod` varchar(50) NOT NULL,
  `group_pro_sn` varchar(50) NOT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_product`
--

CREATE TABLE `s_group_product` (
  `group_id` int(14) UNSIGNED NOT NULL,
  `group_pro_id` varchar(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_project`
--

CREATE TABLE `s_group_project` (
  `group_id` int(14) UNSIGNED NOT NULL,
  `group_pro_id` varchar(20) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `group_size` varchar(100) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_sale`
--

CREATE TABLE `s_group_sale` (
  `group_id` int(14) UNSIGNED NOT NULL,
  `group_cus_id` varchar(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `group_tel` varchar(50) NOT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_service`
--

CREATE TABLE `s_group_service` (
  `group_id` int(14) UNSIGNED NOT NULL,
  `group_ser_id` varchar(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_sparpart`
--

CREATE TABLE `s_group_sparpart` (
  `group_id` int(14) UNSIGNED NOT NULL,
  `group_spar_id` varchar(20) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `group_location` varchar(50) DEFAULT NULL,
  `group_stock` int(14) DEFAULT 0,
  `group_unit_price` varchar(20) DEFAULT '0',
  `group_namecall` varchar(100) NOT NULL,
  `group_type` varchar(50) DEFAULT NULL,
  `group_price` varchar(20) NOT NULL DEFAULT '0',
  `typespar` varchar(1) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_sparpart_bill`
--

CREATE TABLE `s_group_sparpart_bill` (
  `sub_id` int(11) NOT NULL,
  `sub_name` text DEFAULT NULL,
  `sub_address` text DEFAULT NULL,
  `sub_tel` text DEFAULT NULL,
  `sub_billnum` varchar(50) DEFAULT NULL,
  `sub_billdate` date DEFAULT NULL,
  `sub_comment` text DEFAULT NULL,
  `sub_vat` varchar(1) DEFAULT NULL,
  `stock_date` date DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_sparpart_bill_pro`
--

CREATE TABLE `s_group_sparpart_bill_pro` (
  `id` int(11) NOT NULL,
  `id_bill` int(15) NOT NULL,
  `sparpart_id` varchar(20) NOT NULL,
  `sparpart_qty` int(15) NOT NULL,
  `sparpart_unit_price` varchar(20) NOT NULL,
  `sparpart_total` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_technician`
--

CREATE TABLE `s_group_technician` (
  `group_id` int(14) UNSIGNED NOT NULL,
  `group_cus_id` varchar(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `group_tel` varchar(50) NOT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_type`
--

CREATE TABLE `s_group_type` (
  `group_id` int(14) UNSIGNED NOT NULL,
  `group_type_id` varchar(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_typeproduct`
--

CREATE TABLE `s_group_typeproduct` (
  `group_id` int(14) UNSIGNED NOT NULL,
  `group_spro_id` varchar(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `group_stock` int(14) DEFAULT NULL,
  `group_pro_pod` varchar(50) NOT NULL,
  `group_pro_sn` varchar(50) NOT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_typeproduct2`
--

CREATE TABLE `s_group_typeproduct2` (
  `group_id` int(14) UNSIGNED NOT NULL,
  `group_spro_id` varchar(20) DEFAULT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_lang`
--

CREATE TABLE `s_lang` (
  `lang_id` bigint(20) NOT NULL,
  `lang_name` varchar(100) NOT NULL,
  `lang_key` varchar(50) NOT NULL,
  `lang_images` varchar(255) NOT NULL,
  `lang_status` int(2) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_by` varchar(50) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(50) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_module`
--

CREATE TABLE `s_module` (
  `module_id` bigint(20) NOT NULL,
  `module_name` varchar(50) DEFAULT NULL,
  `tag_title` text DEFAULT NULL,
  `tag_meta` text DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_by` varchar(50) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(50) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_project_order`
--

CREATE TABLE `s_project_order` (
  `fo_id` int(14) UNSIGNED NOT NULL,
  `cd_name` varchar(255) NOT NULL,
  `cd_address` varchar(255) NOT NULL,
  `cd_province` int(11) NOT NULL,
  `cd_tel` varchar(50) NOT NULL,
  `cd_fax` varchar(50) NOT NULL,
  `fs_id` varchar(20) NOT NULL,
  `r_id` varchar(20) NOT NULL,
  `date_forder` date NOT NULL,
  `cg_type` int(11) NOT NULL,
  `ctype` int(11) NOT NULL,
  `pro_type` int(11) NOT NULL,
  `po_id` varchar(20) NOT NULL,
  `c_contact` varchar(50) NOT NULL,
  `c_tel` varchar(50) NOT NULL,
  `loc_name` varchar(50) NOT NULL,
  `loc_address` varchar(255) NOT NULL,
  `loc_shopping` varchar(255) NOT NULL,
  `systemH` varchar(255) NOT NULL,
  `systemHName` varchar(255) NOT NULL,
  `systemHTel` varchar(255) NOT NULL,
  `systemG` varchar(255) NOT NULL,
  `systemGName` varchar(255) NOT NULL,
  `systemGTel` varchar(255) NOT NULL,
  `shipS1` int(1) NOT NULL,
  `shipS2` int(1) NOT NULL,
  `shipS3` int(1) NOT NULL,
  `shipS4` int(1) NOT NULL,
  `shipS5` int(1) NOT NULL,
  `shipL1` varchar(150) NOT NULL,
  `shipL2` varchar(150) NOT NULL,
  `shipL3` varchar(150) NOT NULL,
  `shipL4` varchar(150) NOT NULL,
  `shipL5` varchar(150) NOT NULL,
  `cpro1` varchar(11) NOT NULL,
  `cpro2` varchar(11) NOT NULL,
  `cpro3` varchar(11) NOT NULL,
  `cpro4` varchar(11) NOT NULL,
  `cpro5` varchar(11) NOT NULL,
  `cpro6` varchar(11) NOT NULL,
  `cpro7` varchar(11) NOT NULL,
  `ccomment` text NOT NULL,
  `cs_sign` varchar(150) NOT NULL,
  `date_quf` date NOT NULL,
  `date_qut` date NOT NULL,
  `qucomment` text NOT NULL,
  `cs_contact` varchar(50) NOT NULL,
  `cs_tel` varchar(50) NOT NULL,
  `cs_ship` date NOT NULL,
  `cs_setting` date NOT NULL,
  `cs_company` varchar(50) NOT NULL,
  `cs_sell` varchar(50) NOT NULL,
  `cs_aceep` varchar(50) NOT NULL,
  `remark` text NOT NULL,
  `st_setting` int(11) NOT NULL,
  `separate` int(1) NOT NULL,
  `cusid` varchar(25) NOT NULL,
  `money_garuntree` int(10) NOT NULL,
  `money_setup` int(10) NOT NULL,
  `notvat1` int(1) NOT NULL,
  `notvat2` int(1) NOT NULL,
  `feeder` int(1) NOT NULL,
  `feeder_type` varchar(100) NOT NULL,
  `feeder_type2` varchar(100) NOT NULL,
  `service_type` int(11) NOT NULL,
  `discount` varchar(20) NOT NULL,
  `status_use` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `s_project_order_cost`
--

CREATE TABLE `s_project_order_cost` (
  `id` int(11) NOT NULL,
  `fo_id` int(11) NOT NULL,
  `shipC1` varchar(50) DEFAULT NULL,
  `shipC2` varchar(50) DEFAULT NULL,
  `shipC3` varchar(50) DEFAULT NULL,
  `shipC4` varchar(50) DEFAULT NULL,
  `shipC5` varchar(50) DEFAULT NULL,
  `shipC6` varchar(50) DEFAULT NULL,
  `shipC7` varchar(50) DEFAULT NULL,
  `shipC8` varchar(50) DEFAULT NULL,
  `shipM1` varchar(50) DEFAULT NULL,
  `shipM2` varchar(50) DEFAULT NULL,
  `shipM3` varchar(50) DEFAULT NULL,
  `shipM4` varchar(50) DEFAULT NULL,
  `shipM5` varchar(50) DEFAULT NULL,
  `shipM6` varchar(50) DEFAULT NULL,
  `shipM7` varchar(50) DEFAULT NULL,
  `shipM8` varchar(50) DEFAULT NULL,
  `shipM9` varchar(50) DEFAULT NULL,
  `shipL1` varchar(50) DEFAULT NULL,
  `shipL2` varchar(50) DEFAULT NULL,
  `shipL3` varchar(50) DEFAULT NULL,
  `shipL4` varchar(50) DEFAULT NULL,
  `shipL5` varchar(50) DEFAULT NULL,
  `shipL6` varchar(50) DEFAULT NULL,
  `shipL7` varchar(50) DEFAULT NULL,
  `shipL8` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `s_project_product`
--

CREATE TABLE `s_project_product` (
  `id` int(11) NOT NULL,
  `fo_id` varchar(50) NOT NULL,
  `ccode` varchar(20) DEFAULT NULL,
  `cpro` varchar(255) NOT NULL,
  `cpod` varchar(255) NOT NULL,
  `csn` varchar(255) NOT NULL,
  `camount` varchar(255) NOT NULL,
  `cprice` varchar(255) NOT NULL,
  `ccost` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `s_project_product_cost`
--

CREATE TABLE `s_project_product_cost` (
  `id` int(11) NOT NULL,
  `fo_id` varchar(50) NOT NULL,
  `ccode` varchar(20) DEFAULT NULL,
  `cpro` varchar(255) DEFAULT NULL,
  `cpod` varchar(255) DEFAULT NULL,
  `csn` varchar(255) DEFAULT NULL,
  `camount` varchar(255) DEFAULT NULL,
  `cprice` varchar(255) DEFAULT NULL,
  `ccost` varchar(255) DEFAULT NULL,
  `costpros` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `s_province`
--

CREATE TABLE `s_province` (
  `province_id` int(11) NOT NULL,
  `province_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_service_report`
--

CREATE TABLE `s_service_report` (
  `sr_id` int(14) UNSIGNED NOT NULL,
  `sv_id` varchar(50) NOT NULL,
  `srid` varchar(20) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `sr_ctype` varchar(10) NOT NULL,
  `sr_ctype2` varchar(10) NOT NULL,
  `job_open` date NOT NULL,
  `job_close` date NOT NULL,
  `job_balance` date NOT NULL,
  `sr_stime` date NOT NULL,
  `loc_pro` varchar(50) NOT NULL,
  `loc_seal` varchar(50) NOT NULL,
  `loc_sn` varchar(50) NOT NULL,
  `loc_clean` varchar(50) NOT NULL,
  `loc_contact` varchar(50) NOT NULL,
  `loc_tels` varchar(50) NOT NULL,
  `cl_01` varchar(50) NOT NULL,
  `cl_02` varchar(50) NOT NULL,
  `cl_03` varchar(50) NOT NULL,
  `cl_04` varchar(50) NOT NULL,
  `cl_05` varchar(50) NOT NULL,
  `cl_06` varchar(50) NOT NULL,
  `cl_07` varchar(50) NOT NULL,
  `cl_08` varchar(50) NOT NULL,
  `ckl_list` varchar(50) NOT NULL,
  `ckw_list` varchar(50) NOT NULL,
  `ckf_list` varchar(50) NOT NULL,
  `detail_recom` text NOT NULL,
  `detail_recom2` text NOT NULL,
  `detail_calpr` text NOT NULL,
  `cpro1` varchar(11) NOT NULL,
  `cpro2` varchar(11) NOT NULL,
  `cpro3` varchar(11) NOT NULL,
  `cpro4` varchar(11) NOT NULL,
  `cpro5` varchar(11) NOT NULL,
  `camount1` varchar(10) NOT NULL,
  `camount2` varchar(10) NOT NULL,
  `camount3` varchar(10) NOT NULL,
  `camount4` varchar(10) NOT NULL,
  `camount5` varchar(10) NOT NULL,
  `cprice1` varchar(20) NOT NULL,
  `cprice2` varchar(20) NOT NULL,
  `cprice3` varchar(20) NOT NULL,
  `cprice4` varchar(20) NOT NULL,
  `cprice5` varchar(20) NOT NULL,
  `approve` int(1) NOT NULL,
  `supply` int(1) NOT NULL,
  `st_setting` int(11) NOT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_service_report2`
--

CREATE TABLE `s_service_report2` (
  `sr_id` int(14) UNSIGNED NOT NULL,
  `sv_id` varchar(50) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `srid` varchar(20) NOT NULL,
  `srid2` varchar(20) NOT NULL,
  `sr_ctype` varchar(10) NOT NULL,
  `sr_ctype2` varchar(10) NOT NULL,
  `job_open` date NOT NULL,
  `job_close` date NOT NULL,
  `job_balance` date NOT NULL,
  `sr_stime` date NOT NULL,
  `loc_pro` varchar(50) NOT NULL,
  `loc_seal` varchar(50) NOT NULL,
  `loc_sn` varchar(50) NOT NULL,
  `loc_clean` varchar(50) NOT NULL,
  `loc_contact` varchar(50) NOT NULL,
  `loc_contact2` varchar(11) DEFAULT NULL,
  `loc_contact3` varchar(11) DEFAULT NULL,
  `cs_sell` varchar(11) DEFAULT NULL,
  `loc_tels` varchar(50) NOT NULL,
  `cl_01` varchar(50) NOT NULL,
  `cl_02` varchar(50) NOT NULL,
  `cl_03` varchar(50) NOT NULL,
  `cl_04` varchar(50) NOT NULL,
  `cl_05` varchar(50) NOT NULL,
  `cl_06` varchar(50) NOT NULL,
  `cl_07` varchar(50) NOT NULL,
  `cl_08` varchar(50) NOT NULL,
  `ckl_list` varchar(50) NOT NULL,
  `ckw_list` varchar(50) NOT NULL,
  `ckf_list` varchar(50) NOT NULL,
  `detail_recom` text NOT NULL,
  `detail_recom2` text NOT NULL,
  `detail_calpr` text NOT NULL,
  `approve` int(1) NOT NULL,
  `supply` int(1) NOT NULL,
  `st_setting` int(11) NOT NULL,
  `loc_date2` date NOT NULL,
  `sell_date` date NOT NULL,
  `loc_date3` date NOT NULL,
  `ref_date` date NOT NULL,
  `cus_source` varchar(2) DEFAULT 'fo',
  `search_fo` varchar(20) DEFAULT NULL,
  `search_po` varchar(20) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_service_report2sub`
--

CREATE TABLE `s_service_report2sub` (
  `r_id` int(11) NOT NULL,
  `sr_id` int(11) NOT NULL,
  `codes` varchar(20) CHARACTER SET utf8 NOT NULL,
  `lists` varchar(255) CHARACTER SET utf8 NOT NULL,
  `units` varchar(20) CHARACTER SET utf8 NOT NULL,
  `prices` varchar(20) DEFAULT '0',
  `amounts` varchar(20) DEFAULT '0',
  `opens` varchar(20) DEFAULT '0',
  `remains` varchar(20) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `s_service_report3`
--

CREATE TABLE `s_service_report3` (
  `sr_id` int(14) UNSIGNED NOT NULL,
  `sv_id` varchar(50) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `sr_ctype` varchar(10) NOT NULL,
  `sr_ctype2` varchar(10) NOT NULL,
  `job_open` date NOT NULL,
  `job_close` date NOT NULL,
  `job_balance` date NOT NULL,
  `sr_stime` date NOT NULL,
  `loc_pro` varchar(50) NOT NULL,
  `loc_seal` varchar(50) NOT NULL,
  `loc_sn` varchar(50) NOT NULL,
  `loc_clean` varchar(50) NOT NULL,
  `loc_contact` varchar(50) NOT NULL,
  `loc_contact2` varchar(11) DEFAULT NULL,
  `loc_contact3` varchar(11) DEFAULT NULL,
  `cs_sell` varchar(11) DEFAULT NULL,
  `loc_tels` varchar(50) NOT NULL,
  `cl_01` varchar(50) NOT NULL,
  `cl_02` varchar(50) NOT NULL,
  `cl_03` varchar(50) NOT NULL,
  `cl_04` varchar(50) NOT NULL,
  `cl_05` varchar(50) NOT NULL,
  `cl_06` varchar(50) NOT NULL,
  `cl_07` varchar(50) NOT NULL,
  `cl_08` varchar(50) NOT NULL,
  `ckl_list` varchar(50) NOT NULL,
  `ckw_list` varchar(50) NOT NULL,
  `ckf_list` varchar(50) NOT NULL,
  `detail_recom` text NOT NULL,
  `detail_recom2` text NOT NULL,
  `detail_calpr` text NOT NULL,
  `approve` int(1) NOT NULL,
  `supply` int(1) NOT NULL,
  `approve_return` varchar(1) DEFAULT NULL,
  `st_setting` int(11) NOT NULL,
  `loc_date2` date NOT NULL,
  `sell_date` date NOT NULL,
  `loc_date3` date NOT NULL,
  `cus_source` varchar(2) DEFAULT 'fo',
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_service_report3sub`
--

CREATE TABLE `s_service_report3sub` (
  `r_id` int(11) NOT NULL,
  `sr_id` int(11) NOT NULL,
  `codes` varchar(20) NOT NULL,
  `lists` varchar(255) NOT NULL,
  `units` varchar(20) NOT NULL,
  `prices` varchar(20) DEFAULT '0',
  `amounts` varchar(20) DEFAULT '0',
  `opens` varchar(20) DEFAULT '0',
  `remains` varchar(20) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_service_report4`
--

CREATE TABLE `s_service_report4` (
  `sr_id` int(14) UNSIGNED NOT NULL,
  `sv_id` varchar(50) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `srid` varchar(20) NOT NULL,
  `sr_ctype` varchar(10) NOT NULL,
  `sr_ctype2` varchar(10) NOT NULL,
  `job_open` date NOT NULL,
  `job_close` date NOT NULL,
  `job_balance` date NOT NULL,
  `sr_stime` date NOT NULL,
  `loc_pro` varchar(50) NOT NULL,
  `loc_seal` varchar(50) NOT NULL,
  `loc_sn` varchar(50) NOT NULL,
  `loc_clean` varchar(50) NOT NULL,
  `loc_contact` varchar(50) NOT NULL,
  `loc_contact2` varchar(11) DEFAULT NULL,
  `loc_contact3` varchar(11) DEFAULT NULL,
  `cs_sell` varchar(11) DEFAULT NULL,
  `loc_tels` varchar(50) NOT NULL,
  `cl_01` varchar(50) NOT NULL,
  `cl_02` varchar(50) NOT NULL,
  `cl_03` varchar(50) NOT NULL,
  `cl_04` varchar(50) NOT NULL,
  `cl_05` varchar(50) NOT NULL,
  `cl_06` varchar(50) NOT NULL,
  `cl_07` varchar(50) NOT NULL,
  `cl_08` varchar(50) NOT NULL,
  `mn_1` varchar(11) DEFAULT '0',
  `mn_2` varchar(11) DEFAULT '0',
  `mn_3` varchar(11) DEFAULT '0',
  `mn_4` varchar(11) DEFAULT '0',
  `mn_5` varchar(11) DEFAULT '0',
  `ckl_list` varchar(50) NOT NULL,
  `ckw_list` varchar(50) NOT NULL,
  `ckf_list` varchar(50) NOT NULL,
  `detail_recom` text NOT NULL,
  `detail_recom2` text NOT NULL,
  `detail_calpr` text NOT NULL,
  `approve` varchar(1) DEFAULT NULL,
  `supply` varchar(1) DEFAULT NULL,
  `st_setting` varchar(11) DEFAULT NULL,
  `loc_date2` date NOT NULL,
  `sell_date` date NOT NULL,
  `loc_date3` date NOT NULL,
  `u_images` varchar(50) NOT NULL,
  `cus_source` varchar(2) DEFAULT 'fo',
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` date NOT NULL,
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_service_report4sub`
--

CREATE TABLE `s_service_report4sub` (
  `r_id` int(11) NOT NULL,
  `sr_id` int(11) NOT NULL,
  `codes` varchar(20) NOT NULL,
  `lists` varchar(255) NOT NULL,
  `units` varchar(20) NOT NULL,
  `prices` varchar(20) DEFAULT NULL,
  `amounts` varchar(20) DEFAULT NULL,
  `opens` varchar(20) DEFAULT NULL,
  `remains` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_service_report5`
--

CREATE TABLE `s_service_report5` (
  `sr_id` int(14) UNSIGNED NOT NULL,
  `sv_id` varchar(50) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `sr_ctype` varchar(10) NOT NULL,
  `sr_ctype2` varchar(10) NOT NULL,
  `job_open` date NOT NULL,
  `job_close` date NOT NULL,
  `job_balance` date NOT NULL,
  `sr_stime` date NOT NULL,
  `loc_pro` varchar(50) NOT NULL,
  `loc_seal` varchar(50) NOT NULL,
  `loc_sn` varchar(50) NOT NULL,
  `loc_clean` varchar(50) NOT NULL,
  `loc_contact` varchar(50) NOT NULL,
  `loc_contact2` varchar(11) DEFAULT NULL,
  `loc_contact3` varchar(11) DEFAULT NULL,
  `cs_sell` varchar(11) DEFAULT NULL,
  `loc_tels` varchar(50) NOT NULL,
  `cl_01` varchar(50) NOT NULL,
  `cl_02` varchar(50) NOT NULL,
  `cl_03` varchar(50) NOT NULL,
  `cl_04` varchar(50) NOT NULL,
  `cl_05` varchar(50) NOT NULL,
  `cl_06` varchar(50) NOT NULL,
  `cl_07` varchar(50) NOT NULL,
  `cl_08` varchar(50) NOT NULL,
  `ckl_list` varchar(50) NOT NULL,
  `ckw_list` varchar(50) NOT NULL,
  `ckf_list` varchar(50) NOT NULL,
  `detail_recom` text NOT NULL,
  `detail_recom2` text NOT NULL,
  `detail_calpr` text NOT NULL,
  `approve` int(1) NOT NULL,
  `supply` int(1) NOT NULL,
  `approve_return` varchar(1) DEFAULT NULL,
  `st_setting` int(11) NOT NULL,
  `loc_date2` date NOT NULL,
  `sell_date` date NOT NULL,
  `loc_date3` date NOT NULL,
  `cus_source` varchar(2) DEFAULT 'fo',
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_service_report5sub`
--

CREATE TABLE `s_service_report5sub` (
  `r_id` int(11) NOT NULL,
  `sr_id` int(11) NOT NULL,
  `codes` varchar(20) NOT NULL,
  `lists` varchar(255) NOT NULL,
  `units` varchar(20) NOT NULL,
  `prices` varchar(20) DEFAULT '0',
  `amounts` varchar(20) DEFAULT '0',
  `opens` varchar(20) DEFAULT '0',
  `remains` varchar(20) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_user`
--

CREATE TABLE `s_user` (
  `user_id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `u_images` varchar(255) NOT NULL,
  `admin_flag` int(2) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_by` varchar(50) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(50) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_user_group`
--

CREATE TABLE `s_user_group` (
  `user_group_id` int(10) UNSIGNED NOT NULL,
  `user_id` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `group_id` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_user_p`
--

CREATE TABLE `s_user_p` (
  `user_p_id` bigint(20) NOT NULL,
  `user_id` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `group_id` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `module_id` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `read_p` char(1) DEFAULT '0',
  `add_p` char(1) DEFAULT '0',
  `update_p` char(1) DEFAULT '0',
  `delete_p` char(1) DEFAULT '0',
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_by` varchar(50) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(50) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_menu_cate`
--

CREATE TABLE `tb_menu_cate` (
  `menucate_id` int(10) UNSIGNED NOT NULL,
  `rank` int(10) NOT NULL,
  `menucate_name` varchar(255) NOT NULL,
  `url_link` varchar(255) NOT NULL,
  `create_by` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_by` varchar(100) NOT NULL,
  `update_date` datetime NOT NULL,
  `delete_by` varchar(100) NOT NULL,
  `delete_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_menu_submenu`
--

CREATE TABLE `tb_menu_submenu` (
  `id` int(10) UNSIGNED NOT NULL,
  `rank` int(10) NOT NULL,
  `menucate_id` int(10) NOT NULL,
  `submenu_name` varchar(255) NOT NULL,
  `submenu_url_link` varchar(255) NOT NULL,
  `create_by` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_by` varchar(100) NOT NULL,
  `update_date` datetime NOT NULL,
  `delete_by` varchar(100) NOT NULL,
  `delete_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `s_backup_database`
--
ALTER TABLE `s_backup_database`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `s_document`
--
ALTER TABLE `s_document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_first_order`
--
ALTER TABLE `s_first_order`
  ADD PRIMARY KEY (`fo_id`);

--
-- Indexes for table `s_group`
--
ALTER TABLE `s_group`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `s_group_custommer`
--
ALTER TABLE `s_group_custommer`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `s_group_fix`
--
ALTER TABLE `s_group_fix`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `s_group_pod`
--
ALTER TABLE `s_group_pod`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `s_group_product`
--
ALTER TABLE `s_group_product`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `s_group_project`
--
ALTER TABLE `s_group_project`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `s_group_sale`
--
ALTER TABLE `s_group_sale`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `s_group_service`
--
ALTER TABLE `s_group_service`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `s_group_sparpart`
--
ALTER TABLE `s_group_sparpart`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `s_group_sparpart_bill`
--
ALTER TABLE `s_group_sparpart_bill`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `s_group_sparpart_bill_pro`
--
ALTER TABLE `s_group_sparpart_bill_pro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_group_technician`
--
ALTER TABLE `s_group_technician`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `s_group_type`
--
ALTER TABLE `s_group_type`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `s_group_typeproduct`
--
ALTER TABLE `s_group_typeproduct`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `s_group_typeproduct2`
--
ALTER TABLE `s_group_typeproduct2`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `s_lang`
--
ALTER TABLE `s_lang`
  ADD PRIMARY KEY (`lang_id`);

--
-- Indexes for table `s_module`
--
ALTER TABLE `s_module`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `s_project_order`
--
ALTER TABLE `s_project_order`
  ADD PRIMARY KEY (`fo_id`);

--
-- Indexes for table `s_project_order_cost`
--
ALTER TABLE `s_project_order_cost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_project_product`
--
ALTER TABLE `s_project_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_project_product_cost`
--
ALTER TABLE `s_project_product_cost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_province`
--
ALTER TABLE `s_province`
  ADD PRIMARY KEY (`province_id`);

--
-- Indexes for table `s_service_report`
--
ALTER TABLE `s_service_report`
  ADD PRIMARY KEY (`sr_id`);

--
-- Indexes for table `s_service_report2`
--
ALTER TABLE `s_service_report2`
  ADD PRIMARY KEY (`sr_id`);

--
-- Indexes for table `s_service_report2sub`
--
ALTER TABLE `s_service_report2sub`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `s_service_report3`
--
ALTER TABLE `s_service_report3`
  ADD PRIMARY KEY (`sr_id`);

--
-- Indexes for table `s_service_report3sub`
--
ALTER TABLE `s_service_report3sub`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `s_service_report4`
--
ALTER TABLE `s_service_report4`
  ADD PRIMARY KEY (`sr_id`);

--
-- Indexes for table `s_service_report4sub`
--
ALTER TABLE `s_service_report4sub`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `s_service_report5`
--
ALTER TABLE `s_service_report5`
  ADD PRIMARY KEY (`sr_id`);

--
-- Indexes for table `s_service_report5sub`
--
ALTER TABLE `s_service_report5sub`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `s_user`
--
ALTER TABLE `s_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `s_user_group`
--
ALTER TABLE `s_user_group`
  ADD PRIMARY KEY (`user_group_id`);

--
-- Indexes for table `s_user_p`
--
ALTER TABLE `s_user_p`
  ADD PRIMARY KEY (`user_p_id`);

--
-- Indexes for table `tb_menu_cate`
--
ALTER TABLE `tb_menu_cate`
  ADD PRIMARY KEY (`menucate_id`);

--
-- Indexes for table `tb_menu_submenu`
--
ALTER TABLE `tb_menu_submenu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `s_backup_database`
--
ALTER TABLE `s_backup_database`
  MODIFY `group_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_document`
--
ALTER TABLE `s_document`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_first_order`
--
ALTER TABLE `s_first_order`
  MODIFY `fo_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group`
--
ALTER TABLE `s_group`
  MODIFY `group_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_custommer`
--
ALTER TABLE `s_group_custommer`
  MODIFY `group_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_fix`
--
ALTER TABLE `s_group_fix`
  MODIFY `group_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_pod`
--
ALTER TABLE `s_group_pod`
  MODIFY `group_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_product`
--
ALTER TABLE `s_group_product`
  MODIFY `group_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_project`
--
ALTER TABLE `s_group_project`
  MODIFY `group_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_sale`
--
ALTER TABLE `s_group_sale`
  MODIFY `group_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_service`
--
ALTER TABLE `s_group_service`
  MODIFY `group_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_sparpart`
--
ALTER TABLE `s_group_sparpart`
  MODIFY `group_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_sparpart_bill`
--
ALTER TABLE `s_group_sparpart_bill`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_sparpart_bill_pro`
--
ALTER TABLE `s_group_sparpart_bill_pro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_technician`
--
ALTER TABLE `s_group_technician`
  MODIFY `group_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_type`
--
ALTER TABLE `s_group_type`
  MODIFY `group_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_typeproduct`
--
ALTER TABLE `s_group_typeproduct`
  MODIFY `group_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_typeproduct2`
--
ALTER TABLE `s_group_typeproduct2`
  MODIFY `group_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_lang`
--
ALTER TABLE `s_lang`
  MODIFY `lang_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_module`
--
ALTER TABLE `s_module`
  MODIFY `module_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_project_order`
--
ALTER TABLE `s_project_order`
  MODIFY `fo_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_project_order_cost`
--
ALTER TABLE `s_project_order_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_project_product`
--
ALTER TABLE `s_project_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_project_product_cost`
--
ALTER TABLE `s_project_product_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_province`
--
ALTER TABLE `s_province`
  MODIFY `province_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_service_report`
--
ALTER TABLE `s_service_report`
  MODIFY `sr_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_service_report2`
--
ALTER TABLE `s_service_report2`
  MODIFY `sr_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_service_report2sub`
--
ALTER TABLE `s_service_report2sub`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_service_report3`
--
ALTER TABLE `s_service_report3`
  MODIFY `sr_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_service_report3sub`
--
ALTER TABLE `s_service_report3sub`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_service_report4`
--
ALTER TABLE `s_service_report4`
  MODIFY `sr_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_service_report4sub`
--
ALTER TABLE `s_service_report4sub`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_service_report5`
--
ALTER TABLE `s_service_report5`
  MODIFY `sr_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_service_report5sub`
--
ALTER TABLE `s_service_report5sub`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_user`
--
ALTER TABLE `s_user`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_user_group`
--
ALTER TABLE `s_user_group`
  MODIFY `user_group_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_user_p`
--
ALTER TABLE `s_user_p`
  MODIFY `user_p_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_menu_cate`
--
ALTER TABLE `tb_menu_cate`
  MODIFY `menucate_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_menu_submenu`
--
ALTER TABLE `tb_menu_submenu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
