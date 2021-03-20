-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2021 at 12:37 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `songalia_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_types`
--

CREATE TABLE `account_types` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_types`
--

INSERT INTO `account_types` (`id`, `name`, `description`) VALUES
(1, 'local', NULL),
(2, 'goole', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `buyers`
--

CREATE TABLE `buyers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `middle_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(64) NOT NULL,
  `address_primary` longtext NOT NULL,
  `address_secondary` longtext DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NULL DEFAULT current_timestamp(),
  `account_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buyers`
--

INSERT INTO `buyers` (`id`, `first_name`, `middle_name`, `last_name`, `gender`, `email`, `password`, `address_primary`, `address_secondary`, `created`, `modified`, `account_type_id`) VALUES
(2, 'John', 'Doe', 'Cena', 0, 'john@gmail.com', '1234', 'Cavitex', NULL, '2021-02-11 11:56:09', '2021-02-11 11:56:09', 1),
(3, 'Jane', 'Gang', 'Doe', 1, '111@cake.com', '111', 'Choromium st. Platinumville cmnd.', '', '2021-02-11 12:37:39', '2021-02-11 12:37:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `buyer_id`, `product_id`, `quantity`) VALUES
(1, 2, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `file_name` varchar(120) NOT NULL,
  `file_root` varchar(120) NOT NULL,
  `file_size_kb` int(11) NOT NULL,
  `file_type` varchar(64) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `file_name`, `file_root`, `file_size_kb`, `file_type`, `product_id`) VALUES
(1, 'p1.webp', '/img/products/', 99, 'image', 3),
(2, 'p2.webp', '/img/products/', 99, 'image', 3),
(3, 'p3.webp', '/img/products/', 99, 'image', 4),
(4, 'p5.webp', '/img/products/', 99, 'image', 4),
(5, 'p6.webp', '/img/products/', 99, 'image', 3),
(6, 'p7.webp', '/img/products/', 99, 'image', 4),
(7, 'p8.webp', '/img/products/', 99, 'image', 3),
(8, 'p9.webp', '/img/products/', 99, 'image', 4),
(9, 'p10.webp', '/img/products/', 99, 'image', 5),
(10, 'p11.webp', '/img/products/', 99, 'image', 6),
(11, 'p12.webp', '/img/products/', 99, 'image', 5),
(14, 'p1.webp', '/img/products/', 99, 'image', 7),
(15, 'p12.webp', '/img/products/', 99, 'image', 9),
(16, 'p11.webp', '/img/products/', 99, 'image', 9),
(17, 'p11.webp', '/img/products/', 99, 'image', 9),
(18, 'p11.webp', '/img/products/', 99, 'image', 9),
(19, 'p11.webp', '/img/products/', 99, 'image', 9),
(20, 'p11.webp', '/img/products/', 99, 'image', 9),
(21, 'p11.webp', '/img/products/', 99, 'image', 9),
(22, 'p11.webp', '/img/products/', 99, 'image', 9),
(23, 'p11.webp', '/img/products/', 99, 'image', 9),
(24, 'p11.webp', '/img/products/', 99, 'image', 9),
(25, 'p11.webp', '/img/products/', 99, 'image', 9),
(26, 'p12.webp', '/img/products/', 99, 'image', 8),
(27, 'p9.webp', '/img/products/', 99, 'image', 4),
(28, 'p9.webp', '/img/products/', 99, 'image', 7),
(29, 'p9.webp', '/img/products/', 99, 'image', 8),
(30, 'p9.webp', '/img/products/', 99, 'image', 9),
(31, 'p9.webp', '/img/products/', 99, 'image', 5),
(32, 'p7.webp', '/img/products/', 99, 'image', 5),
(33, 'p11.webp', '/img/products/', 99, 'image', 5),
(34, 'p11.webp', '/img/products/', 99, 'image', 5),
(35, 'p11.webp', '/img/products/', 99, 'image', 5),
(36, 'p11.webp', '/img/products/', 99, 'image', 5),
(37, 'p11.webp', '/img/products/', 99, 'image', 5),
(38, 'p11.webp', '/img/products/', 99, 'image', 5),
(39, 'p11.webp', '/img/products/', 99, 'image', 5),
(40, 'p11.webp', '/img/products/', 99, 'image', 5);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `description` longtext DEFAULT NULL,
  `is_available` tinyint(4) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `seller_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sold` int(11) NOT NULL DEFAULT 0,
  `warranty_day` int(11) NOT NULL DEFAULT 0,
  `discount_percentage` decimal(15,2) NOT NULL DEFAULT 0.00,
  `product_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `is_available`, `created`, `modified`, `seller_id`, `quantity`, `sold`, `warranty_day`, `discount_percentage`, `product_type_id`) VALUES
