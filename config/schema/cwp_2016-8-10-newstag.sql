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

-- 导出  表 binggq.newstag 结构
CREATE TABLE IF NOT EXISTS `newstag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='资讯标签';

-- 正在导出表  binggq.newstag 的数据：~14 rows (大约)
DELETE FROM `newstag`;
/*!40000 ALTER TABLE `newstag` DISABLE KEYS */;
INSERT INTO `newstag` (`id`, `name`) VALUES
	(1, '并购交易'),
	(2, '并购热点'),
	(3, '并购基金'),
	(4, '并购重组'),
	(5, '并购融资'),
	(6, '并购干货'),
	(7, '海外并购'),
	(8, '并购活动'),
	(9, '并购连线'),
	(10, '并购培训'),
	(11, '并购周报'),
	(12, '产业并购'),
	(13, '并购战略'),
	(14, '并购整合');
/*!40000 ALTER TABLE `newstag` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
