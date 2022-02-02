-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-02-02 02:30:28
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

--
-- テーブルのデータのダンプ `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `postcode`, `prefecture`, `city`, `chomei`, `building`, `room_number`) VALUES
(1, 2, 1234567, '愛知県', '名古屋市山田区太郎', '30丁目30-3', '太郎ビルディング', '500号室'),
(4, 3, 9876543, '愛知県', '名古屋市花子区', '30丁目30-3', '', '');

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
-- テーブルの構造 `deliveries`
--

CREATE TABLE `deliveries` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `start` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `deliveries`
--

INSERT INTO `deliveries` (`id`, `transaction_id`, `start`) VALUES
(1, 3, '2022-02-02 01:25:53'),
(2, 4, '2022-02-02 01:26:26');

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

--
-- テーブルのデータのダンプ `payments`
--

INSERT INTO `payments` (`id`, `transaction_id`, `method`, `status`, `completion_date`) VALUES
(1, 2, 0, 0, '2022-02-02 01:23:18'),
(2, 3, 0, 0, '2022-02-02 01:24:31'),
(3, 4, 0, 0, '2022-02-02 01:25:23'),
(4, 5, 0, 0, '2022-02-02 01:27:47');

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
(1, 1, '2022-02-02-02-08-55-0.png'),
(2, 1, '2022-02-02-02-08-55-1.png'),
(3, 2, '2022-02-02-02-09-35-0.png'),
(4, 2, '2022-02-02-02-09-35-1.png'),
(5, 3, '2022-02-02-02-12-20-0.png'),
(6, 4, '2022-02-02-02-14-11-0.png'),
(7, 5, '2022-02-02-02-16-57-0.png'),
(8, 6, '2022-02-02-02-17-43-0.png'),
(9, 6, '2022-02-02-02-17-44-1.png'),
(10, 7, '2022-02-02-02-18-35-0.png'),
(11, 8, '2022-02-02-02-19-24-0.png'),
(12, 9, '2022-02-02-02-20-05-0.png');

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
(1, 'アップリカ', 150000, 'ベビーカーです。', 1, '2022-02-02 01:09:00', 1),
(2, 'エアバギー', 160000, 'エアバギーのベビーカーです', 1, '2022-02-02 01:09:38', 1),
(3, '女の子靴 スニーカー', 5000, 'HAYAHARUのスニーカーです', 0, '2022-02-02 01:12:22', 2),
(4, '男の子靴 スニーカー', 40005, 'Championのスニーカーです', 1, '2022-02-02 01:14:13', 2),
(5, 'コンビ ステップアップセット', 4000, '食器です', 1, '2022-02-02 01:17:01', 3),
(6, 'コンビ  食器セット', 10000, 'コンビのナビゲート食器セットと離乳調理食器のセットです。', 0, '2022-02-02 01:17:46', 3),
(7, 'アウター ダウン', 4000, 'northFaceのダウンです', 1, '2022-02-02 01:18:37', 3),
(8, 'H&M サンタクローストップス', 3500, 'サンタクロースの絵柄が描かれたトップスです。', 0, '2022-02-02 01:19:26', 3),
(9, 'H&M 薄手デニム', 3000, '薄手のデニムです。', 0, '2022-02-02 01:20:08', 3);

-- --------------------------------------------------------

--
-- テーブルの構造 `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `purchase_date` timestamp NULL DEFAULT current_timestamp(),
  `completion_date` timestamp NULL DEFAULT NULL,
  `status` int(3) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `transactions`
--

INSERT INTO `transactions` (`id`, `product_id`, `user_id`, `purchase_date`, `completion_date`, `status`) VALUES
(1, 1, 2, '2022-02-02 01:21:34', NULL, 0),
(2, 2, 2, '2022-02-02 01:22:04', NULL, 1),
(3, 5, 2, '2022-02-02 01:23:48', NULL, 2),
(4, 7, 2, '2022-02-02 01:25:21', NULL, 4),
(5, 4, 3, '2022-02-02 01:26:41', NULL, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `transfers`
--

CREATE TABLE `transfers` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `transfers`
--

INSERT INTO `transfers` (`id`, `transaction_id`, `amount`, `date`) VALUES
(1, 4, 3600, '2022-02-02 01:29:07');

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
(1, 'goku', '$2y$10$pYw2JPiFQtrv1qpS5Lc9UenBzY8DX71aB5haoVPYgkh.3wK6pJ7Qu', '孫悟空', 'goku@example.com'),
(2, 'nakamura', '$2y$10$1DOdNIMuJYMQljN5ZTkHQuenUq0PN6rlw2c.PgACygVRkJgToNh5e', 'ナカムラ', 'nakamura@example.com'),
(3, 'test', '$2y$10$sMR8x1yNxFJVPdwM5C3D8uNxTK5TDfBG5epaAhzL3417JYSazZpfy', '手素徒労', 'test@example.com');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
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
-- テーブルのインデックス `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f_transaction_id` (`transaction_id`);

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
  ADD KEY `transactions_product_id` (`product_id`),
  ADD KEY `transactions_user_id` (`user_id`);

--
-- テーブルのインデックス `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transfer_transaction_id` (`transaction_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- テーブルの AUTO_INCREMENT `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- テーブルの AUTO_INCREMENT `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- テーブルの AUTO_INCREMENT `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- テーブルの AUTO_INCREMENT `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- テーブルの AUTO_INCREMENT `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- テーブルの制約 `deliveries`
--
ALTER TABLE `deliveries`
  ADD CONSTRAINT `f_transaction_id` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`);

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
  ADD CONSTRAINT `transactions_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `transactions_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- テーブルの制約 `transfers`
--
ALTER TABLE `transfers`
  ADD CONSTRAINT `transfer_transaction_id` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
