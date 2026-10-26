-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 26, 2026 at 09:12 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `musicstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `country` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `name`, `country`) VALUES
(1, 'Solaris', 'Hungary'),
(2, 'Renegade Brass Band', 'United Kingdom'),
(3, 'Celldweller', 'United States');

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1787685349);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text DEFAULT NULL,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('@managePosts', 2, 'Manage posts', NULL, NULL, 1787685349, 1787685349),
('admin', 1, NULL, NULL, NULL, 1787685349, 1787685349);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', '@managePosts');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `auth_key_expire` date NOT NULL,
  `password_hash` varchar(25) NOT NULL,
  `password_reset_token` varchar(25) NOT NULL,
  `status` int(11) NOT NULL,
  `creation_datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `username`, `email`, `auth_key`, `auth_key_expire`, `password_hash`, `password_reset_token`, `status`, `creation_datetime`) VALUES
(1, 'Antal Bikas', 'abikas@localhost', 'qw', '2026-07-23', 'd', 'f', 1, '2026-07-31 13:00:29'),
(4, 'Miklos Szurke', 'mgrey@localhost', 'authkey', '2026-07-23', 'pass', 'smash', 2, '2026-07-31 12:32:04');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1787681675),
('m140506_102106_rbac_init', 1787682758),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1787682758),
('m180523_151638_rbac_updates_indexes_without_prefix', 1787682758),
('m200409_110543_rbac_update_mssql_trigger', 1787682758),
('m260825_200430_create_user_table', 1787689060);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `customerid` int(11) DEFAULT NULL,
  `statusid` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `datetime`, `customerid`, `statusid`) VALUES
(1, '2027-03-12 00:00:00', 1, 2),
(2, '2027-03-15 00:00:00', 1, 3),
(3, '2026-03-15 00:00:00', 4, 5),
(4, '2026-10-25 21:13:49', 1, 2),
(5, '2026-10-25 21:20:36', 4, 1),
(7, '2026-10-26 20:27:08', 1, 4),
(8, '2026-10-26 21:06:53', 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price_value` double NOT NULL,
  `price_currency` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `orderid`, `productid`, `quantity`, `price_value`, `price_currency`) VALUES
(1, 1, 1, 1, 0, ''),
(3, 3, 2, 1, 10, 'eur'),
(4, 3, 1, 1, 7, 'eur'),
(5, 7, 4, 1, 19, 'usd'),
(6, 7, 1, 3, 7, 'eur'),
(7, 1, 2, 1, 10, 'eur'),
(8, 5, 3, 1, 25, 'eur'),
(9, 4, 4, 1, 19, 'usd'),
(10, 2, 2, 1, 10, 'eur');

-- --------------------------------------------------------

--
-- Table structure for table `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `name`) VALUES
(1, 'pending'),
(2, 'confirmed'),
(3, 'processing'),
(4, 'shipped'),
(5, 'received'),
(6, 'cancelled'),
(7, 'refunded'),
(8, 'failed'),
(9, 'on hold');

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `value` double NOT NULL,
  `currency` varchar(3) NOT NULL DEFAULT 'eur',
  `startdate` date NOT NULL,
  `enddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `productid`, `value`, `currency`, `startdate`, `enddate`) VALUES
(1, 1, 5, 'eur', '2020-01-01', '2024-01-01'),
(2, 2, 10, 'eur', '2025-02-21', '2027-03-15'),
(3, 3, 25, 'eur', '2025-05-15', '2027-01-01'),
(4, 1, 7, 'eur', '2024-01-02', '2027-01-01'),
(5, 4, 19, 'usd', '2019-01-02', '2027-01-01'),
(6, 5, 29, 'usd', '2026-10-12', '0002-02-01'),
(7, 5, 29, 'usd', '2026-10-12', '2027-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `releaseid` int(11) NOT NULL,
  `mediaid` int(11) NOT NULL DEFAULT 1,
  `available_from_date` date NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `releaseid`, `mediaid`, `available_from_date`, `stock`) VALUES
(1, 3, 1, '2014-09-01', 1),
(2, 6, 1, '2026-10-24', 1),
(3, 3, 4, '2023-05-10', 300),
(4, 7, 1, '2017-01-01', 1),
(5, 7, 2, '2026-10-21', 300);

-- --------------------------------------------------------

--
-- Table structure for table `product_medias`
--

CREATE TABLE `product_medias` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_medias`
--

