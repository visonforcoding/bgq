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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 CHECKSUM=1 ROW_FORMAT=DYNAMIC COMMENT='后台操作日志表';

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
	(24, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  \'_csrf_token\' => \'\',\n  \'username\' => \'admin\',\n  \'password\' => \'admin\',\n)', 'admin', '2016-05-10 17:02:49');
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
	(2, 'admin', '曹麦穗', '$2y$10$IwMcx3dYp7Sn.TPgovzc9Osem.XpMAdajZ1C.Z8y41LHcdcJUpCRy', '', 1, '2016-04-11 16:53:37', '2016-05-10 17:02:49', '2016-05-10 17:02:49', '127.0.0.1');
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
	(11, 1, '节能环保'),
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='菜单表';

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
	(24, '轮播图添加', '/admin/banner/add', 17, '', NULL, 0, 1, '');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='咨询表';

-- 正在导出表  binggq.news 的数据：~3 rows (大约)
DELETE FROM `news`;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` (`id`, `admin_id`, `admin_name`, `title`, `read_nums`, `praise_nums`, `comment_nums`, `cover`, `body`, `summary`, `create_time`, `update_time`) VALUES
	(10, 2, '曹麦穗', '人们习以为常的事却其实在触犯自然法则', 0, 0, 0, '/upload/newscover/2016-05-11/57328fb168e83.jpg', '<p><strong style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">中國湖北 - 恩施土家族苗族自治州 - 鶴峰屏山大峽谷</strong><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">清澈見底的河上，船行上面尤如飄浮空中，泛舟河上，真可以體驗到世外桃源的幽靜！﻿</span></p><p><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">Wisely前陣子就曉得 ‪#‎Starbucks‬ ‪#‎星巴克‬ 即將在台北艋舺大道與西園路交叉口這一帶，在具有歷史背景意義的林家古宅開設 ‪#‎星巴克艋舺門市‬，而這也是繼「大稻埕保安門市」後，成為活化在地老宅的商業模式新型咖啡店！至目前為止，我覺得評價其實還挺兩極的，但至少就觀光的角度來看，起碼它吸引了不少人的目光…</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">連結：</span><a rel="nofollow" target="_blank" href="http://www.wiselyview.cc/read-23143.html" class="ot-anchor aaTEdf" jslog="10929; track:click" dir="ltr" style="-webkit-tap-highlight-color: transparent; text-decoration: none; color: rgb(41, 98, 255); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">http://www.wiselyview.cc/read-23143.html</a><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">臉書：</span><a rel="nofollow" target="_blank" href="https://www.facebook.com/wiselymood/" class="ot-anchor aaTEdf" jslog="10929; track:click" dir="ltr" style="-webkit-tap-highlight-color: transparent; text-decoration: none; color: rgb(41, 98, 255); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">https://www.facebook.com/wiselymood/</a><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">‪#‎台北‬ ‪#‎萬華區‬ ‪#‎捷運龍山寺站‬ ‪#‎咖啡‬ ‪#‎Wisely遊記</span></p>', '人们习以为常的事却其实在触犯自然法则', '2016-05-11 09:54:22', '2016-05-11 09:54:22'),
	(11, 2, '曹麦穗', 'G+就是爱旅行', 0, 0, 0, '/upload/newscover/2016-05-11/57329129df6b7.jpg', '<p><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">位於優雅老屋的Keefü Table，店裡的丹麥家具、老物件和經典燈飾都很有看頭，餐點飲品也好吃，老黃說等油煙問題改善，要再來試試木府午食，ya~~</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">Keefü Table</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">地址：台南市東區東榮街44巷12號</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">電話：06-2355139</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">營業時間：11:00~21:00</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">週二週三公休﻿</span></p>', '23333', '2016-05-11 09:56:10', '2016-05-11 14:33:39'),
	(12, 2, '曹麦穗', 'cakephp3 + Wpadmin 后台开发文档', 0, 0, 0, '/upload/newscover/2016-05-11/573291606baaf.jpg', '<p><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">位於優雅老屋的Keefü Table，店裡的丹麥家具、老物件和經典燈飾都很有看頭，餐點飲品也好吃，老黃說等油煙問題改善，要再來試試木府午食，ya~~</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">Keefü Table</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">地址：台南市東區東榮街44巷12號</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">電話：06-2355139</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">營業時間：11:00~21:00</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">週二週三公休﻿</span></p>', '55555', '2016-05-11 09:57:02', '2016-05-11 13:23:16');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;


-- 导出  表 binggq.newscom 结构
CREATE TABLE IF NOT EXISTS `newscom` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '新闻评论表',
  `news_id` int(11) NOT NULL COMMENT '新闻id',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `body` varchar(500) NOT NULL COMMENT '评论内容',
  `praise_nums` int(11) NOT NULL,
  `create_time` datetime NOT NULL COMMENT '评论时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='新闻评论表';

-- 正在导出表  binggq.newscom 的数据：~2 rows (大约)
DELETE FROM `newscom`;
/*!40000 ALTER TABLE `newscom` DISABLE KEYS */;
INSERT INTO `newscom` (`id`, `news_id`, `user_id`, `body`, `praise_nums`, `create_time`) VALUES
	(1, 4, 2, 'test', 0, '2016-05-05 11:11:11'),
	(2, 4, 2, '不错啊，哈哈', 2, '2016-05-06 11:11:11');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='新闻行业标签';

-- 正在导出表  binggq.news_industry 的数据：~6 rows (大约)
DELETE FROM `news_industry`;
/*!40000 ALTER TABLE `news_industry` DISABLE KEYS */;
INSERT INTO `news_industry` (`id`, `news_id`, `industry_id`) VALUES
	(3, 10, 5),
	(4, 10, 8),
	(5, 11, 6),
	(6, 11, 8),
	(7, 12, 5),
	(9, 11, 7);
/*!40000 ALTER TABLE `news_industry` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='短信记录';

-- 正在导出表  binggq.smsmsg 的数据：~17 rows (大约)
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
	(17, '18316629973', '5727', '您的动态验证码为5727', '2016-05-10 15:12:15');
/*!40000 ALTER TABLE `smsmsg` ENABLE KEYS */;


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
  `ymjy` varchar(250) DEFAULT '' COMMENT '项目经验',
  `ywnl` varchar(250) DEFAULT '' COMMENT '业务能力',
  `reason` varchar(250) DEFAULT '' COMMENT '审核意见',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '账号状态：1.普通0.黑名单20实名待审核21实名不通过22实名通过30专家待认证31专家认证不通过32专家通过',
  `enabled` tinyint(1) NOT NULL DEFAULT '1' COMMENT '账号状态 ：1.可用0禁用(控制登录)',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- 正在导出表  binggq.user 的数据：~2 rows (大约)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `phone`, `wx_openid`, `truename`, `level`, `idcard`, `company`, `position`, `email`, `gender`, `agency_id`, `ext_industry`, `goodat`, `city`, `card_path`, `avatar`, `money`, `meet_nums`, `ymjy`, `ywnl`, `reason`, `status`, `enabled`, `create_time`, `update_time`) VALUES
	(7, '18681509040', '', '郑旭', '2', '', '中青文化投资管理有限公司', '互联网事业部副总经理', 'claus@smartlemon.cn', 1, 17, '6642', '', '', '/upload/user/mp/2016-05-05/572b2466c4068.jpg', '', 0.00, 0, '', '', '', 1, 1, '2016-05-05 18:46:01', '2016-05-05 19:50:52'),
	(8, '18316629973', 'ogD3IwZkB0fiIdrRDPwn_ao9mMBA', '曹麦穗', '2', '', '广东深宏盾律师事务所', '共产主义接班人', '714265403@qq.com', 1, 13, '打dota', '', '', '/upload/user/mp/2016-05-09/57305f00c5c1a.jpg', 'http://wx.qlogo.cn/mmopen/ajNVdqHZLLCOibYvNGzNtJmgyOEpAyhkd45A3gbGgt2mbDYUdMeBVbbe9SmxwJiceNGd4ibZCeKTHSDq1kJDkVibXQ/0', 0.00, 0, '', '', '', 1, 1, '2016-05-09 17:57:24', '2016-05-09 17:57:41');
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


-- 导出  表 binggq.user_industry 结构
CREATE TABLE IF NOT EXISTS `user_industry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `industry_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='用户行业标签';

-- 正在导出表  binggq.user_industry 的数据：~4 rows (大约)
DELETE FROM `user_industry`;
/*!40000 ALTER TABLE `user_industry` DISABLE KEYS */;
INSERT INTO `user_industry` (`id`, `user_id`, `industry_id`) VALUES
	(20, 7, 9),
	(21, 7, 16),
	(22, 8, 8),
	(23, 8, 19);
/*!40000 ALTER TABLE `user_industry` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