(3, 'Strong Morning Coffee Cup', '21.00', 'PREMIUM POWDER COATING SURFACE: Powder coating allows you to hold the cup without slipping because of wet. It also allows you to hold it without worrying of possible harm from your hot drink inside the cup.', 1, '2021-02-11 11:58:10', '2021-02-12 03:55:42', 1, 12, 3, 31, '10.00', 1),
(4, 'Glass Coffee Cup', '60.00', 'none', 0, '2021-02-12 02:43:48', '2021-02-12 02:43:48', 1, 21, 1, 1, '0.00', 1),
(5, 'Sledgers Mens Paulo Slip On (Black)', '299.00', ' Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility\r\n', 0, '2021-03-06 03:35:43', '2021-03-16 09:11:05', 1, 99, 10, 7, '10.00', 2),
(6, 'Himalayan Salt Lamp with FREE 5ml Jade Essentials Roman Chamomile Essential Oil and 5ml Peppermint Essential OIl', '788.00', 'Product details of Himalayan Salt Lamp with FREE 5ml Jade Essentials Roman Chamomile Essential Oil and 5ml Peppermint Essential OIl\r\nPurifies the air\r\nActs as natural deodorizer\r\nCalms allergies and reduces asthma\r\nNeutralizes electromagnetic radiation\r\nIncreases blood flow\r\nEnhances sleep quality\r\nBoosts serotonin level\r\nImproves mood and concentration level\r\nIncreases energy level\r\nReduces stress', 1, '2021-03-06 03:37:54', '2021-03-06 03:37:54', 1, 99, 15, 7, '0.00', 2),
(7, 'Glass Coffee Cup High Quality Buy 1 Take 1 Promo for new Buyers MONAOZNE Nordic Ceramic Coffee Cup with Cup Saucer and S', '60.00', 'Product details of MONAOZNE Nordic Ceramic Coffee Cup with Cup Saucer and Spoon Ins Afternoon Tea Set with Gold Handle Modern Minimalist Creative Home Coffee Cup Dish Set Home Simple Mug Four Colors\r\nMaterial: saucer:New bone china/spoon:304 stainless steel\r\nCraft：saucer:Underglaze color + high temperature deca/spoon:Plating + mirror\r\nQuantity:one piece\r\nFunction: Can be used with coffee, tea, water，etc.\r\nWarning:microwave oven,oven,dishwasher and disinfection cabinetforbidden.Product details of MONAOZNE Nordic Ceramic Coffee Cup with Cup Saucer and Spoon Ins Afternoon Tea Set with Gold Handle Modern Minimalist Creative Home Coffee Cup Dish Set Home Simple Mug Four Colors\r\nMaterial: saucer:New bone china/spoon:304 stainless steel\r\nCraft：saucer:Underglaze color + high temperature deca/spoon:Plating + mirror\r\nQuantity:one piece\r\nFunction: Can be used with coffee, tea, water，etc.\r\nWarning:microwave oven,oven,dishwasher and disinfection cabinetforbidden.', 1, '2021-02-12 02:43:48', '2021-02-12 02:43:48', 1, 21, 45, 1, '0.00', 1),
(8, 'Sledgers Mens Paulo Slip On (Black)', '299.00', ' Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility', 0, '2021-03-06 03:35:43', '2021-03-14 01:36:42', 1, 99, 10, 7, '10.00', 2),
(9, 'Sledgers Mens Paulo Slip On (Black)', '299.00', ' Ortholite\r\n- Soft Step\r\n- Flex and Move\r\n- Perforated leather loafers made breathable for more comfortable drives. Made with a molded cup insoles for maximum comfort & mobility', 0, '2021-03-06 03:35:43', '2021-03-14 01:36:42', 1, 99, 10, 7, '10.00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `products_tags`
--

CREATE TABLE `products_tags` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products_tags`
--

INSERT INTO `products_tags` (`id`, `product_id`, `tag_id`) VALUES
(1, 3, 1),
(2, 4, 2),
(3, 3, 2),
(5, 6, 2),
(6, 6, 3),
(7, 5, 4),
(9, 5, 3),
(10, 4, 1),
(11, 9, 1),
(12, 8, 4),
(13, 9, 4),
(14, 7, 3),
(15, 9, 3),
(16, 3, 5),
(17, 4, 5),
(18, 5, 5),
(19, 6, 5),
(20, 7, 5),
(21, 8, 5),
(22, 9, 5);

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `name`, `description`) VALUES
(1, 'Best Sellers', NULL),
(2, 'Discover', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `middle_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `email` varchar(120) NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `address` longtext NOT NULL,
  `password` varchar(120) NOT NULL,
  `account_type_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`id`, `first_name`, `middle_name`, `last_name`, `email`, `gender`, `address`, `password`, `account_type_id`, `created`, `modified`) VALUES
(1, 'Joe', 'Jo', 'Mojo', 'joe@gmai.com', 1, 'Cavitex', '1234', 1, '2021-02-11 11:57:41', '2021-02-11 11:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(1, 'Ceramic'),
(2, 'Glass'),
(3, 'Light'),
(4, 'Apparel'),
(5, 'High Quality');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_types`
--
ALTER TABLE `account_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buyers`
--
ALTER TABLE `buyers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_account_types` (`account_type_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_cart_buyers` (`buyer_id`),
  ADD KEY `FK_cart_products` (`product_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_product_images` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_sellers` (`seller_id`),
  ADD KEY `Fk_product_types` (`product_type_id`);

--
-- Indexes for table `products_tags`
--
ALTER TABLE `products_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_tags` (`tag_id`),
  ADD KEY `FK_products` (`product_id`);

--
-- Indexes for table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_account_type` (`account_type_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_types`
--
ALTER TABLE `account_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `buyers`
--
ALTER TABLE `buyers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products_tags`
--
ALTER TABLE `products_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buyers`
--
ALTER TABLE `buyers`
  ADD CONSTRAINT `FK_account_types` FOREIGN KEY (`account_type_id`) REFERENCES `account_types` (`id`);

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `FK_cart_buyers` FOREIGN KEY (`buyer_id`) REFERENCES `buyers` (`id`),
  ADD CONSTRAINT `FK_cart_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_product_images` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_sellers` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`),
  ADD CONSTRAINT `Fk_product_types` FOREIGN KEY (`product_type_id`) REFERENCES `product_types` (`id`);

--
-- Constraints for table `products_tags`
--
ALTER TABLE `products_tags`
  ADD CONSTRAINT `FK_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `FK_tags` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

--
-- Constraints for table `sellers`
--
ALTER TABLE `sellers`
  ADD CONSTRAINT `FK_account_type` FOREIGN KEY (`account_type_id`) REFERENCES `account_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
