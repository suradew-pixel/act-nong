-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 18, 2026 at 01:00 PM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nongsim_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `cover_image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `title`, `description`, `cover_image`, `created_at`) VALUES
(2, 'จับของขวัญ', 'ส่งท้ายปีเก่า  ต้อนรับปีใหม่ ขอให้มีความสุข  เจริญด้วยอายุ  วรรณะ  สุขะ  พละ ร่ำรวยเงินทอง ปราศจากโรคภัยไข้เจ็บตลอดปี 2569', '1768303538_cover_605207065_3437011843132021_1733867039413981049_n.jpg', '2025-12-26 10:07:28'),
(3, 'พัฒนาหมู่บ้าน   ', '', '1768303182_cover_571309166_3366985420134664_401315441802310081_n.jpg', '2026-01-13 11:19:42'),
(5, 'งานของดี วิถีจอมพระ', '19 ถึง 22 กุมภาพันธ์ 2569 ช่วยเป็นกำลังใจแรงใจให้กับลูกหลานบ้านหนองสิมของเราด้วยนะครับ', '1772371474_cover_636368107_3492575687575636_1556224366530332255_n.jpg', '2026-03-01 13:23:53'),
(6, 'ณ ร.ร.จอมพระประชาสรรค์', 'ขอบคุณครับที่แว.ะอุุดหนุนสินค้าชุมชนคนหนองสิม', '1772371873_cover_634083528_3484694098363795_2895400307922399940_n.jpg', '2026-03-01 13:29:07');

-- --------------------------------------------------------

--
-- Table structure for table `activity_images`
--

CREATE TABLE `activity_images` (
  `id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_images`
--

INSERT INTO `activity_images` (`id`, `activity_id`, `image_path`) VALUES
(13, 3, '1768303182_0_572028036_3366985886801284_3283606801220346983_n.jpg'),
(14, 3, '1768303182_1_571080176_3366985596801313_8729682239832466185_n.jpg'),
(15, 3, '1768303182_2_571788512_3366985523467987_4331308044291177498_n.jpg'),
(16, 3, '1768303182_3_571661853_3366985476801325_7763905408225257684_n.jpg'),
(17, 2, '1768303538_0_605425099_3437010543132151_9196556798994961264_n.jpg'),
(18, 2, '1768303538_1_605687573_3437010376465501_5721008094611359723_n.jpg'),
(19, 2, '1768303538_2_603847578_3437010293132176_3594872831575079281_n.jpg'),
(20, 2, '1768303538_3_605144561_3437010166465522_5643191207271032424_n.jpg'),
(21, 2, '1768303538_4_605127920_3437009993132206_7540380804941835981_n.jpg'),
(22, 2, '1768303538_5_605756648_3437009906465548_9148233768789768138_n.jpg'),
(23, 2, '1768303538_6_607015469_3437009823132223_5706019319842134216_n.jpg'),
(24, 2, '1768303538_7_605218236_3437009736465565_2546264886375209109_n.jpg'),
(25, 2, '1768303538_8_605202969_3437011943132011_1329161217820207088_n.jpg'),
(29, 5, '1772371433_0_639724699_3492575560908982_649645850315982593_n.jpg'),
(30, 5, '1772371433_1_637982514_3492575497575655_2451488991675261254_n.jpg'),
(31, 5, '1772371433_2_636368107_3492575687575636_1556224366530332255_n.jpg'),
(32, 6, '1772371747_0_630727831_3484694371697101_3729423246625190381_n.jpg'),
(33, 6, '1772371747_1_633188291_3484694271697111_462216285312522802_n.jpg'),
(34, 6, '1772371747_2_631277110_3484694231697115_1229053898155700647_n.jpg'),
(35, 6, '1772371747_3_633423361_3484694195030452_1518481019688388262_n.jpg'),
(36, 6, '1772371747_4_631403810_3484694145030457_3146903362562356448_n.jpg'),
(37, 6, '1772371747_5_634083528_3484694098363795_2895400307922399940_n.jpg'),
(38, 6, '1772371747_6_639724699_3492575560908982_649645850315982593_n.jpg'),
(39, 6, '1772371747_7_637982514_3492575497575655_2451488991675261254_n.jpg'),
(40, 6, '1772371801_0_630727831_3484694371697101_3729423246625190381_n.jpg'),
(41, 6, '1772371801_1_633188291_3484694271697111_462216285312522802_n.jpg'),
(42, 6, '1772371801_2_631277110_3484694231697115_1229053898155700647_n.jpg'),
(43, 6, '1772371801_3_633423361_3484694195030452_1518481019688388262_n.jpg'),
(44, 6, '1772371801_4_631403810_3484694145030457_3146903362562356448_n.jpg'),
(45, 6, '1772371801_5_634083528_3484694098363795_2895400307922399940_n.jpg'),
(46, 6, '1772371873_0_630727831_3484694371697101_3729423246625190381_n.jpg'),
(47, 6, '1772371873_1_633188291_3484694271697111_462216285312522802_n.jpg'),
(48, 6, '1772371873_2_631277110_3484694231697115_1229053898155700647_n.jpg'),
(49, 6, '1772371873_3_633423361_3484694195030452_1518481019688388262_n.jpg'),
(50, 6, '1772371873_4_631403810_3484694145030457_3146903362562356448_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leaders`
--

