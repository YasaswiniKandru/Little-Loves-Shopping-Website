
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
);


CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL
);


INSERT INTO `items` (`id`, `name`, `price`) VALUES
(1, 'Long Sleeve Top + Stripped Phants', 15),
(2, 'Transparent Baby Girl Dress', 30),
(3, 'Elegant Baby Girl Frock', 25),
(4, 'Girls Summer Wear', 13),
(5, 'Baby Girl Cotton Wear', 30),
(6, 'Traditional Wear Lehanga', 80),
(7, 'Summer comforts Girl Wear', 70),
(8, 'Beautiful Ghagra - Festival Wear', 100),
(9, 'Raymond Shirt & Jeans', 75),
(10, 'Suite for boy kid', 80),
(11, 'Vineyard Vines Boys Shirt & Jeans', 90),
(12, 'Brand Factory Jeans & Shirt, Kids', 80),
(13, 'Boys Hoodie & Jeans', 95),
(14, 'Traditional wear for boy kid', 120),
(15, 'Laurance Hoodie & Jeans', 90),
(16, 'Trendy Jeans & Shirt, Kids', 95);


CREATE TABLE `users_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `status` enum('Added to cart','Confirmed') NOT NULL
);


ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `users_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`item_id`),
  ADD KEY `item_id` (`item_id`);


ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
  
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `users_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `users_items`
  ADD CONSTRAINT `users_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);



