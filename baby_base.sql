-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-01-04 07:39:17
-- サーバのバージョン： 10.4.21-MariaDB
-- PHP のバージョン: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `baby_base`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `postcode` int(7) NOT NULL,
  `prefecture` text COLLATE utf8_unicode_ci NOT NULL,
  `city` text COLLATE utf8_unicode_ci NOT NULL,
  `chomei` text COLLATE utf8_unicode_ci NOT NULL,
  `building` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `room_number` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `method` int(3) NOT NULL,
  `status` int(3) NOT NULL,
  `completion_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `pictures`
--

CREATE TABLE `pictures` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `path` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `pictures`
--

INSERT INTO `pictures` (`id`, `product_id`, `path`) VALUES
(1, 3, '2022-01-04-07-38-37-0.png'),
(2, 3, '2022-01-04-07-38-37-1.png');

-- --------------------------------------------------------

--
-- テーブルの構造 `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `price` int(255) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `date` timestamp NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `status`, `date`, `user_id`) VALUES
(1, 'テスト商品1', 1000, 'テスト商品です', 0, '2022-01-04 06:37:24', 2),
(2, 'テスト商品2', 3000, 'テスト商品のその2です。', 0, '2022-01-04 06:37:54', 2),
(3, 'テスト商品[写真付き]', 200000, '写真付きのテスト商品です。', 0, '2022-01-04 06:38:39', 2);

-- --------------------------------------------------------

--
-- テーブルの構造 `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `products_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `purchase_date` timestamp NULL DEFAULT current_timestamp(),
  `completion_date` timestamp NULL DEFAULT NULL,
  `status` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `transfers`
--

CREATE TABLE `transfers` (
  `id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `email`) VALUES
(1, 'user', '$2y$10$Ral7bOuEz.oU50bH48BM4uA/wlg/xP31zkYHhALDXVGxi1r6H67oC', '外町釣り機', 'test@gmail.com'),
(2, 'test', '$2y$10$96jHHKmqMeGX0IBk4Ub2jO86WsnhHSQRKdNMcxoPPu04EuCFbwO1S', 'test', 'test@gmail.com');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address_user_id` (`user_id`);

--
-- テーブルのインデックス `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_products_id` (`products_id`);

--
-- テーブルのインデックス `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chats_user_is` (`user_id`),
  ADD KEY `chats_product_is` (`product_id`),
  ADD KEY `chats_transaction_id` (`transaction_id`);

--
-- テーブルのインデックス `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_transaction_id` (`transaction_id`);

--
-- テーブルのインデックス `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pictures_product_id` (`product_id`);

--
-- テーブルのインデックス `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_user_id` (`user_id`);

--
-- テーブルのインデックス `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_product_id` (`products_id`),
  ADD KEY `transactions_user_id` (`user_id`);

--
-- テーブルのインデックス `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transfer_payment_id` (`payment_id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- テーブルの AUTO_INCREMENT `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `address_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- テーブルの制約 `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `category_products_id` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`);

--
-- テーブルの制約 `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_product_is` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `chats_transaction_id` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`),
  ADD CONSTRAINT `chats_user_is` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- テーブルの制約 `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payment_transaction_id` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`);

--
-- テーブルの制約 `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `pictures_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- テーブルの制約 `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- テーブルの制約 `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_product_id` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `transactions_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- テーブルの制約 `transfers`
--
ALTER TABLE `transfers`
  ADD CONSTRAINT `transfer_payment_id` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
