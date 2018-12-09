-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 09 2018 г., 17:53
-- Версия сервера: 5.6.41
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `burger`
--

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `callback` text NOT NULL,
  `payment` text NOT NULL,
  `comment` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `address`, `callback`, `payment`, `comment`, `date`) VALUES
(36, 23, 'sdfdsf 23 Корпус: 324 Квартира: 123 Этаж: 123', 'Перезвонить', 'Потребуется сдача', 'kdsfjslkdfsdfsd fsdf sdf ', '2018-09-03'),
(37, 23, 'sdfdsf 23 Корпус: 324 Квартира: 123 Этаж: 123', 'Перезвонить', 'Потребуется сдача', 'kdsfjslkdfsdfsd fsdf sdf ', '2018-12-06'),
(38, 24, 'sdfdsf 23 Корпус: 324 Квартира: 123 Этаж: 123', 'Перезвонить', 'Потребуется сдача', 'kdsfjslkdfsdfsd fsdf sdf ', '2018-12-06'),
(39, 28, 'Ленина 4 Корпус: 4 Квартира: 1 Этаж: 5', 'Перезвонить', 'Потребуется сдача', 'Обязательно хорошей прожарки. Доставка от 18 до 19', '2018-12-09'),
(40, 28, 'Ленина 4 Корпус: 4 Квартира: 1 Этаж: 5', 'Перезвонить', 'Потребуется сдача', 'Обязательно хорошей прожарки. Доставка от 18 до 19', '2018-12-09');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `orders` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `phone`, `orders`) VALUES
(23, 'Юрий', 'georgf88@ukr.net', '+7 (555) 555 55 5_', 4),
(24, 'Иван', 'ge7gf88@ukr.net', '+7 (555) 555 55 5_', 7),
(25, 'Никита', 'gegf88@ukr.net', '+7 (555) 555 55 5_', 11),
(26, 'Федор', 'deltapilot88@gmail.com', '+7 (636) 352 30 9_', 6),
(27, 'Андрей', 's88inua@gmail.com', '+7 (555) 555 55 55', 2),
(28, 'Юрий', 'georg88@ukr.net', '+7 (063) 635 23 11', 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
