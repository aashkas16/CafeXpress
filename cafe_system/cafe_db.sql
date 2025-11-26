-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2025 at 04:26 PM
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
-- Database: `cafe_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `category`, `item_name`, `description`, `price`) VALUES
(1, 'HOT COFFEE', 'DOPPIO', 'Double Espresso Shot', 109.00),
(2, 'HOT COFFEE', 'INDI FILTER COFFEE', 'Traditional Filter Coffee', 119.00),
(3, 'HOT COFFEE', 'LONG BLACK', 'Espresso With Hot Water', 139.00),
(4, 'HOT COFFEE', 'POUR OVER', 'Hot Coffee Brewed Via V60 Pour Over Method', 139.00),
(5, 'HOT COFFEE', 'FRENCH PRESS', 'Ground Coffee Brewed In French Press/Cafetiére', 139.00),
(6, 'HOT COFFEE', 'IRISH COFFEE', 'Classic Black Coffee With Irish Base', 149.00),
(7, 'HOT COFFEE', 'CAPPUCCINO', 'Espresso Shot Infused With Hot Milk & Froth', 159.00),
(8, 'HOT COFFEE', 'SAM\'S CAPPUCCINO', 'Classic Cappuccino With Chocolate & Brown Sugar.', 169.00),
(9, 'HOT COFFEE', 'CAFE LATTE', 'Espresso Infused With Hot Milk & Froth', 159.00),
(10, 'HOT COFFEE', 'IRISH LATTE', 'Espresso Infused With Irish, Hot Milk & Froth', 169.00),
(11, 'HOT COFFEE', 'HAZELNUT LATTE', 'Espresso Infused With Hazelnut, Hot Milk & Froth', 169.00),
(12, 'HOT COFFEE', 'VANILLA LATTE', 'Espresso Infused With Vanilla, Hot Milk & Froth', 169.00),
(13, 'HOT COFFEE', 'TOFFEE LATTE', 'Espresso Infused With Toffee, Hot Milk & Froth', 169.00),
(14, 'HOT COFFEE', 'PEPPERMINT LATTE', 'Espresso Infused With Peppermint, Hot Milk & Froth', 169.00),
(15, 'HOT COFFEE', 'CINNAMON LATTE', 'Espresso Infused With Cinnamon, Hot Milk & Froth', 169.00),
(16, 'HOT COFFEE', 'BUBBLEGUM LATTE', 'Espresso Infused With Bubblegum, Hot Milk & Froth', 169.00),
(17, 'HOT COFFEE', 'CAFE MOCHA', 'Espresso Infused With Steamed Milk & Chocolate', 169.00),
(18, 'HOT COFFEE', 'CARAMEL MACCHIATO', 'Caramel Sauce As Base, Espresso & Milk', 159.00),
(19, 'HOT COFFEE', 'FLAT WHITE', 'Espresso & Lots of Milk', 159.00),
(20, 'HOT COFFEE', 'WHITE MOCHA', 'White Chocolate Based Mocha', 169.00),
(21, 'COLD COFFEE', 'VANILLA AFFOGATO', 'A Scoop of Vanilla Ice Cream & Espresso', 119.00),
(22, 'COLD COFFEE', 'CHOCOLATE AFFOGATO', 'A Scoop of Chocolate Ice Cream & Espresso', 119.00),
(23, 'COLD COFFEE', 'ICED AMERICANO', 'Espresso, Water & Ice Cubes', 139.00),
(24, 'COLD COFFEE', 'ICED CAPPUCCINO', 'Ice & Hot Espresso Topped With Milk & Froth', 149.00),
(25, 'COLD COFFEE', 'COLD BREW', 'Coffee Dipped In Water Overnight', 139.00),
(26, 'COLD COFFEE', 'ICED POUR OVER', 'Water Poured Over Coffee & Ice With V-60', 149.00),
(27, 'COLD COFFEE', 'VIETNAMESE LATTE', 'Espresso With Condensed Milk and Steamed Milk', 159.00),
(28, 'COLD COFFEE', 'MOCHA CHILLO', 'Espresso, Milk, Chocolate, Ice & Condensed Milk.', 159.00),
(29, 'COLD COFFEE', 'ICED CARAMEL MACCHIATO', 'Espresso, Caramel, Froth, Milk & Ice', 159.00),
(30, 'COLD COFFEE', 'CAFFEIN FRAPPE', 'Blended Vanilla Ice Cream & Espresso', 169.00),
(31, 'COLD COFFEE', 'HAZELNUT FRAPPE', 'Blended Vanilla Ice Cream, Hazelnut & Espresso', 179.00),
(32, 'COLD COFFEE', 'VANILLA FRAPPE', 'Blended Vanilla Ice Cream, Vanilla & Espresso', 179.00),
(33, 'COLD COFFEE', 'TOFFEE FRAPPE', 'Blended Vanilla Ice Cream, Toffee & Espresso', 179.00),
(34, 'COLD COFFEE', 'IRISH FRAPPE', 'Blended Vanilla Ice Cream, Irish Syrup & Espresso', 179.00),
(35, 'COLD COFFEE', 'PEPPERMINT FRAPPE', 'Blended Vanilla Ice Cream, Peppermint & Espresso', 179.00),
(36, 'COLD COFFEE', 'BUBBLEGUM FRAPPE', 'Blended Vanilla Ice Cream, Bubblegum & Espresso', 179.00),
(37, 'COLD COFFEE', 'MANGO FRAPPE', 'Blended Vanilla Ice Cream, Mango & Espresso', 179.00),
(38, 'COLD COFFEE', 'GREEN APPLE FRAPPE', 'Blended Vanilla Ice Cream, Green Apple & Espresso', 179.00),
(39, 'COLD COFFEE', 'BLACKCURRANT FRAPPE', 'Blended Vanilla Ice Cream, Blackcurrant & Espresso', 179.00),
(40, 'COLD COFFEE', 'STRAWBERRY FRAPPE', 'Blended Vanilla Ice Cream, Strawberry & Espresso', 179.00),
(41, 'COLD COFFEE', 'OREO FRAPPE', 'Blended Vanilla Ice Cream, OREO & Espresso', 189.00),
(42, 'COLD COFFEE', 'BROWNIE FRAPPE', 'Blended Vanilla Ice Cream, BROWNIE & Espresso', 189.00),
(43, 'COLD COFFEE', 'KIT-KAT FRAPPE', 'Blended Vanilla Ice Cream, KIT-KAT & Espresso', 189.00),
(44, 'COLD COFFEE', 'CAFFEIN MOCHA FRAPPE', 'Vanilla & Chocolate Ice Cream + Espresso', 189.00),
(45, 'COLD COFFEE', 'CAFFEIN DARK OWNS', 'Vanilla & Chocolate Ice Cream, Espresso & Chocolate Dressing', 199.00),
(46, 'TEA', 'GREEN TEA', 'Cup of Classic Green Tea - Lemon/Honey/Ginger/Mint', 79.00),
(47, 'TEA', 'QAWAH', 'Blend of Home-Made Spices In Hot Water', 79.00),
(48, 'TEA', 'MASALA CHAI', 'Made With Black Tea, Home Made Spice-Mix & Milk', 79.00),
(49, 'ICED TEA', 'LEMON ICED TEA', 'Flavoured Cold Tea Over Ice', 149.00),
(50, 'ICED TEA', 'PEACH ICED TEA', 'Flavoured Cold Tea Over Ice', 149.00),
(51, 'ICED TEA', 'WATERMELON ICED TEA', 'Flavoured Iced Tea', 149.00),
(52, 'ICED TEA', 'MANGO ICED TEA', 'Flavoured Iced Tea', 149.00),
(53, 'ICED TEA', 'STRAWBERRY ICED TEA', 'Flavoured Iced Tea', 149.00),
(54, 'ICED TEA', 'SPICY GUAVA ICED TEA', 'Flavoured Iced Tea', 149.00),
(55, 'ICED TEA', 'ORANGE ICED TEA', 'Flavoured Iced Tea', 149.00),
(56, 'ICED TEA', 'BLACKCURRANT ICED TEA', 'Flavoured Iced Tea', 149.00),
(57, 'ICED TEA', 'BUBBLEGUM ICED TEA', 'Flavoured Iced Tea', 149.00),
(58, 'ICED TEA', 'GREEN APPLE ICED TEA', 'Flavoured Iced Tea', 149.00),
(59, 'MOJITOS', 'LEMON MOJITO', 'Fresh Mint, Lime Juice, Soda & Ice', 149.00),
(60, 'MOJITOS', 'ORANGE MOJITO', 'Mint, Lime, Soda, Ice', 149.00),
(61, 'MOJITOS', 'WATERMELON MOJITO', 'Mint, Lime, Soda, Ice', 149.00),
(62, 'MOJITOS', 'MANGO MOJITO', 'Mint, Lime, Soda, Ice', 149.00),
(63, 'MOJITOS', 'STRAWBERRY MOJITO', 'Mint, Lime, Soda, Ice', 149.00),
(64, 'MOJITOS', 'CHILLI GUAVA MOJITO', 'Mint, Lime, Soda, Ice', 149.00),
(65, 'MOJITOS', 'PEACH MOJITO', 'Mint, Lime, Soda, Ice', 149.00),
(66, 'MOJITOS', 'BLACKCURRANT MOJITO', 'Mint, Lime, Soda & Ice', 149.00),
(67, 'MOJITOS', 'BUBBLEGUM MOJITO', 'Mint, Lime, Soda & Ice', 149.00),
(68, 'MOJITOS', 'GREEN APPLE MOJITO', 'Mint, Lime, Soda & Ice', 149.00),
(69, 'MILKSHAKES', 'STRAWBERRY SHAKE', 'Blended Ice Cream with Milk & Strawberry', 149.00),
(70, 'MILKSHAKES', 'MANGO SHAKE', 'Blended Ice Cream with Milk & Mango', 149.00),
(71, 'MILKSHAKES', 'BLACKCURRANT SHAKE', 'Blackcurrant Shake', 149.00),
(72, 'MILKSHAKES', 'BOOMER SHAKE', 'Boomer Chocolate Shake', 149.00),
(73, 'MILKSHAKES', 'VANILLA SHAKE', 'Classic Vanilla Shake', 149.00),
(74, 'MILKSHAKES', 'CARAMEL SHAKE', 'Caramel Ice Cream Shake', 149.00),
(75, 'MILKSHAKES', 'GREEN APPLE SHAKE', 'Green Apple Shake', 149.00),
(76, 'THICKSHAKES', 'KITKAT SHAKE', 'Thick Kitkat Shake', 189.00),
(77, 'THICKSHAKES', 'BROWNIE SHAKE', 'Brownie Shake', 189.00),
(78, 'THICKSHAKES', 'BOURVITA SHAKE', 'Bourvita Thick Shake', 179.00),
(79, 'THICKSHAKES', 'OREO SHAKE', 'Oreo Thickshake', 189.00),
(80, 'THICKSHAKES', 'CRUNCHY STRAWBERRY SHAKE', 'Strawberry Crunch Thickshake', 189.00),
(81, 'THICKSHAKES', 'BROWNIE VANILLA SHAKE', 'Brownie + Vanilla Thickshake', 189.00),
(82, 'THICKSHAKES', 'CHUNKHY MANGO SHAKE', 'Chunky Mango Thickshake', 189.00),
(83, 'THICKSHAKES', 'COLD CHOCO SHAKE', 'Cold Chocolate Thickshake', 169.00),
(84, 'DESSERTS', 'HOT BOURNVITA', 'Bournvita Blended With Milk & Chocolate Sauce', 129.00),
(85, 'DESSERTS', 'HOT CHOCOLATE', 'Chocolate Sauce & Vanilla Ice Cream Topped With Milk', 149.00),
(86, 'DESSERTS', 'BROWNIE SANDWICH', 'Brownie With Vanilla Ice Cream Stuffing', 149.00),
(87, 'DESSERTS', 'BROWNIE SUNDAE', 'Brownie With Vanilla & Chocolate Ice Cream', 159.00),
(88, 'DESSERTS', 'SIZZLING BROWNIE', 'Brownie Sizzler With Vanilla Ice Cream', 179.00),
(89, 'TOASTIES', 'GARLIC CHEESE', 'Bread, Cheese, Herbs & Spices', 139.00),
(90, 'TOASTIES', 'CHILLI CHEESE', 'Bread, Cheese, Green Chilli', 139.00),
(91, 'TOASTIES', 'CORN & CAPSICUM', 'Bread, Cheese, Corn & Capsicum', 149.00),
(92, 'TOASTIES', 'ITALIAN', 'Bread, Cheese, Olives & Sauce', 149.00),
(93, 'TOASTIES', 'PANEER TIKKA', 'Bread, Cheese, Tandoori Sauce & Paneer', 149.00),
(94, 'TOASTIES', 'PEPPY PANEER', 'Bread, Cheese, Hot Sauce & Paneer', 149.00),
(95, 'TOASTIES', 'ZESTY VEG', 'Bread, Cheese & Veggies', 149.00),
(96, 'TOASTIES', 'BAKED MUSHROOM', 'Bread, Cheese & Mushroom', 149.00),
(97, 'FRIES', 'SALT & PEPPER', 'Crispy Fried Potatoes with Salt & Pepper', 139.00),
(98, 'FRIES', 'PERI-PERI', 'Crispy Fries with Peri-Peri', 149.00),
(99, 'FRIES', 'CHEESY', 'Cheese Loaded Fries', 149.00),
(100, 'FRIES', 'LOADED CHEESY PERI-PERI', 'Cheese Loaded Peri-Peri Fries', 169.00),
(101, 'FRIES', 'SPECIAL FRIES CHAT', 'Indian Style Chat with Cheese Sauce', 179.00),
(102, 'ADD-ONS', 'FLAVOURED SYRUPS', 'Vanilla, Hazelnut, Caramel, Irish, Bubblegum, Toffee, Peppermint', 39.00),
(103, 'DIPS', 'CHEESEY DIP', 'Cheesy Dip', 29.00),
(104, 'DIPS', 'MAYO DIP', 'Mayonnaise Dip', 29.00),
(105, 'DIPS', 'PERI-PERI DIP', 'Peri-Peri Dip', 29.00);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `gst_rate` decimal(5,2) NOT NULL,
  `gst_amount` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `subtotal`, `gst_rate`, `gst_amount`, `total`, `created_at`) VALUES
(1, 1, 447.00, 18.00, 80.46, 527.46, '2025-11-26 14:46:30');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `qty`, `price`) VALUES
(1, 1, 83, 1, 169.00),
(2, 1, 89, 2, 139.00);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`) VALUES
(1, 'aashkasomani1611@gmail.com', '$2y$10$oGFcOCjc37eMBgI2nK8.Z.IzS2Z3TF4RlVmeb9IHLyuFQAps79XI6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
