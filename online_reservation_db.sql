-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 09, 2023 at 12:17 AM
-- Server version: 10.5.16-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id20015116_resort_management_reservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activity_log`
--

CREATE TABLE `tbl_activity_log` (
  `id` int(11) NOT NULL,
  `actions` varchar(255) NOT NULL,
  `date_added` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contacts`
--

CREATE TABLE `tbl_contacts` (
  `id` int(11) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `working_hours` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_contacts`
--

INSERT INTO `tbl_contacts` (`id`, `contact`, `address`, `email`, `working_hours`) VALUES
(1, '09178348282', 'Brgy Nazareth General Tinio, Nueva Ecija', 'pmpmanmadeparadise@gmail.com', 'Mon - Sat: 8AM to 5PM ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cottage`
--

CREATE TABLE `tbl_cottage` (
  `id` int(11) NOT NULL,
  `cottage_name` varchar(255) NOT NULL,
  `cottage_capacity` int(11) NOT NULL,
  `available_cottage` int(11) NOT NULL,
  `cottage_price` int(11) NOT NULL,
  `cottage_image` varchar(255) NOT NULL,
  `date_added` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cottage`
--

INSERT INTO `tbl_cottage` (`id`, `cottage_name`, `cottage_capacity`, `available_cottage`, `cottage_price`, `cottage_image`, `date_added`) VALUES
(4, 'malake medyo', 5, 2, 400, '1669561058_416e82db83c1750699da.jpg', '2022-11-27'),
(5, 'qweqwe', 3, 2, 250, '1669567313_c57afb5b388350bef3bd.jpg', '2022-11-28'),
(6, 'asdas', 6, 2, 600, '1669567372_f71ad7a6995b8a0b6fa9.jpg', '2022-11-28'),
(7, 'asda', 2, 2, 200, '1669567404_826e5842bd35b5e79818.jpg', '2022-11-28'),
(8, 'awdawd', 10, 3, 1500, '1669682665_a5713db3d42c98c23090.jpg', '2022-11-29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customers`
--

CREATE TABLE `tbl_customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(40) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `birthdate` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `account_status` varchar(100) NOT NULL DEFAULT 'inactive',
  `activation_key` varchar(255) NOT NULL,
  `activation_date` datetime NOT NULL,
  `room_cancellation_limit` int(11) NOT NULL,
  `date_added` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL COMMENT 'update when customer request to reset their password'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customers`
--

INSERT INTO `tbl_customers` (`id`, `name`, `email`, `password`, `gender`, `contact`, `birthdate`, `age`, `profile`, `address`, `account_status`, `activation_key`, `activation_date`, `room_cancellation_limit`, `date_added`, `updated_at`) VALUES
(78, 'Jonnella Gutierrez', 'jonnellagutierrez@gmail.com', '$2y$10$2Da9jTX5A.FBLaArkWgt0e6ny0thOwG3UpRwUDYiboy4jb6GGBNgi', 'female', '09265758678', '09-28-1999', 23, 'user_male.jpg', 'Poblacion l', 'active', 'a28c6422911614453f72bde3ce3ad623', '2022-12-18 03:12:35', 3, '2022-12-18', NULL),
(79, 'Niel Boneza', 'johnrenielboneza12@gmail.com', '$2y$10$z..XlWdbRgZt65nmbys/0.ZAyDJLcitmXPCxxpptB3lQvbUPRxZHa', 'male', '09773415345', '11-12-2000', 22, 'user_male.jpg', 'Poblacion II Penaranda Nueva Ecija', 'active', '136a7a020d8c94f35baba560f16b403e', '2022-12-18 04:06:02', 3, '2022-12-18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_entrance`
--

CREATE TABLE `tbl_entrance` (
  `id` int(11) NOT NULL,
  `adult_price` int(11) NOT NULL,
  `child_price` int(11) NOT NULL,
  `date_added` date NOT NULL DEFAULT current_timestamp(),
  `night_adult` int(11) NOT NULL,
  `night_child` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_entrance`
--

INSERT INTO `tbl_entrance` (`id`, `adult_price`, `child_price`, `date_added`, `night_adult`, `night_child`) VALUES
(1, 200, 60, '2022-11-27', 300, 120);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_entrance_cottage_transaction`
--

CREATE TABLE `tbl_entrance_cottage_transaction` (
  `id` int(11) NOT NULL,
  `unique_id` varchar(100) NOT NULL,
  `cottage_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `visit_type` varchar(100) NOT NULL COMMENT 'day/night/overnight',
  `date_visit` date NOT NULL,
  `time_arrival` varchar(255) NOT NULL,
  `transaction_status` varchar(100) NOT NULL,
  `total_bill` int(11) NOT NULL,
  `total_adult` int(11) NOT NULL,
  `total_child` int(11) NOT NULL,
  `total_person` int(11) NOT NULL,
  `transaction_date` datetime NOT NULL DEFAULT current_timestamp(),
  `gcash_reference_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_entrance_cottage_transaction`
--

INSERT INTO `tbl_entrance_cottage_transaction` (`id`, `unique_id`, `cottage_id`, `customer_id`, `visit_type`, `date_visit`, `time_arrival`, `transaction_status`, `total_bill`, `total_adult`, `total_child`, `total_person`, `transaction_date`, `gcash_reference_number`) VALUES
(1, 'C8E564C694', 5, 51, 'day', '2022-12-08', '10:00AM - 11:00AM', 'pending', 770, 2, 2, 4, '2022-12-08 21:44:24', '123123213');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events_places`
--

CREATE TABLE `tbl_events_places` (
  `id` int(11) NOT NULL,
  `events_name` varchar(100) NOT NULL,
  `rate` int(11) NOT NULL,
  `max_capacity` int(11) NOT NULL,
  `description` text NOT NULL,
  `images` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_events_places`
--

INSERT INTO `tbl_events_places` (`id`, `events_name`, `rate`, `max_capacity`, `description`, `images`, `status`) VALUES
(6, 'Events Place I', 10000, 100, '<p>This event\'s place can hold 100 person at max. You can hold weddings, birthday party, and reunion depending on your guest count.</p>', '1671205406_15be470cb95b0e353000.png', 'active'),
(7, 'Events Place II', 25000, 500, '<p>A great venue to celebrate big events like reunion or any events that expecting many guest.</p>', '1671205516_bbea72c9f306892384da.png', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events_transaction`
--

CREATE TABLE `tbl_events_transaction` (
  `transaction_id` int(11) NOT NULL,
  `unique_id` varchar(100) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `event_place_id` int(11) NOT NULL,
  `date_book` date NOT NULL DEFAULT current_timestamp(),
  `time_arrival` varchar(100) DEFAULT NULL,
  `payment_status` varchar(100) DEFAULT NULL,
  `total_bill` int(11) NOT NULL,
  `payment_deposit` int(11) NOT NULL,
  `total_person` int(11) NOT NULL,
  `gcash_reference_number` varchar(255) NOT NULL,
  `transaction_status` varchar(100) NOT NULL DEFAULT 'pending',
  `cancellation_message` text DEFAULT NULL,
  `resubmit_ref` varchar(20) DEFAULT NULL COMMENT 'if gcash ref no. is wrong admin can set this colum to true so the customer can resubmit their gcash ref no.',
  `transaction_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_events_transaction`
--

INSERT INTO `tbl_events_transaction` (`transaction_id`, `unique_id`, `customer_id`, `event_place_id`, `date_book`, `time_arrival`, `payment_status`, `total_bill`, `payment_deposit`, `total_person`, `gcash_reference_number`, `transaction_status`, `cancellation_message`, `resubmit_ref`, `transaction_date`) VALUES
(20, 'DA7171C54E', 57, 1, '2022-12-17', NULL, NULL, 30004, 15002, 20, '12345', 'cancelled', 'scam', NULL, '2022-12-14'),
(21, '129281F494', 57, 1, '2022-12-14', NULL, 'fully paid', 30004, 15002, 5, '121212', 'completed', NULL, NULL, '2022-12-14'),
(22, '00894E3F20', 51, 4, '2022-12-16', NULL, NULL, 10000, 5000, 50, 'Uwuusus', 'pending', NULL, NULL, '2022-12-15'),
(23, 'B610E67C48', 78, 7, '2022-12-18', NULL, 'fully paid', 25000, 12500, 0, '76786786867', 'accepted', NULL, NULL, '2022-12-18'),
(24, '37BD9E9798', 79, 7, '2022-12-19', NULL, NULL, 25000, 12500, 500, '151515151', 'pending', NULL, NULL, '2022-12-18'),
(25, '77F09B2E60', 79, 7, '2022-12-20', NULL, NULL, 25000, 12500, 500, '62616161888', 'pending', NULL, NULL, '2022-12-18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_info`
--

CREATE TABLE `tbl_payment_info` (
  `id` int(11) NOT NULL,
  `gcash_number` varchar(20) NOT NULL,
  `gcash_qr` varchar(255) NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_payment_info`
--

INSERT INTO `tbl_payment_info` (`id`, `gcash_number`, `gcash_qr`, `status`) VALUES
(1, '09073570209', '1671255961_4c4ab516573a3f12805d.jpg', 'active'),
(3, '09999999999', '1670725655_433a06b120af6b68eeb1.jpg', 'inactive'),
(4, '09123456782', '1670723998_46a39c7a27735d7493fe.jpg', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rate_reviews`
--

CREATE TABLE `tbl_rate_reviews` (
  `id` int(11) NOT NULL,
  `rates` varchar(255) NOT NULL,
  `reviews` text NOT NULL,
  `rate_by` varchar(100) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(100) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rides`
--

CREATE TABLE `tbl_rides` (
  `id` int(11) NOT NULL,
  `rides_name` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_rides`
--

INSERT INTO `tbl_rides` (`id`, `rides_name`, `image`, `description`) VALUES
(15, 'ATV', '1671256613_359ddfa80f2c029ca1e1.jpg', '<p>2 ATV AROUND CP/ 30m = P500</p>'),
(16, 'BIKES', '1671256887_f586257fa167b68d4e42.jpg', '<p>11 ADULTS BIKES/ &nbsp;3 KIDS BIKES / 30mins = P150</p>'),
(17, 'HORSE RIDE', '1671256948_260077fa9c12ec4a3df1.jpg', '<p>HORSE RIDE/ 20mins = P150</p>'),
(18, 'TOUR JEEPNEYS', '1671257026_792097e6271041b9f760.jpg', '<p>2 TOUR JEEPNEYS/ 10 DESTINATIONS = P200</p>'),
(19, 'KALABAW RIDE', '1671257125_35a6d3aba7c8b7f477b1.jpg', '<p>KALABAW RIDE/ 20 mins = 150</p>'),
(20, 'KAYAK', '1671257163_26587dba9ca315c8b1d8.jpg', '<p>KAYAK/ 30mins = P150</p>'),
(21, 'SKY BIKE', '1671257427_8d8735e58e244d4522ac.jpg', '<p>ADULT SKYBIKE/ BACK &amp; FORTH = P250</p>'),
(22, 'TRAINS', '1671257527_a8e2cc323dd3c755cf41.jpg', '<p>2 TRAINS/ AROUND CP/ 30m = P50</p>'),
(23, 'TRAMPOLINE ', '1671257635_46244ae67de3373a93bb.jpg', '<p>HIGH TRAMPOLINE/ 15mins = P150</p>'),
(24, 'ZIPLINE', '1671257691_a4587da7277f2e0a48bb.jpg', '<p>ADULT ZIPLINE/ 1 LINE = P150</p>');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rooms`
--

CREATE TABLE `tbl_rooms` (
  `id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `room_category_id` int(11) NOT NULL,
  `available_rooms` int(11) NOT NULL,
  `rate_per_night` int(11) NOT NULL,
  `room_description` text NOT NULL,
  `room_image` varchar(255) NOT NULL,
  `room_status` varchar(50) NOT NULL,
  `total_number_of_reserve` int(11) DEFAULT NULL,
  `date_added` date NOT NULL DEFAULT current_timestamp(),
  `room_checkin_date` date DEFAULT NULL,
  `room_checkout_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_rooms`
--

INSERT INTO `tbl_rooms` (`id`, `room_name`, `room_category_id`, `available_rooms`, `rate_per_night`, `room_description`, `room_image`, `room_status`, `total_number_of_reserve`, `date_added`, `room_checkin_date`, `room_checkout_date`) VALUES
(1, 'Family Room', 1, 10, 1000, '<h2>awdawd<strong>awd</strong></h2>', '1670373315_b95d9564eccc4010b43e.jpg', 'active', NULL, '2022-12-07', NULL, NULL),
(2, 'Don Paulo', 2, 2, 4500, '<p>kjankdfawkdfbakwdlawndlawndlkanwd</p>', '1670509164_91955e7a5168199b203f.jpg', 'active', NULL, '2022-12-08', NULL, NULL),
(3, 'Dona Esperanza', 2, 2, 4500, '<p>awfwafawfawfawf</p>', '1670509238_56d58a1bcc41d25c63c8.jpg', 'active', NULL, '2022-12-08', NULL, NULL),
(4, 'Dona Salvacion', 2, 2, 4500, '<p>kahwdhawldhalwd</p>', '1670509265_025632ab5c7c10959c94.jpg', 'active', NULL, '2022-12-08', NULL, NULL),
(5, 'Apartle', 3, 16, 3000, '<p>;m;padja;mdawdawjdpawjdpajwd</p>', '1670989346_2f16b0e178a9c473f2f5.jpg', 'active', NULL, '2022-12-12', NULL, NULL),
(6, 'villa op', 4, 2, 3000, '<p>tdydgdgfdgdgfdghfdfgdhfgdfdfgdf</p>', '1671032863_307fd2300965e847ffa7.jpg', 'active', NULL, '2022-12-14', NULL, NULL),
(7, 'Apartelle Family Room', 5, 6, 3500, '<p>The Apartelle Family Room Has Two Double-deck Beds And A Single Bed It Can Fit Up To 6 Persons</p>', '1671202462_c5f51b4fcb28d1a28b8e.jpg', 'active', NULL, '2022-12-16', NULL, NULL),
(8, 'Hotel Room', 7, 10, 1000, '<p>A room that\'s comfortable to take a rest with your love ones or by yourself, Including Bathroom, and TV.</p>', '1671202637_b636c8d2c5053331418a.jpg', 'active', NULL, '2022-12-16', NULL, NULL),
(9, 'Don Paulo', 6, 2, 4500, '<p>An elegant place to rest with your family or friends. Maximum of 6 person.&nbsp;<br>Including: Small Kitchen, Single Bathroom, Living Room And Room With Single Bed And TV</p>', '1671202723_38af4353b09b6ae24f86.jpg', 'active', NULL, '2022-12-16', NULL, NULL),
(10, 'Dona Esperanza', 6, 2, 4500, '<p>An elegant place to rest with your family or friends. Maximum of 6 person.&nbsp;<br>Including: Small Kitchen, Single Bathroom, Living Room And Room With Single Bed And TV</p>', '1671202867_622ed7603432772fa6db.jpg', 'active', NULL, '2022-12-16', NULL, NULL),
(11, 'Dona Salvacion', 6, 2, 4500, '<p>An elegant place to rest with your family or friends. Maximum of 6 person.&nbsp;<br>Including: Small Kitchen, Single Bathroom, Living Room And Room With Single Bed And TV</p>', '1671202948_ecd55a575bcfe602a887.jpg', 'active', NULL, '2022-12-16', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room_category`
--

CREATE TABLE `tbl_room_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `max_adults_capacity` int(11) DEFAULT NULL,
  `max_children_capacity` int(11) DEFAULT NULL,
  `date_added` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_room_category`
--

INSERT INTO `tbl_room_category` (`category_id`, `category_name`, `max_adults_capacity`, `max_children_capacity`, `date_added`) VALUES
(6, 'Executive Villa', 4, 2, '2022-12-16'),
(7, 'Hotel Rooms', 2, 0, '2022-12-16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room_number`
--

CREATE TABLE `tbl_room_number` (
  `room_number_id` int(11) NOT NULL,
  `room_number` varchar(255) NOT NULL,
  `room_number_status` varchar(255) NOT NULL COMMENT 'auto add value if the room number is occupied or not'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_room_number`
--

INSERT INTO `tbl_room_number` (`room_number_id`, `room_number`, `room_number_status`) VALUES
(1, 'Room 01', 'not available'),
(2, 'Villa #3s', 'not available'),
(4, 'Room 02', 'not available'),
(5, 'Room 03', 'not available');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room_reservation_transactions`
--

CREATE TABLE `tbl_room_reservation_transactions` (
  `transaction_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `unique_id` varchar(100) NOT NULL,
  `transaction_type` varchar(100) NOT NULL COMMENT 'online/walk-in',
  `payment_status` varchar(100) DEFAULT NULL,
  `total_bill` int(11) NOT NULL,
  `payment_deposit` int(11) NOT NULL,
  `time_arrival` varchar(255) DEFAULT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `transaction_status` varchar(100) DEFAULT NULL COMMENT 'pending/cancelled/accepted/completed',
  `total_person` int(11) NOT NULL,
  `gcash_reference_number` varchar(255) DEFAULT NULL,
  `cancellation_message` text DEFAULT NULL,
  `resubmit_ref` varchar(20) DEFAULT NULL COMMENT 'if gcash ref no. is wrong admin can set this colum to true so the customer can resubmit their gcash ref no.',
  `assigned_room_number` varchar(255) DEFAULT NULL,
  `transaction_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_room_reservation_transactions`
--

INSERT INTO `tbl_room_reservation_transactions` (`transaction_id`, `room_id`, `customer_id`, `unique_id`, `transaction_type`, `payment_status`, `total_bill`, `payment_deposit`, `time_arrival`, `checkin`, `checkout`, `transaction_status`, `total_person`, `gcash_reference_number`, `cancellation_message`, `resubmit_ref`, `assigned_room_number`, `transaction_date`) VALUES
(55, 8, '71', '948E3B0E2C', 'online', NULL, 4000, 2000, NULL, '2022-12-23', '2022-12-27', 'cancelled', 2, '1233456', NULL, NULL, NULL, '2022-12-17'),
(56, 8, '72', '3C27306E77', 'online', NULL, 1000, 500, NULL, '2022-12-18', '2022-12-19', 'accepted', 2, '099098337123', NULL, NULL, NULL, '2022-12-17'),
(57, 9, '72', '0A86AB9577', 'online', NULL, 324000, 162000, NULL, '2022-12-18', '2023-02-28', 'cancelled', 6, '9191919191', 'Baho ng pool', NULL, NULL, '2022-12-17'),
(58, 8, '79', '1C6155DBA3', 'online', NULL, 10000, 5000, NULL, '2022-12-20', '2022-12-30', 'accepted', 2, '62612636213612', NULL, NULL, NULL, '2022-12-18'),
(59, 8, '78', '595E6632FC', 'online', NULL, 1000, 500, NULL, '2022-12-27', '2022-12-28', 'accepted', 2, '13456', NULL, NULL, NULL, '2022-12-18'),
(60, 8, '78', 'D118F17043', 'online', 'fully paid', 1000, 500, NULL, '2022-12-18', '2022-12-19', 'accepted', 2, '1231232213', NULL, NULL, '1', '2022-12-18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shutdown_website`
--

CREATE TABLE `tbl_shutdown_website` (
  `id` int(11) NOT NULL,
  `room_reservation` int(11) NOT NULL,
  `event_reservation` int(11) NOT NULL,
  `login` int(11) NOT NULL,
  `register` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_shutdown_website`
--

INSERT INTO `tbl_shutdown_website` (`id`, `room_reservation`, `event_reservation`, `login`, `register`) VALUES
(1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_access` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `date_added` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `firstname`, `middlename`, `lastname`, `email`, `password`, `user_access`, `profile`, `date_added`) VALUES
(1, 'squidward', 'a', 'tentacles', 'squidward@email.com', '$2y$10$EutoVk2XRjukTFV1izXp/eYGR6FMb1MLZJbUB25jjoL9Q5CYXYGTe', 'admin', 'user_male.jpg', '2022-11-19'),
(5, 'admin', 'a', 'admin', 'admin@email.com', '$2y$10$V4Ne1MQTLepoyHnGjlx5qeTFP8wQMcW.gkfe24BjkVIMndBDvbXbW', 'admin', 'user_male.jpg', '2022-12-14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_activity_log`
--
ALTER TABLE `tbl_activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_contacts`
--
ALTER TABLE `tbl_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cottage`
--
ALTER TABLE `tbl_cottage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`,`email`,`gender`,`age`,`date_added`);

--
-- Indexes for table `tbl_entrance`
--
ALTER TABLE `tbl_entrance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_entrance_cottage_transaction`
--
ALTER TABLE `tbl_entrance_cottage_transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cottage_id` (`cottage_id`,`customer_id`,`date_visit`),
  ADD KEY `unique_id` (`unique_id`),
  ADD KEY `visit_type` (`visit_type`);

--
-- Indexes for table `tbl_events_places`
--
ALTER TABLE `tbl_events_places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_events_transaction`
--
ALTER TABLE `tbl_events_transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `tbl_payment_info`
--
ALTER TABLE `tbl_payment_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rate_reviews`
--
ALTER TABLE `tbl_rate_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rides`
--
ALTER TABLE `tbl_rides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rooms`
--
ALTER TABLE `tbl_rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_name` (`room_name`,`room_category_id`,`rate_per_night`),
  ADD KEY `room_status` (`room_status`,`date_added`),
  ADD KEY `available_rooms` (`available_rooms`);

--
-- Indexes for table `tbl_room_category`
--
ALTER TABLE `tbl_room_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_room_number`
--
ALTER TABLE `tbl_room_number`
  ADD PRIMARY KEY (`room_number_id`);

--
-- Indexes for table `tbl_room_reservation_transactions`
--
ALTER TABLE `tbl_room_reservation_transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `room_id` (`room_id`,`customer_id`,`transaction_type`,`payment_status`,`transaction_date`),
  ADD KEY `total_person` (`total_person`),
  ADD KEY `gcash_reference_number` (`gcash_reference_number`),
  ADD KEY `transaction_status` (`transaction_status`),
  ADD KEY `checkin` (`checkin`,`checkout`),
  ADD KEY `total_bill` (`total_bill`);

--
-- Indexes for table `tbl_shutdown_website`
--
ALTER TABLE `tbl_shutdown_website`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`firstname`,`middlename`,`lastname`),
  ADD KEY `email` (`email`,`user_access`,`date_added`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_activity_log`
--
ALTER TABLE `tbl_activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_contacts`
--
ALTER TABLE `tbl_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_cottage`
--
ALTER TABLE `tbl_cottage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `tbl_entrance`
--
ALTER TABLE `tbl_entrance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_entrance_cottage_transaction`
--
ALTER TABLE `tbl_entrance_cottage_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_events_places`
--
ALTER TABLE `tbl_events_places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_events_transaction`
--
ALTER TABLE `tbl_events_transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_payment_info`
--
ALTER TABLE `tbl_payment_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_rate_reviews`
--
ALTER TABLE `tbl_rate_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_rides`
--
ALTER TABLE `tbl_rides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_rooms`
--
ALTER TABLE `tbl_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_room_category`
--
ALTER TABLE `tbl_room_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_room_number`
--
ALTER TABLE `tbl_room_number`
  MODIFY `room_number_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_room_reservation_transactions`
--
ALTER TABLE `tbl_room_reservation_transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `tbl_shutdown_website`
--
ALTER TABLE `tbl_shutdown_website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
