-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2022 at 09:54 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbmitush1`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbadmin`
--

CREATE TABLE `tbadmin` (
  `fld_id` int(11) NOT NULL,
  `fld_username` varchar(30) NOT NULL,
  `fld_password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbadmin`
--

INSERT INTO `tbadmin` (`fld_id`, `fld_username`, `fld_password`) VALUES
(1, 'admin', 'admin@123');

-- --------------------------------------------------------

--
-- Table structure for table `tbclothes`
--

CREATE TABLE `tbclothes` (
  `clothe_id` int(11) NOT NULL,
  `fldvendor_id` int(11) NOT NULL,
  `clothename` varchar(100) NOT NULL,
  `cost` bigint(15) NOT NULL,
  `descriptions` varchar(50) NOT NULL,
  `paymentmode` varchar(50) NOT NULL,
  `fldimage` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbclothes`
--

INSERT INTO `tbclothes` (`clothe_id`, `fldvendor_id`, `clothename`, `cost`, `descriptions`, `paymentmode`, `fldimage`) VALUES
(34, 28, 'trouser', 200, 'red', 'COD', '5.jpg'),
(35, 28, 'shirt', 200, 'black', 'COD', '8.jpg'),
(36, 29, 'boots', 500, 'durable shoes', 'COD', 's.jpg'),
(37, 29, 'shoes', 400, 'sports shoe', 'COD', '13.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblcart`
--

CREATE TABLE `tblcart` (
  `fld_cart_id` int(11) NOT NULL,
  `fld_product_id` bigint(11) NOT NULL,
  `fld_customer_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblcart`
--

INSERT INTO `tblcart` (`fld_cart_id`, `fld_product_id`, `fld_customer_id`) VALUES
(36, 11, 'eric1@gmail.com'),
(38, 23, 'eric4@gmail.com'),
(43, 30, 'eric@gmail.com'),
(45, 30, 'eric@gmail.com'),
(46, 31, 'eric@gmail.com'),
(47, 28, 'eric@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomer`
--

CREATE TABLE `tblcustomer` (
  `fld_cust_id` int(10) NOT NULL,
  `fld_name` varchar(30) NOT NULL,
  `fld_email` varchar(30) NOT NULL,
  `fld_mobile` bigint(10) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblcustomer`
--

INSERT INTO `tblcustomer` (`fld_cust_id`, `fld_name`, `fld_email`, `fld_mobile`, `password`) VALUES
(7, 'eric', 'eric4@gmail.com', 7098776666, '12345'),
(8, 'millie', 'millie1@gmail.com', 7098776666, '1234'),
(9, 'customer', 'customer@gmail.com', 798458697, '1234');

-- --------------------------------------------------------

--
-- Table structure for table `tblmessage`
--

CREATE TABLE `tblmessage` (
  `fld_msg_id` int(10) NOT NULL,
  `fld_name` varchar(50) NOT NULL,
  `fld_email` varchar(50) NOT NULL,
  `fld_phone` bigint(10) DEFAULT NULL,
  `fld_msg` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblorder`
--

CREATE TABLE `tblorder` (
  `fld_order_id` int(10) NOT NULL,
  `fld_cart_id` bigint(10) NOT NULL,
  `fldvendor_id` bigint(10) DEFAULT NULL,
  `fld_clothe_id` bigint(10) DEFAULT NULL,
  `fld_email_id` varchar(50) DEFAULT NULL,
  `fld_payment` varchar(20) DEFAULT NULL,
  `fldstatus` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblorder`
--

INSERT INTO `tblorder` (`fld_order_id`, `fld_cart_id`, `fldvendor_id`, `fld_clothe_id`, `fld_email_id`, `fld_payment`, `fldstatus`) VALUES
(17, 39, 25, 9, 'eric@gmail.com', '234', 'In Process'),
(18, 37, 26, 22, 'eric@gmail.com', '120', 'In Process'),
(19, 50, 27, 30, 'customer@gmail.com', '400', 'Delivered'),
(20, 51, 27, 32, 'customer@gmail.com', '300', 'Delivered'),
(21, 54, 27, 30, 'customer@gmail.com', '400', 'Delivered'),
(22, 56, 27, 32, 'customer@gmail.com', '300', 'In Process');

-- --------------------------------------------------------

--
-- Table structure for table `tblvendor`
--

CREATE TABLE `tblvendor` (
  `fldvendor_id` int(10) NOT NULL,
  `fld_name` varchar(30) NOT NULL,
  `fld_email` varchar(50) NOT NULL,
  `fld_password` varchar(50) NOT NULL,
  `fld_mob` bigint(10) NOT NULL,
  `fld_phone` bigint(10) NOT NULL,
  `fld_address` varchar(50) NOT NULL,
  `fld_logo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblvendor`
--

INSERT INTO `tblvendor` (`fldvendor_id`, `fld_name`, `fld_email`, `fld_password`, `fld_mob`, `fld_phone`, `fld_address`, `fld_logo`) VALUES
(28, 'millie', 'millie@gmail.com', '12345', 798458697, 798458697, '33', 'bg10.jpg'),
(29, 'vendor', 'vendor@gmai.com', '12345', 798458697, 111234567, '267-300 meru', '9c935e14be80fcfa4233736a7d3d5a26.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbadmin`
--
ALTER TABLE `tbadmin`
  ADD PRIMARY KEY (`fld_id`);

--
-- Indexes for table `tbclothes`
--
ALTER TABLE `tbclothes`
  ADD PRIMARY KEY (`clothe_id`),
  ADD KEY `fldvendor_id` (`fldvendor_id`);

--
-- Indexes for table `tblcart`
--
ALTER TABLE `tblcart`
  ADD PRIMARY KEY (`fld_cart_id`);

--
-- Indexes for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  ADD PRIMARY KEY (`fld_cust_id`);

--
-- Indexes for table `tblmessage`
--
ALTER TABLE `tblmessage`
  ADD PRIMARY KEY (`fld_msg_id`);

--
-- Indexes for table `tblorder`
--
ALTER TABLE `tblorder`
  ADD PRIMARY KEY (`fld_order_id`);

--
-- Indexes for table `tblvendor`
--
ALTER TABLE `tblvendor`
  ADD PRIMARY KEY (`fldvendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbadmin`
--
ALTER TABLE `tbadmin`
  MODIFY `fld_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbclothes`
--
ALTER TABLE `tbclothes`
  MODIFY `clothe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tblcart`
--
ALTER TABLE `tblcart`
  MODIFY `fld_cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  MODIFY `fld_cust_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblmessage`
--
ALTER TABLE `tblmessage`
  MODIFY `fld_msg_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblorder`
--
ALTER TABLE `tblorder`
  MODIFY `fld_order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tblvendor`
--
ALTER TABLE `tblvendor`
  MODIFY `fldvendor_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbclothes`
--
ALTER TABLE `tbclothes`
  ADD CONSTRAINT `tbclothes_ibfk_1` FOREIGN KEY (`fldvendor_id`) REFERENCES `tblvendor` (`fldvendor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
