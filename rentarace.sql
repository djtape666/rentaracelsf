-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.4
-- Время создания: Май 26 2026 г., 18:13
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

INSERT INTO `application` (`id`, `created_at`, `car_id`, `pay_type_id`, `phone`, `end_date`, `start_date`, `status_id`, `user_id`) VALUES
(3, '2026-05-23 22:11:36', 1, 1, '11', '2026-05-15 00:00:00', '2026-05-01 00:00:00', 3, 3),
(4, '2026-05-25 10:38:45', 11, 1, '+71234567890', '2026-05-28 00:00:00', '2026-05-26 00:00:00', 3, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `car`
--

CREATE TABLE `car` (
  `id` int NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
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

INSERT INTO `car` (`id`, `color`, `price`, `engine_power`, `description`, `model`, `year`, `is_available`) VALUES
(1, 'Синий', 19000, 190, 'Audi A3 — премиальный компактный автомобиль (C-класс), доступный в кузовах седан и 5-дверный хэтчбек (Sportback), известный высоким качеством материалов, комфортом и передовыми технологиями', 'A3', 2018, 1),
(2, 'Гранит', 22000, 485, 'Dodge Challenger R/T Scat Pack Widebody - бескомпромиссный американский маслкар, сочетающий классический дизайн с мощным 6,4-литровым двигателем V8 HEMI. Самый агрессивный и мускулистый представитель семейства Challenger с заводским обвесом Widebody, который превращает мощный маслкар в настоящего трекового монстра, оставаясь при этом комфортным для повседневной езды.', 'Challenger R/T Scat Pack Widebody', NULL, 1),
(3, 'Желтый', 20000, 659, 'Chevrolet Corvette оборудуется одним двигателем, семиступенчатой механической  и исключительно задним приводом. Благодаря такому набору, автомобиль отвечает большинству запросов потенциального покупателя и способен подарить массу удовольствия настоящему фанату вождения.', 'Corvette Z06', 2015, 1),
(4, 'Серый', 30000, 530, 'BMW M850i Cabriolet - один из лучших представителей BMW M-серии. Автомобиль обладает выраженным характером и позволяет прочувствовать всю роскошь класса люкс. Поездка на таком кабриолете может стать идеальным способом удовлетворить собственные амбиции и испытать высший уровень комфорта от управления и премиального салона. ', 'М850i Cabriolet', 2018, 1),
(5, 'Гранит', 230000, 485, 'Dodge Charger Scat Pack Widebody - это бескомпромиссный полноразмерный седан, сочетающий практичность 4-дверного автомобиля и взрывной характер классического американского маслкара. ', 'Charger Scat Pack Widebody', 2021, 1),
(6, 'Синий', 28000, 245, 'Audi A6 Allroad Quattro 45 TDI - это полноприводный премиальный универсал повышенной проходимости. Он оснащается 3,0-литровым дизельным двигателем V6 , 8-ступенчатой АКПП , адаптивной пневмоподвеской и постоянным полным приводом, сочетая динамику спорткара и практичность внедорожника', 'A6 Allroad Quattro 45 TDI', 2021, 1),
(7, 'Металл', 30000, 760, 'Ford Mustang Shelby GT500 - это самый мощный и экстремальный серийный спорткар в истории культового семейства Ford Mustang. Автомобиль сочетает агрессивный дизайн и передовые технологии, разработанные для гоночных треков.', 'Mustang Shelby GT500', 2022, 1),
(8, 'Жёлтый', 17000, 327, 'Chevrolet Camaro 2014 - это стильный и мощный спорткар 5-го поколения, который выделяется агрессивным дизайном, задним приводом и культовым атмосферным рыком.', 'Camaro', 2014, 1),
(11, 'черный', 17000, 190, 'цув', 'М850i Cabriolet', 2018, 1),
(12, 'Жёлтый', 20000, 625, 'McLaren MP4-12C (позже переименованный в McLaren 12C) — это культовый британский суперкар, выпускавшийся с 2011 по 2014 год. Это первая серийная дорожная модель, полностью разработанная подразделением McLaren Automotive. Автомобиль выделяется карбоновым монококом и передовыми технологиями из мира Формулы-1.', 'MP4-12C', 2014, 1),
(15, 'Серый', 25000, 480, 'Ford Mustang GT нового поколения обзавёлся характерным агрессивным обликом, новыми светодиодными фарами и приборной панелью, как у истребителей. Новый скакун предлагает самый мощный стоковый Coyote V8 за всю историю и «тормоза для дрифта».', 'Mustang GT ', 2023, 1),
(16, 'Белый', 17000, 190, 'Toyota Celica ZZT231 F6 (2002) с пробегом \\(194\\,000\\) км — это спортивный хэтчбек седьмого поколения в комплектации SS-II с легендарным высокооборотистым двигателем 2ZZ-GE и 6-ступенчатой механической коробкой передач.', 'CELICA ZZT231', 2002, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `car_characteristic`
--

CREATE TABLE `car_characteristic` (
  `id` int NOT NULL,
  `car_id` int NOT NULL,
  `characteristic_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `car_characteristic`
--

INSERT INTO `car_characteristic` (`id`, `car_id`, `characteristic_id`) VALUES
(33, 2, 1),
(34, 2, 2),
(35, 2, 3),
(36, 2, 5),
(37, 3, 8),
(38, 3, 2),
(39, 3, 3),
(40, 3, 5),
(41, 4, 7),
(42, 4, 2),
(43, 4, 11),
(44, 4, 10),
(65, 5, 1),
(66, 5, 2),
(67, 5, 11),
(68, 5, 5),
(81, 6, 6),
(82, 6, 12),
(83, 6, 11),
(84, 6, 10),
(93, 15, 14),
(94, 15, 2),
(95, 15, 11),
(96, 15, 5),
(103, 7, 14),
(104, 7, 2),
(105, 7, 11),
(106, 7, 5),
(119, 8, 8),
(120, 8, 2),
(121, 8, 11),
(122, 8, 5),
(131, 16, 15),
(132, 16, 2),
(133, 16, 3),
(134, 16, 4),
(147, 1, 6),
(148, 1, 2),
(149, 1, 3),
(150, 1, 4),
(160, 12, 16),
(161, 12, 2),
(162, 12, 11),
(163, 12, 5);

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
(2, 2, '/images/car2.jpg'),
(6, 3, '/images/69f91220bf2b8.jpg'),
(7, 3, '/images/69f91235e8c37.jpg'),
(8, 3, '/images/69f91247caec8.jpg'),
(9, 4, '/images/69f9fc4aad6fa.jpg'),
(10, 4, '/images/69f9fc661a055.jpg'),
(11, 4, '/images/69f9fc767a0ba.jpg'),
(14, 2, '/images/6a14947dcb23f.jpg'),
(15, 2, '/images/6a1495cd861e0.jpg'),
(20, 5, '/images/6a14a0bf50be2.jpg'),
(21, 5, '/images/6a14a0cb7beaa.jpg'),
(22, 5, '/images/6a14a0d5bbae8.jpg'),
(23, 6, '/images/6a14a3f45376a.jpg'),
(24, 6, '/images/6a14a4058c1fb.jpg'),
(25, 6, '/images/6a14a416570ad.jpg'),
(26, 15, '/images/6a14c884b8c29.jpg'),
(27, 15, '/images/6a14c8a0cd487.jpg'),
(28, 15, '/images/6a14c8b0676a1.jpg'),
(29, 7, '/images/6a14c9b8a476d.jpg'),
(30, 7, '/images/6a14c9c75c811.jpg'),
(31, 7, '/images/6a14c9da31cb3.jpg'),
(32, 8, '/images/6a14cc57e6367.jpg'),
(33, 8, '/images/6a14cc6b7420b.jpg'),
(35, 8, '/images/6a14ccd0bafd6.jpg'),
(36, 16, '/images/6a1570fea1f45.jfif'),
(37, 16, '/images/6a15715ecb2ea.jfif'),
(38, 16, '/images/6a1571cc7e92e.jpg'),
(45, 1, '/images/6a157c00b9045.jpg'),
(46, 1, '/images/6a157c0bd941c.jpg'),
(47, 1, '/images/6a157c0be0a01.jpg'),
(49, 12, '/images/6a158a2d7b551.jpg'),
(50, 12, '/images/6a158a4494215.jpg'),
(51, 12, '/images/6a158a44a4023.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(256) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Марка'),
(2, 'Топливо'),
(3, 'Коробка передач'),
(4, 'Привод');

-- --------------------------------------------------------

--
-- Структура таблицы `characteristic`
--

CREATE TABLE `characteristic` (
  `id` int NOT NULL,
  `category_id` int NOT NULL,
  `value` varchar(256) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `characteristic`
--

INSERT INTO `characteristic` (`id`, `category_id`, `value`) VALUES
(1, 1, 'Dodge'),
(2, 2, 'Бензин'),
(3, 3, 'МКПП'),
(4, 4, 'Передний'),
(5, 4, 'Задний'),
(6, 1, 'Audi'),
(7, 1, 'BMW'),
(8, 1, 'Chevrolet'),
(9, 1, 'Porcshe'),
(10, 4, 'Полный'),
(11, 3, 'АКПП'),
(12, 2, 'Дизель'),
(13, 2, 'Электро'),
(14, 1, 'Ford'),
(15, 1, 'Toyota'),
(16, 1, 'McLaren');

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
(3, NULL, 1);

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
(2, 'Активная', 'active'),
(3, 'Закрыта', 'closed');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `fullname` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
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

INSERT INTO `user` (`id`, `login`, `fullname`, `password`, `phone`, `age`, `email`, `role`, `auth_key`) VALUES
(1, 'mamalama', '', '$2y$13$WUoSBhdtQixZF6qh51FFTO/xNMyZuDwQx6DWx9oxccDVkOT3U2gnq', '8(996)945-04-16', 23, 'hotbeeeer@gmail.com', 0, '8ekKDZn3J1KLb-freJhD9zOowD51XAaP'),
(2, 'admin', '', '$2y$13$Cp0dr4mKrPwz2mXjI0CAtuFKQKDJCFEvtDKI1Btxb21ypsvZYyp6y', '+7(123)456-78-90', 23, 'hotbeeeer@gmail.com', 1, 'JL36oNNBOesQW7mEZ8RJ5JtLuwXnRbmK'),
(3, 'kokoko', '', '$2y$13$jLNo7gK1A44VwYD9YrfeV.T0uzoAzsStvVPAkxNRMHghqOJhULtNW', '+7(899)694-50-4', 23, 'hotbeeeer@gmail.com', 0, 'S_3FR6mcDYPmUXO7Z_4RvkAGWfC4sHiG'),
(4, 'user', 'Максов Макс', '$2y$13$2xf6NkX6cvCW2MrQJdEbneYuY5Mh21xbrJFwkYhMwxTNQiWYDzwMW', '+7(123)456-78-90', 26, 'gudini@mail.com', 0, 'nVbLY4qp4U1F_9kJKzRLH7kG1yuYzE5R');

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
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `car_characteristic`
--
ALTER TABLE `car_characteristic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`),
  ADD KEY `characteristic_id` (`characteristic_id`);

--
-- Индексы таблицы `car_image`
--
ALTER TABLE `car_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `characteristic`
--
ALTER TABLE `characteristic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`application_id`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `car`
--
ALTER TABLE `car`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `car_characteristic`
--
ALTER TABLE `car_characteristic`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT для таблицы `car_image`
--
ALTER TABLE `car_image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `characteristic`
--
ALTER TABLE `characteristic`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `application_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- Ограничения внешнего ключа таблицы `car_characteristic`
--
ALTER TABLE `car_characteristic`
  ADD CONSTRAINT `car_characteristic_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `car_characteristic_ibfk_2` FOREIGN KEY (`characteristic_id`) REFERENCES `characteristic` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `car_image`
--
ALTER TABLE `car_image`
  ADD CONSTRAINT `car_image_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `characteristic`
--
ALTER TABLE `characteristic`
  ADD CONSTRAINT `characteristic_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `application` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
