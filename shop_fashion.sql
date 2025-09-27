-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th9 27, 2025 lúc 01:23 AM
-- Phiên bản máy phục vụ: 8.0.30
-- Phiên bản PHP: 8.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shop_fashion`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumb` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `abouts`
--

INSERT INTO `abouts` (`id`, `name`, `content`, `thumb`, `created_at`, `updated_at`) VALUES
(7, 'MỤC TIÊU', '<p>Mục ti&ecirc;u của PMSTOREl&agrave; trở th&agrave;nh một trong những thương hiệu gi&agrave;y được y&ecirc;u th&iacute;ch v&agrave; tin tưởng nhất, kh&ocirc;ng chỉ tại Việt Nam m&agrave; c&ograve;n vươn ra thế giới. Ch&uacute;ng t&ocirc;i hướng đến việc cung cấp những sản phẩm thời trang chất lượng cao, đ&aacute;p ứng đ&uacute;ng nhu cầu v&agrave; sở th&iacute;ch của kh&aacute;ch h&agrave;ng, đồng thời x&acirc;y dựng một cộng đồng y&ecirc;u th&iacute;ch sự s&aacute;ng tạo v&agrave; phong c&aacute;ch c&aacute; nh&acirc;n.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Ch&uacute;ng t&ocirc;i cam kết ph&aacute;t triển bền vững, lu&ocirc;n s&aacute;ng tạo v&agrave; cải tiến kh&ocirc;ng ngừng để mang đến những bộ sưu tập đa dạng, bắt kịp xu hướng, đồng thời ch&uacute; trọng đến chất lượng sản phẩm v&agrave; dịch vụ chăm s&oacute;c kh&aacute;ch h&agrave;ng. PMSTORE muốn l&agrave; nơi m&agrave; mỗi kh&aacute;ch h&agrave;ng t&igrave;m thấy sự tự tin v&agrave; thể hiện phong c&aacute;ch ri&ecirc;ng biệt qua từng đ&ocirc;i gi&agrave;y.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>B&ecirc;n cạnh đ&oacute;, mục ti&ecirc;u d&agrave;i hạn của PMSTORE l&agrave; mở rộng mạng lưới cửa h&agrave;ng v&agrave; n&acirc;ng cao trải nghiệm mua sắm trực tuyến, gi&uacute;p kh&aacute;ch h&agrave;ng dễ d&agrave;ng tiếp cận c&aacute;c sản phẩm thời trang chất lượng, d&ugrave; ở bất cứ đ&acirc;u. Ch&uacute;ng t&ocirc;i lu&ocirc;n nỗ lực kh&ocirc;ng ngừng để mang lại gi&aacute; trị cao nhất cho kh&aacute;ch h&agrave;ng, đội ngũ nh&acirc;n</p>', '/uploads/products/1739458608_about-02.jpg', '2025-02-13 07:25:02', '2025-09-14 23:38:51'),
(8, 'GIỚI THIỆU', '<p>PMSTORE l&agrave; một thương hiệu gi&agrave;y nổi bật, được biết đến với cam kết mang đến cho kh&aacute;ch h&agrave;ng những sản phẩm kh&ocirc;ng chỉ đẹp mắt m&agrave; c&ograve;n chất lượng vượt trội. Với sứ mệnh gi&uacute;p bạn tự tin thể hiện c&aacute; t&iacute;nh qua từng bộ trang phục, PMSTORE chuy&ecirc;n cung cấp c&aacute;c d&ograve;ng sản phẩm gi&agrave;y ph&ugrave; hợp với nhiều lứa tuổi v&agrave; phong c&aacute;ch sống.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Ch&uacute;ng t&ocirc;i lu&ocirc;n theo s&aacute;t xu hướng thời trang quốc tế, từ đ&oacute; đưa ra c&aacute;c thiết kế tinh tế, s&aacute;ng tạo nhưng vẫn giữ được sự tiện dụng v&agrave; thoải m&aacute;i. D&ugrave; bạn y&ecirc;u th&iacute;ch phong c&aacute;ch trẻ trung, năng động hay thanh lịch, PMSTORE đều c&oacute; những lựa chọn đa dạng, gi&uacute;p bạn dễ d&agrave;ng t&igrave;m thấy những sản phẩm ph&ugrave; hợp với bản th&acirc;n.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Đặc biệt, ch&uacute;ng t&ocirc;i lu&ocirc;n ch&uacute; trọng đến chất lượng sản phẩm với nguy&ecirc;n liệu chọn lọc kỹ c&agrave;ng, bền đẹp v&agrave; th&acirc;n thiện với người sử dụng. Mỗi m&oacute;n đồ tại PMSTORE đều được kiểm tra cẩn thận, đảm bảo độ ho&agrave;n thiện cao nhất.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Với gi&aacute; cả hợp l&yacute; v&agrave; ch&iacute;nh s&aacute;ch phục vụ kh&aacute;ch h&agrave;ng chu đ&aacute;o, PMSTORE kh&ocirc;ng chỉ l&agrave; nơi mua sắm, m&agrave; c&ograve;n l&agrave; đối t&aacute;c đ&aacute;ng tin cậy trong việc đồng h&agrave;nh c&ugrave;ng bạn x&acirc;y dựng phong c&aacute;ch c&aacute; nh&acirc;n. H&atilde;y đến với ch&uacute;ng t&ocirc;i để t&igrave;m kiếm những sản phẩm ho&agrave;n hảo nhất cho tủ đồ của bạn v&agrave; tự tin tỏa s&aacute;ng mỗi ng&agrave;y!</p>', '/uploads/products/1739457413_about-01.jpg', '2025-02-13 07:36:53', '2025-09-14 23:38:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 4, '2025-08-18 07:13:11', '2025-08-18 07:13:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint UNSIGNED NOT NULL,
  `cart_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `size_id` bigint UNSIGNED DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending','replied') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `contacts`
--

INSERT INTO `contacts` (`id`, `email`, `message`, `created_at`, `updated_at`, `status`) VALUES
(2, 'manh@gmail.com', 'ghgh', NULL, '2025-02-12 03:45:01', 'replied'),
(3, 'sd', 'sd', '2025-02-11 09:57:38', '2025-02-12 03:52:28', 'replied'),
(4, 'sd', 'sd', '2025-02-11 10:00:49', '2025-02-12 03:52:26', 'replied'),
(5, 'vbvb', 'cvcv', '2025-02-11 10:00:55', '2025-02-12 03:31:49', 'replied'),
(6, 'admin@mail.com', 'jkjkdfd', '2025-02-13 06:32:19', '2025-02-13 07:14:07', 'replied'),
(11, 'admin@mail.com', 'klkl', '2025-02-13 06:48:52', '2025-02-13 07:08:42', 'replied'),
(12, 'admin@mail.com', 'dfdf', '2025-02-13 06:52:44', '2025-02-13 07:08:39', 'replied'),
(15, 'admin@mail.com', 'xcxc', '2025-02-13 07:03:59', '2025-02-13 07:07:10', 'replied'),
(17, 'admin@mail.com', 'hjh', '2025-02-13 07:19:48', '2025-02-13 07:45:15', 'replied'),
(22, 'admin@mail.com', 'sdsd', '2025-02-18 02:11:03', '2025-02-18 02:11:03', 'pending'),
(23, 'admin@mail.com', 'sdsd', '2025-08-20 02:15:04', '2025-08-20 02:15:04', 'pending');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `infos`
--

CREATE TABLE `infos` (
  `id` bigint UNSIGNED NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `infos`
--

INSERT INTO `infos` (`id`, `address`, `phone`, `email`, `created_at`, `updated_at`) VALUES
(1, 'số 45 ngõ 201 Cầu Giấy', '0323456789', 'manh18052011@gmail.com', NULL, '2025-02-11 07:55:38');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menus`
--

CREATE TABLE `menus` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `menus`
--

INSERT INTO `menus` (`id`, `name`, `parent_id`, `description`, `content`, `slug`, `active`, `created_at`, `updated_at`) VALUES
(5, 'THỂ THAO', 0, '', '', 'nam', 1, '2025-02-10 00:09:01', '2025-09-14 09:12:04'),
(6, 'SNEAKER', 0, '', '', 'nu', 1, '2025-02-10 00:09:06', '2025-09-14 09:11:47'),
(9, 'Hoka', 5, '', '', 'ao', 1, '2025-02-10 00:11:11', '2025-09-14 23:23:55'),
(10, 'Nike', 5, '', '', 'quan', 1, '2025-02-10 00:11:20', '2025-09-14 23:23:39'),
(13, 'Adidas', 6, '', '', 'ao-2', 1, '2025-02-10 00:21:49', '2025-09-14 21:07:40'),
(14, 'New Balance', 6, '', '', 'quan-2', 1, '2025-02-10 00:22:31', '2025-09-14 21:07:28'),
(15, 'Giày Tây', 0, '', '', 'giay-tay', 1, '2025-09-14 21:04:16', '2025-09-14 21:04:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(17, '0001_01_01_000000_create_users_table', 1),
(18, '0001_01_01_000001_create_cache_table', 1),
(19, '0001_01_01_000002_create_jobs_table', 1),
(20, '2024_11_06_025812_create_menus_table', 1),
(21, '2024_11_19_023516_create_products_table', 1),
(22, '2024_11_19_024435_update_table_product', 1),
(23, '2024_11_28_075022_create_sizes_table', 1),
(24, '2024_11_28_075115_create_product_sizes_table', 1),
(25, '2024_11_29_051755_update_thumb_path_in_products', 2),
(26, '2024_11_30_071809_remove_price_from_product_sizes', 3),
(28, '2025_01_11_080348_create_sliders_table', 4),
(29, '2025_01_19_044703_update_sliders', 5),
(31, '2025_02_11_082406_create_about_table', 6),
(32, '2025_02_11_085345_rename_about_to_abouts', 7),
(34, '2025_02_11_131719_create_infos_table', 8),
(36, '2025_02_11_150045_create_contacts_table', 9),
(37, '2025_02_12_102017_add_status_to_contacts_table', 10),
(38, '2025_02_16_162353_create_user_clients_table', 11),
(39, '2025_02_17_160642_create_reviews_table', 11),
(40, '2025_02_18_143502_add_status_to_reviews_table', 12),
(42, '2025_02_18_154144_add_admin_reply_to_reviews_table', 13),
(43, '2025_02_24_150822_create_orders_table', 14),
(44, '2025_02_25_031505_update_orders_table', 15),
(45, '2025_02_25_031619_create_order_items_table', 15),
(46, '2025_02_25_092100_update_order_items_table', 16),
(47, '2025_08_18_134835_create_carts_table', 17),
(48, '2025_08_18_134911_create_cart_items_table', 17),
(49, '2025_08_18_141402_add_size_id_to_cart_items_table', 18),
(50, '2025_09_13_154950_create_product_images_table', 19),
(51, '2025_09_23_033356_create_review_images_table', 20);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','processing','shipped','completed','canceled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `total_price` decimal(10,2) NOT NULL,
  `payment_method` enum('COD','Momo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'COD',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `customer_name`, `customer_phone`, `customer_address`, `status`, `total_price`, `payment_method`, `created_at`, `updated_at`) VALUES
(48, 3, 'manh', '1010101', 'Quang trung', 'pending', 1000000.00, 'Momo', '2025-09-26 09:38:36', '2025-09-26 09:38:36'),
(49, 3, 'manh', '1010101', 'Quang trung', 'pending', 1000000.00, 'Momo', '2025-09-26 10:10:19', '2025-09-26 10:10:19'),
(50, 3, 'manh', '1010101', 'Quang trung', 'pending', 1000000.00, 'Momo', '2025-09-26 10:12:15', '2025-09-26 10:12:15'),
(51, 3, 'manh', '1010101', 'Quang trung', 'pending', 1000000.00, 'Momo', '2025-09-26 10:20:35', '2025-09-26 10:20:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `size_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`, `size_id`) VALUES
(10, 48, 103, 1, 1000000.00, '2025-09-26 09:38:36', '2025-09-26 09:38:36', NULL),
(11, 49, 104, 1, 1000000.00, '2025-09-26 10:10:19', '2025-09-26 10:10:19', NULL),
(12, 50, 104, 1, 1000000.00, '2025-09-26 10:12:15', '2025-09-26 10:12:15', NULL),
(13, 51, 99, 1, 1000000.00, '2025-09-26 10:20:35', '2025-09-26 10:20:35', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_id` int NOT NULL,
  `price` bigint NOT NULL,
  `price_sale` bigint DEFAULT NULL,
  `active` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `thumb` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `content`, `menu_id`, `price`, `price_sale`, `active`, `created_at`, `updated_at`, `thumb`) VALUES
(97, 'Giày New Balance 530 ‘White Light Chrome Blue’ MR530PC', '<p><strong>Thương hiệu: </strong><strong>New Balance</strong></p>\r\n\r\n<p><strong>Thiết kế:</strong>&nbsp;530</p>\r\n\r\n<p><strong>Xuất xứ:</strong>&nbsp;Mỹ</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Trọng lượng</th>\r\n			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;1 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Size</th>\r\n			<td>\r\n			<p>38.5, 40.5, 41.5, 42</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', '<p>Trong l&agrave;n s&oacute;ng Y2K đang l&agrave;m mưa l&agrave;m gi&oacute; trong giới thời trang, những đ&ocirc;i sneaker mang thiết kế cổ điển pha hiện đại như&nbsp;<strong>New Balance 530</strong>&nbsp;đang chiếm trọn cảm t&igrave;nh của người trẻ tr&ecirc;n to&agrave;n thế giới. Trong số đ&oacute;, phi&ecirc;n bản&nbsp;<strong>New Balance 530 &lsquo;White Light Chrome Blue&rsquo; MR530PC</strong>&nbsp;nổi bật với phối m&agrave;u tươi mới, trẻ trung v&agrave; cực kỳ dễ ứng dụng trong đời sống thường ng&agrave;y.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Điểm thu h&uacute;t đầu ti&ecirc;n của&nbsp;<strong>MR530PC</strong>&nbsp;l&agrave; sự phối hợp m&agrave;u sắc h&agrave;i h&ograve;a: nền&nbsp;<strong>trắng thanh lịch</strong>&nbsp;kết hợp c&ugrave;ng c&aacute;c chi tiết&nbsp;<strong>xanh dương &aacute;nh bạc (chrome blue)</strong>&nbsp;nổi bật, tạo n&ecirc;n sự tương phản nhẹ nh&agrave;ng nhưng đầy cuốn h&uacute;t. Phần logo &ldquo;N&rdquo; được phủ lớp &aacute;nh kim tinh tế, mang đến vẻ hiện đại v&agrave; sắc sảo. Đ&acirc;y l&agrave; một phối m&agrave;u vừa c&aacute; t&iacute;nh, vừa dễ phối &ndash; ph&ugrave; hợp cho cả nam v&agrave; nữ, từ học sinh sinh vi&ecirc;n đến d&acirc;n văn ph&ograve;ng trẻ trung.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Phần upper được l&agrave;m từ&nbsp;<strong>lưới mesh tho&aacute;ng kh&iacute;</strong>&nbsp;c&ugrave;ng với c&aacute;c lớp phủ bằng&nbsp;<strong>da tổng hợp</strong>, đảm bảo đ&ocirc;i gi&agrave;y lu&ocirc;n th&ocirc;ng tho&aacute;ng, nhẹ ch&acirc;n v&agrave; giữ được form đẹp d&ugrave; sử dụng trong thời gian d&agrave;i. Thiết kế vẫn giữ nguy&ecirc;n tinh thần retro của d&ograve;ng 530 &ndash; với đường n&eacute;t bo tr&ograve;n, d&aacute;ng &ldquo;dad shoe&rdquo; nhưng được l&agrave;m mới bằng chi tiết sắc sảo v&agrave; m&agrave;u sắc trẻ trung.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Về mặt hiệu năng,&nbsp;<strong>MR530PC</strong>&nbsp;sử dụng&nbsp;<strong>c&ocirc;ng nghệ đệm ABZORB</strong>&nbsp;&ndash; gi&uacute;p hấp thụ lực v&agrave; giảm chấn hiệu quả trong mỗi bước ch&acirc;n. Phần đế cao su b&aacute;m chắc, linh hoạt, ph&ugrave; hợp với nhiều loại địa h&igrave;nh &ndash; từ mặt đường phố đến s&acirc;n thể thao hay bề mặt gồ ghề nhẹ.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>New Balance 530 kh&ocirc;ng chỉ đơn thuần l&agrave; một đ&ocirc;i gi&agrave;y chạy bộ, m&agrave; c&ograve;n l&agrave; m&oacute;n phụ kiện thời trang quan trọng trong tủ đồ của giới trẻ hiện đại. Với thiết kế linh hoạt,&nbsp;<strong>MR530PC &lsquo;White Light Chrome Blue&rsquo;</strong>&nbsp;dễ d&agrave;ng kết hợp với nhiều kiểu trang phục: từ quần jeans, jogger, quần thể thao cho đến v&aacute;y d&agrave;i, quần ống rộng hoặc phong c&aacute;ch layering theo m&ugrave;a.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sự kết hợp giữa&nbsp;<strong>t&iacute;nh thẩm mỹ cao</strong>,&nbsp;<strong>độ thoải m&aacute;i tuyệt vời</strong>, c&ugrave;ng mức gi&aacute; hợp l&yacute; khiến&nbsp;<strong>New Balance 530 MR530PC</strong>&nbsp;trở th&agrave;nh một trong những lựa chọn s&aacute;ng gi&aacute; nhất cho những ai đang t&igrave;m kiếm một đ&ocirc;i sneaker đa năng, ph&ugrave; hợp cả thời trang lẫn vận động.</p>\r\n\r\n<h3>&nbsp;</h3>', 14, 2000000, 1000000, 1, '2025-09-14 07:57:52', '2025-09-14 22:42:31', '/uploads/products/1757909491_Giay-New-Balance-530-White-Light-Chrome-Blue-MR530PC.jpg'),
(98, 'Giày New Balance 530 ‘White’ MR530CT', '<p bis_size=\"{&quot;x&quot;:20,&quot;y&quot;:20,&quot;w&quot;:1158,&quot;h&quot;:20,&quot;abs_x&quot;:306,&quot;abs_y&quot;:760}\"><strong bis_size=\"{&quot;x&quot;:20,&quot;y&quot;:23,&quot;w&quot;:88,&quot;h&quot;:14,&quot;abs_x&quot;:306,&quot;abs_y&quot;:763}\">Thương hiệu: New Balance</strong></p>\r\n\r\n<p bis_size=\"{&quot;x&quot;:20,&quot;y&quot;:53,&quot;w&quot;:1158,&quot;h&quot;:20,&quot;abs_x&quot;:306,&quot;abs_y&quot;:793}\"><strong bis_size=\"{&quot;x&quot;:20,&quot;y&quot;:57,&quot;w&quot;:53,&quot;h&quot;:14,&quot;abs_x&quot;:306,&quot;abs_y&quot;:797}\">Thiết kế:</strong>&nbsp;530</p>\r\n\r\n<p bis_size=\"{&quot;x&quot;:20,&quot;y&quot;:87,&quot;w&quot;:1158,&quot;h&quot;:20,&quot;abs_x&quot;:306,&quot;abs_y&quot;:827}\"><strong bis_size=\"{&quot;x&quot;:20,&quot;y&quot;:90,&quot;w&quot;:86,&quot;h&quot;:14,&quot;abs_x&quot;:306,&quot;abs_y&quot;:830}\">M&atilde; sản phẩm:</strong>&nbsp;MR530CT</p>\r\n\r\n<p bis_size=\"{&quot;x&quot;:20,&quot;y&quot;:121,&quot;w&quot;:1158,&quot;h&quot;:20,&quot;abs_x&quot;:306,&quot;abs_y&quot;:861}\"><strong bis_size=\"{&quot;x&quot;:20,&quot;y&quot;:124,&quot;w&quot;:52,&quot;h&quot;:14,&quot;abs_x&quot;:306,&quot;abs_y&quot;:864}\">Xuất xứ:</strong>&nbsp;Mỹ</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Trọng lượng</th>\r\n			<td>&nbsp; &nbsp;1 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Size</th>\r\n			<td>\r\n			<p>39.5, 40.5</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', '<p>Trong những năm gần đ&acirc;y, tr&agrave;o lưu sneaker mang phong c&aacute;ch Y2K (2000s) đang quay trở lại mạnh mẽ, v&agrave; kh&ocirc;ng c&aacute;i t&ecirc;n n&agrave;o thể hiện xu hướng đ&oacute; r&otilde; n&eacute;t hơn&nbsp;<strong>New Balance 530</strong>. Trong đ&oacute;, phi&ecirc;n bản&nbsp;<strong>New Balance 530 &lsquo;White&rsquo; MR530CT</strong>&nbsp;đ&atilde; nhanh ch&oacute;ng trở th&agrave;nh đ&ocirc;i gi&agrave;y &ldquo;quốc d&acirc;n&rdquo; nhờ thiết kế tối giản, tinh tế nhưng vẫn đầy t&iacute;nh thời trang.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Ấn tượng đầu ti&ecirc;n về&nbsp;<strong>MR530CT</strong>&nbsp;ch&iacute;nh l&agrave; vẻ ngo&agrave;i sạch sẽ, hiện đại với phối m&agrave;u&nbsp;<strong>trắng chủ đạo</strong>, điểm nhẹ một ch&uacute;t x&aacute;m bạc v&agrave; đen ở logo v&agrave; đế gi&agrave;y. Đ&acirc;y l&agrave; sự lựa chọn l&yacute; tưởng cho những ai y&ecirc;u th&iacute;ch sự&nbsp;<strong>tối giản v&agrave; dễ phối đồ</strong>, ph&ugrave; hợp với hầu hết mọi phong c&aacute;ch &ndash; từ thể thao, năng động đến thanh lịch, casual.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Về chất liệu, phần upper của gi&agrave;y được cấu th&agrave;nh từ&nbsp;<strong>lưới mesh tho&aacute;ng kh&iacute;</strong>&nbsp;kết hợp với&nbsp;<strong>c&aacute;c mảng synthetic overlays (da tổng hợp)</strong>&nbsp;gi&uacute;p tăng độ bền m&agrave; vẫn giữ được trọng lượng nhẹ. Thiết kế n&agrave;y đảm bảo đ&ocirc;i gi&agrave;y lu&ocirc;n th&ocirc;ng tho&aacute;ng, ph&ugrave; hợp để sử dụng cả ng&agrave;y d&agrave;i trong c&aacute;c hoạt động thường ng&agrave;y.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Một điểm mạnh kh&ocirc;ng thể kh&ocirc;ng nhắc đến l&agrave; phần đệm&nbsp;<strong>ABZORB</strong>&nbsp;được t&iacute;ch hợp ở midsole &ndash; c&ocirc;ng nghệ đặc trưng của New Balance gi&uacute;p hấp thụ lực v&agrave; giảm chấn hiệu quả. Đế gi&agrave;y c&oacute; độ d&agrave;y vừa phải, mang lại sự &ecirc;m &aacute;i v&agrave; hỗ trợ tốt cho b&agrave;n ch&acirc;n, đặc biệt ph&ugrave; hợp với những ai thường xuy&ecirc;n phải di chuyển hoặc đứng l&acirc;u.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Form gi&agrave;y</strong>&nbsp;của d&ograve;ng 530 vẫn giữ n&eacute;t cổ điển hơi hướng &ldquo;dad shoe&rdquo; &ndash; với phần mũi thon, g&oacute;t hơi b&egrave;, mang đến cảm gi&aacute;c thể thao nhưng kh&ocirc;ng qu&aacute; hầm hố. Điều n&agrave;y gi&uacute;p đ&ocirc;i gi&agrave;y ph&ugrave; hợp với nhiều d&aacute;ng người v&agrave; c&oacute; thể phối với đa dạng kiểu trang phục: từ quần jeans, quần short cho đến ch&acirc;n v&aacute;y d&agrave;i, quần t&acirc;y oversize&hellip;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Kh&ocirc;ng qu&aacute; lời khi n&oacute;i rằng&nbsp;<strong>New Balance 530 &lsquo;White&rsquo; MR530CT</strong>&nbsp;l&agrave; đ&ocirc;i gi&agrave;y &ldquo;must-have&rdquo; trong tủ đồ của mọi t&iacute;n đồ thời trang hiện đại. N&oacute; kh&ocirc;ng chỉ đẹp, dễ phối, m&agrave; c&ograve;n mang lại sự thoải m&aacute;i, linh hoạt &ndash; đ&uacute;ng tinh thần m&agrave; New Balance lu&ocirc;n theo đuổi:&nbsp;<strong>sự c&acirc;n bằng giữa phong c&aacute;ch v&agrave; hiệu năng</strong>.</p>', 14, 2000000, 1000000, 1, '2025-09-14 09:14:00', '2025-09-14 22:57:25', '/uploads/products/1757915845_Giay-New-Balance-MR530-White-MR530CT.jpg'),
(99, 'Giày New Balance 2002R ‘Shadow Grey’ M2002RNM', '<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Trọng lượng</th>\r\n			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 1 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Size</th>\r\n			<td>\r\n			<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 40.5, 41.5, 42, 42.5, 43, 44, 44.5, 45</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', '<p>Giữa v&ocirc; v&agrave;n lựa chọn sneaker tr&ecirc;n thị trường hiện nay, những đ&ocirc;i gi&agrave;y mang phong c&aacute;ch cổ điển pha lẫn hiện đại, dễ phối đồ v&agrave; mang lại cảm gi&aacute;c thoải m&aacute;i lu&ocirc;n được săn đ&oacute;n. V&agrave;&nbsp;<strong>New Balance 2002R &lsquo;Shadow Grey&rsquo; M2002RNM</strong>&nbsp;ch&iacute;nh l&agrave; một trong những đại diện xuất sắc cho xu hướng đ&oacute; &ndash; một đ&ocirc;i gi&agrave;y hội tụ đủ sự tinh tế trong thiết kế, độ bền trong chất liệu v&agrave; hiệu năng vượt trội trong trải nghiệm sử dụng.</p>\r\n\r\n<p>Lấy cảm hứng từ những mẫu gi&agrave;y chạy bộ đầu những năm 2000,&nbsp;<strong>2002R &lsquo;Shadow Grey&rsquo;</strong>&nbsp;sở hữu form d&aacute;ng cổ điển nhưng vẫn mang hơi thở đương đại. T&ocirc;ng m&agrave;u&nbsp;<strong>x&aacute;m tro (shadow grey)</strong>&nbsp;l&agrave;m chủ đạo, đi k&egrave;m với c&aacute;c lớp m&agrave;u x&aacute;m đậm &ndash; nhạt được phối hợp h&agrave;i h&ograve;a tạo n&ecirc;n chiều s&acirc;u cho thiết kế. Đ&acirc;y l&agrave; gam m&agrave;u trung t&iacute;nh cực kỳ dễ ứng dụng, ph&ugrave; hợp với mọi phong c&aacute;ch thời trang &ndash; từ streetwear c&aacute; t&iacute;nh đến phong c&aacute;ch tối giản, smart casual.</p>\r\n\r\n<p>Chất liệu gi&agrave;y l&agrave; sự kết hợp giữa&nbsp;<strong>da lộn cao cấp</strong>&nbsp;v&agrave;&nbsp;<strong>vải mesh tho&aacute;ng kh&iacute;</strong>, vừa mang đến vẻ ngo&agrave;i cao cấp, vừa đảm bảo độ thoải m&aacute;i v&agrave; th&ocirc;ng tho&aacute;ng khi mang l&acirc;u. Điều l&agrave;m n&ecirc;n sự kh&aacute;c biệt của d&ograve;ng 2002R nằm ở bộ đệm: phần midsole sử dụng c&ocirc;ng nghệ&nbsp;<strong>ABZORB</strong>&nbsp;gi&uacute;p hấp thụ lực tốt, trong khi phần g&oacute;t t&iacute;ch hợp&nbsp;<strong>N-ergy</strong>&nbsp;mang lại độ nảy v&agrave; cảm gi&aacute;c &ecirc;m &aacute;i đ&aacute;ng kinh ngạc. Ngo&agrave;i ra, hệ thống Stability Web ở phần đế giữa hỗ trợ v&ograve;m ch&acirc;n, tăng sự ổn định khi di chuyển.</p>\r\n\r\n<p><strong>M2002RNM</strong>&nbsp;kh&ocirc;ng chỉ l&agrave; một đ&ocirc;i gi&agrave;y đẹp &ndash; n&oacute; c&ograve;n l&agrave; một lựa chọn l&yacute; tưởng cho người cần sự linh hoạt: từ những bước đi thường ng&agrave;y, c&aacute;c buổi đi bộ đường d&agrave;i, cho đến việc kết hợp c&ugrave;ng outfit đi học, đi l&agrave;m. Ch&iacute;nh sự đơn giản nhưng tinh tế, thoải m&aacute;i nhưng mạnh mẽ đ&atilde; khiến mẫu gi&agrave;y n&agrave;y trở th&agrave;nh một phần kh&ocirc;ng thể thiếu trong tủ đồ của nhiều sneakerhead v&agrave; t&iacute;n đồ thời trang hiện đại.</p>', 14, 2000000, 1000000, 1, '2025-09-14 23:16:16', '2025-09-14 23:16:16', '/uploads/products/1757916976_Giay-New-Balance-2002R-Shadow-Grey-M2002RNM.jpg'),
(100, 'Giày Adidas Samba OG W ‘Wonder Quartz’ JR8830', '<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Trọng lượng</th>\r\n			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;1 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Size</th>\r\n			<td>\r\n			<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 36, 36 2/3, 37 1/3, 38, 38 2/3, 39 1/3</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', '<p><strong>Adidas Samba OG &lsquo;Wonder Quartz&rsquo;</strong>&nbsp;l&agrave; một biến thể đầy ấn tượng v&agrave; thời thượng của mẫu gi&agrave;y huyền thoại Samba. Phi&ecirc;n bản n&agrave;y được phủ l&ecirc;n m&igrave;nh t&ocirc;ng m&agrave;u &ldquo;Wonder Quartz&rdquo; (thạch anh tuyệt vời) ấm &aacute;p, kết hợp giữa m&agrave;u be chủ đạo v&agrave; c&aacute;c điểm nhấn m&agrave;u n&acirc;u sẫm v&agrave; trắng.</p>\r\n\r\n<p>Đ&ocirc;i gi&agrave;y vẫn giữ nguy&ecirc;n những DNA đặc trưng của d&ograve;ng Samba Original:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Thiết kế kinh điển:</strong>&nbsp;Form gi&agrave;y low-profile mỏng, nhẹ v&agrave; &ocirc;m ch&acirc;n.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Cấu tr&uacute;c nguy&ecirc;n bản:</strong>&nbsp;Mũi gi&agrave;y da lộn bồi đệm mềm mại, bộ 3 Sọc Ba m&agrave;u nổi bật tr&ecirc;n th&acirc;n gi&agrave;y bằng da mịn, v&agrave; đế ngo&agrave;i bằng cao su m&agrave;u g&ocirc;m (gum) cổ điển.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Linh vật da lộn:</strong>&nbsp;Miếng đắp g&oacute;t gi&agrave;y bằng da lộn với logo adidas nổi tạo n&ecirc;n điểm nhận diện quen thuộc.</p>\r\n	</li>\r\n</ul>\r\n\r\n<p>Với sự kết hợp m&agrave;u sắc trung t&iacute;nh, dễ phối đồ,&nbsp;<strong>Samba OG &lsquo;Wonder Quartz&rsquo;</strong>&nbsp;kh&ocirc;ng chỉ l&agrave; một đ&ocirc;i gi&agrave;y thể thao m&agrave; c&ograve;n l&agrave; một phụ kiện thời trang ho&agrave;n hảo, ph&ugrave; hợp để tạo điểm nhấn thanh lịch v&agrave; c&aacute; t&iacute;nh cho mọi outfit, từ trang phục casual đơn giản đến phong c&aacute;ch street-style.</p>', 13, 2000000, NULL, 1, '2025-09-14 23:18:21', '2025-09-14 23:18:21', '/uploads/products/1757917101_2-2.jpg'),
(101, 'Giày adidas Originals Gazelle Indoor ‘Beige’ JS1418', '<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Trọng lượng</th>\r\n			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 1 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Size</th>\r\n			<td>\r\n			<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 36 2/3, 37 1/3, 38, 38 2/3, 39 1/3, 40, 40 2/3, 41 1/3, 42, 42 2/3</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', '<p>Trong thế giới thời trang v&agrave; thể thao, Adidas lu&ocirc;n l&agrave; một trong những thương hiệu được nhiều người y&ecirc;u th&iacute;ch v&agrave; tin d&ugrave;ng. Một trong những mẫu gi&agrave;y nổi bật của Adidas m&agrave; t&ocirc;i muốn giới thiệu ch&iacute;nh l&agrave; đ&ocirc;i gi&agrave;y Adidas Originals Gazelle Indoor &lsquo;Beige&rsquo; với m&atilde; sản phẩm JS1418.</p>\r\n\r\n<p>Đ&ocirc;i gi&agrave;y n&agrave;y mang thiết kế rất tinh tế v&agrave; cổ điển, thể hiện sự kết hợp ho&agrave;n hảo giữa phong c&aacute;ch retro v&agrave; hiện đại. M&agrave;u beige nhẹ nh&agrave;ng tạo cảm gi&aacute;c dễ chịu v&agrave; dễ phối hợp với nhiều trang phục kh&aacute;c nhau, từ quần jeans, quần thể thao đến c&aacute;c bộ đồ casual h&agrave;ng ng&agrave;y. Sắc m&agrave;u n&agrave;y cũng gi&uacute;p người đi tr&ocirc;ng thanh lịch v&agrave; trẻ trung hơn.</p>\r\n\r\n<p>Chất liệu của gi&agrave;y Adidas Gazelle Indoor rất mềm mại v&agrave; bền bỉ, phần th&acirc;n gi&agrave;y được l&agrave;m từ da lộn cao cấp, gi&uacute;p tăng độ bền v&agrave; tho&aacute;ng kh&iacute; cho đ&ocirc;i ch&acirc;n. Đế gi&agrave;y được thiết kế với c&ocirc;ng nghệ đặc biệt ph&ugrave; hợp với c&aacute;c hoạt động trong nh&agrave; như chơi b&oacute;ng hoặc tập luyện nhẹ nh&agrave;ng, gi&uacute;p người d&ugrave;ng c&oacute; thể di chuyển linh hoạt v&agrave; thoải m&aacute;i hơn.</p>\r\n\r\n<p>Điều l&agrave;m t&ocirc;i ấn tượng nhất ở mẫu gi&agrave;y n&agrave;y ch&iacute;nh l&agrave; sự chăm ch&uacute;t tỉ mỉ trong từng chi tiết nhỏ: logo Adidas Originals được th&ecirc;u r&otilde; n&eacute;t, c&aacute;c đường may đều đặn v&agrave; chắc chắn, c&ugrave;ng phần lưỡi g&agrave; in t&ecirc;n sản phẩm tạo n&ecirc;n vẻ đẹp ho&agrave;n thiện v&agrave; chuy&ecirc;n nghiệp. Đ&acirc;y kh&ocirc;ng chỉ l&agrave; một đ&ocirc;i gi&agrave;y thể thao m&agrave; c&ograve;n l&agrave; một m&oacute;n phụ kiện thời trang đẳng cấp, ph&ugrave; hợp với nhiều đối tượng, từ giới trẻ năng động đến những người y&ecirc;u th&iacute;ch phong c&aacute;ch cổ điển.</p>', 13, 2000000, NULL, 1, '2025-09-14 23:20:20', '2025-09-14 23:20:20', '/uploads/products/1757917220_Giay-adidas-Originals-Gazelle-Indoor-Beige-JS1418.jpg'),
(102, 'Giày Adidas Superstar Vintage ‘White’ JQ3254', '<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Trọng lượng</th>\r\n			<td>&nbsp; &nbsp; &nbsp; &nbsp; 1 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Size</th>\r\n			<td>\r\n			<p>&nbsp; &nbsp; &nbsp; &nbsp; 37 1/3, 38, 39 1/3, 41 1/3, 42, 42 2/3</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', '<p>Trong thế giới thời trang hiện nay, gi&agrave;y kh&ocirc;ng chỉ đơn thuần l&agrave; một m&oacute;n phụ kiện cần thiết, m&agrave; c&ograve;n l&agrave; một phần quan trọng thể hiện c&aacute; t&iacute;nh, phong c&aacute;ch v&agrave; gu thẩm mỹ của người mang. Một trong những mẫu gi&agrave;y vừa mang t&iacute;nh biểu tượng, vừa kh&ocirc;ng ngừng đổi mới để ph&ugrave; hợp với xu hướng hiện đại ch&iacute;nh l&agrave;&nbsp;<strong>Adidas Superstar Vintage &lsquo;White&rsquo; JQ3254</strong>&nbsp;&ndash; phi&ecirc;n bản cổ điển đầy tinh tế v&agrave; lịch sử.</p>\r\n\r\n<p>Ra mắt lần đầu v&agrave;o những năm 1970, d&ograve;ng gi&agrave;y&nbsp;<strong>Adidas Superstar</strong>&nbsp;đ&atilde; nhanh ch&oacute;ng trở th&agrave;nh huyền thoại, khởi nguồn từ s&acirc;n b&oacute;ng rổ v&agrave; dần bước ra đời sống thường nhật, thời trang đường phố, thậm ch&iacute; l&agrave; văn h&oacute;a hip-hop.&nbsp;<strong>Phi&ecirc;n bản &lsquo;White&rsquo; JQ3254</strong>&nbsp;l&agrave; sự t&aacute;i hiện tinh tế những gi&aacute; trị nguy&ecirc;n bản của d&ograve;ng gi&agrave;y n&agrave;y, đồng thời mang đến n&eacute;t cổ điển qua từng chi tiết thiết kế.</p>\r\n\r\n<p>M&agrave;u trắng chủ đạo của đ&ocirc;i gi&agrave;y tượng trưng cho sự thuần khiết, đơn giản nhưng kh&ocirc;ng k&eacute;m phần sang trọng. Chất liệu da cao cấp được sử dụng ở phần upper gi&uacute;p gi&agrave;y vừa bền bỉ, vừa dễ lau ch&ugrave;i, lại tạo cảm gi&aacute;c mềm mại v&agrave; thoải m&aacute;i khi mang. Đặc biệt, thiết kế mũi gi&agrave;y vỏ s&ograve; &ndash; &ldquo;shell toe&rdquo; đặc trưng &ndash; vẫn được giữ nguy&ecirc;n như một dấu ấn kh&ocirc;ng thể thay thế, mang đậm chất retro v&agrave; gợi nhắc đến thời kỳ ho&agrave;ng kim của Adidas trong những thập ni&ecirc;n trước.</p>\r\n\r\n<p>Logo ba sọc kinh điển m&agrave;u đen tương phản nổi bật tr&ecirc;n nền trắng gi&uacute;p tăng th&ecirc;m t&iacute;nh nhận diện thương hiệu. Phần đế cao su dạng xương c&aacute; giữ cho người mang lu&ocirc;n cảm thấy chắc chắn, ổn định d&ugrave; di chuyển nhiều. Ngo&agrave;i ra, phi&ecirc;n bản JQ3254 c&ograve;n mang hơi hướng &ldquo;vintage&rdquo; r&otilde; n&eacute;t th&ocirc;ng qua c&aacute;c chi tiết như l&oacute;t gi&agrave;y cổ điển, c&aacute;ch phối m&agrave;u nhẹ nh&agrave;ng v&agrave; kiểu d&aacute;ng gọn g&agrave;ng, ph&ugrave; hợp với nhiều phong c&aacute;ch ăn mặc &ndash; từ streetwear năng động đến casual lịch sự.</p>\r\n\r\n<p>Kh&ocirc;ng chỉ đẹp về h&igrave;nh thức, đ&ocirc;i gi&agrave;y n&agrave;y c&ograve;n chứa đựng cả một d&ograve;ng chảy văn h&oacute;a v&agrave; lịch sử k&eacute;o d&agrave;i hơn nửa thế kỷ. Mang đ&ocirc;i Adidas Superstar Vintage &lsquo;White&rsquo; JQ3254 tr&ecirc;n ch&acirc;n, kh&ocirc;ng chỉ l&agrave; thể hiện gu thẩm mỹ tinh tế, m&agrave; c&ograve;n l&agrave; c&aacute;ch người mang thể hiện sự tr&acirc;n trọng với gi&aacute; trị truyền thống kết hợp c&ugrave;ng hơi thở hiện đại.</p>\r\n\r\n<p>T&oacute;m lại,&nbsp;<strong>Adidas Superstar Vintage &lsquo;White&rsquo; JQ3254</strong>&nbsp;l&agrave; một đ&ocirc;i gi&agrave;y l&yacute; tưởng d&agrave;nh cho những ai y&ecirc;u th&iacute;ch vẻ đẹp cổ điển nhưng vẫn muốn bắt kịp xu hướng thời trang ng&agrave;y nay. Đ&oacute; l&agrave; sự giao thoa ho&agrave;n hảo giữa qu&aacute; khứ v&agrave; hiện tại, giữa truyền thống v&agrave; s&aacute;ng tạo.</p>', 13, 2000000, NULL, 1, '2025-09-14 23:22:03', '2025-09-14 23:22:03', '/uploads/products/1757917323_Giay-Adidas-Superstar-Vintage-White-JQ3254.jpg'),
(103, 'Giày Nike Run Defy ‘White Apricot Agate’ HM9594-101', '<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Trọng lượng</th>\r\n			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 1 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Size</th>\r\n			<td>\r\n			<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;40, 41, 42.5, 44, 45</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', '<p>Trong thế giới thời trang thể thao ng&agrave;y c&agrave;ng ph&aacute;t triển, việc lựa chọn một đ&ocirc;i gi&agrave;y kh&ocirc;ng chỉ dừng lại ở c&ocirc;ng năng sử dụng m&agrave; c&ograve;n phải thể hiện được c&aacute; t&iacute;nh v&agrave; gu thẩm mỹ của người mang. Giữa v&ocirc; v&agrave;n lựa chọn, đ&ocirc;i gi&agrave;y&nbsp;<strong>Nike Run Defy &lsquo;White Apricot Agate&rsquo; HM9594-101</strong>&nbsp;đ&atilde; nhanh ch&oacute;ng thu h&uacute;t sự ch&uacute; &yacute; của nhiều t&iacute;n đồ sneaker v&agrave; người y&ecirc;u chạy bộ nhờ thiết kế nổi bật c&ugrave;ng hiệu suất vượt trội.</p>\r\n\r\n<p>Ngay từ c&aacute;i nh&igrave;n đầu ti&ecirc;n, đ&ocirc;i gi&agrave;y g&acirc;y ấn tượng với phối m&agrave;u thanh lịch nhưng kh&ocirc;ng k&eacute;m phần c&aacute; t&iacute;nh. T&ocirc;ng&nbsp;<strong>trắng chủ đạo</strong>, kết hợp với sắc&nbsp;<strong>cam đ&agrave;o (apricot)</strong>&nbsp;v&agrave; một ch&uacute;t&nbsp;<strong>agate (m&agrave;u n&acirc;u đ&aacute; qu&yacute;)</strong>&nbsp;tạo n&ecirc;n tổng thể h&agrave;i h&ograve;a, vừa tinh tế vừa năng động. Đ&acirc;y l&agrave; kiểu m&agrave;u ph&ugrave; hợp cho cả nam v&agrave; nữ, dễ d&agrave;ng phối đồ v&agrave; mang lại cảm gi&aacute;c trẻ trung, tươi mới cho người sử dụng.</p>\r\n\r\n<p>Kh&ocirc;ng chỉ đẹp về mặt thẩm mỹ,&nbsp;<strong>Nike Run Defy</strong>&nbsp;c&ograve;n ch&uacute; trọng đến yếu tố c&ocirc;ng nghệ v&agrave; sự thoải m&aacute;i. Phần đệm giữa được trang bị&nbsp;<strong>c&ocirc;ng nghệ foam nhẹ</strong>, gi&uacute;p hấp thụ lực tốt v&agrave; tăng cường độ &ecirc;m &aacute;i khi chạy hoặc đi bộ đường d&agrave;i. Thiết kế đế ngo&agrave;i với c&aacute;c r&atilde;nh linh hoạt gi&uacute;p cải thiện độ b&aacute;m v&agrave; độ ổn định tr&ecirc;n nhiều loại địa h&igrave;nh. Lưới upper nhẹ v&agrave; tho&aacute;ng kh&iacute; gi&uacute;p ch&acirc;n lu&ocirc;n kh&ocirc; tho&aacute;ng, hạn chế cảm gi&aacute;c b&iacute; b&aacute;ch khi vận động l&acirc;u.</p>\r\n\r\n<p>Ngo&agrave;i ra, thiết kế phần cổ gi&agrave;y &ocirc;m gọn mắt c&aacute; ch&acirc;n, hỗ trợ cố định b&agrave;n ch&acirc;n v&agrave; hạn chế chấn thương khi vận động mạnh. Điều n&agrave;y khiến đ&ocirc;i Nike Run Defy kh&ocirc;ng chỉ ph&ugrave; hợp với người chạy bộ chuy&ecirc;n nghiệp m&agrave; c&ograve;n rất l&yacute; tưởng cho những ai y&ecirc;u th&iacute;ch vận động h&agrave;ng ng&agrave;y hoặc chỉ đơn giản l&agrave; cần một đ&ocirc;i gi&agrave;y thời trang, thoải m&aacute;i để đi học hay đi l&agrave;m.</p>\r\n\r\n<p>C&oacute; thể n&oacute;i,&nbsp;<strong>Nike Run Defy &lsquo;White Apricot Agate&rsquo; HM9594-101</strong>&nbsp;l&agrave; một minh chứng r&otilde; r&agrave;ng cho triết l&yacute; &ldquo;đẹp phải đi đ&ocirc;i với chất lượng&rdquo; m&agrave; Nike lu&ocirc;n theo đuổi. Đ&acirc;y kh&ocirc;ng chỉ l&agrave; một đ&ocirc;i gi&agrave;y, m&agrave; c&ograve;n l&agrave; người bạn đồng h&agrave;nh đ&aacute;ng tin cậy cho những ai đang t&igrave;m kiếm sự kết hợp ho&agrave;n hảo giữa thời trang v&agrave; hiệu năng.</p>', 10, 2000000, 1000000, 1, '2025-09-14 23:29:42', '2025-09-14 23:29:42', '/uploads/products/1757917782_Giay-Nike-Run-Defy-White-Apricot-Agate-HM9594-101.jpg'),
(104, 'Giày Nike Winflo 11 ‘Football Grey Deep Night’ FJ9509-006', '<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Trọng lượng</th>\r\n			<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 1 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<th>Size</th>\r\n			<td>\r\n			<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;40, 40.5, 41, 42, 42.5, 43, 44, 44.5, 45</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', '<p>Trong thế giới gi&agrave;y thể thao ng&agrave;y nay, việc t&igrave;m kiếm một đ&ocirc;i gi&agrave;y vừa đ&aacute;p ứng được nhu cầu tập luyện, vừa c&oacute; thiết kế thời thượng kh&ocirc;ng phải l&agrave; điều dễ d&agrave;ng. Tuy nhi&ecirc;n, Nike &ndash; thương hiệu đ&atilde; qu&aacute; quen thuộc với người y&ecirc;u thể thao &ndash; tiếp tục khẳng định đẳng cấp của m&igrave;nh với phi&ecirc;n bản&nbsp;<strong>Winflo 11 &lsquo;Football Grey Deep Night&rsquo; (FJ9509-006)</strong>. Đ&acirc;y kh&ocirc;ng chỉ đơn thuần l&agrave; một đ&ocirc;i gi&agrave;y chạy bộ, m&agrave; c&ograve;n l&agrave; tuy&ecirc;n ng&ocirc;n về sự tinh tế, c&ocirc;ng nghệ v&agrave; phong c&aacute;ch sống năng động.</p>\r\n\r\n<p>Điểm nổi bật đầu ti&ecirc;n phải kể đến l&agrave;&nbsp;<strong>thiết kế phối m&agrave;u &ldquo;Football Grey Deep Night&rdquo;</strong>&nbsp;đầy cuốn h&uacute;t. M&agrave;u x&aacute;m nhạt chủ đạo kết hợp c&ugrave;ng sắc t&iacute;m trầm &ldquo;Deep Night&rdquo; tạo n&ecirc;n một tổng thể h&agrave;i h&ograve;a, hiện đại v&agrave; cực kỳ dễ phối đồ. D&ugrave; l&agrave; đi chạy, tập gym hay đơn giản chỉ l&agrave; dạo phố, đ&ocirc;i gi&agrave;y n&agrave;y vẫn giữ được vẻ c&aacute; t&iacute;nh v&agrave; năng động m&agrave; kh&ocirc;ng qu&aacute; ph&ocirc; trương.</p>\r\n\r\n<p>Về mặt c&ocirc;ng nghệ,&nbsp;<strong>Nike Winflo 11</strong>&nbsp;tiếp tục ph&aacute;t huy những cải tiến từ thế hệ trước với lớp đệm&nbsp;<strong>Cushlon</strong>&nbsp;&ecirc;m &aacute;i v&agrave; bộ đế giữa hỗ trợ phản hồi lực tốt. Lớp upper l&agrave;m từ lưới kỹ thuật mang lại độ th&ocirc;ng tho&aacute;ng cao, giữ cho b&agrave;n ch&acirc;n lu&ocirc;n kh&ocirc; r&aacute;o trong qu&aacute; tr&igrave;nh vận động. Cấu tr&uacute;c gi&agrave;y &ocirc;m ch&acirc;n, kết hợp với phần cổ thấp gi&uacute;p người mang c&oacute; cảm gi&aacute;c linh hoạt nhưng vẫn rất chắc chắn.</p>\r\n\r\n<p>Điểm m&igrave;nh thực sự ấn tượng ở đ&ocirc;i Winflo 11 n&agrave;y l&agrave;&nbsp;<strong>cảm gi&aacute;c thoải m&aacute;i khi chạy đường d&agrave;i</strong>. D&ugrave; vận động li&ecirc;n tục trong nhiều giờ, ch&acirc;n vẫn kh&ocirc;ng bị b&iacute; hay mỏi, một phần nhờ v&agrave;o thiết kế khung g&oacute;t v&agrave; phần đệm hỗ trợ chuyển động mượt m&agrave;. Đ&ocirc;i gi&agrave;y mang đến cảm gi&aacute;c nhẹ, linh hoạt nhưng vẫn đảm bảo độ b&aacute;m v&agrave; ổn định tr&ecirc;n nhiều bề mặt kh&aacute;c nhau.</p>', 10, 2000000, 1000000, 1, '2025-09-14 23:32:56', '2025-09-14 23:32:56', '/uploads/products/1757917976_Giay-Nike-Winflo-11-Football-Grey-Deep-Night-FJ9509-006.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_path`, `created_at`, `updated_at`) VALUES
(6, 97, '/uploads/products/1757909491_68c791f3a4571_Giay-New-Balance-530-White-Light-Chrome-Blue-MR530PC-2.jpg', '2025-09-14 21:11:31', '2025-09-14 21:11:31'),
(7, 97, '/uploads/products/1757909491_68c791f3a498f_Giay-New-Balance-530-White-Light-Chrome-Blue-MR530PC-3.jpg', '2025-09-14 21:11:31', '2025-09-14 21:11:31'),
(8, 97, '/uploads/products/1757909491_68c791f3a4e05_Giay-New-Balance-530-White-Light-Chrome-Blue-MR530PC-4.jpg', '2025-09-14 21:11:31', '2025-09-14 21:11:31'),
(9, 97, '/uploads/products/1757909491_68c791f3a527a_Giay-New-Balance-530-White-Light-Chrome-Blue-MR530PC-5.jpg', '2025-09-14 21:11:31', '2025-09-14 21:11:31'),
(10, 97, '/uploads/products/1757909491_68c791f3a5722_Giay-New-Balance-530-White-Light-Chrome-Blue-MR530PC-6.jpg', '2025-09-14 21:11:31', '2025-09-14 21:11:31'),
(11, 98, '/uploads/products/1757915845_68c7aac5a51c7_Giay-New-Balance-MR530-White-MR530CT-2.jpg', '2025-09-14 22:57:25', '2025-09-14 22:57:25'),
(12, 98, '/uploads/products/1757915845_68c7aac5a56e9_Giay-New-Balance-MR530-White-MR530CT-3.jpg', '2025-09-14 22:57:25', '2025-09-14 22:57:25'),
(13, 98, '/uploads/products/1757915845_68c7aac5a5c43_Giay-New-Balance-MR530-White-MR530CT-4.jpg', '2025-09-14 22:57:25', '2025-09-14 22:57:25'),
(14, 98, '/uploads/products/1757915845_68c7aac5a61de_Giay-New-Balance-MR530-White-MR530CT-5.jpg', '2025-09-14 22:57:25', '2025-09-14 22:57:25'),
(15, 99, '/uploads/products/1757916976_68c7af30e4fd3_6-66.jpg', '2025-09-14 23:16:16', '2025-09-14 23:16:16'),
(16, 99, '/uploads/products/1757916976_68c7af30e537b_Giay-New-Balance-2002R-Shadow-Grey-M2002RNM-2.jpg', '2025-09-14 23:16:16', '2025-09-14 23:16:16'),
(17, 99, '/uploads/products/1757916976_68c7af30e594f_Giay-New-Balance-2002R-Shadow-Grey-M2002RNM-3.jpg', '2025-09-14 23:16:16', '2025-09-14 23:16:16'),
(18, 99, '/uploads/products/1757916976_68c7af30e5e85_Giay-New-Balance-2002R-Shadow-Grey-M2002RNM-4.jpg', '2025-09-14 23:16:16', '2025-09-14 23:16:16'),
(19, 100, '/uploads/products/1757917101_68c7afadc7690_3-2.jpg', '2025-09-14 23:18:21', '2025-09-14 23:18:21'),
(20, 100, '/uploads/products/1757917101_68c7afadc7d19_4-3.jpg', '2025-09-14 23:18:21', '2025-09-14 23:18:21'),
(21, 100, '/uploads/products/1757917101_68c7afadc8138_5-2.jpg', '2025-09-14 23:18:21', '2025-09-14 23:18:21'),
(22, 100, '/uploads/products/1757917101_68c7afadc860d_z6983170027493_4300fa39e16b38a6adea241752a56c48-scaled.jpg', '2025-09-14 23:18:21', '2025-09-14 23:18:21'),
(23, 101, '/uploads/products/1757917220_68c7b0241c86d_Giay-adidas-Originals-Gazelle-Indoor-Beige-JS1418-2.jpg', '2025-09-14 23:20:20', '2025-09-14 23:20:20'),
(24, 101, '/uploads/products/1757917220_68c7b0241cdcf_Giay-adidas-Originals-Gazelle-Indoor-Beige-JS1418-3.jpg', '2025-09-14 23:20:20', '2025-09-14 23:20:20'),
(25, 101, '/uploads/products/1757917220_68c7b0241d3f2_Giay-adidas-Originals-Gazelle-Indoor-Beige-JS1418-4.jpg', '2025-09-14 23:20:20', '2025-09-14 23:20:20'),
(26, 101, '/uploads/products/1757917220_68c7b0241d8b4_Giay-adidas-Originals-Gazelle-Indoor-Beige-JS1418-5.jpg', '2025-09-14 23:20:20', '2025-09-14 23:20:20'),
(27, 101, '/uploads/products/1757917220_68c7b0241dd95_z6983170027493_4300fa39e16b38a6adea241752a56c48-scaled.jpg', '2025-09-14 23:20:20', '2025-09-14 23:20:20'),
(28, 102, '/uploads/products/1757917323_68c7b08b86b8b_Giay-Adidas-Superstar-Vintage-White-JQ3254-2.jpg', '2025-09-14 23:22:03', '2025-09-14 23:22:03'),
(29, 102, '/uploads/products/1757917323_68c7b08b86f55_Giay-Adidas-Superstar-Vintage-White-JQ3254-3.jpg', '2025-09-14 23:22:03', '2025-09-14 23:22:03'),
(30, 102, '/uploads/products/1757917323_68c7b08b874d3_Giay-Adidas-Superstar-Vintage-White-JQ3254-4.jpg', '2025-09-14 23:22:03', '2025-09-14 23:22:03'),
(31, 102, '/uploads/products/1757917323_68c7b08b87a41_Giay-Adidas-Superstar-Vintage-White-JQ3254-5.jpg', '2025-09-14 23:22:03', '2025-09-14 23:22:03'),
(32, 103, '/uploads/products/1757917782_68c7b2566218b_Giay-Nike-Run-Defy-White-Apricot-Agate-HM9594-101-2.jpg', '2025-09-14 23:29:42', '2025-09-14 23:29:42'),
(33, 103, '/uploads/products/1757917782_68c7b256624c5_Giay-Nike-Run-Defy-White-Apricot-Agate-HM9594-101-3.jpg', '2025-09-14 23:29:42', '2025-09-14 23:29:42'),
(34, 103, '/uploads/products/1757917782_68c7b25662836_Giay-Nike-Run-Defy-White-Apricot-Agate-HM9594-101-4.jpg', '2025-09-14 23:29:42', '2025-09-14 23:29:42'),
(35, 103, '/uploads/products/1757917782_68c7b25662b97_Giay-Nike-Run-Defy-White-Apricot-Agate-HM9594-101-5.jpg', '2025-09-14 23:29:42', '2025-09-14 23:29:42'),
(36, 104, '/uploads/products/1757917976_68c7b31813402_Giay-Nike-Winflo-11-Football-Grey-Deep-Night-FJ9509-006-2 - Copy.jpg', '2025-09-14 23:32:56', '2025-09-14 23:32:56'),
(37, 104, '/uploads/products/1757917976_68c7b318137b8_Giay-Nike-Winflo-11-Football-Grey-Deep-Night-FJ9509-006-3 - Copy.jpg', '2025-09-14 23:32:56', '2025-09-14 23:32:56'),
(38, 104, '/uploads/products/1757917976_68c7b31813b26_Giay-Nike-Winflo-11-Football-Grey-Deep-Night-FJ9509-006-4 - Copy.jpg', '2025-09-14 23:32:56', '2025-09-14 23:32:56'),
(39, 104, '/uploads/products/1757917976_68c7b31813e8a_Giay-Nike-Winflo-11-Football-Grey-Deep-Night-FJ9509-006-5.jpg', '2025-09-14 23:32:56', '2025-09-14 23:32:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `size_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `product_id`, `size_id`, `quantity`, `created_at`, `updated_at`) VALUES
(71, 97, 1, 1, '2025-09-14 22:42:31', '2025-09-14 22:42:31'),
(72, 97, 2, 1, '2025-09-14 22:42:31', '2025-09-14 22:42:31'),
(73, 97, 3, 1, '2025-09-14 22:42:31', '2025-09-14 22:42:31'),
(74, 97, 4, 1, '2025-09-14 22:42:31', '2025-09-14 22:42:31'),
(75, 97, 5, 1, '2025-09-14 22:42:31', '2025-09-14 22:42:31'),
(76, 97, 6, 1, '2025-09-14 22:42:31', '2025-09-14 22:42:31'),
(77, 97, 7, 1, '2025-09-14 22:42:31', '2025-09-14 22:42:31'),
(78, 97, 8, 1, '2025-09-14 22:42:31', '2025-09-14 22:42:31'),
(79, 97, 9, 1, '2025-09-14 22:42:31', '2025-09-14 22:42:31'),
(80, 98, 1, 1, '2025-09-14 22:57:25', '2025-09-14 22:57:25'),
(81, 98, 2, 1, '2025-09-14 22:57:25', '2025-09-14 22:57:25'),
(82, 98, 5, 1, '2025-09-14 22:57:25', '2025-09-14 22:57:25'),
(83, 99, 1, 1, '2025-09-14 23:16:16', '2025-09-14 23:16:16'),
(84, 100, 1, 1, '2025-09-14 23:18:21', '2025-09-14 23:18:21'),
(85, 101, 1, 1, '2025-09-14 23:20:20', '2025-09-14 23:20:20'),
(86, 102, 1, 1, '2025-09-14 23:22:03', '2025-09-14 23:22:03'),
(87, 103, 1, 1, '2025-09-14 23:29:42', '2025-09-14 23:29:42'),
(88, 104, 1, 1, '2025-09-14 23:32:56', '2025-09-14 23:32:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `rating` tinyint NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending','replied') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `admin_reply` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `rating`, `comment`, `created_at`, `updated_at`, `status`, `admin_reply`) VALUES
(15, 3, 97, 5, 'ssss', '2025-09-24 09:36:04', '2025-09-24 09:36:04', 'pending', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `review_images`
--

CREATE TABLE `review_images` (
  `id` bigint UNSIGNED NOT NULL,
  `review_id` bigint UNSIGNED NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `review_images`
--

INSERT INTO `review_images` (`id`, `review_id`, `path`, `created_at`, `updated_at`) VALUES
(7, 15, '/uploads/review/1758731764_z7031487382325_d4e28cbf715e77198c1c3dde914585cc-scaled.jpg', '2025-09-24 09:36:04', '2025-09-24 09:36:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('qIx4KHyG6wOj1mpdLzCYBtiaQaDuYpuOG2zCqy7w', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVHdUQjRBdVlLYVRnZjZuaGdBQ1FyUzlNekduNWRJbTN2N3pDcTBsMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9zaG9wLnRlc3QvcHJvZHVjdC9kZXRhaWwvNzEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjU1OiJsb2dpbl9mcm9udGVuZF81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1739890382);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '36', '2025-09-13 08:44:36', '2025-09-13 08:44:36'),
(2, '37', '2025-09-13 08:44:36', '2025-09-13 08:44:36'),
(3, '38', '2025-09-13 08:44:36', '2025-09-13 08:44:36'),
(4, '39', '2025-09-13 08:44:36', '2025-09-13 08:44:36'),
(5, '40', '2025-09-13 08:44:36', '2025-09-13 08:44:36'),
(6, '41', '2025-09-13 08:44:36', '2025-09-13 08:44:36'),
(7, '42', '2025-09-13 08:44:36', '2025-09-13 08:44:36'),
(8, '43', '2025-09-13 08:44:36', '2025-09-13 08:44:36'),
(9, '44', '2025-09-13 08:44:36', '2025-09-13 08:44:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_by` int NOT NULL,
  `active` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sliders`
--

INSERT INTO `sliders` (`id`, `name`, `url`, `thumb`, `sort_by`, `active`, `created_at`, `updated_at`, `description`) VALUES
(6, 'THỂ THAO', 'https://www.facebook.com/', '/uploads/products/1758597478_z7031487382325_d4e28cbf715e77198c1c3dde914585cc-scaled.jpg', 1, 1, '2025-01-21 05:32:28', '2025-09-22 20:17:58', '\"NÂNG SỨC KHỎE - NÂNG BƯỚC CHÂN\"'),
(9, 'SNEAKER', 'https://www.facebook.com/', '/uploads/products/1757921227_sneaker_guide_opener_ce7d4edd690e431791db097ededa61de_1024x1024.jpg', 1, 1, '2025-01-21 06:02:41', '2025-09-15 00:28:18', '\"Chọn đồ chất - Bật phong cách\"');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_admin` int NOT NULL DEFAULT '1',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `is_admin`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@localhost.com', NULL, 1, '$2y$12$/XLcslCjU9vc4hyphwBU/eJbM9c/k4SiUjJ/7rEtjt2wvEkJ0M4L2', 'P6t3lEMXMmsCsbZvZOCYqNqWWA8Peizr8x3v8jDM3QkuRKt5N2sYUYNhG3K2', '2024-11-28 02:56:58', '2024-11-28 08:10:36'),
(2, 'Demo', 'demo@gmail.com', NULL, 0, '$2y$12$dhjYJrvXb8mKPZTjKcSfbuKay6yI/DmyGItUOEWJ1JezbFFaCgUJ.', NULL, '2025-02-17 07:09:49', '2025-02-17 07:09:49'),
(3, 'manh', 'a@gmail.com', NULL, 0, '$2y$12$JqnoTtuDwk6viUGyPHyrDea1ke53xbYTa/BoXzgIQRNkxSrezrCSe', NULL, '2025-02-17 07:42:38', '2025-02-17 07:42:38'),
(4, 'b', 'b@gmail.com', NULL, 0, '$2y$12$ovj6/99WErpt..Zd8sCo4uX25WrAyUvCcfRIq1rk3GINRDii8XNYe', NULL, '2025-02-17 07:44:48', '2025-02-17 07:44:48'),
(5, 'c', 'c@gmail.com', NULL, 0, '$2y$12$/ki8VOiJ8PUvx0s9XEuideEFcJBYggNfyYWsWZE65VZB9kQUzvZmW', NULL, '2025-02-17 07:51:42', '2025-02-17 07:51:42'),
(6, 'd', 'd@gmail.com', NULL, 0, '$2y$12$XcpC4/csxjg65sbET3SY6OCHSZr3BYLDB7B541UKcYKY5GTB7Kgu6', NULL, '2025-02-17 07:53:53', '2025-02-17 07:53:53');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_clients`
--

CREATE TABLE `user_clients` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `infos`
--
ALTER TABLE `infos`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `order_items_size_id_foreign` (`size_id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_sizes_product_id_foreign` (`product_id`),
  ADD KEY `product_sizes_size_id_foreign` (`size_id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `review_images`
--
ALTER TABLE `review_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_images_review_id_foreign` (`review_id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `user_clients`
--
ALTER TABLE `user_clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_clients_email_unique` (`email`),
  ADD UNIQUE KEY `user_clients_phone_unique` (`phone`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT cho bảng `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `infos`
--
ALTER TABLE `infos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT cho bảng `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `review_images`
--
ALTER TABLE `review_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `user_clients`
--
ALTER TABLE `user_clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_sizes_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `review_images`
--
ALTER TABLE `review_images`
  ADD CONSTRAINT `review_images_review_id_foreign` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
