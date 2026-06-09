-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.4
-- Время создания: Июн 08 2026 г., 23:12
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
(4, '2026-05-25 10:38:45', 11, 1, '+71234567890', '2026-05-28 00:00:00', '2026-05-26 00:00:00', 3, 4),
(5, '2026-05-26 23:49:00', 5, 2, '+71234567890', '2026-05-31 00:00:00', '2026-05-30 00:00:00', 3, 4),
(6, '2026-05-26 23:51:37', 6, 2, '+79211568360', '2026-05-31 00:00:00', '2026-05-30 00:00:00', 3, 5),
(7, '2026-05-27 01:05:49', 1, 2, '+71234567890', '2026-05-31 00:00:00', '2026-05-30 00:00:00', 3, 5),
(8, '2026-05-27 01:07:28', 2, 1, '+71234567890', '2026-05-31 00:00:00', '2026-05-30 00:00:00', 3, 5),
(9, '2026-06-03 16:29:40', 7, 2, '+71234567890', '2026-06-30 16:29:00', '2026-06-26 16:29:00', 3, 5),
(10, '2026-06-03 20:31:06', 15, 2, '+79211568360', '2026-06-28 20:31:00', '2026-06-27 20:31:00', 2, 4),
(11, '2026-06-03 20:31:32', 15, 1, '+71234567890', '2026-06-30 20:31:00', '2026-06-29 20:31:00', 2, 4),
(12, '2026-06-03 22:34:55', 12, 2, '+71234567890', '2026-06-06 22:34:00', '2026-06-04 22:34:00', 5, 5),
(13, '2026-06-08 20:59:46', 7, 1, '+79211568360', '2026-06-19 20:59:00', '2026-06-10 20:59:00', 5, 5),
(14, '2026-06-08 21:17:47', 7, 1, '+71234567890', '2026-06-18 21:17:00', '2026-06-10 21:17:00', 5, 5),
(15, '2026-06-08 22:31:24', 3, 1, '+79211568360', '2026-06-27 22:31:00', '2026-06-10 22:31:00', 1, 4);

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
(11, 'Красный', 17000, 160, 'Mazda MX-5 Miata (также известная как Mazda Roadster в Японии) — это легендарный легкий заднеприводный родстер, дебютировавший в 1989 году. Автомобиль прославился идеальной развесовкой, превосходной управляемостью, атмосферными моторами и внесен в Книгу рекордов Гиннесса как самый продаваемый спортивный кабриолет в мире', ' MX-5 Miata', 2015, 1),
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
(163, 12, 5),
(176, 11, 17),
(177, 11, 2),
(178, 11, 3),
(179, 11, 5);

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
(51, 12, '/images/6a158a44a4023.jpg'),
(53, 11, '/images/6a15da8200bbd.jpg'),
(54, 11, '/images/6a15da90e0260.jpg'),
(55, 11, '/images/6a15da910da79.jpg');

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
(16, 1, 'McLaren'),
(17, 1, 'Mazda');

-- --------------------------------------------------------

--
-- Структура таблицы `chat_message`
--

CREATE TABLE `chat_message` (
  `id` int NOT NULL,
  `application_id` int NOT NULL,
  `user_id` int NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `chat_message`
--

INSERT INTO `chat_message` (`id`, `application_id`, `user_id`, `message`, `created_at`, `is_read`) VALUES
(1, 10, 4, 'lf ', '2026-06-03 20:38:55', 1),
(2, 10, 4, 'ьььь', '2026-06-03 20:40:05', 1),
(3, 10, 2, 'пппп', '2026-06-03 21:00:08', 1),
(4, 10, 4, 'здравствуйте', '2026-06-03 21:02:54', 1),
(5, 10, 4, 'помогите пожалуйста я врезался', '2026-06-03 21:08:57', 1),
(6, 10, 4, 'почему вы не отвечаете', '2026-06-03 21:15:11', 1),
(7, 10, 4, 'у меня спустило колесо', '2026-06-03 23:10:55', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `application_id` int NOT NULL,
  `comment` text COLLATE utf8mb4_general_ci,
  `car_rating` int NOT NULL,
  `booking_rating` int NOT NULL,
  `service_rating` int NOT NULL,
  `expectation_rating` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`application_id`, `comment`, `car_rating`, `booking_rating`, `service_rating`, `expectation_rating`) VALUES
(4, 'ttyt', 2, 3, 3, 3),
(5, 'спасибо', 3, 3, 5, 5),
(6, 'yyyy', 5, 5, 5, 5),
(7, '4к', 5, 5, 5, 5),
(8, '11111', 4, 5, 5, 3);

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
(1, 'В обработке', 'new'),
(2, 'Активная', 'active'),
(3, 'Закрыта', 'closed'),
(5, 'Отменена', 'cancelled');

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
(4, 'user', 'Максов Макс', '$2y$13$2xf6NkX6cvCW2MrQJdEbneYuY5Mh21xbrJFwkYhMwxTNQiWYDzwMW', '+7(123)456-78-90', 26, 'gudini@mail.com', 0, 'nVbLY4qp4U1F_9kJKzRLH7kG1yuYzE5R'),
(5, 'user2', 'Баранов Кирилл', '$2y$13$cZv5Aece1ju//E0bZTC/2OF.k7zYFs9yEUBbtd30DrcLDy473MGiC', '8(996)945-04-16', 26, 'sorokdva@mail.com', 0, 'qGZOBN1QW8T0PxWBHptgqHFYKrp4PtB-'),
(6, 'user3', 'Аrina Mishak', '$2y$13$fFy3dB9MLl0/VrudQ0fbb.dv/Uz38pDrYKd7zJshdfAXYJPYcXRVC', '8(996)945-04-16', 23, 'hotbeeeer@gmail.com', 0, 'sp5Rulm5fuqeCI-bzOwoqEsrZZ6bs4Rc');

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
-- Индексы таблицы `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `application_id` (`application_id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `car`
--
ALTER TABLE `car`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `car_characteristic`
--
ALTER TABLE `car_characteristic`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT для таблицы `car_image`
--
ALTER TABLE `car_image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `characteristic`
--
ALTER TABLE `characteristic`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `application_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `pay_type`
--
ALTER TABLE `pay_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- Ограничения внешнего ключа таблицы `chat_message`
--
ALTER TABLE `chat_message`
  ADD CONSTRAINT `chat_message_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `application` (`id`),
  ADD CONSTRAINT `chat_message_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `application` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
