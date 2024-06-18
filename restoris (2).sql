-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 18 2024 г., 10:29
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `restoris`
--

-- --------------------------------------------------------

--
-- Структура таблицы `menu_categories`
--

CREATE TABLE `menu_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `menu_categories`
--

INSERT INTO `menu_categories` (`id`, `name`) VALUES
(1, 'Завтраки'),
(2, 'Обеды'),
(3, 'Ужины'),
(4, 'Напитки'),
(5, 'Десерты');

-- --------------------------------------------------------

--
-- Структура таблицы `menu_dishes`
--

CREATE TABLE `menu_dishes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `menu_dishes`
--

INSERT INTO `menu_dishes` (`id`, `name`, `description`, `price`, `category_id`, `img`) VALUES
(8, 'Стейк из говядины', 'Нежный стейк из отборной говядины, приготовленный на гриле.', 25.99, 1, 'uploads/1menu.jpg'),
(9, 'Салат Цезарь', 'Классический салат с кусочками куриного мяса, сухариками и соусом Цезарь.', 12.50, 2, 'uploads/2menu.jpg'),
(10, 'Паста Болоньезе', 'Итальянские спагетти с мясным соусом Болоньезе.', 15.75, 3, 'uploads/3menu.jpg'),
(11, 'Суп куриный', 'Ароматный куриный суп с овощами.', 8.99, 2, 'uploads/4menu.jpg'),
(12, 'Фруктовый десерт', 'Свежие фрукты, нарезанные кусочками и поданые с ванильным соусом.', 10.25, 5, 'uploads/6menu.jpg'),
(13, 'Кока-кола', 'Классический газированный напиток.', 3.99, 4, 'uploads/1napitki.jpg'),
(14, 'Мохито', 'Освежающий коктейль на основе рома с лаймом и мятой.', 7.50, 4, 'uploads/2napitki.jpg'),
(15, 'Красное вино', 'Отборное красное вино с богатым вкусом и ароматом.', 20.99, 4, 'uploads/3napitki.jpg'),
(16, 'Кофе Латте', 'Ароматный кофе с молоком, украшенный молочной пенкой.', 5.25, 4, 'uploads/4napitki.jpg'),
(17, 'Чай зеленый', 'Натуральный зеленый чай с ароматом и приятным вкусом.', 4.50, 4, 'uploads/5napitki.jpg'),
(18, 'zoxan', 'qwe', 5030.20, 3, 'uploads/4menu.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_table` int(11) NOT NULL,
  `bron_date` datetime NOT NULL,
  `arrival_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `rating` int(1) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `rating`, `message`, `created_at`) VALUES
(1, 'Vova Kornev', 5, '123123123312', '2024-04-08 15:42:55'),
(6, 'йцуйцуйц', 3, 'йцуйцу', '2024-04-09 19:27:41'),
(7, 'йцуйцуцйуйц', 3, 'йцуйцууйцу', '2024-04-09 19:27:45'),
(8, 'Vova12312 Kornev', 3, '123123123', '2024-04-09 19:28:35'),
(9, 'Vova12312 Kornev', 4, '12312312312', '2024-04-09 19:31:19'),
(19, 'zoxan', 5, '12321312', '2024-05-16 20:00:10'),
(20, '123', 1, '12312312', '2024-05-16 20:01:42'),
(21, 'zoxan', 0, '12312', '2024-05-16 20:12:23'),
(22, 'zoxan', 0, '12321', '2024-05-16 20:12:59'),
(23, 'zoxan', 0, '12321', '2024-05-16 20:15:48'),
(24, 'zoxan', 0, '12321', '2024-05-16 20:15:51'),
(25, '123', 0, '21', '2024-05-16 20:16:07'),
(26, '123', 0, '21', '2024-05-16 20:16:40'),
(27, 'zoxan', 2, '12321', '2024-05-16 20:19:14'),
(28, '123', 5, 'ФВЫФ', '2024-05-23 23:49:53');

-- --------------------------------------------------------

--
-- Структура таблицы `tables`
--

CREATE TABLE `tables` (
  `id` int(11) NOT NULL,
  `name_table` text NOT NULL,
  `quantity` text NOT NULL,
  `status` text NOT NULL,
  `img` text NOT NULL,
  `description` text NOT NULL,
  `booking_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `tables`
--

INSERT INTO `tables` (`id`, `name_table`, `quantity`, `status`, `img`, `description`, `booking_time`, `end_time`) VALUES
(45, 'Стол 1', '4', 'забронированный', 'uploads/1stol.jpg', 'Уютный столик для четырех человек.', '2024-06-02 23:25:34', '2024-07-03 12:30:00'),
(46, 'Стол 2', '2', 'забронированный', 'uploads/2stol.jpg', 'Столик для романтического ужина вдвоем.', '2024-06-02 23:28:08', '2024-06-28 14:21:00'),
(47, 'Стол 3', '6', 'забронированный', 'uploads/3stol.jpg', 'Большой стол для компании из шести человек.', '2024-06-02 23:50:12', '2024-06-27 22:50:00'),
(48, 'Стол 4', '3', 'забронированный', 'uploads/4stol.jpg', 'Столик для небольшой компании.', '2024-06-18 10:26:31', '2024-06-19 14:12:00'),
(49, 'Стол 5', '5', 'свободный', 'uploads/5stol.jpg', 'Удобный стол для пятерых гостей.', NULL, NULL),
(50, 'Стол 6', '4', 'свободный', 'uploads/6stol.jpg', 'Еще один уютный столик для четырех человек.', '2024-05-11 21:00:44', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'password');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `menu_categories`
--
ALTER TABLE `menu_categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menu_dishes`
--
ALTER TABLE `menu_dishes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `menu_categories`
--
ALTER TABLE `menu_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `menu_dishes`
--
ALTER TABLE `menu_dishes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `menu_dishes`
--
ALTER TABLE `menu_dishes`
  ADD CONSTRAINT `menu_dishes_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `menu_categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
