-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Po 05.Máj 2025, 14:07
-- Verzia serveru: 10.4.21-MariaDB
-- Verzia PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `diskutujme`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(1, 'Matematika', 'Matematika je vedecká disciplína, ktorá sa zaoberá štúdiom vzťahov, vzorcov, štruktúr a objavovania pravidiel, ktoré charakterizujú rôzne matematické koncepty. '),
(2, 'Fyzika', 'Fyzika je vedecká disciplína, ktorá sa zaoberá štúdiom vzťahov, vzorcov, štruktúr a objavovania pravidiel, ktoré charakterizujú rôzne matematické koncepty. '),
(3, 'Chémia', 'Chémia je vedecká disciplína, ktorá sa zaoberá štúdiom vzťahov, vzorcov, štruktúr a objavovania pravidiel, ktoré charakterizujú rôzne matematické koncepty. '),
(4, 'Geografia', 'Chémia je vedecká disciplína, ktorá sa zaoberá štúdiom vzťahov, vzorcov, štruktúr a objavovania pravidiel, ktoré charakterizujú rôzne matematické koncepty. '),
(5, 'Geometria', 'Chémia je vedecká disciplína, ktorá sa zaoberá štúdiom vzťahov, vzorcov, štruktúr a objavovania pravidiel, ktoré charakterizujú rôzne matematické koncepty. '),
(6, 'Slovenčína', 'Chémia je vedecká disciplína, ktorá sa zaoberá štúdiom vzťahov, vzorcov, štruktúr a objavovania pravidiel, ktoré charakterizujú rôzne matematické koncepty. ');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `message` varchar(1024) NOT NULL,
  `author` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  `thread` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `post`
--

