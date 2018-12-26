-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 24 2018 г., 09:07
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
(7, 43, 7),
(8, 44, 7),
(9, 43, 8),
(10, 44, 8),
(11, 42, 9),
(12, 43, 9),
(13, 42, 10),
(14, 43, 10),
(17, 42, 12),
(18, 43, 12),
(19, 42, 13),
(20, 43, 13),
(21, 42, 14),
(22, 43, 14),
(23, 42, 15),
(24, 42, 16),
(25, 42, 17),
(26, 42, 18),
(27, 42, 19),
(28, 42, 20),
(29, 42, 21),
(30, 42, 22),
(31, 43, 23),
(32, 43, 24),
(33, 43, 25),
(34, 43, 26),
(35, 43, 27),
(36, 43, 28),
(37, 43, 29),
(38, 43, 30),
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
(5, 'TEst', '1234567899', 100, 10, 50, ''),
(6, 'Название', '1234567899', 100, 400, 95, ''),
(7, 'Название книги', '1234567899', 100, 250.99, 100, ''),
(8, 'Название книги', '1234567899', 100, 250.99, 100, ''),
(9, 'Название книги 2', '1234567899', 100, 150.23, 10, ''),
(10, 'Название книги', '1234567899', 100, 250.99, 100, ''),
(12, 'Название', '1234567899', 100, 250.99, 100, ''),
(13, 'Название', '1234567899', 100, 250.99, 100, ''),
(14, 'Название', '1234567899', 100, 250.99, 100, ''),
(15, 'просто название ', '0123456789', 10, 400, 100, 'Описание книги...'),
(16, 'просто название ', '0123456789', 10, 400, 100, 'Описание книги...'),
(17, 'просто название ', '0123456789', 10, 400, 100, 'Описание книги...'),
(18, 'просто название ', '0123456789', 10, 400, 100, 'Описание книги...'),
(19, 'просто название ', '0123456789', 10, 400, 100, 'Описание книги...'),
(20, 'просто название ', '0123456789', 10, 400, 100, 'Описание книги...'),
(21, 'просто название ', '0123456789', 10, 400, 100, 'Описание книги...'),
(22, 'просто название ', '0123456789', 10, 400, 100, 'Описание книги...'),
(23, 'Test', '0123456789', 10, 100, 6, 'Description...'),
(24, 'Test', '0123456789', 10, 100, 6, 'Description...'),
(25, 'Test', '0123456789', 10, 100, 6, 'Description...'),
(26, 'Test', '0123456789', 10, 100, 6, 'Description...'),
(27, 'Test', '0123456789', 10, 100, 6, 'Description...'),
(28, 'Test', '0123456789', 10, 100, 6, 'Description...'),
(29, 'Test', '0123456789', 10, 100, 6, 'Description...'),
(30, 'Test', '0123456789', 10, 100, 6, 'Description...'),
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
(3, 2, 7),
(4, 4, 7),
(5, 2, 8),
(6, 4, 8),
(7, 4, 9),
(8, 8, 9),
(9, 4, 10),
(10, 8, 10),
(13, 4, 12),
(14, 8, 12),
(15, 4, 13),
(16, 8, 13),
(17, 4, 14),
(18, 8, 14),
(19, 1, 15),
(20, 2, 15),
(21, 1, 16),
(22, 2, 16),
(23, 1, 17),
(24, 2, 17),
(25, 1, 18),
(26, 2, 18),
(27, 1, 19),
(28, 1, 20),
(29, 2, 19),
(30, 2, 20),
(31, 1, 21),
(32, 2, 21),
(33, 1, 22),
(34, 2, 22),
(35, 2, 23),
(36, 4, 23),
(37, 2, 24),
(38, 4, 24),
(39, 2, 25),
(40, 4, 25),
(41, 2, 26),
(42, 4, 26),
(43, 2, 27),
(44, 4, 27),
(45, 2, 28),
(46, 4, 28),
(47, 2, 29),
(48, 4, 29),
(49, 2, 30),
(50, 4, 30),
(51, 2, 31),
(52, 4, 31),
(53, 2, 32),
(54, 4, 32);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `orderID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `orderDatetime` datetime NOT NULL,
  PRIMARY KEY (`orderID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userLogin` varchar(50) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `userPassword` varchar(100) NOT NULL,
  `verification` tinyint(1) NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
