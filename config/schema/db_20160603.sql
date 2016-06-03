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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 CHECKSUM=1 ROW_FORMAT=DYNAMIC COMMENT='后台操作日志表';

-- 正在导出表  binggq.actionlog 的数据：~24 rows (大约)
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
	(32, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-02 18:29:53'),
	(33, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-06-02 18:30:50');
/*!40000 ALTER TABLE `actionlog` ENABLE KEYS */;


-- 导出  表 binggq.activity 结构
CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '活动表',
  `admin_id` int(10) NOT NULL COMMENT '作者id',
  `user_id` int(10) NOT NULL COMMENT '用户id',
  `publisher` varchar(50) NOT NULL COMMENT '作者姓名',
  `industry_id` int(10) NOT NULL COMMENT '标签id',
  `company` varchar(100) NOT NULL COMMENT '主办单位',
  `title` varchar(150) NOT NULL COMMENT '活动名称',
  `time` varchar(50) NOT NULL COMMENT '活动时间（3.2~4.1）',
  `address` varchar(150) NOT NULL COMMENT '地点',
  `scale` varchar(50) NOT NULL COMMENT '规模',
  `read_nums` int(11) DEFAULT NULL COMMENT '阅读数',
  `praise_nums` int(11) DEFAULT NULL COMMENT '点赞数',
  `comment_nums` int(11) DEFAULT NULL COMMENT '评论数',
  `cover` varchar(250) DEFAULT NULL COMMENT '封面',
  `body` text COMMENT '活动内容',
  `summary` varchar(250) DEFAULT NULL COMMENT '摘要',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `apply_nums` int(11) DEFAULT '0' COMMENT '报名人数',
  `apply_fee` int(11) DEFAULT '0' COMMENT '报名费用',
  `is_crowdfunding` tinyint(2) DEFAULT '0' COMMENT '是否众筹活动',
  `is_check` tinyint(2) DEFAULT '0' COMMENT '是否审核，0：未审核；1：发布；2：未通过审核',
  PRIMARY KEY (`id`),
  KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='活动表';

-- 正在导出表  binggq.activity 的数据：~1 rows (大约)
DELETE FROM `activity`;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
INSERT INTO `activity` (`id`, `admin_id`, `user_id`, `publisher`, `industry_id`, `company`, `title`, `time`, `address`, `scale`, `read_nums`, `praise_nums`, `comment_nums`, `cover`, `body`, `summary`, `create_time`, `update_time`, `apply_nums`, `apply_fee`, `is_crowdfunding`, `is_check`) VALUES
	(6, 2, 8, '曹麦穗', 5, '柠檬智慧科技', 'E店通', '2016-09-09 12:00-13:00', '福田上沙3', '500人', 1, NULL, NULL, '/upload/activity/2016-04-21/571878d1d6f5f.jpg', '<p>活动介绍：</p><p><br/></p><p><br/></p><p>活动流程：</p><p><br/></p><p><br/></p><p>参与嘉宾：</p><p><br/></p><p><br/></p><p>联系方式：<br/></p>', '交流会啊', '2016-04-21 14:53:10', '2016-05-12 17:21:57', 0, 0, 0, 0);
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;


-- 导出  表 binggq.activityapply 结构
CREATE TABLE IF NOT EXISTS `activityapply` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '活动申请表',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `activity_id` int(11) NOT NULL COMMENT '活动id',
  `create_time` datetime NOT NULL COMMENT '提交时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  `is_pass` tinyint(4) DEFAULT '0' COMMENT '审核是否通过',
  `is_top` tinyint(4) DEFAULT '0' COMMENT '是否置顶',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='活动申请表';

-- 正在导出表  binggq.activityapply 的数据：~0 rows (大约)
DELETE FROM `activityapply`;
/*!40000 ALTER TABLE `activityapply` DISABLE KEYS */;
/*!40000 ALTER TABLE `activityapply` ENABLE KEYS */;


-- 导出  表 binggq.activitycom 结构
CREATE TABLE IF NOT EXISTS `activitycom` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '活动评论表',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `activity_id` int(11) NOT NULL COMMENT '活动id',
  `body` varchar(550) NOT NULL COMMENT '评论内容',
  `praise_nums` int(11) DEFAULT '0' COMMENT '点赞数',
  `create_time` datetime NOT NULL COMMENT '评论时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='活动评论表';

-- 正在导出表  binggq.activitycom 的数据：~0 rows (大约)
DELETE FROM `activitycom`;
/*!40000 ALTER TABLE `activitycom` DISABLE KEYS */;
/*!40000 ALTER TABLE `activitycom` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='管理员表';

-- 正在导出表  binggq.admin 的数据：~1 rows (大约)
DELETE FROM `admin`;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `username`, `truename`, `password`, `phone`, `enabled`, `ctime`, `utime`, `login_time`, `login_ip`) VALUES
	(2, 'admin', '曹麦穗', '$2y$10$IwMcx3dYp7Sn.TPgovzc9Osem.XpMAdajZ1C.Z8y41LHcdcJUpCRy', '', 1, '2016-04-11 16:53:37', '2016-06-02 18:30:50', '2016-06-02 18:30:50', '127.0.0.1');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='后台系统消息';

-- 正在导出表  binggq.adminmsg 的数据：~2 rows (大约)
DELETE FROM `adminmsg`;
/*!40000 ALTER TABLE `adminmsg` DISABLE KEYS */;
INSERT INTO `adminmsg` (`id`, `type`, `table_id`, `msg`, `status`, `create_time`, `update_time`) VALUES
	(1, 1, 8, '您有一条实名认证申请需处理', 1, '2016-05-13 15:23:08', '2016-05-13 15:23:08'),
	(2, 1, 8, '您有一条专家认证申请需处理', 1, '2016-05-13 17:30:57', '2016-05-13 17:30:57'),
	(3, 1, 8, '您有一条专家认证申请需处理', 2, '2016-05-13 17:33:48', '2016-05-13 18:41:07');
/*!40000 ALTER TABLE `adminmsg` ENABLE KEYS */;


-- 导出  表 binggq.admin_group 结构
CREATE TABLE IF NOT EXISTS `admin_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL COMMENT '管理员',
  `group_id` int(11) NOT NULL COMMENT '所属组',
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_id` (`admin_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='管理员群组';

-- 正在导出表  binggq.admin_group 的数据：~0 rows (大约)
DELETE FROM `admin_group`;
/*!40000 ALTER TABLE `admin_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_group` ENABLE KEYS */;


-- 导出  表 binggq.agency 结构
CREATE TABLE IF NOT EXISTS `agency` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '行业标签',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='机构标签库';

-- 正在导出表  binggq.agency 的数据：~25 rows (大约)
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
	(28, 4, '想融资');
/*!40000 ALTER TABLE `agency` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='轮播图';

-- 正在导出表  binggq.banner 的数据：~3 rows (大约)
DELETE FROM `banner`;
/*!40000 ALTER TABLE `banner` DISABLE KEYS */;
INSERT INTO `banner` (`id`, `type`, `img`, `url`, `remark`, `enabled`, `create_time`) VALUES
	(10, '1', '/webroot/upload/banner/2016-04-21/571890c6ddbdb.jpg', 'http://movie.douban.com/subject/1295644/', '不错的页面', 1, '2016-04-21 16:35:50'),
	(11, '1', '/upload/banner/2016-05-10/5731590f47ae4.webp', 'http://bgq.dev/news/view/4', '333', 1, '2016-05-10 11:48:07'),
	(12, '1', '/upload/banner/2016-05-10/57315a0135fec.webp', 'http://bgq.dev/news/view/5', '3333', 1, '2016-05-10 11:48:28'),
	(13, '1', '/upload/banner/2016-05-10/57315a13a9b5e.jpg', 'http://bgq.dev/news/view/5', '3333', 1, '2016-05-10 11:48:41');
/*!40000 ALTER TABLE `banner` ENABLE KEYS */;


-- 导出  表 binggq.career 结构
CREATE TABLE IF NOT EXISTS `career` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '工作经历',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户',
  `company` varchar(50) NOT NULL COMMENT '公司',
  `position` varchar(50) NOT NULL COMMENT '职位',
  `start_date` date NOT NULL COMMENT '开始日期',
  `end_date` date NOT NULL COMMENT '结束日期',
  `desc` text NOT NULL COMMENT '描述',
  `create_time` datetime NOT NULL COMMENT '创建日期',
  `update_time` datetime NOT NULL COMMENT '修改日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='工作经历';

-- 正在导出表  binggq.career 的数据：~0 rows (大约)
DELETE FROM `career`;
/*!40000 ALTER TABLE `career` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='点赞日志表';

-- 正在导出表  binggq.collect 的数据：~1 rows (大约)
DELETE FROM `collect`;
/*!40000 ALTER TABLE `collect` DISABLE KEYS */;
INSERT INTO `collect` (`id`, `user_id`, `relate_id`, `is_delete`, `type`, `create_time`, `update_time`) VALUES
	(4, 8, 18, 0, 1, '2016-05-23 20:33:29', '2016-05-23 20:50:00');
/*!40000 ALTER TABLE `collect` ENABLE KEYS */;


-- 导出  表 binggq.comment_like 结构
CREATE TABLE IF NOT EXISTS `comment_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论点赞表',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `relate_id` int(11) NOT NULL COMMENT '点赞相关id，例：活动id或者是资讯id',
  `type` tinyint(4) NOT NULL COMMENT '类型值：0：活动；1：资讯',
  `create_time` datetime NOT NULL COMMENT '点赞时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='评论点赞表';

-- 正在导出表  binggq.comment_like 的数据：~14 rows (大约)
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
	(19, 8, 23, 1, '2016-05-23 15:55:47');
/*!40000 ALTER TABLE `comment_like` ENABLE KEYS */;


-- 导出  表 binggq.education 结构
CREATE TABLE IF NOT EXISTS `education` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '教育经历表',
  `user_id` int(11) NOT NULL COMMENT '用户',
  `school` varchar(50) NOT NULL COMMENT '学校',
  `major` varchar(50) NOT NULL COMMENT '专业',
  `education` varchar(50) NOT NULL COMMENT '学历',
  `start_date` date NOT NULL COMMENT '开始日期',
  `end_date` date NOT NULL COMMENT '结束日期',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='教育经历';

-- 正在导出表  binggq.education 的数据：~0 rows (大约)
DELETE FROM `education`;
/*!40000 ALTER TABLE `education` DISABLE KEYS */;
/*!40000 ALTER TABLE `education` ENABLE KEYS */;


-- 导出  表 binggq.flow 结构
CREATE TABLE IF NOT EXISTS `flow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '交易类型',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '交易金额',
  `pre_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '交易前金额',
  `after_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '交易后金额',
  `status` tinyint(4) NOT NULL COMMENT '交易状态',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户资金流水';

-- 正在导出表  binggq.flow 的数据：~0 rows (大约)
DELETE FROM `flow`;
/*!40000 ALTER TABLE `flow` DISABLE KEYS */;
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

-- 正在导出表  binggq.group 的数据：~0 rows (大约)
DELETE FROM `group`;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
INSERT INTO `group` (`id`, `name`, `remark`, `ctime`, `utime`) VALUES
	(1, 'test', '3333', '2016-05-05 19:38:00', '2016-05-05 19:38:00'),
	(2, '444', '3333', '2016-05-10 19:39:00', '2016-05-10 19:39:00');
/*!40000 ALTER TABLE `group` ENABLE KEYS */;


-- 导出  表 binggq.group_menu 结构
CREATE TABLE IF NOT EXISTS `group_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL DEFAULT '0' COMMENT '群组',
  `menu_id` int(11) NOT NULL DEFAULT '0' COMMENT '权限',
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_id` (`group_id`,`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='群组权限';

-- 正在导出表  binggq.group_menu 的数据：~5 rows (大约)
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='行业标签库';

-- 正在导出表  binggq.industry 的数据：~17 rows (大约)
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
	(20, 5, '研发');
/*!40000 ALTER TABLE `industry` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='点赞日志表';

-- 正在导出表  binggq.like_logs 的数据：~0 rows (大约)
DELETE FROM `like_logs`;
/*!40000 ALTER TABLE `like_logs` DISABLE KEYS */;
INSERT INTO `like_logs` (`id`, `user_id`, `relate_id`, `msg`, `create_time`, `update_time`, `type`) VALUES
	(1, 8, 18, '进行了点赞', '2016-05-23 16:06:07', '2016-05-23 16:06:07', 1);
/*!40000 ALTER TABLE `like_logs` ENABLE KEYS */;


-- 导出  表 binggq.meet_subject 结构
CREATE TABLE IF NOT EXISTS `meet_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '专家id',
  `title` varchar(150) NOT NULL DEFAULT '' COMMENT '标题',
  `summary` varchar(550) NOT NULL DEFAULT '' COMMENT '简介',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '类型:1对1,2对多',
  `invite_time` varchar(50) NOT NULL COMMENT '约见时间',
  `price` decimal(10,2) NOT NULL COMMENT '价格',
  `address` varchar(250) NOT NULL COMMENT '地址',
  `last_time` tinyint(4) NOT NULL DEFAULT '0' COMMENT '持续时间',
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='专家主题';

-- 正在导出表  binggq.meet_subject 的数据：~4 rows (大约)
DELETE FROM `meet_subject`;
/*!40000 ALTER TABLE `meet_subject` DISABLE KEYS */;
INSERT INTO `meet_subject` (`id`, `user_id`, `title`, `summary`, `type`, `invite_time`, `price`, `address`, `last_time`, `create_time`, `update_time`) VALUES
	(1, 8, '测试话题', '抓拍阿狗阿猫是个练习追焦的好办法，所以我相机包里会放一瓶狗粮用来犒劳模特和让模特保持注意力（之所以不是猫粮是因为我家养的是狗，不过流浪猫挺喜欢吃狗粮的）。\n\n照片中那个碗是邻居送来的红烧肉，小狗馋的的眼珠都像要掉', 2, '2015年5月20日15:00', 150.00, '深圳是福田区东海国际公寓', 1, '2016-05-16 15:22:47', '2016-05-16 15:22:47'),
	(2, 8, '互联网开发讲座', '呵呵我就是来扯淡的', 1, '2015年5月20日15:00', 200.00, '深圳是福田区东海国际公寓', 2, '2016-05-16 15:24:30', '2016-05-16 15:24:30'),
	(3, 7, '互联网开发讲座', '呵呵我就是来扯淡的', 1, '2015年5月20日15:00', 200.00, '深圳是福田区东海国际公寓', 2, '2016-05-16 15:24:30', '2016-05-16 15:24:30'),
	(4, 7, '测试话题', '抓拍阿狗阿猫是个练习追焦的好办法，所以我相机包里会放一瓶狗粮用来犒劳模特和让模特保持注意力（之所以不是猫粮是因为我家养的是狗，不过流浪猫挺喜欢吃狗粮的）。\n\n照片中那个碗是邻居送来的红烧肉，小狗馋的的眼珠都像要掉', 2, '2015年5月20日15:00', 150.00, '深圳是福田区东海国际公寓', 1, '2016-05-16 15:22:47', '2016-05-16 15:22:47');
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='菜单表';

-- 正在导出表  binggq.menu 的数据：~13 rows (大约)
DELETE FROM `menu`;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `name`, `node`, `pid`, `class`, `rank`, `is_menu`, `status`, `remark`) VALUES
	(1, '系统管理', '', 0, 'icon-cog', NULL, 1, 1, ''),
	(2, '菜单管理', '/admin/menu/index', 1, 'icon-align-justify', NULL, 1, 1, ''),
	(3, '行业标签管理', '/admin/industry/index', 1, 'icon-beaker', NULL, 1, 1, ''),
	(6, '机构标签管理', '/admin/agency/index', 1, 'icon-building', NULL, 1, 1, ''),
	(7, '机构标签添加', '/admin/agency/add', 6, '', NULL, 0, 1, ''),
	(10, '菜单添加', '/admin/menu/add', 2, '', NULL, 0, 1, '菜单添加'),
	(11, '用户管理', '', 0, 'icon-user', 3, 1, 1, ''),
	(12, '会员管理', '/admin/user/index', 11, 'icon-user', NULL, 1, 1, ''),
	(13, '资讯管理', '/admin/news/index', 14, 'icon-newspaper-o', NULL, 1, 1, ''),
	(14, '内容管理', '', 0, 'icon-newspaper-o', 2, 1, 1, ''),
	(15, '添加资讯', '/admin/news/add', 13, '', NULL, 0, 1, ''),
	(16, '活动管理', '/admin/activity/index', 14, 'icon-trophy', NULL, 1, 1, ''),
	(17, '轮播图管理', '/admin/banner/index', 14, 'icon-file-image', NULL, 1, 1, ''),
	(19, '融资项目管理', '/admin/projrong/index', 20, 'icon-cubes', NULL, 1, 1, ''),
	(20, '项目管理', '', 0, 'icon-diamond', 2, 1, 1, ''),
	(21, '消息中心', '/admin/adminmsg/index', 0, 'icon-tasks', -1, 0, 1, ''),
	(22, 'need管理', '/admin/need/index', 1, NULL, NULL, 1, 1, NULL),
	(23, '群组管理', '/wpadmin/group/index', 1, 'icon-group', NULL, 1, 1, ''),
	(24, '轮播图添加', '/admin/banner/add', 17, '', NULL, 0, 1, ''),
	(25, '添加行业标签', '/admin/industry/add', 3, '', NULL, 0, 1, ''),
	(26, '实名认证', '/admin/user/realname', 11, 'icon-eye-open', NULL, 1, 1, '');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;


-- 导出  表 binggq.need 结构
CREATE TABLE IF NOT EXISTS `need` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '小秘书',
  `user_id` int(11) NOT NULL COMMENT '用户',
  `msg` varchar(550) NOT NULL COMMENT '内容',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态0未读1已读',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='小秘书';

-- 正在导出表  binggq.need 的数据：~0 rows (大约)
DELETE FROM `need`;
/*!40000 ALTER TABLE `need` DISABLE KEYS */;
INSERT INTO `need` (`id`, `user_id`, `msg`, `status`, `create_time`, `update_time`) VALUES
	(1, 8, '4624623', 0, '2016-05-18 15:55:44', '2016-05-18 15:55:44');
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
  `summary` varchar(250) DEFAULT NULL COMMENT '摘要',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='咨询表';

-- 正在导出表  binggq.news 的数据：~18 rows (大约)
DELETE FROM `news`;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` (`id`, `admin_id`, `admin_name`, `title`, `read_nums`, `praise_nums`, `comment_nums`, `cover`, `body`, `summary`, `create_time`, `update_time`) VALUES
	(10, 2, '曹麦穗', '人们习以为常的事却其实在触犯自然法则', 2, 0, 0, '/upload/newscover/2016-05-11/57328fb168e83.jpg', '<p><strong style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">中國湖北 - 恩施土家族苗族自治州 - 鶴峰屏山大峽谷</strong><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">清澈見底的河上，船行上面尤如飄浮空中，泛舟河上，真可以體驗到世外桃源的幽靜！﻿</span></p><p><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">Wisely前陣子就曉得 ‪#‎Starbucks‬ ‪#‎星巴克‬ 即將在台北艋舺大道與西園路交叉口這一帶，在具有歷史背景意義的林家古宅開設 ‪#‎星巴克艋舺門市‬，而這也是繼「大稻埕保安門市」後，成為活化在地老宅的商業模式新型咖啡店！至目前為止，我覺得評價其實還挺兩極的，但至少就觀光的角度來看，起碼它吸引了不少人的目光…</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">連結：</span><a rel="nofollow" target="_blank" href="http://www.wiselyview.cc/read-23143.html" class="ot-anchor aaTEdf" jslog="10929; track:click" dir="ltr" style="-webkit-tap-highlight-color: transparent; text-decoration: none; color: rgb(41, 98, 255); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">http://www.wiselyview.cc/read-23143.html</a><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">臉書：</span><a rel="nofollow" target="_blank" href="https://www.facebook.com/wiselymood/" class="ot-anchor aaTEdf" jslog="10929; track:click" dir="ltr" style="-webkit-tap-highlight-color: transparent; text-decoration: none; color: rgb(41, 98, 255); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">https://www.facebook.com/wiselymood/</a><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">‪#‎台北‬ ‪#‎萬華區‬ ‪#‎捷運龍山寺站‬ ‪#‎咖啡‬ ‪#‎Wisely遊記</span></p>', '人们习以为常的事却其实在触犯自然法则', '2016-05-11 09:54:22', '2016-05-23 19:17:51'),
	(11, 2, '曹麦穗', 'G+就是爱旅行', 0, 0, 2, '/upload/newscover/2016-05-11/57329129df6b7.jpg', '<p><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">位於優雅老屋的Keefü Table，店裡的丹麥家具、老物件和經典燈飾都很有看頭，餐點飲品也好吃，老黃說等油煙問題改善，要再來試試木府午食，ya~~</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">Keefü Table</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">地址：台南市東區東榮街44巷12號</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">電話：06-2355139</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">營業時間：11:00~21:00</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">週二週三公休﻿</span></p>', '23333', '2016-05-11 09:56:10', '2016-05-19 19:39:03'),
	(12, 2, '曹麦穗', 'cakephp3 + Wpadmin 后台开发文档', 0, 0, 0, '/upload/newscover/2016-05-11/573291606baaf.jpg', '<p><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">位於優雅老屋的Keefü Table，店裡的丹麥家具、老物件和經典燈飾都很有看頭，餐點飲品也好吃，老黃說等油煙問題改善，要再來試試木府午食，ya~~</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">Keefü Table</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">地址：台南市東區東榮街44巷12號</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">電話：06-2355139</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">營業時間：11:00~21:00</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">週二週三公休﻿</span></p>', '55555', '2016-05-11 09:57:02', '2016-05-11 13:23:16'),
	(13, 2, '曹麦穗', 'centos php libevent拓展安装', 0, 0, 0, '/upload/newscover/2016-05-19/573d6c22d9ced.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', 'lovelylovelylovelylovelylovelylovelylovelylovelylovelylovely', '2016-05-19 15:34:38', '2016-05-19 15:34:38'),
	(14, 2, '曹麦穗', 'mongodb常用shell 命令', 1, 0, 0, '/upload/newscover/2016-05-19/573d6ca5592d2.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', '33sfw3r123rdsgdsagf34r3 dsagdasg3 b43gsag3 23 t3fdsadg dsag 3 34 23 dsag 32', '2016-05-19 15:35:29', '2016-05-24 14:29:54'),
	(15, 2, '曹麦穗', 'centos php libevent拓展安装', 0, 0, 0, '/upload/newscover/2016-05-19/573d6cd65c623.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', '版权归作者所有，任何形式转载请联系作者。\r\n作者：卢十四（来自豆瓣）\r\n来源：https://www.douban.com/note/557628871/\r\n\r\n清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。\r\n\r\n正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。\r\n\r\n我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”\r\n\r\n“一百岁了。”我妈声音里透出', '2016-05-19 15:36:36', '2016-05-19 15:36:36'),
	(16, 2, '曹麦穗', '母婴健康交流', 60, 0, 2, '/upload/newscover/2016-05-19/573d6d1294b53.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', 'fr21f21f', '2016-05-19 15:37:00', '2016-05-23 19:17:27'),
	(17, 2, '曹麦穗', '母婴健康交流', 16, 0, 1, '/upload/newscover/2016-05-19/573d6d1294b53.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', 'fr21f21f', '2016-05-19 15:37:00', '2016-05-20 15:19:32'),
	(18, 2, '曹麦穗', '母婴健康交流', 86, 1, 13, '/upload/newscover/2016-05-19/573d6d1294b53.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', 'fr21f21f', '2016-05-19 15:37:00', '2016-05-24 18:32:10'),
	(19, 2, '曹麦穗', '母婴健康交流', 6, 0, 0, '/upload/newscover/2016-05-19/573d6d1294b53.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', 'fr21f21f', '2016-05-19 15:37:00', '2016-05-23 10:26:44'),
	(20, 2, '曹麦穗', 'centos php libevent拓展安装', 0, 0, 0, '/upload/newscover/2016-05-19/573d6cd65c623.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', '版权归作者所有，任何形式转载请联系作者。\r\n作者：卢十四（来自豆瓣）\r\n来源：https://www.douban.com/note/557628871/\r\n\r\n清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。\r\n\r\n正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。\r\n\r\n我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”\r\n\r\n“一百岁了。”我妈声音里透出', '2016-05-19 15:36:36', '2016-05-19 15:36:36'),
	(21, 2, '曹麦穗', 'centos php libevent拓展安装', 0, 0, 0, '/upload/newscover/2016-05-19/573d6c22d9ced.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', 'lovelylovelylovelylovelylovelylovelylovelylovelylovelylovely', '2016-05-19 15:34:38', '2016-05-19 15:34:38'),
	(22, 2, '曹麦穗', 'mongodb常用shell 命令', 0, 0, 0, '/upload/newscover/2016-05-19/573d6ca5592d2.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', '33sfw3r123rdsgdsagf34r3 dsagdasg3 b43gsag3 23 t3fdsadg dsag 3 34 23 dsag 32', '2016-05-19 15:35:29', '2016-05-19 15:35:29'),
	(23, 2, '曹麦穗', 'centos php libevent拓展安装', 0, 0, 0, '/upload/newscover/2016-05-19/573d6c22d9ced.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', 'lovelylovelylovelylovelylovelylovelylovelylovelylovelylovely', '2016-05-19 15:34:38', '2016-05-19 15:34:38'),
	(24, 2, '曹麦穗', 'centos php libevent拓展安装', 0, 0, 0, '/upload/newscover/2016-05-19/573d6cd65c623.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', '版权归作者所有，任何形式转载请联系作者。\r\n作者：卢十四（来自豆瓣）\r\n来源：https://www.douban.com/note/557628871/\r\n\r\n清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。\r\n\r\n正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。\r\n\r\n我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”\r\n\r\n“一百岁了。”我妈声音里透出', '2016-05-19 15:36:36', '2016-05-19 15:36:36'),
	(25, 2, '曹麦穗', 'centos php libevent拓展安装', 0, 0, 0, '/upload/newscover/2016-05-19/573d6c22d9ced.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', 'lovelylovelylovelylovelylovelylovelylovelylovelylovelylovely', '2016-05-19 15:34:38', '2016-05-19 15:34:38'),
	(26, 2, '曹麦穗', 'centos php libevent拓展安装', 0, 0, 0, '/upload/newscover/2016-05-19/573d6c22d9ced.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', 'lovelylovelylovelylovelylovelylovelylovelylovelylovelylovely', '2016-05-19 15:34:38', '2016-05-19 15:34:38'),
	(27, 2, '曹麦穗', 'cakephp3 + Wpadmin 后台开发文档', 0, 0, 0, '/upload/newscover/2016-05-11/573291606baaf.jpg', '<p><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">位於優雅老屋的Keefü Table，店裡的丹麥家具、老物件和經典燈飾都很有看頭，餐點飲品也好吃，老黃說等油煙問題改善，要再來試試木府午食，ya~~</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">Keefü Table</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">地址：台南市東區東榮街44巷12號</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">電話：06-2355139</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">營業時間：11:00~21:00</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">週二週三公休﻿</span></p>', '55555', '2016-05-11 09:57:02', '2016-05-11 13:23:16'),
	(28, 2, '曹麦穗', '母婴健康交流', 47, 0, 11, '/upload/newscover/2016-05-19/573d6d1294b53.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', 'fr21f21f', '2016-05-19 15:37:00', '2016-05-23 19:18:12');
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COMMENT='新闻评论表';

-- 正在导出表  binggq.newscom 的数据：~22 rows (大约)
DELETE FROM `newscom`;
/*!40000 ALTER TABLE `newscom` DISABLE KEYS */;
INSERT INTO `newscom` (`id`, `news_id`, `pid`, `user_id`, `reply_user`, `body`, `praise_nums`, `create_time`, `update_time`) VALUES
	(1, 4, 0, 2, 0, 'test', 0, '2016-05-05 11:11:11', '0000-00-00 00:00:00'),
	(2, 4, 0, 2, 0, '不错啊，哈哈', 2, '2016-05-06 11:11:11', '0000-00-00 00:00:00'),
	(3, 11, 0, 8, 0, '不错，值得学习', 0, '2016-05-19 19:26:50', '2016-05-19 19:26:50'),
	(4, 11, 0, 8, 0, '我又来评论啦！', 0, '2016-05-19 19:39:03', '2016-05-19 19:39:03'),
	(5, 16, 0, 8, 0, '卧槽，不错！', 8, '2016-05-19 20:14:22', '2016-05-23 10:59:39'),
	(9, 17, 0, 8, 0, '不错！', 7, '2016-05-20 14:50:37', '2016-05-20 15:11:54'),
	(14, 16, 0, 8, 0, '放假房间', 1, '2016-05-20 15:22:16', '2016-05-23 10:30:25'),
	(15, 28, 0, 8, 0, '呵呵', 1, '2016-05-20 15:25:24', '2016-05-20 15:25:29'),
	(16, 28, 0, 8, 0, '呵呵\n', 1, '2016-05-20 15:31:58', '2016-05-20 15:32:54'),
	(17, 28, 0, 8, 0, '不错，很好', 1, '2016-05-20 16:00:30', '2016-05-20 16:54:17'),
	(18, 28, 0, 8, 0, '受到了1万点伤害', 1, '2016-05-20 16:58:28', '2016-05-20 16:58:43'),
	(19, 28, 0, 8, 0, '正取果上果', 1, '2016-05-20 16:59:51', '2016-05-20 16:59:55'),
	(20, 18, 0, 8, 0, '43523531252', 1, '2016-05-23 11:17:40', '2016-05-23 11:17:43'),
	(21, 18, 0, 8, 0, '不错，值得膜拜', 1, '2016-05-23 11:21:58', '2016-05-23 11:22:01'),
	(22, 18, 0, 8, 0, '卧槽，我要打鸡血了。', 1, '2016-05-23 11:22:29', '2016-05-23 11:22:34'),
	(23, 18, 0, 8, 0, '打鸡血', 1, '2016-05-23 15:55:43', '2016-05-23 15:55:48'),
	(25, 18, 22, 8, 8, '嘻嘻，打吧，打吧', 0, '2016-05-23 17:48:37', '2016-05-23 17:48:37'),
	(26, 18, 0, 7, 0, '嘻嘻，打吧，打吧', 0, '2016-05-23 17:48:37', '2016-05-23 17:48:37'),
	(27, 18, 26, 8, 7, '呵呵，不想跟你说话。', 0, '2016-05-23 18:24:18', '2016-05-23 18:24:18'),
	(28, 18, 26, 8, 7, '对啊，不想跟你说话', 0, '2016-05-23 18:25:24', '2016-05-23 18:25:24'),
	(29, 18, 26, 8, 7, '妹子，你的头像很漂亮哦', 0, '2016-05-23 18:28:24', '2016-05-23 18:28:24'),
	(30, 18, 26, 8, 7, '哇塞，美女！', 0, '2016-05-23 18:30:41', '2016-05-23 18:30:41'),
	(31, 18, 26, 8, 7, '妹子加我Q：233333333', 0, '2016-05-23 18:35:00', '2016-05-23 18:35:00'),
	(32, 18, 26, 8, 7, '妹子加我Q：233333333', 0, '2016-05-23 18:35:18', '2016-05-23 18:35:18'),
	(33, 18, 26, 8, 7, '妹子加我Q：233333333', 0, '2016-05-23 18:35:52', '2016-05-23 18:35:52');
/*!40000 ALTER TABLE `newscom` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='新闻行业标签';

-- 正在导出表  binggq.news_industry 的数据：~14 rows (大约)
DELETE FROM `news_industry`;
/*!40000 ALTER TABLE `news_industry` DISABLE KEYS */;
INSERT INTO `news_industry` (`id`, `news_id`, `industry_id`) VALUES
	(3, 10, 5),
	(4, 10, 8),
	(5, 11, 6),
	(6, 11, 8),
	(7, 12, 5),
	(9, 11, 7),
	(10, 13, 6),
	(11, 13, 8),
	(12, 14, 7),
	(13, 14, 17),
	(14, 15, 6),
	(15, 15, 18),
	(16, 15, 19),
	(17, 16, 7),
	(18, 16, 16);
/*!40000 ALTER TABLE `news_industry` ENABLE KEYS */;


-- 导出  表 binggq.order 结构
CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '订单类型1约见',
  `relate_id` int(11) NOT NULL DEFAULT '0' COMMENT '关联id',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id(买家id)',
  `seller_id` int(11) NOT NULL DEFAULT '0' COMMENT '卖家id',
  `order_no` varchar(20) NOT NULL DEFAULT '' COMMENT '订单号',
  `out_trade_no` varchar(50) DEFAULT '' COMMENT '支付方的订单号',
  `paytype` tinyint(4) DEFAULT '1' COMMENT '实际支付方式：1微信2支付宝',
  `price` decimal(10,2) NOT NULL COMMENT '定价',
  `fee` decimal(10,2) NOT NULL COMMENT '实际支付',
  `remark` varchar(50) NOT NULL COMMENT '备注',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '订单状态0未完成1已完成',
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='订单表';

-- 正在导出表  binggq.order 的数据：~2 rows (大约)
DELETE FROM `order`;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` (`id`, `type`, `relate_id`, `user_id`, `seller_id`, `order_no`, `out_trade_no`, `paytype`, `price`, `fee`, `remark`, `status`, `create_time`, `update_time`) VALUES
	(3, 1, 7, 7, 8, '14648363607781', NULL, 1, 150.00, 0.00, '预约话题测试话题', 0, '2016-06-02 10:59:20', '2016-06-02 10:59:20'),
	(6, 1, 6, 8, 7, '14648392418692', NULL, 1, 150.00, 0.00, '预约话题测试话题', 1, '2016-06-02 11:47:21', '2016-06-03 11:51:40');
/*!40000 ALTER TABLE `order` ENABLE KEYS */;


-- 导出  表 binggq.projrong 结构
CREATE TABLE IF NOT EXISTS `projrong` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '融资项目',
  `user_id` int(10) NOT NULL COMMENT '发布人id',
  `publisher` varchar(50) NOT NULL COMMENT '发布人',
  `company` varchar(100) NOT NULL COMMENT '公司',
  `title` varchar(150) NOT NULL COMMENT '项目名称',
  `rzjd` varchar(50) NOT NULL COMMENT '融资阶段',
  `address` varchar(150) NOT NULL COMMENT '地点',
  `scale` varchar(50) NOT NULL COMMENT '融资规模',
  `stock` varchar(50) NOT NULL COMMENT '股份',
  `read_nums` int(11) DEFAULT NULL COMMENT '阅读数',
  `praise_nums` int(11) DEFAULT NULL COMMENT '点赞数',
  `comment_nums` int(11) DEFAULT NULL COMMENT '评论数',
  `cover` varchar(250) DEFAULT NULL COMMENT '封面',
  `body` text COMMENT '活动内容',
  `summary` varchar(550) DEFAULT NULL COMMENT '项目简介',
  `comp_desc` varchar(550) DEFAULT NULL COMMENT '公司简介',
  `team` varchar(550) DEFAULT NULL COMMENT '核心团队',
  `attach` varchar(350) DEFAULT NULL COMMENT '资料地址',
  `status` tinyint(4) DEFAULT '0' COMMENT '状态',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='融资项目';

-- 正在导出表  binggq.projrong 的数据：~1 rows (大约)
DELETE FROM `projrong`;
/*!40000 ALTER TABLE `projrong` DISABLE KEYS */;
INSERT INTO `projrong` (`id`, `user_id`, `publisher`, `company`, `title`, `rzjd`, `address`, `scale`, `stock`, `read_nums`, `praise_nums`, `comment_nums`, `cover`, `body`, `summary`, `comp_desc`, `team`, `attach`, `status`, `create_time`, `update_time`) VALUES
	(2, 2, '曹文鹏', '腾讯科技', '母婴健康交流', 'A轮', '深圳市南山区腾讯大厦', '500人', '14%', NULL, NULL, NULL, '/upload/proj/cover/2016-04-22/5719a69da9447.jpg', '特特', '12', '33', '养生项目组', '/upload/proj/attach/2016-04-22/5719a6b8d85c9.pptx', NULL, '0000-00-00 00:00:00', NULL);
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


-- 导出  表 binggq.rong_tag 结构
CREATE TABLE IF NOT EXISTS `rong_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `industry_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='融资项目行业标签';

-- 正在导出表  binggq.rong_tag 的数据：~2 rows (大约)
DELETE FROM `rong_tag`;
/*!40000 ALTER TABLE `rong_tag` DISABLE KEYS */;
INSERT INTO `rong_tag` (`id`, `project_id`, `industry_id`) VALUES
	(1, 2, 2),
	(2, 2, 5);
/*!40000 ALTER TABLE `rong_tag` ENABLE KEYS */;


-- 导出  表 binggq.savant 结构
CREATE TABLE IF NOT EXISTS `savant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `cover` varchar(550) NOT NULL DEFAULT '' COMMENT '封面',
  `xmjy` varchar(550) NOT NULL DEFAULT '' COMMENT '项目经验',
  `zyys` varchar(550) NOT NULL COMMENT '资源优势',
  `summary` varchar(550) NOT NULL COMMENT '简洁',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='专家信息表';

-- 正在导出表  binggq.savant 的数据：~0 rows (大约)
DELETE FROM `savant`;
/*!40000 ALTER TABLE `savant` DISABLE KEYS */;
INSERT INTO `savant` (`id`, `user_id`, `cover`, `xmjy`, `zyys`, `summary`) VALUES
	(3, 8, '', '7年dota经验，精通所有英雄，5个位置都能打，擅长C位，伐木能力惊人！', 'dota 坑逼 菜鱼\n万年经济垫底飞鞋送人头 菜黄\n烈士路第一单 小金子\n中路菜鸡 左XX', '');
/*!40000 ALTER TABLE `savant` ENABLE KEYS */;


-- 导出  表 binggq.smsmsg 结构
CREATE TABLE IF NOT EXISTS `smsmsg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(50) NOT NULL DEFAULT '0' COMMENT '手机号',
  `code` varchar(50) DEFAULT NULL COMMENT '验证码',
  `content` varchar(250) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COMMENT='短信记录';

-- 正在导出表  binggq.smsmsg 的数据：~36 rows (大约)
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
	(34, '18681509040', '', '您预约的话题：\'测试话题\'已确认通过，请及时登录平台支付预约款。', '2016-06-02 10:59:21'),
	(35, '18316629973', '', '您预约的话题：\'测试话题\'已确认通过，请及时登录平台支付预约款。', '2016-06-02 11:09:52'),
	(36, '18316629973', '', 'ee', '2016-06-02 11:18:29'),
	(40, '18316629973', '', '您预约的话题：《测试话题》已确认通过，请及时登录平台支付预约款。', '2016-06-02 11:47:22'),
	(41, '18316629973', '1648', '您的动态验证码为1648', '2016-06-02 15:48:22');
/*!40000 ALTER TABLE `smsmsg` ENABLE KEYS */;


-- 导出  表 binggq.subject_book 结构
CREATE TABLE IF NOT EXISTS `subject_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL DEFAULT '0' COMMENT '话题id',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `savant_id` int(11) NOT NULL DEFAULT '0' COMMENT '专家id',
  `summary` varchar(550) NOT NULL DEFAULT '' COMMENT '需求简介',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0,未确认1确认通过2不予通过3完成',
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='话题预约';

-- 正在导出表  binggq.subject_book 的数据：~2 rows (大约)
DELETE FROM `subject_book`;
/*!40000 ALTER TABLE `subject_book` DISABLE KEYS */;
INSERT INTO `subject_book` (`id`, `subject_id`, `user_id`, `savant_id`, `summary`, `status`, `create_time`, `update_time`) VALUES
	(6, 4, 8, 7, 'gasgdsa1', 1, '2016-05-26 18:27:45', '2016-06-03 11:41:10'),
	(7, 1, 7, 8, 'gasgdsa1', 1, '2016-05-26 18:27:45', '2016-06-02 10:59:20');
/*!40000 ALTER TABLE `subject_book` ENABLE KEYS */;


-- 导出  表 binggq.user 结构
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户表',
  `phone` varchar(20) NOT NULL COMMENT '手机号',
  `wx_openid` varchar(100) DEFAULT '' COMMENT '微信的openid',
  `truename` varchar(20) NOT NULL COMMENT '姓名',
  `level` varchar(20) NOT NULL DEFAULT '1' COMMENT '等级,1:普通2:专家',
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
  `reason` varchar(250) DEFAULT '' COMMENT '审核意见',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '实名认证状态：1.实名待审核2审核通过0审核不通过',
  `savant_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '专家认证状态：1.未认证.2待审核3审核通过0审核不通过',
  `enabled` tinyint(1) NOT NULL DEFAULT '1' COMMENT '账号状态 ：1.可用0禁用(控制登录)',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- 正在导出表  binggq.user 的数据：~3 rows (大约)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `phone`, `wx_openid`, `truename`, `level`, `idcard`, `company`, `position`, `email`, `gender`, `agency_id`, `ext_industry`, `goodat`, `city`, `card_path`, `avatar`, `money`, `meet_nums`, `fans`, `ymjy`, `ywnl`, `reason`, `status`, `savant_status`, `enabled`, `create_time`, `update_time`) VALUES
	(7, '18681509040', '', '郑旭', '2', '', '中青文化投资管理有限公司', '互联网事业部副总经理', 'claus@smartlemon.cn', 1, 17, '6642', '', '', '/upload/user/mp/2016-05-05/572b2466c4068.jpg', '/upload/user/avatar/avatar2.jpg', 0.00, 0, 1, '', '', '', 2, 1, 1, '2016-05-05 18:46:01', '2016-05-18 10:51:51'),
	(8, '18316629973', 'oZVmqjjrFxADkBG1YDYSqk36G3oo', '曹麦穗', '2', '', '广东深宏盾律师事务所', '共产主义接班人', '714265403@qq.com', 1, 13, '打dota', '', '', '/upload/user/mp/2016-05-09/57305f00c5c1a.jpg', 'http://wx.qlogo.cn/mmopen/ajNVdqHZLLCOibYvNGzNtJmgyOEpAyhkd45A3gbGgt2mbDYUdMeBVbbe9SmxwJiceNGd4ibZCeKTHSDq1kJDkVibXQ/0', 0.00, 0, 1, '', '', '', 2, 3, 1, '2016-05-09 17:57:24', '2016-05-13 17:43:16'),
	(10, '18316629974', '', '郑旭', '1', '', '中青文化投资管理有限公司', '互联网事业部副总经理', 'claus3@smartlemon.cn', 1, 0, '', '', '', '/upload/user/mp/2016-06-02/574fe54db9d2c.jpg', '', 0.00, 0, 0, '', '', '', 1, 1, 0, '2016-06-02 15:52:29', '2016-06-02 15:52:29');
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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COMMENT='用户消息';

-- 正在导出表  binggq.usermsg 的数据：~25 rows (大约)
DELETE FROM `usermsg`;
/*!40000 ALTER TABLE `usermsg` DISABLE KEYS */;
INSERT INTO `usermsg` (`id`, `user_id`, `type`, `table_id`, `title`, `msg`, `num`, `url`, `status`, `create_time`, `update_time`) VALUES
	(7, 7, 1, 10, '您有新的关注者', '您有1位新的关注者', 0, '/admin/user/index', 0, '2016-05-18 10:51:51', '2016-05-18 10:51:51'),
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
	(28, 7, 3, 33, '评论回复', '有人回复了你的评论!', 0, '/news/view/{#id#}#{#com_id#}', 0, '2016-05-23 18:35:52', '2016-05-23 18:35:52'),
	(29, 7, 4, 0, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 0, '2016-05-26 17:18:11', '2016-05-26 17:18:11'),
	(30, 7, 4, 4, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 0, '2016-05-26 17:26:26', '2016-05-26 17:26:26'),
	(31, 7, 4, 6, '话题预约', '您有新的话题预约请求', 0, '/home/my-book-savant', 0, '2016-05-26 18:27:45', '2016-05-26 18:27:45'),
	(32, 7, 4, 7, '预约通知', '您预约的话题：\'测试话题\'已确认通过，请及时登录平台支付预约款。', 0, '/home/my-book-savant', 0, '2016-06-02 10:59:21', '2016-06-02 10:59:21'),
	(33, 8, 4, 6, '预约通知', '您预约的话题：\'测试话题\'已确认通过，请及时登录平台支付预约款。', 0, '/home/my-book-savant', 0, '2016-06-02 11:09:52', '2016-06-02 11:09:52'),
	(34, 8, 4, 6, '预约通知', '您预约的话题：\'测试话题\'已确认通过，请及时登录平台支付预约款。', 0, '/home/my-book-savant', 0, '2016-06-02 11:21:25', '2016-06-02 11:21:25'),
	(35, 8, 4, 6, '预约通知', '您预约的话题：《测试话题》已确认通过，请及时登录平台支付预约款。', 0, '/home/my-book-savant', 0, '2016-06-02 11:47:22', '2016-06-02 11:47:22');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='用户关系表';

-- 正在导出表  binggq.user_fans 的数据：~1 rows (大约)
DELETE FROM `user_fans`;
/*!40000 ALTER TABLE `user_fans` DISABLE KEYS */;
INSERT INTO `user_fans` (`id`, `user_id`, `following_id`, `type`, `create_time`, `update_time`) VALUES
	(10, 8, 7, 2, '2016-05-18 10:51:51', '2016-05-18 10:51:51'),
	(11, 7, 8, 2, '2016-05-18 10:51:51', '2016-05-18 10:51:51');
/*!40000 ALTER TABLE `user_fans` ENABLE KEYS */;


-- 导出  表 binggq.user_industry 结构
CREATE TABLE IF NOT EXISTS `user_industry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `industry_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COMMENT='用户行业标签';

-- 正在导出表  binggq.user_industry 的数据：~6 rows (大约)
DELETE FROM `user_industry`;
/*!40000 ALTER TABLE `user_industry` DISABLE KEYS */;
INSERT INTO `user_industry` (`id`, `user_id`, `industry_id`) VALUES
	(20, 7, 9),
	(21, 7, 16),
	(22, 8, 8),
	(23, 8, 19),
	(24, 9, 11),
	(25, 9, 19),
	(26, 8, 20);
/*!40000 ALTER TABLE `user_industry` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
