-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.4
-- Время создания: Май 22 2026 г., 12:30
-- Версия сервера: 8.4.4
-- Версия PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `rentarace`
--

-- --------------------------------------------------------

--
-- Структура таблицы `application`
--

CREATE TABLE `application` (
  `id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `car_id` int NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pay_type_id` int NOT NULL,
  `phone` varchar(16) COLLATE utf8mb4_general_ci NOT NULL,
  `end_date` datetime NOT NULL,
  `start_date` datetime NOT NULL,
  `status_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `application`
--

INSERT INTO `application` (`id`, `created_at`, `car_id`, `fullname`, `pay_type_id`, `phone`, `end_date`, `start_date`, `status_id`, `user_id`) VALUES
(1, '2026-04-25 11:55:37', 1, 'М М М', 1, '11111', '2026-04-30 00:00:00', '2026-04-26 00:00:00', 3, 1),
(2, '2026-05-05 17:25:25', 2, 'Мишак', 2, '11', '2026-05-14 00:00:00', '2026-05-05 00:00:00', 3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `car`
--

CREATE TABLE `car` (
  `id` int NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `transmission_type_id` int NOT NULL,
  `fuel_type_id` int NOT NULL,
  `marka_id` int NOT NULL,
  `price` int NOT NULL,
  `engine_power` int NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `year` int DEFAULT NULL,
  `is_available` tinyint DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `car`
--

INSERT INTO `car` (`id`, `color`, `transmission_type_id`, `fuel_type_id`, `marka_id`, `price`, `engine_power`, `description`, `model`, `year`, `is_available`) VALUES
(1, 'Синий', 1, 1, 1, 19000, 190, 'Audi A3 — премиальный компактный автомобиль (C-класс), доступный в кузовах седан и 5-дверный хэтчбек (Sportback), известный высоким качеством материалов, комфортом и передовыми технологиями', 'A3', 2018, 1),
(2, 'Гранит', 2, 1, 4, 17000, 125, 'топ', 'Challenger R/T Scat Pack Widebody', NULL, 1),
(3, 'Желтый', 1, 1, 1, 20000, 659, 'Chevrolet Corvette оборудуется одним двигателем, семиступенчатой механической или восьмиступенчатой автоматической коробками передач и исключительно задним приводом. Благодаря такому набору, автомобиль отвечает большинству запросов потенциального покупателя и способен подарить массу удовольствия настоящему фанату вождения.', 'Corvette Z06', 2015, 1),
(4, 'Серый', 2, 1, 2, 30000, 530, 'BMW M850i Cabriolet – один из лучших представителей BMW M-серии. Автомобиль обладает выраженным характером и позволяет прочувствовать всю роскошь класса люкс. Поездка на таком кабриолете может стать идеальным способом удовлетворить собственные амбиции и испытать высший уровень комфорта от управления и премиального салона. ', 'М850i Cabriolet', 2018, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `car_image`
--

CREATE TABLE `car_image` (
  `id` int NOT NULL,
  `car_id` int NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `car_image`
--

INSERT INTO `car_image` (`id`, `car_id`, `image_path`) VALUES
(1, 1, '/images/car1.jpg'),
(2, 2, '/images/car2.jpg'),
(3, 2, '/images/69f08003c4a56.jpg'),
(4, 1, '/images/69f392a151365.jpg'),
(5, 1, '/images/69f3931ab8ae7.jpg'),
(6, 3, '/images/69f91220bf2b8.jpg'),
(7, 3, '/images/69f91235e8c37.jpg'),
(8, 3, '/images/69f91247caec8.jpg'),
(9, 4, '/images/69f9fc4aad6fa.jpg'),
(10, 4, '/images/69f9fc661a055.jpg'),
(11, 4, '/images/69f9fc767a0ba.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `application_id` int NOT NULL,
  `comment` text COLLATE utf8mb4_general_ci,
  `rating` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`application_id`, `comment`, `rating`) VALUES
(1, NULL, 5),
(2, NULL, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `fuel_type`
--

CREATE TABLE `fuel_type` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `fuel_type`
--

INSERT INTO `fuel_type` (`id`, `title`) VALUES
(1, 'Бензин'),
(2, 'Дизель'),
(3, 'Электро'),
(4, 'Гибрид');

-- --------------------------------------------------------

--
-- Структура таблицы `marka`
--

CREATE TABLE `marka` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `marka`
--

INSERT INTO `marka` (`id`, `title`) VALUES
(1, 'Audi'),
(2, 'BMW'),
(3, 'Mersedes'),
(4, 'Dodge');

-- --------------------------------------------------------

--
-- Структура таблицы `pay_type`
--

CREATE TABLE `pay_type` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `pay_type`
--

INSERT INTO `pay_type` (`id`, `title`) VALUES
(1, 'Наличными'),
(2, 'Картой');

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id`, `title`, `alias`) VALUES
(1, 'Новая', 'new'),
(2, 'Действующая', 'active'),
(3, 'Закрыта', 'closed');

