--
--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+09:00";

--
-- Database: `ideaStorager`
--

-- --------------------------------------------------------

--
-- Table structure for table `tweets`
--

CREATE TABLE `tweets` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `tweet` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
    `created_at` datetime DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tweets` (`id`, `tweet`, `created_at`) VALUES
(1, 'アイデアが保存できたらなあ', '2022-10-31 00:00:00'),
(2, '引っ越し作業もっと簡単にならないかなあ', '2022-10-31 04:00:00');

-- --------------------------------------------------------

