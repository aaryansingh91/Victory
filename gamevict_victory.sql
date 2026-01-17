-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 17, 2026 at 02:53 PM
-- Server version: 10.6.21-MariaDB
-- PHP Version: 8.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamevict_victory`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountstatement`
--

CREATE TABLE `accountstatement` (
  `account_statement_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `pubg_id` varchar(50) DEFAULT NULL,
  `from_mem_id` int(11) NOT NULL DEFAULT 0,
  `deposit` double NOT NULL,
  `withdraw` double NOT NULL,
  `join_money` double NOT NULL DEFAULT 0,
  `win_money` double NOT NULL DEFAULT 0,
  `match_id` int(11) NOT NULL DEFAULT 0,
  `note` varchar(200) DEFAULT NULL,
  `note_id` enum('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21') NOT NULL COMMENT '0 = add money to join wallet,1 = withdraw from win wallet,2 = match join,3 = register referral,4 = referral,5 = match reward,6 = refund,7 = add money to win wallet,8 = withdraw from join wallet,9 = pending withdraw,10 = Lottery Joined,11 = Lottery Reward,12=product order,13=watch and earn,14=Add Challenge,15=Accept Challenge,16=Cancel Challenge,17=Win Challenge,18=Panelty Charge,19=Pending Add Money,20=Failed Add Money,21=Ludo Challenge Penlty',
  `pyatmnumber` varchar(200) DEFAULT NULL,
  `withdraw_method` varchar(200) DEFAULT NULL,
  `entry_from` enum('0','1','2','3') NOT NULL DEFAULT '0' COMMENT '0=unknown,1=app,2=web,3=admin',
  `ip_detail` varchar(200) NOT NULL,
  `browser` varchar(200) NOT NULL,
  `accountstatement_dateCreated` datetime NOT NULL,
  `lottery_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `deposit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `default_login` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=yes,1=no',
  `permission` longtext NOT NULL,
  `craeted_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `default_login`, `permission`, `craeted_date`) VALUES
(1, 'admin', 'gameaura@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '0', '', '2019-01-10 17:19:25'),
(71, 'Mohan2854@sys74', 'Mohan2854@sys', 'e307b09a04131b00abb992a068221cfe', '0', '[\"1\",\"2\",\"9\",\"82\",\"83\",\"88\",\"90\",\"26\",\"27\"]', '2025-10-30 05:03:34'),
(72, 'Raj8625@sys72', 'Raj8625@sys', '18508d983450c6651938e0929abd3fb1', '0', '[\"9\",\"10\",\"83\",\"90\"]', '2025-10-30 05:05:10'),
(79, 'jarvish098toy@xlofi', 'jarvish098toy@xlofi@gmail.com', 'eb77124414e89b03a49fcb15d52f000e', '0', '[\"9\",\"88\",\"90\"]', '2025-10-30 09:45:32'),
(86, 'Rudra8427@sys98', 'grthjyrjethrsg', 'ed9a321ad95e4e3382cfa95cc93d5f6b', '0', '[\"9\",\"88\"]', '2025-11-05 08:44:53'),
(87, 'Aadi4351@lolx52', 'efwrhtdvz', 'a6334d52f790e08b2e6d5bb43b93998c', '0', '[\"9\",\"88\"]', '2025-11-05 08:46:16'),
(88, 'Vishwas8677@sys98', 'Vishwas8677@gmail.com', 'f1ab785eb4d07c06c99c92201372fc91', '0', '[\"9\",\"88\"]', '2025-11-08 12:56:00'),
(96, 'AuraSys_owner1', 'dhruv@nightmode9', '0234601609bfed1034789632b5732781', '0', '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"82\",\"83\",\"89\",\"90\",\"91\",\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\",\"22\",\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"43\",\"44\",\"45\",\"46\",\"47\",\"48\",\"49\",\"50\",\"51\",\"52\",\"53\",\"54\",\"55\",\"56\",\"57\",\"58\",\"59\",\"60\",\"61\",\"62\",\"63\",\"64\",\"65\",\"66\",\"67\",\"68\",\"69\",\"70\",\"71\",\"72\",\"73\",\"74\",\"75\",\"77\",\"78\",\"79\",\"80\",\"81\",\"85\",\"86\",\"87\",\"92\",\"93\"]', '2025-12-03 15:50:39'),
(98, 'Vibhu@resultLOLX', 'Vibhu@gmail.com', '3f32af08ce6a4641f8749434ac19d27c', '0', '[\"9\",\"83\",\"90\"]', '2025-12-07 21:08:44'),
(100, 'dhruv87@sys33', 'AuraSys_owner', '5af07686f81dff97792886e1d5fccf06', '0', '[\"6\",\"9\",\"10\",\"11\",\"89\",\"90\"]', '2025-12-10 16:01:39'),
(108, 'Sumeet847@sys98', 'AuraSys_Admin1', 'a8667a49a8e62dbd4cc1d0538d7b5173', '0', '[\"9\",\"88\"]', '2026-01-09 14:44:46'),
(109, 'Ayush46532@sys52', 'Ayush46532@gmail.com', 'f4bd50e3b326c150eb95ee8d450ac946', '0', '[\"9\",\"88\"]', '2026-01-10 10:51:10');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `announcement_id` int(11) NOT NULL,
  `announcement_desc` text NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`announcement_id`, `announcement_desc`, `date_created`) VALUES
(2, '• PER DAY MATCH JOIN LIMIT !!\r\n\r\n In Lone Wolf And Clash Squad mode, you can play only 8 matches per day. If a match gets canceled or you can’t play, it still counts And if you exceed the match limit, Then You Will Be Ban Without Giving Any Warning.', '2025-10-19 00:50:17'),
(3, '• ADD COIN ISSUE !!\r\n\r\nIf your coins don’t add in your wallet after payment, send your payment screenshot and username to customer support within 12 hours for a quick resolution.', '2025-10-19 00:50:36'),
(4, '• SCREEN RECORDING MANDATORY !!\r\n\r\nScreen recording is mandatory while playing any match, Keep it saved for 24 hours Compulsory For Evidence, as it may be requested for review if there’s any doubt.', '2025-10-19 00:50:49'),
(5, '• RULES AND INSTRUCTIONS TO AVOID BAN !!\r\n\r\nIf you register matches using names like user1/user2 or random/random By, you may get a penalty of up to 100 coins.\r\nUsing multiple accounts with the same game ID will result in a direct ban without warning.', '2025-10-19 00:51:01'),
(6, 'Read Rules Properly GameAura Esports', '2025-10-19 00:51:15');

-- --------------------------------------------------------

--
-- Table structure for table `app_upload`
--

CREATE TABLE `app_upload` (
  `app_upload_id` int(11) NOT NULL,
  `app_upload` mediumtext NOT NULL,
  `app_version` varchar(200) NOT NULL,
  `app_description` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `force_update` enum('Yes','No') NOT NULL,
  `force_logged_out` enum('Yes','No') NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_upload`
--

INSERT INTO `app_upload` (`app_upload_id`, `app_upload`, `app_version`, `app_description`, `date_created`, `force_update`, `force_logged_out`) VALUES
(1, 'WinHub.apk', '3', '<p>Test</p>\r\n', '2025-10-30 05:37:08', 'Yes', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `banner_id` int(11) NOT NULL,
  `banner_title` varchar(200) NOT NULL,
  `banner_image` text NOT NULL,
  `banner_link_type` enum('app','web') NOT NULL,
  `banner_link` text NOT NULL,
  `link_id` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=deactive,1=active',
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`banner_id`, `banner_title`, `banner_image`, `banner_link_type`, `banner_link`, `link_id`, `status`, `date_created`) VALUES
(11, 'ROOM ID AND PASS', '202511122056281769153788__sliderapp.jpg', 'web', 'https://youtu.be/mknurEE6uAw?si=d-JiGYE6r5diNlvi', 20, '1', '2025-09-16 02:22:11'),
(12, 'ID SELL', '202510281309461847087286__NWID.jpg', 'web', 'https://whatsapp.com/channel/0029VbBaU2L84OmK7zYz3U2I', 0, '1', '2025-10-11 19:21:50'),
(13, 'WHATSAPP CHANNEL', '202510281255231836174223__WHATSAPPAURA_(1).jpg', 'web', 'https://whatsapp.com/channel/0029VbBMutwJ93wbWxt2iA1L', 0, '1', '2025-10-19 00:49:09');

-- --------------------------------------------------------

--
-- Table structure for table `challenge_result_upload`
--

CREATE TABLE `challenge_result_upload` (
  `challenge_result_upload_id` int(11) NOT NULL,
  `ludo_challenge_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `result_uploded_by_flag` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=by addedd,1=by accepted',
  `result_image` longtext NOT NULL,
  `reason` mediumtext NOT NULL,
  `result_status` enum('0','1','2') NOT NULL COMMENT '0=win,1=lost,2=error',
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `challenge_room_code`
--

CREATE TABLE `challenge_room_code` (
  `challenge_room_code_id` int(11) NOT NULL,
  `challenge_id` int(11) NOT NULL,
  `room_code` varchar(100) NOT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `p_code` varchar(25) NOT NULL,
  `country_name` varchar(250) NOT NULL,
  `country_status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=inactive,1=active',
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `p_code`, `country_name`, `country_status`, `date_created`) VALUES
(96, '+91', 'India', '1', '2020-05-29 12:10:01');

-- --------------------------------------------------------

--
-- Table structure for table `courier`
--

CREATE TABLE `courier` (
  `courier_id` int(11) NOT NULL,
  `courier_name` varchar(255) NOT NULL,
  `courier_link` mediumtext NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=deactive,1=active',
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `currency_id` int(11) NOT NULL,
  `currency_name` varchar(100) NOT NULL,
  `currency_code` char(6) NOT NULL,
  `currency_symbol` text NOT NULL,
  `currency_decimal_place` varchar(100) NOT NULL,
  `currency_status` enum('0','1') NOT NULL,
  `currency_dateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`currency_id`, `currency_name`, `currency_code`, `currency_symbol`, `currency_decimal_place`, `currency_status`, `currency_dateCreated`) VALUES
(3, 'India Rupee', 'INR', '₹', '2', '1', '2019-03-29 15:05:12'),
(5, 'US Dollar', 'USD', '$', '2', '0', '2019-03-29 15:31:23'),
(6, 'Token', 'TRX', 'TRX', '2', '0', '2021-10-12 11:55:15');

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `deposit_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `deposit_amount` double NOT NULL,
  `wallet_address` longtext DEFAULT NULL,
  `private_key` longtext DEFAULT NULL,
  `public_key` longtext DEFAULT NULL,
  `address_hex` longtext DEFAULT NULL,
  `bank_transection_no` varchar(200) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `deposit_status` enum('0','1','2') NOT NULL COMMENT '0=pending,1=complete,2 = failed',
  `deposit_by` varchar(200) NOT NULL,
  `entry_from` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0=unknown,1=app,2=web',
  `deposit_dateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`deposit_id`, `member_id`, `deposit_amount`, `wallet_address`, `private_key`, `public_key`, `address_hex`, `bank_transection_no`, `reason`, `deposit_status`, `deposit_by`, `entry_from`, `deposit_dateCreated`) VALUES
(1, 2, 10, NULL, NULL, NULL, NULL, '17684133999348551', NULL, '0', 'UPITranzact', '1', '2026-01-14 23:26:39'),
(2, 1, 20, NULL, NULL, NULL, NULL, '17684134255123905', NULL, '0', 'UPITranzact', '1', '2026-01-14 23:27:05');

-- --------------------------------------------------------

--
-- Table structure for table `download`
--

