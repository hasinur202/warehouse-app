-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2021 at 03:20 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warehouse-app`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, '<p>asdfasf asdf sadf sadf safdsdafas safdsdf</p>', '2021-04-03 01:19:32', '2021-04-03 01:19:32');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `logo`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Fair & lovely dd', '1731054532.png', 'fair-lovely-dd', 1, '2021-03-29 00:33:28', '2021-03-29 00:49:59');

-- --------------------------------------------------------

--
-- Table structure for table `child_categories`
--

CREATE TABLE `child_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED DEFAULT NULL,
  `main_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `child_categories`
--

INSERT INTO `child_categories` (`id`, `warehouse_id`, `main_category_id`, `sub_category_id`, `category_name`, `slug`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 2, 'this child category dd 1', 'this-child-category-dd-1', '1114879723.jpeg', 1, '2021-03-27 03:35:21', '2021-03-27 04:18:11'),
(2, 2, 3, 2, 'child category two', 'child-category-two', '1119055063.png', 1, '2021-03-27 03:57:53', '2021-03-27 03:57:53'),
(4, 2, 2, 3, 'cattt test', 'cattt-test', '273075525.jpg', 1, '2021-03-31 06:31:11', '2021-03-31 06:32:58');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `color_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'blue', 1, '2021-04-04 00:44:04', '2021-04-04 00:57:31'),
(2, 'green', 1, '2021-04-04 00:49:42', '2021-04-04 00:55:23'),
(3, 'red', 1, '2021-04-04 00:57:42', '2021-04-04 00:57:42');

-- --------------------------------------------------------

--
-- Table structure for table `color_products`
--

CREATE TABLE `color_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `color_products`
--

INSERT INTO `color_products` (`id`, `product_id`, `color_id`, `created_at`, `updated_at`) VALUES
(5, 3, 1, '2021-04-08 04:49:35', '2021-04-08 04:49:35'),
(6, 3, 3, '2021-04-08 04:49:35', '2021-04-08 04:49:35');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_price` decimal(15,2) NOT NULL,
  `discount_p` int(11) NOT NULL,
  `discount_price` decimal(15,2) NOT NULL,
  `apply_coupon` int(11) NOT NULL,
  `use` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `admin_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_name`, `start_date`, `end_date`, `min_price`, `discount_p`, `discount_price`, `apply_coupon`, `use`, `status`, `admin_id`, `created_at`, `updated_at`) VALUES
(1, 'asfdklsa', '2021-04-08', '2021-04-16', '100.00', 50, '50.00', 1, NULL, 1, NULL, '2021-04-07 23:44:51', '2021-04-07 23:44:51');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_charges`
--

CREATE TABLE `delivery_charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED DEFAULT NULL,
  `district_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shipping_id` bigint(20) UNSIGNED DEFAULT NULL,
  `charge` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_charges`
--

INSERT INTO `delivery_charges` (`id`, `warehouse_id`, `district_id`, `shipping_id`, `charge`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, '4000.00', '2021-04-04 05:43:22', '2021-04-04 05:43:22'),
(2, 1, 4, 2, '4000.00', '2021-04-04 05:43:22', '2021-04-04 05:43:22'),
(3, 1, 5, 2, '4000.00', '2021-04-04 05:43:22', '2021-04-04 05:43:22'),
(4, 1, 6, 2, '5000.00', '2021-04-04 05:43:22', '2021-04-04 06:14:04'),
(5, 1, 7, 2, '5000.00', '2021-04-04 05:43:22', '2021-04-04 06:14:04'),
(6, 1, 6, 3, '6000.00', '2021-04-04 05:44:39', '2021-04-04 05:44:39'),
(7, 1, 7, 3, '6000.00', '2021-04-04 05:44:39', '2021-04-04 05:44:39');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED DEFAULT NULL,
  `state_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `warehouse_id`, `state_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'adfsa', '2021-04-04 01:49:43', '2021-04-04 01:49:43'),
(2, 1, 'dddd d', '2021-04-04 01:52:48', '2021-04-04 01:56:14'),
(3, 1, 'asdfd', '2021-04-04 04:49:13', '2021-04-04 04:49:13'),
(4, 1, 'dhaka', '2021-04-04 04:49:19', '2021-04-04 04:49:19'),
(5, 1, 'rajshahi', '2021-04-04 04:49:24', '2021-04-04 04:49:24'),
(6, 1, 'comilla', '2021-04-04 04:49:31', '2021-04-04 04:49:31'),
(7, 1, 'Rangpur', '2021-04-04 04:49:40', '2021-04-04 04:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `main_categories`
--

CREATE TABLE `main_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `main_categories`
--

