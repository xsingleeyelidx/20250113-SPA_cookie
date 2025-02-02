-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2025-01-13 09:33:09
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `testdb`
--

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `ID` int(11) NOT NULL COMMENT '會員編號',
  `Username` varchar(32) NOT NULL COMMENT '會員帳號',
  `Password` varchar(128) NOT NULL COMMENT '會員密碼',
  `Email` varchar(32) NOT NULL COMMENT '會員信箱',
  `Uid01` varchar(32) NOT NULL COMMENT '金鑰',
  `Level` int(8) NOT NULL DEFAULT 0 COMMENT '會員等級\r\n0：一般會員\r\n20：銅牌會員\r\n50：銀牌會員\r\n100：金牌會員',
  `Create_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '註冊時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`ID`, `Username`, `Password`, `Email`, `Uid01`, `Level`, `Create_at`) VALUES
(1, 'Champion', '5566', 'abc@gmail.com', '', 0, '2024-12-30 01:27:20'),
(4, '88888888', '$2y$10$3dR1fAFNNHwgEUg7r1csEuOBCj.Dl/aqf11aR2NbzZ9e1vMTEsLHq', '88888888', 'a24a5eaff0', 0, '2024-12-30 08:24:30');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`ID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member`
--
ALTER TABLE `member`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '會員編號', AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
