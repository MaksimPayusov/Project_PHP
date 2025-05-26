-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 03 2025 г., 20:34
-- Версия сервера: 5.6.51
-- Версия PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tasks`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `creationDate`, `updationDate`) VALUES
(1, 'admin', 'fcea920f7412b5da7be0cf42b8c93759', '2022-01-31 16:21:18', '2022-05-05 14:16:54');

-- --------------------------------------------------------

--
-- Структура таблицы `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `descruption` varchar(500) DEFAULT NULL,
  `clients` varchar(255) DEFAULT NULL,
  `id_technic` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Назначена',
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `startDate` timestamp NULL DEFAULT NULL,
  `endDate` timestamp NULL DEFAULT NULL,
  `times` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `requests`
--

INSERT INTO `requests` (`id`, `name`, `descruption`, `clients`, `id_technic`, `status`, `creationDate`, `updationDate`, `startDate`, `endDate`, `times`) VALUES
(1, 'Ремонт телефона', 'Был в воде, после включения погас, аккумулятор вытащил. Модель Lenovovo K10a40', 'Петров Иван Васильевич', 1, 'Завершена', '2025-04-15 14:38:43', '2025-05-03 17:10:08', '2025-04-16 14:38:43', '2025-05-03 17:10:08', '410'),
(2, 'Ремонт холодильника', 'Замена компрессора.', 'ООО \"Фирма-холод\"', 2, 'Назначена', '2025-05-03 14:31:28', '2025-05-03 17:08:22', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `technic`
--

CREATE TABLE `technic` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `fio` varchar(255) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `technic`
--

INSERT INTO `technic` (`id`, `username`, `fio`, `email`, `password`, `creationDate`, `updationDate`) VALUES
(1, 'technic', 'Федор Петрович Раскольников1', 'tc@mail.ru', 'fcea920f7412b5da7be0cf42b8c93759', '2022-01-31 16:21:18', '2025-05-03 17:08:57'),
(2, 'usermaster', 'Качков Иван Николаевич', 'user@bk.ru', 'fcea920f7412b5da7be0cf42b8c93759', '2025-05-03 14:27:06', NULL),
(3, 'harry', 'Смирнов Иван Николаевич', 'harryden@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', '2025-05-03 17:00:02', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_technic` (`id_technic`);

--
-- Индексы таблицы `technic`
--
ALTER TABLE `technic`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `technic`
--
ALTER TABLE `technic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `fk_id_technic` FOREIGN KEY (`id_technic`) REFERENCES `technic` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
