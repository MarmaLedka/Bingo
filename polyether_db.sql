-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 17 2024 г., 19:46
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `polyether_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `pid` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int NOT NULL,
  `quantity` int NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE `message` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(13, 14, 'shaikh anas', 'shaikh@gmail.com', '0987654321', 'hi, how are you?'),
(14, 16, 'dasdas', 'asdasd@gabs', '231213', 'awddqdq');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Ожидает оплаты',
  `deliver_status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Оформлен'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`, `deliver_status`) VALUES
(26, 22, 'Иван Жаворонков', '89675324233', 'vanek@gmail.com', 'наличными при получении', 'кв. 53, Молодёжная, Сыктывкар, Сыктывкарская, Россия - 64', ', Готовое связующее ГС-20И(200кг) (1) , Смолы (1) ', 87000, '17-Dec-2024', 'Оплачен', 'Доставлен');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `image`) VALUES
(13, 'Связующие Этилсикат-40(10кг)', 'Связующее Этилсиликат-40\r\n\r\nГОСТ 26371-84; СТО 12455361-45-2024\r\nСинонимы: ЭТС-40, Тетраэтил Ортосиликат, тетраэтоксисилан, ТЭОС-40.\r\nМеждународное название: Ethyl Silicate-40\r\nСинонимы: Ethyl Polysilcate, Tetraethyl-orto-Silicate, Silicic Acid Tetraethyl ester, Tetraethoxysilane, Silane Coupling Agent, ETHYL SILICATE POLYMER', 10000, 'etil.jpg'),
(15, 'Готовое связующее ГС-20И(200кг)', 'Готовое связующее ГС-20 представляет собой продукт частичного гидролиза и конденсации этилсиликата с целевыми добавками в органическом растворителе.\r\n\r\nПродукт предназначен для изготовления керамических оболочковых форм для точного литья по выплавляемым моделям.', 75000, 'gs-20.jpg'),
(16, 'Полиэфиры', 'Свойства олигоэфиракрилатов делают возможным их применение в производстве  лаков и эмалей для металла и дерева, клея и герметика, связующих для композиционных материалов, электроизоляционных компаундов, контактных линз, оптических деталей, типографических печатных форм и используют для модификации высокомолекулярных соединений, резин и пластизолей.', 15000, 'polyephir.jpg'),
(17, 'Электроизоляционные компаунды(5кг)', 'Компаунд электроизоляционный пропиточный марки КО-950  предназначен для пропитки обмоток электрических машин и аппаратов классов нагревостойкости 200°С и 220°С по ГОСТ 8865 методом погружения или вакуум-нагнетательной пропитки.', 13000, 'electro.jpg'),
(18, 'Олигомер метилсилоксановый — ПМС(1л)', 'Олигомер метилсилоксановый — ПМС используется для изготовления технических волокнистых материалов специального назначения — различные текстильные структуры (нити, ленты, ткани, трикотаж, нетканые полотна) используемые в качестве наполнителей композиционных материалов теплозащитного назначения.', 8000, 'oligomer.jpg'),
(19, 'Фурфуриловый спирт 98%(бочка 250кг)', 'Фасовка – бочки 250кг.\r\nФурфуриловый спирт, еще одно название химреактива:2-Фурилкарбинол — это одноатомный спирт, производное фурана.\r\nФурфуриловый спирт представляет собой подвижную, прозрачную, иногда желтоватую жидкость со слабым запахом и горьким вкусом.', 100000, 'spirt.jpg'),
(1351, 'Смолы', 'Смола эпоксиэфирная ПН-543, ПН-543Р представляет собой раствор олигоэпоксималеинатов в олигоэфиракрилате и применяется в производстве электроизоляционных пропиточных компаундов.\r\n\r\nГарантийный срок хранения смолы в герметичной таре – 12 месяцев со дня изготовления.', 12000, 'smola.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(14, 'user A', 'user01@gmail.com', '698d51a19d8a121ce581499d7b701668', 'user'),
(15, 'user B', 'user02@gmail.com', '698d51a19d8a121ce581499d7b701668', 'user'),
(16, 'asdasdas', '21312312@gmail.com', 'efe6398127928f1b2e9ef3207fb82663', 'user'),
(17, 'Asos', 'email@gmail.com', '4297f44b13955235245b2497399d7a93', 'user'),
(18, 'goy', 'begetik@gmail.com', 'a8f5f167f44f4964e6c998dee827110c', 'admin'),
(20, 'qwe', 'qweqwe@gmail.com', 'efe6398127928f1b2e9ef3207fb82663', 'admin'),
(21, 'asdasdasda', 'den@gmail.com', '075a79fb221852f46c51b49f9d83204b', 'user'),
(22, 'ben4ik228', 'ben4ik228@gmail.com', 'cb679243e9cf722d94a8d10b0127af64', 'user'),
(23, 'denisdemoekz', 'denis@gmail.com', 'c3875d07f44c422f3b3bc019c23e16ae', 'admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT для таблицы `message`
--
ALTER TABLE `message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1352;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
