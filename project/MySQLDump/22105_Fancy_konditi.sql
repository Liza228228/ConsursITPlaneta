-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: db
-- Время создания: Дек 26 2024 г., 00:34
-- Версия сервера: 10.9.3-MariaDB-1:10.9.3+maria~ubu2204
-- Версия PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `22105_Fancy_konditi`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id_category` bigint(20) UNSIGNED NOT NULL,
  `name_category` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id_category`, `name_category`, `available`, `created_at`, `updated_at`) VALUES
(1, 'Торты', 1, '2024-12-17 13:58:25', '2024-12-17 13:58:25'),
(2, 'Десерты', 1, '2024-12-17 13:58:30', '2024-12-19 11:14:39');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
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
-- Структура таблицы `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_11_07_235929_create_categories_table', 1),
(5, '2024_11_07_235930_create_orders_table', 1),
(6, '2024_11_07_235930_create_products_table', 1),
(7, '2024_11_07_235931_create_order_items_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id_order` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('Создан','Принят','В процессе','Готов к выдаче','Отменён') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Создан',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id_order`, `id_user`, `order_date`, `total_amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '2024-12-19 01:56:47', '3000.00', 'В процессе', '2024-12-19 09:56:47', '2024-12-19 09:58:12'),
(2, 4, '2024-12-19 03:12:00', '2770.00', 'Принят', '2024-12-19 11:12:00', '2024-12-19 11:14:07');

-- --------------------------------------------------------

--
-- Структура таблицы `order_items`
--

CREATE TABLE `order_items` (
  `id_order_item` bigint(20) UNSIGNED NOT NULL,
  `id_order` bigint(20) UNSIGNED NOT NULL,
  `id_product` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `order_items`
--

INSERT INTO `order_items` (`id_order_item`, `id_order`, `id_product`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 1, '1400.00', '2024-12-19 09:56:47', '2024-12-19 09:56:47'),
(2, 1, 5, 1, '1600.00', '2024-12-19 09:56:47', '2024-12-19 09:56:47'),
(3, 2, 2, 2, '1350.00', '2024-12-19 11:12:00', '2024-12-19 11:12:00'),
(4, 2, 10, 1, '70.00', '2024-12-19 11:12:00', '2024-12-19 11:12:00');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id_product` bigint(20) UNSIGNED NOT NULL,
  `name_product` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1,
  `quantity` int(11) NOT NULL,
  `id_category` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id_product`, `name_product`, `description`, `picture`, `weight`, `price`, `available`, `quantity`, `id_category`, `created_at`, `updated_at`) VALUES
