-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 29 2022 г., 08:27
-- Версия сервера: 10.4.22-MariaDB
-- Версия PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `users`
--

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE `sessions` (
  `email` varchar(255) NOT NULL,
  `user_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`email`, `user_key`) VALUES
('test@mail.ru', '0a364656305543148ec65304d3a10253a7fed0ec857d5cb9a12022-04-29 08:26:41');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `hash`, `salt`) VALUES
(1, 'test@mail.ru', '$2y$10$VOPdodMf3eqhZDppV9plqeFikchSB/I4SszCF/YdFBMK3OA4cUPKm', '123'),
(12, 'test5@mail.ru', '$2y$10$Pfd3VTyTa5sExOpeysendOwXusQvTsUY6DANjJy3Og1bXRYnkv3Sa', '078efc091d322c78'),
(13, 'test3@mail.ru', '$2y$10$HhFfq4O0MWzA.QES2VKhXuP.ws0RBJvCCwOwIT9J41Lc9rsaQNmry', 'c195cd4a8936ee3b'),
(14, 'test6@mail.ru', '$2y$10$bqdVb.eKFLQJM9JfqcOp9eD7rkZAQhtqRQrc6D3muGVV3XyK./372', '33d2f919cfbd9b66');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
