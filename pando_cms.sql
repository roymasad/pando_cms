-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 10, 2023 at 06:19 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pando_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `main_link` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `project` int(11) NOT NULL,
  `sortid` int(11) NOT NULL,
  `legend` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `main_link`, `category`, `project`, `sortid`, `legend`) VALUES
(5, 'happy_tree_friends.jpg', 'plans', 4, 5, ''),
(21, 'welcome.jpg', 'sketches', 1, 21, ''),
(25, '002.jpg', 'sketches', 1, 20, ''),
(28, 'startrek.jpg', 'models', 9, 28, ''),
(29, 'ss056.jpg', 'sketches', 9, 29, ''),
(30, 'ss028.jpg', 'sketches', 9, 30, ''),
(31, 'ss041.jpg', 'sketches', 9, 31, ''),
(32, 'ss364.jpg', 'images', 1, 32, ''),
(33, 'ss174.jpg', 'images', 2, 33, ''),
(34, 'ss199.jpg', 'images', 4, 34, ''),
(36, 'ss307.jpg', 'images', 8, 36, ''),
(37, 'ss268.jpg', 'images', 9, 37, ''),
(38, 'pic1.jpg', 'images', 7, 38, ''),
(39, 'ss287.jpg', 'boards', 2, 39, ''),
(40, '6.jpg', 'plans', 9, 40, ''),
(41, 'testpic.jpg', 'sketches', 7, 41, ''),
(42, 'testpic3.jpg', 'plans', 7, 42, ''),
(43, 'testpic4.jpg', 'site', 7, 43, ''),
(44, 'testimg2.jpg', 'images', 8, 44, ''),
(45, 'testimg2.jpg', 'images', 8, 45, ''),
(46, 'bleach.jpg', 'sketches', 1, 46, ''),
(49, 'b1.jpg', 'plans', 1, 49, ''),
(50, 'pdf-logo.jpg', 'plans', 1, 50, ''),
(56, '20070606-screen-black-lagoon.jpg', 'icons', 7, 56, ''),
(57, 'bl2sq0.jpg', 'icons', 1, 57, ''),
(58, 'burst+angel+jo.jpg', 'icons', 4, 58, ''),
(59, 'claymorehox4.jpg', 'icons', 2, 59, ''),
(60, 'Elfen_Lied_ep4_Lucy.jpg', 'icons', 8, 60, ''),
(61, 'ergo-proxy-01-15.jpg', 'icons', 9, 61, ''),
(62, 'Heavenly+Sword.jpg', 'icons', 10, 62, ''),
(63, '192.jpg', 'perspective', 1, 63, ''),
(64, 'card31.jpg', 'concept', 1, 64, ''),
(65, 'dbzcellposter11.jpg', 'site', 1, 65, ''),
(66, 'kdb91.jpg', 'boards', 1, 66, ''),
(71, 'southimage.jpg', 'construction', 1, 71, ''),
(72, 'ON-SITE-002.jpg', 'icons', 12, 72, ''),
(98, 'snoopy2.jpg', 'images', 53, 98, ''),
(99, 'snoopy2.jpg', 'icons', 53, 0, ''),
(100, 'ON-SITE-002.jpg', 'icons', 13, 100, ''),
(101, 'ELEVATION-01.jpg', 'images', 13, 107, ''),
(102, 'ELEVATION-02.jpg', 'images', 13, 111, ''),
(103, 'INTERIOR-SUFLI-0000.jpg', 'images', 13, 109, ''),
(104, 'INTERIOR-SUFLI-0005.jpg', 'images', 13, 104, ''),
(105, 'INTERIOR-SUFLI-0010.jpg', 'images', 13, 105, ''),
(106, 'INTERIOR-SUFLI-0020.jpg', 'images', 13, 106, ''),
(107, 'ON-SITE-001.jpg', 'images', 13, 101, ''),
(108, 'ON-SITE-002.jpg', 'images', 13, 0, ''),
(109, 'ON-SITE-003.jpg', 'images', 13, 103, ''),
(111, 'VIEWS-0000.jpg', 'images', 13, 102, ''),
(112, 'VIEWS-0010.jpg', 'images', 13, 112, ''),
(113, 'VIEWS-0015.jpg', 'images', 13, 113, ''),
(114, 'VIEWS-0020.jpg', 'images', 13, 114, ''),
(115, 'VIEWS-0025.jpg', 'images', 13, 115, ''),
(116, 'VIEWS-0035.jpg', 'images', 13, 116, ''),
(117, 'VIEWS-0040.jpg', 'images', 13, 117, ''),
(118, 'sketch-0003.jpg', 'sketches', 13, 118, ''),
(119, 'DSC00738.JPG', 'models', 13, 119, ''),
(120, 'DSC00739.JPG', 'models', 13, 120, ''),
(121, 'model.jpg', 'models', 13, 121, 'yayyy'),
(122, 'peebles-driftwood0045.jpg', 'icons', 50, 122, ''),
(178, 'VIEW-numero-0003.jpg', 'icons', 43, 178, ''),
(180, 'Copy_of_NIGHT.jpg', 'images', 43, 180, ''),
(181, 'inside-operavoid.jpg', 'images', 43, 181, ''),
(182, 'on-stage-003.jpg', 'images', 43, 182, ''),
(183, 'on-stage-004.jpg', 'images', 43, 183, ''),
(184, 'PLATFORM-lower-view-.jpg', 'images', 43, 184, ''),
(185, 'view-numero-25-stronger.jpg', 'images', 43, 185, ''),
(186, 'view-numero-37-MT.jpg', 'images', 43, 186, ''),
(187, 'VIEW-numero-0003.jpg', 'images', 43, 0, ''),
(188, 'VOID-SYSTEM.jpg', 'images', 43, 188, ''),
(191, 'VIDE-porte.jpg', 'sketches', 43, 191, ''),
(192, 'VIEW-0000.jpg', 'icons', 51, 192, ''),
(196, 'precious-collection-17--0000.jpg', 'images', 51, 196, ''),
(197, 'precious-collection-17--0005.jpg', 'images', 51, 197, ''),
(198, 'precious-collection-17--0010.jpg', 'images', 51, 198, ''),
(199, 'precious-collection-17--0015.jpg', 'images', 51, 199, ''),
(200, 'precious-collection-17--0020.jpg', 'images', 51, 200, ''),
(203, 'test-0000011.jpg', 'images', 51, 203, ''),
(226, 'APARTMENT-detail-close-up.jpg', 'images', 51, 226, ''),
(227, 'APARTMENT-WEST-details.jpg', 'images', 51, 227, ''),
(228, 'AXONOMETRY-d', 'images', 51, 228, ''),
(229, 'AXONOMETRY-e.jpg', 'images', 51, 229, ''),
(230, 'DETAIL.jpg', 'images', 51, 230, ''),
(231, 'SKIN-APARTMENT-SKIN-precious-loggias.jpg', 'images', 51, 231, ''),
(232, 'SKIN-APARTMENT-SKIN-wind.jpg', 'images', 51, 232, ''),
(233, 'SKIN-HOTEL-sun-shadows+photovoltaics.jpg', 'images', 51, 233, ''),
(234, 'SKIN-HOTEL-surpression+normal-use.jpg', 'images', 51, 234, ''),
(235, 'SKIN-HOTEL-typical-skin-WEST.jpg', 'images', 51, 235, ''),
(236, 'VIEW-0000.jpg', 'images', 51, 0, ''),
(237, 'VIEW-0005.jpg', 'images', 51, 237, ''),
(238, 'VIEW-0010.jpg', 'images', 51, 238, ''),
(239, 'VIEW-0020.jpg', 'images', 51, 239, ''),
(240, '2-options.jpg', 'sketches', 51, 240, ''),
(241, 'bad-side.jpg', 'sketches', 51, 241, ''),
(242, 'hotel-corner.jpg', 'sketches', 51, 242, ''),
(243, 'hotel-skin.jpg', 'sketches', 51, 243, ''),
(244, 'massing_organisation.jpg', 'sketches', 51, 244, ''),
(245, 'objects-community.jpg', 'sketches', 51, 245, ''),
(246, 'overall.jpg', 'sketches', 51, 246, ''),
(247, 'sketch-02-05-08.jpg', 'sketches', 51, 247, ''),
(248, 'skin-detail.jpg', 'sketches', 51, 248, ''),
(249, 'skin-edges.jpg', 'sketches', 51, 249, ''),
(250, '00-DAY_01-landscape.jpg', 'icons', 48, 250, ''),
(251, '00-BALCONY-01.jpg', 'images', 48, 251, ''),
(252, '00-DAY_01-landscape.jpg', 'images', 48, 0, ''),
(253, '00-DAY_02.jpg', 'images', 48, 253, ''),
(254, '00-DAY_03.jpg', 'images', 48, 254, ''),
(255, '00-GARDEN-view-landscape.jpg', 'images', 48, 255, ''),
(256, '00-INTERIOR_02-corrected.jpg', 'images', 48, 256, ''),
(257, '00-INTERIOR-01.jpg', 'images', 48, 257, ''),
(258, '00-NIGHT_01.jpg', 'images', 48, 258, ''),
(259, '00-NIGHT_02.jpg', 'images', 48, 259, ''),
(260, '00-NIGHT_03.jpg', 'images', 48, 260, ''),
(261, '00-panoramique.jpg', 'images', 48, 261, ''),
(262, '00-ROOF-view-UPDATED.jpg', 'images', 48, 262, ''),
(263, '00-UPVIEW.jpg', 'images', 48, 263, ''),
(264, '6-VILLAS-option-PARKING.jpg', 'sketches', 48, 264, ''),
(265, '6-VILLAS-option-PLAN.jpg', 'sketches', 48, 265, ''),
(266, '6-VILLAS-option-SECTION.jpg', 'sketches', 48, 266, ''),
(267, 'icon.jpg', 'sketches', 48, 267, ''),
(268, 'volumetric_sketch01.jpg', 'sketches', 48, 268, ''),
(269, 'volumetric_sketch02.jpg', 'sketches', 48, 269, ''),
(270, 'volumetric_sketch03.jpg', 'sketches', 48, 270, ''),
(271, 'volumetric_sketch04.jpg', 'sketches', 48, 271, ''),
(272, 'volumetric_sketch05.jpg', 'sketches', 48, 272, ''),
(273, 'volumetric_sketch06.jpg', 'sketches', 48, 273, ''),
(274, 'drift-tent-0000005.jpg', 'images', 50, 274, ''),
(275, 'drift-tent-0000010.jpg', 'images', 50, 275, ''),
(276, 'drift-tent-0000015.jpg', 'images', 50, 276, ''),
(277, 'drift-tent-0000015-TEST.jpg', 'images', 50, 277, ''),
(278, 'drift-tent-0000020.jpg', 'images', 50, 278, ''),
(279, 'drift-tent-0000025.jpg', 'images', 50, 279, ''),
(280, 'drift-tent-0000030.jpg', 'images', 50, 280, ''),
(281, 'drift-tent-0000035.jpg', 'images', 50, 281, ''),
(282, 'drift-tent-0000040.jpg', 'images', 50, 282, ''),
(283, 'drift-tent-0000045.jpg', 'images', 50, 283, ''),
(284, 'drift-tent-0000050.jpg', 'images', 50, 284, ''),
(285, '1.jpg', 'sketches', 50, 285, ''),
(286, 'micro-sketches.jpg', 'sketches', 50, 286, ''),
(287, 'Untitled-1.jpg', 'sketches', 50, 287, ''),
(288, 'Untitled-3.jpg', 'sketches', 50, 288, ''),
(289, 'Untitled-5.jpg', 'sketches', 50, 289, ''),
(290, 'Untitled-7.jpg', 'sketches', 50, 290, ''),
(291, 'Untitled-9.jpg', 'sketches', 50, 291, ''),
(305, 'main.jpg', 'images', 20, 305, ''),
(306, 'main-02.jpg', 'images', 20, 306, ''),
(307, 'night.jpg', 'images', 20, 307, ''),
(308, 'road-01.jpg', 'images', 20, 308, ''),
(309, 'terrace.jpg', 'images', 20, 309, ''),
(310, 'night.jpg', 'icons', 20, 0, ''),
(322, '00012.jpg', 'images', 22, 322, ''),
(323, '00014.jpg', 'images', 22, 323, ''),
(324, '00015.jpg', 'images', 22, 324, ''),
(325, '00016.jpg', 'images', 22, 325, ''),
(326, '00017.jpg', 'images', 22, 326, ''),
(333, 'anim-maquette-02.jpg', 'models', 23, 333, ''),
(334, 'back-to-basics-1.jpg', 'models', 23, 334, ''),
(335, 'MODEL-000.jpg', 'models', 23, 335, ''),
(336, 'MODEL-005.jpg', 'models', 23, 336, ''),
(337, 'IMG_5477.jpg', 'sketches', 23, 337, ''),
(338, 'IMG_5479.jpg', 'sketches', 23, 338, ''),
(339, 'IMG_5480.jpg', 'sketches', 23, 339, ''),
(340, 'HI-RES-landing.jpg', 'images', 23, 340, ''),
(341, 'HI-RES-missing-last-minute-.jpg', 'images', 23, 341, ''),
(342, 'HI-RES-radiale-plongeante.jpg', 'images', 23, 342, ''),
(343, 'MODEL-006.jpg', 'images', 23, 343, ''),
(344, 'MODEL-007.jpg', 'images', 23, 344, ''),
(345, 'MODEL-009.jpg', 'images', 23, 345, ''),
(346, 'MODEL-004.jpg', 'plans', 23, 346, ''),
(347, 'MODEL-009.jpg', 'icons', 23, 0, ''),
(349, '130428_fixation_sketch.JPG', 'sketches', 54, 349, ''),
(350, 'IMG_2941.JPG', 'sketches', 54, 350, ''),
(351, 'IMG_2946.JPG', 'sketches', 54, 1, ''),
(352, '130513_PARKING_corner-small.jpg', 'perspective', 54, 358, ''),
(353, '130616_penthouse_small.jpg', 'perspective', 54, 361, ''),
(354, '130710-LOBBY-02-small.jpg', 'perspective', 54, 354, ''),
(355, '130824_RENDERS_0000-small.jpg', 'perspective', 54, 355, ''),
(356, '130824_RENDERS_0020-small.jpg', 'perspective', 54, 356, ''),
(357, '130824_RENDERS_0030-small.jpg', 'perspective', 54, 357, ''),
(358, '130824_RENDERS_0100.jpg', 'perspective', 54, 11, ''),
(359, '130827_INTERIORs_0000.jpg', 'perspective', 54, 359, ''),
(360, '130827_INTERIORs_0005.jpg', 'perspective', 54, 360, ''),
(361, '130827_INTERIORs_0010.jpg', 'perspective', 54, 353, ''),
(362, 'IMG_3103.jpg', 'perspective', 54, 362, ''),
(363, '130501_fixation_model_1-1_02.jpg', 'models', 54, 363, ''),
(364, '20130829_164729.jpg', 'models', 54, 373, ''),
(365, 'DSC_0019.JPG', 'models', 54, 365, ''),
(366, 'IMG_3318.JPG', 'models', 54, 366, ''),
(367, 'IMG_4176.JPG', 'models', 54, 367, ''),
(368, 'IMG_4185.JPG', 'models', 54, 368, ''),
(369, 'IMG_4187.JPG', 'models', 54, 369, ''),
(370, 'IMG_4207.JPG', 'models', 54, 370, ''),
(371, 'IMG_4211.JPG', 'models', 54, 371, ''),
(372, 'IMG_4221.JPG', 'models', 54, 372, ''),
(373, 'IMG_4226.JPG', 'models', 54, 364, ''),
(374, 'Photo_Sep_26,_12_09_10.jpg', 'models', 54, 374, ''),
(375, 'illustration-east-elevation.jpg', 'concept', 54, 375, ''),
(376, 'IMG_8658.JPG', 'site', 54, 376, ''),
(377, '130901_MBO_JEDDAH_HeadQuarters_IMAGE_8.jpg', 'boards', 54, 377, ''),
(378, '130901_MBO_JEDDAH_HeadQuarters_IMAGE_12.jpg', 'boards', 54, 378, ''),
(379, '130901_MBO_JEDDAH_HeadQuarters_IMAGE_14.jpg', 'boards', 54, 379, ''),
(380, '130901_MBO_JEDDAH_HeadQuarters_IMAGE_15.jpg', 'boards', 54, 380, ''),
(381, '130901_MBO_JEDDAH_HeadQuarters_IMAGE_17.jpg', 'boards', 54, 381, ''),
(382, '130901_MBO_JEDDAH_HeadQuarters_IMAGE_18.jpg', 'boards', 54, 382, ''),
(383, '130901_MBO_JEDDAH_HeadQuarters_IMAGE_14.jpg', 'boards', 54, 0, ''),
(384, '130901_MBO_JEDDAH_HeadQuarters_IMAGE_15.jpg', 'boards', 54, 0, ''),
(385, '130901_MBO_JEDDAH_HeadQuarters_IMAGE_17.jpg', 'boards', 54, 0, ''),
(386, '130901_MBO_JEDDAH_HeadQuarters_IMAGE_18.jpg', 'boards', 54, 0, ''),
(387, '130901_MBO_JEDDAH_HeadQuarters_IMAGE_21.jpg', 'boards', 54, 387, ''),
(388, '130901_MBO_JEDDAH_HeadQuarters_IMAGE_27.jpg', 'boards', 54, 388, ''),
(389, '130901_MBO_JEDDAH_HeadQuarters_IMAGE_44.jpg', 'boards', 54, 389, ''),
(390, '130901_MBO_JEDDAH_HeadQuarters_IMAGE_47.jpg', 'boards', 54, 390, ''),
(391, '130901_MBO_JEDDAH_HeadQuarters_IMAGE_54.jpg', 'boards', 54, 391, ''),
(392, '130827_ELEVATION_EAST-small.jpg', 'plans', 54, 392, ''),
(393, '130827_ELEVATIONS_NORTH.jpg', 'plans', 54, 393, ''),
(394, '130827_ELEVATIONS_SOUTH.jpg', 'plans', 54, 394, ''),
(395, '130829_MP_.jpg', 'plans', 54, 395, ''),
(398, '10-INTERIOR-down-.jpg', 'diagrams', 54, 398, ''),
(399, 'ELEV-ANGLES-10i-0010.jpg', 'diagrams', 54, 399, ''),
(400, 'SUN-10-0001.jpg', 'diagrams', 54, 400, ''),
(401, 'test-10i.jpg', 'diagrams', 54, 401, ''),
(402, 'IMG_3103.jpg', 'icons', 54, 0, ''),
(403, '0043-SITE-PROGRESS-20130828.JPG', 'construction', 54, 403, ''),
(404, '0043-SITE-PROGRESS-20130829.JPG', 'construction', 54, 404, ''),
(405, 'Damascus_ateliersdesnuages.jpg', 'icons', 15, 405, ''),
(408, 'COURTYARD-mall.jpg', 'icons', 25, 408, ''),
(409, '0017-process.jpg', 'icons', 28, 409, ''),
(410, 'DSC00156.jpg', 'icons', 30, 410, ''),
(411, 'big00copy.jpg', 'icons', 32, 411, ''),
(412, '29-06-2010-000011.jpg', 'icons', 34, 412, ''),
(413, 'pict-01.jpg', 'icons', 35, 413, ''),
(414, 'bank-icon.jpg', 'icons', 36, 414, ''),
(416, 'riad-concept.jpg', 'icons', 37, 416, ''),
(417, 'OPTION-3.jpg', 'icons', 38, 417, ''),
(418, 'VUE-003.jpg', 'icons', 39, 418, ''),
(419, '0001-PERSPECTIVE-DETAIL-02.jpg', 'icons', 46, 419, ''),
(420, 'SUSPENDED-GARDEN.jpg', 'icons', 44, 420, ''),
(421, 'bluesky.jpg', 'site', 15, 421, ''),
(422, 'Damascus_2_meters_under_20_01_2011.jpg', 'site', 15, 422, ''),
(423, 'Damascus_11-tonnes-romaines.jpg', 'site', 15, 423, ''),
(424, 'Damascus_ateliersdesnuages.jpg', 'site', 15, 0, ''),
(425, 'Damascus_beit-nar-big.jpg', 'site', 15, 425, ''),
(426, 'Damascus_blue-detail.jpg', 'site', 15, 426, ''),
(427, 'Damascus_court3door.jpg', 'site', 15, 427, ''),
(428, 'Damascus_Kitchen_wall_Stone_rebuilt.jpg', 'site', 15, 428, ''),
(429, 'Damascus_Liwan.jpg', 'site', 15, 429, ''),
(430, 'Damascus_main_courtyard.jpg', 'site', 15, 430, ''),
(431, 'Damascus_panorama-demolition-early-works.jpg', 'site', 15, 431, ''),
(432, 'ground-floor.jpg', 'sketches', 15, 432, ''),
(433, 'sections.jpg', 'sketches', 15, 433, ''),
(441, 'pg_1.jpg', 'sketches', 22, 441, ''),
(443, 'pg-1.jpg', 'sketches', 22, 443, ''),
(444, 'pg-9.jpg', 'sketches', 22, 444, ''),
(445, 'pg-10.jpg', 'sketches', 22, 445, ''),
(446, 'pg-11.jpg', 'sketches', 22, 446, ''),
(447, 'pg-13.jpg', 'sketches', 22, 447, ''),
(448, 'pg-14.jpg', 'sketches', 22, 448, ''),
(449, 'pg-15.jpg', 'sketches', 22, 449, ''),
(450, '00031.jpg', 'concept', 22, 0, ''),
(451, '00032.jpg', 'concept', 22, 451, ''),
(452, 'ABDLE-WAHAB.jpg', 'images', 25, 452, ''),
(453, 'BALCONY.jpg', 'images', 25, 453, ''),
(454, 'BECHARA-EL-KHOURY.jpg', 'images', 25, 454, ''),
(455, 'COURTYARD-mall.jpg', 'images', 25, 0, ''),
(456, 'DAMASCUS-ROAD.jpg', 'images', 25, 456, ''),
(457, 'ELEVATIONS.jpg', 'concept', 25, 457, ''),
(458, '0001-espace-campus.jpg', 'sketches', 28, 458, ''),
(459, '0002-deroulement.jpg', 'sketches', 28, 459, ''),
(460, '0003-plan-masse.jpg', 'sketches', 28, 460, ''),
(461, '0004-planmasse-advanced.jpg', 'sketches', 28, 461, ''),
(462, '0005-administration.jpg', 'sketches', 28, 462, ''),
(463, '0006-classes.jpg', 'sketches', 28, 463, ''),
(464, '0007-entre2.jpg', 'sketches', 28, 464, ''),
(465, '0007-entree.jpg', 'perspective', 28, 465, ''),
(466, '0008-entrance.jpg', 'perspective', 28, 466, ''),
(467, '0010-campus-etudiant.jpg', 'perspective', 28, 467, ''),
(468, '0011-avion.jpg', 'perspective', 28, 468, ''),
(469, '0011-mass.jpg', 'perspective', 28, 469, ''),
(470, '0012-cours-officielle.jpg', 'perspective', 28, 470, ''),
(471, '0012-rue-interieure.jpg', 'perspective', 28, 471, ''),
(472, '0013-inside.jpg', 'perspective', 28, 472, ''),
(473, '0013-spectacle.jpg', 'perspective', 28, 473, ''),
(474, '0013-sport.jpg', 'perspective', 28, 474, ''),
(475, '0015-big-campus-old.jpg', 'perspective', 28, 475, ''),
(476, '0016-campus.jpg', 'perspective', 28, 476, ''),
(477, '0017-process.jpg', 'perspective', 28, 0, ''),
(478, 'coin-interieur.jpg', 'perspective', 28, 478, ''),
(479, 'ELEVATION.jpg', 'perspective', 28, 479, ''),
(480, 'entree-Fares.jpg', 'perspective', 28, 480, ''),
(481, 'NEW-Fares.jpg', 'perspective', 28, 481, ''),
(482, 'vue_du_balcon.jpg', 'perspective', 28, 482, ''),
(483, 'ghazal-sketch1-b.jpg', 'sketches', 30, 483, ''),
(484, 'sk-4.jpg', 'sketches', 30, 484, ''),
(485, 'sk-5.jpg', 'sketches', 30, 485, ''),
(486, 'sk-6.jpg', 'sketches', 30, 486, ''),
(487, 'sk-7.jpg', 'sketches', 30, 487, ''),
(488, 'DSC00156.jpg', 'models', 30, 0, ''),
(489, 'DSC00157.jpg', 'models', 30, 489, ''),
(490, 'DSC00158.jpg', 'models', 30, 490, ''),
(491, 'DSC00159.jpg', 'models', 30, 491, ''),
(492, 'DSC00160.jpg', 'models', 30, 492, ''),
(493, 'DSC00161.jpg', 'models', 30, 493, ''),
(494, 'DSC00163.jpg', 'models', 30, 494, ''),
(495, 'DSC00168.jpg', 'models', 30, 495, ''),
(496, 'VUE-001.jpg', 'perspective', 30, 496, ''),
(497, 'VUE-002.jpg', 'perspective', 30, 497, ''),
(498, 'VUE-003.jpg', 'perspective', 30, 498, ''),
(499, 'VUE-004.jpg', 'perspective', 30, 499, ''),
(500, 'sketch1.jpg', 'sketches', 32, 500, ''),
(501, 'sketch2.jpg', 'sketches', 32, 501, ''),
(502, 'sketch3.jpg', 'sketches', 32, 502, ''),
(503, 'sketch4.jpg', 'sketches', 32, 503, ''),
(504, 'sketch5.jpg', 'sketches', 32, 504, ''),
(505, 'sketch6.jpg', 'sketches', 32, 505, ''),
(506, 'BIG-002_copy.jpg', 'concept', 32, 506, ''),
(507, 'BIG-003_copy.jpg', 'concept', 32, 507, ''),
(508, 'BIG-004_copy.jpg', 'concept', 32, 508, ''),
(509, 'BIG-005_copy.jpg', 'concept', 32, 509, ''),
(510, 'BIG-006_copy.jpg', 'concept', 32, 510, ''),
(511, 'IBIS+NOVOTEL004.jpg', 'sketches', 37, 511, ''),
(512, 'IBIS+NOVOTEL005.jpg', 'sketches', 37, 512, ''),
(513, 'IBIS+NOVOTEL006.jpg', 'sketches', 37, 513, ''),
(514, 'IBIS+NOVOTEL007.jpg', 'sketches', 37, 514, ''),
(515, 'IBIS+NOVOTEL008.jpg', 'sketches', 37, 515, ''),
(516, 'IBIS+NOVOTEL009.jpg', 'sketches', 37, 516, ''),
(517, 'IBIS+NOVOTEL0010.jpg', 'sketches', 37, 517, ''),
(518, 'IBIS+NOVOTEL011.jpg', 'sketches', 37, 518, ''),
(519, 'NIGHT-0001.jpg', 'concept', 37, 519, ''),
(520, 'VUE-Ibis+NOV-NORD-GREY.jpg', 'concept', 37, 520, ''),
(521, 'VUE-Ibis+Novotel-SUD-GREY.jpg', 'concept', 37, 521, ''),
(522, 'VUE-interieure.jpg', 'concept', 37, 522, ''),
(523, 'VUE-NOV-only-GREY.jpg', 'concept', 37, 523, ''),
(524, 'escaliers.jpg', 'sketches', 38, 524, ''),
(525, 'ETAGE-0.jpg', 'sketches', 38, 525, ''),
(526, 'ETAGE-1.jpg', 'sketches', 38, 526, ''),
(527, 'ETAGE-2.jpg', 'sketches', 38, 527, ''),
(528, 'ETAGE-3.jpg', 'sketches', 38, 528, ''),
(529, 'ETAGE-4.jpg', 'sketches', 38, 529, ''),
(530, 'NEW-SAT.jpg', 'concept', 38, 530, ''),
(531, 'OPTION-2.jpg', 'concept', 38, 531, ''),
(532, 'OPTION-3.jpg', 'concept', 38, 0, ''),
(533, 'OPTION-4.jpg', 'concept', 38, 533, ''),
(534, 'OPTION-4-view.jpg', 'concept', 38, 534, ''),
(535, 'PROPOSITION-01.jpg', 'concept', 38, 535, ''),
(536, 'completeboard.jpg', 'sketches', 41, 536, ''),
(538, 'processus-banque.jpg', 'sketches', 41, 538, ''),
(539, 'S1010001.jpg', 'site', 41, 539, ''),
(540, 'S1010002.jpg', 'site', 41, 540, ''),
(541, 'bank-icon.jpg', 'icons', 41, 541, ''),
(542, 'main-perspective.jpg', 'perspective', 41, 542, ''),
(545, 'sketch-00.jpg', 'sketches', 42, 545, ''),
(546, 'sketch-01.jpg', 'sketches', 42, 546, ''),
(547, 'detail-LONG.jpg', 'icons', 42, 547, ''),
(548, 'COUPE_perspective.jpg', 'perspective', 42, 548, ''),
(553, 'BIG-view-0002.jpg', 'images', 42, 553, ''),
(554, 'BIG-view-0003.jpg', 'images', 42, 554, ''),
(555, 'entry.jpg', 'images', 42, 555, ''),
(556, 'LOBBY.jpg', 'images', 42, 556, ''),
(557, 'view.jpg', 'images', 42, 557, ''),
(558, 'ELEPHANT-diagremme-01.jpg', 'diagrams', 43, 558, ''),
(559, 'TEST-diagram-empty-urban-viewpoint.jpg', 'diagrams', 43, 559, ''),
(560, 'TEST-diagram-program-zones-A-urban-viewpoint.jpg', 'diagrams', 43, 560, ''),
(561, 'TEST-diagram-program-zones-B-urban-viewpoint.jpg', 'diagrams', 43, 561, ''),
(562, 'TEST-diagram-suspended-world-urban-viewpoint.jpg', 'diagrams', 43, 562, ''),
(563, 'TWO-towers0111.jpg', 'diagrams', 43, 563, ''),
(564, 'URBAN-division.jpg', 'diagrams', 43, 564, ''),
(565, '0001-PERSPECTIVE-DETAIL-02.jpg', 'perspective', 46, 0, ''),
(566, '0001-PERSPECTIVE-INSIDE.jpg', 'perspective', 46, 566, ''),
(567, '001-PERSPECTIVE-NUIT.jpg', 'perspective', 46, 567, ''),
(568, '001-PERSPECTIVE-PROCHE.jpg', 'perspective', 46, 568, ''),
(569, '00PERS-FRONT-WIRE.jpg', 'concept', 46, 569, ''),
(570, '001-ELEVATION-NORD.jpg', 'concept', 46, 570, ''),
(571, '001-ELEVATION-OUEST.jpg', 'concept', 46, 571, ''),
(572, '001-ELEVATION-SUD.jpg', 'concept', 46, 572, ''),
(573, 'VERSION-III-plan.jpg', 'plans', 50, 575, ''),
(574, 'VERSION-II-plan.jpg', 'plans', 50, 574, ''),
(575, 'VERSION-I-plan.jpg', 'plans', 50, 573, ''),
(576, 'v-2-program-diag-1.jpg', 'diagrams', 50, 576, ''),
(577, 'v-2-sun-diag-1.jpg', 'diagrams', 50, 577, ''),
(578, 'v-2-sun-diag-2.jpg', 'diagrams', 50, 578, ''),
(579, 'V-2-WIND-DIAG.jpg', 'diagrams', 50, 579, ''),
(580, 'v-2-wind-diag-2.jpg', 'diagrams', 50, 580, ''),
(581, 'v-2-wind-diag-3.jpg', 'diagrams', 50, 581, ''),
(582, 'v-3-green-diag-1.jpg', 'diagrams', 50, 582, ''),
(583, 'v-3-SUN-DIAG-1.jpg', 'diagrams', 50, 583, ''),
(584, 'v-3-views-diag-1.jpg', 'diagrams', 50, 584, ''),
(585, 'bioshock_infinite_video_game-wide.jpg', 'concept', 13, 585, ''),
(586, 'dexter.png', 'images', 19, 586, ''),
(587, 'cat.12003.jpg', 'sketches', 19, 587, ''),
(588, 'cat.12009.jpg', 'sketches', 19, 588, ''),
(589, 'cat.12006.jpg', 'models', 19, 589, ''),
(590, 'dog.12000.jpg', 'sketches', 21, 590, ''),
(591, 'dog.12014.jpg', 'models', 21, 591, ''),
(592, 'cat.12003.jpg', 'icons', 19, 0, ''),
(593, 'dog.12018.jpg', 'icons', 21, 593, ''),
(594, 'dog.12018.jpg', 'images', 21, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `modz`
--

CREATE TABLE `modz` (
  `username` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `modz`
--

INSERT INTO `modz` (`username`, `password`, `level`, `email`) VALUES
('admin', 'admin', 1, 'roy.masad@googlemail.com');

-- --------------------------------------------------------

--
-- Table structure for table `names`
--

CREATE TABLE `names` (
  `id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `team` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `names`
--

INSERT INTO `names` (`id`, `name`, `team`) VALUES
(1, 'red fred', 'Client'),
(21, 'blue fred', 'Engineers'),
(22, 'green fred', 'Architects');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `htmltext` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `htmltext`) VALUES
(1, 'contact', '<p>\r\n	&nbsp;</p>\r\n<p class=\"style1\" style=\"\">\r\n	<font color=\"#000000\"><span style=\"font-size: 10px;\">USA</span></font></p>\r\n<p class=\"style1\" style=\"\">\r\n	&nbsp;</p>\r\n<p class=\"style1\" style=\"\">\r\n	<span style=\"color: rgb(0, 0, 0); font-size: 10px;\">TEL: 1 555 123123</span></p>\r\n'),
(2, 'about', '<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<strong><span style=\"color:#696969;\"><span style=\"font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\"><span style=\"background-color:#ffffff;\">What is Lorem Ipsum? </span></span></span></strong></p>\r\n<p>\r\n	<span style=\"color:#696969;\"><span style=\"font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\"><span style=\"background-color:#ffffff;\">Lorem Ipsum is simply&nbsp;</span></span><span style=\"font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\"><span style=\"background-color:#ffffff;\">dummy text of the printing and typesetting industry</span></span><span style=\"font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\"><span style=\"background-color:#ffffff;\">. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span></span></span></p>\r\n'),
(3, 'team', '<h1>\r\n	<font class=\"Apple-style-span\" color=\"#000000\" face=\"verdana, geneva, sans-serif\"><img alt=\"\" src=\"/tests/blob/pix/image/team-page.jpg\" /></font></h1>\r\n'),
(4, 'partners', '<h1>\r\n	<span style=\"font-family:verdana,geneva,sans-serif;\">PARTNERS</span></h1>\r\n<p>\r\n	<strong style=\"color: rgb(0, 0, 0); font-family: Verdana; font-size: 13px; line-height: 17px; \">ONLINE VIDEO BROADCASTER</strong>&nbsp;Youtube has bought Rightsflow, a copyright management firm.</p>\r\n<p style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 10px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; line-height: 1.32em; color: rgb(0, 0, 0); font-family: Verdana; font-size: 13px; \">\r\n	Rightsflow lets creators license their media content and monetise it. It covers licences for digital music, vinyl and CD and might have an impact on what music gets posted online and who gets the credit for it.</p>\r\n<p style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 10px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; line-height: 1.32em; color: rgb(0, 0, 0); font-family: Verdana; font-size: 13px; \">\r\n	&quot;We&#39;re pleased to now be taking a momentous step with the team at YouTube, that shares in our vision of solving the really challenging problem of copyright management,&quot; said Rightsflow CEO Patrick Sullivan.</p>\r\n<p style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 10px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; line-height: 1.32em; color: rgb(0, 0, 0); font-family: Verdana; font-size: 13px; \">\r\n	&quot;Combined with the worldwide platform and reach of YouTube, we&#39;ll now be able to drive awareness, adoption, and licensing success to a much larger audience - ultimately benefiting users, artists, labels, songwriters, publishers, and the entire global music ecosystem.&quot;</p>\r\n<p style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 10px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; line-height: 1.32em; color: rgb(0, 0, 0); font-family: Verdana; font-size: 13px; \">\r\n	Youtube said that Rightsflow would help it deal with the &quot;complex issues of licensing and royalty payment management&quot;.</p>\r\n<p style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 10px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; line-height: 1.32em; color: rgb(0, 0, 0); font-family: Verdana; font-size: 13px; \">\r\n	&quot;By combining Rightsflow&#39;s expertise and technology with YouTube&#39;s platform, we hope to more rapidly and efficiently license music on YouTube, meaning more music for you all to enjoy, and more money for the talented people producing the music. From music videos to live-streamed concerts,&quot; said David King, product manager at Youtube.</p>\r\n<p style=\"margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 10px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; line-height: 1.32em; color: rgb(0, 0, 0); font-family: Verdana; font-size: 13px; \">\r\n	&quot;We have and will continue to invest in tools that make it easier for copyright owners to manage their content online.&quot; &micro;</p>\r\n'),
(5, 'jobs', '<h1>\r\n	<span style=\"font-family:verdana,geneva,sans-serif;\">JOB OPPORTUNITIES</span></h1>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	coming soon..</div>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `pdfs`
--

CREATE TABLE `pdfs` (
  `id` int(11) NOT NULL,
  `main_link` text COLLATE utf8_unicode_ci NOT NULL,
  `project` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pdfs`
--

INSERT INTO `pdfs` (`id`, `main_link`, `project`) VALUES
(7, 'test.pdf', '1'),
(8, 'test2.pdf', '7'),
(9, '131004_STUDY-MODEL_report.pdf', '54');

-- --------------------------------------------------------

--
-- Table structure for table `press`
--

CREATE TABLE `press` (
  `id` int(11) NOT NULL,
  `title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `info` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `image_link` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `hyper_link` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `press`
--

INSERT INTO `press` (`id`, `title`, `date`, `info`, `image_link`, `hyper_link`) VALUES
(10, 'NEW', '2011-01-01', 'Lorem Ipsum again, but this time with a twist', '192.jpg', 'www.google.com'),
(11, 'News Title 1', '2012-01-10', 'Lorem Ipsum 123, Things happened today', '20070606-screen-black-lagoon.jpg', 'pdf//6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `area` int(11) NOT NULL,
  `project_year` int(11) NOT NULL,
  `completion_year` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `ranking` int(11) NOT NULL,
  `client` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `authorship` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `associates` text COLLATE utf8_unicode_ci NOT NULL,
  `lead_architects` text COLLATE utf8_unicode_ci NOT NULL,
  `architects` text COLLATE utf8_unicode_ci NOT NULL,
  `engineers` text COLLATE utf8_unicode_ci NOT NULL,
  `interior_designers` text COLLATE utf8_unicode_ci NOT NULL,
  `lighting_list` text COLLATE utf8_unicode_ci NOT NULL,
  `materials_list` text COLLATE utf8_unicode_ci NOT NULL,
  `sustainability` text COLLATE utf8_unicode_ci NOT NULL,
  `3d` text COLLATE utf8_unicode_ci NOT NULL,
  `pix_icons` text COLLATE utf8_unicode_ci NOT NULL,
  `pix_images` text COLLATE utf8_unicode_ci NOT NULL,
  `pix_sketches` text COLLATE utf8_unicode_ci NOT NULL,
  `pix_perspectives` text COLLATE utf8_unicode_ci NOT NULL,
  `pix_models` text COLLATE utf8_unicode_ci NOT NULL,
  `pix_conceptpix` text COLLATE utf8_unicode_ci NOT NULL,
  `pix_sitepix` text COLLATE utf8_unicode_ci NOT NULL,
  `pix_animation` text COLLATE utf8_unicode_ci NOT NULL,
  `pix_boards` text COLLATE utf8_unicode_ci NOT NULL,
  `pix_plans` text COLLATE utf8_unicode_ci NOT NULL,
  `pdf_report` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `grid` int(11) NOT NULL,
  `volume` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `type`, `area`, `project_year`, `completion_year`, `cost`, `ranking`, `client`, `authorship`, `associates`, `lead_architects`, `architects`, `engineers`, `interior_designers`, `lighting_list`, `materials_list`, `sustainability`, `3d`, `pix_icons`, `pix_images`, `pix_sketches`, `pix_perspectives`, `pix_models`, `pix_conceptpix`, `pix_sitepix`, `pix_animation`, `pix_boards`, `pix_plans`, `pdf_report`, `status`, `location`, `website`, `grid`, `volume`) VALUES
(19, 'Kitty House', 'It is a kitty project', 'residential', 2000, 2013, 0, 500000, 4, '', '', 'John Doe', '', 'Jane, Jonathan', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Pluto', '', 0, ''),
(21, 'Dog House', 'Quite loud', 'commercial', 3500, 2006, 0, 15000000, 2, 'Spot', '', '', '', 'Jonathan', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Jupiter', '', 0, ''),
(22, 'Hamster House', '', 'competition', 25000, 2007, 0, 500000, 1, 'red fred, ', '', '', 'green fred, ', 'green fred, ', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Venus', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `publications`
--

CREATE TABLE `publications` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `info` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `image_link` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `hyper_link` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `pdf_link` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `publications`
--

INSERT INTO `publications` (`id`, `date`, `info`, `image_link`, `hyper_link`, `pdf_link`) VALUES
(2, '2011-12-12', 'pub2', 'pic1.jpg', '222222', ''),
(3, '0000-00-00', 'pubs3', 'pubs3.jpg', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `grid_3d_offset_x` int(11) NOT NULL,
  `grid_3d_offset_y` int(11) NOT NULL,
  `grid_skew` int(11) NOT NULL,
  `grid_thumb_fade_delay` float NOT NULL,
  `grid_thumb_height` int(11) NOT NULL,
  `grid_thumb_width` int(11) NOT NULL,
  `grid_thumb_zoom` float NOT NULL,
  `grid_xyz` int(11) NOT NULL,
  `image_height` int(11) NOT NULL,
  `thumb_height` int(11) NOT NULL,
  `thumb_width` int(11) NOT NULL,
  `column_offset` int(11) NOT NULL,
  `mini_x_offset` int(11) NOT NULL,
  `mini_y_offset` int(11) NOT NULL,
  `sort_alphab` text COLLATE utf8_unicode_ci NOT NULL,
  `sort_type` text COLLATE utf8_unicode_ci NOT NULL,
  `sort_area` text COLLATE utf8_unicode_ci NOT NULL,
  `sort_ranking` text COLLATE utf8_unicode_ci NOT NULL,
  `sort_budget` text COLLATE utf8_unicode_ci NOT NULL,
  `sort_year` text COLLATE utf8_unicode_ci NOT NULL,
  `grid_margin_left` int(11) NOT NULL,
  `grid_margin_top` int(11) NOT NULL,
  `budget_list` text COLLATE utf8_unicode_ci NOT NULL,
  `area_list` text COLLATE utf8_unicode_ci NOT NULL,
  `alphab_list` text COLLATE utf8_unicode_ci NOT NULL,
  `sort_price_design` text COLLATE utf8_unicode_ci NOT NULL,
  `price_design_list` text COLLATE utf8_unicode_ci NOT NULL,
  `sort_price_art` text COLLATE utf8_unicode_ci NOT NULL,
  `price_art_list` text COLLATE utf8_unicode_ci NOT NULL,
  `sort_material_design` text COLLATE utf8_unicode_ci NOT NULL,
  `material_design_list` text COLLATE utf8_unicode_ci NOT NULL,
  `sort_material_art` text COLLATE utf8_unicode_ci NOT NULL,
  `material_art_list` text COLLATE utf8_unicode_ci NOT NULL,
  `sort_volume_design` text COLLATE utf8_unicode_ci NOT NULL,
  `volume_design_list` text COLLATE utf8_unicode_ci NOT NULL,
  `sort_volume_art` text COLLATE utf8_unicode_ci NOT NULL,
  `volume_art_list` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `grid_3d_offset_x`, `grid_3d_offset_y`, `grid_skew`, `grid_thumb_fade_delay`, `grid_thumb_height`, `grid_thumb_width`, `grid_thumb_zoom`, `grid_xyz`, `image_height`, `thumb_height`, `thumb_width`, `column_offset`, `mini_x_offset`, `mini_y_offset`, `sort_alphab`, `sort_type`, `sort_area`, `sort_ranking`, `sort_budget`, `sort_year`, `grid_margin_left`, `grid_margin_top`, `budget_list`, `area_list`, `alphab_list`, `sort_price_design`, `price_design_list`, `sort_price_art`, `price_art_list`, `sort_material_design`, `material_design_list`, `sort_material_art`, `material_art_list`, `sort_volume_design`, `volume_design_list`, `sort_volume_art`, `volume_art_list`) VALUES
(1, 60, 60, 25, 1, 200, 0, 300, 5, 720, 227, 800, 50, 100, 50, 'AtoE,FtoJ,KtoP,QtoV,WtoZ', 'commercial, competition, industrial, residential, urban', '10,100,500,1000,10000', '1,2,3,4,5', '1000, 10000, 100000, 1000000 , 10000000', '1990,2000,2005,2010,2013', 200, 200, '1000, 10K, 1000K, 1M , 10M', '10m2,100m2,500m2,1K m2,5K m2', 'A,F,K,Q,W', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `main_link` text COLLATE utf8_unicode_ci NOT NULL,
  `project` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `main_link`, `project`) VALUES
(2, 'Milow.mp4', '1'),
(3, 'Maroon5.mp4', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modz`
--
ALTER TABLE `modz`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `names`
--
ALTER TABLE `names`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdfs`
--
ALTER TABLE `pdfs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `press`
--
ALTER TABLE `press`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=595;

--
-- AUTO_INCREMENT for table `names`
--
ALTER TABLE `names`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pdfs`
--
ALTER TABLE `pdfs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `press`
--
ALTER TABLE `press`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `publications`
--
ALTER TABLE `publications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
