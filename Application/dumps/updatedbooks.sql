-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 20 2018 г., 17:12
-- Версия сервера: 5.7.21
-- Версия PHP: 5.6.35

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`authorID`, `authorFirstName`, `authorLastName`) VALUES
(3, 'Александр', 'Пушкин'),
(4, 'Книга', 'Книга');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `bookPrice` varchar(10) NOT NULL,
  `bookAmount` smallint(6) NOT NULL,
  `bookDescription` varchar(500) NOT NULL,
  PRIMARY KEY (`bookID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`bookID`, `bookTitle`, `bookISBN`, `bookPages`, `bookPrice`, `bookAmount`, `bookDescription`) VALUES
(1, 'Книга', '1234567890', 123, '123', 123, 'Описание 123 123'),
(2, 'Книга', '1234567890', 123, '123', 123, 'Описание 123 123'),
(3, 'Книга', '1234567890', 123, '123', 123, '12312312321312'),
(4, 'Книга', '1234567890', 123, '123', 123, '12312312321312'),
(5, 'Книга', '1234567890', 123, '123', 123, '1231231232131'),
(6, 'Книга', '1234567890', 123, '123,22', 123, '213123123123');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

DROP TABLE IF EXISTS `genres`;
CREATE TABLE IF NOT EXISTS `genres` (
  `genreID` int(11) NOT NULL AUTO_INCREMENT,
  `genreTitle` varchar(50) NOT NULL,
  PRIMARY KEY (`genreID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`genreID`, `genreTitle`) VALUES
(1, '12312');

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
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
