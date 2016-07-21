-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        5.6.24 - MySQL Community Server (GPL)
-- 服务器操作系统:                      Win32
-- HeidiSQL 版本:                  9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 导出 binggq 的数据库结构
CREATE DATABASE IF NOT EXISTS `binggq` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `binggq`;


-- 导出  表 binggq.scale 结构
CREATE TABLE IF NOT EXISTS `scale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='融资规模';

-- 正在导出表  binggq.scale 的数据：~2 rows (大约)
DELETE FROM `scale`;
/*!40000 ALTER TABLE `scale` DISABLE KEYS */;
INSERT INTO `scale` (`id`, `name`) VALUES
	(1, '100人'),
	(2, '200人');
/*!40000 ALTER TABLE `scale` ENABLE KEYS */;


-- 导出  表 binggq.stage 结构
CREATE TABLE IF NOT EXISTS `stage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='融资阶段';

-- 正在导出表  binggq.stage 的数据：~4 rows (大约)
DELETE FROM `stage`;
/*!40000 ALTER TABLE `stage` DISABLE KEYS */;
INSERT INTO `stage` (`id`, `name`) VALUES
	(1, '天使轮'),
	(2, 'A轮'),
	(3, 'B轮'),
	(4, 'C轮');
/*!40000 ALTER TABLE `stage` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
