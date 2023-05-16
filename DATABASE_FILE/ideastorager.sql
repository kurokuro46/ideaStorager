-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2023-05-17 00:12:12
-- サーバのバージョン： 10.4.24-MariaDB
-- PHP のバージョン: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `ideastorager`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `postidea`
--

CREATE TABLE `postidea` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `body` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imgPost` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default_post.jpg',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `postidea`
--

INSERT INTO `postidea` (`id`, `user_id`, `title`, `body`, `imgPost`, `created_at`) VALUES
(1, 1, 'アイデアの再利用！', 'アイデアを気軽に投稿し、保存する。そして、次のアイデアにつなげるシステム。', 'default_post.jpg', '2023-05-02 02:23:21'),
(4, 1, '置き忘れ・盗難を防ぐ傘立て', 'アプリと傘立てを連携し、傘の場所をアプリで確認できる。', 'post-644ff7949cd9f.PNG', '2023-05-02 02:32:04'),
(5, 1, 'AIでは書けない、新しい履歴書', 'AIが履歴書を書くよいになり、履歴書の信用性がない。そこで、どんなイベントに参加したか、どのようなスキルを持っているかを管理するシステムを考えた。', 'post-644ff877cb67a.PNG', '2023-05-02 02:35:51'),
(9, 1, 'アイデア', '文', 'default_post.jpg', '2023-05-11 05:15:50');

-- --------------------------------------------------------

--
-- テーブルの構造 `postprob`
--

CREATE TABLE `postprob` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `body` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imgPost` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default_post.jpg',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `postprob`
--

INSERT INTO `postprob` (`id`, `user_id`, `title`, `body`, `imgPost`, `created_at`) VALUES
(1, 1, 'アイデアが消えている！', 'アイデアソンなどで出た、一部のアイデアが使われなくそのまま消えている。', 'default_post.jpg', '2023-05-02 02:23:21'),
(7, 4, '食料自給率が上がらず横ばい', 'このままでは目標に達しない', 'post-prob-645bee1919059.png', '2023-05-11 04:18:49'),
(8, 1, 'タイトル', '本文', 'default_post.jpg', '2023-05-11 05:11:09');

-- --------------------------------------------------------

--
-- テーブルの構造 `tweets`
--

CREATE TABLE `tweets` (
  `id` int(11) NOT NULL,
  `tweet` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `tweets`
--

INSERT INTO `tweets` (`id`, `tweet`, `created_at`) VALUES
(1, 'アイデアが保存できたらなあ', '2022-10-31 00:00:00'),
(2, '引っ越し作業もっと簡単にならないかなあ', '2022-10-31 04:00:00'),
(4, '雨の日が楽しくなるシステムないかなあ', '2022-11-04 14:39:22'),
(5, 'テスト', '2022-11-04 14:40:59'),
(9, 'こんちにわ', '2023-02-24 17:16:15'),
(11, '履歴書簡単にならないかな', '2023-05-02 02:50:56'),
(12, '日本の人口を増やすには？', '2023-05-02 02:51:35'),
(13, 'アイデアを再利用したい', '2023-05-02 02:52:29');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `imgProfile` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `bio` varchar(140) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `name`, `imgProfile`, `bio`) VALUES
(1, 'nametsst', 'test@gmail.com', 'pass', 'くろくろ', 'user-64503908a9423.jpg', 'こんにちは！アイデアを共有するwebアプリケーションを作成してみました。'),
(3, 'test2', 'test2@gmail.com', 'pass', 'test2', 'default.jpg', '自己紹介します！'),
(4, 'oniku', 'oniku@gmail.com', 'pass', 'oniku', 'default.jpg', '');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `postidea`
--
ALTER TABLE `postidea`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `user_id` (`user_id`);

--
-- テーブルのインデックス `postprob`
--
ALTER TABLE `postprob`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `user_id` (`user_id`);

--
-- テーブルのインデックス `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `postidea`
--
ALTER TABLE `postidea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- テーブルの AUTO_INCREMENT `postprob`
--
ALTER TABLE `postprob`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- テーブルの AUTO_INCREMENT `tweets`
--
ALTER TABLE `tweets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
