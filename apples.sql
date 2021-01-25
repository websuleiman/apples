-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Янв 25 2021 г., 19:40
-- Версия сервера: 10.4.13-MariaDB
-- Версия PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `apples`
--

-- --------------------------------------------------------

--
-- Структура таблицы `apple`
--

CREATE TABLE `apple` (
  `id` int(11) NOT NULL,
  `color` varchar(50) NOT NULL,
  `status` tinyint(4) DEFAULT 0,
  `size` tinyint(4) DEFAULT 100,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `drop_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `apple`
--

INSERT INTO `apple` (`id`, `color`, `status`, `size`, `create_time`, `drop_time`) VALUES
(77, 'Orange', 1, 50, '2021-01-25 15:24:00', '2021-01-24 11:22:52'),
(91, 'Yellow', 0, 100, '2021-01-25 15:29:01', '0000-00-00 00:00:00'),
(94, 'Green', 0, 100, '2021-01-25 17:37:52', '0000-00-00 00:00:00'),
(97, 'Yellow', 1, 94, '2021-01-25 18:38:44', '2021-01-25 14:38:10'),
(98, 'Green', 0, 100, '2021-01-25 18:36:33', '0000-00-00 00:00:00'),
(99, 'Orange', 0, 100, '2021-01-25 18:36:33', '0000-00-00 00:00:00'),
(100, 'Orange', 0, 100, '2021-01-25 18:36:33', '0000-00-00 00:00:00'),
(101, 'Red', 0, 100, '2021-01-25 18:36:33', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1611549974),
('m130524_201442_init', 1611549979),
('m190124_110200_add_verification_token_column_to_user_table', 1611549979),
('m210125_070327_apple', 1611559301);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(3, 'dyatel', 'Sp9N5_n36QTqM_8iJOmTPywkFOjzGEEz', '$2y$13$DVheh4VCFAP6968JG9.mNe0wUm0P84l0Bv4.TpKQqJM8zO2s98Qdy', NULL, 'dyatel@yandex.info', 10, 1611551909, 1611552196, 'tBN5cZw15hzWZQobGUzxk6erpjC6K7x4_1611551909');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `apple`
--
ALTER TABLE `apple`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `apple`
--
ALTER TABLE `apple`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
