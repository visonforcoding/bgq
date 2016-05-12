CREATE TABLE `activityapply` (
	`id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '活动申请表',
	`user_id` INT(11) NOT NULL COMMENT '用户id',
	`activity_id` INT(11) NOT NULL COMMENT '活动id',
	`create_time` DATETIME NOT NULL COMMENT '提交时间',
	`update_time` DATETIME NOT NULL COMMENT '更新时间',
	`is_pass` TINYINT(2) DEFAULT 0 COMMENT '审核是否通过',
	`is_top` TINYINT(2) DEFAULT 0 COMMENT '是否置顶',
	PRIMARY KEY (`id`)
)
COMMENT='活动申请表'
COLLATE='utf8_general_ci'
ENGINE=InnoDB