INSERT INTO `main_categories` (`id`, `warehouse_id`, `admin_id`, `category_name`, `slug`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'asfsda', 'asfsda', '196990385.png', 1, '2021-03-25 03:49:50', '2021-03-27 04:00:30'),
(2, 2, 1, 'Category 2', 'category-2', '1236996099.jpg', 1, '2021-03-25 04:44:25', '2021-03-27 03:19:36'),
(3, 2, 1, 'Category 3', 'category-3', '1134619428.png', 1, '2021-03-25 05:06:48', '2021-03-25 05:06:48'),
(4, 1, 1, 'Category 4', 'category-4', '1393968864.png', 1, '2021-03-25 05:09:27', '2021-03-25 05:30:04');

-- --------------------------------------------------------

--
-- Table structure for table `measurement_types`
--

CREATE TABLE `measurement_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `measurement_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `measurement_types`
--

INSERT INTO `measurement_types` (`id`, `measurement_type`, `created_at`, `updated_at`) VALUES
(1, 'piece', '2021-04-07 23:28:01', '2021-04-07 23:28:01'),
(2, 'kg', '2021-04-07 23:28:03', '2021-04-07 23:28:03'),
(3, 'meters', '2021-04-07 23:28:06', '2021-04-07 23:28:06');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_03_25_064553_create_warehouses_table', 2),
(5, '2021_03_25_075519_create_main_categories_table', 3),
(6, '2021_03_25_115334_create_sub_categories_table', 4),
(7, '2021_03_27_083949_create_child_categories_table', 5),
(8, '2021_03_29_055850_create_brands_table', 6),
(9, '2021_03_29_070041_create_slides_table', 7),
(11, '2021_04_03_071130_create_abouts_table', 8),
(12, '2021_04_03_072429_create_privacypolicies_table', 9),
(15, '2021_04_04_063234_create_colors_table', 10),
(16, '2021_04_04_070518_create_shipping_classes_table', 11),
(17, '2021_04_04_073953_create_districts_table', 12),
(18, '2021_04_04_102632_create_delivery_charges_table', 13),
(25, '2021_04_06_170521_create_measurement_types_table', 14),
(26, '2021_04_06_180045_create_products_table', 14),
(27, '2021_04_06_182725_create_product_attributes_table', 14),
(28, '2021_04_06_182743_create_product_images_table', 14),
(29, '2021_04_06_183903_create_color_products_table', 14),
(30, '2021_04_07_190038_create_coupons_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privacypolicies`
--

CREATE TABLE `privacypolicies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `privacypolicies`
--

INSERT INTO `privacypolicies` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, '<p>asfdsaf asdf asdf safd sadf asdf</p>', '2021-04-03 01:33:13', '2021-04-03 01:33:13');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `main_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `child_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shipping_id` bigint(20) UNSIGNED DEFAULT NULL,
  `measurement_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_barcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feature_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `condition` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipp_duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `warehouse_id`, `brand_id`, `main_category_id`, `sub_category_id`, `child_category_id`, `shipping_id`, `measurement_id`, `product_barcode`, `product_sku`, `product_name`, `slug`, `feature_image`, `image1`, `image2`, `image3`, `product_type`, `condition`, `shipp_duration`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 3, 2, 1, 1, 1, 'barr555', '101', 'samsung pro', 'samsung-pro', '89047258.jpg', '179008748.jpg', '146641420.webp', '1666070843.png', 'popular', 'New', '3 days', '<p>sadfsadf asf sda</p>', 1, '2021-04-07 23:29:08', '2021-04-08 07:19:49'),
(2, 2, 1, 3, 2, 2, 2, 1, 'barr555gg', '103', 'Infinity T shirt', 'infinity-t-shirt', '63799354.png', '1478743619.jpg', '6442486.png', '870470755.jpg', 'trending', 'New', '3 days', '<p>afsafsaf</p>', 1, '2021-04-08 01:23:12', '2021-04-08 01:23:12'),
(3, 2, 1, 3, 2, 2, 2, 1, 'barr555455', '104', 'Mens Fairness', 'mens-fairness', '455550659.jpg', '1789133779.png', '368252913.jpg', '', 'popular', 'New', '3 days', '<p>asfsdaf</p>', 1, '2021-04-08 04:49:34', '2021-04-08 04:49:34');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `purchase_price` decimal(15,2) NOT NULL,
  `sale_price` decimal(15,2) NOT NULL,
  `discount` decimal(15,2) DEFAULT NULL,
  `discount_p` decimal(15,2) DEFAULT NULL,
  `current_price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `product_id`, `size`, `qty`, `purchase_price`, `sale_price`, `discount`, `discount_p`, `current_price`, `created_at`, `updated_at`) VALUES
