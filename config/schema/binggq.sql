-- phpMyAdmin SQL Dump
-- version 4.4.15.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-06-20 10:26:26
-- 服务器版本： 5.5.37-log
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `binggq`
--

-- --------------------------------------------------------

--
-- 表的结构 `actionlog`
--

CREATE TABLE IF NOT EXISTS `actionlog` (
  `id` int(11) NOT NULL COMMENT '主键，自增',
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
  `create_time` datetime NOT NULL COMMENT '创建时间'
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 CHECKSUM=1 ROW_FORMAT=DYNAMIC COMMENT='后台操作日志表';

--
-- 转存表中的数据 `actionlog`
--

INSERT INTO `actionlog` (`id`, `url`, `type`, `useragent`, `ip`, `filename`, `msg`, `controller`, `action`, `param`, `user`, `create_time`) VALUES
(1, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', '', '', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-04-20 15:48:49'),
(2, 'admin/news/edit/4', 'PUT', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '修改', 'news', 'edit', 'array (\n  ''title'' => ''这才是国内八月最值得去的12个旅行天堂！别去错了！'',\n  ''cover'' => ''/upload/newscover/2016-04-20/5717016f566af.jpg'',\n  ''summary'' => ''稻城亚丁的三神山由金刚手菩萨。三座山峰终年白雪皑皑，遥相呼应，直逼云天，慑人心魄据佛教的典籍圣地咱日秘相记载，世界佛教二十四神山，属相是鸡属众生供奉朝神'',\n  ''body'' => ''<p>&nbsp;&nbsp; &nbsp; &nbsp;\r\n\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; <br/></p><p><br/></p><section data-id="85616" class="135editor" style="white-space: normal; margin: 0px; padding: 0px; max-width: 100%; box-sizing: border-box; color: rgb(62, 62, 62); line-height: 25px; background-color: rgb(255, 255, 255); border: 0px none; font-family: 微软雅黑; word-wrap: break-word !important;"><section style="margin: 0px; padding: 10px; max-width: 100%; box-sizing: border-box; word-wrap: break-word; line-height: 2em; word-break: normal; text-align: center; background-color: rgb(12, 137, 24); color: rgb(255, 255, 255); border-color: rgb(45, 206, 60);"><strong style="', 'admin', '2016-04-20 17:10:00'),
(3, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-04-21 09:44:42'),
(4, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-04-21 10:38:44'),
(5, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-04-21 10:47:13'),
(6, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-04-21 10:48:28'),
(7, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-04-21 11:21:39'),
(8, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-04-21 11:24:58'),
(9, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-04-21 11:25:43'),
(10, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-04-21 11:38:16'),
(11, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-04-21 12:03:57'),
(12, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-04-21 12:04:32'),
(13, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-04-21 12:04:56'),
(14, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-04-22 11:05:58'),
(15, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-04-22 12:09:45'),
(16, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-04-25 10:43:20'),
(17, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-04-26 09:59:32'),
(18, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-04-27 16:57:18'),
(19, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-05-03 14:48:27'),
(20, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-05-03 15:28:30'),
(21, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-05-05 11:32:12'),
(22, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-05-10 10:51:36'),
(23, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-05-10 15:44:01'),
(24, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-05-10 17:02:49'),
(25, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-05-12 16:02:34'),
(26, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-05-13 09:33:46'),
(27, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-05-13 09:58:29'),
(28, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-05-13 10:33:29'),
(29, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.04', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-05-19 15:25:18'),
(30, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-05-20 11:46:25'),
(31, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '127.0.0.1', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-05-24 14:30:27'),
(32, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '27.38.97.247', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-06-07 10:56:41'),
(33, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '27.38.97.247', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-06-07 11:58:33'),
(34, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '27.38.97.247', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-06-07 15:51:04'),
(35, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '27.38.97.247', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-06-07 16:45:57'),
(36, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '27.38.97.247', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-06-07 17:00:15'),
(37, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '27.38.97.247', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-06-07 17:13:37'),
(38, 'admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '27.38.97.247', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-06-07 18:24:06'),
(39, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '113.87.213.147', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-06-07 20:17:56'),
(40, 'admin/admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '163.125.252.133', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-06-08 17:05:27'),
(41, 'admin/login', 'POST', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36', '58.251.235.86', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-06-13 14:38:23'),
(42, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '58.251.235.86', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-06-14 10:43:06'),
(43, 'admin/login', 'POST', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', '163.125.72.119', '', '登录系统', 'admin', 'login', 'array (\n  ''_csrf_token'' => '''',\n  ''username'' => ''admin'',\n  ''password'' => ''admin'',\n)', 'admin', '2016-06-17 10:17:49');

-- --------------------------------------------------------

--
-- 表的结构 `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(10) unsigned NOT NULL COMMENT '活动表',
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
  `is_top` tinyint(2) DEFAULT '0' COMMENT 'æ˜¯å¦ç½®é¡¶',
  `guest` varchar(255) DEFAULT NULL COMMENT 'å‚ä¸Žå˜‰å®¾',
  `reason` varchar(255) DEFAULT NULL COMMENT 'æœªé€šè¿‡å®¡æ ¸ç†ç”±'
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='活动表';

--
-- 转存表中的数据 `activity`
--

INSERT INTO `activity` (`id`, `admin_id`, `user_id`, `publisher`, `industry_id`, `company`, `title`, `time`, `address`, `scale`, `read_nums`, `praise_nums`, `comment_nums`, `cover`, `body`, `summary`, `create_time`, `update_time`, `apply_nums`, `apply_fee`, `is_crowdfunding`, `is_check`, `is_top`, `guest`, `reason`) VALUES
(6, 2, 8, '曹麦穗', 5, '柠檬智慧科技', 'E店通', '2016-09-09 12:00-13:00', '福田上沙3', '500人', 13, NULL, NULL, '/upload/activity/2016-04-21/571878d1d6f5f.jpg', '<p>活动介绍：</p><p><br/></p><p><br/></p><p>活动流程：</p><p><br/></p><p><br/></p><p>参与嘉宾：</p><p><br/></p><p><br/></p><p>联系方式：<br/></p>', '<p>交流会啊</p>', '2016-04-21 14:53:00', '2016-06-13 15:39:55', 0, 0, 0, 1, 0, NULL, NULL),
(8, 2, 2, '曹麦穗', 0, '并购精英汇', '2006年中国国际体育融资总裁年会', '04月28日-04月30日', '深圳市福田区东海国际公寓', '500人', 26, NULL, NULL, '/upload/newscover/2016-06-07/575689ec1146c.png', '<p>活动流程：<br/></p><p>13:00 - 14:00&nbsp;签到</p><p>13:00 - 14:00&nbsp;活动开场</p><p>14:00 - 14:05&nbsp;签到</p><p>14:05 - 14:15&nbsp;天天投介绍</p><p>14:15 - 14:55&nbsp;圆桌论坛+现场提问</p><p>14:55 - 16:40&nbsp;12个项目路演</p><p>14:40 - 18:00&nbsp;投融资面对面一对一交流</p><p>18:00 - 00:00&nbsp;活动结束</p><p><br/></p>', '<p>46号文的出现，体育产业从业界内心激情澎湃，产业外人士 纷纷扎入，这是体育产业建仓的最好时候，那么接下来体育 与资本、体育金融、体育产业将如何风起云涌？谁将是体育 产业中的新星？谁将成为体育产业里的独角兽？</p>', '2016-06-07 16:46:00', '2016-06-15 08:13:23', 0, 0, 0, 1, 0, '<p>高一波 柠檬智慧总裁</p><p>郑旭 柠檬智慧副总裁</p><p><br/></p>', NULL),
(9, 2, 2, '曹麦穗', 0, '并购精英汇', '云峰有约——刘云中国画作品展', '2016年6月7日至6月12日 9：00—17：00（逢周一休馆）', '深圳市福田区红荔路6026号', '100人', 8, NULL, NULL, '/upload/newscover/2016-06-07/57569682a7e94.jpg', '<p>活动：</p><p style="margin-top: 0px; margin-bottom: 0px; padding: 5px 0px; word-wrap: break-word; line-height: 26px; font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; color: rgb(34, 34, 34); white-space: normal; background-color: rgb(255, 255, 255);"><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 26px; background-color: rgb(255, 255, 255);">中、西绘画艺术语言的融汇贯通是20世纪以来中国画家寻求现代转型和世界对话的一个重要路径，而由油画跨入中国画的大家如徐悲鸿、朱屹瞻、林风眠、李可染、吴冠中等都以其辉煌的艺术成就，为中、西绘画艺术的融合、对话、碰撞而产生全新的艺术风格提供了典范。他们作为一种现代艺术精神和思想资源，感召着后来者，也为后来者奠定了继续探索前行的基石，从而构成了现代中国画艺术的多元面貌。</span></p>', '<p>“云峰有约——刘云中国画作品展”将于2016年6月7日上午10：00在深圳市关山月美术馆开幕，此展由中国美术家协会、湖南省文学艺术界联合会共同主办，关山月美术馆、湖南省美术家协会、湖南省画院、湖南美术出版社联合承办，共展出刘云山水画作品70件。</p>', '2016-06-07 17:37:00', '2016-06-07 20:56:19', 0, 0, 0, 1, 0, NULL, NULL),
(10, 2, 2, '曹麦穗', 0, '南澳办事处', '6月8日来南澳看海上赛龙舟，品疍家渔民文化', '2016年6月8日 周三 9:00', '大鹏新区南澳月亮湾海域', '1000人', 9, NULL, NULL, '/upload/newscover/2016-06-07/575697402e545.jpg', '<p>活动：</p><p><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 26px; background-color: rgb(255, 255, 255);">“赛龙舟百舸争流 舞腰鼓万人同欢”。一年一度的大鹏新区南澳龙舟邀请赛将于6月8日上午9时在南澳月亮湾海域举行。届时将有来自广州、东莞、香港、澳门和深圳的18支队伍海上竞渡。</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 26px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 26px; background-color: rgb(255, 255, 255);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 作为南澳的旅游文化名片之一，今年，南澳办事处着重“打造品牌”，聘请专业公司设计了龙舟赛LOGO，通过标志鲜明的精彩赛事和文艺汇演，将龙舟赛打造成弘扬南澳文化的特色品牌。</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 26px; white-space: normal; background-color: rgb(255, 255, 255);"/><br/></p>', '<p><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 26px; background-color: rgb(255, 255, 255);">南澳作为龙舟之乡，赛龙舟已有70多年的历史，至今已成功举办15届。作为广东省非物质文化遗产项目，龙舟文化已深入本地居民的生活，更成为备受社会关注的国际性运动。同时，南澳的祭妈祖、渔民娶', '2016-06-07 17:43:00', '2016-06-14 13:03:12', 0, 0, 0, 1, 1, NULL, NULL),
(11, 2, 2, '曹麦穗', 0, '网易娱乐', '2016深圳CFD暴雪电竞嘉年华活动 端午节期间上演', '6月9日-11日', '深圳龙岗大运中心体育馆', '500人', 3, NULL, NULL, '/upload/newscover/2016-06-07/575699cb52d91.png', '<p><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">交通指南</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">　　公交：</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">　　附近公交站：大运中心、体育新城、大运中心体育场</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">　　地铁：3号龙岗线大运站C出口</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">　　地铁到站出站以后，到附近的地铁公交接驳站坐公交。</span></p>', '<p><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">狼蛛杯CFD暴雪电竞嘉年华是由网易和暴雪授权、CFD电竞平台举办的《风暴英雄》和《炉石传说》官方赛事，是广大游戏玩家参与的电竞盛典。</span></p>', '2016-06-07 17:54:00', '2016-06-17 17:52:47', 0, 0, 0, 1, 0, NULL, NULL),
(12, 2, 2, '曹麦穗', 0, '深圳交响乐团', '【公益活动】深圳交响乐团音乐季音乐会导赏', '2016年6月9日（周四）14:30', '深圳交响乐团演奏厅（深圳市罗湖区黄贝路2025号）', '100人', 11, 1, 1, '/upload/newscover/2016-06-07/57569c5069697.jpg', '<p><span style="color: rgb(128, 0, 128); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">公益免费，凭身份证领取入场票</span></p>', '<p><span style="color: rgb(128, 0, 128); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">公益免费，凭身份证领取入场票</span></p>', '2016-06-07 18:05:00', '2016-06-16 18:22:10', 0, 0, 0, 1, 0, NULL, NULL),
(13, 2, 2, '曹麦穗', 0, '福田文化馆', '【公益演出】黄龙戏小戏赏析', '2016年6月10日（周五）晚上7:00-8:30', '福田区非遗馆剧场（二楼小剧场）', '100人', 7, NULL, NULL, '/upload/newscover/2016-06-07/5756a02b93e45.jpg', '<p><span style="font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; color: rgb(255, 140, 0); background-color: rgb(255, 255, 255);"><strong>《梨园苹果》</strong></span><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">剧情简介戏曲剧团龙套演员李大平受儿子李小果学校之托，要去学校组织的联欢会上表演节目。一口答应在联欢会唱歌的他，却在剧团的排练场偷偷地拿出团里的传统戏曲服装自己排练起了戏曲唱段的节目。学校教导处主任在李小果的带领下审查李大平的节目，几次劝说让他放弃表演戏曲唱段，改为唱流行歌曲《小苹果》，并表示现在不光是孩子们，就算是很多成年人也不愿意接受节奏缓慢咿咿呀呀的戏曲表演艺术。李大平几次“抗争”无果之后，稍作妥协，把戏曲唱段的唱词用流行歌曲的形式表演出来。王主任和李小果看后拍手叫好，李大平却从掌声中失落无比脱下了他梦寐以求的主演服装，他觉得自己虽然只是个剧团里的小龙套，但戏曲不可以这样改革，艺术不可以这样胡闹，从而拒绝了联欢会的邀约。最后王主任幡然醒悟，觉得不光戏曲应该更加贴近观众，观众也应该平静下心来去更深层次的了解戏曲，不仅答应让李大平在联欢会上表演戏曲唱段，而且邀请剧团老师把戏曲艺术带进校园，每周去给学生们上一节戏曲课程。</span></p><p><span style="font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; color: rgb(255, 140, 0); background-color: rgb(255, 255, 255);"><strong>《醉鬼相亲》</strong></span><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">剧情简介嗜酒为命、无所事事的东北农村大龄亲年何老九受远房表叔牵线搭桥，醉酒后来到表叔家相看对象，谁知前来相亲的农村大龄剩女刘美妞（反串）貌丑无比、说话莽撞。二人在交流对话中一醉酒，一莽撞，火花四溅，笑料不断。最后刘美妞道出儿时旧事，原来二人早有渊源。刘美妞虽貌丑莽撞，但淳朴勤劳；何老九嗜酒如命，却也是宅心仁厚。二人的碰撞能否给彼此带来自我认知的改变，每个人心里都有不同的答案。</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">《醉鬼相亲》是东北地方小戏常见的调侃嬉闹的表演风格。在热闹之余，讽刺了当下农村的恶风陋习，同时也表达了不管什么样的人对美好生活的由衷渴求。</span></p>', '<p><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">这是舞台上不多见的以戏说戏的表演形式，用当代戏曲人和当代大多数观众两个视角来表述戏曲艺术如今存在的困惑和问题。它不会给予答案，只期望带给更多的人一些思考。&nbsp;</span>&l', '2016-06-07 18:20:00', '2016-06-16 23:23:53', 0, 0, 0, 1, 0, NULL, NULL),
(14, 2, 2, '曹麦穗', 0, '政府', '《梅花三弄》——经典古筝名曲赏析端午节音乐会', '2016年6月10日（周五）15:00', '深圳大剧院音乐厅', '100人', 9, NULL, NULL, '/upload/newscover/2016-06-07/5756a12e4eccc.jpg', '<p><strong style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);">演出曲目</strong><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">梅花三弄&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 陈志远/曲</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">茉莉芬芳&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 何占豪/曲</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">临安遗恨&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 何占豪/曲</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">牧羊曲&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 王立平/曲</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">梁祝&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 何占豪/曲</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">彝族舞曲&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 王中山/改编&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">水调歌头•明月几时有</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">秋望&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 周煜国/曲</span></p>', '<p><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">古筝是我国传统民族乐器，它是中国独特的、重要的民族乐器之一。它的音色优美，音域宽广、演奏技巧丰富，具有相当强的表现力，因此它深受广大人民群众的喜爱。6月10日端午节假期，深圳“艺术大观', '2016-06-07 18:25:00', '2016-06-17 17:54:25', 0, 0, 0, 1, 0, NULL, NULL),
(15, 2, 2, '曹麦穗', 0, '西西弗书店', '鞠萍姐姐携新书《萍聚》于花园城前庭与你见面', '6月11日（周六）下午16:30-18:30', '深圳市南山区南海大道花园城（购物中心）1楼前庭', '100人', 68, 1, 17, '/upload/newscover/2016-06-07/5756a4be1899f.png', '<p><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">年少时，陪伴我们鞠萍姐姐，依然继续陪伴着更多的儿童以及青少年。小编似乎觉得，好像时光并没有流失，因为鞠萍姐姐还是记忆中的鞠萍姐姐啊，跟小编小时候看见的一样。或许岁月改变的是彼此的容颜，却没有改变我们的记忆。</span></p><p><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">童年喜欢鞠萍姐姐的小伙伴们，现在孩子喜欢鞠萍姐姐的朋友们，还有喜欢鞠萍姐姐新书《萍聚》的朋友们，一起来花园城参加鞠萍姐姐读者见面会吧。</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">让我们一起用爱守护童年，用心撒播希望。</span><br style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; white-space: normal; background-color: rgb(255, 255, 255);"/><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">6月11日，我们不见不散~</span></p>', '<p><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">小时候，每天下午放学回家，第一件事就是打开电视机，从动画城看到大风车，从大风车看到七巧板，董浩叔叔，鞠萍姐姐，小鹿姐姐，金龟子，月亮姐姐每个人都能叫出名字来，就好像他们就是我们童年的偶', '2016-06-07 18:40:00', '2016-06-17 18:08:59', 0, 0, 0, 1, 1, NULL, NULL),
(16, 2, 2, '曹麦穗', 0, '大丰收', '2016深圳首届平板支撑项目挑战赛', '2016年6月11日（周六）下午3点', '深圳华强路站B出口世纪汇广场', '100人', 121, 1, NULL, '/upload/newscover/2016-06-07/5756a6d693699.jpg', '<p><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">#2016深圳平板支撑挑战赛#挑战无极限，乐享大丰收只要你报名参赛，就有机会赢得运动蓝牙耳机、海尔洗衣机、威思达健身VIP年卡、一万元现金、海尔四门冰箱等精美豪礼！还等什么？</span></p>', '<p><span style="color: rgb(34, 34, 34); font-family: &#39;Microsoft Yahei&#39;, 黑体, Tahoma, SimSun; line-height: 28px; background-color: rgb(255, 255, 255);">够硬，就一直撑下去！</span></p>', '2016-06-07 18:50:53', '2016-06-17 18:06:45', 0, 0, 0, 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `activityapply`
--

CREATE TABLE IF NOT EXISTS `activityapply` (
  `id` int(11) NOT NULL COMMENT '活动申请表',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `activity_id` int(11) NOT NULL COMMENT '活动id',
  `create_time` datetime NOT NULL COMMENT '提交时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  `is_pass` tinyint(4) DEFAULT '0' COMMENT '审核是否通过',
  `is_top` tinyint(4) DEFAULT '0' COMMENT '是否置顶'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='活动申请表';

-- --------------------------------------------------------

--
-- 表的结构 `activitycom`
--

CREATE TABLE IF NOT EXISTS `activitycom` (
  `id` int(11) NOT NULL COMMENT '活动评论表',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `activity_id` int(11) NOT NULL COMMENT '活动id',
  `body` varchar(550) NOT NULL COMMENT '评论内容',
  `praise_nums` int(11) DEFAULT '0' COMMENT '点赞数',
  `create_time` datetime NOT NULL COMMENT '评论时间',
  `reply_id` int(11) DEFAULT NULL COMMENT 'å›žå¤ç”¨æˆ·id'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='活动评论表';

--
-- 转存表中的数据 `activitycom`
--

INSERT INTO `activitycom` (`id`, `user_id`, `activity_id`, `body`, `praise_nums`, `create_time`, `reply_id`) VALUES
(1, 9, 15, '很怀念啊', 0, '2016-06-12 14:37:03', 2),
(2, 10, 15, '很好', 0, '2016-06-12 14:43:56', 2),
(3, 10, 15, '很好', 0, '2016-06-12 14:43:56', 2),
(4, 10, 15, '很好', 0, '2016-06-12 14:43:57', 2),
(5, 10, 15, '很好', 0, '2016-06-12 14:43:57', 2),
(6, 10, 15, 'henhao', 0, '2016-06-12 14:44:14', 2),
(7, 10, 15, 'henhao', 0, '2016-06-12 14:44:15', 2),
(8, 10, 15, 'henhao hao', 0, '2016-06-12 14:44:47', 2),
(9, 10, 15, 'henhao hao', 0, '2016-06-12 14:44:47', 2),
(10, 10, 15, 'henhao hao', 0, '2016-06-12 14:44:48', 2),
(11, 10, 15, 'henhao hao', 0, '2016-06-12 14:44:48', 2),
(12, 10, 15, 'henhao hao', 0, '2016-06-12 14:44:48', 2),
(13, 10, 15, 'henhao hao', 0, '2016-06-12 14:44:49', 2),
(14, 9, 15, 'first time', 0, '2016-06-12 15:07:48', 2),
(15, 9, 15, 'secend time', 0, '2016-06-12 15:12:00', 10),
(16, 9, 15, 'third time', 0, '2016-06-12 19:17:16', 2),
(17, 9, 15, 'fourth time', 0, '2016-06-12 19:18:01', 2),
(18, 8, 12, '呵呵，不错', 1, '2016-06-16 18:22:10', 2);

-- --------------------------------------------------------

--
-- 表的结构 `activity_industry`
--

CREATE TABLE IF NOT EXISTS `activity_industry` (
  `id` int(11) NOT NULL COMMENT 'æ´»åŠ¨æ ‡ç­¾è¡¨',
  `industry_id` int(11) NOT NULL COMMENT 'ç”¨æˆ·id',
  `activity_id` int(11) NOT NULL COMMENT 'æ´»åŠ¨id'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='æ´»åŠ¨æ ‡ç­¾è¡¨';

--
-- 转存表中的数据 `activity_industry`
--

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
(10, 4, 16);

-- --------------------------------------------------------

--
-- 表的结构 `activity_savant`
--

CREATE TABLE IF NOT EXISTS `activity_savant` (
  `id` int(11) NOT NULL COMMENT '专家推荐活动关系表',
  `activity_id` int(11) NOT NULL COMMENT '活动id',
  `savant_id` int(11) NOT NULL COMMENT '专家id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='专家推荐活动关系表';

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `truename` varchar(50) NOT NULL COMMENT '真实姓名',
  `password` varchar(150) NOT NULL COMMENT '密码',
  `phone` varchar(20) NOT NULL COMMENT '手机号',
  `enabled` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1启用0禁用',
  `ctime` datetime DEFAULT NULL COMMENT '创建时间',
  `utime` datetime DEFAULT NULL COMMENT '修改时间',
  `login_time` datetime DEFAULT NULL COMMENT '登录时间',
  `login_ip` varchar(50) DEFAULT NULL COMMENT '登录ip'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='管理员表';

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `username`, `truename`, `password`, `phone`, `enabled`, `ctime`, `utime`, `login_time`, `login_ip`) VALUES
(2, 'admin', '曹麦穗', '$2y$10$IwMcx3dYp7Sn.TPgovzc9Osem.XpMAdajZ1C.Z8y41LHcdcJUpCRy', '', 1, '2016-04-11 16:53:37', '2016-06-17 10:17:49', '2016-06-17 10:17:49', '163.125.72.119');

-- --------------------------------------------------------

--
-- 表的结构 `adminmsg`
--

CREATE TABLE IF NOT EXISTS `adminmsg` (
  `id` int(11) NOT NULL COMMENT '后台消息',
  `type` tinyint(4) NOT NULL COMMENT '类型',
  `table_id` int(11) NOT NULL COMMENT '记录id',
  `msg` varchar(250) NOT NULL COMMENT '内容',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态:1未读2已读',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '修改时间'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='后台系统消息';

--
-- 转存表中的数据 `adminmsg`
--

INSERT INTO `adminmsg` (`id`, `type`, `table_id`, `msg`, `status`, `create_time`, `update_time`) VALUES
(1, 1, 8, '您有一条实名认证申请需处理', 1, '2016-05-13 15:23:08', '2016-05-13 15:23:08'),
(2, 1, 8, '您有一条专家认证申请需处理', 1, '2016-05-13 17:30:57', '2016-05-13 17:30:57'),
(3, 1, 8, '您有一条专家认证申请需处理', 2, '2016-05-13 17:33:48', '2016-05-13 18:41:07');

-- --------------------------------------------------------

--
-- 表的结构 `admin_group`
--

CREATE TABLE IF NOT EXISTS `admin_group` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL COMMENT '管理员',
  `group_id` int(11) NOT NULL COMMENT '所属组'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='管理员群组';

-- --------------------------------------------------------

--
-- 表的结构 `agency`
--

CREATE TABLE IF NOT EXISTS `agency` (
  `id` int(11) NOT NULL COMMENT '行业标签',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称'
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='机构标签库';

--
-- 转存表中的数据 `agency`
--

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

-- --------------------------------------------------------

--
-- 表的结构 `banner`
--

CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(11) unsigned NOT NULL COMMENT '轮播图',
  `type` varchar(20) NOT NULL DEFAULT '1' COMMENT '类型',
  `img` varchar(450) NOT NULL COMMENT '图片',
  `url` varchar(450) NOT NULL COMMENT '链接地址',
  `remark` varchar(250) NOT NULL COMMENT '备注说明',
  `enabled` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1启用0禁用',
  `create_time` datetime NOT NULL COMMENT '创建时间'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='轮播图';

--
-- 转存表中的数据 `banner`
--

INSERT INTO `banner` (`id`, `type`, `img`, `url`, `remark`, `enabled`, `create_time`) VALUES
(10, '1', '/webroot/upload/banner/2016-04-21/571890c6ddbdb.jpg', 'http://movie.douban.com/subject/1295644/', '不错的页面', 1, '2016-04-21 16:35:50'),
(11, '1', '/upload/banner/2016-05-10/5731590f47ae4.webp', 'http://bgq.dev/news/view/4', '333', 1, '2016-05-10 11:48:07'),
(12, '1', '/upload/banner/2016-05-10/57315a0135fec.webp', 'http://bgq.dev/news/view/5', '3333', 1, '2016-05-10 11:48:28'),
(13, '1', '/upload/banner/2016-05-10/57315a13a9b5e.jpg', 'http://bgq.dev/news/view/5', '3333', 1, '2016-05-10 11:48:41'),
(14, '2', '/upload/banner/2016-06-07/575691ff5a467.png', '/mobile/html/api_test.html', '2006年中国国际体育融资总裁年会', 1, '2016-06-07 17:21:31'),
(15, '2', '/upload/banner/2016-06-07/5756925982cd4.png', '/mobile/html/api_test.html', 'E店通', 1, '2016-06-07 17:23:05');

-- --------------------------------------------------------

--
-- 表的结构 `career`
--

CREATE TABLE IF NOT EXISTS `career` (
  `id` int(11) NOT NULL COMMENT '工作经历',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户',
  `company` varchar(50) NOT NULL COMMENT '公司',
  `position` varchar(50) NOT NULL COMMENT '职位',
  `start_date` date NOT NULL COMMENT '开始日期',
  `end_date` date NOT NULL COMMENT '结束日期',
  `desc` text NOT NULL COMMENT '描述',
  `create_time` datetime NOT NULL COMMENT '创建日期',
  `update_time` datetime NOT NULL COMMENT '修改日期'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='工作经历';

-- --------------------------------------------------------

--
-- 表的结构 `collect`
--

CREATE TABLE IF NOT EXISTS `collect` (
  `id` int(11) NOT NULL COMMENT '点赞日志表',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `relate_id` int(11) NOT NULL COMMENT '关联id（活动id或资讯id）',
  `is_delete` tinyint(4) NOT NULL DEFAULT '1' COMMENT '删除1:删除0正常',
  `type` tinyint(4) NOT NULL COMMENT '类型值：0：活动；1：资讯',
  `create_time` datetime NOT NULL COMMENT '记录时间',
  `update_time` datetime NOT NULL COMMENT '更新时间'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='点赞日志表';

--
-- 转存表中的数据 `collect`
--

INSERT INTO `collect` (`id`, `user_id`, `relate_id`, `is_delete`, `type`, `create_time`, `update_time`) VALUES
(4, 8, 18, 0, 1, '2016-05-23 20:33:29', '2016-05-23 20:50:00'),
(5, 9, 16, 1, 0, '2016-06-08 10:26:37', '2016-06-08 10:27:01'),
(6, 9, 15, 1, 0, '2016-06-08 10:28:17', '2016-06-08 10:28:38'),
(7, 10, 15, 0, 0, '2016-06-12 14:45:57', '2016-06-12 14:45:57'),
(8, 10, 19, 0, 1, '2016-06-14 19:47:55', '2016-06-14 19:47:55');

-- --------------------------------------------------------

--
-- 表的结构 `comment_like`
--

CREATE TABLE IF NOT EXISTS `comment_like` (
  `id` int(11) NOT NULL COMMENT '评论点赞表',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `relate_id` int(11) NOT NULL COMMENT '点赞相关id，例：活动id或者是资讯id',
  `type` tinyint(4) NOT NULL COMMENT '类型值：0：活动；1：资讯',
  `create_time` datetime NOT NULL COMMENT '点赞时间'
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='评论点赞表';

--
-- 转存表中的数据 `comment_like`
--

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
(26, 8, 18, 0, '0000-00-00 00:00:00'),
(27, 8, 36, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `education`
--

CREATE TABLE IF NOT EXISTS `education` (
  `id` int(11) NOT NULL COMMENT '教育经历表',
  `user_id` int(11) NOT NULL COMMENT '用户',
  `school` varchar(50) NOT NULL COMMENT '学校',
  `major` varchar(50) NOT NULL COMMENT '专业',
  `education` varchar(50) NOT NULL COMMENT '学历',
  `start_date` date NOT NULL COMMENT '开始日期',
  `end_date` date NOT NULL COMMENT '结束日期',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='教育经历';

-- --------------------------------------------------------

--
-- 表的结构 `flow`
--

CREATE TABLE IF NOT EXISTS `flow` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '交易类型',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '交易金额',
  `pre_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '交易前金额',
  `after_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '交易后金额',
  `status` tinyint(4) NOT NULL COMMENT '交易状态',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '修改时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户资金流水';

-- --------------------------------------------------------

--
-- 表的结构 `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT '群组名称',
  `remark` varchar(50) NOT NULL COMMENT '备注',
  `ctime` datetime NOT NULL COMMENT '创建时间',
  `utime` datetime NOT NULL COMMENT '修改时间'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='群组管理\r\n';

--
-- 转存表中的数据 `group`
--

INSERT INTO `group` (`id`, `name`, `remark`, `ctime`, `utime`) VALUES
(1, 'test', '3333', '2016-05-05 19:38:00', '2016-05-05 19:38:00'),
(2, '444', '3333', '2016-05-10 19:39:00', '2016-05-10 19:39:00');

-- --------------------------------------------------------

--
-- 表的结构 `group_menu`
--

CREATE TABLE IF NOT EXISTS `group_menu` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0' COMMENT '群组',
  `menu_id` int(11) NOT NULL DEFAULT '0' COMMENT '权限'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='群组权限';

--
-- 转存表中的数据 `group_menu`
--

INSERT INTO `group_menu` (`id`, `group_id`, `menu_id`) VALUES
(1, 1, 20),
(2, 1, 22),
(3, 1, 23),
(4, 2, 2),
(5, 2, 7),
(6, 2, 11);

-- --------------------------------------------------------

--
-- 表的结构 `industry`
--

CREATE TABLE IF NOT EXISTS `industry` (
  `id` int(11) NOT NULL COMMENT '行业标签',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称'
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='行业标签库';

--
-- 转存表中的数据 `industry`
--

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

-- --------------------------------------------------------

--
-- 表的结构 `like_logs`
--

CREATE TABLE IF NOT EXISTS `like_logs` (
  `id` int(11) NOT NULL COMMENT '点赞日志表',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `relate_id` int(11) NOT NULL COMMENT '关联id（活动id或资讯id）',
  `msg` varchar(255) NOT NULL COMMENT '日志内容',
  `create_time` datetime NOT NULL COMMENT '记录时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  `type` tinyint(4) NOT NULL COMMENT '类型值：0：活动；1：资讯'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='点赞日志表';

--
-- 转存表中的数据 `like_logs`
--

INSERT INTO `like_logs` (`id`, `user_id`, `relate_id`, `msg`, `create_time`, `update_time`, `type`) VALUES
(1, 8, 18, '进行了点赞', '2016-05-23 16:06:07', '2016-05-23 16:06:07', 1),
(2, 10, 18, '进行了点赞', '2016-06-07 20:55:05', '2016-06-07 20:55:05', 1),
(3, 9, 16, '进行了点赞', '2016-06-07 22:40:32', '2016-06-07 22:40:32', 0),
(4, 10, 15, '进行了点赞', '2016-06-12 14:17:48', '2016-06-12 14:17:48', 0),
(5, 8, 12, '进行了点赞', '2016-06-16 18:21:03', '2016-06-16 18:21:03', 0),
(6, 8, 17, '进行了点赞', '2016-06-16 18:24:11', '2016-06-16 18:24:11', 1);

-- --------------------------------------------------------

--
-- 表的结构 `meet_subject`
--

CREATE TABLE IF NOT EXISTS `meet_subject` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '专家id',
  `title` varchar(150) NOT NULL DEFAULT '' COMMENT '标题',
  `summary` varchar(550) NOT NULL DEFAULT '' COMMENT '简介',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '类型:1对1,2对多',
  `invite_time` varchar(50) NOT NULL COMMENT '约见时间',
  `price` decimal(10,2) NOT NULL COMMENT '价格',
  `address` varchar(250) NOT NULL COMMENT '地址',
  `last_time` tinyint(4) NOT NULL DEFAULT '0' COMMENT '持续时间',
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='专家主题';

--
-- 转存表中的数据 `meet_subject`
--

INSERT INTO `meet_subject` (`id`, `user_id`, `title`, `summary`, `type`, `invite_time`, `price`, `address`, `last_time`, `create_time`, `update_time`) VALUES
(1, 8, '测试话题', '抓拍阿狗阿猫是个练习追焦的好办法，所以我相机包里会放一瓶狗粮用来犒劳模特和让模特保持注意力（之所以不是猫粮是因为我家养的是狗，不过流浪猫挺喜欢吃狗粮的）。\n\n照片中那个碗是邻居送来的红烧肉，小狗馋的的眼珠都像要掉', 2, '2015年5月20日15:00', '150.00', '深圳是福田区东海国际公寓', 1, '2016-05-16 15:22:47', '2016-05-16 15:22:47'),
(2, 8, '互联网开发讲座', '呵呵我就是来扯淡的', 1, '2015年5月20日15:00', '200.00', '深圳是福田区东海国际公寓', 2, '2016-05-16 15:24:30', '2016-05-16 15:24:30'),
(3, 7, '互联网开发讲座', '呵呵我就是来扯淡的', 1, '2015年5月20日15:00', '200.00', '深圳是福田区东海国际公寓', 2, '2016-05-16 15:24:30', '2016-05-16 15:24:30'),
(4, 7, '测试话题', '抓拍阿狗阿猫是个练习追焦的好办法，所以我相机包里会放一瓶狗粮用来犒劳模特和让模特保持注意力（之所以不是猫粮是因为我家养的是狗，不过流浪猫挺喜欢吃狗粮的）。\n\n照片中那个碗是邻居送来的红烧肉，小狗馋的的眼珠都像要掉', 2, '2015年5月20日15:00', '150.00', '深圳是福田区东海国际公寓', 1, '2016-05-16 15:22:47', '2016-05-16 15:22:47');

-- --------------------------------------------------------

--
-- 表的结构 `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL COMMENT '节点名称',
  `node` varchar(50) DEFAULT NULL COMMENT '路径',
  `pid` int(11) NOT NULL COMMENT '父ID',
  `class` varchar(50) DEFAULT NULL COMMENT '样式',
  `rank` int(6) DEFAULT NULL COMMENT '排序',
  `is_menu` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否在菜单显示',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `remark` varchar(100) DEFAULT NULL COMMENT '备注'
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='菜单表';

--
-- 转存表中的数据 `menu`
--

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
(26, '实名认证', '/admin/user/realname', 11, 'icon-eye-open', NULL, 1, 1, ''),
(27, '数据统计', '', 0, '', NULL, 1, 1, ''),
(28, '招聘管理', '', 0, '', NULL, 1, 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `need`
--

CREATE TABLE IF NOT EXISTS `need` (
  `id` int(11) NOT NULL COMMENT '小秘书',
  `user_id` int(11) NOT NULL COMMENT '用户',
  `msg` varchar(550) NOT NULL COMMENT '内容',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态0未读1已读',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '修改时间'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='小秘书';

--
-- 转存表中的数据 `need`
--

INSERT INTO `need` (`id`, `user_id`, `msg`, `status`, `create_time`, `update_time`) VALUES
(1, 8, '4624623', 0, '2016-05-18 15:55:44', '2016-05-18 15:55:44');

-- --------------------------------------------------------

--
-- 表的结构 `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL,
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
  `update_time` datetime DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='咨询表';

--
-- 转存表中的数据 `news`
--

INSERT INTO `news` (`id`, `admin_id`, `admin_name`, `title`, `read_nums`, `praise_nums`, `comment_nums`, `cover`, `body`, `summary`, `create_time`, `update_time`) VALUES
(10, 2, '曹麦穗', '人们习以为常的事却其实在触犯自然法则', 3, 0, 0, '/upload/newscover/2016-05-11/57328fb168e83.jpg', '<p><strong style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">中國湖北 - 恩施土家族苗族自治州 - 鶴峰屏山大峽谷</strong><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">清澈見底的河上，船行上面尤如飄浮空中，泛舟河上，真可以體驗到世外桃源的幽靜！﻿</span></p><p><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">Wisely前陣子就曉得 ‪#‎Starbucks‬ ‪#‎星巴克‬ 即將在台北艋舺大道與西園路交叉口這一帶，在具有歷史背景意義的林家古宅開設 ‪#‎星巴克艋舺門市‬，而這也是繼「大稻埕保安門市」後，成為活化在地老宅的商業模式新型咖啡店！至目前為止，我覺得評價其實還挺兩極的，但至少就觀光的角度來看，起碼它吸引了不少人的目光…</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">連結：</span><a rel="nofollow" target="_blank" href="http://www.wiselyview.cc/read-23143.html" class="ot-anchor aaTEdf" jslog="10929; track:click" dir="ltr" style="-webkit-tap-highlight-color: transparent; text-decoration: none; color: rgb(41, 98, 255); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">http://www.wiselyview.cc/read-23143.html</a><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">臉書：</span><a rel="nofollow" target="_blank" href="https://www.facebook.com/wiselymood/" class="ot-anchor aaTEdf" jslog="10929; track:click" dir="ltr" style="-webkit-tap-highlight-color: transparent; text-decoration: none; color: rgb(41, 98, 255); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">https://www.facebook.com/wiselymood/</a><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">‪#‎台北‬ ‪#‎萬華區‬ ‪#‎捷運龍山寺站‬ ‪#‎咖啡‬ ‪#‎Wisely遊記</span></p>', '人们习以为常的事却其实在触犯自然法则', '2016-05-11 09:54:22', '2016-06-08 13:16:42'),
(11, 2, '曹麦穗', 'G+就是爱旅行', 1, 0, 2, '/upload/newscover/2016-05-11/57329129df6b7.jpg', '<p><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">位於優雅老屋的Keefü Table，店裡的丹麥家具、老物件和經典燈飾都很有看頭，餐點飲品也好吃，老黃說等油煙問題改善，要再來試試木府午食，ya~~</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">Keefü Table</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">地址：台南市東區東榮街44巷12號</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">電話：06-2355139</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">營業時間：11:00~21:00</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">週二週三公休﻿</span></p>', '23333', '2016-05-11 09:56:10', '2016-06-07 21:27:11'),
(12, 2, '曹麦穗', 'cakephp3 + Wpadmin 后台开发文档', 0, 0, 0, '/upload/newscover/2016-05-11/573291606baaf.jpg', '<p><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">位於優雅老屋的Keefü Table，店裡的丹麥家具、老物件和經典燈飾都很有看頭，餐點飲品也好吃，老黃說等油煙問題改善，要再來試試木府午食，ya~~</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">Keefü Table</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">地址：台南市東區東榮街44巷12號</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">電話：06-2355139</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">營業時間：11:00~21:00</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">週二週三公休﻿</span></p>', '55555', '2016-05-11 09:57:02', '2016-05-11 13:23:16'),
(13, 2, '曹麦穗', 'centos php libevent拓展安装', 0, 0, 0, '/upload/newscover/2016-05-19/573d6c22d9ced.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', 'lovelylovelylovelylovelylovelylovelylovelylovelylovelylovely', '2016-05-19 15:34:38', '2016-05-19 15:34:38'),
(14, 2, '曹麦穗', 'mongodb常用shell 命令', 1, 0, 0, '/upload/newscover/2016-05-19/573d6ca5592d2.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', '33sfw3r123rdsgdsagf34r3 dsagdasg3 b43gsag3 23 t3fdsadg dsag 3 34 23 dsag 32', '2016-05-19 15:35:29', '2016-05-24 14:29:54'),
(15, 2, '曹麦穗', 'centos php libevent拓展安装', 1, 0, 0, '/upload/newscover/2016-05-19/573d6cd65c623.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', '版权归作者所有，任何形式转载请联系作者。\r\n作者：卢十四（来自豆瓣）\r\n来源：https://www.douban.com/note/557628871/\r\n\r\n清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。\r\n\r\n正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。\r\n\r\n我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”\r\n\r\n“一百岁了。”我妈声音里透出', '2016-05-19 15:36:36', '2016-06-17 18:07:52'),
(16, 2, '曹麦穗', '母婴健康交流', 177, 0, 2, '/upload/newscover/2016-05-19/573d6d1294b53.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', 'fr21f21f', '2016-05-19 15:37:00', '2016-06-17 18:07:54'),
(17, 2, '曹麦穗', '母婴健康交流', 66, 1, 2, '/upload/newscover/2016-05-19/573d6d1294b53.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', 'fr21f21f', '2016-05-19 15:37:00', '2016-06-17 18:06:26'),
(18, 2, '曹麦穗', '母婴健康交流', 103, 2, 13, '/upload/newscover/2016-05-19/573d6d1294b53.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', 'fr21f21f', '2016-05-19 15:37:00', '2016-06-17 10:15:06'),
(19, 2, '曹麦穗', '母婴健康交流', 16, 0, 2, '/upload/newscover/2016-05-19/573d6d1294b53.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', 'fr21f21f', '2016-05-19 15:37:00', '2016-06-17 18:25:21'),
(20, 2, '曹麦穗', 'centos php libevent拓展安装', 1, 0, 0, '/upload/newscover/2016-05-19/573d6cd65c623.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', '版权归作者所有，任何形式转载请联系作者。\r\n作者：卢十四（来自豆瓣）\r\n来源：https://www.douban.com/note/557628871/\r\n\r\n清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。\r\n\r\n正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。\r\n\r\n我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”\r\n\r\n“一百岁了。”我妈声音里透出', '2016-05-19 15:36:36', '2016-05-31 17:43:59'),
(21, 2, '曹麦穗', 'centos php libevent拓展安装', 0, 0, 0, '/upload/newscover/2016-05-19/573d6c22d9ced.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', 'lovelylovelylovelylovelylovelylovelylovelylovelylovelylovely', '2016-05-19 15:34:38', '2016-05-19 15:34:38'),
(22, 2, '曹麦穗', 'mongodb常用shell 命令', 0, 0, 0, '/upload/newscover/2016-05-19/573d6ca5592d2.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', '33sfw3r123rdsgdsagf34r3 dsagdasg3 b43gsag3 23 t3fdsadg dsag 3 34 23 dsag 32', '2016-05-19 15:35:29', '2016-05-19 15:35:29'),
(23, 2, '曹麦穗', 'centos php libevent拓展安装', 0, 0, 0, '/upload/newscover/2016-05-19/573d6c22d9ced.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', 'lovelylovelylovelylovelylovelylovelylovelylovelylovelylovely', '2016-05-19 15:34:38', '2016-05-19 15:34:38'),
(24, 2, '曹麦穗', 'centos php libevent拓展安装', 1, 0, 0, '/upload/newscover/2016-05-19/573d6cd65c623.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', '版权归作者所有，任何形式转载请联系作者。\r\n作者：卢十四（来自豆瓣）\r\n来源：https://www.douban.com/note/557628871/\r\n\r\n清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。\r\n\r\n正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。\r\n\r\n我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”\r\n\r\n“一百岁了。”我妈声音里透出', '2016-05-19 15:36:36', '2016-06-14 18:34:33'),
(25, 2, '曹麦穗', 'centos php libevent拓展安装', 1, 0, 0, '/upload/newscover/2016-05-19/573d6c22d9ced.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', 'lovelylovelylovelylovelylovelylovelylovelylovelylovelylovely', '2016-05-19 15:34:38', '2016-06-08 13:16:21'),
(26, 2, '曹麦穗', 'centos php libevent拓展安装', 0, 0, 0, '/upload/newscover/2016-05-19/573d6c22d9ced.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', 'lovelylovelylovelylovelylovelylovelylovelylovelylovelylovely', '2016-05-19 15:34:38', '2016-05-19 15:34:38'),
(27, 2, '曹麦穗', 'cakephp3 + Wpadmin 后台开发文档', 0, 0, 0, '/upload/newscover/2016-05-11/573291606baaf.jpg', '<p><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">位於優雅老屋的Keefü Table，店裡的丹麥家具、老物件和經典燈飾都很有看頭，餐點飲品也好吃，老黃說等油煙問題改善，要再來試試木府午食，ya~~</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">Keefü Table</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">地址：台南市東區東榮街44巷12號</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">電話：06-2355139</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">營業時間：11:00~21:00</span><br style="-webkit-tap-highlight-color: transparent; color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);"/><span style="color: rgb(33, 33, 33); font-family: Roboto, RobotoDraft, Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; white-space: pre-wrap; background-color: rgb(254, 254, 254);">週二週三公休﻿</span></p>', '55555', '2016-05-11 09:57:02', '2016-05-11 13:23:16'),
(28, 2, '曹麦穗', '母婴健康交流', 53, 0, 11, '/upload/newscover/2016-05-19/573d6d1294b53.jpg', '<p>版权归作者所有，任何形式转载请联系作者。<br/>作者：卢十四（来自豆瓣）<br/>来源：https://www.douban.com/note/557628871/<br/><br/>清明时节雨纷纷，我这次清明节回老家却赶上阳光灿烂的好天气，运气不错。<br/><br/>正站在家里阳台上晒太阳，突然看到隔壁单元一楼的王奶奶在院子里晾衣服。我心头一动：好几年没见到她，她身形佝偻了一圈，动作也迟缓了很多。<br/><br/>我甚至隐隐惊讶，她居然还在……赶紧回到房间里问我妈：“隔壁单元的王奶奶，今年高寿了？”<br/><br/>“一百岁了。”我妈声音里透出敬意。<br/><br/>我和这位王奶奶虽然做了多年邻居，但没打过交道，仅限于路上遇到时叫一声奶奶好。在很长一段时间里，我对她是何身份，有何经历，家里有什么人，统统一无所知。我对她最深的印象是她总在院子里高声招呼家人，声音洪亮高亢，音调古怪，像一匹马在嘶鸣。<br/><br/>二十年前，外公去世后，外婆搬到我家常住。她那时已经七十多岁，对周边环境又不熟悉，几乎从不出门。爸妈去上班，我去上学，她就日复一日一个人待在家里。突然有一天，我们发现她交到一个朋友，——就是王奶奶。<br/><br/>我外婆站在二楼阳台上，王奶奶站在院子里，俩人不能促膝聊天，就互相喊话：<br/><br/>“你老人家身体好哇！”<br/><br/>“你老人家身体好！”<br/><br/>王奶奶比我外婆大将近十岁。我外婆耳朵不太好，但王奶奶天生高嗓门。一位七十多岁老奶奶和一位八十多岁老奶奶，就这么一聊好半天。<br/><br/>前年我回家的时候，和我妈路过一家敬老院。我妈说：“王奶奶前不久在这里住了大半个月。”<br/><br/>为什么王奶奶要住敬老院？我妈说：“王奶奶和她外孙女住一起。她外孙女要去外地治病，找不到别人照顾王奶奶，只好让她去敬老院住一段时间。”<br/><br/>王奶奶除了一个外孙女没有其他亲人了吗？我追问道。我妈就干脆和我讲了讲王奶奶的生平。<br/><br/>王奶奶本是单位食堂的员工。在四十九岁那年，她的丈夫和两个儿子接连去世，一家人只剩下她一个。后来食堂里另一位丧偶的师傅和她年龄相仿，俩人就结合成新家庭。第二任丈夫有个女儿，对王奶奶也很孝敬。<br/><br/>“这不是很好吗？为什么只剩下一个外孙女呢？”<br/><br/>我妈接着说：王奶奶的第二任丈夫早就不在了。前几年，她的女儿又去世了。——倒不算夭折，因为享年也有七十多岁。<br/><br/>“王奶奶女儿去世后没多久，我在路上遇到她，她对我哭，说‘还是你妈妈命好，有那么多儿子女儿孝顺。我就这么一个女儿，还没有了。’”<br/><br/>就这样，王奶奶现在和唯一的外孙女一起生活。外孙女自己离异了，儿女在外地，也是孤身一人。她去外地治病，王奶奶就只能去敬老院。<br/><br/>我外婆和王奶奶隔空对话了十几年，一位已经八十多，一位已经九十多。王奶奶嗓门依然很高，可我外婆却更加耳背了：<br/><br/>“你老人家身体好哇！”<br/><br/>“啊？”<br/><br/>后来王奶奶就不太爱和我外婆聊天了。她对我妈说：“你妈妈现在耳朵不行了，我和她说话，她听不见！”<br/><br/>从敬老院回来之后，王奶奶赞不绝口，对我妈说：敬老院饮食住宿条件都很好，处处有人照顾，工作人员也都和气周到。<br/><br/>她又问：“好久没见你妈妈了。她还好吧？”<br/><br/>我妈说：“她现在住在我哥哥家，挺好的。”<br/><br/>王奶奶不知道，我外婆已经在2014年的冬天去世了。<br/><br/>屈指一算，我外婆享年九十多岁，王奶奶也确实该有一百岁了。我意识到，我之所以这几年没感觉到她的存在，是因为她也很久没亮出招牌式的大嗓门了。今天再次见到她，令我有些惊喜：咱们楼里竟然出了位百岁老人，整栋楼的人仿佛都沾上点福气。她明显的衰老了，但依然能自己在院子里晾衣服。我不禁想对她喊一声：<br/><br/>“你老人家身体好哇！”<br/><br/>王奶奶的生平故事，我本已记不太清楚，又请我妈给我再讲了一遍。这个故事是从她四十九岁那年开始的：那一年，她连续失去三位至亲。<br/><br/>当时已年近半百的她，又怎么想得到自己还将在人世间继续行走五十多年呢？<br/><br/>在清明时节，偶尔遇到这样的艳阳天，实在令人欣喜。草木尽绿，碧空如洗，春日的阳光第一百次洒在王奶奶身上。天地不仁，草木无情，春光从不过问人世间的生老病死。我们却不能不年复一年在春光中陶醉。<br/><br/>明天一早我们一家要去祖坟上扫墓祭奠。阳世与阴间永是隔绝，而清明节是一扇短暂的窗口，活着的人赶在此时探望去世的亲人，期待用纸钱香火传递信息，也盼望着冥冥虚空中有魂魄注视我们，抚摩我们的头顶。</p>', 'fr21f21f', '2016-05-19 15:37:00', '2016-06-03 10:23:39');

-- --------------------------------------------------------

--
-- 表的结构 `newscom`
--

CREATE TABLE IF NOT EXISTS `newscom` (
  `id` int(11) NOT NULL COMMENT '新闻评论表',
  `news_id` int(11) NOT NULL COMMENT '新闻id',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父id',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `reply_user` int(11) NOT NULL DEFAULT '0' COMMENT '回复人id',
  `body` varchar(500) NOT NULL COMMENT '评论内容',
  `praise_nums` int(11) NOT NULL DEFAULT '0',
  `create_time` datetime NOT NULL COMMENT '评论时间',
  `update_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COMMENT='新闻评论表';

--
-- 转存表中的数据 `newscom`
--

INSERT INTO `newscom` (`id`, `news_id`, `pid`, `user_id`, `reply_user`, `body`, `praise_nums`, `create_time`, `update_time`) VALUES
(1, 4, 0, 2, 0, 'test', 0, '2016-05-05 11:11:11', '0000-00-00 00:00:00'),
(2, 4, 0, 2, 0, '不错啊，哈哈', 2, '2016-05-06 11:11:11', '0000-00-00 00:00:00'),
(3, 11, 0, 8, 0, '不错，值得学习', 0, '2016-05-19 19:26:50', '2016-05-19 19:26:50'),
(4, 11, 0, 8, 0, '我又来评论啦！', 0, '2016-05-19 19:39:03', '2016-05-19 19:39:03'),
(5, 16, 0, 8, 0, '卧槽，不错！', 9, '2016-05-19 20:14:22', '2016-06-07 20:41:26'),
(9, 17, 0, 8, 0, '不错！', 8, '2016-05-20 14:50:37', '2016-06-07 21:18:21'),
(14, 16, 0, 8, 0, '放假房间', 1, '2016-05-20 15:22:16', '2016-05-23 10:30:25'),
(15, 28, 0, 8, 0, '呵呵', 1, '2016-05-20 15:25:24', '2016-05-20 15:25:29'),
(16, 28, 0, 8, 0, '呵呵\n', 1, '2016-05-20 15:31:58', '2016-05-20 15:32:54'),
(17, 28, 0, 8, 0, '不错，很好', 1, '2016-05-20 16:00:30', '2016-05-20 16:54:17'),
(18, 28, 0, 8, 0, '受到了1万点伤害', 1, '2016-05-20 16:58:28', '2016-05-20 16:58:43'),
(19, 28, 0, 8, 0, '正取果上果', 1, '2016-05-20 16:59:51', '2016-05-20 16:59:55'),
(20, 18, 0, 8, 0, '43523531252', 2, '2016-05-23 11:17:40', '2016-06-13 16:37:04'),
(21, 18, 0, 8, 0, '不错，值得膜拜', 2, '2016-05-23 11:21:58', '2016-06-13 16:37:08'),
(22, 18, 0, 8, 0, '卧槽，我要打鸡血了。', 1, '2016-05-23 11:22:29', '2016-05-23 11:22:34'),
(23, 18, 0, 8, 0, '打鸡血', 1, '2016-05-23 15:55:43', '2016-05-23 15:55:48'),
(25, 18, 22, 8, 8, '嘻嘻，打吧，打吧', 1, '2016-05-23 17:48:37', '2016-06-13 16:37:15'),
(26, 18, 0, 7, 0, '嘻嘻，打吧，打吧', 1, '2016-05-23 17:48:37', '2016-06-13 16:36:59'),
(27, 18, 26, 8, 7, '呵呵，不想跟你说话。', 0, '2016-05-23 18:24:18', '2016-05-23 18:24:18'),
(28, 18, 26, 8, 7, '对啊，不想跟你说话', 0, '2016-05-23 18:25:24', '2016-05-23 18:25:24'),
(29, 18, 26, 8, 7, '妹子，你的头像很漂亮哦', 0, '2016-05-23 18:28:24', '2016-05-23 18:28:24'),
(30, 18, 26, 8, 7, '哇塞，美女！', 0, '2016-05-23 18:30:41', '2016-05-23 18:30:41'),
(31, 18, 26, 8, 7, '妹子加我Q：233333333', 0, '2016-05-23 18:35:00', '2016-05-23 18:35:00'),
(32, 18, 26, 8, 7, '妹子加我Q：233333333', 0, '2016-05-23 18:35:18', '2016-05-23 18:35:18'),
(33, 18, 26, 8, 7, '妹子加我Q：233333333', 0, '2016-05-23 18:35:52', '2016-05-23 18:35:52'),
(34, 0, 0, 0, 0, '', 0, '2016-06-14 19:46:34', '2016-06-14 19:46:34'),
(35, 0, 0, 0, 0, '', 0, '2016-06-14 19:46:45', '2016-06-14 19:46:45'),
(36, 17, 0, 8, 0, '哎哟，不错哦', 1, '2016-06-16 18:23:23', '2016-06-16 18:23:30');

-- --------------------------------------------------------

--
-- 表的结构 `news_collect`
--

CREATE TABLE IF NOT EXISTS `news_collect` (
  `id` int(11) NOT NULL COMMENT '用户新闻收藏表',
  `user_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户资讯收藏';

-- --------------------------------------------------------

--
-- 表的结构 `news_industry`
--

CREATE TABLE IF NOT EXISTS `news_industry` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL DEFAULT '0',
  `industry_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='新闻行业标签';

--
-- 转存表中的数据 `news_industry`
--

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

-- --------------------------------------------------------

--
-- 表的结构 `news_savant`
--

CREATE TABLE IF NOT EXISTS `news_savant` (
  `id` int(11) NOT NULL COMMENT '专家推荐资讯关系表',
  `news_id` int(11) NOT NULL COMMENT '资讯id',
  `savant_id` int(11) NOT NULL COMMENT '专家id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='专家推荐活动关系表';

-- --------------------------------------------------------

--
-- 表的结构 `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL,
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
  `update_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='订单表';

--
-- 转存表中的数据 `order`
--

INSERT INTO `order` (`id`, `type`, `relate_id`, `user_id`, `seller_id`, `order_no`, `out_trade_no`, `paytype`, `price`, `fee`, `remark`, `status`, `create_time`, `update_time`) VALUES
(3, 1, 7, 7, 8, '14648363607781', NULL, 1, '150.00', '0.00', '预约话题测试话题', 0, '2016-06-02 10:59:20', '2016-06-02 10:59:20'),
(6, 1, 6, 8, 7, '146483924186123', NULL, 1, '150.00', '0.00', '预约话题测试话题', 1, '2016-06-02 11:47:21', '2016-06-13 17:00:30');

-- --------------------------------------------------------

--
-- 表的结构 `projrong`
--

CREATE TABLE IF NOT EXISTS `projrong` (
  `id` int(10) unsigned NOT NULL COMMENT '融资项目',
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
  `update_time` datetime DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='融资项目';

--
-- 转存表中的数据 `projrong`
--

INSERT INTO `projrong` (`id`, `user_id`, `publisher`, `company`, `title`, `rzjd`, `address`, `scale`, `stock`, `read_nums`, `praise_nums`, `comment_nums`, `cover`, `body`, `summary`, `comp_desc`, `team`, `attach`, `status`, `create_time`, `update_time`) VALUES
(2, 2, '曹文鹏', '腾讯科技', '母婴健康交流', 'A轮', '深圳市南山区腾讯大厦', '500人', '14%', NULL, NULL, NULL, '/upload/proj/cover/2016-04-22/5719a69da9447.jpg', '特特', '12', '33', '养生项目组', '/upload/proj/attach/2016-04-22/5719a6b8d85c9.pptx', NULL, '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `projrong_fans`
--

CREATE TABLE IF NOT EXISTS `projrong_fans` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='融资项目感兴趣的人';

-- --------------------------------------------------------

--
-- 表的结构 `rong_tag`
--

CREATE TABLE IF NOT EXISTS `rong_tag` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `industry_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='融资项目行业标签';

--
-- 转存表中的数据 `rong_tag`
--

INSERT INTO `rong_tag` (`id`, `project_id`, `industry_id`) VALUES
(1, 2, 2),
(2, 2, 5);

-- --------------------------------------------------------

--
-- 表的结构 `savant`
--

CREATE TABLE IF NOT EXISTS `savant` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cover` varchar(550) NOT NULL DEFAULT '' COMMENT '封面',
  `xmjy` varchar(550) NOT NULL DEFAULT '' COMMENT '项目经验',
  `zyys` varchar(550) NOT NULL COMMENT '资源优势',
  `summary` varchar(550) NOT NULL COMMENT '简洁'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='专家信息表';

--
-- 转存表中的数据 `savant`
--

INSERT INTO `savant` (`id`, `user_id`, `cover`, `xmjy`, `zyys`, `summary`) VALUES
(3, 8, '', '7年dota经验，精通所有英雄，5个位置都能打，擅长C位，伐木能力惊人！', 'dota 坑逼 菜鱼\n万年经济垫底飞鞋送人头 菜黄\n烈士路第一单 小金子\n中路菜鸡 左XX', '');

-- --------------------------------------------------------

--
-- 表的结构 `smsmsg`
--

CREATE TABLE IF NOT EXISTS `smsmsg` (
  `id` int(11) NOT NULL,
  `phone` varchar(50) NOT NULL DEFAULT '0' COMMENT '手机号',
  `code` varchar(50) DEFAULT NULL COMMENT '验证码',
  `content` varchar(250) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COMMENT='短信记录';

--
-- 转存表中的数据 `smsmsg`
--

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
(51, '13510663507', '1924', '您的动态验证码为1924', '2016-06-17 12:12:48'),
(52, '15986227560', '8865', '您的动态验证码为8865', '2016-06-17 16:42:58'),
(53, '15986227560', '5378', '您的动态验证码为5378', '2016-06-17 16:43:01'),
(54, '13510663507', '9317', '您的动态验证码为9317', '2016-06-17 18:15:03');

-- --------------------------------------------------------

--
-- 表的结构 `sponsor`
--

CREATE TABLE IF NOT EXISTS `sponsor` (
  `id` int(11) NOT NULL COMMENT 'æ´»åŠ¨èµžåŠ©è¡¨',
  `user_id` int(11) NOT NULL COMMENT 'ç”¨æˆ·id',
  `activity_id` int(11) NOT NULL COMMENT 'æ´»åŠ¨id',
  `create_time` datetime NOT NULL COMMENT 'æäº¤æ—¶é—´',
  `type` tinyint(4) NOT NULL COMMENT 'ç±»åž‹å€¼ï¼š1ï¼šå˜‰å®¾æŽ¨èï¼›2ï¼šåœºåœ°èµžåŠ©ï¼›3ï¼šçŽ°é‡‘èµžåŠ©ï¼›4ï¼šç‰©å“èµžåŠ©ï¼›5ï¼šå…¶ä»–',
  `description` varchar(550) DEFAULT NULL COMMENT 'æè¿°',
  `name` varchar(20) DEFAULT NULL COMMENT 'å§“å',
  `company` varchar(100) DEFAULT NULL COMMENT 'å…¬å¸/æœºæž„',
  `department` varchar(20) DEFAULT NULL COMMENT 'éƒ¨é—¨',
  `position` varchar(20) DEFAULT NULL COMMENT 'èŒåŠ¡',
  `address` varchar(255) DEFAULT NULL COMMENT 'åœ°å€',
  `people` int(11) DEFAULT NULL COMMENT 'å®¹çº³äººæ•°'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='æ´»åŠ¨èµžåŠ©è¡¨';

-- --------------------------------------------------------

--
-- 表的结构 `subject_book`
--

CREATE TABLE IF NOT EXISTS `subject_book` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL DEFAULT '0' COMMENT '话题id',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `savant_id` int(11) NOT NULL DEFAULT '0' COMMENT '专家id',
  `summary` varchar(550) NOT NULL DEFAULT '' COMMENT '需求简介',
  `status` tinyint(4) NOT NULL COMMENT '0,未确认1确认通过2不予通过3完成',
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='话题预约';

--
-- 转存表中的数据 `subject_book`
--

INSERT INTO `subject_book` (`id`, `subject_id`, `user_id`, `savant_id`, `summary`, `status`, `create_time`, `update_time`) VALUES
(6, 4, 8, 7, 'gasgdsa1', 3, '2016-05-26 18:27:45', '2016-06-13 17:00:30'),
(7, 1, 7, 8, 'gasgdsa1', 0, '2016-05-26 18:27:45', '2016-05-26 18:27:45');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL COMMENT '用户表',
  `phone` varchar(20) NOT NULL COMMENT '手机号',
  `wx_openid` varchar(100) DEFAULT '' COMMENT '微信的openid',
  `user_token` varchar(20) NOT NULL COMMENT '用户标志',
  `app_wx_openid` varchar(50) DEFAULT NULL COMMENT 'app端的微信openid',
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
  `update_time` datetime DEFAULT NULL COMMENT '修改时间'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='用户表';

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `phone`, `wx_openid`, `user_token`, `app_wx_openid`, `truename`, `level`, `idcard`, `company`, `position`, `email`, `gender`, `agency_id`, `ext_industry`, `goodat`, `city`, `card_path`, `avatar`, `money`, `meet_nums`, `fans`, `ymjy`, `ywnl`, `reason`, `status`, `savant_status`, `enabled`, `create_time`, `update_time`) VALUES
(2, '', '', '', NULL, 'admin', '1', '', '', '', '', 1, 0, '', '', '', '', '', '0.00', 0, 0, '', '', '', 1, 1, 1, '0000-00-00 00:00:00', NULL),
(7, '18681509040', '', '', NULL, '郑旭', '2', '', '中青文化投资管理有限公司', '互联网事业部副总经理', 'claus@smartlemon.cn', 1, 17, '6642', '', '', '/upload/user/mp/2016-05-05/572b2466c4068.jpg', '/upload/user/avatar/avatar2.jpg', '300.00', 0, 1, '', '', '', 2, 1, 1, '2016-05-05 18:46:01', '2016-06-13 17:00:30'),
(8, '18316629973', 'oqQRxsx_srEukkVOBQMVWsmPDPbY', '5760b3d3207fc', NULL, '曹麦穗', '2', '', '广东深宏盾律师事务所', '共产主义接班人', '714265403@qq.com', 1, 13, '打dota', '', '', '/upload/user/mp/2016-05-09/57305f00c5c1a.jpg', 'http://wx.qlogo.cn/mmopen/ajNVdqHZLLCOibYvNGzNtJmgyOEpAyhkd45A3gbGgt2mbDYUdMeBVbbe9SmxwJiceNGd4ibZCeKTHSDq1kJDkVibXQ/0', '0.00', 0, 1, '', '', '', 2, 3, 1, '2016-05-09 17:57:24', '2016-05-13 17:43:16'),
(9, '13560627825', '', '', NULL, '游依婷', '1', '', '广东深宏盾律师事务所', '', '71426333x@qq.com', 1, 28, '', '', '', '/upload/user/mp/2016-05-11/573312fbdeaa3.jpg', '', '0.00', 0, 0, '', '', '', 1, 1, 1, '2016-05-11 19:10:58', '2016-05-11 19:20:01');

-- --------------------------------------------------------

--
-- 表的结构 `usermsg`
--

CREATE TABLE IF NOT EXISTS `usermsg` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '类型',
  `table_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT '记录id',
  `title` varchar(150) NOT NULL COMMENT '标题',
  `msg` varchar(550) NOT NULL COMMENT '内容',
  `num` smallint(6) NOT NULL DEFAULT '0' COMMENT '关注条数',
  `url` varchar(250) NOT NULL DEFAULT '' COMMENT '跳转链接',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0未读1已读',
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COMMENT='用户消息';

--
-- 转存表中的数据 `usermsg`
--

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
(32, 8, 2, 5, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-07 20:41:26', '2016-06-07 20:41:26'),
(33, 8, 2, 9, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-07 21:18:21', '2016-06-07 21:18:21'),
(34, 7, 2, 26, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 0, '2016-06-13 16:36:59', '2016-06-13 16:36:59'),
(35, 8, 2, 20, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-13 16:37:05', '2016-06-13 16:37:05'),
(36, 8, 2, 21, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-13 16:37:08', '2016-06-13 16:37:08'),
(37, 8, 2, 25, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 1, '2016-06-13 16:37:15', '2016-06-13 16:37:15'),
(38, 8, 2, 18, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 0, '2016-06-16 18:22:15', '2016-06-16 18:22:15'),
(39, 8, 2, 36, '您有新的点赞', '您的评论获得新的点赞', 0, '/news/view/{#id#}#{#com_id#}', 0, '2016-06-16 18:23:30', '2016-06-16 18:23:30');

-- --------------------------------------------------------

--
-- 表的结构 `user_fans`
--

CREATE TABLE IF NOT EXISTS `user_fans` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT '关注者',
  `following_id` int(11) NOT NULL COMMENT '被关注者',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1,单向关注2互为关注',
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='用户关系表';

--
-- 转存表中的数据 `user_fans`
--

INSERT INTO `user_fans` (`id`, `user_id`, `following_id`, `type`, `create_time`, `update_time`) VALUES
(10, 8, 7, 2, '2016-05-18 10:51:51', '2016-05-18 10:51:51'),
(11, 7, 8, 2, '2016-05-18 10:51:51', '2016-05-18 10:51:51');

-- --------------------------------------------------------

--
-- 表的结构 `user_industry`
--

CREATE TABLE IF NOT EXISTS `user_industry` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `industry_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COMMENT='用户行业标签';

--
-- 转存表中的数据 `user_industry`
--

INSERT INTO `user_industry` (`id`, `user_id`, `industry_id`) VALUES
(20, 7, 9),
(21, 7, 16),
(22, 8, 8),
(23, 8, 19),
(24, 9, 11),
(25, 9, 19),
(26, 8, 20),
(27, 10, 5),
(28, 10, 8),
(29, 10, 11),
(30, 10, 15);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actionlog`
--
ALTER TABLE `actionlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `activityapply`
--
ALTER TABLE `activityapply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activitycom`
--
ALTER TABLE `activitycom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_industry`
--
ALTER TABLE `activity_industry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_savant`
--
ALTER TABLE `activity_savant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `adminmsg`
--
ALTER TABLE `adminmsg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_group`
--
ALTER TABLE `admin_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_id` (`admin_id`,`group_id`);

--
-- Indexes for table `agency`
--
ALTER TABLE `agency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `career`
--
ALTER TABLE `career`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collect`
--
ALTER TABLE `collect`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_like`
--
ALTER TABLE `comment_like`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flow`
--
ALTER TABLE `flow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `group_menu`
--
ALTER TABLE `group_menu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_id` (`group_id`,`menu_id`);

--
-- Indexes for table `industry`
--
ALTER TABLE `industry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like_logs`
--
ALTER TABLE `like_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meet_subject`
--
ALTER TABLE `meet_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `need`
--
ALTER TABLE `need`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `newscom`
--
ALTER TABLE `newscom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_collect`
--
ALTER TABLE `news_collect`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_industry`
--
ALTER TABLE `news_industry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_savant`
--
ALTER TABLE `news_savant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projrong`
--
ALTER TABLE `projrong`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projrong_fans`
--
ALTER TABLE `projrong_fans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rong_tag`
--
ALTER TABLE `rong_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `savant`
--
ALTER TABLE `savant`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `smsmsg`
--
ALTER TABLE `smsmsg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_book`
--
ALTER TABLE `subject_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phone` (`phone`);

--
-- Indexes for table `usermsg`
--
ALTER TABLE `usermsg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_fans`
--
ALTER TABLE `user_fans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_industry`
--
ALTER TABLE `user_industry`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actionlog`
--
ALTER TABLE `actionlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键，自增',AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '活动表',AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `activityapply`
--
ALTER TABLE `activityapply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '活动申请表';
--
-- AUTO_INCREMENT for table `activitycom`
--
ALTER TABLE `activitycom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '活动评论表',AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `activity_industry`
--
ALTER TABLE `activity_industry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'æ´»åŠ¨æ ‡ç­¾è¡¨',AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `activity_savant`
--
ALTER TABLE `activity_savant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '专家推荐活动关系表';
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `adminmsg`
--
ALTER TABLE `adminmsg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '后台消息',AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `admin_group`
--
ALTER TABLE `admin_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `agency`
--
ALTER TABLE `agency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '行业标签',AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '轮播图',AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `career`
--
ALTER TABLE `career`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '工作经历';
--
-- AUTO_INCREMENT for table `collect`
--
ALTER TABLE `collect`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '点赞日志表',AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `comment_like`
--
ALTER TABLE `comment_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论点赞表',AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '教育经历表';
--
-- AUTO_INCREMENT for table `flow`
--
ALTER TABLE `flow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `group_menu`
--
ALTER TABLE `group_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `industry`
--
ALTER TABLE `industry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '行业标签',AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `like_logs`
--
ALTER TABLE `like_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '点赞日志表',AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `meet_subject`
--
ALTER TABLE `meet_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `need`
--
ALTER TABLE `need`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '小秘书',AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `newscom`
--
ALTER TABLE `newscom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '新闻评论表',AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `news_collect`
--
ALTER TABLE `news_collect`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户新闻收藏表';
--
-- AUTO_INCREMENT for table `news_industry`
--
ALTER TABLE `news_industry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `news_savant`
--
ALTER TABLE `news_savant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '专家推荐资讯关系表';
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `projrong`
--
ALTER TABLE `projrong`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '融资项目',AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `projrong_fans`
--
ALTER TABLE `projrong_fans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rong_tag`
--
ALTER TABLE `rong_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `savant`
--
ALTER TABLE `savant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `smsmsg`
--
ALTER TABLE `smsmsg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `sponsor`
--
ALTER TABLE `sponsor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'æ´»åŠ¨èµžåŠ©è¡¨';
--
-- AUTO_INCREMENT for table `subject_book`
--
ALTER TABLE `subject_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户表',AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `usermsg`
--
ALTER TABLE `usermsg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `user_fans`
--
ALTER TABLE `user_fans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `user_industry`
--
ALTER TABLE `user_industry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
