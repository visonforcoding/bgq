-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        5.7.12-0ubuntu1.1 - (Ubuntu)
-- 服务器操作系统:                      Linux
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
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='菜单表';

-- 正在导出表  binggq.menu 的数据：~31 rows (大约)
DELETE FROM `menu`;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `name`, `node`, `pid`, `class`, `rank`, `is_menu`, `status`, `remark`) VALUES
	(1, '系统管理', '', 0, 'icon-cog', NULL, 1, 1, ''),
	(2, '菜单管理', '/admin/menu/index', 1, 'icon-align-justify', NULL, 1, 1, ''),
	(3, '行业标签管理', '/admin/industry/index', 36, 'icon-beaker', NULL, 1, 1, ''),
	(6, '机构标签管理', '/admin/agency/index', 36, 'icon-building', NULL, 1, 1, ''),
	(7, '机构标签添加', '/admin/agency/add', 6, '', NULL, 0, 1, ''),
	(10, '菜单添加', '/admin/menu/add', 2, '', NULL, 0, 1, '菜单添加'),
	(11, '用户管理', '', 0, 'icon-user', 3, 1, 1, ''),
	(12, '会员管理', '/admin/user/index', 11, 'icon-user', NULL, 1, 1, ''),
	(13, '资讯管理', '/admin/news/index', 14, 'icon-newspaper-o', 10, 1, 1, ''),
	(14, '内容管理', '', 0, 'icon-newspaper-o', 2, 1, 1, ''),
	(15, '添加资讯', '/admin/news/add', 13, '', NULL, 0, 1, ''),
	(16, '活动管理', '/admin/activity/index', 14, 'icon-trophy', 9, 1, 1, ''),
	(17, '轮播图管理', '/admin/banner/index', 14, 'icon-file-image', 7, 1, 1, ''),
	(19, '融资项目管理', '/admin/projrong/index', 20, 'icon-cubes', NULL, 1, 1, ''),
	(20, '项目管理', '', 0, 'icon-diamond', 2, 1, 1, ''),
	(21, '消息中心', '/admin/adminmsg/index', 0, 'icon-tasks', -1, 0, 1, ''),
	(23, '群组管理', '/wpadmin/group/index', 1, 'icon-group', NULL, 0, 1, ''),
	(24, '轮播图添加', '/admin/banner/add', 17, '', NULL, 0, 1, ''),
	(25, '添加行业标签', '/admin/industry/add', 3, '', NULL, 0, 1, ''),
	(26, '实名认证', '/admin/user/realname', 11, 'icon-eye-open', NULL, 1, 1, ''),
	(27, '数据统计', '', 0, '', NULL, 1, 1, ''),
	(28, '招聘管理', '', 0, '', NULL, 1, 1, ''),
	(29, '提现管理', '/admin/withdraw/index', 14, 'icon-dollar', NULL, 1, 1, '用户的提现管理'),
	(30, '活动评论管理', '/admin/activitycom/index', 35, 'icon-comments', NULL, 1, 1, ''),
	(31, '资讯评论管理', '/admin/newscom/index', 35, 'icon-comments', NULL, 1, 1, ''),
	(32, '大咖推荐', '/admin/biggieAd/index', 14, 'icon-lightbulb', 8, 1, 1, ''),
	(33, '添加会员', '/admin/user/add', 12, '', NULL, 0, 1, '后台添加会员'),
	(34, '会员编辑', '/admin/user/edit', 12, '', NULL, 0, 1, '对会员信息的编辑'),
	(35, '评论管理', '', 0, 'icon-comments-alt', 0, 1, 1, '包含所有平评论的管理入口'),
	(36, '标签管理', '', 0, 'icon-tags', 1, 1, 1, '个人标签、行业标签'),
	(37, '小秘书', '/admin/need/index', 0, '', NULL, 0, 1, '');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
