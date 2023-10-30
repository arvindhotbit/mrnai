-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 07, 2023 at 07:28 PM
-- Server version: 5.7.40
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `openline_215464542db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `user_type` enum('Super Admin','Admin') NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `profile_pic` varchar(200) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zipcode` varchar(6) NOT NULL,
  `reset_token_date` datetime DEFAULT NULL,
  `reset_token` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL COMMENT '0 for not deleed 1 for deleted',
  `deleted_date` datetime NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `role_id`, `parent_id`, `user_type`, `fullname`, `username`, `email`, `mobile`, `status`, `profile_pic`, `state_id`, `city_id`, `address`, `zipcode`, `reset_token_date`, `reset_token`, `password`, `is_deleted`, `deleted_date`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 0, 0, 'Super Admin', 'master admin', 'masteradmin', 'admin@master.com', '1231231233', 'Active', 'resources/images/profile/1695057825650887a1deeb7.jpg', 0, 0, 'indore', '452010', '2020-04-15 15:58:20', NULL, 'e10adc3949ba59abbe56e057f20f883e', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2023-05-24 22:56:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `booking_no` varchar(20) NOT NULL,
  `business_id` int(11) NOT NULL,
  `window_id` int(11) NOT NULL,
  `service_ids` varchar(25) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seat_no` int(4) NOT NULL,
  `serve_time` float NOT NULL,
  `created` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `modified` datetime NOT NULL,
  `updated_by` varchar(20) NOT NULL,
  `updated_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `booking_no`, `business_id`, `window_id`, `service_ids`, `user_id`, `seat_no`, `serve_time`, `created`, `status`, `modified`, `updated_by`, `updated_id`) VALUES
