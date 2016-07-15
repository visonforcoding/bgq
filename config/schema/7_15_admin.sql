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

-- 导出  表 binggq.admin 结构
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `truename` varchar(50) NOT NULL COMMENT '真实姓名',
  `password` varchar(150) NOT NULL COMMENT '密码',
  `phone` varchar(20) NOT NULL COMMENT '手机号',
  `enabled` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1启用0禁用',
  `ctime` datetime DEFAULT NULL COMMENT '创建时间',
  `utime` datetime DEFAULT NULL COMMENT '修改时间',
  `login_time` datetime DEFAULT NULL COMMENT '登录时间',
  `login_ip` varchar(50) DEFAULT NULL COMMENT '登录ip',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='管理员表';

-- 正在导出表  binggq.admin 的数据：~5 rows (大约)
DELETE FROM `admin`;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `username`, `truename`, `password`, `phone`, `enabled`, `ctime`, `utime`, `login_time`, `login_ip`) VALUES
	(2, 'admin', '曹麦穗', '$2y$10$IwMcx3dYp7Sn.TPgovzc9Osem.XpMAdajZ1C.Z8y41LHcdcJUpCRy', '', 1, '2016-04-11 16:53:37', '2016-07-15 10:42:54', '2016-07-15 10:42:54', '127.0.0.1'),
	(3, '小玲', '江燕玲', '$2y$10$N5wuytgrX1DlehKar8fHSOc6JFKFgBfLXLzKCnkPDskiBlOKcraQa', '', 1, '2016-07-13 18:28:05', '2016-07-13 18:28:05', NULL, NULL),
	(4, '小美', '', '$2y$10$s6jfMZA7tvmo4.popIGwuOZAWgWB6waU8gcMUdZpr6w3TDo1cW0tu', '', 1, '2016-07-13 18:31:41', '2016-07-13 18:31:41', NULL, NULL),
	(5, 'admin_test', '', '$2y$10$BOdCuLFMu5mQgNU4nPcRGumR/fCggCdHnlLo7TkfM0PNgy09hcRCC', '', 1, '2016-07-14 20:30:06', '2016-07-14 20:30:06', NULL, NULL),
	(6, 'admin1', '', '$2y$10$PurFYv9bjS.C7lRa9akM2.BvNmOxJyZzY0QMOtEMeJhEX6L79ycoa', '', 1, '2016-07-14 20:30:16', '2016-07-14 21:56:14', '2016-07-14 21:56:14', '127.0.0.1');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