(1, '3 Шоколада', 'Изысканный муссовый десерт, сочетающий в себе вкус воздушного шоколадного бисквита и три нежнейших по своей текстуре слоя со вкусом темного, молочного и белого шоколада.', '/images/product/3_sokolada.png', '1.20', '1200.00', 1, 5, 1, '2024-12-17 13:59:16', '2024-12-17 13:59:16'),
(2, 'Ассоль', 'Это классический белый бисквит с цитрусовой ноткой, конфи из клубники, кусочки свежего киви и лёгкий сливочный крем.', '/images/product/assol.png', '1.20', '1350.00', 1, 2, 1, '2024-12-17 14:00:57', '2024-12-19 11:12:00'),
(3, 'Австрийский', 'Традиционный шоколадный слоёный пирог с абрикосовой начинкой и шоколадной глазурью.', '/images/product/avstriski.png', '1.20', '1500.00', 1, 5, 1, '2024-12-17 14:01:46', '2024-12-17 14:01:46'),
(4, 'Черемуховый', 'Он называется так, потому что в составе теста для коржей присутствует черёмуховая мука — тонко перемолотые сушёные ягоды дикорастущей черёмухи (вместе с косточкой).', '/images/product/cheremux.png', '1.50', '1300.00', 1, 3, 1, '2024-12-17 14:03:45', '2024-12-17 14:03:45'),
(5, 'Француз', 'Состоит из трёх бисквитных коржей: с грецким орехом, с бельгийским какао и с изюмом.', '/images/product/francys.png', '1.30', '1600.00', 1, 1, 1, '2024-12-17 14:05:45', '2024-12-19 09:56:47'),
(6, 'Ягодный', 'Состоит из нескольких слоёв бисквита, прослоенных кремом и ягодами. Ягоды придают торту свежесть и яркость, а также обеспечивают его полезными витаминами и минералами.', '/images/product/iagodni.png', '1.10', '1350.00', 1, 6, 1, '2024-12-17 14:06:34', '2024-12-17 14:06:34'),
(7, 'Королевский', 'Вкусный домашний десерт, состоящий из сметанных коржей с различными добавками, такими как: орехи, какао, кофе, мак, сухофрукты, кокосовая стружка или цукаты. В качестве крема чаще всего используется взбитая с сахаром сметана, а отделка и украшение остаются на усмотрение хозяйки.', '/images/product/korolevski.png', '1.40', '1400.00', 1, 5, 1, '2024-12-17 14:08:12', '2024-12-19 09:56:47'),
(8, 'Красный бархат', 'Шоколадный торт тёмно-красного, ярко-красного или красно-коричневого цвета. Традиционно готовится как слоёный пирог с глазурью из сливочного сыра.', '/images/product/krasni_barx.png', '1.40', '1700.00', 1, 6, 1, '2024-12-17 14:09:40', '2024-12-17 14:09:40'),
(9, 'Черничная корзинка', 'Десерт, который сочетает в себе песочное хрустящее тесто, черничный джем и нежный творожно-сливочный крем.', '/images/product/desert_korz_chern.png', '0.30', '70.00', 1, 7, 2, '2024-12-17 14:16:02', '2024-12-19 10:47:56'),
(10, 'Клубничная корзинка', 'Десерт, состоящий из песочного теста, крема на сливках и сгущённом молоке и клубники.', '/images/product/desert_korz_klub.png', '0.25', '70.00', 1, 6, 2, '2024-12-17 14:19:46', '2024-12-19 11:12:00'),
(11, 'Макарон клубника мята', 'Французское миндальное печенье с двойной начинкой из шоколадного ганаша и фруктового пюре.', '/images/product/makarin_klub_mata.png', '0.20', '52.00', 1, 10, 2, '2024-12-17 14:21:55', '2024-12-17 14:21:55'),
(12, 'Макарон малина', 'Французское миндальное печенье с начинкой из шоколадного ганаша и фруктового пюре. Два воздушных печенья из миндальной муки соединены начинкой из нежного крема.', '/images/product/makarin_malina.png', '0.20', '50.00', 1, 10, 2, '2024-12-17 14:23:36', '2024-12-17 14:23:36'),
(13, 'Пирог Абрикосовый', 'тест', '/images/product/pirog_abrikos.png', '0.30', '500.00', 1, 5, NULL, '2024-12-19 11:16:37', '2024-12-19 11:16:37');

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('h3s8RkUoy56ZvzakjCtQHEhZJkfBeeZr3PqpHaEB', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiY2NVMkNKWElaU1RKY3RSNXo1ZGZvUGluMzZTbW9xVVFQTkdrMDdYcyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9oZWxwIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1734578584);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `last_name`, `first_name`, `phone`, `login`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Кривогорницына', 'Елизавета', '+7 (457) 457-45-74', 'LizaA', '$2y$12$5Nls1c2tB/pBAH6dsHhDyuz5dRzG/mbqBG.gC35JbgjkyI96G7gli', 1, '2024-12-17 13:51:14', '2024-12-19 09:55:34'),
(2, 'Балаева', 'Анастасия', '+7 (999) 999-44-33', 'nasti', '$2y$12$n.85c1wWtpWH17UeSntGgurZCkCEKsfFF.tGOXHkGBAxnbOqPFHvG', 0, '2024-12-17 14:44:28', '2024-12-19 10:02:20'),
(4, 'Мурзина', 'Елена', '+7 (888) 888-88-88', 'Lena8', '$2y$12$oo5tA3g4hTG5XRAMJcZ/ke37z2wbl5gv3RV891HAmgvPsIEhL6tqW', 0, '2024-12-19 11:11:47', '2024-12-19 11:12:36');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Индексы таблицы `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Индексы таблицы `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `orders_id_user_foreign` (`id_user`);

--
-- Индексы таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id_order_item`),
  ADD KEY `order_items_id_order_foreign` (`id_order`),
  ADD KEY `order_items_id_product_foreign` (`id_product`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `products_id_category_foreign` (`id_category`);

--
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_login_unique` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id_order_item` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id_product` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_id_order_foreign` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_id_category_foreign` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
