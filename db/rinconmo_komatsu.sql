-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 07, 2017 at 01:30 PM
-- Server version: 5.6.36-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rinconmo_komatsu`
--

-- --------------------------------------------------------

--
-- Table structure for table `appsetting`
--

CREATE TABLE `appsetting` (
  `id` int(11) UNSIGNED NOT NULL,
  `smr_based_choices` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mileage_based_choices` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_based_choices` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_email_reminder_recipient` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appsetting`
--

INSERT INTO `appsetting` (`id`, `smr_based_choices`, `mileage_based_choices`, `time_based_choices`, `additional_email_reminder_recipient`) VALUES
(15000, '250|500|1000|1500|2000|2222|3333', '10000|20000|30000|40000|50000', '1|2|3|4|5|14|30', 'kevin@rinconmountaintech.com');

-- --------------------------------------------------------

--
-- Table structure for table `componentchange`
--

CREATE TABLE `componentchange` (
  `id` int(11) UNSIGNED NOT NULL,
  `servicelog_id` int(11) UNSIGNED DEFAULT NULL,
  `component_type` int(11) UNSIGNED DEFAULT NULL,
  `component` int(11) UNSIGNED DEFAULT NULL,
  `component_data` int(11) UNSIGNED DEFAULT NULL,
  `notes` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `componenttype`
--

CREATE TABLE `componenttype` (
  `id` int(11) UNSIGNED NOT NULL,
  `component_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` tinyint(1) UNSIGNED DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `componenttype`
--

INSERT INTO `componenttype` (`id`, `component_type`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 'Engine', '2017-11-15 06:13:59', 1, '2017-11-15 06:14:31', 1),
(2, 'Final Drive', '2017-11-15 06:14:06', 1, NULL, NULL),
(3, 'Suspension', '2017-11-15 06:14:12', 1, NULL, NULL),
(4, 'Software', '2017-11-15 06:14:19', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `equipmentmodel`
--

CREATE TABLE `equipmentmodel` (
  `id` int(11) UNSIGNED NOT NULL,
  `manufacturer_id` int(11) UNSIGNED DEFAULT NULL,
  `model_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL,
  `equipmenttype_id` int(11) UNSIGNED DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `equipmentmodel`
--

