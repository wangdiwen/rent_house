-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 13, 2016 at 03:23 PM
-- Server version: 5.5.47-MariaDB
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rh`
--

-- --------------------------------------------------------

--
-- Table structure for table `rh_advice`
--

CREATE TABLE IF NOT EXISTS `rh_advice` (
  `id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `nick` varchar(20) NOT NULL,
  `popo` varchar(20) DEFAULT NULL,
  `say` varchar(512) NOT NULL,
  `pub_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rh_advice`
--

INSERT INTO `rh_advice` (`id`, `status`, `nick`, `popo`, `say`, `pub_time`) VALUES
(1, 1, '油炸电风扇', 'hzwangdiwen1', '增加高级搜索功能，还有把界面优化一下', '2016-07-09 13:36:14'),
(2, 1, '小刀', 'xiaodao', '房子图片现在只能放3张，可以增加张数和大小限制吗？', '2016-07-09 13:37:34'),
(3, 1, '浪里白条', 'bobaniubi', '发布房源已经有了，那如何解决求租的需求呢？', '2016-07-09 13:42:38'),
(4, 1, '西秦', 'hzbaihuancheng', '我要发布那里试着对接下openid，做可删除的。', '2016-07-09 23:21:36'),
(5, 1, '旺仔Q糖', 'hzhuyuyong', '租房信息页，一般我们比较关注的有：价格，面积大小，主次卧还是单间，离公司多远\r\n希望在这方面的信', '2016-07-12 11:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `rh_house`
--

CREATE TABLE IF NOT EXISTS `rh_house` (
  `id` int(10) unsigned NOT NULL,
  `s_date` date NOT NULL DEFAULT '0000-00-00',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `pub_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ukey` bigint(20) unsigned NOT NULL,
  `community` varchar(20) NOT NULL,
  `popo` varchar(20) NOT NULL DEFAULT '',
  `phone` bigint(20) unsigned DEFAULT NULL,
  `room_num` tinyint(3) unsigned NOT NULL,
  `room_type` enum('master','slave','single') NOT NULL DEFAULT 'slave',
  `rent_type` enum('short','long') NOT NULL DEFAULT 'long',
  `man` enum('girl','boy','no') NOT NULL DEFAULT 'girl',
  `animal` varchar(10) DEFAULT NULL,
  `price` smallint(5) unsigned NOT NULL,
  `xy_point` varchar(30) NOT NULL,
  `other` varchar(140) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rh_house`
--

INSERT INTO `rh_house` (`id`, `s_date`, `status`, `pub_time`, `ukey`, `community`, `popo`, `phone`, `room_num`, `room_type`, `rent_type`, `man`, `animal`, `price`, `xy_point`, `other`) VALUES
(1, '2016-07-27', 1, '2016-07-09 15:02:12', 1468047641428, '长江小区东苑', 'hzwangdiwen1', 13291288276, 3, 'master', 'long', 'no', 'cat', 1400, '120.186524,30.179616', '房间朝东，有大窗户可以晒衣服，距离公司相当近，目前其他两个舍友都是华三的女生，非常好相处。'),
(2, '2016-07-27', 0, '2016-07-11 15:02:12', 1468047641428, '长江小区东苑', 'hzwangdiwen1', 13291288276, 3, 'master', 'long', 'no', 'cat', 1400, '120.186524,30.179616', '房间朝东，有大窗户可以晒衣服，距离公司相当近，目前其他两个舍友都是华三的女生，非常好相处。'),
(3, '2016-07-21', 0, '2016-07-11 12:00:08', 1468209554561, '滨兴东苑', 'hzwangdiwen1', 0, 3, 'master', 'short', 'boy', 'dog', 1500, '120.201395,30.195159', '距离公司很近。'),
(4, '2016-07-21', 0, '2016-07-11 12:10:26', 1468210182349, '白金海岸', 'hzbaihuancheng', 13871992061, 2, 'slave', 'short', 'boy', 'cat', 1500, '120.18822,30.202522', '测试'),
(5, '2016-07-15', 1, '2016-07-11 17:22:10', 1468228754894, '江虹小区', 'hzwangjiamin1', 18767102247, 2, 'slave', 'long', 'no', '', 3600, '120.194399,30.189391', '【房源一则】，是认识的人发的，房源来自驻客公寓：江虹小区，就在我们网易附近，两室一厅一厨一卫'),
(6, '2016-07-17', 1, '2016-07-11 18:34:04', 1468233149933, '滨兴小区', 'qzyn2320', 0, 3, 'master', 'long', 'no', '', 1600, '120.201266,30.192674', '向南 ，有宽带洗衣机，热水器空调'),
(7, '2016-07-14', 0, '2016-07-11 19:57:01', 1468238203562, 'TEST', 'hzbaihuancheng', 0, 3, 'master', 'long', 'no', '', 1500, '120.18719,30.196884', 'CES'),
(8, '2016-07-31', 1, '2016-07-12 10:09:31', 1468289259514, '盛庐小区', 'hzchenqi', 18157153212, 4, 'master', 'long', 'no', 'dog', 1400, '120.176096,30.192349', '没有厨房，舍友两个网易单身男同事，阳光帅气型。');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rh_advice`
--
ALTER TABLE `rh_advice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rh_house`
--
ALTER TABLE `rh_house`
  ADD PRIMARY KEY (`id`),
  ADD KEY `s_date` (`s_date`,`status`),
  ADD KEY `popo` (`popo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rh_advice`
--
ALTER TABLE `rh_advice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `rh_house`
--
ALTER TABLE `rh_house`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
