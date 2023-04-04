-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Апр 04 2023 г., 21:15
-- Версия сервера: 5.7.21-20-beget-5.7.21-20-1-log
-- Версия PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bolsun95_main`
--

-- --------------------------------------------------------

--
-- Структура таблицы `company`
--
-- Создание: Мар 12 2023 г., 23:19
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inn` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `director` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `company`
--

INSERT INTO `company` (`id`, `name`, `inn`, `content`, `director`, `address`, `phone`) VALUES
(1, 'Сбербанк', '7707083893', 'Информация о компании Сбербанк', 'Греф Герман Оскарович', '117312, г. Москва, ул. Вавилова, д.19', '79990001122'),
(2, 'ООО Яндекс', '7736207543', 'Информация о компании Яндекс', 'Елена Бунина', 'Моска, улица Льва Толстого, дом 16.', '8 (800) 250-96-39'),
(3, 'ГК Сегежа', '7703803710', 'Информация о компании Сегежа', 'Валихова Нелли Маратовна', '123112, Россия, г. Москва, Пресненская набережная, д. 10, блок С. ', '+7 (499) 962 82 00'),
(6, 'АО ТИНЬКОФФ', '7710140679', 'Информация о компании Тинькофф', 'Олег Юрьевич Тиньков', '127287, г. Москва, ул. 2-я Хуторская, д. 38А, стр. 26', '8 800 555-777-8'),
(8, 'РЖД', '7708503727', 'Информация о компании РЖД', 'Олег Валентинович Белозёров', '107174, г. Москва, ул. Новая Басманная, д. 2/1, стр. 1', '8 (499) 605-20-00'),
(9, 'Аэрофлот', '7712040126', 'Информация о компании Аэрофлот', 'Сергей Владимирович Александровский', 'г. Москва, ул. Арбат, д. 1. ', '8-800-444-55-55'),
(10, 'Агроторг', '7825706086', 'Информация о компании Агроторг', 'Михаил Фридман', ' г. Санкт-Петербург, проспект Невский, д. 90/92 ', '7(800) 5555505'),
(13, 'test company', '123456', 'test content', 'test person', 'st 33', '12334444');

-- --------------------------------------------------------

--
-- Структура таблицы `notes`
--
-- Создание: Апр 04 2023 г., 18:10
-- Последнее обновление: Апр 04 2023 г., 18:12
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE `notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'main',
  `company_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `notes`
--

INSERT INTO `notes` (`id`, `user_id`, `user_name`, `text`, `date`, `field`, `company_id`) VALUES
(468, 1, 'Болсуновский Егор Андреевич', 'rewrwe', '2023-04-04 18:12:16', 'address', 13);

-- --------------------------------------------------------

--
-- Структура таблицы `password_reset`
--
-- Создание: Мар 12 2023 г., 23:19
-- Последнее обновление: Апр 04 2023 г., 18:15
--

DROP TABLE IF EXISTS `password_reset`;
CREATE TABLE `password_reset` (
  `id` int(10) UNSIGNED NOT NULL,
  `timestamp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--
-- Создание: Мар 12 2023 г., 23:19
-- Последнее обновление: Апр 04 2023 г., 18:04
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signup_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `fullname`, `login`, `email`, `password`, `age`, `position`, `signup_date`) VALUES
(1, 'Болсуновский Егор Андреевич', 'egor', 'bolsunovski.e@gmail.com', '$2y$10$UV3gFVjvke.Ab3mcx1ylDOjqGDCjN6QJn9gr3fFcezPx.ohEg5tIC', 21, 'Разработчик', '2023-03-09 11:10:16'),
(2, 'Петров Иван', 'petr', 'petr@mail.ru', '$2y$10$EL7Vchsjs1yaoJPINm7XHOaImmrFr3VRZIUZT/tiwDoO4iZTsaXOW', 23, 'Разработчик', '2023-03-09 11:27:18'),
(3, 'ewrwrwer', 'egor2', 'ere@mail.ru', '$2y$10$n0N1mfGGnvkgk7Bn6J9P4eUI4VoyE5./iMckxYL16/ww3vT6oPDTy', 18, 'Разработчик', '2023-03-09 11:57:51'),
(4, 'Попов Илья', 'ilya', 'ilya@mail.ru', '$2y$10$YWwNz0dn01CELX4VykFoJOw5Lo1GyOUrTtgFNPLxaA04xRq73tZ.2', 54, 'Бухгалтер', '2023-03-09 19:10:12'),
(5, 'Костеров Илья', 'kost', 'illy.a@mail.ru', '$2y$10$VPRH8lut0zXpRdrrJMDeu.4HDuFe2snoFH3jKHfrplWtCZ1rwUDc2', 20, 'Редактор', '2023-03-10 00:51:18'),
(6, 'eeeeeeeeee', 'test1', 'test1@mail.ru', '$2y$10$omzqEpt3n8vpLOqnTP6NK.fk.HGn8MUmBx5XDPRL1xIlhPxlmNzFW', 18, 'Разработчик', '2023-03-11 21:20:13'),
(7, 'erwerwe', 'rwerwerwe', 'rwerwerwe@mail.ry', '$2y$10$tTnQzYrjZI.ZsEPkJo5GTeBIwLe2zEbLfhg7SQ3SXUQrju/KNdmjC', 18, 'Разработчик', '2023-03-13 00:25:15'),
(8, 'Егор Бол.', 'egor33', 'faceithebas@gmail.com', '$2y$10$l.o/FpOgyzHeOVC5deOEPeFbj7op.LhSrXv3CyICw2rktpFHSkL3S', 18, 'Разработчик', '2023-03-13 00:39:35'),
(9, 'ешекшеукзщ', 'opriwpore', 'bbb@mail.ru', '$2y$10$jPRFKf38tBAr9OB8k50wne5SlVz0lK5RKtplRGTnRQ/h7DEHXd33q', 18, 'Разработчик', '2023-04-04 18:04:19');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Индексы таблицы `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `company`
--
ALTER TABLE `company`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=469;

--
-- AUTO_INCREMENT для таблицы `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