INSERT INTO `post` (`id`, `message`, `author`, `date`, `thread`) VALUES
(1, 'Ludolfovo číslo, tiež známe ako pí, či Archimedova konštanta, je matematická konštanta, ktorá vyjadruje pomer obvodu kružnice k jej priemeru. Tento vzťah platí pre kružnice akejkoľvek veľkosti. Ak sa rozpomeniete na hodiny matematiky, pí sa nepoužívalo iba pri výpočte vlastností kružníc ako obsah a obvod.', 1, '2024-05-03 10:01:56', 1),
(2, 'Nerovnica je algebrická úloha, pri ktorej sa hľadajú všetky čísla danej množiny, ktoré spĺňajú danú nerovnosť. Nerovnice sa riešia tak, že sa ekvivalentnými úpravami prevedú na jednoduchší tvar, z ktorého je možné určiť riešenie nerovnice.', 1, '2024-05-03 10:01:56', 4),
(3, 'Gravitačná sila je sila, ktorá je mierou gravitačnej interakcie. Inak povedané: Gravitačná sila je sila pôsobiaca v dôsledku gravitácie.', 1, '2024-05-03 12:10:15', 6),
(4, '\"Hmotnosť látok vstupujúcich do chemickej reakcie (reaktantov) sa rovná hmotnosti látok, ktoré chemickou reakciou vzniknú (produktov).\" Definovali ho nezávisle od seba Michal Vasilievič Lomonosov a Antoine Laurent Lavoisier, pričom pochádzali z úplne iných pomerov.', 1, '2024-05-03 12:10:15', 7),
(5, 'Ludolfovo číslo, tiež známe ako pí, či Archimedova konštanta, je matematická konštanta, ktorá vyjadruje pomer obvodu kružnice k jej priemeru. Tento vzťah platí pre kružnice akejkoľvek veľkosti. Ak sa rozpomeniete na hodiny matematiky, pí sa nepoužívalo iba pri výpočte vlastností kružníc ako obsah a obvod.', 2, '2024-05-10 10:01:56', 1),
(6, 'Hoci matematika samotná sa väčšinou nepovažuje za prírodnú vedu, špecifické štruktúry skúmané matematikmi majú často pôvod v prírodných vedách, najmä vo fyzike. Matematici sa však zaoberajú aj štruktúrami, ktorých pôvod nie je čisto matematický, napríklad ak poskytujú zovšeobecnenie', 9, '2024-07-02 11:07:02', 2),
(7, 'Hoci matematika samotná sa väčšinou nepovažuje za prírodnú vedu, špecifické štruktúry skúmané matematikmi majú často pôvod v prírodných vedách, najmä vo fyzike. Matematici sa však zaoberajú aj štruktúrami, ktorých pôvod nie je čisto matematický, napríklad ak poskytujú zovšeobecnenie', 9, '2024-07-02 11:12:14', 20),
(8, 'Hoci matematika samotná sa väčšinou nepovažuje za prírodnú vedu, špecifické štruktúry skúmané matematikmi majú často pôvod v prírodných vedách, najmä vo fyzike. Matematici sa však zaoberajú aj štruktúrami, ktorých pôvod nie je čisto matematický, napríklad ak poskytujú zovšeobecnenie', 2, '2024-07-02 11:07:02', 1),
(9, 'Hoci matematika samotná sa väčšinou nepovažuje za prírodnú vedu, špecifické štruktúry skúmané matematikmi majú často pôvod v prírodných vedách, najmä vo fyzike. Matematici sa však zaoberajú aj štruktúrami, ktorých pôvod nie je čisto matematický, napríklad ak poskytujú zovšeobecnenie', 7, '2024-07-02 11:07:02', 1),
(10, 'Hoci matematika samotná sa väčšinou nepovažuje za prírodnú vedu, špecifické štruktúry skúmané matematikmi majú často pôvod v prírodných vedách, najmä vo fyzike. Matematici sa však zaoberajú aj štruktúrami, ktorých pôvod nie je čisto matematický, napríklad ak poskytujú zovšeobecnenie', 4, '2024-07-02 11:07:02', 1),
(11, 'Hoci matematika samotná sa väčšinou nepovažuje za prírodnú vedu, špecifické štruktúry skúmané matematikmi majú často pôvod v prírodných vedách, najmä vo fyzike. Matematici sa však zaoberajú aj štruktúrami, ktorých pôvod nie je čisto matematický, napríklad ak poskytujú zovšeobecnenie', 1, '2024-07-02 11:07:02', 1),
(12, 'Kokot (iné názvy: Cacat, Chokot, Kokat, Kakat, Kakath, Gockern a iné) bola osada a hrad na území dnešného Štúrova.[1] Hrad aj osada boli zničené Turkami (ÚGKK SR uvádza vpád v roku 1543),[1] neskôr bola v 40. rokoch 16. storočia v ich tesnej blízkosti založená nová osada', 9, '2024-08-08 13:17:43', 20),
(13, 'Kokot (iné názvy: Cacat, Chokot, Kokat, Kakat, Kakath, Gockern a iné) bola osada a hrad na území dnešného Štúrova.[', 9, '2024-08-08 13:21:09', 20),
(14, 'Kokot (iné názvy: Cacat, Chokot, Kokat, Kakat, Kakath, Gockern a iné) bola osada a hrad na území dnešného Štúrova.[', 9, '2024-08-08 13:21:24', 20),
(15, 'Kokot (iné názvy: Cacat, Chokot, Kokat, Kakat, Kakath, Gockern a iné) bola osada a hrad na území dnešného Štúrova.[', 9, '2024-08-08 13:21:37', 20),
(16, 'Kokot (iné názvy: Cacat, Chokot, Kokat, Kakat, Kakath, Gockern a iné) bola osada a hrad na území dnešného Štúrova.[', 9, '2024-08-08 13:21:38', 20),
(17, 'ahooojahooojahooojahooojahooojahooojahooojahooojahooojahooojahooojahooojahooojahooojahoooj', 9, '2024-08-08 13:26:18', 9),
(18, 'A characterising name for the thread.A characterising name for the thread.A characterising name for the thread.', 9, '2024-08-08 13:49:46', 21),
(19, 'super cg Michal Vasilievič Lomonosov a Antoine Laurent Lavoisier', 9, '2024-08-16 22:56:59', 7),
(20, 'neviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviem', 9, '2024-08-27 20:06:51', 22),
(21, 'neviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviem', 9, '2024-08-27 20:07:32', 22),
(22, 'neviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviemneviem', 9, '2024-08-27 20:07:35', 22);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `thread`
--

