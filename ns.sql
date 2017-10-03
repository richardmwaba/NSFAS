-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 12, 2017 at 06:20 PM
-- Server version: 5.5.54-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ns`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_levels`
--

CREATE TABLE IF NOT EXISTS `access_levels` (
  `level_id` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `levelName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`level_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `access_levels`
--

INSERT INTO `access_levels` (`level_id`, `levelName`) VALUES
('AC', 'Accountant'),
('DN', 'Dean of School'),
('HD', 'Head of Department'),
('OT', 'Other'),
('PO', 'Purchasing Officer'),
('SA', 'System Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `accountName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `projects_id` int(11) DEFAULT NULL,
  `budget_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `accounts_accountname_unique` (`accountName`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `user_id`, `accountName`, `projects_id`, `budget_id`, `school_id`, `created_at`, `updated_at`) VALUES
(18, 1111, 'The school of Natural Sciences main account', NULL, NULL, 8, '2017-03-16 09:20:55', '2017-03-16 09:20:55'),
(19, 1111, 'The department of Biological Sciences main account', NULL, NULL, 8, '2017-03-16 09:21:14', '2017-03-16 09:21:14'),
(20, 1111, 'The department of Chemistry main account', NULL, NULL, 8, '2017-03-16 09:21:21', '2017-03-16 09:21:21'),
(21, 1111, 'The department of Computer Science main account', NULL, NULL, 8, '2017-03-16 09:21:26', '2017-03-16 09:21:26'),
(22, 1111, 'The department of Geography main account', NULL, NULL, 8, '2017-03-16 09:21:32', '2017-03-16 09:21:32'),
(23, 1111, 'The department of Physics main account', NULL, NULL, 8, '2017-03-16 09:21:40', '2017-03-16 09:21:40'),
(24, 1111, 'The department of Mathematics and Statistics main account', NULL, NULL, 8, '2017-03-16 09:21:45', '2017-03-16 09:21:45'),
(25, 0, 'Huawei training', 4, NULL, NULL, '2017-03-28 11:16:00', '2017-03-28 11:16:00');

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE IF NOT EXISTS `activities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `objectives_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `strategic_directions_id` int(11) DEFAULT NULL,
  `activityName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `belongsToActualBudget` tinyint(1) NOT NULL,
  `indicatorOfSuccess` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `targetOfIndicator` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `baselineOfIndicator` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sourceOfFunding` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `staffResponsible` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `percentageAchieved` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstQuarter` tinyint(1) NOT NULL,
  `secondQuarter` tinyint(1) NOT NULL,
  `thirdQuarter` tinyint(1) NOT NULL,
  `fourthQuarter` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `objectives_id`, `department_id`, `school_id`, `strategic_directions_id`, `activityName`, `belongsToActualBudget`, `indicatorOfSuccess`, `targetOfIndicator`, `baselineOfIndicator`, `sourceOfFunding`, `staffResponsible`, `percentageAchieved`, `firstQuarter`, `secondQuarter`, `thirdQuarter`, `fourthQuarter`, `created_at`, `updated_at`) VALUES
(2, 3, 3, 8, 2, '1.1.1 Working on the curriculum for the New and Postgraduate Program, Bachelors Program, Diploma Program and Certificate in Computing', 1, 'New Curriculum Approved', '2 Certificate Programs', 'i)Prepare draft proposals for presentation to the School Board and Senate for Approval of the Programmes', '50% School allocation and 50% Departmental Projects such as the Cisco Programme', 'HoD', '90', 1, 1, 0, 0, '2017-03-16 06:55:29', '2017-03-16 09:23:42'),
(3, 3, 3, 8, 2, '1.1.2 Working on the New Courses and allocating them according to the degrees programs.', 0, 'Number of Courses and Computing (PG, UG, Diploma and Certificate) Programmes Introduced', '6 New Degree Programmes (PG and UG) and 2 Diploma Programmes', 'i) Holding meetings, seminars, Workshop, consultations and presentation on the new courses ii) Get new books for new courses and propose new Degree Structure ', 'School Allocation', 'HOD/ LECTURES', '85% and 95%', 1, 1, 0, 0, '2017-03-16 06:59:50', '2017-03-16 06:59:50'),
(4, 8, 1, 8, 3, 'Any', 1, 'Any', 'Any', 'Any', 'Any', 'Any', 'v', 1, 1, 0, 0, '2017-03-16 18:02:28', '2017-03-16 18:10:51'),
(5, 3, 3, 8, 2, 'Training students with huawei networking devices', 1, 'Succeful completion of the offered courses with not less than merits', 'Perfomance', 'Completion', 'Huwaei', 'Richard, Clayton', '20', 1, 0, 0, 0, '2017-03-28 12:14:23', '2017-06-02 07:53:25');

-- --------------------------------------------------------

--
-- Table structure for table `budgets`
--

CREATE TABLE IF NOT EXISTS `budgets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `budgetName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `schoolIncome` int(11) DEFAULT NULL,
  `departmentIncome` int(11) DEFAULT NULL,
  `netProjectBudget` double(8,2) DEFAULT NULL,
  `departmentAmount` double(8,2) DEFAULT NULL,
  `unzaAmount` double(8,2) DEFAULT NULL,
  `actualProjectBudget` double(8,2) DEFAULT NULL,
  `approved` tinyint(1) NOT NULL,
  `isDepartmentBudget` tinyint(1) NOT NULL,
  `projects_id` int(11) DEFAULT NULL,
  `departments_id` int(11) DEFAULT NULL,
  `accounts_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `budgets`
--

INSERT INTO `budgets` (`id`, `budgetName`, `schoolIncome`, `departmentIncome`, `netProjectBudget`, `departmentAmount`, `unzaAmount`, `actualProjectBudget`, `approved`, `isDepartmentBudget`, `projects_id`, `departments_id`, `accounts_id`, `created_at`, `updated_at`) VALUES
(16, 'The department of Biological Sciences Budget', 9000000, 1500000, NULL, NULL, NULL, NULL, 0, 0, NULL, 1, 19, '2017-03-16 09:21:14', '2017-03-16 09:22:27'),
(17, 'The department of Chemistry Budget', 9000000, 1500000, NULL, NULL, NULL, NULL, 0, 0, NULL, 2, 20, '2017-03-16 09:21:21', '2017-03-16 09:22:27'),
(18, 'The department of Computer Science Budget', 9000000, 1500000, NULL, NULL, NULL, NULL, 0, 0, NULL, 3, 21, '2017-03-16 09:21:26', '2017-03-16 09:22:27'),
(19, 'The department of Geography Budget', 9000000, 1500000, NULL, NULL, NULL, NULL, 0, 0, NULL, 4, 22, '2017-03-16 09:21:32', '2017-03-16 09:22:27'),
(20, 'The department of Physics Budget', 9000000, 1500000, NULL, NULL, NULL, NULL, 0, 0, NULL, 5, 23, '2017-03-16 09:21:40', '2017-03-16 09:22:27'),
(21, 'The department of Mathematics and Statistics Budget', 9000000, 1500000, NULL, NULL, NULL, NULL, 0, 0, NULL, 6, 24, '2017-03-16 09:21:45', '2017-03-16 09:22:27'),
(22, 'Huawei training', NULL, NULL, 20000.00, 14000.00, 6000.00, 20000.00, 0, 0, 4, 3, NULL, '2017-03-28 11:16:00', '2017-03-28 11:16:00');

-- --------------------------------------------------------

--
-- Table structure for table `budget_items`
--

CREATE TABLE IF NOT EXISTS `budget_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `budgetLine` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `pricePerUnit` double(8,2) DEFAULT NULL,
  `cost` double(8,2) NOT NULL,
  `budget_id` int(11) NOT NULL,
  `activities_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `budget_items`
--

INSERT INTO `budget_items` (`id`, `budgetLine`, `description`, `quantity`, `pricePerUnit`, `cost`, `budget_id`, `activities_id`, `created_at`, `updated_at`) VALUES
(9, 'The department of Computer Science Budget', 'Meetings, seminars, workshops and presentations', 12, 12000.00, 144000.00, 18, 2, '2017-03-16 09:23:42', '2017-03-16 09:23:42'),
(10, 'The department of Biological Sciences Budget', 'Any', 10, 4500.00, 45000.00, 16, 4, '2017-03-16 18:10:51', '2017-03-16 18:10:51'),
(11, 'The department of Computer Science Budget', 'Precaricurar acativies', 50, 100.00, 5000.00, 18, 5, '2017-06-02 07:53:25', '2017-06-02 07:53:25');

-- --------------------------------------------------------

--
-- Table structure for table `calculated_totals`
--

CREATE TABLE IF NOT EXISTS `calculated_totals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `incomeAcquired` int(11) DEFAULT NULL,
  `proposedBudget` int(11) DEFAULT NULL,
  `expenditureAcquired` int(11) DEFAULT NULL,
  `projects_id` int(11) DEFAULT NULL,
  `accounts_id` int(11) DEFAULT NULL,
  `budget_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;

--
-- Dumping data for table `calculated_totals`
--

INSERT INTO `calculated_totals` (`id`, `incomeAcquired`, `proposedBudget`, `expenditureAcquired`, `projects_id`, `accounts_id`, `budget_id`, `created_at`, `updated_at`) VALUES
(20, NULL, NULL, NULL, NULL, 9, NULL, '2017-03-16 08:26:47', '2017-03-16 08:26:47'),
(21, 9000000, NULL, NULL, NULL, 18, NULL, '2017-03-16 09:20:55', '2017-03-16 09:22:27'),
(22, 1500000, NULL, NULL, NULL, 19, NULL, '2017-03-16 09:21:14', '2017-03-16 09:22:27'),
(23, 1500000, NULL, NULL, NULL, 20, NULL, '2017-03-16 09:21:21', '2017-03-16 09:22:27'),
(24, 1500000, NULL, NULL, NULL, 21, NULL, '2017-03-16 09:21:26', '2017-03-16 09:22:27'),
(25, 1500000, NULL, NULL, NULL, 22, NULL, '2017-03-16 09:21:32', '2017-03-16 09:22:27'),
(26, 1500000, NULL, NULL, NULL, 23, NULL, '2017-03-16 09:21:40', '2017-03-16 09:22:27'),
(27, 1530000, NULL, NULL, NULL, 24, NULL, '2017-03-16 09:21:45', '2017-03-23 10:38:33'),
(28, NULL, NULL, NULL, 4, NULL, NULL, '2017-03-28 11:18:07', '2017-03-28 11:18:07'),
(29, NULL, NULL, NULL, NULL, 25, NULL, '2017-03-28 11:22:04', '2017-03-28 11:22:04');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `departmentName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `schools_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `departments_id_unique` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=63 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `departmentName`, `schools_id`) VALUES
(1, 'Agriculture Economics', 1),
(2, 'Animal Science', 1),
(3, 'Food Science & Nutrition', 1),
(4, 'Plant Science', 1),
(5, 'Soil Science', 1),
(6, 'Adult Education & Extension Studies', 2),
(7, 'Advisory Units for Colleges of Education', 2),
(8, 'Education Administration & Policy Studies', 2),
(9, 'Educational Psychology, Sociology & Special Education', 2),
(10, 'Library Information Studies', 2),
(11, 'Language & Social Sciences', 2),
(12, 'Mathematics & Science Education', 2),
(13, 'Primary Education', 2),
(14, 'Religious Studies', 2),
(15, 'Agricultural Engineering', 3),
(16, 'Civil & Environmental Engineering', 3),
(17, 'Electrical & Electronic Engineering', 3),
(18, 'Mechanical Engineering', 3),
(19, 'Geomatic Engineering', 3),
(20, 'Development Studies', 4),
(21, 'Economics', 4),
(22, 'History', 4),
(23, 'Political & Administrative Studies', 4),
(24, 'Population Studies', 4),
(25, 'Psychology', 4),
(26, 'Philosophy & Applied Ethics', 4),
(27, 'Mass Communication', 4),
(28, 'Literature & Language', 4),
(29, 'Gender Studies', 4),
(30, 'Social Development Studies', 4),
(31, 'Public Law', 5),
(32, 'Private Law', 5),
(33, 'Geology', 7),
(34, 'Mines Engineering', 7),
(35, 'Metallurgy & Material Processing', 7),
(36, 'Specialized Units', 7),
(37, 'Anatomy', 6),
(38, 'Biomedical Sciences', 6),
(39, 'Physiological Sciences', 6),
(40, 'Nursing Sciences', 6),
(41, 'Medical Education Development', 6),
(42, 'Obstetrics & Gynaecology', 6),
(43, 'Paediatrics & Child Health', 6),
(44, 'Pathology & Microbiology', 6),
(45, 'Pharmacy', 6),
(46, 'Physiotherapy', 6),
(47, 'Psychiatry', 6),
(48, 'Public Health', 6),
(49, 'Surgery', 6),
(50, 'Internal Medicine', 6),
(51, 'Biological Sciences', 8),
(52, 'Chemistry', 8),
(53, 'Computer Science', 8),
(54, 'Geography', 8),
(55, 'Mathematics & Statistics', 8),
(56, 'Physics', 8),
(57, 'Biomedical Studies', 9),
(58, 'Clinical Studies', 9),
(60, 'Disease Control', 9),
(61, 'Para-Clinical Studies', 9),
(62, 'Central Services & Supply', 9);

-- --------------------------------------------------------

--
-- Table structure for table `estimates`
--

CREATE TABLE IF NOT EXISTS `estimates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `activities_id` int(11) NOT NULL,
  `itemDescription` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pricePerUnit` double(8,2) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `cost` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `estimates`
--

INSERT INTO `estimates` (`id`, `department_id`, `activities_id`, `itemDescription`, `pricePerUnit`, `quantity`, `cost`, `created_at`, `updated_at`) VALUES
(2, 53, 2, 'Meetings, seminars, workshops and presentations', 12000.00, 12, 144000.00, '2017-03-16 06:55:29', '2017-03-16 06:55:29'),
(3, 53, 3, 'Meetings, Seminars, Workshops and Presentations and Books', 12000.00, 12, 144000.00, '2017-03-16 06:59:50', '2017-03-16 06:59:50'),
(4, 51, 4, 'Any', 4500.00, 10, 45000.00, '2017-03-16 18:02:28', '2017-03-16 18:02:28'),
(5, 53, 5, 'Precaricurar acativies', 100.00, 50, 5000.00, '2017-03-28 12:14:23', '2017-06-02 07:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `expenditures`
--

CREATE TABLE IF NOT EXISTS `expenditures` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `amountPaid` int(11) NOT NULL,
  `budgetLine` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `beneficiary` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `purpose` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `voucherNumber` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datePaid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `approvedByHOD` tinyint(1) NOT NULL,
  `approvedByACC` tinyint(1) NOT NULL,
  `approvedByDN` tinyint(1) NOT NULL,
  `accounts_id` int(11) NOT NULL,
  `projects_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `imprestRetirements`
--

CREATE TABLE IF NOT EXISTS `imprestRetirements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `imprestId` int(11) NOT NULL,
  `chequeNo` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `dateOfReturn` date DEFAULT NULL,
  `departedFrom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departureDate` date DEFAULT NULL,
  `arrivedAt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `noOfNights` int(11) DEFAULT NULL,
  `ratePerNight` int(11) DEFAULT NULL,
  `subAmount` double DEFAULT NULL,
  `fuelAmount` double DEFAULT NULL,
  `item1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item1Amount` double DEFAULT NULL,
  `item2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item2Amount` double DEFAULT NULL,
  `item3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item3Amount` double DEFAULT NULL,
  `other` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `otherAmount` double DEFAULT NULL,
  `receiptNumber` int(11) DEFAULT NULL,
  `amountRecoverable` double DEFAULT '0',
  `bursarComment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deanOrHeadComment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bursarApproval` smallint(6) DEFAULT '0',
  `bursarManNumber` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateOfBursarApproval` date DEFAULT NULL,
  `internalAuditApproval` smallint(6) DEFAULT '0',
  `dateOfInternalAuditApproval` date DEFAULT NULL,
  `deanOrHeadApproval` smallint(6) DEFAULT '0',
  `deanOrHeadManNumber` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateOfDeanOrHeadApproval` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `imprests`
--

CREATE TABLE IF NOT EXISTS `imprests` (
  `imprestId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `applicantId` int(11) DEFAULT NULL,
  `departmentId` int(11) NOT NULL,
  `amountRequested` double NOT NULL,
  `purpose` int(11) DEFAULT NULL,
  `budgetLine` int(11) DEFAULT NULL,
  `authorisedByHead` int(11) NOT NULL DEFAULT '0',
  `authorisedByHeadOn` date NOT NULL,
  `headManNumber` int(11) DEFAULT NULL,
  `commentFromHead` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `authorisedByDean` int(11) NOT NULL DEFAULT '0',
  `authorisedByDeanOn` date NOT NULL,
  `deanManNumber` int(11) DEFAULT NULL,
  `commentFromDean` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bursarRecommendation` int(11) NOT NULL DEFAULT '0',
  `bursarRecommendationDate` date DEFAULT NULL,
  `bursarManNumber` int(11) DEFAULT NULL,
  `commentFromBursar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `authorisedAmount` double NOT NULL DEFAULT '0',
  `imprestBalance` double NOT NULL DEFAULT '0',
  `cashAvailable` tinyint(1) NOT NULL DEFAULT '0',
  `dateOutstandingImprest` date DEFAULT NULL,
  `isRetired` tinyint(1) NOT NULL DEFAULT '0',
  `overDue` tinyint(1) NOT NULL DEFAULT '0',
  `seenByDean` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`imprestId`),
  KEY `imprests_applicantid_foreign` (`applicantId`),
  KEY `imprests_headmannumber_foreign` (`headManNumber`),
  KEY `imprests_deanmannumber_foreign` (`deanManNumber`),
  KEY `imprests_bursarmannumber_foreign` (`bursarManNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE IF NOT EXISTS `incomes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `amountReceived` int(11) NOT NULL,
  `giver` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateReceived` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `receiptNumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `accounts_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `incomes`
--

INSERT INTO `incomes` (`id`, `amountReceived`, `giver`, `dateReceived`, `receiptNumber`, `accounts_id`, `created_at`, `updated_at`) VALUES
(14, 9000000, 'Ministry of Higher Education ( GRZ )', '2017-03-16', '348Ab58', 18, '2017-03-16 09:22:27', '2017-03-16 09:22:27'),
(15, 1500000, 'The school of Natural Sciences main account', '2017-03-16', '348Ab58', 19, '2017-03-16 09:22:27', '2017-03-16 09:22:27'),
(16, 1500000, 'The school of Natural Sciences main account', '2017-03-16', '348Ab58', 20, '2017-03-16 09:22:27', '2017-03-16 09:22:27'),
(17, 1500000, 'The school of Natural Sciences main account', '2017-03-16', '348Ab58', 21, '2017-03-16 09:22:27', '2017-03-16 09:22:27'),
(18, 1500000, 'The school of Natural Sciences main account', '2017-03-16', '348Ab58', 22, '2017-03-16 09:22:27', '2017-03-16 09:22:27'),
(19, 1500000, 'The school of Natural Sciences main account', '2017-03-16', '348Ab58', 23, '2017-03-16 09:22:27', '2017-03-16 09:22:27'),
(20, 1500000, 'The school of Natural Sciences main account', '2017-03-16', '348Ab58', 24, '2017-03-16 09:22:27', '2017-03-16 09:22:27'),
(21, 30000, 'Microsft', '2017-03-23', 'dsaf321', 24, '2017-03-23 10:38:33', '2017-03-23 10:38:33');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_100000_create_password_resets_table', 1),
('2016_10_18_195004_create_schools_table', 1),
('2016_10_18_202117_create_projects_table', 1),
('2016_10_18_202131_create_staff_table', 1),
('2016_10_18_202252_create_budgets_table', 1),
('2016_10_18_202325_create_budget_items_table', 1),
('2016_10_18_202521_create_accounts_table', 1),
('2016_10_18_202643_create_incomes_table', 1),
('2016_10_18_202908_create_expenditures_table', 1),
('2016_10_18_203224_create_roles_table', 1),
('2016_10_18_203511_create_rights_table', 1),
('2016_10_22_223204_create_access_levels_table', 1),
('2016_10_30_083407_users_roles', 1),
('2016_10_30_083456_roles_rights', 1),
('2016_10_30_084231_expenditurePurposes', 1),
('2016_11_08_221216_create_calculated_totals_table', 1),
('2016_11_20_095309_create_departments_table', 1),
('2016_11_22_124724_create_users_table', 1),
('2016_11_29_214258_create_imprests_table', 1),
('2016_11_29_214339_create_imprest_retirements_table', 1),
('2016_12_16_183116_create_strategic_directions_table', 1),
('2016_12_16_184828_create_objectives_table', 1),
('2016_12_16_184947_create_estimates_table', 1),
('2016_12_16_185040_create_activities_table', 1),
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_10_18_195004_create_schools_table', 1),
('2016_10_18_202102_create_departments_table', 1),
('2016_10_18_202117_create_projects_table', 1),
('2016_10_18_202131_create_staff_table', 1),
('2016_10_18_202252_create_budgets_table', 1),
('2016_10_18_202325_create_budget_items_table', 1),
('2016_10_18_202521_create_accounts_table', 1),
('2016_10_18_202643_create_incomes_table', 1),
('2016_10_18_202908_create_expenditures_table', 1),
('2016_10_18_203224_create_roles_table', 1),
('2016_10_18_203511_create_rights_table', 1),
('2016_10_22_223204_create_access_levels_table', 1),
('2016_10_30_083407_users_roles', 1),
('2016_10_30_083456_roles_rights', 1),
('2016_10_30_083610_users_depaments', 1),
('2016_10_30_084231_expenditurePurposes', 1),
('2016_11_08_221216_create_calculated_totals_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `objectives`
--

CREATE TABLE IF NOT EXISTS `objectives` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `strategic_directions_id` int(11) NOT NULL,
  `objective` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `objectives`
--

INSERT INTO `objectives` (`id`, `department_id`, `strategic_directions_id`, `objective`, `created_at`, `updated_at`) VALUES
(3, 53, 2, '1.1 By 30th of Sept 2017, the Dept will have New Degree Programmes', '2017-03-16 06:36:18', '2017-03-16 06:36:18'),
(5, 53, 2, '1.2 Collaborations in running Computing Programs with other schools an departments such as Engineering, Medicine, Mines, Agricultural Sciences, Education, Law and Veterinary Medicine, Geography, Mathematics, Biology, Physics and Chemistry ', '2017-03-16 06:41:07', '2017-03-16 06:41:07'),
(6, 53, 2, '1.3 Stationery', '2017-03-16 06:44:00', '2017-03-16 06:44:00'),
(7, 53, 2, '1.4 Strengthen research policy to undertake quality research', '2017-03-16 06:46:04', '2017-03-16 06:46:04'),
(8, 51, 3, 'Just any dummy text', '2017-03-16 18:00:33', '2017-03-16 18:00:33'),
(9, 53, 2, 'Train students with huawei networking interfaces', '2017-03-28 11:28:38', '2017-03-28 11:28:38'),
(10, 53, 2, 'kjg', '2017-04-05 10:01:55', '2017-04-05 10:01:55');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `projectName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `projectCoordinator` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `startDate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `endingDate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL,
  `departments_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `projectName`, `projectCoordinator`, `description`, `startDate`, `endingDate`, `completed`, `departments_id`, `created_at`, `updated_at`) VALUES
(4, 'Huawei training', 'John Kelvin Doe', 'Training students for huawei networking devices', '2017-03-28', '2017-03-31', 0, 53, '2017-03-28 11:16:00', '2017-03-28 11:16:00');

-- --------------------------------------------------------

--
-- Table structure for table `rights`
--

CREATE TABLE IF NOT EXISTS `rights` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rightName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `roleDescription` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles_rights`
--

CREATE TABLE IF NOT EXISTS `roles_rights` (
  `rights_id` int(11) NOT NULL,
  `roles_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE IF NOT EXISTS `schools` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `schoolName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `schoolName`) VALUES
(1, 'Agricultural Sciences'),
(2, 'Education'),
(3, 'Engineering'),
(4, 'Humanities and Social Sciences'),
(5, 'Law'),
(6, 'Medicine'),
(7, 'Mines'),
(8, 'Natural Sciences'),
(9, 'Veterinary Medicine'),
(10, 'Graduate School of Business');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `manNumber` int(11) NOT NULL,
  `firstName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `otherName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phoneNumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `departments_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `staff_mannumber_unique` (`manNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `strategic_directions`
--

CREATE TABLE IF NOT EXISTS `strategic_directions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `school_id` int(11) NOT NULL,
  `strategy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `academicYear` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `strategic_directions`
--

INSERT INTO `strategic_directions` (`id`, `school_id`, `strategy`, `academicYear`, `created_at`, `updated_at`) VALUES
(2, 8, 'Promote and Maintain Excellence in Teaching, Learning and Research and Consultancy', '2016 / 2017', '2017-03-16 06:17:49', '2017-03-16 06:17:49'),
(3, 8, 'Enhance Financial, Planning and Administrative Management Systems.', '2016 / 2017', '2017-03-16 06:19:24', '2017-03-16 06:19:24'),
(4, 8, 'Invest in New and Existing Business Ventures. ', '2016 / 2017', '2017-03-16 06:20:32', '2017-03-16 06:20:32'),
(5, 8, 'Enhance Human Resource Capacity and Management.', '2016 / 2017', '2017-03-16 06:21:14', '2017-03-16 06:21:14'),
(6, 8, 'Maintain, Improve and Expand Infrastructure. ', '2016 / 2017', '2017-03-16 06:22:20', '2017-03-16 06:22:20'),
(7, 8, 'Quality Assurance Systems.', '2016 / 2017', '2017-03-16 06:23:56', '2017-03-16 06:23:56'),
(8, 8, 'Expand and Promote Use of Information and Communication Technologies across campuses and the wider community.', '2016 / 2017', '2017-03-16 06:26:22', '2017-03-16 06:26:22'),
(9, 8, 'Provide Open Distance learning as an Option for Mass Teaching, Learning and Research.', '2016 / 2017', '2017-03-16 06:27:45', '2017-03-16 06:27:45'),
(10, 8, 'Harness Workers'' and Allies'' Energies for University''s Freedom from Financial Liability. ', '2016 / 2017', '2017-03-16 06:30:39', '2017-03-16 06:30:39'),
(11, 8, 'Promote Beneficial Partnerships in the Knowledge Economy. ', '2016 / 2017', '2017-03-16 06:31:46', '2017-03-16 06:31:46'),
(12, 8, 'Empowering students', '2017', '2017-04-03 19:28:42', '2017-04-03 19:28:42'),
(13, 8, 'Test', 'xjhjksdh', '2017-04-05 07:33:54', '2017-04-05 07:33:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `manNumber` int(11) NOT NULL,
  `firstName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `otherName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phoneNumber` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `access_level_id` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `departments_id` int(11) DEFAULT NULL,
  `schools_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_mannumber_unique` (`manNumber`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_phonenumber_unique` (`phoneNumber`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `manNumber`, `firstName`, `lastName`, `otherName`, `email`, `phoneNumber`, `password`, `access_level_id`, `departments_id`, `schools_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1234, 'Manasseh', 'Mwansa', 'Kabaso', 'ks@gmail.com', NULL, '$2y$10$yomSYSPc4mE1AEwhwHTlZeKFRF7cga3jmaJRED2lag7fUyuLVAzZi', 'SA', NULL, NULL, 'uDf2sDEhRxtmMcyS3IC40idzdv1H9KCd8ztKSBfoTcxjPir8cvp6z9Z70jnr', '2016-10-23 05:39:11', '2017-07-13 12:26:46'),
(2, 1111, 'Mwenda', 'Mwenda', 'T', 'mwenda@gmail.com', NULL, '$2y$10$NGY1JVISGIEX4XRRMkZxeuNrdqon8aRhGEpJla2QKfPU6pE.DLhK2', 'AC', NULL, 8, '42XHd885R086oh9WiR7TQTvQcZNy2Wva6hXUDwIJNDULQ9t0YQ27Wf71Zimo', '2016-11-23 12:48:02', '2017-05-23 07:06:50'),
(3, 2222, 'Habatwa', 'Mweene', '', 'hm@gmail.com', NULL, '$2y$10$O/Ls0I394QGbjzv54RSrpel5rZbghkweGo5vELOOQGCPfWqZCiw4G', 'DN', NULL, 8, '5Fv0SaqIS7UDuHw9pqbW1MdKvxK6oN51IYrVsKwgOJhVNN4a8pRFlYY6lNh8', '2016-11-23 12:49:29', '2017-07-11 18:30:29'),
(4, 3333, 'Jackson', 'Phiri', '', 'jp@gmail.com', NULL, '$2y$10$L2jNRECEIgdFQqmR.GqN4ugmMEt20STPeG5V4aSmCsl5FMR/VrsMi', 'HD', 53, 8, '4dbzHd3jZF36uPzUu1nvkU23JhtKM8VwmLXN2v867NwQQCfMJt855VzxRQ4y', '2016-11-23 12:58:00', '2017-06-02 08:48:13'),
(5, 4444, 'Shehata', 'Shehata', '', 'sh@gmail.com', NULL, '$2y$10$ySsb63qGBOedAejX.mA01u9QM1EYfX5v8zlmOOPFI05fi7eFHZHW6', 'HD', 51, 8, 'g2gJRpZNS7dQbzH1sWt5Py1ouChNg1MHQnC9iwzuVrWANXKqKdBNLMdt8bA0', '2016-11-23 12:59:27', '2017-03-16 18:16:49'),
(6, 5555, 'Prokahshi', 'Prokahshi', '', 'pk@gmail.com', NULL, '$2y$10$OgofixT9Hntdtom3MElD9.VxNBbTzS9cvdtddCiZXreraj06VqGGC', 'HD', 52, 8, 'J7XDHtQ3F2IVVMelzw539SaSVPBFHV8WXxtXFT7c04tlDuIIPAwUhWkkvRqF', '2016-11-23 13:00:34', '2017-07-13 09:48:19'),
(7, 6666, 'Kabamba', 'Kabamba', '', 'kbz@gmail.com', NULL, '$2y$10$Jir8g5D4ujLiVGNIamGn5.BrO8pxeIb4OiWwee7IdrzIRXbiF3LaG', 'HD', 54, 8, NULL, '2016-11-23 13:01:56', '2016-11-23 13:01:56'),
(8, 7777, 'Ephraim', 'Ephraim', '', 'ep@gmail.com', NULL, '$2y$10$8RuUtxVQZm69EH/MjjNms.X2hCkVhDsO2LJQhR0DRiSLFgMXaaumG', 'HD', 55, 8, NULL, '2016-11-23 13:03:04', '2016-11-23 13:03:04'),
(9, 8888, 'Maywoood', 'Maluza', '', 'marktwain@gmail.com', NULL, '$2y$10$qhItkIxq3mMmOXEuw8voueg95j0L19dDjqtNd/yhrsNPNt/EK8H9y', 'HD', 56, 8, NULL, '2016-11-23 13:04:59', '2016-11-23 13:04:59'),
(12, 5454, 'John', 'Doe', 'Kelvin', 'ricch.mwaba@gmail.com', '+260 962034633', '$2y$10$TIp6Rj/Sr37h7ROpatfioO//HbnLYxz.ij3MdcLhB1rypGJWBhcMi', 'OT', 53, 8, 'RFfWZpa9PQxYusvBsFbLwtSwc3VguO5xcoPw6NCtcJJ4cC62NkRe1Vs1tVhj', '2017-03-15 13:21:05', '2017-03-16 06:32:15'),
(13, 999999, 'Clayton', 'Sikasote', 'Pastor Zika', 'sikaclay@unza.zm', NULL, '$2y$10$axj8QifsxG/32fABEMGmnedOH8dt49WwQOrweQP4wgOuHWq/Go2P.', 'HD', NULL, 8, NULL, '2017-07-07 08:20:28', '2017-07-07 08:20:28'),
(14, 7787, 'David', 'Zulu', 'Makadani', 'makadanizulu@gmail.com', NULL, '$2y$10$mVy9lw.HZGCJZJqHrUr4Au6cvGlhYrPenYgNNsRpuO9vrrUzAoCEa', 'AC', NULL, 8, NULL, '2017-07-07 08:22:46', '2017-07-07 08:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `users_roles`
--

CREATE TABLE IF NOT EXISTS `users_roles` (
  `users_id` int(11) NOT NULL,
  `roles_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `imprests`
--
ALTER TABLE `imprests`
  ADD CONSTRAINT `imprests_applicantid_foreign` FOREIGN KEY (`applicantId`) REFERENCES `users` (`manNumber`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `imprests_bursarmannumber_foreign` FOREIGN KEY (`bursarManNumber`) REFERENCES `users` (`manNumber`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `imprests_deanmannumber_foreign` FOREIGN KEY (`deanManNumber`) REFERENCES `users` (`manNumber`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `imprests_headmannumber_foreign` FOREIGN KEY (`headManNumber`) REFERENCES `users` (`manNumber`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