INSERT INTO `equipmentmodel` (`id`, `manufacturer_id`, `model_number`, `created`, `created_by`, `equipmenttype_id`, `modified`, `modified_by`) VALUES
(5, 11, 'CAT-4029-A', '2017-09-27 01:31:53', 1, 4, '2017-09-27 02:34:38', 1),
(6, 13, 'HON-385875', '2017-09-27 01:32:06', 1, 8, '2017-09-27 02:34:01', 1),
(7, 15, 'MF9281', '2017-09-27 01:33:20', 1, 6, '2017-09-27 02:34:10', 1),
(8, 14, 'NIS39393', '2017-09-27 01:33:35', 1, 10, '2017-09-27 02:34:14', 1),
(9, 12, 'YAMA232', '2017-09-27 01:33:46', 1, 9, '2017-09-27 02:34:19', 1),
(10, 15, 'MF393933', '2017-09-27 02:17:36', 1, 11, '2017-09-27 02:34:05', 1),
(11, 12, 'YAMAYAMA01', '2017-10-16 11:36:02', 1, 9, NULL, NULL),
(12, 12, 'YAMAYAMA02', '2017-10-16 11:36:15', 1, 9, NULL, NULL),
(13, 12, 'YAMAYAMA03', '2017-10-16 11:36:31', 1, 4, NULL, NULL),
(14, 11, 'AllofThem', '2017-11-16 02:56:51', 3, 6, NULL, NULL),
(15, 11, 'AAAAAA', '2017-11-30 01:19:37', 1, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `equipmenttype`
--

CREATE TABLE `equipmenttype` (
  `id` int(11) UNSIGNED NOT NULL,
  `equipment_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` tinyint(1) UNSIGNED DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `equipmenttype`
--

INSERT INTO `equipmenttype` (`id`, `equipment_type`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(4, 'All Truck Support Equipment', '2017-09-27 02:02:02', 1, '2017-11-14 10:02:09', 1),
(5, 'Loader', '2017-09-27 02:02:09', 1, NULL, NULL),
(6, 'Fork Lift', '2017-09-27 02:02:16', 1, NULL, NULL),
(7, 'Other', '2017-09-27 02:02:24', 1, NULL, NULL),
(8, 'Light Vehicle', '2017-09-27 02:02:34', 1, NULL, NULL),
(9, 'Generators', '2017-09-27 02:02:41', 1, NULL, NULL),
(10, 'Welders', '2017-09-27 02:02:46', 1, NULL, NULL),
(11, 'Rental Equipment', '2017-09-27 02:02:53', 1, NULL, NULL),
(12, 'Temporary', '2017-09-27 02:03:00', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `equipmentunit`
--

CREATE TABLE `equipmentunit` (
  `id` int(11) UNSIGNED NOT NULL,
  `equipmentmodel_id` int(11) UNSIGNED DEFAULT NULL,
  `unit_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` tinyint(1) UNSIGNED DEFAULT NULL,
  `person_responsible` int(11) UNSIGNED DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` tinyint(1) UNSIGNED DEFAULT NULL,
  `track_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `equipmentunit`
--

INSERT INTO `equipmentunit` (`id`, `equipmentmodel_id`, `unit_number`, `created`, `created_by`, `person_responsible`, `modified`, `modified_by`, `track_type`) VALUES
(1, 15, '123', '2017-12-05 05:58:56', 1, 2, '2017-12-07 11:07:48', 1, 'miles'),
(2, 15, '1111', '2017-12-05 05:59:06', 1, 1, '2017-12-07 11:07:43', 1, 'smr'),
(3, 9, 'AVC', '2017-12-05 07:36:24', 1, 3, '2017-12-07 11:08:17', 1, 'smr'),
(4, 14, '08962321', '2017-12-05 07:36:36', 1, 3, '2017-12-07 11:08:10', 1, 'smr'),
(5, 12, '11111111111111111', '2017-12-05 07:36:46', 1, 2, '2017-12-07 11:08:27', 1, 'miles'),
(6, 15, '123123123', '2017-12-06 08:47:39', 1, 1, '2017-12-07 11:07:52', 1, 'time'),
(7, 15, '455455455', '2017-12-06 08:49:21', 1, 1, '2017-12-07 11:07:57', 1, 'miles'),
(8, 15, '888888888888888', '2017-12-07 10:56:40', 1, 2, '2017-12-07 11:08:01', 1, 'time');

-- --------------------------------------------------------

--
-- Table structure for table `fluidtype`
--

CREATE TABLE `fluidtype` (
  `id` int(11) UNSIGNED NOT NULL,
  `fluid_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` tinyint(1) UNSIGNED DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fluidtype`
--

INSERT INTO `fluidtype` (`id`, `fluid_type`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 'Diesel - On Highway', '2017-09-27 03:03:35', 1, '2017-09-27 03:05:08', 1),
(2, 'Gasoline', '2017-09-27 03:03:45', 1, NULL, NULL),
(3, 'Diesel - Off Highway', '2017-09-27 03:05:21', 1, '2017-11-14 07:46:16', 2),
(5, 'Water', '2017-09-27 03:10:59', 1, NULL, NULL),
(6, 'DEF', '2017-11-14 09:26:07', 1, '2017-11-14 11:15:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE `manufacturer` (
  `id` int(11) UNSIGNED NOT NULL,
  `manufacturer_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` tinyint(1) UNSIGNED DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`id`, `manufacturer_name`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(11, 'Caterpillar', '2017-09-27 10:25:38', 1, NULL, NULL),
(12, 'Yamaha', '2017-09-27 10:25:44', 1, '2017-09-27 10:52:23', 1),
(13, 'Honda', '2017-09-27 10:25:50', 1, NULL, NULL),
(14, 'Nissan', '2017-09-27 10:25:57', 1, NULL, NULL),
(15, 'Massey Ferguson', '2017-09-27 10:52:35', 1, NULL, NULL),
(16, 'Suzuki', '2017-09-27 07:55:46', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mileagechoice`
--

CREATE TABLE `mileagechoice` (
  `id` int(11) UNSIGNED NOT NULL,
  `mileage_choice` int(11) UNSIGNED DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mileagechoice`
--

INSERT INTO `mileagechoice` (`id`, `mileage_choice`, `created`, `created_by`) VALUES
(1, 1000, '2017-11-15 07:32:37', 1),
(2, 2000, '2017-11-15 07:32:42', 1),
(3, 3000, '2017-11-15 07:32:46', 1),
(4, 4000, '2017-11-15 07:33:52', 1),
(5, 5000, '2017-11-15 07:33:56', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pmservice`
--

CREATE TABLE `pmservice` (
  `id` int(11) UNSIGNED NOT NULL,
  `servicelog_id` int(11) UNSIGNED DEFAULT NULL,
  `reminder_pm_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smr_due` int(11) UNSIGNED DEFAULT NULL,
  `notes` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reminder_recipients` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reminder_quantity` int(11) UNSIGNED DEFAULT NULL,
  `reminder_units` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reminderrecipient`
--

CREATE TABLE `reminderrecipient` (
  `id` int(11) UNSIGNED NOT NULL,
  `reminder_recipient` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reminderrecipient`
--

INSERT INTO `reminderrecipient` (`id`, `reminder_recipient`, `created`, `created_by`) VALUES
(4, 'NPJohnson@KOMATSUNA.COM', '2017-12-05 03:39:45', 1),
(5, 'kevin@rinconmountaintech.com', '2017-12-05 03:39:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `servicelog`
--

CREATE TABLE `servicelog` (
  `id` int(11) UNSIGNED NOT NULL,
  `date_entered` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entered_by` int(11) UNSIGNED DEFAULT NULL,
  `serviced_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `equipment_id` int(11) UNSIGNED DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `servicelog`
--

INSERT INTO `servicelog` (`id`, `date_entered`, `entered_by`, `serviced_by`, `equipment_id`, `created`) VALUES
(31, '11/14/2017', 4, '12', 9, '2017-11-14 11:11:57');

-- --------------------------------------------------------

--
-- Table structure for table `smrchoice`
--

CREATE TABLE `smrchoice` (
  `id` int(11) UNSIGNED NOT NULL,
  `smr_choice` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `smrchoice`
--

INSERT INTO `smrchoice` (`id`, `smr_choice`, `created`, `created_by`) VALUES
(2, '250', '2017-11-15 07:15:28', 1),
(3, '500', '2017-11-15 07:15:33', 1),
(4, '1000', '2017-11-15 07:15:38', 1),
(5, '1500', '2017-11-15 07:15:43', 1),
(6, '2000', '2017-11-15 07:15:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `smrupdate`
--

CREATE TABLE `smrupdate` (
  `id` int(11) UNSIGNED NOT NULL,
  `servicelog_id` int(11) UNSIGNED DEFAULT NULL,
  `sus_fluid_type` int(11) UNSIGNED DEFAULT NULL,
  `sus_quantity` double DEFAULT NULL,
  `sus_units` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sus_miles` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `smrupdate`
--

INSERT INTO `smrupdate` (`id`, `servicelog_id`, `sus_fluid_type`, `sus_quantity`, `sus_units`, `sus_miles`) VALUES
(20, 31, 3, 555, 'gal', '121311');

-- --------------------------------------------------------

--
-- Table structure for table `timechoice`
--

CREATE TABLE `timechoice` (
  `id` int(11) UNSIGNED NOT NULL,
  `time_choice` double DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `timechoice`
--

INSERT INTO `timechoice` (`id`, `time_choice`, `created`, `created_by`) VALUES
(1, 3, '2017-11-15 07:34:14', 1),
(2, 6, '2017-11-15 07:34:20', 1),
(3, 10, '2017-11-15 07:34:25', 1),
(4, 15, '2017-11-15 07:34:30', 1),
(5, 30, '2017-11-15 07:34:34', 1),
(6, 1.3, '2017-11-20 12:51:04', 3),
(7, 0.2, '2017-11-20 12:51:18', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int(11) UNSIGNED DEFAULT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` tinyint(1) UNSIGNED DEFAULT NULL,
  `modified_by` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `first_name`, `last_name`, `email_address`, `pin`, `active`, `role`, `created`, `modified`, `created_by`, `modified_by`) VALUES
(1, 'ksawic', 'Kevin', 'Sawicke', 'kevin@rinconmountaintech.com', '$2y$10$X8nS3FQYOYeutGdidds23u9TeHX8S5Zof7LvdR3V366Zu8SxwUES6', 1, 'admin', '2017-09-20 09:14:01', '2017-11-27 09:39:55', NULL, 1),
(2, 'npjohnson', 'Neil', 'Johnson', 'npjohnson@komatsuna.com', '$2y$10$KbsjY24kqNqXEq332ZB4mO1x.gX1kI8VZKYJyG7yzVpQ6jkaplHP2', 1, 'admin', '2017-09-20 09:14:01', '2017-11-27 09:47:46', NULL, 1),
(3, 'jleonetti', 'John', 'Leonetti', 'jleonetti@komatsuna.com', '$2y$10$vdXnbSwnzHn2r/vRypqTkeuRepkqoUslOld5ubHAvdDH7vt82OdCW', 1, 'user', '2017-09-20 09:14:02', '2017-11-27 09:47:55', NULL, 1),
(4, 'bwjohnson', 'Bret', 'Johnson', 'bwjohnson@komatsuna.com', '$2y$10$9d/yQ4KGkNe.8jXGfsVZDuwB6MKWfTJwQnBUoUZMZ.n576eZk.jD.', 1, 'admin', '2017-09-20 09:14:02', '2017-11-27 09:47:39', NULL, 1),
(6, 'eguin', 'Eric', 'Guin', 'eguin@komatsuna.com', '$2y$10$rYyPjxibbdCeczWZScgffOmDF1irVMECxE2ojbsREUSFmeCk3vyny', 1, 'admin', '2017-11-27 09:41:20', '2017-11-27 09:52:18', 1, 1),
(7, 'awolf', 'Adam', 'Wolf', 'awolf@komatsuna.com', '$2y$10$zuBdxB2Rr7e8jUHhoD7kte7cxtiP4S5iHBR2xs1xvCLQIswWwJXZy', 1, 'user', '2017-11-27 09:41:59', '2017-11-27 09:48:08', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appsetting`
--
ALTER TABLE `appsetting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `componentchange`
--
ALTER TABLE `componentchange`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_foreignkey_componentchange_servicelog` (`servicelog_id`);

--
-- Indexes for table `componenttype`
--
ALTER TABLE `componenttype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipmentmodel`
--
ALTER TABLE `equipmentmodel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_foreignkey_equipment_manufacturer` (`manufacturer_id`),
  ADD KEY `index_foreignkey_equipment_equipmenttype` (`equipmenttype_id`);

--
-- Indexes for table `equipmenttype`
--
ALTER TABLE `equipmenttype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipmentunit`
--
ALTER TABLE `equipmentunit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_foreignkey_equipmentunit_equipmentmodel` (`equipmentmodel_id`);

--
-- Indexes for table `fluidtype`
--
ALTER TABLE `fluidtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mileagechoice`
--
ALTER TABLE `mileagechoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmservice`
--
ALTER TABLE `pmservice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_foreignkey_pmservice_servicelog` (`servicelog_id`);

--
-- Indexes for table `reminderrecipient`
--
ALTER TABLE `reminderrecipient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servicelog`
--
ALTER TABLE `servicelog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_foreignkey_servicelog_equipment` (`equipment_id`);

--
-- Indexes for table `smrchoice`
--
ALTER TABLE `smrchoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smrupdate`
--
ALTER TABLE `smrupdate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_foreignkey_smrupdate_servicelog` (`servicelog_id`);

--
-- Indexes for table `timechoice`
--
ALTER TABLE `timechoice`
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
-- AUTO_INCREMENT for table `appsetting`
--
ALTER TABLE `appsetting`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15001;
--
-- AUTO_INCREMENT for table `componentchange`
--
ALTER TABLE `componentchange`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `componenttype`
--
ALTER TABLE `componenttype`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `equipmentmodel`
--
ALTER TABLE `equipmentmodel`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `equipmenttype`
--
ALTER TABLE `equipmenttype`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `equipmentunit`
--
ALTER TABLE `equipmentunit`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `fluidtype`
--
ALTER TABLE `fluidtype`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `mileagechoice`
--
ALTER TABLE `mileagechoice`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pmservice`
--
ALTER TABLE `pmservice`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reminderrecipient`
--
ALTER TABLE `reminderrecipient`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `servicelog`
--
ALTER TABLE `servicelog`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `smrchoice`
--
ALTER TABLE `smrchoice`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `smrupdate`
--
ALTER TABLE `smrupdate`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `timechoice`
--
ALTER TABLE `timechoice`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `componentchange`
--
ALTER TABLE `componentchange`
  ADD CONSTRAINT `c_fk_componentchange_servicelog_id` FOREIGN KEY (`servicelog_id`) REFERENCES `servicelog` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `equipmentmodel`
--
ALTER TABLE `equipmentmodel`
  ADD CONSTRAINT `c_fk_equipment_equipmenttype_id` FOREIGN KEY (`equipmenttype_id`) REFERENCES `equipmenttype` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `c_fk_equipment_manufacturer_id` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturer` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `equipmentunit`
--
ALTER TABLE `equipmentunit`
  ADD CONSTRAINT `c_fk_equipmentunit_equipmentmodel_id` FOREIGN KEY (`equipmentmodel_id`) REFERENCES `equipmentmodel` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `pmservice`
--
ALTER TABLE `pmservice`
  ADD CONSTRAINT `c_fk_pmservice_servicelog_id` FOREIGN KEY (`servicelog_id`) REFERENCES `servicelog` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `servicelog`
--
ALTER TABLE `servicelog`
  ADD CONSTRAINT `c_fk_servicelog_equipment_id` FOREIGN KEY (`equipment_id`) REFERENCES `equipmentmodel` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `smrupdate`
--
ALTER TABLE `smrupdate`
  ADD CONSTRAINT `c_fk_smrupdate_servicelog_id` FOREIGN KEY (`servicelog_id`) REFERENCES `servicelog` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
