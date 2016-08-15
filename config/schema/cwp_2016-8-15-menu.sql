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
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='菜单表';

-- 正在导出表  binggq.menu 的数据：~89 rows (大约)
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
	(99, '资讯标签修改', '/admin/newstag/edit', 95, '', NULL, 0, 1, '');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
