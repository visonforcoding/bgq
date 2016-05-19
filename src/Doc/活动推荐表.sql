CREATE TABLE `sponsor` (
	`id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '活动赞助表',
	`user_id` INT(11) NOT NULL COMMENT '用户id',
	`activity_id` INT(11) NOT NULL COMMENT '活动id',
	`create_time` DATETIME NOT NULL COMMENT '提交时间',
	`type` TINYINT NOT NULL COMMENT '类型值：1：嘉宾推荐；2：场地赞助；3：现金赞助；4：物品赞助；5：其他',
	`description` varchar(550) COMMENT '描述',
	`name` varchar(20) COMMENT '姓名',
	`company` varchar(100) COMMENT '公司/机构',
	`department` varchar(20) COMMENT '部门',
	`position` varchar(20) COMMENT '职务',
	`address` varchar(255) COMMENT '地址',
	`people` INT COMMENT '容纳人数',
	PRIMARY KEY (`id`)
)
COMMENT='活动赞助表'
COLLATE='utf8_general_ci'
ENGINE=InnoDB