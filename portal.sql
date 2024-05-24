CREATE TABLE `users` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone_number` int(9) NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `permission` int(3) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `offers` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` varchar(20) NOT NULL,
  `type` varchar(25) NOT NULL,
  `publication_date` date NOT NULL,
  `status` varchar(25) NOT NULL,
  `user_id` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
);

CREATE TABLE `photos` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `file` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `offer_id` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`offer_id`) REFERENCES `offers`(`id`) ON DELETE CASCADE
);

