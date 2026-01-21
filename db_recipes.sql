-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2025 at 08:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_recipes`
--

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `recipe_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `ingredients` text NOT NULL,
  `instructions` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`recipe_id`, `title`, `ingredients`, `instructions`, `image_path`, `category`, `user_id`, `is_approved`) VALUES
(4, 'Pizza Margarita', '300g brašna, 1 kesica kvasca, 200ml vode, 2 kašike maslinovog ulja, 1 kašičica soli, 100g paradajz sosa, 200g mocarele, svež bosiljak', '1. Pomešati brašno, kvasac, so i vodu. 2. Umesiti testo i ostaviti da naraste 1 sat. 3. Razvući testo, premazati paradajz sosom, dodati mocarelu i bosiljak. 4. Peći na 220°C oko 12 minuta.', 'pictures/pizza_margarita.jpg', 'Glavna jela', NULL, 1),
(12, 'Voćna torta', 'Brašno, jaja, šećer, voće', 'Ispeci biskvit i dodaj voće.', 'pictures/fruit_torta.jpg', 'Torte', 2, 1),
(13, 'Plazma torta', 'Plazma, mleko, šećer, margarin', 'Izmešati sastojke i staviti u frižider.', 'pictures/plazma_torta.jpg', 'Torte', 3, 1),
(17, 'Punjene paprike', 'Mleveno meso, pirinač, paprika, začini', 'Napuniti paprike i kuvati.', 'pictures/punjene_paprike.jpg', 'Glavna jela', 7, 1),
(19, 'Ćevapi', 'Mleveno meso, začini, luk', 'Oblikovati i peći na roštilju.', 'pictures/cevapi.jpg', 'Glavna jela', 2, 1),
(20, 'Grčka salata', 'Paradajz, krastavac, sir, masline', 'Iseckati sastojke i pomešati.Dodati sirće i origano po ukusu.', 'pictures/grcka_salata.jpg', 'Salate', 3, 1),
(21, 'Ruska salata', 'Krompir, šargarepa, majonez, grašak', 'Skuvati povrće i dodati majonez.', 'pictures/ruska_salata.jpg', 'Salate', 4, 1),
(24, 'Mojito', 'Rum, šećer, nana, limeta, soda voda', 'Izgnječiti limetu i nanu, dodati rum i sodu.', 'pictures/mojito.jpg', 'Pića', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'moderator'),
(3, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(36) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `role_id`) VALUES
(2, 'aleksandar123', 'aleksandar123@gmail.com', '$2y$10$RDDHFQXoWxQFW.1AnLc1mueGqmuNwDJ/Q2g6bnoiRfL8x.iNEQITi', 3),
(3, 'Ignjat', 'milatovicignjat007@gmail.com', '$2y$10$pM.7U7iz.zJaVwvt09BBler0mH7iX5N83AO7HB/FpLI8tdtUXdsf6', 3),
(4, 'milos123', 'milos123@gmail.com', '$2y$10$6n92ESK0TOU2yaOGDOQGl.qFx3qFD9BnzLfS5gjm7ZLWuurFApCqW', 3),
(7, 'marko123', 'marko123@gmail.com', '$2y$10$ZLPAlkeLPfqafN4D1n1Kj.EjCkSJfWf6cjekiS3iJLYugDeFyrwO2', 3),
(8, 'uros123', 'uros123@gmail.com', '$2y$10$EWcSa4uYDJUTdieSE4wxQ.0YNqnO1L3TWcFv2kn5FhJSEuQQHGQkG', 3),
(9, 'mirko123', 'mirko123@gmail.com', '$2y$10$tnR9Ndoz/2rMb4HdqWTzo.K.1e7X4gIeI7HSRuHJZqE8NLMaSqfkS', 3),
(10, 'Ignjat123', 'ignjat123@gmail.com', '$2y$10$w9k3kW4WqP6jY5hXe0aJxuW8XY8LkqjvHhL7B0kZPSP95a6CNfC1K', 3),
(11, 'danilo1234', 'danilo1234@gmail.com', '$2y$10$En2HzY1sgOZ0BxBpVAvzo.1dVcGDCPwRlrnladoCZLB9b7D8NjZBy', 3),
(12, 'nikola1234', 'nikola1234@gmail.com', '$2y$10$Vsm0k4aHpsoKhAsL2LompeVNntBcSG8HgL83IZlfm/PsW4LIwlF26', 3),
(13, 'arsenije123', 'arsenije123@gmail.com', '$2y$10$BtmxTXORNfKwH8OzUyf2nOlMh/Uj0.TerR99cjMqAGStPpXCRS8MW', 3),
(14, 'admin', 'admin@example.com', '$2y$10$4qmR5kTckCX3UMfQJjgnIuKZ2YvrmenWRRBjef7zsuFZFjymgwFyK', 1),
(15, 'moderator', 'moderator@example.com', '$2y$10$i03iv8Cg6jFoyVcgfAqjc.LVeAOShMKbitZQw8qW6CDzff5pm.qG2', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipe_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `recipes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
