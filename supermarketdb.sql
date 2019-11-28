-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2019 at 08:00 PM
-- Server version: 10.4.8-MariaDB
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
-- Database: `supermarketdb`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `totalAmount` (IN `billno` INT(9) UNSIGNED)  SELECT SUM(amount) FROM cart WHERE bill_no = billno$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `zipcode` int(6) NOT NULL,
  `state` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`zipcode`, `state`, `district`, `city`) VALUES
(561203, 'Karnataka', 'Bangalore Rural', 'Doddaballapur'),
(562157, 'Karnataka', 'Bangalore', 'Bangalore'),
(584128, 'Karnataka', 'Raichur', 'SINDHANUR'),
(587101, 'Karnataka', 'Bagalkot', 'Old Bagalkot'),
(591242, 'Karnataka', 'Belgaum', 'Athni');

-- --------------------------------------------------------

--
-- Table structure for table `billing_counter`
--

CREATE TABLE `billing_counter` (
  `bill_no` int(9) NOT NULL,
  `customer_id` int(4) NOT NULL,
  `employee_id` int(3) NOT NULL,
  `bdate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `billing_counter`
--

INSERT INTO `billing_counter` (`bill_no`, `customer_id`, `employee_id`, `bdate`) VALUES
(70, 1111, 111, '2019-11-23 23:53:34'),
(72, 1112, 111, '2019-11-24 11:43:07'),
(79, 2226, 111, '2019-11-24 14:49:20'),
(80, 2227, 111, '2019-11-24 16:06:14'),
(115, 2227, 111, '2019-11-29 00:05:18'),
(120, 2229, 111, '2019-11-29 00:22:49');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(4) NOT NULL,
  `model_id` int(5) NOT NULL,
  `quantity` int(3) NOT NULL,
  `amount` int(8) NOT NULL,
  `bill_no` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `model_id`, `quantity`, `amount`, `bill_no`) VALUES
(44, 12111, 1, 90, 70),
(47, 12111, 1, 90, 72),
(48, 12122, 2, 100, 72),
(66, 12111, 2, 200, 79),
(67, 12122, 1, 50, 79),
(68, 12111, 2, 100, 80),
(69, 12122, 5, 500, 80),
(118, 12111, 5, 1140, 115),
(125, 12111, 2, 456, 120),
(126, 12122, 1, 50, 120);

--
-- Triggers `cart`
--
DELIMITER $$
CREATE TRIGGER `amounts` BEFORE INSERT ON `cart` FOR EACH ROW BEGIN
UPDATE p_name,product
SET p_name.quantity=p_name.quantity-NEW.QUANTITY
WHERE NEW.MODEL_ID=product.model_id AND
product.name_id=p_name.name_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` bigint(10) NOT NULL,
  `zipcode` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `name`, `email`, `phone_no`, `zipcode`) VALUES
(1111, 'Vinayak S P', 'vinay@gmail.com', 9632587410, 562157),
(1112, 'Basu', 'basu@gmail.com', 8965231470, 584128),
(2226, 'Sammed', 'sammed@gmail.com', 8523987410, 591242),
(2227, 'Bhuvan', 'bhuvan@gmail.com', 8563256989, 562157),
(2229, 'Sachin Koppad', 'sachin@gmail.com', 6532568956, 587101);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` bigint(10) NOT NULL,
  `role` varchar(255) NOT NULL,
  `zipcode` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `name`, `email`, `phone_no`, `role`, `zipcode`) VALUES
(111, 'NBPatil', 'patil@gmail.com', 9955117755, 'Biller', 584128),
(112, 'Chandru', 'chand@gmail.com', 9658325614, 'Volunteer', 562157),
(114, 'Sachin', 'sachin@gmail.com', 8695352665, 'Security guard', 587101),
(116, 'Abhi', 'abhi@gmail.com', 6369856325, 'Biller', 561203);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(8) NOT NULL,
  `customer_id` int(4) NOT NULL,
  `pdate` datetime NOT NULL DEFAULT current_timestamp(),
  `amount` int(8) NOT NULL,
  `mode` varchar(255) NOT NULL,
  `bill_no` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `customer_id`, `pdate`, `amount`, `mode`, `bill_no`) VALUES
(6, 1111, '2019-11-23 23:53:53', 90, 'Cash', 70),
(7, 1112, '2019-11-24 11:44:01', 190, 'Cash', 72),
(10, 2226, '2019-11-24 14:49:52', 250, 'Cash', 79),
(11, 2227, '2019-11-24 16:06:50', 600, 'Card', 80),
(20, 2227, '2019-11-29 00:05:54', 1140, 'Card', 115),
(25, 2229, '2019-11-29 00:23:21', 506, 'Cash', 120);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `model_id` int(5) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`model_id`, `type`, `name_id`) VALUES
(12111, 'Tea Powder', 1),
(12122, 'Toothpaste', 14),
(12123, 'Mobile', 15);

-- --------------------------------------------------------

--
-- Table structure for table `product_shelves`
--

CREATE TABLE `product_shelves` (
  `shelf_id` int(2) NOT NULL,
  `type` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_shelves`