(19, '000019', 5, 5, '1', 13, 1, 10, '2023-05-06 14:08:40', 'Completed', '0000-00-00 00:00:00', '', 0),
(20, '000020', 5, 5, '2', 2, 2, 15, '2023-05-09 14:08:51', 'Pending', '2023-05-09 22:37:36', 'business', 5),
(21, '000021', 5, 5, '1,2', 13, 3, 25, '2023-05-09 14:09:03', 'In-Progress', '0000-00-00 00:00:00', '', 0),
(22, '000022', 5, 6, '3', 13, 1, 50, '2023-05-09 14:09:24', 'Completed', '2023-05-09 22:42:36', 'business', 5),
(23, '000023', 5, 5, '2', 13, 1, 15, '2023-05-09 22:10:30', 'Confirm', '2023-05-09 22:36:58', 'business', 5),
(24, '000024', 5, 5, '2,4', 13, 1, 125, '2023-05-10 22:19:15', 'In-Progress', '0000-00-00 00:00:00', '', 0),
(25, '000025', 5, 5, '2', 14, 1, 5, '2023-05-23 22:49:16', 'Canceled', '2023-05-23 22:49:51', 'user', 14),
(26, '000026', 5, 5, '2,4', 14, 2, 125, '2023-05-23 22:50:05', 'Completed', '2023-05-23 22:51:35', 'business', 5),
(27, '000027', 5, 6, '3', 14, 1, 15, '2023-05-23 22:50:37', 'In-Progress', '2023-05-23 22:54:03', 'business', 5),
(28, '000028', 5, 5, '1,2', 15, 1, 17, '2023-06-03 21:34:03', 'Pending', '0000-00-00 00:00:00', '', 0),
(29, '000029', 7, 8, '6', 15, 1, 25, '2023-06-03 21:34:17', 'Pending', '0000-00-00 00:00:00', '', 0),
(30, '000030', 8, 10, '7', 16, 1, 15, '2023-06-06 07:13:53', 'Hold', '2023-06-06 07:18:06', 'business', 8),
(31, '000031', 8, 9, '8', 16, 1, 15, '2023-06-06 07:19:13', 'Completed', '2023-06-06 07:20:04', 'business', 8),
(32, '000032', 8, 10, '7', 16, 2, 15, '2023-06-06 07:25:35', 'Canceled', '2023-06-06 07:27:48', 'user', 16),
(33, '000033', 8, 10, '7', 17, 3, 15, '2023-06-06 19:39:40', 'Pending', '0000-00-00 00:00:00', '', 0),
(34, '000034', 8, 10, '7', 18, 1, 15, '2023-06-08 07:24:54', 'Canceled', '2023-06-08 07:34:10', 'user', 18),
(35, '000035', 8, 9, '8', 18, 1, 15, '2023-06-08 07:36:13', 'Completed', '2023-06-08 07:36:42', 'business', 8),
(36, '000036', 8, 9, '8', 18, 2, 15, '2023-06-08 07:37:24', 'Hold', '2023-06-08 07:43:25', 'business', 8),
(37, '000037', 7, 8, '6', 18, 1, 25, '2023-06-08 07:39:01', 'Pending', '0000-00-00 00:00:00', '', 0),
(38, '000038', 8, 9, '8', 18, 3, 15, '2023-06-08 07:40:22', 'Completed', '2023-06-08 09:22:55', 'business', 8),
(39, '000039', 8, 9, '8', 18, 4, 15, '2023-06-08 07:41:50', 'Hold', '2023-06-08 09:24:48', 'business', 8),
(40, '000040', 5, 5, '4', 19, 1, 120, '2023-06-08 07:50:20', 'Pending', '0000-00-00 00:00:00', '', 0),
(41, '000041', 8, 9, '8', 19, 5, 15, '2023-06-08 07:53:00', 'Hold', '2023-06-08 09:26:43', 'business', 8),
(42, '000042', 8, 10, '7,10', 19, 2, 45, '2023-06-08 09:42:18', 'Completed', '2023-06-08 22:17:34', 'business', 8),
(43, '000043', 8, 9, '8', 20, 6, 15, '2023-06-08 22:16:51', 'Completed', '2023-06-08 22:17:09', 'business', 8),
(44, '000044', 8, 10, '7,10', 20, 3, 45, '2023-06-08 22:18:06', 'In-Progress', '2023-06-08 22:19:23', 'business', 8),
(45, '000045', 8, 9, '8', 20, 7, 15, '2023-06-08 22:19:05', 'In-Progress', '2023-06-08 22:19:20', 'business', 8),
(46, '000046', 5, 5, '1,2', 21, 1, 17, '2023-06-25 09:52:52', 'Pending', '0000-00-00 00:00:00', '', 0),
(47, '000047', 5, 5, '4', 22, 1, 120, '2023-07-24 14:08:50', 'Confirm', '2023-07-24 14:11:05', 'business', 5),
(48, '000048', 5, 5, '2', 23, 2, 5, '2023-07-24 14:09:25', 'In-Progress', '2023-07-24 14:10:59', 'business', 5),
(49, '000049', 5, 5, '2', 24, 3, 5, '2023-07-24 14:10:20', 'Confirm', '2023-07-24 14:11:04', 'business', 5),
(50, '000050', 5, 5, '2', 25, 4, 5, '2023-07-24 14:20:38', 'Pending', '0000-00-00 00:00:00', '', 0),
(51, '000051', 8, 9, '8', 26, 1, 15, '2023-08-30 07:09:53', 'In-Progress', '2023-08-30 07:10:51', 'business', 8),
(52, '000052', 8, 9, '8', 27, 1, 15, '2023-09-16 13:44:03', 'Canceled', '2023-09-16 13:53:21', 'user', 27),
(53, '000053', 8, 9, '8', 27, 2, 15, '2023-09-16 13:54:49', 'Completed', '2023-09-16 14:27:56', 'business', 8),
(54, '000054', 8, 9, '8', 27, 3, 15, '2023-09-16 13:55:06', 'Canceled', '2023-09-16 20:02:37', 'user', 27),
(55, '000055', 8, 9, '8', 28, 4, 15, '2023-09-16 14:24:38', 'Completed', '2023-09-16 20:07:47', 'business', 8),
(56, '000056', 8, 10, '10', 27, 1, 30, '2023-09-16 19:29:13', 'Completed', '2023-09-16 19:51:09', 'business', 8),
(57, '000057', 8, 10, '7,10', 27, 2, 45, '2023-09-16 19:55:50', 'Canceled', '2023-09-16 20:02:35', 'user', 27),
(58, '000058', 5, 6, '3,5', 27, 1, 75, '2023-09-16 19:59:00', 'Pending', '0000-00-00 00:00:00', '', 0),
(59, '000059', 8, 10, '7,10', 27, 3, 45, '2023-09-16 19:59:47', 'Canceled', '2023-09-16 20:04:01', 'user', 27),
(60, '000060', 8, 10, '7,10', 27, 4, 45, '2023-09-16 20:10:31', 'In-Progress', '2023-09-16 20:11:19', 'business', 8),
(61, '000061', 8, 10, '7,10', 27, 5, 45, '2023-09-16 20:13:05', 'Confirm', '2023-09-16 20:51:12', 'business', 8),
(62, '000062', 5, 5, '1,2,4', 27, 1, 137, '2023-09-16 20:24:48', 'Pending', '0000-00-00 00:00:00', '', 0),
(63, '000063', 8, 9, '11', 27, 1, 20, '2023-09-30 22:01:01', 'In-Progress', '2023-09-30 22:01:14', 'business', 8),
(64, '000064', 8, 9, '8', 27, 2, 15, '2023-09-30 22:03:36', 'Confirm', '2023-09-30 22:03:48', 'business', 8);

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE `business` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `business_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `category_id` int(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `lat` double NOT NULL,
  `long` double NOT NULL,
  `address` varchar(150) CHARACTER SET utf8 NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `login_token` varchar(50) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `is_live` tinyint(1) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`id`, `fullname`, `email`, `phone_no`, `business_name`, `category_id`, `password`, `country_id`, `state_id`, `city_id`, `lat`, `long`, `address`, `status`, `created`, `created_by`, `modified`, `modified_by`, `is_deleted`, `login_token`, `logo`, `is_live`, `slug`, `views`) VALUES
(1, '', '', '', '', 0, 'ef1cc71de7e32c1ed1d4294d340e8637', 0, 0, 0, 0, 0, '', 'Active', '2023-04-23 23:33:14', 0, '0000-00-00 00:00:00', 0, 0, 'bbcacb037d9330e8af0399b058ef3275', '', 0, '', 0),
(2, '', '', '', '', 0, '4297f44b13955235245b2497399d7a93', 0, 0, 0, 0, 0, '', 'Active', '2023-04-24 22:51:52', 0, '0000-00-00 00:00:00', 0, 0, '6662fd8b1b00e070630a51cf4d3b667b', '', 0, '', 0),
(3, '', '', '1234567895', '', 0, 'e10adc3949ba59abbe56e057f20f883e', 0, 0, 0, 0, 0, '', 'Active', '2023-04-24 23:13:40', 0, '0000-00-00 00:00:00', 0, 0, 'ff953f7ae6bbdd02096a003a0e068d76', '', 0, '', 0),
(4, '', '', '7418529630', '', 0, '4297f44b13955235245b2497399d7a93', 0, 0, 0, 0, 0, '', 'Active', '2023-04-24 23:16:54', 0, '0000-00-00 00:00:00', 0, 0, '361266f8af9dd0ad14310eae11294654', '', 0, '', 0),
(5, 'ankit', '', '1234567890', 'bname', 1, 'e10adc3949ba59abbe56e057f20f883e', 1, 1, 1, 22.7195687, 75.8577258, 'Indore, Madhya Pradesh, India', 'Active', '2023-04-29 12:20:48', 0, '2023-09-11 22:46:54', 0, 0, '', 'resources/images/1685807006647b5f9e39d8d.jpg', 1, 'bname8552', 0),
(6, '', '', '6654456465', '', 0, 'e10adc3949ba59abbe56e057f20f883e', 0, 0, 0, 0, 0, '', 'Active', '2023-06-03 21:10:56', 0, '0000-00-00 00:00:00', 0, 0, '29cc80923d4b19db84017fc272c470f6', '', 0, '', 0),
(7, 'sanky', '', '5869544564', 'clinik', 2, 'f79b88e64734efba50742ab2e6775359', 1, 1, 1, 0, 0, 'vijay nagar', 'Active', '2023-06-03 21:29:28', 0, '2023-06-03 21:31:17', 0, 0, '42a48efdf45c7d91df26dc5dfe86c3e0', 'resources/images/1685808043647b63ab03c75.jpeg', 1, 'clinik5911', 0),
(8, 'Siddharth Tiwari', '', '7415722354', 'Mr. Nai Wala', 1, '33fe23654abe9a9ccaa0ff547aab2165', 1, 1, 1, 22.7850175, 75.89006599999999, 'Belmont Park, Indore, Madhya Pradesh, India', 'Active', '2023-06-06 06:47:43', 0, '2023-09-30 22:00:09', 0, 0, 'cd480096fad7d8bee9cba6e24245b80e', 'resources/images/1686014873647e8b999c38b.jpg', 1, 'mr-nai-wala4813', 0);

-- --------------------------------------------------------

--
-- Table structure for table `business_category`
--

CREATE TABLE `business_category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `is_deleted` tinyint(1) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `business_category`
--