CREATE TABLE `leaders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaders`
--

INSERT INTO `leaders` (`id`, `name`, `position`, `phone`, `image_path`) VALUES
(18, 'นายอดิเรก บูรณะ', 'ผู้ใหญ่บ้าน', '0813114404', '1772100758_Screenshot 2026-02-26 171216.png'),
(19, 'นางสมพร สิงห์มี', 'ผู้ช่วยผู้ใหญ่บ้าน', '0837251278', '1772100860_8c4ab878-e454-40c7-9880-0bde7240a206.jfif'),
(22, 'นายปรีชา อยู่เย็น', 'ผู้ช่วยผู้ใหญ่บ้าน', '0833679379', '1772343798_Screenshot 2026-02-26 174001.png'),
(25, 'นางไสว พวงจันทร์', 'กรรมการเงินล้าน', '0650834679', '1772370739_143879623_102222868562959_5082885710601235089_n.jpg'),
(27, 'นางสาวดวงพร ใจกล้า', 'ประธาน อสม.', '0925653986', '1772370958_474837500_1412967023245362_9078334490259341601_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `image_path`, `created_at`) VALUES
(13, 'ร่วมทำบุญตักบาตร  ถวายเป็นพระราชกุศล', 'ขอเชิญพ่อแม่พี่น้องชาวหนองสิมมา ร่วมทำบุญตักบาตร  ข้าวสาร  อาหารแห้ง  ถวายเป็นพระราชกุศล  เนื่องในวันคล้ายวันพระราชสมภพพระบาทสมเด็จพระบรมชนกาธิเบศร มหาภูมิพลอดุลยเดชมหาราช บรมนาถบพิตร วันชาติ และ วันพ่อแห่งชาติ  ในวันที่ 5 ธันวาคม 2568 ณ หอประชุมอำเภอจอมพระ', '1768303942_594064356_3411583909008148_6905593336402407174_n.jpg', '2026-01-13 11:32:22'),
(15, 'เลือกตั้งนายก', '11ม.ค 2569 ม.14 ต.จอมพระ อ.จอมพระ จ.สุรินทร์', '1768312436_614721094_3449252415241297_5471451215434870012_n.jpg', '2026-01-13 13:53:56'),
(19, 'งานของดี วิธีจอมพระ', '19-22 กุมภาพันธ์ 2569 แวะเยี่ยมชมสินค้าชุมชน องค์การบริหารส่วนตำบลจอมพระ อุดหนุนด้วยนะครับ', '1772773260_639688365_3493496420816896_7491275115214719820_n.jpg', '2026-03-06 05:01:00'),
(20, ' อบต.จอมพระ ร่วมกับ มหาวิทยาลัยราชภัฎจังหวัดสุรินทร์ได้จัดกิจกรรม อบรมเชิงปฏิบัติการพัฒนาและสร้างมูลค่าเพิ่มผลิตภัณฑ์คราฟท์  ', '   กิจกรรมฯสร้างอาชีพ ทั้ง 2 รุ่น  วันนี้เป็นการถ่ายทำวีดีทัศน์เพื่อประชาสัมพันธ์โครงการ ฯ ทั้ง 4 อปท. คือ ท ต.จอมพระ  ทต.กระหาด  อบต.เมืองลีง และ อบต.จอมพระ  ณ .ศาลาประขาคมบ้านหนองยาว  ต.กระหาด  \r\n#ขอขอบคุณผู้ใหญ่บ้านหนองสิมที่ได้ส่งเสริมสนับสนุนนกิจกรรมให้ลูกบ้านได้เป็นตัวแทน อบต.จอมพระในการถ่ายทำวีดีทัศน์ในครั้งนี้ จำเริญดี  ????????????\r\n', '1772773385_633079523_1273087711406460_6585324515341194414_n.jpg', '2026-03-06 05:02:51');

-- --------------------------------------------------------

--
-- Table structure for table `page_content`
--

CREATE TABLE `page_content` (
  `id` int(11) NOT NULL,
  `page_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `page_content`
--

INSERT INTO `page_content` (`id`, `page_name`, `content`, `image_path`) VALUES
(1, 'history', 'หมู่บ้านหนองสิม ตั้งอยู่ในตำบลจอมพระ อำเภอจอมพระ จังหวัดสุรินทร์ เป็นชุมชนชนบทที่มีประวัติความเป็นมายาวนาน ชื่อหมู่บ้าน “หนองสิม” มีที่มาจากลักษณะภูมิประเทศในอดีตซึ่งเป็นพื้นที่ลุ่ม มีหนองน้ำขนาดใหญ่ และใช้เป็นสถานที่ประกอบพิธีกรรมทางศาสนา เช่น การบวชหรือการทำสิมน้ำประชาชนในหมู่บ้านหนองสิมส่วนใหญ่เป็นชาวไทยเชื้อสายเขมร มีวิถีชีวิตเรียบง่าย ยึดอาชีพเกษตรกรรมเป็นหลัก เช่น การทำนา การเลี้ยงสัตว์ และการทำการเกษตรแบบพอเพียง ควบคู่ไปกับการดำรงชีวิตตามขนบธรรมเนียมประเพณีและวัฒนธรรมท้องถิ่นหมู่บ้านหนองสิมมีการจัดกิจกรรมทางศาสนาและประเพณีอย่างต่อเนื่อง เช่น งานบุญประจำปี งานทำบุญกลางบ้าน งานทอดกฐิน และกิจกรรมจิตอาสา ซึ่งสะท้อนถึงความสามัคคีและการมีส่วนร่วมของคนในชุมชน อย่างไรก็ตาม การเผยแพร่ข้อมูลเกี่ยวกับกิจกรรมและศักยภาพของหมู่บ้านยังจำกัดอยู่ภายในพื้นที่ ส่งผลให้บุคคลภายนอกไม่สามารถรับรู้ข้อมูลของหมู่บ้านได้อย่างทั่วถึง', '1766916080_pexels-photo-6965543.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_images`
--
ALTER TABLE `activity_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_id` (`activity_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaders`
--
ALTER TABLE `leaders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_content`
--
ALTER TABLE `page_content`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `activity_images`
--
ALTER TABLE `activity_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leaders`
--
ALTER TABLE `leaders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `page_content`
--
ALTER TABLE `page_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_images`
--
ALTER TABLE `activity_images`
  ADD CONSTRAINT `activity_images_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
