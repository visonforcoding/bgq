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
	(6, 1, 6, 8, 7, '14648392418692', NULL, 1, 150.00, 0.00, '预约话题测试话题', 1, '2016-06-02 11:47:21', '2016-06-13 12:06:29');
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
