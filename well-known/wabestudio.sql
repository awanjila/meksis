-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2022 at 10:47 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wabestudio`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `category`, `author`, `name`, `slug`, `image`, `description`, `created_at`, `updated_at`) VALUES
(2, 'Web Design', 'Abraham Wanjila', 'Why Your Business Needs a Modern Website', 'why-your-business-needs-a-modern-website', 'Launch_a_Website_for_your_Business_1651088341.png', '<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"color: #ffffff;\"><strong style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\">Why Your Business Needs a Modern Website</strong></span></p>\r\n<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt; color: #ffffff;\" data-preserver-spaces=\"true\">Today, most businesses don’t realize that many of their customers will visit their website before making a purchase.</span></p>\r\n<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt; color: #ffffff;\" data-preserver-spaces=\"true\">Having an online presence, particularly a website, can make or break generating more revenue</span></p>\r\n<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt; color: #ffffff;\" data-preserver-spaces=\"true\">If you want help creating your website, call us today at +254710909198 to speak with a strategist.</span></p>\r\n<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"> </p>\r\n<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt; color: #ffffff;\" data-preserver-spaces=\"true\">WabeStudio doesn’t just provide web design services in Kenya. Wherever you are, We will sort you.</span></p>\r\n<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"color: #ffffff;\"><strong style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\">Credibility</strong></span></p>\r\n<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt; color: #ffffff;\" data-preserver-spaces=\"true\">Do you want to make a great first impression?, Have a website It will give people comfort that you’re a real business.</span></p>\r\n<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt; color: #ffffff;\" data-preserver-spaces=\"true\">As a rule of thumb, people do not trust sites that are poorly done or have outdated information, they will quickly move to your competitors. </span></p>\r\n<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt; color: #ffffff;\" data-preserver-spaces=\"true\">The best way to stand out is by having a website that looks good and communicates quality information to your consumers.</span></p>\r\n<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt; color: #ffffff;\" data-preserver-spaces=\"true\">A professionally done site signals trust, and once they trust your business they will check it out further.</span></p>\r\n<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"> </p>\r\n<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"color: #ffffff;\"><strong style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\">Brand</strong></span></p>\r\n<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"> </p>\r\n<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt; color: #ffffff;\" data-preserver-spaces=\"true\">A modern Web presence will set you apart from your competitors. Without one, it is incredibly challenging to create a brand without a website because potential clients can\'t easily find quality and reliable information on your business.</span></p>\r\n<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt; color: #ffffff;\" data-preserver-spaces=\"true\">A well-designed website is an opportunity for your business to showcase its unique features. It can show your audience why they should choose you over the competition.</span></p>\r\n<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"color: #ffffff;\"><strong style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\">Leads</strong></span></p>\r\n<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt; color: #ffffff;\" data-preserver-spaces=\"true\">A website increases your chances of getting leads because it impacts how your audience perceives your brand. </span></p>\r\n<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt; color: #ffffff;\" data-preserver-spaces=\"true\">The impression you make on them can either get them to remain on your page and learn about your business or leave your page and turn to a competitor. </span></p>\r\n<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt; color: #ffffff;\" data-preserver-spaces=\"true\">Once people find you and become interested in your products/services, a modern web design can help you keep leads on your page.</span></p>\r\n<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"> </p>\r\n<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"color: #ffffff;\"><strong style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\">Saving You Time + Customer Service</strong></span></p>\r\n<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt; color: #ffffff;\" data-preserver-spaces=\"true\">Having a website improves your customer support and improves your overall customer service. </span></p>\r\n<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt; color: #ffffff;\" data-preserver-spaces=\"true\">A website does this if you post support Q&amp;As on your website or create a forum where users can ask each other questions about your product and other users can answer these questions. </span></p>\r\n<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt; color: #ffffff;\" data-preserver-spaces=\"true\">This makes it much faster for your customers and also makes your customer support department more efficient.</span></p>\r\n<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"color: #ffffff;\"><strong style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\">Your website establishes your place in the industry</strong></span></p>\r\n<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt; color: #ffffff;\" data-preserver-spaces=\"true\">If your competitors are not online yet, they probably will be very soon. Establish yourself as a leader in your field by building a high-quality website first.</span></p>\r\n<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt; color: #ffffff;\" data-preserver-spaces=\"true\">If your competitors are online, you have a different kind of opportunity: you can build a website that’s completely different from your competitors’ sites, showing potential customers what makes your company stand apart.</span></p>', '2022-04-27 19:39:01', '2022-04-27 19:39:01'),
(3, 'Web Design', 'Abraham Wanjila', 'Why you should always use version control', 'why-you-should-always-use-version-control', 'OIP_1651089950.jpg', '<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt; color: #ffffff;\" data-preserver-spaces=\"true\">Why you should always use version control</span></p>\r\n<p style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\"> </p>\r\n<ol style=\"color: #0e101a; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt;\">\r\n<li style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt; list-style-type: decimal;\"><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt; color: #ffffff;\" data-preserver-spaces=\"true\">saves a lot of time</span></li>\r\n<li style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt; list-style-type: decimal;\"><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt; color: #ffffff;\" data-preserver-spaces=\"true\">You can easily go back to the previous version if it fails</span></li>\r\n<li style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt; list-style-type: decimal;\"><span style=\"background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; margin-top: 0pt; margin-bottom: 0pt; color: #ffffff;\" data-preserver-spaces=\"true\">Your gitted code serves as a reference for future projects.</span></li>\r\n</ol>', '2022-04-27 20:05:50', '2022-04-27 20:05:50');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `created_at`, `updated_at`, `slug`) VALUES
(1, 'Web Design', '2022-03-21 14:09:05', '2022-03-21 14:09:05', 'web_design');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `blog_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'jugfiygy', NULL, NULL),
(2, 1, 3, 'kgvgfgvfggfig', NULL, NULL),
(3, 1, 3, '.khjhh', NULL, NULL),
(4, 1, 3, 'lkugiugiug', NULL, NULL),
(5, 1, 3, 'jkgkgkg', NULL, NULL),
(6, 1, 3, 'mhvjhjjjccjjh', NULL, NULL),
(7, 1, 3, 'lljbkjbkhbkjbkjb', NULL, NULL),
(8, 1, 3, 'Liam is my son', NULL, NULL),
(9, 1, 3, 'ufufufuyufuyf', NULL, NULL),
(10, 1, 3, 'lknlvlvflnlncvkl', NULL, NULL),
(11, 1, 2, 'lihihiohiho', NULL, NULL),
(12, 1, 2, '.knklnlnkkkkkkkkkk monkey', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Abraham Wanjila Muchika', 'abemuchikan@yahoo.com', '0710909198', 'Testing', '2022-03-20 19:58:39', '2022-03-20 19:58:39'),
(2, 'Abraham Wanjila Muchika', 'abemuchikan@yahoo.com', '0710909198', 'Testing', '2022-03-20 19:59:46', '2022-03-20 19:59:46'),
(3, 'Abraham Wanjila Muchika', 'abemuchikan@yahoo.com', '0710909198', 'Testing', '2022-03-20 19:59:58', '2022-03-20 19:59:58'),
(4, 'Abraham Wanjila Muchika', 'abemuchikan@gmail.com', '0710909198', 'Testing 123', '2022-03-20 20:04:30', '2022-03-20 20:04:30'),
(5, 'Abraham Wanjila Muchika', 'abemuchikan@gmail.com', '0781312070', 'ojd', '2022-03-20 20:14:29', '2022-03-20 20:14:29'),
(6, 'Abraham Wanjila Muchika', 'abemuchikan@gmail.com', '0781312070', 'ojd', '2022-03-20 20:23:49', '2022-03-20 20:23:49'),
(7, 'Joyce', 'yemakhakha@gmail.com', '0745218453', 'rrfyvfigfgv g gc', '2022-03-20 20:30:10', '2022-03-20 20:30:10'),
(8, '15 Days 14 Nights Safari Birding Safari', 'dripmasterske@gmail.com', '07185522278', 'kknkn', '2022-03-20 20:32:18', '2022-03-20 20:32:18'),
(9, '5 Days Safari Masai Mara – Lake Nakuru', 'admin@test.com', '07185522278', ';kn knvkn vmshuto', '2022-03-20 20:33:59', '2022-03-20 20:33:59'),
(10, 'Abraham Wanjila Muchika', 'admin@test.com', '+254710909198', 'fuyfu', '2022-04-01 19:04:02', '2022-04-01 19:04:02');

-- --------------------------------------------------------

--
-- Table structure for table `demo_plans`
--

CREATE TABLE `demo_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `demo_plan_users`
--

CREATE TABLE `demo_plan_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_11_17_132130_create_contacts_table', 1),
(6, '2021_11_29_025404_create_mpesa_transactions_table', 1),
(7, '2021_11_29_050955_create_demo_plans_table', 1),
(8, '2021_12_01_202334_create_demo_plan_users_table', 1),
(10, '2021_12_09_212001_create_blog_categories_table', 1),
(11, '2021_12_18_174221_create_comments_table', 1),
(13, '2022_03_25_200736_create_services_table', 3),
(15, '2014_10_12_000000_create_users_table', 5),
(21, '2022_11_01_150854_create_products_table', 6),
(22, '2022_04_30_130334_create_product_images_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `mpesa_transactions`
--

CREATE TABLE `mpesa_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mpesa_receipt_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `url`, `client`, `product_image`, `created_at`, `updated_at`) VALUES
(1, '15 Days 14 Nights Safari Birding Safari', '5_days_climb_to_mt_kilimanjaro_marangu_route', 'ljkggg', '', '', '1651316434_g-mini-i3_130x_1639862655.jpg', '2022-04-30 11:00:34', '2022-04-30 11:00:34');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `body_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `body_image`, `created_at`, `updated_at`) VALUES
(1, 1, '1651316434_2280_1069930156544_3096_n_1647871774.jpg', '2022-04-30 11:00:34', '2022-04-30 11:00:34'),
(2, 1, '1651316435_g-mini-i3_130x_1639862655.jpg', '2022-04-30 11:00:35', '2022-04-30 11:00:35'),
(3, 1, '1651316435_Launch_a_Website_for_your_Business_1651088341.png', '2022-04-30 11:00:35', '2022-04-30 11:00:35'),
(4, 1, '1651316435_mpesa_snapshot_1639265948.JPG', '2022-04-30 11:00:35', '2022-04-30 11:00:35'),
(5, 1, '1651316435_OIP_1651089950.jpg', '2022-04-30 11:00:35', '2022-04-30 11:00:35'),
(6, 1, '1651316435_pexels-kei-photo-2741457-removebg-preview_1639256427.png', '2022-04-30 11:00:35', '2022-04-30 11:00:35'),
(7, 1, '1651316435_pizza-coffee-wooden-table-cup-cappuccino-paper-113616731_1639095077.jpg', '2022-04-30 11:00:35', '2022-04-30 11:00:35'),
(8, 1, '1651316435_pizza-coffee-wooden-table-cup-cappuccino-paper-113616731_1639095314.jpg', '2022-04-30 11:00:35', '2022-04-30 11:00:35'),
(9, 1, '1651316435_shop_1639266291.PNG', '2022-04-30 11:00:35', '2022-04-30 11:00:35');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `slug`, `description`, `cover_image`, `created_at`, `updated_at`) VALUES
(6, 'Custom Software', 'custom_software_development_in_kentya', '<p><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">Microsoft Office, for example, is a packaged commercial software product and service. It meets the generalized needs of office productivity and website creation.</span><br /><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">Custom software, on the other hand, is designed for a specific set of needs, such as a broadcast messaging program for a school or an attendance program that can differentiate staff and students.</span></p>\r\n<p><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">Custom software, and its development, is also referred to as bespoke software. The term has its origins in old English and the tailoring trade. Think tailor-made suit.</span></p>\r\n<p><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\"><strong>What is Automation?</strong></span></p>\r\n<p><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">\"Automation means that business owners have the opportunity to unify their processes, evolving from disparate spreadsheets to one integrated, affordable system.\"</span></p>\r\n<p><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">Why is custom software development important?</span></p>\r\n<p><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">Custom software development is important because it helps meet unique requirements at a cost-competitive with purchasing, maintaining and modifying commercial software.</span></p>\r\n<ul type=\"disc\">\r\n<li><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">Efficiency: Custom software is purpose-built to support processes swiftly and productively, without the need to tinker with or adjust COTS applications.</span></li>\r\n<li><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">Scalability: Custom software can grow as an organization or business grows and changes. Designers and developers can assess future needs as part of their requirements gathering. These factors can then be incorporated into the application, rather than incurring costs by purchasing additional licenses or subscriptions of packaged applications.</span></li>\r\n<li><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">Lower integration costs: One of the chief considerations of commercial software is: will it work with existing and legacy applications? If the answer is no, organizations face a further investment in getting commercial software to communicate and operate with their existing infrastructure. Custom software can be built to integrate with its intended environment.</span></li>\r\n<li><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">Profitability: It’s possible to make money with custom software development. Depending on the terms and conditions of the project, businesses that develop their own software may own the software and therefore be able to license or sell it to other organizations.</span></li>\r\n<li><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">Independence: The benefits of being free of a commercial software vendor cut both ways. On the plus side, organizations can avoid price hikes for licensing and support — and getting stuck maintaining packaged software should the vendor go out of business or terminate a product. On the negative side, the cost of supporting and maintaining custom software falls to the organization that created it or had it developed. How the equation works out requires each organization to look carefully at whether it’s better to build or buy.</span></li>\r\n</ul>', '1648396863_1.jpg', '2022-03-27 16:01:03', '2022-04-19 11:36:40'),
(8, 'Brand Identity', 'branding_digital_marketing_kenya', '<p><span style=\"font-family: \'book antiqua\', palatino, serif; font-size: 14pt;\">offering innovative and customer-centric digital experiences, that enable SMEs, Enterprises and Communities in our Society to grow.</span></p>', '1648469218_branding_and_digital.jpg', '2022-03-28 12:06:58', '2022-04-19 11:59:04'),
(9, 'Lipa Na Mpesa Integration', 'lipa_na_mpesa_integration_in_kenya', '<p><span style=\"font-family: \'book antiqua\', palatino, serif; font-size: 14pt;\">Let Your Customers Pay Directly to your Paybill from your Website. At Wabestudio we provide you with mobile payment integration solutions that will enable your business to receive and make payments in a more organized and efficient manner through Mpesa</span></p>\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; line-height: normal;\"><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">These solutions include:</span></p>\r\n<p class=\"MsoListParagraphCxSpFirst\" style=\"mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; mso-add-space: auto; text-indent: -.25in; line-height: normal; mso-list: l0 level1 lfo1;\"><span style=\"font-family: \'book antiqua\', palatino, serif; font-size: 14pt;\"><!-- [if !supportLists]-->·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal;\">           </span><!--[endif]-->Business-to-Customer Integration (B2C)-This enables businesses to pay customers directly</span></p>\r\n<p class=\"MsoListParagraphCxSpMiddle\" style=\"mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; mso-add-space: auto; text-indent: -.25in; line-height: normal; mso-list: l0 level1 lfo1;\"><span style=\"font-family: \'book antiqua\', palatino, serif; font-size: 14pt;\"><!-- [if !supportLists]-->·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal;\">           </span><!--[endif]-->Business-to-Business Integration (B2B)-This enables businesses to another Business directly from their Pay-bill</span></p>\r\n<p class=\"MsoListParagraphCxSpMiddle\" style=\"mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; mso-add-space: auto; text-indent: -.25in; line-height: normal; mso-list: l0 level1 lfo1;\"><span style=\"font-family: \'book antiqua\', palatino, serif; font-size: 14pt;\"><!-- [if !supportLists]-->·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal;\">           </span><!--[endif]-->Business-to-Customer Integration (C2B)-This allows businesses to receive payments from their customers directly</span></p>\r\n<p class=\"MsoListParagraphCxSpLast\" style=\"mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; mso-add-space: auto; text-indent: -.25in; line-height: normal; mso-list: l0 level1 lfo1;\"><span style=\"font-family: \'book antiqua\', palatino, serif; font-size: 14pt;\"><!-- [if !supportLists]-->·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal;\">           </span><!--[endif]-->Lipa na Mpesa Online. -This allows initiating an M-Pesa transaction on behalf of a customer using STKPush</span></p>\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; line-height: normal;\"><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">Give your shoppers a convenient checkout experience by providing them with a seamless online payment method straight to your mobile money wallet.</span></p>\r\n<p> </p>\r\n<p class=\"MsoNormal\" style=\"mso-margin-top-alt: auto; mso-margin-bottom-alt: auto; line-height: normal;\"><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">We offer our Mpesa Integration Services all over Kenya, in We have clients in Nakuru, Mombasa, Eldoret, Kisumu and Nanyuki. In East and Central Africa, Uganda, Tanzania, Rwanda, Burundi, and Congo.</span></p>\r\n<p><span style=\"font-family: \'book antiqua\', palatino, serif; font-size: 14pt;\">\"&gt;</span></p>', '1648470154_Lipa_Na_Mpesa_integration.jpg', '2022-03-28 12:22:34', '2022-04-19 11:52:30'),
(10, 'E-Commerce  Development', 'e_commerce_development_in_kenya', '<p><span style=\"font-family: \'book antiqua\', palatino, serif; font-size: 14pt;\">Traditional retail will be doomed to its inevitable extinction. It’s a matter of When. Online businesses are booming and rightly so – this year it is expected that 28% of all retail purchases will occur online. That’s partly because eCommerce website development has got easy – almost anyone can do it. But hubris might be your downfall; there are several important things to consider before you choose a company to build your eCommerce website. This is especially true if you want customers to keep coming back to your site.</span></p>\r\n<p><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\"> At WabeStudio Here are 5 Important things we will consider before developing your eCommerce website</span></p>\r\n<p style=\"margin-left: 39.5pt; text-indent: -21.5pt;\"><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\"><!-- [if !supportLists]-->·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal;\">          </span><!--[endif]-->Robust and Scalable Platform, We use Laravel &amp; Vue Js.</span></p>\r\n<p style=\"margin-left: 39.5pt; text-indent: -21.5pt;\"><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\"><!-- [if !supportLists]-->·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal;\">          </span><!--[endif]-->Clean, Simple, and Modern Design</span></p>\r\n<p style=\"margin-left: 39.5pt; text-indent: -21.5pt;\"><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\"><!-- [if !supportLists]-->·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal;\">          </span><!--[endif]-->Your eCommerce website needs to be secure</span></p>\r\n<p style=\"margin-left: 39.5pt; text-indent: -21.5pt;\"><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\"><!-- [if !supportLists]-->·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal;\">          </span><!--[endif]-->SEO attracts organic traffic to your eCommerce site.</span></p>\r\n<p style=\"margin-left: 39.5pt; text-indent: -21.5pt;\"><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\"><!-- [if !supportLists]-->·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal;\">          </span><!--[endif]-->Site Speed.</span></p>\r\n<p><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">It is essential to understand that eCommerce is not limited to strictly the buying and selling of goods on a website. It is the technique by which a website aids the business processes of a company or firm in a way that expedites the process and makes the entire exchange between the buyer and seller convenient and easy. Our websites even provide a secure <a href=\"https://wabestudio.co.ke/services/mpesa_integration_in_kenya\">**Payment Portal**</a> for our clients to use to buy our services. As expected, it is how almost all of our clients choose to complete their transactions with us.</span></p>\r\n<p><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">We offer our Ecommerce Web Services all over Kenya, in We, have clients in Nakuru, Mombasa, Eldoret, Kisumu, and Nanyuki. In East and Central Africa, Uganda, Tanzania, Rwanda, Burundi, and Congo</span></p>\r\n<p> </p>\r\n<p><span style=\"font-family: \'book antiqua\', palatino, serif; font-size: 14pt;\">\"&gt;</span></p>\r\n<p><span style=\"font-family: \'book antiqua\', palatino, serif; font-size: 14pt;\">\"&gt;</span></p>', '1648470541_e_commerce_development_in_kenya.jpg', '2022-03-28 12:29:01', '2022-04-19 11:52:09'),
(11, 'Modern Website Design', 'modern_website_design_kenya', '<p><span style=\"font-family: \'book antiqua\', palatino, serif; font-size: 14pt;\">Modern web development is both a set of tools and a way of thinking. These are the core elements of modern web development in 2021</span>. <span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">Mobile-Friendly Layout, </span><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">Light and optimized for speed, </span><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">High-quality Images, </span><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">Typography and fonts that uniquely identify you.</span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">Responsive web design is the practice of designing a page or site with a dynamically changing appearance or layout based on the screen size of the person’s device.</span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">In 2021 responsive web design is one of the most essential tools for anyone with a digital presence.</span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">This practice ensures users will have a good viewing experience no matter what type of device they’re using. Perhaps that\'s why it\'s so surprising when users are turning more and more to mobile devices and tablets, to find websites that continue to suffer from non-responsive web designs.</span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\">We offer our modern web design services all over Kenya, in We have clients in Nakuru, Mombasa, Eldoret, Kisumu and Nanyuki. In East and Central Africa, Uganda, Tanzania, Rwanda, Burundi and Congo.</span></p>\r\n<p><span style=\"font-size: 14pt; font-family: \'book antiqua\', palatino, serif;\"> </span></p>\r\n<p> </p>\r\n<p><span style=\"font-family: \'book antiqua\', palatino, serif; font-size: 14pt;\">\"&gt;</span></p>\r\n<p>\"&gt;</p>', '1648472143_concept-modern-web-design-studio.jpg', '2022-03-28 12:55:43', '2022-04-19 11:51:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Abraham', 'abemuchikan@gmail.com', NULL, '$2y$10$DGNa7YVdZ2LpsGnptST2oeFJyKPx..1kGvz/UO8EMivZUGh/1Uk3S', NULL, '2022-04-27 08:26:42', '2022-04-27 08:26:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_blog_id_foreign` (`blog_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `demo_plans`
--
ALTER TABLE `demo_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `demo_plan_users`
--
ALTER TABLE `demo_plan_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mpesa_transactions`
--
ALTER TABLE `mpesa_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `demo_plans`
--
ALTER TABLE `demo_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `demo_plan_users`
--
ALTER TABLE `demo_plan_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `mpesa_transactions`
--
ALTER TABLE `mpesa_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`),
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
