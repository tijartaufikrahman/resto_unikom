-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Agu 2024 pada 15.31
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resto_unikom`
--
CREATE DATABASE IF NOT EXISTS `resto_unikom` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `resto_unikom`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_category` varchar(255) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name_category`, `note`, `created_at`, `updated_at`) VALUES
(1, 'Foods (Makanan)', NULL, NULL, NULL),
(2, 'Drinks (Minuman)', NULL, NULL, NULL),
(3, 'Makanan Ringan (Snacks)', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cookings`
--

CREATE TABLE `cookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `chef_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status_cooking` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `food__materials`
--

CREATE TABLE `food__materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_material` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `note_material` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `food__materials`
--

INSERT INTO `food__materials` (`id`, `name_material`, `stock`, `note_material`, `created_at`, `updated_at`) VALUES
(1, 'Terigu', 1000, '', NULL, NULL),
(3, 'Gula', 1000, '', NULL, NULL),
(4, 'Tapioka', 1000, '', NULL, NULL),
(5, 'Kentang (1pcs/300gr)', 1000, '', NULL, NULL),
(7, 'Teh Celup', 1000, '', NULL, NULL),
(8, 'Garam', 25, '', NULL, NULL),
(9, 'Saus Blibis', 25, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name_menu` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `parent_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id`, `name_menu`, `link`, `icon`, `parent_id`) VALUES
(1, 'Dashboard', 'dashboard', 'fas fa-dashboard', NULL),
(2, 'Find Table and Seats', 'find-table-and-seats', 'bi-table', NULL),
(3, 'Check Order Availability', 'check-order-availability', 'bi bi-cart-check-fill', NULL),
(4, 'Order List', 'order-list', 'bi-receipt', NULL),
(5, 'Serve Food and Drinks', 'serve-food-and-drinks', 'bi-cup-straw', NULL),
(6, 'Manage Items', '#', 'bi bi-book', NULL),
(7, 'Foods', 'new-foods', 'bi-box-seam', 6),
(8, 'Categories', 'new-category', 'bi-tags', 6),
(9, 'Food Materials', 'food-materials', 'fas fa-leaf', 6),
(10, 'Order & Kitchen', 'orderhandling-food-preparation', 'bi-egg-fried', NULL),
(11, 'Order History', 'order-history', 'bi bi-file-earmark-text', NULL),
(12, 'Payment', 'payment', 'bi-credit-card', NULL),
(13, 'Transaction Report', 'transaction-report', 'bi-file-text', NULL),
(14, 'Create Users', 'users', 'bi bi-person-fill-add', NULL),
(15, 'Analytics', 'analytics', 'fa-solid fa-chart-line', NULL),
(16, 'Profile', 'profile', 'fas fa-user', NULL),
(17, 'Product Sales Report', 'product-sales-report', 'bi bi-file-earmark-spreadsheet', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_role`
--

CREATE TABLE `menu_role` (
  `id` int(11) NOT NULL,
  `menu_id` int(255) NOT NULL,
  `role_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menu_role`
--

INSERT INTO `menu_role` (`id`, `menu_id`, `role_id`) VALUES
(4, 1, '1'),
(5, 17, '1'),
(17, 14, '1'),
(19, 2, '2'),
(20, 3, '9'),
(21, 4, '2'),
(22, 5, '2'),
(23, 6, '3'),
(24, 7, '3'),
(25, 8, '3'),
(26, 9, '3'),
(27, 10, '3'),
(28, 11, '3'),
(29, 12, '4'),
(30, 13, '4'),
(34, 16, '2'),
(35, 16, '3'),
(36, 16, '4'),
(37, 13, '1'),
(47, 6, '1'),
(48, 7, '1'),
(49, 8, '1'),
(50, 9, '1'),
(98, 15, '1'),
(99, 16, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_05_04_190717_create_roles_table', 1),
(6, '2024_06_01_151320_categories', 1),
(7, '2024_06_02_163349_create_articles_table', 1),
(8, '2024_06_07_190231_create_status_tables_table', 1),
(9, '2024_06_10_090841_create_products_table', 1),
(10, '2024_06_11_185935_create_order_list_items_table', 1),
(11, '2024_06_16_173750_create_transactions_table', 1),
(12, '2024_06_17_174751_create_orders_table', 1),
(13, '2024_06_17_181912_create_cookings_table', 1),
(14, '2024_06_24_115201_create_food__materials_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_table` bigint(20) UNSIGNED NOT NULL,
  `id_chef` bigint(20) UNSIGNED DEFAULT NULL,
  `status_order` varchar(255) NOT NULL DEFAULT 'Pending',
  `note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `id_user`, `id_table`, `id_chef`, `status_order`, `note`, `created_at`) VALUES
(121, 'John', 14, 1, NULL, 'Pending', 'Jangan Pake Sambel', '2024-08-09 13:21:35'),
(122, 'Oren', 14, 2, NULL, 'Pending', 'Jangan DI Kecapain', '2024-08-09 13:22:46'),
(123, 'Robert', 14, 3, NULL, 'Pending', 'Jangan Pake Garam', '2024-08-09 13:26:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_list_items`
--

CREATE TABLE `order_list_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `food_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `order_list_items`
--

INSERT INTO `order_list_items` (`id`, `id_user`, `order_id`, `food_id`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
(207, 14, 121, 9, 1, 'wait', NULL, NULL),
(208, 14, 121, 2, 1, 'wait', NULL, NULL),
(209, 14, 122, 3, 1, 'wait', NULL, NULL),
(210, 14, 122, 10, 1, 'wait', NULL, NULL),
(211, 14, 122, 14, 1, 'wait', NULL, NULL),
(212, 14, 123, 7, 1, 'wait', NULL, NULL),
(213, 14, 123, 14, 1, 'wait', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_product` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `stok` int(11) NOT NULL,
  `price` decimal(8,1) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name_product`, `category_id`, `stok`, `price`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Nasi Goreng', 1, 10, 14000.0, 'bahan1.jpg', NULL, NULL),
(2, 'Rendang', 1, 11, 18000.0, 'bahan2.jpg', NULL, NULL),
(3, 'Sate Ayam', 1, 12, 16000.0, 'bahan3.jpg', NULL, NULL),
(4, 'Soto Ayam Madura', 3, 0, 20000.0, 'bahan3.jpg', NULL, NULL),
(5, 'Nasi Padang', 1, 12, 16000.0, 'bahan4.jpg', NULL, NULL),
(6, 'Pecel Lele', 1, 0, 12000.0, 'bahan1.jpg', NULL, NULL),
(7, 'Ayam Goreng', 1, 15, 10000.0, 'bahan2.jpg', NULL, NULL),
(8, 'Bakso', 1, 0, 15000.0, 'bahan4.jpg', NULL, NULL),
(9, 'Ikan Bakar', 1, 10, 25000.0, 'bahan1.jpg', NULL, NULL),
(10, 'Martabak', 1, 15, 17000.0, 'bahan1.jpg', NULL, NULL),
(11, 'Mie Ayam', 1, 12, 10000.0, 'bahan3.jpg', NULL, NULL),
(12, 'Es Jeruk', 2, 12, 7000.0, 'es_jeruk.jpeg', NULL, NULL),
(13, 'Es Krim', 2, 99, 9000.0, 'es_krim.jpeg', NULL, NULL),
(14, 'Es Teh', 2, 99, 5000.0, 'es_teh.jpg', NULL, NULL),
(16, 'Kentang Goreng', 3, 99, 12000.0, 'kentang1.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_materials`
--

CREATE TABLE `product_materials` (
  `id` int(11) NOT NULL,
  `id_product` varchar(255) NOT NULL,
  `id_material` varchar(255) NOT NULL,
  `qty` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `product_materials`
--

INSERT INTO `product_materials` (`id`, `id_product`, `id_material`, `qty`) VALUES
(56, '14', '3', 11),
(62, '48', '1', 1),
(68, '49', '1', 1),
(69, '49', '3', 1),
(70, '49', '4', 1),
(108, '52', '3', 50),
(113, '53', '3', 1),
(114, '54', '1', 1),
(115, '54', '3', 1),
(120, '56', '3', 1),
(121, '57', '4', 1),
(123, '58', '3', 1),
(132, '50', '3', 2),
(137, '51', '7', 1),
(138, '16', '1', 2),
(139, '16', '5', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'administrator', NULL, NULL),
(2, 'waiter', NULL, NULL),
(3, 'chef', NULL, NULL),
(4, 'cashier', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_tables`
--

CREATE TABLE `status_tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `table_number` int(11) NOT NULL,
  `occupied` tinyint(1) NOT NULL DEFAULT 0,
  `maximum_seats` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `status_tables`
--

INSERT INTO `status_tables` (`id`, `table_number`, `occupied`, `maximum_seats`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 10, NULL, NULL),
(2, 2, 1, 10, NULL, NULL),
(3, 3, 1, 10, NULL, NULL),
(4, 4, 0, 10, NULL, NULL),
(5, 5, 0, 8, NULL, NULL),
(6, 6, 0, 8, NULL, NULL),
(7, 7, 0, 8, NULL, NULL),
(8, 8, 0, 8, NULL, NULL),
(9, 9, 0, 6, NULL, NULL),
(10, 10, 0, 6, NULL, NULL),
(11, 11, 0, 6, NULL, NULL),
(12, 12, 0, 6, NULL, NULL),
(13, 13, 0, 6, NULL, NULL),
(14, 14, 0, 6, NULL, NULL),
(15, 15, 0, 6, NULL, NULL),
(16, 16, 0, 6, NULL, NULL),
(17, 17, 0, 2, NULL, NULL),
(18, 18, 0, 2, NULL, NULL),
(19, 19, 0, 2, NULL, NULL),
(20, 20, 0, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` varchar(20) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL,
  `total` int(11) NOT NULL,
  `pay_money` decimal(8,2) DEFAULT NULL,
  `refund_money` decimal(8,2) DEFAULT NULL,
  `status_order` varchar(255) NOT NULL DEFAULT 'Payment Pending',
  `date` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `customer_name`, `order_id`, `id_user`, `total`, `pay_money`, `refund_money`, `status_order`, `date`, `created_at`) VALUES
('MK20240809202135', 'John', 121, 16, 43000, 50000.00, 7000.00, 'Paid', '2024-08-09 20:23:06', '2024-08-09 13:21:35'),
('MK20240809202246', 'Oren', 122, 16, 38000, 50000.00, 12000.00, 'Paid', '2024-08-08 20:23:18', '2024-08-09 13:22:46'),
('MK20240809202628', 'Robert', 123, 16, 15000, 30000.00, 15000.00, 'Paid', '2024-08-07 20:27:46', '2024-08-09 13:26:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `name`, `email_verified_at`, `password`, `remember_token`, `created_at`, `role_id`) VALUES
(1, 'Tijar Taufik Rahman', 'admin@gmail.com', 'Tijar Taufik Rahman', NULL, '12345', NULL, NULL, 1),
(14, 'Victoria Clark', 'waiter@gmail.com', 'Victoria Clark', NULL, '12345', NULL, NULL, 2),
(15, 'Charlotte Anderson', 'chef@gmail.com', 'Charlotte Anderson', NULL, '12345', NULL, NULL, 3),
(16, 'Isabella Thompson', 'cashier@gmail.com', 'Isabella Thompson', NULL, '12345', NULL, NULL, 4),
(18, 'xxx', 'cashier2@gmail.com', 'xxx', NULL, '12345', NULL, NULL, 4);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cookings`
--
ALTER TABLE `cookings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `food__materials`
--
ALTER TABLE `food__materials`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu_role`
--
ALTER TABLE `menu_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `order_list_items`
--
ALTER TABLE `order_list_items`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product_materials`
--
ALTER TABLE `product_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `status_tables`
--
ALTER TABLE `status_tables`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `cookings`
--
ALTER TABLE `cookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `food__materials`
--
ALTER TABLE `food__materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=996;

--
-- AUTO_INCREMENT untuk tabel `menu_role`
--
ALTER TABLE `menu_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT untuk tabel `order_list_items`
--
ALTER TABLE `order_list_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `product_materials`
--
ALTER TABLE `product_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `status_tables`
--
ALTER TABLE `status_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
