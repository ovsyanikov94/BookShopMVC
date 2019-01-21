-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 21 2019 г., 08:01
-- Версия сервера: 5.7.19
-- Версия PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `booksdb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

DROP TABLE IF EXISTS `authors`;
CREATE TABLE IF NOT EXISTS `authors` (
  `authorID` int(11) NOT NULL AUTO_INCREMENT,
  `authorFirstName` varchar(50) NOT NULL,
  `authorLastName` varchar(50) NOT NULL,
  PRIMARY KEY (`authorID`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`authorID`, `authorFirstName`, `authorLastName`) VALUES
(42, 'Александр', 'Пушкин'),
(43, 'Федор', 'Достаевский'),
(44, 'Лев', 'Толстой');

-- --------------------------------------------------------

--
-- Структура таблицы `bookauthors`
--

DROP TABLE IF EXISTS `bookauthors`;
CREATE TABLE IF NOT EXISTS `bookauthors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `authorID` int(11) NOT NULL,
  `bookID` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `authorID` (`authorID`),
  KEY `bookID` (`bookID`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bookauthors`
--

INSERT INTO `bookauthors` (`id`, `authorID`, `bookID`) VALUES
(30, 42, 22),
(31, 43, 23),
(32, 43, 24),
(33, 43, 25),
(39, 43, 31),
(40, 43, 32);

-- --------------------------------------------------------

--
-- Структура таблицы `bookimages`
--

DROP TABLE IF EXISTS `bookimages`;
CREATE TABLE IF NOT EXISTS `bookimages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bookID` int(11) NOT NULL,
  `bookImagePath` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bookimages`
--

INSERT INTO `bookimages` (`id`, `bookID`, `bookImagePath`) VALUES
(1, 23, 'images/23/1545633941_3.jpg'),
(2, 24, 'images/24/1545633941_3.jpg'),
(3, 25, 'images/25/1545633969_3.jpg'),
(4, 26, 'images/26/1545633969_3.jpg'),
(5, 27, 'images/27/1545633998_3.jpg'),
(6, 28, 'images/28/1545633998_3.jpg'),
(7, 29, 'images/29/1545634013_3.jpg'),
(8, 30, 'images/30/1545634013_3.jpg'),
(9, 31, 'images/31/1545634235_3.jpg'),
(10, 32, 'images/32/1545634235_3.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `bookID` int(11) NOT NULL AUTO_INCREMENT,
  `bookTitle` varchar(50) NOT NULL,
  `bookISBN` varchar(30) NOT NULL,
  `bookPages` smallint(6) NOT NULL,
  `bookPrice` double NOT NULL,
  `bookAmount` smallint(6) NOT NULL,
  `bookDescription` varchar(500) NOT NULL,
  PRIMARY KEY (`bookID`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`bookID`, `bookTitle`, `bookISBN`, `bookPages`, `bookPrice`, `bookAmount`, `bookDescription`) VALUES
(22, 'просто название ', '0123456789', 10, 400, 100, 'Описание книги...'),
(23, 'Test', '0123456789', 10, 100, 6, 'Description...'),
(24, 'Test', '0123456789', 10, 100, 6, 'Description...'),
(25, 'Test', '0123456789', 10, 100, 6, 'Description...'),
(31, 'Test', '0123456789', 10, 100, 6, 'Description...'),
(32, 'Test', '0123456789', 10, 100, 6, 'Description...');

-- --------------------------------------------------------

--
-- Структура таблицы `booksgenres`
--

DROP TABLE IF EXISTS `booksgenres`;
CREATE TABLE IF NOT EXISTS `booksgenres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `genreID` int(11) NOT NULL,
  `bookID` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bookID` (`bookID`),
  KEY `genreID` (`genreID`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `booksgenres`
--

INSERT INTO `booksgenres` (`id`, `genreID`, `bookID`) VALUES
(33, 1, 22),
(34, 2, 22),
(35, 2, 23),
(36, 4, 23),
(37, 2, 24),
(38, 4, 24),
(39, 2, 25),
(40, 4, 25),
(51, 2, 31),
(52, 4, 31),
(53, 2, 32),
(54, 4, 32);

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `commentID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `bookID` int(11) NOT NULL,
  `commentText` varchar(1500) NOT NULL,
  `statusID` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  PRIMARY KEY (`commentID`),
  KEY `bookID` (`bookID`),
  KEY `userID` (`userID`),
  KEY `statusID` (`statusID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

DROP TABLE IF EXISTS `genres`;
CREATE TABLE IF NOT EXISTS `genres` (
  `genreID` int(11) NOT NULL AUTO_INCREMENT,
  `genreTitle` varchar(50) NOT NULL,
  PRIMARY KEY (`genreID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`genreID`, `genreTitle`) VALUES
(1, 'Fantasy'),
(2, 'Детектив'),
(4, 'Животные'),
(8, 'Драма'),
(11, 'Драма'),
(12, 'Драма'),
(13, 'Драма'),
(14, 'Драма'),
(15, 'Test '),
(18, 'test'),
(19, '213rdfqecas'),
(20, '213rdfqecas'),
(21, '213rdfqecas');

-- --------------------------------------------------------

--
-- Структура таблицы `orderdetails`
--

DROP TABLE IF EXISTS `orderdetails`;
CREATE TABLE IF NOT EXISTS `orderdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderID` int(11) NOT NULL,
  `bookID` int(11) NOT NULL,
  `bookPrice` int(11) NOT NULL,
  `bookAmount` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orderdetails_ibfk_1` (`bookID`),
  KEY `orderdetails_ibfk_2` (`orderID`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orderdetails`
--

INSERT INTO `orderdetails` (`id`, `orderID`, `bookID`, `bookPrice`, `bookAmount`) VALUES
(16, 3, 22, 400, 5),
(17, 3, 23, 100, 1),
(18, 3, 24, 100, 3),
(19, 3, 31, 100, 1),
(20, 4, 22, 400, 5),
(21, 4, 23, 100, 1),
(22, 4, 24, 100, 3),
(23, 4, 31, 100, 1),
(24, 6, 22, 400, 1),
(25, 7, 22, 400, 1),
(26, 7, 23, 100, 1),
(27, 8, 24, 100, 1),
(28, 8, 25, 100, 1),
(29, 9, 22, 400, 1),
(30, 9, 23, 100, 1),
(31, 9, 24, 100, 1),
(32, 10, 32, 100, 1),
(33, 11, 22, 400, 1),
(34, 11, 24, 100, 1),
(35, 12, 22, 400, 5),
(36, 12, 32, 100, 1),
(37, 12, 31, 100, 1),
(38, 13, 23, 100, 1),
(39, 13, 24, 100, 1),
(40, 13, 25, 100, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `orderID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `adressOrder` varchar(255) NOT NULL,
  `orderDatetime` timestamp NOT NULL,
  `orderStatus` int(11) NOT NULL,
  PRIMARY KEY (`orderID`),
  KEY `orders_ibfk_1` (`userID`),
  KEY `orders_ibfk_2` (`orderStatus`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`orderID`, `userID`, `adressOrder`, `orderDatetime`, `orderStatus`) VALUES
(3, 11, 'ул. Тест 45', '2019-01-15 07:27:55', 3),
(4, 11, 'ул. Тестовая д45', '2019-01-15 07:59:16', 2),
(5, 11, 'ул. Тестовая д45', '2019-01-15 07:59:26', 2),
(6, 11, 'Адрес', '2019-01-15 08:16:57', 2),
(7, 11, 'Address ', '2019-01-15 08:18:39', 2),
(8, 11, 'Address', '2019-01-15 08:23:35', 2),
(9, 11, 'Address', '2019-01-15 08:24:42', 2),
(10, 11, 'Address', '2019-01-15 08:36:26', 2),
(11, 11, 'Test', '2019-01-15 08:57:54', 2),
(12, 11, 'Address', '2019-01-21 06:46:01', 2),
(13, 11, 'Address 2', '2019-01-21 06:46:19', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `orderstatus`
--

DROP TABLE IF EXISTS `orderstatus`;
CREATE TABLE IF NOT EXISTS `orderstatus` (
  `statusID` int(11) NOT NULL AUTO_INCREMENT,
  `statusTitle` varchar(50) NOT NULL,
  PRIMARY KEY (`statusID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orderstatus`
--

INSERT INTO `orderstatus` (`statusID`, `statusTitle`) VALUES
(1, 'В обработке'),
(2, 'Новый'),
(3, 'Завершен');

-- --------------------------------------------------------

--
-- Структура таблицы `statuses`
--

DROP TABLE IF EXISTS `statuses`;
CREATE TABLE IF NOT EXISTS `statuses` (
  `statusID` int(11) NOT NULL AUTO_INCREMENT,
  `statusTitle` varchar(25) NOT NULL,
  PRIMARY KEY (`statusID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `statuses`
--

INSERT INTO `statuses` (`statusID`, `statusTitle`) VALUES
(1, 'Новый'),
(2, 'Одобрен'),
(3, 'Отклонен');

-- --------------------------------------------------------

--
-- Структура таблицы `useravatar`
--

DROP TABLE IF EXISTS `useravatar`;
CREATE TABLE IF NOT EXISTS `useravatar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `userImagePath` varchar(1054) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_avatar_id` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `useravatar`
--

INSERT INTO `useravatar` (`id`, `userID`, `userImagePath`) VALUES
(12, 11, 'images/avatars/11/Avatar_1547536274.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userLogin` varchar(50) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `middleName` varchar(50) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `isAdmin` tinyint(4) DEFAULT NULL,
  `userPassword` varchar(100) NOT NULL,
  `verification` tinyint(1) NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `userLogin` (`userLogin`),
  UNIQUE KEY `userEmail` (`userEmail`),
  UNIQUE KEY `phoneNumber` (`phoneNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`userID`, `userLogin`, `userEmail`, `firstName`, `lastName`, `middleName`, `phoneNumber`, `isAdmin`, `userPassword`, `verification`, `token`) VALUES
(10, 'Alex', 'alex@gmail.com', 'Alex', 'Ovs', 'Serg', '+11(222)333-44-99', NULL, '$2y$10$/RIhEgwDSxlRlGx3yxmMW.y5N/3zi/DugeuDSvBBN3GPFkxVtKb6K', 1, '$2y$10$TyhQWu7174/m3QB9wz1wqOZvxeizOnyWXhF5F1Df8aQGszhyZrDxe'),
(11, 'Alex2', 'alex2@gmail.com', 'Alexey', 'Ovs', 'Ovs', '+11(222)333-44-91', NULL, '$2y$10$NzKRtH8SJICCqiVD5oOEcOyubN5PyEhYwKjxG2lKiQIPEMo3k.h3O', 1, '$2y$10$evIzO3yFO/q7zGU/qCrV6etTGNJ7FJn70VxmhAdvZq84NhmlZvUH6'),
(12, 'Admin', 'admin@gmail.com', 'Admin', 'Admin', 'Admin', '+12(222)900-12-11', 1, '$2y$10$g9tpHih3HEwaY6CUpKDiRuUUoN6TIME7ldFpVJh2NoT8spJ.N/vP2', 1, '$2y$10$pfsZcqFSyGhvWOlj1PwGAOuSB4At9JcHbkdIjGIeOBwx.9o/UWghu');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `bookauthors`
--
ALTER TABLE `bookauthors`
  ADD CONSTRAINT `bookauthors_ibfk_1` FOREIGN KEY (`authorID`) REFERENCES `authors` (`authorID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookauthors_ibfk_2` FOREIGN KEY (`bookID`) REFERENCES `books` (`bookID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `booksgenres`
--
ALTER TABLE `booksgenres`
  ADD CONSTRAINT `booksgenres_ibfk_1` FOREIGN KEY (`bookID`) REFERENCES `books` (`bookID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booksgenres_ibfk_2` FOREIGN KEY (`genreID`) REFERENCES `genres` (`genreID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`bookID`) REFERENCES `books` (`bookID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`statusID`) REFERENCES `statuses` (`statusID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`bookID`) REFERENCES `books` (`bookID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`orderStatus`) REFERENCES `orderstatus` (`statusID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `useravatar`
--
ALTER TABLE `useravatar`
  ADD CONSTRAINT `fk_user_avatar_id` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
