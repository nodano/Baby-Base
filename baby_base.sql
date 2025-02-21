-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-03-04 02:38:27
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
-- テーブルの構造 `block`
--

CREATE TABLE `block` (
  `id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `blocks`
--

CREATE TABLE `blocks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `target_user_id` int(11) NOT NULL
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

-- --------------------------------------------------------

--
-- テーブルの構造 `favorite`
--

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `favorite`
--

INSERT INTO `favorite` (`id`, `user_id`, `products_id`) VALUES
(1, 3, 5);

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
(1, 1, '2022-03-04-02-27-55-0.png'),
(2, 1, '2022-03-04-02-27-55-1.png'),
(3, 1, '2022-03-04-02-27-55-2.png'),
(4, 1, '2022-03-04-02-27-55-3.png'),
(5, 2, '2022-03-04-02-28-53-0.png'),
(6, 3, '2022-03-04-02-29-52-0.png'),
(7, 3, '2022-03-04-02-29-52-1.png'),
(8, 4, '2022-03-04-02-30-55-0.png'),
(9, 5, '2022-03-04-02-31-31-0.png'),
(10, 6, '2022-03-04-02-33-29-0.png'),
(11, 7, '2022-03-04-02-34-24-0.png'),
(12, 8, '2022-03-04-02-35-32-0.png'),
(13, 9, '2022-03-04-02-37-07-0.png'),
(14, 9, '2022-03-04-02-37-07-1.png'),
(15, 9, '2022-03-04-02-37-07-2.png');

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
(1, 'アップリカ スムーヴプレミアム', 50000, 'アップリカのスムーブプレミアムです。', 1, '2022-03-04 01:28:02', 1),
(2, 'アップリカ クルリー', 25000, 'アップリカのベビーカーです。', 1, '2022-03-04 01:28:54', 1),
(3, 'アップリカ スムーヴ AD', 15000, 'アップリカのスムーブADです。\r\nとても良い品です。', 0, '2022-03-04 01:29:55', 1),
(4, 'Combi チャイルドシート', 5000, 'Combiのチャイルドシートです。', 0, '2022-03-04 01:30:57', 2),
(5, 'エルゴ 抱っこひも', 1000, 'エルゴの抱っこひもです', 1, '2022-03-04 01:31:34', 2),
(6, 'HAYAHARU ファーストシューズ', 700, '女の子用のファーストシューズです。', 0, '2022-03-04 01:33:31', 3),
(7, '赤ちゃん本舗 デニムネイビー', 850, '赤ちゃん本舗の男の子靴です。', 1, '2022-03-04 01:34:25', 3),
(8, 'クロックス', 900, '男の子用のクロックスです。', 0, '2022-03-04 01:35:33', 4),
(9, 'ピジョン 哺乳瓶', 1500, 'ピジョンの哺乳瓶です。', 0, '2022-03-04 01:37:10', 5);

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
(1, 1, 2, '2022-03-04 01:31:50', NULL, 0),
(2, 5, 3, '2022-03-04 01:34:34', NULL, 0),
(3, 7, 4, '2022-03-04 01:35:43', NULL, 0),
(4, 2, 5, '2022-03-04 01:37:24', NULL, 0);

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
(1, 'bassa', '$2y$10$.iJo0mw.dpG8Kq8QweOPxulEn5qQxudpo6wT39GVoUI9BRFAILQiG', '中村律希', 'bassa@example.com'),
(2, 'ikema', '$2y$10$5Xzs/5qXzOf7r9bx/6uQo.WH.l4exoITw5B1FBbI6Wq/ANIhXM0YO', '中村律希', 'ikema@example.com'),
(3, 'nodano', '$2y$10$y5WJjbzqtnNaPF0Zs0ovXONDHPAyFD/o7sFRMpXnw.JnWI5nlJi8y', '中村律希', 'nodano@example.com'),
(4, 'watanabe', '$2y$10$/bVGm4qEc3Va.aFzG3YvU.S12WCJCfkdREG6hgF/vonMx1kgb9yL.', '中村律希', 'watanabe@example.com'),
(5, 'chambers', '$2y$10$aEZkDANKSAiS7l1GAZURZuv.0g37/4v4iNhL6Y1DPtDcMv9Tgu/Dy', '中村律希', 'chambers@example.com');

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
-- テーブルのインデックス `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ref_blocks_user_id` (`user_id`),
  ADD KEY `ref_blocks_target_user_id` (`target_user_id`);

--
-- テーブルのインデックス `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f_transaction_id` (`transaction_id`);

--
-- テーブルのインデックス `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ref` (`products_id`),
  ADD KEY `ref_user_id` (`user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `block`
--
ALTER TABLE `block`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `blocks`
--
ALTER TABLE `blocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- テーブルの AUTO_INCREMENT `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- テーブルの AUTO_INCREMENT `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- テーブルの AUTO_INCREMENT `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `address_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- テーブルの制約 `blocks`
--
ALTER TABLE `blocks`
  ADD CONSTRAINT `ref_blocks_target_user_id` FOREIGN KEY (`target_user_id`) REFERENCES `users` (`id`);

--
-- テーブルの制約 `deliveries`
--
ALTER TABLE `deliveries`
  ADD CONSTRAINT `f_transaction_id` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`);

--
-- テーブルの制約 `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `ref` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `ref_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