INSERT INTO `product_medias` (`id`, `name`) VALUES
(1, 'digital download'),
(2, 'compact disc'),
(3, 'minidisc'),
(4, 'vinyl'),
(5, 'cassette');

-- --------------------------------------------------------

--
-- Table structure for table `releases`
--

CREATE TABLE `releases` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `artistid` int(11) NOT NULL,
  `date` date NOT NULL,
  `typeid` int(11) NOT NULL DEFAULT 1,
  `genre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `releases`
--

INSERT INTO `releases` (`id`, `title`, `artistid`, `date`, `typeid`, `genre`) VALUES
(1, 'Nostradamus', 1, '1990-02-11', 1, 'progressive rock'),
(2, 'NOAB', 1, '1989-10-23', 1, 'progressive rock'),
(3, 'RBB: Rhymes, Beats & Brass', 2, '2014-08-04', 1, 'jazz/rap'),
(4, 'Totems', 2, '2019-06-13', 1, 'jazz/rap'),
(5, 'Martian Chronicles', 1, '1984-03-14', 1, 'progressive rock'),
(6, 'Can\'t Stop', 2, '2021-08-16', 2, 'jazz/rap'),
(7, 'End of an Empire', 3, '2015-07-07', 1, 'metal');

-- --------------------------------------------------------

--
-- Table structure for table `release_types`
--

CREATE TABLE `release_types` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `release_types`
--

INSERT INTO `release_types` (`id`, `name`) VALUES
(1, 'album'),
(2, 'EP'),
(3, 'single');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `auth_key_expire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `auth_key_expire`) VALUES
(1, 'admin', 'egyedi-auth-key', '$2y$13$56hg99O3urXsq.T83eCni.Ua9kNiYi1Bw6/9xj6LAIjOtvRbMGcB2', NULL, 'admin@example.com', 10, 1787690942, 1787690942, 3600),
(2, 'staff', 'egyedi-auth-key2', '$2y$13$o36TWALtpUNZzfwP3V4FNO3E803Lnu2m6X.QPLtDmfxy9RJ.gNHSq', NULL, 'staff@example.com', 10, 1793032368, 1793032368, 3600);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_username` (`username`),
  ADD UNIQUE KEY `uniq_email` (`email`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `statusid` (`statusid`),
  ADD KEY `userid` (`customerid`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderid` (`orderid`),
  ADD KEY `productid` (`productid`);

--
-- Indexes for table `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productid` (`productid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mediaid` (`mediaid`),
  ADD KEY `releaseid` (`releaseid`);

--
-- Indexes for table `product_medias`
--
ALTER TABLE `product_medias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `releases`
--
ALTER TABLE `releases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artistid` (`artistid`),
  ADD KEY `typeid` (`typeid`);

--
-- Indexes for table `release_types`
--
ALTER TABLE `release_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_medias`
--
ALTER TABLE `product_medias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `releases`
--
ALTER TABLE `releases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `release_types`
--
ALTER TABLE `release_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`statusid`) REFERENCES `order_statuses` (`id`),
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`customerid`) REFERENCES `customers` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`orderid`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_3` FOREIGN KEY (`productid`) REFERENCES `products` (`id`);

--
-- Constraints for table `prices`
--
ALTER TABLE `prices`
  ADD CONSTRAINT `prices_ibfk_1` FOREIGN KEY (`productid`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`mediaid`) REFERENCES `product_medias` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`releaseid`) REFERENCES `releases` (`id`);

--
-- Constraints for table `releases`
--
ALTER TABLE `releases`
  ADD CONSTRAINT `releases_ibfk_1` FOREIGN KEY (`artistid`) REFERENCES `artists` (`id`),
  ADD CONSTRAINT `releases_ibfk_2` FOREIGN KEY (`typeid`) REFERENCES `release_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
