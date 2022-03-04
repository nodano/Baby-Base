-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-03-04 01:58:20
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
(4, 3, 9876543, '愛知県', '名古屋市花子区', '30丁目30-3', '', ''),
(6, 4, 1234567, '愛知県', '名古屋市花子区', '30丁目30-3', '', ''),
(8, 5, 1234567, '愛知県', '名古屋市山田区太郎', '30丁目30-3', 'ふぁふぁ', '302号室'),
(10, 7, 1234567, '愛知県', '名古屋市山田区太郎', '30丁目30-3', '', ''),
(11, 8, 1234567, '愛知県', '名古屋市山田区太郎', '30丁目30-3', 'ふぁふぁ', '302号室');

-- --------------------------------------------------------

--
-- テーブルの構造 `block`
--

CREATE TABLE `block` (
  `id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `block`
--

INSERT INTO `block` (`id`, `from_user_id`, `to_user_id`) VALUES
(8, 2, 4),
(9, 8, 2),
(10, 2, 8);

-- --------------------------------------------------------

--
-- テーブルの構造 `blocks`
--

CREATE TABLE `blocks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `target_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `blocks`
--

INSERT INTO `blocks` (`id`, `user_id`, `target_user_id`) VALUES
(4, 2, 1),
(5, 2, 3);

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
(2, 4, '2022-02-02 01:26:26'),
(3, 6, '2022-02-17 07:43:15'),
(4, 2, '2025-02-13 09:37:02'),
(5, 8, '2022-02-01 10:00:28'),
(6, 11, '2022-02-01 09:34:09'),
(7, 13, '2022-02-17 07:27:53'),
(8, 14, '2022-03-01 01:39:34'),
(9, 15, '2022-03-02 09:42:36');

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
(2, 7, 10);

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
(4, 5, 0, 0, '2022-02-02 01:27:47'),
(5, 6, 0, 0, '2022-02-17 09:40:53'),
(6, 8, 0, 0, '2022-02-24 10:00:01'),
(7, 9, 0, 0, '2022-02-25 05:17:01'),
(8, 11, 0, 0, '2022-02-25 09:33:47'),
(9, 13, 0, 0, '2022-02-28 06:27:20'),
(10, 14, 0, 0, '2022-03-02 01:38:58'),
(11, 15, 0, 0, '2022-03-03 09:42:15');

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
(12, 9, '2022-02-02-02-20-05-0.png'),
(13, 10, '2022-02-18-10-14-10-0.png'),
(14, 11, '2022-02-24-10-52-44-0.png'),
(15, 11, '2022-02-24-10-52-44-1.png'),
(16, 12, '2022-02-24-10-59-27-0.png'),
(17, 13, '2022-02-24-11-00-44-0.png'),
(18, 14, '2022-02-25-05-35-44-0.png'),
(19, 14, '2022-02-25-05-35-44-1.png'),
(20, 15, '2022-02-25-05-52-49-0.png'),
(21, 16, '2022-02-25-05-53-49-0.png'),
(22, 16, '2022-02-25-05-53-49-1.png'),
(23, 17, '2022-02-25-10-32-59-0.png'),
(24, 17, '2022-02-25-10-32-59-1.png'),
(25, 18, '2022-02-26-06-52-28-0.png'),
(26, 18, '2022-02-26-06-52-28-1.png'),
(27, 18, '2022-02-26-06-52-28-2.png'),
(28, 18, '2022-02-26-06-52-28-3.png'),
(29, 18, '2022-02-26-06-52-28-4.png'),
(30, 19, '2022-02-28-07-21-21-0.png'),
(31, 19, '2022-02-28-07-21-21-1.png'),
(32, 19, '2022-02-28-07-21-22-2.png'),
(33, 19, '2022-02-28-07-21-22-3.png'),
(34, 19, '2022-02-28-07-21-22-4.png'),
(35, 20, '2022-03-02-02-37-47-0.png'),
(36, 20, '2022-03-02-02-37-47-1.png'),
(37, 20, '2022-03-02-02-37-47-2.png'),
(38, 20, '2022-03-02-02-37-47-3.png'),
(39, 20, '2022-03-02-02-37-47-4.png'),
(40, 21, '2022-03-02-03-06-41-0.png'),
(41, 22, '2022-03-03-10-40-53-0.png'),
(42, 22, '2022-03-03-10-40-53-1.png'),
(43, 22, '2022-03-03-10-40-54-2.png'),
(44, 22, '2022-03-03-10-40-54-3.png'),
(45, 22, '2022-03-03-10-40-54-4.png');

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
(3, '女の子靴 HAYAHARUスニーカー', 50000, 'HAYAHARU\r\nスニーカーです', 0, '2022-02-02 01:12:22', 2),
(4, '男の子靴 スニーカー', 40005, 'Championのスニーカーです', 1, '2022-02-02 01:14:13', 2),
(5, 'コンビ ステップアップセット', 4000, '食器です', 1, '2022-02-02 01:17:01', 3),
(6, 'コンビ  食器セット', 10000, 'コンビのナビゲート食器セットと離乳調理食器のセットです。', 1, '2022-02-02 01:17:46', 3),
(7, 'アウター ダウン', 4000, 'northFaceのダウンです', 1, '2022-02-02 01:18:37', 3),
(8, 'H&amp;サンタクローストップス', 35009, 'サンタクロースの絵柄が描かれたトップスです。', 0, '2022-02-02 01:19:26', 3),
(9, 'H&M 薄手デニム', 3000, '薄手のデニムです。', 1, '2022-02-02 01:20:08', 3),
(10, 'ベル', 100000, 'test商品', 0, '2022-02-18 09:14:19', 2),
(11, 'テスト商品', 2000, '商品', 1, '2022-02-24 09:53:44', 1),
(12, 'テスト商品222', 22222, 'test', 0, '2022-02-24 09:59:31', 4),
(13, 'テスト商品3', 333, 'test', 1, '2022-02-24 10:00:46', 1),
(14, 'test', 2000, 'テスト', 1, '2022-02-25 04:39:42', 1),
(15, 'っ風景', 300, '風景です', 1, '2022-02-25 04:53:18', 3),
(16, 'tetette', 3000, 'テスト商品', 1, '2022-02-25 04:53:57', 3),
(17, 'テスト商品', 300, 'test', 1, '2022-02-25 09:33:03', 5),
(18, 'テスト商品', 3333, 'tete', 0, '2022-02-26 05:52:32', 2),
(19, 'テスト商品test', 333, 'test\r\n\r\nte', 1, '2022-02-28 06:21:27', 2),
(20, 'テストの商品', 30000, 'テスト商品です', 1, '2022-03-02 01:37:53', 7),
(21, 'tes', 222, 'tete', 1, '2022-03-02 02:06:42', 1),
(22, 'test3', 4001, 'test', 1, '2022-03-03 09:41:06', 8);

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
(2, 2, 2, '2022-02-02 01:22:04', NULL, 2),
(3, 5, 2, '2022-02-02 01:23:48', NULL, 3),
(4, 7, 2, '2022-02-02 01:25:21', NULL, 4),
(5, 4, 3, '2022-02-02 01:26:41', NULL, 1),
(6, 9, 2, '2022-02-17 09:40:49', NULL, 4),
(7, 6, 1, '2022-02-17 10:31:20', NULL, 0),
(8, 11, 4, '2022-02-24 09:59:56', NULL, 4),
(9, 14, 4, '2022-02-25 05:16:27', NULL, 1),
(10, 13, 4, '2022-02-25 05:17:13', NULL, 0),
(11, 15, 5, '2022-02-25 09:33:19', NULL, 4),
(12, 17, 2, '2022-02-25 10:12:28', NULL, 0),
(13, 16, 2, '2022-02-28 06:27:18', NULL, 4),
(14, 19, 7, '2022-03-02 01:38:19', NULL, 4),
(15, 21, 8, '2022-03-03 09:41:51', NULL, 4),
(16, 22, 1, '2022-03-03 09:43:58', NULL, 0),
(17, 20, 8, '2022-03-03 09:44:33', NULL, 0);

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
(1, 4, 3600, '2022-02-02 01:29:07'),
(2, 6, 2700, '2022-02-17 09:45:12'),
(3, 8, 1800, '2022-02-24 10:01:31'),
(4, 11, 270, '2022-02-25 09:35:02'),
(5, 13, 2700, '2022-02-28 06:29:59'),
(6, 14, 300, '2022-03-02 01:40:16'),
(7, 15, 200, '2022-03-03 09:43:10');

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
(3, 'test', '$2y$10$sMR8x1yNxFJVPdwM5C3D8uNxTK5TDfBG5epaAhzL3417JYSazZpfy', '手素徒労', 'test@example.com'),
(4, 'test2', '$2y$10$tswGz.MPFhE3lgRecKGX7u/rdej5bXABMWHAUL2VLNNPWDRv.ggDG', '中村律希', 'test2@example.com'),
(5, 'ritsuki1', '$2y$10$yyeDK7zPZg78kay3hUN3Vu5gQ6VVPVLdd1CRC1I8rYZqi/Q8LkjRq', '中村律希', 'ritsuki@gmail.com'),
(6, 'hoge', '$2y$10$uJ6q0R5Ff7AcDmxaIz3x9.Aj1K1iMV1uRZci.Rt5SvHn/UatEnBTa', '中村律希', 'hoge@example.com'),
(7, 'test100', '$2y$10$GbYf8Frm737KkoST7Ka.NuMVLwzp8oa8P5zJNlgc0VK1XpB8W/lB.', '中村律希', 'test100@example.com'),
(8, 'test5', '$2y$10$3W56GtgIhecTGY27Nx2DvO0S50.AlWF0bvMV4TuAcBiNMweXCAKj6', '中村律希', 'test5@example.com');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- テーブルの AUTO_INCREMENT `block`
--
ALTER TABLE `block`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- テーブルの AUTO_INCREMENT `blocks`
--
ALTER TABLE `blocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- テーブルの AUTO_INCREMENT `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- テーブルの AUTO_INCREMENT `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- テーブルの AUTO_INCREMENT `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- テーブルの AUTO_INCREMENT `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- テーブルの AUTO_INCREMENT `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
