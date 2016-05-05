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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 CHECKSUM=1 ROW_FORMAT=DYNAMIC COMMENT='后台操作日志表';

-- 正在导出表  binggq.actionlog 的数据：~11 rows (大约)
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
	(20, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-05-03 15:28:30');
/*!40000 ALTER TABLE `actionlog` ENABLE KEYS */;


-- 导出  表 binggq.activity 结构
CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '活动表',
  `admin_id` int(10) NOT NULL COMMENT '作者id',
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
  PRIMARY KEY (`id`),
  KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='活动表';

-- 正在导出表  binggq.activity 的数据：~3 rows (大约)
DELETE FROM `activity`;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
INSERT INTO `activity` (`id`, `admin_id`, `publisher`, `industry_id`, `company`, `title`, `time`, `address`, `scale`, `read_nums`, `praise_nums`, `comment_nums`, `cover`, `body`, `summary`, `create_time`, `update_time`) VALUES
	(6, 2, '', 5, '柠檬智慧科技', 'E店通', '2016-09-09 12:00-13:00', '福田上沙3', '500人', NULL, NULL, NULL, '/upload/activity/2016-04-21/571878d1d6f5f.jpg', '<p>活动介绍：</p><p><br/></p><p><br/></p><p>活动流程：</p><p><br/></p><p><br/></p><p>参与嘉宾：</p><p><br/></p><p><br/></p><p>联系方式：<br/></p>', '交流会啊', '2016-04-21 14:53:10', '2016-04-21 14:53:10');
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;


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
	(2, 'admin', '曹麦穗', '$2y$10$IwMcx3dYp7Sn.TPgovzc9Osem.XpMAdajZ1C.Z8y41LHcdcJUpCRy', '', 1, '2016-04-11 16:53:37', '2016-05-03 15:28:30', '2016-05-03 15:28:30', '127.0.0.1');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;


-- 导出  表 binggq.adminmsg 结构
CREATE TABLE IF NOT EXISTS `adminmsg` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '后台消息',
  `type` tinyint(4) NOT NULL COMMENT '类型',
  `msg` varchar(250) NOT NULL COMMENT '内容',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态:1未读2已读',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台系统消息';

-- 正在导出表  binggq.adminmsg 的数据：~0 rows (大约)
DELETE FROM `adminmsg`;
/*!40000 ALTER TABLE `adminmsg` DISABLE KEYS */;
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
  `img` varchar(250) NOT NULL COMMENT '图片',
  `url` varchar(250) NOT NULL COMMENT '链接地址',
  `remark` varchar(250) NOT NULL COMMENT '备注说明',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='轮播图';

-- 正在导出表  binggq.banner 的数据：~0 rows (大约)
DELETE FROM `banner`;
/*!40000 ALTER TABLE `banner` DISABLE KEYS */;
INSERT INTO `banner` (`id`, `type`, `img`, `url`, `remark`, `create_time`) VALUES
	(10, '1', '/webroot/upload/banner/2016-04-21/571890c6ddbdb.jpg', 'http://movie.douban.com/subject/1295644/', '不错的页面', '2016-04-21 16:35:50');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='群组管理\r\n';

-- 正在导出表  binggq.group 的数据：~0 rows (大约)
DELETE FROM `group`;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
/*!40000 ALTER TABLE `group` ENABLE KEYS */;


-- 导出  表 binggq.group_menu 结构
CREATE TABLE IF NOT EXISTS `group_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL DEFAULT '0' COMMENT '群组',
  `menu_id` int(11) NOT NULL DEFAULT '0' COMMENT '权限',
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_id` (`group_id`,`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='群组权限';

-- 正在导出表  binggq.group_menu 的数据：~0 rows (大约)
DELETE FROM `group_menu`;
/*!40000 ALTER TABLE `group_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `group_menu` ENABLE KEYS */;


-- 导出  表 binggq.industry 结构
CREATE TABLE IF NOT EXISTS `industry` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '行业标签',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='行业标签库';

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
	(11, 0, '节能环保'),
	(12, 1, '军工/高端装备'),
	(13, 2, '定增基金'),
	(14, 2, '优先资金'),
	(15, 2, '过桥资金'),
	(16, 2, '股票质押'),
	(17, 2, '税务筹划'),
	(18, 2, '结构化融资'),
	(19, 2, '债券');
/*!40000 ALTER TABLE `industry` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='菜单表';

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
	(22, 'need管理', '/admin/need/index', 1, NULL, NULL, 1, 1, NULL);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;


-- 导出  表 binggq.need 结构
CREATE TABLE IF NOT EXISTS `need` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '小秘书',
  `user_id` int(11) NOT NULL COMMENT '用户',
  `msg` varchar(550) NOT NULL COMMENT '内容',
  `status` tinyint(4) NOT NULL COMMENT '状态',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='小秘书';

-- 正在导出表  binggq.need 的数据：~0 rows (大约)
DELETE FROM `need`;
/*!40000 ALTER TABLE `need` DISABLE KEYS */;
/*!40000 ALTER TABLE `need` ENABLE KEYS */;


-- 导出  表 binggq.news 结构
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(10) NOT NULL COMMENT '作者id',
  `industry_id` int(10) NOT NULL COMMENT '标签id',
  `admin_name` varchar(50) NOT NULL COMMENT '作者姓名',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `read_nums` int(11) DEFAULT NULL COMMENT '阅读数',
  `praise_nums` int(11) DEFAULT NULL COMMENT '点赞数',
  `comment_nums` int(11) DEFAULT NULL COMMENT '评论数',
  `cover` varchar(250) DEFAULT NULL COMMENT '封面',
  `body` text COMMENT '内容',
  `summary` varchar(250) DEFAULT NULL COMMENT '摘要',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='咨询表';

-- 正在导出表  binggq.news 的数据：~1 rows (大约)
DELETE FROM `news`;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` (`id`, `admin_id`, `industry_id`, `admin_name`, `title`, `read_nums`, `praise_nums`, `comment_nums`, `cover`, `body`, `summary`, `create_time`, `update_time`) VALUES
	(4, 2, 0, '', '这才是国内八月最值得去的12个旅行天堂！别去错了！', NULL, NULL, NULL, '/upload/newscover/2016-04-21/571891fdbe0ac.jpg', '<p>&nbsp;&nbsp; &nbsp; &nbsp;\r\n\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; <br/></p><p><br/></p><section data-id="85616" class="135editor" style="white-space: normal; margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; color: rgb(62, 62, 62); line-height: 25px; background-color: rgb(255, 255, 255); border: 0px none; font-family: 微软雅黑; word-wrap: break-word !important;"><section style="margin: 0px; padding: 10px; max-width: 100%; box-sizing: border-box; word-wrap: break-word; line-height: 2em; word-break: normal; text-align: center; background-color: rgb(12, 137, 24); color: rgb(255, 255, 255); border-color: rgb(45, 206, 60);"><strong style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"><span class="135brush" data-brushtype="text" style="margin: 0px; padding: 0px; max-width: 100%; color: inherit; box-sizing: border-box !important; word-wrap: break-word !important;">NO.1 四川稻城三神山</span></strong></section><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; max-width: 100%; min-height: 1em; white-space: pre-wrap; border-color: rgb(12, 137, 24); box-sizing: border-box !important; word-wrap: break-word !important;"><img src="http://mmbiz.qpic.cn/mmbiz/yqVAqoZvDibFa8hbzHetsNTXuYCBmRffsYZ8PRWZtwBxfyibqc9iaXu1bJLt4NAtw2NIxWNJ4GoKakhs0Qlyz3MMw/640?wx_fmt=png&wxfrom=5&wx_lazy=1" _width="670px" data-src="http://mmbiz.qpic.cn/mmbiz/yqVAqoZvDibFa8hbzHetsNTXuYCBmRffsYZ8PRWZtwBxfyibqc9iaXu1bJLt4NAtw2NIxWNJ4GoKakhs0Qlyz3MMw/0?wx_fmt=png" data-width="100%" data-ratio="0.06560636182902585" data-w="" style="margin: 0px; padding: 0px; border-color: rgb(12, 137, 24); color: inherit; box-sizing: border-box ! important; word-wrap: break-word ! important; width: 670px ! important; visibility: visible ! important; height: auto ! important;" width="670px"/><img src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5HX8yYTuQNZpy2a7iaw2SFDdf4UaDJajRZicOyyQ8uvpEgh27NtKKxVjUA/640?wx_fmt=jpeg&wxfrom=5&wx_lazy=1" style="width: auto ! important; visibility: visible ! important; height: auto ! important;" data-s="300,640" data-type="jpeg" data-src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5HX8yYTuQNZpy2a7iaw2SFDdf4UaDJajRZicOyyQ8uvpEgh27NtKKxVjUA/0?wx_fmt=jpeg" data-ratio="0.6043737574552683" data-w="" width="auto"/></p></section><p><br/></p><p style="white-space: normal;"><img src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5HbNahxD9wiaG30XHYJ0CLja9hzHt2Q9yDNllfftphAaYbsyWkr3WwnicQ/640?wx_fmt=jpeg&wxfrom=5&wx_lazy=1" _width="auto" data-s="300,640" data-type="jpeg" data-src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5HbNahxD9wiaG30XHYJ0CLja9hzHt2Q9yDNllfftphAaYbsyWkr3WwnicQ/0?wx_fmt=jpeg" data-ratio="0.6620278330019881" data-w="" style="margin: 0px; padding: 0px; box-sizing: border-box ! important; word-wrap: break-word ! important; width: auto ! important; visibility: visible ! important; height: auto ! important;" width="auto"/></p><p style="white-space: normal;"><img src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5HT4JPUvb02eJmG1p0YDCcS1iblcabctCcjknBPcLVgz877vls5hzjzZQ/640?wx_fmt=jpeg&wxfrom=5&wx_lazy=1" _width="auto" data-s="300,640" data-type="jpeg" data-src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5HT4JPUvb02eJmG1p0YDCcS1iblcabctCcjknBPcLVgz877vls5hzjzZQ/0?wx_fmt=jpeg" data-ratio="0.4990059642147117" data-w="" style="margin: 0px; padding: 0px; box-sizing: border-box ! important; word-wrap: break-word ! important; width: auto ! important; visibility: visible ! important; height: auto ! important;" width="auto"/><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><br/></p><p><br/></p><section data-id="29735" class="135editor" style="white-space: normal; margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; color: rgb(62, 62, 62); line-height: 25px; background-color: rgb(255, 255, 255); border: 0px none; font-family: 微软雅黑; word-wrap: break-word !important;"><section style="margin: 0px; padding: 0px 5px; max-width: 100%; box-sizing: border-box; line-height: 10px; color: inherit; border: 1px solid rgb(12, 137, 24); word-wrap: break-word !important;"><section data-width="50%" style="margin: -8px 0px 0px 140px; padding: 0px; max-width: 100%; box-sizing: border-box; color: inherit; height: 8px; width: 329px; background-color: rgb(254, 254, 254); border-color: rgb(12, 137, 24); word-wrap: break-word !important;"><section data-width="8px" style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; width: 8px; height: 8px; border-top-left-radius: 100%; border-top-right-radius: 100%; border-bottom-right-radius: 100%; border-bottom-left-radius: 100%; line-height: 1; font-size: 18px; text-decoration: inherit; border-color: rgb(45, 206, 60); display: inline-block; color: rgb(255, 255, 255); background-color: rgb(12, 137, 24); word-wrap: break-word !important;"></section></section><p style="margin: 15px; padding: 0px; max-width: 100%; min-height: 1em; white-space: pre-wrap; line-height: 2em; font-size: 14px; text-indent: 2em; box-sizing: border-box !important; word-wrap: break-word !important;">稻城亚丁的三神山由仙乃日、央迈勇、夏诺多吉三座雪峰组成，分别代表观音菩萨、文殊菩萨、金刚手菩萨。三座山峰终年白雪皑皑，遥相呼应，直逼云天，慑人心魄据佛教的典籍圣地咱日秘相记载，世界佛教二十四神山，它排名十一，属相是鸡属众生供奉朝神积德之圣地据说转山一次等于念一亿嘛尼的功德，藏历鸡年朝拜，功德倍增。</p><section data-width="65%" style="margin: 0px 0px -4px 25px; padding: 0px; max-width: 100%; box-sizing: border-box; background-color: rgb(254, 254, 254); color: inherit; text-align: right; height: 10px; width: 427.6875px; border-color: rgb(12, 137, 24); word-wrap: break-word !important;"><section data-width="8px" style="margin: 0px auto 1px; padding: 0px; max-width: 100%; box-sizing: border-box; border-top-left-radius: 100%; border-top-right-radius: 100%; border-bottom-right-radius: 100%; border-bottom-left-radius: 100%; line-height: 1; text-decoration: inherit; background-color: rgb(12, 137, 24); border-color: rgb(45, 206, 60); display: inline-block; height: 8px; width: 8px; color: rgb(255, 255, 255); word-wrap: break-word !important;"></section></section></section><section style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; width: 0px; height: 0px; clear: both; word-wrap: break-word !important;"></section></section><p><br/></p><p style="white-space: normal;"><br/></p><p style="white-space: normal;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><br/></p><p><br/></p><section data-id="85616" class="135editor" style="white-space: normal; margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; color: rgb(62, 62, 62); line-height: 25px; background-color: rgb(255, 255, 255); border: 0px none; font-family: 微软雅黑; word-wrap: break-word !important;"><section style="margin: 0px; padding: 10px; max-width: 100%; box-sizing: border-box; word-wrap: break-word; line-height: 2em; word-break: normal; text-align: center; background-color: rgb(12, 137, 24); color: rgb(255, 255, 255); border-color: rgb(45, 206, 60);"><strong style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"><span class="135brush" data-brushtype="text" style="margin: 0px; padding: 0px; max-width: 100%; color: inherit; box-sizing: border-box !important; word-wrap: break-word !important;">NO.2 新疆喀纳斯湖</span></strong></section><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; max-width: 100%; min-height: 1em; white-space: pre-wrap; border-color: rgb(12, 137, 24); box-sizing: border-box !important; word-wrap: break-word !important;"><img src="http://mmbiz.qpic.cn/mmbiz/yqVAqoZvDibFa8hbzHetsNTXuYCBmRffsYZ8PRWZtwBxfyibqc9iaXu1bJLt4NAtw2NIxWNJ4GoKakhs0Qlyz3MMw/640?wx_fmt=png&wxfrom=5&wx_lazy=1" _width="670px" data-src="http://mmbiz.qpic.cn/mmbiz/yqVAqoZvDibFa8hbzHetsNTXuYCBmRffsYZ8PRWZtwBxfyibqc9iaXu1bJLt4NAtw2NIxWNJ4GoKakhs0Qlyz3MMw/0?wx_fmt=png" data-width="100%" data-ratio="0.06560636182902585" data-w="" style="margin: 0px; padding: 0px; border-color: rgb(12, 137, 24); color: inherit; box-sizing: border-box ! important; word-wrap: break-word ! important; width: 670px ! important; visibility: visible ! important; height: auto ! important;" width="670px"/></p></section><p><br/></p><p style="white-space: normal;"><br/></p><p style="white-space: normal;"><img src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5H7mdiaiaD5KPAgNicIKbic0HGrUOxIy6Jt6Bb8eIKwGwjl68VCorUN4Vuow/640?wx_fmt=jpeg&wxfrom=5&wx_lazy=1" _width="auto" data-s="300,640" data-type="jpeg" data-src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5H7mdiaiaD5KPAgNicIKbic0HGrUOxIy6Jt6Bb8eIKwGwjl68VCorUN4Vuow/0?wx_fmt=jpeg" data-ratio="0.6679920477137177" data-w="" style="margin: 0px; padding: 0px; box-sizing: border-box ! important; word-wrap: break-word ! important; width: auto ! important; visibility: visible ! important; height: auto ! important;" width="auto"/><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><img src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5HNZBGcSLFXkrEvsoUiclcUjDuhKlB80dxXdiawgQibRkYZJibf5Y7ofLT4A/640?wx_fmt=jpeg&wxfrom=5&wx_lazy=1" _width="auto" data-s="300,640" data-type="jpeg" data-src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5HNZBGcSLFXkrEvsoUiclcUjDuhKlB80dxXdiawgQibRkYZJibf5Y7ofLT4A/0?wx_fmt=jpeg" data-ratio="0.6401590457256461" data-w="" style="margin: 0px; padding: 0px; box-sizing: border-box ! important; word-wrap: break-word ! important; width: auto ! important; visibility: visible ! important; height: auto ! important;" width="auto"/><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/><span style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"></span></p><p style="white-space: normal;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><br/></p><p><br/></p><section data-id="29735" class="135editor" style="white-space: normal; margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; color: rgb(62, 62, 62); line-height: 25px; background-color: rgb(255, 255, 255); border: 0px none; font-family: 微软雅黑; word-wrap: break-word !important;"><section data-width="92px" style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; width: 92px; border-color: rgb(12, 137, 24); word-wrap: break-word !important;"><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; max-width: 100%; min-height: 1em; white-space: pre-wrap; text-align: center; color: inherit; line-height: 2em; border-color: rgb(12, 137, 24); box-sizing: border-box !important; word-wrap: break-word !important;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p></section><section style="margin: 0px; padding: 0px 5px; max-width: 100%; box-sizing: border-box; line-height: 10px; color: inherit; border: 1px solid rgb(12, 137, 24); word-wrap: break-word !important;"><section data-width="50%" style="margin: -8px 0px 0px 140px; padding: 0px; max-width: 100%; box-sizing: border-box; color: inherit; height: 8px; width: 329px; background-color: rgb(254, 254, 254); border-color: rgb(12, 137, 24); word-wrap: break-word !important;"><section data-width="8px" style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; width: 8px; height: 8px; border-top-left-radius: 100%; border-top-right-radius: 100%; border-bottom-right-radius: 100%; border-bottom-left-radius: 100%; line-height: 1; font-size: 18px; text-decoration: inherit; border-color: rgb(45, 206, 60); display: inline-block; color: rgb(255, 255, 255); background-color: rgb(12, 137, 24); word-wrap: break-word !important;"></section></section><p style="margin: 15px; padding: 0px; max-width: 100%; min-height: 1em; white-space: pre-wrap; line-height: 2em; font-size: 14px; text-indent: 2em; box-sizing: border-box !important; word-wrap: break-word !important;">喀纳斯湖是中国新疆阿勒泰地区布尔津县北部一著名淡水湖，面积45.75平方公里，平均水深120米，最深处达到188.5米，蓄水量达53.8亿立方米。外形呈月牙，被推测为古冰川强烈运动阻塞山谷积水而成。 喀纳斯湖之所以有名原因有二——独特的自然风景和水怪的传说。登上观鱼台可俯瞰喀纳斯湖全景，也可一寻水怪之踪迹。山下是图佤族人的古朴村落，房屋就地取材、全木制的小屋，颇有瑞士小镇的风采。公路沿喀纳斯河而下，河道蜿蜒曲折，河水的颜色也随着光影、景物而变化，景色较喀纳斯湖有过之而无不及。</p><section data-width="65%" style="margin: 0px 0px -4px 25px; padding: 0px; max-width: 100%; box-sizing: border-box; background-color: rgb(254, 254, 254); color: inherit; text-align: right; height: 10px; width: 427.6875px; border-color: rgb(12, 137, 24); word-wrap: break-word !important;"><section data-width="8px" style="margin: 0px auto 1px; padding: 0px; max-width: 100%; box-sizing: border-box; border-top-left-radius: 100%; border-top-right-radius: 100%; border-bottom-right-radius: 100%; border-bottom-left-radius: 100%; line-height: 1; text-decoration: inherit; background-color: rgb(12, 137, 24); border-color: rgb(45, 206, 60); display: inline-block; height: 8px; width: 8px; color: rgb(255, 255, 255); word-wrap: break-word !important;"></section></section></section><section style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; width: 0px; height: 0px; clear: both; word-wrap: break-word !important;"></section></section><p><br/></p><p style="white-space: normal;"><br/></p><p style="white-space: normal;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><img src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5HZFticrOaQqibTkjWueQn2Rep9JumZuPiaj3mNx2aSB0QMfhVffo06aTicg/640?wx_fmt=jpeg&wxfrom=5&wx_lazy=1" _width="auto" data-s="300,640" data-type="jpeg" data-src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5HZFticrOaQqibTkjWueQn2Rep9JumZuPiaj3mNx2aSB0QMfhVffo06aTicg/0?wx_fmt=jpeg" data-ratio="0.6381709741550696" data-w="" style="margin: 0px; padding: 0px; box-sizing: border-box ! important; word-wrap: break-word ! important; width: auto ! important; visibility: visible ! important; height: auto ! important;" width="auto"/><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/><span style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"></span></p><p style="white-space: normal;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><br/></p><p><br/></p><section data-id="29735" class="135editor" style="white-space: normal; margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; color: rgb(62, 62, 62); line-height: 25px; background-color: rgb(255, 255, 255); border: 0px none; font-family: 微软雅黑; word-wrap: break-word !important;"><section data-width="92px" style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; width: 92px; border-color: rgb(12, 137, 24); word-wrap: break-word !important;"><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; max-width: 100%; min-height: 1em; white-space: pre-wrap; text-align: center; color: inherit; line-height: 2em; border-color: rgb(12, 137, 24); box-sizing: border-box !important; word-wrap: break-word !important;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p></section><section style="margin: 0px; padding: 0px 5px; max-width: 100%; box-sizing: border-box; line-height: 10px; color: inherit; border: 1px solid rgb(12, 137, 24); word-wrap: break-word !important;"><section data-width="50%" style="margin: -8px 0px 0px 140px; padding: 0px; max-width: 100%; box-sizing: border-box; color: inherit; height: 8px; width: 329px; background-color: rgb(254, 254, 254); border-color: rgb(12, 137, 24); word-wrap: break-word !important;"><section data-width="8px" style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; width: 8px; height: 8px; border-top-left-radius: 100%; border-top-right-radius: 100%; border-bottom-right-radius: 100%; border-bottom-left-radius: 100%; line-height: 1; font-size: 18px; text-decoration: inherit; border-color: rgb(45, 206, 60); display: inline-block; color: rgb(255, 255, 255); background-color: rgb(12, 137, 24); word-wrap: break-word !important;"></section></section><p style="margin: 15px; padding: 0px; max-width: 100%; min-height: 1em; white-space: pre-wrap; line-height: 2em; font-size: 14px; text-indent: 2em; box-sizing: border-box !important; word-wrap: break-word !important;">喀纳斯有湖边栈道，尽管不像九寨沟那样完整，但是如果想要避开大批的人流，静静地欣赏三湾（神仙湾、月亮湾、卧龙湾）的美景，沿栈道一路走下去是一个明智的选择。月亮湾和卧龙湾的栈道是互相连接的，距离约2km 左右。</p><section data-width="65%" style="margin: 0px 0px -4px 25px; padding: 0px; max-width: 100%; box-sizing: border-box; background-color: rgb(254, 254, 254); color: inherit; text-align: right; height: 10px; width: 427.6875px; border-color: rgb(12, 137, 24); word-wrap: break-word !important;"><section data-width="8px" style="margin: 0px auto 1px; padding: 0px; max-width: 100%; box-sizing: border-box; border-top-left-radius: 100%; border-top-right-radius: 100%; border-bottom-right-radius: 100%; border-bottom-left-radius: 100%; line-height: 1; text-decoration: inherit; background-color: rgb(12, 137, 24); border-color: rgb(45, 206, 60); display: inline-block; height: 8px; width: 8px; color: rgb(255, 255, 255); word-wrap: break-word !important;"></section></section></section><section style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; width: 0px; height: 0px; clear: both; word-wrap: break-word !important;"></section></section><p><br/></p><p style="white-space: normal;"><br/></p><p style="white-space: normal;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><br/></p><p><br/></p><section data-id="85616" class="135editor" style="white-space: normal; margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; color: rgb(62, 62, 62); line-height: 25px; background-color: rgb(255, 255, 255); border: 0px none; font-family: 微软雅黑; word-wrap: break-word !important;"><section style="margin: 0px; padding: 10px; max-width: 100%; box-sizing: border-box; word-wrap: break-word; line-height: 2em; word-break: normal; text-align: center; background-color: rgb(12, 137, 24); color: rgb(255, 255, 255); border-color: rgb(45, 206, 60);"><strong style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"><span class="135brush" data-brushtype="text" style="margin: 0px; padding: 0px; max-width: 100%; color: inherit; box-sizing: border-box !important; word-wrap: break-word !important;">NO.3 西藏纳木错湖</span></strong></section><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; max-width: 100%; min-height: 1em; white-space: pre-wrap; border-color: rgb(12, 137, 24); box-sizing: border-box !important; word-wrap: break-word !important;"><img src="http://mmbiz.qpic.cn/mmbiz/yqVAqoZvDibFa8hbzHetsNTXuYCBmRffsYZ8PRWZtwBxfyibqc9iaXu1bJLt4NAtw2NIxWNJ4GoKakhs0Qlyz3MMw/640?wx_fmt=png&wxfrom=5&wx_lazy=1" _width="670px" data-src="http://mmbiz.qpic.cn/mmbiz/yqVAqoZvDibFa8hbzHetsNTXuYCBmRffsYZ8PRWZtwBxfyibqc9iaXu1bJLt4NAtw2NIxWNJ4GoKakhs0Qlyz3MMw/0?wx_fmt=png" data-width="100%" data-ratio="0.06560636182902585" data-w="" style="margin: 0px; padding: 0px; border-color: rgb(12, 137, 24); color: inherit; box-sizing: border-box ! important; word-wrap: break-word ! important; width: 670px ! important; visibility: visible ! important; height: auto ! important;" width="670px"/></p></section><p><br/></p><p style="white-space: normal;"><br/></p><p style="white-space: normal;"><img src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5H3qka7wWaF3fttpRDiaZpaU3SvHdhGTfUPfBkia9r3Yx7XWR4dOPwtYYQ/640?wx_fmt=jpeg&wxfrom=5&wx_lazy=1" _width="auto" data-s="300,640" data-type="jpeg" data-src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5H3qka7wWaF3fttpRDiaZpaU3SvHdhGTfUPfBkia9r3Yx7XWR4dOPwtYYQ/0?wx_fmt=jpeg" data-ratio="0.6640159045725647" data-w="" style="margin: 0px; padding: 0px; box-sizing: border-box ! important; word-wrap: break-word ! important; width: auto ! important; visibility: visible ! important; height: auto ! important;" width="auto"/></p><p style="white-space: normal;"><img src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5HrysyYxAc0Y0rHQkTxwv1icPCYsDFnicugQNT6Fan040koQYETias93D3A/640?wx_fmt=jpeg&wxfrom=5&wx_lazy=1" _width="auto" data-s="300,640" data-type="jpeg" data-src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5HrysyYxAc0Y0rHQkTxwv1icPCYsDFnicugQNT6Fan040koQYETias93D3A/0?wx_fmt=jpeg" data-ratio="0.6640159045725647" data-w="" style="margin: 0px; padding: 0px; box-sizing: border-box ! important; word-wrap: break-word ! important; width: auto ! important; visibility: visible ! important; height: auto ! important;" width="auto"/><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><span style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"><img src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5HzOVblaTa7kXJUz9A2IibqGlmnZz4wIA0mwyBgAaMGMPUlDl0rXrJNPA/640?wx_fmt=jpeg&wxfrom=5&wx_lazy=1" _width="auto" data-s="300,640" data-type="jpeg" data-src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5HzOVblaTa7kXJUz9A2IibqGlmnZz4wIA0mwyBgAaMGMPUlDl0rXrJNPA/0?wx_fmt=jpeg" data-ratio="0.6679920477137177" data-w="" style="margin: 0px; padding: 0px; box-sizing: border-box ! important; word-wrap: break-word ! important; width: auto ! important; visibility: visible ! important; height: auto ! important;" width="auto"/><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></span></p><p style="white-space: normal;"><br/></p><p><br/></p><section data-id="29735" class="135editor" style="white-space: normal; margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; color: rgb(62, 62, 62); line-height: 25px; background-color: rgb(255, 255, 255); border: 0px none; font-family: 微软雅黑; word-wrap: break-word !important;"><section data-width="92px" style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; width: 92px; border-color: rgb(12, 137, 24); word-wrap: break-word !important;"><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; max-width: 100%; min-height: 1em; white-space: pre-wrap; text-align: center; color: inherit; line-height: 2em; border-color: rgb(12, 137, 24); box-sizing: border-box !important; word-wrap: break-word !important;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p></section><section style="margin: 0px; padding: 0px 5px; max-width: 100%; box-sizing: border-box; line-height: 10px; color: inherit; border: 1px solid rgb(12, 137, 24); word-wrap: break-word !important;"><section data-width="50%" style="margin: -8px 0px 0px 140px; padding: 0px; max-width: 100%; box-sizing: border-box; color: inherit; height: 8px; width: 329px; background-color: rgb(254, 254, 254); border-color: rgb(12, 137, 24); word-wrap: break-word !important;"><section data-width="8px" style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; width: 8px; height: 8px; border-top-left-radius: 100%; border-top-right-radius: 100%; border-bottom-right-radius: 100%; border-bottom-left-radius: 100%; line-height: 1; font-size: 18px; text-decoration: inherit; border-color: rgb(45, 206, 60); display: inline-block; color: rgb(255, 255, 255); background-color: rgb(12, 137, 24); word-wrap: break-word !important;"></section></section><p style="margin: 15px; padding: 0px; max-width: 100%; min-height: 1em; white-space: pre-wrap; line-height: 2em; font-size: 14px; text-indent: 2em; box-sizing: border-box !important; word-wrap: break-word !important;">纳木错是西藏最大的湖泊，平均海拔4700m，与日喀则地区的羊卓雍错、阿里地区的玛旁雍错同为西藏三大神湖。纳木错被善男信女视为必去的神圣之地，每到羊年，僧人信徒不惜长途跋涉都要前往转湖一次。转湖在藏历羊年的四月十五（佛吉祥日）达到高潮，届时信徒如潮如云，盛况空前。湖中有5个岛屿，最大的是扎西半岛。顺时针环岛一周约2小时，在快回到旅馆的地方还可见到100多米长的玛尼墙。</p><section data-width="65%" style="margin: 0px 0px -4px 25px; padding: 0px; max-width: 100%; box-sizing: border-box; background-color: rgb(254, 254, 254); color: inherit; text-align: right; height: 10px; width: 427.6875px; border-color: rgb(12, 137, 24); word-wrap: break-word !important;"><section data-width="8px" style="margin: 0px auto 1px; padding: 0px; max-width: 100%; box-sizing: border-box; border-top-left-radius: 100%; border-top-right-radius: 100%; border-bottom-right-radius: 100%; border-bottom-left-radius: 100%; line-height: 1; text-decoration: inherit; background-color: rgb(12, 137, 24); border-color: rgb(45, 206, 60); display: inline-block; height: 8px; width: 8px; color: rgb(255, 255, 255); word-wrap: break-word !important;"></section></section></section><section style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; width: 0px; height: 0px; clear: both; word-wrap: break-word !important;"></section></section><p><br/></p><p style="white-space: normal;"><br/></p><p style="white-space: normal;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><br/></p><p><br/></p><section data-id="85616" class="135editor" style="white-space: normal; margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; color: rgb(62, 62, 62); line-height: 25px; background-color: rgb(255, 255, 255); border: 0px none; font-family: 微软雅黑; word-wrap: break-word !important;"><section style="margin: 0px; padding: 10px; max-width: 100%; box-sizing: border-box; word-wrap: break-word; line-height: 2em; word-break: normal; text-align: center; background-color: rgb(12, 137, 24); color: rgb(255, 255, 255); border-color: rgb(45, 206, 60);"><strong style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"><span class="135brush" data-brushtype="text" style="margin: 0px; padding: 0px; max-width: 100%; color: inherit; box-sizing: border-box !important; word-wrap: break-word !important;">NO.4 吉林长白山天池</span></strong></section><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; max-width: 100%; min-height: 1em; white-space: pre-wrap; border-color: rgb(12, 137, 24); box-sizing: border-box !important; word-wrap: break-word !important;"><img src="http://mmbiz.qpic.cn/mmbiz/yqVAqoZvDibFa8hbzHetsNTXuYCBmRffsYZ8PRWZtwBxfyibqc9iaXu1bJLt4NAtw2NIxWNJ4GoKakhs0Qlyz3MMw/640?wx_fmt=png&wxfrom=5&wx_lazy=1" _width="670px" data-src="http://mmbiz.qpic.cn/mmbiz/yqVAqoZvDibFa8hbzHetsNTXuYCBmRffsYZ8PRWZtwBxfyibqc9iaXu1bJLt4NAtw2NIxWNJ4GoKakhs0Qlyz3MMw/0?wx_fmt=png" data-width="100%" data-ratio="0.06560636182902585" data-w="" style="margin: 0px; padding: 0px; border-color: rgb(12, 137, 24); color: inherit; box-sizing: border-box ! important; word-wrap: break-word ! important; width: 670px ! important; visibility: visible ! important; height: auto ! important;" width="670px"/></p></section><p><br/></p><p style="white-space: normal;"><br/></p><p style="white-space: normal;"><img src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5HvZK2CV4mICF3j5fZ2nqUDPJyY2ibqEtn77dJA9xcQuAzZCCj38a5mfA/640?wx_fmt=jpeg&wxfrom=5&wx_lazy=1" _width="auto" data-s="300,640" data-type="jpeg" data-src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5HvZK2CV4mICF3j5fZ2nqUDPJyY2ibqEtn77dJA9xcQuAzZCCj38a5mfA/0?wx_fmt=jpeg" data-ratio="0.8230616302186878" data-w="" style="margin: 0px; padding: 0px; box-sizing: border-box ! important; word-wrap: break-word ! important; width: auto ! important; visibility: visible ! important; height: auto ! important;" width="auto"/><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/><img src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5HAbPMc4XFJX1Ymq8HFL4bq6sbuqCKgrUicS55otZGKPCVHmawYyn4rEA/640?wx_fmt=jpeg&wxfrom=5&wx_lazy=1" _width="auto" data-s="300,640" data-type="jpeg" data-src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5HAbPMc4XFJX1Ymq8HFL4bq6sbuqCKgrUicS55otZGKPCVHmawYyn4rEA/0?wx_fmt=jpeg" data-ratio="0.6679920477137177" data-w="" style="margin: 0px; padding: 0px; box-sizing: border-box ! important; word-wrap: break-word ! important; width: auto ! important; visibility: visible ! important; height: auto ! important;" width="auto"/><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><img src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5Hc5eRJvYFlxCSicoQ9GALA4at9P4CkPib6VpHzEP3ghawUBBVBtdvUF5w/640?wx_fmt=jpeg&wxfrom=5&wx_lazy=1" _width="auto" data-s="300,640" data-type="jpeg" data-src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5Hc5eRJvYFlxCSicoQ9GALA4at9P4CkPib6VpHzEP3ghawUBBVBtdvUF5w/0?wx_fmt=jpeg" data-ratio="0.6679920477137177" data-w="" style="margin: 0px; padding: 0px; box-sizing: border-box ! important; word-wrap: break-word ! important; width: auto ! important; visibility: visible ! important; height: auto ! important;" width="auto"/><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><img src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5HK8WcjqtRBmva6XDiaErAeCEyn6ZsC9ZxVnOeTUvPXvwoaU9vic4Ws76g/640?wx_fmt=jpeg&wxfrom=5&wx_lazy=1" _width="auto" data-s="300,640" data-type="jpeg" data-src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5HK8WcjqtRBmva6XDiaErAeCEyn6ZsC9ZxVnOeTUvPXvwoaU9vic4Ws76g/0?wx_fmt=jpeg" data-ratio="0.7276341948310139" data-w="" style="margin: 0px; padding: 0px; box-sizing: border-box ! important; word-wrap: break-word ! important; width: auto ! important; visibility: visible ! important; height: auto ! important;" width="auto"/><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><br/></p><p><br/></p><section data-id="29735" class="135editor" style="white-space: normal; margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; color: rgb(62, 62, 62); line-height: 25px; background-color: rgb(255, 255, 255); border: 0px none; font-family: 微软雅黑; word-wrap: break-word !important;"><section data-width="92px" style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; width: 92px; border-color: rgb(12, 137, 24); word-wrap: break-word !important;"><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; max-width: 100%; min-height: 1em; white-space: pre-wrap; text-align: center; color: inherit; line-height: 2em; border-color: rgb(12, 137, 24); box-sizing: border-box !important; word-wrap: break-word !important;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p></section><section style="margin: 0px; padding: 0px 5px; max-width: 100%; box-sizing: border-box; line-height: 10px; color: inherit; border: 1px solid rgb(12, 137, 24); word-wrap: break-word !important;"><section data-width="50%" style="margin: -8px 0px 0px 140px; padding: 0px; max-width: 100%; box-sizing: border-box; color: inherit; height: 8px; width: 329px; background-color: rgb(254, 254, 254); border-color: rgb(12, 137, 24); word-wrap: break-word !important;"><section data-width="8px" style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; width: 8px; height: 8px; border-top-left-radius: 100%; border-top-right-radius: 100%; border-bottom-right-radius: 100%; border-bottom-left-radius: 100%; line-height: 1; font-size: 18px; text-decoration: inherit; border-color: rgb(45, 206, 60); display: inline-block; color: rgb(255, 255, 255); background-color: rgb(12, 137, 24); word-wrap: break-word !important;"></section></section><p style="margin: 15px; padding: 0px; max-width: 100%; min-height: 1em; white-space: pre-wrap; line-height: 2em; font-size: 14px; text-indent: 2em; box-sizing: border-box !important; word-wrap: break-word !important;">天池水面海拔达2150 米，因其所处的位置高而得名，天池是火山喷发自然形成的火山口湖，呈椭圆形，当火山喷射出大量熔岩之后，火山口处形成盆状，时间一长，在雨水、雪水和地下泉水的作用下，积水成湖，就形成了现在的天池。天池湖面面积10 平方公里，是一个巨大的天然水库，在周围十六座山峰的环抱中，沉静清澈的天池犹如一块碧玉一般，给人以神秘莫测之感。游天池最佳时节是在盛夏，这时云雾较少，容易一睹天池的真面目。</p><section data-width="65%" style="margin: 0px 0px -4px 25px; padding: 0px; max-width: 100%; box-sizing: border-box; background-color: rgb(254, 254, 254); color: inherit; text-align: right; height: 10px; width: 427.6875px; border-color: rgb(12, 137, 24); word-wrap: break-word !important;"><section data-width="8px" style="margin: 0px auto 1px; padding: 0px; max-width: 100%; box-sizing: border-box; border-top-left-radius: 100%; border-top-right-radius: 100%; border-bottom-right-radius: 100%; border-bottom-left-radius: 100%; line-height: 1; text-decoration: inherit; background-color: rgb(12, 137, 24); border-color: rgb(45, 206, 60); display: inline-block; height: 8px; width: 8px; color: rgb(255, 255, 255); word-wrap: break-word !important;"></section></section></section><section style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; width: 0px; height: 0px; clear: both; word-wrap: break-word !important;"></section></section><p><br/></p><p style="white-space: normal;"><br/></p><p style="white-space: normal;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><br/></p><p><br/></p><section data-id="85616" class="135editor" style="white-space: normal; margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; color: rgb(62, 62, 62); line-height: 25px; background-color: rgb(255, 255, 255); border: 0px none; font-family: 微软雅黑; word-wrap: break-word !important;"><section style="margin: 0px; padding: 10px; max-width: 100%; box-sizing: border-box; word-wrap: break-word; line-height: 2em; word-break: normal; text-align: center; background-color: rgb(12, 137, 24); color: rgb(255, 255, 255); border-color: rgb(45, 206, 60);"><strong style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"><span class="135brush" data-brushtype="text" style="margin: 0px; padding: 0px; max-width: 100%; color: inherit; box-sizing: border-box !important; word-wrap: break-word !important;">NO.5 福建武夷山</span></strong></section><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; max-width: 100%; min-height: 1em; white-space: pre-wrap; border-color: rgb(12, 137, 24); box-sizing: border-box !important; word-wrap: break-word !important;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p></section><p><br/></p><p style="white-space: normal;"><br/></p><p style="white-space: normal;"><img src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5H9nZz7kibUahMEicIx0FEuHe6u80lic78zMUsjmKVxyT6SpugiaZiaQ41wXw/640?wx_fmt=jpeg&wxfrom=5&wx_lazy=1" _width="auto" data-s="300,640" data-type="jpeg" data-src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5H9nZz7kibUahMEicIx0FEuHe6u80lic78zMUsjmKVxyT6SpugiaZiaQ41wXw/0?wx_fmt=jpeg" data-ratio="0.6679920477137177" data-w="" style="margin: 0px; padding: 0px; box-sizing: border-box ! important; word-wrap: break-word ! important; width: auto ! important; visibility: visible ! important; height: auto ! important;" width="auto"/><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><img src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5HDfG354Jwwoh7RdjUhlIOu8tDeJcoYiaGzHRlhgCb3hWFwpKOhPQaVzg/640?wx_fmt=jpeg&wxfrom=5&wx_lazy=1" _width="auto" data-s="300,640" data-type="jpeg" data-src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5HDfG354Jwwoh7RdjUhlIOu8tDeJcoYiaGzHRlhgCb3hWFwpKOhPQaVzg/0?wx_fmt=jpeg" data-ratio="0.6640159045725647" data-w="" style="margin: 0px; padding: 0px; box-sizing: border-box ! important; word-wrap: break-word ! important; width: auto ! important; visibility: visible ! important; height: auto ! important;" width="auto"/><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><br/></p><p><br/></p><section data-id="29735" class="135editor" style="white-space: normal; margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; color: rgb(62, 62, 62); line-height: 25px; background-color: rgb(255, 255, 255); border: 0px none; font-family: 微软雅黑; word-wrap: break-word !important;"><section data-width="92px" style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; width: 92px; border-color: rgb(12, 137, 24); word-wrap: break-word !important;"><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; max-width: 100%; min-height: 1em; white-space: pre-wrap; text-align: center; color: inherit; line-height: 2em; border-color: rgb(12, 137, 24); box-sizing: border-box !important; word-wrap: break-word !important;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p></section><section style="margin: 0px; padding: 0px 5px; max-width: 100%; box-sizing: border-box; line-height: 10px; color: inherit; border: 1px solid rgb(12, 137, 24); word-wrap: break-word !important;"><section data-width="50%" style="margin: -8px 0px 0px 140px; padding: 0px; max-width: 100%; box-sizing: border-box; color: inherit; height: 8px; width: 329px; background-color: rgb(254, 254, 254); border-color: rgb(12, 137, 24); word-wrap: break-word !important;"><section data-width="8px" style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; width: 8px; height: 8px; border-top-left-radius: 100%; border-top-right-radius: 100%; border-bottom-right-radius: 100%; border-bottom-left-radius: 100%; line-height: 1; font-size: 18px; text-decoration: inherit; border-color: rgb(45, 206, 60); display: inline-block; color: rgb(255, 255, 255); background-color: rgb(12, 137, 24); word-wrap: break-word !important;"></section></section><p style="margin: 15px; padding: 0px; max-width: 100%; min-height: 1em; white-space: pre-wrap; line-height: 2em; font-size: 14px; text-indent: 2em; box-sizing: border-box !important; word-wrap: break-word !important;">武夷山位于福建省北部，是是国家5A级风景区，更是世界文化与自然遗产双重遗产地，曾被《孤星旅游指南》评为“全球十大最幸福地方”之一。武夷山素有“碧水丹山”的称号，奇峰险峻，碧水潺潺，幽谷险壑，古树参天，“奇、秀、美、古”的动人美景让人叹为观止；这里独特的丹霞地貌，从古至今吸引了无数文人墨客留下动人篇章；武夷山还具有丰富的历史文化遗产，道教传说、悬棺文化让这里的山水更多了一分灵秀之气。</p><section data-width="65%" style="margin: 0px 0px -4px 25px; padding: 0px; max-width: 100%; box-sizing: border-box; background-color: rgb(254, 254, 254); color: inherit; text-align: right; height: 10px; width: 427.6875px; border-color: rgb(12, 137, 24); word-wrap: break-word !important;"><section data-width="8px" style="margin: 0px auto 1px; padding: 0px; max-width: 100%; box-sizing: border-box; border-top-left-radius: 100%; border-top-right-radius: 100%; border-bottom-right-radius: 100%; border-bottom-left-radius: 100%; line-height: 1; text-decoration: inherit; background-color: rgb(12, 137, 24); border-color: rgb(45, 206, 60); display: inline-block; height: 8px; width: 8px; color: rgb(255, 255, 255); word-wrap: break-word !important;"></section></section></section><section style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; width: 0px; height: 0px; clear: both; word-wrap: break-word !important;"></section></section><p><br/></p><p style="white-space: normal;"><br/></p><p style="white-space: normal;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><br/></p><p><br/></p><section data-id="85616" class="135editor" style="white-space: normal; margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; color: rgb(62, 62, 62); line-height: 25px; background-color: rgb(255, 255, 255); border: 0px none; font-family: 微软雅黑; word-wrap: break-word !important;"><section style="margin: 0px; padding: 10px; max-width: 100%; box-sizing: border-box; word-wrap: break-word; line-height: 2em; word-break: normal; text-align: center; background-color: rgb(12, 137, 24); color: rgb(255, 255, 255); border-color: rgb(45, 206, 60);"><strong style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"><span class="135brush" data-brushtype="text" style="margin: 0px; padding: 0px; max-width: 100%; color: inherit; box-sizing: border-box !important; word-wrap: break-word !important;">NO.6 新疆唐布拉草原</span></strong></section><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; max-width: 100%; min-height: 1em; white-space: pre-wrap; border-color: rgb(12, 137, 24); box-sizing: border-box !important; word-wrap: break-word !important;"><img src="http://mmbiz.qpic.cn/mmbiz/yqVAqoZvDibFa8hbzHetsNTXuYCBmRffsYZ8PRWZtwBxfyibqc9iaXu1bJLt4NAtw2NIxWNJ4GoKakhs0Qlyz3MMw/640?wx_fmt=png&wxfrom=5&wx_lazy=1" _width="670px" data-src="http://mmbiz.qpic.cn/mmbiz/yqVAqoZvDibFa8hbzHetsNTXuYCBmRffsYZ8PRWZtwBxfyibqc9iaXu1bJLt4NAtw2NIxWNJ4GoKakhs0Qlyz3MMw/0?wx_fmt=png" data-width="100%" data-ratio="0.06560636182902585" data-w="" style="margin: 0px; padding: 0px; border-color: rgb(12, 137, 24); color: inherit; box-sizing: border-box ! important; word-wrap: break-word ! important; width: 670px ! important; visibility: visible ! important; height: auto ! important;" width="670px"/></p></section><p><br/></p><p style="white-space: normal;"><br/></p><p style="white-space: normal;"><img src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5HKHz9xEmAp00ibplJCicVHcVwBtkR5WWeLibg1PoheSqTJYj1ttZe78hxQ/640?wx_fmt=jpeg&wxfrom=5&wx_lazy=1" _width="auto" data-s="300,640" data-type="jpeg" data-src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5HKHz9xEmAp00ibplJCicVHcVwBtkR5WWeLibg1PoheSqTJYj1ttZe78hxQ/0?wx_fmt=jpeg" data-ratio="0.6341948310139165" data-w="" style="margin: 0px; padding: 0px; box-sizing: border-box ! important; word-wrap: break-word ! important; width: auto ! important; visibility: visible ! important; height: auto ! important;" width="auto"/><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><img src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5HIPZ5He2wrlOfy2WHHv1ze6YeajLzicUtnY3nbbojpZGTrOTjyVd2bIw/640?wx_fmt=jpeg&wxfrom=5&wx_lazy=1" _width="auto" data-s="300,640" data-type="jpeg" data-src="http://mmbiz.qpic.cn/mmbiz/jLVlTC1NjhibXiboA7ng3JaJA3fVOHyq5HIPZ5He2wrlOfy2WHHv1ze6YeajLzicUtnY3nbbojpZGTrOTjyVd2bIw/0?wx_fmt=jpeg" data-ratio="0.6679920477137177" data-w="" style="margin: 0px; padding: 0px; box-sizing: border-box ! important; word-wrap: break-word ! important; width: auto ! important; visibility: visible ! important; height: auto ! important;" width="auto"/><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><br/></p><p><br/></p><section data-id="29735" class="135editor" style="white-space: normal; margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; color: rgb(62, 62, 62); line-height: 25px; background-color: rgb(255, 255, 255); border: 0px none; font-family: 微软雅黑; word-wrap: break-word !important;"><section data-width="92px" style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; width: 92px; border-color: rgb(12, 137, 24); word-wrap: break-word !important;"><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; max-width: 100%; min-height: 1em; white-space: pre-wrap; text-align: center; color: inherit; line-height: 2em; border-color: rgb(12, 137, 24); box-sizing: border-box !important; word-wrap: break-word !important;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p></section><section style="margin: 0px; padding: 0px 5px; max-width: 100%; box-sizing: border-box; line-height: 10px; color: inherit; border: 1px solid rgb(12, 137, 24); word-wrap: break-word !important;"><section data-width="50%" style="margin: -8px 0px 0px 140px; padding: 0px; max-width: 100%; box-sizing: border-box; color: inherit; height: 8px; width: 329px; background-color: rgb(254, 254, 254); border-color: rgb(12, 137, 24); word-wrap: break-word !important;"><section data-width="8px" style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; width: 8px; height: 8px; border-top-left-radius: 100%; border-top-right-radius: 100%; border-bottom-right-radius: 100%; border-bottom-left-radius: 100%; line-height: 1; font-size: 18px; text-decoration: inherit; border-color: rgb(45, 206, 60); display: inline-block; color: rgb(255, 255, 255); background-color: rgb(12, 137, 24); word-wrap: break-word !important;"></section></section><p style="margin: 15px; padding: 0px; max-width: 100%; min-height: 1em; white-space: pre-wrap; line-height: 2em; font-size: 14px; text-indent: 2em; box-sizing: border-box !important; word-wrap: break-word !important;">唐布拉草原得名于阿吾拉勒山北坡唐布拉沟东侧有几处突兀的岩石，因岩石酷似玉玺、印章而得名，唐布拉草原意即“印章”。唐布拉草原有奇特的阿尔斯郎石林，壮观的草原落日，冰峰雪岭倒映在静寂幽深的高山湖泊之中，温热清爽的温泉，蓝天白云，芳草萋萋，唐布拉沟内溪水淙淙，云杉林苍翠挺拔，唐布拉沟内林区山清水秀、清爽宜人，夏季如画如屏，层峦叠翠，每时每刻给人以美的享受。</p><section data-width="65%" style="margin: 0px 0px -4px 25px; padding: 0px; max-width: 100%; box-sizing: border-box; background-color: rgb(254, 254, 254); color: inherit; text-align: right; height: 10px; width: 427.6875px; border-color: rgb(12, 137, 24); word-wrap: break-word !important;"><section data-width="8px" style="margin: 0px auto 1px; padding: 0px; max-width: 100%; box-sizing: border-box; border-top-left-radius: 100%; border-top-right-radius: 100%; border-bottom-right-radius: 100%; border-bottom-left-radius: 100%; line-height: 1; text-decoration: inherit; background-color: rgb(12, 137, 24); border-color: rgb(45, 206, 60); display: inline-block; height: 8px; width: 8px; color: rgb(255, 255, 255); word-wrap: break-word !important;"></section></section></section><section style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; width: 0px; height: 0px; clear: both; word-wrap: break-word !important;"></section></section><p><br/></p><p style="white-space: normal;"><br/></p><p style="white-space: normal;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><br/></p><p><br/></p><section data-id="85616" class="135editor" style="white-space: normal; margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; color: rgb(62, 62, 62); line-height: 25px; background-color: rgb(255, 255, 255); border: 0px none; font-family: 微软雅黑; word-wrap: break-word !important;"><section style="margin: 0px; padding: 10px; max-width: 100%; box-sizing: border-box; word-wrap: break-word; line-height: 2em; word-break: normal; text-align: center; background-color: rgb(12, 137, 24); color: rgb(255, 255, 255); border-color: rgb(45, 206, 60);"><strong style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"><span class="135brush" data-brushtype="text" style="margin: 0px; padding: 0px; max-width: 100%; color: inherit; box-sizing: border-box !important; word-wrap: break-word !important;">NO.7 甘肃张掖丹霞地貌</span></strong></section><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; max-width: 100%; min-height: 1em; white-space: pre-wrap; border-color: rgb(12, 137, 24); box-sizing: border-box !important; word-wrap: break-word !important;"><br/></p></section><p><br/></p><p style="white-space: normal;"><br/></p><p style="white-space: normal;"><br/></p><p style="white-space: normal;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><br/></p><p><br/></p><section data-id="29735" class="135editor" style="white-space: normal; margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; color: rgb(62, 62, 62); line-height: 25px; background-color: rgb(255, 255, 255); border: 0px none; font-family: 微软雅黑; word-wrap: break-word !important;"><section data-width="92px" style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; width: 92px; border-color: rgb(12, 137, 24); word-wrap: break-word !important;"><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; max-width: 100%; min-height: 1em; white-space: pre-wrap; text-align: center; color: inherit; line-height: 2em; border-color: rgb(12, 137, 24); box-sizing: border-box !important; word-wrap: break-word !important;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p></section><section style="margin: 0px; padding: 0px 5px; max-width: 100%; box-sizing: border-box; line-height: 10px; color: inherit; border: 1px solid rgb(12, 137, 24); word-wrap: break-word !important;"><section data-width="50%" style="margin: -8px 0px 0px 140px; padding: 0px; max-width: 100%; box-sizing: border-box; color: inherit; height: 8px; width: 329px; background-color: rgb(254, 254, 254); border-color: rgb(12, 137, 24); word-wrap: break-word !important;"><section data-width="8px" style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; width: 8px; height: 8px; border-top-left-radius: 100%; border-top-right-radius: 100%; border-bottom-right-radius: 100%; border-bottom-left-radius: 100%; line-height: 1; font-size: 18px; text-decoration: inherit; border-color: rgb(45, 206, 60); display: inline-block; color: rgb(255, 255, 255); background-color: rgb(12, 137, 24); word-wrap: break-word !important;"></section></section><p style="margin: 15px; padding: 0px; max-width: 100%; min-height: 1em; white-space: pre-wrap; line-height: 2em; font-size: 14px; text-indent: 2em; box-sizing: border-box !important; word-wrap: break-word !important;">张掖位于甘肃省西北部，距兰州547km，是古时河西走廊四郡之一，旧称“甘州”，地理位置险要：西接酒泉、嘉峪关，东邻武威，与武威并称“金张掖，银武威”，往北到达巴丹吉林沙漠入内蒙，向南翻越祁连山可至青海。张掖的出名缘于丹霞地貌，丹霞的出名则缘于张艺谋在此拍摄的一部电影——《三枪拍案惊奇》。</p><section data-width="65%" style="margin: 0px 0px -4px 25px; padding: 0px; max-width: 100%; box-sizing: border-box; background-color: rgb(254, 254, 254); color: inherit; text-align: right; height: 10px; width: 427.6875px; border-color: rgb(12, 137, 24); word-wrap: break-word !important;"><section data-width="8px" style="margin: 0px auto 1px; padding: 0px; max-width: 100%; box-sizing: border-box; border-top-left-radius: 100%; border-top-right-radius: 100%; border-bottom-right-radius: 100%; border-bottom-left-radius: 100%; line-height: 1; text-decoration: inherit; background-color: rgb(12, 137, 24); border-color: rgb(45, 206, 60); display: inline-block; height: 8px; width: 8px; color: rgb(255, 255, 255); word-wrap: break-word !important;"></section></section></section><section style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; width: 0px; height: 0px; clear: both; word-wrap: break-word !important;"></section></section><p><br/></p><p style="white-space: normal;"><br/></p><p style="white-space: normal;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><br/></p><p><br/></p><section data-id="29735" class="135editor" style="white-space: normal; margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; color: rgb(62, 62, 62); line-height: 25px; background-color: rgb(255, 255, 255); border: 0px none; font-family: 微软雅黑; word-wrap: break-word !important;"><section data-width="92px" style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; width: 92px; border-color: rgb(12, 137, 24); word-wrap: break-word !important;"><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; max-width: 100%; min-height: 1em; white-space: pre-wrap; text-align: center; color: inherit; line-height: 2em; border-color: rgb(12, 137, 24); box-sizing: border-box !important; word-wrap: break-word !important;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p></section><section style="margin: 0px; padding: 0px 5px; max-width: 100%; box-sizing: border-box; line-height: 10px; color: inherit; border: 1px solid rgb(12, 137, 24); word-wrap: break-word !important;"><section data-width="50%" style="margin: -8px 0px 0px 140px; padding: 0px; max-width: 100%; box-sizing: border-box; color: inherit; height: 8px; width: 329px; background-color: rgb(254, 254, 254); border-color: rgb(12, 137, 24); word-wrap: break-word !important;"><section data-width="8px" style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; width: 8px; height: 8px; border-top-left-radius: 100%; border-top-right-radius: 100%; border-bottom-right-radius: 100%; border-bottom-left-radius: 100%; line-height: 1; font-size: 18px; text-decoration: inherit; border-color: rgb(45, 206, 60); display: inline-block; color: rgb(255, 255, 255); background-color: rgb(12, 137, 24); word-wrap: break-word !important;"></section></section><p style="margin: 15px; padding: 0px; max-width: 100%; min-height: 1em; white-space: pre-wrap; line-height: 2em; font-size: 14px; text-indent: 2em; box-sizing: border-box !important; word-wrap: break-word !important;">张掖丹霞论色彩为全国一等，雨后欣赏尤为浪漫。除丹霞外，张掖必游的另一个景点是祁连山脚下的马蹄寺，马蹄寺有着开阔的森林草甸，自然风光优美，生活着90%能歌善舞的裕固族人。正所谓“不望祁连山上雪，错把张掖当江南”，来到张掖，你会发现粗犷的大西北也有柔美的一面。</p><section data-width="65%" style="margin: 0px 0px -4px 25px; padding: 0px; max-width: 100%; box-sizing: border-box; background-color: rgb(254, 254, 254); color: inherit; text-align: right; height: 10px; width: 427.6875px; border-color: rgb(12, 137, 24); word-wrap: break-word !important;"><section data-width="8px" style="margin: 0px auto 1px; padding: 0px; max-width: 100%; box-sizing: border-box; border-top-left-radius: 100%; border-top-right-radius: 100%; border-bottom-right-radius: 100%; border-bottom-left-radius: 100%; line-height: 1; text-decoration: inherit; background-color: rgb(12, 137, 24); border-color: rgb(45, 206, 60); display: inline-block; height: 8px; width: 8px; color: rgb(255, 255, 255); word-wrap: break-word !important;"></section></section></section><section style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; width: 0px; height: 0px; clear: both; word-wrap: break-word !important;"></section></section><p><br/></p><p style="white-space: normal;"><br/></p><p style="white-space: normal;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p><p style="white-space: normal;"><br/></p><p><br/></p><section data-id="85616" class="135editor" style="white-space: normal; margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; color: rgb(62, 62, 62); line-height: 25px; background-color: rgb(255, 255, 255); border: 0px none; font-family: 微软雅黑; word-wrap: break-word !important;"><section style="margin: 0px; padding: 10px; max-width: 100%; box-sizing: border-box; word-wrap: break-word; line-height: 2em; word-break: normal; text-align: center; background-color: rgb(12, 137, 24); color: rgb(255, 255, 255); border-color: rgb(45, 206, 60);"><strong style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"><span class="135brush" data-brushtype="text" style="margin: 0px; padding: 0px; max-width: 100%; color: inherit; box-sizing: border-box !important; word-wrap: break-word !important;">NO.8 贵州万峰林</span></strong></section></section><section data-id="29735" class="135editor" style="white-space: normal; margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; color: rgb(62, 62, 62); line-height: 25px; background-color: rgb(255, 255, 255); border: 0px none; font-family: 微软雅黑; word-wrap: break-word !important;"><section data-width="92px" style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; width: 92px; border-color: rgb(12, 137, 24); word-wrap: break-word !important;"><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; max-width: 100%; min-height: 1em; white-space: pre-wrap; text-align: center; color: inherit; line-height: 2em; border-color: rgb(12, 137, 24); box-sizing: border-box !important; word-wrap: break-word !important;"><br style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;"/></p></section><section style="margin: 0px; padding: 0px 5px; max-width: 100%; box-sizing: border-box; line-height: 10px; color: inherit; border: 1px solid rgb(12, 137, 24); word-wrap: break-word !important;"><section data-width="50%" style="margin: -8px 0px 0px 140px; padding: 0px; max-width: 100%; box-sizing: border-box; color: inherit; height: 8px; width: 329px; background-color: rgb(254, 254, 254); border-color: rgb(12, 137, 24); word-wrap: break-word !important;"><section data-width="8px" style="margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; width: 8px; height: 8px; border-top-left-radius: 100%; border-top-right-radius: 100%; border-bottom-right-radius: 100%; border-bottom-left-radius: 100%; line-height: 1; font-size: 18px; text-decoration: inherit; border-color: rgb(45, 206, 60); display: inline-block; color: rgb(255, 255, 255); background-color: rgb(12, 137, 24); word-wrap: break-word !important;"></section></section><p style="margin: 15px; padding: 0px; max-width: 100%; min-height: 1em; white-space: pre-wrap; line-height: 2em; font-size: 14px; text-indent: 2em; box-sizing: border-box !important; word-wrap: break-word !important;">眼前一座座紧挨在一起的山峰，如同一段相声里说的：“远望群山，一锅窝头”；也正如徐霞客所说，“唯有此处峰成林”，这说的就是“中国最美的五大大峰林”之一：万峰林。广阔的农田中散布着一个个宽而浅的碟形漏斗，层层梯田以漏斗为中心，弧形布展，构成奇幻的太极八</p></section></section><p><br/></p>', '稻城亚丁的三神山由金刚手菩萨。三座山峰终年白雪皑皑，遥相呼应，直逼云天，慑人心魄据佛教的典籍圣地咱日秘相记载，世界佛教二十四神山，属相是鸡属众生供奉朝神', '2016-04-20 12:19:56', '2016-04-21 16:40:32'),
	(5, 2, 0, '', '母婴健康交流', NULL, NULL, NULL, '/upload/newscover/2016-04-27/57207f0359a14.jpg', '<p style="margin: 0px 0px 25px; padding: 0px; text-indent: 28px; font-size: 14px; color: rgb(43, 43, 43); font-family: simsun, arial, helvetica, clean, sans-serif; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 24px; orphans: auto; text-align: left; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);">本报讯 （记者 邹太平 通讯员 袁东广 舒雪慧）“对非组织活动的发起者凤凰村党支部书记杨昌英、云坡村党支部书记朱世东进行组织处理，免去党支部书记职务；对组织、参与非组织活动的杨昌英、朱世东等8人，取消其双井镇第十届党代会代表正式候选人资格；对杨昌英、朱世东等10人予以立案调查……”4月26日，湖南省怀化市纪委通报了该市溆浦县纪委近期查处的一起严重违反政治纪律、组织纪律的典型案件。</p><p style="margin: 0px 0px 25px; padding: 0px; text-indent: 28px; font-size: 14px; color: rgb(43, 43, 43); font-family: simsun, arial, helvetica, clean, sans-serif; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 24px; orphans: auto; text-align: left; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);">事情得从4月9日说起。</p><p style="margin: 0px 0px 25px; padding: 0px; text-indent: 28px; font-size: 14px; color: rgb(43, 43, 43); font-family: simsun, arial, helvetica, clean, sans-serif; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 24px; orphans: auto; text-align: left; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);">4月9日晚19时，正在值班的溆浦县双井镇镇长易长生接到该镇某村纪检员的电话，报告该镇岩家垅片区几名村干部准备集体不参加4月10日镇党委、政府组织的工作会议。</p><p style="margin: 0px 0px 25px; padding: 0px; text-indent: 28px; font-size: 14px; color: rgb(43, 43, 43); font-family: simsun, arial, helvetica, clean, sans-serif; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 24px; orphans: auto; text-align: left; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);">正值乡镇党委换届之际，事态紧急。易长生立即将此事向该镇党委书记贺德海报告。很快，溆浦县委、县纪委主要负责人获知这一情况，并指示双井镇党委、政府马上安排镇党政领导分别联系岩家垅片区各村党支部书记，摸清情况，并进行教育谈话。</p><p style="margin: 0px 0px 25px; padding: 0px; text-indent: 28px; font-size: 14px; color: rgb(43, 43, 43); font-family: simsun, arial, helvetica, clean, sans-serif; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 24px; orphans: auto; text-align: left; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);">4月10日，该镇岩家垅片区12名村党支部书记中，除云坡村党支部书记朱世东请假没有参加会议外，其他11人均按时参加了会议。</p><p><br/></p>', 'Bootstrap是Twitter推出的一个用于前端开发的开源工具包。它由Twitter的设计师Mark Otto和Jacob Thornton合作开发,是一个CSS/HTML框架。目前,Bootstrap最新版本为3.0 ', '2016-04-27 16:59:07', '2016-04-27 16:59:07');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;


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


-- 导出  表 binggq.smsmsg 结构
CREATE TABLE IF NOT EXISTS `smsmsg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(50) NOT NULL DEFAULT '0' COMMENT '手机号',
  `code` varchar(50) DEFAULT NULL COMMENT '验证码',
  `content` varchar(250) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='短信记录';

-- 正在导出表  binggq.smsmsg 的数据：~7 rows (大约)
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
	(8, '18316629973', '6637', '您的动态验证码为6637', '2016-05-03 14:25:07');
/*!40000 ALTER TABLE `smsmsg` ENABLE KEYS */;


-- 导出  表 binggq.user 结构
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户表',
  `phone` varchar(20) NOT NULL COMMENT '手机号',
  `wx_openid` varchar(20) DEFAULT '' COMMENT '微信的openid',
  `truename` varchar(20) NOT NULL COMMENT '姓名',
  `level` varchar(20) NOT NULL DEFAULT '1' COMMENT '等级,1:普通2:专家',
  `idcard` varchar(20) DEFAULT '' COMMENT '身份证',
  `company` varchar(50) DEFAULT '' COMMENT '公司',
  `position` varchar(50) DEFAULT '' COMMENT '职位',
  `email` varchar(50) DEFAULT '' COMMENT '邮箱',
  `gender` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1,男，2女',
  `agency_id` int(11) NOT NULL COMMENT '机构',
  `goodat` varchar(50) DEFAULT '' COMMENT '擅长业务',
  `city` varchar(50) DEFAULT '' COMMENT '常驻城市',
  `card_path` varchar(250) NOT NULL DEFAULT '' COMMENT '名片路径',
  `avatar` varchar(250) DEFAULT '' COMMENT '头像',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '账户余额',
  `ymjy` varchar(250) DEFAULT '' COMMENT '项目经验',
  `ywnl` varchar(250) DEFAULT '' COMMENT '业务能力',
  `reason` varchar(250) DEFAULT '' COMMENT '审核意见',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '账号状态：1.普通0.黑名单20实名待审核21实名不通过22实名通过30专家待认证31专家认证不通过32专家通过',
  `enabled` tinyint(1) NOT NULL DEFAULT '1' COMMENT '账号状态 ：1.可用0禁用(控制登录)',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- 正在导出表  binggq.user 的数据：~1 rows (大约)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `phone`, `wx_openid`, `truename`, `level`, `idcard`, `company`, `position`, `email`, `gender`, `agency_id`, `goodat`, `city`, `card_path`, `avatar`, `money`, `ymjy`, `ywnl`, `reason`, `status`, `enabled`, `create_time`, `update_time`) VALUES
	(2, '18316629973', NULL, '曹文鹏', '1', '', '', '', '', 1, 3, '', NULL, '123', '', 1.00, '', '', '', 1, 1, '2016-04-19 16:35:17', '2016-04-19 16:35:17');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- 导出  表 binggq.user_fans 结构
CREATE TABLE IF NOT EXISTS `user_fans` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT '用户',
  `following_id` int(11) NOT NULL COMMENT '关注对象',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1,单向关注2互为关注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户关系表';

-- 正在导出表  binggq.user_fans 的数据：~0 rows (大约)
DELETE FROM `user_fans`;
/*!40000 ALTER TABLE `user_fans` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_fans` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
