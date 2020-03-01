-- phpMyAdmin SQL Dump
-- version 5.0.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 28, 2020 at 05:53 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zhaw_pmmastaz`
--

-- --------------------------------------------------------

--
-- Table structure for table `capacities`
--

CREATE TABLE `capacities` (
  `pi_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `capacity` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `capacities`
--

INSERT INTO `capacities` (`pi_id`, `staff_id`, `capacity`) VALUES
(1, 1, 24),
(1, 2, 2),
(1, 3, 11),
(1, 4, 24),
(1, 5, 24),
(1, 6, 0),
(1, 7, 8),
(1, 8, 8),
(1, 9, 1),
(1, 10, 0),
(1, 11, 0),
(1, 12, 24),
(1, 13, 0),
(1, 14, 0),
(1, 15, 8),
(1, 16, 8),
(1, 17, 16),
(2, 1, 24),
(2, 2, 0),
(2, 3, 24),
(2, 4, 24),
(2, 5, 24),
(2, 6, 1),
(2, 7, 8),
(2, 8, 8),
(2, 9, 1),
(2, 10, 0),
(2, 11, 0),
(2, 12, 24),
(2, 13, 0),
(2, 14, 0),
(2, 15, 8),
(2, 16, 8),
(2, 17, 16),
(3, 1, 10),
(3, 2, 20),
(3, 3, 24),
(3, 4, 1),
(3, 5, 24),
(3, 6, 2),
(3, 7, 8),
(3, 8, 8),
(3, 9, 1),
(3, 10, 0),
(3, 11, 0),
(3, 12, 24),
(3, 13, 0),
(3, 14, 0),
(3, 15, 8),
(3, 16, 8),
(3, 17, 16),
(3, 18, 25),
(3, 19, 0),
(3, 20, 0),
(3, 21, 0),
(3, 22, 0),
(3, 23, 0),
(4, 1, 10),
(4, 2, 20),
(4, 3, 24),
(4, 4, 20),
(4, 5, 24),
(4, 6, 8),
(4, 7, 8),
(4, 8, 8),
(4, 9, 1),
(4, 10, 8),
(4, 11, 8),
(4, 12, 24),
(4, 13, 8),
(4, 14, 8),
(4, 15, 8),
(4, 16, 8),
(4, 17, 16),
(4, 18, 25),
(4, 19, 26),
(4, 20, 25),
(4, 21, 0),
(4, 22, 0),
(4, 23, 0),
(5, 1, 10),
(5, 2, 20),
(5, 3, 24),
(5, 4, 20),
(5, 5, 24),
(5, 6, 8),
(5, 7, 8),
(5, 8, 8),
(5, 9, 1),
(5, 10, 12),
(5, 11, 12),
(5, 12, 24),
(5, 13, 24),
(5, 14, 24),
(5, 15, 8),
(5, 16, 8),
(5, 17, 16),
(5, 18, 60),
(5, 19, 0),
(5, 20, 0),
(5, 21, 0),
(5, 22, 0),
(5, 23, 0),
(6, 1, 10),
(6, 2, 20),
(6, 3, 24),
(6, 4, 20),
(6, 5, 24),
(6, 6, 8),
(6, 7, 8),
(6, 8, 8),
(6, 9, 1),
(6, 10, 12),
(6, 11, 12),
(6, 12, 24),
(6, 13, 24),
(6, 14, 24),
(6, 15, 8),
(6, 16, 8),
(6, 17, 16),
(6, 18, 0),
(6, 19, 0),
(6, 20, 0),
(6, 21, 0),
(6, 22, 0),
(6, 23, 0),
(7, 1, 24),
(7, 2, 24),
(7, 3, 24),
(7, 4, 24),
(7, 5, 24),
(7, 6, 8),
(7, 7, 8),
(7, 8, 8),
(7, 9, 1),
(7, 10, 12),
(7, 11, 12),
(7, 12, 24),
(7, 13, 24),
(7, 14, 24),
(7, 15, 8),
(7, 16, 8),
(7, 17, 16),
(8, 1, 24),
(8, 2, 24),
(8, 3, 24),
(8, 4, 24),
(8, 5, 24),
(8, 6, 8),
(8, 7, 8),
(8, 8, 8),
(8, 9, 1),
(8, 10, 12),
(8, 11, 12),
(8, 12, 24),
(8, 13, 24),
(8, 14, 24),
(8, 15, 8),
(8, 16, 8),
(8, 17, 16),
(9, 1, 24),
(9, 2, 24),
(9, 3, 24),
(9, 4, 24),
(9, 5, 24),
(9, 6, 8),
(9, 7, 8),
(9, 8, 8),
(9, 9, 1),
(9, 10, 12),
(9, 11, 12),
(9, 12, 24),
(9, 13, 24),
(9, 14, 24),
(9, 15, 8),
(9, 16, 8),
(9, 17, 16),
(10, 1, 24),
(10, 2, 24),
(10, 3, 24),
(10, 4, 24),
(10, 5, 24),
(10, 6, 8),
(10, 7, 8),
(10, 8, 8),
(10, 9, 1),
(10, 10, 12),
(10, 11, 12),
(10, 12, 24),
(10, 13, 24),
(10, 14, 24),
(10, 15, 8),
(10, 16, 8),
(10, 17, 16),
(11, 1, 24),
(11, 2, 24),
(11, 3, 24),
(11, 4, 24),
(11, 5, 24),
(11, 6, 8),
(11, 7, 8),
(11, 8, 8),
(11, 9, 1),
(11, 10, 12),
(11, 11, 12),
(11, 12, 24),
(11, 13, 24),
(11, 14, 24),
(11, 15, 8),
(11, 16, 8),
(11, 17, 16),
(12, 1, 24),
(12, 2, 24),
(12, 3, 24),
(12, 4, 24),
(12, 5, 24),
(12, 6, 8),
(12, 7, 8),
(12, 8, 8),
(12, 9, 1),
(12, 10, 12),
(12, 11, 12),
(12, 12, 24),
(12, 13, 24),
(12, 14, 24),
(12, 15, 8),
(12, 16, 8),
(12, 17, 16),
(13, 1, 24),
(13, 2, 24),
(13, 3, 24),
(13, 4, 24),
(13, 5, 24),
(13, 6, 8),
(13, 7, 8),
(13, 8, 8),
(13, 9, 1),
(13, 10, 12),
(13, 11, 12),
(13, 12, 24),
(13, 13, 24),
(13, 14, 24),
(13, 15, 8),
(13, 16, 8),
(13, 17, 16),
(14, 1, 24),
(14, 2, 24),
(14, 3, 24),
(14, 4, 24),
(14, 5, 24),
(14, 6, 8),
(14, 7, 8),
(14, 8, 8),
(14, 9, 1),
(14, 10, 12),
(14, 11, 12),
(14, 12, 24),
(14, 13, 24),
(14, 14, 24),
(14, 15, 8),
(14, 16, 8),
(14, 17, 16),
(15, 1, 24),
(15, 2, 24),
(15, 3, 24),
(15, 4, 24),
(15, 5, 24),
(15, 6, 8),
(15, 7, 8),
(15, 8, 8),
(15, 9, 1),
(15, 10, 12),
(15, 11, 12),
(15, 12, 24),
(15, 13, 24),
(15, 14, 24),
(15, 15, 8),
(15, 16, 8),
(15, 17, 16),
(16, 1, 24),
(16, 2, 24),
(16, 3, 24),
(16, 4, 24),
(16, 5, 24),
(16, 6, 8),
(16, 7, 8),
(16, 8, 8),
(16, 9, 1),
(16, 10, 12),
(16, 11, 12),
(16, 12, 24),
(16, 13, 24),
(16, 14, 24),
(16, 15, 8),
(16, 16, 8),
(16, 17, 16);

