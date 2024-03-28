-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2024 at 07:58 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravelbackend`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menus_id` bigint(20) UNSIGNED NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `title_ar` varchar(255) DEFAULT NULL,
  `description_en` text NOT NULL,
  `description_ar` text DEFAULT NULL,
  `icon_class` varchar(255) DEFAULT NULL,
  `icon_file` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `menu_slug` varchar(255) DEFAULT NULL,
  `title_en` varchar(255) NOT NULL,
  `title_ar` varchar(255) DEFAULT NULL,
  `blog_title_slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `web_image` varchar(255) NOT NULL,
  `image_title` varchar(255) NOT NULL,
  `image_alt` varchar(255) NOT NULL,
  `short_description_en` text DEFAULT NULL,
  `short_description_ar` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `description_ar` text DEFAULT NULL,
  `block_quote_en` text DEFAULT NULL,
  `block_quote_ar` text DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `sort_order` smallint(6) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: Inactive, 1: Active, 2: Pending',
  `is_featured` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: No, 1: Yes',
  `created_on` timestamp NOT NULL DEFAULT '2024-03-17 23:31:37',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `message` text DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `reference_id`, `name`, `company_name`, `email`, `phone`, `message`, `created_on`, `created_at`, `updated_at`) VALUES
(1, 'cms-1', 'Raja kumar', 'BSTL', 'rajakumarpusthela@gmail.com', '9959614393', 'test', '2024-03-28 06:32:40', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_name_en` varchar(255) NOT NULL,
  `country_name_ar` varchar(255) DEFAULT NULL,
  `country_iso_code_en` varchar(255) DEFAULT NULL,
  `country_iso_code_ar` varchar(255) DEFAULT NULL,
  `country_slug` varchar(255) NOT NULL,
  `sort_order` smallint(6) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL COMMENT '0: Inactive, 1: Active, 2: Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_name_en`, `country_name_ar`, `country_iso_code_en`, `country_iso_code_ar`, `country_slug`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'United Arab Emirates', NULL, NULL, NULL, 'united-arab-emirates', 1, 1, '2024-03-26 05:45:13', '2024-03-26 05:57:16');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `title_ar` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `iamge_title_tag` varchar(255) DEFAULT NULL,
  `image_alt_text` varchar(255) DEFAULT NULL,
  `sort_order` smallint(6) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: Inactive, 1: Active',
  `image_thumb_path` varchar(255) DEFAULT NULL,
  `image_medium_path` varchar(255) DEFAULT NULL,
  `image_large_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `title_en`, `title_ar`, `image`, `iamge_title_tag`, `image_alt_text`, `sort_order`, `status`, `image_thumb_path`, `image_medium_path`, `image_large_path`, `created_at`, `updated_at`) VALUES
(1, 'test', NULL, '1711532317.jpg', NULL, 'tet', 1, 1, NULL, NULL, NULL, '2024-03-27 09:38:38', '2024-03-27 09:38:38'),
(2, 'ABOUT US', NULL, '1711533899.jpg', NULL, 'test', 2, 1, 'http://localhost/cms/public/storage/gallery/thumb/', 'http://localhost/cms/public/storage/gallery/thumb/', 'http://localhost/cms/public/storage/gallery/thumb/', '2024-03-27 10:04:59', '2024-03-27 10:04:59'),
(3, 'Terms and Conditions:', NULL, '1711534064.png', NULL, 'test', 3, 1, 'http://localhost/cms/public/storage/gallery/thumb/', 'http://localhost/cms/public/storage/gallery/medium/', 'http://localhost/cms/public/storage/gallery/large/', '2024-03-27 10:07:44', '2024-03-27 10:07:44');

-- --------------------------------------------------------

--
-- Table structure for table `general_sections`
--

CREATE TABLE `general_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `menu_slug` varchar(255) NOT NULL,
  `category_title_en` varchar(255) NOT NULL,
  `category_title_ar` varchar(255) DEFAULT NULL,
  `highlight_en` text DEFAULT NULL,
  `highlight_ar` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `description_ar` text DEFAULT NULL,
  `sort_order` smallint(6) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `icon_file` varchar(255) DEFAULT NULL,
  `icon_class` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_sections`
--

INSERT INTO `general_sections` (`id`, `parent_id`, `menu_id`, `menu_slug`, `category_title_en`, `category_title_ar`, `highlight_en`, `highlight_ar`, `description_en`, `description_ar`, `sort_order`, `status`, `image`, `icon_file`, `icon_class`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'homes', 'Home', NULL, '<p>test</p>', '<p>test</p>', '<p>test</p>', '<p>test</p>', 1, 1, NULL, NULL, NULL, '2024-03-27 12:11:42', '2024-03-27 12:11:42'),
(2, 1, 1, 'homes', 'test', 'test', '<p>test</p>', '<p>test</p>', '<p>test</p>', '<p>test</p>', 1, 1, NULL, NULL, NULL, '2024-03-27 12:13:38', '2024-03-27 12:13:38');

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `name`, `email`, `phone`, `location`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Raja kumar', 'rajakumarpusthela@gmail.com', '9959614393', 'hyderabad', 'test', 0, '2024-03-28 05:46:44', '2024-03-28 05:47:02');

-- --------------------------------------------------------

--
-- Table structure for table `lead_sliders`
--

CREATE TABLE `lead_sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `image_title` varchar(255) NOT NULL,
  `image_alt` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `sort_order` smallint(6) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lead_sliders`
--

INSERT INTO `lead_sliders` (`id`, `image`, `image_title`, `image_alt`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, '1711607483.jpg', 'about', 'about', 1, 1, '2024-03-28 06:19:02', '2024-03-28 06:31:24');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `menu_name_en` varchar(255) NOT NULL,
  `menu_name_ar` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `short_description_en` tinytext DEFAULT NULL,
  `short_description_ar` tinytext DEFAULT NULL,
  `display_in_nav_bar` tinyint(4) NOT NULL DEFAULT 0,
  `display_in_seo` tinyint(4) NOT NULL DEFAULT 0,
  `display_in_footer` tinyint(4) NOT NULL DEFAULT 0,
  `sort_order` smallint(6) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `menu_name_en`, `menu_name_ar`, `slug`, `link`, `image`, `image_path`, `short_description_en`, `short_description_ar`, `display_in_nav_bar`, `display_in_seo`, `display_in_footer`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'Homes', NULL, 'homes', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 1, '2024-03-15 01:57:02', '2024-03-15 03:53:51'),
(2, 0, 'About us', NULL, 'about-us', NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 2, 1, '2024-03-15 03:31:31', '2024-03-15 03:31:31'),
(3, 0, 'Blog', NULL, 'blog', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 3, 1, '2024-03-15 04:00:10', '2024-03-15 04:00:10'),
(4, 0, 'Contact', NULL, 'contact', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 4, 1, '2024-03-15 04:11:00', '2024-03-15 04:11:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(5, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(6, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(7, '2016_06_01_000004_create_oauth_clients_table', 1),
(8, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(9, '2019_08_19_000000_create_failed_jobs_table', 1),
(10, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(11, '2024_03_12_122405_create_permission_tables', 2),
(12, '2023_07_23_095623_create_menus_table', 3),
(13, '2023_08_04_071346_create_module_settings_table', 4),
(14, '2023_08_04_072404_create_countries_table', 4),
(15, '2023_08_09_112124_add_extra_columns_to_permissions_table', 4),
(16, '2023_08_14_052627_create_blogs_table', 4),
(17, '2023_08_14_084303_create_galleries_table', 4),
(18, '2023_08_16_065104_create_office_locations_table', 4),
(19, '2023_08_18_043902_create_site_settings_table', 4),
(20, '2023_08_18_124100_create_general_sections_table', 4),
(21, '2023_08_21_122156_create_sections_table', 4),
(22, '2023_09_06_043836_create_contact_us_table', 4),
(23, '2023_11_02_092258_create_about_us_table', 4),
(24, '2024_03_26_141346_create_sliders_table', 5),
(25, '2023_08_18_085435_create_seos_table', 6),
(26, '2024_03_28_104848_create_leads_table', 7),
(27, '2024_03_28_105040_create_lead_sliders_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(3, 'App\\Models\\User', 1),
(4, 'App\\Models\\User', 14),
(4, 'App\\Models\\User', 15),
(4, 'App\\Models\\User', 16),
(4, 'App\\Models\\User', 17);

-- --------------------------------------------------------

--
-- Table structure for table `module_settings`
--

CREATE TABLE `module_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `module_slug` varchar(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT '2024-03-17 23:31:36',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `module_settings`
--

INSERT INTO `module_settings` (`id`, `module_name`, `module_slug`, `created_on`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'dashboard', '2024-03-17 23:31:36', '2024-03-18 03:12:11', '2024-03-18 03:12:11'),
(4, 'Sidebar', 'sidebar', '2024-03-17 23:31:36', '2024-03-18 23:12:17', '2024-03-18 23:12:17'),
(7, 'Inbox', 'inbox', '2024-03-17 23:31:36', '2024-03-26 07:16:26', '2024-03-26 07:16:26'),
(8, 'Location settings', 'location-settings', '2024-03-17 23:31:36', '2024-03-26 07:17:37', '2024-03-26 07:17:37'),
(9, 'Website Settings', 'website-settings', '2024-03-17 23:31:36', '2024-03-26 07:22:26', '2024-03-26 07:22:26'),
(10, 'General Settings', 'general-settings', '2024-03-17 23:31:36', '2024-03-26 07:24:11', '2024-03-26 07:24:11');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', '1JGJGVgtiOusve6vqcCXgDR1VshQ0rWf2FBo1HJ0', NULL, 'http://localhost', 1, 0, 0, '2024-03-12 06:52:46', '2024-03-12 06:52:46'),
(2, NULL, 'Laravel Password Grant Client', 'RG5fqfiNDDOC09Ho9zOtAOcJrcBD6QPGktyTQI94', 'users', 'http://localhost', 0, 1, 0, '2024-03-12 06:52:46', '2024-03-12 06:52:46'),
(3, NULL, 'Laravel Personal Access Client', 'AdCFMuUVqzKFVQd5od1rCobxebVpp8tlQvsf6A0o', NULL, 'http://localhost', 1, 0, 0, '2024-03-17 23:37:25', '2024-03-17 23:37:25'),
(4, NULL, 'Laravel Password Grant Client', 'jBAqpkT9zJKFl17nriFZxiGSb8z49H4PqCjy2VX0', 'users', 'http://localhost', 0, 1, 0, '2024-03-17 23:37:25', '2024-03-17 23:37:25');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-03-12 06:52:46', '2024-03-12 06:52:46'),
(2, 3, '2024-03-17 23:37:25', '2024-03-17 23:37:25');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `office_locations`
--

CREATE TABLE `office_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `address_en` tinytext NOT NULL,
  `address_ar` tinytext DEFAULT NULL,
  `address_icon` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_icon` varchar(255) DEFAULT NULL,
  `tel_number` varchar(255) DEFAULT NULL,
  `fax_number` varchar(255) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `phone_icon` varchar(255) DEFAULT NULL,
  `map_link` text DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `office_locations`
--

INSERT INTO `office_locations` (`id`, `address_en`, `address_ar`, `address_icon`, `email`, `email_icon`, `tel_number`, `fax_number`, `phone`, `phone_icon`, `map_link`, `created_on`, `created_at`, `updated_at`) VALUES
(1, 'H-no : - 7-1-307/44/1/5 First Floor', 'H-no : - 7-1-307/44/1/5 First Floor', 'Address Icon Class:', 'admin@gmail.com', 'Email Icon Class :', 'Telephone Number:', 'four', '09959614393', 'Phone Icon Class :', 'https://maps.app.goo.gl/vXYqcw8Pj1RA4iNd8', '2024-03-27 07:12:09', '2024-03-27 07:12:09', '2024-03-27 07:16:13');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `permission_slug` varchar(255) DEFAULT NULL,
  `module_settings_id` bigint(20) UNSIGNED DEFAULT NULL,
  `module_name` varchar(255) DEFAULT NULL,
  `module_slug` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `guard_name` varchar(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT '2024-03-17 23:31:37',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `permission_slug`, `module_settings_id`, `module_name`, `module_slug`, `status`, `guard_name`, `created_on`, `created_at`, `updated_at`) VALUES
(5, 'dashboard-index-dashboard', 'Dashboard-index', 'dashboard-index', 1, 'Dashboard', 'dashboard', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(12, 'dashboard-sidebar', 'Dashboard', 'dashboard', 4, 'Sidebar', 'sidebar', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(13, 'inbox-sidebar', 'Inbox', 'inbox', 4, 'Sidebar', 'sidebar', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(14, 'user-settings-sidebar', 'User Settings', 'user-settings', 4, 'Sidebar', 'sidebar', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(15, 'location-settings-sidebar', 'Location Settings', 'location-settings', 4, 'Sidebar', 'sidebar', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(16, 'website-settings-sidebar', 'Website Settings', 'website-settings', 4, 'Sidebar', 'sidebar', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(17, 'general-settings-sidebar', 'General Settings', 'general-settings', 4, 'Sidebar', 'sidebar', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(18, 'leads-index-inbox', 'Leads Index', 'leads-index', 7, 'Inbox', 'inbox', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(19, 'leads-sliders-index-inbox', 'Leads Sliders Index', 'leads-sliders-index', 7, 'Inbox', 'inbox', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(20, 'contact-page-leads-index-inbox', 'Contact Page Leads Index', 'contact-page-leads-index', 7, 'Inbox', 'inbox', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(21, 'country-index-location-settings', 'Country Index', 'country-index', 8, 'Location settings', 'location-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(22, 'country-create-location-settings', 'Country Create', 'country-create', 8, 'Location settings', 'location-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(23, 'country-store-location-settings', 'Country Store', 'country-store', 8, 'Location settings', 'location-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(24, 'country-edit-location-settings', 'Country Edit', 'country-edit', 8, 'Location settings', 'location-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(25, 'country-update-location-settings', 'Country Update', 'country-update', 8, 'Location settings', 'location-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(26, 'country-delete-location-settings', 'Country Delete', 'country-delete', 8, 'Location settings', 'location-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(27, 'menus-index-website-settings', 'Menus Index', 'menus-index', 9, 'Website Settings', 'website-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(28, 'menus-create-website-settings', 'Menus Create', 'menus-create', 9, 'Website Settings', 'website-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(29, 'menus-store-website-settings', 'Menus Store', 'menus-store', 9, 'Website Settings', 'website-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(30, 'menus-edit-website-settings', 'Menus Edit', 'menus-edit', 9, 'Website Settings', 'website-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(31, 'menus-update-website-settings', 'Menus Update', 'menus-update', 9, 'Website Settings', 'website-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(32, 'menus-delete-website-settings', 'Menus Delete', 'menus-delete', 9, 'Website Settings', 'website-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(33, 'home-page-sliders-index-website-settings', 'Home Page Sliders Index', 'home-page-sliders-index', 9, 'Website Settings', 'website-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(34, 'home-page-sliders-create-website-settings', 'Home Page Sliders Create', 'home-page-sliders-create', 9, 'Website Settings', 'website-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(35, 'home-page-sliders-store-website-settings', 'Home Page Sliders Store', 'home-page-sliders-store', 9, 'Website Settings', 'website-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(36, 'home-page-sliders-edit-website-settings', 'Home Page Sliders Edit', 'home-page-sliders-edit', 9, 'Website Settings', 'website-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(37, 'home-page-sliders-update-website-settings', 'Home Page Sliders Update', 'home-page-sliders-update', 9, 'Website Settings', 'website-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(38, 'home-page-sliders-delete-website-settings', 'Home Page Sliders Delete', 'home-page-sliders-delete', 9, 'Website Settings', 'website-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(39, 'office-location-index-website-settings', 'Office Location Index', 'office-location-index', 9, 'Website Settings', 'website-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(40, 'office-location-create-website-settings', 'Office Location Create', 'office-location-create', 9, 'Website Settings', 'website-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(41, 'office-location-store-website-settings', 'Office Location Store', 'office-location-store', 9, 'Website Settings', 'website-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(42, 'office-location-edit-website-settings', 'Office Location Edit', 'office-location-edit', 9, 'Website Settings', 'website-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(43, 'office-location-update-website-settings', 'Office Location Update', 'office-location-update', 9, 'Website Settings', 'website-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(44, 'office-location-delete-website-settings', 'Office Location Delete', 'office-location-delete', 9, 'Website Settings', 'website-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(45, 'blogs-index-website-settings', 'Blogs Index', 'blogs-index', 9, 'Website Settings', 'website-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(46, 'blogs-create-website-settings', 'Blogs Create', 'blogs-create', 9, 'Website Settings', 'website-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(47, 'blogs-edit-website-settings', 'Blogs Edit', 'blogs-edit', 9, 'Website Settings', 'website-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(48, 'blogs-update-website-settings', 'Blogs Update', 'blogs-update', 9, 'Website Settings', 'website-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(49, 'blogs-delete-website-settings', 'Blogs Delete', 'blogs-delete', 9, 'Website Settings', 'website-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(50, 'gallery-index-website-settings', 'Gallery Index', 'gallery-index', 9, 'Website Settings', 'website-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(51, 'gallery-create-website-settings', 'Gallery Create', 'gallery-create', 9, 'Website Settings', 'website-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(52, 'gallery-store-website-settings', 'Gallery Store', 'gallery-store', 9, 'Website Settings', 'website-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(53, 'gallery-edit-website-settings', 'Gallery Edit', 'gallery-edit', 9, 'Website Settings', 'website-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(54, 'gallery-update-website-settings', 'Gallery Update', 'gallery-update', 9, 'Website Settings', 'website-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(55, 'gallery-delete-website-settings', 'Gallery Delete', 'gallery-delete', 9, 'Website Settings', 'website-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(56, 'site-settings-create-general-settings', 'Site Settings Create', 'site-settings-create', 10, 'General Settings', 'general-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(57, 'site-settings-store-general-settings', 'Site Settings Store', 'site-settings-store', 10, 'General Settings', 'general-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(58, 'general-section-index-general-settings', 'General Section Index', 'general-section-index', 10, 'General Settings', 'general-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(59, 'general-section-create-general-settings', 'General Section Create', 'general-section-create', 10, 'General Settings', 'general-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(60, 'general-section-store-general-settings', 'General Section Store', 'general-section-store', 10, 'General Settings', 'general-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(61, 'general-section-edit-general-settings', 'General Section Edit', 'general-section-edit', 10, 'General Settings', 'general-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(62, 'general-section-update-general-settings', 'General Section Update', 'general-section-update', 10, 'General Settings', 'general-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(63, 'general-section-delete-general-settings', 'General Section Delete', 'general-section-delete', 10, 'General Settings', 'general-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(64, 'seo-index-general-settings', 'SEO Index', 'seo-index', 10, 'General Settings', 'general-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(65, 'seo-create-general-settings', 'SEO Create', 'seo-create', 10, 'General Settings', 'general-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(66, 'seo-store-general-settings', 'SEO Store', 'seo-store', 10, 'General Settings', 'general-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(67, 'seo-edit-general-settings', 'SEO Edit', 'seo-edit', 10, 'General Settings', 'general-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(68, 'seo-update-general-settings', 'SEO Update', 'seo-update', 10, 'General Settings', 'general-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL),
(69, 'seo-delete-general-settings', 'SEO Delete', 'seo-delete', 10, 'General Settings', 'general-settings', 1, 'web', '2024-03-17 23:31:37', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(3, 'Admin', 'web', '2024-03-19 06:17:44', '2024-03-19 06:17:44'),
(4, 'Leads', 'web', '2024-03-19 06:31:16', '2024-03-19 06:31:16');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(5, 3),
(12, 3),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(17, 3),
(21, 3),
(22, 3),
(23, 3),
(24, 3),
(25, 3),
(26, 3),
(27, 3),
(28, 3),
(29, 3),
(30, 3),
(31, 3),
(32, 3),
(33, 3),
(34, 3),
(35, 3),
(36, 3),
(37, 3),
(38, 3),
(39, 3),
(40, 3),
(41, 3),
(42, 3),
(43, 3),
(44, 3),
(45, 3),
(46, 3),
(47, 3),
(48, 3),
(49, 3),
(50, 3),
(51, 3),
(52, 3),
(53, 3),
(54, 3),
(55, 3),
(56, 3),
(57, 3),
(58, 3),
(59, 3),
(60, 3),
(61, 3),
(62, 3),
(63, 3),
(64, 3),
(65, 3),
(66, 3),
(67, 3),
(68, 3),
(69, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `general_sections_id` bigint(20) UNSIGNED NOT NULL,
  `section_title_en` varchar(255) NOT NULL,
  `section_title_ar` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `icon_class` varchar(255) DEFAULT NULL,
  `icon_file` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: Inactive, 1: Active',
  `sort_order` smallint(6) NOT NULL DEFAULT 0,
  `description_en` text DEFAULT NULL,
  `description_ar` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seos`
--

CREATE TABLE `seos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menus_id` bigint(20) UNSIGNED NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` text DEFAULT NULL,
  `canonical_url` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_alt` varchar(255) DEFAULT NULL,
  `og_title` varchar(255) DEFAULT NULL,
  `og_url` varchar(255) DEFAULT NULL,
  `og_image` varchar(255) DEFAULT NULL,
  `og_type` varchar(255) DEFAULT NULL,
  `og_locale` varchar(255) DEFAULT NULL,
  `og_description` varchar(255) DEFAULT NULL,
  `robots` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: No, 1: Yes',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seos`
--

INSERT INTO `seos` (`id`, `menus_id`, `meta_title`, `meta_description`, `meta_keywords`, `canonical_url`, `image`, `image_alt`, `og_title`, `og_url`, `og_image`, `og_type`, `og_locale`, `og_description`, `robots`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'test', 'test', 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-03-27 12:31:19', '2024-03-27 12:31:19');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name_en` varchar(255) NOT NULL,
  `site_name_ar` varchar(255) DEFAULT NULL,
  `site_url` varchar(255) DEFAULT NULL,
  `contact_number` varchar(30) DEFAULT NULL,
  `telephone_number` varchar(30) DEFAULT NULL,
  `whats_app_number` varchar(30) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `login_email` varchar(255) DEFAULT NULL,
  `contactus_email` varchar(255) DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `youtube_url` varchar(255) DEFAULT NULL,
  `company_address_en` tinytext DEFAULT NULL,
  `company_address_ar` tinytext DEFAULT NULL,
  `disable` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: No, 1: Yes',
  `header_logo` varchar(255) DEFAULT NULL,
  `footer_logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `site_name_en`, `site_name_ar`, `site_url`, `contact_number`, `telephone_number`, `whats_app_number`, `email`, `login_email`, `contactus_email`, `facebook_url`, `twitter_url`, `instagram_url`, `youtube_url`, `company_address_en`, `company_address_ar`, `disable`, `header_logo`, `footer_logo`, `created_at`, `updated_at`) VALUES
(1, 'CMS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2024-03-27 11:47:04', '2024-03-27 11:47:04');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_title_en` varchar(255) DEFAULT NULL,
  `first_title_ar` varchar(255) DEFAULT NULL,
  `second_title_en` varchar(255) DEFAULT NULL,
  `second_title_ar` varchar(255) DEFAULT NULL,
  `third_title_en` varchar(255) DEFAULT NULL,
  `third_title_ar` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `image_alt` varchar(255) DEFAULT NULL,
  `sort_order` smallint(8) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `first_title_en`, `first_title_ar`, `second_title_en`, `second_title_ar`, `third_title_en`, `third_title_ar`, `image`, `image_alt`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, '1711455543.png', 'image', 0, 1, '2024-03-26 12:19:03', '2024-03-27 06:08:37'),
(2, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(3, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(4, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(5, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(6, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(7, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(8, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(9, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(10, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(11, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(12, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(13, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(14, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(15, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(16, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(17, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(18, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(19, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(20, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(21, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(22, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(23, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(24, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(25, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(26, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(27, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(28, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(29, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(30, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(31, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(32, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(33, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(34, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(35, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(36, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(37, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(38, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58'),
(39, NULL, NULL, NULL, NULL, NULL, NULL, '1711519618.png', NULL, 2, 1, '2024-03-27 05:28:05', '2024-03-27 06:06:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `first_name_en` varchar(255) DEFAULT NULL,
  `first_name_ar` varchar(255) DEFAULT NULL,
  `last_name_en` varchar(255) DEFAULT NULL,
  `last_name_ar` varchar(255) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `otp` smallint(8) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `is_user_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:CMS User,2:Frontend User',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:Inactive,1:Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `first_name_en`, `first_name_ar`, `last_name_en`, `last_name_ar`, `phone`, `otp`, `profile_pic`, `is_user_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$jgN95.2UdbLVIMXY8OLV2OfPBJUC9UCl/30ZQCeR3g9QbhFWl4rjC', NULL, NULL, NULL, NULL, NULL, '9182204361', NULL, NULL, 1, 1, '2024-03-12 23:47:22', '2024-03-19 06:17:59'),
(17, 'Leads', 'leads@autofix.ae', NULL, '$2y$12$nMyWn5kWvJcr9sIidwULTO1GIzkpv4GrrI.eYWPkMuOszamOMgPaW', NULL, NULL, NULL, NULL, NULL, '9182204362', NULL, NULL, 1, 1, '2024-03-19 12:07:02', '2024-03-19 12:16:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`),
  ADD KEY `about_us_menus_id_index` (`menus_id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogs_menu_id_index` (`menu_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_sections`
--
ALTER TABLE `general_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `general_sections_menu_id_index` (`menu_id`),
  ADD KEY `general_sections_parent_id_index` (`parent_id`),
  ADD KEY `general_sections_category_title_en_index` (`category_title_en`),
  ADD KEY `general_sections_highlight_en_index` (`highlight_en`(768));

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead_sliders`
--
ALTER TABLE `lead_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `module_settings`
--
ALTER TABLE `module_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `office_locations`
--
ALTER TABLE `office_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`),
  ADD KEY `permissions_module_settings_id_index` (`module_settings_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sections_general_sections_id_index` (`general_sections_id`),
  ADD KEY `sections_section_title_en_index` (`section_title_en`);

--
-- Indexes for table `seos`
--
ALTER TABLE `seos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `general_sections`
--
ALTER TABLE `general_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lead_sliders`
--
ALTER TABLE `lead_sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `module_settings`
--
ALTER TABLE `module_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `office_locations`
--
ALTER TABLE `office_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seos`
--
ALTER TABLE `seos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_module_settings_id_foreign` FOREIGN KEY (`module_settings_id`) REFERENCES `module_settings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