--

INSERT INTO `product_shelves` (`shelf_id`, `type`, `category`) VALUES
(1, 'Tea Powder', 'Daily Needs'),
(10, 'Toothpaste', 'Daily Needs'),
(18, 'Perfumes', 'Daily needs'),
(19, 'Mobile', 'Electronics');

-- --------------------------------------------------------

--
-- Table structure for table `p_name`
--

CREATE TABLE `p_name` (
  `name_id` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(8) NOT NULL,
  `quantity` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `p_name`
--

INSERT INTO `p_name` (`name_id`, `name`, `price`, `quantity`) VALUES
(1, 'Red Label Natural Care 500g', 228, 193),
(14, 'Colgate', 50, 199),
(15, 'Redmi Note8 Pro 6GB and 64GB', 14999, 200);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `name`) VALUES
(2, 'admin', 'admin', 'admin'),
(3, 'user', 'user', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`zipcode`),
  ADD UNIQUE KEY `zipcode` (`zipcode`);

--
-- Indexes for table `billing_counter`
--
ALTER TABLE `billing_counter`
  ADD PRIMARY KEY (`bill_no`),
  ADD UNIQUE KEY `bill_no` (`bill_no`),
  ADD KEY `fk_bcid` (`customer_id`),
  ADD KEY `fk_beid` (`employee_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `fk_cbno` (`bill_no`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `fk_zipcode` (`zipcode`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `fk_ezip` (`zipcode`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `fk_pbno` (`bill_no`),
  ADD KEY `fk_pcid` (`customer_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`model_id`),
  ADD KEY `fk_pnid` (`name_id`),
  ADD KEY `fk_ptype` (`type`);

--
-- Indexes for table `product_shelves`
--
ALTER TABLE `product_shelves`
  ADD PRIMARY KEY (`shelf_id`,`type`),
  ADD UNIQUE KEY `type` (`type`);

--
-- Indexes for table `p_name`
--
ALTER TABLE `p_name`
  ADD PRIMARY KEY (`name_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing_counter`
--
ALTER TABLE `billing_counter`
  MODIFY `bill_no` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2230;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `model_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12124;

--
-- AUTO_INCREMENT for table `product_shelves`
--
ALTER TABLE `product_shelves`
  MODIFY `shelf_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `p_name`
--
ALTER TABLE `p_name`
  MODIFY `name_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `billing_counter`
--
ALTER TABLE `billing_counter`
  ADD CONSTRAINT `fk_bcid` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_beid` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cbno` FOREIGN KEY (`bill_no`) REFERENCES `billing_counter` (`bill_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_zipcode` FOREIGN KEY (`zipcode`) REFERENCES `address` (`zipcode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `fk_ezip` FOREIGN KEY (`zipcode`) REFERENCES `address` (`zipcode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_pbno` FOREIGN KEY (`bill_no`) REFERENCES `billing_counter` (`bill_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pcid` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_pnid` FOREIGN KEY (`name_id`) REFERENCES `p_name` (`name_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ptype` FOREIGN KEY (`type`) REFERENCES `product_shelves` (`type`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
