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

-- 导出  表 binggq.actionlog 结构
CREATE TABLE IF NOT EXISTS `actionlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键，自增',
  `url` varchar(1000) NOT NULL COMMENT '请求地址',
  `type` varchar(50) NOT NULL COMMENT '请求类型',
  `useragent` varchar(1000) NOT NULL COMMENT '浏览器信息',
  `ip` varchar(80) NOT NULL COMMENT '客户端IP',
  `filename` varchar(250) NOT NULL COMMENT '脚本名称',
  `msg` varchar(150) NOT NULL COMMENT '日志内容',
  `controller` varchar(50) NOT NULL COMMENT '控制器',
  `action` varchar(50) NOT NULL COMMENT '动作',
  `param` varchar(1000) NOT NULL COMMENT '请求参数',
  `user` varchar(80) NOT NULL COMMENT '操作者',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=211 DEFAULT CHARSET=utf8 CHECKSUM=1 ROW_FORMAT=DYNAMIC COMMENT='后台操作日志表';

-- 正在导出表  binggq.actionlog 的数据：~129 rows (大约)
DELETE FROM `actionlog`;
/*!40000 ALTER TABLE `actionlog` DISABLE KEYS */;
INSERT INTO `actionlog` (`id`, `url`, `type`, `useragent`, `ip`, `filename`, `msg`, `controller`, `action`, `param`, `user`, `create_time`) VALUES
	(1, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', '', '', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-04-20 15:48:49'),
	(2, 'admin/news/edit/4', 'PUT', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '修改', 'news', 'edit', 'array (\n  \'title\' => \'这才是国内八月最值得去的12个旅行天堂！别去错了！\',\n  \'cover\' => \'/upload/newscover/2016-04-20/5717016f566af.jpg\',\n  \'summary\' => \'稻城亚丁的三神山由金刚手菩萨。三座山峰终年白雪皑皑，遥相呼应，直逼云天，慑人心魄据佛教的典籍圣地咱日秘相记载，世界佛教二十四神山，属相是鸡属众生供奉朝神\',\n  \'body\' => \'<p>&nbsp;&nbsp; &nbsp; &nbsp;\r\n\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; <br/></p><p><br/></p><section data-id="85616" class="135editor" style="white-space: normal; margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; color: rgb(62, 62, 62); line-height: 25px; background-color: rgb(255, 255, 255); border: 0px none; font-family: 微软雅黑; word-wrap: break-word !important;"><section style="margin: 0px; padding: 10px; max-width: 100%; box-sizing: border-box; word-wrap: break-word; line-height: 2em; word-break: normal; text-align: center; background-color: rgb(12, 137, 24); color: rgb(255, 255, 255); border-color: rgb(45, 206, 60);"><strong style="', 'admin', '2016-04-20 17:10:00'),
	(3, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-04-21 09:44:42'),
	(4, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-04-21 10:38:44'),
	(5, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-04-21 10:47:13'),
	(6, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-04-21 10:48:28'),
	(7, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-04-21 11:21:39'),
	(8, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-04-21 11:24:58'),
	(9, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-04-21 11:25:43'),
	(10, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-04-21 11:38:16'),
	(11, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-04-21 12:03:57'),
	(12, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-04-21 12:04:32'),
	(13, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-04-21 12:04:56'),
	(14, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-04-22 11:05:58'),
	(15, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-04-22 12:09:45'),
	(16, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-04-25 10:43:20'),
	(17, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-04-26 09:59:32'),
	(18, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-04-27 16:57:18'),
	(19, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-05-03 14:48:27'),
	(20, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-05-03 15:28:30'),
	(21, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-05-05 11:32:12'),
	(22, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-05-10 10:51:36'),
	(23, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-05-10 15:44:01'),
	(24, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-05-10 17:02:49'),
	(25, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-05-12 16:02:34'),
	(26, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-05-13 09:33:46'),
	(27, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-05-13 09:58:29'),
	(28, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-05-13 10:33:29'),
	(29, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-05-19 15:25:18'),
	(30, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-05-20 11:46:25'),
	(31, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-05-24 14:30:27'),
	(32, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '27.38.97.247', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-07 10:56:41'),
	(33, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '27.38.97.247', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-07 11:58:33'),
	(34, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '27.38.97.247', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-07 15:51:04'),
	(35, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '27.38.97.247', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-07 16:45:57'),
	(36, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '27.38.97.247', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-07 17:00:15'),
	(37, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '27.38.97.247', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-07 17:13:37'),
	(38, 'admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '27.38.97.247', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-07 18:24:06'),
	(39, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '113.87.213.147', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-07 20:17:56'),
	(40, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '163.125.252.133', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-08 17:05:27'),
	(41, 'admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '58.251.235.86', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-13 14:38:23'),
	(42, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '58.251.235.86', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-14 10:43:06'),
	(43, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-16 14:31:12'),
	(44, 'admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '163.125.72.101', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-20 18:33:13'),
	(45, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '58.251.232.109', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-21 15:44:24'),
	(46, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '58.251.232.109', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-21 17:11:25'),
	(47, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '58.251.232.109', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-22 09:37:07'),
	(48, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '58.251.232.109', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-22 11:09:09'),
	(49, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '58.251.231.143', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-22 15:02:53'),
	(50, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '58.251.231.143', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-22 17:47:48'),
	(51, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '58.251.231.143', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-23 10:16:32'),
	(52, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '58.251.231.143', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-23 11:35:49'),
	(53, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '58.251.231.143', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-23 16:04:24'),
	(54, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '58.251.231.143', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-23 16:46:57'),
	(55, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '58.251.231.143', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-23 18:33:17'),
	(56, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '27.38.140.216', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-24 16:30:12'),
	(57, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '27.38.140.216', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-24 19:51:25'),
	(58, 'admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '27.38.140.216', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-24 20:12:04'),
	(59, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '27.38.140.216', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-24 21:28:36'),
	(60, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '58.251.233.229', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-25 14:54:52'),
	(61, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.93 Safari/537.36', '58.251.233.229', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n  \'_remember_me\' => \'on\',\n)', 'admin', '2016-06-25 15:29:42'),
	(62, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '58.251.233.229', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-25 16:47:38'),
	(63, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '58.251.233.229', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-25 18:45:23'),
	(64, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.93 Safari/537.36', '58.251.233.229', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-25 19:34:24'),
	(65, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '58.251.233.229', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-25 19:39:31'),
	(66, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.93 Safari/537.36', '58.251.233.229', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-25 20:20:51'),
	(67, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '58.251.233.229', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-25 20:40:50'),
	(68, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '58.251.233.229', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-25 21:07:04'),
	(69, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36', '27.38.41.59', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-27 16:04:35'),
	(70, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36', '27.38.41.125', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-27 16:42:24'),
	(71, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '27.38.41.123', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-27 16:56:38'),
	(72, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.106 Safari/537.36', '27.38.41.125', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-27 21:09:57'),
	(73, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '27.38.99.117', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-28 10:50:51'),
	(74, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '27.38.99.117', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-28 11:33:28'),
	(75, 'admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '27.38.99.117', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-28 18:02:14'),
	(76, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '27.38.99.117', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-28 18:04:39'),
	(77, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '27.38.99.117', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-28 18:13:21'),
	(78, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '27.38.99.117', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-28 18:55:18'),
	(79, 'admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '27.38.99.117', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-28 22:38:19'),
	(80, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '163.125.75.24', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-29 14:15:35'),
	(81, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '163.125.75.24', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-29 17:35:00'),
	(82, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '163.125.75.24', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-30 11:16:03'),
	(83, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.110 Safari/537.36', '114.116.197.131', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-03 13:07:31'),
	(84, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.110 Safari/537.36', '223.73.1.101', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-03 20:53:04'),
	(85, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '163.125.149.244', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-04 11:42:19'),
	(86, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '163.125.149.244', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-04 11:52:25'),
	(87, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', '163.125.149.244', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-04 11:59:49'),
	(88, 'admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '163.125.149.244', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-04 14:28:17'),
	(89, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', '163.125.149.244', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-04 16:58:02'),
	(90, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '163.125.149.244', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-04 18:28:05'),
	(91, 'admin/login', 'POST', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/49.0.2623.108 Chrome/49.0.2623.108 Safari/537.36', '163.125.149.244', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-04 20:10:25'),
	(92, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '163.125.149.244', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-04 20:52:30'),
	(93, 'admin/admin/login', 'POST', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/49.0.2623.108 Chrome/49.0.2623.108 Safari/537.36', '163.125.72.85', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-05 09:47:44'),
	(94, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', '163.125.72.85', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-05 10:31:49'),
	(95, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', '27.38.97.109', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-05 12:26:12'),
	(96, 'admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/601.6.17 (KHTML, like Gecko) Version/9.1.1 Safari/601.6.17', '27.38.97.109', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-05 14:24:30'),
	(97, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', '27.38.97.109', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-05 14:34:20'),
	(98, 'admin/login', 'POST', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_3_2 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Mobile/13F69', '117.136.79.165', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-05 14:40:46'),
	(99, 'admin/login', 'POST', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_3_2 like Mac OS X; zh-CN) AppleWebKit/537.51.1 (KHTML, like Gecko) Mobile/13F69 UCBrowser/10.9.17.807 Mobile', '117.136.79.165', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-05 14:42:11'),
	(100, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.10; rv:43.0) Gecko/20100101 Firefox/43.0', '27.38.97.109', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-05 15:50:35'),
	(101, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '27.38.97.109', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-05 16:06:30'),
	(102, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', '27.38.97.109', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-05 16:11:05'),
	(103, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.10; rv:43.0) Gecko/20100101 Firefox/43.0', '112.95.189.17', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-05 20:21:38'),
	(104, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/601.6.17 (KHTML, like Gecko) Version/9.1.1 Safari/601.6.17', '112.95.189.17', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-05 20:45:05'),
	(105, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '112.95.189.17', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-06 10:23:40'),
	(106, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '112.95.189.17', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-06 12:21:47'),
	(107, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '112.95.189.17', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-06 19:38:11'),
	(108, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/601.6.17 (KHTML, like Gecko) Version/9.1.1 Safari/601.6.17', '112.95.189.17', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-06 21:00:31'),
	(109, 'admin/login', 'POST', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:47.0) Gecko/20100101 Firefox/47.0', '58.251.229.156', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-07 10:07:52'),
	(110, 'admin/admin/login', 'POST', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/51.0.2704.79 Chrome/51.0.2704.79 Safari/537.36', '58.251.229.156', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-07 10:11:39'),
	(111, 'admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/601.6.17 (KHTML, like Gecko) Version/9.1.1 Safari/601.6.17', '58.251.229.156', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-07 10:32:39'),
	(112, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.93 Safari/537.36', '163.125.239.100', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-07 17:48:05'),
	(113, 'admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '163.125.239.100', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-07 18:08:14'),
	(114, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/601.6.17 (KHTML, like Gecko) Version/9.1.1 Safari/601.6.17', '163.125.239.100', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-07 19:02:11'),
	(115, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '163.125.239.100', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-07 19:09:28'),
	(116, 'admin/login', 'POST', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:47.0) Gecko/20100101 Firefox/47.0', '163.125.239.100', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-07 19:14:36'),
	(117, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.93 Safari/537.36', '163.125.239.100', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-08 09:24:25'),
	(118, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/601.6.17 (KHTML, like Gecko) Version/9.1.1 Safari/601.6.17', '163.125.239.100', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-08 10:11:00'),
	(119, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.93 Safari/537.36', '163.125.239.100', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-08 11:04:52'),
	(120, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '163.125.239.100', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-08 11:40:34'),
	(121, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '163.125.239.100', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-08 16:32:22'),
	(122, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/601.6.17 (KHTML, like Gecko) Version/9.1.1 Safari/601.6.17', '163.125.149.255', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-11 10:57:10'),
	(123, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '163.125.149.255', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-11 11:04:22'),
	(124, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/601.6.17 (KHTML, like Gecko) Version/9.1.1 Safari/601.6.17', '113.88.129.114', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-11 17:15:06'),
	(125, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '58.251.234.145', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-12 11:40:30'),
	(126, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/601.6.17 (KHTML, like Gecko) Version/9.1.1 Safari/601.6.17', '58.251.234.145', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-12 12:26:43'),
	(127, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.93 Safari/537.36', '58.251.234.145', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-12 15:04:02'),
	(128, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/601.6.17 (KHTML, like Gecko) Version/9.1.1 Safari/601.6.17', '58.251.234.145', '/data/www/eliteclub/plugins/Wpadmin/src/Controller/Component/UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-12 15:19:45'),
	(129, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-12 16:41:46'),
	(130, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-12 16:47:07'),
	(131, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-13 09:49:55'),
	(132, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-13 14:16:56'),
	(133, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-13 16:44:05'),
	(134, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-13 22:55:19'),
	(135, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-14 10:38:43'),
	(136, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-14 17:02:08'),
	(137, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-14 17:45:17'),
	(138, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-14 18:09:38'),
	(139, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin1\',\n  \'password\' => \'123456\',\n)', 'admin1', '2016-07-14 20:30:29'),
	(140, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-14 21:39:56'),
	(141, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-14 21:42:16'),
	(142, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin1\',\n  \'password\' => \'123456\',\n)', 'admin1', '2016-07-14 21:42:32'),
	(143, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-14 21:43:10'),
	(144, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin1\',\n  \'password\' => \'123456\',\n)', 'admin1', '2016-07-14 21:56:14'),
	(145, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-14 21:56:41'),
	(146, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-15 10:42:54'),
	(147, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-15 16:31:52'),
	(148, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-15 17:03:27'),
	(149, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-18 09:38:02'),
	(150, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-18 16:11:35'),
	(151, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-19 15:03:07'),
	(152, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-20 09:53:22'),
	(153, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-20 15:06:51'),
	(154, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-21 10:01:23'),
	(155, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'yueyunpeng\',\n  \'password\' => \'123456\',\n)', 'yueyunpeng', '2016-07-21 10:04:37'),
	(156, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-21 10:08:42'),
	(157, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'yueyunpeng\',\n  \'password\' => \'123456\',\n)', 'yueyunpeng', '2016-07-21 14:52:13'),
	(158, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-21 14:52:30'),
	(159, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'yueyunpeng\',\n  \'password\' => \'123456\',\n)', 'yueyunpeng', '2016-07-21 14:53:58'),
	(160, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-21 14:56:05'),
	(161, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'yueyunpeng\',\n  \'password\' => \'123456\',\n)', 'yueyunpeng', '2016-07-21 14:57:44'),
	(162, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'yueyunpeng\',\n  \'password\' => \'123456\',\n)', 'yueyunpeng', '2016-07-21 15:12:01'),
	(163, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-21 15:32:12'),
	(164, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-22 10:11:19'),
	(165, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-22 20:42:33'),
	(166, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-22 20:59:31'),
	(167, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-25 10:33:27'),
	(168, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-26 14:53:12'),
	(169, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-26 16:44:27'),
	(170, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-27 09:51:54'),
	(171, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-27 12:07:40'),
	(172, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-27 15:07:55'),
	(173, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-28 09:46:42'),
	(174, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-07-28 15:21:11'),
	(175, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-07-28 15:27:22'),
	(176, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-07-28 16:17:07'),
	(177, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-07-28 16:20:17'),
	(178, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-07-28 19:20:21'),
	(179, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-07-29 10:46:18'),
	(180, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-07-29 15:21:42'),
	(181, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-01 10:07:20'),
	(182, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-01 10:11:20'),
	(183, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-01 12:26:24'),
	(184, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-03 10:10:44'),
	(185, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-04 11:06:38'),
	(186, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-05 10:47:41'),
	(187, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-06 10:39:53'),
	(188, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-08 09:33:06'),
	(189, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-08 10:18:01'),
	(190, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-08 12:03:58'),
	(191, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-09 09:49:03'),
	(192, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-10 09:55:59'),
	(193, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-10 10:21:47'),
	(194, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-11 09:56:41'),
	(195, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-11 10:38:15'),
	(196, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-12 10:41:01'),
	(197, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-12 14:26:26'),
	(198, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-15 10:07:46'),
	(199, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-15 17:11:50'),
	(200, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-16 15:55:55'),
	(201, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-16 18:05:24'),
	(202, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-16 20:11:36'),
	(203, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-17 19:59:59'),
	(204, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-18 16:08:42'),
	(205, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-19 14:11:56'),
	(206, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-19 16:23:31'),
	(207, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-19 17:25:00'),
	(208, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-19 18:05:34'),
	(209, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-22 09:38:56'),
	(210, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '127.0.0.1', 'F:\\www\\eliteclub\\plugins\\Wpadmin\\src\\Controller\\Component\\UtilComponent.php', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'123456\',\n)', 'admin', '2016-08-22 10:46:50');
/*!40000 ALTER TABLE `actionlog` ENABLE KEYS */;


-- 导出  表 binggq.activity 结构
CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '活动表',
  `admin_id` int(10) NOT NULL COMMENT '作者id',
  `user_id` int(10) NOT NULL COMMENT '用户id',
  `publisher` varchar(50) NOT NULL COMMENT '发布者姓名',
  `industry_id` int(10) NOT NULL COMMENT '标签id',
  `company` varchar(100) NOT NULL COMMENT '主办单位',
  `title` varchar(150) NOT NULL COMMENT '活动名称',
  `time` date NOT NULL COMMENT '活动时间（3.2~4.1）',
  `address` varchar(150) NOT NULL COMMENT '地点',
  `must_check` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0不需要1需要 报名审核',
  `scale` int(11) NOT NULL COMMENT '规模',
  `read_nums` int(11) DEFAULT '0' COMMENT '阅读数',
  `praise_nums` int(11) DEFAULT '0' COMMENT '点赞数',
  `comment_nums` int(11) NOT NULL DEFAULT '0' COMMENT '评论数',
  `cover` varchar(250) DEFAULT NULL COMMENT '封面',
  `body` text COMMENT '活动内容',
  `summary` varchar(250) DEFAULT NULL COMMENT '摘要',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `apply_end_time` int(11) NOT NULL COMMENT '报名截止日期',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `apply_nums` int(11) DEFAULT '0' COMMENT '报名人数',
  `apply_fee` float NOT NULL DEFAULT '0' COMMENT '报名费用',
  `is_crowdfunding` tinyint(2) DEFAULT '0' COMMENT '是否众筹活动',
  `is_check` tinyint(2) DEFAULT '0' COMMENT '是否审核，0：未审核；1：发布；2：未通过审核',
  `is_top` tinyint(2) DEFAULT '0' COMMENT '是否置顶',
  `from_user` int(11) NOT NULL DEFAULT '0' COMMENT '-1需求0后台>1,copy',
  `guest` varchar(255) DEFAULT NULL COMMENT 'å‚ä¸Žå˜‰å®¾',
  `reason` varchar(255) DEFAULT NULL COMMENT 'æœªé€šè¿‡å®¡æ ¸ç†ç”±',
  `series_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT '系列标签',
  `region_id` int(11) NOT NULL COMMENT '地区id',
  `qrcode` varchar(200) DEFAULT NULL COMMENT '二维码',
  `thumb` varchar(200) DEFAULT NULL COMMENT '缩略图',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1正常0下架',
  `is_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1删除0正常',
  PRIMARY KEY (`id`),
  KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='活动表';

-- 正在导出表  binggq.activity 的数据：~29 rows (大约)
DELETE FROM `activity`;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
INSERT INTO `activity` (`id`, `admin_id`, `user_id`, `publisher`, `industry_id`, `company`, `title`, `time`, `address`, `must_check`, `scale`, `read_nums`, `praise_nums`, `comment_nums`, `cover`, `body`, `summary`, `create_time`, `apply_end_time`, `update_time`, `apply_nums`, `apply_fee`, `is_crowdfunding`, `is_check`, `is_top`, `from_user`, `guest`, `reason`, `series_id`, `region_id`, `qrcode`, `thumb`, `status`, `is_del`) VALUES
	(6, 2, 8, '曹麦穗', 5, '柠檬智慧科技', 'E店通', '2016-09-09', '福田上沙3', 0, 127, 25, 0, 0, '/upload/activity/2016-04-21/571878d1d6f5f.jpg', '<p>活动介绍：</p><p><br/></p><p><br/></p><p>活动流程：</p><p><br/></p><p><br/></p><p>参与嘉宾：</p><p><br/></p><p><br/></p><p>联系方式：<br/></p>', '<p>交流会啊</p>', '2016-04-21 14:53:00', 0, '2016-08-03 16:45:05', 0, 0, 0, 1, 0, 0, NULL, NULL, 0, 1, '/upload/qrcode/activitycode/2016-07-07/14678966196.png', NULL, 1, 0),
	(8, 2, 2, '曹麦穗', 0, '并购精英汇', '2006年中国国际体育融资总裁年会', '0000-00-00', '深圳市福田区东海国际公寓', 0, 127, 54, 2, 7, '/upload/newscover/2016-06-07/575689ec1146c.png', '<p>活动流程：<br/></p><p>13:00 - 14:00&nbsp;签到</p><p>13:00 - 14:00&nbsp;活动开场</p><p>14:00 - 14:05&nbsp;签到</p><p>14:05 - 14:15&nbsp;天天投介绍</p><p>14:15 - 14:55&nbsp;圆桌论坛+现场提问</p><p>14:55 - 16:40&nbsp;12个项目路演</p><p>14:40 - 18:00&nbsp;投融资面对面一对一交流</p><p>18:00 - 00:00&nbsp;活动结束</p><p><br/></p>', '<p>46号文的出现，体育产业从业界内心激情澎湃，产业外人士 纷纷扎入，这是体育产业建仓的最好时候，那么接下来体育 与资本、体育金融、体育产业将如何风起云涌？谁将是体育 产业中的新星？谁将成为体育产业里的独角兽？</p>', '2016-06-07 16:46:00', 0, '2016-07-07 21:03:40', 0, 0, 0, 1, 0, 0, '<p>高一波 柠檬智慧总裁</p><p>郑旭 柠檬智慧副总裁</p><p><br/></p>', NULL, 0, 2, '/upload/qrcode/activitycode/2016-07-07/14678966208.png', NULL, 1, 0),
	(9, 2, 2, '曹麦穗', 0, '并购精英汇', '云峰有约——刘云中国画作品展', '0000-00-00', '深圳市福田区红荔路6026号', 0, 100, 15, 0, 0, '/upload/newscover/2016-06-07/57569682a7e94.jpg', '<p>活动：</p><p style="margin-top: 0px; margin-bottom: 0px; padding: 5px 0px; word-wrap: break-word; line-height: 26px; font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; color: rgb(34, 34, 34); white-space: normal; background-color: rgb(255, 255, 255);"><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 26px; background-color: rgb(255, 255, 255);">中、西绘画艺术语言的融汇贯通是20世纪以来中国画家寻求现代转型和世界对话的一个重要路径，而由油画跨入中国画的大家如徐悲鸿、朱屹瞻、林风眠、李可染、吴冠中等都以其辉煌的艺术成就，为中、西绘画艺术的融合、对话、碰撞而产生全新的艺术风格提供了典范。他们作为一种现代艺术精神和思想资源，感召着后来者，也为后来者奠定了继续探索前行的基石，从而构成了现代中国画艺术的多元面貌。</span></p>', '<p>“云峰有约——刘云中国画作品展”将于2016年6月7日上午10：00在深圳市关山月美术馆开幕，此展由中国美术家协会、湖南省文学艺术界联合会共同主办，关山月美术馆、湖南省美术家协会、湖南省画院、湖南美术出版社联合承办，共展出刘云山水画作品70件。</p>', '2016-06-07 17:37:00', 0, '2016-07-07 21:03:40', 0, 0, 0, 1, 0, 0, NULL, NULL, 0, 1, '/upload/qrcode/activitycode/2016-07-07/14678966209.png', NULL, 1, 0),
	(10, 2, 2, '曹麦穗', 0, '南澳办事处', '6月8日来南澳看海上赛龙舟，品疍家渔民文化', '0000-00-00', '大鹏新区南澳月亮湾海域', 0, 127, 97, 3, 4, '/upload/newscover/2016-06-07/575697402e545.jpg', '<p>活动：</p><p><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 26px; background-color: rgb(255, 255, 255);">“赛龙舟百舸争流 舞腰鼓万人同欢”。一年一度的大鹏新区南澳龙舟邀请赛将于6月8日上午9时在南澳月亮湾海域举行。届时将有来自广州、东莞、香港、澳门和深圳的18支队伍海上竞渡。</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 26px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 26px; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 作为南澳的旅游文化名片之一，今年，南澳办事处着重“打造品牌”，聘请专业公司设计了龙舟赛LOGO，通过标志鲜明的精彩赛事和文艺汇演，将龙舟赛打造成弘扬南澳文化的特色品牌。</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 26px; white-space: normal; background-color: rgb(255, 255, 255);"/><br/></p>', '<p><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 26px; background-color: rgb(255, 255, 255);">南澳作为龙舟之乡，赛龙舟已有70多年的历史，至今已成功举办15届。作为广东省非物质文化遗产项目，龙舟文化已深入本地居民的生活，更成为备受社会关注的国际性运动。同时，南澳的祭妈祖、渔民娶', '2016-06-07 17:43:00', 0, '2016-07-12 11:14:04', 1, 0, 0, 1, 0, 0, NULL, NULL, 0, 1, '/upload/qrcode/activitycode/2016-07-07/146789662010.png', NULL, 1, 0),
	(11, 2, 2, '曹麦穗', 0, '网易娱乐', '2016深圳CFD暴雪电竞嘉年华活动 端午节期间上演', '0000-00-00', '深圳龙岗大运中心体育馆', 0, 127, 42, 2, 1, '/upload/newscover/2016-06-07/575699cb52d91.png', '<p><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">交通指南</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">　　公交：</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">　　附近公交站：大运中心、体育新城、大运中心体育场</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">　　地铁：3号龙岗线大运站C出口</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">　　地铁到站出站以后，到附近的地铁公交接驳站坐公交。</span></p>', '<p><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">狼蛛杯CFD暴雪电竞嘉年华是由网易和暴雪授权、CFD电竞平台举办的《风暴英雄》和《炉石传说》官方赛事，是广大游戏玩家参与的电竞盛典。</span></p>', '2016-06-07 17:54:00', 0, '2016-07-07 21:03:40', 0, 0, 0, 1, 0, 0, NULL, NULL, 0, 2, '/upload/qrcode/activitycode/2016-07-07/146789662011.png', NULL, 1, 0),
	(12, 2, 2, '曹麦穗', 0, '深圳交响乐团', '【公益活动】深圳交响乐团音乐季音乐会导赏', '0000-00-00', '深圳交响乐团演奏厅（深圳市罗湖区黄贝路2025号）', 0, 100, 87, 4, 1, '/upload/newscover/2016-06-07/57569c5069697.jpg', '<p><span style="color: rgb(128, 0, 128); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">公益免费，凭身份证领取入场票</span></p>', '<p><span style="color: rgb(128, 0, 128); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">公益免费，凭身份证领取入场票</span></p>', '2016-06-07 18:05:00', 0, '2016-07-07 21:03:40', 1, 0, 0, 1, 0, 0, NULL, NULL, 0, 1, '/upload/qrcode/activitycode/2016-07-07/146789662012.png', NULL, 1, 0),
	(13, 2, 2, '曹麦穗', 0, '福田文化馆', '【公益演出】黄龙戏小戏赏析', '0000-00-00', '福田区非遗馆剧场（二楼小剧场）', 0, 100, 69, 1, 0, '/upload/newscover/2016-06-07/5756a02b93e45.jpg', '<p><span style="font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; color: rgb(255, 140, 0); background-color: rgb(255, 255, 255);"><strong>《梨园苹果》</strong></span><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">剧情简介戏曲剧团龙套演员李大平受儿子李小果学校之托，要去学校组织的联欢会上表演节目。一口答应在联欢会唱歌的他，却在剧团的排练场偷偷地拿出团里的传统戏曲服装自己排练起了戏曲唱段的节目。学校教导处主任在李小果的带领下审查李大平的节目，几次劝说让他放弃表演戏曲唱段，改为唱流行歌曲《小苹果》，并表示现在不光是孩子们，就算是很多成年人也不愿意接受节奏缓慢咿咿呀呀的戏曲表演艺术。李大平几次“抗争”无果之后，稍作妥协，把戏曲唱段的唱词用流行歌曲的形式表演出来。王主任和李小果看后拍手叫好，李大平却从掌声中失落无比脱下了他梦寐以求的主演服装，他觉得自己虽然只是个剧团里的小龙套，但戏曲不可以这样改革，艺术不可以这样胡闹，从而拒绝了联欢会的邀约。最后王主任幡然醒悟，觉得不光戏曲应该更加贴近观众，观众也应该平静下心来去更深层次的了解戏曲，不仅答应让李大平在联欢会上表演戏曲唱段，而且邀请剧团老师把戏曲艺术带进校园，每周去给学生们上一节戏曲课程。</span></p><p><span style="font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; color: rgb(255, 140, 0); background-color: rgb(255, 255, 255);"><strong>《醉鬼相亲》</strong></span><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">剧情简介嗜酒为命、无所事事的东北农村大龄亲年何老九受远房表叔牵线搭桥，醉酒后来到表叔家相看对象，谁知前来相亲的农村大龄剩女刘美妞（反串）貌丑无比、说话莽撞。二人在交流对话中一醉酒，一莽撞，火花四溅，笑料不断。最后刘美妞道出儿时旧事，原来二人早有渊源。刘美妞虽貌丑莽撞，但淳朴勤劳；何老九嗜酒如命，却也是宅心仁厚。二人的碰撞能否给彼此带来自我认知的改变，每个人心里都有不同的答案。</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">《醉鬼相亲》是东北地方小戏常见的调侃嬉闹的表演风格。在热闹之余，讽刺了当下农村的恶风陋习，同时也表达了不管什么样的人对美好生活的由衷渴求。</span></p>', '<p><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">这是舞台上不多见的以戏说戏的表演形式，用当代戏曲人和当代大多数观众两个视角来表述戏曲艺术如今存在的困惑和问题。它不会给予答案，只期望带给更多的人一些思考。</span></p>', '2016-06-07 18:20:00', 0, '2016-07-11 11:12:24', 2, 200, 0, 1, 0, 0, NULL, NULL, 0, 2, '/upload/qrcode/activitycode/2016-07-07/146789662013.png', NULL, 1, 0),
	(14, 2, 2, '曹麦穗', 0, '政府', '《梅花三弄》——经典古筝名曲赏析端午节音乐会', '0000-00-00', '深圳大剧院音乐厅', 0, 100, 179, 3, 1, '/upload/newscover/2016-06-07/5756a12e4eccc.jpg', '<p><strong style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">演出曲目</strong><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">梅花三弄&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 陈志远/曲</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">茉莉芬芳&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 何占豪/曲</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">临安遗恨&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 何占豪/曲</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">牧羊曲&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 王立平/曲</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">梁祝&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 何占豪/曲</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">彝族舞曲&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 王中山/改编&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">水调歌头•明月几时有</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">秋望&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 周煜国/曲</span></p>', '<p><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">古筝是我国传统民族乐器，它是中国独特的、重要的民族乐器之一。它的音色优美，音域宽广、演奏技巧丰富，具有相当强的表现力，因此它深受广大人民群众的喜爱。6月10日端午节假期，深圳“艺术大观', '2016-06-07 18:25:00', 0, '2016-07-08 11:24:51', 1, 200, 0, 1, 0, 0, NULL, NULL, 0, 1, '/upload/qrcode/activitycode/2016-07-07/146789662014.png', NULL, 1, 0),
	(15, 2, 2, '曹麦穗', 0, '西西弗书店', '鞠萍姐姐携新书《萍聚》于花园城前庭与你见面', '0000-00-00', '深圳市南山区南海大道花园城（购物中心）1楼前庭', 0, 100, 400, 4, 28, '/upload/activitycover/2016-07-08/577f430ed8fbf.png', '<p>年少时，陪伴我们鞠萍姐姐，依然继续陪伴着更多的儿童以及青少年。小编似乎觉得，好像时光并没有流失，因为鞠萍姐姐还是记忆中的鞠萍姐姐啊，跟小编小时候看见的一样。或许岁月改变的是彼此的容颜，却没有改变我们的记忆。</p><p>童年喜欢鞠萍姐姐的小伙伴们，现在孩子喜欢鞠萍姐姐的朋友们，还有喜欢鞠萍姐姐新书《萍聚》的朋友们，一起来花园城参加鞠萍姐姐读者见面会吧。让我们一起用爱守护童年，用心撒播希望。6月11日，我们不见不散~</p>', '<p>小时候，每天下午放学回家，第一件事就是打开电视机，从动画城看到大风车，从大风车看到七巧板，董浩叔叔，鞠萍姐姐，小鹿姐姐，金龟子，月亮姐姐每个人都能叫出名字来，就好像他们就是我们童年的偶</p>', '2016-06-07 18:40:00', 0, '2016-08-04 11:43:40', 3, 0, 0, 1, 0, 0, NULL, NULL, 0, 2, '/upload/qrcode/activitycode/2016-07-07/146789662015.png', '/upload/activitythumb/2016-07-08/577f430ab6481.png', 1, 0),
	(19, 0, 11, '', 0, '柠檬智慧咨询有限公司', '我们实得分 ', '0000-00-00', '', 0, 0, NULL, 0, 0, NULL, '窝窝', NULL, '2016-07-04 09:33:33', 0, '2016-07-07 21:03:40', 0, 0, 1, 0, 0, 0, NULL, NULL, 0, 0, '/upload/qrcode/activitycode/2016-07-07/146789662019.png', NULL, 1, 0),
	(20, 2, 2, '曹麦穗', 0, '并购菁英汇', '互联网＋行业峰会', '2016-09-09', '万象城', 0, 100, 147, 1, 3, '/upload/activitycover/2016-07-08/577f1866232c6.jpg', '<p>如果问如今中国哪个行业最火？毫无疑问，必然是IT互联网行业。在“互联网+”的热潮下，互联网创造了一个又一个的跨界奇迹，制造了一个又一个的行业神话。</p>', '<p>从最初的电商颠覆零售，到如今的互联网+在餐饮、旅游、物流、地产、医疗……等多个行业发力，形成了一股来势汹涌的互联网热潮。互联网IT行业以其蓬勃兴起的无尽活力向世人昭示了信息技术的强大生命力！</p>', '2016-07-05 14:38:40', 0, '2016-08-03 16:09:04', 5, 0, 0, 1, 0, 0, '<p><embed id="xunlei_com_thunder_helper_plugin_d462f475-c18e-46be-bd10-327458d045bd" type="application/thunder_download_plugin" height="0" width="0"/></p><p><br/></p>', NULL, 0, 2, '/upload/qrcode/activitycode/2016-07-07/146789662020.png', '/upload/activitythumb/2016-07-08/577f18db31f35.jpg', 1, 0),
	(21, 2, 2, '曹麦穗', 0, '并购精英汇', '2016年中国国际体育融资总裁年会', '0000-00-00', '岗厦北', 0, 100, 120, 1, 0, '/upload/activitycover/2016-07-08/577f19f65619e.png', '<p>1月22 日，体育BANK联合安信证券、君联资本、华体集团、探路者、智美体育集团、通力律师事务所、北京鸟巢文化中心在鸟巢举办了“2016中国国际体育投融资总裁年会暨首届“体育BANK”颁奖盛典。来自体育各界上市公司、投资机构、体育新三板公司、学术界、金融界的专家和领导共200余人莅临会场，与2015年度体育产业年度最佳获奖者们，共同见证了这一体育与资本拥抱的年度体育盛事。</p>', '<p><strong>时间</strong>：2016 年1月22日 14:00-20:00</p><p><strong>地点</strong>：北京鸟巢文化中心</p><p><strong>主题</strong>：体育大时代，悟动未来</p><p><strong>组织机构 </strong>&nbsp; &nbsp;</p><p><strong>主办方</strong>：体育BANK、安信证券、君联资本、华体集团、探路者、智美集团、通力律师事务所 &nbsp; &nbsp;</p><p>&am', '2016-07-05 16:07:01', 0, '2016-07-12 15:35:14', 3, 0, 0, 1, 0, 0, NULL, NULL, 0, 1, '/upload/qrcode/activitycode/2016-07-07/146789662021.png', '/upload/activitythumb/2016-07-08/577f19f1ab5d9.png', 1, 0),
	(24, 2, 2, '曹麦穗', 0, '并购帮', '并购万里行—为金融垂直领域精英人才的工作学习', '2016-09-09', '南山区', 0, 100, 163, 2, 7, '/upload/activitycover/2016-07-08/577f0d383137e.jpg', '<p>是一个专注并购的菁英社交平台,致力于搭建中国最顶尖的金融精英社区,为金融垂直领域精英人才的工作学习,事业社交以及休闲生活提供高端,精准服务。</p>', '<p>是一个专注并购的菁英社交平台,致力于搭建中国最顶尖的金融精英社区,为金融垂直领域精英人才的工作学习,事业社交以及休闲生活提供高端,精准服务。</p>', '2016-07-08 10:18:21', 0, '2016-08-06 11:13:46', 8, 100, 0, 1, 0, 0, '', NULL, 0, 2, 'upload/qrcode/activitycode/2016-07-08/146794433424.png', '/upload/activitythumb/2016-07-08/577f0d32d995e.jpg', 0, 0),
	(26, 2, 2, '曹麦穗', 0, '腾讯科技', '完成灸疗店铺版开发', '2016-09-09', '深圳市南山区腾讯大厦', 0, 127, NULL, 0, 0, '/upload/activitycover/2016-07-14/57875092125a4.jpg', '<p>流程介绍：</p><p>test<br/></p><p><br/></p><p>联系方式：</p><p>testa<br/></p>', '<p>teaadfga</p><p>agd<br/></p>', '2016-07-14 16:43:29', 0, '2016-07-14 16:43:29', 0, 100, 0, 0, 0, 0, NULL, NULL, 0, 1, NULL, '/upload/activitythumb/2016-07-14/578750830ffa4.jpg', 1, 0),
	(27, 2, 2, '曹麦穗', 0, '腾讯科技', '完成灸疗店铺版开发', '2016-09-09', '深圳市南山区腾讯大厦', 0, 127, NULL, 0, 0, '/upload/activitycover/2016-07-14/57875092125a4.jpg', '<p>流程介绍：</p><p>test<br/></p><p><br/></p><p>联系方式：</p><p>testa<br/></p>', '<p>teaadfga</p><p>agd<br/></p>', '2016-07-14 16:43:37', 0, '2016-08-03 17:14:21', 0, 100, 0, 0, 0, 0, NULL, NULL, 0, 1, NULL, '/upload/activitythumb/2016-07-14/578750830ffa4.jpg', 0, 1),
	(28, 2, 2, '曹麦穗', 0, '腾讯科技', '母婴健康交流', '2016-09-09', '深圳市南山区腾讯大厦', 0, 127, 1, 0, 0, '/upload/activitycover/2016-07-15/5788674c1bbe7.jpg', '<p>流程介绍：</p><p><br/></p><p>3<br/></p><p>联系方式：</p><p><br/></p><p>4<br/></p>', '<p>112<br/></p>', '2016-07-15 12:59:55', 0, '2016-08-03 17:33:30', 0, 100, 0, 0, 0, 0, NULL, NULL, 1, 1, NULL, '/upload/activitythumb/2016-07-15/5788674400a98.jpg', 0, 0),
	(29, 2, 2, '曹麦穗', 0, '腾讯科技', '母婴健康交流', '2016-09-09', '深圳市南山区腾讯大厦', 0, 127, 1, 0, 0, '', '<p>流程介绍：</p><p><br/></p><p><br/></p><p>联系方式：<br/></p>', NULL, '2016-07-15 14:14:34', 0, '2016-08-04 11:43:24', 0, 100, 0, 0, 0, 0, NULL, NULL, 1, 1, NULL, '', 1, 0),
	(30, 2, 2, '曹麦穗', 0, '腾讯科技', '这才是国内八月最值得去的12个旅行天堂！别去错了！', '2016-09-09', '深圳市南山区腾讯大厦', 0, 127, NULL, 0, 0, '/upload/activitycover/2016-07-15/57887f96d4e82.jpg', '<p>流程介绍：</p><p>444<br/></p><p><br/></p><p>联系方式：</p><p>5556<br/></p>', '<p>333<br/></p>', '2016-07-15 14:16:09', 0, '2016-08-03 17:14:15', 0, 200, 0, 0, 0, 0, NULL, NULL, 0, 1, NULL, '/upload/activitythumb/2016-07-15/57887f923e545.jpg', 0, 1),
	(31, 2, 2, '曹麦穗', 0, '腾讯科技', '母婴健康交流', '2016-09-09', '深圳市南山区腾讯大厦', 0, 127, NULL, 0, 0, '/upload/activitycover/2016-07-15/578881093b3f9.jpg', '<p>流程介绍：</p><p>123<br/></p><p><br/></p><p>联系方式：</p><p>123<br/></p>', '<p>3<br/></p>', '2016-07-15 14:22:10', 0, '2016-08-03 17:14:12', 0, 100, 0, 0, 0, 0, NULL, NULL, 0, 1, NULL, '/upload/activitythumb/2016-07-15/578881045a35a.jpg', 0, 1),
	(32, 2, 2, '曹麦穗', 0, 'google', '母婴健康交流', '2016-09-09', '深圳市南山区腾讯大厦', 0, 127, NULL, 0, 0, '', '<p>流程介绍：</p><p><br/></p><p>3<br/></p><p>联系方式：</p><p>44<br/></p>', '<p>123<br/></p>', '2016-07-15 14:25:25', 0, '2016-08-03 17:14:10', 0, 100, 0, 0, 0, 0, NULL, NULL, 0, 1, NULL, '', 0, 1),
	(33, 2, 2, '曹麦穗', 0, '腾讯科技', '母婴健康交流', '2016-09-09', '深圳市南山区腾讯大厦', 0, 127, NULL, 0, 0, '/upload/activitycover/2016-07-15/578882d4af322.jpg', '<p>流程介绍：</p><p><br/></p><p>3<br/></p><p>联系方式：</p><p>5<br/></p>', '<p>12<br/></p>', '2016-07-15 14:29:56', 0, '2016-08-03 17:14:04', 0, 100, 0, 0, 0, 0, NULL, NULL, 3, 1, NULL, '/upload/activitythumb/2016-07-15/578882cf161c4.jpg', 0, 1),
	(34, 2, 2, '曹麦穗', 0, 'google', '完成灸疗店铺版开发', '2016-09-09', '深圳市南山区腾讯大厦', 0, 127, NULL, 0, 0, '/upload/activitycover/2016-07-15/5788833c57504.jpg', '<p>流程介绍：</p><p><br/></p><p>123<br/></p><p>联系方式：</p><p>123<br/></p>', '<p>123<br/></p>', '2016-07-15 14:31:37', 0, '2016-08-03 17:03:23', 0, 100, 0, 0, 0, 0, NULL, NULL, 0, 1, NULL, '/upload/activitythumb/2016-07-15/578883350ded4.jpg', 0, 1),
	(35, 0, 29, '', 0, '12', '我有一个plan', '0000-00-00', '', 0, 0, NULL, 0, 0, NULL, '只差一个程序员', NULL, '2016-07-22 20:58:38', 0, '2016-08-03 17:39:32', 0, 0, 1, 0, 0, -1, NULL, NULL, 0, 0, NULL, NULL, 1, 0),
	(36, 2, 2, '曹麦穗', 0, 'google', '完成灸疗店铺版开发', '2016-09-09', '深圳市南山区腾讯大厦', 0, 188, NULL, 0, 0, '/upload/activitycover/2016-07-26/57975973ada9e.jpg', '<p>流程介绍：</p><p><br/></p><p>55<br/></p><p>联系方式：</p><p>7677<br/></p>', '<p>1231<br/></p>', '2016-07-26 20:39:49', 0, '2016-08-03 17:02:33', 0, 677, 0, 0, 0, 0, NULL, NULL, 0, 1, NULL, '/upload/activitythumb/2016-07-26/57975970db2ae.jpg', 0, 1),
	(37, 2, 8, '曹麦穗', 0, '腾讯科技', '完成灸疗店铺版开发', '2016-09-09', '深圳市南山区腾讯大厦', 0, 188, 1, 0, 0, '/upload/activitycover/2016-07-26/57975d4226450.jpg', '<p>流程介绍：</p><p><br/></p><p>213<br/></p><p>联系方式：</p><p>42352<br/></p>', '<p>14246776<br/></p>', '2016-07-26 20:53:37', 2147483647, '2016-08-03 16:44:05', 0, 121, 0, 0, 0, 0, NULL, NULL, 0, 1, NULL, '/upload/activitythumb/2016-07-26/57975d3bba4ba.jpg', 1, 0),
	(38, 2, 2, '曹麦穗', 0, '腾讯科技', 'hello world', '2016-07-22', '深南大道腾讯大厦', 1, 188, 6, 0, 0, '/upload/activitycover/2016-08-04/57a2bafa44c38.png', '<p>流程介绍：</p><p><br/></p><p>3<br/></p><p>联系方式：</p><p>4<br/></p>', '<p>1<br/></p>', '2016-08-04 11:48:20', 1458529200, '2016-08-22 11:03:29', 0, 100, 0, 0, 1, 0, NULL, NULL, 0, 1, '/147142546638.png', '/upload/activitythumb/2016-08-04/57a2baf460ee5.jpg', 1, 0),
	(39, 2, 2, '曹麦穗', 0, '广煤2号', '美队2冬日战士上映', '2016-09-09', '深南大道腾讯大厦', 1, 188, 5, 0, 0, '/upload/activitycover/2016-08-04/57a2e49975236.jpg', '<p>流程介绍：</p><p>3466<br/></p><p><br/></p><p>联系方式：</p><p>78<br/></p>', '<p>88<br/></p>', '2016-08-04 14:48:43', 1472551211, '2016-08-04 18:36:39', 1, 0, 0, 0, 0, 0, NULL, NULL, 0, 1, NULL, '/upload/activitythumb/2016-08-04/57a2e492b1e4d.jpg', 1, 0),
	(40, 2, 2, '曹麦穗', 0, '腾讯科技', 'hello world', '2016-08-09', '深南大道腾讯大厦', 1, 188, NULL, 0, 0, '/upload/activitycover/2016-08-04/57a2e7fa90dcc.jpg', '<p>流程介绍：</p><p><br/></p><p><br/></p><p>联系方式：<br/></p>', NULL, '2016-08-04 15:00:17', 1471507247, '2016-08-04 15:00:29', 0, 0, 0, 0, 0, 0, NULL, NULL, 1, 1, NULL, '/upload/activitythumb/2016-08-04/57a2e7f514ba3.jpg', 0, 1),
	(41, 2, 2, '曹麦穗', 0, '腾讯科技', 'hello world4455', '2016-08-31', '深圳市南山区腾讯大厦', 0, 500, 0, 0, 0, '/upload/activitycover/2016-08-06/57a58de4f2041.jpg', '<p>流程介绍：</p><p><br/></p><p>4<br/></p><p>联系方式：</p><p>55<br/></p>', '<p>33<br/></p>', '2016-08-06 15:12:56', 0, '2016-08-06 15:13:20', 0, 100, 0, 0, 0, 0, NULL, NULL, 0, 1, NULL, '/upload/activitythumb/2016-08-06/57a58de10e187.jpg', 0, 0),
	(42, 2, 2, '曹麦穗', 0, '33', '111', '0000-00-00', '', 0, 112, 0, 0, 0, '', '<p>流程介绍：</p><p><br/></p><p><br/></p><p>联系方式：<br/></p>', NULL, '2016-08-11 10:47:14', 0, '2016-08-11 10:47:14', 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 1, NULL, '', 0, 0),
	(43, 2, 2, '曹麦穗', 0, '柠檬智慧', '传统企业的改革之路', '2016-08-31', '展涛科技大厦1楼路演厅', 0, 40, 4, 0, 0, '/upload/activitycover/2016-08-19/57b6a39700eda.jpg', '<p>流程介绍：</p><p>3333</p><p><br/></p><p>联系方式：<br/></p><p>333444</p>', '大清要亡了', '2016-08-19 14:14:13', 1472536834, '2016-08-19 14:16:47', 0, 100, 0, 0, 0, 0, '<p>郑旭柠檬智慧</p>', NULL, 1, 2, '/147158726943.png', '/upload/activitythumb/2016-08-19/57b6a38de4383.jpg', 1, 0);
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;


-- 导出  表 binggq.activityapply 结构
CREATE TABLE IF NOT EXISTS `activityapply` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '活动申请表',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `activity_id` int(11) NOT NULL COMMENT '活动id',
  `create_time` datetime NOT NULL COMMENT '提交时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  `is_pass` tinyint(4) DEFAULT '0' COMMENT '是否通过1通过0未通过',
  `is_check` tinyint(4) DEFAULT '0' COMMENT '是否审核通过',
  `check_man` varchar(50) DEFAULT '' COMMENT '审核人',
  `is_top` tinyint(4) DEFAULT '0' COMMENT '是否置顶',
  `is_sign` tinyint(2) DEFAULT '0' COMMENT '是否已签到，0：未签到；1：已签到',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COMMENT='活动申请表';

-- 正在导出表  binggq.activityapply 的数据：~32 rows (大约)
DELETE FROM `activityapply`;
/*!40000 ALTER TABLE `activityapply` DISABLE KEYS */;
INSERT INTO `activityapply` (`id`, `user_id`, `activity_id`, `create_time`, `update_time`, `is_pass`, `is_check`, `check_man`, `is_top`, `is_sign`) VALUES
	(1, 10, 15, '2016-06-22 14:53:25', '2016-06-22 14:53:25', 0, 0, '', 0, 0),
	(2, 10, 16, '2016-06-22 14:54:04', '2016-06-22 14:54:04', 0, 0, '', 0, 0),
	(3, 9, 16, '2016-06-22 14:56:11', '2016-07-11 14:57:32', 0, 0, '', 0, 0),
	(4, 9, 15, '2016-06-22 14:56:30', '2016-06-22 14:56:30', 0, 0, '', 0, 0),
	(5, 10, 13, '2016-06-22 15:15:09', '2016-06-22 15:15:09', 0, 0, '', 0, 0),
	(6, 9, 13, '2016-06-23 16:05:53', '2016-06-23 16:54:31', 1, 0, '', 0, 0),
	(7, 10, 12, '2016-06-26 15:34:06', '2016-06-26 15:34:06', 0, 0, '', 0, 0),
	(8, 11, 16, '2016-06-28 09:25:21', '2016-06-28 09:25:21', 0, 0, '', 0, 0),
	(9, 9, 14, '2016-06-30 22:15:03', '2016-06-30 22:15:03', 0, 0, '', 0, 0),
	(10, 11, 10, '2016-07-01 12:12:46', '2016-07-01 12:12:46', 0, 0, '', 0, 0),
	(11, 7, 16, '2016-07-05 10:51:04', '2016-07-05 14:53:34', 1, 0, '', 0, 0),
	(12, 7, 15, '2016-07-05 10:51:53', '2016-07-05 10:51:53', 0, 0, '', 0, 0),
	(13, 7, 21, '2016-07-05 16:16:25', '2016-07-05 16:16:25', 0, 0, '', 0, 0),
	(14, 17, 20, '2016-07-05 16:43:24', '2016-07-05 16:43:24', 0, 0, '', 0, 0),
	(15, 14, 24, '2016-07-09 12:52:04', '2016-07-09 12:52:04', 0, 0, '', 0, 0),
	(16, 14, 16, '2016-07-09 13:02:35', '2016-07-09 13:02:35', 0, 0, '', 0, 0),
	(17, 24, 24, '2016-07-09 21:12:56', '2016-07-09 21:12:56', 0, 0, '', 0, 0),
	(18, 25, 24, '2016-07-11 11:10:09', '2016-07-11 11:10:09', 0, 0, '', 0, 0),
	(19, 25, 20, '2016-07-11 11:10:39', '2016-07-11 11:10:39', 0, 0, '', 0, 0),
	(20, 26, 21, '2016-07-11 12:59:37', '2016-07-11 12:59:37', 0, 0, '', 0, 0),
	(21, 7, 24, '2016-07-11 15:50:25', '2016-07-11 15:50:25', 0, 0, '', 0, 0),
	(22, 27, 24, '2016-07-11 15:56:19', '2016-07-11 15:56:19', 0, 0, '', 0, 0),
	(23, 26, 16, '2016-07-11 15:58:46', '2016-07-11 15:58:46', 0, 0, '', 0, 0),
	(24, 7, 20, '2016-07-11 16:24:46', '2016-07-11 16:24:46', 0, 0, '', 0, 0),
	(25, 13, 24, '2016-07-11 16:25:21', '2016-07-11 16:25:21', 0, 0, '', 0, 0),
	(26, 26, 20, '2016-07-11 16:25:58', '2016-07-11 16:25:58', 0, 0, '', 0, 0),
	(27, 24, 20, '2016-07-11 16:30:32', '2016-07-11 16:30:32', 0, 0, '', 0, 0),
	(28, 10, 21, '2016-07-12 10:41:12', '2016-07-12 10:41:12', 0, 0, '', 0, 0),
	(29, 9, 24, '2016-07-12 12:12:19', '2016-07-12 12:12:19', 0, 0, '', 0, 0),
	(30, 15, 24, '2016-07-12 14:19:22', '2016-07-12 14:19:22', 0, 0, '', 0, 0),
	(31, 8, 38, '2016-08-04 14:39:49', '2016-08-04 14:56:57', 0, 0, '', 1, 0),
	(32, 8, 39, '2016-08-04 14:49:18', '2016-08-06 14:32:47', 1, 2, '曹麦穗', 0, 0),
	(33, 8, 43, '2016-08-19 14:16:33', '2016-08-19 14:16:33', 0, 0, '', 0, 0);
/*!40000 ALTER TABLE `activityapply` ENABLE KEYS */;


-- 导出  表 binggq.activitycom 结构
CREATE TABLE IF NOT EXISTS `activitycom` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '活动评论表',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `activity_id` int(11) NOT NULL COMMENT '活动id',
  `body` varchar(550) NOT NULL COMMENT '评论内容',
  `praise_nums` int(11) DEFAULT '0' COMMENT '点赞数',
  `create_time` datetime NOT NULL COMMENT '评论时间',
  `reply_id` int(11) DEFAULT NULL COMMENT '被回复人',
  `pid` int(11) NOT NULL COMMENT '被回复评论',
  `is_delete` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COMMENT='活动评论表';

-- 正在导出表  binggq.activitycom 的数据：~53 rows (大约)
DELETE FROM `activitycom`;
/*!40000 ALTER TABLE `activitycom` DISABLE KEYS */;
INSERT INTO `activitycom` (`id`, `user_id`, `activity_id`, `body`, `praise_nums`, `create_time`, `reply_id`, `pid`, `is_delete`) VALUES
	(5, 10, 15, '很好', 0, '2016-06-12 14:43:57', 2, 0, 0),
	(6, 10, 15, 'henhao', 0, '2016-06-12 14:44:14', 2, 0, 0),
	(7, 10, 15, 'henhao', 0, '2016-06-12 14:44:15', 2, 0, 0),
	(8, 10, 15, 'henhao hao', 0, '2016-06-12 14:44:47', 2, 0, 0),
	(9, 10, 15, 'henhao hao', 0, '2016-06-12 14:44:47', 2, 0, 0),
	(10, 10, 15, 'henhao hao', 0, '2016-06-12 14:44:48', 2, 0, 0),
	(11, 10, 15, 'henhao hao', 0, '2016-06-12 14:44:48', 2, 0, 0),
	(12, 10, 15, 'henhao hao', 0, '2016-06-12 14:44:48', 2, 0, 0),
	(13, 10, 15, 'henhao hao', 0, '2016-06-12 14:44:49', 2, 0, 0),
	(14, 9, 15, 'first time', 0, '2016-06-12 15:07:48', 2, 0, 0),
	(15, 9, 15, 'secend time', 0, '2016-06-12 15:12:00', 10, 0, 0),
	(16, 9, 15, 'third time', 0, '2016-06-12 19:17:16', 2, 0, 0),
	(17, 9, 15, 'fourth time', 0, '2016-06-12 19:18:01', 2, 0, 0),
	(18, 10, 15, 'ok', 1, '2016-06-21 18:17:28', 2, 0, 0),
	(20, 11, 12, '主题鲜明 文笔干练 内容生动而富有说理 语言简洁却又不失韵味  实在是一篇难得的好文章', 2, '2016-06-24 18:16:04', 2, 0, 0),
	(21, 9, 16, '123', 4, '2016-06-25 16:42:00', 2, 0, 0),
	(22, 2, 14, 'uuu', 0, '2016-06-25 16:42:39', 2, 0, 0),
	(23, 8, 16, '得', 0, '2016-06-26 11:00:06', 2, 0, 0),
	(24, 10, 15, '一定参加', 0, '2016-06-26 11:00:56', 2, 0, 0),
	(25, 10, 15, '一定参加ok', 0, '2016-06-26 11:01:19', 2, 0, 0),
	(26, 10, 8, '动画啊', 2, '2016-06-30 11:40:51', 2, 0, 0),
	(27, 2, 11, '很严重', 0, '2016-07-01 10:08:11', 2, 0, 0),
	(28, 11, 10, 'hjbbvb', 2, '2016-07-01 12:12:32', 2, 0, 0),
	(30, 7, 8, '', 1, '2016-07-05 10:27:22', 2, 0, 0),
	(31, 7, 8, '', 1, '2016-07-05 10:27:39', 2, 0, 0),
	(32, 7, 8, '我', 0, '2016-07-05 10:27:53', 2, 0, 0),
	(33, 7, 8, '我们的生活方式，我', 0, '2016-07-05 10:28:08', 2, 0, 0),
	(34, 7, 8, '我们的生活方式，我', 0, '2016-07-05 10:28:19', 2, 0, 0),
	(35, 7, 8, '我们的生活方式，我', 0, '2016-07-05 10:28:40', 2, 0, 0),
	(36, 7, 10, '大家好', 1, '2016-07-05 20:55:34', 2, 0, 0),
	(37, 7, 15, '大家好', 0, '2016-07-05 22:15:04', 2, 0, 0),
	(38, 7, 15, '我说我说我说', 0, '2016-07-06 11:58:17', 2, 0, 0),
	(39, 7, 15, '我说我说我说', 0, '2016-07-06 11:58:36', 2, 0, 0),
	(40, 7, 15, '我说我说我说', 0, '2016-07-06 11:59:16', 2, 0, 0),
	(41, 7, 15, '我说我说我说', 0, '2016-07-06 12:00:21', 2, 0, 0),
	(42, 7, 15, '我说我说我说g f t y', 0, '2016-07-06 12:00:55', 2, 0, 0),
	(43, 7, 15, '我说我说我说g f t y', 0, '2016-07-06 12:01:43', 2, 0, 0),
	(44, 10, 10, '而非他人瓦上霜', 1, '2016-07-06 12:03:24', 2, 0, 0),
	(45, 10, 10, '评论', 1, '2016-07-06 12:04:35', 2, 0, 0),
	(46, 15, 20, '扯扯', 1, '2016-07-07 11:57:04', 2, 0, 0),
	(47, 2, 20, '还好', 1, '2016-07-07 19:47:56', 15, 46, 0),
	(48, 2, 20, '323e', 1, '2016-07-07 20:17:39', 2, 47, 0),
	(49, 10, 24, '路过', 1, '2016-07-08 12:09:16', 2, 0, 0),
	(50, 14, 24, '这个主题很赞！', 1, '2016-07-09 12:57:08', 2, 0, 0),
	(51, 7, 24, '不错', 0, '2016-07-11 10:30:22', 2, 0, 0),
	(52, 7, 24, '已报名', 1, '2016-07-11 10:30:51', 2, 0, 0),
	(53, 7, 24, '赞', 0, '2016-07-11 11:03:53', 2, 0, 0),
	(54, -1, 0, '你脑子有坑吧', 0, '2016-07-29 15:56:51', 7, 42, 0),
	(55, -1, 0, '你脑子有坑吧', 0, '2016-07-29 15:57:04', 7, 42, 0),
	(56, -1, 0, '你脑子有坑吧', 0, '2016-07-29 15:57:33', 7, 42, 0),
	(57, -1, 0, '诶哟，不错', 0, '2016-07-29 15:58:42', 10, 49, 0),
	(58, -1, 0, '诶哟，不错', 0, '2016-07-29 15:58:47', 10, 49, 0),
	(59, -1, 24, '诶哟，不错', 0, '2016-07-29 16:00:06', 10, 49, 0),
	(60, -1, 24, '呵呵，你是？', 0, '2016-08-06 11:13:46', 7, 53, 0);
/*!40000 ALTER TABLE `activitycom` ENABLE KEYS */;


-- 导出  表 binggq.activity_industry 结构
CREATE TABLE IF NOT EXISTS `activity_industry` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'æ´»åŠ¨æ ‡ç­¾è¡¨',
  `industry_id` int(11) NOT NULL COMMENT 'ç”¨æˆ·id',
  `activity_id` int(11) NOT NULL COMMENT 'æ´»åŠ¨id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COMMENT='活动标签对映表';

-- 正在导出表  binggq.activity_industry 的数据：~30 rows (大约)
DELETE FROM `activity_industry`;
/*!40000 ALTER TABLE `activity_industry` DISABLE KEYS */;
INSERT INTO `activity_industry` (`id`, `industry_id`, `activity_id`) VALUES
	(1, 5, 8),
	(2, 5, 6),
	(3, 4, 9),
	(4, 11, 10),
	(5, 5, 11),
	(6, 7, 12),
	(7, 7, 13),
	(8, 7, 14),
	(9, 7, 15),
	(13, 7, 19),
	(15, 6, 20),
	(16, 5, 21),
	(21, 5, 24),
	(23, 5, 26),
	(24, 5, 27),
	(25, 5, 28),
	(26, 5, 29),
	(27, 4, 30),
	(28, 5, 30),
	(29, 4, 31),
	(30, 5, 32),
	(31, 6, 32),
	(32, 4, 33),
	(33, 5, 33),
	(34, 4, 34),
	(35, 5, 34),
	(37, 7, 33),
	(38, 6, 34),
	(39, 5, 36),
	(40, 4, 37),
	(41, 5, 37),
	(42, 7, 37),
	(43, 5, 38),
	(44, 5, 39),
	(45, 5, 40),
	(46, 5, 41),
	(47, 7, 41),
	(48, 8, 41),
	(49, 5, 42),
	(50, 6, 42),
	(51, 8, 42),
	(52, 7, 43);
/*!40000 ALTER TABLE `activity_industry` ENABLE KEYS */;


-- 导出  表 binggq.activity_recommend 结构
CREATE TABLE IF NOT EXISTS `activity_recommend` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '活动推荐活动关系表',
  `activity_id` int(11) NOT NULL COMMENT '活动id',
  `activity_recommend_id` int(11) NOT NULL COMMENT '推荐活动id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='活动推荐活动关系表';

-- 正在导出表  binggq.activity_recommend 的数据：~2 rows (大约)
DELETE FROM `activity_recommend`;
/*!40000 ALTER TABLE `activity_recommend` DISABLE KEYS */;
INSERT INTO `activity_recommend` (`id`, `activity_id`, `activity_recommend_id`) VALUES
	(1, 38, 9),
	(2, 39, 9),
	(3, 40, 9),
	(4, 41, 9),
	(5, 43, 11);
/*!40000 ALTER TABLE `activity_recommend` ENABLE KEYS */;


-- 导出  表 binggq.activity_savant 结构
CREATE TABLE IF NOT EXISTS `activity_savant` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '专家推荐活动关系表',
  `activity_id` int(11) NOT NULL COMMENT '活动id',
  `savant_id` int(11) NOT NULL COMMENT '专家id,为专家的user表id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COMMENT='专家推荐活动关系表';

-- 正在导出表  binggq.activity_savant 的数据：~16 rows (大约)
DELETE FROM `activity_savant`;
/*!40000 ALTER TABLE `activity_savant` DISABLE KEYS */;
INSERT INTO `activity_savant` (`id`, `activity_id`, `savant_id`) VALUES
	(18, 29, 7),
	(19, 30, 7),
	(20, 32, 7),
	(21, 33, 7),
	(22, 34, 7),
	(23, 34, 10),
	(24, 34, 17),
	(25, 33, 17),
	(26, 36, 7),
	(27, 36, 10),
	(28, 37, 7),
	(29, 37, 10),
	(30, 37, 17),
	(31, 38, 17),
	(32, 39, 17),
	(33, 40, 17),
	(34, 41, 17),
	(35, 43, 23);
/*!40000 ALTER TABLE `activity_savant` ENABLE KEYS */;


-- 导出  表 binggq.admin 结构
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `avatar` varchar(250) DEFAULT NULL COMMENT '头像',
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='管理员表';

-- 正在导出表  binggq.admin 的数据：~6 rows (大约)
DELETE FROM `admin`;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `username`, `avatar`, `truename`, `password`, `phone`, `enabled`, `ctime`, `utime`, `login_time`, `login_ip`) VALUES
	(2, 'admin', '/upload/admin/avatar/2016-08-01/579eafaf5cd30.jpg', '曹麦穗', '$2y$10$GVKepiqUWKSMUwGd3syKluYjzS1jLDZ8zbi.2D2S8B9k1atFXwNha', '', 1, '2016-04-11 16:53:00', '2016-08-22 10:46:50', '2016-08-22 10:46:50', '127.0.0.1'),
	(3, '小玲', '', '江燕玲', '$2y$10$N5wuytgrX1DlehKar8fHSOc6JFKFgBfLXLzKCnkPDskiBlOKcraQa', '', 1, '2016-07-13 18:28:05', '2016-07-13 18:28:05', NULL, NULL),
	(4, '小美', '', '', '$2y$10$s6jfMZA7tvmo4.popIGwuOZAWgWB6waU8gcMUdZpr6w3TDo1cW0tu', '', 0, '2016-07-13 18:31:41', '2016-07-28 15:34:57', NULL, NULL),
	(5, 'admin_test', '', '', '$2y$10$BOdCuLFMu5mQgNU4nPcRGumR/fCggCdHnlLo7TkfM0PNgy09hcRCC', '', 1, '2016-07-14 20:30:06', '2016-07-14 20:30:06', NULL, NULL),
	(6, 'admin1', '', '', '$2y$10$PurFYv9bjS.C7lRa9akM2.BvNmOxJyZzY0QMOtEMeJhEX6L79ycoa', '', 1, '2016-07-14 20:30:16', '2016-07-14 21:56:14', '2016-07-14 21:56:14', '127.0.0.1'),
	(8, 'yueyunpeng', '', '岳云鹏', '$2y$10$3y/GLL6Xp6zQ2.mEMwk5L.lxUpOTi2JnfCeYvSitK/bQhuMMpa.Fu', '18316629974', 1, '2016-07-20 14:47:06', '2016-08-12 11:47:12', '2016-07-21 15:12:01', '127.0.0.1');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;


-- 导出  表 binggq.adminmsg 结构
CREATE TABLE IF NOT EXISTS `adminmsg` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '后台消息',
  `type` tinyint(4) NOT NULL COMMENT '类型',
  `table_id` int(11) NOT NULL COMMENT '记录id',
  `msg` varchar(250) NOT NULL COMMENT '内容',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态:1未读2已读',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='后台系统消息';

-- 正在导出表  binggq.adminmsg 的数据：~16 rows (大约)
DELETE FROM `adminmsg`;
/*!40000 ALTER TABLE `adminmsg` DISABLE KEYS */;
INSERT INTO `adminmsg` (`id`, `type`, `table_id`, `msg`, `status`, `create_time`, `update_time`) VALUES
	(1, 1, 8, '您有一条实名认证申请需处理', 2, '2016-05-13 15:23:08', '2016-07-08 12:16:50'),
	(2, 1, 8, '您有一条专家认证申请需处理', 2, '2016-05-13 17:30:57', '2016-07-08 12:16:54'),
	(3, 1, 8, '您有一条专家认证申请需处理', 2, '2016-05-13 17:33:48', '2016-05-13 18:41:07'),
	(4, 1, 11, '您有一条专家认证申请需处理', 2, '2016-07-01 12:15:00', '2016-07-11 11:11:28'),
	(5, 1, 10, '您有一条专家认证申请需处理', 2, '2016-07-01 20:58:14', '2016-07-11 11:11:59'),
	(6, 1, 7, '您有一条专家认证申请需处理', 1, '2016-07-08 11:27:45', '2016-07-08 11:27:45'),
	(7, 1, 7, '您有一条专家认证申请需处理', 1, '2016-07-08 11:44:09', '2016-07-08 11:44:09'),
	(8, 1, 7, '您有一条专家认证申请需处理', 1, '2016-07-08 11:44:51', '2016-07-08 11:44:51'),
	(9, 1, 7, '您有一条专家认证申请需处理', 1, '2016-07-08 15:38:53', '2016-07-08 15:38:53'),
	(10, 1, 21, '您有一条专家认证申请需处理', 1, '2016-07-27 12:07:19', '2016-07-27 12:07:19'),
	(11, 1, 21, '您有一条专家认证申请需处理', 1, '2016-08-01 12:21:04', '2016-08-01 12:21:04'),
	(12, 1, 21, '您有一条专家认证申请需处理', 1, '2016-08-01 12:21:47', '2016-08-01 12:21:47'),
	(13, 1, 21, '您有一条专家认证申请需处理', 1, '2016-08-03 10:38:55', '2016-08-03 10:38:55'),
	(14, 1, 21, '您有一条专家认证申请需处理', 1, '2016-08-03 11:44:31', '2016-08-03 11:44:31'),
	(15, 1, 21, '您有一条专家认证申请需处理', 1, '2016-08-03 11:52:25', '2016-08-03 11:52:25'),
	(16, 1, 21, '您有一条专家认证申请需处理', 1, '2016-08-03 12:00:43', '2016-08-03 12:00:43');
/*!40000 ALTER TABLE `adminmsg` ENABLE KEYS */;


-- 导出  表 binggq.admin_group 结构
CREATE TABLE IF NOT EXISTS `admin_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL COMMENT '管理员',
  `group_id` int(11) NOT NULL COMMENT '所属组',
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_id` (`admin_id`,`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='管理员群组';

-- 正在导出表  binggq.admin_group 的数据：~2 rows (大约)
DELETE FROM `admin_group`;
/*!40000 ALTER TABLE `admin_group` DISABLE KEYS */;
INSERT INTO `admin_group` (`id`, `admin_id`, `group_id`) VALUES
	(1, 3, 1),
	(2, 4, 1),
	(3, 5, 1);
/*!40000 ALTER TABLE `admin_group` ENABLE KEYS */;


-- 导出  表 binggq.admin_menu 结构
CREATE TABLE IF NOT EXISTS `admin_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL DEFAULT '0',
  `menu_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='用户菜单表';

-- 正在导出表  binggq.admin_menu 的数据：~13 rows (大约)
DELETE FROM `admin_menu`;
/*!40000 ALTER TABLE `admin_menu` DISABLE KEYS */;
INSERT INTO `admin_menu` (`id`, `admin_id`, `menu_id`) VALUES
	(1, 6, 13),
	(2, 6, 16),
	(3, 6, 42),
	(4, 6, 43),
	(6, 8, 13),
	(7, 8, 15),
	(8, 8, 56),
	(9, 8, 45),
	(10, 8, 46),
	(11, 8, 48),
	(14, 8, 12),
	(15, 8, 33),
	(16, 8, 34);
/*!40000 ALTER TABLE `admin_menu` ENABLE KEYS */;


-- 导出  表 binggq.agency 结构
CREATE TABLE IF NOT EXISTS `agency` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '行业标签',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='机构标签库';

-- 正在导出表  binggq.agency 的数据：~29 rows (大约)
DELETE FROM `agency`;
/*!40000 ALTER TABLE `agency` DISABLE KEYS */;
INSERT INTO `agency` (`id`, `pid`, `name`) VALUES
	(1, 0, '投资机构'),
	(2, 0, '融资机构'),
	(3, 0, '顾问机构'),
	(4, 0, '实体企业'),
	(5, 1, '并购基金'),
	(6, 1, 'PE/VC'),
	(7, 1, '天使投资'),
	(8, 0, '个人投资者 '),
	(9, 2, '银行'),
	(10, 2, '券商'),
	(11, 2, '信托'),
	(12, 2, '基金子公司'),
	(13, 2, '财富管理'),
	(14, 2, '融资租赁/保理'),
	(15, 2, '担保'),
	(16, 3, '券商投行'),
	(17, 3, '律所'),
	(18, 3, '会计所'),
	(19, 3, '并购顾问'),
	(20, 3, '咨询机构'),
	(21, 4, 'A股'),
	(22, 4, '港股'),
	(23, 4, '美股'),
	(24, 4, '新三板'),
	(25, 4, '拟上新三板'),
	(26, 4, '拟上新三板'),
	(27, 4, '想被并购'),
	(28, 4, '想融资'),
	(29, 8, '个人投资者');
/*!40000 ALTER TABLE `agency` ENABLE KEYS */;


-- 导出  表 binggq.attach 结构
CREATE TABLE IF NOT EXISTS `attach` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proj_id` int(11) NOT NULL DEFAULT '0' COMMENT '项目id',
  `name` varchar(250) NOT NULL DEFAULT '' COMMENT '名称',
  `path` varchar(250) NOT NULL DEFAULT '' COMMENT '路径',
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='项目附件';

-- 正在导出表  binggq.attach 的数据：~4 rows (大约)
DELETE FROM `attach`;
/*!40000 ALTER TABLE `attach` DISABLE KEYS */;
INSERT INTO `attach` (`id`, `proj_id`, `name`, `path`, `create_time`) VALUES
	(1, 14, '050E000054DB138467379F1D8103FA89.jpg', '/upload/proj/attach/2016-08-18/57b56778dcdc9.jpg', '2016-08-18 15:47:23'),
	(2, 14, '140728mahvppspuqaeejhp.jpg', '/upload/proj/attach/2016-08-18/57b5677c76948.jpg', '2016-08-18 15:47:23'),
	(3, 15, '柠檬智慧科技服务器信息文档.docx', '/upload/proj/attach/2016-08-18/57b57b21bd650.docx', '2016-08-18 15:48:22'),
	(6, 15, 'Untitled Document.pdf', '/upload/proj/attach/2016-08-18/57b57bc033c58.pdf', '2016-08-18 17:11:30'),
	(7, 16, '578158.jpg', '/upload/proj/attach/2016-08-19/57b6e91f6b24b.jpg', '2016-08-19 19:10:48');
/*!40000 ALTER TABLE `attach` ENABLE KEYS */;


-- 导出  表 binggq.banner 结构
CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '轮播图',
  `type` varchar(20) NOT NULL DEFAULT '1' COMMENT '类型',
  `img` varchar(450) NOT NULL COMMENT '图片',
  `url` varchar(450) NOT NULL COMMENT '链接地址',
  `remark` varchar(250) NOT NULL COMMENT '备注说明',
  `enabled` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1启用0禁用',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='轮播图';

-- 正在导出表  binggq.banner 的数据：~7 rows (大约)
DELETE FROM `banner`;
/*!40000 ALTER TABLE `banner` DISABLE KEYS */;
INSERT INTO `banner` (`id`, `type`, `img`, `url`, `remark`, `enabled`, `create_time`) VALUES
	(11, '1', '/upload/banner/2016-07-07/577e2577420dd.png', '/news/view/19', '333', 1, '2016-05-10 11:48:07'),
	(12, '1', '/upload/banner/2016-07-07/577e257fa6de8.png', '/news/view/29', '3333', 1, '2016-05-10 11:48:28'),
	(13, '1', '/upload/banner/2016-07-07/577e258b0dd55.png', '/news/view/30', '3333', 1, '2016-05-10 11:48:41'),
	(14, '2', '/upload/banner/2016-07-07/577e2596a0f66.png', '/mobile/html/api_test.html', '2006年中国国际体育融资总裁年会', 1, '2016-06-07 17:21:31'),
	(15, '2', '/upload/banner/2016-07-07/577e25a15a876.png', '/activity/details/16', 'E店通', 1, '2016-06-07 17:23:05'),
	(16, '3', '/upload/banner/2016-07-07/577e25aad5bef.png', '/meet/view/7', '陈知知', 1, '2016-06-22 09:38:49'),
	(17, '3', '/upload/banner/2016-07-07/577e25b52d00d.png', '/meet/view/8', '古筝大师', 1, '2016-06-22 09:39:54');
/*!40000 ALTER TABLE `banner` ENABLE KEYS */;


-- 导出  表 binggq.biggie_ad 结构
CREATE TABLE IF NOT EXISTS `biggie_ad` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '大咖广告表',
  `savant_id` int(11) NOT NULL COMMENT '大咖id',
  `url` varchar(50) NOT NULL COMMENT '图片地址',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='大咖广告表';

-- 正在导出表  binggq.biggie_ad 的数据：~10 rows (大约)
DELETE FROM `biggie_ad`;
/*!40000 ALTER TABLE `biggie_ad` DISABLE KEYS */;
INSERT INTO `biggie_ad` (`id`, `savant_id`, `url`, `create_time`) VALUES
	(1, 3, '/upload/biggiead/2016-06-28/5771e652830bd.png', '2016-06-25 17:07:17'),
	(2, 0, '/upload/biggiead/2016-06-25/576e7ce17753d.png', '2016-06-25 20:45:46'),
	(3, 0, '/upload/biggiead/2016-06-25/576e7d09ac8d1.png', '2016-06-25 20:46:05'),
	(4, 0, '/upload/biggiead/2016-06-28/5771e86978100.png', '2016-06-28 11:00:59'),
	(5, 5, '/upload/biggiead/2016-07-08/577f2831384c4.jpg', '2016-06-28 11:33:54'),
	(6, 3, '/upload/biggiead/2016-06-28/5771f02e53322.png', '2016-06-28 11:34:52'),
	(7, 5, '/upload/biggiead/2016-07-08/577f281926018.jpg', '2016-06-28 11:35:43'),
	(8, 0, '/upload/biggiead/2016-07-08/577f2862d42cb.jpg', '2016-07-08 12:13:27'),
	(9, 0, '/upload/biggiead/2016-07-08/577f287a0064e.jpg', '2016-07-08 12:13:48'),
	(10, 7, '/upload/biggiead/2016-07-08/577f2a9830c51.jpg', '2016-07-08 12:22:51');
/*!40000 ALTER TABLE `biggie_ad` ENABLE KEYS */;


-- 导出  表 binggq.book_chat 结构
CREATE TABLE IF NOT EXISTS `book_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `reply_id` int(11) NOT NULL COMMENT '回复用户id',
  `book_id` int(11) NOT NULL COMMENT '约见id',
  `content` varchar(140) NOT NULL COMMENT '内容',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='约见聊天表';

-- 正在导出表  binggq.book_chat 的数据：~0 rows (大约)
DELETE FROM `book_chat`;
/*!40000 ALTER TABLE `book_chat` DISABLE KEYS */;
/*!40000 ALTER TABLE `book_chat` ENABLE KEYS */;


-- 导出  表 binggq.candidate 结构
CREATE TABLE IF NOT EXISTS `candidate` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '招聘信息id',
  `truename` varchar(50) NOT NULL DEFAULT '' COMMENT '姓名',
  `birthday` date NOT NULL COMMENT '生日',
  `phone` varchar(50) NOT NULL DEFAULT '' COMMENT '电话',
  `email` varchar(60) NOT NULL DEFAULT '' COMMENT '邮箱',
  `address` varchar(60) NOT NULL DEFAULT '' COMMENT '地址',
  `career` text NOT NULL COMMENT '工作经历',
  `education` text NOT NULL COMMENT '教育经历',
  `salary` varchar(50) NOT NULL COMMENT '期望薪水',
  `remark` varchar(550) NOT NULL DEFAULT '' COMMENT '其他说明',
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='求职者';

-- 正在导出表  binggq.candidate 的数据：~2 rows (大约)
DELETE FROM `candidate`;
/*!40000 ALTER TABLE `candidate` DISABLE KEYS */;
INSERT INTO `candidate` (`id`, `job_id`, `truename`, `birthday`, `phone`, `email`, `address`, `career`, `education`, `salary`, `remark`, `create_time`, `update_time`) VALUES
	(1, 1, '苏谬儿', '2011-08-08', '18316629975', 'ada999@qq.com', '深南大道腾讯大厦', '2014-12-14\r\n湖北大学', '2012-11-11\r\ngoogle+中国', '20K~30K', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(2, 1, '王大锤', '2016-11-11', '18316629975', 'ada1@qq.com', '深南大道腾讯大厦', '来了卡了卡了', 'datepickerdatepickerdatepickerdatepicker', '20K~30K', '秦时明月', '2016-07-21 14:26:06', '2016-08-11 15:45:31');
/*!40000 ALTER TABLE `candidate` ENABLE KEYS */;


-- 导出  表 binggq.card_box 结构
CREATE TABLE IF NOT EXISTS `card_box` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '赠名片表',
  `ownerid` int(11) NOT NULL COMMENT '名片夹主人id',
  `uid` int(11) NOT NULL COMMENT '名片id',
  `resend` tinyint(4) NOT NULL COMMENT '1回赠2不回赠',
  `create_time` datetime NOT NULL COMMENT '????ʱ??',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='赠名片表';

-- 正在导出表  binggq.card_box 的数据：~22 rows (大约)
DELETE FROM `card_box`;
/*!40000 ALTER TABLE `card_box` DISABLE KEYS */;
INSERT INTO `card_box` (`id`, `ownerid`, `uid`, `resend`, `create_time`) VALUES
	(1, 7, 9, 1, '2016-06-25 15:11:12'),
	(2, 13, 10, 2, '2016-06-25 20:22:54'),
	(3, 8, 10, 1, '2016-06-25 21:04:14'),
	(4, 7, 8, 2, '2016-06-26 18:39:17'),
	(5, 8, 13, 2, '2016-06-28 22:09:31'),
	(6, 9, 10, 2, '2016-06-28 22:27:56'),
	(7, 7, 17, 1, '2016-06-29 17:28:25'),
	(8, 10, 19, 2, '2016-06-30 15:18:53'),
	(9, 10, 11, 2, '2016-07-01 14:04:32'),
	(10, 7, 11, 1, '2016-07-01 15:07:46'),
	(11, 19, 10, 1, '2016-07-01 16:43:57'),
	(12, 10, 2, 2, '2016-07-01 17:12:03'),
	(13, 19, 11, 1, '2016-07-01 23:09:03'),
	(14, 11, 7, 1, '2016-07-04 19:52:30'),
	(15, 11, 18, 2, '2016-07-05 17:22:18'),
	(16, 9, 7, 1, '2016-07-06 21:21:48'),
	(17, 17, 10, 2, '2016-07-06 22:28:48'),
	(18, 14, 7, 2, '2016-07-11 10:29:50'),
	(19, 10, 26, 2, '2016-07-11 13:02:05'),
	(20, 14, 24, 2, '2016-07-11 15:31:30'),
	(21, 10, 7, 2, '2016-07-11 16:55:56'),
	(22, 14, 21, 2, '2016-07-11 17:11:30');
/*!40000 ALTER TABLE `card_box` ENABLE KEYS */;


-- 导出  表 binggq.card_box_log 结构
CREATE TABLE IF NOT EXISTS `card_box_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '赠名片记录表',
  `optid` int(11) NOT NULL COMMENT '操作人id',
  `targetid` int(11) NOT NULL COMMENT '目标id',
  `type` tinyint(4) NOT NULL COMMENT '1发放2回赠',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='赠名片记录表';

-- 正在导出表  binggq.card_box_log 的数据：~0 rows (大约)
DELETE FROM `card_box_log`;
/*!40000 ALTER TABLE `card_box_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `card_box_log` ENABLE KEYS */;


-- 导出  表 binggq.career 结构
CREATE TABLE IF NOT EXISTS `career` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '工作经历',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户',
  `company` varchar(50) NOT NULL COMMENT '公司',
  `position` varchar(50) NOT NULL COMMENT '职位',
  `start_date` varchar(20) DEFAULT NULL COMMENT '??ʼ????',
  `end_date` varchar(20) DEFAULT NULL COMMENT '????????',
  `descb` text COMMENT '????',
  `create_time` datetime NOT NULL COMMENT '创建日期',
  `update_time` datetime NOT NULL COMMENT '修改日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='工作经历';

-- 正在导出表  binggq.career 的数据：~4 rows (大约)
DELETE FROM `career`;
/*!40000 ALTER TABLE `career` DISABLE KEYS */;
INSERT INTO `career` (`id`, `user_id`, `company`, `position`, `start_date`, `end_date`, `descb`, `create_time`, `update_time`) VALUES
	(2, 10, '神一样的', '大神', '2009-07-01', '2016-07-01', '很好的  真的饿', '2016-07-01 20:23:34', '2016-07-01 20:23:34'),
	(3, 11, '深圳视客科技', '网页设计', '2016-04-01', '2010-07-01', '网页设计计算机技术', '2016-07-01 22:02:24', '2016-07-01 22:02:24'),
	(4, 8, '神一样的', '大神', '2009-07-01', '2016-07-01', '很好的  真的饿', '2016-07-01 20:23:34', '2016-07-01 20:23:34'),
	(5, 8, '神一样的6', '大神7', '2009-07-01', '2016-07-01', '很好的  真的饿', '2016-07-01 20:23:34', '2016-07-01 20:23:34'),
	(6, 8, '神一样的67', '大神7', '2009-07-01', '2016-07-01', '很好的  真的饿', '2016-07-01 20:23:34', '2016-07-01 20:23:34');
/*!40000 ALTER TABLE `career` ENABLE KEYS */;


-- 导出  表 binggq.collect 结构
CREATE TABLE IF NOT EXISTS `collect` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '点赞日志表',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `relate_id` int(11) NOT NULL COMMENT '关联id（活动id或资讯id）',
  `is_delete` tinyint(4) NOT NULL DEFAULT '1' COMMENT '删除1:删除0正常',
  `type` tinyint(4) NOT NULL COMMENT '类型值：0：活动；1：资讯',
  `create_time` datetime NOT NULL COMMENT '记录时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='点赞日志表';

-- 正在导出表  binggq.collect 的数据：~48 rows (大约)
DELETE FROM `collect`;
/*!40000 ALTER TABLE `collect` DISABLE KEYS */;
INSERT INTO `collect` (`id`, `user_id`, `relate_id`, `is_delete`, `type`, `create_time`, `update_time`) VALUES
	(4, 8, 18, 0, 1, '2016-05-23 20:33:29', '2016-05-23 20:50:00'),
	(5, 9, 16, 1, 0, '2016-06-08 10:26:37', '2016-06-08 10:27:01'),
	(6, 9, 15, 1, 0, '2016-06-08 10:28:17', '2016-06-08 10:28:38'),
	(7, 10, 15, 1, 0, '2016-06-12 14:45:57', '2016-06-21 18:18:20'),
	(8, 10, 19, 0, 1, '2016-06-14 19:47:55', '2016-06-30 11:31:23'),
	(9, 2, 2, 1, 2, '2016-06-21 15:06:38', '2016-06-21 16:09:02'),
	(10, 11, 12, 0, 0, '2016-06-24 18:16:15', '2016-06-24 18:16:15'),
	(11, 11, 16, 0, 1, '2016-06-24 18:19:57', '2016-06-24 18:19:57'),
	(12, 11, 10, 0, 1, '2016-06-24 18:21:22', '2016-06-24 18:21:22'),
	(13, 7, 15, 1, 1, '2016-06-25 11:14:49', '2016-06-25 11:14:57'),
	(14, 11, 18, 1, 1, '2016-06-25 11:20:18', '2016-06-25 11:20:19'),
	(15, 7, 7, 1, 2, '2016-06-25 11:44:41', '2016-07-05 10:48:37'),
	(16, 2, 8, 0, 2, '2016-06-25 18:10:30', '2016-06-25 18:10:30'),
	(17, 2, 10, 1, 0, '2016-06-25 21:19:59', '2016-07-06 18:05:58'),
	(18, 10, 29, 1, 1, '2016-06-26 11:58:02', '2016-07-06 22:30:51'),
	(19, 18, 29, 0, 1, '2016-06-28 10:00:49', '2016-06-28 10:01:04'),
	(20, 11, 24, 0, 1, '2016-06-28 11:17:12', '2016-06-28 11:17:12'),
	(21, 8, 7, 0, 2, '2016-06-28 16:29:29', '2016-06-28 16:29:29'),
	(22, 10, 16, 1, 0, '2016-06-28 20:03:55', '2016-06-28 20:03:56'),
	(23, 8, 19, 0, 1, '2016-06-28 20:31:16', '2016-06-28 20:31:16'),
	(24, 14, 16, 1, 0, '2016-06-28 22:15:48', '2016-06-28 22:27:49'),
	(25, 17, 7, 0, 2, '2016-06-29 17:29:12', '2016-06-29 17:29:12'),
	(26, 18, 7, 0, 2, '2016-06-30 11:50:15', '2016-06-30 11:50:16'),
	(27, 9, 29, 0, 1, '2016-06-30 12:15:21', '2016-06-30 12:15:21'),
	(28, 19, 19, 0, 1, '2016-06-30 20:48:26', '2016-06-30 20:48:26'),
	(29, 11, 14, 0, 0, '2016-07-01 11:39:54', '2016-07-01 11:39:54'),
	(30, 11, 16, 0, 0, '2016-07-01 12:04:06', '2016-07-01 12:04:06'),
	(31, 7, 9, 1, 0, '2016-07-01 21:13:03', '2016-07-01 21:13:04'),
	(32, 11, 7, 0, 2, '2016-07-01 21:25:09', '2016-07-01 21:25:09'),
	(33, 7, 11, 0, 2, '2016-07-04 19:53:59', '2016-07-04 19:53:59'),
	(34, 7, 16, 1, 0, '2016-07-04 19:54:18', '2016-07-05 10:53:18'),
	(35, 7, 8, 1, 0, '2016-07-05 10:27:14', '2016-07-05 10:28:25'),
	(36, 7, 15, 1, 0, '2016-07-05 10:51:30', '2016-07-05 10:51:44'),
	(37, 17, 30, 0, 1, '2016-07-05 15:08:11', '2016-07-08 15:45:01'),
	(38, 7, 21, 1, 0, '2016-07-05 16:57:36', '2016-07-05 16:57:38'),
	(39, 7, 31, 0, 1, '2016-07-05 22:14:31', '2016-07-05 22:14:31'),
	(40, 7, 10, 1, 0, '2016-07-06 10:02:46', '2016-07-06 10:05:12'),
	(41, 10, 31, 0, 1, '2016-07-06 11:52:11', '2016-07-06 11:52:11'),
	(42, 7, 30, 1, 1, '2016-07-06 12:10:22', '2016-07-06 12:10:23'),
	(43, 10, 21, 0, 0, '2016-07-06 17:24:11', '2016-07-06 17:24:11'),
	(44, 15, 10, 0, 0, '2016-07-06 17:26:41', '2016-07-06 17:26:41'),
	(45, 2, 31, 0, 1, '2016-07-07 19:06:05', '2016-07-07 19:06:08'),
	(46, 17, 32, 0, 1, '2016-07-08 15:47:34', '2016-07-08 15:47:34'),
	(47, 17, 24, 0, 0, '2016-07-08 16:24:45', '2016-07-08 16:24:45'),
	(48, 25, 24, 0, 0, '2016-07-11 11:29:25', '2016-07-11 11:29:25'),
	(49, 28, 24, 1, 0, '2016-07-11 15:41:21', '2016-07-11 15:41:23'),
	(50, 7, 32, 1, 1, '2016-07-11 15:43:10', '2016-07-11 15:43:11'),
	(51, 24, 24, 1, 0, '2016-07-11 16:18:39', '2016-07-11 16:18:40');
/*!40000 ALTER TABLE `collect` ENABLE KEYS */;


-- 导出  表 binggq.comment_like 结构
CREATE TABLE IF NOT EXISTS `comment_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论点赞表',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `relate_id` int(11) NOT NULL COMMENT '点赞相关id，例：活动id或者是资讯id',
  `type` tinyint(4) NOT NULL COMMENT '类型值：0：活动；1：资讯',
  `create_time` datetime NOT NULL COMMENT '点赞时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8 COMMENT='评论点赞表';

-- 正在导出表  binggq.comment_like 的数据：~88 rows (大约)
DELETE FROM `comment_like`;
/*!40000 ALTER TABLE `comment_like` DISABLE KEYS */;
INSERT INTO `comment_like` (`id`, `user_id`, `relate_id`, `type`, `create_time`) VALUES
	(6, 8, 9, 1, '2016-05-20 15:11:54'),
	(7, 8, 15, 1, '2016-05-20 15:25:29'),
	(8, 8, 16, 1, '2016-05-20 15:32:54'),
	(9, 8, 16, 2, '2016-05-20 15:32:54'),
	(10, 7, 16, 1, '2016-05-20 15:32:54'),
	(11, 8, 17, 1, '2016-05-20 16:54:17'),
	(12, 8, 18, 1, '2016-05-20 16:58:43'),
	(13, 8, 19, 1, '2016-05-20 16:59:55'),
	(14, 8, 14, 1, '2016-05-23 10:30:25'),
	(15, 8, 5, 1, '2016-05-23 10:59:39'),
	(16, 8, 20, 1, '2016-05-23 11:17:43'),
	(17, 8, 21, 1, '2016-05-23 11:22:01'),
	(18, 8, 22, 1, '2016-05-23 11:22:34'),
	(19, 8, 23, 1, '2016-05-23 15:55:47'),
	(20, 10, 5, 1, '0000-00-00 00:00:00'),
	(21, 10, 9, 1, '0000-00-00 00:00:00'),
	(22, 10, 26, 1, '0000-00-00 00:00:00'),
	(23, 10, 20, 1, '0000-00-00 00:00:00'),
	(24, 10, 21, 1, '0000-00-00 00:00:00'),
	(25, 10, 25, 1, '0000-00-00 00:00:00'),
	(26, 10, 29, 1, '0000-00-00 00:00:00'),
	(27, 7, 40, 1, '0000-00-00 00:00:00'),
	(28, 8, 21, 0, '0000-00-00 00:00:00'),
	(29, 18, 39, 1, '0000-00-00 00:00:00'),
	(30, 10, 18, 0, '0000-00-00 00:00:00'),
	(31, 10, 20, 0, '0000-00-00 00:00:00'),
	(32, 19, 60, 1, '0000-00-00 00:00:00'),
	(33, 10, 62, 1, '0000-00-00 00:00:00'),
	(34, 10, 61, 1, '0000-00-00 00:00:00'),
	(35, 10, 60, 1, '0000-00-00 00:00:00'),
	(36, 10, 49, 1, '0000-00-00 00:00:00'),
	(37, 10, 47, 1, '0000-00-00 00:00:00'),
	(38, 7, 63, 1, '0000-00-00 00:00:00'),
	(39, 7, 60, 1, '0000-00-00 00:00:00'),
	(40, 10, 64, 1, '0000-00-00 00:00:00'),
	(41, 10, 63, 1, '0000-00-00 00:00:00'),
	(42, 9, 20, 0, '0000-00-00 00:00:00'),
	(43, 10, 26, 0, '0000-00-00 00:00:00'),
	(44, 19, 64, 1, '0000-00-00 00:00:00'),
	(45, 19, 65, 1, '0000-00-00 00:00:00'),
	(46, 10, 46, 1, '0000-00-00 00:00:00'),
	(47, 11, 21, 0, '0000-00-00 00:00:00'),
	(48, 11, 28, 0, '0000-00-00 00:00:00'),
	(49, 10, 65, 1, '0000-00-00 00:00:00'),
	(50, 11, 26, 0, '0000-00-00 00:00:00'),
	(51, 11, 65, 1, '0000-00-00 00:00:00'),
	(52, 11, 64, 1, '0000-00-00 00:00:00'),
	(53, 7, 21, 0, '0000-00-00 00:00:00'),
	(54, 7, 66, 1, '0000-00-00 00:00:00'),
	(55, 7, 31, 0, '0000-00-00 00:00:00'),
	(56, 7, 30, 0, '0000-00-00 00:00:00'),
	(57, 19, 61, 1, '2016-07-05 18:28:27'),
	(58, 19, 62, 1, '2016-07-05 18:29:03'),
	(59, 19, 63, 1, '2016-07-05 18:29:23'),
	(60, 19, 49, 1, '2016-07-05 18:29:42'),
	(61, 7, 62, 1, '2016-07-05 20:20:28'),
	(62, 7, 65, 1, '2016-07-05 20:21:02'),
	(63, 7, 68, 1, '2016-07-05 22:14:21'),
	(64, 7, 36, 0, '2016-07-06 10:02:43'),
	(65, 7, 28, 0, '2016-07-06 10:02:45'),
	(66, 7, 61, 1, '2016-07-06 10:22:38'),
	(67, 7, 49, 1, '2016-07-06 10:22:41'),
	(68, 7, 47, 1, '2016-07-06 10:22:42'),
	(69, 7, 71, 1, '2016-07-06 12:03:59'),
	(70, 10, 45, 0, '2016-07-06 17:28:23'),
	(71, 10, 44, 0, '2016-07-06 17:28:25'),
	(72, 21, 66, 1, '2016-07-06 21:57:16'),
	(73, 7, 69, 1, '2016-07-07 17:52:34'),
	(74, 10, 76, 1, '2016-07-08 12:05:35'),
	(75, 10, 77, 1, '2016-07-08 12:07:44'),
	(76, 10, 70, 1, '2016-07-08 12:07:45'),
	(77, 10, 69, 1, '2016-07-08 12:08:02'),
	(78, 10, 49, 0, '2016-07-08 12:09:22'),
	(79, 14, 21, 0, '2016-07-09 13:02:52'),
	(80, 24, 79, 1, '2016-07-09 21:10:46'),
	(81, 7, 50, 0, '2016-07-11 10:30:33'),
	(82, 25, 73, 1, '2016-07-11 11:17:06'),
	(83, 25, 81, 1, '2016-07-11 11:17:25'),
	(84, 25, 75, 1, '2016-07-11 11:17:30'),
	(85, 26, 72, 1, '2016-07-11 12:56:06'),
	(86, 26, 63, 1, '2016-07-11 12:56:20'),
	(87, 26, 79, 1, '2016-07-11 15:29:47'),
	(88, 7, 79, 1, '2016-07-11 15:30:00'),
	(89, 28, 52, 0, '2016-07-11 15:41:49'),
	(90, 7, 78, 1, '2016-07-11 15:51:21'),
	(91, 15, 46, 0, '2016-07-12 15:32:45'),
	(92, 15, 47, 0, '2016-07-12 15:32:47'),
	(93, 15, 48, 0, '2016-07-12 15:32:48');
/*!40000 ALTER TABLE `comment_like` ENABLE KEYS */;


-- 导出  表 binggq.education 结构
CREATE TABLE IF NOT EXISTS `education` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '教育经历表',
  `user_id` int(11) NOT NULL COMMENT '用户',
  `school` varchar(50) NOT NULL COMMENT '学校',
  `major` varchar(50) NOT NULL COMMENT '专业',
  `education` varchar(50) NOT NULL COMMENT '学历',
  `start_date` varchar(20) DEFAULT NULL COMMENT '??ʼ????',
  `end_date` varchar(20) DEFAULT NULL COMMENT '????????',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='教育经历';

-- 正在导出表  binggq.education 的数据：~4 rows (大约)
DELETE FROM `education`;
/*!40000 ALTER TABLE `education` DISABLE KEYS */;
INSERT INTO `education` (`id`, `user_id`, `school`, `major`, `education`, `start_date`, `end_date`, `create_time`, `update_time`) VALUES
	(1, 10, '北京大学', '计算机', '1', '2016-07-01', '2016-08-01', '2016-07-01 20:22:28', '2016-07-01 20:22:28'),
	(2, 11, '深圳大学', '计算机系', '1', '2016-02-01', '2016-07-04', '2016-07-01 22:01:16', '2016-07-01 22:01:16'),
	(3, 8, '深圳大学', '家里蹲', '3', '2016-02-01', '2016-02-01', '2016-07-01 22:01:16', '2016-08-08 19:05:38'),
	(4, 8, '深圳大学3', '计算机系', '1', '2016-02-01', '2016-07-04', '2016-07-01 22:01:16', '2016-07-01 22:01:16'),
	(5, 8, '深圳大学2', '计算机系', '1', '2016-02-01', '2016-07-04', '2016-07-01 22:01:16', '2016-07-01 22:01:16');
/*!40000 ALTER TABLE `education` ENABLE KEYS */;


-- 导出  表 binggq.flow 结构
CREATE TABLE IF NOT EXISTS `flow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户',
  `relate_id` int(11) NOT NULL DEFAULT '0' COMMENT '关联id',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '交易类型',
  `type_msg` varchar(50) NOT NULL COMMENT '类型名称',
  `income` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否收入1:收入2:支出',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '交易金额',
  `pre_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '交易前金额',
  `after_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '交易后金额',
  `status` tinyint(4) NOT NULL COMMENT '交易状态0冻结1正常2作废',
  `remark` varchar(50) NOT NULL COMMENT '备注',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='用户资金流水';

-- 正在导出表  binggq.flow 的数据：~7 rows (大约)
DELETE FROM `flow`;
/*!40000 ALTER TABLE `flow` DISABLE KEYS */;
INSERT INTO `flow` (`id`, `user_id`, `relate_id`, `type`, `type_msg`, `income`, `amount`, `pre_amount`, `after_amount`, `status`, `remark`, `create_time`, `update_time`) VALUES
	(1, 10, 0, 1, '约见收入', 1, 300.00, 0.00, 0.00, 1, '', '2016-07-13 00:00:00', '0000-00-00 00:00:00'),
	(2, 21, 7, 3, '提现支出', 2, 1000.00, 15000.00, 14000.00, 1, '用户提现支出', '2016-07-27 14:20:59', '2016-07-27 16:29:42'),
	(3, 21, 8, 3, '提现支出', 2, 200.00, 14000.00, 13800.00, 2, '用户提现支出', '2016-07-27 16:52:34', '2016-07-27 16:53:22'),
	(4, 21, 8, 4, '提现失败退回', 1, 200.00, 13800.00, 14000.00, 1, '用户提现失败退回', '2016-07-27 16:53:22', '2016-07-27 16:53:22'),
	(5, 21, 9, 3, '提现支出', 2, 100.00, 14000.00, 13900.00, 1, '用户提现支出', '2016-07-27 16:54:41', '2016-07-27 17:04:54'),
	(6, 8, 10, 3, '提现支出', 2, 124.00, 13900.00, 13776.00, 2, '用户提现支出', '2016-08-06 11:41:59', '2016-08-06 11:42:26'),
	(7, 8, 10, 4, '提现失败退回', 1, 124.00, 13776.00, 13900.00, 1, '用户提现失败退回', '2016-08-06 11:42:26', '2016-08-06 11:42:26'),
	(8, 8, 11, 3, '提现支出', 2, 100.00, 13900.00, 13800.00, 0, '用户提现支出', '2016-08-06 11:51:54', '2016-08-06 11:51:54');
/*!40000 ALTER TABLE `flow` ENABLE KEYS */;


-- 导出  表 binggq.group 结构
CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '群组名称',
  `remark` varchar(50) NOT NULL COMMENT '备注',
  `ctime` datetime NOT NULL COMMENT '创建时间',
  `utime` datetime NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='群组管理\r\n';

-- 正在导出表  binggq.group 的数据：~2 rows (大约)
DELETE FROM `group`;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
INSERT INTO `group` (`id`, `name`, `remark`, `ctime`, `utime`) VALUES
	(1, '业务员', '勤劳的业务员', '2016-05-05 19:38:00', '2016-05-05 19:38:00'),
	(2, '总裁办', '总裁办', '2016-05-10 19:39:00', '2016-05-10 19:39:00');
/*!40000 ALTER TABLE `group` ENABLE KEYS */;


-- 导出  表 binggq.group_menu 结构
CREATE TABLE IF NOT EXISTS `group_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL DEFAULT '0' COMMENT '群组',
  `menu_id` int(11) NOT NULL DEFAULT '0' COMMENT '权限',
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_id` (`group_id`,`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='群组权限';

-- 正在导出表  binggq.group_menu 的数据：~6 rows (大约)
DELETE FROM `group_menu`;
/*!40000 ALTER TABLE `group_menu` DISABLE KEYS */;
INSERT INTO `group_menu` (`id`, `group_id`, `menu_id`) VALUES
	(1, 1, 20),
	(2, 1, 22),
	(3, 1, 23),
	(4, 2, 2),
	(5, 2, 7),
	(6, 2, 11);
/*!40000 ALTER TABLE `group_menu` ENABLE KEYS */;


-- 导出  表 binggq.industry 结构
CREATE TABLE IF NOT EXISTS `industry` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '行业标签',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='行业标签库';

-- 正在导出表  binggq.industry 的数据：~21 rows (大约)
DELETE FROM `industry`;
/*!40000 ALTER TABLE `industry` DISABLE KEYS */;
INSERT INTO `industry` (`id`, `pid`, `name`) VALUES
	(1, 0, '行业投资'),
	(2, 0, '资金业务'),
	(3, 0, '其它'),
	(4, 1, '医疗健康'),
	(5, 1, '互联网+'),
	(6, 1, '大消费'),
	(7, 1, '文化传媒'),
	(8, 1, '工业4.0'),
	(9, 1, '新能源'),
	(10, 1, '新材料'),
	(11, 1, '节能环保'),
	(12, 1, '军工/高端装备'),
	(13, 2, '定增基金'),
	(14, 2, '优先资金'),
	(15, 2, '过桥资金'),
	(16, 2, '股票质押'),
	(17, 2, '税务筹划'),
	(18, 2, '结构化融资'),
	(19, 2, '债券'),
	(20, 5, '研发'),
	(21, 3, '其他');
/*!40000 ALTER TABLE `industry` ENABLE KEYS */;


-- 导出  表 binggq.job 结构
CREATE TABLE IF NOT EXISTS `job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` varchar(50) NOT NULL DEFAULT '' COMMENT '公司',
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '负责人id',
  `contact` varchar(150) NOT NULL DEFAULT '' COMMENT '联系方式',
  `earnings` tinyint(4) NOT NULL DEFAULT '1' COMMENT '分成方式',
  `position` varchar(50) NOT NULL DEFAULT '' COMMENT '招聘职位',
  `salary` varchar(50) NOT NULL DEFAULT '' COMMENT '薪资范围',
  `address` varchar(150) NOT NULL DEFAULT '' COMMENT '工作地点',
  `summary` varchar(750) NOT NULL DEFAULT '' COMMENT '招聘简介',
  `is_finish` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否已完成:1完成0未完成',
  `remark` varchar(250) NOT NULL DEFAULT '' COMMENT '备注',
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='招聘信息';

-- 正在导出表  binggq.job 的数据：~1 rows (大约)
DELETE FROM `job`;
/*!40000 ALTER TABLE `job` DISABLE KEYS */;
INSERT INTO `job` (`id`, `company`, `admin_id`, `contact`, `earnings`, `position`, `salary`, `address`, `summary`, `is_finish`, `remark`, `create_time`, `update_time`) VALUES
	(1, '腾讯科技', 3, '深南大道腾讯大厦', 1, '扫地阿姨', '20K~30K', '深南大道腾讯大厦', '要求扫地经验10年以上', 1, '', '2016-07-21 11:34:32', '2016-08-12 15:52:48');
/*!40000 ALTER TABLE `job` ENABLE KEYS */;


-- 导出  表 binggq.job_industry 结构
CREATE TABLE IF NOT EXISTS `job_industry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `industry_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='招聘行业标签';

-- 正在导出表  binggq.job_industry 的数据：~2 rows (大约)
DELETE FROM `job_industry`;
/*!40000 ALTER TABLE `job_industry` DISABLE KEYS */;
INSERT INTO `job_industry` (`id`, `job_id`, `industry_id`) VALUES
	(1, 1, 6),
	(2, 1, 7);
/*!40000 ALTER TABLE `job_industry` ENABLE KEYS */;


-- 导出  表 binggq.like_logs 结构
CREATE TABLE IF NOT EXISTS `like_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '点赞日志表',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `relate_id` int(11) NOT NULL COMMENT '关联id（活动id或资讯id）',
  `msg` varchar(255) NOT NULL COMMENT '日志内容',
  `create_time` datetime NOT NULL COMMENT '记录时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  `type` tinyint(4) NOT NULL COMMENT '类型值：0：活动；1：资讯',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COMMENT='点赞日志表';

-- 正在导出表  binggq.like_logs 的数据：~53 rows (大约)
DELETE FROM `like_logs`;
/*!40000 ALTER TABLE `like_logs` DISABLE KEYS */;
INSERT INTO `like_logs` (`id`, `user_id`, `relate_id`, `msg`, `create_time`, `update_time`, `type`) VALUES
	(1, 8, 18, '进行了点赞', '2016-05-23 16:06:07', '2016-05-23 16:06:07', 1),
	(2, 10, 18, '进行了点赞', '2016-06-07 20:55:05', '2016-06-07 20:55:05', 1),
	(3, 9, 16, '进行了点赞', '2016-06-07 22:40:32', '2016-06-07 22:40:32', 0),
	(4, 10, 15, '进行了点赞', '2016-06-12 14:17:48', '2016-06-12 14:17:48', 0),
	(5, 11, 15, '进行了点赞', '2016-06-24 17:04:55', '2016-06-24 17:04:55', 0),
	(6, 7, 10, '进行了点赞', '2016-06-25 11:51:42', '2016-06-25 11:51:42', 0),
	(7, 7, 18, '进行了点赞', '2016-06-25 12:02:15', '2016-06-25 12:02:15', 1),
	(8, 10, 29, '进行了点赞', '2016-06-25 20:28:46', '2016-06-25 20:28:46', 1),
	(9, 8, 29, '进行了点赞', '2016-06-25 20:36:13', '2016-06-25 20:36:13', 1),
	(10, 7, 29, '进行了点赞', '2016-06-26 12:57:58', '2016-06-26 12:57:58', 1),
	(11, 10, 16, '进行了点赞', '2016-06-26 15:24:34', '2016-06-26 15:24:34', 0),
	(12, 18, 16, '进行了点赞', '2016-06-28 10:43:59', '2016-06-28 10:43:59', 1),
	(13, 10, 19, '进行了点赞', '2016-06-30 11:29:32', '2016-06-30 11:29:32', 1),
	(14, 10, 8, '进行了点赞', '2016-06-30 11:38:38', '2016-06-30 11:38:38', 0),
	(15, 19, 19, '进行了点赞', '2016-06-30 13:22:57', '2016-06-30 13:22:57', 1),
	(16, 11, 29, '进行了点赞', '2016-06-30 14:53:34', '2016-06-30 14:53:34', 1),
	(17, 11, 19, '进行了点赞', '2016-06-30 20:04:28', '2016-06-30 20:04:28', 1),
	(18, 10, 12, '进行了点赞', '2016-06-30 21:09:36', '2016-06-30 21:09:36', 0),
	(19, 10, 14, '进行了点赞', '2016-06-30 21:10:36', '2016-06-30 21:10:36', 0),
	(20, 9, 12, '进行了点赞', '2016-07-01 09:55:22', '2016-07-01 09:55:22', 0),
	(21, 9, 13, '进行了点赞', '2016-07-01 10:00:04', '2016-07-01 10:00:04', 0),
	(22, 11, 12, '进行了点赞', '2016-07-01 10:00:57', '2016-07-01 10:00:57', 0),
	(23, 9, 15, '进行了点赞', '2016-07-01 10:01:39', '2016-07-01 10:01:39', 0),
	(24, 2, 11, '进行了点赞', '2016-07-01 10:07:27', '2016-07-01 10:07:27', 0),
	(25, 9, 14, '进行了点赞', '2016-07-01 10:07:38', '2016-07-01 10:07:38', 0),
	(26, 11, 11, '进行了点赞', '2016-07-01 10:09:40', '2016-07-01 10:09:40', 0),
	(27, 9, 10, '进行了点赞', '2016-07-01 10:11:45', '2016-07-01 10:11:45', 0),
	(28, 19, 12, '进行了点赞', '2016-07-01 10:15:11', '2016-07-01 10:15:11', 0),
	(29, 11, 10, '进行了点赞', '2016-07-01 10:27:24', '2016-07-01 10:27:24', 0),
	(30, 11, 14, '进行了点赞', '2016-07-01 11:36:46', '2016-07-01 11:36:46', 0),
	(31, 11, 16, '进行了点赞', '2016-07-01 11:44:49', '2016-07-01 11:44:49', 0),
	(32, 2, 29, '进行了点赞', '2016-07-01 17:11:20', '2016-07-01 17:11:20', 1),
	(33, 9, 29, '进行了点赞', '2016-07-01 20:12:53', '2016-07-01 20:12:53', 1),
	(34, 11, 8, '进行了点赞', '2016-07-01 22:36:41', '2016-07-01 22:36:41', 0),
	(35, 10, 30, '进行了点赞', '2016-07-03 21:08:31', '2016-07-03 21:08:31', 1),
	(36, 11, 30, '进行了点赞', '2016-07-04 09:29:03', '2016-07-04 09:29:03', 1),
	(37, 7, 16, '进行了点赞', '2016-07-04 19:51:44', '2016-07-04 19:51:44', 0),
	(38, 7, 30, '进行了点赞', '2016-07-05 10:33:29', '2016-07-05 10:33:29', 1),
	(39, 9, 30, '进行了点赞', '2016-07-05 10:34:20', '2016-07-05 10:34:20', 1),
	(40, 7, 31, '进行了点赞', '2016-07-05 15:11:14', '2016-07-05 15:11:14', 1),
	(41, 7, 21, '进行了点赞', '2016-07-05 20:17:03', '2016-07-05 20:17:03', 0),
	(42, 19, 16, '进行了点赞', '2016-07-05 20:18:21', '2016-07-05 20:18:21', 0),
	(43, 7, 19, '进行了点赞', '2016-07-05 20:19:53', '2016-07-05 20:19:53', 1),
	(44, 7, 15, '进行了点赞', '2016-07-05 20:46:29', '2016-07-05 20:46:29', 0),
	(45, 7, 20, '进行了点赞', '2016-07-06 18:17:35', '2016-07-06 18:17:35', 0),
	(46, 10, 32, '进行了点赞', '2016-07-08 12:05:32', '2016-07-08 12:05:32', 1),
	(47, 10, 24, '进行了点赞', '2016-07-08 12:05:53', '2016-07-08 12:05:53', 0),
	(48, 10, 31, '进行了点赞', '2016-07-08 12:07:48', '2016-07-08 12:07:48', 1),
	(49, 14, 16, '进行了点赞', '2016-07-09 13:04:15', '2016-07-09 13:04:15', 0),
	(50, 25, 29, '进行了点赞', '2016-07-11 11:17:28', '2016-07-11 11:17:28', 1),
	(51, 7, 32, '进行了点赞', '2016-07-11 15:34:03', '2016-07-11 15:34:03', 1),
	(52, 24, 29, '进行了点赞', '2016-07-11 15:34:13', '2016-07-11 15:34:13', 1),
	(53, 28, 24, '进行了点赞', '2016-07-11 15:41:13', '2016-07-11 15:41:13', 0);
/*!40000 ALTER TABLE `like_logs` ENABLE KEYS */;


-- 导出  表 binggq.log 结构
CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `flag` varchar(50) NOT NULL DEFAULT '',
  `msg` varchar(550) NOT NULL DEFAULT '',
  `data` text,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COMMENT='重要的信息日志记录';

-- 正在导出表  binggq.log 的数据：~32 rows (大约)
DELETE FROM `log`;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` (`id`, `flag`, `msg`, `data`, `create_time`) VALUES
	(1, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-07-13 09:45:47'),
	(2, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-07-25 11:33:24'),
	(3, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-07-25 15:18:26'),
	(4, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-07-25 15:18:29'),
	(5, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-07-25 15:18:30'),
	(6, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-07-25 15:18:32'),
	(7, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-07-25 15:18:33'),
	(8, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-07-25 15:18:35'),
	(9, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-07-25 15:18:37'),
	(10, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-07-25 16:13:57'),
	(11, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-07-25 16:13:59'),
	(12, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-07-26 14:12:29'),
	(13, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-08-04 20:16:29'),
	(14, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-08-06 16:18:47'),
	(15, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-08-06 16:22:06'),
	(16, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-08-06 16:27:20'),
	(17, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-08-06 16:29:24'),
	(18, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-08-06 16:29:28'),
	(19, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-08-06 16:30:24'),
	(20, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-08-06 16:31:11'),
	(21, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-08-06 16:31:35'),
	(22, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-08-06 16:59:06'),
	(23, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-08-06 17:00:08'),
	(24, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-08-06 17:05:30'),
	(25, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-08-06 17:08:31'),
	(26, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-08-06 17:17:31'),
	(27, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-08-06 17:17:33'),
	(28, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-08-06 17:25:03'),
	(29, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-08-06 17:32:47'),
	(30, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-08-06 17:48:48'),
	(31, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-08-06 17:48:57'),
	(32, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-08-06 17:49:00'),
	(33, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-08-06 18:16:43'),
	(34, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-08-06 18:17:14'),
	(35, 'order', '一个测试日志', 'array (\n  \'foo\' => \'bar\',\n  \'you\' => \'done\',\n)', '2016-08-08 09:18:06');
/*!40000 ALTER TABLE `log` ENABLE KEYS */;


-- 导出  表 binggq.meet_subject 结构
CREATE TABLE IF NOT EXISTS `meet_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '专家id',
  `title` varchar(150) NOT NULL DEFAULT '' COMMENT '标题',
  `summary` varchar(550) NOT NULL DEFAULT '' COMMENT '简介',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '类型:1对1,2对多',
  `invite_time` varchar(50) NOT NULL DEFAULT '' COMMENT 'Լ??ʱ??',
  `price` decimal(10,2) NOT NULL COMMENT '价格',
  `address` varchar(250) NOT NULL DEFAULT '' COMMENT '??ַ',
  `last_time` tinyint(4) NOT NULL DEFAULT '0' COMMENT '持续时间',
  `is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1删除0正常',
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='专家主题';

-- 正在导出表  binggq.meet_subject 的数据：~6 rows (大约)
DELETE FROM `meet_subject`;
/*!40000 ALTER TABLE `meet_subject` DISABLE KEYS */;
INSERT INTO `meet_subject` (`id`, `user_id`, `title`, `summary`, `type`, `invite_time`, `price`, `address`, `last_time`, `is_del`, `create_time`, `update_time`) VALUES
	(1, 8, '测试话题', '抓拍阿狗阿猫是个练习追焦的好办法，所以我相机包里会放一瓶狗粮用来犒劳模特和让模特保持注意力（之所以不是猫粮是因为我家养的是狗，不过流浪猫挺喜欢吃狗粮的）。\n\n照片中那个碗是邻居送来的红烧肉，小狗馋的的眼珠都像要掉', 2, '2015年5月20日15:00', 150.00, '深圳是福田区东海国际公寓', 1, 0, '2016-05-16 15:22:47', '2016-05-16 15:22:47'),
	(2, 8, '互联网开发讲座', '呵呵我就是来扯淡的', 1, '2015年5月20日15:00', 200.00, '深圳是福田区东海国际公寓', 2, 0, '2016-05-16 15:24:30', '2016-05-16 15:24:30'),
	(3, 7, '互联网开发讲座', '呵呵我就是来扯淡的', 1, '2015年5月20日15:00', 200.00, '深圳是福田区东海国际公寓', 2, 0, '2016-05-16 15:24:30', '2016-05-16 15:24:30'),
	(4, 7, '测试话题', '抓拍阿狗阿猫是个练习追焦的好办法，所以我相机包里会放一瓶狗粮用来犒劳模特和让模特保持注意力（之所以不是猫粮是因为我家养的是狗，不过流浪猫挺喜欢吃狗粮的）。\n\n照片中那个碗是邻居送来的红烧肉，小狗馋的的眼珠都像要掉', 2, '2015年5月20日15:00', 150.00, '深圳是福田区东海国际公寓', 1, 1, '2016-05-16 15:22:47', '2016-08-01 16:20:43'),
	(5, 10, '中型网络开发', '研发团队能力模型，工程预估', 1, '随时', 300.00, '深圳', 2, 0, '2016-07-05 11:41:51', '2016-07-05 11:41:51'),
	(6, 17, '吃', '论如何吃成一个瘦子', 1, '夏天', 1.00, '西瓜园', 1, 0, '2016-07-05 17:23:48', '2016-07-13 21:54:29');
/*!40000 ALTER TABLE `meet_subject` ENABLE KEYS */;


-- 导出  表 binggq.menu 结构
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '节点名称',
  `node` varchar(50) DEFAULT NULL COMMENT '路径',
  `pid` int(11) NOT NULL COMMENT '父ID',
  `class` varchar(50) DEFAULT NULL COMMENT '样式',
  `rank` int(6) DEFAULT NULL COMMENT '排序',
  `is_menu` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否在菜单显示',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `remark` varchar(100) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='菜单表';

-- 正在导出表  binggq.menu 的数据：~62 rows (大约)
DELETE FROM `menu`;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `name`, `node`, `pid`, `class`, `rank`, `is_menu`, `status`, `remark`) VALUES
	(1, '系统管理', '', 0, 'icon-cog', 1, 1, 1, ''),
	(2, '菜单管理', '/admin/menu/index', 1, 'icon-align-justify', NULL, 1, 1, ''),
	(3, '行业标签管理', '/admin/industry/index', 36, 'icon-beaker', NULL, 1, 1, ''),
	(6, '机构标签管理', '/admin/agency/index', 36, 'icon-building', NULL, 1, 1, ''),
	(7, '机构标签添加', '/admin/agency/add', 6, '', NULL, 0, 1, ''),
	(10, '菜单添加', '/admin/menu/add', 2, '', NULL, 0, 1, '菜单添加'),
	(11, '用户管理', '', 0, 'icon-user', 20, 1, 1, ''),
	(12, '会员管理', '/admin/user/index', 11, 'icon-user', 1, 1, 1, ''),
	(13, '资讯管理', '/admin/news/index', 43, 'icon-newspaper-o', 10, 1, 1, ''),
	(15, '添加资讯', '/admin/news/add', 13, '', NULL, 0, 1, ''),
	(16, '活动管理', '/admin/activity/index', 42, 'icon-trophy', 9, 1, 1, ''),
	(17, '轮播图管理', '/admin/banner/index', 41, 'icon-file-image', 7, 1, 1, ''),
	(19, '融资项目管理', '/admin/projrong/index', 20, 'icon-cubes', NULL, 1, 1, ''),
	(20, '项目管理', '', 0, 'icon-diamond', 17, 1, 1, ''),
	(23, '群组管理', '/wpadmin/group/index', 1, 'icon-group', NULL, 0, 1, ''),
	(24, '轮播图添加', '/admin/banner/add', 24, '', NULL, 0, 1, ''),
	(25, '添加行业标签', '/admin/industry/add', 3, '', NULL, 0, 1, ''),
	(26, '实名认证', '/admin/user/realname', 11, 'icon-eye-open', NULL, 0, 1, ''),
	(27, '数据统计', '', 0, 'icon-sitemap', 13, 1, 1, ''),
	(28, '招聘管理', '', 0, 'icon-envelope-alt', 16, 1, 1, ''),
	(29, '提现管理', '/admin/withdraw/index', 1, 'icon-dollar', NULL, 1, 1, '用户的提现管理'),
	(30, '活动评论管理', '/admin/activitycom/index', 35, 'icon-comments', NULL, 1, 1, ''),
	(31, '资讯评论管理', '/admin/newscom/index', 35, 'icon-comments', NULL, 1, 1, ''),
	(32, '大咖推荐', '/admin/biggie-ad/index', 41, 'icon-lightbulb', 8, 1, 1, ''),
	(33, '添加会员', '/admin/user/add', 12, '', NULL, 0, 1, '后台添加会员'),
	(34, '会员编辑', '/admin/user/edit', 12, '', 999, 0, 1, '对会员信息的编辑'),
	(35, '评论管理', '', 0, 'icon-comments-alt', 13, 1, 1, '包含所有平评论的管理入口'),
	(36, '标签管理', '', 0, 'icon-tags', 14, 1, 1, '个人标签、行业标签'),
	(37, '小秘书', '/admin/need/index', 49, 'icon-coffee', NULL, 1, 1, ''),
	(38, '专家管理', '/admin/savant/index', 11, 'icon-group', NULL, 1, 1, ''),
	(39, '地区管理', '/admin/region/index', 36, 'icon-building', NULL, 1, 1, ''),
	(40, '个人标签', '/admin/profiletag/index', 36, 'icon-tag', NULL, 1, 1, ''),
	(41, '广告管理', '', 0, 'icon-picture', 15, 1, 1, ''),
	(42, '活动管理', '', 0, 'icon-trophy', 19, 1, 1, ''),
	(43, '资讯管理', '', 0, 'icon-newspaper-o', 18, 1, 1, ''),
	(44, '话题管理', '/admin/meet-subject/index', 11, 'icon-chat-line', NULL, 1, 1, ''),
	(45, '高级会员管理', '/admin/senior/index', 11, 'icon-user', NULL, 1, 1, ''),
	(46, 'vip会员管理', '/admin/vip/index', 11, 'icon-user', NULL, 1, 1, ''),
	(47, '管理员管理', '/admin/admin/index', 1, 'icon-meh', NULL, 1, 1, ''),
	(48, '高级会员编辑', '/admin/senior/edit', 45, '', NULL, 0, 1, ''),
	(49, '消息中心', '/admin/adminmsg/index', 0, 'icon-bell', -1, 1, 1, ''),
	(50, '活动添加', '/admin/activity/add', 16, '', NULL, 0, 1, ''),
	(51, '需求管理', '/admin/projneed/index', 20, 'icon-laptop', NULL, 1, 1, ''),
	(52, '添加需求', '/admin/projneed/add', 51, '', NULL, 0, 1, ''),
	(53, '修改需求', '/admin/projneed/edit', 51, '', NULL, 0, 1, ''),
	(54, '主面板', '', 0, '', NULL, 0, 1, ''),
	(55, '首页', '/admin/index/index', 54, '', NULL, 0, 1, ''),
	(56, '资讯修改', '/admin/news/edit', 13, '', NULL, 0, 1, ''),
	(57, '管理员添加', '/admin/admin/add', 47, '', NULL, 0, 1, ''),
	(58, '管理员修改', '/admin/admin/edit', 47, '', NULL, 0, 1, ''),
	(59, '招聘信息管理', '/admin/job/index', 28, 'icon-usecase', NULL, 1, 1, ''),
	(60, '招聘信息添加', '/admin/job/add', 59, '', NULL, 0, 1, ''),
	(61, '招聘信息修改', '/admin/job/edit', 59, '', NULL, 0, 1, ''),
	(62, '应聘管理', '/admin/candidate/index', 28, 'icon-umbrella', NULL, 1, 1, ''),
	(63, '活动需求', '/admin/activity-need/index', 42, 'icon-github', NULL, 1, 1, ''),
	(64, 'vip会员编辑', '/admin/vip/edit', 46, '', NULL, 0, 1, ''),
	(65, '话题添加', '/admin/meet-subject/add', 44, '', NULL, 0, 1, ''),
	(66, '话题编辑', '/admin/meet-subject/edit', 44, '', NULL, 0, 1, ''),
	(67, '融资项目添加', '/admin/projrong/add', 19, '', NULL, 0, 1, ''),
	(68, '融资项目编辑', '/admin/projrong/edit', 19, '', NULL, 0, 1, ''),
	(69, '应聘添加', '/admin/candidate/add', 62, '', NULL, 0, 1, ''),
	(70, '应聘修改', '/admin/candidate/edit', 62, '', NULL, 0, 1, ''),
	(71, '大咖推荐添加', '/admin/biggie-ad/add', 32, '', NULL, 0, 1, ''),
	(72, '大咖推荐修改', '/admin/biggie-ad/edit', 32, '', NULL, 0, 1, ''),
	(73, '轮播图添加', '/admin/banner/add', 17, '', NULL, 0, 1, ''),
	(74, '轮播图修改', '/admin/banner/edit', 17, '', NULL, 0, 1, ''),
	(75, '活动修改', '/admin/activity/edit', 16, '', NULL, 0, 1, ''),
	(76, '专家编辑', '/admin/savant/edit', 38, '', NULL, 0, 1, ''),
	(77, '收藏日志', '/admin/collect/index', 54, '', NULL, 0, 1, ''),
	(78, '提现编辑', '/admin/withdraw/edit', 29, '', NULL, 0, 1, ''),
	(79, '阶段标签管理', '/admin/stage/index', 36, 'icon-code-fork', NULL, 1, 1, ''),
	(80, '阶段标签添加', '/admin/stage/add', 79, '', NULL, 0, 1, ''),
	(81, '阶段标签修改', '/admin/stage/edit', 79, '', NULL, 0, 1, ''),
	(82, '规模标签管理', '/admin/scale/index', 36, 'icon-sort-by-attributes', NULL, 1, 1, ''),
	(83, '规模标签添加', '/admin/scale/add', 82, '', NULL, 0, 1, ''),
	(84, '规模标签修改', '/admin/scale/edit', 82, '', NULL, 0, 1, ''),
	(85, '赞助管理', '/admin/sponsor/index', 16, '', NULL, 0, 1, ''),
	(86, '活动报名管理', '/admin/activityapply/index', 16, '', NULL, 0, 1, ''),
	(87, '管理员权限配置', '/admin/admin/config', 47, '', NULL, 0, 1, ''),
	(88, '点赞日志', '/admin/like-logs/index', 55, '', NULL, 0, 1, ''),
	(89, '活动需求编辑', '/admin/activity-need/edit', 63, '', NULL, 0, 1, ''),
	(90, '用户统计', '/admin/user-chart/index', 27, 'icon-bar-chart', 1, 1, 1, ''),
	(91, '活动统计', '/admin/activity-chart/index', 27, 'icon-area-chart', NULL, 1, 1, ''),
	(92, '资讯统计', '/admin/news-chart/index', 27, 'icon-line-chart', NULL, 1, 1, ''),
	(93, '专家统计', '/admin/savant-chart/index', 27, 'icon-bar-chart', NULL, 1, 1, ''),
	(94, '查看专家话题', '/admin/savant/show-subject', 38, '', NULL, 0, 1, ''),
	(95, '资讯标签管理', '/admin/newstag/index', 43, 'icon-tags', NULL, 1, 1, ''),
	(96, '查看资讯收藏', '/admin/news/view-collect', 13, '', NULL, 0, 1, ''),
	(97, '查看活动收藏', '/admin/activity/view-collect', 16, '', NULL, 0, 1, ''),
	(98, '资讯标签添加', '/admin/newstag/add', 95, '', NULL, 0, 1, ''),
	(99, '资讯标签修改', '/admin/newstag/edit', 95, '', NULL, 0, 1, ''),
	(100, '活动点赞', '/admin/activity/view-like', 16, '', NULL, 0, 1, ''),
	(101, '活动需求收藏', '/admin/activity-need/view-collect', 63, '', NULL, 0, 1, '');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;


-- 导出  表 binggq.need 结构
CREATE TABLE IF NOT EXISTS `need` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '小秘书',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '??id',
  `reply_id` int(11) NOT NULL DEFAULT '0' COMMENT '?ظ??û?id',
  `user_id` int(11) NOT NULL COMMENT '用户',
  `msg` varchar(550) NOT NULL COMMENT '内容',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态0未读1已读',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='小秘书';

-- 正在导出表  binggq.need 的数据：~15 rows (大约)
DELETE FROM `need`;
/*!40000 ALTER TABLE `need` DISABLE KEYS */;
INSERT INTO `need` (`id`, `pid`, `reply_id`, `user_id`, `msg`, `status`, `create_time`, `update_time`) VALUES
	(1, 0, 0, 8, '4624623', 1, '2016-05-18 15:55:44', '2016-08-17 16:09:09'),
	(2, 0, 0, 7, '不错哦', 0, '2016-06-25 11:34:55', '2016-06-25 11:34:55'),
	(3, 0, 0, 7, '不错哦', 0, '2016-06-25 11:38:26', '2016-06-28 19:37:21'),
	(4, 0, 0, 11, '@我就问你', 0, '2016-07-01 12:15:19', '2016-07-01 12:15:19'),
	(5, 0, 0, 10, '来一发', 0, '2016-07-01 21:37:26', '2016-07-01 21:37:26'),
	(6, 0, 0, 11, '1313', 0, '2016-07-04 09:37:29', '2016-07-04 09:37:29'),
	(7, 0, 0, 10, '很好', 0, '2016-07-04 12:29:45', '2016-08-03 20:14:05'),
	(8, 0, 0, 7, '我', 1, '2016-08-07 20:01:52', '2016-08-17 15:23:00'),
	(9, 0, 0, 7, '我自己', 0, '2016-07-07 20:01:52', '2016-07-07 20:01:52'),
	(10, 9, 7, 2, '我自己', 1, '2016-07-07 20:02:29', '2016-08-17 16:01:56'),
	(12, 0, 0, 24, '你好', 0, '2016-07-09 21:09:40', '2016-07-09 21:09:40'),
	(13, 0, 0, 25, '哈喽', 1, '2016-07-11 11:30:34', '2016-08-17 14:21:11'),
	(15, 0, 0, 26, 'hello，你漂亮么', 0, '2016-07-11 13:05:14', '2016-07-11 13:05:14'),
	(16, 6, 11, -1, '你在说什么啊', 1, '2016-08-03 20:45:26', '2016-08-17 16:09:12'),
	(19, 0, 10, -1, '傻逼', 1, '2016-08-03 21:20:33', '2016-08-17 16:33:09'),
	(20, 0, 7, -1, '回复比较多的内容看看效果如何，哈哈，不错，嗯可以，行吧。没什么不妥，没毛病。哪换行呢，这个我就不知道了。', 1, '2016-08-17 15:28:39', '2016-08-17 16:35:55');
/*!40000 ALTER TABLE `need` ENABLE KEYS */;


-- 导出  表 binggq.news 结构
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(10) NOT NULL COMMENT '作者id',
  `admin_name` varchar(50) NOT NULL COMMENT '作者姓名',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `read_nums` int(11) DEFAULT '0' COMMENT '阅读数',
  `praise_nums` int(11) DEFAULT '0' COMMENT '点赞数',
  `comment_nums` int(11) DEFAULT '0' COMMENT '评论数',
  `cover` varchar(250) DEFAULT NULL COMMENT '封面',
  `body` text COMMENT '内容',
  `is_media` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0无1视频2音频',
  `media_pos` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1顶部2底部',
  `video` varchar(250) NOT NULL DEFAULT '' COMMENT '视频地址',
  `video_cover` varchar(250) NOT NULL DEFAULT '' COMMENT '视频封面',
  `mp3` varchar(250) NOT NULL DEFAULT '' COMMENT '音频',
  `mp3_title` varchar(250) NOT NULL DEFAULT '' COMMENT '音频标题',
  `summary` varchar(250) DEFAULT NULL COMMENT '摘要',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `publish_time` datetime NOT NULL COMMENT '发布时间',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `source` varchar(50) DEFAULT NULL COMMENT '来源',
  `keywords` varchar(50) NOT NULL DEFAULT '' COMMENT '关键字',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '下线',
  `thumb` varchar(200) DEFAULT NULL COMMENT '缩略图',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0' COMMENT '删除',
  PRIMARY KEY (`id`),
  KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='咨询表';

-- 正在导出表  binggq.news 的数据：~32 rows (大约)
DELETE FROM `news`;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` (`id`, `admin_id`, `admin_name`, `title`, `read_nums`, `praise_nums`, `comment_nums`, `cover`, `body`, `is_media`, `media_pos`, `video`, `video_cover`, `mp3`, `mp3_title`, `summary`, `create_time`, `update_time`, `publish_time`, `user_id`, `source`, `keywords`, `status`, `thumb`, `is_delete`) VALUES
	(12, 2, '曹麦穗', '钟伟：负利率时代能走多远？离中国有多远？', 0, 0, 0, '/upload/newscover/2016-06-25/576e38b25c3a6.png', '<p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">近年来，一些经济体在货币量宽之后陆续陷入了<a href="http://money.163.com/keywords/8/1/8d1f52297387/1.html" title="负利率" target="_blank" style="color: rgb(15, 107, 153);">负利率</a>状态，人们对负利率现象的分析莫衷一是。在我们看来，考虑到全球增长乏力，产能过剩和通缩浓重，负利率很可能会蔓延持续一段时间，负利率政策对资产价格带来了重估压力，使社保和寿险等长期资产管理者面临挑战，负利率也有可能以持续损害金融体系来补贴实体经济，并导致财政和货币政策之间边界的模糊。如果负利率政策持续较久，也许意味着全年经济体以政府信用为支撑，以刚性泡沫为代价，在展开一场致力于转型和创新的艰难竞赛，而竞赛结果仍变幻莫测。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">第一，需要定义什么是负利率。我们认为负利率是名义利率为负，更多地表现为一国的长期国债到期收益率陷入零甚至负收益的状态。从以上粗略定义，我们可以看出零利率甚至负利率的一些特点，一是负利率主要指的是长期无风险利率为负，而不是利率产品整体陷入负利率；二是负利率并不意味着央行调控的短期利率为负；三是负利率是名义利率的概念，并非扣除通胀的实际利率。目前一些国家陷入了负利率，例如丹麦 、瑞典、瑞士、欧元区和日本等。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">由此看来，一国的利率类产品决定了利率具有复杂的结构，长期无风险利率为负，不能等同于结构化的利率整体为负，尤其是风险溢价往往和负利率相关性不强。负利率可以和信用债违约潮并存。负利率可能意味着商业银行被迫从国债市场逐渐挤出，但也并不意味着存贷款利差的消失甚至倒挂。负利率和权益类市场的关系错综复杂。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">负利率现象的出现引发了巨大好奇和争议。一些学者认为负利率是非常有限、暂时和特殊现象，另一些学者则认为负利率可能会进一步蔓延。一部分学者认为负利率有助于一国去杠杆和舒缓债务压力，另一些学者认为负利率可能会严重伤害一国的银行体系，甚至带来更深重的金融灾难。所以负利率政策到底是刚刚拉开大幕还是已经昙花一现；是对一国无济于事的饮鸩止渴，还是有所裨益的大胆尝试，都还缺乏定论。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">第二，需要探究负利率折射出的情绪。我们倾向认为负利率折射出了一国央行和金融机构对未来增长和物价的悲观预期。看起来负利率的形成通常需要三个前提：一是对本国经济增长前景的预期是弱的甚至是负面的；二是本国已长期处于低利率状况；三是通胀达不到央行预期，甚至面临通缩威胁。负利率的触发则往往是在本币面临升值压力，央行却仍看不到增长和通缩好转的时刻。三是负利率和政府债务压力的关系似乎不明朗。我们可以看到目前陷入负利率的经济体都符合低增长、通缩威胁和长期低利率的前提，并且触发甫利率的时点也大致发生在本币面临升值压力之际，但这些经济体并不一定都具有高债务，一些斯堪的纳维亚半岛的经济体的债务状况还是不错的，而日本或欧元区债务状况则不令人乐观。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">总体上，负利率的形成是低增长、低通胀和持续低利率甚至零利率的线性外推的必然结果。它折射出政府试图维持国民收入分配现状的姿态。以美国为例，美国目前债务负担率约为&nbsp;<a href="http://quotes.money.163.com/usstock/hq/GD.html" style="color: rgb(15, 107, 153);">GD</a>P的100%，如果美国长期国债的到期收益率约为1.5%，再加上美国海外军事费用支出每年约为1800-2000亿美元（约合<a href="http://money.163.com/baike/gdp/" title="财经知识_GDP" target="_blank" style="color: rgb(15, 107, 153);">GDP</a>的1%），可以推算出美国政府为支付长期国债利息和海外军费这两项，需要消耗美国GDP的2.5%，这几乎就是目前美国的经济增长速度。可以说低增长、通缩的威胁给负利率打开了方便之门，总体来看，负利率状况在全球范围并没有缩减，反而有进一步扩张蔓延之势。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">第三，目前对负利率如何银行业存在巨大分歧。有些学者非常悲观，有些学者则不这么看。在欧洲，前英格兰银行行长Charles·Goodhart指出，如果一国持续采取负利率政策，则会对本国银行业带来难以挽回的巨大压力，利差的收缩甚至消失可能迫使银行业业绩急剧恶化甚至爆发危机。一些美国学者认为，负利率状况是人类历史上前所未有的，这将会导致金融机构资产端收益率锐减，ROE持续滑坡以及银行业的不断萎缩。次贷危机以来，<a href="http://quotes.money.163.com/usstock/hq/BAC.html" style="color: rgb(15, 107, 153);">美国银行</a>业的资负规模已几乎缩减了50%，负利率有可能使银行最终陷入资产收益无法覆盖负债成本的巨大困境。而日本央行对存款准备金实施负利率的做法，似乎也没有有效刺激银行信贷的扩张，看起来负利率对银行业将带来负面冲击的判断占据上风。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">在有些学者非常担心负利率对于银行业稳健性具有长期侵蚀作用的同时，另外一些学者倾向认为负利率对银行业的影响其实没有那么严重，这些持相对乐观的判断的学者持有下列三种假说。一种假说是，净储蓄者逃避负利率的手段是持有黄金或者现金，因此负利率无非就意味着净储蓄为保管黄金或现金的保险柜购买和维持成本。换言之，即便储户因为负利率而不愿到银行储蓄或存款，其仍需为持有类现金而支付保管成本，所以对负利率没有必要大惊小怪。第二种假说是，负利率发生在基于现金使用比较少的经济体，即所谓的less cash economy 的经济体，由于这些经济基本上以支票，银行卡或是以其他电子货币支付工具为主，所以负利率相当于账户管理服务的收费。金融账户使用者并不具有逃避负利率的替代选择。第三种假说是，负利率意味着各国央行面临从创造和监管电子货币到数字货币的进一步转型，发达经济体已基本告别了大规模现金使用<a href="http://money.163.com/keywords/6/f/65f64ee3/1.html" title="时代" target="_blank" style="color: rgb(15, 107, 153);">时代</a>，Inclusive Finance的发展依托于高度垂直封闭分布的金融账户体系，这赋予了央行比较充沛的把无风险利率降到极低甚至零以下的能力。并且不必担心现金囤积行为等带来的货币乘数下降问题。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">看起来，对负利率表示悲观的学者似乎将负利率等同于利差的逐渐消失；而乐观的学者则认为利率其实是一个结构，有资产端的也有负债端的，有长端的也有短端的，有银行的也有非银行的，有无风险的也有风险溢价，因此负利率既不等同于利差的消失，也不等同于大类资产无法配置，而仅仅意味着负利率下金融产品再定价和博取收益的难度空前加大。从已有的实践来看，实施负利率的经济体，其银行体系的表现有较大差异性。有些经济体，如瑞士、瑞典和丹麦的银行业似乎没有受到特别大的影响。有些经济体例如日本，其银行业有逐步从国债市场淡出的迹象，但日本央行坚称，包括量宽和负利率在内的货币政策仍然空间巨大。当然负利率和银行业的关系还有待于时间的考验。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">目前大多数学者倾向于认为负利率会使银行体系的利差有所收缩，银行盈利能力更弱，但对负利率是否构成银行业的灾难，意见分歧巨大。这也很正常，因为总体上来说，负利率政策是期望刺激信贷需求、刺激实体经济进行长期投资的信心，而这种刺激直接损害了储蓄者和金融中介，尤其是长期储蓄者的利益。同时由于金融机构资产端收益率下降和负债端成本的锁定，两者之间往往存在错配性。所以当资产收益率调整的速度比负债端尤其是长期负债的成本的调节更快的话，银行很可能会遭遇暂时的困难。负利率政策也可能隐含着央行应当对购入商业银行的高息长期负债负有一定义务。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);"><span style="color: rgb(136, 136, 136); font-family: &quot;Sim sun&quot;; font-size: 12px; line-height: 13px; text-align: justify; background-color: rgb(255, 255, 255);">本文来源：21世纪经济报道</span></p><p><br/></p>', 0, 1, '', '', '', '', '', '2016-05-11 09:57:02', '2016-06-25 15:55:00', '0000-00-00 00:00:00', 8, '', '', 0, NULL, 0),
	(13, 2, '曹麦穗', '【简讯】美联储：必要时将通过货币互换提供美元流动性', 8, 0, 0, '/upload/newscover/2016-06-25/576e38142b27d.png', '<p><span style="font-size: 18px; font-family: 微软雅黑, &quot;Microsoft YaHei&quot;;"><span style="font-size: 18px; color: rgb(64, 64, 64); line-height: 32px; text-align: justify; text-indent: 36px; background-color: rgb(255, 255, 255);">香港万得通讯社报道，美股开盘前夕</span>美联储<span style="font-size: 18px; color: rgb(64, 64, 64); line-height: 32px; text-align: justify; text-indent: 36px; background-color: rgb(255, 255, 255);">表示，正密切监控全球金融市场动向，必要时将通过</span>货币互换<span style="font-size: 18px; color: rgb(64, 64, 64); line-height: 32px; text-align: justify; text-indent: 36px; background-color: rgb(255, 255, 255);">提供</span>美元流动性<span style="font-size: 18px; color: rgb(64, 64, 64); line-height: 32px; text-align: justify; text-indent: 36px; background-color: rgb(255, 255, 255);">；若基金市场遭受压力，将及时采取行动。</span></span></p>', 0, 1, '', '', '', '', '香港万得通讯社报道，美股开盘前夕美联储表示，正密切监控全球金融市场动向，必要时将通过货币互换提供美元流动性；若基金市场遭受压力，将及时采取行动。', '2016-05-19 15:34:38', '2016-06-25 15:51:50', '0000-00-00 00:00:00', 8, '', '', 0, NULL, 0),
	(14, 2, '曹麦穗', '虚拟货币疯涨背后：都是在炒作 暴涨暴跌风险大', 2, 0, 0, '/upload/newscover/2016-06-25/576e37690d5ef.jpg', '<p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">无论是过去还是现在，虚拟货币疯涨行情的背后都离不开投资者的炒作。而相比2013年，以比特币为代表的虚拟货币市场，其背后的投资者生态更为多元和复杂。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">业内人士认为，随着国民财富的增加和资产投资标的逐渐丰富，中国投资者对有着明显“造富效应”的虚拟币市场青睐有加。数据显示，截至2013年年底，人民币交易量迅速占到整个比特币市场67%以上的份额，而这轮行情人民币交易量占比最高超过九成左右。火币网的数据显示，截至6月19日18时，该平台累计交易额已突破1.06万亿元。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">从市场行情来看，近期短短20个交易日，炒作比特币似乎就能获得超过60%以上的收益，对投资者而言，和投资数额巨大的房地产市场以及波动起伏不断的股市相比，虚拟币市场更有吸引力。熟悉虚拟货币市场的人士分析，目前以人民币计价的比特币价格一直比海外市场高，意味着中国买家对比特币的需求十分旺盛，中国的比特币价格有至少10%的溢价。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">从虚拟货币的投资者生态来看，既有纯粹通过“挖矿”技术获得比特币的程序员玩家，也有从中实现炒作交易的庄家，以及一大波跟风投资的普通投资者。一位曾经参与虚拟货币炒作的投资者坦言，对于比特币交易本身的原理及涉及的技术风险等问题都不太熟悉，自己所理解的比特币交易实际上也是将其作为股票投资，看到盈利可观和疯涨的行情就跟风买进。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">除比特币之外，一些其他类别的虚拟货币也受到广泛关注，在各类民间平台火热起来。某第三方虚拟币交易平台分析，由于受到比特币行情的影响，当前一些其他币种的虚拟货币平台交易量也出现明显上涨。由于差异化竞争格局的存在，当比特币出现高位横盘的时候，类似以太币、莱特币等虚拟币的行情就开始活跃，而部分总交易盘小的虚拟币，价格被买家资金炒高的情况更多。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">不过，在爆行情的背后，虚拟货币的炒作风险也令人担忧。一位比特币的资深玩家透露，每一轮行情的活跃都离不开杠杆交易，不少国内的比特币交易平台会为参与投资者提供杠杆业务。在杠杆效应下，行情炒作的速度加快，也会令比特币出现暴涨暴跌的价格走势，这种常态化的巨幅震荡往往令普通投资者难以承受。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">同时，由于缺乏监管和合法性的认定，也有打着“虚拟货币理财”的幌子进行非法传销、非法集资的伪交易平台出现，让不少缺乏判断力的投资者入局受骗、个人财产受到损失，这也令虚拟币的炒作游走在监管的灰色地带。此外，虚拟货币交易平台的安全性也遭受拷问，一旦平台交易系统的防火墙被黑客攻破，留存在平台上的大量资金就会流失，虚拟货币价格也会因此波动，其风险因素令人担忧。</p><p><br/></p>', 0, 1, '', '', '', '', '无论是过去还是现在，虚拟货币疯涨行情的背后都离不开投资者的炒作。而相比2013年，以比特币为代表的虚拟货币市场，其背后的投资者生态更为多元和复杂。', '2016-05-19 15:35:29', '2016-06-25 20:31:23', '0000-00-00 00:00:00', 8, '', '', 0, NULL, 0),
	(15, 2, '曹麦穗', '直播泡沫：每月烧钱几千万 集体造假成公开秘密', 31, 0, 2, '/upload/newscover/2016-06-25/576e355439cdf.jpg', '<p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">任何行业都会<a href="http://money.163.com/keywords/9/2/90205047/1.html" title="造假" target="_blank" style="color: rgb(15, 107, 153);">造假</a>，但如果一个行业集体造假，而且造假到任何人都能看出来造假，那这个行业已经病得很重。当年牛奶行业品质集体掉线，至今未能使国产牛奶声誉恢复。公众对一个领域宽容度极高，但如果一个行业骗了用户的核心利益，那可能随时翻船。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">移动<a href="http://money.163.com/keywords/7/f/76f464ad/1.html" title="直播" target="_blank" style="color: rgb(15, 107, 153);">直播</a>数据造假仍不是灾难性的问题，但造假本身说明用户活跃度根本不足以支撑直播行业如今的，而且移动直播仍义无反顾地向远离用户的方向一往直前。如果这口虚火没有去好，大量直播平台被嫌弃的那天不会太远。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);"><strong>人人知道数据造假，却不会逃离直播</strong></p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">映客对外宣布用户过亿时，就有很多人大呼其数据水分太足。于是有人挖坑在直播时使用黑屏长达三小时，这三小时内竟然有21人不离不弃。“黑屏门”后，直播平台利用<a href="http://quotes.money.163.com/1300024.html" style="color: rgb(15, 107, 153);">机器人</a>账号刷数据的丑闻被接连曝光。</p><p class="f_center" style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: center; white-space: normal; background-color: rgb(255, 255, 255);"><img alt="直播泡沫：每月烧钱几千万 集体造假成公开秘密" class="aligncenter" src="http://cms-bucket.nosdn.127.net/catchpic/F/F5/F5A7D5D08C3BD06B384A867BCB4B8461.jpeg" width="517" height="919" style="vertical-align: top; border: 0px;"/></p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">“黑屏门”事件最重要的影响是，直播平台的谎言已经到了用户普遍不信的地步。实际上，直播平台的数据造假早就已经不需遮掩，甚至假到任何人明眼都能看出来。2015年WE队员微笑在斗鱼直播英雄联盟时，其显示观看人数竟然超过了13亿。这个点击因为人人可以看到，因而直播平台数据造假一事自那时起便已经是公开的秘密。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">那时起铺天盖地的消息就说，直播平台主播显示观看人数实际上是真实在线用户乘以一个相对应的系数得来的。这个系数少则2倍，多则10倍。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">那个时候，媒体自媒体就已经披露，直播数据造假要骗的唯有投资者和一般小白用户。如果一个用户习惯性地根据点击去看直播，就有可能选择那些僵尸粉扎推的直播内容一看究竟，也可能跟着造假的送礼物行为一起送礼。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">也就是说，直播平台的数据谎言已经从2015年骗到了现在，预计还是可以骗下去。所以行业中人估计不会理会外界关于直播行业数据造假的警告。<strong>因为如今直播平台的所谓数据造假并没有伤害到用户的核心利益。</strong></p><p class="f_center" style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: center; white-space: normal; background-color: rgb(255, 255, 255);"><img alt="直播泡沫：每月烧钱几千万 集体造假成公开秘密" class="aligncenter" src="http://cms-bucket.nosdn.127.net/catchpic/2/2D/2D3A829760324B950F42F290586DA10D.jpeg" width="473" height="212" style="vertical-align: top; border: 0px;"/></p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">斗鱼造假13亿人观看直播</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">很多人都知道斗鱼直播13亿人看的笑话，但人们并没有抛弃斗鱼；“黑屏门”也至少说明了一点，虽然没有那么多人真的看黑屏，但大家对映客等平台的确仍然不离不弃。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">中国人对于造假的忍耐度是非常高的。因为造假到现在还饱受质疑的，也就是国产牛奶行业。导致这一结果的正是因为造假伤害了用户健康这一核心利益。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);"><strong>用户对直播的热情还有多少</strong></p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">目前直播全行业的数据造假，只能说明直播行业虚火太过旺盛。但是业内对于这样的虚火恐怕并不是特别紧张。该作假的依旧会作假，而且会心安理得。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">他们会有很多的借口安慰自己。比如很多电商也会刷单；O2O也几乎在靠数据造假维持；创投行业也都虚报投融资数据。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);"><strong>或许是时候喊一个口号：没有数据造假，就没有互联网繁荣。</strong></p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">只是直播平台的数据造假，也是一种自嗨，它的<strong>真正隐忧是</strong>：各平台造假是不是说明用户真的不够用了？直播才被热议大半年，用户活跃度就已经下滑到必须靠全平台造假才能维持了吗？</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">继而一个疑问是，各直播平台真的有那么热吗？或者说直播从来就没有真的像媒体说的那样火？用户对于直播的热情到底还有多少？</p><p class="f_center" style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: center; white-space: normal; background-color: rgb(255, 255, 255);"><img alt="直播泡沫：每月烧钱几千万 集体造假成公开秘密" class="aligncenter" src="http://cms-bucket.nosdn.127.net/catchpic/4/4F/4F9AAF2253331483EBD3A8F4246DAF6D.png" width="364" height="629" style="vertical-align: top; border: 0px;"/></p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">根据现有数据造假的惯例，网上已经有人计算出公式，映客一万人的直播数据，实际在线人数可能只有250人。这至少说明了一点，各主要直播平台现有的设计与行动，已不能真正有效调动用户的兴趣，或连续保持用户的粘性。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">中国直播追随的实际是美国的Meerkat。但是作为直播界的鼻祖，Meerkat在风行半年后就开始衰退，一个重要的原因就是搭载用户入口的推特不跟他玩了，用户不能在使用推特的时候分享到Meerkat的内容，Meerkat也就没有了用户。今年3月Meerkat被迫关闭。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">国内的部分移动直播平台可能自我感觉良好，认为自己有能力做成一个入口，可以吸引到足够的用户。熊猫TV也号称砸钱迅速砸出了一个亿的用户（好像中国13亿人随时被砸）。但问题来了，就算有这么多用户，现有的直播平台是否能留下来用户的热情。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">现有主要的直播模式包括，电商直播，网红秀场，游戏直播等。无论什么直播形式，在各现有直播平台里，内容已经高度同质化，网红主播一律大眼尖下巴，换个谁看都是秀舞秀歌。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);"><strong>如此同质化首先是直播平台设计的失败，它导引直播内容生产领域过于狭窄。</strong>而且马太效应会越发明显，让普通内容生产者不断复刻“成功”模版，结果显而易见，只有少数平台包装的主播才有出头之日。长此以往，将损耗相当一部分内容生产者的兴趣。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">国内平台也发现了这个问题，但他们选择的方式，是利用明星效应。明星直播的介入在短时间内会抬高数据，比如刘涛玩个直播总在线可以达到71万人。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">但这样的结果是，国内手机直播平台最终变身为媒体直播平台。媒体直播的方式，就是靠平台自身的眼光、资源对内容进行人工干预。这跟办一家报纸，办一个传统媒体的网站并没有什么区别。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">尽管直播平台的数据也许会止跌，甚至短期内很热闹，但也将摧毁各种用户内容自生产的空间。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);"><strong>一个更符合互联网精神的直播方式应该是社交式直播而非媒体式直播。</strong>这就跟微信朋友圈当初击败利用明星战略和媒体模式的微博一样。微博当年也被迫使用僵尸粉等方式来体现数据，但活跃度不可遏止的下滑。原因正是用户在微信上体验社交到乐趣，而在微博上大都智能被动接受信息。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">如果移动直播，从网络社交直播倒退回媒体直播，用户的热情将可能出现剧烈波动。因为明星是可以迁徙的，而用户凭借自娱自乐的兴趣玩直播也是有淡季的。一旦出现比现有移动直播更有互娱性的新方式，用户就有可能大规模撤离。即使现在没有诞生更好的平台，直播也是可看可不看的。人们依然可以通过其他管道获得类似的体验。也就是说，现有相当多的直播平台有随时可能陷入僵尸平台的风险。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);"><strong>直播烧钱还能烧多久</strong></p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">本来，基于个人兴趣的直播是有多元化空间的。在视频行业中，youtube就通过机器算法，根据用户兴趣提供不同的内容。这种非人工干预的方式，实现了“千人千面”，有效刺激了多元化视频内容生产者的兴趣。假如你是一个专业砍树的，那做一个如何专业砍树的视频也能找到知音。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);"><strong>但在现行的强调媒体效应的直播平台环境里，这种多元化的直播方式就很难被发掘被推荐。</strong>那么类似有趣的直播就会淡出市场。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">也就是说现有的直播方式并没有改变什么生活方式与行为，这就跟020只是电话点餐改成网络点餐一样。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">而我们看下，团购、P2P，O2O都曾被视为巨大的资本风口，但他们辉煌到落寞时间居然都只是一年。比如2013年有上千家团购网站，如今只剩下美团等少数网站；2015年市场倒掉了1302家P2P；而如今谁提020都当是在说一个笑话。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">如今直播平台约200家，相当多的一部分还没过A轮。但现有直播平台的方式主要靠<a href="http://money.163.com/keywords/7/e/70e794b1/1.html" title="烧钱" target="_blank" style="color: rgb(15, 107, 153);">烧钱</a>。比如斗鱼带宽成本每月支出在3000万元左右。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">此外还需要砸钱养主播，媒体宣传等等各项支出智能依靠投融资来烧钱。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">几乎所有的平台如今都只是烧钱。而直播平台的盈利模式和手段仍然单一，过度依赖广告，打赏等方式完全无法回报如今的投资成本。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">但烧钱似乎已经成为部分直播平台继续下去的救命药丸。它如同一个鸡肋又如同一个黑洞。烧下去未来不明，但现在退了又前功尽弃各种可惜。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);"><strong>直播泡沫这么大为什么还没破</strong></p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">实际上，有关直播<a href="http://money.163.com/keywords/6/e/6ce16cab/1.html" title="泡沫" target="_blank" style="color: rgb(15, 107, 153);">泡沫</a>巨大的讨论从2014年直播处在走红苗头时，就已经出现了。如今有关直播泡沫比地产泡沫还要大的说法，也说了很久了。直播造假，投资只烧钱等各种问题暴露的似乎也够多了，但泡沫居然还是没有破。这固然与资本连续为直播平台续命烧钱有关，与公众对直播平台上各种扯淡事件的忍耐度和接受度有关，但根本还是因为直播在中国确实有足够大的空间。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">直播与020，团购等前车之鉴不同之处在于，移动直播注定是视频行业的趋势。移动直播的便捷化、低门槛，都能促成视频行业的进化。它也能迅速吸收利用更多视频领域的新技术新应用。比如VR等。因此直播不会如很多伪风口一样迅速凋零死亡。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">只是如今我们应该越来越清醒地认识到，<strong>直播应该只是各行业未来的一个标配产品，而很可能不是什么单独运作的大入口，大生意。</strong>未来各行各业都可能基于传播的需要，投入到直播领域，但通常会强调最低的经营成本来完成这项工作。特别是那些拥有超级流量的入口和渠道，最终仍将掌握直播的受众的实际需求。如今直播热的所谓用户，不过仍只是可有可无的尝鲜派。</p><p><br/></p>', 0, 1, '', '', '', '', '移动直播数据造假仍不是灾难性的问题，但造假本身说明用户活跃度根本不足以支撑直播行业如今的，而且移动直播仍义无反顾地向远离用户的方向一往直前。', '2016-05-19 15:36:36', '2016-06-28 16:01:03', '0000-00-00 00:00:00', 8, '', '', 0, NULL, 0),
	(16, 2, '曹麦穗', '深圳P2P"在线贷"许以24%高息回报 非法集资7.3亿', 342, 1, 4, '/upload/newscover/2016-06-25/576e3491cb115.jpeg', '<p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">一款P2P金融理财产品项目，利息回报最高竟能达到24%！高额回报的背后是非法集资的陷阱，全国2000余人上当。昨日，（深圳）南山警方公布了此起金融公司虚构理财产品非法集资案。目前，何某等4名主要犯罪嫌疑人已被南山区人民检察院批准逮捕。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">今年1月初，南山警方陆续接到群众报案称，某金融公司通过网络借贷平台“在线贷”搞资金池，非法吸收公众资金。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">南山公安分局经侦大队联合高新派出所迅速展开调查发现，群众所举报的公司仍在经营，但已无资金兑付能力，主要账户都处于亏空状态。鉴于公司运营状况不断恶化的实际情况，为及时挽回群众损失，防止更多投资人上当受骗，4月8日，南山警方出动百余名警力开展统一收网行动，将主要犯罪嫌疑人何某、赵某、王某、李某四名主要犯罪嫌疑人全部抓捕归案。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">经警方调查，从2012年3月份开始，该公司法人代表、董事长何某在未取得金融许可证和从事基金、股权交易资质的前提下，设立金融公司。通过现场推介会、网络宣传、图册宣传、业务员线下寻找等多种方式，向社会不特定公众介绍公司的P2P金融理财产品项目，承诺保本付息，并许以投资人年化14%至24%不等的高额利息回报。还通过自行设立的网站平台“在线贷”对外发布广告，招聘社会人员从事吸收公众资金和对外放贷的业务，对于业务员则给予其推荐的投资人年化收益1%至3%不等的提成。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">该公司发布个人或公司借款周转标的吸引投资人投资，每天更新。投资标的基本为3-6个所谓月标，许诺年化收益率在18%左右，并先后在深圳市南山区、福田区，湖南省长沙市、郴州市，上海市设立了多个分支机构，大肆开展投融资业务。公司运营期间，为维持公司资金流动，何某与公司总经理赵某多次在网站平台发布虚假项目，不断吸引新投资人的资金，并将所获资金用于偿还前期投资人的本金和利息支付。同时，何某、赵某二人为获取投资人的信任，利用何某实际控制的公司，对网站运行的投资项目标的实施风险担保，以所谓第三方支付平台收取客户投资款的方式，最终将投资款转入何某等人的个人账户进行使用，在个人账户上形成资金池。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">2015年12月，该公司因为没有新的吸收资金进入，导致原有投资人投资资金回笼逾期，最终陷入无法继续经营状况。截至2016年3月，该公司涉及投资资金累计约7.29亿元人民币，吸收公众原始本金为1.09亿元人民币，现无法收回返还实际投资人，涉及全国各地投资人2000余人。</p><p><br/></p>', 0, 1, '', '', '', '', '一款P2P金融理财产品项目，利息回报最高竟能达到24%！高额回报的背后是非法集资的陷阱，全国2000余人上当。', '2016-05-19 15:37:00', '2016-06-29 12:09:41', '0000-00-00 00:00:00', 8, '', '', 0, NULL, 0),
	(17, 2, '曹麦穗', '富国：英国脱欧冲击市场 能源行业首当其冲', 127, 0, 4, '/upload/newscover/2016-06-25/576e340cd0706.jpg', '<p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">对此Jacobsen表示，需要特别当心脱欧对能源行业所带来的“非同寻常”影响，鉴于此类债券低的债务评级，建议投资者不要寻求投资此类债券，更为谨慎的办法是，考虑“投资”级别的美国国债；因为只要不发生重大意外事件，其便具有稳定的回报率。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">本周四(6月23日)出于对英国可能脱离欧盟的担忧，美国、英国和德国的债券均下跌，而德国和日本债券的收益率目前均处于负值；在英国正式投票脱离欧盟后，美国国债一度大幅下挫，但在本周五交投时间段内有所反弹。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &quot;Microsoft Yahei&quot;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">英国成功“脱欧”也严重影响了美国芝加哥商品交易所(CME)的利率期货显示，美联储7月加息的概率已几近于零。对此Jacobsen表示，鉴于加息可能对经济发展造成不利影响，即将公布的美国6月非农就业数据可能“不太好看”，美联储加息是一把“双刃剑”；某种程度上说，现在只求6月就业数据良好，只有这样，才有利于美联储加息。</p><p><br/></p>', 0, 1, '', '', '', '', '需要特别当心脱欧对能源行业所带来的“非同寻常”影响', '2016-05-19 15:37:00', '2016-06-29 12:10:14', '0000-00-00 00:00:00', 8, '', '', 0, NULL, 0),
	(18, 2, '曹麦穗', '英国首相卡梅伦宣布辞职', 246, 3, 17, '/upload/newscover/2016-05-19/573d6d1294b53.jpg', '<p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &#39;Microsoft Yahei&#39;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">据中国新闻网：美联社报道称，英国首相卡梅伦发表声明称，他将尊重民众的选择，离开欧盟，他本人将辞去英国首相职务。他希望在今年10月份保守党会议时选出新的党首来代替他。卡梅伦表示，既然英国人民已经明确选择了与他所支持的道路完全不同的道路，他也不再适合担任“掌舵人”。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &#39;Microsoft Yahei&#39;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">他相信，英国GDP会保持稳定的势头。他将在未来数月内继续参与英国脱欧进程，将在下周前往欧盟商讨脱欧事宜。。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &#39;Microsoft Yahei&#39;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">据悉，此次脱欧公投共有382个选区，根据对其中的352个选区的计票结果显示，脱离欧盟的支持者领先，共获得51.9%的投票，即1570万人支持退欧，而留在欧盟的支持者共有1458万人，获得48.1%的选票。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &#39;Microsoft Yahei&#39;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">投票结果出来后，英国外交大臣哈蒙德曾表示，卡梅伦在公投后将继续担任英国首相。英国外交及联邦事务大臣表示，英国政府目前的任务是稳定局势并且以最佳的方式满足人民的意愿。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &#39;Microsoft Yahei&#39;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">欧洲理事会主席图斯克此前曾表示，若是英国公投决定脱离欧盟，英国与欧盟将需要至少7年时间，才能完成双方关系未来发展的协商谈判。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &#39;Microsoft Yahei&#39;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">根据里斯本条约第50条，欧盟会员国若要脱离欧盟，必须通知欧洲理事会，包括英国商品关税协</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &#39;Microsoft Yahei&#39;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">议、欧盟会员国居民自由移动协议等协议都须在2年内完成。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; font-stretch: normal; line-height: 32px; font-family: &#39;Microsoft Yahei&#39;; color: rgb(64, 64, 64); text-align: justify; white-space: normal; background-color: rgb(255, 255, 255);">中国日报<span class="W_icon icon_member4"></span>：【英国脱欧谈判将由新任首相主导】英国首相卡梅伦24日宣布，英国与欧盟的脱欧谈判将在新任首相的领导下进行。新任首相也将决定何时触发《里斯本条约》第50条关于脱欧的规定。卡梅伦称下周将会出席欧盟委员会会议解释英国人民的决定，接下来三个月他会努力让“国家之船平稳航行”。</p><p><br/></p>', 0, 1, '', '', '', '', '当地时间24日，英国首相卡梅伦发表声明宣布辞职，称保守党将在10月年会选出下任英国首相。', '2016-05-19 15:37:00', '2016-06-29 12:10:31', '0000-00-00 00:00:00', 8, '', '', 0, NULL, 0),
	(19, 2, '曹麦穗', '百度或遭遇“寒冬” 揭秘被异化的竞价排名', 245, 4, 4, '/upload/newscover/2016-07-08/577f04879b2a5.png', '<p>6月8日，大理希尔顿酒店顶层行政酒廊，刚刚结束完一场演讲的李彦宏半倚在一张舒适的白色沙发上，考虑到过去一个多月中百度遭受到的攻击与压力，他的容光焕发令人略感意外。</p><p>“我一直在想我们为什么会走到这一步？”李彦宏对《财经》记者说。</p><p>2016年初时，即使最悲观的互联网分析师也不会想到，这家总市值650亿美元、2015年净利润超过51.9亿美元、同比增长155％的中国互联网巨头，在本土会遭遇如此重创。</p><p>4月12日，一名患有癌症的大学生魏则西通过百度的一个赞助商链接尝试接受治疗后不治去世，接下来的一个多月中，百度成为质疑的焦点。舆论认为，百度应为此承担重要责任。</p><p>与百度历次危机不同，魏则西事件带来了罕见的一边倒指责——包括官媒《人民日报》和新华社在内的大量媒体，对这家上市公司进行了铺天盖地的批评。社交网络上，用户呼吁抵制百度，另一些人呼吁让谷歌回归中国。而一些中等规模的竞争对手，则借机发挥—— 一位网站CEO给李彦宏写公开信，称百度崛起成为中国最大的流量入口，导致大量企业衰败。<br/></p><p>同时，百度首次成为政府部门的调查对象，此前它一直作为谷歌的对手、政府的监管窗口受到官方支持。“百度背后的政府保护伞已收起。”一位互联网评论家对《财经》记者说。</p><p>6月13日，百度下调其季度收入预期。百度预计2016年第二财季收入为28.1亿－28.2亿美元，低于此前预计的30.5亿－31.2亿美元。评级机构穆迪6月15日发布报告，预计百度2016年收入增速将从2015年的35％放缓至15％。</p><p>更直接的影响是股价。截至6月17日美股收市，百度股价在163.71美元，两个月内下滑15.7％，市值从680亿美元跌至约563亿美元，缩水约117亿美元。不及阿里（1927亿美元）和腾讯（2048亿美元）市值的三分之一。一些言论认为百度正在告别BAT阵营。</p><p><br/></p><p>在国内最大的问答社区知乎上，有一篇名为《百度员工如何看待魏则西事件》的帖子，百度的员工、前员工、合作伙伴贡献了672条回答。一位员工引用《肖申克救赎》中的一句话：“刚入狱的时候，你痛恨周围的墙，慢慢的，你习惯了生活其中，最终你发现自己不得不依靠它而生存。”另一位百度在职员工则称，有一周时间他在餐厅吃饭已经不敢开发票了，因为不想让服务员和邻桌听到他是百度人。</p><p>从声誉到股价，从收入到信任，百度正在陷入危机。</p><p>此时距离百度股价最高点刚刚过去19个月（2014年11月28日，百度股价达251.99美元，市值868亿美元）。在更早的2011年，百度市值首次超过腾讯成为中国互联网企业第一。同年李彦宏成为中国首富，并发表演讲，称百度要“为中国赢得全世界的尊敬”。</p><p>业界多数评价认为，百度今日的境遇，并非因为某一具体事件，而是一个日积月累的过程。它反映了系统性问题，这个问题是以商业伦理为基础，以业务、战略、企业管理为导向，同时在舆论和竞争的放大之下，出现的综合性结果。</p><p>只有抽丝剥茧地研究、探讨百度如何陷入危机，才能知道这家中国的明星科技公司该如何走出危机。</p><p>被异化的竞价排名</p><p>在不违法的前提下追求商业价值最大化，是百度商业价值观的体现，也是李彦宏的底线。但在关系到社会民生等重要问题上，仅有商业价值观是不够的</p><p>迈入2016年夏季的第一周，对百度而言无疑是冬天的开始。</p><p>这家全球最大的中文搜索引擎，因为陕西青年魏则西之死被推上风口浪尖。由国家网信办牵头成立的联合调查组公布的调查结果认为，百度搜索相关关键词竞价排名结果，客观上对魏则西选择就医产生了影响。</p><p>竞价排名，指买断关键词搜索结果前几位的位置，再以竞价卖给商家进行广告目的的链接。其为goto.com公司（后改名为Overture）在1998年创立并采用，此后，几乎所有搜索引擎的商业模式均脱胎于此，包括谷歌。</p><p>自2006年起，百度已不完全按出价高低来排列结果。2009年，百度推出凤巢系统，在竞价排名中引入“质量度”（包括点击率、创意质量、账户表现等），价格和“质量度”共同决定排序。</p><p><br/></p><p>“竞价排名本身是一个合理、合法，被广泛使用的商业模式。全世界所有的搜索、所有的广告都是竞价排名。”360公司董事长周鸿祎在接受《财经》记者采访时称。360搜索引擎在中国的市场份额仅次于百度，号称占有约30%份额。</p><p>搜索引擎是一个工具，工具是没有原罪的。百度竞价排名被诟病，问题并不在竞价排名这个商业模式，而在实现此商业模式的路径和准则上。</p><p>比如，在广告还是正常搜索结果的混淆度上，谷歌是强标注，百度是弱标注；比如，在2011年11月之前，谷歌不卖页面左侧广告，只出让页面右侧的广告位，而百度一开始就开卖左侧，并且每屏广告条数比谷歌多，后来则越来越多；在一些本应谨慎处理的领域——医疗，百度没能抵制住商业的诱惑。</p><p>2016年5月，李彦宏在他撰写的公开信中承认，对短期KPI（关键绩效指标）的追逐使该公司“与用户渐行渐远”。</p><p>2000年互联网泡沫即将破灭之际，李彦宏创立百度。五年后，百度在纳斯达克上市，创造了美国资本市场200多年以来海外公司单日涨幅的最高纪录。</p><p>过去十年间，这家公司就像一辆高速行进的列车。它的市值增长了27倍，总营收从2005年的3.19亿元人民币增长到2015年的664亿元人民币。它给股东以巨大的回报，并实现了流量价值最大化，还把这个优势迁移到了移动端（百度目前超50％收入来自移动）——从这个角度而言，李彦宏是一名成功的企业家，他缔造了一家商业价值巨大的上市公司。</p><p>在丰厚的利润和回报中，医疗客户对百度的贡献功不可没。据交银国际2015年4月发布的研报称，其估计2013年和2014年百度网络搜索收入分别为286亿元人民币、429亿元人民币，其中估计莆田系对百度收入的贡献分别为22％、19％，而整个医疗推广对百度收入的贡献更多。</p><p>在baidu.com诞生的第一天，李彦宏便提出了“搜索引擎三定律”。从其中的 “自信心定律”可窥见百度关于竞价排名的哲学：谁对自己的网站有信心，谁就排在前面。而有信心的表现就是愿意为这个排名多付钱。</p><p>他告诉《财经》记者，对于用户来说，是不是商业推广不重要，重要的是这个结果有没有满足他的需求。“竞价排名结果和用户搜索结果相关性最高时，可能不会伤害用户体验。出于这种理念，我们一直没有把推广结果和自然搜索结果区分得那么清楚。”他停顿了一下，补充说，但这确实也带来了很多抱怨。</p><p>基于上述定律，李彦宏相信：有时候自然搜索结果反而没有竞价排名结果好。比如搜索“干洗店加盟”，广告主是百度经过审核、有资质保证的，而在“自然搜索”中出现的干洗店加盟，这个公司存在不存在，无人知道。</p><p>6月8日，李彦宏在接受《财经》记者专访时称，魏则西事件中，和百度签合同是一家三甲医院，它资质完整，显示在合法地经营。事后，百度撤下了所有军警系统医院的广告，这是和魏则西事件最相关的一个措施。</p><p>中国第三大搜索引擎搜狗CEO王小川对《财经》记者表示，“医疗是一个特殊的行业。我们需要承担帮助用户甄别的社会责任。”</p><p>周鸿祎则认为，“搜索引擎三定律”在医疗行业是失效的。因为医疗是一个严重供给不足的行业，正规的好医院是不会花钱给搜索引擎打广告的。</p><p>“最后导致在这个（医疗）行业里，出钱越多的，基本上都是坏人。”他说，竞价排名像毒品，吸上之后很难戒掉。2016年5月，360搜索宣布放弃一切医疗商业推广。</p><p>在弱监管的社会，企业往往需要对自身有更高的道德自律，来承担一部分原本应由政府来承担的职责。知名互联网评论家洪波对《财经》记者说，百度错在并未诞生与其体量和影响力相匹配的成熟的商业伦理。</p><p>“如果对推广进行更清楚的标明，大家接受程度会更高的话，我是没问题的。”“魏则西事件”爆发后，李彦宏对《财经》记者表示。此次整改之后，百度控制商业推广信息占比不超过30％，同时加强了对“商业推广”字样的标注强度。</p><p>在不违法的前提下追求商业价值最大化，是百度的商业价值观，也是李彦宏的底线。但在关系到社会民生问题上，仅有商业价值观是不够的。“这两种文化最终需要聚焦在一个死去的大学生上来释放所有冲突。”一位腾讯公司人士称。</p><p>“百度原来有可能成为一家伟大的公司，当然未来也有可能。但现在，它只是一家赚钱的公司。”一位多年前供职于百度的高层人士称。</p><p>失衡的天平</p><p>“公司如果走偏的话一定就是文化和价值观出了问题。”李彦宏说，这是他现在最担心的事</p><p>“我们很早就意识并提出了这个问题。”上述前百度员工称，百度内部曾有过争论，以俞军为代表的产品团队坚持要彻底改变、取消“灰色地带”的广告客户，而时任百度COO沈皓瑜为代表的运营团队则反对。一名产品团队高层人士在会议上说：“这是让百度未来无法成为一家伟大公司的唯一原因。”最后双方达成共识——逐步改。</p><p>在这次会议中，李彦宏并未露面。</p><p>不久之后，“央视危机”爆发——2008年10月，央视接连两天报道百度的销售员工帮忙客户造假、甚至存在勒索营销的嫌疑。</p><p>6月8日，李彦宏向《财经》记者回顾，当时央视危机更多是因为百度在销售体系管理上确实有漏洞。“后来我们迅速把漏洞堵掉了。”</p><p>过去在百度内部，代表销售、商业化的力量和代表用户、产品的力量势均力敌，他们彼此牵制、相互妥协。直到2009年－2011年，以俞军、边江、李健为代表的几代百度产品总监相继离职，打破了天平的平衡。</p><p><br/></p><p>在百度销售网络高速扩张的2003年－2009年，同时也是百度产品创新的高峰时期。在那个阶段诞生了如百度贴吧、知道、百科等百度历史上最明星的产品。当时百度21个产品线中，拥有用户量过亿的产品就有7个-8个。2003年12月，百度创下一个月六个产品同时上线的记录。</p><p>“冲突是创新之母。”一位前百度产品总监告诉《财经》。</p><p>“我们工作的全部目的是要把信息获取这件事情拉平。”上述前总监称，他们认为任何阻挡了信息传播的行为都是不道德的。哪怕传播本身是不道德的，他们也要将信息、知识全部传播出去，去满足用户。这也是他们为什么要顶着盗版的风险做百度文库的原因。</p><p>一位百度前员工告诉《财经》记者，百度有很多不为外人所知的原则，它是产品技术部门的原则，但并不是整个公司的原则。比如，百度做MP3，只使用外链，不下载任何一首歌曲在自己的服务器上；早期百度坚决不做彩铃订阅套餐和游戏；做百度新闻，原则是没有任何人工编辑，2009年以前，百度新闻没有任何一个编辑的岗位。</p><p>“记得百度当年为了用户的1积分而彻夜追查问题。每年知道网友见面会后会倾听他们的声音，都会对每一个代码、每一个feature更加负责。对网民的负责，才成就了今天的百度。”一位仍在百度任职的老员工称。</p><p>随着俞军等代表百度早期产品理念、价值观的人离开，原先势均力敌的两股力量开始失衡。从现在的结果上来看——商业开始主导搜索，而技术、产品为商业服务。</p><p>“多数产品线都有很大（商业化）的压力。”一位百度员工说。</p><p>2016年2月，因为将血友病吧运营权承包给第三方合伙人运营，百度贴吧事件爆发。背景正是贴吧在2015年首次开始商业化，而此时距离贴吧成立已经过去了12年。</p><p>一位百度现任员工告诉记者，今天在百度搜索上所看到的很多问题，比如搜索一个关键词，先看到什么，后看到什么，“很大程度上不是技术问题，而是产品理念问题”。</p><p>相对而言，在百度，技术、市场、销售体系的员工晋升机会更多。现任百度高级副总裁、搜索公司总裁向海龙15年前仅是百度一家代理商的总经理，2005年，他的公司被百度收购，向海龙加入百度。</p><p>向海龙个子不高、不苟言笑。其下属称他从不与客户应酬，却带领团队连续三年保持200％以上的高速成长，2007年向海龙升任为北京分公司总经理，三个月后又升任百度公司销售副总裁。2011年，向成为百度公司商业运营体系副总裁。2015年，成为百度三大业务群组之一的搜索业务群组（SSG）负责人。2016年，SSG和移动服务事业群组（MSG）合并为百度搜索公司，向海龙成为CEO。</p><p>百度共有三个SVP（高级副总裁），负责技术的王劲于2013年12月晋升为百度高级副总裁，掌管销售的向海龙于2014年10月晋升为SVP。今年6月22日，朱光成为百度第三个SVP，朱光2008年加入百度，最早在百度负责市场及公关业务。</p><p>另外一部分员工则认为，“升迁极其困难，尤其早年在产品体系内，几乎不可能升迁。”一位前百度员工称，百度七大创始人中的郭眈与崔姗姗离职时，职位还是百度高级总监，而当时他们已为这家公司工作了十年。现任美团联合创始人穆荣均以技术经理身份离开百度时，手里只有公司分的几十股。</p><p>在这一轮的调整中，百度地图、贴吧等产品也划归到向海龙辖下。</p><p>“百度有一条非常粗的大腿，叫搜索、叫变现。与其打一个用户习惯还没培养成的新市场，不如这个季度给公司多赚5亿，完成KPI，升职更快、奖金更多。”一位百度搜索公司现任员工称。</p><p>“那些新加入的人，包括高层，他们对于百度的价值观到底是什么？可能还有误解。”李彦宏说。</p><p>近年来，随着百度的快速增长，大量部门的人员数量膨胀，这直接带来了对早期百度价值观的稀释。李彦宏称，这是他最担心的事情。</p><p>百度的企业文化是简单可依赖，早期80％的人是产品技术员工。“而现在5万员工里有2万人司龄不超两年，过去三年我们的员工数量不断翻倍，而他们对百度的感情、对于百度文化的融入是很有限的。”上述百度中层人士告诉记者，“我们不仅要打败外部，还有内部。”</p><p>“在百度适合磨平棱角。”百度一位高级别的员工称。在百度工作，刚开始半年很累，适应了后压力就不大。但百度的价值观考核事实上很严格，“360度打分，自己填写打分，上级打分，下级打分，同级打分。”</p><p>2014年，百度内部爆发了一次关于企业文化的争论。起因是内网的一篇发帖，有员工认为百度的企业文化是有问题的，而管理层则坚持百度的企业文化依然很好——他们为此争论了几千页。</p><p>这次大争论的结果是，百度进行了一系列文化夜谈，员工聚在一起，相互分享百度的文化故事。</p><p><br/></p><p>2015年7月，百度将外卖业务拆分出去独立发展；10月，百度将去哪儿出售给携程。今年，爱奇艺也将随着私有化而剥离出百度。甩掉这三个成本中心后，百度会更为轻松。</p><p><br/></p><p>在百度内网，李彦宏的公开信下共有300多条员工评论。“希望未来回头来看今天，是我们历史上一个重要契机。因为直面了自己的问题，有魄力去改正完善。”多名百度员工留言称，他们希望可以和百度一起跨过从“大企业到伟大企业的长距离”。</p><p><br/></p>', 0, 1, '', '', '', '', '2016年初时，即使最悲观的互联网分析师也不会想到，这家总市值650亿美元、2015年净利润超过51.9亿美元、同比增长155％的中国互联网巨头，在本土会遭遇如此重创。', '2016-05-19 15:37:00', '2016-07-12 01:26:03', '0000-00-00 00:00:00', 10, '', '', 0, '/upload/newsthumb/2016-07-08/577f0441aca45.png', 0),
	(20, 2, '曹麦穗', '季节效应和MPA考核压力下 隔夜回购利率飙涨近800%', 4, 0, 0, '/upload/newscover/2016-06-25/576e33887afd7.png', '<p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;"><span style="color: rgb(0, 0, 0);">6月23日消息，今日早盘，沪深交易所国债回购利率全线飘红。截至收盘，</span><a class="wt_article_link" href="http://weibo.com/chinasse?zw=finance" target="_blank" style="text-decoration: underline; color: rgb(0, 0, 0);"><span style="color: rgb(0, 0, 0);">上交所</span></a><span style="color: rgb(0, 0, 0);">一天期国债回购利率GC001涨幅783.08%，报5.74%。</span></p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;"><span style="color: rgb(0, 0, 0);">　　步入6月下旬，流动性终于出现了市场预期已久的收敛，资金面的趋紧一下子将沉浸在乐观氛围之中的市场参与者拉回了现实，市场情绪重归谨慎的状态。然而，</span><a class="wt_article_link" href="http://weibo.com/u/3921015143?zw=finance" target="_blank" style="text-decoration: underline; color: rgb(0, 0, 0);"><span style="color: rgb(0, 0, 0);">央行</span></a><span style="color: rgb(0, 0, 0);">货币政策调控也在发力，央行逆回购交易量已连续三日破千亿，流动性也只是略微收紧。</span></p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;"><span style="color: rgb(0, 0, 0);">　　市场人士指出，在超储难言充裕而季节性压力较大的情况下，半年末季节效应和MPA考核影响不容小觑，最近缴税和MLF到期也新添扰动，对流动性短时波动风险需给予重视，但也要看到央行对流动性的支持力度在加大，并且有充足工具和手段来平抑货币市场异常波动，加上各方提前有所准备，预计半年末流动性风险可控，货币市场利率面临上限约束，无需对流动性过度悲观，资金面最终平稳度过半年末时点仍是大概率事件。</span></p><p><br/></p>', 0, 1, '', '', '', '', '​6月23日消息，今日早盘，沪深交易所国债回购利率全线飘红。截至收盘，上交所一天期国债回购利率GC001涨幅783.08%，报5.74%。', '2016-05-19 15:36:36', '2016-06-25 17:42:22', '0000-00-00 00:00:00', 8, '', '', 0, NULL, 0),
	(21, 2, '曹麦穗', '新三板创新层名单敲定953只个股入围', 1, 0, 0, '/upload/newscover/2016-06-25/576e324740e25.png', '<p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　6月24日，全国中小企业股份转让系统挂牌公司完成创新层挂牌公司筛选工作。最终满足创新层标准的挂牌公司共计953家。</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　根据《关于创新层挂牌公司初步筛选名单异议处理结果的公告》，结合市场异议的核实情况，贵州三力制药股份有限公司等39家挂牌公司满足分层管理办法的规定，调整进入创新层挂牌公司名单。</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　同时，创新层初步筛选名单公示后，新疆火炬燃气股份有限公司、厦门日懋城建园林建设股份有限公司、同创<span id="stock_sh600053"><a href="http://finance.sina.com.cn/realstock/company/sh600053/nc.shtml" class="keyword" target="_blank" style="color: rgb(17, 62, 170); text-decoration: none;">九鼎投资</a></span><span id="quote_sh600053">(<span style="color:green">32.470</span>,&nbsp;<span style="color:green">-1.16</span>,<span style="color:green">-3.45%</span>)</span>管理集团股份有限公司等3家挂牌公司申请自愿放弃进入创新层，根据分层管理办法的规定，将上述3家挂牌公司调整出创新层挂牌公司名单。</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　另外，联讯证券股份有限公司、开源证券股份有限公司因被中国<a class="wt_article_link" href="http://weibo.com/csrcfabu?zw=finance" target="_blank" style="color: rgb(17, 62, 170); text-decoration: none;">证监会</a>派出机构采取行政监管措施，根据分层管理办法的规定，将其调整出创新层挂牌公司名单。北京中搜网络技术股份有限公司因公司客户和投资者举报反映其存在公司治理不健全、内控不合规等问题，根据分层管理办法的规定，将其调整出创新层挂牌公司名单。</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　自2016年6月27日起，全国股转公司正式对挂牌公司实施分层管理，并分别揭示创新层和基础层挂牌公司的证券转让行情和信息披露文件。</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　全国股转系统要求主办券商、信息商等市场参与主体高度重视，各尽其责，做好技术和业务准备，认真向投资者进行解释说明，确保挂牌公司分层信息正确揭示，方便投资者查询相关信息，保证股票转让等业务正常进行。遇有重要情况，主办券商应及时向全国股转公司报告。</p><p><br/></p>', 0, 1, '', '', '', '', '新疆火炬燃气股份有限公司、厦门日懋城建园林建设股份有限公司、同创九鼎投资管理集团股份有限公司等3家挂牌公司申请自愿放弃进入创新层。', '2016-05-19 15:34:38', '2016-06-25 15:27:56', '0000-00-00 00:00:00', 8, '', '', 0, NULL, 0),
	(22, 2, '曹麦穗', '周小川拉加德问答实录：促银团贷款 约束银行降杠杆', 3, 0, 0, '/upload/newscover/2016-06-25/576e32234e8e7.jpg', '<p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">（图为<span style="font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; line-height: 32px;">拉加德向周小川赠送了一把某中国品牌的羽毛球拍作为答谢</span>）周小川在会上做了《把握好多目标货币政策：转型的中国的经济视角》的发言，并与IMF总裁<a class="wt_article_link" href="http://weibo.com/christinelagarde?zw=finance" target="_blank" style="color: rgb(17, 62, 170); text-decoration: none;">拉加德</a>展开了一对一的讨论。</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　拉加德介绍说周小川是一位羽毛球和网球好手。在讲座结束后，她向周小川赠送了一把某中国品牌的羽毛球拍以示感谢。</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　以下为两人的问答实录，小标题为编者所加：</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　<strong>汇率政策与汇率制度改革</strong></p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　<strong>拉加德：</strong>这些年中国的货币政策框架不断发展，基金组织也与人民银行持续进行合作。中国已实现了多项重大改革，如实施了存款保险机制，实现了利率自由化，利率走廊取得进展，汇率改革方面也是如此。您也澄清了人民币与一篮子货币（而非仅美元）之间的关系。除这些变革外，请问您下一步还有何打算，特别是在汇率方面？您预计今后会有什么变化？</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　<strong>周小川：</strong>我首先谈一谈人民币汇率的历史演变。汇率政策和汇率制度改革是中国改革和开放政策的关键要素。</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　很多人研究了亚洲经济体之间的相似性。一些小型经济体，包括一些东盟国家，实施了出口导向的转型战略。后来，中国也采用了所谓的“外向型”发展战略。</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　尽管这些经济体具有不同的特性，其中一些经济体曾在战后实行指令经济，中国则实行中央计划经济，但这些经济的转型都依赖于定价机制的转变。在纠正价格扭曲的过程中，通常都要改革汇率制度，并实施税收改革，例如，将旧的税收体系转变为增值税体系，以将国际价格引入国内价格体系。通过出口参与国际竞争，并通过进口来改变国内价格体系的扭曲。我认为，这正是汇率政策在中国中早期经济改革中发挥的作用。</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　但是，随着中国经济日益融入全球经济，下一个阶段，我们应当认真研究世界各国的经验，不仅限于亚洲经济体的经验。我们将进一步推进改革开放，促进贸易和投资，使经常账户和资本账户兑换更加便利，为中国和外国公民经商和旅游提供更多方便。这些是我们下一步要做的工作。</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　我们感谢基金组织将人民币纳入特别提款权的决定。所有这些努力都表明，中国汇率制度的变化是服务于中国总体发展战略的，并应符合中国经济的发展阶段。</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　因此很容易理解，下一步人民币汇率制度应符合市场经济的更高要求，即汇率更加灵活，经常账户和资本账户资金流动更加自由，本外币兑换更加方便，并能为本国和外国投资者提供风险管理工具。我认为，这也符合中国经济与全球经济之间更加密切联系的需要。</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　<strong>如何面对市场波动</strong></p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　拉加德：面对市场波动，你认为银行、企业、个人会预期到这些变化么？银行会在其中起到什么作用？也许不只是消费者保护，而也包括消费者教育？</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　周小川：这也与中国转型的历史有关。大家可能以为中国的企业、居民只熟悉固定汇率和资本流动高度管制的情况，但其实并非如此。80年代经济改革初期，第一项重大措施就是人民币贬值，人民币兑美元汇率从1.9贬值至2.8。此后，官方和市场汇率还有数次变化。90年代人民币汇率的主要特点是所谓的双轨制。官方汇率用于对国有企业进行支持，其他市场参与者则适用市场汇率。市场汇率对美元波动较为剧烈，从5开始贬值，到1993年贬至9，后来贬至11。实际上，当时的中国人已经知道如何应对汇率波动。后来适用官方汇率的比例不断降低，下降至20%以下。到1994年，中国决定汇率并轨，形成单一汇率体制。此后，汇率也是波动的，特别是在亚洲金融危机时期，人们都经历了人民币的汇率波动。</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　但自2003年后的十年内，汇率相对稳定，并呈单向升值。因此，年轻一代人可能只经历过汇率的单向变动，可能对汇率波动准备不足。<strong>但国际形势是不断变化的，会出现许多新的情况，就像我们昨天看到的（英国公投那样）。</strong>因此，人们会更好地了解汇率波动。从80年代、90年代人的经历来看，这不会很困难。</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　<strong>对<a class="wt_article_link" href="http://weibo.com/u/3921015143?zw=finance" target="_blank" style="color: rgb(17, 62, 170); text-decoration: none;">央行</a>来说，我们试图对公众进行教育，让其了解市场形势。我们努力减少过多管制，引入更多的外汇市场风险管理工具，包括外汇掉期、衍生品，希望中国企业和居民在这个环境中变得越来越成熟。</strong></p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　<strong>SDR使用</strong></p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　<strong>拉加德：</strong>您刚才提到了SDR，在推动人民币纳入SDR方面我们有很好的合作。我知道你和你的团队支持更加广泛的使用SDR。因此，你们也正在消除SDR使用者进入人民币市场的障碍。能否给我们介绍一下您在推动SDR使用方面的思路，比如SDR债券等？</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　<strong>周小川：</strong>我们愿意看到SDR更广泛的使用，人民银行也开始用SDR作为一些报表的报告货币。<strong>关于你提到的我们正在消除SDR使用者进入人民币市场的障碍。</strong><strong>一方面，央行试图帮助提高人民币在贸易、投资和金融市场等领域的可自由使用程度。另一方面，我们将其视为一个促进中国全面深化改革的方式。</strong>这就像早期汇率制度改革对中国的外向型经济发展战略所发挥的发动机一样的作用。</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　但我们也看到，人民币更广泛的使用是一个自然而然的过程，要尊重市场参与者的选择。如果美元汇率稳定、流动性充裕，没有不正常的资本流动，这时人们愿意选择美元。否则，人们也希望看到货币的多元化，以更好地管理风险，我们乐意看到这样渐进的发展过程。</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　在扩大人民币使用方面，央行已经采取了不少政策措施，我们还可以在人民币可兑换方面做更多工作，包括进一步发展外汇市场和减少不必要的管制措施等。<strong>我们特别关注人民币还不能自由使用的领域，确保人民币达到可自由使用的标准。我们知道人民币在金融交易方面的使用还不够广泛。虽然交易规模正在逐渐上升，但这不会是一个线性的过程，会受到全球市场波动的影响，螺旋式上升。</strong>当然，长期内人民币还是有望能够在全球金融市场更广泛的使用。另外，我们还强调宏观经济稳定和低通胀的重要性。如果我们实现了宏观经济的稳定增长和低通胀，市场参与者自然会选择更多使用人民币。</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　<strong>如何解决不良贷款</strong></p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　<strong>拉加德：</strong>您和许多人都关注的一个问题是，中国经济整体负债程度过高，需要削减过剩产能。包括基金组织在内的许多机构也都提出了建议。对于企业债务，中国正在采取什么应对行动？是否会向僵尸企业“开刀”，将采取什么措施解决不良贷款问题？</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　<strong>周小川</strong>：危机后，中国实施了大规模财政和货币刺激计划。这可能导致了企业部门杠杆程度上升，一些行业出现产能过剩。但是，中国经济也因此得以从雷曼兄弟事件中迅速恢复。有得必有失。</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　从全球看，总需求依然不足。我们已经应用了需求侧政策，现在有一些问题需要应用供给侧政策来解决，这也是中国经济改革的关键所在。</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　<strong>需解决三方面的问题。一是产能过剩。二是企业部门杠杆率过高，要注意不是整体经济，只是企业部门。三是房地产市场库存量过大。</strong></p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　为研究这一问题，我们首先需要进行国际比较。中国企业部门的总体杠杆程度很高，但中国的储蓄率也很高。居民将钱存在银行里，而资本市场尚不完善，所以大量资金通过银行发放贷款和购买企业债券。与其他发展中国家相比，中国的杠杆程度较高，这有其合理性。但杠杆程度过快上升很危险。所以，我们在一开始就认真分析，哪些行业、哪些所有制的企业、哪些治理结构的企业具有过高的杠杆率。</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　在明确了问题之后，中央银行和银行监管机构就可以运用适当的政策影响借贷行为，解决企业负债过高问题。</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　有时也存在竞争问题。一些企业可能有地方政府背景。如果一家银行没有贷给它，它可以找其它银行。</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　<strong>拉加德：</strong>对此，您是否已有工具来应对？例如，限制一些银行，而对其他向杠杆率正常企业贷款的银行提供支持？</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　<strong>周小川：</strong><strong>这是一个新的挑战，央行需要与监管者、商业银行共同合作、形成共识，促进银团贷款发展，让银团贷款发挥更重要的作用。约束银行降杠杆。</strong>另外，企业方面，需要考虑为什么这些企业在股本不足的情况下可以举借这么多债务。补充资本和完善公司治理是企业部门改革的一个重点。第三，<strong>投资者方面，金融危机后，中国国有企业发展经历了一个黄金时期，投资者（特别是个人投资者）可能存在一个错误认识，即只要是国有企业的债券，就是安全的，因为国有企业违约很少见。因此投资者教育非常重要。</strong>如果我们能在这三个方面开展工作，资源分配将逐步改善，更多资源会流向私人部门、高科技企业、服务业，而这需要一个过程。</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　<strong>拉加德：</strong>税改是否能在鼓励企业进行股权融资（而非债务融资）中起到作用？许多发达经济体实际都考虑到了这个问题。</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　<strong>周小川：</strong>近期我们推出了营改增改革，这将对服务业更加有益。另一个相关的问题是交易税。一方面，人们需要分散风险，因而要进行证券化，出售部分资产，推出债转股等。这些都与不同类别的交易税及其他税种相关。因此，应对上述问题进行系统性的评估，包括税种设置等。另一个问题是国际比较，看其他国家是否有类似税种，看税率是否过高或过低，之后判定其是否有益。</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　<strong>影子银行</strong></p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　<strong>拉加德：</strong>关于影子银行。您曾表示需要有影子银行，因为不论金融部门开放有何种重大进展，影子银行都是银行业的重要补充。我也知道您在仔细观察这一问题。您也不想让他们过于脱离管制。您是否有信心做到这一点？</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　<strong>周小川：</strong><strong>我们都知道影子银行会造成严重问题，美国就是一个例子，我们应对影子银行保持高度关注。</strong></p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　但从中国影子银行的现象及其结构看，我认为中美的影子银行并不相同。金融稳定理事会（FSB）和国际清算银行（BIS）将影子银行分为两类，包括影子银行机构（如对冲基金、货币市场基金）和影子银行活动。其中，影子银行活动是指传统的商业银行采取的旨在规避传统监管的有关活动，而中国影子银行主要是这一类。<strong>其总规模目前并不很大，如果我们将影子银行活动的总资产与传统银行资产相比较，则规模只有后者的20%；如果与银行总贷款相比，则只有30%，因为银行资产比银行贷款规模要大的多。</strong></p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　但近期影子银行的发展十分迅速，原因之一是存在监管真空和监管套利。影子银行发展十分迅速，会占据较大市场份额并获得较高利润，而传统金融机构（如银行、保险公司等）则会纷纷效仿。<strong>中国已决定开展新一轮监管体制改革来覆盖这些监管真空领域，希望能解决上述问题。</strong></p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　另一个挑战是，危机后国际社会对金融机构的资本要求不断提高，对“大而不能倒”机构的资本要求尤其高；近期还提出了总损失吸收能力（TLAC）方面的有关要求。</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　<strong>拉加德：</strong>中国有五家全球系统重要性银行？</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　<strong>周小川：</strong>中国有四家全球系统重要性银行，一家全球系统重要性保险公司。但还有多家银行和保险公司的规模和开展国际业务的程度接近这几家。当我们要求增加这些机构的资本充足率时，它们会试图进行一些资本要求较低的业务，或者不受资本充足率监管的业务。因此，我们需要保持监管的平衡。</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　第三个重要问题是互联网公司迅速发展。互联网公司在支付、银行业服务和众筹等领域不断渗透，并创造了新的金融工具。<strong>我们从感情上是支持高科技发展的，人们也不希望这些互联网公司受到太多限制，但这些公司确实在从事一些影子银行活动。</strong></p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　<strong>拉加德：</strong>您是否希望加强阿里巴巴的监管？</p><p style="margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal;">　　<strong>周小川：</strong><strong>阿里巴巴的情况已经有所变化。</strong>监管部门向其颁发了银行牌照。人民银行也向其颁发了支付牌照。<strong>但是，根据金融稳定委员会对影子银行的定义，他们所进行的影子银行活动存在期限转换问题，杠杆程度过高，资本要求也不同于传统银行。</strong>我们将研究这些问题，并创造公平的竞争环境。<strong>我们鼓励互联网公司发展，但当它们开展金融业务时，在当前的情况下，它们需要遵守现有规则。</strong></p><p><br/></p>', 0, 1, '', '', '', '', '周小川拉加德问答实录：促银团贷款 约束银行降杠杆', '2016-05-19 15:35:29', '2016-06-26 14:33:12', '0000-00-00 00:00:00', 8, '', '', 0, NULL, 0),
	(23, 2, '曹麦穗', '万科：除深铁外 仍在与另一名潜在交易对手谈判', 2, 0, 0, '/upload/newscover/2016-06-25/576e315c8120d.jpg', '<p>　　24日晚，万科公告称，除地铁集团外，公司于2015年12月25日与另一名潜在交易对手方签署了一份不具有法律约束力的合作意向书。目前公司仍在与该潜在交易对手方进行谈判，公司预计该笔意向交易金额未达到重大资产重组的要求；而且与跟深铁的交易不同的是，公司也无意以发行股份的方式作为对价。</p><p>　　此外，万科表示，公司与相关中介机构目前正在积极进行逐项落实和回复<a href="http://weibo.com/szse?zw=finance" target="_blank">深交所</a>下发的《关于对万科企业股份有限公司的重组问询函》，待公司向深交所提交说明回复，并经深交所审核通过后，将会申请复牌。</p><p><br/></p>', 0, 1, '', '', '', '', ' 第一大股东易主——万科是谁的万科？', '2016-05-19 15:34:38', '2016-06-26 14:33:43', '0000-00-00 00:00:00', 8, '', '', 0, NULL, 0),
	(24, 2, '曹麦穗', '交易商协会暂停瑞华发债审计 万亿债券将换审计机构', 12, 0, 0, '/upload/newscover/2016-06-25/576e30db4594d.png', '<p>债券市场违约事件多发的同时，中介机构的职能及履约能力也越来越受到市场关注。</p><p>　　6月21日，银行间市场交易商协会发布消息称，在针对绿地集团和云峰集团涉嫌信息披露违规等事项开展调查过程中，瑞华会计师事务所因未按照要求提供相关资料而被处罚。根据自律处分规定，给予瑞华公开谴责处分，并作出责令改正、暂停相关业务一年的处分。</p><p>　　对此，瑞华会计师事务所其官网上发布声明回应称：“协会的做法及相关决定是极为草率和不负责任的，也是我所根本不能接受的。”并且表示，“为了维护债券市场公平正义，维护注册会计师行业尊严，将通过司法途径主张自身权利，挽回由此带来的名誉及经济损失。”</p><p>　　21世纪经济报道记者就此联系瑞华，该公司工作人员表示，不方便接受任何采访。瑞华作为国内较大的会计师事务所，市场占有率较高。Wind数据显示，目前存续的债券中，由瑞华审计发行的共计1101只，涉及金额高达17506.5亿元。</p><p>　　云峰两份中报数据相差甚远</p><p>　　根据交易商协会公布的答记者问，2016年2月，因发现绿地集团所披露云峰集团财务信息与云峰集团自身披露的财务信息存在巨大差异，协会向绿地集团审计机构瑞华会计师事务所发送自律调查通知书，要求其说明具体情况并提供相关工作底稿。</p><p>　　3月4日，协会调查人员赴瑞华上海分所开展现场调查。5月6日，协会再次向瑞华发函明确要求其配合调查工作，并于收到函件5个工作日内向协会提交相关工作底稿。瑞华未能按照协会相关要求及时提供调查工作所需材料，未履行会员应尽义务。</p><p>　　作为并表子公司，绿地集团于2015年8月25日公布的半年报显示，截至2015年6月末，云峰集团流动资产234.39亿元，非流动资产101.11亿元，资产总计335.5亿元；流动负债225.89亿元，非流动负债106.06亿元，负债合计331.96亿元。</p><p>　　以此计算，云峰的资产负债率高达98.9%，净资产仅3.54亿元。此外，云峰集团2015年上半年营业收入为213.86亿元，净利润为-2.65亿元，综合收益总额为-2.65亿元，经营活动现金流量为-7.01亿元。</p><p>　　不过，投资者向21世纪经济报道记者提供的一份云峰集团2015年中报却显示，该公司流动资产161.3亿元，非流动资产86.1亿元，资产总额247.71亿元；流动负债115.44亿元，非流动负债82.24亿元，负债总额197.68亿元。这份财报中，云峰集团净资产为49.73亿元，资产负债率仅79.9%。</p><p>　　营收方面，2015年上半年实现营业收入217.53亿元，营业利润为3375万元，净利润为-2461万元，经营活动产生的现金流为1.58亿。以上各关键财务数据均与绿地集团公布的差距甚远。</p><p>　　云峰集团于2014、2015年共发行了7期非公开定向融资工具（PPN），规模66亿元。今年1月底，由于云峰集团的负债率超过85%，触发了“15云峰PPN003”及“15云峰PPN005”共计20亿元的私募债券提前到期条款，并最终出现本息违约。</p><p>　　瑞华不服交易商协会处罚</p><p>　　对于交易商协会的处罚，瑞华却罕见地作出强硬回应。</p><p>　　根据瑞华的声明，其理由主要是“我所未与云峰集团签订债务融资业务约定，不是云峰集团发行债务融资工具的申报会计师，因此，我所不应列为自律处分对象。在交易商协会针对云峰集团涉嫌信息披露违规开展的自律调查中，交易商协会要求我所提供调查工作所需资料，我所在力所能及的范围内履行了应尽的义务。”</p><p>　　对此，接近交易商协会人士表示：“因绿地、云峰都被调查，二家的审计机构都需提供底稿，瑞华提供的是绿地涉及云峰的内容。”</p><p>　　也有业内人士认为，协会作为自律组织，处罚没有依据，也无权要求会计师事务所提供审计底稿。</p><p>　　前述接近协会的人士认为：“规则很清楚，开过四次律师会议，二十多个律师都认为法律法规没问题”。</p><p>　　21世纪经济报道记者查询交易商协会官网发现，瑞华会计师事务所位列交易商协会的6080家会员名单中，这意味着应接受协会自律规则。</p><p>　　根据交易商协会2012年修订后的《银行间债券市场非金融企业债务融资工具中介服务规则》，中介机构应当对所依据的文件资料内容的真实性、准确性、完整性进行必要的核查和验证。交易商协会可对中介机构的中介服务开展情况和自律规范性文件遵守执行情况开展业务调查。中介机构应积极配合调查，及时提供真实、准确、完整的材料。</p><p>　　中介机构未按规定配合协会业务调查的，根据情节严重程度给予诫勉谈话、通报批评、警告、严重警告或公开谴责处分，可并处责令改正、责令致歉、暂停相关业务、暂停会员权利或取消会员资格。</p><p>　　万亿债券将换审计机构</p><p>　　也有业内人士质疑，协会为什么不处罚云峰集团的审计机构上海华申会计师事务所？</p><p>　　为此，前述接近协会的人士向21世纪经济报道记者表示：“调查才刚开始，协会公告通告说得很清楚，是阶段性的。如果调查下来涉及违规违法，一定会依法处理。现在云峰和瑞华被处罚，是因为刚开始调查就拒不履行会员义务。”</p><p>按照目前的处罚结果，瑞华被公开谴责，并暂停债务融资工具相关业务一年。</p><p>　　华创证券分析认为：“瑞华市场占有率较高，受牵连企业数量众多。”</p><p>　　华创证券认为，由于受罚，目前瑞华正在参与审计的项目将被交易商协会拒绝受理，或造成部分企业进行中的融资计划因更换会计师事务所而被迫中断。</p><p>　　接近协会的人士向21世纪经济报道记者表示：“当时处罚己考虑到对市场的影响，个人认为不超过十家。其他的影响很小，因为现在2015年审计报告差不多都审计完了，2016年审计到年底才开始。”</p><p>　　Wind数据显示，目前由瑞华提供审计的存续债券共计1101只，规模共17506.5亿元。扣除发行期限为一年以内的短融和超短融，受影响的是部分存续期限超过一年的中票。在瑞华审计的所有债券中，存续期限长于1年的有799只，涉及金额或超万亿。这就意味着，剩余的799只债券，凡是在银行间发行的，都需在明年更换审计机构。</p><p><br/></p>', 0, 1, '', '', '', '', 'Wind数据显示，目前由瑞华提供审计的存续债券共计1101只，规模共17506.5亿元。扣除发行期限为一年以内的短融和超短融，受影响的是部分存续期限超过一年的中票。', '2016-05-19 15:36:36', '2016-08-10 18:08:06', '0000-00-00 00:00:00', 8, '312323', '', 0, '', 0),
	(25, 2, '曹麦穗', '证监会：将核实万科重组独董回避表决情况', 2, 0, 0, '/upload/newscover/2016-05-19/573d6c22d9ced.jpg', '<p>近期有媒体报道万科召开董事会及独立董事回避表决相关情况，华润公司已对董事会有效性表示异议。对此，<a href="http://weibo.com/csrcfabu?zw=finance" target="_blank">证监会</a>新闻发言人邓舸昨日表示，证监会已关注到相关情况。上市公司董事会的召开，独立董事的履职等，应严格遵守《公司法》等法律法规及公司章程的规定。独立董事对公司及全体股东负有诚信与勤勉义务。</p><p></p><p>邓舸称，目前，交易所已对万科董事会的召开及重组方案开展问询。证监会将对本次董事会的召集、独立董事提出回避申请等相关事项作进一步核实。</p><p>　　此外，有媒体报道，证监会对已完成并购重组未实现业绩承诺的上市公司进行抽查，并针对目前在会的全部并购重组项目进行复核，尤其是商誉较大的轻资产类公司。</p><p>　　对此，邓舸昨日回应称，加强上市公司并购重组事中事后监管，是证监会并购重组监管全链条的重要环节。上市公司2015年年报披露以后，证监会重点关注了上市公司并购重组业绩承诺的完成情况及信息披露的合规情况。目前，证监会正对部分已实施并购重组，但承诺完成比例低、媒体质疑较大的上市公司开展专项检查。检查发现违法违规的，发现一起，查处一起。</p><p>　　邓舸强调，规范并购重组市场秩序，需要各方共同努力。财务顾问、审计、法律、评估等各类中介机构都要遵循行业公认的执业标准，切实履行职责、勤勉尽责，切实维护投资者的合法权益。</p><p><br/><br/></p>', 0, 1, '', '', '', '', '近期有媒体报道万科召开董事会及独立董事回避表决相关情况，华润公司已对董事会有效性表示异议。对此，证监会新闻发言人邓舸昨日表示，证监会已关注到相关情况。上市公司董事会的召开，独立董事的履职等，应严格遵守《公司法》等法律法规及公司章程的规定。独立董事对公司及全体股东负有诚信与勤勉义务。', '2016-05-19 15:34:38', '2016-08-01 11:05:11', '0000-00-00 00:00:00', 8, '', '', 1, NULL, 0),
	(26, 2, '曹麦穗', '周小川谈央行多目标货币政策框架：收益大于成本', 0, 0, 0, '/upload/newscover/2016-06-25/576e2f195759e.jpg', '<p>全球金融危机过后，不少过往根深蒂固的中央银行的信条和政策框架面临了巨大的挑战和辩论，货币政策、金融稳定、金融监管、以及财政政策等多政策的协调，正在重构全球决策者的决策框架。</p><p>　　“中国<a href="http://weibo.com/u/3921015143?zw=finance" target="_blank">央行</a>采取的多目标制，既包含价格稳定、促进经济增长、促进就业、保持国际收支大体平衡等四大目标，也包含金融改革和开放、发展金融市场这两个动态目标。”6月24日，在华盛顿国际货币基金组织（IMF）每年一度的康德苏讲座上，中国央行行长周小川首次面向国际社会详细阐述了中国央行选择多目标货币政策框架的原因。</p><p>　　“维持价格稳定的单一目标制是一个令人羡慕的制度——简洁、好度量、容易沟通。但对现阶段的中国尚不太现实。”周小川认为，多目标货币政策选择与中国处于经济转轨中的国情是分不开的。</p><p>　　周小川坦陈，央行的目标模型选择不可能只有收益，没有成本。他表示，“与同样处在转轨经济中的世界其他央行相比，中国央行推进了改革，促进了金融市场的发展，大体上保持了金融稳定，也赢得了机会去更好地实现货币政策目标，可以说收益大于成本。”</p><p>　　货币政策的“动态目标”</p><p>　　财政政策和货币政策理论上是有分工的，然而，全球金融危机以后，财政政策使用得并不充分，直接造成了对货币政策过度依赖。这引发了全球范围内对货币政策和财政政策相互关系的辩论。</p><p>　　而中国的特殊性在于，中国央行长期承担了改革开放、发展金融市场和国际收支平衡这三大“不寻常”的政策目标。为什么央行要有这些目标？为什么是央行而不是财政？</p><p>　　首先，<a href="http://weibo.com/u/3921015143?zw=finance" target="_blank">人民银行</a>为什么要支持并组织改革开放？周小川解释道，转轨早期的共性问题是价格严重扭曲，资源配置非常低效，银行也还不是真正的商业银行，这些扭曲和资源配置错误的损失通常最终都集中于银行体系。不改革开放就不会有健康的金融机构体系，就没有金融稳定可言，中央银行难以实现价格稳定，货币政策的有效性也无从谈起。因此，在这一历史阶段，金融改革和实现金融系统健康化和稳定的重要性甚至要高于通胀等传统目标。</p><p>　　亚洲金融风波之后，针对中国银行部门的资本充足率、不良贷款等指标严重恶化，国际业界普遍评论中国的大型银行已经陷入了“技术性破产”。在缺少买家的情况下，中国需要靠力量来救助银行并进行改造。而当时的现状是财政没有足够的资源，1990年代财政收入占GDP比重的低点仅约为10%。周小川表示，当时人民银行剥离了政策性不良资产，对问题银行进行了注资，并推动各大型银行公开发行上市、转向混合所有制、改革其治理和提高国际竞争力，在宏观上维护了金融稳定，顺利走出了亚洲金融风波的危机。</p><p>　　其次，人民银行为什么要发展金融市场？周小川进一步解释认为，转轨经济体通常价格机制僵化，缺乏成熟经济体的金融市场和金融产品。这种情况下，货币政策也无法正常传导，也无法建立建立现代市场化的宏观调控框架。因此，人民银行推动金融市场发展，是其更好履行货币政策职责的内在要求。</p><p>　　最后，人民银行为什么要关注国际收支平衡？ 周小川表示，中国在转轨过程中选择了外向型发展道路，在高速增长的同时也提高了中国对国际贸易和外资的依赖度，国际收支在很大程度上影响到了央行的货币政策、货币供应量和价格稳定目标。因此，中国央行必须要关注国际收支平衡问题，相应也需要承担管理汇率、外汇、外汇储备、黄金储备、国际收支统计等职能。而财政在转轨早期、中期面对大量显性和隐性亏损，处于极度困难的阶段，可以理解会对金融改革、汇率、国际收支取避让策略。</p><p>　　金融稳定和央行独立性</p><p>　　金融危机以来，各国央行和政策制定者达成的最大共识在于，着眼于系统性风险的金融稳定是和和央行的价格稳定政策一样重要的政策目标。同时，由于全球互动越来越显著，产生众多的关于溢出和反向溢出的讨论，因此，金融稳定也是一个全球性问题。</p><p>　　美联储前副主席唐纳德·科恩曾表示，在货币政策的目标系统中，增加金融稳定这个目标，对现阶段的中国更加迫切。例如，在保证产出和就业的同时，中国的货币政策还要在资本管制只发挥部分作用并逐步被解除的情况下，抑制汇率水平的剧烈、破坏性震荡。</p><p>　　周小川表示，由于将金融稳定、国际收支、金融发展、改革开放等多目标都纳入了政策框架，显然会带来不少潜在的挑战，例如如何建立追求优化的多目标函数，如能解决好权重系数等等。此外，将不同国家、不同类别的模型加以联结，更是加重了“维度灾难”（Curse of Dimensionality）等困难。</p><p>　　不过，这并不意味着没有解决方案。周小川分析到，央行在面对多重政策目标的时，可以模拟市场公允价格的形成机制，通过权衡决策层和专家层等各方面的意见，模拟出公允价格，作为权重系数。</p><p>　　此外，目标的权重也可以是一个动态调整的过程。周小川举例说，在危机期间，中国就调高了金融稳定和金融机构健康化的权重；而在通胀较高的时候，价格稳定的权重升高；在经常项目余额占GDP比重较大的时候，国际收支目标的权重又会相应得到提高。</p><p>　　显然，多目标和动态调整使中国央行的目标函数看起来不太稳定， 多目标、多维度，显然也加重了人们对中国央行独立性的担忧。周小川对此回应道，《中国人民银行法》对央行独立性也是有语言表述的，即“中国人民银行在国务院领导下依法独立执行货币政策，履行职责，开展业务，不受地方政府、各级政府部门、社会团体和个人的干涉”。展望未来，他表示，如果今后央行的改革任务基本完成，目前的这种状况也可能发生变化。</p><p>　　“中国式”市场沟通</p><p>　　央行的目标多重并非中国的特例，全球金融危机之后，全球的大多数央行都被赋予了更多的使命，如美联储除就业和价格稳定外还要负责监管系统重要性金融机构，欧央行在欧洲银行业联盟建设过程中成为了单一银行业监管机构，英格兰银行也增加了审慎监管职能。等等。由于复杂度成倍上升，和市场和公众的沟通变得前所未有的重要。然而，多重目标和全球联动也给沟通带来了巨大的的困难。</p><p>　　周小川表示，货币政策决策实际运用的模型是多变量、动态的，各变量及其滞后的变量间有复杂的交互关系。但多数人的思维方式和教科书描述传统通常是单变量的、语言型逻辑。因此央行在沟通中一直面临着两难：如果沟通过于简单，虽能保证公众理解，却无法反映事物本身的复杂性；如果沟通过于技术、复杂，则只有少数经济学家和市场人士能理解。这种两难是每个央行在沟通过程中都面临的。</p><p>　　此外，中国在经历了去年8.11汇改以来的市场波动后，全球都对中国央行的沟通提出了新的期待和要求。</p><p>　　对此，周小川给出了“中国式”沟通解决方案：中国央行的做法是强调对专家层的沟通，以维护信息传递尽可能准确，并通过专家向广大公众做分析、解释工作；同时，央行也会向公众提供简化版的沟通。</p><p><br/></p>', 0, 1, '', '', '', '', '周小川谈央行多目标货币政策框架：收益大于成本。\r\n周小川：中国式市场沟通是强调对专家层的沟通，以维护信息传递尽可能准确，并通过专家向广大公众做分析、解释工作；同时，央行也会向公众提供简化版的沟通', '2016-05-19 15:34:38', '2016-08-01 11:05:09', '0000-00-00 00:00:00', 8, '', '', 1, NULL, 0),
	(27, 2, '曹麦穗', '全球央行紧急应对英国脱欧 美联储加息预期淡出', 7, 0, 0, '/upload/newscover/2016-06-25/576e2d0af2de6.jpg', '<p>　　英国脱欧引发的全球市场海啸使得各国央行紧急行动。脱欧结果确认后的几小时内，英国央行、欧洲央行、美国央行、日本央行均表态，称将密切关注市场并提供稳定所需要的支持，而世界银行、IMF等多边机构也在第一时间进行了类似表态。</p><p>　　更多央行已经在市场上投入了真金白银。瑞士央行称，已进行市场干预，以稳定瑞郎汇率。印度和韩国央行疑似抛售美元以稳定汇率，日本央行称将尽一切可能提供流动性。</p><p>　　“英国脱欧是金融危机后全球市场最大的短期风险事件，各国央行的表态将有利于短期内市场稳定，更重要的还是看后续央行态度。”一位华尔街宏观对冲基金经理向21世纪经济报道表示。</p><p>　　“由于英国脱欧目前来看将在未来的三到六个月成为长期并持续的风险事件，我们判断全球央行都将保持宽松，预计美国将推后加息，而欧洲央行和英国央行很有可能推出新的QE。”华尔街某大型保险公司首席经济学家向21世纪经济报道表示。</p><p>　　美联储推迟加息已定 甚至可能降息</p><p>　　从长期来看，脱欧的最直接影响是美联储利率调整进程。市场普遍认为，目前的结果将推后联储加息，美联储还有可能进行降息。</p><p>　　有着“美联储通讯社”之称的华尔街日报记者Hilsenrath在最新的文章中提到，英国脱欧意味着美国或推迟加息，7月加息目前看起来不太可能。美联储最大的担忧是美元走强。预计美联储将观望英国脱欧对美国经济的影响。</p><p>　　在脱欧结果变得明朗之后，金融市场很快就做出了强烈反应。美国股指期货大跌，投资者纷纷买入美债避险，10年期公债收益率跌破1.5%，接近四年低点。美元一度上涨逾3%，创下1978年以来最大单日涨幅。</p><p>　　美元在日内对大多数货币都出现了2%以上的升值，这对于美联储而言是一个重要的变数。美联储最大的担忧是美元走强，这将令美国出口受到影响并给进口物价带来下行压力。此外，美元走强引发的紧缩效应会导致股市下跌和全球资本流向避险资产。</p><p>　　更重要的是，美元升值会令人民币出现贬值压力。而从过去来看，人民币贬值会引发市场波动率走高，并导致美联储放缓加息。业界分析，如果英国脱欧的负面因素逐渐显现并持续下去的话，美联储的经济增长和通胀预期都会下调，甚至不排除美联储降息可能性。</p><p>　　在英国公投离开欧盟后，周五美国短期利率期货合约价格走高。交易员预计，美联储可能降息帮助全球经济免遭脱欧的负面影响。</p><p>　　同时，利率期货市场涨势如此迅猛，已经完全排除了美联储在今明两年上调指标隔夜拆借利率的可能性。实际上，市场目前押注12月时联邦基金目标利率可能低于当前约0.38%的平均水准。</p><p>　　而CME利率期货显示，年内美联储加息概率仅有16.3%，而7月降息的概率现在只有7.2%。</p><p>　　“从利率情况我们看到，年内联储加息可能性已经几乎没有，同时应该考虑降息的可能。”RBS Securities利率策略师John Briggs表示。</p><p>欧洲各央行料将“放水”</p><p>　<strong>　英国脱欧的影响更将对英国央行和欧洲央行的策略产生直接影响。</strong></p><p>　　摩根大通预计欧洲央行将下调存款利率10个基点，并延长QE时间至2018年。“债券天王”格罗斯接受采访时表示，“感觉”欧洲央行将采取一切可能的措施。</p><p>　　英国央行行长卡尼称，英国央行已经为脱欧做好了准备，将毫不犹豫采取额外措施。已经做好准备提供2500亿英镑的额外资金；将确保市场有序运作。</p><p>　　此外，日本央行表示，已准备好与美联储、欧洲央行、英国央行、瑞士央行、加拿大央行5家央行动用互换安排，6家央行将尽一切可能提供流动性。</p><p>　　纽约时间早盘，俗称恐慌指数 CBOE波动性指数（VIX）盘初涨22.43%，报21.12。道指跌幅收窄至384.29点或2.13%，暂报17626.78点；标普500指数跌44.15点或2.09%，暂报2070.18点，纳指跌120.44点或2.44%，暂报4790.09点。</p><p><br/></p>', 0, 1, '', '', '', '', '英国脱欧引发的全球市场海啸使得各国央行紧急行动。在过去的48小时都发生了什么？', '2016-05-11 09:57:02', '2016-08-01 11:05:07', '0000-00-00 00:00:00', 8, '', '', 1, NULL, 0),
	(28, 2, '曹麦穗', '母婴健康交流', 55, 0, 11, '/upload/newscover/2016-05-19/573d6d1294b53.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', 0, 1, '', '', '', '', 'fr21f21f', '2016-05-19 15:37:00', '2016-08-01 11:05:05', '0000-00-00 00:00:00', 8, '', '', 1, NULL, 0),
	(29, 2, '曹麦穗', '退欧一声炮响 英国巨富轰然“出血”55亿美元', 524, 8, 24, '/upload/newscover/2016-07-08/577f03d55eca1.png', '<p>退欧派胜出的英国公投结果公布后，英镑暴跌11%，直逼1.32，创英国自1970年初实行浮动汇率以来的最大日内跌幅。不仅英国股市收跌近3%，欧洲股市整体也遭遇了史上最黑“黑色星期五”：在开盘暴跌后跌势有所缓和，但仍以6%以上的跌幅创2008年以来单日跌幅新高。</p><p><br/></p><p>上述报道还提到了巨富中的一位铁杆退欧派——英国金融业最大零售经纪商Hargreaves Lansdown的联合创始人Peter Hargreaves。周五盘中，他的资产市值锐减19%至29亿美元。Hargreaves个人为退欧拉票活动捐助了320万英镑（合440万美元），是为退欧捐款最多的英国富豪。他接受采访时称，支持留欧的政治家应该和市场大跌无关，因为英国就是要竭力从欧盟解脱出来。华尔街见闻此前文章提到，Starfort Investment Holdings的董事长Ken Courtis评论周五欧股大跌称，此前投资者都在押注留欧派胜出，如今这种结果导致人们蜂拥寻找掩护，“人们在向相反的方向调整，在同一时刻蜂拥试图从极小的门洞出逃。”</p>', 0, 1, '', '', '', '', '退欧派胜出的英国公投结果公布后，英镑暴跌11%，直逼1.32', '2016-06-25 19:47:34', '2016-08-01 11:05:04', '0000-00-00 00:00:00', 13, '', '', 1, '/upload/newsthumb/2016-07-08/577f03b5c35ed.png', 0),
	(30, 2, '曹麦穗', '  罢免王石要落空？ 万科使出“王炸”', 301, 4, 0, '/upload/newscover/2016-07-08/577f030a446b3.png', '<p>香港万得通讯社综合报道，万科股权之争，再掀波澜，万科管理层使出多个大招！</p><p>7月1日，<a href="http://114.80.154.46/ns/findsnap.php?id=377240952&show=wft_no_title&fontsize=normal&skin=black&show=wft#" target="_blank">万科A</a>在深交所发布8个公告，包括提示下周一复牌、修改董事会议事规则、修订重组议案、发布业绩......</p><p>董事会拒绝罢免</p><p>万科在深交所发布的《董事会议事规则》(修订稿)，其中第五条规定，董事在任期届满前，股东大会不得无故解除其职务；另据附则显示，该规则由董事会制订报股东大会批准后生效，修改时亦同。</p><p style="text-align: center;"><img id="newsimg_00000000" src="http://114.80.154.46/ImageOcean/%7B59cb1be2-cc51-4fc3-af5a-26c7311ebe9c%7D" style="vertical-align: top; border: 0px;"/></p><p>而6月26日，宝能旗下两家公司——钜盛华和前海人寿联合向万科董事会提出召开临时股东大会，审议<a href="http://money.163.com/keywords/7/6/7f62514d/1.html" title="罢免" target="_blank">罢免</a>全体董事的议案。</p><p>被宝能提请罢免的，包括<a href="http://money.163.com/keywords/7/8/738b77f3/1.html" title="王石" target="_blank">王石</a>、乔世波、郁亮、孙健一、陈鹰、魏民、王文金在内的七名董事，张利平、华生、罗君美三位独立董事，以及解冻、廖绮云两位监事。</p><p>现在看来，按照 《董事会议事规则》(修订稿)，宝能提请的罢免不是那么容易的事。</p><p>独董回避表决合情合理合法</p><p>万科还逐条回复深交所七问，其中备受关注的是独董张利平回避表决一问。万科借助了律师事务所的专业法律回答，并详细披露了万科与张利平所供职单位的相关交易等，最终得出结论：张利平回避表决合情合理合法。</p><p><img id="newsimg_00000001" src="http://114.80.154.46/ImageOcean/%7Bcb8ad4b3-5585-4dce-a162-d559c69181a6%7D" style="vertical-align: top; border: 0px;"/></p><p>修订重组案示好华润</p><p>万科也知道谁是可以争取的朋友，最新发布的重组预案进行了六大修订，很有针对华润质疑的意味，或者说更像是要给华润一个交代。</p><p>修订一：交易标的资产的预估值及交易价格，包括标的资产的定价依据，补充披露了标的资产预估值已考虑地铁集团向前海国际增资注入的土地作价与本次交易作价差异对公司的影响。</p><p>修订二：在预案“对价股份的定价依据”内容板块中，补充和修订披露了此次交易对价股份发行价格定价依据的说明。</p><p>修订三：删除了“标的公司无法取得房地产业务资质的风险”和“标的公司无法取得房地产业务资质的风险”，在“标的公司经营范围”中补充披露了标的公司已取得房地产业务资质的说明。</p><p>修订四：补充披露了此次交易可能会导致<a href="http://money.163.com/baike/hshares/" title="财经知识_H股" target="_blank">H股</a>公众持股比例低于经香港联合交易所有限公司批准豁免的最低要求的风险提示。</p><p>修订五：新增标的公司“盈利模式及持续盈利能力”，补充披露了标的公司的具体盈利模式及存量项目开发建设完成而实现对外出售后的持续盈利能力。</p><p>修订六：新增“标的公司主要资产的税费缴纳情况”，补充披露了标的公司主要资产的税费缴纳情况。</p><p>管理层抛出“王炸”</p><p>万科管理层此次还抛出了“王炸”！原本在7月4、5号才会发布的6月业绩，这个7月的第一天就被“急着”推了出来。</p><p>2016年6月份，万科实现销售面积326.4 万平方米，销售金额424.0亿元。2016年1~6月份公司累计实现销售面积1409.0万平方米，销售金额1900.8亿元。</p><p>靓丽的业绩报向华润及大小股东证明了万科管理层的能力。更难得的大概是，在这个华润否决重组提案、宝能要求罢免全部董事的6月，万科仍实现了424亿的销售业绩。</p><p>在面临管理层董事会成员被罢免、管理层随之可能遭受清洗和肢解的境地之下，2016年5月以来，万科的管理层仍然拿下了15个住宅项目用地和2个物流项目用地，这确保万科业绩的延续性；换句话说，无论未来是谁的万科，这些延续的业绩，都将持续为万科的公众投资者贡献收入和利润。</p><p>王石的战时内阁，在郁亮的带领下，尽管面临着未来控制权的不确定性，仍然没有实施“焦土策略”，这正是万科优秀阳光文化的核心所在。如是一切业绩，恐怕就连华润，也不会否认。</p><p>万科业绩的核心，即在于管理层30多年来营建的优秀企业文化和良治的公司治理结构，而形成这一切的，则是万科管理层完整的团队。这是比任何票数都更重要的、无可替代的筹码。</p><p>华润自然看得懂这样的局面。华润十分清楚，自己不能接受一个麻烦棘手的万科；一个仍然优秀的万科，是傅育宁下一步棋的更大筹码。</p><p>宝能罢免王石要落空？</p><p>1、华润突然表态，我们和宝能系不是一个阵营的，并对此前宝能罢免万科全部董事监事的提案有异议。一家巨型央企和一家民企构成一致行动人关系可能性似乎不大。这个表态意味深长，华润不同意罢免全体董事监事，不代表不会罢免王石。</p><p>2、宝能也发公告撇清关系，自己与华润之间不存在协议、其他安排等形式共同扩大所能够支配万科股份表决权数量的行为或者事实。言外之意就是，宝能和华润不是一伙的，各自为战。同时，宝能系更是表态，欢迎并真诚希望管理层中的优秀者继续留任万科，意味着还是有人会出局。</p><p>3、力挺王石的还有一个隐秘力量，是资本市场不可或缺的重要力量，他们就是评级公司。如果现在否决万科现有董事，清除万科管理团队，有可能直接降低万科的信用等级，这可不是好消息，最直接的后果是万科融资成本增加，甚至对万科品牌产生负面影响。宝能也许是想让王石出局，而不是要整垮万科，姚员外还请三思。</p><p>4、宝能系增持万科的资金来自哪里？或将引发一场金融风暴</p><p>除了前<a href="http://quotes.money.163.com/usstock/hq/SNP.html">中石化</a>董事长傅成玉站出来发声，连素有中国最懂金融的市长之称的黄奇帆也出来给王石支招了，查一查宝能系的资金来源是否规范，用300亿撬动万科不是小数目，而且一年10%的利息成本那就是30亿，这些钱是从哪里来的？</p><p>宝能系的部分资金主要是来自万能险，前海作为新兴保险公司，为了吸引资金，给了客户较高的收益。这表明宝能可能会面临比较大的资金压力。</p><p>有人不禁质疑，宝能会不会以万能险资金购买万科股票？万能险是保险的一个品种，具有保险和投资的两项功能，但是本质上是保险公司的负债，正如银行的负债一样，银行吸收公众存款，但是银行不能拿这些公众的存款去收购股权一样，只能去放贷，收取利差，银行要并购只能用自己的资本金，也就是长期资金。</p><p>万能险资金和银行存款一样，是保险机构的短期资金来源，是金融机构向公众吸收的存款，银行资金只能去放贷，保险资金只能去投资获得收益，但是这种短期投资是不能用于长期并购的，否则就是吸收公众存款做长期业务，这是违规的。</p><p>这是宝能埋下的一颗大大的定时炸弹，背后蕴藏的是无法预估的巨大金融风险。</p><p>复牌砸死宝能？</p><p>在过去的半年，没有停牌的万科港股已经跌去原有市值的1/3，在重组提案仍未获得共识的情况下，复牌之后万科的补跌没有悬念。就连万科董秘朱旭也表示，万科A复牌以后的确是有补跌的压力，这是不争的事实。</p><p>Wind资讯推算显示，若万科A复牌，公募基金的基金净值能够承受26%的跌幅，大约在2-3个跌停板之间。</p><p>万科股价深跌，最先承受不住的，便是拥有大量杠杆资金的宝能。而且，从近几日的状况来看，姚老板似乎并没有获得更多筹码。</p><p>自媒体“攸克地产”认为：</p><p>这样状况的宝能系，显然是华润愿意看到的，道理很简单，宝能不比华润，深跌的时候，华润有更多的牌可以和姚先生打，关于他手中持有的那些万科股权（论炮灰的重要性）……</p><p>如果万科暴跌，宝能加了杠杆的资金会爆仓吗？</p><p>根据数据显示，宝能买万科的成本，大概是15元左右。但问题是这里边有杠杆，3个跌停就能爆仓。要是能一路砸下去，极可能会套死宝能，造成不可收拾的局面。</p><p><br/></p>', 0, 1, '', '', '', '', '万科股权之争，再掀波澜，万科管理层使出多个大招！', '2016-07-03 21:07:14', '2016-08-03 16:43:44', '0000-00-00 00:00:00', 7, '', '', 1, '/upload/newsthumb/2016-07-08/577f0312921f7.png', 0),
	(31, 2, '曹麦穗', '柠檬智慧创客空间开业', 426, 2, 5, '/upload/newscover/2016-07-07/577e286496cfa.png', '<p>事实上，在地产商这个主体介入之前，国内的众创空间已经如雨后春笋般接连不断，各种“孵化器”层出不穷，诸如产业咖啡馆、孵化器、科技园区、创新工场等等，都是众创空间的代名词。</p><p>以目前最为热门的海外借鉴对象WeWork而言，其模式主要与<a title="商业地产" href="http://www.officese.com/" target="_blank">商业地产</a>基金和开发商合作，选择城市重建规划中新建的地标建筑，以低于市场价10%左右的折扣租用1-2层楼面，分割为可定制并且社交功能齐全的工作空间，以远高于同业的价格租给各种创业公司。</p><p>近年来，开发商主导的众创空间在显著增加。比如SOHO 3Q、瑞安创智天地、万科云城、华夏幸福产业园等。他们一般都会选择与风投、天使基金等合作，扮演融资与孵化的角色。</p>', 0, 1, '', '', '', '', '柠檬智慧创客空间入驻深圳龙华，敬请关注！', '2016-07-05 15:10:21', '2016-08-04 10:35:21', '0000-00-00 00:00:00', 2, '', '', 1, '/upload/newsthumb/2016-07-07/577e2811e78bd.png', 0),
	(32, 2, '曹麦穗', '你是一个网巴丹啊哈哈老客户看见了记录灸疗12加快了大家撒老公进来12312尽快了解了解尽快了解了解你', 190, 2, 4, '/upload/newscover/2016-07-08/577f173d2b81a.jpg', '<p><span style="color: rgb(64, 64, 64); font-family: &#39;Microsoft Yahei&#39;; font-size: 18px; text-align: justify; text-indent: 2em;">&nbsp;&nbsp;&nbsp;&nbsp;中国证监会上市公司并购重组审核委员会（以下简称“并购重组委”）于2016年6月7 日举行的 2016 年第 41 次并购重组委会议，依法对公司的发行股份购买资产并配套募集资金方案、进行了审核。</span></p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; line-height: 32px; font-family: &#39;Microsoft Yahei&#39;; color: rgb(64, 64, 64); text-align: justify; white-space: normal;">并购重组委在审核中关注到，公司申请材料显示，本次交易标的公司盈利能力具有较大不确定性。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; line-height: 32px; font-family: &#39;Microsoft Yahei&#39;; color: rgb(64, 64, 64); text-align: justify; white-space: normal;">并购重组委认为，不符合《上市公司重大资产重组管理办法》第四十三条的相关规定。并购重组委会议以投票方式对公司方案进行了表决，同意票数未达到3 票，方案未获通过。根据《公司法》、《证券法》、《上市公司重大资产重组管理办法》等有关规定，依法对公司本次发行股份购买资产并募集配套资金申请作出不予核准的决定。</p><p style="margin-top: 32px; margin-bottom: 0px; padding: 0px; font-size: 18px; text-indent: 2em; line-height: 32px; font-family: &#39;Microsoft Yahei&#39;; color: rgb(64, 64, 64); text-align: justify; white-space: normal;">对此，暴风集团表示，将结合公司的“DT大娱乐”战略布局及相关业务的实际情况，继续认真审慎研究本次重组方案。并将在 10 日内对是否修改或终止本次方案作出决议，并按照有关规定及时履行信息披露义务。</p>', 0, 1, '', '', '', '', '7月7日消息，暴风集团今日晚间发布公告称，收到证监会出具的《关于不予核准暴风集团股份有限公司发行股份购买资产并募集配套资金申请的决定》', '2016-07-08 11:01:20', '2016-08-03 18:19:30', '0000-00-00 00:00:00', 13, 'ddd', '3', 0, '/upload/newsthumb/2016-07-08/577f1736f2f9a.jpg', 1),
	(33, 2, '曹麦穗', '母婴健康交流', 0, 0, 0, '/upload/newscover/2016-07-21/57909235aadd0.jpg', '<p>444<br/></p>', 0, 1, '', '', '', '', '33', '2016-07-21 17:13:37', '2016-08-01 11:06:17', '0000-00-00 00:00:00', 0, '333333', '333', 1, '/upload/newsthumb/2016-07-21/579092327bc7e.jpg', 1),
	(34, 2, '曹麦穗', '1313', 0, 0, 0, '/upload/newscover/2016-08-10/57aafd235566e.jpg', '<p>311<br/></p>', 0, 1, '', '', '', '', '1231', '2016-08-10 18:08:46', '2016-08-10 18:08:46', '0000-00-00 00:00:00', 2, '1313131', '3231', 0, '/upload/newsthumb/2016-08-10/57aafd1cd675b.jpg', 0),
	(35, 2, '曹麦穗', '22222', 0, 0, 0, '', NULL, 0, 1, '', '', '', '', '', '2016-08-10 18:14:36', '2016-08-10 18:14:36', '0000-00-00 00:00:00', 7, '曹麦穗', '313131', 0, '', 0),
	(36, 2, '曹麦穗', '123412', 0, 0, 0, '', NULL, 0, 1, '', '', '', '', '', '2016-08-10 18:14:58', '2016-08-10 18:14:58', '0000-00-00 00:00:00', 9, '12412', '214', 0, '', 0),
	(37, 2, '曹麦穗', '母婴健康交流', 0, 0, 0, '', NULL, 0, 1, '', '', '', '', '', '2016-08-10 18:15:46', '2016-08-10 18:15:46', '0000-00-00 00:00:00', 7, '21412', '12312', 0, '', 0),
	(38, 2, '曹麦穗', '母婴健康交流', 0, 0, 0, '', NULL, 0, 1, '', '', '', '', '', '2016-08-10 18:17:22', '2016-08-10 18:17:22', '0000-00-00 00:00:00', 8, '12312', '214', 0, '', 0),
	(39, 2, '曹麦穗', '123', 0, 0, 0, '', '<p>321312<br/></p>', 0, 1, '', '', '', '', '12312', '2016-08-10 18:17:48', '2016-08-10 18:17:48', '0000-00-00 00:00:00', 7, '12312', '313131', 0, '', 0),
	(40, 2, '曹麦穗', '12312', 0, 0, 0, '', NULL, 0, 1, '', '', '', '', '', '2016-08-10 18:18:26', '2016-08-10 18:18:26', '0000-00-00 00:00:00', 7, '21412', '21412', 0, '', 0),
	(47, 2, '曹麦穗', 'hello world4455', 152, 0, 0, '', '<p>3<br/></p>', 1, 1, '/upload/news/video/2016-08-15/57b170258743b.m4v', '/upload/news/videocover/2016-08-16/57b30313e31a5.jpg', '', '', '3', '2016-08-11 14:57:32', '2016-08-22 11:09:57', '2016-08-16 00:00:00', 8, '', '313131', 1, '', 0),
	(48, 2, '曹麦穗', '111', 6, 0, 0, '', '<p><video class="edui-upload-video  vjs-default-skin video-js" controls="" preload="none" width="420" height="280" src="/ueditor/php/upload/video/20160811/1470908946280352.wmv" data-setup="{}"><source src="/ueditor/php/upload/video/20160811/1470908946280352.wmv" type="video/wmv"/></video></p>', 0, 1, '', '', '', '', '3', '2016-08-11 17:49:32', '2016-08-17 10:02:20', '0000-00-00 00:00:00', 2, '', '214', 1, '', 0),
	(49, 2, '曹麦穗', 'lightbox2 with image rotate', 49, 0, 0, '/upload/newscover/2016-08-16/57b2b60d99503.jpg', '<p>atesatg1`2312fds</p>', 2, 1, '', '', '/upload/news/mp3/2016-08-16/57b2cd75f02bd.mp3', '新季度财报分析', 'this is just a test news ', '2016-08-16 14:43:49', '2016-08-22 11:09:47', '2016-08-16 00:00:00', 10, '', 'git', 1, '/upload/newsthumb/2016-08-16/57b2b607dff9d.jpg', 0);
/*!40000 ALTER TABLE `news` ENABLE KEYS */;


-- 导出  表 binggq.newscom 结构
CREATE TABLE IF NOT EXISTS `newscom` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '新闻评论表',
  `news_id` int(11) NOT NULL COMMENT '新闻id',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父id',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `reply_user` int(11) NOT NULL DEFAULT '0' COMMENT '回复人id',
  `body` varchar(500) NOT NULL COMMENT '评论内容',
  `praise_nums` int(11) NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL COMMENT '评论时间',
  `update_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8 COMMENT='新闻评论表';

-- 正在导出表  binggq.newscom 的数据：~69 rows (大约)
DELETE FROM `newscom`;
/*!40000 ALTER TABLE `newscom` DISABLE KEYS */;
INSERT INTO `newscom` (`id`, `news_id`, `pid`, `user_id`, `reply_user`, `body`, `praise_nums`, `create_time`, `update_time`, `is_delete`) VALUES
	(1, 4, 0, 2, 0, 'test', 0, '2016-05-05 11:11:11', '0000-00-00 00:00:00', 0),
	(2, 4, 0, 2, 0, '不错啊，哈哈', 2, '2016-05-06 11:11:11', '0000-00-00 00:00:00', 0),
	(3, 11, 0, 8, 0, '不错，值得学习', 0, '2016-05-19 19:26:50', '2016-05-19 19:26:50', 0),
	(4, 11, 0, 8, 0, '我又来评论啦！', 0, '2016-05-19 19:39:03', '2016-05-19 19:39:03', 0),
	(5, 16, 0, 8, 0, '卧槽，不错！', 9, '2016-05-19 20:14:22', '2016-06-07 20:41:26', 0),
	(9, 17, 0, 8, 0, '不错！', 8, '2016-05-20 14:50:37', '2016-06-07 21:18:21', 0),
	(14, 16, 0, 8, 0, '放假房间', 1, '2016-05-20 15:22:16', '2016-05-23 10:30:25', 0),
	(15, 28, 0, 8, 0, '呵呵', 1, '2016-05-20 15:25:24', '2016-05-20 15:25:29', 0),
	(16, 28, 0, 8, 0, '呵呵\n', 1, '2016-05-20 15:31:58', '2016-05-20 15:32:54', 0),
	(17, 28, 0, 8, 0, '不错，很好', 1, '2016-05-20 16:00:30', '2016-05-20 16:54:17', 0),
	(18, 28, 0, 8, 0, '受到了1万点伤害', 1, '2016-05-20 16:58:28', '2016-05-20 16:58:43', 0),
	(19, 28, 0, 8, 0, '正取果上果', 1, '2016-05-20 16:59:51', '2016-05-20 16:59:55', 0),
	(20, 18, 0, 8, 0, '43523531252', 2, '2016-05-23 11:17:40', '2016-06-13 16:37:04', 0),
	(21, 18, 0, 8, 0, '不错，值得膜拜', 2, '2016-05-23 11:21:58', '2016-06-13 16:37:08', 0),
	(22, 18, 0, 8, 0, '卧槽，我要打鸡血了。', 1, '2016-05-23 11:22:29', '2016-05-23 11:22:34', 0),
	(23, 18, 0, 8, 0, '打鸡血', 1, '2016-05-23 15:55:43', '2016-05-23 15:55:48', 0),
	(25, 18, 22, 8, 8, '嘻嘻，打吧，打吧', 1, '2016-05-23 17:48:37', '2016-06-13 16:37:15', 0),
	(26, 18, 0, 7, 0, '嘻嘻，打吧，打吧', 1, '2016-05-23 17:48:37', '2016-06-13 16:36:59', 0),
	(27, 18, 26, 8, 7, '呵呵，不想跟你说话。', 0, '2016-05-23 18:24:18', '2016-05-23 18:24:18', 0),
	(28, 18, 26, 8, 7, '对啊，不想跟你说话', 0, '2016-05-23 18:25:24', '2016-05-23 18:25:24', 0),
	(29, 18, 26, 8, 7, '妹子，你的头像很漂亮哦', 1, '2016-05-23 18:28:24', '2016-06-25 11:13:10', 0),
	(30, 18, 26, 8, 7, '哇塞，美女！', 0, '2016-05-23 18:30:41', '2016-05-23 18:30:41', 0),
	(31, 18, 26, 8, 7, '妹子加我Q：233333333', 0, '2016-05-23 18:35:00', '2016-05-23 18:35:00', 0),
	(32, 18, 26, 8, 7, '妹子加我Q：233333333', 0, '2016-05-23 18:35:18', '2016-05-23 18:35:18', 0),
	(33, 18, 26, 8, 7, '妹子加我Q：233333333', 0, '2016-05-23 18:35:52', '2016-05-23 18:35:52', 0),
	(34, 0, 0, 0, 0, '', 0, '2016-06-14 19:46:34', '2016-06-14 19:46:34', 0),
	(35, 0, 0, 0, 0, '', 0, '2016-06-14 19:46:45', '2016-06-14 19:46:45', 0),
	(36, 16, 0, 8, 0, '什么', 0, '2016-06-21 09:50:20', '2016-06-21 09:50:20', 0),
	(37, 17, 0, 8, 0, '傻逼', 0, '2016-06-21 11:45:38', '2016-06-21 11:45:38', 0),
	(38, 17, 0, 8, 0, '呵呵', 0, '2016-06-21 11:49:20', '2016-06-21 11:49:20', 0),
	(39, 16, 0, 11, 0, '怎么不换行？', 1, '2016-06-24 18:19:47', '2016-06-28 10:51:27', 0),
	(40, 15, 0, 10, 0, '很棒的', 1, '2016-06-24 19:52:38', '2016-06-25 11:13:14', 0),
	(41, 15, 0, 7, 0, '好', 0, '2016-06-25 11:13:22', '2016-06-25 11:13:22', 0),
	(42, 18, 30, 11, 8, '安静', 0, '2016-06-25 11:21:09', '2016-06-25 11:21:09', 0),
	(43, 18, 22, 11, 8, '安静', 0, '2016-06-25 11:21:15', '2016-06-25 11:21:15', 0),
	(44, 18, 0, 10, 0, 'okok', 0, '2016-06-25 12:06:09', '2016-06-25 12:06:09', 0),
	(45, 18, 43, 10, 11, 'ooook', 0, '2016-06-25 14:24:45', '2016-06-25 14:24:45', 0),
	(46, 29, 0, 10, 0, '专家很棒', 1, '2016-06-25 20:29:28', '2016-06-30 20:09:06', 0),
	(47, 29, 0, 10, 0, 'ok', 2, '2016-06-25 20:30:08', '2016-07-06 10:22:42', 0),
	(48, 29, 47, 8, 10, '我回复我', 0, '2016-06-25 20:32:41', '2016-06-25 20:32:41', 0),
	(49, 29, 0, 10, 0, 'oookkk', 3, '2016-06-25 20:34:01', '2016-07-06 10:22:41', 0),
	(50, 29, 47, 8, 10, '我回复我', 0, '2016-06-25 20:34:53', '2016-06-25 20:34:53', 0),
	(51, 29, 47, 8, 10, '我回复我', 0, '2016-06-25 20:35:02', '2016-06-25 20:35:02', 0),
	(52, 29, 47, 8, 10, '我回复我', 0, '2016-06-25 20:35:02', '2016-06-25 20:35:02', 0),
	(53, 29, 47, 8, 10, '我回复我', 0, '2016-06-25 20:35:03', '2016-06-25 20:35:03', 0),
	(54, 29, 47, 8, 10, '测试', 0, '2016-06-25 20:35:28', '2016-06-25 20:35:28', 0),
	(55, 29, 0, 8, 0, '测试ok', 0, '2016-06-25 20:35:52', '2016-06-25 20:35:52', 0),
	(56, 29, 0, 8, 0, '测试ok', 0, '2016-06-25 20:35:53', '2016-06-25 20:35:53', 0),
	(57, 17, 0, 10, 0, 'iii o o o', 0, '2016-06-25 20:37:11', '2016-06-25 20:37:11', 0),
	(58, 29, 0, 8, 0, 'bug，bug', 0, '2016-06-25 20:38:20', '2016-06-25 20:38:20', 0),
	(59, 29, 0, 8, 0, 'bug，bug', 0, '2016-06-25 20:39:28', '2016-06-25 20:39:28', 0),
	(61, 29, 0, 17, 0, '一个大西瓜', 3, '2016-06-29 17:46:07', '2016-07-06 10:22:38', 0),
	(62, 29, 46, 19, 10, '帅哥', 3, '2016-06-29 17:57:48', '2016-07-05 20:20:28', 0),
	(63, 29, 0, 10, 0, '可以回复', 4, '2016-06-29 19:57:08', '2016-07-11 12:56:20', 0),
	(64, 19, 0, 10, 0, 'GG哈哈哈哈', 3, '2016-06-30 11:31:54', '2016-07-04 09:29:42', 0),
	(65, 19, 64, 19, 10, '我去', 4, '2016-06-30 13:23:15', '2016-07-05 20:21:02', 0),
	(68, 31, 0, 7, 0, '赞一个', 1, '2016-07-05 22:14:16', '2016-07-05 22:14:21', 0),
	(69, 31, 0, 10, 0, '赞一个', 2, '2016-07-06 11:52:29', '2016-07-08 12:08:02', 0),
	(70, 31, 0, 7, 0, '我自己', 1, '2016-07-06 11:59:59', '2016-07-08 12:07:45', 0),
	(72, 29, 0, 10, 0, '我的人家说明', 1, '2016-07-06 12:03:46', '2016-07-11 12:56:06', 0),
	(74, 29, 61, 10, 17, '消暑', 0, '2016-07-06 22:30:30', '2016-07-06 22:30:30', 0),
	(75, 29, 74, 2, 10, '回复有很多内容回复有很多内容回复有很多内容回复有很多内容回复有很多内容回复有很多内容回复有很多内容回复有很多内容回复有很多内容回复有很多内容回复有很多内容回复有很多内容回复有很多内容回复有很多内容回复有很多内容回复有很多内容回复有很多内容回复有很多内容回复有很多内容回复有很多内容回复有很多内容', 1, '2016-07-07 19:49:27', '2016-07-11 11:17:30', 0),
	(76, 32, 0, 7, 0, '暴风挺住', 1, '2016-07-08 11:02:22', '2016-07-08 12:05:35', 0),
	(77, 31, 69, 7, 10, '呵呵', 1, '2016-07-08 11:02:46', '2016-07-08 12:07:44', 0),
	(78, 31, 0, 10, 0, '路过', 1, '2016-07-08 12:08:15', '2016-07-11 15:51:21', 0),
	(81, 29, 74, 25, 10, '哪些', 1, '2016-07-11 11:17:18', '2016-07-11 11:17:25', 0),
	(83, 29, 72, 26, 10, '看你', 0, '2016-07-11 15:34:47', '2016-07-11 15:34:47', 0),
	(84, 32, 0, 10, 0, '呵呵哒', 0, '2016-07-13 17:09:09', '2016-07-13 17:09:09', 0),
	(86, 29, 46, -1, 10, '呵呵', 0, '2016-07-29 16:10:10', '2016-07-29 16:10:10', 0);
/*!40000 ALTER TABLE `newscom` ENABLE KEYS */;


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


-- 导出  表 binggq.news_collect 结构
CREATE TABLE IF NOT EXISTS `news_collect` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户新闻收藏表',
  `user_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户资讯收藏';

-- 正在导出表  binggq.news_collect 的数据：~0 rows (大约)
DELETE FROM `news_collect`;
/*!40000 ALTER TABLE `news_collect` DISABLE KEYS */;
/*!40000 ALTER TABLE `news_collect` ENABLE KEYS */;


-- 导出  表 binggq.news_industry 结构
CREATE TABLE IF NOT EXISTS `news_industry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) NOT NULL DEFAULT '0',
  `industry_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COMMENT='新闻行业标签';

-- 正在导出表  binggq.news_industry 的数据：~36 rows (大约)
DELETE FROM `news_industry`;
/*!40000 ALTER TABLE `news_industry` DISABLE KEYS */;
INSERT INTO `news_industry` (`id`, `news_id`, `industry_id`) VALUES
	(7, 12, 5),
	(10, 13, 6),
	(12, 14, 7),
	(13, 14, 17),
	(14, 15, 6),
	(16, 15, 19),
	(19, 26, 13),
	(20, 26, 17),
	(21, 26, 19),
	(22, 25, 19),
	(23, 24, 19),
	(24, 23, 6),
	(25, 23, 16),
	(26, 23, 19),
	(27, 21, 19),
	(28, 20, 19),
	(29, 17, 9),
	(30, 16, 19),
	(31, 15, 5),
	(32, 19, 5),
	(33, 19, 6),
	(34, 13, 19),
	(35, 29, 7),
	(36, 29, 8),
	(37, 30, 5),
	(38, 30, 7),
	(39, 31, 4),
	(40, 31, 5),
	(41, 31, 18),
	(42, 32, 5),
	(43, 32, 7),
	(44, 33, 5),
	(45, 33, 6),
	(46, 34, 8),
	(47, 34, 9),
	(48, 39, 7),
	(55, 47, 5),
	(56, 48, 5),
	(57, 49, 8);
/*!40000 ALTER TABLE `news_industry` ENABLE KEYS */;


-- 导出  表 binggq.news_newstag 结构
CREATE TABLE IF NOT EXISTS `news_newstag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) NOT NULL DEFAULT '0',
  `tag_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='资讯对应标签表';

-- 正在导出表  binggq.news_newstag 的数据：~2 rows (大约)
DELETE FROM `news_newstag`;
/*!40000 ALTER TABLE `news_newstag` DISABLE KEYS */;
INSERT INTO `news_newstag` (`id`, `news_id`, `tag_id`) VALUES
	(1, 47, 2),
	(2, 47, 6),
	(3, 48, 2),
	(4, 49, 2);
/*!40000 ALTER TABLE `news_newstag` ENABLE KEYS */;


-- 导出  表 binggq.news_savant 结构
CREATE TABLE IF NOT EXISTS `news_savant` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '专家推荐资讯关系表',
  `news_id` int(11) NOT NULL COMMENT '资讯id',
  `savant_id` int(11) NOT NULL COMMENT '专家id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COMMENT='专家推荐活动关系表';

-- 正在导出表  binggq.news_savant 的数据：~34 rows (大约)
DELETE FROM `news_savant`;
/*!40000 ALTER TABLE `news_savant` DISABLE KEYS */;
INSERT INTO `news_savant` (`id`, `news_id`, `savant_id`) VALUES
	(1, 18, 3),
	(2, 27, 3),
	(3, 26, 3),
	(4, 25, 3),
	(5, 24, 3),
	(6, 23, 3),
	(7, 22, 3),
	(8, 21, 3),
	(9, 20, 3),
	(10, 19, 3),
	(11, 17, 3),
	(12, 16, 3),
	(13, 15, 3),
	(14, 14, 3),
	(15, 13, 3),
	(16, 12, 3),
	(17, 29, 3),
	(18, 30, 5),
	(19, 31, 5),
	(20, 31, 6),
	(21, 31, 7),
	(23, 32, 17),
	(24, 33, 17),
	(25, 34, 17),
	(26, 35, 10),
	(27, 36, 17),
	(28, 37, 17),
	(29, 39, 17),
	(30, 40, 10),
	(31, 47, 7),
	(32, 47, 10),
	(33, 47, 16),
	(34, 47, 23),
	(35, 48, 7),
	(36, 48, 10),
	(37, 48, 16),
	(38, 48, 23),
	(39, 49, 8),
	(40, 49, 10),
	(41, 49, 17),
	(42, 49, 23);
/*!40000 ALTER TABLE `news_savant` ENABLE KEYS */;


-- 导出  表 binggq.order 结构
CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '订单类型1约见活动',
  `relate_id` int(11) NOT NULL DEFAULT '0' COMMENT '关联id',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id(买家id)',
  `seller_id` int(11) NOT NULL DEFAULT '0' COMMENT '卖家id',
  `order_no` varchar(20) NOT NULL DEFAULT '' COMMENT '订单号',
  `out_trade_no` varchar(50) DEFAULT '' COMMENT '支付方的订单号',
  `paytype` tinyint(4) DEFAULT '0' COMMENT '实际支付方式：1微信2支付宝',
  `price` decimal(10,2) NOT NULL COMMENT '定价',
  `fee` decimal(10,2) NOT NULL COMMENT '实际支付',
  `remark` varchar(50) NOT NULL COMMENT '备注',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '订单状态0未完成1已完成',
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COMMENT='订单表';

-- 正在导出表  binggq.order 的数据：~27 rows (大约)
DELETE FROM `order`;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` (`id`, `type`, `relate_id`, `user_id`, `seller_id`, `order_no`, `out_trade_no`, `paytype`, `price`, `fee`, `remark`, `status`, `create_time`, `update_time`) VALUES
	(3, 1, 7, 7, 8, '14648363607781', NULL, 1, 150.00, 0.00, '预约话题测试话题', 0, '2016-06-02 10:59:20', '2016-06-02 10:59:20'),
	(6, 1, 6, 8, 7, '146483924186123', NULL, 1, 150.00, 0.00, '预约话题测试话题', 1, '2016-06-02 11:47:21', '2016-06-13 17:00:30'),
	(7, 1, 8, 8, 7, '14667444338874', '', 1, 200.00, 0.00, '预约话题互联网开发讲座', 1, '2016-06-24 13:00:33', '2016-06-24 13:23:32'),
	(8, 1, 9, 8, 7, '14667625488932', '', 1, 150.00, 0.00, '预约话题测试话题', 1, '2016-06-24 18:02:28', '2016-06-24 19:42:41'),
	(9, 1, 11, 10, 8, '1466823755101127', '', 1, 150.00, 0.00, '预约话题测试话题', 0, '2016-06-25 11:02:35', '2016-06-25 11:02:35'),
	(10, 1, 10, 8, 7, '146682445581026', '', 1, 150.00, 0.00, '预约话题测试话题', 1, '2016-06-25 11:14:15', '2016-06-25 11:50:51'),
	(11, 1, 12, 10, 7, '1466826737101267', '', 1, 150.00, 0.00, '预约话题测试话题', 1, '2016-06-25 11:52:17', '2016-06-25 12:15:23'),
	(12, 1, 12, 10, 7, '1466826738101238', '', 1, 150.00, 0.00, '预约话题测试话题', 0, '2016-06-25 11:52:18', '2016-06-25 11:52:18'),
	(13, 1, 12, 10, 7, '1466826746101293', '', 1, 150.00, 0.00, '预约话题测试话题', 0, '2016-06-25 11:52:26', '2016-06-25 11:52:26'),
	(14, 1, 14, 15, 8, '1466828642151400', '', 1, 150.00, 0.00, '预约话题测试话题', 1, '2016-06-25 12:24:02', '2016-06-25 12:24:38'),
	(15, 1, 15, 15, 7, '1466829242151546', '', 1, 150.00, 0.00, '预约话题测试话题', 1, '2016-06-25 12:34:03', '2016-06-25 12:34:32'),
	(16, 1, 13, 8, 7, '146682927181346', '', 1, 150.00, 0.00, '预约话题测试话题', 1, '2016-06-25 12:34:31', '2016-06-25 12:35:49'),
	(17, 1, 16, 10, 8, '1466837379101632', '', 1, 150.00, 0.00, '预约话题测试话题', 1, '2016-06-25 14:49:39', '2016-06-25 15:33:48'),
	(18, 1, 18, 9, 8, '146683805991834', '', 1, 200.00, 0.00, '预约话题互联网开发讲座', 0, '2016-06-25 15:00:59', '2016-06-25 15:00:59'),
	(19, 1, 19, 8, 7, '146683917981958', '', 1, 150.00, 0.00, '预约话题测试话题', 0, '2016-06-25 15:19:39', '2016-06-25 15:19:39'),
	(20, 1, 25, 17, 7, '1467710345172545', '', 1, 200.00, 0.00, '预约话题互联网开发讲座', 0, '2016-07-05 17:19:05', '2016-07-05 17:19:05'),
	(21, 1, 26, 19, 17, '1467713501192647', '', 1, 1.00, 0.00, '预约话题吃', 1, '2016-07-05 18:11:41', '2016-07-05 18:12:39'),
	(22, 1, 24, 11, 7, '1467727982112496', '', 1, 200.00, 0.00, '预约话题互联网开发讲座', 0, '2016-07-05 22:13:02', '2016-07-05 22:13:02'),
	(23, 1, 27, 7, 10, '146777904372774', '', 1, 300.00, 0.00, '预约话题中型网络开发', 1, '2016-07-06 12:24:03', '2016-07-06 12:28:29'),
	(24, 1, 27, 7, 10, '146777904472747', '', 1, 300.00, 0.00, '预约话题中型网络开发', 0, '2016-07-06 12:24:04', '2016-07-06 12:24:04'),
	(25, 1, 28, 15, 7, '1467779360152881', '', 1, 200.00, 0.00, '预约话题互联网开发讲座', 1, '2016-07-06 12:29:20', '2016-07-06 12:30:16'),
	(26, 1, 32, 21, 7, '331369923211m3j1', '2016071221001004930282888237', 2, 200.00, 0.01, '预约话题互联网开发讲座', 0, '2016-07-06 22:01:39', '2016-07-12 10:06:50'),
	(27, 1, 32, 21, 7, '146781369921329921', '', 1, 200.00, 0.00, '预约话题互联网开发讲座', 0, '2016-07-06 22:01:39', '2016-07-06 22:01:39'),
	(28, 1, 58, 15, 7, '1467893659155872', '2016071121001004310204453944', 1, 200.00, 0.00, '预约话题互联网开发讲座', 1, '2016-07-07 20:14:19', '2016-07-11 21:03:21'),
	(29, 1, 57, 15, 7, '1467893670155725', '2016071121001004310209736760', 1, 150.00, 0.00, '预约话题测试话题', 1, '2016-07-07 20:14:30', '2016-07-11 21:35:23'),
	(30, 1, 56, 15, 7, '1467893707155617', '4005622001201607118775622082', 1, 150.00, 1.00, '预约话题测试话题', 1, '2016-07-07 20:15:07', '2016-07-11 18:06:44'),
	(31, 1, 68, 15, 10, '1468311610156813', '2016071221001004310216474337', 2, 300.00, 0.01, '预约话题中型网络开发', 1, '2016-07-12 16:20:10', '2016-07-12 16:22:27'),
	(32, 2, 31, 8, 2, '147029278923859', '', 0, 100.00, 0.00, '活动报名hello world', 0, '2016-08-04 14:39:49', '2016-08-04 14:39:49'),
	(33, 2, 33, 8, 2, '147158739324329', '', 0, 100.00, 0.00, '活动报名传统企业的改革之路', 0, '2016-08-19 14:16:33', '2016-08-19 14:16:33');
/*!40000 ALTER TABLE `order` ENABLE KEYS */;


-- 导出  表 binggq.phonelog 结构
CREATE TABLE IF NOT EXISTS `phonelog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_token` varchar(150) DEFAULT '',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1读取2邀请',
  `phones` text NOT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户通讯录手机号';

-- 正在导出表  binggq.phonelog 的数据：~3 rows (大约)
DELETE FROM `phonelog`;
/*!40000 ALTER TABLE `phonelog` DISABLE KEYS */;
INSERT INTO `phonelog` (`id`, `user_token`, `type`, `phones`, `create_time`) VALUES
	(1, 'jkljljljea23jklajl3jl', 1, '123|15013797469|123|1233|15013797469', '2016-08-11 18:51:06'),
	(2, 'jkljljljea23jklajl3jl', 2, '123|15013797469|123|1233|15013797469', '2016-08-11 18:53:35'),
	(3, 'jkljljljea23jklajl3jl', 2, '123|15013797469|123|1233|15013797469', '2016-08-11 18:55:54');
/*!40000 ALTER TABLE `phonelog` ENABLE KEYS */;


-- 导出  表 binggq.profiletag 结构
CREATE TABLE IF NOT EXISTS `profiletag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0' COMMENT '个人标签',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='个人标签';

-- 正在导出表  binggq.profiletag 的数据：~5 rows (大约)
DELETE FROM `profiletag`;
/*!40000 ALTER TABLE `profiletag` DISABLE KEYS */;
INSERT INTO `profiletag` (`id`, `name`) VALUES
	(1, '研发'),
	(2, '产品'),
	(3, '设计'),
	(4, '运营'),
	(5, '市场');
/*!40000 ALTER TABLE `profiletag` ENABLE KEYS */;


-- 导出  表 binggq.projneed 结构
CREATE TABLE IF NOT EXISTS `projneed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '标题',
  `body` text NOT NULL COMMENT '内容',
  `needer` varchar(50) NOT NULL COMMENT '需求方',
  `contact` varchar(250) NOT NULL DEFAULT '' COMMENT '联系方式',
  `follower` varchar(50) NOT NULL DEFAULT '' COMMENT '跟进人',
  `stage_remark` varchar(150) NOT NULL DEFAULT '' COMMENT '进度描述',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='需求项目管理';

-- 正在导出表  binggq.projneed 的数据：~0 rows (大约)
DELETE FROM `projneed`;
/*!40000 ALTER TABLE `projneed` DISABLE KEYS */;
INSERT INTO `projneed` (`id`, `title`, `body`, `needer`, `contact`, `follower`, `stage_remark`, `create_time`, `update_time`) VALUES
	(2, '母婴健康交流', '2', '4', '', '2', '3', '2016-07-18 12:18:10', '2016-08-06 11:33:54');
/*!40000 ALTER TABLE `projneed` ENABLE KEYS */;


-- 导出  表 binggq.projneed_industry 结构
CREATE TABLE IF NOT EXISTS `projneed_industry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `projneed_id` int(11) NOT NULL DEFAULT '0',
  `industry_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='需求项目标签';

-- 正在导出表  binggq.projneed_industry 的数据：~2 rows (大约)
DELETE FROM `projneed_industry`;
/*!40000 ALTER TABLE `projneed_industry` DISABLE KEYS */;
INSERT INTO `projneed_industry` (`id`, `projneed_id`, `industry_id`) VALUES
	(1, 2, 9),
	(2, 2, 12),
	(3, 2, 6);
/*!40000 ALTER TABLE `projneed_industry` ENABLE KEYS */;


-- 导出  表 binggq.projrong 结构
CREATE TABLE IF NOT EXISTS `projrong` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '融资项目',
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '发布人id',
  `publisher` varchar(50) NOT NULL COMMENT '发布人',
  `contact` varchar(250) NOT NULL DEFAULT '' COMMENT '联系方式',
  `company` varchar(100) NOT NULL COMMENT '公司',
  `title` varchar(150) NOT NULL COMMENT '项目名称',
  `stage_id` varchar(50) NOT NULL COMMENT '融资阶段',
  `address` varchar(150) NOT NULL COMMENT '地点',
  `scale_id` varchar(50) NOT NULL COMMENT '融资规模',
  `stock` varchar(50) NOT NULL COMMENT '股份',
  `read_nums` int(11) DEFAULT '0' COMMENT '阅读数',
  `praise_nums` int(11) DEFAULT '0' COMMENT '点赞数',
  `comment_nums` int(11) DEFAULT '0' COMMENT '评论数',
  `cover` varchar(250) DEFAULT NULL COMMENT '封面',
  `body` text COMMENT '活动内容',
  `summary` varchar(550) DEFAULT NULL COMMENT '项目简介',
  `comp_desc` varchar(550) DEFAULT NULL COMMENT '公司简介',
  `team` varchar(550) DEFAULT NULL COMMENT '核心团队',
  `status` tinyint(4) DEFAULT '0' COMMENT '状态',
  `follow_id` tinyint(4) unsigned DEFAULT '0' COMMENT '跟进人id',
  `follower` varchar(50) DEFAULT '' COMMENT '跟进人',
  `stage_remark` varchar(150) DEFAULT '' COMMENT '进度描述',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='融资项目';

-- 正在导出表  binggq.projrong 的数据：~13 rows (大约)
DELETE FROM `projrong`;
/*!40000 ALTER TABLE `projrong` DISABLE KEYS */;
INSERT INTO `projrong` (`id`, `user_id`, `publisher`, `contact`, `company`, `title`, `stage_id`, `address`, `scale_id`, `stock`, `read_nums`, `praise_nums`, `comment_nums`, `cover`, `body`, `summary`, `comp_desc`, `team`, `status`, `follow_id`, `follower`, `stage_remark`, `create_time`, `update_time`) VALUES
	(2, 2, '曹文鹏', '', '腾讯科技', '母婴健康交流', 'A轮', '深圳市南山区腾讯大厦', '500人', '14%', NULL, NULL, NULL, '/upload/proj/cover/2016-04-22/5719a69da9447.jpg', '特特', '12', '33', '养生项目组', NULL, 0, '', '', '0000-00-00 00:00:00', NULL),
	(3, 2, '并购帮', '', '腾讯科技', 'mysql 查询前一天', '3', '福田上沙333', '2', '14%', NULL, NULL, NULL, '/upload/proj/cover/2016-07-15/5788aa6fe416e.jpg', '45sgasdgdcagd', '交流会啊', '33', '33532', 0, 0, '', '', '0000-00-00 00:00:00', NULL),
	(4, 2, '并购帮', '', '腾讯科技', '母婴健康交流', '1', '深圳市南山区腾讯大厦', '1', '14%', NULL, NULL, NULL, '/upload/proj/cover/2016-07-26/57971f5ca775d.jpg', '12312', '12', '33', '养生项目组', 0, 0, '范冰冰', '呵呵', '2016-07-15 21:41:00', '2016-07-26 16:29:19'),
	(5, 7, '郑旭', '', 'google', '完成灸疗店铺版开发', '1', '深圳市南山区腾讯大厦', '1', '14%', NULL, NULL, NULL, '/upload/proj/cover/2016-07-15/5788e9f27c082.jpg', '123', '交流会啊', '33', '养生项目组', 0, 0, '范冰冰', '123', '2016-07-15 21:49:00', '2016-07-15 21:49:00'),
	(6, 9, '游依婷', '', 'google', '母婴健康交流', '1', '深圳市南山区腾讯大厦', '1', '14%', NULL, NULL, NULL, '/upload/proj/cover/2016-07-18/578c370dc1dd5.jpg', '112', '交流会啊', '33', '养生项目组', 0, 0, '范冰冰', '进行中。', '2016-07-18 09:55:54', '2016-07-18 09:55:54'),
	(7, 7, '郑旭', '腾讯CMD', '腾讯科技', '母婴健康交流', '1', '深南大道腾讯大厦', '1', '14%', 0, 0, 0, '/upload/proj/cover/2016-07-27/5798adcb01370.jpg', 'tw23', '135415', '13513', '513513', 0, 0, '范冰冰', '15135', '2016-07-27 20:49:29', '2016-08-15 10:32:48'),
	(8, 0, '柳青', '189123193311', '野鸡大学', 'lightbox2 with image rotate', '1', '111212334', '1', '12412', 0, 0, 0, '/upload/proj/cover/2016-08-18/57b55d994b90e.png', '', '12312', '12312', '214124', 0, 0, '12312', '1312', '2016-08-18 15:06:53', '2016-08-18 15:08:36'),
	(9, 0, '12312', '213412', '412412', '412412412412412', '1', '441241241', '1', '2412412', 0, 0, 0, '/upload/proj/cover/2016-08-18/57b55f0fbb421.jpg', NULL, '12412', '12412', '12412412', 0, 0, '12312', '421412', '2016-08-18 15:09:28', '2016-08-18 15:09:28'),
	(10, 0, '12312', '421412', '124412', '4214', '1', '21312', '1', '421', 0, 0, 0, '/upload/proj/cover/2016-08-18/57b5614662e15.jpg', '', '124', '21412', '412', 0, 0, '4124', '21412', '2016-08-18 15:18:52', '2016-08-18 15:19:52'),
	(11, 0, '12412', '21412', '21412', '412412', '3', '312421', '2', '412', 0, 0, 0, '/upload/proj/cover/2016-08-18/57b562a8d2dfe.jpg', NULL, '12412', '12512', '512512', 0, 0, '12312', '125123512', '2016-08-18 15:24:52', '2016-08-18 15:24:52'),
	(12, 0, '21412', '412412', '12412', '21412', '1', '12412', '1', '241412', 0, 0, 0, '/upload/proj/cover/2016-08-18/57b562e7e8429.jpg', NULL, '12412', '42141', '12412', 0, 0, '21412', '412412412412', '2016-08-18 15:25:51', '2016-08-18 15:25:51'),
	(14, 0, 'qwr', 'qwrqw', 'rqwrqw', 't12rt12', '1', '124', '1', '4124', 0, 0, 0, '/upload/proj/cover/2016-08-18/57b5677119a5f.jpg', NULL, '12412', '241412', '421412', 0, 0, '12412', '12412', '2016-08-18 15:47:23', '2016-08-18 15:47:23'),
	(15, 0, '2142', '421412', '421412', '412412', '1', '12412', '1', '21412', 0, 0, 0, '/upload/proj/cover/2016-08-18/57b5682fa5b2e.jpg', NULL, '12412', '412412', '21412', 0, 0, '12312', '214214124', '2016-08-18 15:48:22', '2016-08-18 17:11:30'),
	(16, 0, '42134', '12412', '4124', '12412', '1', '21412', '1', '412412', 0, 0, 0, '/upload/proj/cover/2016-08-19/57b6e9198c3ea.jpg', NULL, '124', '12412', '412', 0, 0, '21412', '421412', '2016-08-19 19:10:48', '2016-08-19 19:10:48');
/*!40000 ALTER TABLE `projrong` ENABLE KEYS */;


-- 导出  表 binggq.projrong_fans 结构
CREATE TABLE IF NOT EXISTS `projrong_fans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='融资项目感兴趣的人';

-- 正在导出表  binggq.projrong_fans 的数据：~0 rows (大约)
DELETE FROM `projrong_fans`;
/*!40000 ALTER TABLE `projrong_fans` DISABLE KEYS */;
/*!40000 ALTER TABLE `projrong_fans` ENABLE KEYS */;


-- 导出  表 binggq.pvlog 结构
CREATE TABLE IF NOT EXISTS `pvlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) NOT NULL DEFAULT '' COMMENT 'ip',
  `screen` varchar(20) NOT NULL DEFAULT '' COMMENT '屏幕尺寸',
  `refer` varchar(150) NOT NULL DEFAULT '' COMMENT '访问页',
  `url` varchar(150) NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL,
  `act` varchar(5) NOT NULL DEFAULT '',
  `useragent` varchar(250) NOT NULL DEFAULT '' COMMENT '用户头',
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=258 DEFAULT CHARSET=utf8 COMMENT='访问日志';

-- 正在导出表  binggq.pvlog 的数据：~257 rows (大约)
DELETE FROM `pvlog`;
/*!40000 ALTER TABLE `pvlog` DISABLE KEYS */;
INSERT INTO `pvlog` (`id`, `ip`, `screen`, `refer`, `url`, `user_id`, `act`, `useragent`, `create_time`) VALUES
	(1, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-03 13:05:05'),
	(2, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-03 13:05:42'),
	(3, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-03 13:05:42'),
	(4, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-03 13:05:46'),
	(5, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-03 13:05:46'),
	(6, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-03 13:09:38'),
	(7, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-03 15:38:29'),
	(8, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-03 15:40:22'),
	(9, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-03 15:40:51'),
	(10, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-03 15:41:08'),
	(11, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-03 15:42:41'),
	(12, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-03 15:47:34'),
	(13, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-03 15:54:36'),
	(14, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-03 15:54:43'),
	(15, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-03 15:54:50'),
	(16, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-03 15:55:26'),
	(17, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-03 15:56:04'),
	(18, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-03 15:56:08'),
	(19, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-03 15:57:17'),
	(20, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-03 15:58:34'),
	(21, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-03 16:09:04'),
	(22, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-03 16:31:48'),
	(23, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-03 16:31:50'),
	(24, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-03 16:32:01'),
	(25, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-03 16:43:45'),
	(26, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-03 16:43:55'),
	(27, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-03 16:44:00'),
	(28, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-03 16:44:05'),
	(29, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-03 16:44:52'),
	(30, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-03 16:45:05'),
	(31, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-03 16:47:21'),
	(32, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-03 16:47:24'),
	(33, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-03 16:47:25'),
	(34, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-03 16:47:29'),
	(35, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-03 16:48:15'),
	(36, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-03 16:49:20'),
	(37, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-03 16:49:30'),
	(38, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-03 16:49:39'),
	(39, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-03 16:49:59'),
	(40, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-03 16:51:04'),
	(41, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-03 16:51:10'),
	(42, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-03 16:51:15'),
	(43, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-03 16:51:17'),
	(44, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-03 16:51:19'),
	(45, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-03 16:52:41'),
	(46, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-03 16:52:42'),
	(47, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-03 16:58:35'),
	(48, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 09:44:59'),
	(49, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 09:45:00'),
	(50, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 10:35:02'),
	(51, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 10:35:04'),
	(52, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 10:35:05'),
	(53, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 10:35:07'),
	(54, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 10:35:10'),
	(55, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 10:35:10'),
	(56, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 10:35:11'),
	(57, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 10:35:12'),
	(58, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 10:35:13'),
	(59, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 10:35:13'),
	(60, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 10:35:14'),
	(61, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 10:35:14'),
	(62, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 10:35:15'),
	(63, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 10:35:15'),
	(64, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 10:35:16'),
	(65, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 10:35:17'),
	(66, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 10:35:19'),
	(67, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 10:35:19'),
	(68, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 10:35:22'),
	(69, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 10:35:22'),
	(70, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 10:35:24'),
	(71, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 10:35:26'),
	(72, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 10:35:26'),
	(73, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 10:35:27'),
	(74, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 10:35:28'),
	(75, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 10:35:37'),
	(76, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 10:35:37'),
	(77, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 10:35:38'),
	(78, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 10:35:39'),
	(79, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 10:35:40'),
	(80, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 10:35:40'),
	(81, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 10:35:41'),
	(82, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 10:35:41'),
	(83, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 10:35:43'),
	(84, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 10:35:43'),
	(85, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 10:35:45'),
	(86, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 10:35:55'),
	(87, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 10:35:55'),
	(88, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 10:35:57'),
	(89, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 10:35:57'),
	(90, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 10:35:58'),
	(91, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 10:35:59'),
	(92, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 10:36:00'),
	(93, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 10:36:00'),
	(94, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-04 11:04:08'),
	(95, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 11:43:17'),
	(96, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 11:43:24'),
	(97, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 11:43:40'),
	(98, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 11:43:48'),
	(99, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 11:43:49'),
	(100, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 11:44:03'),
	(101, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 11:44:03'),
	(102, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 11:44:13'),
	(103, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 11:44:13'),
	(104, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 11:44:16'),
	(105, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 11:44:16'),
	(106, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 11:48:39'),
	(107, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 11:48:39'),
	(108, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 11:53:48'),
	(109, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 11:53:48'),
	(110, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 11:53:50'),
	(111, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 11:53:51'),
	(112, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 11:53:53'),
	(113, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 11:53:53'),
	(114, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 11:55:05'),
	(115, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 11:55:05'),
	(116, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 14:39:42'),
	(117, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 14:39:43'),
	(118, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 14:39:44'),
	(119, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 14:39:45'),
	(120, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 14:39:53'),
	(121, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 14:39:53'),
	(122, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 14:40:04'),
	(123, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 14:40:09'),
	(124, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 14:40:12'),
	(125, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 14:40:14'),
	(126, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 14:40:14'),
	(127, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 14:40:15'),
	(128, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 14:40:15'),
	(129, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 14:40:15'),
	(130, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 14:48:53'),
	(131, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 14:48:53'),
	(132, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 14:48:53'),
	(133, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 14:49:04'),
	(134, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 14:49:05'),
	(135, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 14:49:09'),
	(136, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 14:49:09'),
	(137, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 14:49:14'),
	(138, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 14:49:15'),
	(139, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 14:49:20'),
	(140, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 14:49:20'),
	(141, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 14:54:48'),
	(142, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 14:54:50'),
	(143, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 14:54:51'),
	(144, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 14:54:54'),
	(145, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 14:54:54'),
	(146, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 14:55:03'),
	(147, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 14:55:04'),
	(148, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 14:55:15'),
	(149, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 14:55:16'),
	(150, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 17:04:19'),
	(151, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 17:04:20'),
	(152, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 17:04:20'),
	(153, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 17:04:21'),
	(154, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 17:04:23'),
	(155, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 17:04:23'),
	(156, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-04 17:22:03'),
	(157, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 17:22:03'),
	(158, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-04 17:46:48'),
	(159, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-04 19:10:11'),
	(160, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-04 19:10:19'),
	(161, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-04 19:10:22'),
	(162, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-04 19:10:28'),
	(163, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-04 19:10:34'),
	(164, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-04 20:16:13'),
	(165, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-05 10:19:56'),
	(166, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-05 10:47:24'),
	(167, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-05 10:48:12'),
	(168, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-05 10:48:21'),
	(169, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-05 10:49:40'),
	(170, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-05 10:49:51'),
	(171, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-06 11:10:32'),
	(172, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-06 11:41:23'),
	(173, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-06 11:41:34'),
	(174, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-06 11:41:34'),
	(175, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-06 11:41:34'),
	(176, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-06 11:41:35'),
	(177, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-06 11:41:48'),
	(178, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-06 11:41:48'),
	(179, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-06 11:41:50'),
	(180, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-06 11:41:51'),
	(181, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-06 11:41:52'),
	(182, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-06 11:41:52'),
	(183, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-06 11:41:59'),
	(184, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-06 11:42:00'),
	(185, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-06 11:42:01'),
	(186, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-06 11:42:01'),
	(187, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-06 11:42:02'),
	(188, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-06 11:42:03'),
	(189, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-06 11:42:33'),
	(190, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-06 11:42:33'),
	(191, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-06 11:51:48'),
	(192, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-06 11:51:48'),
	(193, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-06 11:51:55'),
	(194, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-06 11:51:55'),
	(195, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-06 11:51:56'),
	(196, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-06 11:51:57'),
	(197, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-06 11:52:00'),
	(198, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-06 11:52:01'),
	(199, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-06 15:38:51'),
	(200, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-06 15:38:55'),
	(201, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-06 15:39:09'),
	(202, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-06 15:39:20'),
	(203, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-06 15:40:07'),
	(204, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-08 09:17:58'),
	(205, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-08 09:31:29'),
	(206, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-08 12:03:24'),
	(207, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-08 14:13:20'),
	(208, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-08 19:15:37'),
	(209, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-08 20:00:48'),
	(210, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-09 09:48:47'),
	(211, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-09 10:01:30'),
	(212, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-10 09:43:16'),
	(213, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-11 10:37:14'),
	(214, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-11 17:49:46'),
	(215, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-11 17:49:58'),
	(216, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-11 17:50:03'),
	(217, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-12 09:40:04'),
	(218, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-15 10:15:14'),
	(219, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-15 15:44:15'),
	(220, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-15 15:44:26'),
	(221, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-15 15:44:27'),
	(222, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-15 15:44:32'),
	(223, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-15 15:44:39'),
	(224, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-15 15:44:39'),
	(225, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-15 15:44:47'),
	(226, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-15 15:44:48'),
	(227, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-15 15:44:49'),
	(228, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-15 15:44:49'),
	(229, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-15 15:45:08'),
	(230, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-15 15:45:09'),
	(231, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-15 15:45:18'),
	(232, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-15 15:45:19'),
	(233, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-15 15:45:21'),
	(234, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-15 15:45:21'),
	(235, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-15 15:45:29'),
	(236, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-15 15:45:30'),
	(237, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-15 15:45:41'),
	(238, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-15 15:45:41'),
	(239, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-15 15:45:42'),
	(240, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-15 15:45:42'),
	(241, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-15 15:45:57'),
	(242, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-15 15:45:58'),
	(243, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-15 15:46:00'),
	(244, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-15 15:46:01'),
	(245, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-15 15:46:10'),
	(246, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-15 15:46:11'),
	(247, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1', '2016-08-15 15:46:53'),
	(248, '127.0.0.1', '667*375', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-15 15:46:54'),
	(249, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-15 16:31:27'),
	(250, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-15 16:31:44'),
	(251, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-15 16:31:47'),
	(252, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-15 16:32:08'),
	(253, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-15 16:33:04'),
	(254, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-15 16:53:54'),
	(255, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-15 16:54:13'),
	(256, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '2016-08-15 16:54:25'),
	(257, '127.0.0.1', '1080*1920', 'bgq.dev', '', 0, 'v', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', '2016-08-15 17:11:06');
/*!40000 ALTER TABLE `pvlog` ENABLE KEYS */;


-- 导出  表 binggq.region 结构
CREATE TABLE IF NOT EXISTS `region` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '地区标签表',
  `name` varchar(50) NOT NULL COMMENT '地区名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='地区标签表';

-- 正在导出表  binggq.region 的数据：~8 rows (大约)
DELETE FROM `region`;
/*!40000 ALTER TABLE `region` DISABLE KEYS */;
INSERT INTO `region` (`id`, `name`) VALUES
	(1, '广州'),
	(2, '深圳'),
	(3, '上海'),
	(4, '北京'),
	(5, '成都'),
	(6, '武汉'),
	(7, '香港'),
	(8, '其他'),
	(9, '杭州');
/*!40000 ALTER TABLE `region` ENABLE KEYS */;


-- 导出  表 binggq.rong_tag 结构
CREATE TABLE IF NOT EXISTS `rong_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `industry_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='融资项目行业标签';

-- 正在导出表  binggq.rong_tag 的数据：~11 rows (大约)
DELETE FROM `rong_tag`;
/*!40000 ALTER TABLE `rong_tag` DISABLE KEYS */;
INSERT INTO `rong_tag` (`id`, `project_id`, `industry_id`) VALUES
	(1, 2, 2),
	(2, 2, 5),
	(3, 5, 5),
	(4, 5, 7),
	(5, 6, 8),
	(6, 6, 9),
	(7, 6, 10),
	(8, 7, 6),
	(9, 8, 9),
	(10, 10, 8),
	(11, 10, 19),
	(12, 15, 6),
	(13, 16, 7),
	(14, 16, 8);
/*!40000 ALTER TABLE `rong_tag` ENABLE KEYS */;


-- 导出  表 binggq.savant 结构
CREATE TABLE IF NOT EXISTS `savant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `reco_nums` mediumint(8) NOT NULL COMMENT '推荐次数',
  `cover` varchar(550) NOT NULL DEFAULT '' COMMENT '封面',
  `xmjy` varchar(550) NOT NULL DEFAULT '' COMMENT '项目经验',
  `zyys` varchar(550) NOT NULL COMMENT '资源优势',
  `summary` varchar(550) NOT NULL COMMENT '简洁',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='专家信息表';

-- 正在导出表  binggq.savant 的数据：~4 rows (大约)
DELETE FROM `savant`;
/*!40000 ALTER TABLE `savant` DISABLE KEYS */;
INSERT INTO `savant` (`id`, `user_id`, `reco_nums`, `cover`, `xmjy`, `zyys`, `summary`) VALUES
	(3, 12, 2, '', '7年dota经验，精通所有英雄，5个位置都能打，擅长C位，伐木能力惊人！', 'dota 坑逼 菜鱼\n万年经济垫底飞鞋送人头 菜黄\n烈士路第一单 小金子\n中路菜鸡 左XX', ''),
	(5, 7, 3, '', '7年dota经验，精通所有英雄，5个位置都能打，擅长C位，伐木能力惊人！', 'dota 坑逼 菜鱼万年经济垫底飞鞋送人头 菜黄烈士路第一单 小金子中路菜鸡 左XX', '超神像吃饭一样，每回合必送敌方五把圣剑'),
	(6, 17, 1, '', '桑三十年你说呢', '啥汉堡', ''),
	(7, 10, 1, '', '经验很好', '很多优势', '互联网咨询'),
	(8, 21, 0, '/upload/savant/cover/2016-07-27/57988ad573cef.jpg', 'dota2', 'dota2,dota,', '没作用');
/*!40000 ALTER TABLE `savant` ENABLE KEYS */;


-- 导出  表 binggq.savant_apply 结构
CREATE TABLE IF NOT EXISTS `savant_apply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `check_man` varchar(50) DEFAULT '' COMMENT '审核人',
  `xmjy` varchar(550) NOT NULL DEFAULT '' COMMENT '项目经验',
  `zyys` varchar(550) NOT NULL DEFAULT '' COMMENT '资源优势',
  `action` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1通过0不通过',
  `reason` varchar(50) DEFAULT '' COMMENT '意见',
  `create_time` datetime NOT NULL COMMENT '申请时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='专家认证';

-- 正在导出表  binggq.savant_apply 的数据：~3 rows (大约)
DELETE FROM `savant_apply`;
/*!40000 ALTER TABLE `savant_apply` DISABLE KEYS */;
INSERT INTO `savant_apply` (`id`, `user_id`, `check_man`, `xmjy`, `zyys`, `action`, `reason`, `create_time`, `update_time`) VALUES
	(2, 21, '曹麦穗', '扯淡经验', '麻痹经验', 0, '又扯淡了吧', '2016-08-03 10:38:55', '2016-08-03 11:46:22'),
	(4, 21, '曹麦穗', '扯淡经验', '麻痹经验334', 0, '还扯淡呢', '2016-08-03 11:52:25', '2016-08-03 11:58:40'),
	(5, 21, '曹麦穗', 'dota2', 'dota2,dota,', 1, '', '2016-08-03 12:00:43', '2016-08-03 12:02:48');
/*!40000 ALTER TABLE `savant_apply` ENABLE KEYS */;


-- 导出  表 binggq.savant_reco 结构
CREATE TABLE IF NOT EXISTS `savant_reco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `savant_id` int(11) DEFAULT '0' COMMENT '专家id',
  `user_id` int(11) DEFAULT '0' COMMENT '用户id',
  `create_time` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='专家推荐';

-- 正在导出表  binggq.savant_reco 的数据：~9 rows (大约)
DELETE FROM `savant_reco`;
/*!40000 ALTER TABLE `savant_reco` DISABLE KEYS */;
INSERT INTO `savant_reco` (`id`, `savant_id`, `user_id`, `create_time`) VALUES
	(10, 8, 18, '2016-06-28 10:13:35'),
	(11, 8, 10, '2016-06-28 20:01:28'),
	(12, 7, 18, '2016-06-29 10:28:14'),
	(13, 7, 17, '2016-06-29 17:27:52'),
	(14, 11, 7, '2016-07-04 19:53:09'),
	(15, 16, 7, '2016-07-05 12:26:15'),
	(16, 10, 7, '2016-07-05 12:26:32'),
	(17, 17, 13, '2016-07-11 14:10:39'),
	(18, 7, 13, '2016-07-11 16:55:15');
/*!40000 ALTER TABLE `savant_reco` ENABLE KEYS */;


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


-- 导出  表 binggq.secret 结构
CREATE TABLE IF NOT EXISTS `secret` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `phone_set` tinyint(4) NOT NULL DEFAULT '1' COMMENT '手机设置1公开2不公开',
  `email_set` tinyint(4) NOT NULL DEFAULT '1' COMMENT '邮箱设置',
  `profile_set` tinyint(4) NOT NULL DEFAULT '1' COMMENT '资料设置',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='隐私设置';

-- 正在导出表  binggq.secret 的数据：~18 rows (大约)
DELETE FROM `secret`;
/*!40000 ALTER TABLE `secret` DISABLE KEYS */;
INSERT INTO `secret` (`id`, `user_id`, `phone_set`, `email_set`, `profile_set`) VALUES
	(2, 17, 1, 1, 1),
	(3, 10, 1, 2, 1),
	(4, 19, 1, 1, 1),
	(5, 2, 1, 1, 1),
	(6, 7, 2, 1, 1),
	(7, 18, 1, 1, 1),
	(8, 25, 2, 1, 1),
	(9, 26, 1, 1, 1),
	(10, 27, 1, 1, 1),
	(11, 14, 2, 1, 1),
	(12, 15, 1, 1, 1),
	(13, 29, 2, 2, 1),
	(14, 30, 2, 2, 1),
	(15, 31, 2, 2, 1),
	(16, 32, 2, 2, 1),
	(17, 33, 2, 2, 1),
	(18, 34, 2, 2, 1),
	(19, 35, 2, 2, 1);
/*!40000 ALTER TABLE `secret` ENABLE KEYS */;


-- 导出  表 binggq.smsmsg 结构
CREATE TABLE IF NOT EXISTS `smsmsg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(50) NOT NULL DEFAULT '0' COMMENT '手机号',
  `code` varchar(50) DEFAULT NULL COMMENT '验证码',
  `content` varchar(250) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=utf8 COMMENT='短信记录';

-- 正在导出表  binggq.smsmsg 的数据：~239 rows (大约)
DELETE FROM `smsmsg`;
/*!40000 ALTER TABLE `smsmsg` DISABLE KEYS */;
INSERT INTO `smsmsg` (`id`, `phone`, `code`, `content`, `create_time`) VALUES
	(1, '18316629973', '', '您的动态验证码为1256', '2016-04-29 18:12:57'),
	(2, '18316629973', '9294', '您的动态验证码为9294', '2016-05-03 09:53:22'),
	(3, '18316629973', '7722', '您的动态验证码为7722', '2016-05-03 11:40:03'),
	(4, '18316629973', '2559', '您的动态验证码为2559', '2016-05-03 12:11:50'),
	(5, '18316629973', '5275', '您的动态验证码为5275', '2016-05-03 13:09:37'),
	(6, '18316629973', '0490', '您的动态验证码为0490', '2016-05-03 13:12:01'),
	(7, '18316629973', '4416', '您的动态验证码为4416', '2016-05-03 14:22:57'),
	(8, '18316629973', '6637', '您的动态验证码为6637', '2016-05-03 14:25:07'),
	(9, '18316629973', '7240', '您的动态验证码为7240', '2016-05-06 10:20:44'),
	(10, '18316629973', '5424', '您的动态验证码为5424', '2016-05-09 16:50:26'),
	(11, '18316629973', '9208', '您的动态验证码为9208', '2016-05-09 17:56:41'),
	(12, '15013797469', '5186', '您的动态验证码为5186', '2016-05-10 10:37:58'),
	(13, '15013797469', '1601', '您的动态验证码为1601', '2016-05-10 10:38:19'),
	(14, '15013797469', '4642', '您的动态验证码为4642', '2016-05-10 10:39:32'),
	(15, '15013797469', '3187', '您的动态验证码为3187', '2016-05-10 10:39:57'),
	(16, '18316629973', '0208', '您的动态验证码为0208', '2016-05-10 14:14:56'),
	(17, '18316629973', '5727', '您的动态验证码为5727', '2016-05-10 15:12:15'),
	(18, '13560627825', '2095', '您的动态验证码为2095', '2016-05-11 19:08:57'),
	(19, '18316629973', '0489', '您的动态验证码为0489', '2016-05-12 16:23:54'),
	(20, '18316629973', '7597', '您的动态验证码为7597', '2016-05-16 10:36:42'),
	(21, '18316629973', '6735', '您的动态验证码为6735', '2016-05-16 11:45:49'),
	(22, '18316629973', '6281', '您的动态验证码为6281', '2016-05-16 11:49:10'),
	(23, '18316629973', '9171', '您的动态验证码为9171', '2016-05-17 11:53:56'),
	(24, '18316629973', '4030', '您的动态验证码为4030', '2016-05-17 12:06:42'),
	(25, '18316629973', '0003', '您的动态验证码为0003', '2016-05-17 13:52:47'),
	(26, '18316629973', '3402', '您的动态验证码为3402', '2016-05-18 14:11:43'),
	(27, '18316629973', '1341', '您的动态验证码为1341', '2016-05-19 10:43:16'),
	(28, '18316629973', '2317', '您的动态验证码为2317', '2016-05-19 14:40:15'),
	(29, '18316629973', '9158', '您的动态验证码为9158', '2016-05-20 14:43:32'),
	(30, '18316629973', '6732', '您的动态验证码为6732', '2016-05-23 10:12:22'),
	(31, '18316629973', '2873', '您的动态验证码为2873', '2016-05-24 10:11:36'),
	(32, '18316629973', '7448', '您的动态验证码为7448', '2016-05-26 15:55:02'),
	(33, '18316629973', '5605', '您的动态验证码为5605', '2016-05-27 16:02:08'),
	(34, '13530229625', '7849', '您的动态验证码为7849', '2016-06-01 13:58:56'),
	(35, '13510663507', '6101', '您的动态验证码为6101', '2016-06-07 17:50:05'),
	(36, '13510663507', '8111', '您的动态验证码为8111', '2016-06-07 20:18:30'),
	(37, '13510663507', '2040', '您的动态验证码为2040', '2016-06-07 20:32:02'),
	(38, '13510663507', '6413', '您的动态验证码为6413', '2016-06-07 20:54:21'),
	(39, '13560627825', '1491', '您的动态验证码为1491', '2016-06-07 21:22:34'),
	(40, '13560627825', '3395', '您的动态验证码为3395', '2016-06-07 21:27:43'),
	(41, '13560627825', '4411', '您的动态验证码为4411', '2016-06-07 21:29:04'),
	(42, '13560627825', '1247', '您的动态验证码为1247', '2016-06-07 22:35:39'),
	(43, '13560627825', '4984', '您的动态验证码为4984', '2016-06-07 22:35:40'),
	(44, '13560627825', '5372', '您的动态验证码为5372', '2016-06-07 22:38:21'),
	(45, '13510663507', '9135', '您的动态验证码为9135', '2016-06-07 23:51:45'),
	(46, '13560627825', '8707', '您的动态验证码为8707', '2016-06-08 10:26:19'),
	(47, '13530229625', '8583', '您的动态验证码为8583', '2016-06-08 11:56:07'),
	(48, '13530229625', '4073', '您的动态验证码为4073', '2016-06-08 17:34:43'),
	(49, '18681509040', '', '申请人已经向您支付了预约费用：150元，请做好赴约准备。', '2016-06-13 16:47:16'),
	(50, '18681509040', '', '申请人已经向您支付了预约费用：150元，请做好赴约准备。', '2016-06-13 17:00:30'),
	(51, '15914057632', '5835', '您的动态验证码为5835', '2016-06-20 14:52:00'),
	(52, '13510663507', '9796', '您的动态验证码为9796', '2016-06-21 16:02:12'),
	(53, '13510663507', '8284', '您的动态验证码为8284', '2016-06-21 16:02:13'),
	(54, '13510663507', '6178', '您的动态验证码为6178', '2016-06-21 16:02:15'),
	(55, '13510663507', '4387', '您的动态验证码为4387', '2016-06-21 16:10:09'),
	(56, '13510663507', '9782', '您的动态验证码为9782', '2016-06-21 16:12:43'),
	(57, '13510663507', '0787', '您的动态验证码为0787', '2016-06-21 16:22:12'),
	(58, '13510663507', '7188', '您的动态验证码为7188', '2016-06-21 16:22:46'),
	(59, '13510663507', '3196', '您的动态验证码为3196', '2016-06-21 16:37:13'),
	(60, '13510663507', '8806', '您的动态验证码为8806', '2016-06-21 16:37:54'),
	(61, '13510663507', '1076', '您的动态验证码为1076', '2016-06-21 16:39:41'),
	(62, '13510663507', '6423', '您的动态验证码为6423', '2016-06-21 16:45:59'),
	(63, '13510663507', '7224', '您的动态验证码为7224', '2016-06-21 16:54:31'),
	(64, '15013797469', '9564', '您的动态验证码为9564', '2016-06-21 17:20:16'),
	(65, '15013797469', '7158', '您的动态验证码为7158', '2016-06-21 17:20:30'),
	(66, '15013797469', '7693', '您的动态验证码为7693', '2016-06-21 17:20:49'),
	(67, '13510663507', '5024', '您的动态验证码为5024', '2016-06-21 17:47:48'),
	(68, '13510663507', '3657', '您的动态验证码为3657', '2016-06-21 17:49:21'),
	(69, '15601866919', '2960', '您的动态验证码为2960', '2016-06-21 20:26:30'),
	(70, '15601866919', '5349', '您的动态验证码为5349', '2016-06-21 20:26:31'),
	(71, '18589040008', '5835', '您的动态验证码为5835', '2016-06-22 16:13:51'),
	(72, '13510663507', '9822', '您的动态验证码为9822', '2016-06-22 17:31:27'),
	(73, '18316629973', '', '您预约的话题：《互联网开发讲座》已确认通过，请及时登录平台支付预约款。', '2016-06-24 13:00:34'),
	(74, '18681509040', '', '申请人已经向您支付了预约费用：200元，请做好赴约准备。', '2016-06-24 13:23:32'),
	(75, '15013797469', '7821', '您的动态验证码为7821', '2016-06-24 15:54:23'),
	(76, '18316629973', '', '您预约的话题：《测试话题》已确认通过，请及时登录平台支付预约款。', '2016-06-24 18:02:29'),
	(77, '18681509040', '', '申请人已经向您支付了预约费用：150元，请做好赴约准备。', '2016-06-24 19:42:42'),
	(78, '18688733411', '5009', '您的动态验证码为5009', '2016-06-24 20:51:02'),
	(79, '18688733411', '0311', '您的动态验证码为0311', '2016-06-24 20:51:03'),
	(80, '18688733411', '3358', '您的动态验证码为3358', '2016-06-24 20:51:22'),
	(81, '18666822085', '9524', '您的动态验证码为9524', '2016-06-24 20:52:27'),
	(82, '18681509040', '7449', '您的动态验证码为7449', '2016-06-24 20:55:37'),
	(83, '13510669757', '3835', '您的动态验证码为3835', '2016-06-24 21:13:21'),
	(84, '18576672803', '4430', '您的动态验证码为4430', '2016-06-24 21:31:43'),
	(85, '18666822085', '2987', '您的动态验证码为2987', '2016-06-24 21:37:25'),
	(86, '18666822085', '6671', '您的动态验证码为6671', '2016-06-24 21:37:53'),
	(87, '13631506288', '6199', '您的动态验证码为6199', '2016-06-24 21:42:11'),
	(88, '18666822085', '8704', '您的动态验证码为8704', '2016-06-24 21:42:58'),
	(89, '15013797469', '0995', '您的动态验证码为0995', '2016-06-25 10:42:27'),
	(90, '15013797469', '9790', '您的动态验证码为9790', '2016-06-25 10:43:59'),
	(91, '15013797469', '5477', '您的动态验证码为5477', '2016-06-25 10:45:52'),
	(92, '15013797469', '7803', '您的动态验证码为7803', '2016-06-25 10:46:24'),
	(93, '15013797469', '3807', '您的动态验证码为3807', '2016-06-25 10:46:38'),
	(94, '13510663507', '', '您预约的话题：《测试话题》已确认通过，请及时登录平台支付预约款。', '2016-06-25 11:02:36'),
	(95, '18681509040', '2658', '您的动态验证码为2658', '2016-06-25 11:12:19'),
	(96, '18316629973', '', '您预约的话题：《测试话题》已确认通过，请及时登录平台支付预约款。', '2016-06-25 11:14:15'),
	(97, '15013797469', '7879', '您的动态验证码为7879', '2016-06-25 11:15:03'),
	(98, '15013797469', '1103', '您的动态验证码为1103', '2016-06-25 11:15:43'),
	(99, '15013797562', '3837', '您的动态验证码为3837', '2016-06-25 11:15:56'),
	(100, '18681509040', '6699', '您的动态验证码为6699', '2016-06-25 11:16:33'),
	(101, '15013797469', '6602', '您的动态验证码为6602', '2016-06-25 11:18:39'),
	(102, '18681509040', '', '申请人已经向您支付了预约费用：150元，请做好赴约准备。', '2016-06-25 11:50:51'),
	(103, '13510663507', '', '您预约的话题：《测试话题》已确认通过，请及时登录平台支付预约款。', '2016-06-25 11:52:17'),
	(104, '13510663507', '', '您预约的话题：《测试话题》已确认通过，请及时登录平台支付预约款。', '2016-06-25 11:52:19'),
	(105, '13510663507', '', '您预约的话题：《测试话题》已确认通过，请及时登录平台支付预约款。', '2016-06-25 11:52:26'),
	(106, '18681509040', '', '申请人已经向您支付了预约费用：150元，请做好赴约准备。', '2016-06-25 12:15:23'),
	(107, '15914057632', '1613', '您的动态验证码为1613', '2016-06-25 12:19:12'),
	(108, '15914057632', '', '您预约的话题：《测试话题》已确认通过，请及时登录平台支付预约款。', '2016-06-25 12:24:03'),
	(109, '18316629973', '', '申请人已经向您支付了预约费用：150元，请做好赴约准备。', '2016-06-25 12:24:38'),
	(110, '15914057632', '', '您预约的话题：《测试话题》已确认通过，请及时登录平台支付预约款。', '2016-06-25 12:34:03'),
	(111, '18316629973', '', '您预约的话题：《测试话题》已确认通过，请及时登录平台支付预约款。', '2016-06-25 12:34:31'),
	(112, '18681509040', '', '申请人已经向您支付了预约费用：150元，请做好赴约准备。', '2016-06-25 12:34:33'),
	(113, '18681509040', '', '申请人已经向您支付了预约费用：150元，请做好赴约准备。', '2016-06-25 12:35:50'),
	(114, '18503039067', '5218', '您的动态验证码为5218', '2016-06-25 14:40:52'),
	(115, '18503039067', '3447', '您的动态验证码为3447', '2016-06-25 14:41:20'),
	(116, '18503039067', '2104', '您的动态验证码为2104', '2016-06-25 14:42:29'),
	(117, '13510663507', '', '您预约的话题：《测试话题》已确认通过，请及时登录平台支付预约款。', '2016-06-25 14:49:39'),
	(118, '18503039067', '9413', '您的动态验证码为9413', '2016-06-25 14:50:55'),
	(119, '18503039067', '9779', '您的动态验证码为9779', '2016-06-25 14:50:56'),
	(120, '15914057632', '7736', '您的动态验证码为7736', '2016-06-25 14:54:42'),
	(121, '13560627825', '8634', '您的动态验证码为8634', '2016-06-25 14:57:43'),
	(122, '13560627825', '', '您预约的话题：《互联网开发讲座》已确认通过，请及时登录平台支付预约款。', '2016-06-25 15:01:00'),
	(123, '15986227560', '5410', '您的动态验证码为5410', '2016-06-25 15:14:07'),
	(124, '15914057632', '0123', '您的动态验证码为0123', '2016-06-25 15:14:47'),
	(125, '18316629973', '', '您预约的话题：《测试话题》已确认通过，请及时登录平台支付预约款。', '2016-06-25 15:19:39'),
	(126, '18503039067', '7442', '您的动态验证码为7442', '2016-06-25 15:24:15'),
	(127, '15013797469', '7142', '您的动态验证码为7142', '2016-06-25 15:26:31'),
	(128, '15013797469', '6793', '您的动态验证码为6793', '2016-06-25 15:27:09'),
	(129, '18316629973', '', '申请人已经向您支付了预约费用：150元，请做好赴约准备。', '2016-06-25 15:33:49'),
	(130, '15986227560', '8892', '您的动态验证码为8892', '2016-06-25 17:37:44'),
	(131, '18503039067', '8586', '您的动态验证码为8586', '2016-06-25 21:12:03'),
	(132, '18503039067', '9034', '您的动态验证码为9034', '2016-06-25 21:13:15'),
	(133, '18503039064', '1015', '您的动态验证码为1015', '2016-06-25 21:17:55'),
	(134, '13922806080', '5623', '您的动态验证码为5623', '2016-06-26 11:23:15'),
	(135, '18503039064', '8664', '您的动态验证码为8664', '2016-06-26 14:24:42'),
	(136, '18503039066', '7326', '您的动态验证码为7326', '2016-06-26 14:34:59'),
	(137, '18503039066', '5072', '您的动态验证码为5072', '2016-06-26 14:35:00'),
	(138, '18503039066', '5617', '您的动态验证码为5617', '2016-06-26 14:35:01'),
	(139, '18503039066', '0532', '您的动态验证码为0532', '2016-06-26 14:35:17'),
	(140, '18503039066', '2490', '您的动态验证码为2490', '2016-06-26 14:35:18'),
	(141, '13530229625', '3341', '您的动态验证码为3341', '2016-06-28 09:58:48'),
	(142, '18688733411', '9977', '您的动态验证码为9977', '2016-06-28 22:09:14'),
	(143, '18688733411', '0268', '您的动态验证码为0268', '2016-06-28 22:09:32'),
	(144, '18688733411', '5144', '您的动态验证码为5144', '2016-06-28 22:22:33'),
	(145, '18688834857', '3229', '您的动态验证码为3229', '2016-06-29 12:12:15'),
	(146, '18688834857', '6108', '您的动态验证码为6108', '2016-06-29 12:16:56'),
	(147, '18316629973', '6359', '您的动态验证码为6359', '2016-06-29 14:25:21'),
	(148, '18316629983', '6689', '您的动态验证码为6689', '2016-06-29 14:28:18'),
	(149, '18316629983', '0997', '您的动态验证码为0997', '2016-06-29 14:32:02'),
	(150, '18316629973', '0524', '您的动态验证码为0524', '2016-06-29 14:36:13'),
	(151, '18316629973', '8004', '您的动态验证码为8004', '2016-06-29 14:38:28'),
	(152, '18316629973', '8832', '您的动态验证码为8832', '2016-06-29 14:41:53'),
	(153, '15914057632', '3871', '您的动态验证码为3871', '2016-06-29 15:27:28'),
	(154, '18316629973', '0711', '您的动态验证码为0711', '2016-06-29 16:22:25'),
	(155, '18316629973', '5023', '您的动态验证码为5023', '2016-06-29 16:30:02'),
	(156, '18316629973', '2991', '您的动态验证码为2991', '2016-06-29 16:40:28'),
	(157, '18316629973', '9725', '您的动态验证码为9725', '2016-06-29 16:50:45'),
	(158, '13922806080', '4796', '您的动态验证码为4796', '2016-06-29 17:23:46'),
	(159, '18316629973', '2958', '您的动态验证码为2958', '2016-06-29 17:41:14'),
	(160, '13922806080', '7588', '您的动态验证码为7588', '2016-06-29 18:02:57'),
	(161, '13510663507', '0952', '您的动态验证码为0952', '2016-06-30 11:17:54'),
	(162, '13510663507', '6528', '您的动态验证码为6528', '2016-06-30 11:18:30'),
	(163, '13510663507', '7995', '您的动态验证码为7995', '2016-06-30 11:19:04'),
	(164, '13510663507', '8912', '您的动态验证码为8912', '2016-06-30 11:21:00'),
	(165, '18503039067', '0747', '您的动态验证码为0747', '2016-06-30 11:33:18'),
	(166, '15986227560', '8887', '您的动态验证码为8887', '2016-06-30 17:00:18'),
	(167, '15914057632', '8380', '您的动态验证码为8380', '2016-06-30 17:13:39'),
	(168, '15986227560', '2385', '您的动态验证码为2385', '2016-07-01 10:19:44'),
	(169, '15914057632', '4112', '您的动态验证码为4112', '2016-07-01 10:23:13'),
	(170, '15914057632', '3376', '您的动态验证码为3376', '2016-07-01 10:23:33'),
	(171, '15013797469', '2054', '您的动态验证码为2054', '2016-07-01 10:24:18'),
	(172, '18503039067', '4457', '您的动态验证码为4457', '2016-07-01 10:43:44'),
	(173, '13510663507', '4621', '您的动态验证码为4621', '2016-07-01 21:56:35'),
	(174, '13510663507', '8678', '您的动态验证码为8678', '2016-07-01 22:13:55'),
	(175, '13510663507', '1276', '您的动态验证码为1276', '2016-07-01 22:25:12'),
	(176, '18038163801', '2966', '您的动态验证码为2966', '2016-07-01 22:33:14'),
	(177, '13510663507', '3726', '您的动态验证码为3726', '2016-07-03 16:30:28'),
	(178, '15914057632', '4357', '您的动态验证码为4357', '2016-07-04 16:04:09'),
	(179, '15013797469', '9280', '您的动态验证码为9280', '2016-07-04 18:08:23'),
	(180, '18681540783', '0519', '您的动态验证码为0519', '2016-07-04 19:46:04'),
	(181, '13922806080', '', '您预约的话题：《互联网开发讲座》已确认通过，请及时登录平台支付预约款。', '2016-07-05 17:19:05'),
	(182, '18316629973', '', '您预约的话题：《吃》已确认通过，请及时登录平台支付预约款。', '2016-07-05 18:11:41'),
	(183, '13922806080', '', '申请人曹麦穗手机号:18316629973已经向您支付了预约费用：1元，请做好赴约准备。', '2016-07-05 18:12:39'),
	(184, '18316629973', '', '您已支付成功,可凭短信赴约,专家:郑巽议手机号:', '2016-07-05 18:12:39'),
	(185, '18503039067', '3448', '您的动态验证码为3448', '2016-07-05 21:39:44'),
	(186, '18316629973', '7339', '您的动态验证码为7339', '2016-07-05 21:58:53'),
	(187, '15013797469', '', '您预约的话题：《互联网开发讲座》已确认通过，请及时登录平台支付预约款。', '2016-07-05 22:13:02'),
	(188, '18681509040', '', '您预约的话题：《中型网络开发》已确认通过，请及时登录平台支付预约款。', '2016-07-06 12:24:03'),
	(189, '18681509040', '', '您预约的话题：《中型网络开发》已确认通过，请及时登录平台支付预约款。', '2016-07-06 12:24:04'),
	(190, '13510663507', '', '申请人郑旭手机号:18681509040已经向您支付了预约费用：300元，请做好赴约准备。', '2016-07-06 12:28:30'),
	(191, '18681509040', '', '您已支付成功,可凭短信赴约,专家:周啸风手机号:13510663507', '2016-07-06 12:28:30'),
	(192, '15914057632', '', '您预约的话题：《互联网开发讲座》已确认通过，请及时登录平台支付预约款。', '2016-07-06 12:29:21'),
	(193, '18681509040', '', '申请人杜胜佳手机号:15914057632已经向您支付了预约费用：200元，请做好赴约准备。', '2016-07-06 12:30:17'),
	(194, '15914057632', '', '您已支付成功,可凭短信赴约,专家:郑旭手机号:18681509040', '2016-07-06 12:30:17'),
	(195, '18316629973', '', '您预约的话题：《互联网开发讲座》已确认通过，请及时登录平台支付预约款。', '2016-07-06 22:01:39'),
	(196, '18316629973', '', '您预约的话题：《互联网开发讲座》已确认通过，请及时登录平台支付预约款。', '2016-07-06 22:01:40'),
	(197, '15914057632', '', '您预约的话题：《互联网开发讲座》已确认通过，请及时登录平台支付预约款。', '2016-07-07 20:14:20'),
	(198, '15914057632', '', '您预约的话题：《测试话题》已确认通过，请及时登录平台支付预约款。', '2016-07-07 20:14:30'),
	(199, '15914057632', '', '您预约的话题：《测试话题》已确认通过，请及时登录平台支付预约款。', '2016-07-07 20:15:08'),
	(200, '13650256334', '5498', '您的动态验证码为5498', '2016-07-08 12:17:15'),
	(201, '15986227560', '5191', '您的动态验证码为5191', '2016-07-08 12:29:10'),
	(202, '15986227560', '2502', '您的动态验证码为2502', '2016-07-08 12:33:49'),
	(203, '13510669757', '2701', '您的动态验证码为2701', '2016-07-08 13:21:09'),
	(204, '18576672803', '7307', '您的动态验证码为7307', '2016-07-08 15:23:50'),
	(205, '18688834857', '6413', '您的动态验证码为6413', '2016-07-08 15:38:39'),
	(206, '18688834857', '0908', '您的动态验证码为0908', '2016-07-08 15:39:49'),
	(207, '18588455890', '8412', '您的动态验证码为8412', '2016-07-08 16:16:36'),
	(208, '15811808140', '1655', '您的动态验证码为1655', '2016-07-08 16:35:55'),
	(209, '18666822085', '0500', '您的动态验证码为0500', '2016-07-08 16:42:36'),
	(210, '15811808140', '0524', '您的动态验证码为0524', '2016-07-09 04:32:43'),
	(211, '13631610622', '1331', '您的动态验证码为1331', '2016-07-09 20:04:55'),
	(212, '13303913119', '1296', '您的动态验证码为1296', '2016-07-09 21:03:27'),
	(213, '18818566622', '3139', '您的动态验证码为3139', '2016-07-11 10:54:28'),
	(214, '13246730326', '4017', '您的动态验证码为4017', '2016-07-11 10:55:28'),
	(215, '18802684325', '8215', '您的动态验证码为8215', '2016-07-11 12:53:23'),
	(216, '18566238264', '6373', '您的动态验证码为6373', '2016-07-11 15:11:05'),
	(217, '13828817061', '5873', '您的动态验证码为5873', '2016-07-11 15:31:14'),
	(218, '13631506288', '9270', '您的动态验证码为9270', '2016-07-11 15:38:56'),
	(219, '13631610622', '3412', '您的动态验证码为3412', '2016-07-11 15:50:18'),
	(220, '18802684325', '1970', '您的动态验证码为1970', '2016-07-11 15:58:08'),
	(221, '13828817061', '3794', '您的动态验证码为3794', '2016-07-11 17:20:02'),
	(222, '13631610622', '1933', '您的动态验证码为1933', '2016-07-11 17:24:36'),
	(223, '18681509040', '', '申请人杜胜佳手机号:15914057632已经向您支付了预约费用：150元，请做好赴约准备。', '2016-07-11 18:06:45'),
	(224, '15914057632', '', '您已支付成功,可凭短信赴约,专家:郑旭手机号:18681509040', '2016-07-11 18:06:45'),
	(225, '18681509040', '', '申请人孔琦手机号:18316629973已经向您支付了预约费用：200元，请做好赴约准备。', '2016-07-11 20:49:53'),
	(226, '18316629973', '', '您已支付成功,可凭短信赴约,专家:郑旭手机号:18681509040', '2016-07-11 20:49:54'),
	(227, '18681509040', '', '申请人杜胜佳手机号:15914057632已经向您支付了预约费用：200元，请做好赴约准备。', '2016-07-11 21:03:21'),
	(228, '15914057632', '', '您已支付成功,可凭短信赴约,专家:郑旭手机号:18681509040', '2016-07-11 21:03:22'),
	(229, '18681509040', '', '申请人杜胜佳手机号:15914057632已经向您支付了预约费用：150元，请做好赴约准备。', '2016-07-11 21:35:24'),
	(230, '15914057632', '', '您已支付成功,可凭短信赴约,专家:郑旭手机号:18681509040', '2016-07-11 21:35:24'),
	(231, '18681509040', '', '申请人孔琦手机号:18316629973已经向您支付了预约费用：200元，请做好赴约准备。', '2016-07-12 09:54:47'),
	(232, '18316629973', '', '您已支付成功,可凭短信赴约,专家:郑旭手机号:18681509040', '2016-07-12 09:54:47'),
	(233, '18681509040', '', '申请人孔琦手机号:18316629973已经向您支付了预约费用：200元，请做好赴约准备。', '2016-07-12 10:06:51'),
	(234, '18316629973', '', '您已支付成功,可凭短信赴约,专家:郑旭手机号:18681509040', '2016-07-12 10:06:52'),
	(235, '15005903191', '6278', '您的动态验证码为6278', '2016-07-12 11:22:10'),
	(236, '15986227560', '4170', '您的动态验证码为4170', '2016-07-12 11:53:36'),
	(237, '15914057632', '', '您预约的话题：《中型网络开发》已确认通过，请及时登录平台支付预约款。', '2016-07-12 16:20:11'),
	(238, '13510663507', '', '申请人杜胜佳手机号:15914057632已经向您支付了预约费用：300元，请做好赴约准备。', '2016-07-12 16:22:28'),
	(239, '15914057632', '', '您已支付成功,可凭短信赴约,专家:周啸风手机号:13510663507', '2016-07-12 16:22:28'),
	(240, '18316629973', '4603', '您的动态验证码为4603', '2016-07-21 15:47:23'),
	(241, '13922806080', '6515', '您的动态验证码为6515', '2016-07-22 20:04:37'),
	(242, '18316629973', '1975', '您的动态验证码为1975', '2016-07-27 11:48:57'),
	(243, '18316629973', '4284', '您的动态验证码为4284', '2016-07-28 17:03:41'),
	(244, '18316629974', '', '您报名的活动：《hello world》已确认通过，请及时登录平台支付报名费用。', '2016-08-04 14:39:50'),
	(245, '18316629974', '', '您报名的活动：《传统企业的改革之路》已确认通过，请及时登录平台支付报名费用。', '2016-08-19 14:16:34'),
	(246, '18316629973', '6880', '您的动态验证码为6880', '2016-08-19 15:21:19'),
	(247, '18316629973', '9283', '您的动态验证码为9283', '2016-08-19 15:29:30'),
	(248, '18316629973', '8453', '您的动态验证码为8453', '2016-08-19 15:52:35'),
	(249, '18316629973', '7568', '您的动态验证码为7568', '2016-08-19 17:03:44');
/*!40000 ALTER TABLE `smsmsg` ENABLE KEYS */;


-- 导出  表 binggq.sponsor 结构
CREATE TABLE IF NOT EXISTS `sponsor` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '活动赞助表',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `activity_id` int(11) NOT NULL COMMENT '活动id',
  `create_time` datetime NOT NULL COMMENT '提交时间',
  `type` tinyint(4) NOT NULL COMMENT '类型值：1：嘉宾推荐；2：场地赞助；3：现金赞助；4：物品赞助；5：其他',
  `description` varchar(550) DEFAULT NULL COMMENT '描述',
  `name` varchar(20) DEFAULT NULL COMMENT '姓名',
  `company` varchar(100) DEFAULT NULL COMMENT '公司/机构',
  `department` varchar(20) DEFAULT NULL COMMENT '部门',
  `position` varchar(20) DEFAULT NULL COMMENT '职务',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '未处理',
  `check_man` varchar(50) NOT NULL DEFAULT '' COMMENT '处理人',
  `people` int(11) DEFAULT NULL COMMENT '容纳人数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COMMENT='活动赞助表';

-- 正在导出表  binggq.sponsor 的数据：~35 rows (大约)
DELETE FROM `sponsor`;
/*!40000 ALTER TABLE `sponsor` DISABLE KEYS */;
INSERT INTO `sponsor` (`id`, `user_id`, `activity_id`, `create_time`, `type`, `description`, `name`, `company`, `department`, `position`, `address`, `status`, `check_man`, `people`) VALUES
	(1, 0, 15, '2016-06-22 11:10:19', 1, '钱钱钱钱钱', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(2, 0, 15, '2016-06-22 11:10:25', 1, '钱钱钱钱钱', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(3, 0, 15, '2016-06-22 11:34:57', 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(4, 0, 15, '2016-06-22 11:35:08', 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(5, 0, 15, '2016-06-22 11:35:18', 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(6, 0, 16, '2016-06-22 14:27:49', 1, '   ', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(7, 0, 16, '2016-06-22 14:29:29', 1, '   ', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(8, 0, 16, '2016-06-22 14:29:36', 1, 'gfds ', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(9, 0, 16, '2016-06-22 14:42:09', 3, 'gdf', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(10, 9, 16, '2016-06-22 14:48:20', 1, 'gfdsgdf', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(11, 10, 16, '2016-06-22 14:49:19', 1, '13123', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(12, 9, 15, '2016-06-22 15:18:54', 3, 'gfsdfgdf', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(13, 2, 13, '2016-06-22 19:00:10', 5, 'hfhf', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(14, 10, 16, '2016-06-23 18:22:10', 1, '呃呃呃呃呃呃呃呃', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(15, 10, 16, '2016-06-23 18:25:59', 4, '呃呃呃呃呃呃呃呃', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(16, 10, 14, '2016-06-30 21:12:35', 1, 'yyy', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(17, 10, 14, '2016-06-30 21:12:37', 1, 'yyy', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(18, 11, 10, '2016-07-01 12:13:51', 2, '1200平', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(19, 10, 14, '2016-07-01 15:06:03', 1, 'tuijian ', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(20, 7, 16, '2016-07-01 16:29:25', 2, '这', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(21, 11, 10, '2016-07-01 21:27:58', 3, '100000', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(22, 7, 16, '2016-07-05 10:53:46', 2, '我们的', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(23, 7, 10, '2016-07-06 10:02:59', 1, '好', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(24, 26, 21, '2016-07-11 13:00:23', 3, '50块', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(25, 27, 24, '2016-07-11 15:55:57', 4, '测试', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(26, 14, 24, '2016-07-11 16:24:23', 1, '我要', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(27, 13, 24, '2016-07-11 16:24:47', 3, '现金赞助10万元', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(28, 24, 24, '2016-07-11 16:24:49', 5, 'money', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(29, 14, 24, '2016-07-11 16:24:51', 1, '我要做', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(30, 14, 24, '2016-07-11 16:30:11', 2, '，a ku', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(31, 24, 20, '2016-07-11 16:30:56', 1, 'one', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(32, 7, 24, '2016-07-11 16:31:04', 3, '富含丰富风格', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(33, 24, 21, '2016-07-11 16:31:19', 1, 'one', NULL, NULL, NULL, NULL, NULL, 0, '曹麦穗', NULL),
	(34, 24, 24, '2016-07-11 16:31:54', 2, '北京', NULL, NULL, NULL, NULL, NULL, 0, '', NULL),
	(35, 8, 38, '2016-08-04 11:54:30', 4, '我可以赞助100箱辣条\n', NULL, NULL, NULL, NULL, NULL, 1, '曹麦穗', NULL);
/*!40000 ALTER TABLE `sponsor` ENABLE KEYS */;


-- 导出  表 binggq.stage 结构
CREATE TABLE IF NOT EXISTS `stage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='融资阶段';

-- 正在导出表  binggq.stage 的数据：~4 rows (大约)
DELETE FROM `stage`;
/*!40000 ALTER TABLE `stage` DISABLE KEYS */;
INSERT INTO `stage` (`id`, `name`) VALUES
	(1, '天使轮'),
	(2, 'A轮'),
	(3, 'B轮'),
	(4, 'C轮'),
	(5, 'D轮');
/*!40000 ALTER TABLE `stage` ENABLE KEYS */;


-- 导出  表 binggq.subject_book 结构
CREATE TABLE IF NOT EXISTS `subject_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL DEFAULT '0' COMMENT '话题id',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `savant_id` int(11) NOT NULL DEFAULT '0' COMMENT '专家id',
  `summary` varchar(550) NOT NULL DEFAULT '' COMMENT '需求简介',
  `status` tinyint(4) NOT NULL COMMENT '0,未确认1确认通过2不予通过3完成',
  `is_done` tinyint(2) NOT NULL DEFAULT '0' COMMENT '专家标记是否已经完成约见',
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COMMENT='话题预约';

-- 正在导出表  binggq.subject_book 的数据：~64 rows (大约)
DELETE FROM `subject_book`;
/*!40000 ALTER TABLE `subject_book` DISABLE KEYS */;
INSERT INTO `subject_book` (`id`, `subject_id`, `user_id`, `savant_id`, `summary`, `status`, `is_done`, `create_time`, `update_time`) VALUES
	(6, 4, 8, 7, 'gasgdsa1', 3, 0, '2016-05-26 18:27:45', '2016-06-13 17:00:30'),
	(7, 1, 7, 8, 'gasgdsa1', 0, 0, '2016-05-26 18:27:45', '2016-05-26 18:27:45'),
	(8, 3, 8, 7, '我有一个plan,就差一个coder，和一些money了。', 3, 0, '2016-06-24 11:58:08', '2016-06-24 13:23:32'),
	(9, 4, 8, 7, '哈哈', 3, 0, '2016-06-24 17:59:32', '2016-06-24 19:42:41'),
	(10, 4, 8, 7, 'das', 3, 0, '2016-06-25 10:53:15', '2016-06-25 11:50:51'),
	(11, 1, 10, 8, '擦', 1, 0, '2016-06-25 10:58:35', '2016-06-25 11:02:35'),
	(12, 4, 10, 7, '预约ok', 3, 0, '2016-06-25 11:51:17', '2016-06-25 12:15:23'),
	(13, 4, 8, 7, '不错', 3, 0, '2016-06-25 12:10:39', '2016-06-25 12:35:49'),
	(14, 1, 15, 8, 'gjmk', 3, 0, '2016-06-25 12:22:46', '2016-06-25 12:24:38'),
	(15, 4, 15, 7, 'lngm', 3, 0, '2016-06-25 12:33:41', '2016-06-25 12:34:32'),
	(16, 1, 10, 8, 'ttt', 3, 0, '2016-06-25 14:34:41', '2016-06-25 15:33:48'),
	(17, 3, 9, 7, '123456', 0, 0, '2016-06-25 14:59:25', '2016-06-25 14:59:25'),
	(18, 2, 9, 8, '56879', 1, 0, '2016-06-25 15:00:54', '2016-06-25 15:00:59'),
	(19, 4, 8, 7, '擦掉', 1, 0, '2016-06-25 15:18:27', '2016-06-25 15:19:39'),
	(20, 4, 18, 7, '测试', 0, 0, '2016-06-28 10:57:43', '2016-06-28 10:57:43'),
	(21, 3, 10, 7, '我', 0, 0, '2016-06-28 20:09:06', '2016-06-28 20:09:06'),
	(22, 1, 10, 8, '我', 0, 0, '2016-06-28 20:10:58', '2016-06-28 20:10:58'),
	(23, 3, 10, 7, 'oko', 0, 0, '2016-06-30 11:57:42', '2016-06-30 11:57:42'),
	(24, 3, 11, 7, 'dgjj', 1, 0, '2016-07-01 21:34:17', '2016-07-05 22:13:02'),
	(25, 3, 17, 7, '我也来扯淡', 2, 0, '2016-07-05 17:18:03', '2016-07-05 17:19:05'),
	(26, 6, 19, 17, '我也想吃西瓜', 3, 0, '2016-07-05 18:09:21', '2016-07-05 18:12:39'),
	(27, 5, 7, 10, '高虎', 3, 0, '2016-07-06 12:22:25', '2016-07-06 12:28:29'),
	(28, 3, 15, 7, '有一个广告', 3, 0, '2016-07-06 12:29:09', '2016-07-06 12:30:16'),
	(29, 3, 15, 7, '我们', 0, 0, '2016-07-06 12:29:34', '2016-07-06 12:29:34'),
	(30, 5, 7, 10, '我', 0, 0, '2016-07-06 18:32:25', '2016-07-06 18:32:25'),
	(31, 5, 21, 10, '不错', 0, 0, '2016-07-06 21:57:57', '2016-07-06 21:57:57'),
	(32, 3, 21, 7, '不错', 1, 0, '2016-07-06 21:58:35', '2016-07-12 10:06:50'),
	(33, 5, 7, 10, '我', 0, 0, '2016-07-07 19:49:26', '2016-07-07 19:49:26'),
	(34, 5, 7, 10, '我', 0, 0, '2016-07-07 19:49:33', '2016-07-07 19:49:33'),
	(35, 5, 7, 10, '我自己的话', 0, 0, '2016-07-07 19:49:48', '2016-07-07 19:49:48'),
	(36, 5, 7, 10, '一个人', 0, 0, '2016-07-07 19:50:10', '2016-07-07 19:50:10'),
	(37, 3, 2, 7, '有一点', 0, 0, '2016-07-07 19:52:03', '2016-07-07 19:52:03'),
	(38, 5, 7, 10, '这', 0, 0, '2016-07-07 19:52:36', '2016-07-07 19:52:36'),
	(39, 4, 2, 7, '一', 0, 0, '2016-07-07 19:52:52', '2016-07-07 19:52:52'),
	(40, 3, 15, 7, 'iii', 0, 0, '2016-07-07 19:52:52', '2016-07-07 19:52:52'),
	(41, 3, 15, 7, '让人听', 0, 0, '2016-07-07 19:53:08', '2016-07-07 19:53:08'),
	(42, 5, 7, 10, '你也喜欢', 0, 0, '2016-07-07 19:54:31', '2016-07-07 19:54:31'),
	(43, 5, 7, 10, '你也喜欢传', 0, 0, '2016-07-07 19:54:58', '2016-07-07 19:54:58'),
	(44, 5, 15, 10, '有意义', 0, 0, '2016-07-07 19:55:23', '2016-07-07 19:55:23'),
	(45, 5, 15, 10, '有意义', 0, 0, '2016-07-07 19:55:36', '2016-07-07 19:55:36'),
	(46, 5, 15, 10, '不会', 0, 0, '2016-07-07 19:55:50', '2016-07-07 19:55:50'),
	(47, 5, 15, 10, '不要', 0, 0, '2016-07-07 19:56:13', '2016-07-07 19:56:13'),
	(48, 4, 15, 7, '这是', 0, 0, '2016-07-07 19:56:52', '2016-07-07 19:56:52'),
	(49, 4, 15, 7, '这是', 0, 0, '2016-07-07 19:57:09', '2016-07-07 19:57:09'),
	(50, 4, 15, 7, '这是', 0, 0, '2016-07-07 19:57:17', '2016-07-07 19:57:17'),
	(51, 4, 15, 7, '这是', 0, 0, '2016-07-07 19:57:22', '2016-07-07 19:57:22'),
	(52, 4, 2, 7, '存在', 0, 0, '2016-07-07 19:57:54', '2016-07-07 19:57:54'),
	(53, 4, 15, 7, '在', 0, 0, '2016-07-07 19:58:30', '2016-07-07 19:58:30'),
	(54, 4, 2, 7, '存在', 0, 0, '2016-07-07 19:58:39', '2016-07-07 19:58:39'),
	(55, 4, 2, 7, '款式', 0, 0, '2016-07-07 19:59:55', '2016-07-07 19:59:55'),
	(56, 4, 15, 7, '都好好的\n', 3, 0, '2016-07-07 20:00:45', '2016-07-11 18:06:44'),
	(57, 4, 15, 7, '高规格', 3, 0, '2016-07-07 20:03:47', '2016-07-11 21:35:23'),
	(58, 3, 15, 7, '在一起', 3, 0, '2016-07-07 20:05:10', '2016-07-11 21:03:21'),
	(59, 5, 7, 10, 'r r t', 0, 0, '2016-07-07 20:08:13', '2016-07-07 20:08:13'),
	(60, 5, 7, 10, 'r r t', 0, 0, '2016-07-07 20:08:18', '2016-07-07 20:08:18'),
	(61, 4, 10, 7, '天天天', 2, 0, '2016-07-07 20:09:11', '2016-07-07 20:14:11'),
	(62, 3, 13, 7, '你好', 0, 0, '2016-07-08 15:33:40', '2016-07-08 15:33:40'),
	(63, 4, 17, 7, '预约', 0, 0, '2016-07-08 17:04:09', '2016-07-08 17:04:09'),
	(64, 4, 17, 7, '预约', 0, 0, '2016-07-08 17:04:55', '2016-07-08 17:04:55'),
	(65, 4, 14, 7, '想学习', 0, 0, '2016-07-09 12:45:56', '2016-07-09 12:45:56'),
	(66, 4, 15, 7, '跟哥哥哥哥哥哥风风光光', 0, 0, '2016-07-11 16:22:14', '2016-07-11 16:22:14'),
	(67, 4, 13, 7, '请教', 0, 0, '2016-07-11 16:55:35', '2016-07-11 16:55:35'),
	(68, 5, 15, 10, 'qqqwwwweeeeerr', 3, 0, '2016-07-11 19:44:52', '2016-07-12 16:22:27'),
	(69, 3, 15, 7, 'weed 的热热热热热吃到一', 0, 0, '2016-07-12 12:32:34', '2016-07-12 12:32:34');
/*!40000 ALTER TABLE `subject_book` ENABLE KEYS */;


-- 导出  表 binggq.user 结构
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户表',
  `phone` varchar(20) NOT NULL COMMENT '手机号',
  `user_token` varchar(20) NOT NULL COMMENT '用户标志',
  `union_id` varchar(100) DEFAULT NULL COMMENT 'wx_unionid',
  `wx_openid` varchar(100) DEFAULT '' COMMENT '微信的openid',
  `app_wx_openid` varchar(100) DEFAULT '' COMMENT 'app端的微信id',
  `truename` varchar(20) NOT NULL COMMENT '姓名',
  `level` tinyint(4) NOT NULL DEFAULT '1' COMMENT '等级,1:普通2:专家',
  `grade` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1普通2高级会员3vip',
  `idcard` varchar(20) DEFAULT '' COMMENT '身份证',
  `company` varchar(50) DEFAULT '' COMMENT '公司',
  `position` varchar(50) DEFAULT '' COMMENT '职位',
  `email` varchar(50) DEFAULT '' COMMENT '邮箱',
  `gender` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1,男，2女',
  `agency_id` int(11) NOT NULL COMMENT '机构',
  `ext_industry` varchar(50) DEFAULT '' COMMENT '自定义行业标签',
  `goodat` varchar(50) DEFAULT '' COMMENT '擅长业务',
  `city` varchar(50) DEFAULT '' COMMENT '常驻城市',
  `card_path` varchar(250) NOT NULL DEFAULT '' COMMENT '名片路径',
  `avatar` varchar(250) DEFAULT '' COMMENT '头像',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '账户余额',
  `meet_nums` mediumint(9) NOT NULL DEFAULT '0' COMMENT '约见次数',
  `fans` mediumint(9) NOT NULL DEFAULT '0' COMMENT '粉丝数',
  `ymjy` varchar(250) DEFAULT '' COMMENT '项目经验',
  `ywnl` varchar(250) DEFAULT '' COMMENT '业务能力',
  `gsyw` varchar(500) DEFAULT NULL COMMENT '公司业务',
  `reason` varchar(250) DEFAULT '' COMMENT '审核意见',
  `grbq` text COMMENT '个人标签',
  `admin_id` int(11) DEFAULT '0' COMMENT '负责人id',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '实名认证状态：1.实名待审核2审核通过0审核不通过',
  `savant_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '专家认证状态：1.未认证.2待审核3审核通过0审核不通过',
  `enabled` tinyint(1) NOT NULL DEFAULT '1' COMMENT '账号状态 ：1.可用0禁用(控制登录)',
  `is_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否假删除：1,是0否',
  `device` varchar(50) NOT NULL DEFAULT 'app' COMMENT '注册设备',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- 正在导出表  binggq.user 的数据：~22 rows (大约)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `phone`, `user_token`, `union_id`, `wx_openid`, `app_wx_openid`, `truename`, `level`, `grade`, `idcard`, `company`, `position`, `email`, `gender`, `agency_id`, `ext_industry`, `goodat`, `city`, `card_path`, `avatar`, `money`, `meet_nums`, `fans`, `ymjy`, `ywnl`, `gsyw`, `reason`, `grbq`, `admin_id`, `status`, `savant_status`, `enabled`, `is_del`, `device`, `create_time`, `update_time`) VALUES
	(-1, '-1', '', NULL, '', '', '并购帮', 3, 1, '', '', '', '', 1, 0, '', '', '', '/upload/user/mp/2016-07-11/578306d7c828a.jpg', '/upload/user/avatar/2016-07-07/thumb_577e35a2415aa.jpg', 0.00, 0, 0, '', '', NULL, '', NULL, 0, 1, 1, 1, 0, 'app', '2016-07-18 10:39:19', '2016-07-11 10:39:19'),
	(2, '', '', NULL, '', '', '并购帮', 3, 1, '', '', '', '', 1, 0, '', '', '', '/upload/user/mp/2016-07-11/578306d7c828a.jpg', '/upload/user/avatar/2016-07-07/thumb_577e35a2415aa.jpg', 0.00, 0, 0, '', '', NULL, '', NULL, 0, 1, 1, 1, 0, 'app', '2016-07-18 10:39:19', '2016-07-11 10:39:19'),
	(7, '18681509040', '', 'oglBHw957rd4_qnAjBb5HoEMSvSA', 'oqQRxswxqn-LYh2834g3168751yA', 'oplMIwqjBXqnmWjo0-C9D3EoX4zM', '郑旭', 2, 1, '', '柠檬智慧互联网咨询', '产品', 'claus@smartlemon.cn', 1, 17, '6642', '互联网咨询、传统企业转型升级', '深圳', '/upload/user/mp/2016-07-08/577f18a4c0e78.png', '/upload/user/avatar/2016-07-08/thumb_577f18645ec6e.png', 2550.00, 7, 6, '', '', '传统企业加速器', '更符合规范', 'a:1:{i:0;s:6:"产品";}', 0, 2, 3, 1, 1, 'app', '2016-05-05 18:46:01', '2016-07-19 18:05:01'),
	(8, '18316629974', '51b98b86bbb3a5ddbf68', 'oglBHw-G5fbNmQeUoZiyWl_M1Dgc', 'oqQRxsx_srEukkVOBQMVWsmPDPbY', 'oplMIwnDMBxytRnkyYXcTE2J6JSE', '曹文鹏', 2, 1, '', '广州市时尚商业城有限公司', '总经理', 'caowenpeng1990@126.com', 1, 17, '', '擅长业务', '深圳', '/upload/user/mp/2016-07-08/577f2b055e9bb.jpg', '/upload/user/avatar/2016-07-08/thumb_577f44aed3af1.jpg', 13800.00, 0, 0, '', '', '公司业务', 'just a reason', 'a:1:{i:0;s:6:"设计";}', 0, 2, 3, 1, 0, 'app', '2016-07-05 22:10:42', '2016-08-19 14:16:06'),
	(9, '13560627825', '', 'oglBHw5Lw3uyiz_G-iPQ8riJtiLw', 'oqQRxs7Z-wldoLSVShHaaiaRLDEM', '', '游依婷', 1, 1, '', '广东深宏盾律师事务所', '', '71426333x@qq.com', 1, 28, '', '', '', '/upload/user/mp/2016-05-11/573312fbdeaa3.jpg', '/upload/user/avatar/2016-07-08/thumb_577f6408be79d.jpg', 0.00, 0, 1, '', '', NULL, '', 'a:1:{i:0;s:1:"a";}', 0, 1, 1, 1, 0, 'app', '2016-05-11 19:10:58', '2016-07-08 16:27:52'),
	(10, '13510663507', '5760b3d3207fk', 'oglBHw7ngF8JT7nLU7uf89n2kTMc', 'oqQRxs7aaLVQQQq6Ps4ae1FZx13g', 'oplMIwmgVK6mc1dAsDgXmT5LExYc', '周啸风', 2, 1, '', '柠檬智慧', '研发', 'xifeo@smartlemon.cn', 1, 5, '', '123asdfj j2222', '深圳', '/upload/user/mp/2016-06-07/5756bee45c3ac.jpg', '/upload/user/avatar/2016-07-08/thumb_577e826868f7f.png', 600.00, 2, 5, '', '', '咨询', '111', 'a:2:{i:0;s:6:"研发";i:1;s:6:"产品";}', 0, 1, 0, 1, 0, 'app', '2016-06-07 20:32:48', '2016-07-28 12:22:18'),
	(11, '15013797469', '', 'oglBHwydRTphIKEnYBRS1zfYvqkM', '', 'oplMIwlQbmVLv7QBsfLl8Dmm5EzE', 'key', 2, 1, '', '柠檬智慧咨询有限公司', 'web前端', '380552386@qq.com', 2, 11, '杂七杂八', '', '', '/upload/user/mp/2016-06-24/576ce8ff6448f.jpg', '/upload/user/avatar/2016-07-08/thumb_577f463787d70.jpg', 0.00, 0, 2, '', '', NULL, '奋斗奋斗', NULL, 0, 1, 0, 1, 0, 'app', '2016-06-24 16:04:00', '2016-07-08 15:38:15'),
	(12, '13510669757', '', NULL, '', '', '123', 1, 1, '', '123123', '123123', '123123@22.cn', 1, 0, '', '', '', '/upload/user/mp/2016-06-24/576d35e3805c7.jpg', '', 0.00, 0, 0, '', '', NULL, '', NULL, 0, 1, 0, 0, 1, 'app', '2016-06-24 21:30:14', '2016-08-06 12:20:05'),
	(13, '18576672803', '9d600de758dbdfcf32ad', 'oglBHw9b2Tnllf6Odqx7lxSN4YIQ', '', 'oplMIwtE0c9yt07HLCFfelxueWcc', '李芬', 1, 1, '', '并购菁英汇', '总裁', 'fannyli@chinama.club', 2, 20, '并购基金', '', '', '/upload/user/mp/2016-07-08/577f57f47a08a.png', '', 0.00, 0, 1, '', '', NULL, '', NULL, 0, 1, 1, 1, 0, 'app', '2016-06-24 21:33:39', '2016-07-11 09:48:11'),
	(14, '18666822085', 'c65b3e2ca913bce64e86', NULL, '', '', '柳君', 1, 1, '', '并购菁英汇', '创始人', 'liujun@chinama.club', 2, 5, '结构化融资', '', '', '/upload/user/mp/2016-06-24/576d38f9f0e91.jpg', '/upload/user/avatar/2016-07-09/thumb_578083f798a7f.png', 0.00, 0, 2, '', '', NULL, '', NULL, 0, 1, 1, 1, 0, 'app', '2016-06-24 21:44:07', '2016-07-28 14:19:37'),
	(15, '15914057632', '', 'oglBHw5JZx4fFFo85XM73g2ouL6M', '', 'oplMIwgh4reCtBkjnZuYYMorucbk', '杜胜佳', 1, 1, '', '柠檬智慧', 'iOS', '2394799027@qq.com', 1, 0, '', '', '', '/upload/user/mp/2016-07-12/57848aae127c7.png', '/upload/user/avatar/2016-07-12/thumb_5784a38353c2c.png', 0.00, 0, 0, '', '', NULL, '', NULL, 0, 1, 1, 1, 0, 'app', '2016-06-25 12:21:13', '2016-07-12 18:30:06'),
	(16, '18503039067', '0c64ded4de1144b70344', NULL, '', '', '高强', 2, 1, '', '柠檬智慧', 'PM', '37373838@qq.com', 1, 25, '', '', '', '/upload/user/mp/2016-06-25/576e83eec7e50.jpg', '', 0.00, 0, 0, '', '', NULL, '', NULL, 0, 1, 3, 1, 0, 'app', '2016-06-25 21:16:29', '2016-08-04 19:10:21'),
	(17, '13922806080', 'c7d35cc52e6fa749d63c', 'oglBHw3XLmsyQwxONqDYLheJ7Sis', 'oqQRxs60He2s7FCEU8OzXo45lg0M', '', '郑巽议', 2, 1, '', '柠檬', '产品', '1747371814@qq.com', 1, 5, '', '', '', '/upload/user/mp/2016-06-26/576f4b9b6d7e7.jpg', '', 1.00, 1, 1, 'AA受到法律思考的法律', '', NULL, '', NULL, 0, 2, 3, 1, 0, 'app', '2016-06-26 11:27:00', '2016-08-05 10:48:20'),
	(18, '13530229625', '04c4b10979bb30d6fe27', 'oglBHw4pSUtpwdN2GQkAIqdmb5Gs', 'oqQRxs7zWwx10JUNNFKs4iRMhVyw', 'oplMIwjL4adjAGV-59R_jUo7uAT4', '陈荣', 0, 1, '', '柠檬智慧', '设计师', '346159951@qq.com', 1, 5, '', '', '', '/upload/user/mp/2016-06-28/5771da1747f70.jpg', 'http://wx.qlogo.cn/mmopen/rElKOG5jB0J4mUeRNkicicYOQLl4y8IPHLtVYTnJ6Yqrk5MfwTsQQYiajyYavrEtZSAkxLjxicKOpSeG3Pvicqibx78Vj0bH5edvyR/0', 0.00, 0, 0, '', '', '测试测试 测试', '', 'a:2:{i:0;s:6:"研发";i:1;s:6:"设计";}', 0, 2, 1, 1, 0, 'app', '2016-06-28 10:00:15', '2016-07-28 14:19:14'),
	(20, '18681540783', '16926776095be98d0358', 'oglBHwxuSzg5OxxUVNVMY07M-0MQ', '', 'oplMIwl-UVA1js6Noy1y8rA7PpxY', '韦世魁', 0, 1, '', '柠檬智慧', '产品总监', 'welber@smartlelmon.cn', 1, 20, '', '', '', '/upload/user/mp/2016-07-04/577a5192a7099.jpg', '/upload/user/avatar/2016-07-04/thumb_577a52fbdecce.jpg', 0.00, 0, 0, '', '', NULL, '', NULL, 0, 1, 1, 1, 0, 'app', '2016-07-04 20:08:58', '2016-08-06 15:40:07'),
	(22, '13650256334', '94a886347ebc45b448a6', 'oglBHww7VB8mFT7-EQ_WxvoFkgsM', '', 'oplMIwoPgcXKztmbadSrvy8E-Ubo', '雷婕', 1, 3, '', '柠檬智慧', '经理', 'xxx@qq.com', 1, 25, '', '', '深圳', '/upload/user/mp/2016-07-08/577f29df288d9.png', '/mobile/images/touxiang.jpg', 0.00, 0, 0, '', '', NULL, '', NULL, 8, 1, 1, 1, 0, 'app', '2016-07-08 12:24:06', '2016-08-06 15:39:09'),
	(23, '15811808140', '9c8cd8c29490f4174cd7', 'oglBHw0LIPNi64Ag35GNL848-JCc', '', 'oplMIwp4tAXG7opso1-TaLvqtlgs', '后雅弘', 2, 3, '', '并购菁英汇', '运营专员', 'houyahong@chinama.club', 2, 5, '', '', '', '/upload/user/mp/2016-07-09/57800e41a323a.jpg', '/upload/user/avatar/2016-07-11/thumb_5782fff6e2f81.jpg', 0.00, 0, 0, '', '', NULL, '', NULL, 0, 1, 1, 1, 0, 'app', '2016-07-09 04:34:30', '2016-07-29 19:59:15'),
	(24, '13303913119', '052d6911dd4fdeff004f', 'oglBHwxgwhvWzVgqhzs1cS6dqAZI', '', 'oplMIwruc7-zBKKd72l_2yu0BMbM', '朱晋辉', 1, 2, '', '并购菁英汇', '运营专员', 'zhujinhui@chinama.club', 1, 20, '', '', '', '/upload/user/mp/2016-07-09/5780f6bd27c9e.png', '/mobile/images/touxiang.jpg', 0.00, 0, 0, '', '', NULL, '', NULL, 3, 1, 1, 1, 0, 'app', '2016-07-09 21:07:44', '2016-08-06 15:38:55'),
	(25, '13246730326', 'cba0467b7f731f3023be', 'oglBHw46WOcXapmDEpCp2GJriSlc', '', 'oplMIwm_9I21V0fz4m2HWkhiuOTA', '黄嘉仪', 1, 1, '', '', '', '304290034@qq.com', 2, 5, '', '', '', '/upload/user/mp/2016-07-11/57830ad43ebee.png', '/mobile/images/touxiang.jpg', 0.00, 0, 0, '', '', NULL, '', NULL, 0, 1, 1, 1, 1, 'app', '2016-07-11 10:56:53', '2016-07-19 18:04:50'),
	(27, '13828817061', '0c323a5f13a14de84429', 'oglBHw9zVzzJEVtvJod8ql3qwGPU', '', 'oplMIwuAMLxO8nyk691lAHJFJzAg', '古思娜', 1, 1, '', '并购菁英汇', '', 'sir*a@chinama.club', 2, 20, '', '', '', '/upload/user/mp/2016-07-11/57835fa09a189.png', '/upload/user/avatar/2016-07-11/thumb_5783647939e2e.png', 0.00, 0, 0, '', '', NULL, '', NULL, 0, 1, 1, 1, 1, 'app', '2016-07-11 15:33:08', '2016-07-19 18:02:52'),
	(29, '1', 'efec6628488aa94091ed', NULL, '', '', '41', 1, 1, '', '12', '1231', '123@11.com', 1, 0, '', '', '', '1', '', 0.00, 0, 0, '', '', NULL, '', NULL, 0, 1, 1, 1, 0, 'app', '2016-07-22 19:20:56', '2016-07-22 20:31:02');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- 导出  表 binggq.usermsg 结构
CREATE TABLE IF NOT EXISTS `usermsg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '类型',
  `table_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT '记录id',
  `title` varchar(150) NOT NULL COMMENT '标题',
  `msg` varchar(550) NOT NULL COMMENT '内容',
  `num` smallint(6) NOT NULL DEFAULT '0' COMMENT '关注条数',
  `url` varchar(250) NOT NULL DEFAULT '' COMMENT '跳转链接',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0未读1已读',
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=utf8 COMMENT='用户消息';

-- 正在导出表  binggq.usermsg 的数据：~223 rows (大约)
DELETE FROM `usermsg`;
/*!40000 ALTER TABLE `usermsg` DISABLE KEYS */;
INSERT INTO `usermsg` (`id`, `user_id`, `type`, `table_id`, `title`, `msg`, `num`, `url`, `status`, `create_time`, `update_time`) VALUES
	(7, 7, 1, 10, '您有新的关注者', '您有1位新的关注者', 0, '/admin/user/index', 1, '2016-05-18 10:51:51', '2016-05-18 10:51:51'),
	(8, 8, 1, 11, '您有新的关注者', '您有1位新的关注者', 0, '/admin/user/index', 1, '2016-05-18 10:51:51', '2016-05-18 10:51:51'),
	(13, 8, 2, 9, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-05-20 14:53:30', '2016-05-20 14:53:30'),
	(14, 8, 2, 9, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-05-20 14:58:19', '2016-05-20 14:58:19'),
	(15, 8, 2, 9, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-05-20 15:05:19', '2016-05-20 15:05:19'),
	(16, 8, 2, 9, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-05-20 15:11:54', '2016-05-20 15:11:54'),
	(17, 8, 2, 15, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-05-20 15:25:30', '2016-05-20 15:25:30'),
	(18, 8, 2, 16, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-05-20 15:32:54', '2016-05-20 15:32:54'),
	(19, 8, 2, 17, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-05-20 16:54:17', '2016-05-20 16:54:17'),
	(20, 8, 2, 18, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-05-20 16:58:43', '2016-05-20 16:58:43'),
	(21, 8, 2, 19, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-05-20 16:59:55', '2016-05-20 16:59:55'),
	(22, 8, 2, 14, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-05-23 10:30:25', '2016-05-23 10:30:25'),
	(23, 8, 2, 5, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-05-23 10:59:39', '2016-05-23 10:59:39'),
	(24, 8, 2, 20, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-05-23 11:17:43', '2016-05-23 11:17:43'),
	(25, 8, 2, 21, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-05-23 11:22:01', '2016-05-23 11:22:01'),
	(26, 8, 2, 22, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-05-23 11:22:34', '2016-05-23 11:22:34'),
	(27, 8, 2, 23, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-05-23 15:55:48', '2016-05-23 15:55:48'),
	(28, 7, 3, 33, '评论回复', '有人回复了你的评论!', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-05-23 18:35:52', '2016-05-23 18:35:52'),
	(29, 7, 4, 0, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-05-26 17:18:11', '2016-05-26 17:18:11'),
	(30, 7, 4, 4, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-05-26 17:26:26', '2016-05-26 17:26:26'),
	(31, 7, 4, 6, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-05-26 18:27:45', '2016-05-26 18:27:45'),
	(32, 8, 2, 5, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-07 20:41:26', '2016-06-07 20:41:26'),
	(33, 8, 2, 9, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-07 21:18:21', '2016-06-07 21:18:21'),
	(34, 7, 2, 26, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-13 16:36:59', '2016-06-13 16:36:59'),
	(35, 8, 2, 20, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-13 16:37:05', '2016-06-13 16:37:05'),
	(36, 8, 2, 21, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-13 16:37:08', '2016-06-13 16:37:08'),
	(37, 8, 2, 25, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-13 16:37:15', '2016-06-13 16:37:15'),
	(38, 7, 4, 8, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-06-24 11:58:08', '2016-06-24 11:58:08'),
	(39, 8, 4, 8, '预约通知', '您预约的话题：《互联网开发讲座》已确认通过，请及时登录平台支付预约款。', 0, '/home/my-book-savant', 1, '2016-06-24 13:00:34', '2016-06-24 13:00:34'),
	(40, 7, 4, 9, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-06-24 17:59:32', '2016-06-24 17:59:32'),
	(41, 8, 4, 9, '预约通知', '您预约的话题：《测试话题》已确认通过，请及时登录平台支付预约款。', 0, '/home/my-book-savant', 1, '2016-06-24 18:02:29', '2016-06-24 18:02:29'),
	(42, 7, 4, 10, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-06-25 10:53:15', '2016-06-25 10:53:15'),
	(43, 8, 4, 11, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-06-25 10:58:35', '2016-06-25 10:58:35'),
	(44, 10, 4, 11, '预约通知', '您预约的话题：《测试话题》已确认通过，请及时登录平台支付预约款。', 0, '/home/my-book-savant', 1, '2016-06-25 11:02:36', '2016-06-25 11:02:36'),
	(45, 8, 2, 29, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-25 11:13:10', '2016-06-25 11:13:10'),
	(46, 10, 2, 40, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-25 11:13:14', '2016-06-25 11:13:14'),
	(47, 8, 4, 10, '预约通知', '您预约的话题：《测试话题》已确认通过，请及时登录平台支付预约款。', 0, '/home/my-book-savant', 1, '2016-06-25 11:14:15', '2016-06-25 11:14:15'),
	(48, 8, 3, 42, '评论回复', '有人回复了你的评论!', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-25 11:21:09', '2016-06-25 11:21:09'),
	(49, 8, 3, 43, '评论回复', '有人回复了你的评论!', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-25 11:21:15', '2016-06-25 11:21:15'),
	(50, 7, 4, 12, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-06-25 11:51:17', '2016-06-25 11:51:17'),
	(51, 10, 4, 12, '预约通知', '您预约的话题：《测试话题》已确认通过，请及时登录平台支付预约款。', 0, '/home/my-book-savant', 1, '2016-06-25 11:52:17', '2016-06-25 11:52:17'),
	(52, 10, 4, 12, '预约通知', '您预约的话题：《测试话题》已确认通过，请及时登录平台支付预约款。', 0, '/home/my-book-savant', 1, '2016-06-25 11:52:19', '2016-06-25 11:52:19'),
	(53, 10, 4, 12, '预约通知', '您预约的话题：《测试话题》已确认通过，请及时登录平台支付预约款。', 0, '/home/my-book-savant', 1, '2016-06-25 11:52:26', '2016-06-25 11:52:26'),
	(54, 7, 4, 13, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-06-25 12:10:39', '2016-06-25 12:10:39'),
	(55, 8, 4, 14, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-06-25 12:22:46', '2016-06-25 12:22:46'),
	(56, 15, 4, 14, '预约通知', '您预约的话题：《测试话题》已确认通过，请及时登录平台支付预约款。', 0, '/home/my-book-savant', 1, '2016-06-25 12:24:03', '2016-06-25 12:24:03'),
	(57, 7, 4, 15, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-06-25 12:33:41', '2016-06-25 12:33:41'),
	(58, 15, 4, 15, '预约通知', '您预约的话题：《测试话题》已确认通过，请及时登录平台支付预约款。', 0, '/home/my-book-savant', 1, '2016-06-25 12:34:03', '2016-06-25 12:34:03'),
	(59, 8, 4, 13, '预约通知', '您预约的话题：《测试话题》已确认通过，请及时登录平台支付预约款。', 0, '/home/my-book-savant', 1, '2016-06-25 12:34:31', '2016-06-25 12:34:31'),
	(60, 11, 3, 45, '评论回复', '有人回复了你的评论!', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-25 14:24:46', '2016-06-25 14:24:46'),
	(61, 8, 4, 16, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-06-25 14:34:41', '2016-06-25 14:34:41'),
	(62, 10, 4, 16, '预约通知', '您预约的话题：《测试话题》已确认通过，请及时登录平台支付预约款。', 0, '/home/my-book-savant', 1, '2016-06-25 14:49:39', '2016-06-25 14:49:39'),
	(63, 7, 4, 17, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-06-25 14:59:25', '2016-06-25 14:59:25'),
	(64, 8, 4, 18, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-06-25 15:00:54', '2016-06-25 15:00:54'),
	(65, 9, 4, 18, '预约通知', '您预约的话题：《互联网开发讲座》已确认通过，请及时登录平台支付预约款。', 0, '/home/my-book-savant', 1, '2016-06-25 15:01:00', '2016-06-25 15:01:00'),
	(66, 7, 4, 19, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-06-25 15:18:27', '2016-06-25 15:18:27'),
	(67, 8, 4, 19, '预约通知', '您预约的话题：《测试话题》已确认通过，请及时登录平台支付预约款。', 0, '/home/my-book-savant', 1, '2016-06-25 15:19:39', '2016-06-25 15:19:39'),
	(68, 10, 3, 48, '评论回复', '有人回复了你的评论!', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-25 20:32:41', '2016-06-25 20:32:41'),
	(69, 10, 3, 50, '评论回复', '有人回复了你的评论!', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-25 20:34:53', '2016-06-25 20:34:53'),
	(70, 10, 3, 51, '评论回复', '有人回复了你的评论!', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-25 20:35:02', '2016-06-25 20:35:02'),
	(71, 10, 3, 52, '评论回复', '有人回复了你的评论!', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-25 20:35:03', '2016-06-25 20:35:03'),
	(72, 10, 3, 53, '评论回复', '有人回复了你的评论!', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-25 20:35:03', '2016-06-25 20:35:03'),
	(73, 10, 3, 54, '评论回复', '有人回复了你的评论!', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-25 20:35:28', '2016-06-25 20:35:28'),
	(74, 9, 2, 21, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-26 10:59:56', '2016-06-26 10:59:56'),
	(75, 11, 2, 39, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-28 10:51:27', '2016-06-28 10:51:27'),
	(76, 7, 4, 20, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-06-28 10:57:43', '2016-06-28 10:57:43'),
	(77, 7, 4, 21, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-06-28 20:09:06', '2016-06-28 20:09:06'),
	(78, 8, 4, 22, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-06-28 20:10:58', '2016-06-28 20:10:58'),
	(79, 10, 2, 18, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-28 22:25:19', '2016-06-28 22:25:19'),
	(80, 11, 2, 20, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-28 22:30:00', '2016-06-28 22:30:00'),
	(81, 10, 2, 60, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-29 17:57:31', '2016-06-29 17:57:31'),
	(82, 10, 3, 62, '评论回复', '有人回复了你的评论!', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-29 17:57:48', '2016-06-29 17:57:48'),
	(83, 19, 2, 62, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-29 19:54:45', '2016-06-29 19:54:45'),
	(84, 17, 2, 61, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-29 19:54:50', '2016-06-29 19:54:50'),
	(85, 10, 2, 60, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-29 19:54:53', '2016-06-29 19:54:53'),
	(86, 10, 2, 49, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-29 19:54:58', '2016-06-29 19:54:58'),
	(87, 10, 2, 47, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-29 19:55:01', '2016-06-29 19:55:01'),
	(88, 10, 2, 63, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-29 20:35:53', '2016-06-29 20:35:53'),
	(89, 10, 2, 60, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-29 20:59:51', '2016-06-29 20:59:51'),
	(90, 10, 2, 64, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-30 11:32:09', '2016-06-30 11:32:09'),
	(91, 10, 2, 63, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-30 11:33:59', '2016-06-30 11:33:59'),
	(92, 11, 2, 20, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-30 11:34:52', '2016-06-30 11:34:52'),
	(93, 10, 2, 26, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-30 11:41:59', '2016-06-30 11:41:59'),
	(94, 7, 4, 23, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-06-30 11:57:42', '2016-06-30 11:57:42'),
	(95, 10, 2, 64, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-30 13:22:48', '2016-06-30 13:22:48'),
	(96, 10, 3, 65, '评论回复', '有人回复了你的评论!', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-30 13:23:16', '2016-06-30 13:23:16'),
	(97, 19, 2, 65, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-30 15:21:08', '2016-06-30 15:21:08'),
	(98, 10, 2, 46, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-30 20:09:06', '2016-06-30 20:09:06'),
	(99, 9, 2, 21, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-07-01 12:11:08', '2016-07-01 12:11:08'),
	(100, 11, 2, 28, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-07-01 12:13:01', '2016-07-01 12:13:01'),
	(101, 19, 2, 65, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 0, '2016-07-01 16:43:47', '2016-07-01 16:43:47'),
	(102, 7, 4, 24, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-01 21:34:17', '2016-07-01 21:34:17'),
	(103, 10, 2, 26, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-07-01 22:36:33', '2016-07-01 22:36:33'),
	(104, 19, 2, 65, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 0, '2016-07-01 23:08:56', '2016-07-01 23:08:56'),
	(105, 10, 2, 64, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-07-04 09:29:42', '2016-07-04 09:29:42'),
	(106, 9, 2, 21, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-07-04 19:51:49', '2016-07-04 19:51:49'),
	(107, 10, 2, 66, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-07-04 20:01:05', '2016-07-04 20:01:05'),
	(108, 7, 2, 31, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-07-05 10:33:08', '2016-07-05 10:33:08'),
	(109, 7, 2, 30, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-07-05 10:33:10', '2016-07-05 10:33:10'),
	(110, 7, 4, 25, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-05 17:18:03', '2016-07-05 17:18:03'),
	(111, 17, 4, 25, '预约通知', '您预约的话题：《互联网开发讲座》已确认通过，请及时登录平台支付预约款。', 0, '/home/my-book-savant', 1, '2016-07-05 17:19:05', '2016-07-05 17:19:05'),
	(112, 17, 4, 25, '预约通知', '您的预约未被通过', 0, '/home/my-book-savant', 1, '2016-07-05 17:19:05', '2016-07-05 17:19:05'),
	(113, 17, 4, 26, '话题预约', '您有新的话题预约请求', 0, '', 1, '2016-07-05 18:09:21', '2016-07-05 18:09:21'),
	(114, 19, 4, 26, '预约通知', '您预约的话题：《吃》已确认通过，请及时登录平台支付预约款。', 0, '', 0, '2016-07-05 18:11:41', '2016-07-05 18:11:41'),
	(115, 17, 2, 61, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/#allcoment#common_61', 0, '2016-07-05 18:28:27', '2016-07-05 18:28:27'),
	(116, 19, 2, 62, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/#allcoment#common_62', 0, '2016-07-05 18:29:03', '2016-07-05 18:29:03'),
	(117, 10, 2, 63, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/#allcoment#common_63', 1, '2016-07-05 18:29:23', '2016-07-05 18:29:23'),
	(118, 10, 2, 49, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/#allcoment#common_49', 1, '2016-07-05 18:29:42', '2016-07-05 18:29:42'),
	(119, 19, 2, 62, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/29#allcoment#common_62', 0, '2016-07-05 20:20:28', '2016-07-05 20:20:28'),
	(120, 19, 2, 65, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/19#allcoment#common_65', 0, '2016-07-05 20:21:02', '2016-07-05 20:21:02'),
	(121, 10, 3, 67, '评论回复', '有人回复了你的评论!', 0, '/news/view/29#allcoment#common_67', 1, '2016-07-05 20:55:29', '2016-07-05 20:55:29'),
	(122, 11, 4, 24, '预约通知', '您预约的话题：《互联网开发讲座》已确认通过，请及时登录平台支付预约款。', 0, '', 1, '2016-07-05 22:13:02', '2016-07-05 22:13:02'),
	(123, 7, 2, 68, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/31#allcoment#common_68', 1, '2016-07-05 22:14:21', '2016-07-05 22:14:21'),
	(124, 7, 1, 26, '您有新的关注者', '', 0, '', 1, '2016-07-05 22:39:39', '2016-07-05 22:39:39'),
	(125, 7, 2, 36, '您有新的点赞', '您的评论获得新的点赞', 0, '/activity/view/10#allcoment#common_36', 1, '2016-07-06 10:02:43', '2016-07-06 10:02:43'),
	(126, 11, 2, 28, '您有新的点赞', '您的评论获得新的点赞', 0, '/activity/view/10#allcoment#common_28', 1, '2016-07-06 10:02:45', '2016-07-06 10:02:45'),
	(127, 17, 2, 61, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/29#allcoment#common_61', 0, '2016-07-06 10:22:38', '2016-07-06 10:22:38'),
	(128, 10, 2, 49, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/29#allcoment#common_49', 1, '2016-07-06 10:22:41', '2016-07-06 10:22:41'),
	(129, 10, 2, 47, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/29#allcoment#common_47', 1, '2016-07-06 10:22:42', '2016-07-06 10:22:42'),
	(130, 7, 2, 71, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/30#allcoment#common_71', 1, '2016-07-06 12:03:59', '2016-07-06 12:03:59'),
	(131, 10, 4, 27, '话题预约', '您有新的话题预约请求', 0, '', 1, '2016-07-06 12:22:25', '2016-07-06 12:22:25'),
	(132, 7, 4, 27, '预约通知', '您预约的话题：《中型网络开发》已确认通过，请及时登录平台支付预约款。', 0, '', 1, '2016-07-06 12:24:03', '2016-07-06 12:24:03'),
	(133, 7, 4, 27, '预约通知', '您预约的话题：《中型网络开发》已确认通过，请及时登录平台支付预约款。', 0, '', 1, '2016-07-06 12:24:04', '2016-07-06 12:24:04'),
	(134, 7, 4, 28, '话题预约', '您有新的话题预约请求', 0, '', 1, '2016-07-06 12:29:09', '2016-07-06 12:29:09'),
	(135, 15, 4, 28, '预约通知', '您预约的话题：《互联网开发讲座》已确认通过，请及时登录平台支付预约款。', 0, '', 1, '2016-07-06 12:29:21', '2016-07-06 12:29:21'),
	(136, 7, 4, 29, '话题预约', '您有新的话题预约请求', 0, '', 1, '2016-07-06 12:29:34', '2016-07-06 12:29:34'),
	(137, 10, 2, 45, '您有新的点赞', '您的评论获得新的点赞', 0, '/activity/view/10#allcoment#common_45', 1, '2016-07-06 17:28:23', '2016-07-06 17:28:23'),
	(138, 10, 2, 44, '您有新的点赞', '您的评论获得新的点赞', 0, '/activity/view/10#allcoment#common_44', 1, '2016-07-06 17:28:25', '2016-07-06 17:28:25'),
	(139, 10, 4, 30, '话题预约', '您有新的话题预约请求', 0, '', 1, '2016-07-06 18:32:25', '2016-07-06 18:32:25'),
	(140, 9, 1, 27, '您有新的关注者', '', 0, '', 0, '2016-07-06 21:21:47', '2016-07-06 21:21:47'),
	(141, 10, 2, 66, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/30#allcoment#common_66', 1, '2016-07-06 21:57:16', '2016-07-06 21:57:16'),
	(142, 10, 4, 31, '话题预约', '您有新的话题预约请求', 0, '', 1, '2016-07-06 21:57:57', '2016-07-06 21:57:57'),
	(143, 7, 4, 32, '话题预约', '您有新的话题预约请求', 0, '', 1, '2016-07-06 21:58:35', '2016-07-06 21:58:35'),
	(144, 21, 4, 32, '预约通知', '您预约的话题：《互联网开发讲座》已确认通过，请及时登录平台支付预约款。', 0, '', 1, '2016-07-06 22:01:39', '2016-07-06 22:01:39'),
	(145, 21, 4, 32, '预约通知', '您预约的话题：《互联网开发讲座》已确认通过，请及时登录平台支付预约款。', 0, '', 1, '2016-07-06 22:01:40', '2016-07-06 22:01:40'),
	(146, 17, 1, 28, '您有新的关注者', '', 0, '', 0, '2016-07-06 22:28:43', '2016-07-06 22:28:43'),
	(147, 17, 3, 74, '评论回复', '有人回复了你的评论!', 0, '/news/view/29#allcoment#common_74', 0, '2016-07-06 22:30:30', '2016-07-06 22:30:30'),
	(148, 10, 2, 69, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/31#allcoment#common_69', 1, '2016-07-07 17:52:34', '2016-07-07 17:52:34'),
	(149, 10, 4, 33, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-07 19:49:26', '2016-07-07 19:49:26'),
	(150, 10, 4, 34, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-07 19:49:33', '2016-07-07 19:49:33'),
	(151, 10, 4, 35, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-07 19:49:48', '2016-07-07 19:49:48'),
	(152, 10, 4, 36, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-07 19:50:10', '2016-07-07 19:50:10'),
	(153, 7, 4, 37, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-07 19:52:03', '2016-07-07 19:52:03'),
	(154, 10, 4, 38, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-07 19:52:36', '2016-07-07 19:52:36'),
	(155, 7, 4, 39, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-07 19:52:52', '2016-07-07 19:52:52'),
	(156, 7, 4, 40, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-07 19:52:52', '2016-07-07 19:52:52'),
	(157, 7, 4, 41, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-07 19:53:08', '2016-07-07 19:53:08'),
	(158, 10, 4, 42, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-07 19:54:31', '2016-07-07 19:54:31'),
	(159, 10, 4, 43, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-07 19:54:58', '2016-07-07 19:54:58'),
	(160, 10, 4, 44, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-07 19:55:23', '2016-07-07 19:55:23'),
	(161, 10, 4, 45, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-07 19:55:36', '2016-07-07 19:55:36'),
	(162, 10, 4, 46, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-07 19:55:50', '2016-07-07 19:55:50'),
	(163, 10, 4, 47, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-07 19:56:13', '2016-07-07 19:56:13'),
	(164, 7, 4, 48, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-07 19:56:52', '2016-07-07 19:56:52'),
	(165, 7, 4, 49, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-07 19:57:09', '2016-07-07 19:57:09'),
	(166, 7, 4, 50, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-07 19:57:17', '2016-07-07 19:57:17'),
	(167, 7, 4, 51, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-07 19:57:22', '2016-07-07 19:57:22'),
	(168, 7, 4, 52, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-07 19:57:54', '2016-07-07 19:57:54'),
	(169, 7, 4, 53, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-07 19:58:30', '2016-07-07 19:58:30'),
	(170, 7, 4, 54, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-07 19:58:39', '2016-07-07 19:58:39'),
	(171, 7, 4, 55, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-07 19:59:56', '2016-07-07 19:59:56'),
	(172, 7, 4, 56, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-07 20:00:45', '2016-07-07 20:00:45'),
	(173, 7, 6, 9, '您有新的消息', '您有新的小秘书消息', 0, '/home/my-history-need', 1, '2016-07-07 20:02:29', '2016-07-07 20:02:29'),
	(174, 7, 6, 8, '您有新的消息', '您有新的小秘书消息', 0, '/home/my-history-need', 1, '2016-07-07 20:03:27', '2016-07-07 20:03:27'),
	(175, 7, 4, 57, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-07 20:03:47', '2016-07-07 20:03:47'),
	(176, 7, 4, 58, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-07 20:05:10', '2016-07-07 20:05:10'),
	(177, 10, 4, 59, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-07 20:08:13', '2016-07-07 20:08:13'),
	(178, 10, 4, 60, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-07 20:08:18', '2016-07-07 20:08:18'),
	(179, 7, 4, 61, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-07 20:09:11', '2016-07-07 20:09:11'),
	(180, 10, 4, 61, '预约通知', '您的预约未被通过', 0, '/home/my-book-savant', 1, '2016-07-07 20:14:11', '2016-07-07 20:14:11'),
	(181, 15, 4, 58, '预约通知', '您预约的话题：《互联网开发讲座》已确认通过，请及时登录平台支付预约款。', 0, '/home/my-book-savant', 1, '2016-07-07 20:14:20', '2016-07-07 20:14:20'),
	(182, 15, 4, 57, '预约通知', '您预约的话题：《测试话题》已确认通过，请及时登录平台支付预约款。', 0, '/home/my-book-savant', 1, '2016-07-07 20:14:30', '2016-07-07 20:14:30'),
	(183, 15, 4, 56, '预约通知', '您预约的话题：《测试话题》已确认通过，请及时登录平台支付预约款。', 0, '/home/my-book-savant', 1, '2016-07-07 20:15:08', '2016-07-07 20:15:08'),
	(184, 10, 1, 29, '您有新的关注者', '', 0, '/admin/user/index', 1, '2016-07-08 10:24:04', '2016-07-08 10:24:04'),
	(185, 11, 5, 6, '专家申请新消息', '您的专家申请审核通过啦！', 0, '/home/savant-auth', 1, '2016-07-08 10:39:30', '2016-07-08 10:39:30'),
	(186, 10, 3, 77, '评论回复', '有人回复了你的评论!', 0, '/news/view/31#allcoment#common_77', 1, '2016-07-08 11:02:46', '2016-07-08 11:02:46'),
	(187, 10, 5, 7, '专家申请新消息', '您的专家申请审核不通过！原因为：111', 0, '/home/savant-auth', 1, '2016-07-08 11:27:16', '2016-07-08 11:27:16'),
	(188, 7, 5, 5, '专家申请新消息', '您的专家申请审核不通过！原因为：566', 0, '/home/savant-auth', 1, '2016-07-08 11:27:31', '2016-07-08 11:27:31'),
	(189, 7, 5, 5, '专家申请新消息', '您的专家申请审核不通过！原因为：哦哦', 0, '/home/savant-auth', 1, '2016-07-08 11:27:57', '2016-07-08 11:27:57'),
	(190, 7, 5, 5, '专家申请新消息', '您的专家申请审核通过啦！', 0, '/home/savant-auth', 1, '2016-07-08 11:44:16', '2016-07-08 11:44:16'),
	(191, 7, 5, 5, '专家申请新消息', '您的专家申请审核不通过！原因为：1321', 0, '/home/savant-auth', 1, '2016-07-08 11:44:22', '2016-07-08 11:44:22'),
	(192, 7, 5, 5, '专家申请新消息', '您的专家申请审核通过啦！', 0, '/home/savant-auth', 1, '2016-07-08 11:45:00', '2016-07-08 11:45:00'),
	(193, 7, 2, 76, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/32#allcoment#common_76', 1, '2016-07-08 12:05:35', '2016-07-08 12:05:35'),
	(194, 7, 2, 77, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/31#allcoment#common_77', 1, '2016-07-08 12:07:44', '2016-07-08 12:07:44'),
	(195, 7, 2, 70, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/31#allcoment#common_70', 1, '2016-07-08 12:07:45', '2016-07-08 12:07:45'),
	(196, 10, 2, 69, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/31#allcoment#common_69', 1, '2016-07-08 12:08:02', '2016-07-08 12:08:02'),
	(197, 10, 2, 49, '您有新的点赞', '您的评论获得新的点赞', 0, '/activity/view/24#allcoment#common_49', 1, '2016-07-08 12:09:22', '2016-07-08 12:09:22'),
	(198, 7, 4, 62, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-08 15:33:40', '2016-07-08 15:33:40'),
	(199, 11, 5, 6, '专家申请新消息', '您的专家申请审核不通过！原因为：奋斗奋斗', 0, '/home/savant-auth', 1, '2016-07-08 15:38:15', '2016-07-08 15:38:15'),
	(200, 7, 5, 5, '专家申请新消息', '您的专家申请审核不通过！原因为：更符合规范', 0, '/home/savant-auth', 1, '2016-07-08 15:38:39', '2016-07-08 15:38:39'),
	(201, 7, 5, 5, '专家申请新消息', '您的专家申请审核通过啦！', 0, '/home/savant-auth', 1, '2016-07-08 15:39:15', '2016-07-08 15:39:15'),
	(202, 7, 4, 63, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-08 17:04:09', '2016-07-08 17:04:09'),
	(203, 7, 4, 64, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-08 17:04:55', '2016-07-08 17:04:55'),
	(204, 7, 4, 65, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-09 12:45:56', '2016-07-09 12:45:56'),
	(205, 9, 2, 21, '您有新的点赞', '您的评论获得新的点赞', 0, '/activity/view/16#allcoment#common_21', 0, '2016-07-09 13:02:52', '2016-07-09 13:02:52'),
	(206, 14, 2, 79, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/32#allcoment#common_79', 0, '2016-07-09 21:10:46', '2016-07-09 21:10:46'),
	(207, 14, 2, 50, '您有新的点赞', '您的评论获得新的点赞', 0, '/activity/view/24#allcoment#common_50', 0, '2016-07-11 10:30:33', '2016-07-11 10:30:33'),
	(208, 14, 3, 80, '评论回复', '有人回复了你的评论!', 0, '/news/view/32#allcoment#common_80', 0, '2016-07-11 10:31:27', '2016-07-11 10:31:27'),
	(209, 10, 2, 73, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/29#allcoment#common_73', 1, '2016-07-11 11:17:06', '2016-07-11 11:17:06'),
	(210, 10, 3, 81, '评论回复', '有人回复了你的评论!', 0, '/news/view/29#allcoment#common_81', 1, '2016-07-11 11:17:18', '2016-07-11 11:17:18'),
	(211, 25, 2, 81, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/29#allcoment#common_81', 1, '2016-07-11 11:17:25', '2016-07-11 11:17:25'),
	(212, 2, 2, 75, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/29#allcoment#common_75', 1, '2016-07-11 11:17:30', '2016-07-11 11:17:30'),
	(213, 10, 2, 72, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/29#allcoment#common_72', 1, '2016-07-11 12:56:06', '2016-07-11 12:56:06'),
	(214, 10, 2, 63, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/29#allcoment#common_63', 1, '2016-07-11 12:56:20', '2016-07-11 12:56:20'),
	(215, 10, 1, 30, '您有新的关注者', '', 0, '/admin/user/index', 1, '2016-07-11 13:02:10', '2016-07-11 13:02:10'),
	(216, 14, 2, 79, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/32#allcoment#common_79', 0, '2016-07-11 15:29:47', '2016-07-11 15:29:47'),
	(217, 14, 2, 79, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/32#allcoment#common_79', 0, '2016-07-11 15:30:00', '2016-07-11 15:30:00'),
	(218, 14, 1, 31, '您有新的关注者', '', 0, '/admin/user/index', 0, '2016-07-11 15:31:32', '2016-07-11 15:31:32'),
	(219, 14, 3, 82, '评论回复', '有人回复了你的评论!', 0, '/news/view/32#allcoment#common_82', 0, '2016-07-11 15:34:30', '2016-07-11 15:34:30'),
	(220, 10, 3, 83, '评论回复', '有人回复了你的评论!', 0, '/news/view/29#allcoment#common_83', 1, '2016-07-11 15:34:47', '2016-07-11 15:34:47'),
	(221, 7, 2, 52, '您有新的点赞', '您的评论获得新的点赞', 0, '/activity/view/24#allcoment#common_52', 1, '2016-07-11 15:41:49', '2016-07-11 15:41:49'),
	(222, 10, 2, 78, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/31#allcoment#common_78', 1, '2016-07-11 15:51:21', '2016-07-11 15:51:21'),
	(223, 7, 4, 66, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-11 16:22:14', '2016-07-11 16:22:14'),
	(224, 7, 4, 67, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-11 16:55:35', '2016-07-11 16:55:35'),
	(225, 10, 1, 32, '您有新的关注者', '', 0, '/admin/user/index', 1, '2016-07-11 16:55:53', '2016-07-11 16:55:53'),
	(226, 14, 1, 33, '您有新的关注者', '', 0, '/admin/user/index', 0, '2016-07-11 17:11:29', '2016-07-11 17:11:29'),
	(227, 10, 4, 68, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 1, '2016-07-11 19:44:52', '2016-07-11 19:44:52'),
	(228, 7, 4, 69, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 0, '2016-07-12 12:32:34', '2016-07-12 12:32:34'),
	(229, 10, 1, 34, '您有新的关注者', '', 0, '/admin/user/index', 1, '2016-07-12 14:13:13', '2016-07-12 14:13:13'),
	(230, 15, 2, 46, '您有新的点赞', '您的评论获得新的点赞', 0, '/activity/view/20#allcoment#common_46', 0, '2016-07-12 15:32:45', '2016-07-12 15:32:45'),
	(231, 2, 2, 47, '您有新的点赞', '您的评论获得新的点赞', 0, '/activity/view/20#allcoment#common_47', 0, '2016-07-12 15:32:47', '2016-07-12 15:32:47'),
	(232, 2, 2, 48, '您有新的点赞', '您的评论获得新的点赞', 0, '/activity/view/20#allcoment#common_48', 0, '2016-07-12 15:32:48', '2016-07-12 15:32:48'),
	(233, 15, 4, 68, '预约通知', '您预约的话题：《中型网络开发》已确认通过，请及时登录平台支付预约款。', 0, '/home/my-book-savant', 0, '2016-07-12 16:20:11', '2016-07-12 16:20:11'),
	(234, 21, 5, 21, '专家申请新消息', '您的专家申请审核不通过！原因为：just a reason', 0, '/home/savant-auth', 0, '2016-08-03 10:37:25', '2016-08-03 10:37:25'),
	(235, 21, 5, 21, '专家申请新消息', '您的专家申请审核不通过！原因为：just a reason', 0, '/home/savant-auth', 0, '2016-08-03 10:37:36', '2016-08-03 10:37:36'),
	(236, 21, 5, 21, '专家申请新消息', '您的专家申请审核不通过！原因为：你这有点扯啊', 0, '/home/savant-auth', 0, '2016-08-03 11:43:26', '2016-08-03 11:43:26'),
	(237, 21, 5, 21, '专家申请新消息', '您的专家申请审核不通过！原因为：又扯淡了吧', 0, '/home/savant-auth', 0, '2016-08-03 11:46:22', '2016-08-03 11:46:22'),
	(238, 21, 5, 21, '专家申请新消息', '您的专家申请审核不通过！原因为：还扯淡呢', 0, '/home/savant-auth', 0, '2016-08-03 11:58:40', '2016-08-03 11:58:40'),
	(239, 11, 6, 6, '您有新的消息', '您有新的小秘书消息', 0, '/home/my-history-need', 0, '2016-08-03 20:45:26', '2016-08-03 20:45:26'),
	(240, 10, 6, 19, '您有新的消息', '您有新的小秘书消息', 0, '/home/my-history-need', 0, '2016-08-03 21:20:33', '2016-08-03 21:20:33'),
	(241, 8, 7, 38, '报名通知', '您报名的活动：《hello world》已确认通过，请及时登录平台支付报名费用。', 0, '/home/my_activity_submit', 1, '2016-08-04 14:39:50', '2016-08-04 14:39:50'),
	(242, 8, 11, 32, '活动报名消息', '您报名的活动"美队2冬日战士上映已审核通过', 0, '/activity/details/39', 0, '2016-08-04 17:18:12', '2016-08-04 17:18:12'),
	(243, 8, 11, 32, '活动报名消息', '您报名的活动"美队2冬日战士上映已审核通过', 0, '/activity/details/39', 0, '2016-08-04 18:36:39', '2016-08-04 18:36:39'),
	(244, 8, 10, 10, '提现消息', '您的体现审核不通过！原因为：什么银行', 0, '/home/my-purse', 0, '2016-08-06 11:42:26', '2016-08-06 11:42:26'),
	(245, 7, 6, 20, '您有新的消息', '您有新的小秘书消息', 0, '/home/my-xiaomi', 0, '2016-08-17 15:28:39', '2016-08-17 15:28:39'),
	(246, 8, 7, 43, '报名通知', '您报名的活动：《传统企业的改革之路》已确认通过，请及时登录平台支付报名费用。', 0, '/home/my_activity_submit', 1, '2016-08-19 14:16:34', '2016-08-19 14:16:34');
/*!40000 ALTER TABLE `usermsg` ENABLE KEYS */;


-- 导出  表 binggq.user_fans 结构
CREATE TABLE IF NOT EXISTS `user_fans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '关注者',
  `following_id` int(11) NOT NULL COMMENT '被关注者',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1,单向关注2互为关注',
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COMMENT='用户关系表';

-- 正在导出表  binggq.user_fans 的数据：~22 rows (大约)
DELETE FROM `user_fans`;
/*!40000 ALTER TABLE `user_fans` DISABLE KEYS */;
INSERT INTO `user_fans` (`id`, `user_id`, `following_id`, `type`, `create_time`, `update_time`) VALUES
	(10, 8, 7, 2, '2016-05-18 10:51:51', '2016-05-18 10:51:51'),
	(11, 7, 8, 2, '2016-05-18 10:51:51', '2016-05-18 10:51:51'),
	(12, 10, 7, 1, '2016-06-22 10:15:03', '2016-07-11 16:56:00'),
	(13, 7, 7, 1, '2016-06-25 11:21:49', '2016-06-25 11:21:49'),
	(14, 10, 8, 1, '2016-06-25 11:37:00', '2016-06-25 11:37:00'),
	(15, 10, 13, 1, '2016-06-25 20:23:58', '2016-06-25 20:23:58'),
	(16, 10, 2, 2, '2016-06-28 22:29:11', '2016-07-01 17:12:05'),
	(17, 17, 7, 1, '2016-06-29 17:28:30', '2016-06-29 17:28:30'),
	(18, 19, 10, 2, '2016-06-30 15:18:48', '2016-07-01 16:44:01'),
	(19, 11, 10, 1, '2016-07-01 14:04:36', '2016-07-01 14:04:36'),
	(20, 11, 7, 1, '2016-07-01 15:07:49', '2016-07-11 10:24:37'),
	(21, 10, 19, 2, '2016-07-01 16:44:01', '2016-07-01 16:44:01'),
	(22, 2, 10, 2, '2016-07-01 17:12:05', '2016-07-01 17:12:05'),
	(23, 11, 19, 1, '2016-07-01 23:09:06', '2016-07-01 23:09:06'),
	(25, 18, 11, 1, '2016-07-05 17:22:21', '2016-07-05 17:22:21'),
	(26, 18, 7, 1, '2016-07-05 22:39:39', '2016-07-05 22:39:39'),
	(27, 7, 9, 1, '2016-07-06 21:21:47', '2016-07-06 21:21:47'),
	(28, 10, 17, 1, '2016-07-06 22:28:43', '2016-07-06 22:28:43'),
	(30, 26, 10, 1, '2016-07-11 13:02:10', '2016-07-11 13:02:10'),
	(31, 24, 14, 1, '2016-07-11 15:31:32', '2016-07-11 15:31:32'),
	(33, 21, 14, 1, '2016-07-11 17:11:29', '2016-07-11 17:11:29'),
	(34, 15, 10, 1, '2016-07-12 14:13:13', '2016-07-12 14:13:13');
/*!40000 ALTER TABLE `user_fans` ENABLE KEYS */;


-- 导出  表 binggq.user_industry 结构
CREATE TABLE IF NOT EXISTS `user_industry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `industry_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 COMMENT='用户行业标签';

-- 正在导出表  binggq.user_industry 的数据：~4 rows (大约)
DELETE FROM `user_industry`;
/*!40000 ALTER TABLE `user_industry` DISABLE KEYS */;
INSERT INTO `user_industry` (`id`, `user_id`, `industry_id`) VALUES
	(67, 34, 17),
	(68, 35, 15),
	(69, 35, 17),
	(70, 35, 19);
/*!40000 ALTER TABLE `user_industry` ENABLE KEYS */;


-- 导出  表 binggq.withdraw 结构
CREATE TABLE IF NOT EXISTS `withdraw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '对象id',
  `amount` float NOT NULL DEFAULT '0' COMMENT '提现金额',
  `cardno` varchar(50) NOT NULL COMMENT '银行卡号',
  `bank` varchar(50) NOT NULL COMMENT '银行',
  `truename` varchar(50) NOT NULL COMMENT '持卡人姓名',
  `fee` float NOT NULL DEFAULT '0' COMMENT '手续费',
  `remark` varchar(200) NOT NULL DEFAULT '' COMMENT '备注',
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '操作者id',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态,0未审核，1审核通过2,审核不通过',
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='提现表';

-- 正在导出表  binggq.withdraw 的数据：~5 rows (大约)
DELETE FROM `withdraw`;
/*!40000 ALTER TABLE `withdraw` DISABLE KEYS */;
INSERT INTO `withdraw` (`id`, `user_id`, `amount`, `cardno`, `bank`, `truename`, `fee`, `remark`, `admin_id`, `status`, `create_time`, `update_time`) VALUES
	(7, 21, 1000, '1263198991312', '平安银行', '曹文鹏', 0, '0', 0, 1, '2016-07-27 14:20:59', '2016-07-27 16:29:42'),
	(8, 21, 200, '123129o-12u4-12930033300390', '建设银行', '曹文鹏', 0, '银行卡错了啊！', 0, 2, '2016-07-27 16:52:34', '2016-07-27 16:53:22'),
	(9, 21, 100, '120312312312', '农行', '曹文鹏', 0, '', 2, 1, '2016-07-27 16:54:41', '2016-07-27 17:04:54'),
	(10, 8, 124, '124', '123', '曹文鹏', 0, '什么银行', 0, 2, '2016-08-06 11:41:59', '2016-08-06 11:42:26'),
	(11, 8, 100, '421', '1231', '曹文鹏', 0, '', 0, 0, '2016-08-06 11:51:54', '2016-08-06 11:51:54');
/*!40000 ALTER TABLE `withdraw` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