(4, 3, 'small', 50, '200.00', '195.00', '5.00', '3.00', '190.00', '2021-04-08 04:49:35', '2021-04-08 04:49:35'),
(7, 2, 'small', 50, '200.00', '490.00', '5.00', '1.00', '485.00', '2021-04-08 07:19:27', '2021-04-08 07:19:27'),
(10, 1, 'small', 50, '200.00', '250.00', '5.00', '2.00', '245.00', '2021-04-08 07:19:49', '2021-04-08 07:19:49'),
(11, 1, 'medium', 50, '300.00', '350.00', '10.00', '3.00', '340.00', '2021-04-08 07:19:49', '2021-04-08 07:19:49');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `gallery_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `gallery_img`, `created_at`, `updated_at`) VALUES
(1, 1, '179008748.jpg', '2021-04-07 23:29:08', '2021-04-07 23:29:08'),
(2, 1, '146641420.webp', '2021-04-07 23:29:08', '2021-04-07 23:29:08'),
(3, 2, '1478743619.jpg', '2021-04-08 01:23:12', '2021-04-08 01:23:12'),
(4, 2, '6442486.png', '2021-04-08 01:23:12', '2021-04-08 01:23:12'),
(5, 2, '870470755.jpg', '2021-04-08 01:23:12', '2021-04-08 01:23:12');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_classes`
--

CREATE TABLE `shipping_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shipping_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_classes`
--

