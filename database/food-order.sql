-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2023 at 02:08 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(16, 'Admin', 'Admin', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(7, 'Burger', 'Food_category_576.jpg', 'yes', 'yes'),
(8, 'PIZZA', 'Food_category_784.jpg', 'yes', 'yes'),
(9, 'FRIED RICE', 'Food_category_627.jpg', 'yes', 'yes'),
(10, 'KOTTU', 'Food_category_39.jpg', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(17, 'TOP-BURGER', 'Enjoy with Burgers', '150.00', 'Food-Name-1250.jpg', 7, 'Yes', 'Yes'),
(18, 'MENU-BURGER', 'Enjoy with Burgers', '180.00', 'Food-Name-4091.jpg', 7, 'Yes', 'Yes'),
(19, 'Pepparoni Pizza', 'Enjoy with Pizza', '1900.00', 'Food-Name-9100.jpg', 10, 'Yes', 'Yes'),
(20, 'Vege Pizza', 'Pizzy cheesy', '1200.00', 'Food-Name-7624.jpg', 8, 'Yes', 'Yes'),
(21, 'Egg Rice', 'Happy with Meal', '400.00', 'Food-Name-2954.png', 9, 'Yes', 'Yes'),
(22, 'Vege Rice', 'Enjoy your meal', '300.00', 'Food-Name-8106.jpg', 9, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` decimal(10,2) NOT NULL,
  `total` varchar(255) NOT NULL,
  `order_date` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `customer_name` varchar(10) NOT NULL,
  `customer_contact` int(10) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'Food1', '26.00', '2.00', '52', '2023-09-01', 'Ordered', 'sdkndsf', 2586, 'dushmantha16ranathunga@gmail.com', 'E/88/1/2, Wahakula, Ruwanwella.'),
(2, 'Food1', '26.00', '3.00', '78', '2023-09-01', 'Ordered', 'ganster', 32564, 'dushmantha16ranathunga@gmail.com', 'afdhbm cvbmfld  '),
(3, 'Food 2', '45.00', '3.00', '135', '2023-09-01', 'Delivered', 'jkmlk', 3541336, 'dushmantha4ranathunga@gmail.com', 'xsdmk cgvm  \r\nsdsfg df \r\n cvsdf'),
(4, 'Food 2', '45.00', '1.00', '45', '2023-09-01', 'Delivered', 'add jhkhbf', 6543, 'dushmantha5ranathunga@gmail.com', 'SVF\r\nDB \r\nDFGGRH'),
(5, 'Food1', '26.00', '1.00', '26', '2023-09-01', 'ordered', 'klji;lj ', 652, 'dushmantha56ranathunga@gmail.com', 'add vdf  bfdg   f'),
(6, 'Pepparoni Pizza', '1900.00', '1.00', '1900', '2023-09-02', 'ordered', 'DR', 720421867, 'dushmantha15ranathunga@gmail.com', 'E/88/1/2, Wahakula, Ruwanwella.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
