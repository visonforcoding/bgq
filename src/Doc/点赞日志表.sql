CREATE TABLE `like_logs` (
	`id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '点赞日志表',
	`user_id` INT(11) NOT NULL COMMENT '用户id',
	`relate_id` INT(11) NOT NULL COMMENT '关联id（活动id或资讯id）',
	`msg` varchar(255) NOT NULL COMMENT '日志内容',
	`create_time` DATETIME NOT NULL COMMENT '记录时间',
	`update_time` DATETIME NOT NULL COMMENT '更新时间',
	`type` TINYINT NOT NULL COMMENT '类型值：0：活动；1：资讯',
	PRIMARY KEY (`id`)
)
COMMENT='点赞日志表'
COLLATE='utf8_general_ci'
ENGINE=InnoDB