CREATE TABLE `download` (
  `download_id` int(11) NOT NULL,
  `download_image` varchar(255) NOT NULL,
  `dp_order` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL COMMENT '0=deactive,1=active',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `features_tab`
--

CREATE TABLE `features_tab` (
  `f_id` int(11) NOT NULL,
  `f_tab_name` varchar(100) NOT NULL,
  `f_tab_title` varchar(100) NOT NULL,
  `f_tab_text` text NOT NULL,
  `f_tab_image` text NOT NULL,
  `f_tab_img_position` varchar(50) NOT NULL,
  `f_tab_order` int(11) NOT NULL,
  `f_tab_status` enum('0','1') NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features_tab`
--

INSERT INTO `features_tab` (`f_id`, `f_tab_name`, `f_tab_title`, `f_tab_text`, `f_tab_image`, `f_tab_img_position`, `f_tab_order`, `f_tab_status`, `date_created`) VALUES
(1, 'features', '', 'See what\'s inside the GameAura Esports app.', '202510190327551773919275__111111111-removebg-preview.png', 'center', 1, '1', '2025-10-19 03:27:55');

-- --------------------------------------------------------

--
-- Table structure for table `features_tab_content`
--

CREATE TABLE `features_tab_content` (
  `ftc_id` int(11) NOT NULL,
  `features_tab_id` int(11) NOT NULL,
  `content_title` varchar(255) NOT NULL,
  `content_text` varchar(255) NOT NULL,
  `content_icon` varchar(255) NOT NULL,
  `content_status` enum('0','1') NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features_tab_content`
--

INSERT INTO `features_tab_content` (`ftc_id`, `features_tab_id`, `content_title`, `content_text`, `content_icon`, `content_status`, `date_created`) VALUES
(1, 1, 'FAIR PLAY', 'All matches are conducted fairly. Everyone gets their reward according to their performance in the game.', 'fa fa-play', '1', '2025-10-19 03:28:45'),
(2, 1, 'Fast Performance', 'GameAura Esports is built using the latest technology, with special care taken for its performance so the user never hesitates to play.', 'fa fa-mobile', '1', '2025-10-19 03:29:14'),
(3, 1, 'Win Exciting Vouchers & Prizes', 'Our platform is built on a skill-based, competitive esports model. Compete for exciting, non-monetary rewards such as digital vouchers, in-game currency, and other prizes.', 'fa fa-gift', '1', '2025-10-19 03:29:41'),
(4, 1, 'Helping Support', 'GameAura offers coustomer support which is ready to help 24x7!', 'fa fa-support', '1', '2025-10-19 03:30:11'),
(5, 1, 'Social Media Connectivity', 'Register and log in easily with your social media accounts to connect with us and the community.', 'fa fa-users', '1', '2025-10-19 03:30:42'),
(6, 1, 'Notifications', 'Get notified for all activities, including new tournaments, match results, and prize payouts.', 'fa fa-bell', '1', '2025-10-19 03:31:03');

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `game_id` int(11) NOT NULL,
  `game_name` varchar(200) NOT NULL,
  `package_name` varchar(100) NOT NULL,
  `game_image` mediumtext NOT NULL,
  `game_rules` text NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=deactive,1=active',
  `game_type` enum('0','1') NOT NULL DEFAULT '0' COMMENT '''0=normal,1=ludo functionality''',
  `follower` longtext NOT NULL,
  `id_prefix` varchar(10) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `game_logo` mediumtext NOT NULL,
  `coming_soon` int(11) NOT NULL,
  `home_game_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`game_id`, `game_name`, `package_name`, `game_image`, `game_rules`, `status`, `game_type`, `follower`, `id_prefix`, `date_created`, `game_logo`, `coming_soon`, `home_game_id`) VALUES
(20, 'FULL MAP 1', 'com.dts.freefiremax', '202510190102081793471928__gameauramap1.jpg', '<h1><strong>SCREEN RECORDING MANDATORY</strong></h1>\r\n\r\n<h1>&nbsp;</h1>\r\n\r\n<h1><strong>BOOYAH PRIZE :- 20 COINS</strong></h1>\r\n\r\n<p><strong>1. SOLO MATCH =&nbsp;WINNER 20 COINS.</strong></p>\r\n\r\n<p><strong>2. DUO MATCH = 10-10&nbsp;COINS TO ALL DUO WINNERS.</strong></p>\r\n\r\n<p><strong>3. SQUAD MATCH = 5-5 COINS TO ALL SQUAD WINNERS.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Ban Guns :-</strong></h1>\r\n\r\n<p><strong>&bull;&nbsp;DOUBLE VECTOR , M79&nbsp;</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Room Settings&nbsp;:-</strong></h1>\r\n\r\n<p><strong>1. CHARACTER SKILL :- YES</strong></p>\r\n\r\n<p><strong>2. GUN ATTRIBUTES :- OFF</strong></p>\r\n\r\n<p><strong>3. MINIMUM LEVEL :- 40</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Instructions Before Joining :-</strong></h1>\r\n\r\n<p>1<strong><strong>.&nbsp;</strong>Enter Your Free Fire Max Account Name Only&nbsp;</strong><strong>N</strong><strong>o Changes Allowed.</strong></p>\r\n\r\n<p><strong>2. Don&#39;t Put Uid/Game ID &amp; Try To Use Simple Font In Game Name.</strong></p>\r\n\r\n<p><strong>3. Room ID And Password Will Be Shared In The App Before 5 Minutes Of Match Time.</strong></p>\r\n\r\n<p><strong>4. If You Failed To Attend Match In Time You Will Not Get Any Refund.</strong></p>\r\n\r\n<p><strong>5. Unregistered Players Are Not Allowed, Inviting Unregistered Players Leads To Penalty, No Reward &amp; Account Ban.</strong></p>\r\n\r\n<p><strong>6. Record Your Gameplay, You Can Be Asked To Provide POV/Recordings. Note :- Only POV Recordings No Replays Will Be Accepted.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Eligibility Rules :-</strong></h1>\r\n\r\n<p><strong>1. Minimum 40 Level Players Are Allowed To Participate In GameAura matches.</strong></p>\r\n\r\n<p><strong>2. Headshot Rate Must Be Below 70% in BR Career</strong></p>\r\n\r\n<p><strong>3. Emulators/Pc Players Are Not Allowed.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Prohibited Behaviour :-</strong></h1>\r\n\r\n<p><strong>1. Hack &amp; Panel Users Are Not Allowed.</strong></p>\r\n\r\n<p><strong>2. Game Modifying Tools Are Not Allowed.</strong></p>\r\n\r\n<p><strong>3. Glitches &amp; Bugs Are Not Allowed</strong></p>\r\n\r\n<p><strong>4. Teaming Up With Opponents Are Not Allowed.</strong></p>\r\n\r\n<p><strong>5. Abusing Any Of The Player/Host Will Lead To An Immediate Ban.</strong></p>\r\n\r\n<p><strong>6. If a Player Found Violating Any Of The Rules, Then Prize Will Not Be Processed, And It Leads To Immediate Ban.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Some Important Tips :-</strong></h1>\r\n\r\n<p><strong>1. If Player Game-ID Is Blacklisted, Then Prizes Will Not Proceed Without Pov/Real Screen Recording.</strong></p>\r\n\r\n<p><strong>2. If Slots Are Not Full, Then The Winning Prize Get Changed As Per The Structure.</strong></p>\r\n\r\n<p><strong>3. If The Room Is Full Then The Player Should Have Screen Recording Of The Room Being Full For Refund.</strong></p>\r\n\r\n<p><strong>4. If You Are Killed By Any Hacker/Team-up Player, Record Evidence For Refund.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Raise Your Query :-</strong></h1>\r\n\r\n<p><strong>Raise Issues With Customer Support Within 1 Hour.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Note :-&nbsp;</strong></h1>\r\n\r\n<h3><strong>GameAura Reserves The Right To Modify Prizes And Rules.</strong></h3>\r\n', '1', '0', '[]', '', '2025-01-21 17:09:28', '202501211709281813515768__Picsart_24-12-26_07-31-45-572.jpg', 0, 1),
(23, 'SURVIVAL	', 'com.dts.freefiremax', '202510190103291821471409__SURV2AURAA_(1).jpg', '<h1><strong>SCREEN RECORDING MANDATORY</strong></h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; SURVIVAL PRIZE POOL :-</strong></h1>\r\n\r\n<p><strong><q>1ST POSITION</q>&nbsp;= 20 COINS&nbsp;</strong></p>\r\n\r\n<p><strong><q>2ND POSITION</q>&nbsp;= 15&nbsp;COINS&nbsp;</strong></p>\r\n\r\n<p><strong><q>3RD POSITION</q>&nbsp;= 12 COINS</strong></p>\r\n\r\n<p><strong><q>4TH&nbsp;POSITION</q>&nbsp;= 10&nbsp;COINS</strong></p>\r\n\r\n<p><strong><q>5TH POSITION</q>&nbsp;= 7&nbsp;COINS</strong></p>\r\n\r\n<p><strong><q>6TH POSITION</q>&nbsp;= 7&nbsp;COINS</strong></p>\r\n\r\n<p><strong><q>7TH POSITION</q>&nbsp;= 7&nbsp;COINS</strong></p>\r\n\r\n<p><strong><q>8TH POSITION</q>&nbsp;= 5&nbsp;COINS</strong></p>\r\n\r\n<p><strong><q>9TH POSITION</q>&nbsp;= 5&nbsp;COINS&nbsp;</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Ban Guns&nbsp;:-</strong></h1>\r\n\r\n<p><strong>&bull; DOUBLE VECTOR , M79</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Room Settings&nbsp;:-</strong></h1>\r\n\r\n<p><strong>1. CHARACTER SKILL :- YES</strong></p>\r\n\r\n<p><strong>2. GUN ATTRIBUTES :- ON</strong></p>\r\n\r\n<p><strong>3. MINIMUM LEVEL :- 40</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>&bull; Instructions Before Joining :-</strong></h2>\r\n\r\n<p><strong><strong>1.&nbsp;</strong>Enter Your Free Fire Max Account Name Only&nbsp;</strong><strong>N</strong><strong>o Changes Allowed.</strong></p>\r\n\r\n<p><strong>2. Don&#39;t Put Uid/Game ID &amp; Try To Use Simple Font In Game Name.</strong></p>\r\n\r\n<p><strong>3. Room ID And Password Will Be Shared In The App Before 10-5 Minutes Of Match Time.</strong></p>\r\n\r\n<p><strong>4. If You Failed To Attend Match In Time You Will Not Get Any Refund.</strong></p>\r\n\r\n<p><strong>5. Unregistered Players Are Not Allowed, Inviting Unregistered Players Leads To Penalty, No Reward &amp; Account Ban.</strong></p>\r\n\r\n<p><strong>6. Record Your Gameplay, You Can Be Asked To Provide POV/Recordings. Note :- Only POV Recordings No Replays Will Be Accepted.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>&bull; Eligibility Rules :-</strong></h2>\r\n\r\n<p><strong>1. Minimum 40 Level Players Are Allowed To Participate In GameAura matches.</strong></p>\r\n\r\n<p><strong>2. Headshot Rate Must Be Below 70% in BR Career</strong></p>\r\n\r\n<p><strong>3. Emulators/Pc Players Are Not Allowed.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>&bull; Prohibited Behaviour :-</strong></h2>\r\n\r\n<p><strong>1. Hack &amp; Panel Users Are Not Allowed.</strong></p>\r\n\r\n<p><strong>2. Game Modifying Tools Are Not Allowed.</strong></p>\r\n\r\n<p><strong>3. Glitches &amp; Bugs Are Not Allowed</strong></p>\r\n\r\n<p><strong>4. Teaming Up With Opponents Are Not Allowed.</strong></p>\r\n\r\n<p><strong>5. Abusing Any Of The Player/Host Will Lead To An Immediate Ban.</strong></p>\r\n\r\n<p><strong>6. If a Player Found Violating Any Of The Rules, Then Prize Will Not Be Processed, And It Leads To Immediate Ban.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>&bull; Some Important Tips :-</strong></h2>\r\n\r\n<p><strong>1. If Player Game-ID Is Blacklisted, Then Prizes Will Not Proceed Without Pov/Real Screen Recording.</strong></p>\r\n\r\n<p><strong>2. If Slots Are Not Full, Then The Winning Prize Get Changed As Per The Structure.</strong></p>\r\n\r\n<p><strong>3. If The Room Is Full Then The Player Should Have Screen Recording Of The Room Being Full For Refund.</strong></p>\r\n\r\n<p><strong>4. If You Are Killed By Any Hacker/Team-up Player, Record Evidence For Refund.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>&bull; Raise Your Query :-</strong></h2>\r\n\r\n<p><strong>Raise Issues With Customer Support Within 1 Hour.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>&bull; Note :-&nbsp;</strong></h2>\r\n\r\n<p><strong>GameAura&nbsp;Reserves The Right To Modify Prizes And Rules.</strong></p>\r\n', '1', '0', '[]', '', '2025-01-21 17:17:32', '202501211717321787837952__Picsart_24-12-26_11-02-31-417.jpg', 0, 1),
(33, 'FULL MAP 2', 'com.dts.freefiremax', '202510190104561804704296__FULLMAP2AURAA_(1).jpg', '<h1><strong>SCREEN RECORDING MANDATORY</strong></h1>\r\n\r\n<h1>&nbsp;</h1>\r\n\r\n<h1><strong>BOOYAH PRIZE :- 20 COINS</strong></h1>\r\n\r\n<p><strong>1. SOLO MATCH =&nbsp;WINNER 20 COINS.</strong></p>\r\n\r\n<p><strong>2. DUO MATCH = 10-10&nbsp;COINS TO ALL DUO WINNERS.</strong></p>\r\n\r\n<p><strong>3. SQUAD MATCH = 5-5 COINS TO ALL SQUAD WINNERS.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Ban Guns :-</strong></h1>\r\n\r\n<p><strong>&bull;&nbsp;DOUBLE VECTOR , M79&nbsp;</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Room Settings&nbsp;:-</strong></h1>\r\n\r\n<p><strong>1. CHARACTER SKILL :- YES</strong></p>\r\n\r\n<p><strong>2. GUN ATTRIBUTES :- OFF</strong></p>\r\n\r\n<p><strong>3. MINIMUM LEVEL :- 40</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Instructions Before Joining :-</strong></h1>\r\n\r\n<p>1<strong><strong>.&nbsp;</strong>Enter Your Free Fire Max Account Name Only&nbsp;</strong><strong>N</strong><strong>o Changes Allowed.</strong></p>\r\n\r\n<p><strong>2. Don&#39;t Put Uid/Game ID &amp; Try To Use Simple Font In Game Name.</strong></p>\r\n\r\n<p><strong>3. Room ID And Password Will Be Shared In The App Before 5 Minutes Of Match Time.</strong></p>\r\n\r\n<p><strong>4. If You Failed To Attend Match In Time You Will Not Get Any Refund.</strong></p>\r\n\r\n<p><strong>5. Unregistered Players Are Not Allowed, Inviting Unregistered Players Leads To Penalty, No Reward &amp; Account Ban.</strong></p>\r\n\r\n<p><strong>6. Record Your Gameplay, You Can Be Asked To Provide POV/Recordings. Note :- Only POV Recordings No Replays Will Be Accepted.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Eligibility Rules :-</strong></h1>\r\n\r\n<p><strong>1. Minimum 40 Level Players Are Allowed To Participate In GameAura matches.</strong></p>\r\n\r\n<p><strong>2. Headshot Rate Must Be Below 70% in BR Career</strong></p>\r\n\r\n<p><strong>3. Emulators/Pc Players Are Not Allowed.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Prohibited Behaviour :-</strong></h1>\r\n\r\n<p><strong>1. Hack &amp; Panel Users Are Not Allowed.</strong></p>\r\n\r\n<p><strong>2. Game Modifying Tools Are Not Allowed.</strong></p>\r\n\r\n<p><strong>3. Glitches &amp; Bugs Are Not Allowed</strong></p>\r\n\r\n<p><strong>4. Teaming Up With Opponents Are Not Allowed.</strong></p>\r\n\r\n<p><strong>5. Abusing Any Of The Player/Host Will Lead To An Immediate Ban.</strong></p>\r\n\r\n<p><strong>6. If a Player Found Violating Any Of The Rules, Then Prize Will Not Be Processed, And It Leads To Immediate Ban.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Some Important Tips :-</strong></h1>\r\n\r\n<p><strong>1. If Player Game-ID Is Blacklisted, Then Prizes Will Not Proceed Without Pov/Real Screen Recording.</strong></p>\r\n\r\n<p><strong>2. If Slots Are Not Full, Then The Winning Prize Get Changed As Per The Structure.</strong></p>\r\n\r\n<p><strong>3. If The Room Is Full Then The Player Should Have Screen Recording Of The Room Being Full For Refund.</strong></p>\r\n\r\n<p><strong>4. If You Are Killed By Any Hacker/Team-up Player, Record Evidence For Refund.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Raise Your Query :-</strong></h1>\r\n\r\n<p><strong>Raise Issues With Customer Support Within 1 Hour.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Note :-&nbsp;</strong></h1>\r\n\r\n<h3><strong>GameAura Reserves The Right To Modify Prizes And Rules.</strong></h3>\r\n', '1', '0', '[]', '', '2025-09-16 00:54:47', '202509160054471821153387__20250916_125103.jpg', 0, 1),
(34, 'LONE WOLF 1V1', 'com.dts.freefiremax', '202510190105411800572241__LW1V1AURAA_(1).jpg', '<h1><strong>SCREEN RECORDING MANDATORY</strong></h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Ban Character :-</strong></h1>\r\n\r\n<h3><strong>&bull; RYDEN</strong></h3>\r\n\r\n<h2>&nbsp;</h2>\r\n\r\n<h1><strong>&bull; Room Settings And Rules&nbsp;:-</strong></h1>\r\n\r\n<p><strong>1. LIMITED AMMO&nbsp;- YES</strong></p>\r\n\r\n<p><strong>2. GUN ATTRIBUTES&nbsp;- YES</strong></p>\r\n\r\n<p><strong>3. CHARACTER SKILL&nbsp;- YES</strong></p>\r\n\r\n<p><strong>4. LODOUT - YES</strong></p>\r\n\r\n<p><strong>5.&nbsp;ALL GUNS - ALLOW</strong></p>\r\n\r\n<p><strong>6.&nbsp;FLASH FREEZE - ALLOW</strong></p>\r\n\r\n<p><strong>7.&nbsp;ZONEPACK - ALLOW</strong></p>\r\n\r\n<p><strong>8.&nbsp;</strong><strong>HEIGHT -&nbsp;ALLOW</strong></p>\r\n\r\n<p><strong>9.&nbsp;MINIMUM LEVEL - 40</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; PER DAY MATCH JOIN LIMIT :-</strong></h1>\r\n\r\n<p><strong>&bull;&nbsp;In Lone Wolf 1v1 mode, you can play only 8 matches per day. If a match gets canceled or you can&rsquo;t play, it still counts&nbsp;And if you exceed the match limit, you&rsquo;ll face a permanent ban.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Prohibited Behaviour :-</strong></h1>\r\n\r\n<p><strong>1. Hack &amp; Panel Users Are Not Allowed.</strong></p>\r\n\r\n<p><strong>2. Game Modifying Tools Are Not Allowed.</strong></p>\r\n\r\n<p><strong>3. Glitches &amp; Bugs Are Not Allowed</strong></p>\r\n\r\n<p><strong>4. Teaming Up With Opponents Are Not Allowed.</strong></p>\r\n\r\n<p><strong>5. Abusing Any Of The Player/Host Will Lead To An Immediate Ban.</strong></p>\r\n\r\n<p><strong>6. If a Player Found Violating Any Of The Rules, Then Prize Will Not Be Processed, And It Leads To Immediate Ban.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Important Rules :-</strong></h1>\r\n\r\n<p><strong>1. Always On Screen Recording While Playing GameAura Matches.</strong></p>\r\n\r\n<p><strong>2. Minimum Game Level Should Be 40.</strong></p>\r\n\r\n<p><strong>3. Headshot % Should Not Be More Than 70%&nbsp;In Life Time Mode.</strong></p>\r\n\r\n<p><strong>4. Refund For Players , Killed By Hackers.</strong></p>\r\n\r\n<p><strong>5. If you think any cheating is going on, Please Capture some Proof and Complain us about it, GameAura&nbsp;never tolerate cheating.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Instructions Before Joining :-</strong></h1>\r\n\r\n<p>1<strong><strong>.&nbsp;</strong>Enter Your Free Fire Max Account Name Only&nbsp;</strong><strong>N</strong><strong>o Changes Allowed.</strong></p>\r\n\r\n<p><strong>2. Don&#39;t Put Uid/Game ID &amp; Try To Use Simple Font In Game Name.</strong></p>\r\n\r\n<p><strong>3. Room ID And Password Will Be Shared In The App Before 5 Minutes Of Match Time.</strong></p>\r\n\r\n<p><strong>4. If You Failed To Attend Match In Time You Will Not Get Any Refund.</strong></p>\r\n\r\n<p><strong>5. Unregistered Players Are Not Allowed, Inviting Unregistered Players Leads To Penalty, No Reward &amp; Account Ban.</strong></p>\r\n\r\n<p><strong>6. Record Your Gameplay, You Can Be Asked To Provide POV/Recordings. Note :- Only POV Recordings No Replays Will Be Accepted.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Raise Your Query :-</strong></h1>\r\n\r\n<p><strong>Raise Issues With Customer Support Within 1 Hour.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Note :-&nbsp;</strong></h1>\r\n\r\n<h3><strong>GameAura Reserves The Right To Modify Prizes And Rules.</strong></h3>\r\n', '1', '0', '[]', '', '2025-09-16 01:01:53', '202510060305341775636334__IMG_20251006_030010.jpg', 0, 1),
(36, 'LONE WOLF 2V2', 'com.dts.freefiremax', '202510190106471785797907__LW2V2AURAA_(1).jpg', '<h1><strong>SCREEN RECORDING MANDATORY</strong></h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Ban Character :-</strong></h1>\r\n\r\n<h3><strong>&bull; RYDEN</strong></h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Room Settings And Rules&nbsp;:-</strong></h1>\r\n\r\n<p><strong>1. LIMITED AMMO&nbsp;- YES</strong></p>\r\n\r\n<p><strong>2. GUN ATTRIBUTES&nbsp;- YES</strong></p>\r\n\r\n<p><strong>3. CHARACTER SKILL&nbsp;- YES</strong></p>\r\n\r\n<p><strong>4. LODOUT - YES</strong></p>\r\n\r\n<p><strong>5.&nbsp;ALL GUNS - ALLOW</strong></p>\r\n\r\n<p><strong>6.&nbsp;FLASH FREEZE - ALLOW</strong></p>\r\n\r\n<p><strong>7.&nbsp;ZONEPACK - ALLOW</strong></p>\r\n\r\n<p><strong>8.&nbsp;</strong><strong>HEIGHT -&nbsp;ALLOW</strong></p>\r\n\r\n<p><strong>9.&nbsp;MINIMUM LEVEL - 40</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; PER DAY MATCH JOIN LIMIT :-</strong></h1>\r\n\r\n<p><strong>&bull;&nbsp;In Lone Wolf 2v2&nbsp;mode, you can play only 8 matches per day. If a match gets canceled or you can&rsquo;t play, it still counts&nbsp;And if you exceed the match limit, you&rsquo;ll face a permanent ban.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Prohibited Behaviour :-</strong></h1>\r\n\r\n<p><strong>1. Hack &amp; Panel Users Are Not Allowed.</strong></p>\r\n\r\n<p><strong>2. Game Modifying Tools Are Not Allowed.</strong></p>\r\n\r\n<p><strong>3. Glitches &amp; Bugs Are Not Allowed</strong></p>\r\n\r\n<p><strong>4. Teaming Up With Opponents Are Not Allowed.</strong></p>\r\n\r\n<p><strong>5. Abusing Any Of The Player/Host Will Lead To An Immediate Ban.</strong></p>\r\n\r\n<p><strong>6. If a Player Found Violating Any Of The Rules, Then Prize Will Not Be Processed, And It Leads To Immediate Ban.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>Important Rules :-</strong></h1>\r\n\r\n<p><strong>1. Always On Screen Recording While Playing GameAura Matches.</strong></p>\r\n\r\n<p><strong>2. Minimum Game Level Should Be 40.</strong></p>\r\n\r\n<p><strong>3. Headshot % Should Not Be More Than 70%&nbsp;In Life Time Mode.</strong></p>\r\n\r\n<p><strong>4. Refund For Players , Killed By Hackers.</strong></p>\r\n\r\n<p><strong>5. If you think any cheating is going on, Please Capture some Proof and Complain us about it, GameAura&nbsp;never tolerate cheating.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Instructions Before Joining :-</strong></h1>\r\n\r\n<p>1<strong><strong>.&nbsp;</strong>Enter Your Free Fire Max Account Name Only&nbsp;</strong><strong>N</strong><strong>o Changes Allowed.</strong></p>\r\n\r\n<p><strong>2. Don&#39;t Put Uid/Game ID &amp; Try To Use Simple Font In Game Name.</strong></p>\r\n\r\n<p><strong>3. Room ID And Password Will Be Shared In The App Before 5 Minutes Of Match Time.</strong></p>\r\n\r\n<p><strong>4. If You Failed To Attend Match In Time You Will Not Get Any Refund.</strong></p>\r\n\r\n<p><strong>5. Unregistered Players Are Not Allowed, Inviting Unregistered Players Leads To Penalty, No Reward &amp; Account Ban.</strong></p>\r\n\r\n<p><strong>6. Record Your Gameplay, You Can Be Asked To Provide POV/Recordings. Note :- Only POV Recordings No Replays Will Be Accepted.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Raise Your Query :-</strong></h1>\r\n\r\n<p><strong>Raise Issues With Customer Support Within 1 Hour.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Note :-&nbsp;</strong></h1>\r\n\r\n<h3><strong>GameAura Reserves The Right To Modify Prizes And Rules.</strong></h3>\r\n', '1', '0', '[]', '', '2025-09-16 01:02:41', '202509160102411843083661__20250916_125814.jpg', 0, 1),
(38, 'LW LOSS FIRST', 'com.dts.freefiremax', '202510190107381827953258__LWLOSSAURAA_(1).jpg', '<h1><strong>SCREEN RECORDING MANDATORY</strong></h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Important Rule -: </strong></h1>\r\n\r\n<h2><strong>&bull; Never Try To Back Your Game while Playing LW LOSS ; Otherwise, If we found someone doing this, Will Get Direct&nbsp;Ban.</strong></h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Room Settings And Rules&nbsp;:-</strong></h1>\r\n\r\n<p><strong>1. LIMITED AMMO&nbsp;- YES</strong></p>\r\n\r\n<p><strong>2. GUN ATTRIBUTES&nbsp;- YES</strong></p>\r\n\r\n<p><strong>3. CHARACTER SKILL&nbsp;- YES</strong></p>\r\n\r\n<p><strong>4. LODOUT - YES</strong></p>\r\n\r\n<p><strong>5.&nbsp;ALL GUNS - ALLOW</strong></p>\r\n\r\n<p><strong>6.&nbsp;FLASH FREEZE - ALLOW</strong></p>\r\n\r\n<p><strong>7.&nbsp;ZONEPACK - ALLOW</strong></p>\r\n\r\n<p><strong>8.&nbsp;</strong><strong>HEIGHT -&nbsp;ALLOW</strong></p>\r\n\r\n<p><strong>9.&nbsp;MINIMUM LEVEL - 40</strong></p>\r\n\r\n<h2>&nbsp;</h2>\r\n\r\n<h1><strong>&bull; PER DAY MATCH JOIN LIMIT :-</strong></h1>\r\n\r\n<p><strong>&bull;&nbsp;In Lone Wolf Loss&nbsp;mode, you can play only 8 matches per day. If a match gets canceled or you can&rsquo;t play, it still counts&nbsp;And if you exceed the match limit, you&rsquo;ll face a permanent ban.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Instructions Before Joining :-</strong></h1>\r\n\r\n<p>1<strong><strong>.&nbsp;</strong>Enter Your Free Fire Max Account Name Only&nbsp;</strong><strong>N</strong><strong>o Changes Allowed.</strong></p>\r\n\r\n<p><strong>2. Don&#39;t Put Uid/Game ID &amp; Try To Use Simple Font In Game Name.</strong></p>\r\n\r\n<p><strong>3. Room ID And Password Will Be Shared In The App Before 5 Minutes Of Match Time.</strong></p>\r\n\r\n<p><strong>4. If You Failed To Attend Match In Time You Will Not Get Any Refund.</strong></p>\r\n\r\n<p><strong>5. Unregistered Players Are Not Allowed, Inviting Unregistered Players Leads To Penalty, No Reward &amp; Account Ban.</strong></p>\r\n\r\n<p><strong>6. Record Your Gameplay, You Can Be Asked To Provide POV/Recordings. Note :- Only POV Recordings No Replays Will Be Accepted.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Raise Your Query :-</strong></h1>\r\n\r\n<p><strong>Raise Issues With Customer Support Within 1 Hour.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Note :-&nbsp;</strong></h1>\r\n\r\n<h3><strong>GameAura Reserves The Right To Modify Prizes And Rules.</strong></h3>\r\n', '1', '0', '[]', '', '2025-10-06 02:44:38', '202510060343581799520338__100x100_202509160102411838570761__20250916_125814.jpg', 0, 1),
(42, 'CLASH SQUAD 1V1', 'com.dts.freefiremax', '202510190112371835021757__CS1V1AURAA_(1).jpg', '<h1><strong>SCREEN RECORDING MANDATORY</strong></h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Ban Guns :-</strong></h1>\r\n\r\n<p><strong>&bull;&nbsp;DOUBLE VECTOR </strong></p>\r\n\r\n<h2>&nbsp;</h2>\r\n\r\n<h1><strong>&bull; Room Settings And Rules&nbsp;:-</strong></h1>\r\n\r\n<p><strong>1. ROUNDS&nbsp;- 7</strong></p>\r\n\r\n<p><strong>2. COINS - 9999</strong></p>\r\n\r\n<p><strong>3. MINIMUM LEVEL - 40</strong></p>\r\n\r\n<p><strong>4. LIMITED AMMO&nbsp;- NO</strong></p>\r\n\r\n<p><strong>5. GUN ATTRIBUTES&nbsp;- YES</strong></p>\r\n\r\n<p><strong>6. CHARACTER SKILL&nbsp;- YES</strong></p>\r\n\r\n<p><strong>7. LODOUT - YES</strong></p>\r\n\r\n<p><strong>5.&nbsp;DOUBLE VECTOR - NOT ALLOWED</strong></p>\r\n\r\n<p><strong>6.&nbsp;GRENADE OR ANY THROWABLES&nbsp;- NOT&nbsp;ALLOWED</strong></p>\r\n\r\n<p><strong>7.&nbsp;ZONEPACK / HEALING BATTLE - NOT ALLOWED</strong></p>\r\n\r\n<p><strong>8.&nbsp;</strong><strong>HEIGHT - NOT ALLOWED (ONLY ADVANTAGE OF HOUSE IS NOT ALLOWED)</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; PER DAY MATCH JOIN LIMIT :-</strong></h1>\r\n\r\n<p><strong>&bull;&nbsp;In Clash Squad&nbsp;1v1 mode, you can play only 8 matches per day. If a match gets canceled or you can&rsquo;t play, it still counts&nbsp;And if you exceed the match limit, you&rsquo;ll face a permanent ban.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Prohibited Behaviour :-</strong></h1>\r\n\r\n<p><strong>1. Hack &amp; Panel Users Are Not Allowed.</strong></p>\r\n\r\n<p><strong>2. Game Modifying Tools Are Not Allowed.</strong></p>\r\n\r\n<p><strong>3. Glitches &amp; Bugs Are Not Allowed</strong></p>\r\n\r\n<p><strong>4. Teaming Up With Opponents Are Not Allowed.</strong></p>\r\n\r\n<p><strong>5. Abusing Any Of The Player/Host Will Lead To An Immediate Ban.</strong></p>\r\n\r\n<p><strong>6. If a Player Found Violating Any Of The Rules, Then Prize Will Not Be Processed, And It Leads To Immediate Ban.</strong></p>\r\n\r\n<p><strong>7.&nbsp;DOUBLE VECTOR NOT ALLOWED</strong></p>\r\n\r\n<p><strong>8.&nbsp;GRENADE OR ANY THROWABLES&nbsp;NOT&nbsp;ALLOWED</strong></p>\r\n\r\n<p><strong>9.&nbsp;ZONEPACK / HEALING BATTLE&nbsp;NOT ALLOWED</strong></p>\r\n\r\n<p><strong>10.&nbsp;</strong><strong>HEIGHT&nbsp;NOT ALLOWED (ONLY ADVANTAGE OF HOUSE IS NOT ALLOWED)</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Important Rules :-</strong></h1>\r\n\r\n<p><strong>1. Always On Screen Recording While Playing GameAura Matches.</strong></p>\r\n\r\n<p><strong>2. Minimum Game Level Should Be 40.</strong></p>\r\n\r\n<p><strong>3. Headshot % Should Not Be More Than 70%&nbsp;In Life Time Mode.</strong></p>\r\n\r\n<p><strong>4. Refund For Players , Killed By Hackers.</strong></p>\r\n\r\n<p><strong>5. If you think any cheating is going on, Please Capture some Proof and Complain us about it, GameAura&nbsp;never tolerate cheating.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Instructions Before Joining :-</strong></h1>\r\n\r\n<p>1<strong><strong>.&nbsp;</strong>Enter Your Free Fire Max Account Name Only&nbsp;</strong><strong>N</strong><strong>o Changes Allowed.</strong></p>\r\n\r\n<p><strong>2. Don&#39;t Put Uid/Game ID &amp; Try To Use Simple Font In Game Name.</strong></p>\r\n\r\n<p><strong>3. Room ID And Password Will Be Shared In The App Before 5 Minutes Of Match Time.</strong></p>\r\n\r\n<p><strong>4. If You Failed To Attend Match In Time You Will Not Get Any Refund.</strong></p>\r\n\r\n<p><strong>5. Unregistered Players Are Not Allowed, Inviting Unregistered Players Leads To Penalty, No Reward &amp; Account Ban.</strong></p>\r\n\r\n<p><strong>6. Record Your Gameplay, You Can Be Asked To Provide POV/Recordings. Note :- Only POV Recordings No Replays Will Be Accepted.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Raise Your Query :-</strong></h1>\r\n\r\n<p><strong>Raise Issues With Customer Support Within 1 Hour.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Note :-&nbsp;</strong></h1>\r\n\r\n<h3><strong>GameAura Reserves The Right To Modify Prizes And Rules.</strong></h3>\r\n', '1', '0', '[]', '', '2025-10-19 01:12:38', '202510190112381800533058__CS1V1AURAA_(1).jpg', 0, 1),
(43, 'CLASH SQUAD 2V2', 'com.dts.freefiremax', '202510190113541859246534__CS2V2AURAA_(1).jpg', '<h1><strong>SCREEN RECORDING MANDATORY</strong></h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Ban Guns :-</strong></h1>\r\n\r\n<p><strong>&bull;&nbsp;DOUBLE VECTOR </strong></p>\r\n\r\n<h2>&nbsp;</h2>\r\n\r\n<h1><strong>&bull; Room Settings And Rules&nbsp;:-</strong></h1>\r\n\r\n<p><strong>1. ROUNDS&nbsp;- 7</strong></p>\r\n\r\n<p><strong>2. COINS - 9999</strong></p>\r\n\r\n<p><strong>3. MINIMUM LEVEL - 40</strong></p>\r\n\r\n<p><strong>4. LIMITED AMMO&nbsp;- NO</strong></p>\r\n\r\n<p><strong>5. GUN ATTRIBUTES&nbsp;- YES</strong></p>\r\n\r\n<p><strong>6. CHARACTER SKILL&nbsp;- YES</strong></p>\r\n\r\n<p><strong>7. LODOUT - YES</strong></p>\r\n\r\n<p><strong>5.&nbsp;DOUBLE VECTOR - NOT ALLOWED</strong></p>\r\n\r\n<p><strong>6.&nbsp;GRENADE OR ANY THROWABLES&nbsp;- NOT&nbsp;ALLOWED</strong></p>\r\n\r\n<p><strong>7.&nbsp;ZONEPACK / HEALING BATTLE - NOT ALLOWED</strong></p>\r\n\r\n<p><strong>8.&nbsp;</strong><strong>HEIGHT - NOT ALLOWED (ONLY ADVANTAGE OF HOUSE IS NOT ALLOWED)</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; PER DAY MATCH JOIN LIMIT :-</strong></h1>\r\n\r\n<p><strong>&bull;&nbsp;In Clash Squad 2v2 mode, you can play only 8 matches per day. If a match gets canceled or you can&rsquo;t play, it still counts&nbsp;And if you exceed the match limit, you&rsquo;ll face a permanent ban.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Prohibited Behaviour :-</strong></h1>\r\n\r\n<p><strong>1. Hack &amp; Panel Users Are Not Allowed.</strong></p>\r\n\r\n<p><strong>2. Game Modifying Tools Are Not Allowed.</strong></p>\r\n\r\n<p><strong>3. Glitches &amp; Bugs Are Not Allowed</strong></p>\r\n\r\n<p><strong>4. Teaming Up With Opponents Are Not Allowed.</strong></p>\r\n\r\n<p><strong>5. Abusing Any Of The Player/Host Will Lead To An Immediate Ban.</strong></p>\r\n\r\n<p><strong>6. If a Player Found Violating Any Of The Rules, Then Prize Will Not Be Processed, And It Leads To Immediate Ban.</strong></p>\r\n\r\n<p><strong>7.&nbsp;DOUBLE VECTOR NOT ALLOWED</strong></p>\r\n\r\n<p><strong>8.&nbsp;GRENADE OR ANY THROWABLES&nbsp;NOT&nbsp;ALLOWED</strong></p>\r\n\r\n<p><strong>9.&nbsp;ZONEPACK / HEALING BATTLE&nbsp;NOT ALLOWED</strong></p>\r\n\r\n<p><strong>10.&nbsp;</strong><strong>HEIGHT&nbsp;NOT ALLOWED (ONLY ADVANTAGE OF HOUSE IS NOT ALLOWED)</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Important Rules :-</strong></h1>\r\n\r\n<p><strong>1. Always On Screen Recording While Playing GameAura Matches.</strong></p>\r\n\r\n<p><strong>2. Minimum Game Level Should Be 40.</strong></p>\r\n\r\n<p><strong>3. Headshot % Should Not Be More Than 70%&nbsp;In Life Time Mode.</strong></p>\r\n\r\n<p><strong>4. Refund For Players , Killed By Hackers.</strong></p>\r\n\r\n<p><strong>5. If you think any cheating is going on, Please Capture some Proof and Complain us about it, GameAura&nbsp;never tolerate cheating.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Instructions Before Joining :-</strong></h1>\r\n\r\n<p>1<strong><strong>.&nbsp;</strong>Enter Your Free Fire Max Account Name Only&nbsp;</strong><strong>N</strong><strong>o Changes Allowed.</strong></p>\r\n\r\n<p><strong>2. Don&#39;t Put Uid/Game ID &amp; Try To Use Simple Font In Game Name.</strong></p>\r\n\r\n<p><strong>3. Room ID And Password Will Be Shared In The App Before 5 Minutes Of Match Time.</strong></p>\r\n\r\n<p><strong>4. If You Failed To Attend Match In Time You Will Not Get Any Refund.</strong></p>\r\n\r\n<p><strong>5. Unregistered Players Are Not Allowed, Inviting Unregistered Players Leads To Penalty, No Reward &amp; Account Ban.</strong></p>\r\n\r\n<p><strong>6. Record Your Gameplay, You Can Be Asked To Provide POV/Recordings. Note :- Only POV Recordings No Replays Will Be Accepted.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Raise Your Query :-</strong></h1>\r\n\r\n<p><strong>Raise Issues With Customer Support Within 1 Hour.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Note :-&nbsp;</strong></h1>\r\n\r\n<h3><strong>GameAura Reserves The Right To Modify Prizes And Rules.</strong></h3>\r\n', '1', '0', '[]', '', '2025-10-19 01:13:56', '202510190113551825004935__CS2V2AURAA_(1).jpg', 0, 1),
(44, 'CLASH SQUAD 4V4', 'com.dts.freefiremax', '202510190114301767517570__CS4V4AURAA_(1).jpg', '<h1><strong>SCREEN RECORDING MANDATORY</strong></h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Ban Guns :-</strong></h1>\r\n\r\n<p><strong>&bull;&nbsp;DOUBLE VECTOR </strong></p>\r\n\r\n<h2>&nbsp;</h2>\r\n\r\n<h1><strong>&bull; Room Settings And Rules&nbsp;:-</strong></h1>\r\n\r\n<p><strong>1. ROUNDS&nbsp;- 7</strong></p>\r\n\r\n<p><strong>2. COINS - 9999</strong></p>\r\n\r\n<p><strong>3. MINIMUM LEVEL - 40</strong></p>\r\n\r\n<p><strong>4. LIMITED AMMO&nbsp;- NO</strong></p>\r\n\r\n<p><strong>5. GUN ATTRIBUTES&nbsp;- YES</strong></p>\r\n\r\n<p><strong>6. CHARACTER SKILL&nbsp;- YES</strong></p>\r\n\r\n<p><strong>7. LODOUT - YES</strong></p>\r\n\r\n<p><strong>5.&nbsp;DOUBLE VECTOR - NOT ALLOWED</strong></p>\r\n\r\n<p><strong>6.&nbsp;GRENADE OR ANY THROWABLES&nbsp;- NOT&nbsp;ALLOWED</strong></p>\r\n\r\n<p><strong>7.&nbsp;ZONEPACK / HEALING BATTLE - NOT ALLOWED</strong></p>\r\n\r\n<p><strong>8.&nbsp;</strong><strong>HEIGHT - NOT ALLOWED (ONLY ADVANTAGE OF HOUSE IS NOT ALLOWED)</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; PER DAY MATCH JOIN LIMIT :-</strong></h1>\r\n\r\n<p><strong>&bull;&nbsp;In Clash Squad 4v4 mode, you can play only 8 matches per day. If a match gets canceled or you can&rsquo;t play, it still counts&nbsp;And if you exceed the match limit, you&rsquo;ll face a permanent ban.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Prohibited Behaviour :-</strong></h1>\r\n\r\n<p><strong>1. Hack &amp; Panel Users Are Not Allowed.</strong></p>\r\n\r\n<p><strong>2. Game Modifying Tools Are Not Allowed.</strong></p>\r\n\r\n<p><strong>3. Glitches &amp; Bugs Are Not Allowed</strong></p>\r\n\r\n<p><strong>4. Teaming Up With Opponents Are Not Allowed.</strong></p>\r\n\r\n<p><strong>5. Abusing Any Of The Player/Host Will Lead To An Immediate Ban.</strong></p>\r\n\r\n<p><strong>6. If a Player Found Violating Any Of The Rules, Then Prize Will Not Be Processed, And It Leads To Immediate Ban.</strong></p>\r\n\r\n<p><strong>7.&nbsp;DOUBLE VECTOR NOT ALLOWED</strong></p>\r\n\r\n<p><strong>8.&nbsp;GRENADE OR ANY THROWABLES&nbsp;NOT&nbsp;ALLOWED</strong></p>\r\n\r\n<p><strong>9.&nbsp;ZONEPACK / HEALING BATTLE&nbsp;NOT ALLOWED</strong></p>\r\n\r\n<p><strong>10.&nbsp;</strong><strong>HEIGHT&nbsp;NOT ALLOWED (ONLY ADVANTAGE OF HOUSE IS NOT ALLOWED)</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Important Rules :-</strong></h1>\r\n\r\n<p><strong>1. Always On Screen Recording While Playing GameAura Matches.</strong></p>\r\n\r\n<p><strong>2. Minimum Game Level Should Be 40.</strong></p>\r\n\r\n<p><strong>3. Headshot % Should Not Be More Than 70%&nbsp;In Life Time Mode.</strong></p>\r\n\r\n<p><strong>4. Refund For Players , Killed By Hackers.</strong></p>\r\n\r\n<p><strong>5. If you think any cheating is going on, Please Capture some Proof and Complain us about it, GameAura&nbsp;never tolerate cheating.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Instructions Before Joining :-</strong></h1>\r\n\r\n<p>1<strong><strong>.&nbsp;</strong>Enter Your Free Fire Max Account Name Only&nbsp;</strong><strong>N</strong><strong>o Changes Allowed.</strong></p>\r\n\r\n<p><strong>2. Don&#39;t Put Uid/Game ID &amp; Try To Use Simple Font In Game Name.</strong></p>\r\n\r\n<p><strong>3. Room ID And Password Will Be Shared In The App Before 5 Minutes Of Match Time.</strong></p>\r\n\r\n<p><strong>4. If You Failed To Attend Match In Time You Will Not Get Any Refund.</strong></p>\r\n\r\n<p><strong>5. Unregistered Players Are Not Allowed, Inviting Unregistered Players Leads To Penalty, No Reward &amp; Account Ban.</strong></p>\r\n\r\n<p><strong>6. Record Your Gameplay, You Can Be Asked To Provide POV/Recordings. Note :- Only POV Recordings No Replays Will Be Accepted.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Raise Your Query :-</strong></h1>\r\n\r\n<p><strong>Raise Issues With Customer Support Within 1 Hour.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Note :-&nbsp;</strong></h1>\r\n\r\n<h3><strong>GameAura Reserves The Right To Modify Prizes And Rules.</strong></h3>\r\n', '1', '0', '[]', '', '2025-10-19 01:14:31', '202510190114301833127170__CS4V4AURAA_(1).jpg', 0, 1),
(45, 'NIGHT MODE', 'com.dts.freefiremax', '202511100411231826497183__NIGHTAURRAA_(1).jpg', '<h1><strong>SCREEN RECORDING MANDATORY</strong></h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; NOTE :- ROOM SETTINGS AND RULES ONLY FOR CLASH SQUAD.</strong></h1>\r\n\r\n<p><strong>1. ROUNDS&nbsp;- 7</strong></p>\r\n\r\n<p><strong>2. COINS - 9999</strong></p>\r\n\r\n<p><strong>3. MINIMUM LEVEL - 40</strong></p>\r\n\r\n<p><strong>4. LIMITED AMMO&nbsp;- NO</strong></p>\r\n\r\n<p><strong>5. GUN ATTRIBUTES&nbsp;- YES</strong></p>\r\n\r\n<p><strong>6. CHARACTER SKILL&nbsp;- YES</strong></p>\r\n\r\n<p><strong>7. LODOUT - YES</strong></p>\r\n\r\n<p><strong>5.&nbsp;DOUBLE VECTOR - NOT ALLOWED</strong></p>\r\n\r\n<p><strong>6.&nbsp;GRENADE OR ANY THROWABLES&nbsp;- NOT&nbsp;ALLOWED</strong></p>\r\n\r\n<p><strong>7.&nbsp;ZONEPACK / HEALING BATTLE - NOT ALLOWED</strong></p>\r\n\r\n<p><strong>8.&nbsp;</strong><strong>HEIGHT - NOT ALLOWED (ONLY ADVANTAGE OF HOUSE IS NOT ALLOWED)</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; NOTE :- ROOM SETTINGS AND RULES ONLY FOR LONE WOLF.</strong></h1>\r\n\r\n<p><strong>1. LIMITED AMMO&nbsp;- YES</strong></p>\r\n\r\n<p><strong>2. GUN ATTRIBUTES&nbsp;- YES</strong></p>\r\n\r\n<p><strong>3. CHARACTER SKILL&nbsp;- YES</strong></p>\r\n\r\n<p><strong>4. LODOUT - YES</strong></p>\r\n\r\n<p><strong>5. RYDEN CHARACTER - NOT ALLOWED</strong></p>\r\n\r\n<p><strong>6.&nbsp;ALL GUNS - ALLOW</strong></p>\r\n\r\n<p><strong>7.&nbsp;FLASH FREEZE - ALLOW</strong></p>\r\n\r\n<p><strong>8.&nbsp;ZONEPACK - ALLOW</strong></p>\r\n\r\n<p><strong>9.&nbsp;</strong><strong>HEIGHT -&nbsp;ALLOW</strong></p>\r\n\r\n<p><strong>10.&nbsp;MINIMUM LEVEL - 40</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; PER DAY MATCH JOIN LIMIT :-</strong></h1>\r\n\r\n<p><strong>&bull;&nbsp;In High Entry mode, you can play only 8 matches per day. If a match gets canceled or you can&rsquo;t play, it still counts&nbsp;And if you exceed the match limit, you&rsquo;ll face a permanent ban.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Prohibited Behaviour :-</strong></h1>\r\n\r\n<p><strong>1. Hack &amp; Panel Users Are Not Allowed.</strong></p>\r\n\r\n<p><strong>2. Game Modifying Tools Are Not Allowed.</strong></p>\r\n\r\n<p><strong>3. Glitches &amp; Bugs Are Not Allowed</strong></p>\r\n\r\n<p><strong>4. Teaming Up With Opponents Are Not Allowed.</strong></p>\r\n\r\n<p><strong>5. Abusing Any Of The Player/Host Will Lead To An Immediate Ban.</strong></p>\r\n\r\n<p><strong>6. If a Player Found Violating Any Of The Rules, Then Prize Will Not Be Processed, And It Leads To Immediate Ban.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Important Rules :-</strong></h1>\r\n\r\n<p><strong>1. Always On Screen Recording While Playing GameAura Matches.</strong></p>\r\n\r\n<p><strong>2. Minimum Game Level Should Be 40.</strong></p>\r\n\r\n<p><strong>3. Headshot % Should Not Be More Than 70%&nbsp;In Life Time Mode.</strong></p>\r\n\r\n<p><strong>4. Refund For Players , Killed By Hackers.</strong></p>\r\n\r\n<p><strong>5. If you think any cheating is going on, Please Capture some Proof and Complain us about it, GameAura&nbsp;never tolerate cheating.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Instructions Before Joining :-</strong></h1>\r\n\r\n<p>1<strong><strong>.&nbsp;</strong>Enter Your Free Fire Max Account Name Only&nbsp;</strong><strong>N</strong><strong>o Changes Allowed.</strong></p>\r\n\r\n<p><strong>2. Don&#39;t Put Uid/Game ID &amp; Try To Use Simple Font In Game Name.</strong></p>\r\n\r\n<p><strong>3. Room ID And Password Will Be Shared In The App Before 5 Minutes Of Match Time.</strong></p>\r\n\r\n<p><strong>4. If You Failed To Attend Match In Time You Will Not Get Any Refund.</strong></p>\r\n\r\n<p><strong>5. Unregistered Players Are Not Allowed, Inviting Unregistered Players Leads To Penalty, No Reward &amp; Account Ban.</strong></p>\r\n\r\n<p><strong>6. Record Your Gameplay, You Can Be Asked To Provide POV/Recordings. Note :- Only POV Recordings No Replays Will Be Accepted.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Raise Your Query :-</strong></h1>\r\n\r\n<p><strong>Raise Issues With Customer Support Within 1 Hour.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Note :-&nbsp;</strong></h1>\r\n\r\n<h3><strong>GameAura Reserves The Right To Modify Prizes And Rules.</strong></h3>\r\n', '1', '0', '[]', '', '2025-10-19 01:15:15', '202511100411241853672384__NIGHTAURRAA_(1).jpg', 0, 1),
(46, 'LOW ENTRY', 'com.dts.freefiremax', '202510190116051829207465__LOWENTRYAURA_(1).jpg', '<h1><strong>SCREEN RECORDING MANDATORY</strong></h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; NOTE :- ROOM SETTINGS AND RULES ONLY FOR CLASH SQUAD.</strong></h1>\r\n\r\n<p><strong>1. ROUNDS&nbsp;- 7</strong></p>\r\n\r\n<p><strong>2. COINS - 9999</strong></p>\r\n\r\n<p><strong>3. MINIMUM LEVEL - 40</strong></p>\r\n\r\n<p><strong>4. LIMITED AMMO&nbsp;- NO</strong></p>\r\n\r\n<p><strong>5. GUN ATTRIBUTES&nbsp;- YES</strong></p>\r\n\r\n<p><strong>6. CHARACTER SKILL&nbsp;- YES</strong></p>\r\n\r\n<p><strong>7. LODOUT - YES</strong></p>\r\n\r\n<p><strong>5.&nbsp;DOUBLE VECTOR - NOT ALLOWED</strong></p>\r\n\r\n<p><strong>6.&nbsp;GRENADE OR ANY THROWABLES&nbsp;- NOT&nbsp;ALLOWED</strong></p>\r\n\r\n<p><strong>7.&nbsp;ZONEPACK / HEALING BATTLE - NOT ALLOWED</strong></p>\r\n\r\n<p><strong>8.&nbsp;</strong><strong>HEIGHT - NOT ALLOWED (ONLY ADVANTAGE OF HOUSE IS NOT ALLOWED)</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; NOTE :- ROOM SETTINGS AND RULES ONLY FOR LONE WOLF.</strong></h1>\r\n\r\n<p><strong>1. LIMITED AMMO&nbsp;- YES</strong></p>\r\n\r\n<p><strong>2. GUN ATTRIBUTES&nbsp;- YES</strong></p>\r\n\r\n<p><strong>3. CHARACTER SKILL&nbsp;- YES</strong></p>\r\n\r\n<p><strong>4. LODOUT - YES</strong></p>\r\n\r\n<p><strong>5. RYDEN CHARACTER - NOT ALLOWED</strong></p>\r\n\r\n<p><strong>6.&nbsp;ALL GUNS - ALLOW</strong></p>\r\n\r\n<p><strong>7.&nbsp;FLASH FREEZE - ALLOW</strong></p>\r\n\r\n<p><strong>8.&nbsp;ZONEPACK - ALLOW</strong></p>\r\n\r\n<p><strong>9.&nbsp;</strong><strong>HEIGHT -&nbsp;ALLOW</strong></p>\r\n\r\n<p><strong>10.&nbsp;MINIMUM LEVEL - 40</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; PER DAY MATCH JOIN LIMIT :-</strong></h1>\r\n\r\n<p><strong>&bull;&nbsp;In Night Mode, you can play only 8 matches per day. If a match gets canceled or you can&rsquo;t play, it still counts&nbsp;And if you exceed the match limit, you&rsquo;ll face a permanent ban.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Prohibited Behaviour :-</strong></h1>\r\n\r\n<p><strong>1. Hack &amp; Panel Users Are Not Allowed.</strong></p>\r\n\r\n<p><strong>2. Game Modifying Tools Are Not Allowed.</strong></p>\r\n\r\n<p><strong>3. Glitches &amp; Bugs Are Not Allowed</strong></p>\r\n\r\n<p><strong>4. Teaming Up With Opponents Are Not Allowed.</strong></p>\r\n\r\n<p><strong>5. Abusing Any Of The Player/Host Will Lead To An Immediate Ban.</strong></p>\r\n\r\n<p><strong>6. If a Player Found Violating Any Of The Rules, Then Prize Will Not Be Processed, And It Leads To Immediate Ban.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Important Rules :-</strong></h1>\r\n\r\n<p><strong>1. Always On Screen Recording While Playing GameAura Matches.</strong></p>\r\n\r\n<p><strong>2. Minimum Game Level Should Be 40.</strong></p>\r\n\r\n<p><strong>3. Headshot % Should Not Be More Than 70%&nbsp;In Life Time Mode.</strong></p>\r\n\r\n<p><strong>4. Refund For Players , Killed By Hackers.</strong></p>\r\n\r\n<p><strong>5. If you think any cheating is going on, Please Capture some Proof and Complain us about it, GameAura&nbsp;never tolerate cheating.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Instructions Before Joining :-</strong></h1>\r\n\r\n<p>1<strong><strong>.&nbsp;</strong>Enter Your Free Fire Max Account Name Only&nbsp;</strong><strong>N</strong><strong>o Changes Allowed.</strong></p>\r\n\r\n<p><strong>2. Don&#39;t Put Uid/Game ID &amp; Try To Use Simple Font In Game Name.</strong></p>\r\n\r\n<p><strong>3. Room ID And Password Will Be Shared In The App Before 5 Minutes Of Match Time.</strong></p>\r\n\r\n<p><strong>4. If You Failed To Attend Match In Time You Will Not Get Any Refund.</strong></p>\r\n\r\n<p><strong>5. Unregistered Players Are Not Allowed, Inviting Unregistered Players Leads To Penalty, No Reward &amp; Account Ban.</strong></p>\r\n\r\n<p><strong>6. Record Your Gameplay, You Can Be Asked To Provide POV/Recordings. Note :- Only POV Recordings No Replays Will Be Accepted.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Raise Your Query :-</strong></h1>\r\n\r\n<p><strong>Raise Issues With Customer Support Within 1 Hour.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Note :-&nbsp;</strong></h1>\r\n\r\n<h3><strong>GameAura Reserves The Right To Modify Prizes And Rules.</strong></h3>\r\n', '1', '0', '[]', '', '2025-10-19 01:16:06', '202510190116061774101066__LOWENTRYAURA_(1).jpg', 0, 1),
(47, 'FREE MATCHES', 'com.dts.freefiremax', '202510190117051792451825__FREEAURAA_(1).jpg', '<h1><strong>SCREEN RECORDING MANDATORY</strong></h1>\r\n\r\n<h1>&nbsp;</h1>\r\n\r\n<h1><strong>&bull; Room Settings&nbsp;:-</strong></h1>\r\n\r\n<p><strong>1. CHARACTER SKILL :- YES</strong></p>\r\n\r\n<p><strong>2. GUN ATTRIBUTES :- OFF</strong></p>\r\n\r\n<p><strong>3. MINIMUM LEVEL :- 40</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Instructions Before Joining :-</strong></h1>\r\n\r\n<p>1<strong><strong>.&nbsp;</strong>Enter Your Free Fire Max Account Name Only&nbsp;</strong><strong>N</strong><strong>o Changes Allowed.</strong></p>\r\n\r\n<p><strong>2. Don&#39;t Put Uid/Game ID &amp; Try To Use Simple Font In Game Name.</strong></p>\r\n\r\n<p><strong>3. Room ID And Password Will Be Shared In The App Before 5 Minutes Of Match Time.</strong></p>\r\n\r\n<p><strong>4. If You Failed To Attend Match In Time You Will Not Get Any Refund.</strong></p>\r\n\r\n<p><strong>5. Unregistered Players Are Not Allowed, Inviting Unregistered Players Leads To Penalty, No Reward &amp; Account Ban.</strong></p>\r\n\r\n<p><strong>6. Record Your Gameplay, You Can Be Asked To Provide POV/Recordings. Note :- Only POV Recordings No Replays Will Be Accepted.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Eligibility Rules :-</strong></h1>\r\n\r\n<p><strong>1. Minimum 40 Level Players Are Allowed To Participate In GameAura matches.</strong></p>\r\n\r\n<p><strong>2. Headshot Rate Must Be Below 70% in BR Career</strong></p>\r\n\r\n<p><strong>3. Emulators/Pc Players Are Not Allowed.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Prohibited Behaviour :-</strong></h1>\r\n\r\n<p><strong>1. Hack &amp; Panel Users Are Not Allowed.</strong></p>\r\n\r\n<p><strong>2. Game Modifying Tools Are Not Allowed.</strong></p>\r\n\r\n<p><strong>3. Glitches &amp; Bugs Are Not Allowed</strong></p>\r\n\r\n<p><strong>4. Teaming Up With Opponents Are Not Allowed.</strong></p>\r\n\r\n<p><strong>5. Abusing Any Of The Player/Host Will Lead To An Immediate Ban.</strong></p>\r\n\r\n<p><strong>6. If a Player Found Violating Any Of The Rules, Then Prize Will Not Be Processed, And It Leads To Immediate Ban.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Some Important Tips :-</strong></h1>\r\n\r\n<p><strong>1. If Player Game-ID Is Blacklisted, Then Prizes Will Not Proceed Without Pov/Real Screen Recording.</strong></p>\r\n\r\n<p><strong>2. If Slots Are Not Full, Then The Winning Prize Get Changed As Per The Structure.</strong></p>\r\n\r\n<p><strong>3. If The Room Is Full Then The Player Should Have Screen Recording Of The Room Being Full For Refund.</strong></p>\r\n\r\n<p><strong>4. If You Are Killed By Any Hacker/Team-up Player, Record Evidence For Refund.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Raise Your Query :-</strong></h1>\r\n\r\n<p><strong>Raise Issues With Customer Support Within 1 Hour.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><strong>&bull; Note :-&nbsp;</strong></h1>\r\n\r\n<h3><strong>GameAura Reserves The Right To Modify Prizes And Rules.</strong></h3>\r\n', '1', '0', '[]', '', '2025-10-19 01:17:06', '202510190117051838361025__FREEAURAA_(1).jpg', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `home_game`
--

CREATE TABLE `home_game` (
  `game_id` int(11) NOT NULL,
  `game_name` varchar(255) DEFAULT NULL,
  `game_image` mediumtext NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_game`
--

INSERT INTO `home_game` (`game_id`, `game_name`, `game_image`, `status`) VALUES
(1, 'FreeFire', '202601142258141778256094__unnamedff.png', '1'),
(2, 'BGMI', '202412251842241811844244__unnamed.png', '1');

-- --------------------------------------------------------

--
-- Table structure for table `howtoplay_content`
--

CREATE TABLE `howtoplay_content` (
  `htp_content_id` int(11) NOT NULL,
  `htp_content_title` varchar(100) NOT NULL,
  `htp_content_text` text NOT NULL,
  `htp_content_image` text NOT NULL,
  `htp_order` int(11) NOT NULL,
  `htp_content_status` enum('0','1') NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `howtoplay_content`
--

INSERT INTO `howtoplay_content` (`htp_content_id`, `htp_content_title`, `htp_content_text`, `htp_content_image`, `htp_order`, `htp_content_status`, `date_created`) VALUES
(1, 'Money Prizes', '<p>Once you win your first tournament, you can request your earnings to be withdraw&nbsp;from your GameAura&nbsp;account.<br />\r\nIt?s also possible to keep playing to get bigger prizes.</p>\r\n\r\n<p>The following payments systems are supported on our App:</p>\r\n\r\n<ul>\r\n	<li>Google Play Gift Card</li>\r\n	<li>Amazon Gift Card</li>\r\n	<li>Upi</li>\r\n	<li>Paytm</li>\r\n	<li>Gpay</li>\r\n</ul>\r\n\r\n<p>Happy earning!</p>\r\n', '202510190332471818404567__444444-removebg-preview.png', 1, '1', '2025-10-19 03:32:47');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `image_id` int(11) NOT NULL,
  `image_title` varchar(200) NOT NULL,
  `image_name` mediumtext NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`image_id`, `image_title`, `image_name`, `created_date`) VALUES
(27, 'SOLO FULL MAP ', '202510190054381791178178__SOLOFMAPAURA_(1).jpg', '2025-10-19 00:54:38'),
(28, 'DUO FULL MAP', '202510190054571775200197__DUOFMAPAURA_(2).jpg', '2025-10-19 00:54:57'),
(29, 'SQUAD FULL MAP', '202510190055121836593812__SQUADFMAPAURA_(1).jpg', '2025-10-19 00:55:13'),
(30, 'SURVIVAL', '202510190057041803947624__aurasurv_(2).jpg', '2025-10-19 00:55:49'),
(31, 'LW 1V1', '202510190057301855408150__LW1V1AURA_(1).jpg', '2025-10-19 00:57:31'),
(32, 'CS 1V1', '202510190057521761858972__CS1V1AURA_(1).jpg', '2025-10-19 00:57:52'),
(33, 'LW 2V2', '202510190058111826922791__LW2V2AURA_(1).jpg', '2025-10-19 00:58:11'),
(34, 'CS 2V2', '202510190058321806352512__CS2V2AURA_(1).jpg', '2025-10-19 00:58:32'),
(35, 'CS 4V4', '202510190058511846557031__CS4V4AURA_(1).jpg', '2025-10-19 00:58:52'),
(36, 'LW LOSS', '202510190059161848833956__LWLOSSAURA_(1).jpg', '2025-10-19 00:59:17'),
(37, 'FREE', '202510190059321812580472__FREEAURA.jpg', '2025-10-19 00:59:32');

-- --------------------------------------------------------

--
-- Table structure for table `lottery`
--

CREATE TABLE `lottery` (
  `lottery_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `lottery_title` varchar(200) NOT NULL,
  `lottery_image` text NOT NULL,
  `lottery_time` datetime NOT NULL,
  `lottery_rules` text NOT NULL,
  `lottery_fees` double NOT NULL,
  `lottery_prize` double NOT NULL,
  `lottery_size` double NOT NULL,
  `total_joined` int(11) NOT NULL,
  `lottery_status` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '0=deactive,1=ongoing,2 = result',
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lottery_member`
--

CREATE TABLE `lottery_member` (
  `lottery_member_id` int(11) NOT NULL,
  `lottery_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `lottery_prize` double NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '1=winner',
  `entry_from` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0=unknown,1=app,2=web',
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ludo_challenge`
--

CREATE TABLE `ludo_challenge` (
  `ludo_challenge_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `auto_id` varchar(15) NOT NULL,
  `member_id` int(11) NOT NULL,
  `accepted_member_id` int(11) NOT NULL,
  `ludo_king_username` varchar(100) NOT NULL,
  `accepted_ludo_king_username` varchar(100) NOT NULL,
  `coin` int(11) NOT NULL,
  `winning_price` float NOT NULL,
  `room_code` varchar(50) NOT NULL,
  `accept_status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0= not accept,1=accepted',
  `notification_status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=not send,1=send',
  `challenge_status` enum('1','2','3','4') NOT NULL DEFAULT '1' COMMENT '1=active,2=canceled,3=completed,4=pending',
  `with_password` enum('0','1') NOT NULL DEFAULT '0',
  `challenge_password` text DEFAULT NULL,
  `canceled_by` int(11) NOT NULL,
  `winner_id` int(11) NOT NULL,
  `accepted_date` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `m_id` int(11) NOT NULL,
  `match_name` varchar(50) NOT NULL,
  `match_url` varchar(255) NOT NULL,
  `match_time` varchar(100) NOT NULL,
  `win_prize` double NOT NULL,
  `prize_description` text NOT NULL,
  `room_description` text DEFAULT NULL,
  `per_kill` double NOT NULL,
  `entry_fee` double NOT NULL,
  `type` varchar(50) NOT NULL,
  `MAP` varchar(50) NOT NULL,
  `game_id` int(11) NOT NULL,
  `match_type` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=unpaid,1=paid',
  `result_type` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=Percentage,1=Fixed',
  `match_desc` text NOT NULL,
  `match_private_desc` text NOT NULL,
  `no_of_player` int(11) NOT NULL,
  `match_status` enum('0','1','2','3','4') DEFAULT '1' COMMENT '0=deactive,1=active,2 =complete,3 = start,4=cancel',
  `date_created` datetime NOT NULL,
  `number_of_position` int(11) NOT NULL,
  `result_notification` text NOT NULL,
  `match_banner` varchar(200) NOT NULL,
  `match_sponsor` text NOT NULL,
  `pin_match` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=no,1=yes',
  `image_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `match_join_member`
--

CREATE TABLE `match_join_member` (
  `match_join_member_id` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `pubg_id` varchar(50) NOT NULL,
  `team` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `place` double NOT NULL,
  `place_point` double NOT NULL,
  `killed` int(11) NOT NULL,
  `win` double NOT NULL,
  `win_prize` double NOT NULL,
  `bonus` double NOT NULL,
  `total_win` double NOT NULL,
  `refund` double NOT NULL,
  `entry_from` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0=unknown,1=app,2=web',
  `date_craeted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `pubg_id` text DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `gender` enum('0','1','') NOT NULL DEFAULT '' COMMENT '0=male,1=female',
  `dob` varchar(50) DEFAULT NULL,
  `mobile_no` varchar(50) NOT NULL,
  `referral_id` int(11) NOT NULL,
  `join_money` double DEFAULT 0,
  `wallet_balance` double DEFAULT 0,
  `member_status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=deactive,1=active',
  `member_package_upgraded` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=no,1=yes',
  `player_id` text DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `api_token` mediumtext NOT NULL,
  `country_id` int(11) NOT NULL,
  `country_code` varchar(20) NOT NULL,
  `fb_id` mediumtext NOT NULL,
  `login_via` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0=simple,1= fb,2 = google',
  `new_user` enum('Yes','No') NOT NULL DEFAULT 'No',
  `profile_image` mediumtext NOT NULL,
  `budy_list` longtext NOT NULL,
  `push_noti` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=off,1=on',
  `entry_from` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '	0=unknown,1=app,2=web',
  `ludo_username` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `pubg_id`, `first_name`, `last_name`, `user_name`, `password`, `email_id`, `gender`, `dob`, `mobile_no`, `referral_id`, `join_money`, `wallet_balance`, `member_status`, `member_package_upgraded`, `player_id`, `created_date`, `api_token`, `country_id`, `country_code`, `fb_id`, `login_via`, `new_user`, `profile_image`, `budy_list`, `push_noti`, `entry_from`, `ludo_username`) VALUES
(1, NULL, 'Aaryan', 'Singh', 'aaryansingh', '115fe6062629aa1a2ceb190e7a9d26c8', 'aaryansingh1356@gmail.com', '', NULL, '9598321356', 0, 0, 0, '1', '0', '', '2026-01-14 22:43:02', '6967ce9ec29f6QlBVWU1LYWE4Y0N1emNFOExCRmlLSzZheWhXQTNIWW9zZHVlSW55Mg==', 0, '+91', '', '0', 'No', '', '', '1', '1', ''),
(2, NULL, 'jdjd', 'ndxjdj', 'xjjxx', '7f4780a0b17094231083a9bf3c82915c', 'nxnxndn@gmial.com', '', NULL, '94649598', 0, 0, 0, '1', '0', '', '2026-01-14 23:25:38', '6967d89acae80S29UNjg5RW1oeEQ0a09CSkRLZGR6OG9SWFE0TmlLOU5TNEo5NU5WNw==', 0, '+91', '', '0', 'No', '', '', '1', '1', ''),
(3, NULL, 'Sonu', 'nagar', 'sonunagar', '90d26c18b7808d78723784f55f36650c', 'sonunagar5384@gmail.com', '', NULL, '8708085423', 0, 0, 0, '1', '0', 'ejfD4p-lS-Cdpg2iGzKtK7:APA91bG2I5h59_aViOKCQD5pHicUhD8DEqukXjThPywvyRzyMjlzvD6ClDvdgumJmJT0ZhxlYK1iCyEZUo_mFOejvq9WIwboaT8aEk6ISXcnjN7NSFigDDY', '2026-01-15 20:49:16', '69690574dad9dRFYyOVY1OUl6MFBnOE9sbXhoSzFlblhJYW1zblA1MkI3ZDFtOHJNdA==', 0, '+91', '', '0', 'No', '', '', '1', '1', ''),
(4, NULL, 'sonu', 'singh', 'sonu__918', '73558e744d44e6973fea48d7bd845f28', '37323x@gmail.com', '', NULL, '34645121316', 0, 0, 0, '1', '0', 'eKioXf2HThuPAQ51890vlz:APA91bHFTQb6ucXZMCftVhbmWmXOA3Edlqro5NseAxwXeqhdWVKp9XA1tLA4cjVCIqxSBT05uFRr8t2iunpAMCMSgtUm1md_EseZX2UmN3PXj4SpG56niOw', '2026-01-15 20:56:18', '6969071a3acecNlRHOVY1SlUxR09GdjJERnlTY3JFUjN1SnppeUtSbGNwcnhXNnJLMQ==', 0, '+91', '', '0', 'No', '', '', '1', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notifications_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `id` mediumtext NOT NULL,
  `heading` varchar(500) NOT NULL,
  `content` longtext NOT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `no` int(11) NOT NULL,
  `order_no` varchar(200) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(200) NOT NULL,
  `product_price` double NOT NULL,
  `shipping_address` text NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `courier_id` int(11) NOT NULL,
  `tracking_id` varchar(255) NOT NULL,
  `entry_from` enum('0','1','2') NOT NULL COMMENT '0=unknown,1=app,2=web',
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `page_id` int(11) NOT NULL,
  `page_title` varchar(100) NOT NULL,
  `page_slug` varchar(100) NOT NULL,
  `page_content` text NOT NULL,
  `page_banner_image` text NOT NULL,
  `page_browsertitle` varchar(100) NOT NULL,
  `page_menutitle` varchar(100) NOT NULL,
  `page_metatitle` varchar(100) NOT NULL,
  `page_metakeyword` varchar(100) NOT NULL,
  `page_metadesc` text NOT NULL,
  `page_publish` enum('0','1') NOT NULL,
  `add_to_menu` enum('0','1') NOT NULL,
  `add_to_footer` enum('0','1') NOT NULL,
  `page_order` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`page_id`, `page_title`, `page_slug`, `page_content`, `page_banner_image`, `page_browsertitle`, `page_menutitle`, `page_metatitle`, `page_metakeyword`, `page_metadesc`, `page_publish`, `add_to_menu`, `add_to_footer`, `page_order`, `parent`, `created_date`) VALUES
(6, 'Contact Us', 'contact', '', '202205301813021748779982__main_bg.jpg', 'Contact Us', 'Contact', 'Contact Us', 'Contact Us', 'Contact Us', '1', '1', '0', 4, 0, '2020-01-06'),
(7, 'How To Install', 'how_to_install', '<h1><strong>How To Download WinHub App</strong></h1>\r\n', '202412240455311797427631__Picsart_24-12-19_17-09-08-435.png', 'How To Install', 'How To Install', 'How To Install', 'How To Install', 'How To Install', '0', '1', '0', 3, 0, '2020-01-06'),
(8, 'Home', 'home', '', '', 'Home', 'Home', 'Home', 'Home', 'Home', '1', '1', '1', 1, 0, '2020-01-09'),
(9, 'About Us', 'about-us', '<p>GameAura is the ultimate Esports tournament platform, connecting gamers, teams, and organizers worldwide. Our mission is to create a seamless, engaging, and rewarding experience for the Esports community.</p>\r\n\r\n<p>Our Story :- Founded by a team of passionate gamers and tech enthusiasts, GameAura aims to bridge the gap between Esports enthusiasts and competitive gaming. We believe that Esports has the power to unite people, foster friendships, and create unforgettable experiences.</p>\r\n\r\n<p>Our Vision :- At GameAura we envision a future where Esports is accessible, inclusive, and thrilling for everyone. We&#39;re committed to :-</p>\r\n\r\n<p>&bull; Providing a user-friendly platform for gamers to compete, connect, and grow</p>\r\n\r\n<p>&bull; Fostering a community that values sportsmanship, teamwork, and mutual respect</p>\r\n\r\n<p>&bull; Partnering with game developers, teams, and organizers to bring exciting tournaments and events to our users</p>\r\n\r\n<p>&bull; Continuously innovating and improving our platform to meet the evolving needs of the Esports community</p>\r\n', '202412240506571790765117__Picsart_24-12-24_05-01-56-283.jpg', '', 'About Us', '', 'GameAura', 'GameAura', '1', '1', '0', 3, 0, '2020-01-18'),
(10, 'Privacy Policy', 'privacy-policy', '<p>GameAura is an Ultimate Solution to all your eSports Games.</p>\r\n', '202412240505191795462519__Picsart_24-12-24_05-01-56-283.jpg', '', 'Privacy Policy', '', 'GameAura', 'GameAura', '1', '1', '0', 4, 9, '2020-01-18'),
(11, 'Terms & Conditions', 'terms_conditions', '<p>GameAura Terms and Conditions</p>\r\n\r\n<p>1. Match Cancellation: We&#39;ll refund your match fee if we cancel a match due to internal reasons.</p>\r\n\r\n<p>2. Entry Policy: No cancellations or refunds once you&#39;ve joined a paid match.</p>\r\n\r\n<p>3. Match Start Time: Enter the match on time to avoid disqualification from refunds.</p>\r\n\r\n<p>4. Fair Play: Cheating will result in cancellation of winning prizes for that match.</p>\r\n\r\n<p>5. Multiple Accounts Policy: Using multiple accounts is prohibited. Violators will face a permanent ban and no withdrawals.</p>\r\n\r\n<p>6. Don&#39;t Create Your Account With Fake Number Or Fake Details. if We Found Anyone With Fake Number Or Fake Details Then No Winnings Or Withdraw Request Will Be Proseed.</p>\r\n\r\n<p>7. Room ID And Password Will Be Shared In The App Before 10-5 Minutes Of Match Time.</p>\r\n\r\n<p>8. If You Failed To Attend Match In Time You Will Not Get Any Refund.</p>\r\n\r\n<p>9. Recording Your Game While Playing GameZoop Tournaments And Keep It For Minimum 3 Hrs.</p>\r\n\r\n<p>10. Keep Your POV Screen Recording Until You Receive The Winning Amount.</p>\r\n\r\n<ul>\r\n</ul>\r\n', '202412240508101769471590__Picsart_24-12-24_05-01-56-283.jpg', '', 'Terms & Conditions', '', 'GameAura', 'GameAura', '1', '1', '0', 5, 9, '2020-01-18');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `permission_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code_name` varchar(100) NOT NULL,
  `parent_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`permission_id`, `name`, `code_name`, `parent_status`) VALUES
(1, 'Member', 'members', 'parent'),
(2, 'View', 'members_view', '1'),
(3, 'Delete', 'members_delete', '1'),
(4, 'Register Referral', 'register_referral', 'parent'),
(5, 'Join Referral', 'referral', 'parent'),
(6, 'Game', 'game', 'parent'),
(7, 'Edit', 'game_edit', '6'),
(8, 'Delete', 'game_delete', '6'),
(9, 'Matches', 'matches', 'parent'),
(10, 'Edit', 'matches_edit', '9'),
(11, 'Delete', 'matches_delete', '9'),
(12, 'Image', 'image', 'parent'),
(13, 'Edit', 'image_edit', '12'),
(14, 'Delete', 'image_delete', '12'),
(15, 'Product', 'product', 'parent'),
(16, 'Edit', 'product_edit', '15'),
(17, 'Delete', 'product_delete', '15'),
(18, 'Order', 'order', 'parent'),
(19, 'View', 'order_view', '18'),
(20, 'Courier', 'courier', 'parent'),
(21, 'Edit', 'courier_edit', '20'),
(22, 'Delete', 'courier_delete', '20'),
(23, 'Country', 'country', 'parent'),
(24, 'Edit', 'country_edit', '23'),
(25, 'Delete', 'country_delete', '23'),
(26, 'Money Order', 'pgorder', 'parent'),
(27, 'Withdrawal Request', 'withdraw', 'parent'),
(28, 'Top Player', 'topplayers', 'parent'),
(29, 'LeaderBoard', 'leaderboard', 'parent'),
(30, 'Announcement', 'announcement', '30'),
(31, 'Edit', 'announcement_edit', '30'),
(32, 'Delete', 'announcement_delete', '30'),
(33, 'Lottery', 'lottery', 'parent'),
(34, 'Edit', 'lottery_edit', '33'),
(35, 'Delete', 'lottery_delete', '33'),
(36, 'View', 'lottery_view', '33'),
(37, 'Page', 'page', 'parent'),
(38, 'Edit', 'page_edit', '37'),
(39, 'Delete', 'page_delete', '37'),
(40, 'Main Banner', 'homeheader', 'parent'),
(41, 'Screenshots', 'screenshots', 'parent'),
(42, 'Edit', 'screenshots_delete', '41'),
(43, 'Delete', 'screenshots_delete', '41'),
(44, 'Features', 'features', 'parent'),
(45, 'Edit', 'features_edit', '44'),
(46, 'Delete', 'features_delete', '44'),
(47, 'Tab Content', 'tab_content', 'parent'),
(48, 'Edit', 'tab_content_edit', '47'),
(49, 'Delete', 'tab_content_delete', '47'),
(50, 'How to Play', 'how_to_play', 'parent'),
(51, 'Edit', 'how_to_play_edit', '50'),
(52, 'Delete', 'how_to_play_delete', '50'),
(53, 'How to Install', 'download', 'parent'),
(54, 'Edit', 'download_edit', '53'),
(55, 'Delete', 'download_delete', '53'),
(56, 'AppSetting', 'appsetting', 'parent'),
(57, 'Currency', 'currency', 'parent'),
(58, 'Edit', 'currency_edit', '57'),
(59, 'Delete', 'currency_delete', '57'),
(60, 'Withdrawal Method', 'withdraw_method', 'parent'),
(61, 'Edit', 'withdraw_method_edit', '60'),
(62, 'Delete', 'withdraw_method_delete', '60'),
(63, 'PaymentGateway', 'pgdetail', 'parent'),
(64, 'Edit', 'pgdetail_edit', '63'),
(65, 'Delete', 'pgdetail_delete', '63'),
(66, 'App Tutorial', 'youtube', 'parent'),
(67, 'Edit', 'youtube_edit', '66'),
(68, 'Delete', 'youtube_delete', '66'),
(69, 'Slider', 'slider', 'parent'),
(70, 'Edit', 'slider_edit', '69'),
(71, 'Delete', 'slider_delete', '69'),
(72, 'Banner', 'banner', 'parent'),
(73, 'Edit', 'banner_edit', '72'),
(74, 'Delete', 'banner_delete', '72'),
(75, 'License', 'license', 'parent'),
(76, 'Push Notification', 'custom_notification', 'parent'),
(77, 'Admin', 'admin', 'parent'),
(78, 'Edit', 'admin_edit', '77'),
(79, 'Delete', 'admin_delete', '77'),
(80, 'Profile Setting', 'profilesetting', 'parent'),
(81, 'Change Password', 'changepassword', 'parent'),
(82, 'Join Match', 'matches_member_position', '9'),
(83, 'Update Result', 'matches_member_join_match', '9'),
(85, 'Challenge', 'ludo_challenge', 'parent'),
(86, 'View', 'ludo_challenge_view', '85'),
(87, 'Delete', 'ludo_challenge_delete', '85'),
(88, 'Only Room Details', 'only_room_details', '9'),
(89, 'Add Match ', 'add_match', '9'),
(90, 'Cancel Match', 'cancel_match', '9'),
(91, 'Deactivate Match', 'deactivate_match', '9'),
(92, 'Dashboard', 'dashboard', 'parent'),
(93, 'Show All Stats', 'show_all_stats', '92'),
(94, 'Telegram Support', 'telegram_support', '0'),
(95, 'Telegram Support Edit', 'telegram_support_edit', '0'),
(96, 'Telegram Support Delete', 'telegram_support_delete', '0');

-- --------------------------------------------------------

--
-- Table structure for table `pg_detail`
--

CREATE TABLE `pg_detail` (
  `id` int(11) NOT NULL,
  `payment_name` varchar(50) DEFAULT NULL,
  `payment_description` text DEFAULT NULL,
  `payment_status` varchar(50) DEFAULT NULL,
  `name` mediumtext DEFAULT NULL,
  `mid` mediumtext DEFAULT NULL,
  `mkey` varchar(200) DEFAULT NULL,
  `wname` longtext DEFAULT NULL,
  `itype` varchar(50) DEFAULT NULL,
  `currency` int(11) DEFAULT NULL,
  `currency_point` varchar(100) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=deactive,1=active',
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pg_detail`
--

INSERT INTO `pg_detail` (`id`, `payment_name`, `payment_description`, `payment_status`, `name`, `mid`, `mkey`, `wname`, `itype`, `currency`, `currency_point`, `date`, `status`, `created_date`) VALUES
(1, 'PayTm', NULL, 'Test', '', 'oKuUOE61722931444313', 'Y_z5pNASz%587TI6', 'WEBSTAGING', 'Retail', 3, '1', '10-10-2025', '0', '2019-01-29 09:25:19'),
(3, 'Offline', '<p>Hello&nbsp;</p>\r\n', '', '', '', '', '', '', 3, '1', '', '0', '2020-03-28 19:45:33'),
(4, 'PayStack', '', '', '', '', '', '', '', 0, '0', '', '0', '2020-04-04 21:45:44'),
(5, 'Instamojo', '', '', '', '', '', '', '', 0, '0', '', '0', '2020-05-02 19:16:40'),
(6, 'Razorpay', '', '', '', '', '', '', '', 0, '0', '', '0', '2020-05-02 19:16:40'),
(7, 'Cashfree', '', '', '', '', '', '', '', 0, '0', '', '0', '2020-05-02 19:16:40'),
(9, 'Tron', '', '', '', '', '', '', '', 6, '2', '', '0', '2021-10-12 12:28:47'),
(10, 'PayU', '', '', '', '', '', '', '', 3, '2', '', '0', '2021-10-12 12:28:47'),
(11, 'UPITranzact', 'https://neoupi.com/apis/v1/pay', 'Production', NULL, NULL, 'W1SEbjUcmg4lyuifzRJMh0T2pK6Wm7NZjznLD6AIxcPRip2BHu', 'yGZbFTqlJf9szEIKdeEuacyMczMZBoIj3tg4RsJPPMVpeXpp4D', NULL, 3, '1', '06-12-2025', '1', '2021-10-12 12:28:47'),
(12, 'UPITranzact Business', NULL, NULL, NULL, 'UPITRANS', 'utz_live_fef691dc36dd3f68', 'c34fa342601a163d4acaamn', NULL, 3, '1', '04-02-2025', '0', '2021-10-12 12:28:47');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_short_description` text NOT NULL,
  `product_description` text NOT NULL,
  `product_actual_price` double NOT NULL,
  `product_selling_price` double NOT NULL,
  `product_status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=deactive,1=active',
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `referral`
--

CREATE TABLE `referral` (
  `referral_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `from_mem_id` int(11) NOT NULL,
  `referral_amount` double NOT NULL,
  `referral_status` enum('0','1') NOT NULL COMMENT '0=referral,1=register referral',
  `entry_from` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0=unknown,1=app,2=web',
  `referral_dateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `screenshots`
--

CREATE TABLE `screenshots` (
  `screenshots_id` int(11) NOT NULL,
  `screenshot` varchar(255) NOT NULL,
  `dp_order` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=deactive,1=active',
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `screenshots`
--

INSERT INTO `screenshots` (`screenshots_id`, `screenshot`, `dp_order`, `status`, `created_date`) VALUES
(14, '202510190322101777273630__111111111-removebg-preview.png', 1, '1', '2025-10-19 03:22:10'),
(15, '202510190324131805017853__22222-removebg-preview.png', 2, '1', '2025-10-19 03:24:13'),
(16, '202510190324451805314885__333333-removebg-preview.png', 3, '1', '2025-10-19 03:24:45'),
(17, '202510190324591801387199__444444-removebg-preview.png', 4, '1', '2025-10-19 03:24:59'),
(18, '202510190325181800242318__55555-removebg-preview.png', 5, '1', '2025-10-19 03:25:18'),
(19, '202510190325361800679936__666666-removebg-preview.png', 6, '1', '2025-10-19 03:25:36');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `slider_id` int(11) NOT NULL,
  `slider_title` varchar(200) NOT NULL,
  `slider_image` text NOT NULL,
  `slider_link_type` enum('app','web','') NOT NULL DEFAULT '',
  `slider_link` text NOT NULL,
  `link_id` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=deactive,1=active',
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`slider_id`, `slider_title`, `slider_image`, `slider_link_type`, `slider_link`, `link_id`, `status`, `date_created`) VALUES
(16, 'Customer Support ', '202510310922511834379671__neewsop.jpg', 'web', 'https://t.me/GameAuraSupport', 0, '1', '2025-10-31 02:44:15'),
(18, 'ID AND PASS', '202511122052321806555052__sliderapp.jpg', 'web', 'https://youtu.be/mknurEE6uAw?si=d-JiGYE6r5diNlvi', 0, '1', '2025-10-31 09:23:18'),
(19, 'ID SELL', '202510310924511785003191__NWID.jpg', 'web', 'https://whatsapp.com/channel/0029VbBaU2L84OmK7zYz3U2I', 0, '1', '2025-10-31 09:23:59'),
(20, 'APP DEVELOPER ', '202511122054441768160084__NEWDVLP.jpg', 'web', 'https://t.me/GameAuraSupport', 0, '1', '2025-10-31 09:24:21'),
(21, 'COIN BONUS', '202511122055241782128924__NWBONYS.jpg', 'web', 'https://t.me/GameAuraSupport', 0, '1', '2025-11-12 20:55:24');

-- --------------------------------------------------------

--
-- Table structure for table `telegram_support`
--

CREATE TABLE `telegram_support` (
  `telegram_support_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `telegram_support`
--

INSERT INTO `telegram_support` (`telegram_support_id`, `name`, `image`, `url`, `status`, `date_created`) VALUES
(1, 'Test Name', '202601152203131845943093__500x500_FREEFIRE.jpg', 'https://t.me/test', 1, '2026-01-14 11:59:19'),
(3, 'LONE WOLF', '202601152235181805644218__500x500_BGMI.jpg', 'https://t.me/test', 1, '2026-01-15 22:35:18');

-- --------------------------------------------------------

--
-- Table structure for table `watch_earn`
--

CREATE TABLE `watch_earn` (
  `watch_earn_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `rewards` int(11) NOT NULL,
  `earning` int(11) NOT NULL,
  `watch_earn_date` date NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `web_config`
--

CREATE TABLE `web_config` (
  `id` int(11) NOT NULL,
  `web_config_name` varchar(255) NOT NULL,
  `web_config_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `web_config`
--

INSERT INTO `web_config` (`id`, `web_config_name`, `web_config_value`) VALUES
(1, 'admin', 'admin2020'),
(3, 'company_address', ' Maharashtra , India'),
(4, 'comapny_phone', ''),
(5, 'company_email', 'support@gameaura.in'),
(7, 'referral', '2'),
(8, 'referral_level1', '0'),
(9, 'template', 'front'),
(11, 'admin_photo', 'uploads'),
(12, 'company_street', 'CUSTOMER SUPPORT ON TELEGRAM'),
(13, 'company_time', '09:00 am to 11:00 pm'),
(15, 'game_rules', ''),
(16, 'match_url', 'https://youtube.com/@gameauraesports?si=E7n3yUyo-ChfZInA'),
(17, 'company_email_for_mail', 'info@xyz.com'),
(18, 'copyright_text', '<p><strong>Copyright &copy; 2026&nbsp;All right Reversed.</strong></p>\r\n\r\n<p><strong>Automatically Host Activity Detection Enabled &trade;</strong></p>\r\n'),
(19, 'active_referral', '1'),
(20, 'currency', ' 5'),
(21, 'share_description', 'GameAura eSports platform. Join Daily Matches & Get Rewards on Each Kill you score. \r\n Get Huge Prize on Winning. Just Download GameAura Android App & Register using the PromoCode given Below to Get 10 PlayCoins Free Signup Bonus. \r\nDownload Link - https://gameaura.in/\r\nDownload Now And Earn Money '),
(22, 'referandearn_description', 'GameAura eSports platform. Join Daily Matches & Get Rewards on Each Kill you score. \r\n Get Huge Prize on Winning. Just Download GameAura Android App & Register using the PromoCode given Below to Get 10 PlayCoins Free Signup Bonus. \r\nDownload Link - https://gameaura.in/\r\nDownload Now And Earn Money '),
(23, 'page_banner_image', ''),
(24, 'features_title', 'GameAura Esports'),
(25, 'features_text', 'Welcome to GameAura Esports, the premier destination for competitive gamers. We host professional-grade tournaments that give you the chance to put your skills to the test and earn amazing rewards.  '),
(26, 'home_sec_title', 'Game Aura '),
(27, 'home_sec_text', 'Introducing GameAura Esports, The Platform That Hosts A Tournaments For Popular Titles Like Free Fire And BGMI'),
(28, 'home_sec_btn', 'DOWNLOAD APP '),
(29, 'home_sec_bnr_image', '202510190040391766192339__liquid-light-forms-shine-loop-free-video.jpg'),
(30, 'home_sec_side_image', '202510190040391766738739__AURAAAAALOGO.png'),
(31, 'htp_title', 'How to Play'),
(32, 'htp_text', '\"GameAura Esports has a great platform for competitive gaming. The matches are fair and the winnings are credited quickly.\"    '),
(33, 'min_withdrawal', '50'),
(34, 'one_signal_notification', '1'),
(35, 'payment', ''),
(36, 'min_addmoney', '10'),
(37, 'fb_link', ''),
(38, 'insta_link', 'https://www.instagram.com/gameaura.in'),
(39, 'twitter_link', ''),
(40, 'google_link', ''),
(41, 'company_about', '<p>GameAura</p>\r\n'),
(42, 'company_logo', '202510190125521824802852__AURAAAAALOGO.png'),
(43, 'company_favicon', '202510190125521841928252__AURAAAAALOGO.png'),
(44, 'app_id', 'winhub.fun'),
(45, 'rest_api_key', ''),
(46, 'company_name', 'GameAura'),
(47, 'user_panel', 'bmuser'),
(48, 'msg91_otp', '0'),
(49, 'under_maintenance', '0'),
(50, 'msg91_authkey', ''),
(51, 'msg91_sender', ''),
(52, 'msg91_route', ''),
(53, 'purchase_code', '1231'),
(54, 'purchase_code_valid', 'no'),
(55, 'purchase_code_msg', 'Purchase Code is invalid! Please enter correct Purchase Code.'),
(56, 'purchase_domain', ''),
(57, 'admin_user', '2'),
(58, 'demo_user', '0'),
(59, 'fb_login', 'no'),
(60, 'firebase_otp', 'no'),
(61, 'google_login', 'yes'),
(64, 'smtp_host', '95.217.148.99'),
(65, 'smtp_user', 'no-reply@gameaura.in'),
(66, 'smtp_pass', '%2A%2A%2A%2A%2A%2A%2A%2A%2A%2A%2A%2A%2A%2A%2A%2A%2A%2A%2A%2A'),
(67, 'smtp_port', '576'),
(68, 'smtp_secure', 'tls'),
(69, 'comapny_country_code', '+91'),
(70, 'place_point_show', 'yes'),
(71, 'watch_ads_per_day', '0'),
(72, 'point_on_watch_ads', '0'),
(73, 'watch_earn_description', 'winhub.fun'),
(74, 'watch_earn_note', 'winhub.fun'),
(75, 'banner_ads_show', 'no'),
(76, 'timezone', 'Asia/Kolkata'),
(77, 'supported_language', '{\"en\":\"english\"}'),
(78, 'rtl_supported_language', '{\"ar\":\"arabic\",\"arc\":\"aramaic\",\"dv\":\"divehi\",\"fa\":\"persian\",\"ha\":\"hausa\",\"he\":\"hebrew\",\"khw\":\"khowar\",\"ks\":\"kashmiri\",\"ku\":\"kurdish\",\"ps\":\"pashto\",\"ur\":\"urdu\",\"yi\":\"yiddish\"}'),
(79, 'footer_script', ''),
(82, 'coin_up_to_hundrade', '5'),
(83, 'coin_under_hundrade', '10'),
(84, 'admin_profit', '0'),
(85, 'min_require_balance_for_withdrawal', '0'),
(86, 'referral_min_paid_fee', '10'),
(87, 'whatsapp_support', ''),
(88, 'firebase_realtime_db_url', 'https://gamezoop-78a94-default-rtdb.asia-southeast1.firebasedatabase.app'),
(89, 'google_analytics', 'no'),
(90, 'google_analytics_code', ''),
(91, 'reset_leaderboard', '');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_method`
--

CREATE TABLE `withdraw_method` (
  `withdraw_method_id` int(11) NOT NULL,
  `withdraw_method` varchar(200) NOT NULL,
  `withdraw_method_field` varchar(200) NOT NULL,
  `withdraw_method_currency` int(11) NOT NULL,
  `withdraw_method_currency_point` varchar(100) NOT NULL,
  `withdraw_method_status` enum('0','1') NOT NULL,
  `withdraw_method_dateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdraw_method`
--

INSERT INTO `withdraw_method` (`withdraw_method_id`, `withdraw_method`, `withdraw_method_field`, `withdraw_method_currency`, `withdraw_method_currency_point`, `withdraw_method_status`, `withdraw_method_dateCreated`) VALUES
(1, 'UPI ID', 'UPI ID', 3, '1', '1', '2024-12-19 19:03:54'),
(2, 'Play Store Redeem Code', 'mobile no', 3, '1', '1', '2024-12-19 19:07:27');

-- --------------------------------------------------------

--
-- Table structure for table `youtube_link`
--

CREATE TABLE `youtube_link` (
  `youtube_link_id` int(11) NOT NULL,
  `youtube_link` text NOT NULL,
  `youtube_link_title` text NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountstatement`
--
ALTER TABLE `accountstatement`
  ADD PRIMARY KEY (`account_statement_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `app_upload`
--
ALTER TABLE `app_upload`
  ADD PRIMARY KEY (`app_upload_id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`banner_id`);

--
-- Indexes for table `challenge_result_upload`
--
ALTER TABLE `challenge_result_upload`
  ADD PRIMARY KEY (`challenge_result_upload_id`);

--
-- Indexes for table `challenge_room_code`
--
ALTER TABLE `challenge_room_code`
  ADD PRIMARY KEY (`challenge_room_code_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `courier`
--
ALTER TABLE `courier`
  ADD PRIMARY KEY (`courier_id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`currency_id`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`deposit_id`);

--
-- Indexes for table `download`
--
ALTER TABLE `download`
  ADD PRIMARY KEY (`download_id`);

--
-- Indexes for table `features_tab`
--
ALTER TABLE `features_tab`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `features_tab_content`
--
ALTER TABLE `features_tab_content`
  ADD PRIMARY KEY (`ftc_id`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`game_id`);

--
-- Indexes for table `home_game`
--
ALTER TABLE `home_game`
  ADD PRIMARY KEY (`game_id`);

--
-- Indexes for table `howtoplay_content`
--
ALTER TABLE `howtoplay_content`
  ADD PRIMARY KEY (`htp_content_id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `lottery`
--
ALTER TABLE `lottery`
  ADD PRIMARY KEY (`lottery_id`);

--
-- Indexes for table `lottery_member`
--
ALTER TABLE `lottery_member`
  ADD PRIMARY KEY (`lottery_member_id`);

--
-- Indexes for table `ludo_challenge`
--
ALTER TABLE `ludo_challenge`
  ADD PRIMARY KEY (`ludo_challenge_id`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `match_join_member`
--
ALTER TABLE `match_join_member`
  ADD PRIMARY KEY (`match_join_member_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notifications_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orders_id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `pg_detail`
--
ALTER TABLE `pg_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `referral`
--
ALTER TABLE `referral`
  ADD PRIMARY KEY (`referral_id`);

--
-- Indexes for table `screenshots`
--
ALTER TABLE `screenshots`
  ADD PRIMARY KEY (`screenshots_id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `telegram_support`
--
ALTER TABLE `telegram_support`
  ADD PRIMARY KEY (`telegram_support_id`);

--
-- Indexes for table `watch_earn`
--
ALTER TABLE `watch_earn`
  ADD PRIMARY KEY (`watch_earn_id`);

--
-- Indexes for table `web_config`
--
ALTER TABLE `web_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_method`
--
ALTER TABLE `withdraw_method`
  ADD PRIMARY KEY (`withdraw_method_id`);

--
-- Indexes for table `youtube_link`
--
ALTER TABLE `youtube_link`
  ADD PRIMARY KEY (`youtube_link_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountstatement`
--
ALTER TABLE `accountstatement`
  MODIFY `account_statement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `app_upload`
--
ALTER TABLE `app_upload`
  MODIFY `app_upload_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `challenge_result_upload`
--
ALTER TABLE `challenge_result_upload`
  MODIFY `challenge_result_upload_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `challenge_room_code`
--
ALTER TABLE `challenge_room_code`
  MODIFY `challenge_room_code_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;

--
-- AUTO_INCREMENT for table `courier`
--
ALTER TABLE `courier`
  MODIFY `courier_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `currency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `deposit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `download`
--
ALTER TABLE `download`
  MODIFY `download_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features_tab`
--
ALTER TABLE `features_tab`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `features_tab_content`
--
ALTER TABLE `features_tab_content`
  MODIFY `ftc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `home_game`
--
ALTER TABLE `home_game`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `howtoplay_content`
--
ALTER TABLE `howtoplay_content`
  MODIFY `htp_content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `lottery`
--
ALTER TABLE `lottery`
  MODIFY `lottery_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lottery_member`
--
ALTER TABLE `lottery_member`
  MODIFY `lottery_member_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ludo_challenge`
--
ALTER TABLE `ludo_challenge`
  MODIFY `ludo_challenge_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `match_join_member`
--
ALTER TABLE `match_join_member`
  MODIFY `match_join_member_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notifications_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `pg_detail`
--
ALTER TABLE `pg_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `referral`
--
ALTER TABLE `referral`
  MODIFY `referral_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `screenshots`
--
ALTER TABLE `screenshots`
  MODIFY `screenshots_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `telegram_support`
--
ALTER TABLE `telegram_support`
  MODIFY `telegram_support_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `watch_earn`
--
ALTER TABLE `watch_earn`
  MODIFY `watch_earn_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `web_config`
--
ALTER TABLE `web_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `withdraw_method`
--
ALTER TABLE `withdraw_method`
  MODIFY `withdraw_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `youtube_link`
--
ALTER TABLE `youtube_link`
  MODIFY `youtube_link_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