CREATE TABLE `thread` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `author_id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `thread`
--

INSERT INTO `thread` (`id`, `name`, `author_id`, `category`, `views`) VALUES
(1, 'Číslo Pí', 1, 1, 30),
(2, 'Analytické vyjadrenie kružnice', 1, 1, 13),
(3, 'Lineárne lomená funkcia', 1, 1, 98),
(4, 'Nerovnice ', 1, 1, 12),
(5, 'Logaritmické rovnice', 1, 1, 80),
(6, 'Gravitačná sila', 1, 2, 0),
(7, 'Zákon zachovania hmotnosti', 1, 3, 0),
(9, 'Lineárne funkcia', 2, 1, 988),
(10, 'Kvadratická funkcia', 2, 1, 988),
(11, 'Aritmeticka postupnost', 2, 1, 988),
(12, 'Eulerove cislo', 1, 1, 30),
(13, 'Analytické vyjadrenie priamky', 1, 1, 13),
(15, 'Analytické vyjadrenie roviny', 1, 1, 13),
(16, 'wegwere', 9, 1, 1),
(17, 'Newt. pohyb. zakon.', 9, 2, 1),
(18, 'Eulerove cislo', 9, 1, 1),
(19, 'Matematika1', 9, 1, 1),
(20, 'Matematika2', 9, 1, 1),
(21, 'Eulerove cislo', 9, 6, 1),
(22, 'neviem', 9, 1, 1);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` text NOT NULL,
  `joined` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `joined`, `status`) VALUES
(1, 'admin', 'admin@gmail.com', 'Heslo123', '2024-05-03 08:55:26', 'admin'),
(2, 'David', 'david.pircher1369@gmail.com', '$2y$10$/GlpVFKCq2Er.aE/ZQ38aew6n0OmYMoALHNI8vSDb5gXoUF5D3SJS', '2024-06-05 14:54:01', 'user'),
(3, 'David1', 'david.pircher19@gmail.com', '$2y$10$6Qtt1Y8PiaGvuVNMGA.QVenpXnQ1i7gA/Rr/3B/CHNJLZ12ieNC9K', '2024-06-05 14:58:28', 'user'),
(4, 'Cc', 'david.pircher9@gmail.com', '$2y$10$21zHkzHX5gRjC8rYwpB4uuW2x66gO585vCatNwglFdmfoqMBney9S', '2024-06-05 14:58:38', 'user'),
(5, 'ff', 'david.pircher@gmail.com', '$2y$10$zNWJl5iXn92L039HHUcId.ic.k44ijvHhsNEBEAef0nqJgfkSdYni', '2024-06-05 14:59:18', 'user'),
(6, 'ffff', 'davidpircher@gmail.com', '$2y$10$rzcsVZgtWfwYx4wYqXvWGON9GUuK6S0nrU.7lo3H5jgHDGRtCF4Da', '2024-06-05 15:01:10', 'user'),
(7, 'DROP TABLE users', 'daidpircher@gmail.com', '$2y$10$/wxJ/GlPtPITBJUMJLg6EeqOAGA016jfI5wz0X7EGXfD1Ci4LI3t6', '2024-06-05 15:03:13', 'user'),
(8, 'drop1', 'daidpircer@gmail.com', '$2y$10$x.kn5wyrCQtUk5P2Ou.IfuiXscup7Yy8qP8XQlf0r/6i0MqnEsk9a', '2024-06-05 15:04:47', 'user'),
(9, 'ferko1', 'pircher1369@gmail.com', '$2y$10$z7Rol4HhPCnKIJatlSlKrOjTkyzI03C786F5yrsY9VK4Y5nHmO7Cu', '2024-06-08 21:57:56', 'user'),
(10, '', '', '', '0000-00-00 00:00:00', 'user'),
(11, '', '', '', '0000-00-00 00:00:00', 'user'),
(12, 'ivan', 'david.p1rcher@gmail.com', '$2y$10$RXnwKW.M69xlK7qZ9TfEz.NrQ.9BJnG0jiqHZ6wLtaEfnHmbUU4bW', '2024-12-14 10:55:53', 'user');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_thread_id` (`thread`),
  ADD KEY `post_author_id` (`author`);

--
-- Indexy pre tabuľku `thread`
--
ALTER TABLE `thread`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thread_category_id` (`category`),
  ADD KEY `thread_author_id` (`author_id`);

--
-- Indexy pre tabuľku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pre tabuľku `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pre tabuľku `thread`
--
ALTER TABLE `thread`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pre tabuľku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Obmedzenie pre exportované tabuľky
--

--
-- Obmedzenie pre tabuľku `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_author_id` FOREIGN KEY (`author`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `post_thread_id` FOREIGN KEY (`thread`) REFERENCES `thread` (`id`);

--
-- Obmedzenie pre tabuľku `thread`
--
ALTER TABLE `thread`
  ADD CONSTRAINT `thread_author_id` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `thread_category_id` FOREIGN KEY (`category`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
