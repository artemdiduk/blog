-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Час створення: Лис 24 2022 р., 14:27
-- Версія сервера: 10.4.24-MariaDB
-- Версія PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `blog`
--

-- --------------------------------------------------------

--
-- Структура таблиці `coments`
--

CREATE TABLE `coments` (
  `id` int(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `post` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `coments`
--

INSERT INTO `coments` (`id`, `user`, `text`, `post`, `img`) VALUES
(10, 'testuser', 'Статья позаимствованная с сайту https://linuxcool.net/', 'linux/3-luchshikh-distributivov-linux-dlya-polzovatelei', 'test228637f6cf0adb15.png'),
(11, 'testuser', 'Статья позаимствованная с сайту https://vps.ua/wiki/top-command/', 'linux/komanda-top-v-linux', '');

-- --------------------------------------------------------

--
-- Структура таблиці `group`
--

CREATE TABLE `group` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `group`
--

INSERT INTO `group` (`id`, `name`, `url`) VALUES
(629, 'Linux', 'linux');

-- --------------------------------------------------------

--
-- Структура таблиці `post`
--

CREATE TABLE `post` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `post`
--

INSERT INTO `post` (`id`, `name`, `url`, `text`, `img`, `group`, `author`) VALUES
(42, '3 лучших дистрибутивов Linux для пользователей', 'linux/3-luchshikh-distributivov-linux-dlya-polzovatelei', '<p>1. Zorin OS</p>\r\n<p>Первый дистрибутив Linux в этом списке – Zorin OS. И на это есть свои причины. С точки зрения нового пользователя Windows, стабильность является важным признаком операционной системы.</p>\r\n<p>Zorin OS является идеальной отправной точкой для пользователей windows. Она поставляется со встроенными Windows-подобными темами, которые вы можете применить одним щелчком мыши. Мало того, внешний вид главной панели задач вы можете изменить с помощью простого в использовании менеджера настроек.</p>\r\n<p>2. Linux Mint Cinnamon Edition</p>\r\n<p>Если вы когда-нибудь запутаетесь, какой дистрибутив выбрать, вы можете слепо выбрать “Linux Mint”, особенно версию Cinnamon. Linux Mint Cinnamon edition – это надежный дистрибутив Linux, который предлагает традиционный дизайн рабочего стола, идеально подходящий для пользователей Windows.</p>\r\n<p>Для начинающих пользователей Linux (с Windows) установка приложений, пакетов и других аспектов может оказаться непосильной задачей. Но команда Linux Mint проделала отличную работу над этим дистрибутивом, который делает вашу повседневную работу очень простой.</p>\r\n<p>3. Kubuntu LTS Release</p>\r\n<p>Список дистрибутивов Linux будет неполным без Kubuntu, который имеет потрясающий рабочий стол KDE Plasma. Kubuntu – это хорошо разработанный и стабильный дистрибутив Linux, который представляет собой слияние Ubuntu и рабочего стола KDE Plasma.</p>', 'linux-3-luchshikh-distributivov-linux-dlya-polzovatelei637f6c573ce96.jpg', 'linux', 'testuser'),
(43, 'Команда top в Linux', 'linux/komanda-top-v-linux', '<p>Любой сервер, каким бы мощным он ни был, имеет ограниченный объем ресурсов. Каждая программа, работающая в активном или фоновом режиме, использует определенное количество виртуальной и физической памяти, процессорного времени и т.д. Иными словами, создает определенную нагрузку на сервер. Чтобы посмотреть, насколько система загружена в данный момент времени, используют консольную команду top.</p>\r\n<p>Команда top в Linux системах позволяет вывести в виде таблицы перечень запущенных процессов и оценить, какой объем ресурсов они потребляют, т.е., какую нагрузку создают на сервер и дисковую подсистему. Такая информация помогает в дальнейшем оптимизировать работу системы.</p>', '', 'linux', 'testuser');

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `name`, `slug`, `email`, `password`) VALUES
(18, 'testuser', 'testUser', 'mail@mail', '5ec0e10dca7721da9ef59f14a19d0780');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `coments`
--
ALTER TABLE `coments`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `coments`
--
ALTER TABLE `coments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблиці `group`
--
ALTER TABLE `group`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=630;

--
-- AUTO_INCREMENT для таблиці `post`
--
ALTER TABLE `post`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