-- --------------------------------------------------------

--
-- Структура таблицы `transmission_type`
--

CREATE TABLE `transmission_type` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `transmission_type`
--

INSERT INTO `transmission_type` (`id`, `title`) VALUES
(1, 'МКПП'),
(2, 'АКПП');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(16) COLLATE utf8mb4_general_ci NOT NULL,
  `age` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` tinyint NOT NULL DEFAULT '0',
  `auth_key` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `phone`, `age`, `email`, `role`, `auth_key`) VALUES
(1, 'mamalama', '$2y$13$WUoSBhdtQixZF6qh51FFTO/xNMyZuDwQx6DWx9oxccDVkOT3U2gnq', '8(996)945-04-16', 23, 'hotbeeeer@gmail.com', 0, '8ekKDZn3J1KLb-freJhD9zOowD51XAaP'),
(2, 'admin', '$2y$13$Cp0dr4mKrPwz2mXjI0CAtuFKQKDJCFEvtDKI1Btxb21ypsvZYyp6y', '+7(123)456-78-90', 23, 'hotbeeeer@gmail.com', 1, 'JL36oNNBOesQW7mEZ8RJ5JtLuwXnRbmK'),
(3, 'kokoko', '$2y$13$jLNo7gK1A44VwYD9YrfeV.T0uzoAzsStvVPAkxNRMHghqOJhULtNW', '+7(899)694-50-4', 23, 'hotbeeeer@gmail.com', 0, 'S_3FR6mcDYPmUXO7Z_4RvkAGWfC4sHiG');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`),
  ADD KEY `pay_type_id` (`pay_type_id`),
  ADD KEY `application_ibfk_3` (`status_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fuel_type_id` (`fuel_type_id`),
  ADD KEY `marka_id` (`marka_id`),
  ADD KEY `transmission_type_id` (`transmission_type_id`);

--
-- Индексы таблицы `car_image`
--
ALTER TABLE `car_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`);

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`application_id`);

--
-- Индексы таблицы `fuel_type`
--
ALTER TABLE `fuel_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `marka`
--
ALTER TABLE `marka`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pay_type`
--
ALTER TABLE `pay_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `transmission_type`
--
ALTER TABLE `transmission_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `application`
--
ALTER TABLE `application`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `car`
--
ALTER TABLE `car`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `car_image`
--
ALTER TABLE `car_image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `application_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `fuel_type`
--
ALTER TABLE `fuel_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `marka`
--
ALTER TABLE `marka`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `pay_type`
--
ALTER TABLE `pay_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `transmission_type`
--
ALTER TABLE `transmission_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `application_ibfk_2` FOREIGN KEY (`pay_type_id`) REFERENCES `pay_type` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `application_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `application_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_ibfk_1` FOREIGN KEY (`fuel_type_id`) REFERENCES `fuel_type` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `car_ibfk_2` FOREIGN KEY (`marka_id`) REFERENCES `marka` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `car_ibfk_3` FOREIGN KEY (`transmission_type_id`) REFERENCES `transmission_type` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `car_image`
--
ALTER TABLE `car_image`
  ADD CONSTRAINT `car_image_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `application` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