INSERT INTO `business_category` (`id`, `name`, `status`, `is_deleted`, `created`) VALUES
(1, 'Saloon', 'Active', 0, '2023-04-23 22:41:09'),
(2, 'Clinic', 'Active', 0, '2023-04-23 22:41:09');

-- --------------------------------------------------------

--
-- Table structure for table `business_security_question`
--

CREATE TABLE `business_security_question` (
  `id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` varchar(100) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `business_security_question`
--

INSERT INTO `business_security_question` (`id`, `business_id`, `question_id`, `answer`, `created`) VALUES
(1, 2, 1, 'asd', '2023-04-24 22:54:49'),
(2, 2, 3, 'das', '2023-04-24 22:54:49'),
(3, 2, 2, 'das', '2023-04-24 22:54:49'),
(4, 3, 1, 'asd', '2023-04-24 23:13:54'),
(5, 3, 3, '123', '2023-04-24 23:13:54'),
(6, 3, 2, '321', '2023-04-24 23:13:54'),
(7, 4, 1, 'asd', '2023-04-24 23:19:09'),
(8, 4, 3, 'asd', '2023-04-24 23:19:09'),
(9, 4, 2, 'asd', '2023-04-24 23:19:09'),
(10, 5, 1, 'asd', '2023-04-29 12:21:01'),
(11, 5, 3, 'asd', '2023-04-29 12:21:01'),
(12, 6, 2, 'asd', '2023-04-29 12:21:01'),
(13, 7, 1, 'car', '2023-06-03 21:29:45'),
(14, 7, 3, 'car', '2023-06-03 21:29:45'),
(15, 7, 2, 'car', '2023-06-03 21:29:45'),
(16, 8, 1, 'Ankit', '2023-06-06 06:49:54'),
(17, 8, 3, 'Audi', '2023-06-06 06:49:55'),
(18, 8, 2, 'Dhoni', '2023-06-06 06:49:55');

-- --------------------------------------------------------

--
-- Table structure for table `business_services`
--

CREATE TABLE `business_services` (
  `id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `window_id` int(11) NOT NULL,
  `service_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `service_person` varchar(50) CHARACTER SET utf8 NOT NULL,
  `service_time` varchar(20) NOT NULL,
  `service_time_str` varchar(20) CHARACTER SET utf8 NOT NULL,
  `gender` varchar(10) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `business_services`
--

INSERT INTO `business_services` (`id`, `business_id`, `window_id`, `service_name`, `service_person`, `service_time`, `service_time_str`, `gender`, `is_deleted`) VALUES
(1, 5, 5, 'Service1', 'rahul', '12', '12 min', 'male', 0),
(2, 5, 5, 'Servie3', 'mayank', '05', '05 min', 'female', 0),
(3, 5, 6, 'New', 'rohit', '15', '15 min', 'male', 0),
(4, 5, 5, 'Hair cut', 'rohit', '120', '120 min', 'male', 0),
(5, 5, 6, 'Padi', 'Neha', '60', '60 min', 'female', 0),
(6, 7, 8, 'Line 1', 'Roy', '25', '25 min', 'male', 0),
(7, 8, 10, 'Hair Cut', 'Ashutosh', '15', '15 min', 'male', 0),
(8, 8, 9, 'Skin Tening', 'Mena', '15', '15 min', 'female', 0),
(9, 8, 11, 'Test serv', 'Ranu', '60', '60 min', 'male', 1),
(10, 8, 10, 'Body scrub', 'Neha', '30', '30 min', 'female', 0),
(11, 8, 9, 'Hand Hair Remove', 'Rohit', '20', '20 min', 'male', 0);

-- --------------------------------------------------------

--
-- Table structure for table `business_window`
--

CREATE TABLE `business_window` (
  `id` int(11) NOT NULL,
  `window_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `business_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `business_window`
--

INSERT INTO `business_window` (`id`, `window_name`, `business_id`, `is_deleted`) VALUES
(1, 'Guest', 1, 0),
(2, 'Guest', 2, 0),
(3, 'Guest', 3, 0),
(4, 'Guest', 4, 0),
(5, 'Guest', 5, 0),
(6, 'balcony', 5, 0),
(7, 'Guest', 6, 0),
(8, 'Guest', 7, 0),
(9, 'Guest', 8, 0),
(10, 'Main Chair', 8, 0),
(11, 'Test121', 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `state_id`, `name`, `is_deleted`, `created`) VALUES
(1, 1, 'Indore', 0, '2023-04-29 12:28:01'),
(2, 1, 'Bhopal', 0, '2023-04-29 12:28:01');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `ticket_id` varchar(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message` text CHARACTER SET utf8 NOT NULL,
  `status` enum('Pending','Replied','Closed') NOT NULL DEFAULT 'Pending',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_updated` datetime NOT NULL,
  `reply_by` int(11) NOT NULL,
  `replied_by_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `is_deleted`, `created`) VALUES
(1, 'India', 0, '2023-04-29 12:28:01');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `title`, `content`, `created`, `modified`) VALUES
(1, 'Terms & Condition', '<h3>\r\n	What is Lorem Ipsum?</h3>\r\n<ul>\r\n	<li>\r\n		<strong>What is Lorem Ipsum</strong> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>\r\n	<li>\r\n		<strong>What is Lorem Ipsum</strong> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>\r\n	<li>\r\n		<strong>What is Lorem Ipsum</strong> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>\r\n	<li>\r\n		<strong>What is Lorem Ipsum</strong> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>\r\n	<li>\r\n		<strong>What is Lorem Ipsum</strong> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>\r\n</ul>\r\n<h3>\r\n	Why do we use it?</h3>\r\n<ul>\r\n	<li>\r\n		<strong>What is Lorem Ipsum</strong> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>\r\n	<li>\r\n		<strong>What is Lorem Ipsum</strong> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>\r\n	<li>\r\n		<strong>What is Lorem Ipsum</strong> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>\r\n	<li>\r\n		<strong>What is Lorem Ipsum</strong> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>\r\n	<li>\r\n		<strong>What is Lorem Ipsum</strong> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li>\r\n	<li>\r\n		<strong>What is Lorem Ipsum</strong> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book -\r\n		<ol type=\"i\">\r\n			<li>\r\n				Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>\r\n			<li>\r\n				Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>\r\n			<li>\r\n				Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>\r\n			<li>\r\n				Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>\r\n			<li>\r\n				Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>\r\n			<li>\r\n				Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>\r\n			<li>\r\n				Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>\r\n		</ol>\r\n		Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</li>\r\n	<li>\r\n		<strong>Where does it come from?</strong>\r\n		<ol type=\"a\">\r\n			<li>\r\n				Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>\r\n			<li>\r\n				Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>\r\n			<li>\r\n				Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>\r\n			<li>\r\n				Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>\r\n			<li>\r\n				Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>\r\n			<li>\r\n				Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>\r\n			<li>\r\n				Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>\r\n		</ol>\r\n	</li>\r\n</ul>\r\n<p>\r\n	<strong>Companies getting registered on Sammaan will have to pay an annual fees of Rs. 10,000+GST (Total Rs.11, 800) towards listing. Furthermore, the listing/empanelment fees will be renewed on annual basis.</strong></p>', '2019-03-28 16:01:46', '0000-00-00 00:00:00'),
(2, 'Privacy Policy', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nunc sed id semper risus in. Dui nunc mattis enim ut. Proin sagittis nisl rhoncus mattis rhoncus. Ultrices tincidunt arcu non sodales neque sodales ut. Sit amet cursus sit amet dictum sit amet justo donec. Eu lobortis elementum nibh tellus molestie nunc. Nunc mi ipsum faucibus vitae aliquet nec ullamcorper sit. Egestas dui id ornare arcu odio ut sem nulla. Tempor commodo ullamcorper a lacus. In massa tempor nec feugiat nisl pretium. Tellus cras adipiscing enim eu turpis egestas pretium aenean pharetra. Nullam eget felis eget nunc lobortis mattis aliquam. Turpis egestas sed tempus urna et pharetra pharetra massa massa. Maecenas volutpat blandit aliquam etiam erat velit scelerisque in. Urna id volutpat lacus laoreet. Potenti nullam ac tortor vitae purus faucibus.\r\n\r\nVel turpis nunc eget lorem dolor sed. Blandit libero volutpat sed cras. Tortor vitae purus faucibus ornare. Dictum varius duis at consectetur lorem donec massa sapien. Mauris a diam maecenas sed enim ut sem viverra aliquet. Ut faucibus pulvinar elementum integer enim neque volutpat ac tincidunt. Mollis nunc sed id semper risus. In nulla posuere sollicitudin aliquam ultrices sagittis. Nunc mattis enim ut tellus elementum. Bibendum neque egestas congue quisque egestas. At volutpat diam ut venenatis tellus. Felis eget nunc lobortis mattis aliquam faucibus purus in massa. Amet volutpat consequat mauris nunc congue nisi vitae. Massa tincidunt dui ut ornare lectus. Integer vitae justo eget magna fermentum iaculis eu non diam. Quisque id diam vel quam elementum pulvinar. Volutpat diam ut venenatis tellus. Faucibus ornare suspendisse sed nisi. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed velit.\r\n\r\nSed odio morbi quis commodo. Cursus sit amet dictum sit amet. Tristique sollicitudin nibh sit amet commodo nulla. Vulputate ut pharetra sit amet aliquam id diam maecenas. Egestas egestas fringilla phasellus faucibus scelerisque. Cras tincidunt lobortis feugiat vivamus at augue eget. Magna fermentum iaculis eu non diam. Est velit egestas dui id ornare arcu odio ut sem. Convallis a cras semper auctor neque vitae tempus quam pellentesque. Nisi lacus sed viverra tellus in hac habitasse. Leo duis ut diam quam. Donec adipiscing tristique risus nec feugiat in fermentum. Sed arcu non odio euismod lacinia at quis risus sed. Habitant morbi tristique senectus et netus et. Felis eget velit aliquet sagittis id consectetur. Tellus molestie nunc non blandit. Aenean et tortor at risus viverra adipiscing. Ullamcorper a lacus vestibulum sed arcu non odio euismod.\r\n\r\nAdipiscing elit ut aliquam purus sit. Malesuada fames ac turpis egestas sed tempus urna et. Eu volutpat odio facilisis mauris sit amet massa vitae. Eget dolor morbi non arcu risus quis varius. Neque sodales ut etiam sit amet. Volutpat blandit aliquam etiam erat velit scelerisque in dictum. Semper viverra nam libero justo laoreet sit amet cursus. Sed viverra tellus in hac. Tincidunt tortor aliquam nulla facilisi cras fermentum odio eu feugiat. Morbi tristique senectus et netus et. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed velit. Odio euismod lacinia at quis risus sed vulputate odio ut. Dolor purus non enim praesent elementum facilisis leo. Sodales ut eu sem integer vitae justo eget. Ornare arcu odio ut sem nulla. Neque sodales ut etiam sit amet nisl. Aliquet nibh praesent tristique magna.\r\n\r\nPlacerat orci nulla pellentesque dignissim enim. Justo donec enim diam vulputate ut pharetra sit. Sed elementum tempus egestas sed sed risus. Elit ullamcorper dignissim cras tincidunt. Magnis dis parturient montes nascetur. Odio morbi quis commodo odio aenean. Fermentum dui faucibus in ornare quam viverra orci sagittis. Tincidunt vitae semper quis lectus nulla at volutpat. Vulputate eu scelerisque felis imperdiet proin fermentum leo vel. Venenatis tellus in metus vulputate eu. Commodo odio aenean sed adipiscing. Tincidunt vitae semper quis lectus nulla at. Lacus luctus accumsan tortor posuere. Convallis aenean et tortor at risus viverra. Dui id ornare arcu odio.', '2019-07-01 17:03:03', '2018-01-24 16:26:26'),
(3, 'About Us', '<p>\r\n	Sai Law House is an Exclusive Online Book Store of Madhya Pradesh, so it is giving better purchasing facility to its customers. This online store sells popular books on Goods and Services Tax, Income Tax, Allied Law &amp; Others books published in India. Our main objective is to provide better services to our respective customers.</p>', '2021-09-06 22:09:31', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `hide` tinyint(4) NOT NULL COMMENT '1=hide for parent roles not edited by any user',
  `type` enum('Admin','Facility','Agency','User') NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `parent_id`, `hide`, `type`, `name`, `status`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 0, 0, 'Admin', 'Role1', 'Active', '2022-04-02 22:35:50', 1, '2023-02-28 22:11:14', 0),
(2, 0, 0, 'Admin', 'Role2', 'Active', '2022-04-02 22:36:14', 1, '0000-00-00 00:00:00', 0),
(3, 0, 0, 'Admin', 'my role', 'Active', '2022-07-15 23:07:22', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `add` tinyint(4) NOT NULL,
  `edit` tinyint(4) NOT NULL,
  `delete` tinyint(4) NOT NULL,
  `view` tinyint(4) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `section_id`, `add`, `edit`, `delete`, `view`, `created`, `modified`) VALUES
(1, 1, 1, 0, 0, 0, 1, '2022-04-02 22:35:50', '2022-04-02 22:35:57'),
(2, 1, 78, 0, 1, 0, 1, '2022-04-02 22:35:50', '2022-04-02 22:35:57'),
(3, 1, 13, 0, 0, 0, 0, '2022-04-02 22:35:50', '2022-04-02 22:35:57'),
(4, 1, 80, 0, 0, 0, 1, '2022-04-02 22:35:51', '2022-04-02 22:35:57'),
(5, 2, 1, 0, 0, 0, 1, '2022-04-02 22:36:14', '2023-02-20 22:18:56'),
(6, 2, 78, 0, 0, 0, 0, '2022-04-02 22:36:14', '2023-02-20 22:18:57'),
(7, 2, 13, 0, 0, 0, 1, '2022-04-02 22:36:14', '2023-02-20 22:18:57'),
(8, 2, 80, 0, 0, 0, 1, '2022-04-02 22:36:14', '2023-02-20 22:18:57'),
(9, 3, 1, 0, 0, 0, 0, '2022-07-15 23:07:22', '2022-11-25 22:41:23'),
(10, 3, 78, 1, 1, 0, 1, '2022-07-15 23:07:23', '2022-11-25 22:41:23'),
(11, 3, 82, 0, 0, 0, 0, '2022-07-15 23:07:23', '2022-11-25 22:41:23'),
(12, 3, 13, 0, 1, 0, 1, '2022-07-15 23:07:23', '2022-11-25 22:41:23'),
(13, 3, 80, 0, 0, 0, 1, '2022-07-15 23:07:23', '2022-11-25 22:41:23'),
(14, 3, 83, 0, 1, 0, 1, '2022-07-15 23:07:23', '2022-11-25 22:41:23'),
(15, 3, 84, 0, 0, 0, 0, '0000-00-00 00:00:00', '2022-11-25 22:41:23'),
(16, 3, 86, 0, 0, 0, 0, '0000-00-00 00:00:00', '2022-11-25 22:41:23'),
(17, 3, 85, 1, 0, 0, 1, '0000-00-00 00:00:00', '2022-11-25 22:41:23'),
(18, 2, 82, 0, 0, 0, 0, '0000-00-00 00:00:00', '2023-02-20 22:18:57'),
(19, 2, 83, 0, 0, 0, 0, '0000-00-00 00:00:00', '2023-02-20 22:18:57'),
(20, 2, 84, 0, 0, 0, 0, '0000-00-00 00:00:00', '2023-02-20 22:18:57'),
(21, 2, 86, 0, 0, 0, 0, '0000-00-00 00:00:00', '2023-02-20 22:18:57'),
(22, 2, 85, 0, 0, 0, 0, '0000-00-00 00:00:00', '2023-02-20 22:18:57');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `type` enum('Admin','Facility','Agency','User') NOT NULL DEFAULT 'Admin',
  `name` varchar(100) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `link` varchar(100) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `flag` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `type`, `name`, `parent_id`, `icon`, `link`, `sort_order`, `status`, `flag`) VALUES
(1, 'Admin', 'Dashboard', 0, 'fa fa-dashboard', 'admin/dashboard', 1, 'Active', 0),
(13, 'Admin', 'User List', 0, 'fa fa-users', 'admin/user/list', 3, 'Active', 0),
(14, 'Admin', 'Settings', 0, 'fa fa-circle', 'javascript:void(0)', 1000, 'Inactive', 0),
(15, 'Admin', 'Manage Roles', 14, 'fa fa-circle', 'admin/role_list', 1, 'Active', 0),
(16, 'Admin', 'Manage Admin', 14, 'fa fa-user', 'admin/subadmin/list', 2, 'Active', 0),
(83, 'Admin', 'Booking Management', 0, 'fa fa-circle', 'admin/booking/list', 7, 'Active', 0),
(87, 'Admin', 'Business Management', 0, 'fa fa-users', 'admin/business/list', 6, 'Active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `security_question`
--

CREATE TABLE `security_question` (
  `id` int(11) NOT NULL,
  `question` varchar(150) CHARACTER SET utf8 NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created` datetime NOT NULL,
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `security_question`
--

INSERT INTO `security_question` (`id`, `question`, `status`, `created`, `is_deleted`) VALUES
(1, 'Who is your best friend?', 'Active', '2023-04-08 12:57:47', 0),
(2, 'Your favorite cricket player?', 'Active', '2023-04-08 12:57:47', 0),
(3, 'Your favorite cricket car?', 'Active', '2023-04-08 12:57:47', 0);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_id`, `name`, `is_deleted`, `created`) VALUES
(1, 1, 'Madhaya Pradesh', 0, '2023-04-29 12:28:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) CHARACTER SET utf8 NOT NULL,
  `device_id` varchar(100) NOT NULL,
  `device_type` varchar(50) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `profile_pic` varchar(100) NOT NULL,
  `device_token` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `device_id`, `device_type`, `phone_no`, `status`, `created`, `modified`, `modified_by`, `is_deleted`, `profile_pic`, `device_token`) VALUES
(1, 's', '', '', '', 'Active', '2023-04-30 22:19:43', '0000-00-00 00:00:00', 0, 0, '', ''),
(2, 'USER', '', '', '7418529630', 'Active', '2023-04-30 22:23:35', '0000-00-00 00:00:00', 0, 0, 'resources/images/user/1682873615644e9d0fc4a64.jpg', ''),
(3, 'jkkjhj', '', '', '', 'Active', '2023-04-30 22:31:04', '0000-00-00 00:00:00', 0, 0, '', ''),
(4, 'jhkj', '', '', '', 'Active', '2023-04-30 22:31:35', '0000-00-00 00:00:00', 0, 0, '', ''),
(5, 'unmae', '', '', '7415829630', 'Active', '2023-04-30 22:39:02', '2023-04-30 22:47:15', 0, 0, 'resources/images/user/1682875035644ea29b247f8.jpg', ''),
(6, 'user', '', '', '', 'Active', '2023-05-01 22:56:33', '0000-00-00 00:00:00', 0, 0, '', '5aaeff7f15299fb9528fe0dc471503d2'),
(7, 'user', '', '', '', 'Active', '2023-05-01 22:56:47', '0000-00-00 00:00:00', 0, 0, '', '27daa05e59c2c19181293de1bb726dec'),
(8, 'user', '', '', '', 'Active', '2023-05-01 22:59:28', '0000-00-00 00:00:00', 0, 0, '', '8665b15660ac68dd5af65f141cb4b6fc'),
(9, 'user', '', '', '', 'Active', '2023-05-01 23:01:20', '0000-00-00 00:00:00', 0, 0, '', '5594f79a70fffceec3cf947693bed29c'),
(10, 'user', '', '', '', 'Active', '2023-05-01 23:03:14', '0000-00-00 00:00:00', 0, 0, '', '5e3ddca75079475aefb39ddac6fe842f'),
(11, 'user', '', '', '', 'Active', '2023-05-01 23:05:01', '2023-05-01 23:05:46', 0, 0, '', '362bd68f5ee2ce7fa2f25aa1a2a96d5a'),
(12, 'user', '', '', '4567891235', 'Active', '2023-05-01 23:06:27', '0000-00-00 00:00:00', 0, 0, '', '362bd68f5ee2ce7fa2f25aa1a2a96d5a'),
(13, 'user', '', '', '4567891230', 'Active', '2023-05-01 23:07:40', '2023-05-10 22:19:15', 0, 0, '', 'b0e88fc5da465237be544612d777bc1a'),
(14, 'user', '', '', '8979878777', 'Active', '2023-05-23 22:49:16', '2023-05-23 22:50:37', 0, 0, '', '64a1ffa0991decbfcd577fcba8af2e1b'),
(15, 'Vishnu', '', '', '8845588899', 'Active', '2023-06-03 21:34:03', '2023-06-03 21:34:17', 0, 0, '', '750608ef8451767b84d2e57cca85c0f3'),
(16, 'Siddharth', '', '', '7415722354', 'Active', '2023-06-06 07:13:53', '2023-06-06 07:25:35', 0, 0, 'resources/images/user/1686015831647e8f5759ba1.jpg', 'bbf6b922bce2f3442d851d656e59787e'),
(17, 'Sid 2', '', '', '', 'Active', '2023-06-06 19:39:40', '0000-00-00 00:00:00', 0, 0, '', 'a20f8dde058a4d91fe2c78f7a2afc53f'),
(18, 'Buddha', '', '', '6377377727', 'Active', '2023-06-08 07:24:54', '2023-06-08 07:41:50', 0, 0, 'resources/images/user/1686189292648134ec827ac.jpg', '39f9e0760618e2fc676b9dfa0436dc92'),
(19, 'Pooja sen', '', '', '', 'Active', '2023-06-08 07:50:20', '2023-06-08 09:42:18', 0, 0, '', 'df588afc044979b67eab4afe89538378'),
(20, 'Monu', '', '', '', 'Active', '2023-06-08 22:16:51', '2023-06-08 22:19:05', 0, 0, '', 'cb8931461e721a264880cd106caa5356'),
(21, 'Sid Babu', '', '', '', 'Active', '2023-06-25 09:52:52', '0000-00-00 00:00:00', 0, 0, 'resources/images/user/16876669706497c11aebfec.jpg', 'f497d62fc297946ddb3f1441ed12cd9f'),
(22, 'user120', '', '', '7418529635', 'Active', '2023-07-24 14:08:50', '0000-00-00 00:00:00', 0, 0, '', '0502a919ab2e03328aae7eca3deafc97'),
(23, 'user5-1', '', '', '7845693214', 'Active', '2023-07-24 14:09:25', '0000-00-00 00:00:00', 0, 0, '', 'aedf47431e075ee0ce3d7cc5c54569cf'),
(24, 'u5-2', '', '', '7896321451', 'Active', '2023-07-24 14:10:20', '0000-00-00 00:00:00', 0, 0, '', '89e9f24c04377def8539c55db64452b6'),
(25, 'U5-3', '', '', '6548523698', 'Active', '2023-07-24 14:20:38', '0000-00-00 00:00:00', 0, 0, '', '2f0a65988f4d7eca13cea3e1ec199504'),
(26, 'Priya', '', '', '', 'Active', '2023-08-30 07:09:53', '0000-00-00 00:00:00', 0, 0, '', '97258149546e5668f85d6a03d3208d48'),
(27, 'Priya', '', '', '', 'Active', '2023-09-16 13:44:03', '2023-09-30 22:03:27', 0, 0, 'resources/images/user/1694852043650563cbc8dfd.jpg', '98629df9e6bffe5e84f6bffd68bf3c99'),
(28, 'Ranu Tiwari', '', '', '', 'Active', '2023-09-16 14:24:38', '0000-00-00 00:00:00', 0, 0, 'resources/images/user/169485447465056d4aabe2f.jpg', '011b23051bcf7c1fbc16ddd8dc502571');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `email` (`email`),
  ADD KEY `status` (`status`),
  ADD KEY `user_type` (`user_type`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_id` (`business_id`),
  ADD KEY `window_id` (`window_id`);

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `business_category`
--
ALTER TABLE `business_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_security_question`
--
ALTER TABLE `business_security_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_services`
--
ALTER TABLE `business_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_id` (`business_id`);

--
-- Indexes for table `business_window`
--
ALTER TABLE `business_window`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_id` (`business_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `ticket_id` (`ticket_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sectionid` (`section_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `security_question`
--
ALTER TABLE `security_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `business`
--
ALTER TABLE `business`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `business_category`
--
ALTER TABLE `business_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `business_security_question`
--
ALTER TABLE `business_security_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `business_services`
--
ALTER TABLE `business_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `business_window`
--
ALTER TABLE `business_window`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `security_question`
--
ALTER TABLE `security_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