-- --------------------------------------------------------

--
-- Table structure for table `epics`
--

CREATE TABLE `epics` (
  `e_id` int(11) NOT NULL,
  `e_title` varchar(30) NOT NULL,
  `e_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `epics`
--

INSERT INTO `epics` (`e_id`, `e_title`, `e_desc`) VALUES
(1, 'Evento R8', ''),
(2, 'Evetno R9', ''),
(3, 'PLP - Produkteplanung Lehre', ''),
(4, 'PLP - AD-Verwaltung', '');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `f_id` int(11) UNSIGNED NOT NULL,
  `f_title` varchar(55) NOT NULL,
  `f_desc` text NOT NULL,
  `f_storypoints` float(11,2) DEFAULT NULL,
  `f_topic_id` int(11) UNSIGNED NOT NULL,
  `f_PI` int(11) NOT NULL,
  `f_ranking` int(11) NOT NULL,
  `f_type` int(11) NOT NULL,
  `f_status_id` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `f_BV` enum('0','1','2','3','5','8','13','20','40','') NOT NULL,
  `f_TC` enum('0','1','2','3','5','8','13','20','40','') NOT NULL,
  `f_RROE` enum('0','1','2','3','5','8','13','20','40','') NOT NULL,
  `f_JS` enum('0','1','2','3','5','8','13','20','40','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`f_id`, `f_title`, `f_desc`, `f_storypoints`, `f_topic_id`, `f_PI`, `f_ranking`, `f_type`, `f_status_id`, `f_BV`, `f_TC`, `f_RROE`, `f_JS`) VALUES
(1, 'Evento R9.RC1', 'Evento R9.RC1 in Test eingespielt und getestet. Feedback an EFHG gegeben.', 9.00, 2, 2, 1, 1, 1, '1', '1', '3', '8'),
(2, 'Evento R9.RC21', 'Evento R9.RC1 in Test eingespielt und getestet. Feedback an EFHG gegeben.1', 8.00, 2, 2, 0, 2, 1, '1', '1', '1', '1'),
(4, 'Evento R8.Final', 'Evento R8.Final in Prod eingespielt.', 13.00, 2, 4, 0, 1, 1, '0', '0', '0', '0'),
(16, 'müssen', 'Trage dies am Donnerstag, 20.02.2020 ein, werden wir wohl im PIP 4 machen müssen', 25.50, 7, 4, 0, 8, 1, '13', '3', '2', '5'),
(19, 'Evento Export - ZHAW Connect', '..', 1.00, 1, 3, 8, 1, 1, '0', '0', '0', '0'),
(20, 'Untis Abgleich', '...', 0.00, 1, 4, 1, 1, 1, '0', '0', '0', '0'),
(21, '2-Weg-Auth Feedback Pentest', '...', 99.00, 1, 4, 2, 1, 1, '0', '0', '0', '0'),
(22, 'Optimierung Usability', '...', 0.00, 1, 4, 3, 1, 1, '0', '0', '0', '0'),
(23, 'AD Personenverwaltung finalisieren Teil 2', '...', 0.00, 1, 4, 4, 1, 1, '0', '0', '0', '0'),
(24, 'AD-Verwaltung Admin', '...', 0.00, 1, 4, 5, 1, 1, '0', '0', '0', '0'),
(25, '1', '1', 1.00, 5, 0, 1, 2, 1, '0', '0', '0', '0'),
(26, '2', '2', 2.00, 5, 0, 2, 1, 1, '0', '0', '0', '0'),
(27, '3', '3', 3.00, 5, 0, 3, 2, 1, '0', '0', '0', '0'),
(35, 'Analyse Exporte', '', 6.00, 1, 3, 0, 1, 1, '0', '0', '0', '0'),
(36, 'SWAP: Export Untis Testing', '0.5 Storypoint', 1.00, 1, 3, 1, 1, 1, '0', '0', '0', '0'),
(37, 'SWAP Export Budgetgrundlage', '', 5.00, 1, 3, 2, 1, 1, '0', '0', '0', '0'),
(38, 'Optimierung Benutzerfreundl. und effiz. Arbeiten', '', 5.00, 1, 3, 3, 1, 1, '0', '0', '0', '0'),
(39, 'SWAP Export Verteilerschl&#65533;ssel', 'Muss ich noch was kl&#65533;en. Trage dies am Donnerstag, 20.02.2020 ein, werden wir wohl im PIP 4 machen müssen', 0.00, 1, 3, 4, 1, 1, '0', '0', '0', '0'),
(40, 'SWAP Export ILVS', '', 16.00, 1, 3, 5, 1, 1, '0', '0', '0', '0'),
(41, 'AD-Personenverwaltung finalisieren Teil 1', 'Da werden es ca 7 SP werden, je nach dem was noch für BUGs kommen.', 7.00, 1, 3, 6, 1, 1, '0', '0', '0', '0'),
(42, 'Know-How Transfer', '', 3.00, 1, 3, 7, 1, 1, '0', '0', '0', '0'),
(43, 'Untis Nacharbeiten', 'Noch keine Schätzung, da noch unklar, was noch kommt', 1.00, 1, 3, 9, 1, 1, '0', '0', '0', '0'),
(44, 'SWAP Export Evento', '', 17.00, 1, 4, 0, 1, 1, '0', '0', '0', '0'),
(45, 'Anpassung onboarding Dept P', '', 20.00, 1, 5, 0, 1, 1, '0', '0', '0', '0'),
(46, 'Optimierung Usability', '', 20.00, 1, 5, 1, 1, 1, '0', '0', '0', '0'),
(47, 'Workflow bei AD-Leistungen implementieren', '', 20.00, 1, 5, 2, 1, 1, '0', '0', '0', '0'),
(48, 'AD-Leistung', '', 20.00, 1, 5, 3, 1, 1, '0', '0', '0', '0'),
(49, 'AD-Auftrag', '', 40.00, 1, 6, 0, 1, 1, '0', '0', '0', '0'),
(50, 'AD-Auszahlung', '', 40.00, 1, 6, 1, 1, 1, '0', '0', '0', '0'),
(51, 'IN2002-2545 Diploma Supplement Anpassungen', '', 0.00, 2, 0, 0, 1, 1, '0', '0', '0', '0'),
(53, 'Infrastructure as a Code', '', 13.00, 1, 0, 0, 1, 1, '0', '2', '2', '2'),
(57, 'BFS Snapshot ', '', 0.00, 2, 3, 0, 1, 1, '0', '0', '0', '0'),
(58, 'Evento Rechnungslauf / RMV Abwicklung Nachfrist', '', 0.00, 2, 3, 1, 1, 1, '0', '0', '0', '0'),
(59, 'Event R8 – Testlauf (mit der finalen Version)', '', 0.00, 2, 3, 2, 1, 1, '0', '0', '0', '0'),
(60, 'IN1710-2688 LWB RfC Hinterlegung', '(Hinterlegung elektronischer Unterschrift)', 0.00, 2, 0, 1, 1, 1, '0', '0', '0', '0'),
(61, 'ONLA / RMV Zweisprachigkeit Faktura & Semesterbest.', '', 0.00, 2, 0, 2, 1, 1, '0', '0', '0', '0'),
(62, 'Evento R9.Beta01', 'Evento R9.Beta01 ist eingespielt in Test, getestet und Feedbacks sind ans EFHG abgegeben worden.\r\nAuslieferung am: Fr 29.05.20', 0.00, 2, 4, 1, 1, 1, '0', '0', '0', '0'),
(63, 'Evento R9.Beta02', 'Evento R9.Beta02 ist eingespielt in Test, getestet und Feedbacks sind ans EFHG abgegeben worden. \r\nAuslierferung am Fr 03.07.20', 0.00, 2, 5, 0, 1, 1, '0', '0', '0', '0'),
(64, 'Evento R9.RC01', 'Evento R9.RC01 ist eingespielt in Test, getestet und Feedbacks sind ans EFHG abgegeben worden.\r\nAuslieferung Fr 31.07.20', 0.00, 2, 5, 1, 1, 1, '0', '0', '0', '0'),
(65, 'Evento R9.Final', 'Evento R9.Final ist eingespielt in Test, getestet und Feedbacks sind ans EFHG abgegeben worden.\r\nAuslieferung: Fr 29.08.20 ', 50.00, 2, 6, 0, 1, 1, '0', '0', '0', '0'),
(66, 'Evento R9 - EFHG-Barrierefreiheit-Test', '', 0.00, 2, 5, 2, 1, 1, '0', '0', '0', '0'),
(67, 'Evento R9 - EFHG-PenTest', '', 0.00, 2, 5, 3, 1, 1, '0', '0', '0', '0'),
(68, 'Feature Request Felder hinzufügen.', 'Die Feature Felder gemäss Vorlage hinzufügen.', 2.00, 9, 3, 1, 1, 1, '0', '0', '0', '0'),
(69, 'File Upload', 'File hinauf laden können.', 2.00, 9, 4, 1, 1, 1, '0', '0', '0', '0'),
(71, 'Comment-Field', 'Neues Feld (Textarea) unter Tab Allgemein', 1.00, 9, 4, 2, 1, 1, '0', '0', '0', '0'),
(72, 'User Management', 'User: login (4-chars; password)\r\npro user: kann/kann nicht roadmap editieren\r\nkein gui mgmt für user\r\nLogin Funktionallität inkl. logout)\r\n', 10.00, 9, 0, 0, 1, 1, '0', '0', '0', '0'),
(73, 'Statusmodell einführen', '', 1.00, 9, 3, 3, 1, 1, '0', '0', '0', '0'),
(74, 'Karte Feature drucken können', '', 2.00, 9, 4, 0, 1, 1, '0', '0', '0', '0'),
(75, 'Online Formulare Feature Requests für Kunden anbieten', '', 10.00, 9, 0, 1, 1, 1, '0', '0', '0', '0'),
(76, 'Feld für Link (z.B. Confluence) hinzufügen', '', 1.00, 9, 3, 2, 1, 1, '0', '0', '0', '0'),
(77, 'Umlaut Problem lösen', '', 1.00, 9, 3, 0, 1, 1, '0', '0', '0', '0'),
(78, 'Feature-Request Formular ausgefüllt ausdrucken k', 'Das Formular Feature Request soll mit den Angaben aus dem System ausgedruckt werden können. [kisf]', 10.00, 9, 0, 3, 1, 1, '0', '1', '3', '13'),
(79, 'SM 4.0: Version ABC in Prod einspielen', '', 10.00, 4, 0, 1, 1, 1, '0', '0', '0', '0'),
(80, 'Epics', 'Epics: title, Beschreibung, topic-zuweisung\r\nauf Feature Epic zuweisbar unter Tab allgemein\r\nKein GUI für Epic Mgmt', 2.00, 9, 0, 2, 1, 1, '0', '0', '0', '0'),
(81, 'Kommentarfunktionalit&#65533;t', 'chat\r\n@ soll möglich sein (\r\njeder User kann kommentare hinzufügen', 10.00, 9, 0, 4, 1, 1, '0', '0', '0', '0'),
(88, 'Enim deserunt repreh', 'Aliquid in ut anim q', 0.00, 7, 6, 0, 5, 1, '0', '0', '0', '0'),
(90, '+ 1 PI mehr anzeigen', '', 0.00, 9, 0, 5, 1, 1, '0', '0', '0', '0'),
(91, 'Epic Roadmap', '', 0.00, 9, 0, 6, 1, 1, '0', '0', '0', '0'),
(94, 'äöü', 'dfdsü', 123.00, 7, 5, 0, 7, 1, '0', '0', '0', '0'),
(95, 'Consequat Cumque qu', 'Ratione numquam nequ', 22.00, 7, 0, 0, 1, 3, '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `featuretypes`
--

CREATE TABLE `featuretypes` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `highlight_color` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `featuretypes`
--

INSERT INTO `featuretypes` (`id`, `name`, `highlight_color`) VALUES
(1, 'Feature', '#F7DC6F'),
(2, 'Enabler', '#00ff00'),
(3, 'UserStory', '#F9E79F'),
(5, 'Exploration/Spike', '#2ECC71'),
(6, 'Maintenance', '#2980B9'),
(7, 'Refacotring', '#85C1E9'),
(8, 'Rucksack', '#C39BD3');

-- --------------------------------------------------------

--
-- Table structure for table `feature_details`
--

CREATE TABLE `feature_details` (
  `id` int(11) UNSIGNED NOT NULL,
  `f_id` int(11) UNSIGNED NOT NULL,
  `f_note` text,
  `f_benefit` text,
  `f_dependencies` text,
  `f_acceptance_criteria` text,
  `f_SME` text,
  `f_due_date` date DEFAULT NULL,
  `f_responsible` int(11) UNSIGNED DEFAULT NULL,
  `f_mehr_details` text,
  `f_epic` int(11) NOT NULL,
  `f_context` text,
  `f_problemdessc` text,
  `f_currentstate` text,
  `f_targetstate` text,
  `f_inscope` text,
  `f_outofscope` text,
  `f_risks` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feature_details`
--

INSERT INTO `feature_details` (`id`, `f_id`, `f_note`, `f_benefit`, `f_dependencies`, `f_acceptance_criteria`, `f_SME`, `f_due_date`, `f_responsible`, `f_mehr_details`, `f_epic`, `f_context`, `f_problemdessc`, `f_currentstate`, `f_targetstate`, `f_inscope`, `f_outofscope`, `f_risks`) VALUES
(2, 16, 'sadsadsada', '', '', '', '', '2020-02-28', 19, 'https://fontawesome.com/', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 88, 'Nesciunt ipsam volu', '', '', '', '', '2020-02-24', 18, '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 35, '', '', '', '', '', '2020-02-24', 1, 'https://www.wuermli.com', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 73, '', '', '', '', '', '2020-02-24', NULL, '', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 77, '', '', '', '', '', '2020-02-24', NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 68, '', '', '', '', '', '2020-02-24', NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 62, '', '', '', '', '', '2020-02-24', 6, '', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 90, '', '', '', '', '', '2020-02-24', NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 91, '', '', '', '', '', '2020-02-24', NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 94, '', '', '', '', '', '2020-02-25', 18, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 65, '', '', '', '', '', '2020-02-25', 6, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 79, '', '', '', '', '', '2020-02-25', 13, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 95, 'Qui sunt tempore el', '', '', '', '', '2020-02-25', 18, 'https://pm.mastaz.ch/roadmap.php?topic=7', 3, 'Ducimus cillum volu', 'Quod provident dolo', 'Voluptate voluptatem', 'Reiciendis aut ut al', 'Sint velit quibusda', 'Culpa ex praesentiu', 'Amet ea dolorem vel');

-- --------------------------------------------------------

--
-- Table structure for table `feature_files`
--

CREATE TABLE `feature_files` (
  `id` int(11) NOT NULL,
  `f_id` int(11) NOT NULL,
  `f_filename` varchar(255) CHARACTER SET utf8 NOT NULL,
  `f_fileurl` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feature_files`
--

INSERT INTO `feature_files` (`id`, `f_id`, `f_filename`, `f_fileurl`) VALUES
(4, 73, 'IMG_4663_24022020173943.JPG', 'https://pm.mastaz.ch/upload/IMG_4663_24022020173943.JPG'),
(6, 68, 'Feature Formular School Management v1_24022020174137.docx', 'https://pm.mastaz.ch/upload/Feature Formular School Management v1_24022020174137.docx'),
(7, 16, 'download_25022020051521.jpg', 'https://pm.mastaz.ch/upload/download_25022020051521.jpg'),
(8, 16, 'maxresdefault_25022020051521.jpg', 'https://pm.mastaz.ch/upload/maxresdefault_25022020051521.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `feature_statuses`
--

CREATE TABLE `feature_statuses` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feature_statuses`
--

INSERT INTO `feature_statuses` (`id`, `name`) VALUES
(1, 'Planned'),
(2, 'Doing'),
(3, 'Done'),
(4, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `help_text`
--

CREATE TABLE `help_text` (
  `id` int(11) NOT NULL,
  `field_name` varchar(50) NOT NULL,
  `tooltip` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `help_text`
--

INSERT INTO `help_text` (`id`, `field_name`, `tooltip`) VALUES
(1, 'f_dependencies', 'Planungshorizonte), organisatorische (Ressorts, Departmente, Abteilungen, Personen, externe Dienstleister) oder technische (Systeme, Schnittstellen) Abhängigkeiten'),
(2, 'f_inscope', 'Bezogen auf die Leistungen der ICT: Abgrenzung von ausdrücklich erwarteten Leistungen (In Scope) und ausdrücklich nicht erwarteten Leistungen (Out of Scope)'),
(3, 'f_benefit', 'konkrete Nutzen wird von der Umsetzung des Features bewirkt bzw. erhofft?\r\nWer hat diesen Nutzen?\r\nQuantifizierung des Nutzens (Anzahl betroffene Personen, Zeitersparnis bei Prozessen, etc.)\r\nAlternative Fragestellung: Was ist bei Nicht-Umsetzung des Features zu erwarten?');

-- --------------------------------------------------------

--
-- Table structure for table `productincrements`
--

CREATE TABLE `productincrements` (
  `pi_id` int(11) NOT NULL,
  `pi_title` varchar(20) NOT NULL,
  `pi_start` date NOT NULL,
  `pi_end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productincrements`
--

INSERT INTO `productincrements` (`pi_id`, `pi_title`, `pi_start`, `pi_end`) VALUES
(1, 'PI 1', '2019-09-16', '2019-11-24'),
(2, 'PI 2', '2019-11-25', '2020-02-02'),
(3, 'PI 3', '2020-02-03', '2020-04-12'),
(4, 'PI 4', '2020-04-13', '2020-06-21'),
(5, 'PI 5', '2020-06-22', '2020-08-30'),
(6, 'PI 6', '2020-08-31', '2020-11-08'),
(7, 'PI 7', '2020-11-09', '2021-01-17'),
(8, 'PI 8', '2021-01-18', '2021-03-28'),
(9, 'PI 9', '2021-03-29', '2021-06-06'),
(10, 'PI 10', '2021-06-07', '2021-08-15'),
(11, 'PI 11', '2021-08-16', '2021-10-24'),
(12, 'PI 12', '2021-10-25', '2022-01-02'),
(13, 'PI 13', '2022-01-03', '2022-03-13'),
(14, 'PI 14', '2022-03-14', '2022-05-22'),
(15, 'PI 15', '2022-05-23', '2022-07-31'),
(16, 'PI 16', '2022-08-01', '2022-10-09');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) UNSIGNED NOT NULL,
  `staff_firstname` varchar(20) NOT NULL,
  `staff_lastname` varchar(20) NOT NULL,
  `staff_team` varchar(25) NOT NULL,
  `staff_topic_id` int(11) UNSIGNED NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `can_edit_roadmap` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_firstname`, `staff_lastname`, `staff_team`, `staff_topic_id`, `email`, `username`, `password`, `can_edit_roadmap`) VALUES
(1, 'Rapahel', 'Wüest', 'School Administration', 1, NULL, 'test', 'ceb6c970658f31504a901b89dcd3e461', '1'),
(2, 'Robert', 'Schindele', 'School Administration', 1, NULL, NULL, NULL, '0'),
(3, 'Mira', 'Nedeczey', 'School Administration', 1, NULL, NULL, NULL, '0'),
(4, 'Fabian', 'De Vries', 'School Administration', 1, NULL, NULL, NULL, '0'),
(5, 'Raphael', 'Bolliger', 'School Administration', 1, NULL, NULL, NULL, '0'),
(6, 'Anja', 'Wolfer Baka', 'School Administration', 2, NULL, NULL, NULL, '0'),
(7, 'Dalibor', 'Wanner', 'School Administration', 2, NULL, NULL, NULL, '0'),
(8, 'Peter', 'Gallmann', 'School Administration', 2, NULL, NULL, NULL, '0'),
(9, 'Andrea', 'Gasser', 'School Administration', 2, NULL, NULL, NULL, '0'),
(10, 'Orhan', 'Teke', 'School Administration', 2, NULL, NULL, NULL, '0'),
(11, 'Anil ', 'Ugras', 'School Administration', 2, NULL, NULL, NULL, '0'),
(12, 'Stefan', 'Rudolf', 'School Administration', 3, NULL, NULL, NULL, '0'),
(13, 'Christoph', 'Bieri', 'School Management', 4, NULL, NULL, NULL, '0'),
(14, 'Marita ', 'Salz', 'School Management', 4, NULL, NULL, NULL, '0'),
(15, 'Martin', 'Wiesendanger', 'School Management', 4, NULL, NULL, NULL, '0'),
(16, 'Stefan', 'Ernst', 'School Management', 4, NULL, NULL, NULL, '0'),
(17, 'Patrik', 'Buenter', 'School Management', 5, NULL, NULL, NULL, '0'),
(18, 'Rapahel', 'Wüest', 'School Administration', 7, NULL, NULL, NULL, '0'),
(19, 'Robert', 'Schindele', 'School Administration', 7, NULL, NULL, NULL, '0'),
(20, 'Mira', 'Nedeczey', 'School Administration', 7, NULL, NULL, NULL, '0'),
(21, 'Fabian', 'De Vries', 'School Administration', 7, NULL, NULL, NULL, '0'),
(22, 'Raphael', 'Bolliger', 'School Administration', 7, NULL, NULL, NULL, '0'),
(23, 'Anja', 'Wolfer Baka', 'School Administration', 7, NULL, NULL, NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `name`) VALUES
(1, 'PLP'),
(2, 'evento'),
(3, 'PM SA'),
(4, 'PM SM'),
(5, 'FM'),
(7, 'test'),
(9, 'PM-Tool');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `capacities`
--
ALTER TABLE `capacities`
  ADD UNIQUE KEY `pi_staff` (`pi_id`,`staff_id`);

--
-- Indexes for table `epics`
--
ALTER TABLE `epics`
  ADD PRIMARY KEY (`e_id`),
  ADD UNIQUE KEY `e_id` (`e_id`,`e_title`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `f_status_id` (`f_status_id`);

--
-- Indexes for table `featuretypes`
--
ALTER TABLE `featuretypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feature_details`
--
ALTER TABLE `feature_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `f_id` (`f_id`),
  ADD KEY `f_responsible` (`f_responsible`);

--
-- Indexes for table `feature_files`
--
ALTER TABLE `feature_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feature_statuses`
--
ALTER TABLE `feature_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `help_text`
--
ALTER TABLE `help_text`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productincrements`
--
ALTER TABLE `productincrements`
  ADD PRIMARY KEY (`pi_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `epics`
--
ALTER TABLE `epics`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `f_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `featuretypes`
--
ALTER TABLE `featuretypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `feature_details`
--
ALTER TABLE `feature_details`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `feature_files`
--
ALTER TABLE `feature_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `feature_statuses`
--
ALTER TABLE `feature_statuses`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `help_text`
--
ALTER TABLE `help_text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `productincrements`
--
ALTER TABLE `productincrements`
  MODIFY `pi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `features`
--
ALTER TABLE `features`
  ADD CONSTRAINT `features_ibfk_1` FOREIGN KEY (`f_status_id`) REFERENCES `feature_statuses` (`id`);

--
-- Constraints for table `feature_details`
--
ALTER TABLE `feature_details`
  ADD CONSTRAINT `feature_details_ibfk_1` FOREIGN KEY (`f_id`) REFERENCES `features` (`f_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `feature_details_ibfk_2` FOREIGN KEY (`f_responsible`) REFERENCES `staff` (`staff_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

