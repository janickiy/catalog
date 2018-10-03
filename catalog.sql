-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 03 2018 г., 17:35
-- Версия сервера: 10.1.34-MariaDB
-- Версия PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `catalog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `catalog`
--

CREATE TABLE `catalog` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `keywords` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `catalog`
--

INSERT INTO `catalog` (`id`, `name`, `description`, `keywords`, `image`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Каталог 1', 'Описание каталога 1', '34234 234234 23423', NULL, 0, '2018-10-01 09:53:09', '2018-10-01 09:53:09'),
(2, 'Подкатегория 1 1', NULL, NULL, NULL, 1, '2018-10-01 11:05:55', '2018-10-01 11:05:55'),
(3, 'Подкатегория 1 2', NULL, NULL, NULL, 1, '2018-10-01 11:06:10', '2018-10-01 11:06:10'),
(4, 'Категория 2', NULL, NULL, NULL, 0, '2018-10-01 11:06:22', '2018-10-01 11:06:30'),
(5, 'Подкатегория 2 1', NULL, NULL, NULL, 3, '2018-10-01 11:06:44', '2018-10-01 11:06:44'),
(15, 'gfhgf', NULL, NULL, '1538405411.jpeg', 0, '2018-10-01 11:50:11', '2018-10-01 11:50:11'),
(16, 'sdfds', 'sdf', NULL, '1538405426.jpeg', 15, '2018-10-01 11:50:26', '2018-10-01 11:50:26'),
(17, 'sdfs', NULL, NULL, '1538405471.jpeg', 15, '2018-10-01 11:51:11', '2018-10-01 11:51:11'),
(18, 'ret', NULL, NULL, NULL, 3, '2018-10-03 10:46:59', '2018-10-03 10:46:59'),
(19, 'ede', 'dewd', NULL, NULL, 5, '2018-10-03 10:55:28', '2018-10-03 10:55:28');

-- --------------------------------------------------------

--
-- Структура таблицы `links`
--

CREATE TABLE `links` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reciprocal_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `keywords` text COLLATE utf8_unicode_ci,
  `full_description` text COLLATE utf8_unicode_ci NOT NULL,
  `htmlcode_banner` text COLLATE utf8_unicode_ci,
  `catalog_id` int(11) NOT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `check_link` tinyint(1) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `comment` text COLLATE utf8_unicode_ci,
  `time_check` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `number_check` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `links`
--

INSERT INTO `links` (`id`, `name`, `url`, `email`, `reciprocal_link`, `description`, `keywords`, `full_description`, `htmlcode_banner`, `catalog_id`, `status`, `token`, `check_link`, `views`, `comment`, `time_check`, `number_check`, `created_at`, `updated_at`) VALUES
(1, 'Сайт', 'http://site1.ru', 'janickiy@mail.ru', 'http://bnmbnm.ru', 'бла бла бла', 'пвап вавапкавупав вап ва п ва пва', 'выава выавы выа выап вапвапва вап вапвап вап вап ав', NULL, 2, '1', '6115c12f9b0fc89999b8d0756c3a75b2', 0, 0, NULL, '2018-09-20 12:27:44', 0, '2018-10-03 11:32:07', '2018-10-03 12:18:24');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2017_05_30_000000_create_permission_role_table', 1),
(3, '2017_05_30_000000_create_permissions_table', 1),
(4, '2017_05_30_000000_create_role_user_table', 1),
(5, '2017_05_30_000000_create_roles_table', 1),
(6, '2017_05_30_000000_create_users_table', 1),
(7, '2018_09_21_154326_create_catalog_table', 2),
(8, '2018_09_21_154338_create_links_table', 2),
(9, '2018_09_24_132618_create_settings_table', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'manage_user', 'Manage Users', 'Manage Users', NULL, NULL),
(2, 'add_user', 'Add User', 'Add User', NULL, NULL),
(3, 'edit_user', 'Edit User', 'Edit User', NULL, NULL),
(4, 'delete_user', 'Delete User', 'Delete User', NULL, NULL),
(5, 'manage_role', 'Manage Roles', 'Manage Roles', NULL, NULL),
(6, 'add_role', 'Add Role', 'Add Role', NULL, NULL),
(7, 'edit_role', 'Edit Role', 'Edit Role', NULL, NULL),
(8, 'delete_role', 'Delete Role', 'Delete Role', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(1, 2),
(5, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'Admin User', NULL, NULL),
(2, 'manager', 'Manager', 'Manager', NULL, '2018-09-28 11:55:54');

-- --------------------------------------------------------

--
-- Структура таблицы `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(2, 2),
(3, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key_cd` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `key_cd`, `type`, `display_value`, `value`, `created_at`, `updated_at`) VALUES
(3, 'CHECK_INTERVAL', 'TEXT', 'Минимальный интервал между проверками ссылок (дней)', '7', '2018-10-03 12:29:51', '2018-10-03 12:29:51'),
(4, 'NUMBER_CHECK', 'TEXT', 'Количество проверок ответной ссылки, по истечению которых ссылка будет удаленна', '3', '2018-10-03 12:30:58', '2018-10-03 12:30:58'),
(5, 'REQUEST_CAPTCHA', 'TEXT', 'Запрашивать секюрити код (CAPTCHA)', '1', '2018-10-03 12:32:28', '2018-10-03 12:32:28'),
(6, 'ADD_LINKS_WITHOUT_CHECK', 'TEXT', 'Добавлять ссылки в каталог минуя проверку администратора', '1', '2018-10-03 12:33:13', '2018-10-03 12:33:13');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '1',
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'admin',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `role_id`, `type`, `name`, `email`, `password`, `avatar`, `provider`, `provider_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'admin 22', 'janickiy@mail.ru', '$2y$10$IIegzNhjV7lA8JpNn97HEuv84VJzB1Mq14g.MnlkTxaNwZio3V5GO', '1538379371.jpeg', NULL, NULL, 'JVFoV3fjR0drhXGKhQ4i5ApDYVqbKqpwSlTSatxsmX790dgK0tILbnEMbFc8', '2018-09-20 12:27:44', '2018-10-01 04:36:11'),
(2, 2, 'admin', 'ewrewr', 'superuser@corals.io', '$2y$10$UOlc9Ro/iATbLBSq7/S2eeVlejXOoE6DaJlowO4g41QvPfZcSAzBu', NULL, NULL, NULL, NULL, '2018-09-24 13:11:01', '2018-09-24 13:11:01'),
(3, 2, 'admin', 'fsd 22', 'sdfs@qwreqwr.ru', '$2y$10$ekN0KVmnHTPa9n2ECkz2yegCS8X59gszrJ6PdLWWIUJ.AfIUyQo8K', NULL, NULL, NULL, NULL, '2018-09-28 11:57:22', '2018-10-01 03:54:01');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Индексы таблицы `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catalog_id` (`catalog_id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_cd_unique` (`key_cd`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `catalog`
--
ALTER TABLE `catalog`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `links`
--
ALTER TABLE `links`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
