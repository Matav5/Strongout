SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `uzivatele`;

CREATE TABLE `uzivatele` (
  `id` int NOT NULL AUTO_INCREMENT,
  `prezdivka` varchar(100) UNIQUE NOT NULL,
  `email` varchar(100) UNIQUE NOT NULL,
  `heslo` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_prezdivka` (`prezdivka`),
  UNIQUE KEY `unique_email` (`email`),
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
);
INSERT INTO `uzivatele` (`prezdivka`, `email`, `heslo`) VALUES
(	'StrongMan123',	'jarda@seznam.cz',	'$2y$10$NxYGNa68cPaK4Q8v9MnOv.63oLGr1JhNbKk3gTgEop96je4U3mlh6'),
(	'alena',	'alena@seznam.cz',	'$2y$10$0E4WfmmRkgKV5ZEyODpHdORMq4gu9C8L2.wH5IOKVisVrFO1XO22e'),
(	'peterka',	  'peterka@google.com','$2y$10$ziAvQ9GexLC6C2HuUYUu7ehAbkmxI1b4idsqOOb2rAPt85Leb40um');


CREATE TABLE `favorites` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fk_uzivatel` int NOT NULL,
  `soubor` text NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`fk_uzivatel`) REFERENCES `uzivatele` (`id`) ON DELETE CASCADE,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
);

