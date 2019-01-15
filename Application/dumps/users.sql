-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 14 2019 г., 17:50
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
  `isAdmin` int(11) DEFAULT NULL,
  `userPassword` varchar(100) NOT NULL,
  `verification` tinyint(1) NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`userID`, `userLogin`, `userEmail`, `firstName`, `lastName`, `middleName`, `phoneNumber`, `isAdmin`, `userPassword`, `verification`, `token`) VALUES
(13, 'dreamcastjk', 'slipdoll@gmail.com', 'Стас', 'Жихарев', 'asdasdasd', '+38(099)918-78-21', NULL, '$2y$10$xGYXmogVSDXwpjGS8URbjuyCW53RQi/HtBy.OxsSxy3sHSLO2f35G', 1, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