INSERT INTO `shipping_classes` (`id`, `shipping_name`, `created_at`, `updated_at`) VALUES
(1, 'Shipping Class-1 (0-2 kg)', '2021-04-04 01:19:36', '2021-04-04 01:23:22'),
(2, 'Shipping Class-2 (2-4 kg)', '2021-04-04 04:50:03', '2021-04-04 04:50:03'),
(3, 'Shipping Class-3 (4 kg-above)', '2021-04-04 04:50:21', '2021-04-04 04:50:21');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '#',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `warehouse_id`, `image`, `slug`, `title`, `url`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '1861009437.png', 'this-title-2-dd', 'this title 2 dd', 'https://multivendor.ideatechsolution.com', 1, '2021-03-29 02:53:11', '2021-03-29 03:15:26'),
(2, 2, '260726521.jpeg', 'online-life-csa', 'Online Life CSA', '#', 1, '2021-03-29 03:24:27', '2021-03-29 03:24:27'),
(3, 1, '1878674171.jpg', 'website-development', 'WEBSITE DEVELOPMENT', '#', 1, '2021-03-29 03:26:19', '2021-03-29 03:26:19');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED DEFAULT NULL,
  `main_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `warehouse_id`, `main_category_id`, `category_name`, `slug`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(2, 2, 3, 'sub category one', 'sub-category-one', '1525943499.png', 1, '2021-03-27 01:58:00', '2021-03-27 01:58:00'),
(3, 2, 2, 'acac cat', 'acac-cat', '636684390.png', 1, '2021-03-31 06:30:42', '2021-03-31 06:32:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.jpg',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `email_verified_at`, `password`, `phone`, `type`, `avatar`, `address`, `city`, `state`, `zip`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Hasinur', 'Rahman', 'admin@admin.com', NULL, '$2y$10$UV06Amj7Eg9jl5mtKvvrKeoAouVMyIsfH6DD8Z/KVJdEmqeYGq6AC', NULL, 'super_admin', 'avatar.jpg', NULL, NULL, NULL, NULL, 1, NULL, '2021-03-23 05:52:14', '2021-03-23 05:52:14'),
(2, 'Sazzad', 'Hossain', 'admin2@gmail.com', NULL, '$2y$10$3XeZjdrzN6eTytPjMXGQl.nEz9WTuc0k62t6K4oiGvpGPPPTozBWi', '155415', 'admin', 'avatar.jpg', 'Dhaka', NULL, NULL, NULL, 1, NULL, '2021-03-23 06:08:14', '2021-03-25 00:40:30'),
(6, 'Shanon', 'babu', 'admin3@admin.com', NULL, '$2y$10$mZ.CyThV0g6vt.L1EJ1y4uX84jIYx3uwaT.s2PM.0D.8HhK8TSJH2', '45455445', 'admin', 'avatar.jpg', 'mohammadpur', NULL, NULL, NULL, NULL, NULL, '2021-03-24 06:40:49', '2021-03-24 23:47:17'),
(7, 'Babu', 'Ry', 'staff@staff.com', NULL, '$2y$10$OsYYDk7sNuR2BiSAbjQTCe.vBRpQnjSfNujeuf2al0EbmO19JYHm.', '555454', 'staff', 'avatar.jpg', 'Mohammadpur', NULL, NULL, NULL, NULL, NULL, '2021-04-08 01:09:45', '2021-04-08 01:09:45');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `warehouse_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'US', 1, '2021-03-25 01:11:14', '2021-03-25 01:11:14'),
(2, 'UK', 1, '2021-03-25 01:21:06', '2021-03-25 02:59:52'),
(3, 'Europe', 0, '2021-03-25 01:28:26', '2021-03-25 01:28:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `child_categories`
--
ALTER TABLE `child_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `child_categories_warehouse_id_foreign` (`warehouse_id`),
  ADD KEY `child_categories_main_category_id_foreign` (`main_category_id`),
  ADD KEY `child_categories_sub_category_id_foreign` (`sub_category_id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color_products`
--
ALTER TABLE `color_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `color_products_product_id_foreign` (`product_id`),
  ADD KEY `color_products_color_id_index` (`color_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_charges`
--
ALTER TABLE `delivery_charges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_charges_warehouse_id_foreign` (`warehouse_id`),
  ADD KEY `delivery_charges_district_id_foreign` (`district_id`),
  ADD KEY `delivery_charges_shipping_id_foreign` (`shipping_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `districts_warehouse_id_foreign` (`warehouse_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `main_categories`
--
ALTER TABLE `main_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `main_categories_warehouse_id_foreign` (`warehouse_id`),
  ADD KEY `main_categories_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `measurement_types`
--
ALTER TABLE `measurement_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `privacypolicies`
--
ALTER TABLE `privacypolicies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_warehouse_id_foreign` (`warehouse_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_main_category_id_foreign` (`main_category_id`),
  ADD KEY `products_sub_category_id_foreign` (`sub_category_id`),
  ADD KEY `products_child_category_id_foreign` (`child_category_id`),
  ADD KEY `products_shipping_id_foreign` (`shipping_id`),
  ADD KEY `products_measurement_id_foreign` (`measurement_id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_attributes_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `shipping_classes`
--
ALTER TABLE `shipping_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slides_warehouse_id_foreign` (`warehouse_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_warehouse_id_foreign` (`warehouse_id`),
  ADD KEY `sub_categories_main_category_id_foreign` (`main_category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `child_categories`
--
ALTER TABLE `child_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `color_products`
--
ALTER TABLE `color_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery_charges`
--
ALTER TABLE `delivery_charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `main_categories`
--
ALTER TABLE `main_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `measurement_types`
--
ALTER TABLE `measurement_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `privacypolicies`
--
ALTER TABLE `privacypolicies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shipping_classes`
--
ALTER TABLE `shipping_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `child_categories`
--
ALTER TABLE `child_categories`
  ADD CONSTRAINT `child_categories_main_category_id_foreign` FOREIGN KEY (`main_category_id`) REFERENCES `main_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `child_categories_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `child_categories_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `color_products`
--
ALTER TABLE `color_products`
  ADD CONSTRAINT `color_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `delivery_charges`
--
ALTER TABLE `delivery_charges`
  ADD CONSTRAINT `delivery_charges_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `delivery_charges_shipping_id_foreign` FOREIGN KEY (`shipping_id`) REFERENCES `shipping_classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `delivery_charges_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `main_categories`
--
ALTER TABLE `main_categories`
  ADD CONSTRAINT `main_categories_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `main_categories_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_child_category_id_foreign` FOREIGN KEY (`child_category_id`) REFERENCES `child_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_main_category_id_foreign` FOREIGN KEY (`main_category_id`) REFERENCES `main_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_measurement_id_foreign` FOREIGN KEY (`measurement_id`) REFERENCES `measurement_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_shipping_id_foreign` FOREIGN KEY (`shipping_id`) REFERENCES `shipping_classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD CONSTRAINT `product_attributes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `slides`
--
ALTER TABLE `slides`
  ADD CONSTRAINT `slides_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_main_category_id_foreign` FOREIGN KEY (`main_category_id`) REFERENCES `main_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sub_categories_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
