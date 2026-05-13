-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2025 at 03:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `anniversary`
--

CREATE TABLE `anniversary` (
  `id` int(10) NOT NULL,
  `anniversary_category_name` varchar(50) NOT NULL,
  `anniversary_category_quantity` int(10) DEFAULT 0,
  `anniversary_category_status` binary(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `banner_id` int(11) NOT NULL,
  `banner_subtitle` varchar(50) NOT NULL,
  `banner_title` text NOT NULL,
  `banner_image` varchar(50) NOT NULL,
  `banner_title_color` varchar(10) DEFAULT '#000000',
  `banner_subtitle_color` varchar(10) DEFAULT '#000000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`banner_id`, `banner_subtitle`, `banner_title`, `banner_image`, `banner_title_color`, `banner_subtitle_color`) VALUES
(9, 'Kraftin\'e', 'Welcome to KRAFTIN\'E', 'banner-1.jpg', '#ffffff', '#ffffff'),
(10, 'Hello', 'Catch up with us!!!', 'banner-3.jpg', '#ffffff', '#ffffff'),
(11, 'sun', 'flower', 'banner-2.png', '#ffffff', '#ffffff');

-- --------------------------------------------------------

--
-- Table structure for table `birthday`
--

CREATE TABLE `birthday` (
  `id` int(10) NOT NULL,
  `birthday_category_name` varchar(50) NOT NULL,
  `birthday_category_quantity` int(10) DEFAULT 0,
  `birthday_category_status` binary(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_price` decimal(10,2) DEFAULT NULL,
  `product_img` varchar(255) DEFAULT NULL,
  `product_qty` int(11) DEFAULT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `img`, `created_at`, `updated_at`) VALUES
(7, 'BIRTHDAY', 'images.png', '2025-04-20 09:03:39', '2025-04-20 17:03:39'),
(8, 'ANNIVERSARY', 'egore911_2_hearts.png', '2025-04-20 09:35:17', '2025-04-20 17:35:17'),
(9, 'VALENTINE\'S DAY', 'cupid-monogram-valentines-day-free-svg-file-SvgHeart.Com.png', '2025-04-20 09:37:04', '2025-04-20 17:37:04'),
(10, 'WEDDING', 'wedding heart.svg', '2025-04-20 09:38:50', '2025-04-20 17:38:50'),
(11, 'MOTHER\'S DAY', 'Happy-Mothers-Day-b-93832-600x450.png', '2025-04-20 09:41:05', '2025-04-20 17:41:05'),
(12, 'FATHER\'S DAY', 'happy-father-s-day-svg_847298-996.avif', '2025-04-20 09:41:50', '2025-04-20 17:41:50'),
(13, 'SYMPATHY', 'hand-drawn-dove-outline-illustration_23-2149255735.avif', '2025-04-20 09:42:49', '2025-04-20 17:42:49');

-- --------------------------------------------------------

--
-- Table structure for table `category_bar`
--

CREATE TABLE `category_bar` (
  `id` int(10) NOT NULL,
  `category_title` varchar(50) NOT NULL,
  `category_quantity` int(10) NOT NULL,
  `category_img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_bar`
--

INSERT INTO `category_bar` (`id`, `category_title`, `category_quantity`, `category_img`) VALUES
(14, 'Roses', 0, 'flower_10.jpg'),
(15, 'Petals', 0, 'flower_16.jpg'),
(16, 'mariposa', 0, 'flower_25.jpg'),
(17, 'crafts', 0, 'flower_7.jpg'),
(18, 'Sunflower', 0, 'flower_5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `category_memorial_day`
--

CREATE TABLE `category_memorial_day` (
  `id` int(10) NOT NULL,
  `category_name` varchar(30) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(100) NOT NULL,
  `customer_fname` varchar(50) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_pwd` varchar(100) NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_role` varchar(50) NOT NULL DEFAULT 'normal',
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_fname`, `customer_email`, `customer_pwd`, `customer_phone`, `customer_address`, `customer_role`, `status`) VALUES
(39, 'Lianne Damaso', 'liannedamaso@gmail.com', 'damaso12345', '00000000000', 'Teresa, Rizal', 'admin', 1),
(41, 'John Rafael B. Manusca', 'manusca.jr@gmail.com', 'rafael12345', '09260457174', 'Antipolo, Rizal', 'admin', 1),
(42, 'Rafael', 'sample@gmail.com', 'Raprap123.', '22222222222', 'CARIGMA', 'normal', 1),
(43, 'rap', 'raprap.28@gmail.com', 'Raprap12345.', '66666666666', 'st thomas', 'normal', 1),
(44, 'Celine Gonzales', 'user@gmail.com', '@Password123', '09123456789', 'marikina city', 'normal', 1),
(45, 'rod', 'rod@gmail.com', 'Rod123..', '99999999999', 'santolan', 'normal', 1);

-- --------------------------------------------------------

--
-- Table structure for table `deal_of_the_day`
--

CREATE TABLE `deal_of_the_day` (
  `deal_id` int(10) NOT NULL,
  `deal_title` text NOT NULL,
  `deal_description` text NOT NULL,
  `deal_net_price` double(10,2) NOT NULL,
  `deal_discounted_price` double(10,2) NOT NULL,
  `available_deal` int(10) NOT NULL,
  `sold_deal` int(10) NOT NULL,
  `deal_image` varchar(50) NOT NULL,
  `deal_end_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deal_of_the_day`
--

INSERT INTO `deal_of_the_day` (`deal_id`, `deal_title`, `deal_description`, `deal_net_price`, `deal_discounted_price`, `available_deal`, `sold_deal`, `deal_image`, `deal_end_date`) VALUES
(0, 'Flower Bundle', 'Different types of flowers, for your love ones', 700.00, 2000.00, 10, 20, 'flower_60.jpg', '2025-05-01 00:56:00');

-- --------------------------------------------------------

--
-- Table structure for table `fathers_day`
--

CREATE TABLE `fathers_day` (
  `id` int(10) NOT NULL,
  `fathers_day_category_name` varchar(50) NOT NULL,
  `fathers_day_category_quantity` int(10) DEFAULT 0,
  `fathers_day_category_status` binary(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mothers_day`
--

CREATE TABLE `mothers_day` (
  `id` int(10) NOT NULL,
  `mothers_day_category_name` varchar(50) NOT NULL,
  `mothers_day_category_quantity` int(10) DEFAULT 0,
  `mothers_day_category_status` binary(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `province` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `street` varchar(255) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `shipping_fee` decimal(10,2) DEFAULT 50.00,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','On the Way','Delivered','Received','Cancelled') DEFAULT 'Pending',
  `archived` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `fullname`, `contact`, `email`, `province`, `city`, `street`, `barangay`, `zip`, `total_amount`, `shipping_fee`, `order_date`, `status`, `archived`) VALUES
(29, 41, 'John Rafael B. Manusca', '09260457174', 'manusca.jr@gmail.com', 'RIZAL', 'ANTIPOLO', 'CARIGMA', 'SAN JOSE', '1870', 53.00, 50.00, '2025-04-19 09:31:43', 'Cancelled', 0),
(30, 41, 'John Rafael B. Manusca', '09260457174', 'manusca.jr@gmail.com', 'RIZAL', 'ANTIPOLO', 'CARIGMA', 'SAN JOSE', '1870', 53.00, 50.00, '2025-04-19 10:54:55', 'Received', 0),
(31, 41, 'John Rafael B. Manusca', '09260457174', 'manusca.jr@gmail.com', 'RIZAL', 'ANTIPOLO', 'CARIGMA', 'SAN JOSE', '1870', 2050.00, 50.00, '2025-04-20 17:47:03', 'Cancelled', 0),
(32, 44, 'Celine Gonzales', '09123456789', 'user@gmail.com', 'rizal', 'marikina', 'street', 'brgy', '1870', 750.00, 50.00, '2025-04-21 05:43:31', 'On the Way', 0),
(33, 45, 'rod', '99999999999', 'rod@gmail.com', 'sdfsdfsd', 'sdfsdf', 'sdfsdfs', 'sdfsdfds', '3333', 1100.00, 50.00, '2025-04-21 08:22:24', 'Received', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `product_img` varchar(255) DEFAULT NULL,
  `status` enum('Pending','On the Way','Delivered') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_name`, `product_price`, `product_qty`, `subtotal`, `product_img`, `status`) VALUES
(26, 29, 'Tulips', 3.00, 1, 3.00, '1.jpg', 'Pending'),
(27, 30, 'Tulips', 3.00, 1, 3.00, '1.jpg', 'Pending'),
(28, 31, 'Flower Bundle', 2000.00, 1, 2000.00, 'flower_60.jpg', 'Pending'),
(29, 32, 'Pinkish Petals', 350.00, 2, 700.00, 'flower_49.jpg', 'Pending'),
(30, 33, 'Pinkish Petals', 350.00, 3, 1050.00, 'flower_49.jpg', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `product_catag` varchar(100) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_desc` text NOT NULL,
  `product_date` varchar(50) NOT NULL,
  `product_img` text NOT NULL,
  `product_left` int(100) NOT NULL,
  `product_author` varchar(100) NOT NULL,
  `category_id` int(10) DEFAULT NULL,
  `section_id` int(10) DEFAULT NULL,
  `discounted_price` double(10,2) DEFAULT NULL,
  `image_1` varchar(50) NOT NULL,
  `image_2` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` binary(1) DEFAULT '1',
  `post_type` enum('new_arrival','trending','top_rated') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_catag`, `product_title`, `product_price`, `product_desc`, `product_date`, `product_img`, `product_left`, `product_author`, `category_id`, `section_id`, `discounted_price`, `image_1`, `image_2`, `created_at`, `updated_at`, `status`, `post_type`) VALUES
(61, 'ANNIVERSARY', 'ROSES', 500, 'ROSE', '20,4,2025', 'flower_10.jpg', 10, 'John Rafael B. Manusca', NULL, NULL, 300.00, '', NULL, '2025-04-20 16:03:25', '2025-04-21 00:03:25', 0x31, 'trending'),
(62, 'WEDDING', 'Pinkish Petals', 600, 'Petalssssss', '20,4,2025', 'flower_49.jpg', 20, 'John Rafael B. Manusca', NULL, NULL, 350.00, '', NULL, '2025-04-20 16:08:30', '2025-04-21 00:08:30', 0x31, 'new_arrival');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `rating_value` int(11) DEFAULT NULL CHECK (`rating_value` between 1 and 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `review` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` binary(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `name`, `status`) VALUES
(2, 'new_arrival', 0x31),
(3, 'trending', 0x31),
(4, 'top_rated', 0x31),
(5, 'deal_of_day', 0x31),
(6, 'best_seller', 0x31),
(7, 'new_products', 0x31);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `website_name` varchar(60) NOT NULL,
  `website_logo` varchar(50) NOT NULL,
  `website_footer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`website_name`, `website_logo`, `website_footer`) VALUES
('Kraftin\'e', 'logo.png', 'Kraftin\'e');

-- --------------------------------------------------------

--
-- Table structure for table `sympathy`
--

CREATE TABLE `sympathy` (
  `id` int(10) NOT NULL,
  `sympathy_category_name` varchar(50) NOT NULL,
  `sympathy_category_quantity` int(10) DEFAULT 0,
  `sympathy_category_status` binary(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `valentines_day`
--

CREATE TABLE `valentines_day` (
  `id` int(10) NOT NULL,
  `valentines_day_category_name` varchar(50) NOT NULL,
  `valentines_day_category_quantity` int(10) DEFAULT 0,
  `valentines_day_category_status` binary(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wedding`
--

CREATE TABLE `wedding` (
  `id` int(10) NOT NULL,
  `wedding_category_name` varchar(50) NOT NULL,
  `wedding_category_quantity` int(10) DEFAULT 0,
  `wedding_category_status` binary(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anniversary`
--
ALTER TABLE `anniversary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`banner_id`);

--
-- Indexes for table `birthday`
--
ALTER TABLE `birthday`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_bar`
--
ALTER TABLE `category_bar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_memorial_day`
--
ALTER TABLE `category_memorial_day`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_email` (`customer_email`);

--
-- Indexes for table `deal_of_the_day`
--
ALTER TABLE `deal_of_the_day`
  ADD PRIMARY KEY (`deal_id`);

--
-- Indexes for table `fathers_day`
--
ALTER TABLE `fathers_day`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mothers_day`
--
ALTER TABLE `mothers_day`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sympathy`
--
ALTER TABLE `sympathy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `valentines_day`
--
ALTER TABLE `valentines_day`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wedding`
--
ALTER TABLE `wedding`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `category_bar`
--
ALTER TABLE `category_bar`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
